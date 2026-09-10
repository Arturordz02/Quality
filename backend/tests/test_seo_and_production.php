<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Test Suite: Tarea 11 - SEO Técnico Mínimo y Archivos de Producción
 */

declare(strict_types=1);

$testsPassed = 0;
$testsTotal = 0;

function assertTest(string $desc, bool $condition, string $detail = ''): void {
    global $testsPassed, $testsTotal;
    $testsTotal++;
    if ($condition) {
        $testsPassed++;
        echo "  [PASS] {$desc}\n";
    } else {
        echo "  [FAIL] {$desc} - {$detail}\n";
    }
}

echo "======================================================\n";
echo "TEST SUITE: TAREA 11 - SEO TÉCNICO Y ARCHIVOS DE PROD \n";
echo "======================================================\n\n";

$rootDir = dirname(__DIR__, 2);

// -----------------------------------------------------------------------------
// 1. VERIFICACIÓN DE 404.HTML
// -----------------------------------------------------------------------------
echo "--- 1. Validación de 404.html ---\n";
$notFoundPath = $rootDir . '/404.html';
assertTest("Existe archivo 404.html en raíz", file_exists($notFoundPath));

$notFoundContent = file_get_contents($notFoundPath);
assertTest("404.html contiene título 'Página no encontrada'", strpos($notFoundContent, 'Página no encontrada') !== false);
assertTest("404.html contiene enlace a index.html", strpos($notFoundContent, 'href="index.html"') !== false);
assertTest("404.html contiene enlace a contacto.html", strpos($notFoundContent, 'href="contacto.html"') !== false);
assertTest("404.html hace referencia al logo oficial img/Logo.png", strpos($notFoundContent, 'img/Logo.png') !== false);
assertTest("404.html NO depende de scripts PHP de backend", strpos($notFoundContent, '<?php') === false);

// .htaccess ErrorDocument
$htaccessContent = file_get_contents($rootDir . '/.htaccess');
assertTest(".htaccess define ErrorDocument 404 /404.html", preg_match('/ErrorDocument\s+404\s+\/404\.html/i', $htaccessContent) === 1);

// -----------------------------------------------------------------------------
// 2. VERIFICACIÓN DE ROBOTS.TXT
// -----------------------------------------------------------------------------
echo "\n--- 2. Validación de robots.txt ---\n";
$robotsPath = $rootDir . '/robots.txt';
assertTest("Existe archivo robots.txt en raíz", file_exists($robotsPath));

$robotsContent = file_get_contents($robotsPath);
assertTest("robots.txt define User-agent: *", strpos($robotsContent, 'User-agent: *') !== false);
assertTest("robots.txt bloquea rastreo de /backend/", strpos($robotsContent, 'Disallow: /backend/') !== false);
assertTest("robots.txt referencia canónica al sitemap.xml", strpos($robotsContent, 'Sitemap: https://quality-consulting.org/sitemap.xml') !== false);

// -----------------------------------------------------------------------------
// 3. VERIFICACIÓN DE SITEMAP.XML
// -----------------------------------------------------------------------------
echo "\n--- 3. Validación de sitemap.xml ---\n";
$sitemapPath = $rootDir . '/sitemap.xml';
assertTest("Existe archivo sitemap.xml en raíz", file_exists($sitemapPath));

$xml = simplexml_load_file($sitemapPath);
assertTest("sitemap.xml es un XML válido", $xml !== false);

$locs = [];
if ($xml !== false) {
    foreach ($xml->url as $urlEntry) {
        $locs[] = (string)$urlEntry->loc;
    }
}
assertTest("sitemap.xml contiene exactamente 44 páginas públicas", count($locs) === 44, "Total: " . count($locs));
assertTest("sitemap.xml incluye la raíz https://quality-consulting.org/", in_array('https://quality-consulting.org/', $locs, true));
assertTest("sitemap.xml NO incluye /backend/", empty(array_filter($locs, fn($u) => strpos($u, '/backend/') !== false)));
assertTest("sitemap.xml NO incluye 404.html", empty(array_filter($locs, fn($u) => strpos($u, '404.html') !== false)));
assertTest("sitemap.xml NO incluye health.php", empty(array_filter($locs, fn($u) => strpos($u, 'health.php') !== false)));
assertTest("Todas las URLs en sitemap.xml usan protocolo HTTPS", empty(array_filter($locs, fn($u) => strpos($u, 'https://') !== 0)));

// -----------------------------------------------------------------------------
// 4. VERIFICACIÓN DE CANONICAL Y METADATOS BÁSICOS
// -----------------------------------------------------------------------------
echo "\n--- 4. Validación de Canonical Tags y Metadatos en HTMLs ---\n";
$publicHtmlFiles = glob($rootDir . '/*.html');

$missingCanonical = [];
$missingTitle = [];
$missingDescription = [];

