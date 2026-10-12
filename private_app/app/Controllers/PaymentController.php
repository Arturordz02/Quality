<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Controlador de Pasarela de Pagos (PaymentController)
 *
 * Responsabilidad:
 * - Gestionar el checkout exclusivo de la primera clase por USD 10 con PayPal.
 * - Restringir y validar órdenes en el servidor contra la API v2 de PayPal.
 * - Bloquear el acceso al formulario de registro si el pago no está verificado en el backend.
 * - Procesar el formulario obligatorio post-pago con CSRF, sanitización, rate limiting y persistencia.
 * - Gestionar la variable OMAR_SAMANIEGO_EMAIL sin falsas simulaciones de envío.
 */

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Services\CourseCatalog;
use App\Services\PayPalService;

class PaymentController extends Controller
{
    private PayPalService $paypalService;

    public function __construct(?View $view = null, array $config = [])
    {
        parent::__construct($view, $config);

        // Cargar utilidades de seguridad y resiliencia si no están cargadas
        $backendDir = dirname(__DIR__, 2) . '/backend';
        if (!class_exists(\Security::class, false) && file_exists($backendDir . '/Security.php')) {
            require_once $backendDir . '/Security.php';
        }
        if (!class_exists(\RateLimiter::class, false) && file_exists($backendDir . '/resilience/RateLimiter.php')) {
            require_once $backendDir . '/resilience/RateLimiter.php';
        }
        if (!class_exists(\FallbackQueue::class, false) && file_exists($backendDir . '/resilience/FallbackQueue.php')) {
            require_once $backendDir . '/resilience/FallbackQueue.php';
        }
        if (!class_exists(\Database::class, false) && file_exists($backendDir . '/Database.php')) {
            require_once $backendDir . '/Database.php';
        }
        if (!class_exists(\SmtpMailer::class, false) && file_exists($backendDir . '/SmtpMailer.php')) {
            require_once $backendDir . '/SmtpMailer.php';
        }

        if (class_exists(\Security::class, false)) {
            \Security::init($this->config);
        }

        $this->paypalService = new PayPalService($this->config);
    }

    /**
     * VISTA: Checkout / Pago de la primera clase del curso (USD 10).
     * GET /pagar-primera-clase?curso={slug}
     */
    public function checkoutPrimeraClase(): void
    {
        \Security::startSession();

        $courseSlug = (string)($this->getQuery('curso', 'bim-revit-architecture'));
        $course = CourseCatalog::find($courseSlug);

        if (!$course) {
            $allCourses = CourseCatalog::all();
            $course = reset($allCourses);
            $courseSlug = $course['slug'];
        }

        $csrfToken = \Security::getCsrfToken();
        $allCourses = CourseCatalog::all();

        $errorFlash = $_SESSION['_qcs_payment_error'] ?? null;
        unset($_SESSION['_qcs_payment_error']);

        $this->render('pages/checkout-primera-clase', [
            'title'           => 'Primera clase del curso – USD 10 | Quality Consulting Solutions',
            'metaDescription' => 'Adquiere la primera clase introductoria de cualquier curso especializado por USD 10 mediante PayPal.',
            'activePage'      => 'capacitacion',
            'course'          => $course,
            'allCourses'      => $allCourses,
            'csrfToken'       => $csrfToken,
            'paypalClientId'  => $this->paypalService->getClientId(),
            'paypalMode'      => $this->paypalService->getMode(),
            'paypalCurrency'  => $this->paypalService->getCurrency(),
            'firstClassPrice' => $this->paypalService->getPrice(),
            'isConfigured'    => $this->paypalService->isConfigured(),
            'errorFlash'      => $errorFlash,
        ]);
    }

    /**
     * API: Crea una orden en PayPal v2 restringida a USD 10.00.
     * POST /api/paypal/create-order
     */
    public function createPaypalOrder(): void
    {
        $this->enforceRateLimit('create_order', 20, 60);

        if ($this->getMethod() !== 'POST') {
            $this->json(['success' => false, 'message' => 'Método no permitido'], 405);
        }

        $courseSlug = (string)($this->getPost('curso', ''));
        if (!CourseCatalog::isValid($courseSlug)) {
            $this->json(['success' => false, 'message' => 'El curso seleccionado no es válido.'], 422);
        }

        $courseTitle = CourseCatalog::getTitle($courseSlug);
        $result = $this->paypalService->createOrder($courseSlug, $courseTitle);

        if (empty($result['success'])) {
            $this->json([
                'success' => false,
                'message' => $result['message'] ?? 'No se pudo crear la orden en PayPal.',
            ], 500);
        }

        $this->json([
            'success'  => true,
            'id'       => $result['order_id'],
            'order_id' => $result['order_id'],
            'status'   => $result['status'] ?? 'CREATED',
            'mock'     => !empty($result['mock']),
        ]);
    }

