<?php
/**
 * Test Suite: Tarea 6 - Validación del Entorno PHP, Health Check y Protección de Diagnóstico
 */

declare(strict_types=1);

$baseUrl = 'http://127.0.0.1:8089';
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

function httpGet(string $url): array {
    $ctx = stream_context_create([
        'http' => [
            'method' => 'GET',
            'ignore_errors' => true,
            'timeout' => 5,
            'header' => "Accept: application/json\r\n"
        ]
    ]);
    $body = @file_get_contents($url, false, $ctx);
    $status = 0;
    if (isset($http_response_header) && preg_match('#HTTP/\S+\s+(\d+)#', $http_response_header[0], $m)) {
        $status = (int)$m[1];
    }
    return ['status' => $status, 'body' => $body ?: '', 'json' => json_decode($body ?: '', true)];
}

echo "======================================================\n";
echo "TEST SUITE: TAREA 6 - VALIDACIÓN DE ENTORNO Y HEALTH  \n";
echo "======================================================\n\n";

// Iniciar servidor local de pruebas si no está activo
$socket = @fsockopen('127.0.0.1', 8089, $errCode, $errStr, 1);
if (!$socket) {
    echo "Iniciando servidor PHP de prueba en puerto 8089...\n";
    $cmd = 'start /B C:\xampp\php\php.exe -S 127.0.0.1:8089 -t "c:\Users\User\Desktop\Quality-main\Quality-main"';
    pclose(popen($cmd, 'r'));
    sleep(2);
} else {
    fclose($socket);
}

// 1. Validar endpoint health.php
$healthRes = httpGet("{$baseUrl}/backend/health.php");
assertTest("health.php responde exitosamente vía HTTP", $healthRes['status'] === 200 || $healthRes['status'] === 503);

$data = $healthRes['json'] ?? [];
assertTest("health.php devuelve JSON con campo 'status'", isset($data['status']));
assertTest("health.php distingue estados válidos (healthy, degraded o unhealthy)", in_array($data['status'], ['healthy', 'degraded', 'unhealthy'], true));

// 2. Comprobar validación de versión PHP y extensiones
assertTest("health.php verifica compatibilidad de versión PHP", isset($data['system']['php_compatible']) && $data['system']['php_compatible'] === true);

$extensions = $data['checks']['extensions'] ?? [];
$requiredExts = ['mbstring', 'pdo', 'openssl', 'json'];
foreach ($requiredExts as $ext) {
    assertTest("health.php audita extensión obligatoria: {$ext}", isset($extensions[$ext]) && $extensions[$ext]['required'] === true);
    assertTest("Extensión obligatoria {$ext} está instalada y OK", isset($extensions[$ext]['status']) && $extensions[$ext]['status'] === 'OK');
}

// 3. Comprobar extensión opcional zlib y gd
assertTest("health.php audita extensión opcional zlib", isset($extensions['zlib']) && $extensions['zlib']['required'] === false);

// 4. Privacidad y protección de datos en health.php
$bodyStr = $healthRes['body'];
assertTest("health.php NUNCA expone contraseñas en su salida JSON", strpos($bodyStr, 'password') === false);
assertTest("health.php NUNCA expone credenciales SMTP en JSON", strpos($bodyStr, 'SMTP_') === false);
assertTest("health.php NUNCA expone rutas internas absolutas de disco (ej: C:\\Users\\...)", strpos($bodyStr, 'C:\\Users\\') === false && strpos($bodyStr, 'c:\\users\\') === false);

// 5. Protección de backend/tests/
$testsAccess = httpGet("{$baseUrl}/backend/tests/index.php");
assertTest("backend/tests/index.php devuelve HTTP 403 Forbidden", $testsAccess['status'] === 403);
assertTest("backend/tests/.htaccess existe", file_exists(__DIR__ . '/.htaccess'));

// 6. Protección de backend/maintenance/
$maintAccess = httpGet("{$baseUrl}/backend/maintenance/index.php");
assertTest("backend/maintenance/index.php devuelve HTTP 403 Forbidden", $maintAccess['status'] === 403);
assertTest("backend/maintenance/.htaccess existe", file_exists(__DIR__ . '/../maintenance/.htaccess'));

// 7. Protección contra ejecución web directa de scripts de mantenimiento
$rotateAccess = httpGet("{$baseUrl}/backend/maintenance/rotate_logs.php");
assertTest("rotate_logs.php rechaza peticiones HTTP sin token con HTTP 403", $rotateAccess['status'] === 403);

$optAccess = httpGet("{$baseUrl}/backend/maintenance/optimize_images.php");
assertTest("optimize_images.php rechaza peticiones HTTP con HTTP 403", $optAccess['status'] === 403);

// 8. Protección de directorios internos (core, resilience, services, utils)
$internalDirs = ['core', 'resilience', 'services', 'utils'];
foreach ($internalDirs as $dir) {
    $dirRes = httpGet("{$baseUrl}/backend/{$dir}/index.php");
    assertTest("backend/{$dir}/index.php devuelve HTTP 403 Forbidden", $dirRes['status'] === 403);
}

echo "\n======================================================\n";
echo "RESULTADOS: {$testsPassed} de {$testsTotal} pruebas aprobadas.\n";
echo "======================================================\n";

if ($testsPassed === $testsTotal) {
    echo "\n>>> TODAS LAS VALIDACIONES DE ENTORNO Y PROTECCIÓN PASARON <<<\n";
    exit(0);
} else {
    echo "\n>>> HUBO FALLOS EN LAS VALIDACIONES <<<\n";
    exit(1);
}

