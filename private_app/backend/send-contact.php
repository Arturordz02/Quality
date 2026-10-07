<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Endpoint API: Procesamiento del Formulario de Contacto ("ENVÍANOS TU CONSULTA")
 * Optimizado con Resiliencia: Rate Limiting, Circuit Breaker y Graceful Degradation
 */

define('QCS_BACKEND_ACCESS', true);

$bootstrap = require __DIR__ . '/bootstrap.php';
$config = $bootstrap['config'];
$rateLimiter = $bootstrap['rateLimiter'];
$dbCircuit = $bootstrap['dbCircuitBreaker'];

require_once __DIR__ . '/SmtpMailer.php';

// Enviar cabeceras JSON y CORS
Security::sendJsonHeaders($config);

// Rate limiting: Máximo 10 envíos por minuto por IP para prevenir ataques de spam/inundación
$clientIp = Security::getClientIp($config);
$rateLimiter->enforceOrBlock($clientIp . '_contact_submit', 10, 60);

// Verificar método HTTP
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Security::jsonError('Método HTTP no permitido. Debe ser POST.', 405);
}

// Obtener datos (Soporta JSON raw y form-data estándar)
$inputData = $_POST;
$rawBody = file_get_contents('php://input');
if (!empty($rawBody)) {
    $jsonData = json_decode($rawBody, true);
    if (is_array($jsonData)) {
        $inputData = array_merge($inputData, $jsonData);
    }
}

// 1. Verificación Anti-Spam (Honeypot)
$honeypotField = $config['security']['honeypot_field'] ?? '_qcs_verification_hp';
if (!Security::verifyHoneypot($inputData, $honeypotField)) {
    Security::jsonSuccess('¡Gracias por comunicarte con Quality Consulting Solutions! Tu mensaje ha sido recibido.');
}

// 2. Extracción y Sanitización de Campos
$nombre   = Security::sanitizeString($inputData['nombre'] ?? '', 120);
$telefono = Security::sanitizeString($inputData['telefono'] ?? '', 30);
$empresa  = Security::sanitizeString($inputData['empresa'] ?? '', 120);
$email    = Security::sanitizeEmail($inputData['email'] ?? '');
$consulta = Security::sanitizeMultiline($inputData['consulta'] ?? '', 4000);

$errors = [];

// 3. Validaciones Estrictas
if (empty($nombre) || mb_strlen($nombre, 'UTF-8') < 2) {
    $errors['nombre'] = 'Por favor, ingrese su nombre y apellido completo.';
}

if (empty($telefono) || !Security::isValidPhone($telefono)) {
    $errors['telefono'] = 'Por favor, ingrese un número de teléfono válido (ej: +51 999 999 999).';
}

if (empty($empresa) || mb_strlen($empresa, 'UTF-8') < 2) {
    $errors['empresa'] = 'Por favor, ingrese el nombre de su empresa o institución.';
}

if (empty($email) || !Security::isValidEmail($email)) {
    $errors['email'] = 'Por favor, ingrese un correo electrónico válido.';
}

if (empty($consulta) || mb_strlen($consulta, 'UTF-8') < 5) {
    $errors['consulta'] = 'Por favor, ingrese los detalles de su consulta (mínimo 5 caracteres).';
}

if (!empty($errors)) {
    Security::jsonError('Existen campos vacíos o con formato inválido.', 422, $errors);
}

$cleanData = [
    'nombre'     => $nombre,
    'telefono'   => $telefono,
    'empresa'    => $empresa,
    'email'      => $email,
    'consulta'   => $consulta,
    'ip_origen'  => $clientIp,
    'user_agent' => Security::getUserAgent(),
];

// 4. Persistencia Garantizada (MySQL con Circuit Breaker O Fallback Queue Verificado)
$dbSaved = false;
$fallbackSaved = false;

if (!empty($config['database']['enabled'])) {
    try {
        $dbSaved = (bool)$dbCircuit->execute(
            function () use ($config, $cleanData) {
                $pdo = Database::getConnection($config);
                if (!$pdo) {
                    throw new \RuntimeException('No se pudo establecer conexión con MySQL: ' . (Database::getLastError() ?: 'Conexión nula'));
                }
                $saved = Database::saveContact($config, $cleanData);
                if (!$saved) {
                    throw new \RuntimeException('No se pudo insertar el contacto en MySQL: ' . (Database::getLastError() ?: 'Error en consulta'));
                }
                return true;
            },
            function (\Throwable $e) use ($cleanData, &$fallbackSaved) {
                error_log('[QCS CircuitBreaker Fallback Triggered] ' . $e->getMessage());
                $res = FallbackQueue::save('contact', $cleanData);
                $fallbackSaved = $res['success'];
                return false;
            }
        );
    } catch (\Throwable $e) {
        error_log('[QCS Contact Persistence DB Failure] ' . $e->getMessage());
        if (!$fallbackSaved) {
            $res = FallbackQueue::save('contact', $cleanData);
            $fallbackSaved = $res['success'];
        }
    }
} else {
    // Base de datos deshabilitada por configuración: persistir directamente en cola de contingencia
    $res = FallbackQueue::save('contact', $cleanData);
    $fallbackSaved = $res['success'];
}

$isPersisted = ($dbSaved || $fallbackSaved);

// REQUISITOS 1, 3, 4 y 6:
// Un formulario de contacto solo puede responder success=true cuando se guardó en MySQL O fallback_queue.
// El envío de email NO debe ser considerado por sí solo como almacenamiento persistente.
// Si fallan MySQL y fallback_queue, NO responder éxito, sino error controlado sin stack trace.
if (!$isPersisted) {
    Security::jsonError(
        'En este momento no fue posible registrar su consulta debido a un problema técnico temporal en nuestros sistemas de almacenamiento. Por favor, contáctenos directamente por WhatsApp al +51 993 463 118 o inténtelo de nuevo más tarde.',
        503
    );
}

// 5. Enviar Notificación por Correo (SMTP) como notificación adicional (No como almacenamiento principal)
$mailer = new SmtpMailer($config);
$recipient = $config['mail']['contact_recipient'] ?? 'contacto@quality-consulting.org';
$subject = "Nueva Consulta Web: {$empresa} - {$nombre}";
$htmlBody = SmtpMailer::templateContactNotification($cleanData);

$mailSent = false;
try {
    $mailSent = RetryHelper::retry(
        function ($attempt) use ($mailer, $recipient, $subject, $htmlBody, $email) {
            return $mailer->send($recipient, $subject, $htmlBody, $email);
        },
        2, // 2 reintentos
        150, // 150ms base
        1000 // 1s max
    );
} catch (\Throwable $e) {
    error_log('[QCS Contact Mail Retry Failure] ' . $e->getMessage());
}

// 6. Respuesta Exitosa Confirmando Persistencia Real
Security::jsonSuccess(
    '¡Gracias por comunicarte con Quality Consulting Solutions! Tu mensaje ha sido recibido con éxito y un especialista se pondrá en contacto a la brevedad.',
    [
        'db_saved'       => $dbSaved,
        'fallback_saved' => $fallbackSaved,
        'mail_sent'      => $mailSent,
    ]
);
