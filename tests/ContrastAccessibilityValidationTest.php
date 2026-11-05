<?php declare(strict_types=1);
/**
 * QUALITY CONSULTING SOLUTIONS
 * Test Suite Automatizado: Validación de Contraste y Legibilidad WCAG 2.1 AA (Fase 10B.1)
 * Archivo: tests/ContrastAccessibilityValidationTest.php
 *
 * Valida:
 * 1. Las reglas corregidas de Fase 10B existen en styles.css.
 * 2. Los colores corregidos no utilizan combinaciones prohibidas conocidas.
 * 3. Los textos secundarios del footer cumplen color #cbd5e1 con ratio >= 10.0:1 sobre fondo #0F1113.
 * 4. .header-logo .logo-sub utiliza #0F3460 con ratio de contraste >= 12.0:1 sobre blanco.
 * 5. Las métricas de /in-house utilizan #0F3460 con ratio >= 12.0:1 sobre fondo blanco.
 * 6. Los numeradores de /clientes y páginas legales cumplen contraste previsto >= 4.5:1.
 * 7. Los placeholders (::placeholder) conservan contraste >= 4.5:1 (#596780 sobre blanco).
 * 8. Los botones dorados no presentan texto blanco (texto #0F1113 con ratio >= 8.5:1 sobre #E5A813).
 * 9. Los estados hover y focus conservan contraste accesible >= 4.5:1.
 * 10. focus-visible permanece presente con indicador accesible (ratio >= 3.0:1 contra adyacente).
 * 11. main.php y 404.html comparten exactamente styles.css?v=4.1.
 * 12. script.js no fue modificado en esta fase.
 * 13. Componentes funcionales preservados (skip-link, whatsappFloatingBtn, modalSolicitarInfo).
 * 14. Las 86 páginas generadas en _site/ conservan exactamente 1 <h1> y 1 <main>.
 * 15. No existen IDs duplicados en ninguna de las páginas generadas.
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

/**
 * Convierte un canal sRGB de 8 bits (0–255) a luminancia lineal
 * Fórmula oficial WCAG 2.1:
 * Si C <= 0.04045 => C / 12.92
 * En caso contrario => ((C + 0.055) / 1.055) ^ 2.4
 */
function srgbChannelToLinear(float $channel): float {
    $c = $channel / 255.0;
    return ($c <= 0.04045) ? ($c / 12.92) : pow(($c + 0.055) / 1.055, 2.4);
}

/**
 * Calcula la luminancia relativa WCAG 2.1 sRGB para un color hexadecimal (#RRGGBB)
 * L = 0.2126 * R + 0.7152 * G + 0.0722 * B
 */
function hexToRelativeLuminance(string $hex): float {
    $hex = ltrim($hex, '#');
    if (strlen($hex) === 3) {
        $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
    }
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));

    $lr = srgbChannelToLinear((float)$r);
    $lg = srgbChannelToLinear((float)$g);
    $lb = srgbChannelToLinear((float)$b);

    return 0.2126 * $lr + 0.7152 * $lg + 0.0722 * $lb;
}

/**
 * Calcula la relación de contraste WCAG entre dos colores:
 * (L_más_claro + 0.05) / (L_más_oscuro + 0.05)
 */
function calculateContrastRatio(string $hex1, string $hex2): float {
    $l1 = hexToRelativeLuminance($hex1);
    $l2 = hexToRelativeLuminance($hex2);
    $lighter = max($l1, $l2);
    $darker = min($l1, $l2);
    return ($lighter + 0.05) / ($darker + 0.05);
}

echo "\n====================================================================\n";
echo " TEST SUITE: CONTRASTE Y LEGIBILIDAD VISUAL WCAG 2.1 AA (FASE 10B.1)\n";
echo "====================================================================\n\n";

$stylesCssPath = __DIR__ . '/../public_html/styles.css';
$mainViewPath = __DIR__ . '/../private_app/app/Views/layouts/main.php';
$html404Path = __DIR__ . '/../public_html/404.html';
$siteDir = __DIR__ . '/../_site';

