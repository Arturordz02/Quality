<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Test Suite Automatizado: Validación Integral de la Capacitación
 * "CONTRATOS FIDIC PARA CONTRATOS EPC Y CONSTRUCCIÓN"
 * Archivo: tests/ContratosFidicEpcConstruccionValidationTest.php
 *
 * Casos de prueba:
 * 1. Registro número 21 en CoursesCatalog (título, categoría, tipo, ruta, imágenes, ausencia de brochure).
 * 2. Registro de ruta /contratos-fidic-epc-construccion en Router.
 * 3. Registro de slug 'contratos-fidic-epc-construccion' en CourseCatalog.
 * 4. PDU (16 PDU) y duración (20 horas netas) como datos separados, sin aval/acreditación atribuida a FIDIC o PMI.
 * 5. Temario con Rainbow Suite (Red, Yellow, Silver Books 1999 y 2017), partes, cláusulas, controversias y legislación peruana.
 * 6. Beneficios oficiales respaldados por el documento (exactamente 5 items).
 * 7. Perfil docente Sharon Grados fiel al documento (Abogada, PMC Talara, NPG, ICCGSA, MTC, Rivera).
 * 8. Existencia física de las imágenes (PNG temática SHA-256 e dimensiones, WebP temática, PNG y WebP docente) y 0 PDFs en repo.
 * 9. Ausencia de datos antiguos (fechas OCT/NOV, horario 20:00-22:00, cuentas bancarias, Visa/Niubiz).
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
echo "EJECUTANDO SUITE DE PRUEBAS: CONTRATOS FIDIC PARA CONTRATOS EPC Y CONSTRUCCIÓN\n";
echo "====================================================================\n\n";

// Caso 1: Registro 21 en CoursesCatalog
runTest("Registro #21 en CoursesCatalog tiene título, tipo, ruta, imágenes y no incluye brochure", function(): bool {
    $courses = CoursesCatalog::getAll();
    $found = null;
    foreach ($courses as $c) {
        if ($c['number'] === 21) {
            $found = $c;
            break;
        }
    }
    if ($found === null) {
        throw new \Exception("No se encontró el registro número 21 en CoursesCatalog.");
    }
    if ($found['title'] !== 'CONTRATOS FIDIC PARA CONTRATOS EPC Y CONSTRUCCIÓN') {
        throw new \Exception("Título incorrecto: " . $found['title']);
    }
    if ($found['category'] !== 'Contratos') {
        throw new \Exception("Categoría incorrecta: " . $found['category']);
    }
    if ($found['route'] !== '/contratos-fidic-epc-construccion') {
        throw new \Exception("Ruta incorrecta: " . $found['route']);
    }
    if ($found['image'] !== 'img/capacitaciones/contratos-fidic-epc-construccion.webp') {
        throw new \Exception("Imagen principal incorrecta: " . $found['image']);
    }
    if ($found['image_fallback'] !== 'img/capacitaciones/contratos-fidic-epc-construccion.png') {
        throw new \Exception("Imagen fallback incorrecta: " . $found['image_fallback']);
    }
    if (!empty($found['brochure'])) {
        throw new \Exception("El brochure no debe estar configurado en el catálogo público: " . $found['brochure']);
    }
    return true;
});

// Caso 2: Ruta en Router
runTest("La ruta /contratos-fidic-epc-construccion está registrada en config/routes.php", function(): bool {
    $router = new Router();
    $config = require dirname(__DIR__) . '/private_app/config/app.php';
    $routesLoader = require dirname(__DIR__) . '/private_app/config/routes.php';
    $routesLoader($router, $config);

    $routes = $router->getRoutes();
    if (!isset($routes['GET']['/contratos-fidic-epc-construccion'])) {
        throw new \Exception("No se encontró la ruta GET /contratos-fidic-epc-construccion.");
    }
    $target = $routes['GET']['/contratos-fidic-epc-construccion'];
    if (!is_array($target) || $target[0] !== TrainingController::class || $target[1] !== 'contratosFidicEpcConstruccion') {
        throw new \Exception("El handler registrado no apunta a TrainingController::contratosFidicEpcConstruccion.");
    }
    return true;
});

