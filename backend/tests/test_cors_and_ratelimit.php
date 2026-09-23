<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Test Suite: Tarea 8 - CORS Seguro y Protección de Rate Limiting
 */

declare(strict_types=1);

define('QCS_BACKEND_ACCESS', true);

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

function sendHttpRequest(string $url, string $method = 'GET', array $headers = [], ?string $body = null): array {
    $headerLines = [];
    foreach ($headers as $k => $v) {
        $headerLines[] = "{$k}: {$v}";
    }

    $opts = [
        'http' => [
            'method'        => $method,
            'ignore_errors' => true,
            'timeout'       => 5,
            'header'        => implode("\r\n", $headerLines) . "\r\n"
        ]
    ];
    if ($body !== null) {
        $opts['http']['content'] = $body;
    }

    $ctx = stream_context_create($opts);
    $responseBody = @file_get_contents($url, false, $ctx);
    $status = 0;
    $respHeaders = [];
    if (isset($http_response_header) && is_array($http_response_header)) {
        if (preg_match('#HTTP/\S+\s+(\d+)#', $http_response_header[0], $m)) {
            $status = (int)$m[1];
        }
        foreach ($http_response_header as $hdr) {
            $parts = explode(':', $hdr, 2);
            if (count($parts) === 2) {
                $respHeaders[strtolower(trim($parts[0]))] = trim($parts[1]);
            }
        }
    }

    return [
        'status'  => $status,
        'headers' => $respHeaders,
        'body'    => $responseBody ?: '',
        'json'    => json_decode($responseBody ?: '', true)
    ];
}

echo "======================================================\n";
echo "TEST SUITE: TAREA 8 - CORS RESTRINGIDO Y RATE LIMITING\n";
echo "======================================================\n\n";

$bootstrap = require dirname(__DIR__) . '/bootstrap.php';
$config = $bootstrap['config'];

// Iniciar servidor local de pruebas si no está activo
$socket = @fsockopen('127.0.0.1', 8089, $errCode, $errStr, 1);
if (!$socket) {
    echo "Iniciando servidor PHP de prueba en puerto 8089...\n";
    $phpBin = PHP_BINARY ?: 'php';
    $rootDir = escapeshellarg(dirname(__DIR__, 2));
    $cmd = "start /B {$phpBin} -S 127.0.0.1:8089 -t {$rootDir}";
    pclose(popen($cmd, 'r'));
    sleep(2);
} else {
    fclose($socket);
}

// --------------------------------------------------------------------------
// 1. VERIFICACIÓN DE CORS: NUNCA USAR WILDCARD '*'
// --------------------------------------------------------------------------
echo "--- 1. Verificación de Restricción CORS ---\n";

// Petición estándar sin cabecera Origin (Same-Origin natural)
$reqNoOrigin = sendHttpRequest("{$baseUrl}/backend/api/soft-skills.php?action=questions");
assertTest("Petición Same-Origin NO incluye Access-Control-Allow-Origin", 
    !isset($reqNoOrigin['headers']['access-control-allow-origin']), 
    $reqNoOrigin['headers']['access-control-allow-origin'] ?? 'Cabecera presente');
assertTest("Respuesta Same-Origin contiene cabeceras de seguridad nosniff y SAMEORIGIN", 
    ($reqNoOrigin['headers']['x-content-type-options'] ?? '') === 'nosniff' &&
    ($reqNoOrigin['headers']['x-frame-options'] ?? '') === 'SAMEORIGIN');

// Petición con Origin oficial de producción
$reqOfficial = sendHttpRequest("{$baseUrl}/backend/api/soft-skills.php?action=questions", 'GET', [
    'Origin' => 'https://quality-consulting.org'
]);
assertTest("Petición con origen oficial recibe Access-Control-Allow-Origin con el dominio exacto", 
    ($reqOfficial['headers']['access-control-allow-origin'] ?? '') === 'https://quality-consulting.org');
assertTest("Petición CORS autorizada envía cabecera Vary: Origin", 
    isset($reqOfficial['headers']['vary']) && strpos($reqOfficial['headers']['vary'], 'Origin') !== false);
assertTest("NUNCA se devuelve comodín '*' para orígenes autorizados", 
    ($reqOfficial['headers']['access-control-allow-origin'] ?? '') !== '*');

// Petición con Origin secundario www
$reqWww = sendHttpRequest("{$baseUrl}/backend/api/soft-skills.php?action=questions", 'GET', [
    'Origin' => 'https://www.quality-consulting.org'
]);
assertTest("Petición con origen www recibe Access-Control-Allow-Origin correspondiente", 
    ($reqWww['headers']['access-control-allow-origin'] ?? '') === 'https://www.quality-consulting.org');

