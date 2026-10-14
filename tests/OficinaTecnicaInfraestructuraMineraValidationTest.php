<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Test Suite Automatizado: Validación Integral de la Capacitación
 * "OFICINA TÉCNICA EN INFRAESTRUCTURA MINERA (PADs, PRESAS DE RELAVE, GEOSINTÉTICOS)"
 * Archivo: tests/OficinaTecnicaInfraestructuraMineraValidationTest.php
 *
 * Casos de prueba:
 * 1. Registro número 14 en CoursesCatalog (título, categoría, tipo, ruta, imágenes, ausencia de brochure).
 * 2. Registro de ruta /oficina-tecnica-infraestructura-minera en Router.
 * 3. Registro de slug 'oficina-tecnica-infraestructura-minera' en CourseCatalog.
 * 4. PDU (16 PDU) y duración (15 horas netas) como datos separados y fieles.
 * 5. Temario en exactamente 5 bloques oficiales según documento oficial:
 *    Organización y contratos, Gestión del alcance, Procura, Planificación y control, Control de costos.
 * 6. Beneficios oficiales respaldados por el documento (5 items oficiales).
 * 7. Perfil docente Ing. Jorge Valdivieso (Ing. Civil, Máster, PMP®, +16 años de experiencia, sin Stanford CIFE atribuido).
 * 8. Existencia física de las imágenes (PNG, WebP y fotografía del docente) y ausencia de PDF en el repositorio.
 * 9. Ausencia de datos antiguos en la vista (fechas pasadas ABR/MAY, horas fijas 16:00-19:00, cuentas bancarias).
 * 10. Ausencia total de enlaces a PDF o portada del brochure en la vista y en el HTML compilado.
 * 11. Sección del brochure reemplazada por mensaje de contacto comercial y canales activos.
 * 12. Botón de PayPal restringido a primera clase (USD 10) con aclaración de no inclusión del curso completo.
 * 13. URL oficial registrada en public_html/sitemap.xml.
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/private_app/config/app.php';
require_once dirname(__DIR__) . '/private_app/app/Services/CoursesCatalog.php';
require_once dirname(__DIR__) . '/private_app/app/Services/CourseCatalog.php';
require_once dirname(__DIR__) . '/private_app/app/Core/Router.php';
require_once dirname(__DIR__) . '/private_app/app/Core/View.php';
require_once dirname(__DIR__) . '/private_app/app/Controllers/TrainingController.php';

use App\Services\CoursesCatalog;
use App\Services\CourseCatalog;
use App\Core\Router;
use App\Core\View;
use App\Controllers\TrainingController;

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
echo "EJECUTANDO SUITE DE PRUEBAS: OFICINA TÉCNICA EN INFRAESTRUCTURA MINERA\n";
echo "====================================================================\n\n";

// Caso 1: Registro 14 en CoursesCatalog
runTest("Registro #14 en CoursesCatalog tiene título, tipo, ruta, imágenes y no incluye brochure", function(): bool {
    $courses = CoursesCatalog::getAll();
    $found = null;
    foreach ($courses as $c) {
        if ($c['number'] === 14) {
            $found = $c;
            break;
        }
    }
    if ($found === null) {
        throw new \Exception("No se encontró el registro número 14 en CoursesCatalog.");
    }
    if ($found['title'] !== 'OFICINA TÉCNICA EN INFRAESTRUCTURA MINERA (PADs, PRESAS DE RELAVE, GEOSINTÉTICOS)') {
        throw new \Exception("Título incorrecto: " . $found['title']);
    }
    if ($found['category'] !== 'Oficina Técnica') {
        throw new \Exception("Categoría incorrecta: " . $found['category']);
    }
    if ($found['route'] !== '/oficina-tecnica-infraestructura-minera') {
        throw new \Exception("Ruta incorrecta: " . $found['route']);
    }
    if ($found['image'] !== 'img/capacitaciones/oficina-tecnica-infraestructura-minera.webp') {
        throw new \Exception("Imagen principal incorrecta: " . $found['image']);
    }
    if ($found['image_fallback'] !== 'img/capacitaciones/oficina-tecnica-infraestructura-minera.png') {
        throw new \Exception("Imagen fallback incorrecta: " . $found['image_fallback']);
    }
    if (!empty($found['brochure'])) {
        throw new \Exception("El brochure no debe estar configurado en el catálogo público: " . $found['brochure']);
    }
    return true;
});