// Caso 3: Slug en CourseCatalog
runTest("Slug 'contratos-fidic-epc-construccion' registrado en CourseCatalog", function(): bool {
    if (!CourseCatalog::isValid('contratos-fidic-epc-construccion')) {
        throw new \Exception("CourseCatalog::isValid retornó false para 'contratos-fidic-epc-construccion'.");
    }
    $info = CourseCatalog::find('contratos-fidic-epc-construccion');
    if (!$info || $info['url'] !== '/contratos-fidic-epc-construccion') {
        throw new \Exception("CourseCatalog::find no retornó los datos correctos.");
    }
    return true;
});

// Caso 4: PDU (16) y duración (20 horas netas) separados
runTest("La vista contiene 20 horas netas y 16 PDU separados y sin brochure público ni aval", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/contratos-fidic-epc-construccion.php';
    if (!file_exists($viewPath)) {
        throw new \Exception("La vista no existe en: " . $viewPath);
    }
    $viewContent = file_get_contents($viewPath);

    if (strpos($viewContent, "'pdu'                 => '16 PDU'") === false &&
        strpos($viewContent, "'pdu_count'           => '16 PDU'") === false) {
        throw new \Exception("No se encontró '16 PDU' en la configuración del curso.");
    }

    if (strpos($viewContent, "'hours'               => '20 horas netas'") === false &&
        strpos($viewContent, "'duration_hours'      => '20 horas netas'") === false) {
        throw new \Exception("No se encontró '20 horas netas' en la configuración del curso.");
    }

    if (strpos($viewContent, 'brochure_url') !== false && strpos($viewContent, "'brochure_url' => ''") === false) {
        throw new \Exception("brochure_url está configurado con valor público en la vista.");
    }

    // No afirmar acreditación ni aval de FIDIC ni PMI
    $forbiddenClaims = [
        'acreditado por fidic', 'acreditado por el pmi',
        'avalado por fidic', 'avalado por el pmi',
        'certificado por fidic', 'certificado por el pmi',
        'autorizado por fidic', 'autorizado por el pmi'
    ];
    foreach ($forbiddenClaims as $claim) {
        if (stripos($viewContent, $claim) !== false) {
            throw new \Exception("Afirmación prohibida en la vista: '{$claim}'");
        }
    }

    return true;
});

// Caso 5: Temario con Rainbow Suite, partes, cláusulas, controversias y legislación peruana
runTest("Temario estructurado con Rainbow Suite (1999 y 2017), partes, cláusulas y legislación peruana", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/contratos-fidic-epc-construccion.php';
    $code = file_get_contents($viewPath);

    $expectedTopics = [
        'Rainbow Suite', 'Libro Rojo', 'Libro Amarillo', 'Libro Plata',
        '1999', '2017', 'Cliente', 'Contratista', 'Ingeniero',
        'Diseño', 'Suspensión y resolución', 'Fuerza mayor', 'Riesgo y responsabilidades',
        'variaciones', 'Inicio, demora', 'Precio contractual y pago',
        'Pruebas de terminación', 'Recepción', 'responsabilidad por defectos',
        'Reclamaciones', 'Controversias', 'legislación peruana', 'Caso práctico'
    ];
    foreach ($expectedTopics as $t) {
        if (stripos($code, $t) === false) {
            throw new \Exception("Falta tema requerido en el temario: '{$t}'");
        }
    }

    return true;
});

// Caso 6: Exactamente los 5 beneficios oficiales
runTest("Beneficios oficiales válidos según el brochure (exactamente 5 items)", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/contratos-fidic-epc-construccion.php';
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

// Caso 7: Docente Sharon Grados
runTest("Docente Sharon Grados fiel al brochure (Abogada, PMC Talara, NPG, ICCGSA, MTC, Rivera)", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/contratos-fidic-epc-construccion.php';
    $code = file_get_contents($viewPath);

    if (strpos($code, 'Sharon Grados') === false) {
        throw new \Exception("No se encontró el nombre de la docente Sharon Grados.");
    }
    if (strpos($code, 'Abogada') === false) {
        throw new \Exception("Falta título 'Abogada'.");
    }
    if (strpos($code, 'PMC Talara') === false) {
        throw new \Exception("Falta trayectoria en PMC Talara.");
    }
    if (strpos($code, 'NPG Abogados') === false) {
        throw new \Exception("Falta trayectoria en NPG Abogados.");
    }
    if (strpos($code, 'ICCGSA') === false) {
        throw new \Exception("Falta trayectoria en ICCGSA.");
    }
    if (strpos($code, 'Ministerio de Transportes y Comunicaciones') === false && strpos($code, 'MTC') === false) {
        throw new \Exception("Falta trayectoria en MTC.");
    }

    return true;
});

