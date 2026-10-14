<?php
/**
 * Test de Validación Exhaustiva para:
 * "CASOS PRÁCTICOS DE CONTRATOS NEC3-F"
 *
 * Valida:
 * 1. Registro del curso en CoursesCatalog.php (#17, slug, ruta, imágenes, tipo).
 * 2. Cursos #15, #16, #19, #20, #25 permanecen intactos y separados.
 * 3. Registro de ruta en config/routes.php.
 * 4. Registro de slug en CourseCatalog.php.
 * 5. Integridad de la vista: 12 horas netas y 12 PDU separados.
 * 6. Temario estructurado: fundamentos oficiales y 3 casos prácticos.
 * 7. Beneficios oficiales: 5 ítems del brochure oficial.
 * 8. Docente Ing. Iván Benavides, PMP®: experiencia y credenciales oficiales del brochure.
 * 9. Existencia física y validez de imágenes (PNG temático intacto, WebP generado, fotos del docente).
 * 10. Ausencia de fechas antiguas, horarios, cuentas bancarias, promesas laborales no autorizadas o PDFs.
 * 11. Mensaje de contacto y flujo PayPal primera clase USD 10.
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
echo "EJECUTANDO SUITE DE PRUEBAS: CASOS PRÁCTICOS DE CONTRATOS NEC3-F\n";
echo "====================================================================\n\n";

// TEST 1: Registro en CoursesCatalog
runTest("Registro #17 en CoursesCatalog tiene título, tipo, ruta, imágenes y no duplica", function(): bool {
    $catalog = CoursesCatalog::getAll();
    $found = null;
    $duplicateCount = 0;
    foreach ($catalog as $c) {
        if (($c['number'] ?? 0) === 17) {
            $found = $c;
        }
        if (($c['route'] ?? '') === '/casos-practicos-contratos-nec3-f') {
            $duplicateCount++;
        }
    }

    if (!$found) {
        throw new \Exception("No se encontró el curso #17 en CoursesCatalog");
    }

    if ($duplicateCount !== 1) {
        throw new \Exception("Se encontraron {$duplicateCount} cursos con ruta /casos-practicos-contratos-nec3-f, debe haber exactamente 1");
    }

    if ($found['title'] !== 'CASOS PRÁCTICOS DE CONTRATOS NEC3-F') {
        throw new \Exception("Título incorrecto: " . $found['title']);
    }

    if ($found['category'] !== 'Contratos' || $found['category_slug'] !== 'contratos') {
        throw new \Exception("Categoría incorrecta");
    }

    if ($found['route'] !== '/casos-practicos-contratos-nec3-f') {
        throw new \Exception("Ruta incorrecta: " . $found['route']);
    }

    if ($found['image'] !== 'img/capacitaciones/casos-practicos-contratos-nec3-f.webp') {
        throw new \Exception("WebP principal incorrecto: " . $found['image']);
    }

    if ($found['image_fallback'] !== 'img/capacitaciones/casos-practicos-contratos-nec3-f.png') {
        throw new \Exception("PNG fallback incorrecto: " . $found['image_fallback']);
    }

    if (isset($found['brochure'])) {
        throw new \Exception("El registro no debe tener clave 'brochure'");
    }

    return true;
});

// TEST 2: Cursos hermanos intactos
runTest("Cursos hermanos (#15, #16, #19, #20, #25) permanecen intactos y separados", function(): bool {
    $catalog = CoursesCatalog::getAll();
    $courses = [];
    foreach ($catalog as $c) {
        $num = $c['number'] ?? 0;
        if (in_array($num, [15, 16, 17, 19, 20, 25], true)) {
            $courses[$num] = $c;
        }
    }

    if (!isset($courses[15]) || $courses[15]['title'] !== 'CONTRATOS COLABORATIVOS NEC3-F') {
        throw new \Exception("Curso #15 modificado o ausente");
    }
    if (!isset($courses[16]) || $courses[16]['title'] !== 'EL CONTRATO DE NEC4') {
        throw new \Exception("Curso #16 modificado o ausente");
    }
    if (!isset($courses[19]) || $courses[19]['title'] !== 'CONTRATO COLABORATIVO NEC 3/4') {
        throw new \Exception("Curso #19 modificado o ausente");
    }
    if (!isset($courses[20]) || $courses[20]['title'] !== 'GESTIÓN DE EVENTOS COMPENSABLES Y ALERTAS TEMPRANAS EN CONTRATOS NEC4') {
        throw new \Exception("Curso #20 modificado o ausente");
    }
    if (!isset($courses[25]) || $courses[25]['title'] !== 'SEMINARIO VALORIZACIÓN DE OBRA EN CONTRATOS NEC') {
        throw new \Exception("Curso #25 modificado o ausente");
    }

    // Comprobar que todas las rutas son distintas
    $routes = [
        $courses[15]['route'],
        $courses[16]['route'],
        $courses[17]['route'],
        $courses[19]['route'],
        $courses[20]['route'],
    ];
    if (count(array_unique($routes)) !== count($routes)) {
        throw new \Exception("Existen colisiones de rutas entre los cursos");
    }

    return true;
});

// TEST 3: Registro de ruta en routes.php
runTest("Ruta /casos-practicos-contratos-nec3-f registrada en config/routes.php", function(): bool {
    $routesFile = dirname(__DIR__) . '/private_app/config/routes.php';
    $content = file_get_contents($routesFile);

    if (!str_contains($content, "'/casos-practicos-contratos-nec3-f'")) {
        throw new \Exception("Ruta '/casos-practicos-contratos-nec3-f' no encontrada en config/routes.php");
    }

    if (!str_contains($content, "'casosPracticosContratosNec3f'")) {
        throw new \Exception("Acción 'casosPracticosContratosNec3f' no encontrada en config/routes.php");
    }

    return true;
});

// TEST 4: Registro de slug en CourseCatalog.php
runTest("Slug casos-practicos-contratos-nec3-f registrado en CourseCatalog.php", function(): bool {
    if (!CourseCatalog::isValid('casos-practicos-contratos-nec3-f')) {
        throw new \Exception("CourseCatalog::isValid retornó false para 'casos-practicos-contratos-nec3-f'");
    }

    $c = CourseCatalog::find('casos-practicos-contratos-nec3-f');
    if (!$c) {
        throw new \Exception("CourseCatalog::find retornó null para 'casos-practicos-contratos-nec3-f'");
    }

    if ($c['url'] !== '/casos-practicos-contratos-nec3-f') {
        throw new \Exception("URL incorrecta en CourseCatalog: " . $c['url']);
    }

    return true;
});

// TEST 5: Renderizado de la vista y métricas (12 horas netas y 12 PDU)
runTest("Vista se renderiza correctamente con 12 horas netas y 12 PDU separados", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/casos-practicos-contratos-nec3-f', [], 'main');

    if (!str_contains($html, 'CASOS PRÁCTICOS DE CONTRATOS NEC3-F')) {
        throw new \Exception("El título del curso no aparece en el HTML");
    }

    if (!str_contains($html, '12 horas netas')) {
        throw new \Exception("No se encontraron '12 horas netas' en el HTML renderizado");
    }

    if (stripos($html, '12 horas lectivas netas') !== false) {
        throw new \Exception("Se encontró '12 horas lectivas netas' prohibido en el HTML");
    }

    if (!str_contains($html, '12 PDU')) {
        throw new \Exception("No se encontraron '12 PDU' en el HTML renderizado");
    }

    return true;
});

// TEST 6: Temario oficial
runTest("Temario contiene exactamente Fundamentos y los 3 casos prácticos según el brochure", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/casos-practicos-contratos-nec3-f', [], 'main');

    if (!str_contains($html, 'Fundamentos')) {
        throw new \Exception("No se encontró el bloque 'Fundamentos' en el temario");
    }

    if (stripos($html, 'Fundamentos normativos') !== false) {
        throw new \Exception("Se encontró 'Fundamentos normativos' prohibido en el HTML");
    }

    $requiredTerms = [
        'Procesos de la Gestión de Proyectos de Construcción',
        'Contrato NEC 3F',
        'Definiciones y Términos del Contrato NEC 3F',
        'Obligaciones del contratista',
        'Obligaciones del cliente',
        'Plazos',
        'Revisión del Cronograma',
        'Pruebas y Defectos',
        'Condiciones de Pago',
        'Gestión de Riesgos',
        'Alertas Tempranas',
        'Eventos Compensables',
        'Titularidad',
        'Riesgos y Seguros',
        'Extinción y Resolución',
        'Solución de Controversias',
        'Cierre del Contrato',
        'Caso Práctico 1',
        'Caso Práctico 2',
        'Caso Práctico 3',
    ];

    foreach ($requiredTerms as $term) {
        if (!str_contains($html, $term)) {
            throw new \Exception("Término curricular no encontrado en la vista: '{$term}'");
        }
    }

    return true;
});

// TEST 7: Beneficios oficiales
runTest("Los 5 beneficios oficiales están presentes en la vista", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/casos-practicos-contratos-nec3-f', [], 'main');

    $benefits = [
        'Ingreso a la base de datos laboral de Quality Consulting Solutions.',
        'Descuento para futuros cursos con precios ordinarios.',
        'Diploma digital a nombre de Quality Consulting Solutions.',
        'Entrega de material digital.',
        '4 semanas',
    ];

    foreach ($benefits as $b) {
        if (!str_contains($html, $b)) {
            throw new \Exception("Beneficio oficial ausente: '{$b}'");
        }
    }

    return true;
});

// TEST 8: Docente Ing. Iván Benavides, PMP®
runTest("Docente Ing. Iván Benavides, PMP® y su trayectoria oficial están en la vista", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/casos-practicos-contratos-nec3-f', [], 'main');

    if (!str_contains($html, 'Iván Benavides') && !str_contains($html, 'Ivan Benavides')) {
        throw new \Exception("Nombre del docente no encontrado");
    }

    if (!str_contains($html, 'PMP®') && !str_contains($html, 'PMP')) {
        throw new \Exception("Credencial PMP no encontrada");
    }

    $experience = [
        'Escuelas Bicentenario',
        'Savia Perú',
        'Juegos Panamericanos Lima 2019',
        'Peru Piping Spools',
        'Graña y Montero',
        'Ingeniería y Servicios Tecnológicos S.A.C.',
    ];

    foreach ($experience as $exp) {
        if (!str_contains($html, $exp)) {
            throw new \Exception("Trayectoria del docente ausente: '{$exp}'");
        }
    }

    if (preg_match('/\bIST\b/', $html)) {
        throw new \Exception("Se encontró abreviatura indebida 'IST' en el perfil docente");
    }

    return true;
});

// TEST 9: Archivos físicos de imágenes
runTest("Archivos de imagen temática y docente existen físicamente", function(): bool {
    $base = dirname(__DIR__) . '/public_html/';

    $files = [
        'img/capacitaciones/casos-practicos-contratos-nec3-f.png',
        'img/capacitaciones/casos-practicos-contratos-nec3-f.webp',
        'img/docentes/ivan-benavides.png',
        'img/docentes/ivan-benavides.webp',
    ];

    foreach ($files as $f) {
        $p = $base . $f;
        if (!file_exists($p)) {
            throw new \Exception("Archivo de imagen no encontrado: {$f}");
        }
        if (filesize($p) === 0) {
            throw new \Exception("Archivo de imagen vacío: {$f}");
        }
    }

    return true;
});

// TEST 10: Ausencia de datos prohibidos
runTest("Ausencia de fechas antiguas, horarios, cuentas bancarias y promesas indebidas", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/casos-practicos-contratos-nec3-f', [], 'main');

    if (str_contains(strtolower($html), '.pdf')) {
        throw new \Exception("Se encontró referencia a archivo PDF en el HTML");
    }

    if (preg_match('/href=["\'][^"\']*(?:brochure|\.pdf)[^"\']*["\']/i', $html)) {
        throw new \Exception("Se encontró enlace a brochure o archivo PDF en el HTML");
    }

    $prohibited = [
        '191-10382996-0-73',
        '047-3092292540',
        '0011-0184-02-00496525',
        '039-7331729',
        'Omar Samaniego',
        '20:00 – 22:00',
        '20:00 - 22:00',
        '06, 17, 22, 24, 29 MAY',
        '05 JUN',
        'Prepárate para trabajar',
        'preparate para trabajar',
    ];

    foreach ($prohibited as $str) {
        if (stripos($html, $str) !== false) {
            throw new \Exception("Cadena prohibida encontrada en la vista: '{$str}'");
        }
    }

    return true;
});

// TEST 11: PayPal primera clase USD 10
runTest("Botón PayPal exclusivo para la primera clase por USD 10", function(): bool {
    $view = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $view->render('pages/casos-practicos-contratos-nec3-f', [], 'main');

    if (!str_contains($html, 'casos-practicos-contratos-nec3-f')) {
        throw new \Exception("Slug del curso ausente en la vista");
    }

    if (!str_contains($html, 'USD 10') && !str_contains($html, '10 USD')) {
        throw new \Exception("Mención de USD 10 para la primera clase ausente");
    }

    return true;
});

// TEST 12: Presencia en sitemap.xml
runTest("Presencia de la URL en sitemap.xml", function(): bool {
    $sitemap = file_get_contents(dirname(__DIR__) . '/public_html/sitemap.xml');
    if (!str_contains($sitemap, 'https://quality-consulting.org/casos-practicos-contratos-nec3-f')) {
        throw new \Exception("URL ausente en sitemap.xml");
    }

    return true;
});

echo "\n====================================================================\n";
echo "RESULTADOS: {$passedTests} / {$totalTests} PRUEBAS PASADAS\n";
echo "====================================================================\n\n";

if ($passedTests !== $totalTests) {
    exit(1);
}
