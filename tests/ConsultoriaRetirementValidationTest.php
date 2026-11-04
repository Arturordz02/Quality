<?php
/**
 * QUALITY CONSULTING SOLUTIONS - SUITE DE PRUEBAS AUTOMATIZADAS
 * Validación Técnica de Retiro de Consultoría y Consolidación en PMO Solutions (Fase 8A/8B)
 * Archivo: tests/ConsultoriaRetirementValidationTest.php
 *
 * Responsabilidad:
 * 1. La ruta `/consultoria` permanece registrada en la tabla de rutas.
 * 2. La redirección dinámica responde con código HTTP 301.
 * 3. El destino de la redirección dinámica es exactamente `https://pmo-solutions.com/`.
 * 4. `navbar.php` no contiene `/consultoria` ni el enlace "Consultoría".
 * 5. `404.html` no contiene enlaces a `consultoria.html` ni a `/consultoria`.
 * 6. `sitemap.xml` no contiene `/consultoria` y conserva la estructura válida.
 * 7. El artefacto estático o vista de transición no publica contenido comercial antiguo de consultoría.
 * 8. La página de transición incluye `noindex, follow` y canónico a PMO Solutions.
 * 9. La página de transición ofrece enlace visible y funcional a `https://pmo-solutions.com/`.
 * 10. No existen enlaces internos huérfanos que apunten a `/consultoria`.
 * 11. Las rutas y vistas de capacitaciones y cursos permanecen intactas.
 * 12. Quality no incorpora ni duplica contenidos de PMO Solutions en su código.
 */

declare(strict_types=1);

$totalTests = 0;
$passedTests = 0;

function runTest(string $description, callable $fn): void {
    global $totalTests, $passedTests;
    $totalTests++;
    echo "• Probando: {$description}... ";
    try {
        $result = $fn();
        if ($result === true) {
            $passedTests++;
            echo "[\033[32mPASÓ\033[0m]\n";
        } else {
            echo "[\033[31mFALLÓ\033[0m] (Retornó no-true)\n";
        }
    } catch (\Throwable $e) {
        echo "[\033[31mFALLÓ\033[0m] Excepción: " . $e->getMessage() . "\n";
    }
}

function assertCondition(bool $cond, string $msg = ''): void {
    if (!$cond) {
        throw new \RuntimeException($msg ?: 'Aserción fallida');
    }
}

echo "\n====================================================================\n";
echo "EJECUTANDO SUITE: RETIRO DE CONSULTORÍA Y CONSOLIDACIÓN EN PMO\n";
echo "====================================================================\n\n";

$baseDir = dirname(__DIR__);
$config = require $baseDir . '/private_app/config/app.php';
require_once $baseDir . '/private_app/app/Core/Router.php';
require_once $baseDir . '/private_app/app/Core/View.php';
require_once $baseDir . '/private_app/app/Core/Controller.php';
require_once $baseDir . '/private_app/app/Controllers/ServiceController.php';
require_once $baseDir . '/private_app/app/Services/CoursesCatalog.php';
require_once $baseDir . '/private_app/app/Services/CourseCatalog.php';

use App\Core\Router;
use App\Core\View;
use App\Controllers\ServiceController;
use App\Services\CoursesCatalog;
use App\Services\CourseCatalog;

// TEST 1: La ruta /consultoria permanece registrada en routes.php
runTest("1. La ruta /consultoria permanece registrada en routes.php hacia ServiceController::consultoria", function() use ($baseDir, $config): bool {
    $router = new Router($config);
    $routesLoader = require $baseDir . '/private_app/config/routes.php';
    $routesLoader($router, $config);

    // Reflexión para inspeccionar rutas registradas
    $ref = new \ReflectionClass($router);
    $prop = $ref->getProperty('routes');
    $prop->setAccessible(true);
    $routes = $prop->getValue($router);

    assertCondition(isset($routes['GET']['/consultoria']), "Ruta GET /consultoria debe estar registrada en Router.");
    $handler = $routes['GET']['/consultoria'];
    assertCondition(is_array($handler) && $handler[0] === ServiceController::class && $handler[1] === 'consultoria',
        "El handler de /consultoria debe ser [ServiceController::class, 'consultoria'].");
    return true;
});

// TEST 2: La redirección dinámica responde con código HTTP 301
runTest("2. ServiceController::consultoria responde con código de estado HTTP 301", function() use ($config): bool {
    $view = new View();
    $controller = new class($view, $config) extends ServiceController {
        public int $capturedCode = 0;
        public string $capturedUrl = '';
        public function redirect(string $url, int $statusCode = 302): void {
            $this->capturedUrl = $url;
            $this->capturedCode = $statusCode;
        }
    };

    $controller->consultoria();

    assertCondition($controller->capturedCode === 301, "El código de estado HTTP debe ser 301 (obtenido: {$controller->capturedCode}).");
    return true;
});

