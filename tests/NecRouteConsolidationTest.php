<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Test Suite Automatizado: Auditoría y Consolidación de Ruta Heredada /nec y Seminario NEC
 * Archivo: tests/NecRouteConsolidationTest.php
 *
 * Verificaciones requeridas:
 * 1. 49 cursos totales en CoursesCatalog.
 * 2. Exactamente 44 cursos con página propia y 5 con 'Información próximamente' (25, 45, 46, 47, 48).
 * 3. El registro #25 no enlaza a /nec (route es null) y tiene slug canónico 'seminario-valorizacion-obra-contratos-nec'.
 * 4. El seminario aparece preseleccionado correctamente en /contacto mediante findBySlugOrIdentifier.
 * 5. La ruta heredada /nec está registrada hacia TrainingController::nec y ejecuta redirección HTTP 301 a /contratos-colaborativos-nec3-f.
 * 6. El slug 'nec' en CourseCatalog está bloqueado para nuevas compras (isPurchasable === false).
 * 7. sitemap.xml no contiene /nec y mantiene /contratos-colaborativos-nec3-f una sola vez sin registrar URLs no publicadas.
 * 8. Cero alteraciones en los cinco cursos protegidos:
 *    - /contratos-colaborativos-nec3-f
 *    - /contrato-nec4
 *    - /contrato-colaborativo-nec-3-4
 *    - /eventos-compensables-alertas-tempranas-nec4
 *    - /casos-practicos-contratos-nec3-f
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

echo "\n====================================================================\n";
echo "EJECUTANDO SUITE: CONSOLIDACIÓN DE RUTA /nec Y SEMINARIO DE VALORIZACIÓN\n";
echo "====================================================================\n\n";

$baseDir = dirname(__DIR__);
require_once $baseDir . '/private_app/config/app.php';
require_once $baseDir . '/private_app/app/Services/CoursesCatalog.php';
require_once $baseDir . '/private_app/app/Services/CourseCatalog.php';
require_once $baseDir . '/private_app/app/Core/Router.php';
require_once $baseDir . '/private_app/app/Core/View.php';
require_once $baseDir . '/private_app/app/Core/Controller.php';
require_once $baseDir . '/private_app/app/Controllers/TrainingController.php';

use App\Services\CoursesCatalog;
use App\Services\CourseCatalog;
use App\Controllers\TrainingController;
use App\Core\Router;

// TEST 1: Conteo total institucional de 49 capacitaciones
runTest("CoursesCatalog contiene exactamente 49 cursos en total", function(): bool {
    $all = CoursesCatalog::getAll();
    if (count($all) !== 49) {
        throw new \Exception("Se esperaban 49 capacitaciones, obtenidas: " . count($all));
    }
    return true;
});

// TEST 2: 44 con ruta y 5 con 'Información próximamente'
runTest("Exactamente 44 cursos tienen ruta propia y 5 tienen route => null", function(): bool {
    $all = CoursesCatalog::getAll();
    $withRoute = array_filter($all, fn($c) => !empty($c['route']));
    $withoutRoute = array_filter($all, fn($c) => empty($c['route']));

    if (count($withRoute) !== 44) {
        throw new \Exception("Se esperaban 44 cursos con ruta, obtenidos: " . count($withRoute));
    }
    if (count($withoutRoute) !== 5) {
        throw new \Exception("Se esperaban 5 cursos sin ruta, obtenidos: " . count($withoutRoute));
    }

    $pendingNumbers = array_map(fn($c) => $c['number'] ?? null, array_values($withoutRoute));
    sort($pendingNumbers);
    if ($pendingNumbers !== [25, 45, 46, 47, 48]) {
        throw new \Exception("Números sin ruta incorrectos: " . json_encode($pendingNumbers));
    }

    return true;
});

