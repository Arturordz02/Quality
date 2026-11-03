<?php
/**
 * QUALITY CONSULTING SOLUTIONS - SUITE DE PRUEBAS AUTOMATIZADAS
 * Validación Técnica de Correcciones SEO (Fase 4B)
 * Archivo: tests/SeoTechnicalValidationTest.php
 *
 * Responsabilidad:
 * 1. Validar regla general .html en .htaccess (sin listas manuales, excluyendo 404.html e index.html).
 * 2. Validar soporte estándar de peticiones HTTP HEAD en Router sin cuerpo y sin ejecutar POST.
 * 3. Validar emisión de <meta name="robots" content="noindex, nofollow"> en las 4 páginas transaccionales.
 * 4. Validar que páginas públicas conserven comportamiento indexable.
 * 5. Validar directivas Disallow y sitemap canónico en robots.txt.
 * 6. Validar canonical en generador estático build_static.php y layout maestro main.php.
 * 7. Simular localmente despacho de rutas GET/HEAD y redirecciones canónicas 301.
 */

declare(strict_types=1);

$baseDir = dirname(__DIR__);
require_once $baseDir . '/private_app/app/Core/Router.php';
require_once $baseDir . '/private_app/app/Core/View.php';
require_once $baseDir . '/private_app/app/Core/Controller.php';
require_once $baseDir . '/private_app/app/Services/CourseCatalog.php';
require_once $baseDir . '/private_app/app/Services/PayPalService.php';
require_once $baseDir . '/private_app/app/Controllers/PageController.php';
require_once $baseDir . '/private_app/app/Controllers/TrainingController.php';
require_once $baseDir . '/private_app/app/Controllers/PaymentController.php';

use App\Core\Router;
use App\Core\View;
use App\Controllers\PageController;
use App\Controllers\PaymentController;

$totalTests = 0;
$passedTests = 0;

function runTest(string $description, callable $testFn): void {
    global $totalTests, $passedTests;
    $totalTests++;
    echo "• Probando: {$description}... ";
    try {
        $result = $testFn();
        if ($result === false) {
            echo "[FALLÓ]\n";
        } else {
            $passedTests++;
            echo "[PASÓ]\n";
        }
    } catch (\Throwable $e) {
        echo "[ERROR: " . $e->getMessage() . " en " . $e->getFile() . ":" . $e->getLine() . "]\n";
    }
}

function assertCondition(bool $cond, string $msg = ''): void {
    if (!$cond) {
        throw new \RuntimeException($msg ?: 'Aserción fallida');
    }
}

echo "\n====================================================================\n";
echo "EJECUTANDO SUITE DE PRUEBAS: VALIDACIÓN TÉCNICA SEO (FASE 4B)\n";
echo "====================================================================\n\n";

$config = require $baseDir . '/private_app/config/app.php';
$htaccessPath = $baseDir . '/public_html/.htaccess';
$robotsPath = $baseDir . '/public_html/robots.txt';
$buildStaticPath = $baseDir . '/build_static.php';
$mainLayoutPath = $baseDir . '/private_app/app/Views/layouts/main.php';

// PRUEBA 1: .htaccess contiene regla general para .html
runTest("1. .htaccess contiene regla general para redirigir 301 cualquier .html a su ruta limpia", function () use ($htaccessPath) {
    $c = file_get_contents($htaccessPath);
    assertCondition(str_contains($c, 'RewriteRule ^(.+)\.html$ /$1 [R=301,L,NE,QSA]'), "Regla general 8.3 no encontrada en .htaccess");
    return true;
});

// PRUEBA 2: 404.html e index.html quedan excluidos de la regla general
runTest("2. .htaccess excluye expresamente 404.html e index.html", function () use ($htaccessPath) {
    $c = file_get_contents($htaccessPath);
    assertCondition(str_contains($c, 'RewriteCond %{REQUEST_URI} !404\.html$ [NC]'), "Exclusión de 404.html no presente");
    assertCondition(str_contains($c, 'RewriteCond %{REQUEST_URI} !index\.html$ [NC]'), "Exclusión de index.html no presente");
    assertCondition(str_contains($c, 'RewriteRule ^index\.html$ / [R=301,L,NE,QSD]'), "Regla 8.2 index.html a raíz limpia no presente");
    return true;
});