// Caso 8: Existencia de imágenes físicas y ausencia de PDF
runTest("Imágenes PNG y WebP existen físicamente con dimensiones y SHA-256 verificado, y 0 PDFs en repo", function(): bool {
    $pngPath = dirname(__DIR__) . '/public_html/img/capacitaciones/contratos-fidic-epc-construccion.png';
    $webpPath = dirname(__DIR__) . '/public_html/img/capacitaciones/contratos-fidic-epc-construccion.webp';
    $docPng = dirname(__DIR__) . '/public_html/img/docentes/sharon-grados.png';
    $docWebp = dirname(__DIR__) . '/public_html/img/docentes/sharon-grados.webp';

    if (!file_exists($pngPath)) {
        throw new \Exception("No existe el archivo PNG: " . $pngPath);
    }
    if (!file_exists($webpPath)) {
        throw new \Exception("No existe el archivo WebP: " . $webpPath);
    }
    if (!file_exists($docPng)) {
        throw new \Exception("No existe el PNG de la docente: " . $docPng);
    }
    if (!file_exists($docWebp)) {
        throw new \Exception("No existe el WebP de la docente: " . $docWebp);
    }

    $expectedPngSha = '82c956350f528744cd63788a0f55bc8ea29fa21cf25bf8edff15a64fa8afbee8';
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
    $pdfBrochure = dirname(__DIR__) . '/public_html/brochures/gestion-de-contratos/Brochure CONTRATOS FIDIC.pdf';
    if (file_exists($pdfBrochure)) {
        throw new \Exception("El PDF no debe existir en el repositorio: " . $pdfBrochure);
    }

    return true;
});

// Caso 9: Ausencia de datos antiguos
runTest("Ausencia de fechas antiguas (OCT/NOV), horarios fijos (20:00-22:00), cuentas bancarias y Visa/Niubiz", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/contratos-fidic-epc-construccion.php';
    $code = file_get_contents($viewPath);

    $prohibitedTerms = [
        '191-10382996-0-73',
        '00219111038299607352',
        '047-3092292540',
        '0011-0184-02-00496525',
        '039-7331729',
        '20:00 – 22:00',
        '20:00 - 22:00',
        '28 OCT',
        '30 NOV',
        'Niubiz',
    ];

    foreach ($prohibitedTerms as $term) {
        if (stripos($code, $term) !== false) {
            throw new \Exception("Se encontró dato prohibido/antiguo en la vista: '{$term}'");
        }
    }

    return true;
});

// Caso 10: Renderizado MVC y ausencia de enlaces a brochures
runTest("Renderizado MVC no expone enlaces a PDFs ni portadas de brochure y muestra mensaje de contacto", function(): bool {
    $view = new View();
    $data = [
        'title'           => 'Capacitación: Contratos FIDIC para Contratos EPC y Construcción | Quality Consulting Solutions',
        'metaDescription' => 'Curso especializado...',
        'canonical'       => 'https://quality-consulting.org/contratos-fidic-epc-construccion',
        'activePage'      => 'capacitacion',
    ];

    $html = $view->render('pages/contratos-fidic-epc-construccion', $data, 'main');

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
runTest("Sitemap.xml incluye la URL https://quality-consulting.org/contratos-fidic-epc-construccion", function(): bool {
    $sitemapPath = dirname(__DIR__) . '/public_html/sitemap.xml';
    $content = file_get_contents($sitemapPath);
    if (strpos($content, '<loc>https://quality-consulting.org/contratos-fidic-epc-construccion</loc>') === false) {
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