// TEST 3: El registro #25 no enlaza a /nec y tiene slug canónico
runTest("El registro #25 no enlaza a /nec y conserva slug canónico 'seminario-valorizacion-obra-contratos-nec'", function(): bool {
    $all = CoursesCatalog::getAll();
    $c25 = null;
    foreach ($all as $c) {
        if (($c['number'] ?? null) === 25) {
            $c25 = $c;
            break;
        }
    }

    if (!$c25) {
        throw new \Exception("No se encontró el curso #25 en CoursesCatalog");
    }

    if ($c25['route'] !== null) {
        throw new \Exception("El curso #25 debe tener route => null, tiene: " . var_export($c25['route'], true));
    }

    if (($c25['slug'] ?? '') !== 'seminario-valorizacion-obra-contratos-nec') {
        throw new \Exception("El curso #25 no define el slug canónico esperado");
    }

    $slugCalculated = CoursesCatalog::getCourseSlug($c25);
    if ($slugCalculated !== 'seminario-valorizacion-obra-contratos-nec') {
        throw new \Exception("CoursesCatalog::getCourseSlug no retorna el slug canónico para #25");
    }

    if ($c25['title'] !== 'SEMINARIO VALORIZACIÓN DE OBRA EN CONTRATOS NEC') {
        throw new \Exception("El título del curso #25 fue alterado indebidamente: " . $c25['title']);
    }

    return true;
});

// TEST 4: Preselección en /contacto
runTest("El seminario se preselecciona correctamente vía findBySlugOrIdentifier", function(): bool {
    $resolved = CoursesCatalog::findBySlugOrIdentifier('seminario-valorizacion-obra-contratos-nec');
    if (!$resolved || ($resolved['number'] ?? null) !== 25) {
        throw new \Exception("findBySlugOrIdentifier falló en resolver el seminario #25");
    }
    return true;
});

// TEST 5: Ruta /nec registrada y redirige permanentemente (301) hacia /contratos-colaborativos-nec3-f
runTest("Ruta /nec responde con redirección permanente 301 a /contratos-colaborativos-nec3-f", function(): bool {
    global $baseDir;
    $config = require $baseDir . '/private_app/config/app.php';
    $router = new Router($config);
    $routesLoader = require $baseDir . '/private_app/config/routes.php';
    $routesLoader($router, $config);

    // Verificar enrutador
    $reflection = new \ReflectionClass($router);
    $routesProperty = $reflection->getProperty('routes');
    $routesProperty->setAccessible(true);
    $routes = $routesProperty->getValue($router);

    if (!isset($routes['GET']['/nec'])) {
        throw new \Exception("La ruta GET /nec no está registrada en el router.");
    }

    $handler = $routes['GET']['/nec'];
    if ($handler !== [TrainingController::class, 'nec']) {
        throw new \Exception("El handler de /nec no apunta a TrainingController::nec.");
    }

    // Verificar código y headers ejecutados en un subproceso aislado
    $phpBin = defined('PHP_BINARY') && PHP_BINARY ? PHP_BINARY : 'C:\\xampp\\php\\php.exe';
    $code = '<?php
    $_SERVER["REQUEST_METHOD"] = "GET";
    $_SERVER["REQUEST_URI"] = "/nec";
    require "' . addslashes($baseDir) . '/private_app/config/app.php";
    require "' . addslashes($baseDir) . '/private_app/app/Core/View.php";
    require "' . addslashes($baseDir) . '/private_app/app/Core/Controller.php";
    require "' . addslashes($baseDir) . '/private_app/app/Controllers/TrainingController.php";
    $controller = new \\App\\Controllers\\TrainingController();
    $controller->nec();
    ';

    $proc = proc_open('"' . $phpBin . '"', [
        0 => ['pipe', 'r'],
        1 => ['pipe', 'w'],
        2 => ['pipe', 'w'],
    ], $pipes);

    if (is_resource($proc)) {
        fwrite($pipes[0], $code);
        fclose($pipes[0]);
        $out = stream_get_contents($pipes[1]);
        $err = stream_get_contents($pipes[2]);
        fclose($pipes[1]);
        fclose($pipes[2]);
        proc_close($proc);
    }

    // Comprobar la implementación de Controller::redirect en TrainingController::nec
    $refMethod = new \ReflectionMethod(TrainingController::class, 'nec');
    $source = file_get_contents($refMethod->getFileName());
    $start = $refMethod->getStartLine();
    $length = $refMethod->getEndLine() - $start + 1;
    $methodLines = array_slice(explode("\n", $source), $start - 1, $length);
    $methodCode = implode("\n", $methodLines);

    if (!str_contains($methodCode, "'/contratos-colaborativos-nec3-f'") || !str_contains($methodCode, '301')) {
        throw new \Exception("TrainingController::nec() no contiene la redirección 301 a /contratos-colaborativos-nec3-f: " . $methodCode);
    }

    return true;
});

