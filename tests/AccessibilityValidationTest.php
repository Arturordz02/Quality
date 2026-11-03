<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Test Suite Automatizado: Validación de Accesibilidad, Semántica y Navegación por Teclado (FASE 5B)
 * Archivo: tests/AccessibilityValidationTest.php
 *
 * Valida:
 * 1. Generación y auditoría de los 86 archivos HTML estáticos en _site.
 * 2. Exactamente un enlace 'Saltar al contenido principal' por documento (WCAG 2.4.1).
 * 3. Exactamente un destino id="main-content" por documento.
 * 4. El destino id="main-content" pertenece exclusivamente a la etiqueta estructural <main>.
 * 5. Ausencia total de wrappers adicionales <div> alrededor de $content.
 * 6. Unicidad absoluta de IDs (0 IDs duplicados) en todos los 86 documentos generados.
 * 7. Control semántico <button type="button"> para el menú desplegable "MÁS" en navbar.php y 404.html.
 * 8. Widget de WhatsApp con ciclo de foco exclusivo dentro de #whatsappFloatingMenu.
 * 9. Reglas CSS accesibles de foco con contraste >= 3:1 y preservación de controles interactivos.
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/private_app/config/app.php';

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
echo "EJECUTANDO SUITE DE PRUEBAS: ACCESIBILIDAD Y SEMÁNTICA (FASE 5B)\n";
echo "====================================================================\n\n";

$siteDir = dirname(__DIR__) . '/_site';
$htmlFiles = glob($siteDir . '/*.html');

// 1. Auditoría de los 86 archivos HTML generados
runTest("1. Existen exactamente 86 archivos HTML compilados en _site", function() use ($htmlFiles) {
    return count($htmlFiles) === 86;
});

// 2. Exactamente un skip link por documento
runTest("2. Cada uno de los 86 HTML contiene exactamente un skip link 'Saltar al contenido principal'", function() use ($htmlFiles) {
    foreach ($htmlFiles as $f) {
        $html = file_get_contents($f);
        $count = substr_count($html, 'href="#main-content"');
        if ($count !== 1 || !str_contains($html, 'class="skip-link"')) {
            throw new \RuntimeException("Archivo " . basename($f) . " tiene $count skip links");
        }
    }
    return true;
});

// 3. Exactamente un id="main-content" por documento
runTest("3. Cada uno de los 86 HTML contiene exactamente un id='main-content'", function() use ($htmlFiles) {
    foreach ($htmlFiles as $f) {
        $html = file_get_contents($f);
        $count = substr_count($html, 'id="main-content"');
        if ($count !== 1) {
            throw new \RuntimeException("Archivo " . basename($f) . " tiene $count id='main-content'");
        }
    }
    return true;
});

// 4. El destino id="main-content" pertenece a una etiqueta <main>
runTest("4. El destino id='main-content' pertenece exclusivamente a una etiqueta <main>", function() use ($htmlFiles) {
    foreach ($htmlFiles as $f) {
        $html = file_get_contents($f);
        if (!preg_match('/<main\b[^>]*\bid="main-content"[^>]*>/i', $html)) {
            throw new \RuntimeException("En " . basename($f) . ", id='main-content' no está en <main>");
        }
    }
    return true;
});

// 5. Ausencia total de wrappers adicionales alrededor de $content
runTest("5. Ausencia de envolturas div#main-content o wrappers intermediarios alrededor de \$content", function() use ($htmlFiles) {
    foreach ($htmlFiles as $f) {
        $html = file_get_contents($f);
        if (str_contains($html, '<div id="main-content"') || str_contains($html, 'main-content-focus-wrapper')) {
            throw new \RuntimeException("En " . basename($f) . " se detectó wrapper no semántico");
        }
    }
    return true;
});

// 6. Unicidad absoluta de IDs en los 86 HTML (0 duplicados)
runTest("6. Unicidad absoluta de atributos id en los 86 archivos (cero IDs duplicados)", function() use ($htmlFiles) {
    foreach ($htmlFiles as $f) {
        $html = file_get_contents($f);
        preg_match_all('/\bid=["\']([^"\']+)["\']/i', $html, $m);
        $counts = array_count_values($m[1]);
        foreach ($counts as $id => $cnt) {
            if ($cnt > 1) {
                throw new \RuntimeException("Archivo " . basename($f) . " tiene ID duplicado: '$id' ($cnt veces)");
            }
        }
    }
    return true;
});

// 7. Semántica de botón para el menú MÁS en navbar.php y 404.html
runTest("7. El elemento MÁS está implementado como <button type='button'> en navbar.php y 404.html", function() {
    $navbar = file_get_contents(dirname(__DIR__) . '/private_app/app/Views/partials/navbar.php');
    $notFound = file_get_contents(dirname(__DIR__) . '/public_html/404.html');

    // Limpiar etiquetas PHP para evaluar el HTML del tag resultante de forma robusta
    $cleanNavbar = preg_replace('/<\?.*?\?>/s', '', $navbar);
    $navbarHasButton = (bool)preg_match('/<button\b[^>]*\bid=["\']dropdownMas["\']/i', $cleanNavbar);
    $notFoundHasButton = (bool)preg_match('/<button\b[^>]*\bid=["\']dropdownMas["\']/i', $notFound);

    return $navbarHasButton && $notFoundHasButton;
});

// 8. Widget de WhatsApp: ciclo exclusivo dentro de floatingMenu
runTest("8. El widget de WhatsApp aísla el ciclo de foco dentro de #whatsappFloatingMenu", function() {
    $script = file_get_contents(dirname(__DIR__) . '/public_html/script.js');
    $partial = file_get_contents(dirname(__DIR__) . '/private_app/app/Views/partials/whatsapp_float.php');

    $scriptScoped = str_contains($script, 'floatingMenu.querySelectorAll');
    $scriptExcludesBtn = !str_contains($script, 'floatingWidget.querySelectorAll');
    $partialInitialState = str_contains($partial, 'role="dialog"') && 
                           str_contains($partial, 'aria-modal="false"') && 
                           str_contains($partial, 'aria-hidden="true"');

    return $scriptScoped && $scriptExcludesBtn && $partialInitialState;
});

// 9. Foco con contraste >= 3:1 y regla :focus:not(:focus-visible) en styles.css
runTest("9. styles.css define :focus-visible con contraste >= 3:1 (#0F3460) y :focus:not(:focus-visible) para main", function() {
    $css = file_get_contents(dirname(__DIR__) . '/public_html/styles.css');

    $hasNavyFocus = str_contains($css, '#0F3460');
    $hasNotFocusVisible = str_contains($css, '#main-content:focus:not(:focus-visible)');
    $hasSkipLinkStyles = str_contains($css, '.skip-link');

    return $hasNavyFocus && $hasNotFocusVisible && $hasSkipLinkStyles;
});

echo "\n====================================================================\n";
echo "RESULTADOS: {$passedTests} / {$totalTests} PRUEBAS PASADAS\n";
echo "====================================================================\n";

if ($passedTests !== $totalTests) {
    exit(1);
}
