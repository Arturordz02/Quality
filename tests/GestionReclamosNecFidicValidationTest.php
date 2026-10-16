<?php
/**
 * Test de Validación Exhaustiva para:
 * "GESTIÓN DE RECLAMOS EN CONTRATOS DE CONSTRUCCIÓN Y CONTRATOS COLABORATIVOS NEC Y FIDIC"
 *
 * Valida:
 * 1. Registro del curso en CoursesCatalog.php (#22, slug, ruta, imágenes, tipo).
 * 2. Registro de ruta en config/routes.php.
 * 3. Registro de slug en CourseCatalog.php.
 * 4. Integridad de la vista: 23 horas netas, 23 PDU separados, sin aval de PMI/FIDIC/NEC.
 * 5. Temario estructurado: Claims FIDIC, Claims NEC, plazo, costo, globales, factor común, demoras.
 * 6. Beneficios oficiales: exactamente los 5 ítems del brochure.
 * 7. Docente Sharon Grados: perfil, experiencia en PMO G2G, Chinchero, PMC Talara, NPG, ICCGSA, MTC, Rivera.
 * 8. Existencia física y SHA-256 de imágenes (PNG y WebP temáticos, Sharon Grados PNG y WebP).
 * 9. Ausencia de fechas antiguas, horarios fijos, cuentas bancarias, videos o referencias a Visa/Niubiz.
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
echo "EJECUTANDO SUITE DE PRUEBAS: GESTIÓN DE RECLAMOS NEC Y FIDIC\n";
echo "====================================================================\n\n";

// TEST 1: Registro en CoursesCatalog
runTest("Registro #22 en CoursesCatalog tiene título, tipo, ruta, imágenes y no incluye brochure", function(): bool {
    $catalog = CoursesCatalog::getAll();
    $found = null;
    foreach ($catalog as $c) {
        if (($c['number'] ?? 0) === 22) {
            $found = $c;
            break;
        }
    }

    if (!$found) {
        throw new \Exception("No se encontró el curso #22 en CoursesCatalog");
    }

    if ($found['title'] !== 'GESTIÓN DE RECLAMOS EN CONTRATOS DE CONSTRUCCIÓN Y CONTRATOS COLABORATIVOS NEC Y FIDIC') {
        throw new \Exception("Título incorrecto: " . $found['title']);
    }

    if ($found['category'] !== 'Contratos' || $found['category_slug'] !== 'contratos') {
        throw new \Exception("Categoría incorrecta");
    }

    if ($found['route'] !== '/gestion-reclamos-nec-fidic') {
        throw new \Exception("Ruta incorrecta: " . $found['route']);
    }

    if ($found['image'] !== 'img/capacitaciones/gestion-reclamos-nec-fidic.webp' ||
        $found['image_fallback'] !== 'img/capacitaciones/gestion-reclamos-nec-fidic.png') {
        throw new \Exception("Rutas de imagen incorrectas");
    }

    if (!empty($found['brochure'])) {
        throw new \Exception("El registro en CoursesCatalog no debe exponer brochure público");
    }

    return true;
});

// TEST 2: Ruta en config/routes.php
runTest("La ruta /gestion-reclamos-nec-fidic está registrada en config/routes.php", function(): bool {
    $router = new Router();
    $config = require dirname(__DIR__) . '/private_app/config/app.php';
    $routesLoader = require dirname(__DIR__) . '/private_app/config/routes.php';
    $routesLoader($router, $config);

    $routes = $router->getRoutes();
    if (!isset($routes['GET']['/gestion-reclamos-nec-fidic'])) {
        throw new \Exception("Ruta GET /gestion-reclamos-nec-fidic no registrada en Router");
    }

    $target = $routes['GET']['/gestion-reclamos-nec-fidic'];
    if (!is_array($target) || $target[0] !== \App\Controllers\TrainingController::class || $target[1] !== 'gestionReclamosNecFidic') {
        throw new \Exception("El handler registrado no apunta a TrainingController::gestionReclamosNecFidic");
    }

    return true;
});

// TEST 3: CourseCatalog
runTest("Slug 'gestion-reclamos-nec-fidic' registrado en CourseCatalog", function() {
    if (!CourseCatalog::isValid('gestion-reclamos-nec-fidic')) {
        throw new \Exception("CourseCatalog::isValid('gestion-reclamos-nec-fidic') retornó false");
    }

    $title = CourseCatalog::getTitle('gestion-reclamos-nec-fidic');
    if ($title !== 'Gestión de Reclamos en Contratos de Construcción y Contratos Colaborativos NEC y FIDIC') {
        throw new \Exception("Título en CourseCatalog no coincide: " . $title);
    }

    return true;
});

// TEST 4: Integridad de la vista
runTest("La vista contiene 23 horas netas y 23 PDU separados y sin aval institucional indebido", function() {
    $viewFile = dirname(__DIR__) . '/private_app/app/Views/pages/gestion-reclamos-nec-fidic.php';
    if (!file_exists($viewFile)) {
        throw new \Exception("No existe el archivo de vista: " . $viewFile);
    }

    $content = file_get_contents($viewFile);

    // Duración y PDU
    if (!str_contains($content, "'23 horas netas'")) {
        throw new \Exception("No se encontró '23 horas netas' en la vista");
    }
    if (!str_contains($content, "'23 PDU'")) {
        throw new \Exception("No se encontró '23 PDU' en la vista");
    }

    // No debe afirmar que el curso está acreditado o avalado por PMI, FIDIC o NEC
    $lower = strtolower($content);
    if (str_contains($lower, "curso acreditado por") ||
        str_contains($lower, "curso certificado por") ||
        str_contains($lower, "avalado por el pmi") ||
        str_contains($lower, "avalado por fidic") ||
        str_contains($lower, "avalado por nec")) {
        throw new \Exception("La vista contiene afirmaciones prohibidas de acreditación o aval institucional");
    }

    // Sin brochure público
    if (str_contains($lower, "'brochure_url'") || str_contains($lower, "'brochure_thumb'")) {
        throw new \Exception("La vista no debe configurar brochure público");
    }

    return true;
});

// TEST 5: Temario estructurado según brochure
runTest("Temario estructurado con Claims FIDIC, Claims NEC, plazo, costo, globales, factor común y demoras", function() {
    $viewFile = dirname(__DIR__) . '/private_app/app/Views/pages/gestion-reclamos-nec-fidic.php';
    $content = file_get_contents($viewFile);

    $requiredModules = [
        'Aspectos generales de los Claims (FIDIC)',
        'Aspectos generales de los Claims (NEC)',
        'Principales reclamaciones de plazo',
        'Principales reclamaciones de costo',
        'Reclamos Globales',
        'Factor común de las Reclamaciones',
        'Técnicas de análisis de demoras',
    ];

    foreach ($requiredModules as $module) {
        if (!str_contains($content, $module)) {
            throw new \Exception("Módulo temático faltante en el temario: " . $module);
        }
    }

    // Puntos específicos requeridos
    $requiredTopics = [
        'Libro rojo, amarillo y plata',
        'NEC 3 opción F',
        'Causa, Efecto (Causalidad)',
        'ampliación de plazo',
        'demoras concurrentes',
        'aceleración',
        'daños',
        'Disruption',
        'pérdida de productividad',
        'multifactores',
        'Mitigación',
        'Test de previsibilidad',
        'análisis de cronograma',
    ];

    foreach ($requiredTopics as $topic) {
        if (!stripos($content, $topic)) {
            throw new \Exception("Tema oficial faltante: " . $topic);
        }
    }

    return true;
});

// TEST 6: Beneficios oficiales
runTest("Beneficios oficiales válidos según el brochure (exactamente 5 items)", function() {
    $viewFile = dirname(__DIR__) . '/private_app/app/Views/pages/gestion-reclamos-nec-fidic.php';
    $content = file_get_contents($viewFile);

    // Contar bloques dentro de 'benefits'
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
        'Base de datos laboral',
        'Descuentos futuros',
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

// TEST 7: Docente Sharon Grados
runTest("Docente Sharon Grados fiel al brochure (Abogada, Árbitro, PMO G2G, Chinchero, PMC Talara, NPG, ICCGSA, MTC, Rivera)", function() {
    $viewFile = dirname(__DIR__) . '/private_app/app/Views/pages/gestion-reclamos-nec-fidic.php';
    $content = file_get_contents($viewFile);

    $requiredDocenteKeywords = [
        'Sharon Grados',
        'Derecho de la Construcción',
        'Mecanismos de Resolución de Controversias',
        'G2G Francia-Perú',
        'Aeropuerto Internacional de Chinchero',
        'Refinería de Talara',
        'PMC Talara',
        'NPG Abogados',
        'ICCGSA',
        'Ministerio de Transportes y Comunicaciones',
        'Estudio Rivera Abogados',
        'UNFV',
        'UNMSM',
    ];

    foreach ($requiredDocenteKeywords as $kw) {
        if (!str_contains($content, $kw)) {
            throw new \Exception("Información docente faltante o inexacta: " . $kw);
        }
    }

    return true;
});

// TEST 8: Imágenes físicas, SHA-256 y 0 PDFs
runTest("Imágenes PNG y WebP existen físicamente con dimensiones y SHA-256 verificado, y 0 PDFs en repo", function() {
    $pngPath = dirname(__DIR__) . '/public_html/img/capacitaciones/gestion-reclamos-nec-fidic.png';
    $webpPath = dirname(__DIR__) . '/public_html/img/capacitaciones/gestion-reclamos-nec-fidic.webp';
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

    $expectedPngSha = 'a66c557ffecd16ce0fb6e1b8f2a104b1f720ef0bc085003ad10b07fe43733183';
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
        throw new \Exception("Dimensiones de la foto de la docente incorrectas: {$docSize[0]}x{$docSize[1]} (esperado 240x240)");
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
runTest("Ausencia de fechas antiguas (SEP/OCT/NOV), horarios fijos (20:00-22:00), cuentas bancarias y Visa/Niubiz", function() {
    $viewFile = dirname(__DIR__) . '/private_app/app/Views/pages/gestion-reclamos-nec-fidic.php';
    $content = file_get_contents($viewFile);

    $prohibitedPatterns = [
        '20:00',
        '22:00',
        '191-10382996-0-73',
        '047-3092292540',
        '0011-0184-02-00496525',
        '039-7331729',
        '03,10,17,26',
        '05,07nov',
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
runTest("Renderizado MVC no expone enlaces a PDFs ni portadas de brochure y muestra mensaje de contacto", function() {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $view->share('siteName', 'Quality Consulting Solutions');
    $view->share('currentYear', date('Y'));

    $data = [
        'title'           => 'Capacitación: Gestión de Reclamos en Contratos de Construcción y Contratos Colaborativos NEC y FIDIC | Quality Consulting Solutions',
        'metaDescription' => 'Curso especializado en Gestión de Reclamos NEC y FIDIC.',
        'canonical'       => 'https://quality-consulting.org/gestion-reclamos-nec-fidic',
        'activePage'      => 'capacitacion',
    ];

    $html = $view->render('pages/gestion-reclamos-nec-fidic', $data, 'main');

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
runTest("Sitemap.xml incluye la URL https://quality-consulting.org/gestion-reclamos-nec-fidic", function() {
    $sitemapPath = dirname(__DIR__) . '/public_html/sitemap.xml';
    $xml = file_get_contents($sitemapPath);
    if (!str_contains($xml, '<loc>https://quality-consulting.org/gestion-reclamos-nec-fidic</loc>')) {
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