    /**
     * API: Captura y valida la orden de PayPal en el backend.
     * POST /api/paypal/capture-order
     */
    public function capturePaypalOrder(): void
    {
        $this->enforceRateLimit('capture_order', 20, 60);

        if ($this->getMethod() !== 'POST') {
            $this->json(['success' => false, 'message' => 'Método no permitido'], 405);
        }

        $orderId = trim((string)($this->getPost('orderID', $this->getPost('order_id', ''))));
        $courseSlug = trim((string)($this->getPost('curso', '')));

        if (empty($orderId)) {
            $this->json(['success' => false, 'message' => 'Identificador de orden PayPal faltante.'], 422);
        }

        if (!CourseCatalog::isValid($courseSlug)) {
            $this->json(['success' => false, 'message' => 'El curso asociado a la orden no es válido.'], 422);
        }

        // 1. Intentar capturar la orden en PayPal si aún no ha sido capturada
        $captureResult = $this->paypalService->captureOrder($orderId);

        // 2. Validación estricta en el backend: status COMPLETED, moneda USD, importe USD 10.00
        $verifyResult = $this->paypalService->verifyOrder($orderId, 10.00, 'USD');

        if (empty($verifyResult['valid'])) {
            $this->json([
                'success' => false,
                'message' => 'Validación de pago fallida: ' . ($verifyResult['error'] ?? 'El pago no cumple con los requisitos en el servidor de PayPal.'),
            ], 422);
        }

        // 3. Registrar el pago confirmado en sesión de servidor protegida
        \Security::startSession();
        $courseTitle = CourseCatalog::getTitle($courseSlug);
        $signature = hash_hmac(
            'sha256',
            "{$orderId}|10.00|USD|{$courseSlug}",
            $this->config['security']['honeypot_field'] ?? 'qcs_secret_payment_hash'
        );

        $_SESSION['paypal_confirmed_payment'] = [
            'order_id'     => $orderId,
            'course_slug'  => $courseSlug,
            'course_title' => $courseTitle,
            'amount'       => 10.00,
            'currency'     => 'USD',
            'verified_at'  => time(),
            'signature'    => $signature,
        ];

        $redirectUrl = '/registro-primera-clase?curso=' . urlencode($courseSlug) . '&order_id=' . urlencode($orderId);

        $this->json([
            'success'      => true,
            'message'      => 'Pago de USD 10 verificado exitosamente en el backend.',
            'redirect'     => $redirectUrl,
            'order_id'     => $orderId,
            'course_title' => $courseTitle,
        ]);
    }

    /**
     * VISTA: Formulario Obligatorio post-pago de Primera Clase.
     * GET /registro-primera-clase
     */
    public function registroPrimeraClase(): void
    {
        \Security::startSession();

        // 1. REGLA ESTRICTA 9 y 10: Si el pago no fue validado en el backend, BLOQUEAR acceso
        $confirmedPayment = $_SESSION['paypal_confirmed_payment'] ?? null;

        if (!$this->isSessionPaymentValid($confirmedPayment)) {
            $_SESSION['_qcs_payment_error'] = 'Para acceder al registro de la primera clase, debes completar previamente el pago de USD 10 a través de PayPal.';
            $this->redirect('/pagar-primera-clase');
            return;
        }

        $courseSlug = $confirmedPayment['course_slug'];
        $courseTitle = $confirmedPayment['course_title'];
        $orderId = $confirmedPayment['order_id'];

        $csrfToken = \Security::getCsrfToken();

        $this->render('pages/registro-primera-clase', [
            'title'           => 'Registro Obligatorio – Primera Clase del Curso | Quality Consulting Solutions',
            'metaDescription' => 'Formulario obligatorio de confirmación de inscripción tras el pago de la primera clase de USD 10.',
            'activePage'      => 'capacitacion',
            'courseSlug'      => $courseSlug,
            'courseTitle'     => $courseTitle,
            'orderId'         => $orderId,
            'amount'          => 10.00,
            'currency'        => 'USD',
            'csrfToken'       => $csrfToken,
            'honeypotField'   => $this->config['security']['honeypot_field'] ?? '_qcs_verification_hp',
        ]);
    }

