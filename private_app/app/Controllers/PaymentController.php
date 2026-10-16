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
 * - Gestionar PAYMENT_NOTIFICATION_EMAIL sin confundir destinatario y cuenta SMTP.
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
     * Aplica cabeceras CORS controladas para permitir llamadas desde GitHub Pages o subdominios autorizados.
     */
    private function applyCorsHeaders(): void
    {
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
        $allowedOrigins = $this->config['security']['allowed_origins'] ?? [];

        if (!empty($origin)) {
            if (empty($allowedOrigins) || in_array($origin, $allowedOrigins, true)) {
                header("Access-Control-Allow-Origin: {$origin}");
                header('Access-Control-Allow-Credentials: true');
                header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
                header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, X-CSRF-Token');
                header('Access-Control-Max-Age: 86400');
            }
        }
    }

    /**
     * Responde peticiones preflight OPTIONS para endpoints de API.
     */
    public function optionsPreflight(): void
    {
        $this->applyCorsHeaders();
        http_response_code(204);
        exit;
    }

    /**
     * API: Provee la configuración pública necesaria para inicializar el SDK de PayPal en cliente.
     * GET /api/paypal/config
     */
    public function getPaypalConfig(): void
    {
        $this->applyCorsHeaders();

        $isConfigured = $this->paypalService->isConfigured();
        $clientId = $isConfigured ? $this->paypalService->getClientId() : '';
        $mode = $this->paypalService->getMode();

        $this->json([
            'configured' => $isConfigured,
            'mode'       => $mode,
            'client_id'  => $clientId,
            'currency'   => $this->paypalService->getCurrency(),
            'price'      => number_format($this->paypalService->getPrice(), 2, '.', ''),
        ]);
    }

    /**
     * API: Crea una orden en PayPal v2 restringida a USD 10.00 vinculada a la capacitación seleccionada.
     * POST /api/paypal/create-order
     */
    public function createPaypalOrder(): void
    {
        $this->applyCorsHeaders();
        $this->enforceRateLimit('create_order', 25, 60);

        if ($this->getMethod() !== 'POST') {
            $this->json(['success' => false, 'message' => 'Método no permitido'], 405);
        }

        $courseSlug = trim((string)($this->getPost('curso', '')));
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
        $this->applyCorsHeaders();
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

        // 2. Validación estricta en el backend: status COMPLETED, moneda USD, importe USD 10.00, receptor y curso
        $verifyResult = $this->paypalService->verifyOrder($orderId, 10.00, 'USD', $courseSlug);

        if (empty($verifyResult['valid'])) {
            $this->json([
                'success' => false,
                'message' => 'Validación de pago fallida: ' . ($verifyResult['error'] ?? 'El pago no cumple con los requisitos en el servidor de PayPal.'),
            ], 422);
        }

        $captureId = (string)($verifyResult['capture_id'] ?? ($captureResult['capture_id'] ?? ''));

        // 3. Registrar el pago confirmado en sesión de servidor protegida
        \Security::startSession();
        $courseTitle = CourseCatalog::getTitle($courseSlug);
        $signature = hash_hmac(
            'sha256',
            "{$orderId}|{$captureId}|10.00|USD|{$courseSlug}",
            $this->config['security']['honeypot_field'] ?? 'qcs_secret_payment_hash'
        );

        $_SESSION['paypal_confirmed_payment'] = [
            'order_id'     => $orderId,
            'capture_id'   => $captureId,
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
            'capture_id'   => $captureId,
            'course_title' => $courseTitle,
            'amount'       => 'USD 10.00',
        ]);
    }

    /**
     * API: Verifica una transacción de PayPal en el backend y habilita el formulario.
     * POST /api/paypal/verify-transaction
     */
    public function verifyTransaction(): void
    {
        $this->applyCorsHeaders();
        $this->enforceRateLimit('verify_transaction', 15, 60);

        if ($this->getMethod() !== 'POST') {
            $this->json(['success' => false, 'message' => 'Método no permitido.'], 405);
        }

        \Security::startSession();

        $orderId = trim((string)($this->getPost('order_id', $this->getPost('paypal_order_id', ''))));
        $courseSlug = trim((string)($this->getPost('curso', '')));

        if (empty($orderId)) {
            $this->json(['success' => false, 'message' => 'Código o referencia de transacción de PayPal faltante.'], 422);
        }

        if (!CourseCatalog::isValid($courseSlug)) {
            $this->json(['success' => false, 'message' => 'El curso seleccionado no es válido.'], 422);
        }

        // 1. Verificación contra reutilización de transacciones
        if (PayPalService::isTransactionAlreadyUsed($orderId, $this->config)) {
            $this->json([
                'success' => false,
                'message' => "La transacción {$orderId} ya fue registrada previamente en el sistema. No se admiten registros duplicados para el mismo pago.",
                'code'    => 'TRANSACTION_ALREADY_USED',
            ], 409);
        }

        // 2. Verificación estricta en el servidor
        $verifyResult = $this->paypalService->verifyOrder($orderId, 10.00, 'USD', $courseSlug);

        if (empty($verifyResult['valid'])) {
            $this->json([
                'success'      => false,
                'message'      => $verifyResult['error'] ?? 'No se pudo verificar el pago en el servidor.',
                'code'         => $verifyResult['code'] ?? 'VERIFICATION_FAILED',
                'unconfigured' => !empty($verifyResult['unconfigured']),
            ], 422);
        }

        $courseTitle = CourseCatalog::getTitle($courseSlug);
        $captureId = (string)($verifyResult['capture_id'] ?? '');

        // 3. Firma y registro en sesión protegida de servidor
        $signature = hash_hmac(
            'sha256',
            "{$orderId}|{$captureId}|10.00|USD|{$courseSlug}",
            $this->config['security']['honeypot_field'] ?? 'qcs_secret_payment_hash'
        );

        $_SESSION['paypal_confirmed_payment'] = [
            'order_id'     => $orderId,
            'capture_id'   => $captureId,
            'course_slug'  => $courseSlug,
            'course_title' => $courseTitle,
            'amount'       => 10.00,
            'currency'     => 'USD',
            'verified_at'  => time(),
            'signature'    => $signature,
        ];

        $this->json([
            'success'      => true,
            'message'      => '¡Pago de USD 10.00 verificado exitosamente en el servidor! Formulario de registro habilitado.',
            'order_id'     => $orderId,
            'capture_id'   => $captureId,
            'course_title' => $courseTitle,
            'amount'       => 'USD 10.00',
        ]);
    }

    /** VISTA: checkout exclusivo de la primera clase. */
    public function pagarPrimeraClase(): void
    {
        $courseSlug = trim((string)$this->getQuery('curso', ''));
        if (!CourseCatalog::isValid($courseSlug)) {
            $this->redirect('/capacitacion');
            return;
        }

        $course = CourseCatalog::find($courseSlug);
        $checkoutMode = $this->getCheckoutMode();
        $paypalMeUrl = trim((string)($this->config['paypal']['paypal_me_url'] ?? ''));
        if (filter_var($paypalMeUrl, FILTER_VALIDATE_URL) === false || parse_url($paypalMeUrl, PHP_URL_SCHEME) !== 'https') {
            $paypalMeUrl = '';
        }
        $this->render('pages/pagar-primera-clase', [
            'title' => 'Pago de primera clase | Quality Consulting Solutions',
            'metaDescription' => 'Pago seguro de la primera clase del curso por USD 10.',
            'activePage' => 'capacitacion',
            'courseSlug' => $courseSlug,
            'courseTitle' => (string)$course['title'],
            'courseUrl' => (string)$course['url'],
            'courseCatalog' => CourseCatalog::all(),
            'staticBuild' => false,
            'checkoutMode' => $checkoutMode,
            'paypalMeUrl' => $checkoutMode === 'paypalme' ? $paypalMeUrl : '',
        ]);
    }

    /**
     * VISTA: Formulario Obligatorio post-pago de Primera Clase.
     * GET /registro-primera-clase?curso={slug}
     */
    public function registroPrimeraClase(): void
    {
        \Security::startSession();

        $courseSlug = (string)($this->getQuery('curso', ''));
        $confirmedPayment = $_SESSION['paypal_confirmed_payment'] ?? null;
        $isSessionValid = $this->isSessionPaymentValid($confirmedPayment);
        $isManualMode = $this->getCheckoutMode() === 'paypalme';

        if ($isManualMode && CourseCatalog::isValid($courseSlug)) {
            $course = CourseCatalog::find($courseSlug);
            $courseTitle = (string)$course['title'];
            $orderId = '';
            $captureId = '';
            $isVerifiedInSession = false;
        } elseif (!$isSessionValid) {
            $target = CourseCatalog::isValid($courseSlug)
                ? '/pagar-primera-clase?curso=' . urlencode($courseSlug)
                : '/capacitacion';
            $this->redirect($target);
            return;
        } else {
            $courseSlug = $confirmedPayment['course_slug'];
            $courseTitle = $confirmedPayment['course_title'];
            $orderId = $confirmedPayment['order_id'];
            $captureId = $confirmedPayment['capture_id'] ?? '';
            $isVerifiedInSession = true;
        }

        $csrfToken = \Security::getCsrfToken();
        $paymentError = $_SESSION['_qcs_payment_error'] ?? null;
        if (isset($_SESSION['_qcs_payment_error'])) {
            unset($_SESSION['_qcs_payment_error']);
        }

        $this->render('pages/registro-primera-clase', [
            'title'               => 'Pago y Registro – Primera Clase | Quality Consulting Solutions',
            'metaDescription'     => 'Verificación de pago y formulario oficial de registro para la primera clase (USD 10).',
            'activePage'          => 'capacitacion',
            'courseSlug'          => $courseSlug,
            'courseTitle'         => $courseTitle,
            'orderId'             => $orderId,
            'captureId'           => $captureId,
            'isVerifiedInSession' => $isVerifiedInSession,
            'paymentError'        => $paymentError,
            'amount'              => 10.00,
            'currency'            => 'USD',
            'csrfToken'           => $csrfToken,
            'honeypotField'       => $this->config['security']['honeypot_field'] ?? '_qcs_verification_hp',
            'courseCatalog'       => CourseCatalog::all(),
            'staticBuild'         => false,
            'manualVerification'  => $isManualMode,
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
            $this->redirect('/capacitacion');
            return;
        }

        \Security::startSession();
        $postedCourseSlug = trim((string)$this->getPost('curso', ''));

        // 1. Protección CSRF obligatoria
        $csrfToken = (string)($this->getPost('_csrf_token', ''));
        if (!\Security::validateCsrfToken($csrfToken)) {
            if ($this->isAjax()) {
                $this->json(['success' => false, 'message' => 'Token de seguridad CSRF inválido o expirado. Recarga la página.'], 403);
            }
            $_SESSION['_qcs_payment_error'] = 'Error de seguridad (CSRF). Por favor, intenta enviar el formulario nuevamente.';
            $this->redirect('/registro-primera-clase?curso=' . urlencode($postedCourseSlug));
            return;
        }

        // 2. Verificación Anti-Spam (Honeypot)
        $honeypotField = $this->config['security']['honeypot_field'] ?? '_qcs_verification_hp';
        if (!\Security::verifyHoneypot($_POST, $honeypotField)) {
            if ($this->isAjax()) {
                $this->json(['success' => true, 'message' => 'Registro recibido.']);
            }
            $this->redirect('/registro-exitoso');
            return;
        }

        // 3. Validación estricta del pago en el backend (No confiar en datos del cliente)
        $orderId = trim((string)($this->getPost('paypal_order_id', '')));
        $cursoSlug = $postedCourseSlug;
        $confirmedPayment = $_SESSION['paypal_confirmed_payment'] ?? null;
        $isManualMode = $this->getCheckoutMode() === 'paypalme';

        if (empty($orderId)) {
            if ($this->isAjax()) {
                $this->json(['success' => false, 'message' => 'Se requiere el código de transacción de PayPal.'], 422);
            }
            $_SESSION['_qcs_payment_error'] = 'El código o referencia de la transacción de PayPal es obligatorio.';
            $this->redirect('/registro-primera-clase?curso=' . urlencode($cursoSlug));
            return;
        }

        if ($isManualMode && !preg_match('/^[A-Za-z0-9._-]{6,127}$/', $orderId)) {
            $msg = 'Ingresa una referencia PayPal válida.';
            if ($this->isAjax()) {
                $this->json(['success' => false, 'message' => $msg], 422);
            }
            $_SESSION['_qcs_payment_error'] = $msg;
            $this->redirect('/registro-primera-clase?curso=' . urlencode($cursoSlug));
            return;
        }

        // Comprobación de no reutilización de transacción
        if (PayPalService::isTransactionAlreadyUsed($orderId, $this->config)) {
            $msg = "La transacción {$orderId} ya fue registrada previamente en el sistema. No se admiten registros duplicados para el mismo pago.";
            if ($this->isAjax()) {
                $this->json(['success' => false, 'message' => $msg, 'code' => 'TRANSACTION_ALREADY_USED'], 409);
            }
            $_SESSION['_qcs_payment_error'] = $msg;
            $this->redirect('/registro-primera-clase?curso=' . urlencode($cursoSlug));
            return;
        }

        // Bloqueo atómico exclusivo contra solicitudes concurrentes simultáneas
        if (!\FallbackQueue::acquireTransactionLock($orderId)) {
            $msg = "La transacción {$orderId} ya está siendo procesada por otra solicitud simultánea o fue registrada previamente.";
            if ($this->isAjax()) {
                $this->json(['success' => false, 'message' => $msg, 'code' => 'TRANSACTION_ALREADY_USED'], 409);
            }
            $_SESSION['_qcs_payment_error'] = $msg;
            $this->redirect('/registro-primera-clase?curso=' . urlencode($cursoSlug));
            return;
        }

        $paymentVerified = false;
        $paymentErrorMsg = null;
        $captureId = $isManualMode
            ? 'MANUAL_' . hash('sha256', strtolower($orderId))
            : trim((string)($this->getPost('paypal_capture_id', $confirmedPayment['capture_id'] ?? '')));

        try {
            if ($isManualMode && CourseCatalog::isValid($cursoSlug)) {
                $paymentVerified = true;
            } elseif ($this->isSessionPaymentValid($confirmedPayment) &&
                strcasecmp((string)$confirmedPayment['order_id'], $orderId) === 0 &&
                $confirmedPayment['course_slug'] === $cursoSlug) {
                $paymentVerified = true;
                if (empty($captureId) && !empty($confirmedPayment['capture_id'])) {
                    $captureId = $confirmedPayment['capture_id'];
                }
            } else {
                // Verificación directa en el servidor contra PayPal API o test mock controlado
                $directVerify = $this->paypalService->verifyOrder($orderId, 10.00, 'USD', $cursoSlug);
                if (!empty($directVerify['valid'])) {
                    $paymentVerified = true;
                    if (empty($captureId) && !empty($directVerify['capture_id'])) {
                        $captureId = $directVerify['capture_id'];
                    }
                } else {
                    $paymentErrorMsg = $directVerify['error'] ?? 'El pago no pudo ser verificado en el servidor de PayPal.';
                }
            }

            if (!$paymentVerified) {
                $finalErr = $paymentErrorMsg ?? 'No fue posible validar la transacción de PayPal en el servidor. El formulario requiere un pago de USD 10.00 verificado.';
                if ($this->isAjax()) {
                    $this->json([
                        'success' => false,
                        'message' => $finalErr,
                    ], 422);
                }
                $_SESSION['_qcs_payment_error'] = $finalErr;
                $this->redirect('/registro-primera-clase?curso=' . urlencode($cursoSlug) . '&order_id=' . urlencode($orderId));
                return;
            }

            if (empty($captureId)) {
                $finalErr = 'No fue posible confirmar el identificador de captura del pago.';
                if ($this->isAjax()) {
                    $this->json(['success' => false, 'message' => $finalErr], 422);
                }
                $_SESSION['_qcs_payment_error'] = $finalErr;
                $this->redirect('/registro-primera-clase?curso=' . urlencode($cursoSlug));
                return;
            }

            if (PayPalService::isTransactionAlreadyUsed($captureId, $this->config)) {
                $msg = 'El pago ya fue registrado previamente. No se admiten registros duplicados.';
                if ($this->isAjax()) {
                    $this->json(['success' => false, 'message' => $msg, 'code' => 'TRANSACTION_ALREADY_USED'], 409);
                }
                $_SESSION['_qcs_payment_error'] = $msg;
                $this->redirect('/registro-primera-clase?curso=' . urlencode($cursoSlug));
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
                $this->redirect('/registro-primera-clase?curso=' . urlencode($cursoSlug));
                return;
            }

            $courseTitle = CourseCatalog::getTitle($cursoSlug);
            $clientIp = \Security::getClientIp($this->config);
            $userAgent = \Security::getUserAgent();

            $registrationData = [
                'nombres'           => $nombres,
                'email'             => $email,
                'telefono'          => $telefono,
                'curso_slug'        => $cursoSlug,
                'curso_titulo'      => $courseTitle,
                'concepto'          => 'Primera clase del curso (no incluye el curso completo)',
                'paypal_order_id'   => $orderId,
                'paypal_capture_id' => $captureId,
                'monto'             => 10.00,
                'moneda'            => 'USD',
                'tipo_compra'       => 'Primera clase del curso – USD 10',
                'ip_origen'         => $clientIp,
                'user_agent'        => $userAgent,
                'fecha_registro'    => date('Y-m-d H:i:s'),
                'mail_sent'         => false,
                'mail_status'       => 'pendiente_en_cola',
                'verification_status' => $isManualMode ? 'pending_manual_verification' : 'verified',
            ];

            // 5. MySQL es la persistencia primaria; la cola se usa solo como contingencia.
            $savedDatabase = \Database::savePayPalFirstClassRegistration($this->config, $registrationData);
            $savedFallback = ['success' => false];
            if (!$savedDatabase) {
                // Una restricción UNIQUE también protege frente a carreras entre procesos.
                if (\Database::isPayPalTransactionUsed($this->config, $orderId)
                    || \Database::isPayPalTransactionUsed($this->config, $captureId)) {
                    $msg = 'El pago ya fue registrado previamente. No se admiten registros duplicados.';
                    if ($this->isAjax()) {
                        $this->json(['success' => false, 'message' => $msg, 'code' => 'TRANSACTION_ALREADY_USED'], 409);
                    }
                    $_SESSION['_qcs_payment_error'] = $msg;
                    $this->redirect('/registro-primera-clase?curso=' . urlencode($cursoSlug));
                    return;
                }
                $savedFallback = \FallbackQueue::save('paypal_first_class', $registrationData, $orderId);
            }
            $isPersisted = $savedDatabase || !empty($savedFallback['success']);

            if (!$isPersisted) {
                if ($this->isAjax()) {
                    $this->json([
                        'success' => false,
                        'message' => 'Hubo una dificultad técnica temporal al guardar el registro. Por favor contáctenos a soporte.',
                    ], 500);
                }
                $_SESSION['_qcs_payment_error'] = 'Error temporal al almacenar el registro. Por favor contáctenos con su código de transacción.';
                $this->redirect('/registro-primera-clase?curso=' . urlencode($cursoSlug));
                return;
            }

            // 6. GESTIÓN DE NOTIFICACIÓN A COORDINACIÓN COMERCIAL (comercial@quality-consulting.org)
            $omarEmail = trim((string)($this->config['recipients']['payment_notification'] ?? ''));
            $isRecipientConfigured = !empty($omarEmail) &&
                !str_contains($omarEmail, 'PLACEHOLDER') &&
                !str_contains($omarEmail, 'ejemplo.com') &&
                \Security::isValidEmail($omarEmail);

            $mailSent = false;
            $mailStatus = 'pendiente_en_cola';
            $mailStatusNote = '';

            if ($isRecipientConfigured) {
                try {
                    $mailer = new \SmtpMailer($this->config);
                    $subject = $isManualMode
                        ? "Pago pendiente de verificación – Primera clase: {$courseTitle} - {$nombres}"
                        : "Nueva Inscripción – Primera Clase (USD 10): {$courseTitle} - {$nombres}";
                    $bodyHtml = $this->buildFirstClassEmailHtml($registrationData);
                    $mailSent = $mailer->send($omarEmail, $subject, $bodyHtml, $email);
                    if ($mailSent) {
                        $mailStatus = 'aceptado_por_servidor_smtp';
                        $mailStatusNote = "Notificación aceptada por el servidor SMTP para entrega a la coordinación comercial ({$omarEmail}).";
                        // Si MySQL falló, conservar la cola para que el cron inserte sin reenviar el correo.
                        if (!$savedDatabase) {
                            $registrationData['mail_sent'] = true;
                            $registrationData['mail_status'] = $mailStatus;
                            $registrationData['mail_sent_at'] = date('Y-m-d H:i:s');
                            \FallbackQueue::save('paypal_first_class', $registrationData, $orderId);
                        }
                    } else {
                        $mailStatus = 'pendiente_en_cola';
                        $mailStatusNote = "Registro guardado en el sistema con orden {$orderId}. La notificación por correo quedó en cola para reintento.";
                        \FallbackQueue::save('paypal_first_class', $registrationData, $orderId);
                    }
                } catch (\Throwable $e) {
                    error_log('[QCS PayPal Email Notification Error] ' . $e->getMessage());
                    $mailSent = false;
                    $mailStatus = 'pendiente_en_cola';
                    $mailStatusNote = "Registro guardado en el sistema con orden {$orderId}. Incidencia SMTP; la notificación quedó registrada en cola para reintento.";
                    \FallbackQueue::save('paypal_first_class', $registrationData, $orderId);
                }
            } else {
                $mailSent = false;
                $mailStatus = 'pendiente_en_cola';
                $mailStatusNote = "Registro guardado con orden {$orderId}. PAYMENT_NOTIFICATION_EMAIL no está configurada; notificación en cola.";
                \FallbackQueue::save('paypal_first_class', $registrationData, $orderId);
                error_log("[QCS PayPal Registration] {$mailStatusNote}");
            }

            // 7. Consumir la sesión para evitar reutilizaciones de la orden
            unset($_SESSION['paypal_confirmed_payment']);

            // Guardar resumen en sesión para la página de confirmación
            $_SESSION['paypal_registration_summary'] = [
                'nombres'                 => $nombres,
                'email'                   => $email,
                'telefono'                => $telefono,
                'curso_titulo'            => $courseTitle,
                'concepto'                => 'Primera clase del curso (no incluye el curso completo)',
                'paypal_order_id'         => $orderId,
                'paypal_capture_id'       => $captureId,
                'monto'                   => 'USD 10.00',
                'mail_sent'               => $mailSent,
                'mail_status'             => $mailStatus,
                'recipient_configured'    => $isRecipientConfigured,
                'mail_status_note'        => $mailStatusNote,
                'pending_manual_verification' => $isManualMode,
            ];

            if ($this->isAjax()) {
                $this->json([
                    'success'                 => true,
                    'message'                 => $isManualMode
                        ? 'Hemos recibido tus datos. La inscripción será confirmada después de verificar manualmente el pago.'
                        : '¡Registro completado exitosamente! Tu inscripción a la primera clase ha sido procesada.',
                    'redirect'                => '/registro-exitoso',
                    'mail_sent'               => $mailSent,
                    'mail_status'             => $mailStatus,
                    'recipient_configured'    => $isRecipientConfigured,
                    'mail_status_note'        => $mailStatusNote,
                ]);
            }

            $this->redirect('/registro-exitoso');
        } finally {
            // Liberar el bloqueo atómico una vez persistido o finalizado
            \FallbackQueue::releaseTransactionLock($orderId);
        }
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
        $captureId = (string)($payment['capture_id'] ?? '');
        $courseSlug = (string)($payment['course_slug'] ?? '');
        $amount = (float)($payment['amount'] ?? 0.0);
        $signature = (string)($payment['signature'] ?? '');

        if (empty($orderId) || empty($courseSlug) || abs($amount - 10.00) > 0.01) {
            return false;
        }

        $sigWithCapture = hash_hmac(
            'sha256',
            "{$orderId}|{$captureId}|10.00|USD|{$courseSlug}",
            $this->config['security']['honeypot_field'] ?? 'qcs_secret_payment_hash'
        );

        $sigWithoutCapture = hash_hmac(
            'sha256',
            "{$orderId}|10.00|USD|{$courseSlug}",
            $this->config['security']['honeypot_field'] ?? 'qcs_secret_payment_hash'
        );

        return hash_equals($sigWithCapture, $signature) || hash_equals($sigWithoutCapture, $signature);
    }

    private function getCheckoutMode(): string
    {
        $mode = strtolower(trim((string)($this->config['paypal']['checkout_mode'] ?? 'api')));
        return in_array($mode, ['api', 'paypalme'], true) ? $mode : 'api';
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
        $captureId = htmlspecialchars((string)($data['paypal_capture_id'] ?? 'N/A'), ENT_QUOTES, 'UTF-8');
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
                        <td style="font-weight:600;border-bottom:1px solid #e2e8f0;">Orden PayPal:</td>
                        <td style="border-bottom:1px solid #e2e8f0;font-family:monospace;font-weight:700;color:#059669;">{$orderId}</td>
                    </tr>
                    <tr>
                        <td style="font-weight:600;border-bottom:1px solid #e2e8f0;">Captura PayPal:</td>
                        <td style="border-bottom:1px solid #e2e8f0;font-family:monospace;font-weight:700;color:#059669;">{$captureId}</td>
                    </tr>
                    <tr style="background-color:#f8fafc;">
                        <td style="font-weight:600;border-bottom:1px solid #e2e8f0;">Monto Validado:</td>
                        <td style="border-bottom:1px solid #e2e8f0;font-weight:700;color:#0f3460;">USD 10.00</td>
                    </tr>
                    <tr>
                        <td style="font-weight:600;border-bottom:1px solid #e2e8f0;">Concepto:</td>
                        <td style="border-bottom:1px solid #e2e8f0;color:#334155;">Primera clase del curso (no incluye el curso completo)</td>
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