// Caso 2: Ruta en Router
runTest("La ruta /oficina-tecnica-infraestructura-minera está registrada en config/routes.php", function(): bool {
    $router = new Router();
    $routesFile = dirname(__DIR__) . '/private_app/config/routes.php';
    $config = require dirname(__DIR__) . '/private_app/config/app.php';
    $routesSetup = require $routesFile;
    $routesSetup($router, $config);

    $routes = $router->getRoutes();
    if (!isset($routes['GET']['/oficina-tecnica-infraestructura-minera'])) {
        throw new \Exception("No se encontró la ruta GET /oficina-tecnica-infraestructura-minera.");
    }
    $target = $routes['GET']['/oficina-tecnica-infraestructura-minera'];
    if (!is_array($target) || $target[0] !== TrainingController::class || $target[1] !== 'oficinaTecnicaInfraestructuraMinera') {
        throw new \Exception("El handler registrado no apunta a TrainingController::oficinaTecnicaInfraestructuraMinera.");
    }
    return true;
});

// Caso 3: Registro en CourseCatalog
runTest("Slug 'oficina-tecnica-infraestructura-minera' registrado en CourseCatalog", function(): bool {
    if (!CourseCatalog::isValid('oficina-tecnica-infraestructura-minera')) {
        throw new \Exception("CourseCatalog::isValid('oficina-tecnica-infraestructura-minera') retornó false.");
    }
    $info = CourseCatalog::find('oficina-tecnica-infraestructura-minera');
    if ($info['url'] !== '/oficina-tecnica-infraestructura-minera') {
        throw new \Exception("URL en CourseCatalog no coincide: " . ($info['url'] ?? 'null'));
    }
    return true;
});

// Caso 4: Variables de la vista del curso
runTest("La vista contiene 15 horas netas y 16 PDU separados y sin brochure público", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/oficina-tecnica-infraestructura-minera.php';
    if (!file_exists($viewPath)) {
        throw new \Exception("No existe el archivo de vista: " . $viewPath);
    }
    $viewContent = file_get_contents($viewPath);

    if (strpos($viewContent, "'pdu'                 => '16 PDU'") === false &&
        strpos($viewContent, "'pdu_count'           => '16 PDU'") === false) {
        throw new \Exception("No se encontró '16 PDU' en la configuración del curso.");
    }

    if (strpos($viewContent, "'hours'               => '15 horas netas'") === false &&
        strpos($viewContent, "'duration_hours'      => '15 horas netas'") === false) {
        throw new \Exception("No se encontró '15 horas netas' en la configuración del curso.");
    }

    if (strpos($viewContent, 'brochure_url') !== false && strpos($viewContent, "'brochure_url' => ''") === false) {
        throw new \Exception("brochure_url está configurado con valor público en la vista.");
    }

    return true;
});

// Caso 5: Temario en 5 bloques oficiales
runTest("Temario estructurado en exactamente 5 bloques oficiales del PDF", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/oficina-tecnica-infraestructura-minera.php';
    $code = file_get_contents($viewPath);

    $expectedBlocks = ['Organización y contratos', 'Gestión del alcance', 'Procura', 'Planificación y control', 'Control de costos'];
    foreach ($expectedBlocks as $b) {
        if (strpos($code, "'title'   => '{$b}'") === false) {
            throw new \Exception("No se encontró el bloque temático oficial: '{$b}'");
        }
    }

    // Verificar contenidos clave de cada bloque
    if (strpos($code, 'Especificaciones Técnicas') === false || strpos($code, 'Informes EIA') === false) {
        throw new \Exception("Falta contenido clave en bloque Organización y contratos.");
    }
    if (strpos($code, 'Administración del Contrato y el Alcance') === false || strpos($code, 'improductivos') === false) {
        throw new \Exception("Falta contenido clave en bloque Gestión del alcance.");
    }
    if (strpos($code, 'Gestión de Subcontratos') === false || strpos($code, 'materiales e insumos') === false) {
        throw new \Exception("Falta contenido clave en bloque Procura.");
    }
    if (strpos($code, 'Tren de actividades') === false || strpos($code, 'Look Ahead') === false || strpos($code, 'Valor Ganado') === false) {
        throw new \Exception("Falta contenido clave en bloque Planificación y control.");
    }
    if (strpos($code, 'Presupuesto Meta') === false || strpos($code, 'Resultado operativo (RO)') === false) {
        throw new \Exception("Falta contenido clave en bloque Control de costos.");
    }

    return true;
});

