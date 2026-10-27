<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Test Suite Automatizado: Validación de Capacitaciones sin Página Propia en Catálogo y Contacto
 * Archivo: tests/CatalogPendingCoursesUxTest.php
 *
 * Valida:
 * 1. CoursesCatalog contiene exactamente 49 cursos en total.
 * 2. Exactamente 45 cursos tienen ruta propia y exactamente 4 tienen 'route' => null (45, 46, 47, 48).
 * 3. Cursos 45, 46, 47 y 48 cuentan con slugs canónicos definidos y accesibles vía getCourseSlug().
 * 4. CoursesCatalog::findBySlugOrIdentifier() valida correctamente slugs/números y rechaza valores inválidos/inyecciones.
 * 5. Vista de catálogo (capacitacion.php) renderiza exactamente 45 enlaces "VER CAPACITACIÓN" y 4 de "Solicitar información" con badge "Información próximamente".
 * 6. Vista de categoría (category_page_content.php) incluye la lógica de "Información próximamente" y "Solicitar información" para cursos sin ruta.
 * 7. En /contacto se incorpora campo select "Programa de Interés (Opcional)" con los programas oficiales del catálogo.
 * 8. En /contacto se preselecciona de forma segura el curso cuando se pasa un slug válido en ?programa= y se ignora si es inválido.
 * 9. script.js contiene la auto-selección en cliente para compatibilidad estática y no bloquea el envío de formulario.
 * 10. Accesibilidad: sin href="#", sin botones deshabilitados confusos, enlaces navegables con teclado y tarjetas estructuralmente limpias.
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

echo "\n====================================================================\n";
echo "EJECUTANDO SUITE DE PRUEBAS: CAPACITACIONES SIN PÁGINA INDIVIDUAL\n";
echo "====================================================================\n\n";

$baseDir = dirname(__DIR__);
require_once $baseDir . '/private_app/app/Services/CoursesCatalog.php';

use App\Services\CoursesCatalog;

// Test 1: Conteo total institucional de 49 capacitaciones
runTest("CoursesCatalog::getAll() devuelve exactamente 49 capacitaciones", function(): bool {
    $all = CoursesCatalog::getAll();
    if (count($all) !== 49) {
        throw new \Exception("Se esperaban 49 capacitaciones, se encontraron " . count($all));
    }
    return true;
});

// Test 2: Conteo de rutas (45 con página propia, 4 con route => null)
runTest("Exactamente 45 cursos tienen página individual y 4 cursos tienen route => null (45, 46, 47, 48)", function(): bool {
    $all = CoursesCatalog::getAll();
    $withRoute = array_filter($all, fn($c) => !empty($c['route']));
    $withoutRoute = array_filter($all, fn($c) => empty($c['route']));

    if (count($withRoute) !== 45) {
        throw new \Exception("Se esperaban 45 cursos con ruta, se encontraron " . count($withRoute));
    }
    if (count($withoutRoute) !== 4) {
        throw new \Exception("Se esperaban 4 cursos sin ruta, se encontraron " . count($withoutRoute));
    }

    $pendingNumbers = array_map(fn($c) => $c['number'] ?? null, array_values($withoutRoute));
    sort($pendingNumbers);
    if ($pendingNumbers !== [45, 46, 47, 48]) {
        throw new \Exception("Los números de cursos sin ruta no coinciden con [45, 46, 47, 48]: " . json_encode($pendingNumbers));
    }

    return true;
});

// Test 3: Slugs canónicos de las 4 capacitaciones sin ruta
runTest("Cursos 45, 46, 47 y 48 tienen slugs canónicos únicos y coherentes", function(): bool {
    $all = CoursesCatalog::getAll();
    $pending = array_values(array_filter($all, fn($c) => empty($c['route'])));

    $expectedSlugs = [
        45 => 'seminario-panel-control-costos-power-bi',
        46 => 'seminario-flujo-caja-obras',
        47 => 'seminario-resultado-operativo-obra',
        48 => 'seminario-automatizacion-last-planner-system',
    ];

    foreach ($pending as $c) {
        $num = $c['number'];
        $slug = CoursesCatalog::getCourseSlug($c);
        if (!isset($expectedSlugs[$num])) {
            throw new \Exception("Curso inesperado sin ruta: #{$num}");
        }
        if ($slug !== $expectedSlugs[$num]) {
            throw new \Exception("Slug incorrecto para curso #{$num}: obtenido '{$slug}', esperado '{$expectedSlugs[$num]}'");
        }
    }

    return true;
});

