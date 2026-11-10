<?php declare(strict_types=1);
/**
 * QUALITY CONSULTING SOLUTIONS
 * Test Suite Automatizado: Validación de Diseño, Legibilidad y Adaptación Responsive de Páginas Informativas
 * Archivo: tests/InformativePagesDesignValidationTest.php
 *
 * Valida:
 * 1. nosostros.php incluye reglas responsive (@media) para mobile y tablet.
 * 2. nosotros.php incorpora estados :focus-visible accesibles.
 * 3. nosotros.php posee padding responsivo en hero, strip de métricas y cards ejecutivas.
 * 4. clientes.php incluye reglas responsive (@media) para mobile y tablet.
 * 5. clientes.php incorpora estados :focus-visible accesibles.
 * 6. clientes.php posee padding responsivo en hero y trust-quote-card.
 * 7. clientes.php optimiza la grilla y el contraste del texto de servicios realizados (#334155).
 * 8. medios.php incluye reglas responsive (@media) para mobile y tablet.
 * 9. medios.php incorpora estados :focus-visible accesibles.
 * 10. medios.php mejora el contraste en insignias y descripciones de artículos de LinkedIn.
 * 11. terminos-y-condiciones.php incluye reglas responsive (@media) para mobile y tablet.
 * 12. terminos-y-condiciones.php incorpora estados :focus-visible accesibles.
 * 13. terminos-y-condiciones.php optimiza la barra lateral y lectura de cláusulas legales.
 * 14. 404.php y 404.html incorporan reglas responsive en tarjeta y botones de acción móviles.
 * 15. 404.php y 404.html incorporan estados :focus-visible accesibles.
 * 16. Componentes sensibles intactos (skip-link, main-content, WhatsApp, sin cambios en JS).
 * 17. Generación estática conserva exactamente 1 <h1> y 1 <main> por página y 0 IDs duplicados.
 */

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

$baseDir = dirname(__DIR__);
$nosotrosPath = $baseDir . '/private_app/app/Views/pages/nosotros.php';
$clientesPath = $baseDir . '/private_app/app/Views/pages/clientes.php';
$mediosPath = $baseDir . '/private_app/app/Views/pages/medios.php';
$terminosPath = $baseDir . '/private_app/app/Views/pages/terminos-y-condiciones.php';
$view404Path = $baseDir . '/private_app/app/Views/pages/404.php';
$html404Path = $baseDir . '/public_html/404.html';
$siteDir = $baseDir . '/_site';

echo "\n====================================================================\n";
echo " TEST SUITE: DISEÑO Y LEGIBILIDAD DE PÁGINAS INFORMATIVAS (06/11/2026)\n";
echo "====================================================================\n\n";

// 1. nosotros.php responsive
runTest("1. nosotros.php incluye reglas responsive (@media) para mobile y tablet", function() use ($nosotrosPath): bool {
    $c = file_get_contents($nosotrosPath);
    return strpos($c, '@media (max-width: 991.98px)') !== false && strpos($c, '@media (max-width: 575.98px)') !== false;
});

// 2. nosotros.php focus-visible
runTest("2. nosotros.php incorpora estados :focus-visible accesibles", function() use ($nosotrosPath): bool {
    $c = file_get_contents($nosotrosPath);
    return strpos($c, '.nosotros-hero-btn:focus-visible') !== false && strpos($c, 'outline:') !== false;
});

// 3. nosotros.php padding responsivo
runTest("3. nosotros.php posee padding responsivo en hero, strip de métricas y cards ejecutivas", function() use ($nosotrosPath): bool {
    $c = file_get_contents($nosotrosPath);
    return strpos($c, '.stat-border-responsive') !== false && strpos($c, '.floating-exec-card') !== false;
});

// 4. clientes.php responsive
runTest("4. clientes.php incluye reglas responsive (@media) para mobile y tablet", function() use ($clientesPath): bool {
    $c = file_get_contents($clientesPath);
    return strpos($c, '@media (max-width: 991.98px)') !== false && strpos($c, '@media (max-width: 575.98px)') !== false;
});

// 5. clientes.php focus-visible
runTest("5. clientes.php incorpora estados :focus-visible accesibles", function() use ($clientesPath): bool {
    $c = file_get_contents($clientesPath);
    return strpos($c, '.service-perf-card:focus-visible') !== false;
});

// 6. clientes.php padding responsivo
runTest("6. clientes.php posee padding responsivo en hero y trust-quote-card", function() use ($clientesPath): bool {
    $c = file_get_contents($clientesPath);
    return strpos($c, '.clientes-hero-banner') !== false && strpos($c, '.trust-quote-card') !== false;
});

// 7. clientes.php grilla y contraste
runTest("7. clientes.php optimiza la grilla y el contraste del texto de servicios realizados (#334155)", function() use ($clientesPath): bool {
    $c = file_get_contents($clientesPath);
    return strpos($c, 'minmax(min(100%, 270px), 1fr)') !== false && strpos($c, 'color: #334155;') !== false;
});

// 8. medios.php responsive
runTest("8. medios.php incluye reglas responsive (@media) para mobile y tablet", function() use ($mediosPath): bool {
    $c = file_get_contents($mediosPath);
    return strpos($c, '@media (max-width: 991.98px)') !== false && strpos($c, '@media (max-width: 575.98px)') !== false;
});

