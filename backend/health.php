<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Endpoint de Monitoreo y Salud del Sistema (Health Check)
 * Valida entorno PHP, extensiones mandatorias, almacenamiento, caché y base de datos.
 *
 * Estados del sistema:
 * - healthy: Todas las comprobaciones críticas y operativas son óptimas (HTTP 200).
 * - degraded: Sistema operativo con contingencia o fallbacks activos (ej. DB offline con fallback_queue) (HTTP 200).
 * - unhealthy: Faltan requisitos indispensables (PHP incompatible, extensiones requeridas ausentes o almacenamiento bloqueado) (HTTP 503).
 */

define('QCS_BACKEND_ACCESS', true);

$bootstrap = require __DIR__ . '/bootstrap.php';
$config = $bootstrap['config'];
$cache = $bootstrap['cache'];
$rateLimiter = $bootstrap['rateLimiter'];
$dbCircuit = $bootstrap['dbCircuitBreaker'];

Security::sendJsonHeaders($config);

// 1. Rate Limiting: Proteger el endpoint contra ataques de denegación de servicio o sondeo abusivo
$clientIp = Security::getClientIp($config);
$rateLimiter->enforceOrBlock($clientIp . '_health_ping', 60, 60);

$isDebug = !empty($config['security']['debug']);

$criticalFailures = [];
$degradedWarnings = [];

// 2. Comprobación de Versión de PHP (El sistema utiliza tipado estricto y características de PHP 8.0+)
$minPhpVersion = '8.0.0';
$phpVersionOk = version_compare(PHP_VERSION, $minPhpVersion, '>=');
if (!$phpVersionOk) {
    $criticalFailures[] = "Versión de PHP incompatible (requiere >= {$minPhpVersion}, actual: " . PHP_VERSION . ").";
}

// 3. Comprobación de Extensiones PHP Mandatorias y Opcionales
$dbEnabled = !empty($config['database']['enabled']);

$requiredExtensions = [
    'mbstring' => 'Manipulación segura de cadenas y sanitización UTF-8',
    'pdo'      => 'Capa de abstracción de datos PDO',
    'openssl'  => 'Criptografía y conexiones seguras TLS para correo SMTP',
    'json'     => 'Serialización y deserialización de APIs',
];

// pdo_mysql es obligatorio si la base de datos está habilitada
if ($dbEnabled) {
    $requiredExtensions['pdo_mysql'] = 'Driver MySQL PDO requerido cuando DB_ENABLED=true';
}

$extensionChecks = [];
foreach ($requiredExtensions as $ext => $desc) {
    $loaded = extension_loaded($ext);
    $extensionChecks[$ext] = [
        'required' => true,
        'status'   => $loaded ? 'OK' : 'MISSING',
    ];
    if (!$loaded) {
        $criticalFailures[] = "Extensión obligatoria faltante: '{$ext}' ({$desc}).";
    }
}

// Extensiones opcionales
$optionalExtensions = [
    'zlib' => 'Compresión de salida Gzip y archivado de logs',
    'gd'   => 'Optimización y conversión de imágenes WebP',
];

foreach ($optionalExtensions as $ext => $desc) {
    $loaded = extension_loaded($ext);
    $extensionChecks[$ext] = [
        'required' => false,
        'status'   => $loaded ? 'OK' : 'UNAVAILABLE',
    ];
    if (!$loaded) {
        $degradedWarnings[] = "Extensión opcional no disponible: '{$ext}' ({$desc}).";
    }
}

// 4. Verificación de Permisos de Almacenamiento Local
$storageDir = __DIR__ . '/storage';
$canWriteStorage = is_writable($storageDir) || @is_writable($storageDir . '/logs');
$canWriteFallback = @is_writable($storageDir . '/fallback_queue') || $canWriteStorage;

if (!$canWriteStorage || !$canWriteFallback) {
    $criticalFailures[] = 'Almacenamiento local (storage) sin permisos de escritura necesarios para logs y contingencia.';
}