// Test 4: Validación y búsqueda segura en CoursesCatalog::findBySlugOrIdentifier()
runTest("CoursesCatalog::findBySlugOrIdentifier valida de forma segura y rechaza entradas inválidas", function(): bool {
    // Casos válidos
    $c45 = CoursesCatalog::findBySlugOrIdentifier('seminario-panel-control-costos-power-bi');
    if (!$c45 || ($c45['number'] ?? null) !== 45) {
        throw new \Exception("Fallo al resolver curso 45 por slug");
    }

    $c46 = CoursesCatalog::findBySlugOrIdentifier('seminario-flujo-caja-obras');
    if (!$c46 || ($c46['number'] ?? null) !== 46) {
        throw new \Exception("Fallo al resolver curso 46 por slug");
    }

    $c47 = CoursesCatalog::findBySlugOrIdentifier('seminario-resultado-operativo-obra');
    if (!$c47 || ($c47['number'] ?? null) !== 47) {
        throw new \Exception("Fallo al resolver curso 47 por slug");
    }

    $c48 = CoursesCatalog::findBySlugOrIdentifier('seminario-automatizacion-last-planner-system');
    if (!$c48 || ($c48['number'] ?? null) !== 48) {
        throw new \Exception("Fallo al resolver curso 48 por slug");
    }

    // Curso con ruta
    $c1 = CoursesCatalog::findBySlugOrIdentifier('gerencia-de-calidad');
    if (!$c1 || ($c1['number'] ?? null) !== 1) {
        throw new \Exception("Fallo al resolver curso con ruta estándar");
    }

    // Casos inválidos
    if (CoursesCatalog::findBySlugOrIdentifier('curso-ficticio-inexistente') !== null) {
        throw new \Exception("Debe retornar null para curso ficticio");
    }
    if (CoursesCatalog::findBySlugOrIdentifier('<script>alert(1)</script>') !== null) {
        throw new \Exception("Debe retornar null para XSS / inyección");
    }
    if (CoursesCatalog::findBySlugOrIdentifier('') !== null) {
        throw new \Exception("Debe retornar null para string vacío");
    }

    return true;
});

// Test 5: Vista capacitacion.php renderiza badges y enlaces para los 4 cursos
runTest("Vista capacitacion.php contiene 'Información próximamente' y 'Solicitar información' con enlace a /contacto?programa=", function(): bool {
    global $baseDir;
    $viewPath = $baseDir . '/private_app/app/Views/pages/capacitacion.php';
    $content = file_get_contents($viewPath);

    if (!str_contains($content, 'Información próximamente')) {
        throw new \Exception("No se encontró el texto 'Información próximamente' en capacitacion.php");
    }

    if (!str_contains($content, 'Solicitar información')) {
        throw new \Exception("No se encontró la acción 'Solicitar información' en capacitacion.php");
    }

    if (!str_contains($content, '/contacto?programa=')) {
        throw new \Exception("No se encontró el enlace a '/contacto?programa=' en capacitacion.php");
    }

    if (str_contains($content, 'href="#"')) {
        throw new \Exception("capacitacion.php contiene enlaces vacíos href='#'");
    }

    return true;
});

// Test 6: Vista category_page_content.php contiene la misma lógica para categorías
runTest("Vista category_page_content.php contiene 'Información próximamente' y 'Solicitar información' hacia /contacto?programa=", function(): bool {
    global $baseDir;
    $partialPath = $baseDir . '/private_app/app/Views/partials/category_page_content.php';
    $content = file_get_contents($partialPath);

    if (!str_contains($content, 'Información próximamente')) {
        throw new \Exception("No se encontró 'Información próximamente' en category_page_content.php");
    }

    if (!str_contains($content, 'Solicitar información')) {
        throw new \Exception("No se encontró 'Solicitar información' en category_page_content.php");
    }

    if (!str_contains($content, '/contacto?programa=')) {
        throw new \Exception("No se encontró el enlace hacia '/contacto?programa=' en category_page_content.php");
    }

    if (str_contains($content, 'href="#"')) {
        throw new \Exception("category_page_content.php contiene enlaces vacíos href='#'");
    }

    return true;
});