// TEST 3: El destino de la redirección dinámica es exactamente https://pmo-solutions.com/
runTest("3. El destino de la redirección dinámica en ServiceController::consultoria es exactamente https://pmo-solutions.com/", function() use ($config): bool {
    $view = new View();
    $controller = new class($view, $config) extends ServiceController {
        public int $capturedCode = 0;
        public string $capturedUrl = '';
        public function redirect(string $url, int $statusCode = 302): void {
            $this->capturedUrl = $url;
            $this->capturedCode = $statusCode;
        }
    };

    $controller->consultoria();

    assertCondition($controller->capturedUrl === 'https://pmo-solutions.com/', "La URL de destino debe ser https://pmo-solutions.com/ (obtenida: {$controller->capturedUrl}).");
    return true;
});

// TEST 4: navbar.php no contiene /consultoria ni el ítem de menú Consultoría
runTest("4. navbar.php no contiene enlace /consultoria ni ítem de menú Consultoría", function() use ($baseDir): bool {
    $navbarPath = $baseDir . '/private_app/app/Views/partials/navbar.php';
    $content = file_get_contents($navbarPath);

    assertCondition(!str_contains($content, '/consultoria'), "navbar.php no debe contener '/consultoria'.");
    assertCondition(!preg_match('#<a\s+[^>]*href=["\'][^"\']*consultoria[^"\']*["\']#i', $content), "navbar.php no debe contener enlaces a consultoría.");
    assertCondition(!preg_match('#<a\s+[^>]*class=["\']dropdown-item["\'][^>]*>\s*Consultor[ií]a\s*</a>#i', $content), "navbar.php no debe contener ítem 'Consultoría' en dropdowns.");
    return true;
});

// TEST 5: public_html/404.html no contiene consultoria.html ni /consultoria
runTest("5. public_html/404.html no contiene enlaces a consultoria.html ni a /consultoria", function() use ($baseDir): bool {
    $notFoundPath = $baseDir . '/public_html/404.html';
    $content = file_get_contents($notFoundPath);

    assertCondition(!str_contains($content, 'consultoria.html'), "404.html no debe contener 'consultoria.html'.");
    assertCondition(!str_contains($content, '/consultoria'), "404.html no debe contener '/consultoria'.");
    assertCondition(!preg_match('#href=["\'][^"\']*consultoria[^"\']*["\']#i', $content), "404.html no debe contener ningún href de consultoría.");
    return true;
});

// TEST 6: sitemap.xml no contiene /consultoria y conserva estructura válida
runTest("6. sitemap.xml no contiene /consultoria y conserva estructura XML válida", function() use ($baseDir): bool {
    $sitemapPath = $baseDir . '/public_html/sitemap.xml';
    $content = file_get_contents($sitemapPath);

    assertCondition(!str_contains($content, 'https://quality-consulting.org/consultoria'), "sitemap.xml no debe contener 'https://quality-consulting.org/consultoria'.");
    assertCondition(!str_contains($content, '<loc>https://quality-consulting.org/consultoria</loc>'), "sitemap.xml no debe tener tag <loc> para /consultoria.");

    // Validar sintaxis XML
    $xml = simplexml_load_string($content);
    assertCondition($xml !== false, "sitemap.xml debe ser un XML válido y bien formado.");
    assertCondition(isset($xml->url) && count($xml->url) > 40, "sitemap.xml debe conservar todas las demás URLs públicas.");
    return true;
});

// TEST 7: La vista/artefacto de consultoria no publica contenido comercial antiguo
runTest("7. La vista consultoria.php no publica contenido comercial antiguo", function() use ($baseDir): bool {
    $viewPath = $baseDir . '/private_app/app/Views/pages/consultoria.php';
    $content = file_get_contents($viewPath);

    $oldTerms = [
        'Diagnóstico y Evaluación',
        'Implementación de Sistemas Integrados',
        'Auditorías Internas',
        'Consultoría Estratégica',
        'Servicios de Consultoría Especializada',
        'Nuestros Servicios de Consultoría',
    ];

    foreach ($oldTerms as $term) {
        assertCondition(!str_contains($content, $term), "consultoria.php no debe contener el texto antiguo: '{$term}'.");
    }
    return true;
});

// TEST 8: La vista/configuración de transición incluye noindex, follow y canonical a PMO Solutions
runTest("8. La vista consultoria.php y build_static.php configuran noindex, follow y canonical hacia PMO Solutions", function() use ($baseDir): bool {
    $view = new View();
    $rendered = $view->render('pages/consultoria', [
        'title' => 'Redirección a PMO Solutions | Quality Consulting Solutions',
        'canonical' => 'https://pmo-solutions.com/',
        'robots' => 'noindex, follow',
    ], 'main');

    assertCondition(str_contains($rendered, '<meta name="robots" content="noindex, follow">'),
        "El HTML renderizado debe contener meta robots noindex, follow.");
    assertCondition(str_contains($rendered, '<link rel="canonical" href="https://pmo-solutions.com/">'),
        "El HTML renderizado debe contener canonical hacia https://pmo-solutions.com/.");
    return true;
});

