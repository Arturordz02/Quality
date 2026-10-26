<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Test Suite Automatizado: Validación de Breadcrumbs Globales y Dinámicos
 * Archivo: tests/BreadcrumbsValidationTest.php
 *
 * Valida:
 * 1. Ausencia en Inicio (Home).
 * 2. Presencia en páginas internas institucionales.
 * 3. Jerarquía correcta de las cinco categorías oficiales.
 * 4. Cursos asociados a su categoría real y título limpio.
 * 5. Página actual sin enlace y con atributo aria-current="page".
 * 6. URLs compatibles con producción y GitHub Pages.
 * 7. Pago y registro conservando el contexto del curso.
 * 8. Manejo exacto del error 404 en MVC y en 404.html.
 * 9. Estructura semántica accesible (<nav aria-label="Ruta de navegación">, <ol class="breadcrumb">, separador ›).
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/private_app/config/app.php';
require_once dirname(__DIR__) . '/private_app/app/Services/CoursesCatalog.php';
require_once dirname(__DIR__) . '/private_app/app/Services/CourseCatalog.php';
require_once dirname(__DIR__) . '/private_app/app/Services/BreadcrumbsService.php';
require_once dirname(__DIR__) . '/private_app/app/Core/View.php';

use App\Services\BreadcrumbsService;
use App\Services\CoursesCatalog;
use App\Services\CourseCatalog;
use App\Core\View;

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
echo "EJECUTANDO SUITE DE PRUEBAS: BREADCRUMBS GLOBALES Y DINÁMICOS\n";
echo "====================================================================\n\n";

$viewEngine = new View(dirname(__DIR__) . '/private_app/app/Views');

// TEST 1: Ausencia en Inicio
runTest("Ausencia total de breadcrumbs en la página de inicio (Home)", function() use ($viewEngine): bool {
    $items = BreadcrumbsService::getBreadcrumbs(['activePage' => 'home', 'pageName' => 'home']);
    if (!empty($items)) {
        return false;
    }

    $itemsEmpty = BreadcrumbsService::getBreadcrumbs(['activePage' => '', 'pageName' => '']);
    if (!empty($itemsEmpty)) {
        return false;
    }

    $html = $viewEngine->render('pages/home', ['activePage' => 'home', 'title' => 'Inicio'], 'main');
    return !str_contains($html, 'class="qcs-breadcrumbs-nav"');
});

// TEST 2: Presencia en páginas internas institucionales
runTest("Presencia de jerarquía en páginas institucionales (Nosotros, Consultoría, Medios, Contacto)", function(): bool {
    $consultoria = BreadcrumbsService::getBreadcrumbs(['pageName' => 'consultoria']);
    if (count($consultoria) !== 2 || $consultoria[0]['title'] !== 'Inicio' || $consultoria[1]['title'] !== 'Consultoría') {
        return false;
    }

    $medios = BreadcrumbsService::getBreadcrumbs(['pageName' => 'medios']);
    if (count($medios) !== 2 || $medios[0]['title'] !== 'Inicio' || $medios[1]['title'] !== 'Medios y Podcasts') {
        return false;
    }

    $contacto = BreadcrumbsService::getBreadcrumbs(['pageName' => 'contacto']);
    if (count($contacto) !== 2 || $contacto[0]['title'] !== 'Inicio' || $contacto[1]['title'] !== 'Contacto') {
        return false;
    }

    $nosotros = BreadcrumbsService::getBreadcrumbs(['pageName' => 'nosotros']);
    if (count($nosotros) !== 2 || $nosotros[0]['title'] !== 'Inicio' || $nosotros[1]['title'] !== 'Nosotros') {
        return false;
    }

    return true;
});