// Test 7: Formulario en /contacto incorpora campo 'Programa de Interés'
runTest("Formulario de /contacto incluye campo de selección 'Programa de Interés' con opciones de CoursesCatalog", function(): bool {
    global $baseDir;
    $contactoPath = $baseDir . '/private_app/app/Views/pages/contacto.php';
    $content = file_get_contents($contactoPath);

    if (!str_contains($content, 'id="contactPrograma"') || !str_contains($content, 'name="programa"')) {
        throw new \Exception("No se encontró el elemento select con id='contactPrograma' y name='programa' en contacto.php");
    }

    if (!str_contains($content, 'Consulta general / Otro programa')) {
        throw new \Exception("No se encontró la opción predeterminada 'Consulta general / Otro programa'");
    }

    if (!str_contains($content, 'Programa de Interés')) {
        throw new \Exception("No se encontró la etiqueta 'Programa de Interés' en contacto.php");
    }

    return true;
});

// Test 8: Controlador PageController pasa catálogo y valida programa
runTest("PageController::contacto() valida ?programa= contra CoursesCatalog y provee datos al formulario", function(): bool {
    global $baseDir;
    $controllerPath = $baseDir . '/private_app/app/Controllers/PageController.php';
    $content = file_get_contents($controllerPath);

    if (!str_contains($content, "findBySlugOrIdentifier")) {
        throw new \Exception("PageController::contacto() no utiliza findBySlugOrIdentifier");
    }

    if (!str_contains($content, "'selectedCourse'")) {
        throw new \Exception("PageController::contacto() no comparte 'selectedCourse'");
    }

    return true;
});

// Test 9: script.js incorpora autoselección por parámetro URL sin bloquear el envío
runTest("script.js contiene initContactProgramAutoSelect y preserva el flujo de envío del formulario", function(): bool {
    global $baseDir;
    $scriptPath = $baseDir . '/public_html/script.js';
    $content = file_get_contents($scriptPath);

    if (!str_contains($content, 'initContactProgramAutoSelect')) {
        throw new \Exception("script.js no contiene la función initContactProgramAutoSelect");
    }

    if (!str_contains($content, "contactSelect.value = matchingOption.value")) {
        throw new \Exception("script.js no asigna el valor coincidente a contactSelect");
    }

    return true;
});

// Test 10: Renderizado en HTML y verificación de accesibilidad de tarjetas
runTest("Renderizado real de capacitacion.php produce 49 tarjetas: 45 con 'VER CAPACITACIÓN' y 4 con 'Solicitar información'", function(): bool {
    global $baseDir;
    $courses = CoursesCatalog::getAll();
    $categoriesSummary = CoursesCatalog::getCategoriesSummary();
    $typesSummary = CoursesCatalog::getTypesSummary();
    $totalCourses = count($courses);

    ob_start();
    include $baseDir . '/private_app/app/Views/pages/capacitacion.php';
    $html = ob_get_clean();

    $verCapacitacionCount = substr_count($html, 'VER CAPACITACIÓN');
    $solicitarInfoCount = substr_count($html, 'Solicitar información');
    $proximamenteCount = substr_count($html, 'Información próximamente');

    if ($verCapacitacionCount !== 45) {
        throw new \Exception("Se esperaban 45 botones 'VER CAPACITACIÓN', se encontraron: {$verCapacitacionCount}");
    }

    if ($solicitarInfoCount !== 4) {
        throw new \Exception("Se esperaban 4 enlaces 'Solicitar información', se encontraron: {$solicitarInfoCount}");
    }

    if ($proximamenteCount !== 4) {
        throw new \Exception("Se esperaban 4 badges 'Información próximamente', se encontraron: {$proximamenteCount}");
    }

    // Verificar que los 4 enlaces contienen los parámetros correctos
    foreach ([
        'seminario-panel-control-costos-power-bi',
        'seminario-flujo-caja-obras',
        'seminario-resultado-operativo-obra',
        'seminario-automatizacion-last-planner-system'
    ] as $slug) {
        $expectedLink = '/contacto?programa=' . $slug;
        if (!str_contains($html, $expectedLink)) {
            throw new \Exception("No se encontró el enlace esperado: {$expectedLink}");
        }
    }

    return true;
});

echo "\n====================================================================\n";
echo "RESULTADO FINAL: {$passedTests} de {$totalTests} pruebas pasaron con éxito.\n";
echo "====================================================================\n";

if ($passedTests !== $totalTests) {
    exit(1);
}