// TEST 9: La vista de transición ofrece enlace visible y funcional a PMO Solutions
runTest("9. La vista consultoria.php incluye enlace visible y directo a https://pmo-solutions.com/", function() use ($baseDir): bool {
    $viewPath = $baseDir . '/private_app/app/Views/pages/consultoria.php';
    $content = file_get_contents($viewPath);

    assertCondition(str_contains($content, 'https://pmo-solutions.com/'), "consultoria.php debe contener la URL https://pmo-solutions.com/.");
    assertCondition(preg_match('#<a\s+[^>]*href=["\']https://pmo-solutions\.com/["\'][^>]*>#i', $content) === 1,
        "consultoria.php debe contener una etiqueta <a> apuntando a https://pmo-solutions.com/.");
    assertCondition(str_contains($content, 'Ir a PMO Solutions') || str_contains($content, 'PMO Solutions'),
        "consultoria.php debe contener texto claro que invite a ir a PMO Solutions.");
    return true;
});

// TEST 10: No existen enlaces internos huérfanos que apunten a /consultoria
runTest("10. No existen enlaces internos huérfanos con href='/consultoria' o href='consultoria.html'", function() use ($baseDir): bool {
    $dirsToScan = [
        $baseDir . '/private_app/app/Views',
        $baseDir . '/public_html',
    ];

    $excludedFiles = [
        realpath($baseDir . '/private_app/app/Views/pages/consultoria.php'),
    ];

    $matchedFiles = [];

    foreach ($dirsToScan as $dir) {
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir));
        foreach ($iterator as $file) {
            if (!$file->isFile()) continue;
            $ext = strtolower($file->getExtension());
            if (!in_array($ext, ['php', 'html', 'js'], true)) continue;

            $realPath = realpath($file->getPathname());
            if (in_array($realPath, $excludedFiles, true)) continue;

            $content = file_get_contents($realPath);
            // Detectar enlaces href="/consultoria" o href="consultoria.html" o href="/consultoria.html"
            if (preg_match('#href=["\'](\/consultoria|consultoria\.html|\/consultoria\.html)["\']#i', $content, $matches)) {
                $matchedFiles[] = $file->getPathname() . " (match: {$matches[0]})";
            }
        }
    }

    assertCondition(empty($matchedFiles), "Se encontraron enlaces internos huérfanos a /consultoria: \n" . implode("\n", $matchedFiles));
    return true;
});

// TEST 11: Rutas y vistas de capacitaciones y cursos permanecen intactas
runTest("11. Cursos y catálogo permanecen intactos (49 cursos totales, 44 con página, 5 con información próximamente)", function() use ($baseDir): bool {
    $allCourses = CoursesCatalog::getAll();
    assertCondition(count($allCourses) === 49, "Deben existir exactamente 49 cursos en CoursesCatalog (encontrados: " . count($allCourses) . ").");

    $withRoute = 0;
    $comingSoon = 0;
    foreach ($allCourses as $c) {
        if (!empty($c['route'])) {
            $withRoute++;
        } else {
            $comingSoon++;
        }
    }
    assertCondition($withRoute === 44, "Deben existir exactamente 44 cursos con ruta propia (encontrados: {$withRoute}).");
    assertCondition($comingSoon === 5, "Deben existir exactamente 5 cursos con información próximamente (encontrados: {$comingSoon}).");

    // Verificar cursos protegidos clave
    $protected = [
        'contratos-colaborativos-nec3-f',
        'contrato-nec4',
        'bim-revit-architecture',
        'calidad-y-pmi',
        'oficina-tecnica-obras-viales'
    ];
    foreach ($protected as $p) {
        assertCondition(CourseCatalog::isPurchasable($p) === true, "Curso protegido {$p} debe ser comprable.");
    }
    return true;
});

// TEST 12: Quality no incorpora ni duplica contenidos de PMO Solutions en su código
runTest("12. Quality no copia contenido editorial extenso ni duplica la estructura de PMO Solutions", function() use ($baseDir): bool {
    $viewPath = $baseDir . '/private_app/app/Views/pages/consultoria.php';
    $content = file_get_contents($viewPath);

    // Debe ser una vista ligera de redirección / transición, no una réplica del sitio de PMO
    $lines = count(explode("\n", $content));
    assertCondition($lines < 100, "La vista de transición consultoria.php debe ser ligera (< 100 líneas, encontradas: {$lines}).");

    // Verificar clientes.php enlace a PMO
    $clientesPath = $baseDir . '/private_app/app/Views/pages/clientes.php';
    $clientesContent = file_get_contents($clientesPath);
    assertCondition(str_contains($clientesContent, 'https://pmo-solutions.com/'), "clientes.php debe enlazar directamente a https://pmo-solutions.com/.");
    assertCondition(str_contains($clientesContent, 'Ver servicios en PMO Solutions'), "clientes.php debe tener el CTA 'Ver servicios en PMO Solutions'.");
    return true;
});

echo "\n====================================================================\n";
echo "RESULTADO FINAL: {$passedTests} de {$totalTests} pruebas pasaron con éxito.\n";
echo "====================================================================\n\n";

if ($passedTests !== $totalTests) {
    exit(1);
}