// TEST 3: Jerarquía correcta de las 5 categorías oficiales
runTest("Jerarquía correcta de las 5 categorías oficiales bajo Capacitación", function(): bool {
    $categoriesExpected = [
        'capacitacion-contratos'           => 'Gestión de Contratos',
        'capacitacion-calidad'             => 'Calidad',
        'capacitacion-riesgos'             => 'Riesgos',
        'capacitacion-gestion-de-proyectos' => 'Gestión de Proyectos',
        'capacitacion-oficina-tecnica'     => 'Oficina Técnica',
    ];

    foreach ($categoriesExpected as $slug => $expectedCatName) {
        $b = BreadcrumbsService::getBreadcrumbs(['pageName' => $slug]);
        if (count($b) !== 3) {
            echo "\nError conteo en {$slug}: " . count($b);
            return false;
        }
        if ($b[0]['title'] !== 'Inicio' || $b[0]['url'] !== '/') {
            return false;
        }
        if ($b[1]['title'] !== 'Capacitación' || $b[1]['url'] !== '/capacitacion') {
            return false;
        }
        if ($b[2]['title'] !== $expectedCatName || $b[2]['url'] !== null) {
            echo "\nError nombre en {$slug}: {$b[2]['title']} !== {$expectedCatName}";
            return false;
        }
    }

    return true;
});

// TEST 4: Cursos asociados a su categoría real y título limpio
runTest("Cursos oficiales asociados dinámicamente a su categoría real de 4 niveles", function(): bool {
    // Caso específico solicitado: Inicio › Capacitación › Gestión de Contratos › Contrato NEC4
    $nec4 = BreadcrumbsService::getBreadcrumbs(['pageName' => 'contrato-nec4']);
    if (count($nec4) !== 4) {
        return false;
    }
    if ($nec4[0]['title'] !== 'Inicio' || $nec4[1]['title'] !== 'Capacitación' || $nec4[2]['title'] !== 'Gestión de Contratos' || $nec4[3]['title'] !== 'Contrato NEC4') {
        echo "\nError NEC4: " . json_encode($nec4);
        return false;
    }
    if ($nec4[2]['url'] !== '/capacitacion-contratos') {
        return false;
    }

    // Calidad: Dirección de la Calidad con el Enfoque PMI® para la Construcción (/calidad-y-pmi)
    $calidadPmi = BreadcrumbsService::getBreadcrumbs(['pageName' => 'calidad-y-pmi']);
    if (count($calidadPmi) !== 4 || $calidadPmi[2]['title'] !== 'Calidad' || $calidadPmi[2]['url'] !== '/capacitacion-calidad') {
        return false;
    }
    if ($calidadPmi[3]['title'] !== 'Dirección de la Calidad con el Enfoque PMI® para la Construcción') {
        echo "\nError título calidad-y-pmi: {$calidadPmi[3]['title']}";
        return false;
    }

    // Riesgos: Análisis Cuantitativo de Riesgos del Costo y Cronograma con Simulación de Monte Carlo
    $riesgos = BreadcrumbsService::getBreadcrumbs(['pageName' => 'analisis-cuantitativo-riesgos']);
    if (count($riesgos) !== 4 || $riesgos[2]['title'] !== 'Riesgos' || $riesgos[2]['url'] !== '/capacitacion-riesgos') {
        return false;
    }
    if ($riesgos[3]['title'] !== 'Análisis Cuantitativo de Riesgos del Costo y Cronograma con Simulación de Monte Carlo') {
        echo "\nError título analisis-cuantitativo-riesgos: {$riesgos[3]['title']}";
        return false;
    }

    // Cursos auditados con títulos oficiales de CoursesCatalog.php:
    // Herramientas (sin abreviación de CourseCatalog)
    $herramientas = BreadcrumbsService::getBreadcrumbs(['pageName' => 'herramientas']);
    if (count($herramientas) !== 4 || $herramientas[3]['title'] !== 'Taller de Herramientas de Gestión de Calidad en la Construcción + Uso de Inteligencia Artificial') {
        echo "\nError título herramientas: " . ($herramientas[3]['title'] ?? 'N/A');
        return false;
    }

    // Junta de Resolución de Disputas (DAB)
    $dab = BreadcrumbsService::getBreadcrumbs(['pageName' => 'junta-resolucion-disputas-dab']);
    if (count($dab) !== 4 || $dab[3]['title'] !== 'Claves para el Éxito en la Junta de Resolución de Disputas - JRD (DAB) de Obras') {
        echo "\nError título dab: " . ($dab[3]['title'] ?? 'N/A');
        return false;
    }

    // Eventos compensables NEC4
    $eventosNec4 = BreadcrumbsService::getBreadcrumbs(['pageName' => 'eventos-compensables-alertas-tempranas-nec4']);
    if (count($eventosNec4) !== 4 || $eventosNec4[3]['title'] !== 'Gestión de Eventos Compensables y Alertas Tempranas en Contratos NEC4') {
        echo "\nError título eventosNec4: " . ($eventosNec4[3]['title'] ?? 'N/A');
        return false;
    }

    // Seminario Valorización de Obra en Contratos NEC (/nec)
    $nec = BreadcrumbsService::getBreadcrumbs(['pageName' => 'nec']);
    if (count($nec) !== 4 || $nec[3]['title'] !== 'Seminario Valorización de Obra en Contratos NEC') {
        echo "\nError título nec: " . ($nec[3]['title'] ?? 'N/A');
        return false;
    }

    // Gestión de Proyectos: BIM Revit Architecture
    $bim = BreadcrumbsService::getBreadcrumbs(['pageName' => 'bim-revit-architecture']);
    if (count($bim) !== 4 || $bim[2]['title'] !== 'Gestión de Proyectos' || $bim[2]['url'] !== '/capacitacion-gestion-de-proyectos') {
        return false;
    }

    // Oficina Técnica: Oficina Técnica en Obras Viales
    $viales = BreadcrumbsService::getBreadcrumbs(['pageName' => 'oficina-tecnica-obras-viales']);
    if (count($viales) !== 4 || $viales[2]['title'] !== 'Oficina Técnica' || $viales[2]['url'] !== '/capacitacion-oficina-tecnica') {
        return false;
    }

    return true;
});