// 5. Verificación de Caché (Driver activo)
$cacheStatus = 'OK';
try {
    $testKey = 'health_ping_' . uniqid();
    $cache->set($testKey, 'pong', 5);
    $val = $cache->get($testKey);
    $cache->delete($testKey);

    if ($val !== 'pong') {
        $cacheStatus = 'DEGRADED';
        $degradedWarnings[] = 'Inconsistencia temporal en operaciones de lectura/escritura de caché.';
    }
} catch (\Throwable $e) {
    $cacheStatus = 'DEGRADED';
    $degradedWarnings[] = 'Excepción al operar motor de caché.';
}

// 6. Verificación de Base de Datos
$dbStatus = 'UNKNOWN';
$dbMessage = '';
if (!$dbEnabled) {
    $dbStatus = 'DISABLED';
    $dbMessage = 'Base de datos no activada (modo estático/correo/contingencia activo).';
} else {
    try {
        $pdo = Database::getConnection($config);
        if ($pdo) {
            $stmt = $pdo->query("SELECT 1");
            $dbStatus = 'OK';
            $dbMessage = 'Conexión activa y operativa.';
        } else {
            $dbStatus = 'DEGRADED';
            $dbMessage = 'Servicio de base de datos no disponible. Cola de contingencia activa.';
            $degradedWarnings[] = 'Base de datos temporalmente inaccesible (degradación elegante a contingencia activa).';
        }
    } catch (\Throwable $e) {
        $dbStatus = 'DEGRADED';
        $dbMessage = 'Servicio de base de datos no disponible.';
        $degradedWarnings[] = 'Error de conexión a base de datos.';
    }
}

// 7. Determinación del Estado Global
if (!empty($criticalFailures)) {
    $overallStatus = 'unhealthy';
    $httpCode = 503;
} elseif (!empty($degradedWarnings)) {
    $overallStatus = 'degraded';
    $httpCode = 200;
} else {
    $overallStatus = 'healthy';
    $httpCode = 200;
}

// 8. Construcción de Respuesta
// En producción: respuesta estrictamente mínima (únicamente 'status') para evitar enumeración de infraestructura
// En desarrollo con APP_DEBUG=true: respuesta diagnóstica completa para inspección local
$isDevelopmentDebug = (($config['app']['env'] ?? '') === 'development') && !empty($config['security']['debug']);

if (!$isDevelopmentDebug) {
    $response = [
        'status' => $overallStatus,
    ];
} else {
    $response = [
        'status'      => $overallStatus,
        'http_status' => $httpCode,
        'timestamp'   => date('c'),
        'environment' => $config['app']['env'] ?? 'development',
        'system'      => [
            'php_compatible' => $phpVersionOk,
            'php_version'    => PHP_VERSION,
        ],
        'checks' => [
            'extensions' => $extensionChecks,
            'storage'    => [
                'status'   => ($canWriteStorage && $canWriteFallback) ? 'OK' : 'ERROR',
                'writable' => ($canWriteStorage && $canWriteFallback),
            ],
            'cache'      => [
                'status' => $cacheStatus,
                'driver' => $cache->getActiveDriverName(),
            ],
            'database'   => [
                'status'  => $dbStatus,
                'message' => $dbMessage,
                'circuit' => $dbCircuit->getState()['state'],
            ],
        ]
    ];

    if (!empty($criticalFailures)) {
        $response['failures'] = $criticalFailures;
    }
    if (!empty($degradedWarnings)) {
        $response['warnings'] = $degradedWarnings;
    }

    $response['debug_telemetry'] = [
        'memory_usage' => round(memory_get_usage(true) / 1024 / 1024, 2) . ' MB',
        'compression'  => extension_loaded('zlib') && ini_get('zlib.output_compression') ? 'enabled' : 'disabled',
    ];
}

http_response_code($httpCode);
echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
exit;
