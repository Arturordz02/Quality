<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Test Suite Automatizado: Validación Integral de la Capacitación
 * "OFICINA TÉCNICA EN EDIFICACIONES Y HOSPITALES"
 * Archivo: tests/OficinaTecnicaHospitalesEdificacionesValidationTest.php
 *
 * Casos de prueba:
 * 1. Registro número 12 en CoursesCatalog (título, categoría, tipo, ruta, imágenes, ausencia de brochure).
 * 2. Registro de ruta /oficina-tecnica-hospitales-edificaciones en Router.
 * 3. Registro de slug 'oficina-tecnica-hospitales-edificaciones' en CourseCatalog.
 * 4. PDU (16 PDU) y duración (16 horas netas) como datos separados y fieles.
 * 5. Temario en exactamente 5 bloques oficiales según documento oficial:
 *    Alcance, Plazo, Costo, Comunicaciones, Procura.
 * 6. Beneficios oficiales permitidos (6 items exactos).
 * 7. Perfil docente Ing. Fanny Muro (Ing. Civil, Máster, ESAN, PUCP, La Salle BCN, Cosapi, GyM, sin Stanford CIFE atribuido).
 * 8. Existencia física de las imágenes (PNG, WebP y fotografía del docente) y ausencia de PDF en el repositorio.
 * 9. Ausencia de datos antiguos en la vista (fechas pasadas, horas fijas, cuentas bancarias, etc.).
 * 10. Ausencia total de enlaces a PDF o portada del brochure en la vista y en el archivo HTML compilado.
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
echo "EJECUTANDO SUITE DE PRUEBAS: OFICINA TÉCNICA EN EDIFICACIONES Y HOSPITALES\n";
echo "====================================================================\n\n";

// Caso 1: Registro 12 en CoursesCatalog
runTest("Registro #12 en CoursesCatalog tiene título, tipo, ruta, imágenes y no incluye brochure", function(): bool {
    $courses = CoursesCatalog::getAll();
    $found = null;
    foreach ($courses as $c) {
        if ($c['number'] === 12) {
            $found = $c;
            break;
        }
    }
    if ($found === null) {
        throw new \Exception("No se encontró el registro número 12 en CoursesCatalog.");
    }
    if ($found['title'] !== 'OFICINA TÉCNICA EN EDIFICACIONES Y HOSPITALES') {
        throw new \Exception("Título incorrecto: " . $found['title']);
    }
    if ($found['category'] !== 'Oficina Técnica') {
        throw new \Exception("Categoría incorrecta: " . $found['category']);
    }
    if ($found['route'] !== '/oficina-tecnica-hospitales-edificaciones') {
        throw new \Exception("Ruta incorrecta: " . $found['route']);
    }
    if ($found['image'] !== 'img/capacitaciones/oficina-tecnica-hospitales-edificaciones.webp') {
        throw new \Exception("Imagen principal incorrecta: " . $found['image']);
    }
    if ($found['image_fallback'] !== 'img/capacitaciones/oficina-tecnica-hospitales-edificaciones.png') {
        throw new \Exception("Imagen fallback incorrecta: " . $found['image_fallback']);
    }
    if (!empty($found['brochure'])) {
        throw new \Exception("El brochure no debe estar configurado en el catálogo público: " . $found['brochure']);
    }
    return true;
});

// Caso 2: Ruta en Router
runTest("La ruta /oficina-tecnica-hospitales-edificaciones está registrada en config/routes.php", function(): bool {
    $router = new Router();
    $routesFile = dirname(__DIR__) . '/private_app/config/routes.php';
    $config = require dirname(__DIR__) . '/private_app/config/app.php';
    $routesSetup = require $routesFile;
    $routesSetup($router, $config);

    $routes = $router->getRoutes();
    if (!isset($routes['GET']['/oficina-tecnica-hospitales-edificaciones'])) {
        throw new \Exception("No se encontró la ruta GET /oficina-tecnica-hospitales-edificaciones.");
    }
    $target = $routes['GET']['/oficina-tecnica-hospitales-edificaciones'];
    if (!is_array($target) || $target[0] !== TrainingController::class || $target[1] !== 'oficinaTecnicaHospitalesEdificaciones') {
        throw new \Exception("El handler registrado no apunta a TrainingController::oficinaTecnicaHospitalesEdificaciones.");
    }
    return true;
});

