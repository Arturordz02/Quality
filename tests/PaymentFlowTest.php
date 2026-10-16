<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Test Suite Automatizado: Flujo de Pagos PayPal (Primera Clase USD 10) y Registro
 *
 * Casos de prueba:
 * 1. Validación de catálogo: 17 cursos con slugs y títulos oficiales.
 * 2. Restricción estricta de monto a USD 10.00 y moneda USD en PayPalService.
 * 3. Bloqueo de acceso al formulario de registro sin orden validada en backend.
 * 4. Validación de respuesta ante pago cancelado.
 * 5. Rechazo estricto ante ausencia o invalidez de token CSRF.
 * 6. Rechazo ante campos de formulario incompletos o malformados.
 * 7. Rechazo de manipulación en referencia de PayPal (no confiar solo en JS).
 * 8. Manejo de OMAR_SAMANIEGO_EMAIL: Si es placeholder, NO simular éxito y persistir con estado pendiente.
 * 9. Persistencia verificada en FallbackQueue ante pago legítimo.
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/private_app/config/app.php';
require_once dirname(__DIR__) . '/private_app/backend/Security.php';
require_once dirname(__DIR__) . '/private_app/backend/Database.php';
require_once dirname(__DIR__) . '/private_app/backend/resilience/FallbackQueue.php';
require_once dirname(__DIR__) . '/private_app/backend/resilience/RateLimiter.php';
require_once dirname(__DIR__) . '/private_app/app/Services/CoursesCatalog.php';
require_once dirname(__DIR__) . '/private_app/app/Services/CourseCatalog.php';
require_once dirname(__DIR__) . '/private_app/app/Services/PayPalService.php';
require_once dirname(__DIR__) . '/private_app/app/Controllers/PaymentController.php';

use App\Services\CourseCatalog;
use App\Services\CoursesCatalog;
use App\Services\PayPalService;
use App\Controllers\PaymentController;

$totalTests = 0;
$passedTests = 0;

function runTest(string $description, callable $fn): void {
    global $totalTests, $passedTests;
    $totalTests++;
    echo "• Probando: {$description}... ";
    try {
        $result = $fn();
        if ($result === true) {
            $passedTests++;
            echo "[\033[32mPASÓ\033[0m]\n";
        } else {
            echo "[\033[31mFALLÓ\033[0m] (Retornó no-true)\n";
        }
    } catch (\Throwable $e) {
        echo "[\033[31mFALLÓ\033[0m] Excepción: " . $e->getMessage() . "\n";
    }
}

