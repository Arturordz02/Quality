<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Puente de Configuración Global (config/app.php)
 *
 * Responsabilidad:
 * - Integrar de forma no disruptiva la configuración existente en backend/config.php (.env loader, DB, SMTP, Cache).
 * - Registrar el Autoloader PSR-4 para el namespace App\.
 * - Proveer metadatos y rutas del sistema para el entorno MVC.
 */

declare(strict_types=1);

// 1. Registrar Autoloader de clases MVC
require_once dirname(__DIR__) . '/app/Core/Autoloader.php';
\App\Core\Autoloader::register();

// 2. Cargar la configuración actual desde backend/config.php
$backendConfigFile = dirname(__DIR__) . '/backend/config.php';
$backendConfig = file_exists($backendConfigFile) ? require $backendConfigFile : [];

// 3. Metadatos y variables del ecosistema MVC
$mvcConfig = [
    'app' => [
        'name'        => 'Quality Consulting Solutions',
        'env'         => getenv('APP_ENV') ?: 'production',
        'debug'       => !empty($backendConfig['security']['debug']),
        'base_url'    => getenv('APP_URL') ?: 'https://quality-consulting.org',
        'timezone'    => 'America/Lima',
        'locale'      => 'es_PE',
    ],
    'paths' => [
        'root'        => dirname(__DIR__),
        'app'         => dirname(__DIR__) . '/app',
        'controllers' => dirname(__DIR__) . '/app/Controllers',
        'models'      => dirname(__DIR__) . '/app/Models',
        'views'       => dirname(__DIR__) . '/app/Views',
        'public'      => dirname(__DIR__) . '/public',
        'storage'     => dirname(__DIR__) . '/backend/storage',
    ],
];

// 4. Retornar configuración unificada
return array_replace_recursive($backendConfig, $mvcConfig);

