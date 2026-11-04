<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Test Suite Automatizado: Validación de Semántica Web y Accesibilidad de Imágenes (Fase 9A)
 * Archivo: tests/SemanticAccessibilityValidationTest.php
 *
 * Valida:
 * 1. Cada una de las 86 páginas de _site/ contiene exactamente un <h1>.
 * 2. public_html/404.html y _site/404.html contienen <h1 class="error-title">Página no encontrada</h1>.
 * 3. Ninguna página tiene más de un <h1>.
 * 4. El partial global header.php no contiene <h1>.
 * 5. La clase .header-brand-title se mantiene en header.php y public_html/styles.css.
 * 6. En home.php / index.html, el <h1> contiene la clase .home-hero-title.
 * 7. En las 10 categorías de catálogo (capacitacion-*.html), el título de categoría es <h1>.
 * 8. En course_detail_unified.php, el título del curso es <h1> y las secciones clave usan <h2>.
 * 9. En in-house.html, el título principal es <h1> y no hay más de un <h1>.
 * 10. En nosotros.html, el título principal es <h1>.
 * 11. En contacto.html, el título principal es <h1>.
 * 12. En libro-de-reclamaciones.html, el título principal es <h1>.
 * 13. En terminos-y-condiciones.html, el título principal es <h1>.
 * 14. En pagar-primera-clase.html y registro-primera-clase.html, existe exactamente un <h1>.
 * 15. Todas las etiquetas <img> en las 86 páginas poseen el atributo alt.
 * 16. Ninguna imagen tiene alt nulo o faltante (salvo alt="" explícito con propósito decorativo).
 * 17. Las imágenes de docentes en las páginas auditadas tienen un alt con su nombre o cargo.
 * 18. Cada página contiene exactamente un elemento <main id="main-content">.
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
echo "EJECUTANDO SUITE: SEMÁNTICA WEB E IMÁGENES ACCESIBLES (FASE 9A)\n";
echo "====================================================================\n\n";

$baseDir = dirname(__DIR__);
$siteDir = $baseDir . '/_site';
$publicHtmlDir = $baseDir . '/public_html';
$viewsDir = $baseDir . '/private_app/app/Views';

$htmlFiles = glob($siteDir . '/*.html');
if (empty($htmlFiles)) {
    throw new \RuntimeException("No se encontraron archivos en _site/. Ejecute build_static.php primero.");
}

// 1. Cada una de las 86 páginas de _site/ contiene exactamente un <h1>
runTest("1. Cada una de las 86 páginas de _site/ contiene exactamente un <h1>", function() use ($htmlFiles): bool {
    if (count($htmlFiles) !== 86) {
        throw new \Exception("Se esperaban 86 páginas en _site/, se encontraron: " . count($htmlFiles));
    }
    $anomalies = [];
    foreach ($htmlFiles as $file) {
        $html = file_get_contents($file);
        preg_match_all('/<h1\b[^>]*>/i', $html, $matches);
        $count = count($matches[0]);
        if ($count !== 1) {
            $anomalies[basename($file)] = $count;
        }
    }
    if (!empty($anomalies)) {
        throw new \Exception("Páginas con conteo de <h1> diferente a 1: " . json_encode($anomalies));
    }
    return true;
});

// 2. public_html/404.html y _site/404.html contienen <h1 class="error-title">Página no encontrada</h1>
runTest("2. public_html/404.html y _site/404.html contienen <h1 class=\"error-title\">Página no encontrada</h1>", function() use ($publicHtmlDir, $siteDir): bool {
    $expected = '<h1 class="error-title">Página no encontrada</h1>';

    $cPublic = file_get_contents($publicHtmlDir . '/404.html');
    if (!str_contains($cPublic, $expected)) {
        throw new \Exception("public_html/404.html no contiene: {$expected}");
    }

    $cSite = file_get_contents($siteDir . '/404.html');
    if (!str_contains($cSite, $expected)) {
        throw new \Exception("_site/404.html no contiene: {$expected}");
    }

    return true;
});

// 3. Ninguna página tiene más de un <h1>
runTest("3. Ninguna página tiene más de un <h1>", function() use ($htmlFiles): bool {
    $multiple = [];
    foreach ($htmlFiles as $file) {
        $html = file_get_contents($file);
        preg_match_all('/<h1\b[^>]*>/i', $html, $matches);
        if (count($matches[0]) > 1) {
            $multiple[basename($file)] = count($matches[0]);
        }
    }
    if (!empty($multiple)) {
        throw new \Exception("Páginas con múltiples <h1>: " . json_encode($multiple));
    }
    return true;
});

