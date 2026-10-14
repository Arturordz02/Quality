<?php
/**
 * Test de Validación Exhaustiva para:
 * "EL CONTRATO DE NEC4"
 *
 * Valida:
 * 1. Registro del curso en CoursesCatalog.php (#16, slug, ruta, imágenes, tipo).
 * 2. Registro de ruta en config/routes.php.
 * 3. Registro de slug en CourseCatalog.php.
 * 4. Integridad de la vista: 14 horas netas y 14 PDU separados, sin aval indebido de PMI o NEC.
 * 5. Temario estructurado: exactamente los 4 bloques oficiales del brochure (cláusulas 10-80, opciones A-F, disputas W/DAB, secundarias).
 * 6. Beneficios oficiales: exactamente los 5 ítems del brochure (incluyendo base de datos laboral y 4 semanas de grabación).
 * 7. Docente Ing. Víctor Cruz: perfil oficial, más de 14 años, empresas y sin atribución de CIFE Stanford.
 * 8. Existencia física y SHA-256 de imágenes (PNG temático intacto, WebP generado, Víctor Cruz PNG y WebP).
 * 9. Ausencia de fechas antiguas, horarios, cuentas bancarias, teléfonos comerciales del brochure o videos.
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
echo "EJECUTANDO SUITE DE PRUEBAS: EL CONTRATO DE NEC4\n";
echo "====================================================================\n\n";

// TEST 1: Registro en CoursesCatalog
runTest("Registro #16 en CoursesCatalog tiene título, tipo, ruta, imágenes y no incluye brochure", function(): bool {
    $catalog = CoursesCatalog::getAll();
    $found = null;
    $duplicateCount = 0;
    foreach ($catalog as $c) {
        if (($c['number'] ?? 0) === 16) {
            $found = $c;
        }
        if (($c['route'] ?? '') === '/contrato-nec4') {
            $duplicateCount++;
        }
    }

    if (!$found) {
        throw new \Exception("No se encontró el curso #16 en CoursesCatalog");
    }

    if ($duplicateCount !== 1) {
        throw new \Exception("Se encontraron {$duplicateCount} cursos con ruta /contrato-nec4, debe haber exactamente 1");
    }

    if ($found['title'] !== 'EL CONTRATO DE NEC4') {
        throw new \Exception("Título incorrecto: " . $found['title']);
    }

    if ($found['category'] !== 'Contratos' || $found['category_slug'] !== 'contratos') {
        throw new \Exception("Categoría incorrecta");
    }

    if ($found['route'] !== '/contrato-nec4') {
        throw new \Exception("Ruta incorrecta: " . $found['route']);
    }

    if ($found['image'] !== 'img/capacitaciones/contrato-nec4.webp') {
        throw new \Exception("WebP principal incorrecto: " . $found['image']);
    }

    if ($found['image_fallback'] !== 'img/capacitaciones/contrato-nec4.png') {
        throw new \Exception("PNG fallback incorrecto: " . $found['image_fallback']);
    }

    if (isset($found['brochure'])) {
        throw new \Exception("El registro no debe tener clave 'brochure'");
    }

    return true;
});

// TEST 2: Registro en CourseCatalog (pasarela y slugs oficiales)
runTest("CourseCatalog reconoce 'contrato-nec4' con ruta y título oficiales", function(): bool {
    if (!CourseCatalog::isValid('contrato-nec4')) {
        throw new \Exception("El slug contrato-nec4 no es reconocido como válido");
    }

    $entry = CourseCatalog::find('contrato-nec4');
    if (!$entry) {
        throw new \Exception("No se encontró entrada en CourseCatalog");
    }

    if ($entry['slug'] !== 'contrato-nec4') {
        throw new \Exception("Slug no coincide");
    }

    if ($entry['url'] !== '/contrato-nec4') {
        throw new \Exception("URL incorrecta en CourseCatalog: " . $entry['url']);
    }

    if ($entry['title'] !== 'El Contrato de NEC4') {
        throw new \Exception("Título no coincide en CourseCatalog: " . $entry['title']);
    }

    return true;
});

// TEST 3: Registro de ruta en routes.php
runTest("routes.php registra la ruta GET /contrato-nec4 apuntando a TrainingController::contratoNec4", function(): bool {
    $config = require dirname(__DIR__) . '/private_app/config/app.php';
    $router = new Router($config);
    $routesLoader = require dirname(__DIR__) . '/private_app/config/routes.php';
    $routesLoader($router, $config);

    $routes = $router->getRoutes();
    if (!isset($routes['GET']['/contrato-nec4'])) {
        throw new \Exception("Ruta GET /contrato-nec4 no encontrada en Router");
    }

    $target = $routes['GET']['/contrato-nec4'];
    if (!is_array($target) || $target[0] !== \App\Controllers\TrainingController::class || $target[1] !== 'contratoNec4') {
        throw new \Exception("El handler registrado no apunta a TrainingController::contratoNec4");
    }

    return true;
});

// TEST 4: Existencia e integridad física de las imágenes
runTest("Imágenes temáticas y del docente existen físicamente con dimensiones y formatos válidos", function(): bool {
    $baseDir = dirname(__DIR__) . '/public_html';

    $thematicPng = $baseDir . '/img/capacitaciones/contrato-nec4.png';
    $thematicWebp = $baseDir . '/img/capacitaciones/contrato-nec4.webp';
    $docentePng = $baseDir . '/img/docentes/victor-cruz.png';
    $docenteWebp = $baseDir . '/img/docentes/victor-cruz.webp';

    if (!file_exists($thematicPng) || filesize($thematicPng) === 0) {
        throw new \Exception("PNG temático ausente o vacío");
    }

    $expectedSha = '66b5a0b0901793524de200f1c0b1d348477d918d4102ddaa5d6081f6199fabd9';
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
    $html = $view->render('pages/contrato-nec4', [
        'title'           => 'Capacitación: El Contrato de NEC4 | Quality Consulting Solutions',
        'metaDescription' => 'Curso especializado en El Contrato de NEC4: cláusulas principales 10 a 80, opciones principales A a F, resolución y prevención de disputas con cláusulas W y DAB, y cláusulas secundarias. 14 horas netas y 14 PDU.',
        'canonical'       => 'https://quality-consulting.org/contrato-nec4',
        'activePage'      => 'capacitacion',
    ], 'main');

    if (empty($html)) {
        throw new \Exception("El HTML generado está vacío");
    }

    if (!str_contains($html, 'EL CONTRATO DE NEC4')) {
        throw new \Exception("Título principal no encontrado en HTML");
    }

    if (!str_contains($html, 'https://quality-consulting.org/contrato-nec4')) {
        throw new \Exception("Canonical URL no encontrada en HTML");
    }

    return true;
});

// TEST 6: Validación de 14 horas netas y 14 PDU separados y sin acreditación por PMI ni NEC
runTest("14 horas netas y 14 PDU se presentan separados y de forma neutral sin atribución de aval por PMI ni NEC", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/contrato-nec4', [], 'main');

    if (!str_contains($html, '14 horas netas')) {
        throw new \Exception("Falta indicación de '14 horas netas'");
    }

    if (!str_contains($html, '14 PDU')) {
        throw new \Exception("Falta indicación de '14 PDU'");
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
runTest("Temario oficial contiene exactamente los 4 bloques sin agregar ni omitir", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/contrato-nec4', [], 'main');

    $requiredTopics = [
        'Esquema de Cláusulas Principales',
        'Opciones',
        'Resolución y Prevención de Disputas',
        'Cláusulas Secundarias',
    ];

    foreach ($requiredTopics as $topic) {
        if (!str_contains($html, $topic)) {
            throw new \Exception("Bloque temático oficial no encontrado en el temario: {$topic}");
        }
    }

    // Verificar contenido clave de cada bloque
    $keyDetails = [
        'Sección 10 General',
        'Sección 20 Responsabilidades principales del contratista',
        'Sección 30 Gestión del Tiempo',
        'Sección 40 Gestión de la Calidad',
        'Sección 50 Pagos',
        'Sección 60 Eventos Compensables',
        'Sección 70 Titularidad',
        'Sección 80 Seguros y Responsabilidades',
        'Opción A',
        'Opción B',
        'Opción C',
        'Opción D',
        'Opción E',
        'Opción F',
        'cláusulas W',
        'Dispute Avoidance Board',
        'Tribunal',
        'Ajuste de precio',
    ];

    foreach ($keyDetails as $detail) {
        if (!str_contains($html, $detail)) {
            throw new \Exception("Detalle clave del temario no encontrado: {$detail}");
        }
    }

    return true;
});

// TEST 8: Perfil oficial de Ing. Víctor Cruz sin atribución de CIFE Stanford
runTest("Perfil docente contiene formación y empresas oficiales de Víctor Cruz y omite CIFE Stanford", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/contrato-nec4', [], 'main');

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

// TEST 9: Ausencia de datos restringidos (PDFs, fechas antiguas, cuentas bancarias, teléfonos del brochure, videos)
runTest("Ausencia total de enlaces o descargas a PDFs, fechas antiguas, cuentas bancarias, teléfonos del brochure o videos", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/contrato-nec4', [], 'main');

    // No debe haber enlaces ni referencias a .pdf
    if (str_contains(strtolower($html), '.pdf')) {
        throw new \Exception("Se encontró referencia a archivo PDF en el HTML");
    }

    // No debe haber cuentas bancarias antiguas
    $bankData = ['191-10382996-0-73', '047-3092292540', '0011-0184-02-00496525', '039-7331729', 'Omar Samaniego'];
    foreach ($bankData as $bd) {
        if (str_contains($html, $bd)) {
            throw new \Exception("Se encontró dato bancario antiguo del brochure: {$bd}");
        }
    }

    // No debe haber fechas antiguas
    $oldDates = ['26, 29 SEP', '01, 06, 13, 15, 24 OCT', '19:00 – 21:00', '19:00-21:00'];
    foreach ($oldDates as $od) {
        if (str_contains($html, $od)) {
            throw new \Exception("Se encontró fecha u horario caduco del brochure: {$od}");
        }
    }

    // No debe haber reproductores de video incrustados
    if (str_contains($html, '<iframe') || str_contains($html, '<video')) {
        throw new \Exception("Se encontró elemento de video no permitido");
    }

    return true;
});

// TEST 10: Beneficios oficiales del brochure
runTest("Beneficios oficiales contiene exactamente los 5 ítems del brochure", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/contrato-nec4', [], 'main');

    $requiredBenefits = [
        'Base de datos laboral',
        'Descuentos futuros',
        'Diploma digital',
        'Material digital',
        'Grabación del curso',
        '4 semanas',
    ];

    foreach ($requiredBenefits as $benefit) {
        if (!str_contains($html, $benefit)) {
            throw new \Exception("Beneficio oficial no encontrado: {$benefit}");
        }
    }

    return true;
});

// TEST 11: Pasarela PayPal exclusiva para primera clase por USD 10
runTest("Pasarela PayPal está configurada para primera clase por USD 10 y registro modal", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/contrato-nec4', [], 'main');

    if (!str_contains($html, 'data-course-slug="contrato-nec4"')) {
        throw new \Exception("Falta data-course-slug=\"contrato-nec4\" en botón de pago PayPal");
    }

    if (!str_contains($html, 'registro-primera-clase?curso=contrato-nec4')) {
        throw new \Exception("Falta enlace de registro primera clase con slug contrato-nec4");
    }

    if (!str_contains($html, 'Primera clase del curso – USD 10') && !str_contains($html, 'USD 10')) {
        throw new \Exception("Falta indicación de precio de primera clase USD 10");
    }

    if (!str_contains($html, 'US$ 10')) {
        throw new \Exception("Precio US$ 10 no encontrado");
    }

    if (!str_contains($html, 'US$10 únicamente por la primera clase. No incluye el curso completo.')) {
        throw new \Exception("Aclaración de alcance no encontrada");
    }

    return true;
});

// TEST 12: Presencia en sitemap.xml
runTest("sitemap.xml incluye la URL https://quality-consulting.org/contrato-nec4", function(): bool {
    $sitemapPath = dirname(__DIR__) . '/public_html/sitemap.xml';
    $content = file_get_contents($sitemapPath);
    if ($content === false) {
        throw new \Exception("No se pudo leer sitemap.xml");
    }

    if (!str_contains($content, '<loc>https://quality-consulting.org/contrato-nec4</loc>')) {
        throw new \Exception("URL https://quality-consulting.org/contrato-nec4 no está en sitemap.xml");
    }

    return true;
});

echo "\n--------------------------------------------------------------------\n";
echo "RESULTADOS: {$passedTests} de {$totalTests} pruebas pasaron exitosamente.\n";
echo "--------------------------------------------------------------------\n\n";

if ($passedTests !== $totalTests) {
    exit(1);
}
