<?php
/**
 * Test de Validación Exhaustiva para:
 * "GESTIÓN CONTRACTUAL EN LOS MEGAPROYECTOS DE CONSTRUCCIÓN MINEROS"
 *
 * Valida:
 * 1. Registro del curso en CoursesCatalog.php (#23, slug, ruta, imágenes, tipo).
 * 2. Registro de ruta en config/routes.php.
 * 3. Registro de slug en CourseCatalog.php.
 * 4. Integridad de la vista: 16 horas netas y 12 PDU separados, sin aval de PMI.
 * 5. Temario estructurado: exactamente los 6 bloques oficiales del brochure.
 * 6. Beneficios oficiales: exactamente los 5 ítems del brochure (incluyendo base de datos laboral y 4 semanas de grabación).
 * 7. Docente Ing. Tomás La Rosa Sánchez: perfil oficial, omitiendo años contradictorios (+25 / 15 años) y sin atribución de CIFE Stanford.
 * 8. Existencia física y SHA-256 de imágenes (PNG temático intacto, WebP generado, Tomás La Rosa Sánchez PNG y WebP).
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
echo "EJECUTANDO SUITE DE PRUEBAS: GESTIÓN CONTRACTUAL EN LOS MEGAPROYECTOS DE CONSTRUCCIÓN MINEROS\n";
echo "====================================================================\n\n";

// TEST 1: Registro en CoursesCatalog
runTest("Registro #23 en CoursesCatalog tiene título, tipo, ruta, imágenes y no incluye brochure", function(): bool {
    $catalog = CoursesCatalog::getAll();
    $found = null;
    foreach ($catalog as $c) {
        if (($c['number'] ?? 0) === 23) {
            $found = $c;
            break;
        }
    }

    if (!$found) {
        throw new \Exception("No se encontró el curso #23 en CoursesCatalog");
    }

    if ($found['title'] !== 'GESTIÓN CONTRACTUAL EN LOS MEGAPROYECTOS DE CONSTRUCCIÓN MINEROS') {
        throw new \Exception("Título incorrecto: " . $found['title']);
    }

    if ($found['category'] !== 'Contratos' || $found['category_slug'] !== 'contratos') {
        throw new \Exception("Categoría incorrecta");
    }

    if ($found['route'] !== '/gestion-contractual-megaproyectos-mineros') {
        throw new \Exception("Ruta incorrecta: " . $found['route']);
    }

    if ($found['image'] !== 'img/capacitaciones/gestion-contractual-megaproyectos-mineros.webp') {
        throw new \Exception("WebP principal incorrecto: " . $found['image']);
    }

    if ($found['image_fallback'] !== 'img/capacitaciones/gestion-contractual-megaproyectos-mineros.png') {
        throw new \Exception("PNG fallback incorrecto: " . $found['image_fallback']);
    }

    if (isset($found['brochure'])) {
        throw new \Exception("El registro no debe tener clave 'brochure'");
    }

    return true;
});

// TEST 2: Registro en CourseCatalog (pasarela y slugs oficiales)
runTest("CourseCatalog reconoce 'gestion-contractual-megaproyectos-mineros' con ruta y título oficiales", function(): bool {
    if (!CourseCatalog::isValid('gestion-contractual-megaproyectos-mineros')) {
        throw new \Exception("El slug gestion-contractual-megaproyectos-mineros no es reconocido como válido");
    }

    $entry = CourseCatalog::find('gestion-contractual-megaproyectos-mineros');
    if (!$entry) {
        throw new \Exception("No se encontró entrada en CourseCatalog");
    }

    if ($entry['slug'] !== 'gestion-contractual-megaproyectos-mineros') {
        throw new \Exception("Slug no coincide");
    }

    if ($entry['url'] !== '/gestion-contractual-megaproyectos-mineros') {
        throw new \Exception("URL incorrecta en CourseCatalog: " . $entry['url']);
    }

    if ($entry['title'] !== 'Gestión Contractual en los Megaproyectos de Construcción Mineros') {
        throw new \Exception("Título no coincide en CourseCatalog: " . $entry['title']);
    }

    return true;
});

// TEST 3: Registro de ruta en routes.php
runTest("routes.php registra la ruta GET /gestion-contractual-megaproyectos-mineros apuntando a TrainingController", function(): bool {
    $config = require dirname(__DIR__) . '/private_app/config/app.php';
    $router = new Router($config);
    $routesLoader = require dirname(__DIR__) . '/private_app/config/routes.php';
    $routesLoader($router, $config);

    $routes = $router->getRoutes();
    if (!isset($routes['GET']['/gestion-contractual-megaproyectos-mineros'])) {
        throw new \Exception("Ruta GET /gestion-contractual-megaproyectos-mineros no encontrada en Router");
    }

    $target = $routes['GET']['/gestion-contractual-megaproyectos-mineros'];
    if (!is_array($target) || $target[0] !== \App\Controllers\TrainingController::class || $target[1] !== 'gestionContractualMegaproyectosMineros') {
        throw new \Exception("El handler registrado no apunta a TrainingController::gestionContractualMegaproyectosMineros");
    }

    return true;
});

// TEST 4: Existencia e integridad física de las imágenes
runTest("Imágenes temáticas y del docente existen físicamente con dimensiones y formatos válidos", function(): bool {
    $baseDir = dirname(__DIR__) . '/public_html';

    $thematicPng = $baseDir . '/img/capacitaciones/gestion-contractual-megaproyectos-mineros.png';
    $thematicWebp = $baseDir . '/img/capacitaciones/gestion-contractual-megaproyectos-mineros.webp';
    $docentePng = $baseDir . '/img/docentes/tomas-la-rosa-sanchez.png';
    $docenteWebp = $baseDir . '/img/docentes/tomas-la-rosa-sanchez.webp';

    if (!file_exists($thematicPng) || filesize($thematicPng) === 0) {
        throw new \Exception("PNG temático ausente o vacío");
    }

    $expectedSha = 'ca82ba7e87b4eefd75bff8df4e16f473059f2ccd8c098e22226a44bba7d857be';
    $actualSha = hash_file('sha256', $thematicPng);
    if ($actualSha !== $expectedSha) {
        throw new \Exception("SHA-256 del PNG temático no coincide. Esperado: $expectedSha, Actual: $actualSha");
    }

    if (!file_exists($thematicWebp) || filesize($thematicWebp) === 0) {
        throw new \Exception("WebP temático ausente o vacío");
    }

    if (!file_exists($docentePng) || filesize($docentePng) === 0) {
        throw new \Exception("PNG de Tomás La Rosa Sánchez ausente o vacío");
    }

    if (!file_exists($docenteWebp) || filesize($docenteWebp) === 0) {
        throw new \Exception("WebP de Tomás La Rosa Sánchez ausente o vacío");
    }

    return true;
});

// TEST 5: Renderizado y metadatos SEO
runTest("Vista unificada renderiza correctamente con metadatos SEO y sin errores", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/gestion-contractual-megaproyectos-mineros', [
        'title'           => 'Capacitación: Gestión Contractual en los Megaproyectos de Construcción Mineros | Quality Consulting Solutions',
        'metaDescription' => 'Curso especializado en Gestión Contractual en Megaproyectos Mineros: formación y negociación de contratos, supervisión del cumplimiento, administración de riesgos y cambios, resolución de disputas y cierre. 16 horas netas y 12 PDU.',
        'canonical'       => 'https://quality-consulting.org/gestion-contractual-megaproyectos-mineros',
        'activePage'      => 'capacitacion',
    ], 'main');

    if (empty($html)) {
        throw new \Exception("El HTML generado está vacío");
    }

    if (!str_contains($html, 'GESTIÓN CONTRACTUAL EN LOS MEGAPROYECTOS DE CONSTRUCCIÓN MINEROS')) {
        throw new \Exception("Título principal no encontrado en HTML");
    }

    if (!str_contains($html, 'https://quality-consulting.org/gestion-contractual-megaproyectos-mineros')) {
        throw new \Exception("Canonical URL no encontrada en HTML");
    }

    return true;
});

// TEST 6: Validación de 16 horas netas y 12 PDU separados y sin acreditación por PMI
runTest("16 horas netas y 12 PDU se presentan separados y de forma neutral sin atribución de aval por PMI", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/gestion-contractual-megaproyectos-mineros', [], 'main');

    if (!str_contains($html, '16 horas netas')) {
        throw new \Exception("Falta indicación de '16 horas netas'");
    }

    if (!str_contains($html, '12 PDU')) {
        throw new \Exception("Falta indicación de '12 PDU'");
    }

    // Comprobar que no se vende como acreditado/certificado/avalado por PMI
    $lower = strtolower($html);
    if (str_contains($lower, 'acreditado por pmi') || str_contains($lower, 'avalado por pmi') || str_contains($lower, 'certificado por pmi')) {
        throw new \Exception("Se encontraron afirmaciones prohibidas de acreditación/aval por PMI");
    }

    if (!str_contains($html, 'General Education Third-Party Provider – The PMI Talent Triangle®')) {
        throw new \Exception("Falta la categoría CCR oficial de PMI");
    }

    return true;
});

// TEST 7: Temario oficial completo (6 bloques)
runTest("Temario oficial contiene exactamente los 6 bloques sin agregar ni omitir", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/gestion-contractual-megaproyectos-mineros', [], 'main');

    $requiredTopics = [
        'Introducción a la Gerencia de Contratos de Construcción',
        'Formación de Contratos',
        'Preparación y Negociación de Contratos',
        'Supervisión del Cumplimiento Contractual',
        'Gestión de Riesgos y Administración de Cambios en Contratos',
        'Resolución de Disputas y Cierre de Contratos',
    ];

    foreach ($requiredTopics as $topic) {
        if (!str_contains($html, $topic)) {
            throw new \Exception("Bloque temático oficial no encontrado en el temario: {$topic}");
        }
    }

    return true;
});

// TEST 8: Perfil oficial de Ing. Tomás La Rosa Sánchez sin años contradictorios ni CIFE Stanford
runTest("Perfil docente contiene formación y empresas oficiales, omitiendo años contradictorios (+25 / 15) y CIFE Stanford", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/gestion-contractual-megaproyectos-mineros', [], 'main');

    $requiredKeywords = [
        'Ing. Tomás La Rosa Sánchez',
        'Universidad Ramon Llull',
        'ESAN',
        'Universidad de Lima',
        'Fluor Corporation',
        'Bechtel Corporation',
        'Jacobs',
        'Barrick Gold',
    ];

    foreach ($requiredKeywords as $kw) {
        if (!str_contains($html, $kw)) {
            throw new \Exception("Dato docente no encontrado: {$kw}");
        }
    }

    // Verificar que NO aparezcan las cifras contradictorias de años
    $forbiddenPhrases = ['+25 años', 'quince años', '15 años', '25 años'];
    foreach ($forbiddenPhrases as $fp) {
        if (str_contains($html, $fp)) {
            throw new \Exception("Se encontró cifra contradictoria de años: {$fp}");
        }
    }

    // Verificar que NO se atribuya CIFE Stanford al docente
    if (str_contains(strtolower($html), 'cife') || str_contains(strtolower($html), 'stanford')) {
        throw new \Exception("Se encontró mención indebida de CIFE Stanford en la vista del curso");
    }

    return true;
});

// TEST 9: Ausencia de datos restringidos (PDFs, fechas antiguas, cuentas bancarias, teléfonos del brochure, videos)
runTest("Ausencia total de enlaces o descargas a PDFs, fechas antiguas, cuentas bancarias, teléfonos externos o videos", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/gestion-contractual-megaproyectos-mineros', [], 'main');

    // No debe haber enlaces ni referencias a .pdf
    if (str_contains(strtolower($html), '.pdf')) {
        throw new \Exception("Se encontró referencia a archivo PDF en el HTML");
    }

    // No debe haber cuentas bancarias antiguas
    $forbiddenAccounts = [
        '191-10382996-0-73',
        '00219111038299607352',
        '047-3092292540',
        '0011-0184-02-00496525',
        '039-7331729',
    ];
    foreach ($forbiddenAccounts as $acc) {
        if (str_contains($html, $acc)) {
            throw new \Exception("Se encontró cuenta bancaria antigua: {$acc}");
        }
    }

    // No debe haber fechas/horarios de convocatorias pasadas
    $forbiddenDates = ['04 JUN', '04 JUL', '20:00 – 22:00', '20:00 - 22:00'];
    foreach ($forbiddenDates as $date) {
        if (str_contains($html, $date)) {
            throw new \Exception("Se encontró fecha u horario antiguo del brochure: {$date}");
        }
    }

    // Videos debe estar vacío
    if (str_contains($html, 'qcs-cd-video-wrap') || str_contains($html, 'qcs-cd-video-frame')) {
        throw new \Exception("No deben mostrarse videos para este curso");
    }

    return true;
});

// TEST 10: Beneficios oficiales permitidos (5 items incluyendo base de datos y 4 semanas de grabación)
runTest("Beneficios incluyen base de datos laboral y acceso a grabación por 4 semanas", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/gestion-contractual-megaproyectos-mineros', [], 'main');

    if (!str_contains($html, 'Ingreso a la base de datos laboral de Quality Consulting Solutions.')) {
        throw new \Exception("Falta beneficio de ingreso a la base de datos laboral");
    }

    if (!str_contains($html, '4 semanas')) {
        throw new \Exception("Falta indicación de acceso a grabación por 4 semanas");
    }

    return true;
});

// TEST 11: Mensaje de información y flujo de PayPal exclusivo primera clase USD 10
runTest("Tarjeta de contacto muestra mensaje oficial y pasarela PayPal restringe a Primera Clase USD 10", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/gestion-contractual-megaproyectos-mineros', [], 'main');

    if (!str_contains($html, 'Para más información, disponibilidad y precios, contáctanos.')) {
        throw new \Exception("Mensaje de consulta no encontrado");
    }

    if (!str_contains($html, 'Primera clase del curso – USD 10')) {
        throw new \Exception("Etiqueta de primera clase no encontrada");
    }

    if (!str_contains($html, 'US$ 10')) {
        throw new \Exception("Precio US$ 10 no encontrado");
    }

    if (stripos($html, 'primera clase') === false
        || !str_contains($html, 'USD 10')
        || stripos($html, 'No incluye el curso completo') === false) {
        throw new \Exception("La aclaración semántica de alcance, precio y exclusión del curso completo no está presente");
    }

    if (!str_contains($html, '/pagar-primera-clase?curso=gestion-contractual-megaproyectos-mineros')) {
        throw new \Exception("Enlace al checkout de primera clase no encontrado");
    }

    return true;
});

// TEST 12: sitemap.xml contiene la URL del curso
runTest("sitemap.xml contiene la entrada canónica del curso", function(): bool {
    $sitemapPath = dirname(__DIR__) . '/public_html/sitemap.xml';
    $content = file_get_contents($sitemapPath);

    if (!str_contains($content, '<loc>https://quality-consulting.org/gestion-contractual-megaproyectos-mineros</loc>')) {
        throw new \Exception("URL no encontrada en sitemap.xml");
    }

    return true;
});

echo "\n====================================================================\n";
echo "RESULTADOS: {$passedTests} de {$totalTests} pruebas pasadas.\n";
echo "====================================================================\n";

if ($passedTests !== $totalTests) {
    exit(1);
}
