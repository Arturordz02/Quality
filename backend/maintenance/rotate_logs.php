<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * CLI Task: Ejecutor programado de rotación de logs (cron / scheduler)
 * Uso: php backend/maintenance/rotate_logs.php
 */

define('QCS_BACKEND_ACCESS', true);

// Bloquear acceso HTTP directo de forma incondicional (Solo ejecución vía CLI)
if (php_sapi_name() !== 'cli') {
    http_response_code(403);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'success' => false,
        'status'  => 403,
        'message' => 'Acceso denegado. Este script solo puede ser ejecutado mediante línea de comandos (CLI).'
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit(1);
}

require_once __DIR__ . '/LogRotator.php';

$rotator = new LogRotator(__DIR__ . '/../storage/logs', 10485760, 30);
$result = $rotator->run();

echo "=== Mantenimiento de Logs Calidad QCS ===\n";
echo "Archivos rotados y comprimidos: " . count($result['rotated']) . "\n";
foreach ($result['rotated'] as $r) {
    echo "  - {$r['file']}: original " . round($r['original_bytes']/1024, 2) . " KB -> comp " . round($r['compressed_bytes']/1024, 2) . " KB\n";
}
echo "Archivos purgados por antigüedad: " . count($result['purged']) . "\n";
echo "Espacio liberado total: " . round($result['bytes_freed'] / 1024, 2) . " KB\n";

