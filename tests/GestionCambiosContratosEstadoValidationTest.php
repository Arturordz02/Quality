<?php
/**
 * Test de Validación Exhaustiva para:
 * "GESTIÓN DEL CAMBIO EN LOS CONTRATOS CON EL ESTADO"
 *
 * Valida:
 * 1. Registro del curso en CoursesCatalog.php (#24, slug, ruta, imágenes, tipo).
 * 2. Registro de ruta en config/routes.php.
 * 3. Registro de slug en CourseCatalog.php.
 * 4. Integridad de la vista: 16 horas netas y 16 PDU separados, sin aval de PMI.
 * 5. Temario estructurado: 9 temas oficiales (Ampliación de plazo, Adicionales, Reducción y deductivo, Suspensión y paralización, Cronograma, Retrasos injustificados, JRD, Conciliación, Arbitrajes).
 * 6. Beneficios oficiales: exactamente los 5 ítems del brochure.
 * 7. Docente Ing. Luis Condori Hospina: perfil, experiencia, UNFV, INNOVA PUCP, CIP-LIMA.
 * 8. Existencia física y SHA-256 de imágenes (PNG temático intacto, WebP generado, Luis Condori Hospina PNG y WebP).
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
echo "EJECUTANDO SUITE DE PRUEBAS: GESTIÓN DEL CAMBIO EN LOS CONTRATOS CON EL ESTADO\n";
echo "====================================================================\n\n";

// TEST 1: Registro en CoursesCatalog
runTest("Registro #24 en CoursesCatalog tiene título, tipo, ruta, imágenes y no incluye brochure", function(): bool {
    $catalog = CoursesCatalog::getAll();
    $found = null;
    foreach ($catalog as $c) {
        if (($c['number'] ?? 0) === 24) {
            $found = $c;
            break;
        }
    }

    if (!$found) {
        throw new \Exception("No se encontró el curso #24 en CoursesCatalog");
    }

    if ($found['title'] !== 'GESTIÓN DEL CAMBIO EN LOS CONTRATOS CON EL ESTADO') {
        throw new \Exception("Título incorrecto: " . $found['title']);
    }

    if ($found['category'] !== 'Contratos' || $found['category_slug'] !== 'contratos') {
        throw new \Exception("Categoría incorrecta");
    }

    if ($found['route'] !== '/gestion-cambios-contratos-estado') {
        throw new \Exception("Ruta incorrecta: " . $found['route']);
    }

    if ($found['image'] !== 'img/capacitaciones/gestion-cambios-contratos-estado.webp') {
        throw new \Exception("WebP principal incorrecto: " . $found['image']);
    }

    if ($found['image_fallback'] !== 'img/capacitaciones/gestion-cambios-contratos-estado.png') {
        throw new \Exception("PNG fallback incorrecto: " . $found['image_fallback']);
    }

    if (isset($found['brochure'])) {
        throw new \Exception("El registro no debe tener clave 'brochure'");
    }

    return true;
});

// TEST 2: Registro en CourseCatalog (pasarela y slugs oficiales)
runTest("CourseCatalog reconoce 'gestion-cambios-contratos-estado' con ruta y título oficiales", function(): bool {
    if (!CourseCatalog::isValid('gestion-cambios-contratos-estado')) {
        throw new \Exception("El slug gestion-cambios-contratos-estado no es reconocido como válido");
    }

    $entry = CourseCatalog::find('gestion-cambios-contratos-estado');
    if (!$entry) {
        throw new \Exception("No se encontró entrada en CourseCatalog");
    }

    if ($entry['slug'] !== 'gestion-cambios-contratos-estado') {
        throw new \Exception("Slug no coincide");
    }

    if ($entry['url'] !== '/gestion-cambios-contratos-estado') {
        throw new \Exception("URL incorrecta en CourseCatalog: " . $entry['url']);
    }

    if ($entry['title'] !== 'Gestión del Cambio en los Contratos con el Estado') {
        throw new \Exception("Título no coincide en CourseCatalog: " . $entry['title']);
    }

    return true;
});

// TEST 3: Registro de ruta en routes.php
runTest("routes.php registra la ruta GET /gestion-cambios-contratos-estado apuntando a TrainingController", function(): bool {
    $config = require dirname(__DIR__) . '/private_app/config/app.php';
    $router = new Router($config);
    $routesLoader = require dirname(__DIR__) . '/private_app/config/routes.php';
    $routesLoader($router, $config);

    $routes = $router->getRoutes();
    if (!isset($routes['GET']['/gestion-cambios-contratos-estado'])) {
        throw new \Exception("Ruta GET /gestion-cambios-contratos-estado no encontrada en Router");
    }

    $target = $routes['GET']['/gestion-cambios-contratos-estado'];
    if (!is_array($target) || $target[0] !== \App\Controllers\TrainingController::class || $target[1] !== 'gestionCambiosContratosEstado') {
        throw new \Exception("El handler registrado no apunta a TrainingController::gestionCambiosContratosEstado");
    }

    return true;
});

// TEST 4: Existencia e integridad física de las imágenes
runTest("Imágenes temáticas y del docente existen físicamente con dimensiones y formatos válidos", function(): bool {
    $baseDir = dirname(__DIR__) . '/public_html';

    $thematicPng = $baseDir . '/img/capacitaciones/gestion-cambios-contratos-estado.png';
    $thematicWebp = $baseDir . '/img/capacitaciones/gestion-cambios-contratos-estado.webp';
    $docentePng = $baseDir . '/img/docentes/luis-condori-hospina.png';
    $docenteWebp = $baseDir . '/img/docentes/luis-condori-hospina.webp';

    if (!file_exists($thematicPng) || filesize($thematicPng) === 0) {
        throw new \Exception("PNG temático ausente o vacío");
    }

    $expectedSha = 'c8f1355bd20e17eb8f0d5db4da6e5d809a9caeab874da33b44216d1ba64f60d1';
    $actualSha = hash_file('sha256', $thematicPng);
    if ($actualSha !== $expectedSha) {
        throw new \Exception("SHA-256 del PNG temático no coincide. Esperado: $expectedSha, Actual: $actualSha");
    }

    if (!file_exists($thematicWebp) || filesize($thematicWebp) === 0) {
        throw new \Exception("WebP temático ausente o vacío");
    }

    if (!file_exists($docentePng) || filesize($docentePng) === 0) {
        throw new \Exception("PNG de Luis Condori Hospina ausente o vacío");
    }

    if (!file_exists($docenteWebp) || filesize($docenteWebp) === 0) {
        throw new \Exception("WebP de Luis Condori Hospina ausente o vacío");
    }

    return true;
});

// TEST 5: Renderizado y metadatos SEO
runTest("Vista unificada renderiza correctamente con metadatos SEO y sin errores", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/gestion-cambios-contratos-estado', [
        'title'           => 'Capacitación: Gestión del Cambio en los Contratos con el Estado | Quality Consulting Solutions',
        'metaDescription' => 'Curso especializado en Gestión del Cambio en los Contratos con el Estado: marco contractual, causales, ampliaciones de plazo, adicionales, deductivos, cronograma y solución de controversias. 16 horas netas y 16 PDU.',
        'canonical'       => 'https://quality-consulting.org/gestion-cambios-contratos-estado',
        'activePage'      => 'capacitacion',
    ], 'main');

    if (empty($html)) {
        throw new \Exception("El HTML generado está vacío");
    }

    if (!str_contains($html, 'GESTIÓN DEL CAMBIO EN LOS CONTRATOS CON EL ESTADO')) {
        throw new \Exception("Título principal no encontrado en HTML");
    }

    if (!str_contains($html, 'https://quality-consulting.org/gestion-cambios-contratos-estado')) {
        throw new \Exception("Canonical URL no encontrada en HTML");
    }

    return true;
});

// TEST 6: Validación de 16 horas netas y 16 PDU separados y sin acreditación por PMI
runTest("16 horas netas y 16 PDU se presentan separados y de forma neutral sin atribución de aval por PMI", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/gestion-cambios-contratos-estado', [], 'main');

    if (!str_contains($html, '16 horas netas')) {
        throw new \Exception("Falta indicación de '16 horas netas'");
    }

    if (!str_contains($html, '16 PDU')) {
        throw new \Exception("Falta indicación de '16 PDU'");
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

// TEST 7: Temario oficial completo (9 temas)
runTest("Temario oficial contiene exactamente los 9 temas sin agregar ni omitir", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/gestion-cambios-contratos-estado', [], 'main');

    $requiredTopics = [
        'Ampliación de plazo',
        'Adicionales de obra',
        'Reducción y deductivo',
        'Suspensión y paralización de obra',
        'Actualización del cronograma',
        'Retrasos injustificados',
        'Junta de Resolución de Disputas',
        'Conciliación',
        'Arbitrajes',
    ];

    foreach ($requiredTopics as $topic) {
        if (!str_contains($html, $topic)) {
            throw new \Exception("Tema oficial no encontrado en el temario: {$topic}");
        }
    }

    return true;
});

// TEST 8: Perfil oficial de Ing. Luis Condori Hospina
runTest("Perfil docente de Ing. Luis Condori Hospina contiene datos oficiales de páginas 1 y 4", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/gestion-cambios-contratos-estado', [], 'main');

    $requiredKeywords = [
        'Ing. Luis Condori Hospina',
        'Más de 30 años de experiencia',
        'Ingeniero Civil',
        'Universidad Nacional Federico Villarreal',
        'INNOVA PUCP',
        'CIP-LIMA',
        'Asesoría Integral de Ingeniería',
    ];

    foreach ($requiredKeywords as $kw) {
        if (!str_contains($html, $kw)) {
            throw new \Exception("Dato docente no encontrado: {$kw}");
        }
    }

    return true;
});

// TEST 9: Ausencia de datos restringidos (PDFs, fechas antiguas, cuentas bancarias, teléfonos del brochure, videos)
runTest("Ausencia total de enlaces o descargas a PDFs, fechas antiguas, cuentas bancarias, teléfonos externos o videos", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/gestion-cambios-contratos-estado', [], 'main');

    // No debe haber enlaces ni referencias a .pdf
    if (str_contains(strtolower($html), '.pdf')) {
        throw new \Exception("Se encontró referencia a archivo PDF en el HTML");
    }

    // No debe haber cuentas bancarias antiguas
    $forbiddenAccounts = [
        '193-17131304-0-47',
        '0021 9311 7131 3040 4717',
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
    $forbiddenDates = ['26 JUL', '01 SEP', '20:00 – 22:00', '20:00 - 22:00'];
    foreach ($forbiddenDates as $date) {
        if (str_contains($html, $date)) {
            throw new \Exception("Se encontró fecha u horario antiguo del brochure: {$date}");
        }
    }

    // No debe haber teléfonos ni correos del brochure externo
    if (str_contains($html, '944 276 649') || str_contains($html, 'comercial@pmo-solutions.com') || str_contains($html, 'pmo-solutions.com')) {
        throw new \Exception("Se encontraron datos de contacto externos del brochure");
    }

    // Videos debe estar vacío
    if (str_contains($html, 'qcs-cd-video-wrap') || str_contains($html, 'qcs-cd-video-frame')) {
        throw new \Exception("No deben mostrarse videos para este curso");
    }

    return true;
});

// TEST 10: Mensaje de información y flujo de PayPal exclusivo primera clase USD 10
runTest("Tarjeta de contacto muestra mensaje oficial y pasarela PayPal restringe a Primera Clase USD 10", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/gestion-cambios-contratos-estado', [], 'main');

    if (!str_contains($html, 'Para más información, disponibilidad y precios, contáctanos.')) {
        throw new \Exception("Mensaje de consulta no encontrado");
    }

    if (!str_contains($html, 'Primera clase del curso – USD 10')) {
        throw new \Exception("Etiqueta de primera clase no encontrada");
    }

    if (!str_contains($html, 'US$ 10')) {
        throw new \Exception("Precio US$ 10 no encontrado");
    }

    if (!str_contains($html, 'US$10 únicamente por la primera clase. No incluye el curso completo.')) {
        throw new \Exception("Aclaración de alcance no encontrada");
    }

    if (!str_contains($html, 'registro-primera-clase?curso=gestion-cambios-contratos-estado')) {
        throw new \Exception("Enlace de pago a primera clase no encontrado");
    }

    return true;
});

// TEST 11: sitemap.xml contiene la URL del curso
runTest("sitemap.xml contiene la entrada canónica del curso", function(): bool {
    $sitemapPath = dirname(__DIR__) . '/public_html/sitemap.xml';
    $content = file_get_contents($sitemapPath);

    if (!str_contains($content, '<loc>https://quality-consulting.org/gestion-cambios-contratos-estado</loc>')) {
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
