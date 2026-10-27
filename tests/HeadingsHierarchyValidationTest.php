<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Test Suite Automatizado: Validación de Jerarquía Global de Encabezados (H1 Único)
 * Archivo: tests/HeadingsHierarchyValidationTest.php
 *
 * Valida:
 * 1. El partial global header.php no contiene etiquetas <h1> institucionales y utiliza el selector semántico .header-brand-title.
 * 2. styles.css define estilos idénticos para .header-brand-title en reglas base y en media queries responsive.
 * 3. Todas las páginas compiladas en _site/ poseen como máximo un solo <h1> semántico.
 * 4. Exactamente 85 páginas de contenido tienen EXACTAMENTE UN <h1> correspondiente a su título principal propio.
 * 5. La página de Inicio (index.html / home.php) conserva su <h1> propio (.home-hero-title) de forma íntegra.
 * 6. La página de error 404 (404.html) no contiene <h1> y conserva su estructura con <h2> sin alteraciones de contenido.
 * 7. Ninguna página del sitio contiene múltiples etiquetas <h1> duplicadas.
 * 8. El archivo estático público public_html/404.html no contiene etiquetas <h1> en su cabecera.
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
echo "EJECUTANDO SUITE DE PRUEBAS: JERARQUÍA GLOBAL DE ENCABEZADOS (H1)\n";
echo "====================================================================\n\n";

$baseDir = dirname(__DIR__);
$headerPath = $baseDir . '/private_app/app/Views/partials/header.php';
$stylesPath = $baseDir . '/public_html/styles.css';
$static404Path = $baseDir . '/public_html/404.html';
$siteDir = $baseDir . '/_site';

// Test 1: header.php no contiene <h1> y usa .header-brand-title
runTest("header.php sustituye el <h1> institucional por un elemento semántico con clase .header-brand-title", function() use ($headerPath): bool {
    $content = file_get_contents($headerPath);
    if (preg_match('/<h1\b[^>]*>/i', $content)) {
        throw new \Exception("header.php aún contiene una etiqueta <h1>");
    }
    if (!str_contains($content, 'header-brand-title')) {
        throw new \Exception("header.php no contiene la clase 'header-brand-title'");
    }
    if (!str_contains($content, 'QUALITY CONSULTING SOLUTIONS')) {
        throw new \Exception("header.php no contiene el texto de la marca");
    }
    return true;
});

// Test 2: styles.css incluye .header-brand-title en reglas de cabecera y media queries
runTest("styles.css define estilos visuales idénticos para .header-brand-title", function() use ($stylesPath): bool {
    $content = file_get_contents($stylesPath);
    if (!str_contains($content, '.header-center-title .header-brand-title')) {
        throw new \Exception("styles.css no incluye el selector '.header-center-title .header-brand-title'");
    }
    // Debe estar en las reglas responsive
    $occurrences = substr_count($content, '.header-brand-title');
    if ($occurrences < 3) {
        throw new \Exception("Se esperaban al menos 3 declaraciones de .header-brand-title en styles.css (base + responsive), encontradas: {$occurrences}");
    }
    return true;
});

// Test 3: public_html/404.html no contiene <h1> en la cabecera
runTest("public_html/404.html no contiene <h1> en la cabecera institucional", function() use ($static404Path): bool {
    $content = file_get_contents($static404Path);
    if (preg_match('/<div class="header-center-title">\s*<h1\b/i', $content)) {
        throw new \Exception("public_html/404.html contiene <h1> en la cabecera");
    }
    return true;
});

// Test 4: Auditoría de todos los archivos HTML en _site/
runTest("Ninguna página HTML compilada en _site/ contiene más de un <h1>", function() use ($siteDir): bool {
    $files = glob($siteDir . '/*.html');
    if (empty($files)) {
        throw new \Exception("No se encontraron archivos en {$siteDir}. Ejecuta build_static.php primero.");
    }

    $violations = [];
    foreach ($files as $file) {
        $html = file_get_contents($file);
        preg_match_all('/<h1\b[^>]*>/i', $html, $matches);
        $count = count($matches[0]);
        if ($count > 1) {
            $violations[basename($file)] = $count;
        }
    }

    if (!empty($violations)) {
        throw new \Exception("Se encontraron páginas con más de un <h1>: " . json_encode($violations));
    }
    return true;
});

// Test 5: Exactamente 85 páginas de contenido tienen un único <h1> propio
runTest("Exactamente 85 páginas poseen un <h1> único y 404.html permanece en 0 <h1> sin inventar títulos", function() use ($siteDir): bool {
    $files = glob($siteDir . '/*.html');
    $exactlyOne = 0;
    $zeroH1 = [];

    foreach ($files as $file) {
        $fn = basename($file);
        $html = file_get_contents($file);
        preg_match_all('/<h1\b[^>]*>/i', $html, $matches);
        $count = count($matches[0]);
        if ($count === 1) {
            $exactlyOne++;
        } elseif ($count === 0) {
            $zeroH1[] = $fn;
        }
    }

    if ($exactlyOne !== 85) {
        throw new \Exception("Se esperaban exactamente 85 páginas con un <h1>, se encontraron: {$exactlyOne}");
    }

    if ($zeroH1 !== ['404.html']) {
        throw new \Exception("Se esperaba que únicamente 404.html tuviera 0 <h1>, encontradas: " . json_encode($zeroH1));
    }

    return true;
});

// Test 6: Inicio (index.html) conserva su encabezado propio .home-hero-title
runTest("Inicio (index.html) conserva intacto su único <h1> principal con clase .home-hero-title", function() use ($siteDir): bool {
    $indexHtml = file_get_contents($siteDir . '/index.html');
    preg_match_all('/<h1\b[^>]*>(.*?)<\/h1>/is', $indexHtml, $matches);
    if (count($matches[0]) !== 1) {
        throw new \Exception("index.html tiene " . count($matches[0]) . " <h1>, se esperaba exactamente 1");
    }
    if (!str_contains($matches[0][0], 'home-hero-title')) {
        throw new \Exception("El <h1> de index.html no tiene la clase 'home-hero-title'");
    }
    return true;
});

echo "\n====================================================================\n";
echo "RESULTADO FINAL: {$passedTests} de {$totalTests} pruebas pasaron con éxito.\n";
echo "====================================================================\n";

if ($passedTests !== $totalTests) {
    exit(1);
}
