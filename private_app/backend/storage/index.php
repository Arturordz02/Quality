<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Capa de Seguridad Defensiva (Defense in Depth)
 * Bloqueo de acceso HTTP directo en caso de que .htaccess sea ignorado por el servidor web.
 */

declare(strict_types=1);

http_response_code(403);
header('Content-Type: application/json; charset=UTF-8');
header('X-Content-Type-Options: nosniff');
header('Cache-Control: no-store, no-cache, must-revalidate');

echo json_encode([
    'success' => false,
    'status'  => 403,
    'message' => 'Acceso denegado. Este directorio es estrictamente privado y reservado para procesos internos del sistema.'
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
exit;