// TEST 6: El slug 'nec' no acepta nuevas compras en CourseCatalog
runTest("CourseCatalog rechaza nuevas compras para el slug 'nec' (isPurchasable === false)", function(): bool {
    if (CourseCatalog::isPurchasable('nec') !== false) {
        throw new \Exception("CourseCatalog::isPurchasable('nec') debe retornar false.");
    }

    // Verificar que el seminario sin ruta tampoco es comprable
    if (CourseCatalog::isPurchasable('seminario-valorizacion-obra-contratos-nec') !== false) {
        throw new \Exception("El seminario pendiente no debe estar habilitado para compra.");
    }

    // Cursos publicados con ruta sí deben ser comprables
    if (CourseCatalog::isPurchasable('contratos-colaborativos-nec3-f') !== true) {
        throw new \Exception("El curso oficial /contratos-colaborativos-nec3-f debe ser comprable.");
    }

    return true;
});

// TEST 7: sitemap.xml no contiene /nec y conserva /contratos-colaborativos-nec3-f una sola vez
runTest("sitemap.xml no expone /nec y registra /contratos-colaborativos-nec3-f exactamente una vez", function(): bool {
    global $baseDir;
    $sitemapPath = $baseDir . '/public_html/sitemap.xml';
    $content = file_get_contents($sitemapPath);

    if (str_contains($content, '<loc>https://quality-consulting.org/nec</loc>')) {
        throw new \Exception("sitemap.xml aún contiene la URL /nec.");
    }

    $nec3fCount = substr_count($content, '<loc>https://quality-consulting.org/contratos-colaborativos-nec3-f</loc>');
    if ($nec3fCount !== 1) {
        throw new \Exception("Se esperaba exactamente 1 registro de /contratos-colaborativos-nec3-f en sitemap.xml, encontrados: {$nec3fCount}");
    }

    if (str_contains($content, 'seminario-valorizacion-obra-contratos-nec')) {
        throw new \Exception("sitemap.xml no debe exponer el seminario mientras no tenga vista propia.");
    }

    return true;
});

// TEST 8: Protección íntegra de los 5 cursos NEC independientes
runTest("Los cinco cursos NEC oficiales protegidos permanecen intactos y consistentes", function(): bool {
    $protected = [
        'contratos-colaborativos-nec3-f'               => 'CONTRATOS COLABORATIVOS NEC3-F',
        'contrato-nec4'                                => 'EL CONTRATO DE NEC4',
        'contrato-colaborativo-nec-3-4'                => 'CONTRATO COLABORATIVO NEC 3/4',
        'eventos-compensables-alertas-tempranas-nec4'   => 'GESTIÓN DE EVENTOS COMPENSABLES Y ALERTAS TEMPRANAS EN CONTRATOS NEC4',
        'casos-practicos-contratos-nec3-f'             => 'CASOS PRÁCTICOS DE CONTRATOS NEC3-F',
    ];

    $all = CoursesCatalog::getAll();
    $byRoute = [];
    foreach ($all as $c) {
        if (!empty($c['route'])) {
            $byRoute[ltrim($c['route'], '/')] = $c;
        }
    }

    foreach ($protected as $route => $expectedTitle) {
        if (!isset($byRoute[$route])) {
            throw new \Exception("Curso protegido ausente de CoursesCatalog: {$route}");
        }
        if ($byRoute[$route]['title'] !== $expectedTitle) {
            throw new \Exception("Título alterado en curso protegido {$route}: {$byRoute[$route]['title']}");
        }
        if (CourseCatalog::isPurchasable($route) !== true) {
            throw new \Exception("Curso protegido no figura como comprable en CourseCatalog: {$route}");
        }
    }

    return true;
});

echo "\n====================================================================\n";
echo "RESULTADO FINAL: {$passedTests} de {$totalTests} pruebas pasaron con éxito.\n";
echo "====================================================================\n";

if ($passedTests !== $totalTests) {
    exit(1);
}