foreach ($publicHtmlFiles as $file) {
    $base = basename($file);
    $html = file_get_contents($file);

    if (preg_match('/<title[^>]*>(.*?)<\/title>/is', $html, $m) && !empty(trim($m[1]))) {
        // OK
    } else {
        $missingTitle[] = $base;
    }

    if (!preg_match('/<meta[^>]+name=["\']description["\']/i', $html)) {
        $missingDescription[] = $base;
    }

    if ($base !== '404.html') {
        if (!preg_match('/<link[^>]+rel=["\']canonical["\']/i', $html)) {
            $missingCanonical[] = $base;
        }
    }
}

assertTest("Todos los HTML poseen etiqueta <title>", empty($missingTitle), implode(', ', $missingTitle));
assertTest("Todos los HTML poseen <meta name='description'>", empty($missingDescription), implode(', ', $missingDescription));
assertTest("Todas las 44 páginas públicas poseen etiqueta canonical", empty($missingCanonical), implode(', ', $missingCanonical));

// Verificar canonical específico de index.html
$indexContent = file_get_contents($rootDir . '/index.html');
assertTest("index.html tiene canonical apuntando a la raíz https://quality-consulting.org/", strpos($indexContent, 'href="https://quality-consulting.org/"') !== false);

// -----------------------------------------------------------------------------
// 5. VALIDACIÓN DE ENLACES INTERNOS, ASSETS Y ANCLAS #ID
// -----------------------------------------------------------------------------
echo "\n--- 5. Escaneo Completo de Enlaces Internos y Anclas #id ---\n";

$pageIds = [];
$pageHtmls = [];
foreach ($publicHtmlFiles as $file) {
    $base = basename($file);
    $h = file_get_contents($file);
    $pageHtmls[$base] = $h;
    preg_match_all('/id=["\']([^"\']+)["\']/i', $h, $mIds);
    $pageIds[$base] = array_unique($mIds[1] ?? []);
}

$brokenLinks = [];
$brokenAnchors = [];

foreach ($publicHtmlFiles as $file) {
    $currentBase = basename($file);
    $html = $pageHtmls[$currentBase];

    preg_match_all('/<a[^>]+href=["\']([^"\']+)["\']/i', $html, $mHrefs);
    foreach ($mHrefs[1] ?? [] as $href) {
        $href = trim($href);
        if ($href === '' || $href === '#' || strpos($href, 'javascript:') === 0 || strpos($href, 'tel:') === 0 || strpos($href, 'mailto:') === 0 || strpos($href, 'http://') === 0 || strpos($href, 'https://') === 0) {
            continue;
        }

        $parts = explode('#', $href, 2);
        $targetFile = $parts[0] !== '' ? $parts[0] : $currentBase;
        $fragment = $parts[1] ?? null;
        $targetFileClean = preg_replace('/\?.*$/', '', $targetFile);

        $fsPath = $rootDir . '/' . ltrim($targetFileClean, '/');
        if (!file_exists($fsPath)) {
            $brokenLinks[] = "{$currentBase} -> {$href}";
            continue;
        }

        if ($fragment !== null && $fragment !== '') {
            $targetBase = basename($targetFileClean);
            if (isset($pageIds[$targetBase]) && !in_array($fragment, $pageIds[$targetBase], true)) {
                $brokenAnchors[] = "{$currentBase} -> {$targetBase}#{$fragment}";
            }
        }
    }
}

assertTest("Cero enlaces internos rotos a archivos HTML", empty($brokenLinks), implode(', ', $brokenLinks));
assertTest("Cero fragmentos #id rotos", empty($brokenAnchors), implode('; ', $brokenAnchors));

// -----------------------------------------------------------------------------
// 6. VERIFICACIÓN DE REGLAS HTTPS EN .HTACCESS
// -----------------------------------------------------------------------------
echo "\n--- 6. Verificación de Reglas HTTPS en .htaccess ---\n";
assertTest(".htaccess contiene bloque preparado para HTTPS sin forzar www/no-www", strpos($htaccessContent, '%{HTTP_HOST}%{REQUEST_URI}') !== false);

// -----------------------------------------------------------------------------
// RESUMEN FINAL
// -----------------------------------------------------------------------------
echo "\n======================================================\n";
echo "RESULTADOS: {$testsPassed} / {$testsTotal} pruebas superadas (" . round(($testsPassed / $testsTotal) * 100, 1) . "%)\n";
echo "======================================================\n";

if ($testsPassed === $testsTotal) {
    echo "ESTADO: [PASS] TAREA 11 COMPLETADA EXITOSAMENTE SIN REGRESIONES.\n";
    exit(0);
} else {
    echo "ESTADO: [FAIL] SE ENCONTRARON FALLOS EN LA VERIFICACIÓN.\n";
    exit(1);
}

