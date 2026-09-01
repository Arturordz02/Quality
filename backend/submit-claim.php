<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Endpoint API: Procesamiento del Libro de Reclamaciones Virtual (Ley N° 29571)
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

// 4. Generación de Código Único de Registro Correlativo/Aleatorio
// Formato: QCS-LR-YYYYMM-XXXXX (Ej: QCS-LR-202608-E4B92)
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
    'ip_origen'          => Security::getClientIp(),
    'user_agent'         => Security::getUserAgent(),
];

// 5. Guardar en Base de Datos MySQL (con Sentencias Preparadas)
$savedInDb = Database::saveClaim($config, $cleanData);

// 6. Envío de Notificaciones por Correo (SMTP)
$mailer = new SmtpMailer($config);
$adminRecipient = $config['mail']['claim_recipient'] ?? 'contacto@quality-consulting.org';
$companyInfo = $config['company'] ?? [];

// A. Notificación para el Administrador de la Empresa
$adminSubject = "[LIBRO RECLAMACIONES] Nuevo {$tipo}: {$codigoReclamacion} - {$nombre}";
$adminBody = SmtpMailer::templateClaimAdminNotification($cleanData, $companyInfo);
$adminMailSent = $mailer->send($adminRecipient, $adminSubject, $adminBody, $email);

// B. Envío de Copia de Hoja de Reclamación al Usuario Reclamante
$userMailSent = false;
if (!empty($config['mail']['send_copy_to_claimant'])) {
    $userSubject = "Hoja de Reclamación Virtual N° {$codigoReclamacion} - Quality Consulting Solutions";
    $userBody = SmtpMailer::templateClaimCustomerReceipt($cleanData, $companyInfo);
    $userMailSent = $mailer->send($email, $userSubject, $userBody);
}

// 7. Respuesta Estructurada
$legalDays = $companyInfo['legal_response_days'] ?? 15;

if ($adminMailSent || $savedInDb || $userMailSent) {
    Security::jsonSuccess("Su registro en el Libro de Reclamaciones ha sido enviado con éxito. Se ha generado la Hoja de Reclamación N° {$codigoReclamacion}. Se le remitirá una respuesta formal al correo ingresado en un plazo máximo de {$legalDays} días hábiles conforme a ley.", [
        'claim_code' => $codigoReclamacion,
        'legal_days' => $legalDays,
        'copy_sent'  => $userMailSent,
        'db_saved'   => $savedInDb
    ]);
} else {
    $errorDetail = $mailer->getLastError();
    $debug = !empty($config['security']['debug']);

    if ($debug) {
        Security::jsonError('Error al procesar el registro del Libro de Reclamaciones: ' . $errorDetail, 500);
    } else {
        Security::jsonError('No fue posible procesar su registro en este momento. Por favor intente nuevamente o comuníquese a contacto@quality-consulting.org.', 500);
    }
}

