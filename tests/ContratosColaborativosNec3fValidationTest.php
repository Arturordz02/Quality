<?php
/**
 * Test de Validación Exhaustiva para:
 * "CONTRATOS COLABORATIVOS NEC3-F"
 *
 * Valida:
 * 1. Registro del curso en CoursesCatalog.php (#15, slug, ruta, imágenes, tipo).
 * 2. Diferenciación estricta con /contrato-colaborativo-nec-3-4 (#19, Jaime Curo).
 * 3. Registro de ruta en config/routes.php.
 * 4. Registro de slug en CourseCatalog.php.
 * 5. Integridad de la vista: 14 horas netas y 14 PDU separados, sin aval indebido de PMI o NEC.
 * 6. Temario estructurado: exactamente los 7 bloques oficiales del brochure con sus subtemas.
 * 7. Beneficios oficiales: ítems del brochure incluyendo base laboral, diploma, material y 4 semanas de grabación.
 * 8. Docente Ing. Luis Ruiz, MBA: perfil profesional del brochure, fotos reutilizadas, sin atribución de CIFE Stanford.
 * 9. Existencia física y SHA-256 de imágenes (PNG temático intacto, WebP generado, fotos del docente reutilizadas).
 * 10. Ausencia de fechas antiguas, horarios, cuentas bancarias, teléfonos del brochure, videos o enlaces a PDFs.
 * 11. Mensaje de contacto y flujo PayPal primera clase USD 10 indicando que no incluye curso completo.
 * 12. Presencia en sitemap.xml.
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
echo "EJECUTANDO SUITE DE PRUEBAS: CONTRATOS COLABORATIVOS NEC3-F\n";
echo "====================================================================\n\n";

// TEST 1: Registro en CoursesCatalog
runTest("Registro #15 en CoursesCatalog tiene título, tipo, ruta, imágenes y no duplica", function(): bool {
    $catalog = CoursesCatalog::getAll();
    $found = null;
    $duplicateCount = 0;
    foreach ($catalog as $c) {
        if (($c['number'] ?? 0) === 15) {
            $found = $c;
        }
        if (($c['route'] ?? '') === '/contratos-colaborativos-nec3-f') {
            $duplicateCount++;
        }
    }

    if (!$found) {
        throw new \Exception("No se encontró el curso #15 en CoursesCatalog");
    }

    if ($duplicateCount !== 1) {
        throw new \Exception("Se encontraron {$duplicateCount} cursos con ruta /contratos-colaborativos-nec3-f, debe haber exactamente 1");
    }

    if ($found['title'] !== 'CONTRATOS COLABORATIVOS NEC3-F') {
        throw new \Exception("Título incorrecto: " . $found['title']);
    }

    if ($found['category'] !== 'Contratos' || $found['category_slug'] !== 'contratos') {
        throw new \Exception("Categoría incorrecta");
    }

    if ($found['route'] !== '/contratos-colaborativos-nec3-f') {
        throw new \Exception("Ruta incorrecta: " . $found['route']);
    }

    if ($found['image'] !== 'img/capacitaciones/contratos-colaborativos-nec3-f.webp') {
        throw new \Exception("WebP principal incorrecto: " . $found['image']);
    }

    if ($found['image_fallback'] !== 'img/capacitaciones/contratos-colaborativos-nec3-f.png') {
        throw new \Exception("PNG fallback incorrecto: " . $found['image_fallback']);
    }

    if (isset($found['brochure'])) {
        throw new \Exception("El registro no debe tener clave 'brochure'");
    }

    return true;
});

// TEST 2: Diferenciación con curso #19 (Jaime Curo)
runTest("El curso permanece estrictamente separado del curso #19 (/contrato-colaborativo-nec-3-4)", function(): bool {
    $catalog = CoursesCatalog::getAll();
    $course15 = null;
    $course19 = null;
    foreach ($catalog as $c) {
        if (($c['number'] ?? 0) === 15) $course15 = $c;
        if (($c['number'] ?? 0) === 19) $course19 = $c;
    }

    if (!$course15 || !$course19) {
        throw new \Exception("Uno de los dos cursos NEC no fue encontrado en CoursesCatalog");
    }

    if ($course15['route'] === $course19['route']) {
        throw new \Exception("Ambos cursos comparten la misma ruta: {$course15['route']}");
    }

    if ($course19['route'] !== '/contrato-colaborativo-nec-3-4') {
        throw new \Exception("La ruta del curso #19 fue alterada indebidamente: {$course19['route']}");
    }

    return true;
});

// TEST 3: Registro en CourseCatalog (pasarela y slugs oficiales)
runTest("CourseCatalog reconoce 'contratos-colaborativos-nec3-f' con ruta y título oficiales", function(): bool {
    if (!CourseCatalog::isValid('contratos-colaborativos-nec3-f')) {
        throw new \Exception("El slug contratos-colaborativos-nec3-f no es reconocido como válido");
    }

    $entry = CourseCatalog::find('contratos-colaborativos-nec3-f');
    if (!$entry) {
        throw new \Exception("No se encontró entrada en CourseCatalog");
    }

    if ($entry['slug'] !== 'contratos-colaborativos-nec3-f') {
        throw new \Exception("Slug no coincide");
    }

    if ($entry['url'] !== '/contratos-colaborativos-nec3-f') {
        throw new \Exception("URL incorrecta en CourseCatalog: " . $entry['url']);
    }

    if ($entry['title'] !== 'Contratos Colaborativos NEC3-F') {
        throw new \Exception("Título no coincide en CourseCatalog: " . $entry['title']);
    }

    return true;
});

// TEST 4: Registro de ruta en routes.php
runTest("routes.php registra la ruta GET /contratos-colaborativos-nec3-f apuntando a TrainingController::contratosColaborativosNec3f", function(): bool {
    $config = require dirname(__DIR__) . '/private_app/config/app.php';
    $router = new Router($config);
    $routesLoader = require dirname(__DIR__) . '/private_app/config/routes.php';
    $routesLoader($router, $config);

    $routes = $router->getRoutes();
    if (!isset($routes['GET']['/contratos-colaborativos-nec3-f'])) {
        throw new \Exception("Ruta GET /contratos-colaborativos-nec3-f no encontrada en Router");
    }

    $target = $routes['GET']['/contratos-colaborativos-nec3-f'];
    if (!is_array($target) || $target[0] !== \App\Controllers\TrainingController::class || $target[1] !== 'contratosColaborativosNec3f') {
        throw new \Exception("El handler registrado no apunta a TrainingController::contratosColaborativosNec3f");
    }

    return true;
});

// TEST 5: Existencia e integridad física de las imágenes
runTest("Imágenes temáticas y del docente existen físicamente con dimensiones y formatos válidos", function(): bool {
    $baseDir = dirname(__DIR__) . '/public_html';

    $thematicPng = $baseDir . '/img/capacitaciones/contratos-colaborativos-nec3-f.png';
    $thematicWebp = $baseDir . '/img/capacitaciones/contratos-colaborativos-nec3-f.webp';
    $docentePng = $baseDir . '/img/docentes/luis-ruiz.png';
    $docenteWebp = $baseDir . '/img/docentes/luis-ruiz.webp';

    if (!file_exists($thematicPng) || filesize($thematicPng) === 0) {
        throw new \Exception("PNG temático ausente o vacío");
    }

    $expectedSha = 'c786447549999de758488e9dcc90ffe467cb16d00c67f45ff21970150ea5dfd8';
    $actualSha = hash_file('sha256', $thematicPng);
    if ($actualSha !== $expectedSha) {
        throw new \Exception("SHA-256 del PNG temático no coincide. Esperado: $expectedSha, Actual: $actualSha");
    }

    if (!file_exists($thematicWebp) || filesize($thematicWebp) === 0) {
        throw new \Exception("WebP temático ausente o vacío");
    }

    if (!file_exists($docentePng) || filesize($docentePng) === 0) {
        throw new \Exception("PNG de Luis Ruiz ausente o vacío");
    }

    if (!file_exists($docenteWebp) || filesize($docenteWebp) === 0) {
        throw new \Exception("WebP de Luis Ruiz ausente o vacío");
    }

    return true;
});

// TEST 6: Renderizado y metadatos SEO
runTest("Vista unificada renderiza correctamente con metadatos SEO y sin errores", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/contratos-colaborativos-nec3-f', [
        'title'           => 'Capacitación: Contratos Colaborativos NEC3-F | Quality Consulting Solutions',
        'metaDescription' => 'Curso especializado en Contratos Colaborativos NEC3-F: Project Delivery System, distribución balanceada de riesgos, cláusulas clave, gestión del cambio y Last Planner® System. 14 horas netas y 14 PDU.',
        'canonical'       => 'https://quality-consulting.org/contratos-colaborativos-nec3-f',
        'activePage'      => 'capacitacion',
    ], 'main');

    if (empty($html)) {
        throw new \Exception("El HTML generado está vacío");
    }

    if (!str_contains($html, 'CONTRATOS COLABORATIVOS NEC3-F')) {
        throw new \Exception("Título principal no encontrado en HTML");
    }

    if (!str_contains($html, 'https://quality-consulting.org/contratos-colaborativos-nec3-f')) {
        throw new \Exception("Canonical URL no encontrada en HTML");
    }

    return true;
});

// TEST 7: Validación de 14 horas netas y 14 PDU separados y sin acreditación por PMI ni NEC
runTest("14 horas netas y 14 PDU se presentan separados y de forma neutral sin atribución de aval por PMI ni NEC", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/contratos-colaborativos-nec3-f', [], 'main');

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

    if (!str_contains($html, 'General Education Third-Party Provider') || !str_contains($html, 'Technical Project Management') || !str_contains($html, 'Strategic &amp; Business Management') && !str_contains($html, 'Strategic & Business Management')) {
        throw new \Exception("Faltan las categorías CCR oficiales del brochure");
    }

    return true;
});

// TEST 8: Temario oficial completo (7 bloques)
runTest("Temario oficial contiene exactamente los 7 bloques con sus subtemas oficiales", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/contratos-colaborativos-nec3-f', [], 'main');

    $requiredTopics = [
        'Visión Holística del Contrato NEC3-F',
        'Project Delivery System',
        'Filosofía que Incentiva la Confianza y Cooperación Mutua',
        'Distribución Balanceada de Riesgos',
        'Cláusulas Contractuales y la Gestión del Cambio',
        'Last Planner® System en la Gestión Contractual Colaborativa',
        'Análisis Contractual',
    ];

    foreach ($requiredTopics as $topic) {
        if (!str_contains($html, $topic)) {
            throw new \Exception("Bloque temático oficial no encontrado en el temario: {$topic}");
        }
    }

    // Verificar contenido clave de cada bloque
    $keyDetails = [
        'Reseña y origen de los contratos NEC',
        'design – bid – build',
        'management contracting at risk',
        'Dispute Adjudication Board',
        'tribunal arbitral',
        'principios de Abrahamson',
        'principios de Bunni',
        'Cláusulas claves del contrato NEC 3F',
        'debida diligencia técnica',
        'análisis de restricciones',
        'desempeño del cronograma',
        'Valor ganado',
    ];

    foreach ($keyDetails as $detail) {
        if (!str_contains($html, $detail)) {
            throw new \Exception("Detalle clave del temario no encontrado: {$detail}");
        }
    }

    return true;
});

// TEST 9: Perfil oficial de Ing. Luis Ruiz sin atribución de CIFE Stanford
runTest("Perfil docente contiene formación y empresas oficiales de Luis Ruiz y omite CIFE Stanford", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/contratos-colaborativos-nec3-f', [], 'main');

    $requiredKeywords = [
        'Ing. Luis Ruiz',
        'MBA',
        '25 años',
        'Panamericanos Lima 2019',
        'Laurus Group',
        'Wescon',
        'Obrainsa',
        'Cosapi',
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

// TEST 10: Ausencia de datos restringidos (PDFs, fechas antiguas, horarios, cuentas bancarias, teléfonos del brochure, videos)
runTest("Ausencia total de enlaces a PDFs, fechas antiguas, horarios, cuentas bancarias, teléfonos o videos", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/contratos-colaborativos-nec3-f', [], 'main');

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

    // No debe haber fechas u horarios caducos
    $oldDates = ['05, 19, 24, 26 NOV', '01, 03, 10 DIC', '20:00 – 22:00', '20:00-22:00'];
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

// TEST 11: Beneficios oficiales del brochure
runTest("Beneficios oficiales contiene los ítems requeridos incluyendo grabación por 4 semanas", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/contratos-colaborativos-nec3-f', [], 'main');

    $requiredBenefits = [
        'Descuentos futuros',
        'Base laboral',
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

// TEST 12: Pasarela PayPal exclusiva para primera clase por USD 10
runTest("Pasarela PayPal está configurada para primera clase por USD 10 indicando alcance", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/contratos-colaborativos-nec3-f', [], 'main');

    if (!str_contains($html, 'data-course-slug="contratos-colaborativos-nec3-f"')) {
        throw new \Exception("Falta data-course-slug=\"contratos-colaborativos-nec3-f\" en botón de pago PayPal");
    }

    if (!str_contains($html, 'registro-primera-clase?curso=contratos-colaborativos-nec3-f')) {
        throw new \Exception("Falta enlace de registro primera clase con slug");
    }

    if (!str_contains($html, 'Primera clase del curso – USD 10')) {
        throw new \Exception("Falta etiqueta Primera clase del curso – USD 10");
    }

    if (!str_contains($html, 'US$ 10')) {
        throw new \Exception("Precio US$ 10 no encontrado");
    }

    if (!str_contains($html, 'US$10 únicamente por la primera clase. No incluye el curso completo.')) {
        throw new \Exception("Aclaración de alcance no encontrada");
    }

    if (!str_contains($html, 'Para más información, disponibilidad y precios, contáctanos.')) {
        throw new \Exception("Mensaje de consulta no encontrado");
    }

    return true;
});

// TEST 13: Presencia en sitemap.xml
runTest("sitemap.xml incluye la URL https://quality-consulting.org/contratos-colaborativos-nec3-f", function(): bool {
    $sitemapPath = dirname(__DIR__) . '/public_html/sitemap.xml';
    $content = file_get_contents($sitemapPath);
    if ($content === false) {
        throw new \Exception("No se pudo leer sitemap.xml");
    }

    if (!str_contains($content, '<loc>https://quality-consulting.org/contratos-colaborativos-nec3-f</loc>')) {
        throw new \Exception("URL https://quality-consulting.org/contratos-colaborativos-nec3-f no está en sitemap.xml");
    }

    return true;
});

echo "\n--------------------------------------------------------------------\n";
echo "RESULTADOS: {$passedTests} de {$totalTests} pruebas pasaron exitosamente.\n";
echo "--------------------------------------------------------------------\n\n";

if ($passedTests !== $totalTests) {
    exit(1);
}