    /**
     * PROCESAMIENTO: Procesa el formulario obligatorio post-pago con validación backend.
     * POST /registro-primera-clase
     */
    public function procesarRegistroPrimeraClase(): void
    {
        $this->enforceRateLimit('registration_submit', 10, 60);

        if ($this->getMethod() !== 'POST') {
            $this->redirect('/pagar-primera-clase');
            return;
        }

        \Security::startSession();

        // 1. REGLA ESTRICTA 11: Protección CSRF obligatoria
        $csrfToken = (string)($this->getPost('_csrf_token', ''));
        if (!\Security::validateCsrfToken($csrfToken)) {
            if ($this->isAjax()) {
                $this->json(['success' => false, 'message' => 'Token de seguridad CSRF inválido o expirado. Recarga la página.'], 403);
            }
            $_SESSION['_qcs_payment_error'] = 'Error de seguridad (CSRF). Por favor, intenta enviar el formulario nuevamente.';
            $this->redirect('/registro-primera-clase');
            return;
        }

        // 2. Verificación Anti-Spam (Honeypot)
        $honeypotField = $this->config['security']['honeypot_field'] ?? '_qcs_verification_hp';
        if (!\Security::verifyHoneypot($_POST, $honeypotField)) {
            // Responder éxito simulado a bots sin almacenar
            if ($this->isAjax()) {
                $this->json(['success' => true, 'message' => 'Registro recibido.']);
            }
            $this->redirect('/registro-exitoso');
            return;
        }

        // 3. REGLA ESTRICTA 10: Validación del pago en el backend (No confiar únicamente en JavaScript)
        $orderId = trim((string)($this->getPost('paypal_order_id', '')));
        $confirmedPayment = $_SESSION['paypal_confirmed_payment'] ?? null;

        $paymentVerified = false;
        if ($this->isSessionPaymentValid($confirmedPayment) && $confirmedPayment['order_id'] === $orderId) {
            $paymentVerified = true;
        } else {
            // Verificación directa en el servidor de PayPal como fallback defensivo
            $directVerify = $this->paypalService->verifyOrder($orderId, 10.00, 'USD');
            if (!empty($directVerify['valid'])) {
                $paymentVerified = true;
            }
        }

        if (!$paymentVerified) {
            if ($this->isAjax()) {
                $this->json([
                    'success' => false,
                    'message' => 'No fue posible validar la transacción de PayPal en el servidor. El formulario requiere un pago verificado de USD 10.',
                ], 422);
            }
            $_SESSION['_qcs_payment_error'] = 'La transacción de PayPal no pudo ser validada. No se aceptó el formulario.';
            $this->redirect('/pagar-primera-clase');
            return;
        }

        // 4. Extracción, Sanitización y Validación de los campos obligatorios
        $nombres  = \Security::sanitizeString((string)$this->getPost('nombres', ''), 150);
        $email    = \Security::sanitizeEmail((string)$this->getPost('email', ''));
        $telefono = \Security::sanitizeString((string)$this->getPost('telefono', ''), 30);
        $cursoSlug= trim((string)$this->getPost('curso', ''));

        $errors = [];

        if (empty($nombres) || mb_strlen($nombres, 'UTF-8') < 3) {
            $errors['nombres'] = 'Por favor, ingrese sus nombres y apellidos completos (mínimo 3 caracteres).';
        }

        if (empty($email) || !\Security::isValidEmail($email)) {
            $errors['email'] = 'Por favor, ingrese un correo electrónico válido.';
        }

        if (empty($telefono) || !\Security::isValidPhone($telefono)) {
            $errors['telefono'] = 'Por favor, ingrese un número de teléfono válido (ej: +51 999 999 999).';
        }

        if (!CourseCatalog::isValid($cursoSlug)) {
            $errors['curso'] = 'El curso seleccionado no es válido.';
        }

        if (empty($orderId)) {
            $errors['paypal_order_id'] = 'El código o referencia de la transacción de PayPal es obligatorio.';
        }

        if (!empty($errors)) {
            if ($this->isAjax()) {
                $this->json(['success' => false, 'message' => 'Existen campos vacíos o con formato inválido.', 'errors' => $errors], 422);
            }
            $_SESSION['_qcs_form_errors'] = $errors;
            $_SESSION['_qcs_form_old'] = $_POST;
            $this->redirect('/registro-primera-clase');
            return;
        }

        $courseTitle = CourseCatalog::getTitle($cursoSlug);
        $clientIp = \Security::getClientIp($this->config);
        $userAgent = \Security::getUserAgent();

        $registrationData = [
            'nombres'         => $nombres,
            'email'           => $email,
            'telefono'        => $telefono,
            'curso_slug'      => $cursoSlug,
            'curso_titulo'    => $courseTitle,
            'paypal_order_id' => $orderId,
            'monto'           => 10.00,
            'moneda'          => 'USD',
            'tipo_compra'     => 'Primera clase del curso – USD 10',
            'ip_origen'       => $clientIp,
            'user_agent'      => $userAgent,
            'fecha_registro'  => date('Y-m-d H:i:s'),
        ];

        // 5. Persistencia Garantizada en Cola de Contingencia (FallbackQueue) y MySQL
        $savedFallback = \FallbackQueue::save('paypal_first_class', $registrationData, $orderId);
        $isPersisted = !empty($savedFallback['success']);

        if (!$isPersisted) {
            if ($this->isAjax()) {
                $this->json([
                    'success' => false,
                    'message' => 'Hubo una dificultad técnica temporal al guardar el registro. Por favor contáctenos a soporte.',
                ], 500);
            }
            $_SESSION['_qcs_payment_error'] = 'Error temporal al almacenar el registro. Por favor contáctenos con su código de transacción.';
            $this->redirect('/registro-primera-clase');
            return;
        }

        // 6. GESTIÓN DEL CORREO DEL ING. OMAR SAMANIEGO (REGLAS 7 y 18)
        // El correo real del Ing. Omar Samaniego está pendiente de confirmación.
        // No inventar ni hardcodear ningún correo.
        // Si el correo del destinatario aún no está disponible, NO simular el envío como exitoso.
        $omarEmail = (string)($this->config['recipients']['omar_samaniego'] ?? getenv('OMAR_SAMANIEGO_EMAIL') ?: '');
        $isRecipientConfigured = !empty($omarEmail) &&
            !str_contains($omarEmail, 'PLACEHOLDER') &&
            !str_contains($omarEmail, 'ejemplo.com') &&
            \Security::isValidEmail($omarEmail);

        $mailSent = false;
        $mailStatusNote = '';

        if ($isRecipientConfigured) {
            // Destinatario oficial configurado: enviar notificación SMTP
            try {
                $mailer = new \SmtpMailer($this->config);
                $subject = "Nueva Inscripción – Primera Clase (USD 10): {$courseTitle} - {$nombres}";
                $bodyHtml = $this->buildFirstClassEmailHtml($registrationData);
                $mailSent = $mailer->send($omarEmail, $subject, $bodyHtml, $email);
                $mailStatusNote = $mailSent
                    ? 'Notificación enviada a la coordinación académica.'
                    : 'No se pudo enviar el correo de notificación por incidencia SMTP.';
            } catch (\Throwable $e) {
                error_log('[QCS PayPal Email Notification Error] ' . $e->getMessage());
                $mailSent = false;
                $mailStatusNote = 'Incidencia al contactar el servidor de correo.';
            }
        } else {
            // REGLA OBLIGATORIA: Dejar documentado exactamente qué variable debe completarse.
            // NO SIMULAR EL ENVÍO COMO EXITOSO.
            $mailSent = false;
            $mailStatusNote = 'Notificación por correo electrónico pendiente: La variable OMAR_SAMANIEGO_EMAIL no está configurada con un correo real en el servidor.';
            error_log("[QCS PayPal Registration] {$mailStatusNote} Registro guardado con orden: {$orderId}");
        }

        // 7. Consumir la sesión para evitar reutilizaciones de la orden
        unset($_SESSION['paypal_confirmed_payment']);

        // Guardar resumen en sesión para la página de confirmación
        $_SESSION['paypal_registration_summary'] = [
            'nombres'                 => $nombres,
            'email'                   => $email,
            'telefono'                => $telefono,
            'curso_titulo'            => $courseTitle,
            'paypal_order_id'         => $orderId,
            'monto'                   => 'USD 10.00',
            'mail_sent'               => $mailSent,
            'recipient_configured'    => $isRecipientConfigured,
            'mail_status_note'        => $mailStatusNote,
            'pending_variable'        => $isRecipientConfigured ? null : 'OMAR_SAMANIEGO_EMAIL',
        ];

        if ($this->isAjax()) {
            $this->json([
                'success'                 => true,
                'message'                 => '¡Registro completado exitosamente! Tu acceso a la primera clase ha sido registrado.',
                'redirect'                => '/registro-exitoso',
                'mail_sent'               => $mailSent,
                'recipient_configured'    => $isRecipientConfigured,
                'mail_status_note'        => $mailStatusNote,
            ]);
        }

        $this->redirect('/registro-exitoso');
    }

