<?php
/**
 * Test Suite: Tarea 5 - Seguridad SMTP y Validación Estricta TLS
 */

declare(strict_types=1);

$testsPassed = 0;
$testsTotal = 0;

function assertTest(string $desc, bool $condition, string $detail = ''): void {
    global $testsPassed, $testsTotal;
    $testsTotal++;
    if ($condition) {
        $testsPassed++;
        echo "  [PASS] {$desc}\n";
    } else {
        echo "  [FAIL] {$desc} - {$detail}\n";
    }
}

echo "======================================================\n";
echo "TEST SUITE: TAREA 5 - SEGURIDAD SMTP Y VALIDACIÓN TLS \n";
echo "======================================================\n\n";

define('QCS_BACKEND_ACCESS', true);
require_once __DIR__ . '/../Security.php';
require_once __DIR__ . '/../SmtpMailer.php';

// 1. Validar entorno de producción por defecto (Verificación estricta)
$prodConfig = [
    'app' => ['env' => 'production'],
    'mail' => [
        'driver' => 'smtp',
        'host'   => 'mail.quality-consulting.org',
        'port'   => 465,
        'encryption' => 'ssl',
        'auth'   => true,
        'username' => 'contacto@quality-consulting.org',
        'password' => 'secret_dummy_pass',
        'allow_self_signed' => false,
    ]
];

$mailerProd = new SmtpMailer($prodConfig);
$sslOptsProd = $mailerProd->getSslContextOptions();

assertTest("Producción: verify_peer es estrictamente TRUE", $sslOptsProd['verify_peer'] === true);
assertTest("Producción: verify_peer_name es estrictamente TRUE", $sslOptsProd['verify_peer_name'] === true);
assertTest("Producción: allow_self_signed es estrictamente FALSE", $sslOptsProd['allow_self_signed'] === false);
assertTest("Producción: peer_name coincide con el host configurado", $sslOptsProd['peer_name'] === 'mail.quality-consulting.org');

// 2. Intentar forzar allow_self_signed en producción (Debe ser ignorado / denegado)
$prodForcedConfig = [
    'app' => ['env' => 'production'],
    'mail' => [
        'driver' => 'smtp',
        'host'   => 'mail.quality-consulting.org',
        'port'   => 465,
        'encryption' => 'ssl',
        'auth'   => true,
        'username' => 'contacto@quality-consulting.org',
        'password' => 'secret_dummy_pass',
        'allow_self_signed' => true, // Intento de habilitar en prod
    ]
];

$mailerProdForced = new SmtpMailer($prodForcedConfig);
$sslOptsProdForced = $mailerProdForced->getSslContextOptions();

assertTest("Producción con flag inseguro: verify_peer permanece TRUE (Blindado)", $sslOptsProdForced['verify_peer'] === true);
assertTest("Producción con flag inseguro: verify_peer_name permanece TRUE (Blindado)", $sslOptsProdForced['verify_peer_name'] === true);
assertTest("Producción con flag inseguro: allow_self_signed permanece FALSE (Blindado)", $sslOptsProdForced['allow_self_signed'] === false);

// 3. Entorno de desarrollo sin flag explícito (Debe mantener TLS estricto por defecto)
$devDefaultConfig = [
    'app' => ['env' => 'development'],
    'mail' => [
        'driver' => 'smtp',
        'host'   => 'mail.quality-consulting.org',
        'port'   => 465,
        'encryption' => 'ssl',
        'auth'   => true,
        'username' => 'contacto@quality-consulting.org',
        'password' => 'secret_dummy_pass',
        'allow_self_signed' => false,
    ]
];

$mailerDevDefault = new SmtpMailer($devDefaultConfig);
$sslOptsDevDefault = $mailerDevDefault->getSslContextOptions();

assertTest("Desarrollo por defecto: verify_peer es TRUE", $sslOptsDevDefault['verify_peer'] === true);
assertTest("Desarrollo por defecto: verify_peer_name es TRUE", $sslOptsDevDefault['verify_peer_name'] === true);
assertTest("Desarrollo por defecto: allow_self_signed es FALSE", $sslOptsDevDefault['allow_self_signed'] === false);

// 4. Entorno de desarrollo con flag explícito de certificados inseguros
$devInsecureConfig = [
    'app' => ['env' => 'development'],
    'mail' => [
        'driver' => 'smtp',
        'host'   => 'localhost',
        'port'   => 465,
        'encryption' => 'ssl',
        'auth'   => false,
        'allow_self_signed' => true,
    ]
];

