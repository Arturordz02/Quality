<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Endpoint API: Procesamiento del Formulario de Contacto ("ENVÍANOS TU CONSULTA")
 */

define('QCS_BACKEND_ACCESS', true);

// Cargar archivos del backend
$configFile = __DIR__ . '/config.php';
if (!file_exists($configFile)) {
    http_response_code(500);
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode([
        'success' => false,
        'message' => 'Error de configuración: no se encontró el archivo config.php'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$config = require $configFile;
require_once __DIR__ . '/Security.php';
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/SmtpMailer.php';

// Enviar cabeceras JSON y CORS
Security::sendJsonHeaders($config);

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
    // Si un bot cayó en la trampa, responder éxito silenciosamente
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
    'ip_origen'  => Security::getClientIp(),
    'user_agent' => Security::getUserAgent(),
];

// 4. Guardar en Base de Datos (Si está habilitada en config.php)
$savedInDb = Database::saveContact($config, $cleanData);

// 5. Enviar Notificación por Correo (SMTP)
$mailer = new SmtpMailer($config);
$recipient = $config['mail']['contact_recipient'] ?? 'contacto@quality-consulting.org';
$subject = "Nueva Consulta Web: {$empresa} - {$nombre}";
$htmlBody = SmtpMailer::templateContactNotification($cleanData);

$mailSent = $mailer->send($recipient, $subject, $htmlBody, $email);

// 6. Respuesta al Cliente
if ($mailSent) {
    Security::jsonSuccess('¡Gracias por comunicarte con Quality Consulting Solutions! Tu mensaje ha sido recibido con éxito y un especialista se pondrá en contacto a la brevedad.', [
        'db_saved' => $savedInDb
    ]);
} else {
    $errorDetail = $mailer->getLastError();
    $debug = !empty($config['security']['debug']);

    if ($debug) {
        Security::jsonError('No se pudo enviar el correo de notificación. Detalle: ' . $errorDetail, 500);
    } else {
        if ($savedInDb) {
            Security::jsonSuccess('Tu consulta ha sido registrada en nuestro sistema y será atendida a la brevedad.');
        } else {
            Security::jsonError('No fue posible procesar su consulta en este momento. Por favor contáctenos por WhatsApp o directamente a contacto@quality-consulting.org.', 500);
        }
    }
}