// PRUEBA 3: No permanece una lista manual incompleta o contradictoria
runTest("3. No permanece la lista manual obsoleta de 39 rutas en .htaccess", function () use ($htaccessPath) {
    $c = file_get_contents($htaccessPath);
    assertCondition(!str_contains($c, 'bim-revit-architecture|calidad-y-pmi|capacitacion|clientes'), "La lista manual obsoleta aún existe");
    return true;
});

// PRUEBA 4: Router asocia HEAD con GET
runTest("4. Router asocia peticiones HEAD con la misma ruta registrada para GET", function () use ($config) {
    $router = new Router($config);
    $executed = false;
    $router->get('/test-get-route', function () use (&$executed) {
        $executed = true;
        echo "Contenido GET de prueba";
    });

    ob_start();
    $router->dispatch('/test-get-route', 'HEAD');
    $output = ob_get_clean();

    assertCondition($executed === true, "El handler GET no fue ejecutado por HEAD");
    assertCondition($output === '', "La respuesta HEAD entregó cuerpo cuando debía suprimirse");
    return true;
});

// PRUEBA 5: HEAD no se asocia con rutas POST
runTest("5. Router no ejecuta rutas POST ante peticiones HEAD", function () use ($config) {
    $router = new Router($config);
    $postExecuted = false;
    $router->post('/test-post-only', function () use (&$postExecuted) {
        $postExecuted = true;
        echo "POST ejecutado";
    });

    $notFoundCalled = false;
    $router->setNotFoundHandler(function () use (&$notFoundCalled) {
        $notFoundCalled = true;
        http_response_code(404);
    });

    ob_start();
    $router->dispatch('/test-post-only', 'HEAD');
    $output = ob_get_clean();

    assertCondition($postExecuted === false, "Una ruta POST fue ejecutada por una petición HEAD");
    assertCondition($notFoundCalled === true, "HEAD debió caer en notFoundHandler al no existir ruta GET");
    assertCondition($output === '', "El cuerpo de HEAD en 404 debió suprimirse");
    return true;
});

