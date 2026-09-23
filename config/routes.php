<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Tabla de Rutas de la Aplicación (config/routes.php)
 *
 * Responsabilidad:
 * - Registrar las rutas HTTP y asociarlas a controladores o funciones de respuesta.
 * - FASE 2: Diagnóstico (/mvc-health) y raíz del Front Controller (/).
 * - FASE 3: Migración piloto de Términos y Condiciones (/terminos-y-condiciones).
 * - FASE 3.2: Migración de páginas institucionales (/nosotros, /clientes, /404).
 * - FASE 3.3: Migración de servicios y consultoría (/consultoria, /gestion-de-la-calidad, etc.).
 * - FASE 3.4: Migración de capacitación y cursos (/capacitacion, /bim-revit-architecture, etc.).
 */

declare(strict_types=1);

use App\Core\Router;
use App\Core\View;
use App\Controllers\LegalController;
use App\Controllers\PageController;
use App\Controllers\ServiceController;
use App\Controllers\TrainingController;

return function (Router $router, array $config): void {

    /**
     * RUTA DE DIAGNÓSTICO Y SALUD DEL ENTORNO MVC
     * Responde con información del estado del framework y verificación de carga.
     */
    $router->get('/mvc-health', function () use ($config) {
        header('Content-Type: application/json; charset=utf-8');
        header('X-Content-Type-Options: nosniff');

        $env = (string) ($config['app']['env'] ?? (getenv('APP_ENV') ?: 'production'));
        $isProduction = (strtolower($env) === 'production');

        if ($isProduction) {
            echo json_encode([
                'status'  => 'ok',
                'service' => $config['app']['name'] ?? 'Quality Consulting Solutions',
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            exit;
        }

        echo json_encode([
            'status'      => 'ok',
            'framework'   => 'QCS-MVC-Core',
            'phase'       => 'Páginas institucionales, servicios y capacitación migradas a MVC',
            'environment' => $env,
            'php_version' => PHP_VERSION,
            'timestamp'   => date('c'),
            'message'     => 'El entorno MVC está cargando correctamente.',
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    });

    /**
     * RUTAS INSTITUCIONALES Y DE ATENCIÓN/FORMULARIOS MVC
     */
    $router->get('/terminos-y-condiciones', [LegalController::class, 'terminos']);
    $router->get('/nosotros', [PageController::class, 'nosotros']);
    $router->get('/clientes', [PageController::class, 'clientes']);
    $router->get('/contacto', [PageController::class, 'contacto']);
    $router->get('/libro-de-reclamaciones', [PageController::class, 'libroDeReclamaciones']);
    $router->get('/evaluacion-habilidades', [PageController::class, 'evaluacionHabilidades']);
    $router->get('/investigacion', [PageController::class, 'investigacion']);
    $router->get('/encuestas-proyectos', [PageController::class, 'encuestasProyectos']);
    $router->get('/medios', [PageController::class, 'medios']);
    $router->get('/noticias', [PageController::class, 'noticias']);
    $router->get('/press', [PageController::class, 'press']);
    $router->get('/404', [PageController::class, 'notFound']);

    /**
     * RUTAS DE SERVICIOS Y CONSULTORÍA TÉCNICA
     */
    $router->get('/consultoria', [ServiceController::class, 'consultoria']);
    $router->get('/gestion-de-la-calidad', [ServiceController::class, 'gestionCalidad']);
    $router->get('/gestion-de-pmo', [ServiceController::class, 'gestionPmo']);
    $router->get('/gestion-de-riesgos', [ServiceController::class, 'gestionRiesgos']);
    $router->get('/cronograma-forense', [ServiceController::class, 'cronogramaForense']);
    $router->get('/homologaciones', [ServiceController::class, 'homologaciones']);
    $router->get('/headhunting', [ServiceController::class, 'headhunting']);
    $router->get('/oficina-tecnica', [ServiceController::class, 'oficinaTecnica']);
    $router->get('/permisologia', [ServiceController::class, 'permisologia']);
    $router->get('/sindrome-del-90', [ServiceController::class, 'sindromeDel90']);

    /**
     * RUTAS DE CAPACITACIÓN Y PROGRAMAS DE ESPECIALIZACIÓN
     */
    $router->get('/capacitacion', [TrainingController::class, 'capacitacion']);
    $router->get('/bim-revit-architecture', [TrainingController::class, 'bimRevitArchitecture']);
    $router->get('/calidad-y-pmi', [TrainingController::class, 'calidadPmi']);
    $router->get('/contratos', [TrainingController::class, 'contratos']);
    $router->get('/contratos-estado', [TrainingController::class, 'contratosEstado']);
    $router->get('/costos', [TrainingController::class, 'costos']);
    $router->get('/fidic', [TrainingController::class, 'fidic']);
    $router->get('/gerencia-de-calidad', [TrainingController::class, 'gerenciaCalidad']);
    $router->get('/gruas-torre', [TrainingController::class, 'gruasTorre']);
    $router->get('/herramientas', [TrainingController::class, 'herramientas']);
    $router->get('/iso-9001', [TrainingController::class, 'iso9001']);
    $router->get('/lean-last-planner', [TrainingController::class, 'leanLastPlanner']);
    $router->get('/lego-serious-play', [TrainingController::class, 'legoSeriousPlay']);
    $router->get('/nec', [TrainingController::class, 'nec']);
    $router->get('/pmo', [TrainingController::class, 'pmo']);
    $router->get('/proyectos-pmi', [TrainingController::class, 'proyectosPmi']);
    $router->get('/riesgo-del-plazo', [TrainingController::class, 'riesgoDelPlazo']);
    $router->get('/riesgos-cadena-produccion', [TrainingController::class, 'riesgosCadenaProduccion']);
    $router->get('/riesgos-pmi', [TrainingController::class, 'riesgosPmi']);
    $router->get('/riesgos-tecnicos', [TrainingController::class, 'riesgosTecnicos']);
    $router->get('/universidad-corporativa', [TrainingController::class, 'universidadCorporativa']);
    $router->get('/valor-ganado', [TrainingController::class, 'valorGanado']);

    /**
     * MANEJADOR DE ERROR 404 PERSONALIZADO
     * Cuando una ruta MVC no exista, renderiza la vista institucional 404.
     */
    $router->setNotFoundHandler(function () use ($config) {
        $controller = new PageController(new View(), $config);
        $controller->notFound();
    });

    /**
     * RUTA RAÍZ - PÁGINA PRINCIPAL
     * Despacha la vista principal migrada a la arquitectura MVC.
     */
    $router->get('/', [PageController::class, 'home']);
};