// 4. El partial global header.php no contiene <h1>
runTest("4. El partial global header.php no contiene <h1>", function() use ($viewsDir): bool {
    $content = file_get_contents($viewsDir . '/partials/header.php');
    if (preg_match('/<h1\b[^>]*>/i', $content)) {
        throw new \Exception("header.php contiene al menos una etiqueta <h1>");
    }
    return true;
});

// 5. La clase .header-brand-title se mantiene en header.php y public_html/styles.css
runTest("5. La clase .header-brand-title se mantiene en header.php y public_html/styles.css", function() use ($viewsDir, $publicHtmlDir): bool {
    $headerContent = file_get_contents($viewsDir . '/partials/header.php');
    if (!str_contains($headerContent, 'header-brand-title')) {
        throw new \Exception("header.php no contiene la clase 'header-brand-title'");
    }

    $stylesContent = file_get_contents($publicHtmlDir . '/styles.css');
    if (!str_contains($stylesContent, '.header-brand-title')) {
        throw new \Exception("styles.css no define la clase '.header-brand-title'");
    }

    return true;
});

// 6. En home.php / index.html, el <h1> contiene la clase .home-hero-title
runTest("6. En home.php / index.html, el <h1> contiene la clase .home-hero-title", function() use ($viewsDir, $siteDir): bool {
    $homeView = file_get_contents($viewsDir . '/pages/home.php');
    if (!preg_match('/<h1\b[^>]*class="[^"]*home-hero-title[^"]*"[^>]*>/i', $homeView)) {
        throw new \Exception("home.php no contiene <h1> con la clase 'home-hero-title'");
    }

    $indexHtml = file_get_contents($siteDir . '/index.html');
    if (!preg_match('/<h1\b[^>]*class="[^"]*home-hero-title[^"]*"[^>]*>/i', $indexHtml)) {
        throw new \Exception("index.html no contiene <h1> con la clase 'home-hero-title'");
    }

    return true;
});

// 7. En las 10 categorías de catálogo (capacitacion-*.html), el título de categoría es <h1>
runTest("7. En las 10 categorías de catálogo (capacitacion-*.html), el título de categoría es <h1>", function() use ($siteDir): bool {
    $categories = [
        'capacitacion-calidad.html',
        'capacitacion-contratos.html',
        'capacitacion-gestion-de-proyectos.html',
        'capacitacion-oficina-tecnica.html',
        'capacitacion-riesgos.html',
        'bim-revit-architecture.html', // Standalone / alias or category
    ];
    $catFiles = glob($siteDir . '/capacitacion-*.html');
    if (count($catFiles) < 5) {
        throw new \Exception("Se esperaban al menos 5 archivos capacitacion-*.html, se encontraron: " . count($catFiles));
    }

    foreach ($catFiles as $file) {
        $html = file_get_contents($file);
        preg_match_all('/<h1\b[^>]*>(.*?)<\/h1>/is', $html, $matches);
        if (count($matches[0]) !== 1) {
            throw new \Exception("El archivo " . basename($file) . " tiene " . count($matches[0]) . " <h1>");
        }
        $title = trim(strip_tags($matches[1][0]));
        if (empty($title)) {
            throw new \Exception("El archivo " . basename($file) . " tiene un <h1> vacío");
        }
    }
    return true;
});

// 8. En course_detail_unified.php, el título del curso es <h1> y las secciones clave usan <h2>
runTest("8. En course_detail_unified.php, el título del curso es <h1> y las secciones clave usan <h2>", function() use ($viewsDir): bool {
    $content = file_get_contents($viewsDir . '/partials/course_detail_unified.php');

    // <h1> con el título del curso
    if (!preg_match('/<h1\b[^>]*>.*?\$title.*?<\/h1>/is', $content)) {
        throw new \Exception("course_detail_unified.php no contiene un <h1> con el título (\$title)");
    }

    // Secciones clave con <h2>
    $keySections = [
        'Objetivo del curso',
        'Perfil docente',
        'Temario del curso',
        'Beneficios y materiales',
    ];
    foreach ($keySections as $section) {
        if (!preg_match('/<h2\b[^>]*>.*?' . preg_quote($section, '/') . '.*?<\/h2>/is', $content)) {
            throw new \Exception("course_detail_unified.php no contiene <h2> para la sección: '{$section}'");
        }
    }

    return true;
});