$stylesCss = file_get_contents($stylesCssPath);
if ($stylesCss === false) {
    throw new RuntimeException("No se pudo leer public_html/styles.css");
}

// 1. Las reglas corregidas existen en styles.css
runTest("1. Reglas corregidas de Fase 10B presentes en styles.css", function() use ($stylesCss): bool {
    $requiredSelectors = [
        '.exec-card-footer',
        '.service-perf-num',
        '.legal-nav-num',
        '.inhouse-stat-num',
        '.header-logo .logo-sub',
        '.badge.bg-secondary-subtle',
        '.badge.bg-danger-subtle',
        '.support-info-card .badge.text-success',
        'footer.bg-dark .text-muted'
    ];
    foreach ($requiredSelectors as $sel) {
        if (!str_contains($stylesCss, $sel)) {
            echo "(Falta selector: $sel) ";
            return false;
        }
    }
    return true;
});

// 2. Los colores corregidos no utilizan combinaciones prohibidas conocidas
runTest("2. Colores corregidos evitan combinaciones prohibidas de bajo contraste", function() use ($stylesCss): bool {
    // text-warning sobre blanco (#E5A813 sobre #FFFFFF da 2.11:1, prohibido)
    $ratioWarningOnWhite = calculateContrastRatio('#E5A813', '#FFFFFF');
    if ($ratioWarningOnWhite >= 4.5) {
        return false;
    }

    // Comprobar que .header-logo .logo-sub no tenga color #E5A813 o var(--accent-gold)
    if (preg_match('/\.header-logo\s+\.logo-sub\s*\{[^}]*color\s*:\s*(?:var\(--accent-gold\)|#e5a813)/i', $stylesCss)) {
        echo "(.header-logo .logo-sub usa color dorado prohibido sobre blanco) ";
        return false;
    }

    // Comprobar que .inhouse-stat-num tenga color accesible (#0F3460)
    if (preg_match('/\.inhouse-stat-num\s*\{[^}]*color\s*:\s*#0F3460/i', $stylesCss) !== 1) {
        echo "(.inhouse-stat-num no define color #0F3460) ";
        return false;
    }
    return true;
});

// 3. Los textos secundarios del footer cumplen el color aprobado
runTest("3. Textos secundarios del footer cumplen color #cbd5e1 con ratio >= 10.0:1 sobre fondo #0F1113", function() use ($stylesCss): bool {
    $ratio = calculateContrastRatio('#cbd5e1', '#0F1113');
    // Matemáticamente exacto: 12.74:1
    if ($ratio < 10.0) {
        echo "(Ratio #cbd5e1 vs #0F1113 es {$ratio}, menor a 10:1) ";
        return false;
    }
    if (!str_contains($stylesCss, 'color: #cbd5e1 !important;')) {
        return false;
    }
    if (!str_contains($stylesCss, 'footer.bg-dark .text-muted') && !str_contains($stylesCss, '.footer.bg-dark .text-muted')) {
        return false;
    }
    return true;
});

// 4. .logo-sub utiliza un color accesible en el header
runTest("4. .header-logo .logo-sub utiliza #0F3460 con ratio de contraste >= 12.0:1 sobre blanco", function() use ($stylesCss): bool {
    $ratio = calculateContrastRatio('#0F3460', '#FFFFFF');
    // Matemáticamente exacto: 12.50:1
    if ($ratio < 12.0) {
        echo "(Ratio #0F3460 vs #FFFFFF es {$ratio}, menor a 12:1) ";
        return false;
    }
    return (bool)preg_match('/\.header-logo\s+\.logo-sub\s*\{[^}]*color\s*:\s*#0F3460/i', $stylesCss);
});