// Petición con Origen no autorizado / malicioso
$reqMalicious = sendHttpRequest("{$baseUrl}/backend/api/soft-skills.php?action=questions", 'GET', [
    'Origin' => 'https://sitio-malicioso-atacante.com'
]);
assertTest("Origen no autorizado NO recibe cabecera Access-Control-Allow-Origin", 
    !isset($reqMalicious['headers']['access-control-allow-origin']));

// Preflight OPTIONS con origen no autorizado
$reqPreflightMalicious = sendHttpRequest("{$baseUrl}/backend/api/soft-skills.php?action=questions", 'OPTIONS', [
    'Origin' => 'https://sitio-malicioso-atacante.com',
    'Access-Control-Request-Method' => 'POST'
]);
assertTest("Preflight OPTIONS de origen no autorizado es rechazado con HTTP 403", 
    $reqPreflightMalicious['status'] === 403);
assertTest("Preflight no autorizado NO recibe Access-Control-Allow-Origin", 
    !isset($reqPreflightMalicious['headers']['access-control-allow-origin']));

// Preflight OPTIONS con origen autorizado
$reqPreflightOk = sendHttpRequest("{$baseUrl}/backend/api/soft-skills.php?action=questions", 'OPTIONS', [
    'Origin' => 'https://quality-consulting.org',
    'Access-Control-Request-Method' => 'POST'
]);
assertTest("Preflight OPTIONS de origen oficial es aceptado con HTTP 204", 
    $reqPreflightOk['status'] === 204);
assertTest("Preflight OPTIONS contiene métodos GET, POST, OPTIONS", 
    isset($reqPreflightOk['headers']['access-control-allow-methods']) &&
    strpos($reqPreflightOk['headers']['access-control-allow-methods'], 'POST') !== false);

// --------------------------------------------------------------------------
// 2. VERIFICACIÓN DE RATE LIMITING Y PREVENCIÓN DE SPOOFING DE IP
// --------------------------------------------------------------------------
echo "\n--- 2. Verificación de Rate Limiting y Protección contra Spoofing ---\n";

// Caso A: TRUST_PROXY_HEADERS=false (Por defecto en GoDaddy / Apache directo)
$mockServerDefault = [
    'REMOTE_ADDR'          => '192.168.1.100',
    'HTTP_X_FORWARDED_FOR' => '203.0.113.195, 10.0.0.1',
    'HTTP_CF_CONNECTING_IP'=> '198.51.100.22',
    'HTTP_X_REAL_IP'       => '192.0.2.1',
];
$configDirect = [
    'security' => [
        'trust_proxy_headers' => false,
        'trusted_proxies'     => ['127.0.0.1', '::1'],
    ]
];

// Inyectar entorno mock temporal
$_SERVER = array_merge($_SERVER, $mockServerDefault);
$detectedIpDirect = Security::getClientIp($configDirect);
assertTest("Con TRUST_PROXY_HEADERS=false se ignora X-Forwarded-For y se usa REMOTE_ADDR", 
    $detectedIpDirect === '192.168.1.100', "Obtenido: {$detectedIpDirect}");

// Caso B: Atacante envía cabecera malformada o inyección
$_SERVER['HTTP_X_FORWARDED_FOR'] = "<script>alert(1)</script>, ' OR 1=1 --";
$detectedIpClean = Security::getClientIp($configDirect);
assertTest("Cabeceras maliciosas en X-Forwarded-For no contaminan la IP detectada", 
    $detectedIpClean === '192.168.1.100');

// Caso C: TRUST_PROXY_HEADERS=true pero conexión directa NO proviene de proxy confiable
$configProxy = [
    'security' => [
        'trust_proxy_headers' => true,
        'trusted_proxies'     => ['127.0.0.1', '10.0.0.50'],
    ]
];
$_SERVER['REMOTE_ADDR'] = '198.51.100.99'; // Atacante directo en internet
$_SERVER['HTTP_X_FORWARDED_FOR'] = '1.1.1.1';
$detectedUntrustedProxy = Security::getClientIp($configProxy);
assertTest("Con TRUST_PROXY_HEADERS=true si REMOTE_ADDR no es proxy confiable se ignora X-Forwarded-For", 
    $detectedUntrustedProxy === '198.51.100.99', "Obtenido: {$detectedUntrustedProxy}");

// Caso D: TRUST_PROXY_HEADERS=true y conexión proviene de proxy confiable (ej. localhost/Cloudflare proxy)
unset($_SERVER['HTTP_CF_CONNECTING_IP'], $_SERVER['HTTP_X_REAL_IP']);
$_SERVER['REMOTE_ADDR'] = '10.0.0.50'; // IP de proxy confiable
$_SERVER['HTTP_X_FORWARDED_FOR'] = '203.0.113.88, 10.0.0.50';
$detectedTrustedProxy = Security::getClientIp($configProxy);
assertTest("Con TRUST_PROXY_HEADERS=true desde proxy confiable se extrae la IP del cliente legítimo", 
    $detectedTrustedProxy === '203.0.113.88', "Obtenido: {$detectedTrustedProxy}");