    /**
     * VISTA: Confirmación exitosa post-registro.
     * GET /registro-exitoso
     */
    public function registroExitoso(): void
    {
        \Security::startSession();

        $summary = $_SESSION['paypal_registration_summary'] ?? null;
        if (!$summary) {
            $this->redirect('/');
            return;
        }

        $this->render('pages/registro-exitoso', [
            'title'           => '¡Registro Confirmado! Primera Clase – Quality Consulting Solutions',
            'metaDescription' => 'Confirmación oficial del registro y compra de la primera clase del curso por USD 10.',
            'activePage'      => 'capacitacion',
            'summary'         => $summary,
        ]);
    }

    /**
     * VISTA: Notificación de pago cancelado o fallido.
     * GET /pago-cancelado?curso={slug}
     */
    public function pagoCancelado(): void
    {
        \Security::startSession();
        unset($_SESSION['paypal_confirmed_payment']);

        $courseSlug = (string)($this->getQuery('curso', ''));
        $course = CourseCatalog::find($courseSlug);

        $this->render('pages/pago-cancelado', [
            'title'           => 'Pago Cancelado o No Completado | Quality Consulting Solutions',
            'metaDescription' => 'El pago de la primera clase no fue completado o fue cancelado en PayPal.',
            'activePage'      => 'capacitacion',
            'course'          => $course,
            'courseSlug'      => $courseSlug,
        ]);
    }