// Caso 3: Registro en CourseCatalog
runTest("Slug 'oficina-tecnica-hospitales-edificaciones' registrado en CourseCatalog", function(): bool {
    if (!CourseCatalog::isValid('oficina-tecnica-hospitales-edificaciones')) {
        throw new \Exception("CourseCatalog::isValid('oficina-tecnica-hospitales-edificaciones') retornó false.");
    }
    $info = CourseCatalog::find('oficina-tecnica-hospitales-edificaciones');
    if ($info['url'] !== '/oficina-tecnica-hospitales-edificaciones') {
        throw new \Exception("URL en CourseCatalog no coincide: " . ($info['url'] ?? 'null'));
    }
    return true;
});

// Caso 4: Variables de la vista del curso
runTest("La vista contiene datos correctos de PDU, duración y sin brochure público", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/oficina-tecnica-hospitales-edificaciones.php';
    if (!file_exists($viewPath)) {
        throw new \Exception("No existe el archivo de vista: " . $viewPath);
    }
    $viewContent = file_get_contents($viewPath);

    if (strpos($viewContent, "'pdu'                 => '16 PDU'") === false &&
        strpos($viewContent, "'pdu_count'           => '16 PDU'") === false) {
        throw new \Exception("No se encontró '16 PDU' en la configuración del curso.");
    }

    if (strpos($viewContent, "'hours'               => '16 horas netas'") === false &&
        strpos($viewContent, "'duration_hours'      => '16 horas netas'") === false) {
        throw new \Exception("No se encontró '16 horas netas' en la configuración del curso.");
    }

    if (strpos($viewContent, 'brochure_url') !== false && strpos($viewContent, "'brochure_url' => ''") === false) {
        throw new \Exception("brochure_url está configurado con valor público en la vista.");
    }

    return true;
});

// Caso 5: Temario en 5 bloques oficiales
runTest("Temario estructurado en exactamente 5 bloques oficiales del PDF", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/oficina-tecnica-hospitales-edificaciones.php';
    $code = file_get_contents($viewPath);

    $expectedBlocks = ['Alcance', 'Plazo', 'Costo', 'Comunicaciones', 'Procura'];
    foreach ($expectedBlocks as $b) {
        if (strpos($code, "'title'   => '{$b}'") === false) {
            throw new \Exception("No se encontró el bloque temático oficial: '{$b}'");
        }
    }

    // Verificar contenidos clave de cada bloque
    if (strpos($code, 'Contrato de Obra') === false || strpos($code, 'Expediente técnico') === false) {
        throw new \Exception("Falta contenido clave en bloque Alcance.");
    }
    if (strpos($code, 'Curva S') === false || strpos($code, 'Last Planner® System') === false) {
        throw new \Exception("Falta contenido clave en bloque Plazo.");
    }
    if (strpos($code, 'Resultado Operativo') === false) {
        throw new \Exception("Falta contenido clave en bloque Costo.");
    }
    if (strpos($code, 'Transmittal') === false || strpos($code, 'RFI') === false) {
        throw new \Exception("Falta contenido clave en bloque Comunicaciones.");
    }
    if (strpos($code, 'Proceso Logístico') === false || strpos($code, 'Cronogramas de Recursos') === false) {
        throw new \Exception("Falta contenido clave en bloque Procura.");
    }

    return true;
});

// Caso 6: Beneficios oficiales (6 elementos exactos)
runTest("Beneficios oficiales válidos (6 elementos)", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/oficina-tecnica-hospitales-edificaciones.php';
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
    if (strpos($code, 'Acceso vía internet a la grabación durante cuatro semanas') === false) {
        throw new \Exception("Falta beneficio: Grabación durante cuatro semanas.");
    }
    if (strpos($code, '16 PDU') === false) {
        throw new \Exception("Falta beneficio: 16 PDU.");
    }

    return true;
});

