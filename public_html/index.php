<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Front Controller Principal para GoDaddy / cPanel
 *
 * Responsabilidad:
 * - Punto de entrada único del entorno MVC en producción.
 * - Localiza y carga de forma segura la aplicación desde 'private_app' fuera del DocumentRoot.
 * - Despacha las peticiones HTTP a los controladores y vistas del sistema.
 */

declare(strict_types=1);

// Servidor embebido de PHP (desarrollo local): despachar archivos estáticos directamente
if (php_sapi_name() === 'cli-server') {
    $requestedPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $staticFilePath = __DIR__ . $requestedPath;
    if ($requestedPath !== '/' && file_exists($staticFilePath) && !is_dir($staticFilePath)) {
        return false;
    }
}

// Localizar private_app de forma resiliente para servidor principal o dominio adicional en cPanel
$privateAppDir = dirname(__DIR__) . '/private_app';
if (!is_dir($privateAppDir)) {
    $candidates = [
        dirname(__DIR__) . '/private_app',
        dirname(__DIR__, 2) . '/private_app',
        __DIR__ . '/../private_app',
    ];
    foreach ($candidates as $cand) {
        if (is_dir($cand)) {
            $privateAppDir = $cand;
            break;
        }
    }
}

if (!is_dir($privateAppDir)) {
    http_response_code(500);
    echo "Error 500: No se pudo localizar el directorio de la aplicación privada.";
    exit;
}

// 1. Cargar configuración unificada y registrar Autoloader PSR-4
$config = require $privateAppDir . '/config/app.php';

// 2. Instanciar el Enrutador del Core
$router = new \App\Core\Router($config);

// 3. Cargar y registrar la tabla de rutas
$routesLoader = require $privateAppDir . '/config/routes.php';
$routesLoader($router, $config);

// 4. Despachar la petición HTTP actual
$router->dispatch();