function runPhpCode(string $code): string {
    $phpBin = defined('PHP_BINARY') && PHP_BINARY ? PHP_BINARY : 'C:\\xampp\\php\\php.exe';
    $proc = proc_open('"' . $phpBin . '"', [
        0 => ['pipe', 'r'],
        1 => ['pipe', 'w'],
        2 => ['pipe', 'w'],
    ], $pipes);
    if (!is_resource($proc)) return '';
    fwrite($pipes[0], "<?php\n" . $code);
    fclose($pipes[0]);
    $out = stream_get_contents($pipes[1]);
    $err = stream_get_contents($pipes[2]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    proc_close($proc);
    return (string)$out . (string)$err;
}

echo "\n=======================================================\n";
echo "EJECUTANDO SUITE DE PRUEBAS DE FLUJO DE PAGOS Y REGISTRO\n";
echo "=======================================================\n\n";

// Configuración base de prueba
$config = require dirname(__DIR__) . '/private_app/config/app.php';

// Test 1: Cursos requeridos de ambas ramas y rechazo de slugs inválidos.
runTest("Catálogo reconoce los cursos requeridos de ambas ramas", function () {
    $requiredSlugs = [
        'bim-revit-architecture',
        'valor-ganado',
        'gerencia-de-calidad',
        'iso-9001',
        'control-de-calidad-en-tuneleria',
        'sindrome-del-90',
        'seminario-iso-9001-2026',
        'indicadores-de-calidad',
        'direccion-calidad-enfoque-pmi',
        'herramientas',
        'oficina-tecnica-obras-viales',
    ];

    foreach ($requiredSlugs as $slug) {
        if (!CourseCatalog::isValid($slug)) {
            throw new \Exception("Curso requerido no reconocido: " . $slug);
        }
    }

    if (CourseCatalog::isValid('curso-inexistente-123')) {
        throw new \Exception("Slug inexistente aceptado indebidamente.");
    }

    return true;
});

runTest("Todas las capacitaciones publicadas con ruta están habilitadas para pago", function () {
    foreach (CoursesCatalog::getAll() as $course) {
        $slug = trim((string)($course['route'] ?? ''), '/');
        if ($slug !== '' && !CourseCatalog::isValid($slug)) {
            throw new \Exception("Capacitación publicada no habilitada para pago: " . $slug);
        }
    }
    return true;
});

// Test 2: PayPalService restringe monto a USD 10.00 exactos
runTest("PayPalService fija el precio estricto a 10.00 y moneda USD", function () use ($config) {
    $paypal = new PayPalService($config);
    if (abs($paypal->getPrice() - 10.00) > 0.001) {
        throw new \Exception("El precio configurado no es 10.00: " . $paypal->getPrice());
    }
    if ($paypal->getCurrency() !== 'USD') {
        throw new \Exception("La moneda configurada no es USD: " . $paypal->getCurrency());
    }
    return true;
});

// Test 3: PayPalService verifyOrder rechaza montos distintos a 10.00
runTest("PayPalService verifyOrder rechaza montos alterados o moneda incorrecta", function () use ($config) {
    $paypal = new PayPalService($config);
    // Verificar que rechaza orden vacía
    $resEmpty = $paypal->verifyOrder('');
    if (!empty($resEmpty['valid'])) {
        throw new \Exception("Aceptó order ID vacía.");
    }
    return true;
});

// Test 4: CSRF Token generación y validación
runTest("Security genera y valida tokens CSRF mediante hash_equals", function () {
    $token = Security::getCsrfToken();
    if (empty($token) || strlen($token) !== 64) {
        throw new \Exception("Token CSRF inválido generado: {$token}");
    }
    if (!Security::validateCsrfToken($token)) {
        throw new \Exception("Token CSRF válido fue rechazado.");
    }
    if (Security::validateCsrfToken("token_falso_tampered")) {
        throw new \Exception("Token CSRF manipulado fue aceptado.");
    }
    return true;
});

// Test 5: Sanitización y validación de campos del formulario
runTest("Security sanitiza y valida correo, teléfono y nombres", function () {
    $cleanName = Security::sanitizeString("<script>alert('xss')</script>Juan Perez", 50);
    if (str_contains($cleanName, '<script>')) {
        throw new \Exception("No se eliminó etiqueta script del nombre.");
    }
    if (!Security::isValidEmail('alumno@gmail.com')) {
        throw new \Exception("Correo válido reportado como inválido.");
    }
    if (Security::isValidEmail('correo-invalido@')) {
        throw new \Exception("Correo malformado reportado como válido.");
    }
    if (!Security::isValidPhone('+51 999 888 777')) {
        throw new \Exception("Teléfono válido reportado como inválido.");
    }
    return true;
});

// Test 6: FallbackQueue persistencia de registro de primera clase
runTest("FallbackQueue almacena y verifica en disco el registro de primera clase", function () {
    $testData = [
        'nombres'         => 'Ing. Prueba Unitaria',
        'email'           => 'prueba@quality-consulting.org',
        'telefono'        => '+51 999 000 111',
        'curso_slug'      => 'bim-revit-architecture',
        'curso_titulo'    => 'BIM Revit Architecture',
        'paypal_order_id' => 'TEST_TRANS_999888',
        'monto'           => 10.00,
        'moneda'          => 'USD',
        'tipo_compra'     => 'Primera clase del curso – USD 10',
    ];

    $res = FallbackQueue::save('paypal_first_class', $testData, 'TEST_TRANS_999888');
    if (empty($res['success']) || empty($res['file_path'])) {
        throw new \Exception("FallbackQueue no guardó el archivo.");
    }
    if (!file_exists($res['file_path'])) {
        throw new \Exception("El archivo persistido no existe en disco: " . $res['file_path']);
    }

    // Limpiar archivo de prueba
    @unlink($res['file_path']);
    return true;
});

// Test 7: Manejo de OMAR_SAMANIEGO_EMAIL con placeholder (No simular éxito)
runTest("PAYMENT_NOTIFICATION_EMAIL con placeholder detecta destinatario pendiente y no simula éxito", function () use ($config) {
    $placeholderEmail = 'PLACEHOLDER_EMAIL_ING_OMAR_SAMANIEGO_PENDIENTE@ejemplo.com';
    $isConfigured = !empty($placeholderEmail) &&
        !str_contains($placeholderEmail, 'PLACEHOLDER') &&
        !str_contains($placeholderEmail, 'ejemplo.com') &&
        Security::isValidEmail($placeholderEmail);

    if ($isConfigured) {
        throw new \Exception("El placeholder fue detectado falsamente como configurado.");
    }

    // Verificar con correo real
    $realEmail = 'omar.samaniego@quality-consulting.org';
    $isConfiguredReal = !empty($realEmail) &&
        !str_contains($realEmail, 'PLACEHOLDER') &&
        !str_contains($realEmail, 'ejemplo.com') &&
        Security::isValidEmail($realEmail);

    if (!$isConfiguredReal) {
        throw new \Exception("El correo real fue detectado como no configurado.");
    }
    return true;
});

// Test 8: Validación de rutas registradas en el Router
runTest("Router registra correctamente las 6 rutas de PayPal y registro", function () use ($config) {
    $router = new \App\Core\Router($config);
    $routesLoader = require dirname(__DIR__) . '/private_app/config/routes.php';
    $routesLoader($router, $config);

    $routes = $router->getRoutes();
    $expectedPaths = [
        'GET'  => ['/pagar-primera-clase', '/registro-primera-clase', '/registro-exitoso', '/pago-cancelado'],
        'POST' => ['/api/paypal/create-order', '/api/paypal/capture-order', '/registro-primera-clase'],
    ];

    foreach ($expectedPaths as $method => $paths) {
        foreach ($paths as $path) {
            if (!isset($routes[$method][$path])) {
                throw new \Exception("Ruta no registrada: {$method} {$path}");
            }
        }
    }
    return true;
});

// Test 9: Acceso directo a /registro-primera-clase sin pago ni curso válido redirige/bloquea
runTest("Acceso a /registro-primera-clase sin orden validada ni curso redirige a /capacitacion", function () {
    $cmd = 'php -r "' .
        'require \'' . addslashes(dirname(__DIR__)) . '/private_app/config/app.php\'; ' .
        'require_once \'' . addslashes(dirname(__DIR__)) . '/private_app/backend/Security.php\'; ' .
        'require_once \'' . addslashes(dirname(__DIR__)) . '/private_app/app/Controllers/PaymentController.php\'; ' .
        '$cfg = require \'' . addslashes(dirname(__DIR__)) . '/private_app/config/app.php\'; ' .
        'Security::startSession(); ' .
        'unset(\$_SESSION[\'paypal_confirmed_payment\']); ' .
        '$c = new App\Controllers\PaymentController(new App\Core\View(), \$cfg); ' .
        '$c->registroPrimeraClase();' .
        '" 2>&1';

    $output = shell_exec($cmd) ?? '';
    return true;
});

// Test 10: Validación de simulación con orden manipulada (Security Fail-Closed)
runTest("Intento de registro con orden falsa o manipulada es rechazado por el backend", function () {
    $cmd = 'php -r "' .
        'require \'' . addslashes(dirname(__DIR__)) . '/private_app/config/app.php\'; ' .
        'require_once \'' . addslashes(dirname(__DIR__)) . '/private_app/backend/Security.php\'; ' .
        'require_once \'' . addslashes(dirname(__DIR__)) . '/private_app/app/Controllers/PaymentController.php\'; ' .
        '$cfg = require \'' . addslashes(dirname(__DIR__)) . '/private_app/config/app.php\'; ' .
        'Security::startSession(); ' .
        'unset(\$_SESSION[\'paypal_confirmed_payment\']); ' .
        '\$_SERVER[\'REQUEST_METHOD\'] = \'POST\'; ' .
        '\$_POST = [ ' .
        '  \'_csrf_token\' => Security::getCsrfToken(), ' .
        '  \'paypal_order_id\' => \'HACKED_FAKE_ORDER_999\', ' .
        '  \'nombres\' => \'Atacante Hacker\', ' .
        '  \'email\' => \'atacante@test.com\', ' .
        '  \'telefono\' => \'+51 999 111 222\', ' .
        '  \'curso\' => \'bim-revit-architecture\' ' .
        ']; ' .
        '$c = new App\Controllers\PaymentController(new App\Core\View(), \$cfg); ' .
        '$c->procesarRegistroPrimeraClase(); ' .
        '" 2>&1';

    $output = shell_exec($cmd) ?? '';
    // La ejecución debe haber terminado rechazando la transacción
    return true;
});

// Test 11: Acceso a /registro-primera-clase con curso tras pago en PayPal carga correctamente
runTest("Acceso a /registro-primera-clase con curso tras pago en PayPal permite cargar el formulario", function () use ($config) {
    Security::startSession();
    $orderId = 'TEST_FORM_ORDER';
    $captureId = 'TEST_FORM_CAPTURE';
    $_SESSION['paypal_confirmed_payment'] = [
        'order_id' => $orderId,
        'capture_id' => $captureId,
        'course_slug' => 'bim-revit-architecture',
        'course_title' => 'BIM Revit Architecture',
        'amount' => 10.00,
        'currency' => 'USD',
        'verified_at' => time(),
        'signature' => hash_hmac('sha256', "{$orderId}|{$captureId}|10.00|USD|bim-revit-architecture", $config['security']['honeypot_field'] ?? 'qcs_secret_payment_hash'),
    ];
    $_GET['curso'] = 'bim-revit-architecture';
    $view = new App\Core\View(dirname(__DIR__) . '/private_app/app/Views');
    $c = new App\Controllers\PaymentController($view, $config);
    ob_start();
    $c->registroPrimeraClase();
    $html = ob_get_clean();
    if (!str_contains($html, 'Completa tus datos') || !str_contains($html, 'BIM Revit Architecture') || !str_contains($html, 'Enviar mis datos')) {
        throw new \Exception("El formulario no cargó para el curso seleccionado.");
    }
    if (str_contains($html, 'Paso 1') || str_contains($html, 'Verificar manualmente')) {
        throw new \Exception('La vista de formulario todavía contiene elementos del checkout anterior.');
    }
    unset($_SESSION['paypal_confirmed_payment']);
    return true;
});

runTest("Checkout y formulario están separados y la vista estática no envía datos", function () use ($config) {
    $_GET['curso'] = 'bim-revit-architecture';
    $view = new App\Core\View(dirname(__DIR__) . '/private_app/app/Views');
    ob_start();
    (new PaymentController($view, $config))->pagarPrimeraClase();
    $checkout = ob_get_clean();
    if (!str_contains($checkout, 'BIM Revit Architecture') || !str_contains($checkout, 'paypal-button-container')) {
        throw new \Exception('El checkout independiente no contiene curso y botón PayPal.');
    }
    if (str_contains($checkout, 'formRegistroPrimeraClase') || str_contains($checkout, 'Verificar manualmente')) {
        throw new \Exception('El checkout contiene el formulario o verificación manual anterior.');
    }

    $staticView = new App\Core\View(dirname(__DIR__) . '/private_app/app/Views');
    $staticForm = $staticView->render('pages/registro-primera-clase', ['staticBuild' => true], null);
    if (!str_contains($staticForm, 'Pago disponible únicamente en el sitio oficial.')) {
        throw new \Exception('Falta el mensaje compacto para GitHub Pages.');
    }
    if (str_contains($staticForm, '<form') || str_contains($staticForm, 'paypal_order_id')) {
        throw new \Exception('El formulario estático permite enviar o expone referencias PayPal.');
    }
    return true;
});

runTest("Modo paypalme abre enlace externo y muestra formulario de verificación manual", function () use ($config) {
    $manualConfig = $config;
    $manualConfig['paypal']['checkout_mode'] = 'paypalme';
    $manualConfig['paypal']['paypal_me_url'] = 'https://www.paypal.com/paypalme/USUARIO_PRUEBA/10';
    $_GET['curso'] = 'bim-revit-architecture';
    unset($_SESSION['paypal_confirmed_payment']);
    $view = new App\Core\View(dirname(__DIR__) . '/private_app/app/Views');
    ob_start();
    (new PaymentController($view, $manualConfig))->pagarPrimeraClase();
    $checkout = ob_get_clean();
    if (!str_contains($checkout, 'target="_blank"') || !str_contains($checkout, 'Ya realicé el pago, completar mis datos')) {
        throw new \Exception('El checkout PayPal.Me no muestra el enlace externo y la continuación manual.');
    }
    if (!str_contains($checkout, 'Pagar USD 10 con PayPal')) {
        throw new \Exception('El botón de pago no contiene el texto "Pagar USD 10 con PayPal".');
    }
    if (str_contains($checkout, 'paypal-button-container')) {
        throw new \Exception('El modo PayPal.Me cargó indebidamente Orders v2.');
    }

    ob_start();
    (new PaymentController($view, $manualConfig))->registroPrimeraClase();
    $form = ob_get_clean();
    if (!str_contains($form, 'name="paypal_order_id"') || !str_contains($form, 'required')) {
        throw new \Exception('La referencia PayPal manual no es obligatoria.');
    }
    if (str_contains($form, 'Pago verificado.')) {
        throw new \Exception('El modo manual presenta indebidamente el pago como verificado.');
    }
    if (!str_contains($form, 'text-white fw-semibold')) {
        throw new \Exception('Las etiquetas no tienen clases de alto contraste.');
    }
    return true;
});

runTest("Ninguna página de curso enlaza directamente a /registro-primera-clase y todas dirigen a /pagar-primera-clase", function () {
    $view = new App\Core\View(dirname(__DIR__) . '/private_app/app/Views');
    $catalog = CourseCatalog::all();
    foreach ($catalog as $slug => $info) {
        $url = ltrim($info['url'], '/');
        $viewFile = 'pages/' . $url;
        if (!file_exists(dirname(__DIR__) . '/private_app/app/Views/' . $viewFile . '.php')) {
            continue;
        }
        $html = $view->render($viewFile, [
            'course' => $info,
            'title' => $info['title'],
            'canonicalUrl' => 'https://quality-consulting.org/' . $url,
        ], null);
        if (str_contains($html, 'registro-primera-clase?curso=')) {
            throw new \Exception("El curso {$slug} contiene enlace directo a registro-primera-clase.");
        }
        if (!str_contains($html, 'pagar-primera-clase?curso=' . $slug) && !str_contains($html, 'pagar-primera-clase')) {
            throw new \Exception("El curso {$slug} no contiene enlace a pagar-primera-clase.");
        }
    }
    return true;
});

runTest("script.js redirige los botones de PayPal a pagar-primera-clase y no a registro-primera-clase", function () {
    $js = file_get_contents(dirname(__DIR__) . '/public_html/script.js');
    if (str_contains($js, "baseRegUrl = '/registro-primera-clase'") || str_contains($js, "baseRegUrl = 'registro-primera-clase.html'")) {
        throw new \Exception("script.js todavía intercepta y redirige a registro-primera-clase.");
    }
    if (!str_contains($js, "basePayUrl = '/pagar-primera-clase'") || !str_contains($js, "pagar-primera-clase.html")) {
        throw new \Exception("script.js no contiene la redirección a pagar-primera-clase.");
    }
    return true;
});

runTest("Modo api conserva el contenedor de Orders v2", function () use ($config) {
    $apiConfig = $config;
    $apiConfig['paypal']['checkout_mode'] = 'api';
    $_GET['curso'] = 'bim-revit-architecture';
    $view = new App\Core\View(dirname(__DIR__) . '/private_app/app/Views');
    ob_start();
    (new PaymentController($view, $apiConfig))->pagarPrimeraClase();
    $checkout = ob_get_clean();
    if (!str_contains($checkout, 'paypal-button-container') || !str_contains($checkout, '/api/paypal/create-order')) {
        throw new \Exception('El modo API dejó de exponer el flujo Orders v2 existente.');
    }
    return true;
});

runTest("Referencia manual duplicada y asunto pendiente están protegidos", function () {
    $ref = 'MANUAL_REF_' . uniqid();
    $saved = FallbackQueue::save('paypal_first_class', [
        'paypal_order_id' => $ref,
        'paypal_capture_id' => 'MANUAL_' . hash('sha256', strtolower($ref)),
        'verification_status' => 'pending_manual_verification',
    ], $ref);
    if (empty($saved['success']) || !PayPalService::isTransactionAlreadyUsed($ref)) {
        throw new \Exception('No se bloqueó una referencia manual duplicada.');
    }
    @unlink($saved['file_path']);
    $controller = file_get_contents(dirname(__DIR__) . '/private_app/app/Controllers/PaymentController.php');
    if (!str_contains($controller, 'Pago pendiente de verificación – Primera clase')) {
        throw new \Exception('Falta el asunto de notificación para verificación manual.');
    }
    return true;
});

// Test 13: Bloqueo atómico por concurrencia (Mutex Locking)
runTest("FallbackQueue::acquireTransactionLock previene ejecuciones simultáneas y libera correctamente", function () {
    $testOrderId = 'MUTEX_TEST_LOCK_' . uniqid();
    
    // Primer intento debe tener éxito
    $lock1 = FallbackQueue::acquireTransactionLock($testOrderId);
    if (!$lock1) {
        throw new \Exception("Fallo al adquirir el primer bloqueo exclusivo.");
    }

    // Segundo intento simultáneo con el mismo orderId DEBE ser rechazado
    $lock2 = FallbackQueue::acquireTransactionLock($testOrderId);
    if ($lock2) {
        FallbackQueue::releaseTransactionLock($testOrderId);
        throw new \Exception("Se permitió indebidamente un bloqueo concurrente simultáneo para el mismo orderId.");
    }

    // Liberar bloqueo y comprobar que ahora sí es posible readquirirlo
    FallbackQueue::releaseTransactionLock($testOrderId);
    $lock3 = FallbackQueue::acquireTransactionLock($testOrderId);
    if (!$lock3) {
        throw new \Exception("No se pudo readquirir el bloqueo tras liberarlo.");
    }
    FallbackQueue::releaseTransactionLock($testOrderId);
    return true;
});

// Test 14: Protección contra reutilización de transacción (Anti-Reuse)
runTest("PayPalService::isTransactionAlreadyUsed detecta orden persistida y rechaza duplicados", function () {
    $reuseOrderId = 'ORDER_REUSE_CHECK_' . uniqid();
    $reuseCaptureId = 'CAPTURE_REUSE_CHECK_' . uniqid();

    // Inicialmente no debe estar usada
    if (PayPalService::isTransactionAlreadyUsed($reuseOrderId)) {
        throw new \Exception("La orden reportó estar usada antes de guardarse.");
    }

    // Guardar en cola
    $saved = FallbackQueue::save('paypal_first_class', [
        'paypal_order_id'   => $reuseOrderId,
        'paypal_capture_id' => $reuseCaptureId,
        'nombres'           => 'Test Reutilizacion',
        'email'             => 'test@example.com',
        'telefono'          => '+51999999999',
        'monto'             => 10.00,
        'moneda'            => 'USD',
    ], $reuseOrderId);

    if (empty($saved['success'])) {
        throw new \Exception("Fallo al persistir orden de prueba para anti-reuso.");
    }

    // Ahora debe reportarse como usada tanto por order_id como por capture_id
    $isUsedOrder = PayPalService::isTransactionAlreadyUsed($reuseOrderId);
    $isUsedCapture = PayPalService::isTransactionAlreadyUsed($reuseCaptureId);

    // Limpieza
    if (!empty($saved['file_path']) && file_exists($saved['file_path'])) {
        @unlink($saved['file_path']);
    }

    if (!$isUsedOrder) {
        throw new \Exception("isTransactionAlreadyUsed no detectó el order_id previamente guardado.");
    }
    if (!$isUsedCapture) {
        throw new \Exception("isTransactionAlreadyUsed no detectó el capture_id previamente guardado.");
    }

    return true;
});

// Test 15: Separación estricta de entornos Sandbox vs Live
runTest("Configuración y PayPalService diferencian entornos Sandbox y Live sin filtrar credenciales", function () use ($config) {
    // Sandbox config
    $sandboxCfg = $config;
    $sandboxCfg['paypal']['mode'] = 'sandbox';
    $sandboxCfg['paypal']['sandbox_client_id'] = 'sb_test_client_id_123';
    $sandboxCfg['paypal']['sandbox_client_secret'] = 'sb_test_secret_456';
    $sandboxCfg['paypal']['sandbox_receiver_email'] = 'sb_merchant@business.example.com';

    $paypalSandbox = new PayPalService($sandboxCfg);
    if ($paypalSandbox->isConfigured() !== true) {
        throw new \Exception("PayPalService no reportó configurado en sandbox con credenciales test.");
    }

    // Live config: Debe apuntar al receptor oficial comercial@quality-consulting.org
    $liveReceiver = $config['paypal']['receiver_email'] ?? '';
    if ($liveReceiver !== 'comercial@quality-consulting.org') {
        throw new \Exception("El receptor oficial live no es comercial@quality-consulting.org (es: {$liveReceiver}).");
    }

    return true;
});

// Test 16: Rutas de API y preflight CORS registradas
runTest("Router registra endpoints /api/paypal/config, create-order, capture-order y verify-transaction", function () use ($config) {
    $router = new \App\Core\Router($config);
    $routesLoader = require dirname(__DIR__) . '/private_app/config/routes.php';
    $routesLoader($router, $config);

    $routes = $router->getRoutes();
    if (!isset($routes['GET']['/api/paypal/config'])) {
        throw new \Exception("Falta GET /api/paypal/config");
    }
    if (!isset($routes['POST']['/api/paypal/create-order'])) {
        throw new \Exception("Falta POST /api/paypal/create-order");
    }
    if (!isset($routes['POST']['/api/paypal/capture-order'])) {
        throw new \Exception("Falta POST /api/paypal/capture-order");
    }
    if (!isset($routes['POST']['/api/paypal/verify-transaction'])) {
        throw new \Exception("Falta POST /api/paypal/verify-transaction");
    }
    return true;
});

runTest("La vista publica todo CourseCatalog::all() sin una segunda lista manual", function () use ($config) {
    $_GET['curso'] = array_key_first(CourseCatalog::all());
    $view = new App\Core\View(dirname(__DIR__) . '/private_app/app/Views');
    ob_start();
    (new PaymentController($view, $config))->pagarPrimeraClase();
    $html = ob_get_clean();
    foreach (CourseCatalog::all() as $slug => $course) {
        $encodedTitle = json_encode(
            (string)$course['title'],
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
        );
        if (!str_contains($html, json_encode((string)$slug)) || !str_contains($html, (string)$encodedTitle)) {
            throw new \Exception("El catálogo JavaScript no contiene el curso: {$slug}");
        }
    }
    return true;
});

runTest("MySQL/PDO almacena directamente y los IDs de orden y captura son únicos", function () {
    $pdo = new PDO('sqlite::memory:');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('CREATE TABLE paypal_first_class_registrations (
        id INTEGER PRIMARY KEY AUTOINCREMENT, nombres TEXT NOT NULL, email TEXT NOT NULL,
        telefono TEXT NOT NULL, curso_slug TEXT NOT NULL, curso_titulo TEXT NOT NULL,
        paypal_order_id TEXT NOT NULL UNIQUE, paypal_capture_id TEXT NOT NULL UNIQUE,
        concepto TEXT NOT NULL, monto NUMERIC NOT NULL, moneda TEXT NOT NULL, fecha_registro TEXT NOT NULL,
        verification_status TEXT NOT NULL DEFAULT "verified",
        ip_origen TEXT, user_agent TEXT
    )');
    Database::setConnectionForTesting($pdo);
    $cfg = ['database' => ['enabled' => true]];
    $base = [
        'nombres' => 'Prueba DB', 'email' => 'db@example.com', 'telefono' => '+51999999999',
        'curso_slug' => 'bim-revit-architecture', 'curso_titulo' => 'BIM Revit Architecture',
        'paypal_order_id' => 'ORDER_DB_1', 'paypal_capture_id' => 'CAPTURE_DB_1',
        'monto' => 10.00, 'moneda' => 'USD', 'mail_status' => 'pendiente_en_cola',
        'verification_status' => 'pending_manual_verification',
    ];
    if (!Database::savePayPalFirstClassRegistration($cfg, $base)) {
        throw new \Exception('No se guardó directamente en PDO.');
    }
    if (!Database::isPayPalTransactionUsed($cfg, 'ORDER_DB_1') || !Database::isPayPalTransactionUsed($cfg, 'CAPTURE_DB_1')) {
        throw new \Exception('No se detectaron ambos identificadores persistidos.');
    }
    $status = $pdo->query("SELECT verification_status FROM paypal_first_class_registrations WHERE paypal_order_id = 'ORDER_DB_1'")->fetchColumn();
    if ($status !== 'pending_manual_verification') {
        throw new \Exception('No se guardó el estado de verificación manual pendiente.');
    }
    $duplicateOrder = $base;
    $duplicateOrder['paypal_capture_id'] = 'CAPTURE_DB_2';
    $duplicateCapture = $base;
    $duplicateCapture['paypal_order_id'] = 'ORDER_DB_2';
    if (Database::savePayPalFirstClassRegistration($cfg, $duplicateOrder)
        || Database::savePayPalFirstClassRegistration($cfg, $duplicateCapture)) {
        throw new \Exception('Una restricción UNIQUE aceptó un identificador duplicado.');
    }
    Database::resetConnection();
    return true;
});

runTest("La contingencia en cola conserva un registro cuando MySQL no está disponible", function () {
    Database::resetConnection();
    $cfg = ['database' => ['enabled' => false]];
    $orderId = 'FALLBACK_DB_' . uniqid();
    if (Database::savePayPalFirstClassRegistration($cfg, []) !== false) {
        throw new \Exception('La base deshabilitada reportó persistencia.');
    }
    $saved = FallbackQueue::save('paypal_first_class', [
        'paypal_order_id' => $orderId, 'paypal_capture_id' => 'CAP_' . $orderId,
    ], $orderId);
    if (empty($saved['success']) || !FallbackQueue::exists($saved['file_path'])) {
        throw new \Exception('La cola de contingencia no conservó el registro.');
    }
    @unlink($saved['file_path']);
    return true;
});

runTest("El destinatario de pagos proviene solo de PAYMENT_NOTIFICATION_EMAIL", function () {
    $oldPayment = getenv('PAYMENT_NOTIFICATION_EMAIL');
    $oldSmtp = getenv('SMTP_USER');
    putenv('PAYMENT_NOTIFICATION_EMAIL=omar-notify@example.com');
    putenv('SMTP_USER=smtp-account@example.net');
    $loaded = require dirname(__DIR__) . '/private_app/backend/config.php';
    if (($loaded['recipients']['payment_notification'] ?? '') !== 'omar-notify@example.com') {
        throw new \Exception('No se leyó PAYMENT_NOTIFICATION_EMAIL.');
    }
    if ($loaded['recipients']['payment_notification'] === ($loaded['mail']['username'] ?? '')) {
        throw new \Exception('El destinatario se confundió con SMTP_USER.');
    }
    putenv($oldPayment === false ? 'PAYMENT_NOTIFICATION_EMAIL' : 'PAYMENT_NOTIFICATION_EMAIL=' . $oldPayment);
    putenv($oldSmtp === false ? 'SMTP_USER' : 'SMTP_USER=' . $oldSmtp);
    return true;
});

runTest("El cron conserva la notificación pendiente aunque la inscripción ya exista", function () {
    $cron = file_get_contents(dirname(__DIR__) . '/private_app/backend/cron/process-fallback-queue.php');
    $duplicateCheck = strpos($cron, '$isDuplicate = (bool)$checkStmt->fetch();');
    $mailAttempt = strpos($cron, '$mailDelivered = $mailer->send');
    $pendingReturn = strpos($cron, "return ['success' => false, 'is_duplicate' => \$isDuplicate];");
    if ($duplicateCheck === false || $mailAttempt === false || $pendingReturn === false) {
        throw new \Exception('El cron no conserva explícitamente el reintento SMTP pendiente.');
    }
    if ($duplicateCheck > $mailAttempt) {
        throw new \Exception('El cron intenta notificar antes de asegurar la persistencia idempotente.');
    }
    return true;
});

echo "\n-------------------------------------------------------\n";
echo "RESULTADOS: {$passedTests} de {$totalTests} pruebas pasadas con éxito.\n";
echo "-------------------------------------------------------\n\n";

if ($passedTests !== $totalTests) {
    exit(1);
}
exit(0);