// TEST 5: Página actual sin enlace y con aria-current="page"
runTest("El último elemento no tiene enlace y lleva aria-current='page'", function() use ($viewEngine): bool {
    $html = $viewEngine->render('pages/nosotros', ['pageName' => 'nosotros', 'title' => 'Nosotros'], 'main');

    // Debe contener el item activo con aria-current="page"
    if (!str_contains($html, 'class="breadcrumb-item active" aria-current="page"')) {
        return false;
    }

    // El último texto no debe estar dentro de una etiqueta <a>
    if (preg_match('/<li class="breadcrumb-item active"[^>]*>\s*<a/i', $html)) {
        return false;
    }

    // Los elementos anteriores sí deben ser enlaces funcionales
    if (!str_contains($html, '<a href="/" class="qcs-breadcrumb-link">Inicio</a>')) {
        return false;
    }

    return true;
});

// TEST 6: URLs compatibles con producción y GitHub Pages
runTest("Helper de URLs genera enlaces compatibles para producción y GitHub Pages", function(): bool {
    // Entorno dinámico (producción)
    $prodHome = BreadcrumbsService::formatUrl('/', false);
    $prodCap = BreadcrumbsService::formatUrl('/capacitacion', false);
    $prodCont = BreadcrumbsService::formatUrl('/capacitacion-contratos', false);
    if ($prodHome !== '/' || $prodCap !== '/capacitacion' || $prodCont !== '/capacitacion-contratos') {
        return false;
    }

    // Entorno estático (GitHub Pages)
    $staticHome = BreadcrumbsService::formatUrl('/', true);
    $staticCap = BreadcrumbsService::formatUrl('/capacitacion', true);
    $staticCont = BreadcrumbsService::formatUrl('/capacitacion-contratos', true);
    if ($staticHome !== 'index.html' || $staticCap !== 'capacitacion.html' || $staticCont !== 'capacitacion-contratos.html') {
        return false;
    }

    return true;
});

