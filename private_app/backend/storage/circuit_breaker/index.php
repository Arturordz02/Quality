<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Capa de Seguridad Defensiva: circuit_breaker
 */
declare(strict_types=1);

http_response_code(403);
header('Content-Type: application/json; charset=UTF-8');
echo json_encode(['success' => false, 'status' => 403, 'message' => 'Acceso denegado.'], JSON_UNESCAPED_UNICODE);
exit;

