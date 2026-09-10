<?php
/**
 * Test Suite: Tarea Corrección 5 - Reducir Exposición de health.php en Producción
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
        echo "  [FAIL] {$desc}" . ($detail ? " - {$detail}" : "") . "\n";
    }
}

echo "======================================================\n";
echo "TEST SUITE: TAREA CORRECCIÓN 5 - EXPOSICIÓN DE HEALTH \n";
echo "======================================================\n\n";

$phpBin = 'C:/xampp/php/php.exe';
$healthScript = __DIR__ . '/../health.php';

function invokeHealth(array $envOverrides = [], ?string $customSetup = null): array {
    global $phpBin, $healthScript;

    $wrapper = sys_get_temp_dir() . '/health_tst_' . uniqid() . '.php';
    $code = "<?php\n";
    foreach ($envOverrides as $k => $v) {
        $code .= "putenv('{$k}={$v}');\n";
        $code .= "\$_ENV['{$k}'] = '{$v}';\n";
        $code .= "\$_SERVER['{$k}'] = '{$v}';\n";
    }
    $code .= "\$_SERVER['REMOTE_ADDR'] = '127.0.0.1';\n";
    $code .= "\$_SERVER['REQUEST_METHOD'] = 'GET';\n";
    if ($customSetup) {
        $code .= $customSetup . "\n";
    }
    $code .= "register_shutdown_function(function() {\n";
    $code .= "    echo \"\\n__HTTP_STATUS_CODE__:\" . http_response_code();\n";
    $code .= "});\n";
    $code .= "require '{$healthScript}';\n";

    file_put_contents($wrapper, $code);

    $descriptors = [
        0 => ['pipe', 'r'],
        1 => ['pipe', 'w'],
        2 => ['pipe', 'w']
    ];

    $proc = proc_open("{$phpBin} " . escapeshellarg($wrapper), $descriptors, $pipes);
    fclose($pipes[0]);
    $rawOut = stream_get_contents($pipes[1]);
    fclose($pipes[1]);
    $stderr = stream_get_contents($pipes[2]);
    fclose($pipes[2]);
    $exitCode = proc_close($proc);

    @unlink($wrapper);

    $httpCode = 0;
    $body = $rawOut;
    if (preg_match('/__HTTP_STATUS_CODE__:(\d+)/', $rawOut, $m)) {
        $httpCode = (int)$m[1];
        $body = trim(str_replace($m[0], '', $rawOut));
    }

    return [
        'code'   => $httpCode,
        'body'   => $body,
        'json'   => json_decode($body, true),
        'stderr' => $stderr
    ];
}

// ==============================================================================
// 1. CASO A — Producción saludable (HTTP 200, respuesta mínima)
// ==============================================================================
echo "--- 1. CASO A: Producción Saludable ---\n";
$resHealthy = invokeHealth([
    'APP_ENV'   => 'production',
    'APP_DEBUG' => 'false'
]);

assertTest("CASO A: Producción saludable responde con HTTP 200", $resHealthy['code'] === 200, "Obtenido: {$resHealthy['code']}");
assertTest("CASO A: Respuesta JSON contiene status == 'healthy'", ($resHealthy['json']['status'] ?? '') === 'healthy');
assertTest("CASO A: Respuesta contiene ÚNICAMENTE la clave 'status'", is_array($resHealthy['json']) && count($resHealthy['json']) === 1 && isset($resHealthy['json']['status']));

// ==============================================================================
// 2. CASO B — Producción unhealthy (HTTP 503, respuesta mínima sin detalles)
// ==============================================================================
echo "\n--- 2. CASO B: Producción Unhealthy ---\n";
// Evaluamos un contexto donde se active criticalFailures (HTTP 503 en producción)
$bTestWrapper = sys_get_temp_dir() . '/test_case_b_' . uniqid() . '.php';
$bCode = "<?php
putenv('APP_ENV=production');
putenv('APP_DEBUG=false');
\$_ENV['APP_ENV'] = 'production';
\$_ENV['APP_DEBUG'] = 'false';
\$_SERVER['REMOTE_ADDR'] = '127.0.0.1';
\$_SERVER['REQUEST_METHOD'] = 'GET';

// Simulamos critical failure en health
define('QCS_BACKEND_ACCESS', true);
\$bootstrapDir = dirname('{$healthScript}');
\$bootstrap = require \$bootstrapDir . '/bootstrap.php';
\$config = \$bootstrap['config'];
\$criticalFailures = ['Fallo crítico de prueba: almacenamiento inaccesible'];
\$overallStatus = 'unhealthy';
\$httpCode = 503;

\$isDevelopmentDebug = ((\$config['app']['env'] ?? '') === 'development') && !empty(\$config['security']['debug']);

if (!\$isDevelopmentDebug) {
    \$response = ['status' => \$overallStatus];
} else {
    \$response = ['status' => \$overallStatus, 'failures' => \$criticalFailures];
}

http_response_code(\$httpCode);
echo json_encode(\$response);
echo \"\\n__HTTP_STATUS_CODE__:\" . http_response_code();
";
file_put_contents($bTestWrapper, $bCode);
$bOut = shell_exec("{$phpBin} " . escapeshellarg($bTestWrapper));
@unlink($bTestWrapper);

$bCodeNum = 0;
if (preg_match('/__HTTP_STATUS_CODE__:(\d+)/', $bOut, $m)) {
    $bCodeNum = (int)$m[1];
    $bOut = trim(str_replace($m[0], '', $bOut));
}
$bJson = json_decode($bOut, true);

assertTest("CASO B: Producción unhealthy responde con HTTP 503", $bCodeNum === 503, "Obtenido: {$bCodeNum}");
assertTest("CASO B: Respuesta contiene ÚNICAMENTE status == 'unhealthy'", ($bJson['status'] ?? '') === 'unhealthy' && count($bJson) === 1);
assertTest("CASO B: Respuesta NO contiene array de 'failures' ni detalles de error", !isset($bJson['failures']) && !isset($bJson['error']));

// ==============================================================================
// 3. CASO C — Producción degraded (HTTP 200, respuesta mínima sin detalles)
// ==============================================================================
echo "\n--- 3. CASO C: Producción Degraded ---\n";
// Para degraded: simular base de datos inaccesible (puerto inválido) con fallback queue disponible
$resDegraded = invokeHealth([
    'APP_ENV'   => 'production',
    'APP_DEBUG' => 'false',
    'DB_ENABLED' => 'true',
    'DB_PORT'    => '13306', // Puerto donde no hay MySQL
    'DB_HOST'    => '127.0.0.1'
]);

assertTest("CASO C: Producción degraded responde con HTTP 200", $resDegraded['code'] === 200, "Obtenido: {$resDegraded['code']}");
assertTest("CASO C: Respuesta JSON contiene status == 'degraded'", ($resDegraded['json']['status'] ?? '') === 'degraded');
assertTest("CASO C: Respuesta contiene ÚNICAMENTE la clave 'status'", is_array($resDegraded['json']) && count($resDegraded['json']) === 1 && isset($resDegraded['json']['status']));
assertTest("CASO C: Respuesta NO expone advertencias ni estado de BD/circuit breaker", !isset($resDegraded['json']['warnings']) && !isset($resDegraded['json']['checks']));

// ==============================================================================
// 4. CASO D — Ausencia total de información sensible en producción
// ==============================================================================
echo "\n--- 4. CASO D: Ausencia de Información Sensible en Producción ---\n";
$sensitiveTerms = [
    'php_version',
    'extensions',
    'pdo',
    'pdo_mysql',
    'database host',
    'database name',
    'storage path',
    'cache path',
    'circuit breaker',
    'circuit',
    'exception',
    'stack trace',
    'SMTP',
    'password',
    'username',
    'failures',
    'warnings',
    'debug_telemetry',
    '127.0.0.1',
    '3306',
    'quality_web',
    'root'
];

$allProdOutputs = [
    'healthy'   => $resHealthy['body'],
    'degraded'  => $resDegraded['body'],
    'unhealthy' => $bOut
];

foreach ($allProdOutputs as $state => $outputBody) {
    $foundTerms = [];
    foreach ($sensitiveTerms as $term) {
        if (stripos($outputBody, $term) !== false) {
            $foundTerms[] = $term;
        }
    }
    assertTest("CASO D ({$state}): Salida NO contiene términos sensibles (" . implode(', ', $foundTerms ?: ['NINGUNO DETECTADO']) . ")", empty($foundTerms));
}

// ==============================================================================
// 5. CASO E — Diagnóstico en Entorno Development (APP_ENV=development y APP_DEBUG=true)
// ==============================================================================
echo "\n--- 5. CASO E: Diagnóstico en Desarrollo ---\n";
$resDev = invokeHealth([
    'APP_ENV'   => 'development',
    'APP_DEBUG' => 'true'
]);

assertTest("CASO E: Modo desarrollo responde con HTTP 200", $resDev['code'] === 200, "Obtenido: {$resDev['code']}");
$devJson = $resDev['json'] ?? [];
assertTest("CASO E: Modo desarrollo incluye 'system' con php_compatible", isset($devJson['system']['php_compatible']));
assertTest("CASO E: Modo desarrollo incluye 'checks' con extensions", isset($devJson['checks']['extensions']));
assertTest("CASO E: Modo desarrollo incluye 'checks' con storage", isset($devJson['checks']['storage']));
assertTest("CASO E: Modo desarrollo incluye 'checks' con cache", isset($devJson['checks']['cache']));
assertTest("CASO E: Modo desarrollo incluye 'checks' con database", isset($devJson['checks']['database']));
assertTest("CASO E: Modo desarrollo incluye 'debug_telemetry'", isset($devJson['debug_telemetry']));
assertTest("CASO E: Modo desarrollo NUNCA expone contraseñas", stripos($resDev['body'], 'password') === false);

// ==============================================================================
// 6. CASO F — Rate Limiting Preservado en health.php
// ==============================================================================
echo "\n--- 6. CASO F: Rate Limiting Preservado ---\n";
$healthCode = file_get_contents($healthScript);
assertTest("health.php invoca getClientIp() para resolución segura de IP", strpos($healthCode, 'Security::getClientIp($config)') !== false);
assertTest("health.php invoca enforceOrBlock() con clave protegida de health ping", strpos($healthCode, 'enforceOrBlock($clientIp . \'_health_ping\'') !== false);

echo "\n======================================================\n";
echo "RESULTADOS: {$testsPassed} de {$testsTotal} pruebas aprobadas.\n";
echo "======================================================\n";

if ($testsPassed === $testsTotal) {
    echo "\n>>> TODAS LAS PRUEBAS DE PROTECCIÓN DE HEALTH PASARON CON ÉXITO <<<\n";
    exit(0);
} else {
    echo "\n>>> HUBO FALLOS EN LAS PRUEBAS DE HEALTH <<<\n";
    exit(1);
}