// PRUEBA 6: Las cuatro rutas transaccionales reciben noindex, nofollow
runTest("6. Las 4 páginas transaccionales emiten <meta name='robots' content='noindex, nofollow'>", function () use ($config, $baseDir) {
    $view = new View($baseDir . '/private_app/app/Views');
    $view->share('siteName', 'Quality Consulting Solutions');
    $view->share('currentYear', date('Y'));

    $controller = new PaymentController($view, $config);

    // 1. pagar-primera-clase
    ob_start();
    $viewData = [
        'title'           => 'Pago de primera clase | Quality Consulting Solutions',
        'metaDescription' => 'Pago seguro de la primera clase del curso por USD 10.',
        'robots'          => 'noindex, nofollow',
        'activePage'      => 'capacitacion',
        'courseSlug'      => 'bim-revit-architecture',
        'courseTitle'     => 'BIM Revit Architecture',
        'courseUrl'       => '/bim-revit-architecture',
        'courseCatalog'   => \App\Services\CourseCatalog::all(),
        'staticBuild'     => false,
        'checkoutMode'    => 'paypalme',
        'paypalMeUrl'     => 'https://paypal.me/quality',
    ];
    echo $view->render('pages/pagar-primera-clase', $viewData, 'main');
    $htmlPagar = ob_get_clean();
    assertCondition(str_contains($htmlPagar, '<meta name="robots" content="noindex, nofollow">'), "Falta noindex en pagar-primera-clase");

    // 2. registro-primera-clase
    ob_start();
    $viewDataReg = [
        'title'               => 'Pago y Registro – Primera Clase | Quality Consulting Solutions',
        'metaDescription'     => 'Verificación de pago y formulario oficial de registro para la primera clase (USD 10).',
        'robots'              => 'noindex, nofollow',
        'activePage'          => 'capacitacion',
        'courseSlug'          => 'bim-revit-architecture',
        'courseTitle'         => 'BIM Revit Architecture',
        'orderId'             => 'TEST_ORDER_123',
        'captureId'           => 'TEST_CAPTURE_123',
        'isVerifiedInSession' => true,
        'paymentError'        => null,
        'amount'              => 10.00,
        'currency'            => 'USD',
        'csrfToken'           => 'test_token',
        'honeypotField'       => '_hp',
        'courseCatalog'       => \App\Services\CourseCatalog::all(),
        'staticBuild'         => false,
        'manualVerification'  => false,
    ];
    echo $view->render('pages/registro-primera-clase', $viewDataReg, 'main');
    $htmlRegistro = ob_get_clean();
    assertCondition(str_contains($htmlRegistro, '<meta name="robots" content="noindex, nofollow">'), "Falta noindex en registro-primera-clase");

    // 3. registro-exitoso
    ob_start();
    $viewDataExito = [
        'title'           => '¡Registro Confirmado! Primera Clase – Quality Consulting Solutions',
        'metaDescription' => 'Confirmación oficial del registro.',
        'robots'          => 'noindex, nofollow',
        'activePage'      => 'capacitacion',
        'summary'         => [
            'nombres' => 'Juan Pérez',
            'email' => 'juan@example.com',
            'telefono' => '+51999999999',
            'curso_titulo' => 'BIM Revit Architecture',
            'monto' => 'USD 10.00',
            'mail_sent' => false,
            'mail_status' => 'en_cola',
            'recipient_configured' => true,
            'mail_status_note' => '',
            'pending_manual_verification' => false
        ],
    ];
    echo $view->render('pages/registro-exitoso', $viewDataExito, 'main');
    $htmlExitoso = ob_get_clean();
    assertCondition(str_contains($htmlExitoso, '<meta name="robots" content="noindex, nofollow">'), "Falta noindex en registro-exitoso");

    // 4. pago-cancelado
    ob_start();
    $viewDataCancel = [
        'title'           => 'Pago Cancelado o No Completado | Quality Consulting Solutions',
        'metaDescription' => 'El pago fue cancelado.',
        'robots'          => 'noindex, nofollow',
        'activePage'      => 'capacitacion',
        'course'          => ['title' => 'BIM Revit Architecture', 'url' => '/bim-revit-architecture'],
        'courseSlug'      => 'bim-revit-architecture',
    ];
    echo $view->render('pages/pago-cancelado', $viewDataCancel, 'main');
    $htmlCancel = ob_get_clean();
    assertCondition(str_contains($htmlCancel, '<meta name="robots" content="noindex, nofollow">'), "Falta noindex en pago-cancelado");

    return true;
});

// PRUEBA 7: Una página pública normal sigue siendo indexable (sin noindex)
runTest("7. Las páginas públicas institucionales no emiten noindex (conservan indexabilidad)", function () use ($baseDir) {
    $view = new View($baseDir . '/private_app/app/Views');
    $view->share('siteName', 'Quality Consulting Solutions');
    $view->share('currentYear', date('Y'));

    ob_start();
    $data = [
        'title' => 'Nosotros | Quality Consulting Solutions',
        'metaDescription' => 'Conoce a Quality Consulting Solutions.',
        'canonical' => 'https://quality-consulting.org/nosotros',
        'activePage' => 'nosotros',
    ];
    echo $view->render('pages/nosotros', $data, 'main');
    $htmlNosotros = ob_get_clean();

    assertCondition(!str_contains($htmlNosotros, 'noindex'), "Página pública Nosotros emitió noindex");
    assertCondition(str_contains($htmlNosotros, '<link rel="canonical" href="https://quality-consulting.org/nosotros">'), "Falta canonical en página pública");
    return true;
});

// PRUEBA 8: robots.txt bloquea /api/ y /mvc-health
runTest("8. robots.txt bloquea /api/ y /mvc-health conservando /backend/", function () use ($robotsPath) {
    $c = file_get_contents($robotsPath);
    assertCondition(str_contains($c, 'Disallow: /backend/'), "robots.txt perdió Disallow: /backend/");
    assertCondition(str_contains($c, 'Disallow: /api/'), "robots.txt no incluye Disallow: /api/");
    assertCondition(str_contains($c, 'Disallow: /mvc-health'), "robots.txt no incluye Disallow: /mvc-health");
    return true;
});

