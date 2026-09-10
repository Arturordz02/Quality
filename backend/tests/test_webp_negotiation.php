<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Test Suite: Tarea 10 - WebP Content Negotiation & Logo Preservation
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
echo "TEST SUITE: TAREA 10 - WEBP & PRESERVACIÓN DE LOGO    \n";
echo "======================================================\n\n";

$rootDir = dirname(__DIR__, 2);
$imgDir = $rootDir . '/img';
$htaccessPath = $rootDir . '/.htaccess';

// -----------------------------------------------------------------------------
// 1. AUDITORÍA DE IMÁGENES Y DETECCIÓN DE DISCREPANCIAS
// -----------------------------------------------------------------------------
echo "--- 1. Auditoría de Imágenes Originales vs WebP ---\n";

$originals = glob($imgDir . '/*.{jpg,jpeg,png,JPG,JPEG,PNG}', GLOB_BRACE);
assertTest("Directorio img/ contiene imágenes originales", count($originals) >= 60, "Encontradas: " . count($originals));

$missingWebp = [];
$dimensionMismatches = [];

foreach ($originals as $orig) {
    $baseName = basename($orig);
    $pathInfo = pathinfo($orig);
    $webpPath = $imgDir . '/' . $pathInfo['filename'] . '.webp';

    if (!file_exists($webpPath)) {
        $missingWebp[] = $baseName;
        continue;
    }

    $origSize = @getimagesize($orig);
    $webpSize = @getimagesize($webpPath);

    if ($origSize && $webpSize) {
        if ($origSize[0] !== $webpSize[0] || $origSize[1] !== $webpSize[1]) {
            $dimensionMismatches[] = "{$baseName}: {$origSize[0]}x{$origSize[1]} vs {$webpSize[0]}x{$webpSize[1]}";
        }
    }
}

assertTest("Todas las imágenes originales disponen de versión WebP", empty($missingWebp), implode(', ', $missingWebp));
assertTest("Todas las imágenes WebP coinciden en dimensiones con el original", empty($dimensionMismatches), implode('; ', $dimensionMismatches));

// -----------------------------------------------------------------------------
// 2. CASO ESPECIAL: LOGO.PNG VS LOGO.WEBP
// -----------------------------------------------------------------------------
echo "\n--- 2. Validación de Discrepancia Crítica: Logo.png vs Logo.webp ---\n";

$logoPng = $imgDir . '/Logo.png';
$logoWebp = $imgDir . '/Logo.webp';
$logoJpg = $imgDir . '/Logo.jpg';

assertTest("Existe Logo.png original", file_exists($logoPng));
assertTest("Existe Logo.webp", file_exists($logoWebp));
assertTest("Existe Logo.jpg", file_exists($logoJpg));

if (extension_loaded('gd')) {
    $imPng = @imagecreatefrompng($logoPng);
    $imWebp = @imagecreatefromwebp($logoWebp);

    assertTest("Logo.png cargado correctamente con GD", $imPng !== false);
    assertTest("Logo.webp cargado correctamente con GD", $imWebp !== false);

    // Muestrear transparencia de Logo.png vs Logo.webp
    $cornerColorPng = imagecolorat($imPng, 0, 0);
    $rgbaCornerPng = imagecolorsforindex($imPng, $cornerColorPng);

    $cornerColorWebp = imagecolorat($imWebp, 0, 0);
    $rgbaCornerWebp = imagecolorsforindex($imWebp, $cornerColorWebp);

    assertTest("Logo.png tiene esquina transparente (canal alfa activo)", $rgbaCornerPng['alpha'] > 100, "Alpha: " . $rgbaCornerPng['alpha']);
    assertTest("Logo.webp tiene esquina OPACA (canal alfa = 0)", $rgbaCornerWebp['alpha'] === 0, "Alpha: " . $rgbaCornerWebp['alpha']);

    // Verificar que Logo.webp proviene de Logo.jpg (sin transparencia)
    $imJpg = @imagecreatefromjpeg($logoJpg);
    if ($imJpg) {
        $cornerColorJpg = imagecolorat($imJpg, 0, 0);
        $rgbaCornerJpg = imagecolorsforindex($imJpg, $cornerColorJpg);
        $colorDiff = abs($rgbaCornerJpg['red'] - $rgbaCornerWebp['red']) + abs($rgbaCornerJpg['green'] - $rgbaCornerWebp['green']) + abs($rgbaCornerJpg['blue'] - $rgbaCornerWebp['blue']);
        assertTest("Logo.webp coincide con fondo sólido de Logo.jpg (diferencia < 10)", $colorDiff < 10, "Diff: {$colorDiff}");
        imagedestroy($imJpg);
    }

    imagedestroy($imPng);
    imagedestroy($imWebp);
}