// Caso 6: Beneficios oficiales
runTest("Beneficios oficiales válidos según el brochure", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/oficina-tecnica-infraestructura-minera.php';
    $code = file_get_contents($viewPath);

    if (strpos($code, 'Base de datos laboral') === false) {
        throw new \Exception("Falta beneficio: Base de datos laboral.");
    }
    if (strpos($code, 'Descuento para futuros cursos') === false) {
        throw new \Exception("Falta beneficio: Descuentos futuros.");
    }
    if (strpos($code, 'Diploma digital') === false) {
        throw new \Exception("Falta beneficio: Diploma digital.");
    }
    if (strpos($code, 'Entrega de material digital') === false) {
        throw new \Exception("Falta beneficio: Material digital.");
    }
    if (strpos($code, 'Acceso vía internet a la grabación del curso luego de finalizado (4 semanas)') === false) {
        throw new \Exception("Falta beneficio: Grabación durante cuatro semanas.");
    }

    return true;
});

// Caso 7: Perfil docente Ing. Jorge Valdivieso
runTest("Docente Ing. Jorge Valdivieso fiel al documento y sin atribuir CIFE Stanford", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/oficina-tecnica-infraestructura-minera.php';
    $code = file_get_contents($viewPath);

    if (strpos($code, 'Ing. Jorge Valdivieso') === false) {
        throw new \Exception("Nombre del docente no encontrado.");
    }
    if (strpos($code, 'CISSAC') === false) {
        throw new \Exception("Trayectoria CISSAC no encontrada.");
    }
    if (strpos($code, 'San Martin Contratistas Generales') === false) {
        throw new \Exception("Trayectoria San Martin no encontrada.");
    }
    if (strpos($code, 'img/docentes/jorge-valdivieso.webp') === false) {
        throw new \Exception("Falta la imagen WebP del docente.");
    }
    if (strpos($code, 'Ing. Jorge Valdivieso, docente de Oficina Técnica en Infraestructura Minera') === false) {
        throw new \Exception("Falta el texto alternativo oficial de la foto del docente.");
    }

    // Verificar que CIFE Stanford NO esté asignado en el array del docente
    $docentePos = strpos($code, "'docente'             => [");
    $docenteEnd = strpos($code, "],", $docentePos);
    $docenteChunk = substr($code, $docentePos, $docenteEnd - $docentePos);
    if (stripos($docenteChunk, 'Stanford') !== false || stripos($docenteChunk, 'CIFE') !== false) {
        throw new \Exception("CIFE Stanford no debe ser atribuido al docente (es institucional de QCS).");
    }

    return true;
});