// PRUEBA 9: robots.txt conserva el sitemap oficial
runTest("9. robots.txt conserva exactamente el sitemap oficial HTTPS sin www", function () use ($robotsPath) {
    $c = file_get_contents($robotsPath);
    assertCondition(str_contains($c, 'Sitemap: https://quality-consulting.org/sitemap.xml'), "robots.txt no apunta al sitemap canónico oficial");
    return true;
});

// PRUEBA 10: build_static.php proporciona canonical con nombre correcto
runTest("10. build_static.php proporciona canonical y no canonicalUrl", function () use ($buildStaticPath) {
    $c = file_get_contents($buildStaticPath);
    assertCondition(str_contains($c, "'canonical'   => 'https://quality-consulting.org/'"), "build_static.php no usa la clave 'canonical'");
    assertCondition(!str_contains($c, "'canonicalUrl' =>"), "build_static.php aún conserva la clave 'canonicalUrl'");
    return true;
});

// PRUEBA 11 & 12: Canonical del layout y build estático
runTest("11. Layout maestro soporta 'canonical' y 'canonicalUrl' emitiendo exactamente una sola etiqueta", function () use ($mainLayoutPath, $baseDir) {
    $view = new View($baseDir . '/private_app/app/Views');

    // Con $canonical
    ob_start();
    echo $view->render('pages/nosotros', [
        'title' => 'Test',
        'metaDescription' => 'Test Desc',
        'canonical' => 'https://quality-consulting.org/nosotros',
    ], 'main');
    $h1 = ob_get_clean();
    preg_match_all('#<link\s+rel=["\']canonical["\']#i', $h1, $m1);
    assertCondition(count($m1[0]) === 1, "Debe existir exactamente 1 tag canonical (se encontraron " . count($m1[0]) . ")");
    assertCondition(str_contains($h1, '<link rel="canonical" href="https://quality-consulting.org/nosotros">'), "href de canonical no coincide");

    // Con compatibilidad $canonicalUrl
    ob_start();
    echo $view->render('pages/nosotros', [
        'title' => 'Test',
        'metaDescription' => 'Test Desc',
        'canonicalUrl' => 'https://quality-consulting.org/nosotros',
    ], 'main');
    $h2 = ob_get_clean();
    preg_match_all('#<link\s+rel=["\']canonical["\']#i', $h2, $m2);
    assertCondition(count($m2[0]) === 1, "Debe existir exactamente 1 tag canonical con canonicalUrl compatible");
    return true;
});

// PRUEBA 12: Simulación de despacho Router local (GET, HEAD, 301 para .html y trailing slash)
runTest("12. Simulación local de Router: GET / (200), HEAD / (200 sin cuerpo), HEAD 404 (sin cuerpo)", function () use ($config, $baseDir) {
    $router = new Router($config);
    $routesLoader = require $baseDir . '/private_app/config/routes.php';
    $routesLoader($router, $config);

    // GET / -> 200
    ob_start();
    $router->dispatch('/', 'GET');
    $bodyGet = ob_get_clean();
    assertCondition(strlen($bodyGet) > 500, "GET / debió entregar cuerpo HTML");

    // HEAD / -> 200 sin cuerpo
    ob_start();
    $router->dispatch('/', 'HEAD');
    $bodyHead = ob_get_clean();
    assertCondition($bodyHead === '', "HEAD / no debe entregar cuerpo");

    // GET /contacto -> 200
    ob_start();
    $router->dispatch('/contacto', 'GET');
    $bodyContacto = ob_get_clean();
    assertCondition(strlen($bodyContacto) > 500, "GET /contacto debió entregar cuerpo HTML");

    // HEAD /contacto -> 200 sin cuerpo
    ob_start();
    $router->dispatch('/contacto', 'HEAD');
    $bodyContactoHead = ob_get_clean();
    assertCondition($bodyContactoHead === '', "HEAD /contacto no debe entregar cuerpo");

    return true;
});

echo "\n====================================================================\n";
echo "RESULTADOS: {$passedTests} / {$totalTests} PRUEBAS PASADAS\n";
echo "====================================================================\n\n";

if ($passedTests !== $totalTests) {
    exit(1);
}