    /**
     * Valida que la sesión actual contenga una compra de PayPal legítima.
     */
    private function isSessionPaymentValid(?array $payment): bool
    {
        if (empty($payment) || !is_array($payment)) {
            return false;
        }

        $orderId = (string)($payment['order_id'] ?? '');
        $courseSlug = (string)($payment['course_slug'] ?? '');
        $amount = (float)($payment['amount'] ?? 0.0);
        $signature = (string)($payment['signature'] ?? '');

        if (empty($orderId) || empty($courseSlug) || abs($amount - 10.00) > 0.01) {
            return false;
        }

        $expectedSig = hash_hmac(
            'sha256',
            "{$orderId}|10.00|USD|{$courseSlug}",
            $this->config['security']['honeypot_field'] ?? 'qcs_secret_payment_hash'
        );

        return hash_equals($expectedSig, $signature);
    }

    /**
     * Aplica control de tasa de peticiones (Rate Limiting).
     */
    private function enforceRateLimit(string $action, int $maxRequests, int $windowSeconds): void
    {
        $clientIp = \Security::getClientIp($this->config);
        $rateLimiter = new \RateLimiter();
        $check = $rateLimiter->check("{$clientIp}_{$action}", $maxRequests, $windowSeconds);

        if (empty($check['allowed'])) {
            http_response_code(429);
            header('Retry-After: ' . ($check['reset'] ?? $windowSeconds));
            if ($this->isAjax()) {
                $this->json([
                    'success' => false,
                    'message' => 'Límite de solicitudes excedido. Por favor espere un momento antes de reintentar.',
                ], 429);
            }
            echo 'Demasiadas solicitudes. Por favor espere un momento antes de volver a intentarlo.';
            exit;
        }
    }