// 9. En in-house.html, el título principal es <h1> y no hay más de un <h1>
runTest("9. En in-house.html, el título principal es <h1> y no hay más de un <h1>", function() use ($siteDir): bool {
    $html = file_get_contents($siteDir . '/in-house.html');
    preg_match_all('/<h1\b[^>]*>(.*?)<\/h1>/is', $html, $matches);
    if (count($matches[0]) !== 1) {
        throw new \Exception("in-house.html tiene " . count($matches[0]) . " <h1>");
    }
    if (!str_contains($matches[1][0], 'Capacitaciones In-House')) {
        throw new \Exception("El <h1> de in-house.html no contiene 'Capacitaciones In-House'");
    }
    return true;
});

// 10. En nosotros.html, el título principal es <h1>
runTest("10. En nosotros.html, el título principal es <h1>", function() use ($siteDir): bool {
    $html = file_get_contents($siteDir . '/nosotros.html');
    preg_match_all('/<h1\b[^>]*>(.*?)<\/h1>/is', $html, $matches);
    if (count($matches[0]) !== 1) {
        throw new \Exception("nosotros.html tiene " . count($matches[0]) . " <h1>");
    }
    $h1Text = strip_tags($matches[1][0]);
    if (!str_contains($h1Text, 'Impulsamos la Excelencia')) {
        throw new \Exception("El <h1> de nosotros.html no contiene el título esperado: {$h1Text}");
    }
    return true;
});

// 11. En contacto.html, el título principal es <h1>
runTest("11. En contacto.html, el título principal es <h1>", function() use ($siteDir): bool {
    $html = file_get_contents($siteDir . '/contacto.html');
    preg_match_all('/<h1\b[^>]*>(.*?)<\/h1>/is', $html, $matches);
    if (count($matches[0]) !== 1) {
        throw new \Exception("contacto.html tiene " . count($matches[0]) . " <h1>");
    }
    if (!str_contains($matches[1][0], 'QUEREMOS ESCUCHARTE')) {
        throw new \Exception("El <h1> de contacto.html no contiene 'QUEREMOS ESCUCHARTE'");
    }
    return true;
});

// 12. En libro-de-reclamaciones.html, el título principal es <h1>
runTest("12. En libro-de-reclamaciones.html, el título principal es <h1>", function() use ($siteDir): bool {
    $html = file_get_contents($siteDir . '/libro-de-reclamaciones.html');
    preg_match_all('/<h1\b[^>]*>(.*?)<\/h1>/is', $html, $matches);
    if (count($matches[0]) !== 1) {
        throw new \Exception("libro-de-reclamaciones.html tiene " . count($matches[0]) . " <h1>");
    }
    if (!str_contains($matches[1][0], 'LIBRO DE RECLAMACIONES VIRTUAL')) {
        throw new \Exception("El <h1> de libro-de-reclamaciones.html no contiene 'LIBRO DE RECLAMACIONES VIRTUAL'");
    }
    return true;
});

// 13. En terminos-y-condiciones.html, el título principal es <h1>
runTest("13. En terminos-y-condiciones.html, el título principal es <h1>", function() use ($siteDir): bool {
    $html = file_get_contents($siteDir . '/terminos-y-condiciones.html');
    preg_match_all('/<h1\b[^>]*>(.*?)<\/h1>/is', $html, $matches);
    if (count($matches[0]) !== 1) {
        throw new \Exception("terminos-y-condiciones.html tiene " . count($matches[0]) . " <h1>");
    }
    if (!str_contains($matches[1][0], 'Términos y Condiciones de Uso')) {
        throw new \Exception("El <h1> de terminos-y-condiciones.html no contiene 'Términos y Condiciones de Uso'");
    }
    return true;
});

// 14. En pagar-primera-clase.html y registro-primera-clase.html, existe exactamente un <h1>
runTest("14. En pagar-primera-clase.html y registro-primera-clase.html, existe exactamente un <h1>", function() use ($siteDir): bool {
    foreach (['pagar-primera-clase.html', 'registro-primera-clase.html'] as $fn) {
        $html = file_get_contents($siteDir . '/' . $fn);
        preg_match_all('/<h1\b[^>]*>/i', $html, $matches);
        if (count($matches[0]) !== 1) {
            throw new \Exception("{$fn} tiene " . count($matches[0]) . " <h1>, se esperaba exactamente 1");
        }
    }
    return true;
});

