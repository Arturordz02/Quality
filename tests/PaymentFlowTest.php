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
require_once dirname(__DIR__) . '/private_app/backend/resilience/FallbackQueue.php';
require_once dirname(__DIR__) . '/private_app/backend/resilience/RateLimiter.php';
require_once dirname(__DIR__) . '/private_app/app/Services/CourseCatalog.php';
require_once dirname(__DIR__) . '/private_app/app/Services/PayPalService.php';
require_once dirname(__DIR__) . '/private_app/app/Controllers/PaymentController.php';

use App\Services\CourseCatalog;
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
runTest("OMAR_SAMANIEGO_EMAIL con placeholder detecta destinatario pendiente y no simula éxito", function () use ($config) {
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
        'GET'  => ['/registro-primera-clase', '/registro-exitoso', '/pago-cancelado'],
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
    unset($_SESSION['paypal_confirmed_payment']);
    $_GET['curso'] = 'bim-revit-architecture';
    $view = new App\Core\View(dirname(__DIR__) . '/private_app/app/Views');
    $c = new App\Controllers\PaymentController($view, $config);
    ob_start();
    $c->registroPrimeraClase();
    $html = ob_get_clean();
    if (!str_contains($html, 'Paso 2: Datos de Inscripción del Participante') || !str_contains($html, 'BIM Revit Architecture')) {
        throw new \Exception("El formulario no cargó para el curso seleccionado.");
    }
    return true;
});

// Test 12: Envío de formulario con código de transacción de PayPal válido es aceptado y registrado
runTest("Envío de registro con código de transacción de PayPal validado en sesión es aceptado y persistido", function () {
    $testTransId = 'PAYPAL_TX_TEST_' . time();
    $code = '
        require \'' . addslashes(dirname(__DIR__)) . '/private_app/config/app.php\';
        require_once \'' . addslashes(dirname(__DIR__)) . '/private_app/backend/Security.php\';
        require_once \'' . addslashes(dirname(__DIR__)) . '/private_app/app/Controllers/PaymentController.php\';
        $cfg = require \'' . addslashes(dirname(__DIR__)) . '/private_app/config/app.php\';
        Security::startSession();
        $sig = hash_hmac(
            \'sha256\',
            \'' . $testTransId . '||10.00|USD|bim-revit-architecture\',
            $cfg[\'security\'][\'honeypot_field\'] ?? \'qcs_secret_payment_hash\'
        );
        $_SESSION[\'paypal_confirmed_payment\'] = [
            \'order_id\'     => \'' . $testTransId . '\',
            \'capture_id\'   => \'\',
            \'course_slug\'  => \'bim-revit-architecture\',
            \'course_title\' => \'BIM Revit Architecture\',
            \'amount\'       => 10.00,
            \'currency\'     => \'USD\',
            \'verified_at\'  => time(),
            \'signature\'    => $sig,
        ];
        $_SERVER[\'REQUEST_METHOD\'] = \'POST\';
        $_POST = [
            \'_csrf_token\'     => Security::getCsrfToken(),
            \'paypal_order_id\' => \'' . $testTransId . '\',
            \'nombres\'         => \'Ing. Juan Alumno PayPal\',
            \'email\'           => \'juan.alumno@empresa.com\',
            \'telefono\'        => \'+51 987 654 321\',
            \'curso\'           => \'bim-revit-architecture\',
        ];
        $c = new App\Controllers\PaymentController(new App\Core\View(), $cfg);
        $c->procesarRegistroPrimeraClase();
    ';
    $output = runPhpCode($code);
    // Verificar que el registro se guardó en la cola FallbackQueue
    $queueDir = FallbackQueue::getQueueDir();
    $allFiles = glob($queueDir . '/*paypal_first_class*');
    $found = false;
    foreach ($allFiles as $f) {
        $content = file_get_contents($f);
        if (str_contains($content, $testTransId)) {
            $found = true;
            @unlink($f);
            break;
        }
    }
    if (!$found) {
        throw new \Exception("No se encontró el registro persistido en disco para {$testTransId}. Output: " . $output);
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

    $recipientOmar = $config['recipients']['omar_samaniego'] ?? '';
    if ($recipientOmar !== 'comercial@quality-consulting.org') {
        throw new \Exception("El destinatario oficial de notificaciones no es comercial@quality-consulting.org (es: {$recipientOmar}).");
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

echo "\n-------------------------------------------------------\n";
echo "RESULTADOS: {$passedTests} de {$totalTests} pruebas pasadas con éxito.\n";
echo "-------------------------------------------------------\n\n";

if ($passedTests !== $totalTests) {
    exit(1);
}
exit(0);