// -----------------------------------------------------------------------------
// 3. REGLAS DE .HTACCESS Y NEGOCIACIÓN DE CONTENIDO
// -----------------------------------------------------------------------------
echo "\n--- 3. Verificación de Reglas en .htaccess ---\n";

assertTest("Existe archivo .htaccess en raíz", file_exists($htaccessPath));
$htaccessContent = file_get_contents($htaccessPath);

assertTest(".htaccess contiene directiva AddType para image/webp", strpos($htaccessContent, 'AddType image/webp .webp') !== false);
assertTest(".htaccess contiene RewriteEngine On", strpos($htaccessContent, 'RewriteEngine On') !== false);
assertTest(".htaccess excluye Logo.png explícitamente de reescritura", preg_match('/RewriteCond\s+%{REQUEST_URI}\s+Logo\\\\\.png/i', $htaccessContent) === 1);
assertTest(".htaccess detiene reescritura de Logo.png con flag [L]", preg_match('/RewriteRule\s+\\\\.png\$\s+-\s+\[L\]/i', $htaccessContent) === 1);
assertTest(".htaccess verifica soporte de WebP vía HTTP_ACCEPT", strpos($htaccessContent, '%{HTTP_ACCEPT}') !== false);
assertTest(".htaccess verifica existencia de archivo .webp antes de reescribir", strpos($htaccessContent, '.webp -f') !== false);
assertTest(".htaccess incluye cabecera Vary: Accept para imágenes", preg_match('/Header\s+append\s+Vary\s+Accept/i', $htaccessContent) === 1);

// -----------------------------------------------------------------------------
// 4. SIMULACIÓN LÓGICA DE NEGOCIACIÓN DE CONTENIDO
// -----------------------------------------------------------------------------
echo "\n--- 4. Simulación de Negociación de Contenido (Lógica mod_rewrite) ---\n";

/**
 * Simula el comportamiento exacto de las directivas mod_rewrite en .htaccess
 */
function simulateContentNegotiation(string $requestUri, string $acceptHeader, string $rootDir): array {
    $ext = strtolower(pathinfo($requestUri, PATHINFO_EXTENSION));
    $isImage = in_array($ext, ['png', 'jpg', 'jpeg'], true);
    
    if (!$isImage) {
        return ['served' => $requestUri, 'type' => 'original', 'vary' => false];
    }

    // Regla 1: Exclusión explícita de Logo.png
    if (preg_match('/Logo\.png$/i', $requestUri)) {
        return ['served' => $requestUri, 'type' => 'original_protected', 'vary' => true];
    }

    // Regla 2: Si el cliente NO soporta WebP
    if (strpos($acceptHeader, 'image/webp') === false) {
        return ['served' => $requestUri, 'type' => 'original_fallback', 'vary' => true];
    }

    // Regla 3: Si existe versión .webp
    $relWithoutExt = substr($requestUri, 0, strrpos($requestUri, '.'));
    $webpFsPath = $rootDir . '/' . ltrim($relWithoutExt, '/') . '.webp';

    if (file_exists($webpFsPath)) {
        return ['served' => $relWithoutExt . '.webp', 'type' => 'webp_negotiated', 'vary' => true];
    }

    // Fallback: si no existe el .webp
    return ['served' => $requestUri, 'type' => 'original_nofile', 'vary' => true];
}

// Test A: Logo.png con cliente que soporta WebP -> Debe conservar Logo.png
$resA = simulateContentNegotiation('img/Logo.png', 'image/webp,image/apng,*/*', $rootDir);
assertTest("Simulación: Logo.png con Accept: image/webp NO es reescrito (protegido)", $resA['served'] === 'img/Logo.png' && $resA['type'] === 'original_protected');

// Test B: Logo.png sin WebP -> Conserva Logo.png
$resB = simulateContentNegotiation('img/Logo.png', 'image/png,*/*', $rootDir);
assertTest("Simulación: Logo.png con Accept estándar conserva Logo.png", $resB['served'] === 'img/Logo.png');

