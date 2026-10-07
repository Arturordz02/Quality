<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Endpoint API: Procesamiento del Libro de Reclamaciones Virtual (Ley N° 29571)
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

// Rate Limiting: Máximo 10 peticiones por minuto por IP
$clientIp = Security::getClientIp($config);
$rateLimiter->enforceOrBlock($clientIp . '_claim_submit', 10, 60);

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
    Security::jsonSuccess('Su registro en el Libro de Reclamaciones ha sido enviado con éxito.', [
        'claim_code' => 'QCS-LR-' . date('Ym') . '-OK'
    ]);
}

// 2. Extracción y Sanitización de Campos
$nombre    = Security::sanitizeString($inputData['nombre'] ?? '', 120);
$documento = Security::sanitizeString($inputData['documento'] ?? '', 30);
$email     = Security::sanitizeEmail($inputData['email'] ?? '');
$telefono  = Security::sanitizeString($inputData['telefono'] ?? '', 30);
$tipo      = strtolower(Security::sanitizeString($inputData['tipo'] ?? '', 20));
$servicio  = Security::sanitizeString($inputData['servicio'] ?? '', 200);
$detalle   = Security::sanitizeMultiline($inputData['detalle'] ?? '', 4000);

$errors = [];

// 3. Validaciones Estrictas conforme a Ley N° 29571
if (empty($nombre) || mb_strlen($nombre, 'UTF-8') < 3) {
    $errors['nombre'] = 'Por favor, ingrese su nombre y apellido completo.';
}

if (empty($documento) || mb_strlen($documento, 'UTF-8') < 4) {
    $errors['documento'] = 'Por favor, ingrese un número de documento válido (DNI, CE o RUC).';
}

if (empty($email) || !Security::isValidEmail($email)) {
    $errors['email'] = 'Por favor, ingrese un correo electrónico válido para enviarle la constancia.';
}

if (empty($telefono) || !Security::isValidPhone($telefono)) {
    $errors['telefono'] = 'Por favor, ingrese un número de teléfono o celular válido.';
}

if (!in_array($tipo, ['queja', 'reclamo'], true)) {
    $errors['tipo'] = 'Debe seleccionar el tipo de registro: Queja o Reclamo.';
}

if (empty($servicio) || mb_strlen($servicio, 'UTF-8') < 2) {
    $errors['servicio'] = 'Por favor, indique el nombre del servicio o curso contratado.';
}

if (empty($detalle) || mb_strlen($detalle, 'UTF-8') < 8) {
    $errors['detalle'] = 'Por favor, describa claramente los hechos ocurridos (mínimo 8 caracteres).';
}

if (!empty($errors)) {
    Security::jsonError('Por favor complete todos los campos obligatorios.', 422, $errors);
}

// 4. Generación de Código Único de Registro
$uniqueSuffix = strtoupper(substr(md5(uniqid((string)mt_rand(), true)), 0, 5));
$codigoReclamacion = 'QCS-LR-' . date('Ym') . '-' . $uniqueSuffix;

$cleanData = [
    'codigo_reclamacion' => $codigoReclamacion,
    'nombre'             => $nombre,
    'documento'          => $documento,
    'email'              => $email,
    'telefono'           => $telefono,
    'tipo'               => $tipo,
    'servicio'           => $servicio,
    'detalle'            => $detalle,
    'ip_origen'          => $clientIp,
    'user_agent'         => Security::getUserAgent(),
];

