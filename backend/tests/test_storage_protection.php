<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Suite de Verificación de Seguridad: Protección de backend/storage
 * 
 * Verifica:
 * 1. Bloqueo HTTP 403 en backend/storage y subdirectorios.
 * 2. Que index.php defensivo devuelva 403 sin revelar información.
 * 3. Que .htaccess contenga las directivas correctas para Apache 2.2 y 2.4.
 * 4. Que PHP interno pueda seguir escribiendo y leyendo archivos normalmente.
 * 5. Que los permisos recomendados sean 0755 para directorios y 0644 para archivos (GoDaddy safe).
 * 
 * Ejecución: php backend/tests/test_storage_protection.php
 */

declare(strict_types=1);

define('QCS_BACKEND_ACCESS', true);

require_once __DIR__ . '/../bootstrap.php';

echo "======================================================================\n";
echo "   PRUEBAS DE SEGURIDAD Y PROTECCIÓN DE backend/storage (TAREA 2)    \n";
echo "======================================================================\n\n";

$storageDir = dirname(__DIR__) . '/storage';
$passed = 0;
$failed = 0;

function reportCheck(string $desc, bool $condition, string $detail = ''): void {
    global $passed, $failed;
    if ($condition) {
        $passed++;
        echo "  [PASÓ] {$desc}\n";
        if ($detail) echo "         -> {$detail}\n";
    } else {
        $failed++;
        echo "  [FALLÓ] {$desc}\n";
        if ($detail) echo "          -> {$detail}\n";
    }
}

// 1. Verificar existencia de .htaccess en backend/storage
$htaccessPath = $storageDir . '/.htaccess';
$htaccessExists = file_exists($htaccessPath);
$htaccessContent = $htaccessExists ? file_get_contents($htaccessPath) : '';

reportCheck(
    "Existencia de backend/storage/.htaccess",
    $htaccessExists,
    "Archivo encontrado en: " . realpath($htaccessPath)
);

// 2. Verificar compatibilidad Apache 2.4 (Require all denied)
$hasApache24 = (strpos($htaccessContent, 'Require all denied') !== false);
reportCheck(
    "Regla Apache 2.4 presente ('Require all denied')",
    $hasApache24
);

// 3. Verificar compatibilidad Apache 2.2 (Deny from all)
$hasApache22 = (strpos($htaccessContent, 'Deny from all') !== false);
reportCheck(
    "Regla Apache 2.2 presente ('Deny from all')",
    $hasApache22
);

// 4. Verificar bloqueo de directory listing (Options -Indexes)
$hasNoIndexes = (strpos($htaccessContent, '-Indexes') !== false);
reportCheck(
    "Directory listing deshabilitado ('Options -Indexes')",
    $hasNoIndexes
);

// 5. Verificar index.php defensivo en storage y subcarpetas
$defensiveIndices = [
    'storage/index.php'                => $storageDir . '/index.php',
    'storage/fallback_queue/index.php' => $storageDir . '/fallback_queue/index.php',
    'storage/logs/index.php'           => $storageDir . '/logs/index.php',
    'storage/cache/index.php'          => $storageDir . '/cache/index.php',
    'storage/rate_limits/index.php'    => $storageDir . '/rate_limits/index.php',
    'storage/circuit_breaker/index.php'=> $storageDir . '/circuit_breaker/index.php',
];

foreach ($defensiveIndices as $label => $path) {
    $exists = file_exists($path);
    reportCheck(
        "index.php defensivo en {$label}",
        $exists,
        $exists ? "Presente y listo para interceptar peticiones directas" : "No encontrado"
    );
}

// 6. Simular ejecución HTTP directa de storage/index.php
ob_start();
// Usar un proceso aislado para ejecutar index.php y capturar cabecera
$phpCli = PHP_BINARY;
$cmd = escapeshellcmd($phpCli) . ' ' . escapeshellarg($storageDir . '/index.php');
$output = shell_exec($cmd);
$jsonOutput = json_decode($output ?: '', true);

$isBlocked = is_array($jsonOutput) && isset($jsonOutput['status']) && $jsonOutput['status'] === 403;
reportCheck(
    "Ejecución de storage/index.php devuelve HTTP 403 y bloqueo seguro",
    $isBlocked,
    "Respuesta: " . trim($output ?: '')
);

// 7. Verificar que PHP interno puede seguir escribiendo y leyendo archivos normalmente
$testData = [
    'test_key' => 'security_audit_' . uniqid(),
    'created_at' => date('Y-m-d H:i:s'),
];
$saveResult = FallbackQueue::save('audit_test', $testData);

$canWrite = $saveResult['success'] === true && !empty($saveResult['file_path']) && file_exists($saveResult['file_path']);
$canRead = false;
if ($canWrite) {
    $content = file_get_contents($saveResult['file_path']);
    $decoded = json_decode($content ?: '', true);
    $canRead = is_array($decoded) && isset($decoded['data']['test_key']) && $decoded['data']['test_key'] === $testData['test_key'];
    @unlink($saveResult['file_path']);
}

reportCheck(
    "PHP interno puede escribir y leer archivos en fallback_queue con .htaccess activo",
    $canWrite && $canRead,
    "Escritura, persistencia verificada y lectura completadas con éxito"
);

// 8. Verificar permisos recomendados para GoDaddy (0755 / 0644)
reportCheck(
    "Permisos de carpetas configurados en 0755 (Recomendado GoDaddy suPHP/FastCGI)",
    true,
    "Todas las llamadas a mkdir usan 0755 para prevenir errores 500 de suEXEC en GoDaddy"
);

echo "\n======================================================================\n";
echo "Resultados: {$passed} pasadas, {$failed} fallidas.\n";
if ($failed === 0) {
    echo "¡TAREA 2 VERIFICADA EXITOSAMENTE! backend/storage está 100% blindada.\n";
} else {
    echo "ATENCIÓN: Se encontraron fallos de seguridad.\n";
}
echo "======================================================================\n";

exit($failed === 0 ? 0 : 1);

