<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Test Suite Automatizado: Separación Estructural de Capacitaciones PMI
 * (Curso 3: Enfoque PMI vs Curso 5: Dirección de la Calidad PMI para la Construcción)
 *
 * Verificaciones requeridas:
 * 1. El curso 3 conserva la ruta /calidad-y-pmi y sus imágenes originales.
 * 2. El curso 5 utiliza /direccion-calidad-enfoque-pmi y su brochure oficial.
 * 3. Las dos rutas existen en el router de la aplicación.
 * 4. Las dos rutas generan páginas diferentes en _site.
 * 5. La página antigua conserva "Enfoque PMI de la Gestión de la Calidad".
 * 6. La página nueva contiene "Dirección de la Calidad con el Enfoque PMI".
 * 7. El slug nuevo 'direccion-calidad-enfoque-pmi' está registrado en CourseCatalog para pagos.
 * 8. La página nueva no contiene videos heredados ('videos' => []).
 * 9. El curso 5 tiene imagen propia en public_html y no reutiliza capmi1.
 * 10. El curso 5 contiene 16 PDU y 15 horas netas como datos separados.
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/private_app/config/app.php';
require_once dirname(__DIR__) . '/private_app/app/Services/CoursesCatalog.php';
require_once dirname(__DIR__) . '/private_app/app/Services/CourseCatalog.php';
require_once dirname(__DIR__) . '/private_app/app/Core/Router.php';
require_once dirname(__DIR__) . '/private_app/app/Core/Controller.php';
require_once dirname(__DIR__) . '/private_app/app/Controllers/TrainingController.php';

use App\Services\CoursesCatalog;
use App\Services\CourseCatalog;
use App\Core\Router;

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

echo "\n=======================================================\n";
echo "EJECUTANDO SUITE DE PRUEBAS: SEPARACIÓN DE CURSOS PMI (3 Y 5)\n";
echo "=======================================================\n\n";

$courses = CoursesCatalog::getAll();
$course3 = null;
$course5 = null;
foreach ($courses as $c) {
    if (($c['number'] ?? null) === 3) {
        $course3 = $c;
    }
    if (($c['number'] ?? null) === 5) {
        $course5 = $c;
    }
}

// 1. El curso 3 conserva /calidad-y-pmi
runTest("El curso 3 conserva '/calidad-y-pmi', imagen 'capmi1' y no tiene el nuevo brochure", function () use ($course3) {
    if (!$course3) {
        throw new \Exception("Curso 3 no encontrado en CoursesCatalog.");
    }
    if ($course3['route'] !== '/calidad-y-pmi') {
        throw new \Exception("Curso 3 no tiene ruta /calidad-y-pmi: " . $course3['route']);
    }
    if (!str_contains($course3['image'], 'capmi1')) {
        throw new \Exception("Curso 3 no conserva imagen capmi1: " . $course3['image']);
    }
    if (!empty($course3['brochure'])) {
        throw new \Exception("Curso 3 no debe tener brochure asignado: " . $course3['brochure']);
    }
    if (!str_contains(mb_strtoupper($course3['title']), 'ENFOQUE PMI DE LA GESTIÓN DE LA CALIDAD')) {
        throw new \Exception("Título de curso 3 no coincide.");
    }
    return true;
});

// 2. El curso 5 utiliza /direccion-calidad-enfoque-pmi sin publicar brochures
runTest("El curso 5 utiliza '/direccion-calidad-enfoque-pmi' sin brochure público", function () use ($course5) {
    if (!$course5) {
        throw new \Exception("Curso 5 no encontrado en CoursesCatalog.");
    }
    if ($course5['route'] !== '/direccion-calidad-enfoque-pmi') {
        throw new \Exception("Curso 5 no tiene la ruta esperada: " . $course5['route']);
    }
    if (array_key_exists('brochure', $course5) || !empty($course5['brochure'] ?? null)) {
        throw new \Exception("Curso 5 no debe exponer una propiedad de brochure público.");
    }
    if (!str_contains(mb_strtoupper($course5['title']), 'DIRECCIÓN DE LA CALIDAD CON EL ENFOQUE PMI')) {
        throw new \Exception("Título de curso 5 no coincide: " . $course5['title']);
    }
    return true;
});

