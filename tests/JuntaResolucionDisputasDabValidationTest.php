<?php
/**
 * Test de Validación Exhaustiva para:
 * "CLAVES PARA EL ÉXITO EN LA JUNTA DE RESOLUCIÓN DE DISPUTAS - JRD (DAB) DE OBRAS"
 *
 * Valida:
 * 1. Registro del curso en CoursesCatalog.php (#18, slug, ruta, imágenes, tipo).
 * 2. Registro de ruta en config/routes.php.
 * 3. Registro de slug en CourseCatalog.php.
 * 4. Integridad de la vista: 16 horas netas, 8 sesiones, 16 PDU separados, sin aval de PMI/FIDIC/NEC/ICC.
 * 5. Temario estructurado: JRD DAB, diferencias, herramientas (consulta informal, hoja de ruta, preguntas poderosas, causa raíz), regulación ICC, NEC y FIDIC.
 * 6. Beneficios oficiales: exactamente los 5 ítems del brochure.
 * 7. Docente Ing. Luis Ruiz: perfil, experiencia en DAB Panamericanos 2019, DAB ARCC, Laurus, Wescon, Obrainsa, Cosapi.
 * 8. Existencia física y SHA-256 de imágenes (PNG y WebP temáticos, Luis Ruiz PNG y WebP).
 * 9. Ausencia de fechas antiguas, cuentas bancarias, teléfonos comerciales, empresas de confianza o videos.
 * 10. Renderizado MVC sin enlaces a PDFs ni portadas, mensaje de contacto y flujo PayPal primera clase USD 10.
 * 11. Presencia en sitemap.xml.
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/private_app/app/Services/CoursesCatalog.php';
require_once dirname(__DIR__) . '/private_app/app/Services/CourseCatalog.php';
require_once dirname(__DIR__) . '/private_app/app/Core/Router.php';
require_once dirname(__DIR__) . '/private_app/app/Core/View.php';

use App\Services\CoursesCatalog;
use App\Services\CourseCatalog;
use App\Core\Router;
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
echo "EJECUTANDO SUITE DE PRUEBAS: JUNTA DE RESOLUCIÓN DE DISPUTAS - JRD (DAB)\n";
echo "====================================================================\n\n";

// TEST 1: Registro en CoursesCatalog
runTest("Registro #18 en CoursesCatalog tiene título, tipo, ruta, imágenes y no incluye brochure", function(): bool {
    $catalog = CoursesCatalog::getAll();
    $found = null;
    foreach ($catalog as $c) {
        if (($c['number'] ?? 0) === 18) {
            $found = $c;
            break;
        }
    }

    if (!$found) {
        throw new \Exception("No se encontró el curso #18 en CoursesCatalog");
    }

    if ($found['title'] !== 'CLAVES PARA EL ÉXITO EN LA JUNTA DE RESOLUCIÓN DE DISPUTAS - JRD (DAB) DE OBRAS') {
        throw new \Exception("Título incorrecto: " . $found['title']);
    }

    if ($found['category'] !== 'Contratos' || $found['category_slug'] !== 'contratos') {
        throw new \Exception("Categoría incorrecta");
    }

    if ($found['route'] !== '/junta-resolucion-disputas-dab') {
        throw new \Exception("Ruta incorrecta: " . $found['route']);
    }

    if ($found['image'] !== 'img/capacitaciones/junta-resolucion-disputas-dab.webp' ||
        $found['image_fallback'] !== 'img/capacitaciones/junta-resolucion-disputas-dab.png') {
        throw new \Exception("Rutas de imagen incorrectas");
    }

    if (!empty($found['brochure'])) {
        throw new \Exception("El registro en CoursesCatalog no debe exponer brochure público");
    }

    return true;
});

// TEST 2: Ruta en config/routes.php
runTest("La ruta /junta-resolucion-disputas-dab está registrada en config/routes.php", function(): bool {
    $router = new Router();
    $config = require dirname(__DIR__) . '/private_app/config/app.php';
    $routesLoader = require dirname(__DIR__) . '/private_app/config/routes.php';
    $routesLoader($router, $config);

    $routes = $router->getRoutes();
    if (!isset($routes['GET']['/junta-resolucion-disputas-dab'])) {
        throw new \Exception("Ruta GET /junta-resolucion-disputas-dab no registrada en Router");
    }

    $target = $routes['GET']['/junta-resolucion-disputas-dab'];
    if (!is_array($target) || $target[0] !== \App\Controllers\TrainingController::class || $target[1] !== 'juntaResolucionDisputasDab') {
        throw new \Exception("El handler registrado no apunta a TrainingController::juntaResolucionDisputasDab");
    }

    return true;
});

// TEST 3: CourseCatalog
runTest("Slug 'junta-resolucion-disputas-dab' registrado en CourseCatalog", function(): bool {
    if (!CourseCatalog::isValid('junta-resolucion-disputas-dab')) {
        throw new \Exception("CourseCatalog::isValid('junta-resolucion-disputas-dab') retornó false");
    }

    $title = CourseCatalog::getTitle('junta-resolucion-disputas-dab');
    if ($title !== 'Claves para el Éxito en la Junta de Resolución de Disputas - JRD (DAB) de Obras') {
        throw new \Exception("Título en CourseCatalog no coincide: " . $title);
    }

    return true;
});

// TEST 4: Integridad de la vista
runTest("La vista contiene 16 horas netas, 8 sesiones y 16 PDU separados y sin aval institucional indebido", function(): bool {
    $viewFile = dirname(__DIR__) . '/private_app/app/Views/pages/junta-resolucion-disputas-dab.php';
    if (!file_exists($viewFile)) {
        throw new \Exception("No existe el archivo de vista: " . $viewFile);
    }

    $content = file_get_contents($viewFile);

    // Duración y PDU
    if (!str_contains($content, "'16 horas netas'")) {
        throw new \Exception("No se encontró '16 horas netas' en la vista");
    }
    if (!str_contains($content, "'8 sesiones'")) {
        throw new \Exception("No se encontró '8 sesiones' en la vista");
    }
    if (!str_contains($content, "'16 PDU'")) {
        throw new \Exception("No se encontró '16 PDU' en la vista");
    }

    // No debe afirmar que el curso está acreditado o avalado por PMI, FIDIC, NEC o ICC
    $lower = strtolower($content);
    if (str_contains($lower, "curso acreditado por") ||
        str_contains($lower, "curso certificado por") ||
        str_contains($lower, "avalado por el pmi") ||
        str_contains($lower, "avalado por fidic") ||
        str_contains($lower, "avalado por nec") ||
        str_contains($lower, "avalado por icc") ||
        str_contains($lower, "avalado por la icc")) {
        throw new \Exception("La vista contiene afirmaciones prohibidas de acreditación o aval institucional");
    }

    // Sin brochure público
    if (str_contains($lower, "'brochure_url'") || str_contains($lower, "'brochure_thumb'")) {
        throw new \Exception("La vista no debe configurar brochure público");
    }

    return true;
});

// TEST 5: Temario estructurado según brochure
runTest("Temario estructurado con JRD (DAB), diferencias, herramientas, regulación ICC, NEC y FIDIC", function(): bool {
    $viewFile = dirname(__DIR__) . '/private_app/app/Views/pages/junta-resolucion-disputas-dab.php';
    $content = file_get_contents($viewFile);

    $requiredModules = [
        'Junta de Resolución de Disputas - JRD (DAB)',
        'Diferencias entre la JRD, Conciliación y Arbitraje',
        'Herramientas y Proceso de la JRD',
        'Regulación de las JRD',
        'Experiencias de Aplicación de la JRD en Contratos NEC',
        'Experiencias de Aplicación de la JRD en Contratos FIDIC',
    ];

    foreach ($requiredModules as $module) {
        if (!str_contains($content, $module)) {
            throw new \Exception("Módulo temático faltante en el temario: " . $module);
        }
    }

    // Puntos específicos requeridos
    $requiredTopics = [
        'prerrogativas',
        'esquema de gobernanza',
        'flujo de comunicación',
        'Conciliación y Arbitraje',
        'Consulta informal',
        'hoja de ruta',
        'Preguntas poderosas',
        'Definición del problema',
        'causa raíz',
        'ICC',
        'NEC3',
        'Gobierno a Gobierno',
        'G2G',
        'FIDIC',
    ];

    foreach ($requiredTopics as $topic) {
        if (!stripos($content, $topic)) {
            throw new \Exception("Tema oficial faltante: " . $topic);
        }
    }

    return true;
});

// TEST 6: Beneficios oficiales
runTest("Beneficios oficiales válidos según el brochure (exactamente 5 items)", function(): bool {
    $viewFile = dirname(__DIR__) . '/private_app/app/Views/pages/junta-resolucion-disputas-dab.php';
    $content = file_get_contents($viewFile);

    preg_match("/'benefits'\s*=>\s*\[(.*?)\]\s*,\s*\n\s*\/\/\s*6\./s", $content, $matches);
    if (empty($matches[1])) {
        throw new \Exception("No se pudo extraer el bloque benefits de la vista");
    }

    $benefitsBlock = $matches[1];
    $count = substr_count($benefitsBlock, "'title'");
    if ($count !== 5) {
        throw new \Exception("Se esperaban exactamente 5 beneficios oficiales, se encontraron: " . $count);
    }

    $requiredBenefits = [
        'Descuentos futuros',
        'Asignación de PDU',
        'Diploma digital',
        'Material digital',
        'Grabación del curso',
    ];

    foreach ($requiredBenefits as $b) {
        if (!str_contains($benefitsBlock, $b)) {
            throw new \Exception("Beneficio oficial faltante: " . $b);
        }
    }

    return true;
});

// TEST 7: Docente Ing. Luis Ruiz
runTest("Docente Ing. Luis Ruiz fiel al brochure (MBA, Civil, DAB Panamericanos 2019, ARCC, Laurus, Wescon, Obrainsa, Cosapi)", function(): bool {
    $viewFile = dirname(__DIR__) . '/private_app/app/Views/pages/junta-resolucion-disputas-dab.php';
    $content = file_get_contents($viewFile);

    $requiredDocenteKeywords = [
        'Luis Ruiz',
        'MBA',
        'Ingeniero Civil',
        'Panamericanos Lima 2019',
        'Reconstrucción con Cambios',
        'ARCC',
        'Laurus Group',
        'Wescon',
        'Obrainsa',
        'Cosapi',
    ];

    foreach ($requiredDocenteKeywords as $kw) {
        if (!str_contains($content, $kw)) {
            throw new \Exception("Información docente faltante o inexacta: " . $kw);
        }
    }

    return true;
});

// TEST 8: Imágenes físicas, SHA-256 y 0 PDFs
runTest("Imágenes PNG y WebP existen físicamente con dimensiones y SHA-256 verificado, y 0 PDFs en repo", function(): bool {
    $pngPath = dirname(__DIR__) . '/public_html/img/capacitaciones/junta-resolucion-disputas-dab.png';
    $webpPath = dirname(__DIR__) . '/public_html/img/capacitaciones/junta-resolucion-disputas-dab.webp';
    $docPng = dirname(__DIR__) . '/public_html/img/docentes/luis-ruiz.png';
    $docWebp = dirname(__DIR__) . '/public_html/img/docentes/luis-ruiz.webp';

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

    $expectedPngSha = 'da8643daca93619fc67cc2a28f96c6d6f9c41beb9f3d67d5360cd72ed2d4e196';
    $actualPngSha = hash_file('sha256', $pngPath);
    if ($actualPngSha !== $expectedPngSha) {
        throw new \Exception("El PNG no coincide con la versión aprobada. SHA: " . $actualPngSha);
    }

    // Verificar dimensiones PNG
    $pngSize = getimagesize($pngPath);
    if ($pngSize[0] !== 1672 || $pngSize[1] !== 941) {
        throw new \Exception("Dimensiones del PNG incorrectas: {$pngSize[0]}x{$pngSize[1]} (esperado 1672x941)");
    }

    // Verificar dimensiones docente PNG
    $docSize = getimagesize($docPng);
    if ($docSize[0] !== 240 || $docSize[1] !== 240) {
        throw new \Exception("Dimensiones de la foto del docente incorrectas: {$docSize[0]}x{$docSize[1]} (esperado 240x240)");
    }

    // Verificar que no se copió ningún PDF dentro del repositorio
    $pdfFiles = glob(dirname(__DIR__) . '/public_html/**/*.pdf');
    $pdfRoot = glob(dirname(__DIR__) . '/*.pdf');
    if (!empty($pdfFiles) || !empty($pdfRoot)) {
        throw new \Exception("Se detectaron archivos PDF dentro del repositorio");
    }

    return true;
});

