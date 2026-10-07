<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Proxy Público Seguro: Formulario de Contacto
 * Conecta las peticiones web públicas con la lógica protegida en private_app
 */

declare(strict_types=1);

$candidates = [
    dirname(__DIR__, 2) . '/private_app/backend/send-contact.php',
    dirname(__DIR__) . '/private_app/backend/send-contact.php'
];

$backendFile = null;
foreach ($candidates as $candidate) {
    if (file_exists($candidate)) {
        $backendFile = $candidate;
        break;
    }
}

if ($backendFile === null) {
    http_response_code(503);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'success' => false,
        'error'   => 'Servicio de backend no disponible temporalmente.'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

require $backendFile;