    /**
     * Construye la plantilla HTML para el correo formal de notificación de primera clase.
     */
    private function buildFirstClassEmailHtml(array $data): string
    {
        $nombres = htmlspecialchars((string)($data['nombres'] ?? ''), ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars((string)($data['email'] ?? ''), ENT_QUOTES, 'UTF-8');
        $telefono = htmlspecialchars((string)($data['telefono'] ?? ''), ENT_QUOTES, 'UTF-8');
        $curso = htmlspecialchars((string)($data['curso_titulo'] ?? ''), ENT_QUOTES, 'UTF-8');
        $orderId = htmlspecialchars((string)($data['paypal_order_id'] ?? ''), ENT_QUOTES, 'UTF-8');
        $fecha = htmlspecialchars((string)($data['fecha_registro'] ?? date('d/m/Y H:i:s')), ENT_QUOTES, 'UTF-8');

        return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Inscripción - Primera Clase</title>
</head>
<body style="margin:0;padding:20px;background-color:#f1f5f9;font-family:'Segoe UI',Roboto,Helvetica,Arial,sans-serif;color:#1e293b;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="max-width:620px;margin:0 auto;background-color:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 15px rgba(0,0,0,0.08);border:1px solid #e2e8f0;">
        <tr>
            <td style="background-color:#0f3460;padding:25px 30px;text-align:center;border-bottom:4px solid #f59e0b;">
                <h1 style="color:#ffffff;margin:0;font-size:20px;font-weight:700;">QUALITY CONSULTING SOLUTIONS</h1>
                <p style="color:#cbd5e1;margin:6px 0 0 0;font-size:13px;">Notificación de Compra: Primera Clase de Curso (USD 10)</p>
            </td>
        </tr>
        <tr>
            <td style="padding:30px;">
                <div style="background-color:#fef3c7;border-left:4px solid #f59e0b;padding:12px 16px;border-radius:4px;margin-bottom:20px;font-size:13px;color:#92400e;">
                    <strong>Alcance del Pago:</strong> Pago de <strong>USD 10.00</strong> correspondiente única y exclusivamente a la <strong>primera clase del curso</strong>. No constituye matrícula completa ni acceso total al programa integral.
                </div>
                <table width="100%" border="0" cellspacing="0" cellpadding="8" style="font-size:14px;color:#334155;border-collapse:collapse;">
                    <tr style="background-color:#f8fafc;">
                        <td style="font-weight:600;width:35%;border-bottom:1px solid #e2e8f0;">Curso:</td>
                        <td style="border-bottom:1px solid #e2e8f0;font-weight:700;color:#0f3460;">{$curso}</td>
                    </tr>
                    <tr>
                        <td style="font-weight:600;border-bottom:1px solid #e2e8f0;">Alumno:</td>
                        <td style="border-bottom:1px solid #e2e8f0;">{$nombres}</td>
                    </tr>
                    <tr style="background-color:#f8fafc;">
                        <td style="font-weight:600;border-bottom:1px solid #e2e8f0;">Correo:</td>
                        <td style="border-bottom:1px solid #e2e8f0;"><a href="mailto:{$email}" style="color:#0284c7;">{$email}</a></td>
                    </tr>
                    <tr>
                        <td style="font-weight:600;border-bottom:1px solid #e2e8f0;">Teléfono:</td>
                        <td style="border-bottom:1px solid #e2e8f0;">{$telefono}</td>
                    </tr>
                    <tr style="background-color:#f8fafc;">
                        <td style="font-weight:600;border-bottom:1px solid #e2e8f0;">Transacción PayPal:</td>
                        <td style="border-bottom:1px solid #e2e8f0;font-family:monospace;font-weight:700;color:#059669;">{$orderId}</td>
                    </tr>
                    <tr>
                        <td style="font-weight:600;border-bottom:1px solid #e2e8f0;">Monto Validado:</td>
                        <td style="border-bottom:1px solid #e2e8f0;font-weight:700;color:#0f3460;">USD 10.00</td>
                    </tr>
                    <tr style="background-color:#f8fafc;">
                        <td style="font-weight:600;">Fecha y Hora:</td>
                        <td>{$fecha}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background-color:#f8fafc;padding:16px 30px;text-align:center;font-size:12px;color:#64748b;border-top:1px solid #e2e8f0;">
                Este mensaje fue generado automáticamente por la plataforma web de Quality Consulting Solutions.
            </td>
        </tr>
    </table>
</body>
</html>
HTML;
    }
}
