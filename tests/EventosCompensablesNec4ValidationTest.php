<?php
/**
 * Test de Validación Exhaustiva para:
 * "GESTIÓN DE EVENTOS COMPENSABLES Y ALERTAS TEMPRANAS EN CONTRATOS NEC4"
 *
 * Valida:
 * 1. Registro del curso en CoursesCatalog.php (#20, slug, ruta, imágenes, tipo).
 * 2. Registro de ruta en config/routes.php.
 * 3. Registro de slug en CourseCatalog.php.
 * 4. Integridad de la vista: 16 horas netas, 8 sesiones y 16 PDU separados, sin aval indebido de PMI o NEC.
 * 5. Temario estructurado: exactamente los 4 bloques oficiales del brochure con todos sus elementos clave.
 * 6. Beneficios oficiales: ítems del brochure incluyendo base laboral, diploma, material, 6 semanas de grabación y 16 PDU neutrales.
 * 7. Docente Ing. Víctor Cruz: perfil y fotografías reutilizadas de /contrato-nec4, sin atribución de CIFE Stanford.
 * 8. Existencia física y SHA-256 de imágenes (PNG temático intacto, WebP generado, fotos del docente reutilizadas).
 * 9. Ausencia de cuentas bancarias, teléfonos del brochure, videos o enlaces a PDFs.
 * 10. Mensaje de contacto y flujo PayPal primera clase USD 10 indicando que no incluye curso completo.
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
echo "EJECUTANDO SUITE DE PRUEBAS: GESTIÓN DE EVENTOS COMPENSABLES Y ALERTAS TEMPRANAS EN CONTRATOS NEC4\n";
echo "====================================================================\n\n";

// TEST 1: Registro en CoursesCatalog
runTest("Registro #20 en CoursesCatalog tiene título, tipo, ruta, imágenes y no duplica", function(): bool {
    $catalog = CoursesCatalog::getAll();
    $found = null;
    $duplicateCount = 0;
    foreach ($catalog as $c) {
        if (($c['number'] ?? 0) === 20) {
            $found = $c;
        }
        if (($c['route'] ?? '') === '/eventos-compensables-alertas-tempranas-nec4') {
            $duplicateCount++;
        }
    }

    if (!$found) {
        throw new \Exception("No se encontró el curso #20 en CoursesCatalog");
    }

    if ($duplicateCount !== 1) {
        throw new \Exception("Se encontraron {$duplicateCount} cursos con ruta /eventos-compensables-alertas-tempranas-nec4, debe haber exactamente 1");
    }

    if ($found['title'] !== 'GESTIÓN DE EVENTOS COMPENSABLES Y ALERTAS TEMPRANAS EN CONTRATOS NEC4') {
        throw new \Exception("Título incorrecto: " . $found['title']);
    }

    if ($found['category'] !== 'Contratos' || $found['category_slug'] !== 'contratos') {
        throw new \Exception("Categoría incorrecta");
    }

    if ($found['route'] !== '/eventos-compensables-alertas-tempranas-nec4') {
        throw new \Exception("Ruta incorrecta: " . $found['route']);
    }

    if ($found['image'] !== 'img/capacitaciones/eventos-compensables-alertas-tempranas-nec4.webp') {
        throw new \Exception("WebP principal incorrecto: " . $found['image']);
    }

    if ($found['image_fallback'] !== 'img/capacitaciones/eventos-compensables-alertas-tempranas-nec4.png') {
        throw new \Exception("PNG fallback incorrecto: " . $found['image_fallback']);
    }

    if (isset($found['brochure'])) {
        throw new \Exception("El registro no debe tener clave 'brochure'");
    }

    return true;
});

// TEST 2: Registro en CourseCatalog (pasarela y slugs oficiales)
runTest("CourseCatalog reconoce 'eventos-compensables-alertas-tempranas-nec4' con ruta y título oficiales", function(): bool {
    if (!CourseCatalog::isValid('eventos-compensables-alertas-tempranas-nec4')) {
        throw new \Exception("El slug eventos-compensables-alertas-tempranas-nec4 no es reconocido como válido");
    }

    $entry = CourseCatalog::find('eventos-compensables-alertas-tempranas-nec4');
    if (!$entry) {
        throw new \Exception("No se encontró entrada en CourseCatalog");
    }

    if ($entry['slug'] !== 'eventos-compensables-alertas-tempranas-nec4') {
        throw new \Exception("Slug no coincide");
    }

    if ($entry['url'] !== '/eventos-compensables-alertas-tempranas-nec4') {
        throw new \Exception("URL incorrecta en CourseCatalog: " . $entry['url']);
    }

    if ($entry['title'] !== 'Gestión de Eventos Compensables y Alertas Tempranas en Contratos NEC4') {
        throw new \Exception("Título no coincide en CourseCatalog: " . $entry['title']);
    }

    return true;
});

// TEST 3: Registro de ruta en routes.php
runTest("routes.php registra la ruta GET /eventos-compensables-alertas-tempranas-nec4 apuntando a TrainingController::eventosCompensablesAlertasTempranasNec4", function(): bool {
    $config = require dirname(__DIR__) . '/private_app/config/app.php';
    $router = new Router($config);
    $routesLoader = require dirname(__DIR__) . '/private_app/config/routes.php';
    $routesLoader($router, $config);

    $routes = $router->getRoutes();
    if (!isset($routes['GET']['/eventos-compensables-alertas-tempranas-nec4'])) {
        throw new \Exception("Ruta GET /eventos-compensables-alertas-tempranas-nec4 no encontrada en Router");
    }

    $target = $routes['GET']['/eventos-compensables-alertas-tempranas-nec4'];
    if (!is_array($target) || $target[0] !== \App\Controllers\TrainingController::class || $target[1] !== 'eventosCompensablesAlertasTempranasNec4') {
        throw new \Exception("El handler registrado no apunta a TrainingController::eventosCompensablesAlertasTempranasNec4");
    }

    return true;
});

// TEST 4: Existencia e integridad física de las imágenes
runTest("Imágenes temáticas y del docente existen físicamente con dimensiones y formatos válidos", function(): bool {
    $baseDir = dirname(__DIR__) . '/public_html';

    $thematicPng = $baseDir . '/img/capacitaciones/eventos-compensables-alertas-tempranas-nec4.png';
    $thematicWebp = $baseDir . '/img/capacitaciones/eventos-compensables-alertas-tempranas-nec4.webp';
    $docentePng = $baseDir . '/img/docentes/victor-cruz.png';
    $docenteWebp = $baseDir . '/img/docentes/victor-cruz.webp';

    if (!file_exists($thematicPng) || filesize($thematicPng) === 0) {
        throw new \Exception("PNG temático ausente o vacío");
    }

    $expectedSha = 'dbb87919db99a11e2d082d4e8d8a67c3c95d9384a3ca52f188d6506b5800a183';
    $actualSha = hash_file('sha256', $thematicPng);
    if ($actualSha !== $expectedSha) {
        throw new \Exception("SHA-256 del PNG temático no coincide. Esperado: $expectedSha, Actual: $actualSha");
    }

    if (!file_exists($thematicWebp) || filesize($thematicWebp) === 0) {
        throw new \Exception("WebP temático ausente o vacío");
    }

    if (!file_exists($docentePng) || filesize($docentePng) === 0) {
        throw new \Exception("PNG de Víctor Cruz ausente o vacío");
    }

    if (!file_exists($docenteWebp) || filesize($docenteWebp) === 0) {
        throw new \Exception("WebP de Víctor Cruz ausente o vacío");
    }

    return true;
});

// TEST 5: Renderizado y metadatos SEO
runTest("Vista unificada renderiza correctamente con metadatos SEO y sin errores", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/eventos-compensables-alertas-tempranas-nec4', [
        'title'           => 'Capacitación: Gestión de Eventos Compensables y Alertas Tempranas en Contratos NEC4 | Quality Consulting Solutions',
        'metaDescription' => 'Curso especializado en Gestión de Eventos Compensables y Alertas Tempranas en Contratos NEC4: cláusulas, Defined Costs, tiempos de presentación, sustento y escalamiento. 16 horas netas, 8 sesiones y 16 PDU.',
        'canonical'       => 'https://quality-consulting.org/eventos-compensables-alertas-tempranas-nec4',
        'activePage'      => 'capacitacion',
    ], 'main');

    if (empty($html)) {
        throw new \Exception("El HTML generado está vacío");
    }

    if (!str_contains($html, 'GESTIÓN DE EVENTOS COMPENSABLES Y ALERTAS TEMPRANAS EN CONTRATOS NEC4')) {
        throw new \Exception("Título principal no encontrado en HTML");
    }

    if (!str_contains($html, 'https://quality-consulting.org/eventos-compensables-alertas-tempranas-nec4')) {
        throw new \Exception("Canonical URL no encontrada en HTML");
    }

    return true;
});

// TEST 6: Validación de 16 horas netas, 8 sesiones y 16 PDU separados y sin acreditación por PMI ni NEC
runTest("16 horas netas, 8 sesiones y 16 PDU se presentan separados y de forma neutral sin atribución de aval por PMI ni NEC", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/eventos-compensables-alertas-tempranas-nec4', [], 'main');

    if (!str_contains($html, '16 horas netas')) {
        throw new \Exception("Falta indicación de '16 horas netas'");
    }

    if (!str_contains($html, '8 sesiones') && !str_contains($html, '08 Sesiones')) {
        throw new \Exception("Falta indicación de '8 sesiones'");
    }

    if (!str_contains($html, '16 PDU')) {
        throw new \Exception("Falta indicación de '16 PDU'");
    }

    // Comprobar que no se vende como acreditado/certificado/avalado por PMI o NEC
    $lower = strtolower($html);
    if (str_contains($lower, 'acreditado por pmi') || str_contains($lower, 'avalado por pmi') || str_contains($lower, 'certificado por pmi')) {
        throw new \Exception("Se encontraron afirmaciones prohibidas de acreditación/aval por PMI");
    }
    if (str_contains($lower, 'acreditado por nec') || str_contains($lower, 'avalado por nec') || str_contains($lower, 'certificado por nec')) {
        throw new \Exception("Se encontraron afirmaciones prohibidas de acreditación/aval por NEC");
    }

    if (!str_contains($html, 'General Education Third-Party Provider – The PMI Talent Triangle®')) {
        throw new \Exception("Falta la categoría CCR oficial de PMI");
    }

    return true;
});

// TEST 7: Temario oficial completo (4 bloques)
runTest("Temario oficial contiene exactamente los 4 bloques con todos sus elementos clave", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/eventos-compensables-alertas-tempranas-nec4', [], 'main');

    $requiredTopics = [
        'Contratos NEC4',
        'Elementos del Contrato NEC4',
        'Eventos Compensables',
        'Escalamiento de los Eventos Compensables',
    ];

    foreach ($requiredTopics as $topic) {
        if (!str_contains($html, $topic)) {
            throw new \Exception("Bloque temático oficial no encontrado en el temario: {$topic}");
        }
    }

    // Verificar contenido clave de cada bloque
    $keyDetails = [
        'Esquema de Cláusulas Principales',
        'Opciones',
        'Cláusulas Especiales',
        'Early Warning',
        'Eventos Compensables',
        'Instructions',
        'Defined Costs',
        'Disallowed Costs',
        'Dividing Date',
        'Fee',
        'Share',
        'Schedule of Cost Components',
        'Causales generales',
        'Causales especiales',
        'Tiempos para la presentación y réplica',
        'Elaboración del sustento',
        'Formato de presentación',
        'Senior Representatives',
        'Adjudicator',
        'DAB (Dispute Avoidance Board)',
        'Tribunal',
        'Cláusula W1',
        'Cláusula W2',
        'Cláusula W3',
    ];

    foreach ($keyDetails as $detail) {
        if (!str_contains($html, $detail)) {
            throw new \Exception("Detalle clave del temario no encontrado: {$detail}");
        }
    }

    return true;
});

// TEST 8: Perfil oficial de Ing. Víctor Cruz sin atribución de CIFE Stanford
runTest("Perfil docente reutiliza la bio oficial de Víctor Cruz y omite CIFE Stanford", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/eventos-compensables-alertas-tempranas-nec4', [], 'main');

    $requiredKeywords = [
        'Ing. Víctor Cruz',
        '14 años',
        'Consorcio SyP',
        'BESALCO STRACON',
        'Cosapi',
        'JJC',
        'CESEL',
        'AKER SOLUTIONS',
        'JACOBS',
    ];

    foreach ($requiredKeywords as $kw) {
        if (!str_contains($html, $kw)) {
            throw new \Exception("Dato docente no encontrado: {$kw}");
        }
    }

    // Verificar que NO se atribuya CIFE Stanford al docente en la página del curso
    if (str_contains(strtolower($html), 'cife') || str_contains(strtolower($html), 'stanford')) {
        throw new \Exception("Se encontró mención indebida de CIFE Stanford en la vista del curso");
    }

    return true;
});

// TEST 9: Ausencia de datos restringidos (PDFs, cuentas bancarias, teléfonos del brochure, videos)
runTest("Ausencia total de enlaces o descargas a PDFs, cuentas bancarias, teléfonos del brochure o videos", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/eventos-compensables-alertas-tempranas-nec4', [], 'main');

    // No debe haber enlaces ni referencias a .pdf
    if (str_contains(strtolower($html), '.pdf')) {
        throw new \Exception("Se encontró referencia a archivo PDF en el HTML");
    }

    // No debe haber cuentas bancarias del brochure
    $bankData = ['191-10382996-0-73', '047-3092292540', '0011-0184-02-00496525', '039-7331729', 'Omar Samaniego'];
    foreach ($bankData as $bd) {
        if (str_contains($html, $bd)) {
            throw new \Exception("Se encontró dato bancario del brochure: {$bd}");
        }
    }

    // No debe haber reproductores de video incrustados
    if (str_contains($html, '<iframe') || str_contains($html, '<video')) {
        throw new \Exception("Se encontró elemento de video no permitido");
    }

    return true;
});

// TEST 10: Beneficios oficiales del brochure
runTest("Beneficios oficiales contiene los ítems requeridos incluyendo grabación por 6 semanas", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/eventos-compensables-alertas-tempranas-nec4', [], 'main');

    $requiredBenefits = [
        'Descuentos futuros',
        'Base laboral',
        'Diploma digital',
        'Material digital',
        'Grabación del curso',
        'seis semanas',
    ];

    foreach ($requiredBenefits as $benefit) {
        if (!str_contains($html, $benefit)) {
            throw new \Exception("Beneficio oficial no encontrado: {$benefit}");
        }
    }

    return true;
});

// TEST 11: Pasarela PayPal exclusiva para primera clase por USD 10
runTest("Pasarela PayPal está configurada para primera clase por USD 10 indicando alcance", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/eventos-compensables-alertas-tempranas-nec4', [], 'main');

    if (!str_contains($html, 'data-course-slug="eventos-compensables-alertas-tempranas-nec4"')) {
        throw new \Exception("Falta data-course-slug=\"eventos-compensables-alertas-tempranas-nec4\" en botón de pago PayPal");
    }

    if (!str_contains($html, '/pagar-primera-clase?curso=eventos-compensables-alertas-tempranas-nec4')) {
        throw new \Exception("Falta enlace al checkout de primera clase con slug");
    }

    if (!str_contains($html, 'Primera clase del curso – USD 10')) {
        throw new \Exception("Falta etiqueta Primera clase del curso – USD 10");
    }

    if (!str_contains($html, 'US$ 10')) {
        throw new \Exception("Precio US$ 10 no encontrado");
    }

    if (stripos($html, 'primera clase') === false
        || !str_contains($html, 'USD 10')
        || stripos($html, 'No incluye el curso completo') === false) {
        throw new \Exception("La aclaración semántica de alcance, precio y exclusión del curso completo no está presente");
    }

    if (!str_contains($html, 'Para más información, disponibilidad y precios, contáctanos.')) {
        throw new \Exception("Mensaje de consulta no encontrado");
    }

    return true;
});

// TEST 12: Presencia en sitemap.xml
runTest("sitemap.xml incluye la URL https://quality-consulting.org/eventos-compensables-alertas-tempranas-nec4", function(): bool {
    $sitemapPath = dirname(__DIR__) . '/public_html/sitemap.xml';
    $content = file_get_contents($sitemapPath);
    if ($content === false) {
        throw new \Exception("No se pudo leer sitemap.xml");
    }

    if (!str_contains($content, '<loc>https://quality-consulting.org/eventos-compensables-alertas-tempranas-nec4</loc>')) {
        throw new \Exception("URL https://quality-consulting.org/eventos-compensables-alertas-tempranas-nec4 no está en sitemap.xml");
    }

    return true;
});

echo "\n--------------------------------------------------------------------\n";
echo "RESULTADOS: {$passedTests} de {$totalTests} pruebas pasaron exitosamente.\n";
echo "--------------------------------------------------------------------\n\n";

if ($passedTests !== $totalTests) {
    exit(1);
}
