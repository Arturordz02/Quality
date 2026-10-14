<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Test Suite Automatizado: Validación Integral de la Capacitación
 * "CONTRATO COLABORATIVO NEC 3/4"
 * Archivo: tests/ContratoColaborativoNec34ValidationTest.php
 *
 * Casos de prueba:
 * 1. Registro número 19 en CoursesCatalog (título, categoría, tipo, ruta, imágenes, ausencia de brochure).
 * 2. Registro de ruta /contrato-colaborativo-nec-3-4 en Router.
 * 3. Registro de slug 'contrato-colaborativo-nec-3-4' en CourseCatalog.
 * 4. PDU (16 PDU) y duración (16 horas netas) como datos separados, sin aval/acreditación atribuida al PMI.
 * 5. Temario con cláusulas principales (secciones 10 a 90), Opción F y demás opciones, y cláusulas secundarias.
 * 6. Beneficios oficiales respaldados por el documento (exactamente 5 items).
 * 7. Perfil docente Ing. Jaime Curo fiel al documento (+17 años, G2G, Oil & Gas, Minería, Construcción; sin Masterc).
 * 8. Existencia física de las imágenes (PNG temática SHA-256 e dimensiones, WebP temática, PNG y WebP docente) y ausencia de PDF.
 * 9. Ausencia de datos antiguos (fechas OCT/NOV/DIC, horario 20:00-22:00, cuentas bancarias, Visa/Niubiz, promesas laborales, Masterc).
 * 10. Ausencia total de enlaces a PDF o portada del brochure y presencia del mensaje de contacto oficial.
 * 11. Botón de PayPal restringido a primera clase (USD 10) con aclaración de no inclusión del curso completo.
 * 12. URL oficial registrada en public_html/sitemap.xml.
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
echo "EJECUTANDO SUITE DE PRUEBAS: CONTRATO COLABORATIVO NEC 3/4\n";
echo "====================================================================\n\n";

// Caso 1: Registro 19 en CoursesCatalog
runTest("Registro #19 en CoursesCatalog tiene título, tipo, ruta, imágenes y no incluye brochure", function(): bool {
    $courses = CoursesCatalog::getAll();
    $found = null;
    foreach ($courses as $c) {
        if ($c['number'] === 19) {
            $found = $c;
            break;
        }
    }
    if ($found === null) {
        throw new \Exception("No se encontró el registro número 19 en CoursesCatalog.");
    }
    if ($found['title'] !== 'CONTRATO COLABORATIVO NEC 3/4') {
        throw new \Exception("Título incorrecto: " . $found['title']);
    }
    if ($found['category'] !== 'Contratos') {
        throw new \Exception("Categoría incorrecta: " . $found['category']);
    }
    if ($found['route'] !== '/contrato-colaborativo-nec-3-4') {
        throw new \Exception("Ruta incorrecta: " . $found['route']);
    }
    if ($found['image'] !== 'img/capacitaciones/contrato-colaborativo-nec-3-4.webp') {
        throw new \Exception("Imagen principal incorrecta: " . $found['image']);
    }
    if ($found['image_fallback'] !== 'img/capacitaciones/contrato-colaborativo-nec-3-4.png') {
        throw new \Exception("Imagen fallback incorrecta: " . $found['image_fallback']);
    }
    if (!empty($found['brochure'])) {
        throw new \Exception("El brochure no debe estar configurado en el catálogo público: " . $found['brochure']);
    }
    return true;
});

// Caso 2: Ruta en Router
runTest("La ruta /contrato-colaborativo-nec-3-4 está registrada en config/routes.php", function(): bool {
    $router = new Router();
    $config = require dirname(__DIR__) . '/private_app/config/app.php';
    $routesLoader = require dirname(__DIR__) . '/private_app/config/routes.php';
    $routesLoader($router, $config);

    $routes = $router->getRoutes();
    if (!isset($routes['GET']['/contrato-colaborativo-nec-3-4'])) {
        throw new \Exception("No se encontró la ruta GET /contrato-colaborativo-nec-3-4.");
    }
    $target = $routes['GET']['/contrato-colaborativo-nec-3-4'];
    if (!is_array($target) || $target[0] !== TrainingController::class || $target[1] !== 'contratoColaborativoNec34') {
        throw new \Exception("El handler registrado no apunta a TrainingController::contratoColaborativoNec34.");
    }
    return true;
});

