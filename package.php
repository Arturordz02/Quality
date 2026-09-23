<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Empaquetador Reproducible y Autónomo de Producción y Cierre
 *
 * Uso CLI:
 *   php package.php [--src=/ruta/al/proyecto] [--out=/ruta/de/salida]
 *
 * Genera:
 *   - Quality-Produccion.zip (261 archivos exactos)
 *   - Quality-Cierre.zip     (331 archivos exactos)
 */

declare(strict_types=1);

// 1. Detección dinámica de rutas (CLI o por defecto)
$options = getopt('', ['src:', 'out:']);
$sourceDir = isset($options['src']) ? rtrim(str_replace('\\', '/', (string)$options['src']), '/') : str_replace('\\', '/', __DIR__);
$outputDir = isset($options['out']) ? rtrim(str_replace('\\', '/', (string)$options['out']), '/') : $sourceDir;

if (!is_dir($sourceDir)) {
    fwrite(STDERR, "ERROR: El directorio de origen especificado no existe: {$sourceDir}\n");
    exit(1);
}

if (!is_dir($outputDir)) {
    if (!mkdir($outputDir, 0755, true)) {
        fwrite(STDERR, "ERROR: No se pudo crear el directorio de salida: {$outputDir}\n");
        exit(1);
    }
}

$prodZipPath = $outputDir . '/Quality-Produccion.zip';
$cierreZipPath = $outputDir . '/Quality-Cierre.zip';

echo "=======================================================\n";
echo "EMPAQUETADOR REPRODUCIBLE - QUALITY CONSULTING SOLUTIONS\n";
echo "=======================================================\n";
echo "Directorio de origen : {$sourceDir}\n";
echo "Directorio de salida : {$outputDir}\n\n";

// 2. Limpieza preventiva de archivos de salida existentes
if (file_exists($prodZipPath)) @unlink($prodZipPath);
if (file_exists($cierreZipPath)) @unlink($cierreZipPath);

// 3. Estructura protegida e inmutable de backend/storage (12 archivos)
$protectedStorageFiles = [
    'backend/storage/.htaccess',
    'backend/storage/index.php',
    'backend/storage/cache/.gitkeep',
    'backend/storage/cache/index.php',
    'backend/storage/circuit_breaker/.gitkeep',
    'backend/storage/circuit_breaker/index.php',
    'backend/storage/fallback_queue/.gitkeep',
    'backend/storage/fallback_queue/index.php',
    'backend/storage/logs/.gitkeep',
    'backend/storage/logs/index.php',
    'backend/storage/rate_limits/.gitkeep',
    'backend/storage/rate_limits/index.php'
];

// 4. Escaneo exhaustivo del árbol de archivos
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($sourceDir, RecursiveDirectoryIterator::SKIP_DOTS)
);

$allFiles = [];
foreach ($iterator as $item) {
    if (!$item->isFile()) continue;
    $p = str_replace('\\', '/', $item->getPathname());
    $rel = ltrim(substr($p, strlen($sourceDir)), '/');

    // EXCLUSIONES GLOBALES (Nunca van a ningún ZIP):
    // - Control de versiones .git/
    if (str_starts_with($rel, '.git/') || $rel === '.git') continue;
    // - Variables de entorno locales
    if ($rel === '.env' || str_starts_with($rel, '.env.')) {
        if ($rel !== '.env.example') continue;
    }
    // - Archivos ZIP, RAR, TAR, GZ anteriores y los propios destinos
    if (preg_match('/\.(zip|rar|tar|gz|bak|old|tmp|swp)$/i', $rel)) continue;
    if ($rel === basename($prodZipPath) || $rel === basename($cierreZipPath)) continue;

    // - Archivos runtime de backend/storage generados por pruebas
    if (str_starts_with($rel, 'backend/storage/')) {
        if (!in_array($rel, $protectedStorageFiles, true)) {
            continue; // Excluir cualquier mock, cola o log generado en runtime
        }
    }

    $allFiles[] = $rel;
}

sort($allFiles);

// 5. Definición de Exclusiones de Producción (70 archivos que solo van a Cierre)
$prodExclusions = [];

// A. 44 archivos HTML de contenido sustituidos por MVC
foreach ($allFiles as $f) {
    if (preg_match('/^[a-z0-9-]+\.html$/i', $f) && $f !== '404.html') {
        $prodExclusions[] = $f;
    }
}

// B. 19 archivos de la suite de pruebas backend
foreach ($allFiles as $f) {
    if (str_starts_with($f, 'backend/tests/')) {
        $prodExclusions[] = $f;
    }
}

// C. Herramientas CLI y documentación técnica interna
$prodExclusions[] = 'backend/maintenance/optimize_images.php';
$prodExclusions[] = 'package.php';
$prodExclusions[] = 'DEPLOYMENT.md';
$prodExclusions[] = 'app/README_MVC.md';
$prodExclusions[] = '.gitignore';

// D. 2 Imágenes duplicadas huérfanas
$prodExclusions[] = 'img/Servicios de Consultoría Técnica.jpg';
$prodExclusions[] = 'img/Servicios de Consultoría Técnica.webp';

sort($prodExclusions);

// 6. Listas definitivas
$prodFiles = [];
foreach ($allFiles as $f) {
    if (!in_array($f, $prodExclusions, true)) {
        $prodFiles[] = $f;
    }
}
sort($prodFiles);