$mailerDevInsecure = new SmtpMailer($devInsecureConfig);
$sslOptsDevInsecure = $mailerDevInsecure->getSslContextOptions();

assertTest("Desarrollo con flag explícito: allow_self_signed es TRUE", $sslOptsDevInsecure['allow_self_signed'] === true);
assertTest("Desarrollo con flag explícito: verify_peer es FALSE", $sslOptsDevInsecure['verify_peer'] === false);

// 5. Manejo seguro de errores y no exposición de secretos
$secretPassword = 'SUPER_SECRET_SMTP_PASS_1234!';
$failingConfig = [
    'app' => ['env' => 'production'],
    'mail' => [
        'driver' => 'smtp',
        'host'   => '127.0.0.1', // Puerto sin servicio SMTP para forzar fallo
        'port'   => 59999,
        'encryption' => 'ssl',
        'auth'   => true,
        'username' => 'test@quality-consulting.org',
        'password' => $secretPassword,
    ]
];

$mailerFailing = new SmtpMailer($failingConfig);
$result = $mailerFailing->send('dest@example.com', 'Asunto Prueba', '<p>Mensaje</p>');

assertTest("Envío a servidor inalcanzable falla controladamente (retorna false)", $result === false);
$lastErr = (string)$mailerFailing->getLastError();
assertTest("Mensaje de error controlado existe", !empty($lastErr));
assertTest("Mensaje de error NUNCA expone la contraseña SMTP", strpos($lastErr, $secretPassword) === false);

// 6. Verificar que config.php activo cumple con las directivas
$bootstrap = require __DIR__ . '/../bootstrap.php';
$activeMailer = new SmtpMailer($bootstrap['config']);
$activeSslOpts = $activeMailer->getSslContextOptions();
assertTest("Configuración activa: verify_peer_name activo", $activeSslOpts['verify_peer_name'] === true || $bootstrap['config']['app']['env'] === 'development');

// 7. Verificación de Comportamiento Fail-Closed de STARTTLS (Casos A, B, C, D, E)
echo "\n--- 7. Verificación Fail-Closed de STARTTLS ---\n";

$mockScript = __DIR__ . '/mock_smtp_server.php';

function executeMockProbe(string $mode, string $mockScript, ?string $certPath = null): array {
    $s = @stream_socket_server('tcp://127.0.0.1:0', $errno, $errstr);
    if (!$s) return ['error' => 'socket_server_failed'];
    $port = (int)parse_url('tcp://' . stream_socket_get_name($s, false), PHP_URL_PORT);
    fclose($s);

    $logFile = sys_get_temp_dir() . '/mock_smtp_test_' . uniqid() . '.json';

    $cmd = "C:\\xampp\\php\\php.exe " . escapeshellarg($mockScript) . " {$port} {$mode} " . escapeshellarg($logFile);
    if ($certPath && file_exists($certPath)) {
        $cmd .= " " . escapeshellarg($certPath);
    }

    $proc = proc_open($cmd, [
        0 => ['pipe', 'r'],
        1 => ['pipe', 'w'],
        2 => ['pipe', 'w']
    ], $pipes);

    usleep(250000); // 250ms para inicialización

    $secretUser = 'usuario_test@quality-consulting.org';
    $secretPass = 'PASSWORD_SUPER_SECRETO_987654!';

    $config = [
        'app' => ['env' => 'development'],
        'mail' => [
            'driver' => 'smtp',
            'host' => '127.0.0.1',
            'port' => $port,
            'encryption' => 'tls',
            'auth' => true,
            'username' => $secretUser,
            'password' => $secretPass,
            'allow_self_signed' => true
        ]
    ];

    $mailer = new SmtpMailer($config);
    $sendResult = $mailer->send('dest@example.com', 'Test Subject', '<p>Test</p>');
    $lastError = (string)$mailer->getLastError();

    proc_close($proc);

    $mockData = [];
    if (file_exists($logFile)) {
        $mockData = json_decode(file_get_contents($logFile), true) ?: [];
        @unlink($logFile);
    }

    return [
        'sendResult' => $sendResult,
        'lastError'  => $lastError,
        'mockData'   => $mockData,
        'secretUser' => $secretUser,
        'secretPass' => $secretPass
    ];
}

