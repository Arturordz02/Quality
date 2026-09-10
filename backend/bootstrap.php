<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Bootstrap Central del Backend: Inicialización de Resiliencia, Caché y Compresión
 */

declare(strict_types=1);

if (!defined('QCS_BACKEND_ACCESS')) {
    define('QCS_BACKEND_ACCESS', true);
}

// 1. Activar compresión de salida Gzip si está disponible y soportada por el cliente
if (!ob_get_level() && !headers_sent()) {
    if (extension_loaded('zlib') && !ini_get('zlib.output_compression')) {
        ini_set('zlib.output_compression', 'On');
        ini_set('zlib.output_compression_level', '6');
    }
}

// 2. Cargar Dependencias del Core
require_once __DIR__ . '/core/ErrorHandler.php';
require_once __DIR__ . '/resilience/CircuitBreaker.php';
require_once __DIR__ . '/resilience/RetryHelper.php';
require_once __DIR__ . '/resilience/RateLimiter.php';
require_once __DIR__ . '/resilience/FallbackQueue.php';
require_once __DIR__ . '/cache/CacheManager.php';
require_once __DIR__ . '/utils/Paginator.php';
require_once __DIR__ . '/Security.php';
require_once __DIR__ . '/Database.php';

// 3. Cargar Configuración Activa
$configFile = __DIR__ . '/config.php';
$config = file_exists($configFile) ? require $configFile : [];
Security::init($config);

// 4. Registrar Manejador Global de Errores
$debugMode = !empty($config['security']['debug']);
ErrorHandler::register($debugMode);

// 5. Inicializar Instancias Globales de Resiliencia
$cache = CacheManager::getInstance($config);
$rateLimiter = new RateLimiter();
$dbCircuitBreaker = new CircuitBreaker('database', 5, 30, 2);

return [
    'config'             => $config,
    'cache'              => $cache,
    'rateLimiter'        => $rateLimiter,
    'dbCircuitBreaker'   => $dbCircuitBreaker,
];