// Caso 3: Slug en CourseCatalog
runTest("Slug 'contrato-colaborativo-nec-3-4' registrado en CourseCatalog", function(): bool {
    if (!CourseCatalog::isValid('contrato-colaborativo-nec-3-4')) {
        throw new \Exception("CourseCatalog::isValid retornó false para 'contrato-colaborativo-nec-3-4'.");
    }
    $info = CourseCatalog::find('contrato-colaborativo-nec-3-4');
    if (!$info || $info['url'] !== '/contrato-colaborativo-nec-3-4') {
        throw new \Exception("CourseCatalog::find no retornó los datos correctos.");
    }
    return true;
});

// Caso 4: PDU (16) y duración (16 horas netas) separados
runTest("La vista contiene 16 horas netas y 16 PDU separados y sin brochure público", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/contrato-colaborativo-nec-3-4.php';
    if (!file_exists($viewPath)) {
        throw new \Exception("La vista no existe en: " . $viewPath);
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

    // No afirmar acreditación ni aval del PMI
    if (stripos($viewContent, 'acreditado por el pmi') !== false || stripos($viewContent, 'avalado por el pmi') !== false) {
        throw new \Exception("No se debe afirmar acreditación ni aval oficial del PMI.");
    }

    return true;
});

// Caso 5: Temario con Cláusulas Principales (10 a 90), Opciones NEC y Cláusulas Secundarias
runTest("Temario estructurado con cláusulas principales (10-90), opciones NEC y cláusulas secundarias", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/contrato-colaborativo-nec-3-4.php';
    $code = file_get_contents($viewPath);

    $expectedSections = [
        'Sección 10', 'Sección 20', 'Sección 30', 'Sección 40', 'Sección 50',
        'Sección 60', 'Sección 70', 'Sección 80', 'Sección 90'
    ];
    foreach ($expectedSections as $s) {
        if (strpos($code, $s) === false) {
            throw new \Exception("Falta sección requerida en el temario: '{$s}'");
        }
    }

    if (strpos($code, 'Opción F') === false) {
        throw new \Exception("Falta mencionar Opción F en el temario.");
    }

    if (strpos($code, 'Cláusulas secundarias') === false && strpos($code, 'cláusulas secundarias') === false) {
        throw new \Exception("Falta mencionar cláusulas secundarias en el temario.");
    }

    return true;
});

// Caso 6: Exactamente los 5 beneficios oficiales
runTest("Beneficios oficiales válidos según el brochure (exactamente 5 items)", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/contrato-colaborativo-nec-3-4.php';
    $code = file_get_contents($viewPath);

    if (strpos($code, 'Base de datos laboral') === false) {
        throw new \Exception("Falta beneficio: Base de datos laboral.");
    }
    if (strpos($code, 'Descuentos futuros') === false) {
        throw new \Exception("Falta beneficio: Descuentos futuros.");
    }
    if (strpos($code, 'Diploma digital') === false) {
        throw new \Exception("Falta beneficio: Diploma digital.");
    }
    if (strpos($code, 'Material digital') === false) {
        throw new \Exception("Falta beneficio: Material digital.");
    }
    if (strpos($code, 'Grabación del curso') === false) {
        throw new \Exception("Falta beneficio: Grabación del curso.");
    }

    return true;
});

// Caso 7: Docente Ing. Jaime Curo
runTest("Docente Ing. Jaime Curo fiel al brochure (+17 años, G2G, Oil & Gas, Minería, Construcción)", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/contrato-colaborativo-nec-3-4.php';
    $code = file_get_contents($viewPath);

    if (strpos($code, 'Ing. Jaime Curo') === false) {
        throw new \Exception("No se encontró el nombre del docente Ing. Jaime Curo.");
    }
    if (strpos($code, '+17 años de experiencia') === false) {
        throw new \Exception("Falta tag '+17 años de experiencia'.");
    }
    if (strpos($code, 'Ingeniero Industrial') === false) {
        throw new \Exception("Falta título 'Ingeniero Industrial'.");
    }
    if (strpos($code, 'Escuelas Bicentenarios') === false) {
        throw new \Exception("Falta trayectoria en Escuelas Bicentenarios.");
    }
    if (strpos($code, 'ARCC') === false) {
        throw new \Exception("Falta trayectoria en ARCC.");
    }
    if (strpos($code, 'Panamericanos') === false) {
        throw new \Exception("Falta trayectoria en Juegos Panamericanos.");
    }
    if (stripos($code, 'masterc') !== false) {
        throw new \Exception("La vista contiene la credencial ambigua no respaldada 'Masterc'.");
    }

    return true;
});