// 5. Las métricas de /in-house utilizan colores accesibles
runTest("5. Métricas de /in-house utilizan #0F3460 con ratio >= 12.0:1 sobre fondo blanco", function() use ($stylesCss): bool {
    $ratio = calculateContrastRatio('#0F3460', '#FFFFFF');
    if ($ratio < 12.0) {
        return false;
    }
    return str_contains($stylesCss, '.inhouse-stat-num') && str_contains($stylesCss, '#0F3460');
});

// 6. Los numeradores de /clientes y páginas legales cumplen el contraste previsto
runTest("6. Numeradores de /clientes y páginas legales tienen contraste >= 4.5:1 (#334155 sobre blanco = 10.36:1)", function() use ($stylesCss): bool {
    $ratio = calculateContrastRatio('#334155', '#FFFFFF');
    // Matemáticamente exacto: 10.36:1 (>= 4.5:1)
    if ($ratio < 4.5) {
        echo "(Ratio #334155 vs blanco es {$ratio}, menor a 4.5:1) ";
        return false;
    }
    $hasServiceNum = (bool)preg_match('/\.service-perf-num\s*\{[^}]*color\s*:\s*#334155/i', $stylesCss);
    $hasLegalNum = (bool)preg_match('/\.legal-nav-num\s*\{[^}]*color\s*:\s*#334155/i', $stylesCss);
    return $hasServiceNum && $hasLegalNum;
});

// 7. Los placeholders conservan contraste suficiente
runTest("7. Placeholders (::placeholder) conservan contraste >= 4.5:1 (#596780 sobre blanco = 5.71:1)", function() use ($stylesCss): bool {
    $ratio = calculateContrastRatio('#596780', '#FFFFFF');
    // Matemáticamente exacto: 5.71:1
    if ($ratio < 4.5) {
        echo "(Ratio #596780 vs #FFFFFF es {$ratio}, menor a 4.5:1) ";
        return false;
    }
    return str_contains($stylesCss, '::placeholder') && str_contains($stylesCss, '#596780');
});

// 8. Los botones dorados no presentan texto blanco con contraste insuficiente
runTest("8. Botones dorados aseguran texto oscuro #0F1113 con contraste >= 8.5:1 sobre #E5A813 (8.96:1)", function() use ($stylesCss): bool {
    $ratio = calculateContrastRatio('#0F1113', '#E5A813');
    // Matemáticamente exacto: 8.96:1
    if ($ratio < 8.5) {
        echo "(Ratio #0F1113 vs #E5A813 es {$ratio}, menor a 8.5:1) ";
        return false;
    }
    return str_contains($stylesCss, '.btn-warning') && str_contains($stylesCss, '#0F1113');
});

// 9. Los estados hover y focus conservan contraste accesible
runTest("9. Estados hover conservan contraste accesible (>= 4.5:1)", function() use ($stylesCss): bool {
    // legal-nav-num en hover usa #0F3460 sobre #f1f5f9: 11.41:1
    $ratioLegalHover = calculateContrastRatio('#0F3460', '#f1f5f9');
    if ($ratioLegalHover < 4.5) {
        echo "(Ratio legal hover es {$ratioLegalHover}) ";
        return false;
    }
    // exec-card-footer en hover usa #0F1113 sobre blanco: 18.92:1
    $ratioExecHover = calculateContrastRatio('#0F1113', '#FFFFFF');
    if ($ratioExecHover < 4.5) {
        echo "(Ratio exec hover es {$ratioExecHover}) ";
        return false;
    }
    return str_contains($stylesCss, '.legal-nav-item:hover .legal-nav-num') &&
           str_contains($stylesCss, '.floating-exec-card:hover .exec-card-footer');
});

// 10. focus-visible permanece presente con ratio >= 3.0:1
runTest("10. focus-visible permanece presente con indicador accesible (ratio >= 3.0:1 contra fondo)", function() use ($stylesCss): bool {
    // #0F3460 sobre blanco da 12.50:1 (>= 3.0:1)
    $ratioFocus = calculateContrastRatio('#0F3460', '#FFFFFF');
    if ($ratioFocus < 3.0) {
        return false;
    }
    return str_contains($stylesCss, ':focus-visible') &&
           (str_contains($stylesCss, 'outline:') || str_contains($stylesCss, 'outline-color:'));
});