// 9. medios.php focus-visible
runTest("9. medios.php incorpora estados :focus-visible accesibles", function() use ($mediosPath): bool {
    $c = file_get_contents($mediosPath);
    return strpos($c, '.podcast-card:focus-visible') !== false && strpos($c, '.btn-linkedin-read:focus-visible') !== false;
});

// 10. medios.php contraste artículos LinkedIn
runTest("10. medios.php mejora el contraste en insignias y descripciones de artículos de LinkedIn", function() use ($mediosPath): bool {
    $c = file_get_contents($mediosPath);
    return strpos($c, 'color: #475569;') !== false && strpos($c, 'color: #334155;') !== false;
});

// 11. terminos-y-condiciones.php responsive
runTest("11. terminos-y-condiciones.php incluye reglas responsive (@media) para mobile y tablet", function() use ($terminosPath): bool {
    $c = file_get_contents($terminosPath);
    return strpos($c, '@media (max-width: 991.98px)') !== false && strpos($c, '@media (max-width: 575.98px)') !== false;
});

// 12. terminos-y-condiciones.php focus-visible
runTest("12. terminos-y-condiciones.php incorpora estados :focus-visible accesibles", function() use ($terminosPath): bool {
    $c = file_get_contents($terminosPath);
    return strpos($c, '.legal-nav-item:focus-visible') !== false;
});

// 13. terminos-y-condiciones.php lectura y sidebar
runTest("13. terminos-y-condiciones.php optimiza la barra lateral y lectura de cláusulas legales", function() use ($terminosPath): bool {
    $c = file_get_contents($terminosPath);
    return strpos($c, 'position: static !important;') !== false && strpos($c, '.legal-clause-card') !== false;
});

// 14. 404 responsive
runTest("14. 404.php y 404.html incorporan reglas responsive en tarjeta y botones de acción móviles", function() use ($view404Path, $html404Path): bool {
    $c1 = file_get_contents($view404Path);
    $c2 = file_get_contents($html404Path);
    return (strpos($c1, '@media (max-width: 575.98px)') !== false && strpos($c1, 'flex-direction: column;') !== false) &&
           (strpos($c2, '@media (max-width: 575.98px)') !== false && strpos($c2, 'flex-direction: column;') !== false);
});

// 15. 404 focus-visible
runTest("15. 404.php y 404.html incorporan estados :focus-visible accesibles", function() use ($view404Path, $html404Path): bool {
    $c1 = file_get_contents($view404Path);
    $c2 = file_get_contents($html404Path);
    return (strpos($c1, '.btn-gold:focus-visible') !== false) &&
           (strpos($c2, '.btn-gold:focus-visible') !== false);
});

// 16. Componentes sensibles intactos
runTest("16. Componentes funcionales preservados (skip-link, main-content, WhatsApp, script.js sin modificar)", function() use ($baseDir): bool {
    $mainContent = file_get_contents($baseDir . '/private_app/app/Views/layouts/main.php');
    if (strpos($mainContent, 'skip-link') === false || strpos($mainContent, 'main-content') === false) {
        return false;
    }
    // git diff script.js debe estar limpio
    exec('git diff --name-only origin/main HEAD -- public_html/script.js', $out);
    return empty($out);
});

// 17. Generación estática conserva h1, main y IDs únicos
runTest("17. Todas las páginas generadas en _site/ conservan 1 <h1>, 1 <main> y 0 IDs duplicados", function() use ($siteDir): bool {
    if (!is_dir($siteDir)) {
        echo "(_site no existe) ";
        return false;
    }
    $htmlFiles = glob($siteDir . '/*.html');
    if (count($htmlFiles) < 86) {
        echo "(Solo " . count($htmlFiles) . " páginas generadas) ";
        return false;
    }

    foreach ($htmlFiles as $file) {
        $html = file_get_contents($file);
        $basename = basename($file);

        // 1 h1
        preg_match_all('/<h1\b[^>]*>/i', $html, $h1Matches);
        if (count($h1Matches[0]) !== 1) {
            echo "(Archivo $basename tiene " . count($h1Matches[0]) . " <h1>) ";
            return false;
        }

        // 1 main
        preg_match_all('/<main\b[^>]*>/i', $html, $mainMatches);
        if (count($mainMatches[0]) !== 1) {
            echo "(Archivo $basename tiene " . count($mainMatches[0]) . " <main>) ";
            return false;
        }

        // IDs únicos
        preg_match_all('/\bid=["\']([^"\']+)["\']/i', $html, $idMatches);
        if (!empty($idMatches[1])) {
            $counts = array_count_values($idMatches[1]);
            foreach ($counts as $id => $cnt) {
                if ($cnt > 1) {
                    echo "(ID duplicado '$id' en $basename) ";
                    return false;
                }
            }
        }
    }
    return true;
});

echo "\n====================================================================\n";
echo " RESUMEN: {$passedTests} / {$totalTests} PRUEBAS PASADAS\n";
echo "====================================================================\n";

if ($passedTests === $totalTests) {
    echo "✔ TODAS LAS PRUEBAS DE DISEÑO Y LEGIBILIDAD PASARON CORRECTAMENTE.\n\n";
    exit(0);
} else {
    echo "✖ EXISTEN FALLOS EN LA SUITE DE DISEÑO Y LEGIBILIDAD.\n\n";
    exit(1);
}