$cierreFiles = $allFiles;
sort($cierreFiles);

echo "Auditoría de inventario:\n";
echo "  Archivos para Producción : " . count($prodFiles) . " (Esperado: 261)\n";
echo "  Exclusiones para Cierre   : " . count($prodExclusions) . " (Esperado: 70)\n";
echo "  Archivos para Cierre     : " . count($cierreFiles) . " (Esperado: 331)\n\n";

if (count($prodFiles) !== 261 || count($cierreFiles) !== 331 || count($prodExclusions) !== 70) {
    fwrite(STDERR, "ERROR: Discrepancia en el conteo de archivos. Abortando empaquetado.\n");
    exit(1);
}

// 7. Función de empaquetado seguro con rollback
function createZip(string $zipPath, array $fileList, string $sourceDir): bool {
    $zip = new ZipArchive();
    $res = $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);
    if ($res !== true) {
        fwrite(STDERR, "ERROR: No se pudo abrir {$zipPath} para escritura (código {$res}).\n");
        return false;
    }

    foreach ($fileList as $relPath) {
        $fullPath = $sourceDir . '/' . $relPath;
        if (!file_exists($fullPath)) {
            fwrite(STDERR, "ERROR: Archivo no encontrado: {$fullPath}\n");
            $zip->close();
            @unlink($zipPath);
            return false;
        }

        // Forzar siempre rutas Unix con '/'
        $entryName = str_replace('\\', '/', $relPath);
        if (!$zip->addFile($fullPath, $entryName)) {
            fwrite(STDERR, "ERROR: Falló al agregar archivo al ZIP: {$relPath}\n");
            $zip->close();
            @unlink($zipPath);
            return false;
        }
    }

    if (!$zip->close()) {
        fwrite(STDERR, "ERROR: Falló al cerrar y consolidar {$zipPath}\n");
        @unlink($zipPath);
        return false;
    }

    return true;
}

// Generar Quality-Produccion.zip
echo "Generando Quality-Produccion.zip...\n";
if (!createZip($prodZipPath, $prodFiles, $sourceDir)) {
    fwrite(STDERR, "ERROR: Falló la creación del paquete de producción. Proceso cancelado.\n");
    @unlink($prodZipPath);
    @unlink($cierreZipPath);
    exit(1);
}
echo "  [OK] Quality-Produccion.zip generado (" . filesize($prodZipPath) . " bytes)\n\n";

// Generar Quality-Cierre.zip
echo "Generando Quality-Cierre.zip...\n";
if (!createZip($cierreZipPath, $cierreFiles, $sourceDir)) {
    fwrite(STDERR, "ERROR: Falló la creación del paquete de cierre. Proceso cancelado.\n");
    @unlink($prodZipPath);
    @unlink($cierreZipPath);
    exit(1);
}
echo "  [OK] Quality-Cierre.zip generado (" . filesize($cierreZipPath) . " bytes)\n\n";

// 8. Validación de integridad de ambos paquetes generados
function verifyZip(string $zipPath, int $expectedCount, string $label): bool {
    $zip = new ZipArchive();
    if ($zip->open($zipPath) !== true) {
        echo "[FAIL] No se pudo reabrir {$label} para verificación.\n";
        return false;
    }

    $count = $zip->numFiles;
    $hasBackslash = false;
    $hasEnv = false;
    $hasZip = false;

    for ($i = 0; $i < $count; $i++) {
        $name = $zip->statIndex($i)['name'];
        if (str_contains($name, '\\')) $hasBackslash = true;
        if ($name === '.env' || str_ends_with($name, '/.env')) $hasEnv = true;
        if (preg_match('/\.(zip|rar|tar)$/i', $name)) $hasZip = true;
    }
    $zip->close();

    $sizeMb = number_format(filesize($zipPath) / (1024 * 1024), 2);
    $sha256 = hash_file('sha256', $zipPath);

    echo "Reporte de verificación: {$label}\n";
    echo "  Ruta          : {$zipPath}\n";
    echo "  Tamaño        : {$sizeMb} MB (" . filesize($zipPath) . " bytes)\n";
    echo "  SHA-256       : {$sha256}\n";
    echo "  Total entradas: {$count} (Esperado: {$expectedCount}) -> " . ($count === $expectedCount ? "PASS" : "FAIL") . "\n";
    echo "  Rutas Unix (/): " . (!$hasBackslash ? "PASS" : "FAIL") . "\n";
    echo "  Ausencia .env : " . (!$hasEnv ? "PASS" : "FAIL") . "\n";
    echo "  Ausencia ZIPs : " . (!$hasZip ? "PASS" : "FAIL") . "\n\n";

    return ($count === $expectedCount && !$hasBackslash && !$hasEnv && !$hasZip);
}

$vProd = verifyZip($prodZipPath, 261, 'Quality-Produccion.zip');
$vCierre = verifyZip($cierreZipPath, 331, 'Quality-Cierre.zip');

if ($vProd && $vCierre) {
    echo "=======================================================\n";
    echo "PROCESO COMPLETADO EXITOSAMENTE CON 100% DE INTEGRIDAD.\n";
    echo "=======================================================\n";
    exit(0);
} else {
    fwrite(STDERR, "ERROR: La verificación de integridad falló. Eliminando paquetes corruptos.\n");
    @unlink($prodZipPath);
    @unlink($cierreZipPath);
    exit(1);
}