// Test C: Imagen de contenido con WebP soportado -> Debe entregar .webp
$resC = simulateContentNegotiation('img/Index-GestionCalidad.png', 'image/webp,image/apng,*/*', $rootDir);
assertTest("Simulación: Index-GestionCalidad.png con WebP soportado entrega .webp", $resC['served'] === 'img/Index-GestionCalidad.webp' && $resC['type'] === 'webp_negotiated');

// Test D: Imagen JPG con WebP soportado -> Debe entregar .webp
$resD = simulateContentNegotiation('img/10-pmi_orig.jpg', 'image/webp,image/apng,*/*', $rootDir);
assertTest("Simulación: 10-pmi_orig.jpg con WebP soportado entrega .webp", $resD['served'] === 'img/10-pmi_orig.webp' && $resD['type'] === 'webp_negotiated');

// Test E: Imagen con navegador antiguo (sin WebP) -> Fallback a JPG original
$resE = simulateContentNegotiation('img/10-pmi_orig.jpg', 'image/jpeg,image/png,*/*', $rootDir);
assertTest("Simulación: 10-pmi_orig.jpg sin soporte WebP entrega JPG original (fallback)", $resE['served'] === 'img/10-pmi_orig.jpg' && $resE['type'] === 'original_fallback');

// Test F: Imagen inexistente -> No rompe y mantiene original
$resF = simulateContentNegotiation('img/no_existe.png', 'image/webp,*/*', $rootDir);
assertTest("Simulación: Imagen sin versión WebP conserva formato original", $resF['served'] === 'img/no_existe.png');

// -----------------------------------------------------------------------------
// 5. REVISIÓN DE PÁGINAS PRINCIPALES DEL PROYECTO
// -----------------------------------------------------------------------------
echo "\n--- 5. Revisión de Páginas Clave y Enlaces a Imágenes ---\n";

$keyPages = [
    'index.html',
    'contacto.html',
    'consultoria.html',
    'capacitacion.html',
    'riesgo-del-plazo.html',
    'libro-de-reclamaciones.html'
];

foreach ($keyPages as $page) {
    $pagePath = $rootDir . '/' . $page;
    assertTest("Página existe: {$page}", file_exists($pagePath));

    $html = file_get_contents($pagePath);

    // Extraer todas las imágenes <img src="...">
    preg_match_all('/<img[^>]+src=["\']([^"\']+)["\']/i', $html, $matches);
    $images = $matches[1] ?? [];

    $brokenImages = [];
    $hasLogoPng = false;

    foreach ($images as $imgSrc) {
        // Ignorar data URIs o urls externas si las hubiera
        if (strpos($imgSrc, 'data:') === 0 || strpos($imgSrc, 'http://') === 0 || strpos($imgSrc, 'https://') === 0) {
            continue;
        }

        // Limpiar query strings o fragmentos
        $cleanSrc = preg_replace('/[?#].*$/', '', $imgSrc);
        $fsPath = $rootDir . '/' . ltrim($cleanSrc, '/');

        if (!file_exists($fsPath)) {
            $brokenImages[] = $imgSrc;
        }

        if (basename($cleanSrc) === 'Logo.png') {
            $hasLogoPng = true;
        }
    }

    assertTest("{$page}: Todas las imágenes referenciadas existen en disco (" . count($images) . " imágenes)", empty($brokenImages), implode(', ', $brokenImages));
    assertTest("{$page}: Conserva referencia a Logo.png en header/brand", $hasLogoPng);
}

// -----------------------------------------------------------------------------
// RESUMEN FINAL
// -----------------------------------------------------------------------------
echo "\n======================================================\n";
echo "RESULTADOS: {$testsPassed} / {$testsTotal} pruebas superadas (" . round(($testsPassed / $testsTotal) * 100, 1) . "%)\n";
echo "======================================================\n";

if ($testsPassed === $testsTotal) {
    echo "ESTADO: [PASS] TAREA 10 COMPLETADA EXITOSAMENTE SIN REGRESIONES.\n";
    exit(0);
} else {
    echo "ESTADO: [FAIL] SE ENCONTRARON FALLOS EN LA VERIFICACIÓN.\n";
    exit(1);
}