// Generar certificado temporal para Caso A
$tmpCert = sys_get_temp_dir() . '/smtp_mock_cert.pem';
$cnf = 'C:/xampp/php/extras/ssl/openssl.cnf';
$privkey = openssl_pkey_new([
    'private_key_bits' => 2048,
    'private_key_type' => OPENSSL_KEYTYPE_RSA,
    'config' => $cnf
]);
if ($privkey) {
    $dn = ['commonName' => '127.0.0.1'];
    $csr = openssl_csr_new($dn, $privkey, ['config' => $cnf]);
    $cert = openssl_csr_sign($csr, null, $privkey, 1, ['config' => $cnf]);
    openssl_x509_export($cert, $c);
    openssl_pkey_export($privkey, $k, null, ['config' => $cnf]);
    file_put_contents($tmpCert, $c . "\n" . $k);
}

// CASO B: STARTTLS responde código distinto de 220 (rechazado) -> Conexión abortada, NO se ejecuta AUTH LOGIN
$probeB = executeMockProbe('reject_starttls', $mockScript);
assertTest("Caso B: Servidor rechaza STARTTLS -> SmtpMailer retorna false", $probeB['sendResult'] === false);
assertTest("Caso B: AUTH LOGIN NUNCA se ejecutó tras rechazo de STARTTLS", ($probeB['mockData']['authLoginSeen'] ?? true) === false);
assertTest("Caso B: Error controlado emitido tras rechazo STARTTLS", strpos($probeB['lastError'], 'rechazó STARTTLS') !== false);

// CASO C: STARTTLS responde 220 pero negociación TLS falla -> Conexión abortada, NO se ejecuta AUTH LOGIN
$probeC = executeMockProbe('crypto_fail', $mockScript);
assertTest("Caso C: Negociación criptográfica falla -> SmtpMailer retorna false", $probeC['sendResult'] === false);
assertTest("Caso C: AUTH LOGIN NUNCA se ejecutó tras fallo en negociación TLS", ($probeC['mockData']['authLoginSeen'] ?? true) === false);
assertTest("Caso C: Error controlado emitido tras fallo criptográfico", strpos($probeC['lastError'], 'Fallo en la negociación TLS segura') !== false);

// CASO A: STARTTLS responde 220 y TLS se negocia correctamente -> el flujo puede continuar hacia autenticación
if (file_exists($tmpCert)) {
    $probeA = executeMockProbe('tls_success', $mockScript, $tmpCert);
    assertTest("Caso A: STARTTLS y TLS exitoso -> flujo avanzó hacia autenticación (AUTH LOGIN visto en servidor seguro)", ($probeA['mockData']['authLoginSeen'] ?? false) === true);
    @unlink($tmpCert);
}

// CASO D: SMTP_ENCRYPTION=ssl / puerto 465 -> Mantiene comportamiento existente (conexión nativa ssl://)
$mailerSsl = new SmtpMailer([
    'app' => ['env' => 'production'],
    'mail' => [
        'driver' => 'smtp',
        'host'   => 'mail.quality-consulting.org',
        'port'   => 465,
        'encryption' => 'ssl',
        'auth'   => true,
        'username' => 'contacto@quality-consulting.org',
        'password' => 'secret_pass'
    ]
]);
$sslContextOpts = $mailerSsl->getSslContextOptions();
assertTest("Caso D: SSL 465 mantiene verify_peer en TRUE para producción", $sslContextOpts['verify_peer'] === true);
assertTest("Caso D: SSL 465 mantiene validación de peer_name", $sslContextOpts['verify_peer_name'] === true);
assertTest("Caso D: SSL 465 preserva allow_self_signed en FALSE", $sslContextOpts['allow_self_signed'] === false);

// CASO E: Los errores producidos NO contienen usuario ni contraseña SMTP
$hasSecretInB = (strpos($probeB['lastError'], $probeB['secretPass']) !== false) || (strpos($probeB['lastError'], $probeB['secretUser']) !== false);
$hasSecretInC = (strpos($probeC['lastError'], $probeC['secretPass']) !== false) || (strpos($probeC['lastError'], $probeC['secretUser']) !== false);
assertTest("Caso E: Mensaje de error en Caso B NO expone usuario ni contraseña", !$hasSecretInB);
assertTest("Caso E: Mensaje de error en Caso C NO expone usuario ni contraseña", !$hasSecretInC);

echo "\n======================================================\n";
echo "RESULTADOS: {$testsPassed} de {$testsTotal} pruebas aprobadas.\n";
echo "======================================================\n";

if ($testsPassed === $testsTotal) {
    echo "\n>>> TODAS LAS PRUEBAS DE SEGURIDAD SMTP PASARON CON ÉXITO <<<\n";
    exit(0);
} else {
    echo "\n>>> HUBO FALLOS EN LAS PRUEBAS SMTP <<<\n";
    exit(1);
}