// Caso E: Cloudflare CF-Connecting-IP desde proxy confiable
$_SERVER['REMOTE_ADDR'] = '127.0.0.1';
$_SERVER['HTTP_CF_CONNECTING_IP'] = '198.51.100.77';
$detectedCf = Security::getClientIp($configProxy);
assertTest("Desde proxy confiable se respeta CF-Connecting-IP prioritariamente", 
    $detectedCf === '198.51.100.77', "Obtenido: {$detectedCf}");

// Restaurar REMOTE_ADDR de loopback para pruebas subsiguientes
$_SERVER['REMOTE_ADDR'] = '127.0.0.1';
unset($_SERVER['HTTP_X_FORWARDED_FOR'], $_SERVER['HTTP_CF_CONNECTING_IP'], $_SERVER['HTTP_X_REAL_IP']);

// --------------------------------------------------------------------------
// 3. PRUEBA DE BLOQUEO DE RATE LIMITER ANTE INTENTO DE BYPASS VÍA X-FORWARDED-FOR
// --------------------------------------------------------------------------
echo "\n--- 3. Resistencia de RateLimiter ante Spoofing de Cabeceras ---\n";

// Crear instancia limpia de RateLimiter para prueba de bypass
$testRateLimiter = new RateLimiter();
$limiterKeyPrefix = 'test_spoof_ip_' . bin2hex(random_bytes(4));

// Simular 3 peticiones desde la misma máquina pero rotando X-Forwarded-For
// Con la protección, la IP devuelta debe ser siempre la misma (REMOTE_ADDR),
// acumulando las peticiones en el mismo contador y bloqueando en el límite.
$limitMax = 3;
$blockedAtFourth = false;

for ($i = 1; $i <= 4; $i++) {
    // Simular que el cliente intenta evadir enviando una IP falsa distinta cada vez
    $_SERVER['REMOTE_ADDR'] = '192.168.1.200';
    $_SERVER['HTTP_X_FORWARDED_FOR'] = "10.20.30.{$i}";
    
    // Con configDirect (trust_proxy_headers = false), la IP devuelta es 192.168.1.200
    $ip = Security::getClientIp($configDirect);
    $check = $testRateLimiter->check($ip . '_' . $limiterKeyPrefix, $limitMax, 60, false);
    
    if ($i <= 3) {
        assertTest("Petición {$i} permitida dentro de la ventana", $check['allowed'] === true);
    } else {
        $blockedAtFourth = !$check['allowed'];
        assertTest("Petición 4 es bloqueada por RateLimiter a pesar de rotar X-Forwarded-For (Anti-Bypass OK)", 
            $blockedAtFourth === true, "Allowed fue: " . ($check['allowed'] ? 'true' : 'false'));
    }
}

// --------------------------------------------------------------------------
// 4. FUNCIONAMIENTO NORMAL DE LOS ENDPOINTS DEL FRONTEND
// --------------------------------------------------------------------------
echo "\n--- 4. Funcionamiento Normal del Frontend ---\n";

// send-contact.php rechaza GET normalmente
$contactGet = sendHttpRequest("{$baseUrl}/backend/send-contact.php");
assertTest("send-contact.php responde HTTP 405 a método GET", $contactGet['status'] === 405);

// submit-claim.php rechaza GET normalmente
$claimGet = sendHttpRequest("{$baseUrl}/backend/submit-claim.php");
assertTest("submit-claim.php responde HTTP 405 a método GET", $claimGet['status'] === 405);

// api/soft-skills.php responde 200 a questions
$questionsReq = sendHttpRequest("{$baseUrl}/backend/api/soft-skills.php?action=questions");
assertTest("soft-skills.php?action=questions responde HTTP 200 OK", $questionsReq['status'] === 200);
assertTest("soft-skills.php retorna estructura de preguntas válida", 
    isset($questionsReq['json']['success']) && $questionsReq['json']['success'] === true && !empty($questionsReq['json']['questions']));

echo "\n======================================================\n";
echo "RESULTADOS: {$testsPassed} de {$testsTotal} pruebas aprobadas.\n";
echo "======================================================\n";

if ($testsPassed === $testsTotal) {
    echo "\n>>> TODAS LAS PRUEBAS DE LA TAREA 8 PASARON CON ÉXITO <<<\n";
    exit(0);
} else {
    echo "\n>>> HUBO FALLOS EN LAS PRUEBAS <<<\n";
    exit(1);
}
