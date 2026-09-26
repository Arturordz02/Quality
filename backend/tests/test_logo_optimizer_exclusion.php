<?php
/**
 * Test Suite: Tarea Corrección 8 - Exclusión Explícita de Logo en ImageOptimizer
 */

declare(strict_types=1);

$testsPassed = 0;
$testsTotal = 0;
$testsSkipped = 0;

function assertTest(string $desc, bool $condition, string $detail = ''): void {
    global $testsPassed, $testsTotal;
    $testsTotal++;
    if ($condition) {
        $testsPassed++;
        echo "  [PASS] {$desc}\n";
    } else {
        echo "  [FAIL] {$desc}" . ($detail ? " - {$detail}" : "") . "\n";
    }
}

function skipTest(string $desc, string $reason = 'Servidor Apache no disponible'): void {
    global $testsSkipped, $testsTotal;
    $testsTotal++;
    $testsSkipped++;
    echo "  [SKIP] {$desc} ({$reason})\n";
}

echo "======================================================\n";
echo "TEST SUITE: TAREA CORRECCIÓN 8 - EXCLUSIÓN LOGO WEBP  \n";
echo "======================================================\n\n";

define('QCS_BACKEND_ACCESS', true);
require_once dirname(__DIR__) . '/maintenance/optimize_images.php';

// ==============================================================================
// 1. Prueba Aislada contra Timestamp (mtime(Logo) > mtime(Logo.webp))
// ==============================================================================
echo "--- 1. Prueba Aislada en Directorio Temporal ---\n";

$tempDir = sys_get_temp_dir() . '/test_logo_opt_' . uniqid();
mkdir($tempDir, 0755, true);

// Crear mock Logo.png (PNG válido de 10x10)
$imPng = imagecreatetruecolor(10, 10);
imagepng($imPng, $tempDir . '/Logo.png');
imagedestroy($imPng);

// Crear mock Logo.jpg (JPEG válido de 10x10)
$imJpg = imagecreatetruecolor(10, 10);
imagejpeg($imJpg, $tempDir . '/Logo.jpg');
imagedestroy($imJpg);

// Crear mock Logo.webp (contenido centinela con timestamp ANTIGUO)
$initialWebpContent = "PRESERVED_LOGO_WEBP_CONTENT_MOCK_12345";
file_put_contents($tempDir . '/Logo.webp', $initialWebpContent);
$initialWebpHash = hash('sha256', $initialWebpContent);

// Establecer timestamp de Logo.webp a hace 10 días
$pastTime = time() - 864000;
touch($tempDir . '/Logo.webp', $pastTime);

// Establecer timestamp de Logo.png y Logo.jpg a AHORA (mtime(Logo) > mtime(Logo.webp))
touch($tempDir . '/Logo.png', time());
touch($tempDir . '/Logo.jpg', time());

// Crear imagen normal que SÍ debe ser optimizada
$imNorm = imagecreatetruecolor(20, 20);
imagepng($imNorm, $tempDir . '/banner_promocional.png');
imagedestroy($imNorm);

clearstatcache();
assertTest("Directorio de prueba preparado: mtime(Logo.png) > mtime(Logo.webp)", 
    filemtime($tempDir . '/Logo.png') > filemtime($tempDir . '/Logo.webp')
);
assertTest("Directorio de prueba preparado: mtime(Logo.jpg) > mtime(Logo.webp)", 
    filemtime($tempDir . '/Logo.jpg') > filemtime($tempDir . '/Logo.webp')
);

// Ejecutar ImageOptimizer sobre el directorio temporal
$optimizer = new ImageOptimizer($tempDir, 80);
$report = $optimizer->optimizeAll();

// Comprobaciones sobre el reporte
assertTest("Logo.png fue clasificado en 'excluded'", in_array('Logo.png', $report['excluded'] ?? []));
assertTest("Logo.jpg fue clasificado en 'excluded'", in_array('Logo.jpg', $report['excluded'] ?? []));
assertTest("Logo.png NO está en 'converted'", !in_array('Logo.png', array_column($report['converted'], 'file')));
assertTest("Logo.jpg NO está en 'converted'", !in_array('Logo.jpg', array_column($report['converted'], 'file')));

// Comprobar que Logo.webp NUNCA fue tocado ni sobrescrito
$finalWebpContent = file_get_contents($tempDir . '/Logo.webp');
$finalWebpHash = hash('sha256', $finalWebpContent);
assertTest("Logo.webp conservó su contenido y hash intactos (nunca sobrescrito)", $finalWebpHash === $initialWebpHash);