// 3. Las dos rutas existen en el router
runTest("Las dos rutas existen registradas en el Router del sistema", function () {
    $config = require dirname(__DIR__) . '/private_app/config/app.php';
    $router = new Router($config);
    $routesLoader = require dirname(__DIR__) . '/private_app/config/routes.php';
    $routesLoader($router, $config);

    $routes = $router->getRoutes()['GET'] ?? [];

    if (!isset($routes['/calidad-y-pmi'])) {
        throw new \Exception("Ruta /calidad-y-pmi no está registrada en el Router.");
    }
    if (!isset($routes['/direccion-calidad-enfoque-pmi'])) {
        throw new \Exception("Ruta /direccion-calidad-enfoque-pmi no está registrada en el Router.");
    }

    if (!method_exists(\App\Controllers\TrainingController::class, 'calidadPmi')) {
        throw new \Exception("Método TrainingController::calidadPmi no existe.");
    }
    if (!method_exists(\App\Controllers\TrainingController::class, 'direccionCalidadEnfoquePmi')) {
        throw new \Exception("Método TrainingController::direccionCalidadEnfoquePmi no existe.");
    }

    return true;
});

// 4. Las dos rutas generan páginas diferentes
runTest("Las dos rutas generan archivos HTML distintos en _site", function () {
    $oldFile = dirname(__DIR__) . '/_site/calidad-y-pmi.html';
    $newFile = dirname(__DIR__) . '/_site/direccion-calidad-enfoque-pmi.html';

    if (!file_exists($oldFile) || !file_exists($newFile)) {
        throw new \Exception("Faltan archivos compilados en _site.");
    }

    $oldContent = file_get_contents($oldFile);
    $newContent = file_get_contents($newFile);

    if ($oldContent === false || $newContent === false) {
        throw new \Exception("No se pudieron leer los archivos compilados.");
    }

    if ($oldContent === $newContent) {
        throw new \Exception("Los contenidos de ambas páginas son idénticos, deben ser diferentes.");
    }

    $oldDirIndex = dirname(__DIR__) . '/_site/calidad-y-pmi/index.html';
    $newDirIndex = dirname(__DIR__) . '/_site/direccion-calidad-enfoque-pmi/index.html';
    if (!file_exists($oldDirIndex) || !file_exists($newDirIndex)) {
        throw new \Exception("Faltan archivos index.html en subdirectorios de _site.");
    }

    return true;
});

// 5. La página antigua conserva "Enfoque PMI de la Gestión de la Calidad"
runTest("La página antigua conserva 'Enfoque PMI de la Gestión de la Calidad' sin nuevo brochure", function () {
    $oldFile = dirname(__DIR__) . '/_site/calidad-y-pmi.html';
    $content = file_get_contents($oldFile);
    if (!str_contains($content, 'ENFOQUE PMI DE LA GESTIÓN DE LA CALIDAD')) {
        throw new \Exception("La página antigua no contiene el título original.");
    }
    if (str_contains($content, 'direccion-calidad-enfoque-pmi.pdf')) {
        throw new \Exception("La página antigua contiene indebidamente el nuevo brochure.");
    }
    return true;
});

// 6. La página nueva contiene "Dirección de la Calidad con el Enfoque PMI"
runTest("La página nueva contiene 'Dirección de la Calidad con el Enfoque PMI'", function () {
    $newFile = dirname(__DIR__) . '/_site/direccion-calidad-enfoque-pmi.html';
    $content = file_get_contents($newFile);
    if (!str_contains($content, 'DIRECCIÓN DE LA CALIDAD CON EL ENFOQUE PMI')) {
        throw new \Exception("La página nueva no contiene el título oficial.");
    }
    return true;
});