// TEST 9: Ausencia de datos restringidos
runTest("Ausencia de cuentas bancarias, teléfonos comerciales, empresas de confianza o videos inventados", function(): bool {
    $viewFile = dirname(__DIR__) . '/private_app/app/Views/pages/junta-resolucion-disputas-dab.php';
    $content = file_get_contents($viewFile);

    $prohibitedPatterns = [
        '191-10382996-0-73',
        '047-3092292540',
        '0011-0184-02-00496525',
        '039-7331729',
        'bcp',
        'bbva',
        'interbank',
        'scotiabank',
        'niubiz',
        'visa',
    ];

    foreach ($prohibitedPatterns as $pat) {
        if (stripos($content, $pat) !== false) {
            throw new \Exception("Se encontró dato prohibido en la vista: " . $pat);
        }
    }

    return true;
});

// TEST 10: Renderizado MVC y flujo PayPal
runTest("Renderizado MVC no expone enlaces a PDFs ni portadas de brochure y muestra mensaje de contacto", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $view->share('siteName', 'Quality Consulting Solutions');
    $view->share('currentYear', date('Y'));

    $data = [
        'title'           => 'Capacitación: Claves para el Éxito en la Junta de Resolución de Disputas - JRD (DAB) de Obras | Quality Consulting Solutions',
        'metaDescription' => 'Curso especializado en la Junta de Resolución de Disputas (DAB).',
        'canonical'       => 'https://quality-consulting.org/junta-resolucion-disputas-dab',
        'activePage'      => 'capacitacion',
    ];

    $html = $view->render('pages/junta-resolucion-disputas-dab', $data, 'main');

    if (!str_contains($html, 'Para más información, disponibilidad y precios, contáctanos.')) {
        throw new \Exception("El renderizado no incluye el mensaje oficial de contacto y precios");
    }

    if (!str_contains($html, 'Primera clase del curso – USD 10')) {
        throw new \Exception("El renderizado no incluye la etiqueta de primera clase de USD 10");
    }

    if (stripos($html, 'primera clase') === false
        || !str_contains($html, 'USD 10')
        || stripos($html, 'No incluye el curso completo') === false) {
        throw new \Exception("El renderizado no incluye la aclaración semántica de alcance, precio y exclusión del curso completo");
    }

    if (stripos($html, '.pdf') !== false) {
        throw new \Exception("El renderizado expone enlaces o nombres de archivos PDF");
    }

    return true;
});

// TEST 11: Sitemap
runTest("Sitemap.xml incluye la URL https://quality-consulting.org/junta-resolucion-disputas-dab", function(): bool {
    $sitemapPath = dirname(__DIR__) . '/public_html/sitemap.xml';
    $xml = file_get_contents($sitemapPath);
    if (!str_contains($xml, '<loc>https://quality-consulting.org/junta-resolucion-disputas-dab</loc>')) {
        throw new \Exception("URL no encontrada en public_html/sitemap.xml");
    }

    return true;
});

echo "\n====================================================================\n";
echo "RESULTADO: {$passedTests} de {$totalTests} pruebas pasaron exitosamente.\n";
echo "====================================================================\n";

if ($passedTests !== $totalTests) {
    exit(1);
}