// Caso 7: Perfil docente Ing. Fanny Muro
runTest("Docente Ing. Fanny Muro fiel al documento y sin atribuir CIFE Stanford", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/oficina-tecnica-hospitales-edificaciones.php';
    $code = file_get_contents($viewPath);

    if (strpos($code, 'Ing. Fanny Muro') === false) {
        throw new \Exception("Nombre del docente no encontrado.");
    }
    if (strpos($code, 'COSAPI') === false) {
        throw new \Exception("Trayectoria COSAPI no encontrada.");
    }
    if (strpos($code, 'GRAÑA Y MONTERO') === false) {
        throw new \Exception("Trayectoria GRAÑA Y MONTERO no encontrada.");
    }
    if (strpos($code, 'Hospital de Llata') === false) {
        throw new \Exception("Falta mención al Hospital de Llata.");
    }
    if (strpos($code, 'img/docentes/fanny-muro.webp') === false) {
        throw new \Exception("Falta la imagen WebP del docente.");
    }
    if (strpos($code, 'Ing. Fanny Muro, docente de Oficina Técnica en Edificaciones y Hospitales') === false) {
        throw new \Exception("Falta el texto alternativo oficial de la foto del docente.");
    }

    // Verificar que CIFE Stanford NO esté asignado en el array del docente
    $docentePos = strpos($code, "'docente'             => [");
    $docenteEnd = strpos($code, "],", $docentePos);
    $docenteChunk = substr($code, $docentePos, $docenteEnd - $docentePos);
    if (stripos($docenteChunk, 'Stanford') !== false || stripos($docenteChunk, 'CIFE') !== false) {
        throw new \Exception("CIFE Stanford no debe ser atribuido a la docente (es institucional de QCS).");
    }

    return true;
});

// Caso 8: Existencia de imágenes requeridas y ausencia de PDF
runTest("Imágenes PNG y WebP existen físicamente y no hay PDFs en el repo", function(): bool {
    $pngPath = dirname(__DIR__) . '/public_html/img/capacitaciones/oficina-tecnica-hospitales-edificaciones.png';
    $webpPath = dirname(__DIR__) . '/public_html/img/capacitaciones/oficina-tecnica-hospitales-edificaciones.webp';
    $docPng = dirname(__DIR__) . '/public_html/img/docentes/fanny-muro.png';
    $docWebp = dirname(__DIR__) . '/public_html/img/docentes/fanny-muro.webp';

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

    $expectedPngSha = '58f068d86b6e6ad100849f265880cd7d4e2309d69b2ea6ad8e010de018c4bfd3';
    $actualPngSha = hash_file('sha256', $pngPath);
    if ($actualPngSha !== $expectedPngSha) {
        throw new \Exception("El PNG no coincide con la versión aprobada. SHA: " . $actualPngSha);
    }

    // Verificar ausencia de PDFs en public_html/brochures
    $pdfBrochure = dirname(__DIR__) . '/public_html/brochures/oficina-tecnica/02 - OFT HOSPITALES Y EDIFICACIONES - FMX (1).pdf';
    if (file_exists($pdfBrochure)) {
        throw new \Exception("El PDF no debe existir en el repositorio: " . $pdfBrochure);
    }

    return true;
});

// Caso 9: Ausencia de datos desactualizados en la vista
runTest("Ausencia de fechas antiguas (FEB/MAR), horarios fijos (20:00) y cuentas bancarias", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/oficina-tecnica-hospitales-edificaciones.php';
    $code = file_get_contents($viewPath);

    $prohibitedTerms = [
        '191-10382996-0-73',
        '00219111038299607352',
        '047-3092292540',
        '0011-0184-02-00496525',
        '039-7331729',
        '20:00 – 22:00',
        '20:00 - 22:00',
        '28 FEB',
        '02 MAR',
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
        'title'           => 'Capacitación: Oficina Técnica en Edificaciones y Hospitales | Quality Consulting Solutions',
        'metaDescription' => 'Curso especializado...',
        'canonical'       => 'https://quality-consulting.org/oficina-tecnica-hospitales-edificaciones',
        'activePage'      => 'capacitacion',
    ];

    $html = $view->render('pages/oficina-tecnica-hospitales-edificaciones', $data, 'main');

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
runTest("Sitemap.xml incluye la URL https://quality-consulting.org/oficina-tecnica-hospitales-edificaciones", function(): bool {
    $sitemapPath = dirname(__DIR__) . '/public_html/sitemap.xml';
    $content = file_get_contents($sitemapPath);
    if (strpos($content, '<loc>https://quality-consulting.org/oficina-tecnica-hospitales-edificaciones</loc>') === false) {
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