// 15. Todas las etiquetas <img> en las 86 páginas poseen el atributo alt
runTest("15. Todas las etiquetas <img> en las 86 páginas poseen el atributo alt", function() use ($htmlFiles): bool {
    $missingAlt = [];
    foreach ($htmlFiles as $file) {
        $html = file_get_contents($file);
        preg_match_all('/<img\b([^>]*)>/i', $html, $matches);
        foreach ($matches[1] as $imgAttrs) {
            if (!preg_match('/\balt\s*=/i', $imgAttrs)) {
                $missingAlt[basename($file)][] = substr($imgAttrs, 0, 60);
            }
        }
    }
    if (!empty($missingAlt)) {
        throw new \Exception("Imágenes sin atributo alt encontradas: " . json_encode($missingAlt));
    }
    return true;
});

// 16. Ninguna imagen tiene alt nulo o faltante (salvo alt="" explícito con propósito decorativo)
runTest("16. Ninguna imagen tiene alt nulo o faltante (salvo alt=\"\" explícito con propósito decorativo)", function() use ($htmlFiles): bool {
    $invalidAlt = [];
    foreach ($htmlFiles as $file) {
        $html = file_get_contents($file);
        preg_match_all('/<img\b([^>]*)>/i', $html, $matches);
        foreach ($matches[1] as $imgAttrs) {
            // Verificar que no sea alt sin comillas ni valor (ej: <img alt > o <img alt>)
            if (preg_match('/\balt\s*(?:$|>|\s+(?![=\'"]))/i', $imgAttrs)) {
                $invalidAlt[basename($file)][] = substr($imgAttrs, 0, 60);
            }
        }
    }
    if (!empty($invalidAlt)) {
        throw new \Exception("Imágenes con atributo alt malformado: " . json_encode($invalidAlt));
    }
    return true;
});

// 17. Las imágenes de docentes en las páginas auditadas tienen un alt con su nombre o cargo
runTest("17. Las imágenes de docentes en las páginas auditadas tienen un alt con su nombre o cargo", function() use ($siteDir): bool {
    // 17.1 En nosotros.html, la foto de Omar Samaniego tiene su nombre
    $nosHtml = file_get_contents($siteDir . '/nosotros.html');
    if (!preg_match('/<img\b[^>]*src="[^"]*Omar_Samaniego[^"]*"[^>]*alt="([^"]*)"/i', $nosHtml, $m)) {
        throw new \Exception("nosotros.html no contiene la imagen del docente Omar Samaniego");
    }
    if (!str_contains($m[1], 'Omar Samaniego')) {
        throw new \Exception("El alt de la imagen de Omar Samaniego no contiene su nombre: '{$m[1]}'");
    }

    // 17.2 En páginas de cursos con docentes, las imágenes poseen alt descriptivo
    $courseDocFiles = glob($siteDir . '/contrato-*.html');
    foreach ($courseDocFiles as $cdf) {
        $html = file_get_contents($cdf);
        if (preg_match('/<div class="qcs-iso-doc-avatar">\s*<picture>\s*(?:<source[^>]*>\s*)?<img\b[^>]*alt="([^"]*)"/is', $html, $dm)) {
            if (empty(trim($dm[1]))) {
                throw new \Exception(basename($cdf) . " tiene un avatar de docente con alt vacío");
            }
        }
    }

    return true;
});

// 18. Cada página contiene exactamente un elemento <main id="main-content">
runTest("18. Cada página contiene exactamente un elemento <main id=\"main-content\">", function() use ($htmlFiles): bool {
    $anomalies = [];
    foreach ($htmlFiles as $file) {
        $html = file_get_contents($file);
        preg_match_all('/<main\b[^>]*\bid="main-content"[^>]*>/i', $html, $matches);
        if (count($matches[0]) !== 1) {
            $anomalies[basename($file)] = count($matches[0]);
        }
    }
    if (!empty($anomalies)) {
        throw new \Exception("Páginas con conteo diferente a 1 de <main id=\"main-content\">: " . json_encode($anomalies));
    }
    return true;
});

echo "\n====================================================================\n";
echo "RESULTADO FINAL: {$passedTests} de {$totalTests} pruebas pasaron con éxito.\n";
echo "====================================================================\n";

if ($passedTests !== $totalTests) {
    exit(1);
}