// Comprobar que el asset normal SÍ fue optimizado a WebP
$normWebpPath = $tempDir . '/banner_promocional.webp';
assertTest("Asset normal (banner_promocional.png) SÍ fue optimizado", 
    file_exists($normWebpPath) && in_array('banner_promocional.png', array_column($report['converted'], 'file'))
);

// Limpieza de directorio temporal
array_map('unlink', glob($tempDir . '/*.*'));
@rmdir($tempDir);

// ==============================================================================
// 2. Verificación de Exclusión Independiente de Mayúsculas/Minúsculas
// ==============================================================================
echo "\n--- 2. Verificación Case-Insensitive de Exclusión ---\n";

$tempDirCase = sys_get_temp_dir() . '/test_logo_case_' . uniqid();
mkdir($tempDirCase, 0755, true);

$im1 = imagecreatetruecolor(10, 10);
imagepng($im1, $tempDirCase . '/logo.png');
imagejpeg($im1, $tempDirCase . '/LOGO.JPG');
imagejpeg($im1, $tempDirCase . '/Logo.jpeg');
imagedestroy($im1);

$optimizerCase = new ImageOptimizer($tempDirCase, 80);
$reportCase = $optimizerCase->optimizeAll();

assertTest("logo.png (minúsculas) fue excluido", in_array('logo.png', $reportCase['excluded'] ?? []));
assertTest("LOGO.JPG (mayúsculas) fue excluido", in_array('LOGO.JPG', $reportCase['excluded'] ?? []));
assertTest("Logo.jpeg (.jpeg) fue excluido", in_array('Logo.jpeg', $reportCase['excluded'] ?? []));
assertTest("Ningún Logo generó WebP", !file_exists($tempDirCase . '/logo.webp') && !file_exists($tempDirCase . '/LOGO.webp') && !file_exists($tempDirCase . '/Logo.webp'));

array_map('unlink', glob($tempDirCase . '/*.*'));
@rmdir($tempDirCase);

// ==============================================================================
// 3. Verificación de Seguridad y Guardia CLI
// ==============================================================================
echo "\n--- 3. Verificación de Guardia CLI y Seguridad HTTP ---\n";

$scriptCode = file_get_contents(dirname(__DIR__) . '/maintenance/optimize_images.php');
assertTest("optimize_images.php conserva guardia incondicional php_sapi_name() !== 'cli'", 
    strpos($scriptCode, "if (php_sapi_name() !== 'cli')") !== false
);

// Prueba HTTP contra servidor Apache si está disponible
$apacheUrl = 'http://127.0.0.1/Quality-main/backend/maintenance/optimize_images.php';
$sock = @fsockopen('127.0.0.1', 80, $errno, $errstr, 1);
if ($sock) {
    fclose($sock);
    $ch = curl_init($apacheUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_exec($ch);
    $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    assertTest("Petición HTTP a optimize_images.php devuelve HTTP 403", $httpStatus === 403);
} else {
    skipTest("Petición HTTP a optimize_images.php devuelve HTTP 403", "Servidor Apache no disponible en puerto 80");
}

// ==============================================================================
// 4. Verificación de Integridad de Hashes del Logo Real
// ==============================================================================
echo "\n--- 4. Verificación de Hashes de Logos Reales ---\n";

$realImgDir = dirname(__DIR__) . '/../img';
$expectedHashes = [
    'Logo.png'  => 'f01dd239386ef06e4dcd6143d45565b14c7c69b6c6e00c9ac0c69be3a71b69ed',
    'Logo.jpg'  => '86c449573887fde74c38fc18d3ac96fd8b4b8bac67367309c6b0c01d3fe8c291',
    'Logo.webp' => 'b93a4aec42feee5de73376f90ff3426520edf651aff97b6312880deb2bf92b6e',
];

foreach ($expectedHashes as $file => $expectedHash) {
    $filePath = $realImgDir . '/' . $file;
    $currentHash = hash_file('sha256', $filePath);
    assertTest("{$file}: SHA-256 coincide exactamente con el valor inicial", $currentHash === $expectedHash);
}

echo "\n======================================================\n";
echo "RESULTADOS: {$testsPassed} pasadas, {$testsSkipped} omitidas de {$testsTotal} pruebas.\n";
echo "======================================================\n";

if ($testsPassed + $testsSkipped === $testsTotal && $testsPassed > 0) {
    echo "\n>>> TODAS LAS PRUEBAS DE EXCLUSIÓN DE LOGO PASARON CON ÉXITO <<<\n";
    exit(0);
} else {
    echo "\n>>> HUBO FALLOS EN LAS PRUEBAS DE EXCLUSIÓN DE LOGO <<<\n";
    exit(1);
}

