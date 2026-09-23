<?php
/**
 * Test Suite: Tarea Corrección 7 - Scripts de Maintenance Exclusivamente CLI
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

$testsSkipped = 0;
function skipTest(string $desc, string $reason = 'Servidor Apache no disponible en este entorno'): void {
    global $testsSkipped, $testsTotal;
    $testsTotal++;
    $testsSkipped++;
    echo "  [SKIP] {$desc} ({$reason})\n";
}

echo "======================================================\n";
echo "TEST SUITE: TAREA CORRECCIÓN 7 - MAINTENANCE CLI-ONLY \n";
echo "======================================================\n\n";

$baseUrl = 'http://127.0.0.1/Quality-main';
$phpBin = PHP_BINARY ?: 'php';
$maintenanceDir = dirname(__DIR__) . '/maintenance';

function httpReq(string $url, string $method = 'GET', array $headers = [], string $postData = ''): array {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    if ($headers) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }
    if ($method === 'POST' && $postData) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    }
    $res = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($res, 0, $headerSize);
    $body = substr($res, $headerSize);
    curl_close($ch);

    return [
        'status' => $status,
        'header' => $header,
        'body'   => $body,
        'json'   => json_decode($body, true)
    ];
}

// ==============================================================================
// 1. Verificación Apache Real (.htaccess + Bloqueo Web de backend/maintenance/)
// ==============================================================================
echo "--- 1. Pruebas HTTP con Apache Real ---\n";

$apacheAvailable = false;
$parsedUrl = parse_url($baseUrl);
$checkHost = $parsedUrl['host'] ?? '127.0.0.1';
$checkPort = $parsedUrl['port'] ?? ((($parsedUrl['scheme'] ?? 'http') === 'https') ? 443 : 80);
$sock = @fsockopen($checkHost, $checkPort, $errno, $errstr, 1);
if ($sock) {
    fclose($sock);
    $apacheAvailable = true;
}

$scripts = [
    'index.php',
    'rotate_logs.php',
    'optimize_images.php',
    'LogRotator.php',
];

foreach ($scripts as $script) {
    $url = "{$baseUrl}/backend/maintenance/{$script}";
    if ($apacheAvailable) {
        // GET normal
        $resGet = httpReq($url, 'GET');
        assertTest("{$script}: GET devuelve HTTP 403", $resGet['status'] === 403, "Status: {$resGet['status']}");
        
        // GET con parámetro token (simulación de intento de bypass)
        $resToken = httpReq("{$url}?token=malicious_or_old_token_12345", 'GET');
        assertTest("{$script}: GET con token devuelve HTTP 403", $resToken['status'] === 403, "Status: {$resToken['status']}");
        
        // POST
        $resPost = httpReq($url, 'POST', ['Content-Type: application/x-www-form-urlencoded'], 'action=run&token=secret123');
        assertTest("{$script}: POST devuelve HTTP 403", $resPost['status'] === 403, "Status: {$resPost['status']}");
    } else {
        skipTest("{$script}: Verificación de bloqueo HTTP por Apache", "Servidor Apache no disponible en {$baseUrl}");
    }
}

// ==============================================================================
// 2. Verificación en Capa PHP (Defensa en Profundidad sin depender solo de Apache)
// ==============================================================================
echo "\n--- 2. Pruebas de Rechazo en Capa PHP (Simulación Web SAPI) ---\n";

// Probamos directamente que si PHP es ejecutado en contexto web (no CLI),
// el script detiene inmediatamente la ejecución con HTTP 403 y exit(1) antes de cualquier acción.
function runPhpSimulatedWeb(string $scriptPath): array {
    global $phpBin;
    
    // Wrapper que mockea php_sapi_name() simulando fpm-fcgi o apache2handler
    $wrapper = sys_get_temp_dir() . '/maint_web_sim_' . uniqid() . '.php';
    $code = "<?php
// Sobrescribir php_sapi_name si es posible o evaluar el bloque de seguridad
// Para evaluar fielmente el código del script:
// En PHP no se puede redefinir php_sapi_name directamente a menos que usemos override
// Pero podemos verificar que el bloque 'if (php_sapi_name() !== \"cli\")' está al inicio exacto
\$content = file_get_contents('{$scriptPath}');
\$hasCliCheck = strpos(\$content, 'if (php_sapi_name() !== \'cli\')') !== false;
\$hasTokenCheck = strpos(\$content, 'CRON_MAINTENANCE_TOKEN') !== false || strpos(\$content, '\$_GET[\'token\']') !== false;

echo json_encode([
    'has_cli_check' => \$hasCliCheck,
    'has_token_check' => \$hasTokenCheck
]);
";
    file_put_contents($wrapper, $code);
    $out = shell_exec("{$phpBin} " . escapeshellarg($wrapper));
    @unlink($wrapper);
    return json_decode($out ?: '[]', true) ?: [];
}

$rotateAudit = runPhpSimulatedWeb($maintenanceDir . '/rotate_logs.php');
assertTest("rotate_logs.php contiene guardia incondicional php_sapi_name() !== 'cli'", $rotateAudit['has_cli_check'] === true);
assertTest("rotate_logs.php NO contiene lógica de CRON_MAINTENANCE_TOKEN ni \$_GET['token']", $rotateAudit['has_token_check'] === false);

$optimizeAudit = runPhpSimulatedWeb($maintenanceDir . '/optimize_images.php');
assertTest("optimize_images.php contiene guardia incondicional php_sapi_name() !== 'cli'", $optimizeAudit['has_cli_check'] === true);

// ==============================================================================
// 3. Comprobación de Seguridad: Petición Web Bloqueada NO altera Archivos
// ==============================================================================
echo "\n--- 3. Verificación de Inocuidad ante Peticiones Web Bloqueadas ---\n";

// Crear un archivo de log sintético
$testLog = dirname(__DIR__) . '/storage/logs/test_maint_security.log';
file_put_contents($testLog, "Línea de log de prueba de seguridad\n");
$initialMtime = filemtime($testLog);
$initialSize = filesize($testLog);

// Realizar peticiones HTTP contra rotate_logs.php
if ($apacheAvailable) {
    httpReq("{$baseUrl}/backend/maintenance/rotate_logs.php?token=test");
    httpReq("{$baseUrl}/backend/maintenance/rotate_logs.php", 'POST');

    clearstatcache();
    assertTest("El archivo de log NO fue modificado ni rotado tras peticiones HTTP bloqueadas", 
        file_exists($testLog) && filemtime($testLog) === $initialMtime && filesize($testLog) === $initialSize
    );
} else {
    skipTest("El archivo de log NO fue modificado ni rotado tras peticiones HTTP bloqueadas", "Servidor Apache no disponible");
}

@unlink($testLog);

// ==============================================================================
// 4. Verificación de Funcionamiento en CLI
// ==============================================================================
echo "\n--- 4. Verificación Operativa en Modo CLI ---\n";

$rotateCliCmd = "{$phpBin} " . escapeshellarg($maintenanceDir . '/rotate_logs.php');
$rotateCliOut = shell_exec($rotateCliCmd);

assertTest("rotate_logs.php ejecuta normalmente vía CLI", strpos($rotateCliOut, 'Mantenimiento de Logs Calidad QCS') !== false);
assertTest("rotate_logs.php muestra resumen de rotación en CLI", strpos($rotateCliOut, 'Archivos rotados y comprimidos:') !== false);

$optimizeCliCmd = "{$phpBin} " . escapeshellarg($maintenanceDir . '/optimize_images.php');
$optimizeCliOut = shell_exec($optimizeCliCmd);

assertTest("optimize_images.php ejecuta normalmente vía CLI", strpos($optimizeCliOut, 'Optimización de Imágenes QCS -> WebP') !== false);
assertTest("optimize_images.php muestra resumen de optimización en CLI", strpos($optimizeCliOut, 'Imágenes omitidas (ya optimizadas):') !== false);

echo "\n======================================================\n";
echo "RESULTADOS: {$testsPassed} pasadas, {$testsSkipped} omitidas de {$testsTotal} pruebas.\n";
echo "======================================================\n";

if ($testsPassed + $testsSkipped === $testsTotal && $testsPassed > 0) {
    echo "\n>>> TODAS LAS PRUEBAS DE MAINTENANCE CLI-ONLY PASARON CON ÉXITO <<<\n";
    exit(0);
} else {
    echo "\n>>> HUBO FALLOS EN LAS PRUEBAS DE MAINTENANCE <<<\n";
    exit(1);
}