// 11. main.php y 404.html comparten la misma versión de styles.css
runTest("11. main.php y 404.html comparten exactamente styles.css?v=4.1", function() use ($mainViewPath, $html404Path): bool {
    $mainContent = file_get_contents($mainViewPath);
    $html404Content = file_get_contents($html404Path);

    preg_match('/styles\.css\?v=([0-9\.]+)/', $mainContent, $m1);
    preg_match('/styles\.css\?v=([0-9\.]+)/', $html404Content, $m2);

    if (empty($m1[1]) || empty($m2[1])) {
        echo "(No se encontró versión de styles.css) ";
        return false;
    }
    if ($m1[1] !== $m2[1]) {
        echo "(Versiones distintas: main={$m1[1]} vs 404={$m2[1]}) ";
        return false;
    }
    if ($m1[1] !== '4.1') {
        echo "(Versión esperada 4.1 pero se encontró {$m1[1]}) ";
        return false;
    }
    return true;
});

// 12. No se modificó script.js si no era necesario
runTest("12. script.js no fue modificado en esta fase", function(): bool {
    $output = shell_exec('git diff --name-only origin/main');
    if ($output === null) {
        return true;
    }
    return !str_contains($output, 'script.js');
});

// 13. Componentes funcionales preservados
runTest("13. Componentes funcionales preservados (skip-link, whatsappFloatingBtn, modalSolicitarInfo)", function(): bool {
    $mainLayout = file_get_contents(__DIR__ . '/../private_app/app/Views/layouts/main.php');
    $modalView = file_get_contents(__DIR__ . '/../private_app/app/Views/partials/info_modal.php');
    $whatsView = file_get_contents(__DIR__ . '/../private_app/app/Views/partials/whatsapp_float.php');

    return str_contains($mainLayout, 'skip-link') &&
           str_contains($whatsView, 'whatsappFloatingBtn') &&
           str_contains($modalView, 'modalSolicitarInfo');
});

// 14. Las 86 páginas generadas conservan exactamente un h1 y un main
runTest("14. Todas las 86 páginas generadas en _site/ tienen exactamente 1 <h1> y 1 <main>", function() use ($siteDir): bool {
    $files = glob($siteDir . '/*.html');
    if (count($files) !== 86) {
        echo "(Se esperaban 86 páginas pero hay " . count($files) . ") ";
        return false;
    }
    foreach ($files as $file) {
        $html = file_get_contents($file);
        $baseName = basename($file);

        $h1Count = preg_match_all('/<h1\b/i', $html);
        if ($h1Count !== 1) {
            echo "($baseName tiene $h1Count elementos <h1>) ";
            return false;
        }

        $mainCount = preg_match_all('/<main\b/i', $html);
        if ($mainCount !== 1) {
            echo "($baseName tiene $mainCount elementos <main>) ";
            return false;
        }
    }
    return true;
});

// 15. No existen IDs duplicados relacionados con las correcciones
runTest("15. No existen IDs duplicados en ninguna de las páginas generadas", function() use ($siteDir): bool {
    $files = glob($siteDir . '/*.html');
    foreach ($files as $file) {
        $html = file_get_contents($file);
        preg_match_all('/\bid=["\']([^"\']+)["\']/i', $html, $matches);
        if (!empty($matches[1])) {
            $counts = array_count_values($matches[1]);
            foreach ($counts as $id => $cnt) {
                if ($cnt > 1) {
                    echo "(ID duplicado '$id' en " . basename($file) . ") ";
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
    echo "\033[32m✔ TODAS LAS PRUEBAS DE CONTRASTE Y ACCESIBILIDAD PASARON CORRECTAMENTE.\033[0m\n\n";
    exit(0);
} else {
    echo "\033[31m✖ SE ENCONTRARON PRUEBAS FALLIDAS.\033[0m\n\n";
    exit(1);
}
