<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Front Controller Principal (public/index.php)
 *
 * Responsabilidad:
 * - Punto de entrada único del entorno MVC (FASE 2).
 * - Carga el puente de configuración unificado y el Autoloader PSR-4.
 * - Registra la tabla de rutas y despacha la petición al controlador/handler adecuado.
 * - Funciona en paralelo sin reemplazar ni alterar index.html en la raíz del proyecto.
 */

declare(strict_types=1);

// 1. Cargar configuración unificada y registrar Autoloader PSR-4
$config = require dirname(__DIR__) . '/config/app.php';

// 2. Instanciar el Enrutador del Core
$router = new \App\Core\Router($config);

// 3. Cargar y registrar la tabla de rutas
$routesLoader = require dirname(__DIR__) . '/config/routes.php';
$routesLoader($router, $config);

// 4. Despachar la petición HTTP actual
$router->dispatch();