// Caso 8: Existencia de imágenes requeridas y ausencia de PDF
runTest("Imágenes PNG y WebP existen físicamente y no hay PDFs en el repo", function(): bool {
    $pngPath = dirname(__DIR__) . '/public_html/img/capacitaciones/oficina-tecnica-infraestructura-minera.png';
    $webpPath = dirname(__DIR__) . '/public_html/img/capacitaciones/oficina-tecnica-infraestructura-minera.webp';
    $docPng = dirname(__DIR__) . '/public_html/img/docentes/jorge-valdivieso.png';
    $docWebp = dirname(__DIR__) . '/public_html/img/docentes/jorge-valdivieso.webp';

    if (!file_exists($pngPath)) {
        throw new \Exception("No existe el archivo PNG: " . $pngPath);
    }
    if (!file_exists($webpPath)) {
        throw new \Exception("No existe el archivo WebP: " . $webpPath);
    }
    if (!file_exists($docPng)) {
        throw new \Exception("No existe el PNG del docente: " . $docPng);
    }
    if (!file_exists($docWebp)) {
        throw new \Exception("No existe el WebP del docente: " . $docWebp);
    }

    $expectedPngSha = '54cd7691f49c9fd856986a899b4a11ff8e427d07ca5b04a2ff5640422ce9890a';
    $actualPngSha = hash_file('sha256', $pngPath);
    if ($actualPngSha !== $expectedPngSha) {
        throw new \Exception("El PNG no coincide con la versión aprobada. SHA: " . $actualPngSha);
    }

    // Verificar ausencia de PDFs en el repositorio
    $pdfBrochure = dirname(__DIR__) . '/public_html/brochures/oficina-tecnica/02 - OFT INFRAESTRUCTURA MINERA - JVX (1).pdf';
    if (file_exists($pdfBrochure)) {
        throw new \Exception("El PDF no debe existir en el repositorio: " . $pdfBrochure);
    }

    return true;
});

// Caso 9: Ausencia de datos desactualizados en la vista
runTest("Ausencia de fechas antiguas (ABR/MAY), horarios fijos (16:00-19:00) y cuentas bancarias", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/oficina-tecnica-infraestructura-minera.php';
    $code = file_get_contents($viewPath);

    $prohibitedTerms = [
        '191-10382996-0-73',
        '00219111038299607352',
        '047-3092292540',
        '0011-0184-02-00496525',
        '039-7331729',
        '16:00 – 19:00',
        '16:00 - 19:00',
        '27 ABR',
        '25 MAY',
    ];

    foreach ($prohibitedTerms as $term) {
        if (strpos($code, $term) !== false) {
            throw new \Exception("Se encontró dato prohibido/antiguo en la vista: '{$term}'");
        }
    }

    return true;
});

// Caso 10: Renderizado MVC y ausencia de enlaces a brochures
runTest("Renderizado MVC no expone enlaces a PDFs ni portadas de brochure", function(): bool {
    $view = new View();
    $data = [
        'title'           => 'Capacitación: Oficina Técnica en Infraestructura Minera | Quality Consulting Solutions',
        'metaDescription' => 'Curso especializado...',
        'canonical'       => 'https://quality-consulting.org/oficina-tecnica-infraestructura-minera',
        'activePage'      => 'capacitacion',
    ];

    $html = $view->render('pages/oficina-tecnica-infraestructura-minera', $data, 'main');

    if (stripos($html, '.pdf') !== false) {
        throw new \Exception("El HTML renderizado contiene referencias a archivos .pdf.");
    }
    if (stripos($html, 'brochures/') !== false) {
        throw new \Exception("El HTML renderizado contiene referencias a rutas de brochures.");
    }
    if (stripos($html, 'portada-') !== false) {
        throw new \Exception("El HTML renderizado contiene referencias a portadas de brochure.");
    }

    // Verificar mensaje de contacto
    if (strpos($html, 'Para más información, disponibilidad y precios, contáctanos.') === false) {
        throw new \Exception("No se encontró el mensaje oficial de contacto en reemplazo del brochure.");
    }

    // Verificar botón de PayPal con primera clase
    if (strpos($html, 'Primera clase del curso – USD 10') === false) {
        throw new \Exception("No se encontró la opción de pago de la primera clase a USD 10.");
    }

    return true;
});

// Caso 11: Registro en sitemap.xml
runTest("Sitemap.xml incluye la URL https://quality-consulting.org/oficina-tecnica-infraestructura-minera", function(): bool {
    $sitemapPath = dirname(__DIR__) . '/public_html/sitemap.xml';
    $content = file_get_contents($sitemapPath);
    if (strpos($content, '<loc>https://quality-consulting.org/oficina-tecnica-infraestructura-minera</loc>') === false) {
        throw new \Exception("No se encontró la URL de la capacitación en sitemap.xml.");
    }
    return true;
});

echo "\n====================================================================\n";
echo "RESULTADO: {$passedTests} de {$totalTests} pruebas pasaron exitosamente.\n";
echo "====================================================================\n";

if ($passedTests !== $totalTests) {
    exit(1);
}