// 5. Persistencia Garantizada (MySQL con Circuit Breaker O Fallback Queue Verificado)
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
                $saved = Database::saveClaim($config, $cleanData);
                if (!$saved) {
                    throw new \RuntimeException('No se pudo insertar la reclamación en MySQL: ' . (Database::getLastError() ?: 'Error en consulta'));
                }
                return true;
            },
            function (\Throwable $e) use ($cleanData, $codigoReclamacion, &$fallbackSaved) {
                error_log('[QCS CircuitBreaker Claim Fallback Triggered] ' . $e->getMessage());
                $res = FallbackQueue::save('claim', $cleanData, $codigoReclamacion);
                $fallbackSaved = $res['success'];
                return false;
            }
        );
    } catch (\Throwable $e) {
        error_log('[QCS Claim Persistence DB Failure] ' . $e->getMessage());
        if (!$fallbackSaved) {
            $res = FallbackQueue::save('claim', $cleanData, $codigoReclamacion);
            $fallbackSaved = $res['success'];
        }
    }
} else {
    // Base de datos deshabilitada por configuración: persistir directamente en cola de contingencia
    $res = FallbackQueue::save('claim', $cleanData, $codigoReclamacion);
    $fallbackSaved = $res['success'];
}

$isPersisted = ($dbSaved || $fallbackSaved);

// REQUISITOS 2, 3, 4 y 6:
// Una reclamación solo puede considerarse registrada cuando exista persistencia real: MySQL O fallback_queue.
// El envío de email NO debe ser considerado por sí solo como almacenamiento persistente.
// Si fallan MySQL y fallback_queue, NO responder éxito, sino error controlado sin stack trace.
if (!$isPersisted) {
    Security::jsonError(
        'No fue posible registrar su hoja de reclamación en este momento debido a un problema técnico temporal en nuestros sistemas de almacenamiento. Por favor, intente nuevamente o comuníquese a contacto@quality-consulting.org.',
        503
    );
}

// 6. Envío de Notificaciones por Correo con Retry Exponential Backoff (Notificación adicional)
$mailer = new SmtpMailer($config);
$adminRecipient = $config['mail']['claim_recipient'] ?? 'contacto@quality-consulting.org';
$companyInfo = $config['company'] ?? [];
$legalDays = $companyInfo['legal_response_days'] ?? 15;

$adminSubject = "[LIBRO RECLAMACIONES] Nuevo {$tipo}: {$codigoReclamacion} - {$nombre}";
$adminBody = SmtpMailer::templateClaimAdminNotification($cleanData, $companyInfo);

$adminMailSent = false;
try {
    $adminMailSent = RetryHelper::retry(
        function () use ($mailer, $adminRecipient, $adminSubject, $adminBody, $email) {
            return $mailer->send($adminRecipient, $adminSubject, $adminBody, $email);
        },
        2, 150, 1000
    );
} catch (\Throwable $e) {
    error_log('[QCS Claim Admin Mail Retry Error] ' . $e->getMessage());
}

$userMailSent = false;
if (!empty($config['mail']['send_copy_to_claimant'])) {
    $userSubject = "Hoja de Reclamación Virtual N° {$codigoReclamacion} - Quality Consulting Solutions";
    $userBody = SmtpMailer::templateClaimCustomerReceipt($cleanData, $companyInfo);
    try {
        $userMailSent = RetryHelper::retry(
            function () use ($mailer, $email, $userSubject, $userBody) {
                return $mailer->send($email, $userSubject, $userBody);
            },
            2, 150, 1000
        );
    } catch (\Throwable $e) {
        error_log('[QCS Claim User Copy Mail Retry Error] ' . $e->getMessage());
    }
}

// 7. Respuesta Exitosa Confirmando Persistencia Real
Security::jsonSuccess(
    "Su registro en el Libro de Reclamaciones ha sido enviado con éxito. Se ha generado la Hoja de Reclamación N° {$codigoReclamacion}. Se le remitirá una respuesta formal al correo ingresado en un plazo máximo de {$legalDays} días hábiles conforme a ley.",
    [
        'claim_code'     => $codigoReclamacion,
        'legal_days'     => $legalDays,
        'db_saved'       => $dbSaved,
        'fallback_saved' => $fallbackSaved,
        'mail_sent'      => $adminMailSent,
        'copy_sent'      => $userMailSent,
    ]
);