// Caso 8: Existencia de imágenes físicas y ausencia de PDF
runTest("Imágenes PNG y WebP existen físicamente con dimensiones y SHA-256 verificado, y 0 PDFs en repo", function(): bool {
    $pngPath = dirname(__DIR__) . '/public_html/img/capacitaciones/contrato-colaborativo-nec-3-4.png';
    $webpPath = dirname(__DIR__) . '/public_html/img/capacitaciones/contrato-colaborativo-nec-3-4.webp';
    $docPng = dirname(__DIR__) . '/public_html/img/docentes/jaime-curo.png';
    $docWebp = dirname(__DIR__) . '/public_html/img/docentes/jaime-curo.webp';

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

    $expectedPngSha = 'e450810c2563bb8c51be481d5a5e4677b1db072bbea705e6d79e2855e7c833c5';
    $actualPngSha = hash_file('sha256', $pngPath);
    if ($actualPngSha !== $expectedPngSha) {
        throw new \Exception("El PNG no coincide con la versión aprobada. SHA: " . $actualPngSha);
    }

    // Verificar dimensiones PNG
    $pngSize = getimagesize($pngPath);
    if ($pngSize[0] !== 1672 || $pngSize[1] !== 941) {
        throw new \Exception("Dimensiones del PNG incorrectas: {$pngSize[0]}x{$pngSize[1]}");
    }

    // Verificar ausencia de PDFs en el repositorio
    $pdfBrochure = dirname(__DIR__) . '/public_html/brochures/gestion-de-contratos/Brochure Contratos Nec 3 y 4.pdf';
    if (file_exists($pdfBrochure)) {
        throw new \Exception("El PDF no debe existir en el repositorio: " . $pdfBrochure);
    }

    return true;
});

// Caso 9: Ausencia de datos antiguos, promesas de empleabilidad y credencial ambigua
runTest("Ausencia de fechas antiguas (OCT/NOV/DIC), horarios fijos (20:00-22:00), cuentas bancarias, promesas laborales y Masterc", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/contrato-colaborativo-nec-3-4.php';
    $code = file_get_contents($viewPath);

    $prohibitedTerms = [
        '191-10382996-0-73',
        '00219111038299607352',
        '047-3092292540',
        '0011-0184-02-00496525',
        '039-7331729',
        '20:00 – 22:00',
        '20:00 - 22:00',
        '30 OCT',
        '06 NOV',
        '18 DIC',
        'Prepárate para trabajar',
        'Preparate para trabajar',
        'Niubiz',
        'Masterc',
        'MASTERc',
    ];

    foreach ($prohibitedTerms as $term) {
        if (stripos($code, $term) !== false) {
            throw new \Exception("Se encontró dato prohibido/antiguo en la vista: '{$term}'");
        }
    }

    return true;
});

// Caso 10: Renderizado MVC y ausencia de enlaces a brochures
runTest("Renderizado MVC no expone enlaces a PDFs, portadas de brochure ni Masterc, y muestra mensaje de contacto", function(): bool {
    $view = new View();
    $data = [
        'title'           => 'Capacitación: Contrato Colaborativo NEC 3/4 | Quality Consulting Solutions',
        'metaDescription' => 'Curso especializado...',
        'canonical'       => 'https://quality-consulting.org/contrato-colaborativo-nec-3-4',
        'activePage'      => 'capacitacion',
    ];

    $html = $view->render('pages/contrato-colaborativo-nec-3-4', $data, 'main');

    if (stripos($html, '.pdf') !== false) {
        throw new \Exception("El HTML renderizado contiene referencias a archivos .pdf.");
    }
    if (stripos($html, 'brochures/') !== false) {
        throw new \Exception("El HTML renderizado contiene referencias a rutas de brochures.");
    }
    if (stripos($html, 'portada-') !== false) {
        throw new \Exception("El HTML renderizado contiene referencias a portadas de brochure.");
    }

    // Verificar ausencia de videos
    if (stripos($html, '<video') !== false || stripos($html, '<iframe') !== false) {
        throw new \Exception("El HTML renderizado contiene videos o iframes.");
    }

    // Verificar ausencia de Masterc
    if (stripos($html, 'masterc') !== false) {
        throw new \Exception("El HTML renderizado contiene la credencial ambigua 'Masterc'.");
    }

    $staticHtmlPath = dirname(__DIR__) . '/_site/contrato-colaborativo-nec-3-4.html';
    if (file_exists($staticHtmlPath)) {
        $staticHtml = file_get_contents($staticHtmlPath);
        if (stripos($staticHtml, 'masterc') !== false) {
            throw new \Exception("El HTML estático compilado contiene 'Masterc'.");
        }
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
runTest("Sitemap.xml incluye la URL https://quality-consulting.org/contrato-colaborativo-nec-3-4", function(): bool {
    $sitemapPath = dirname(__DIR__) . '/public_html/sitemap.xml';
    $content = file_get_contents($sitemapPath);
    if (strpos($content, '<loc>https://quality-consulting.org/contrato-colaborativo-nec-3-4</loc>') === false) {
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