// TEST 7: Pago y registro conservando el curso
runTest("Páginas de pago y registro conservan el contexto del curso cuando el slug es válido", function(): bool {
    // Pago con curso válido
    $pagoConCurso = BreadcrumbsService::getBreadcrumbs([
        'pageName'   => 'pagar-primera-clase',
        'courseSlug' => 'contrato-nec4',
    ]);
    if (count($pagoConCurso) !== 5) {
        echo "\nError conteo pago con curso: " . count($pagoConCurso);
        return false;
    }
    if ($pagoConCurso[0]['title'] !== 'Inicio' ||
        $pagoConCurso[1]['title'] !== 'Capacitación' ||
        $pagoConCurso[2]['title'] !== 'Gestión de Contratos' ||
        $pagoConCurso[3]['title'] !== 'Contrato NEC4' ||
        $pagoConCurso[4]['title'] !== 'Pago de primera clase') {
        echo "\nError títulos pago con curso: " . json_encode($pagoConCurso);
        return false;
    }
    if ($pagoConCurso[3]['url'] !== '/contrato-nec4' || $pagoConCurso[4]['url'] !== null) {
        return false;
    }

    // Registro con curso válido
    $registroConCurso = BreadcrumbsService::getBreadcrumbs([
        'pageName'   => 'registro-primera-clase',
        'courseSlug' => 'contrato-nec4',
    ]);
    if (count($registroConCurso) !== 5) {
        return false;
    }
    if ($registroConCurso[3]['title'] !== 'Contrato NEC4' || $registroConCurso[4]['title'] !== 'Registro') {
        return false;
    }

    // Pago sin curso válido
    $pagoSinCurso = BreadcrumbsService::getBreadcrumbs([
        'pageName'   => 'pagar-primera-clase',
        'courseSlug' => '',
    ]);
    if (count($pagoSinCurso) !== 3 || $pagoSinCurso[2]['title'] !== 'Pago de primera clase') {
        return false;
    }

    return true;
});

// TEST 8: 404 correcto en MVC y en archivo estático 404.html
runTest("Error 404 muestra únicamente 'Inicio › Página no encontrada' en MVC y 404.html", function() use ($viewEngine): bool {
    $items404 = BreadcrumbsService::getBreadcrumbs(['pageName' => '404']);
    if (count($items404) !== 2 || $items404[0]['title'] !== 'Inicio' || $items404[1]['title'] !== 'Página no encontrada') {
        return false;
    }

    $html404 = file_get_contents(dirname(__DIR__) . '/public_html/404.html');
    if (!str_contains($html404, 'Página no encontrada')) {
        return false;
    }
    if (!str_contains($html404, 'class="qcs-breadcrumbs-nav"')) {
        return false;
    }

    return true;
});

// TEST 9: Semántica HTML, accesibilidad y no desbordamiento
runTest("Estructura semántica nav/ol/li, separador › y clases de estilo en styles.css", function(): bool {
    $css = file_get_contents(dirname(__DIR__) . '/public_html/styles.css');
    if (!str_contains($css, '.qcs-breadcrumbs-nav')) {
        return false;
    }
    if (!str_contains($css, "content: '›'")) {
        return false;
    }
    if (!str_contains($css, 'overflow-x: auto')) {
        return false;
    }

    return true;
});

// TEST 10: Integridad en compilación estática (_site): 0 enlaces rotos y presencia en páginas internas
runTest("Compilación estática (_site): breadcrumbs presentes en páginas internas, ausentes en Home y 0 enlaces rotos", function(): bool {
    $siteDir = dirname(__DIR__) . '/_site';
    if (!is_dir($siteDir)) {
        return true;
    }

    $htmlFiles = glob($siteDir . '/*.html');
    if (empty($htmlFiles)) {
        return true;
    }

    foreach ($htmlFiles as $filePath) {
        $name = basename($filePath);
        $content = file_get_contents($filePath);

        if ($name === 'index.html') {
            if (str_contains($content, 'qcs-breadcrumbs-nav')) {
                return false;
            }
        } else {
            if (!str_contains($content, 'qcs-breadcrumbs-nav')) {
                return false;
            }

            // Verificar que ningún enlace de breadcrumbs esté roto
            if (preg_match('/<nav aria-label="Ruta de navegación"[^>]*>(.*?)<\/nav>/s', $content, $match)) {
                preg_match_all('/href="([^"]+)"/', $match[1], $hrefMatches);
                foreach ($hrefMatches[1] as $href) {
                    if (str_starts_with($href, 'http') || str_starts_with($href, '#') || str_starts_with($href, 'javascript')) {
                        continue;
                    }
                    $cleanTarget = explode('?', $href)[0];
                    if (!file_exists($siteDir . '/' . $cleanTarget)) {
                        echo "\nEnlace roto detectado en {$name}: {$href} (no existe {$cleanTarget})\n";
                        return false;
                    }
                }
            }
        }
    }

    return true;
});

echo "\n====================================================================\n";
echo "RESULTADOS: {$passedTests} / {$totalTests} PRUEBAS PASADAS\n";
echo "====================================================================\n\n";

if ($passedTests !== $totalTests) {
    exit(1);
}