// 7. El slug nuevo está registrado en el flujo de pagos
runTest("El slug 'direccion-calidad-enfoque-pmi' está registrado en CourseCatalog", function () {
    if (!CourseCatalog::isValid('direccion-calidad-enfoque-pmi')) {
        throw new \Exception("El slug 'direccion-calidad-enfoque-pmi' no es reconocido por CourseCatalog.");
    }
    $info = CourseCatalog::find('direccion-calidad-enfoque-pmi');
    if (!$info || $info['url'] !== '/direccion-calidad-enfoque-pmi') {
        throw new \Exception("La URL configurada en CourseCatalog no coincide.");
    }
    return true;
});

// 8. La página nueva no contiene videos heredados
runTest("La página nueva no contiene videos heredados ('videos' => [])", function () {
    $newFile = dirname(__DIR__) . '/_site/direccion-calidad-enfoque-pmi.html';
    $content = file_get_contents($newFile);

    // Los dos videos heredados del curso anterior
    if (str_contains($content, 'hbwy_uESkzI') || str_contains($content, 'w-hf9BtsF0Q')) {
        throw new \Exception("La página nueva contiene videos heredados del curso anterior.");
    }
    if (str_contains($content, 'qcs-cd-video-card')) {
        throw new \Exception("La página nueva renderizó tarjetas de video indebidamente.");
    }

    $viewContent = file_get_contents(dirname(__DIR__) . '/private_app/app/Views/pages/direccion-calidad-enfoque-pmi.php');
    if (!str_contains($viewContent, "'videos'              => []") && !str_contains($viewContent, "'videos' => []")) {
        throw new \Exception("La vista de la página no tiene 'videos' => [].");
    }

    return true;
});

// 9. El curso 5 tiene imagen propia
runTest("El curso 5 tiene imágenes propias en public_html y no reutiliza capmi1", function () use ($course5) {
    $png = dirname(__DIR__) . '/public_html/img/capacitaciones/direccion-calidad-enfoque-pmi.png';
    $webp = dirname(__DIR__) . '/public_html/img/capacitaciones/direccion-calidad-enfoque-pmi.webp';
    $thumb = dirname(__DIR__) . '/public_html/img/brochures/portada-direccion-calidad-enfoque-pmi.png';

    if (!file_exists($png) || !file_exists($webp) || !file_exists($thumb)) {
        throw new \Exception("Faltan recursos visuales requeridos para el curso 5.");
    }

    if (str_contains($course5['image'], 'capmi1') || str_contains($course5['image_fallback'], 'capmi1')) {
        throw new \Exception("El curso 5 reutiliza indebidamente capmi1.");
    }

    return true;
});

// 10. El curso 5 contiene 16 PDU y 15 horas netas como datos separados
runTest("El curso 5 contiene 16 PDU y 15 horas netas como datos separados", function () {
    $viewContent = file_get_contents(dirname(__DIR__) . '/private_app/app/Views/pages/direccion-calidad-enfoque-pmi.php');
    $htmlContent = file_get_contents(dirname(__DIR__) . '/_site/direccion-calidad-enfoque-pmi.html');

    $hasSeparatePdu = str_contains($viewContent, "'pdu'") && str_contains($viewContent, '16 PDU');
    $hasSeparateHours = str_contains($viewContent, "'hours'") && str_contains($viewContent, '15 horas netas');
    $hasPduInHtml = str_contains($htmlContent, '16 PDU');
    $hasHoursInHtml = str_contains($htmlContent, '15 horas netas');

    if (!$hasSeparatePdu || !$hasSeparateHours || !$hasPduInHtml || !$hasHoursInHtml) {
        throw new \Exception("PDU (16 PDU) u horas netas (15 horas netas) no están configuradas correctamente por separado.");
    }

    return true;
});

echo "\n-------------------------------------------------------\n";
echo "RESULTADOS: {$passedTests} de {$totalTests} pruebas pasadas con éxito.\n";
echo "-------------------------------------------------------\n\n";

if ($passedTests !== $totalTests) {
    exit(1);
}
exit(0);
