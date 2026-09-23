<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Archivo Defensivo: Bloqueo de Directorio Interno
 */
http_response_code(403);
header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
echo json_encode([
    'success' => false,
    'status'  => 403,
    'message' => 'Acceso denegado. Este directorio es de uso estrictamente interno del sistema.'
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
exit;

