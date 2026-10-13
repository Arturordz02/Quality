<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Test Suite Automatizado: Verificación Dinámica de PDU en Detalle de Capacitaciones
 *
 * Casos de prueba:
 * 1. Taller de Herramientas define y genera exactamente "6 PDU" y NO "16 PDU".
 * 2. Cero (0) apariciones de "16 PDU" en la página generada del Taller de Herramientas.
 * 3. Gerencia de la Calidad, ISO 9001 y Control de Tunelería mantienen "16 PDU" dinámico.
 * 4. La plantilla compartida (course_detail_unified.php) NO tiene "16 PDU" hardcodeado.
 * 5. Si un curso carece de PDU (vacío), el bloque .qcs-cd-pdu-dark-bar no se renderiza.
 */

declare(strict_types=1);

$totalTests = 0;
$passedTests = 0;

function runTest(string $description, callable $fn): void {
    global $totalTests, $passedTests;
    $totalTests++;
    echo "• Probando: {$description}... ";
    try {
        $result = $fn();
        if ($result === true) {
            $passedTests++;
            echo "[\033[32mPASÓ\033[0m]\n";
        } else {
            echo "[\033[31mFALLÓ\033[0m] (Retornó no-true)\n";
        }
    } catch (\Throwable $e) {
        echo "[\033[31mFALLÓ\033[0m] Excepción: " . $e->getMessage() . "\n";
    }
}

echo "\n=======================================================\n";
echo "EJECUTANDO SUITE DE PRUEBAS DE PDU DINÁMICO EN CURSOS\n";
echo "=======================================================\n\n";

// Caso 1: herramientas.php define pdu_title con "6 PDU"
runTest('herramientas.php define pdu_title con "6 PDU"', function(): bool {
    $content = file_get_contents(dirname(__DIR__) . '/private_app/app/Views/pages/herramientas.php');
    if ($content === false) {
        return false;
    }
    return str_contains($content, "'pdu_title'") && str_contains($content, '6 PDU');
});

// Caso 2: course_detail_unified.php no tiene "16 PDU" hardcodeado
runTest('course_detail_unified.php no contiene "16 PDU" hardcodeado', function(): bool {
    $content = file_get_contents(dirname(__DIR__) . '/private_app/app/Views/partials/course_detail_unified.php');
    if ($content === false) {
        return false;
    }
    return !str_contains($content, '16 PDU');
});

function runPhpCode(string $code): string {
    $proc = proc_open('php', [
        0 => ['pipe', 'r'],
        1 => ['pipe', 'w'],
        2 => ['pipe', 'w'],
    ], $pipes);
    if (!is_resource($proc)) return '';
    fwrite($pipes[0], "<?php\n" . $code);
    fclose($pipes[0]);
    $out = stream_get_contents($pipes[1]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    proc_close($proc);
    return (string)$out;
}

// Caso 3: Renderizado simulado sin PDU no muestra el bloque
runTest('Curso sin PDU no renderiza el bloque .qcs-cd-pdu-dark-bar', function(): bool {
    $partialPath = dirname(__DIR__) . '/private_app/app/Views/partials/course_detail_unified.php';
    $code = '
    $course = [
        "title" => "Curso Sin PDU",
        "pdu_title" => "",
        "pdu_text" => "",
    ];
    ob_start();
    include "' . addslashes($partialPath) . '";
    $output = ob_get_clean();
    echo str_contains($output, "qcs-cd-pdu-dark-bar") ? "FAIL" : "OK";
    ';
    $output = runPhpCode($code);
    return trim((string)$output) === 'OK';
});

// Caso 4: Renderizado con pdu_title dinámico muestra el título seguro
runTest('Renderizado con pdu_title dinámico muestra el título configurado', function(): bool {
    $partialPath = dirname(__DIR__) . '/private_app/app/Views/partials/course_detail_unified.php';
    $code = '
    $course = [
        "title" => "Taller",
        "pdu_title" => "Unidades de desarrollo profesional (6 PDU)",
        "pdu_text" => "Otorga 06 PDU",
    ];
    ob_start();
    include "' . addslashes($partialPath) . '";
    $output = ob_get_clean();
    $has6 = str_contains($output, "Unidades de desarrollo profesional (6 PDU)");
    $has16 = str_contains($output, "16 PDU");
    echo ($has6 && !$has16) ? "OK" : "FAIL";
    ';
    $output = runPhpCode($code);
    return trim((string)$output) === 'OK';
});

// Caso 5: HTML generado de herramientas.html tiene exactamente 0 apariciones de "16 PDU"
runTest('Archivo _site/herramientas.html tiene 0 apariciones de "16 PDU"', function(): bool {
    $path = dirname(__DIR__) . '/_site/herramientas.html';
    if (!file_exists($path)) {
        // Si no se ha compilado aún, no falla el test unitario si no existe, pero advertimos
        return false;
    }
    $html = file_get_contents($path);
    if ($html === false) {
        return false;
    }
    $count16 = substr_count($html, '16 PDU');
    $has6 = str_contains($html, '6 PDU');
    return ($count16 === 0 && $has6);
});

// Caso 6: Cursos de 16 PDU conservan sus 16 PDU en _site
runTest('Cursos aprobados de 16 PDU conservan "16 PDU" en sus páginas', function(): bool {
    $courses = [
        'gerencia-de-calidad.html',
        'iso-9001.html',
        'control-de-calidad-en-tuneleria.html',
        'calidad-y-pmi.html',
    ];
    foreach ($courses as $file) {
        $path = dirname(__DIR__) . '/_site/' . $file;
        if (!file_exists($path)) {
            return false;
        }
        $html = file_get_contents($path);
        if ($html === false || !str_contains($html, '16 PDU')) {
            return false;
        }
    }
    return true;
});

// Caso 7: _site/herramientas.html y herramientas.php no contienen "6 horas netas"
runTest('herramientas.php y _site/herramientas.html no contienen "6 horas netas"', function(): bool {
    $phpPath = dirname(__DIR__) . '/private_app/app/Views/pages/herramientas.php';
    $htmlPath = dirname(__DIR__) . '/_site/herramientas.html';
    $phpContent = file_get_contents($phpPath);
    $htmlContent = file_exists($htmlPath) ? file_get_contents($htmlPath) : '';
    if ($phpContent === false) {
        return false;
    }
    $hasInPhp = stripos($phpContent, '6 horas netas') !== false;
    $hasInHtml = ($htmlContent !== '') ? (stripos($htmlContent, '6 horas netas') !== false) : false;
    return (!$hasInPhp && !$hasInHtml);
});

echo "\n-------------------------------------------------------\n";
echo "RESULTADOS: {$passedTests} de {$totalTests} pruebas pasadas con éxito.\n";
echo "-------------------------------------------------------\n\n";

if ($passedTests !== $totalTests) {
    exit(1);
}
exit(0);
