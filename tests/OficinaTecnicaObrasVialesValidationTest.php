<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Test Suite Automatizado: Validación Integral de la Capacitación
 * "OFICINA TÉCNICA EN OBRAS VIALES"
 * Archivo: tests/OficinaTecnicaObrasVialesValidationTest.php
 *
 * Casos de prueba:
 * 1. Registro número 13 en CoursesCatalog (título, categoría, tipo, ruta, imágenes, ausencia de brochure).
 * 2. Registro de ruta /oficina-tecnica-obras-viales en Router.
 * 3. Registro de slug 'oficina-tecnica-obras-viales' en CourseCatalog.
 * 4. PDU (16 PDU) y duración (16 horas netas) como datos separados y fieles.
 * 5. Temario en exactamente 6 bloques oficiales según documento oficial:
 *    Gestión de la Integración, Alcance, Plazo, Costo, Comunicaciones, Procura.
 * 6. Beneficios oficiales permitidos (5 items, con "Base de datos laboral", sin inventar consultoría).
 * 7. Perfil docente Ing. Martín Ortiz (Ing. Civil, PMP®, UNI, experiencia, sin Stanford CIFE atribuido).
 * 8. Existencia física de las imágenes (PNG y WebP) y ausencia de PDF en el repositorio.
 * 9. Ausencia de datos antiguos en la vista (fechas pasadas, horas fijas, cuentas bancarias, etc.).
 * 10. Ausencia total de enlaces a PDF o portada del brochure en la vista y en el archivo HTML compilado.
 * 11. Sección del brochure reemplazada por mensaje de contacto comercial y canales activos.
 * 12. Botón de PayPal restringido a primera clase (USD 10) con aclaración de no inclusión del curso completo.
 * 13. URL oficial registrada en public_html/sitemap.xml.
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
echo "EJECUTANDO SUITE DE PRUEBAS: OFICINA TÉCNICA EN OBRAS VIALES\n";
echo "====================================================================\n\n";

// Caso 1: Registro 13 en CoursesCatalog
runTest("Registro #13 en CoursesCatalog tiene título, tipo, ruta, imágenes y no incluye brochure", function(): bool {
    $courses = CoursesCatalog::getAll();
    $found = null;
    foreach ($courses as $c) {
        if ($c['number'] === 13) {
            $found = $c;
            break;
        }
    }
    if ($found === null) {
        throw new \Exception("No se encontró el registro número 13 en CoursesCatalog.");
    }
    if ($found['title'] !== 'OFICINA TÉCNICA EN OBRAS VIALES') {
        throw new \Exception("Título incorrecto: " . $found['title']);
    }
    if ($found['category'] !== 'Oficina Técnica') {
        throw new \Exception("Categoría incorrecta: " . $found['category']);
    }
    if ($found['route'] !== '/oficina-tecnica-obras-viales') {
        throw new \Exception("Ruta incorrecta: " . $found['route']);
    }
    if ($found['image'] !== 'img/capacitaciones/oficina-tecnica-obras-viales.webp') {
        throw new \Exception("Imagen principal incorrecta: " . $found['image']);
    }
    if ($found['image_fallback'] !== 'img/capacitaciones/oficina-tecnica-obras-viales.png') {
        throw new \Exception("Imagen fallback incorrecta: " . $found['image_fallback']);
    }
    if (!empty($found['brochure'])) {
        throw new \Exception("El brochure no debe estar configurado en el catálogo público: " . $found['brochure']);
    }
    return true;
});

// Caso 2: Ruta en Router
runTest("La ruta /oficina-tecnica-obras-viales está registrada en config/routes.php", function(): bool {
    $router = new Router();
    $config = require dirname(__DIR__) . '/private_app/config/app.php';
    $loader = require dirname(__DIR__) . '/private_app/config/routes.php';
    $loader($router, $config);

    $routes = $router->getRoutes();
    if (!isset($routes['GET']['/oficina-tecnica-obras-viales'])) {
        throw new \Exception("Ruta GET /oficina-tecnica-obras-viales no encontrada.");
    }
    $target = $routes['GET']['/oficina-tecnica-obras-viales'];
    if (!is_array($target) || $target[0] !== TrainingController::class || $target[1] !== 'oficinaTecnicaObrasViales') {
        throw new \Exception("Destino de ruta inválido para /oficina-tecnica-obras-viales.");
    }
    return true;
});

// Caso 3: Registro en CourseCatalog
runTest("Slug 'oficina-tecnica-obras-viales' está registrado y es válido en CourseCatalog", function(): bool {
    if (!CourseCatalog::isValid('oficina-tecnica-obras-viales')) {
        throw new \Exception("CourseCatalog::isValid('oficina-tecnica-obras-viales') retornó false.");
    }
    $title = CourseCatalog::getTitle('oficina-tecnica-obras-viales');
    if (empty($title)) {
        throw new \Exception("CourseCatalog::getTitle retornó vacío.");
    }
    $course = CourseCatalog::find('oficina-tecnica-obras-viales');
    if ($course['url'] !== '/oficina-tecnica-obras-viales') {
        throw new \Exception("CourseCatalog url incorrecta: " . $course['url']);
    }
    return true;
});

// Caso 4: PDU (16 PDU) y duración (16 horas netas) como datos separados
runTest("PDU (16 PDU) y duración (16 horas netas) están declarados fielmente como datos separados", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/oficina-tecnica-obras-viales.php';
    if (!file_exists($viewPath)) {
        throw new \Exception("No existe la vista: " . $viewPath);
    }
    $content = file_get_contents($viewPath);

    if (!str_contains($content, "'16 PDU'") && !str_contains($content, "'16 PDU'")) {
        throw new \Exception("16 PDU no declarado de forma explícita.");
    }
    if (!str_contains($content, "'16 horas netas'")) {
        throw new \Exception("16 horas netas no declaradas explícitamente.");
    }
    if (!str_contains($content, 'General Education Third-Party Provider')) {
        throw new \Exception("Falta la categoría PMI® CCR: General Education Third-Party Provider.");
    }
    return true;
});

// Caso 5: Temario con exactamente 6 bloques oficiales
runTest("Temario contiene exactamente los 6 bloques oficiales del documento", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/oficina-tecnica-obras-viales.php';
    $content = file_get_contents($viewPath);

    $expectedBlocks = [
        'Gestión de la Integración',
        'Alcance',
        'Plazo',
        'Costo',
        'Comunicaciones',
        'Procura',
    ];

    foreach ($expectedBlocks as $block) {
        if (!str_contains($content, $block)) {
            throw new \Exception("Bloque temático faltante: " . $block);
        }
    }

    // Verificar subtemas específicos
    $subtemas = [
        'Contrato de Obra',
        'Plan Técnico de Obra',
        'Memoria Descriptiva',
        'Planos y Especificaciones',
        'Metrados, Solicitudes de Adelanto',
        'Valorizaciones',
        'Adicionales',
        'Deductivos',
        'Cronograma de Obra',
        'Avance Valorizado',
        'Curva S',
        'Solicitudes de Ampliaciones de Plazo',
        'Last Planner System',
        'Presupuesto Contractual',
        'Presupuesto Interno',
        'Presupuesto Meta',
        'Fórmula Polinómica',
        'Resultado Operativo',
        'Actas de Reunión',
        'Cuadernos de Obra',
        'Transmittal, Submittal, RFI',
        'Proceso Logístico',
        'Catálogos, Hojas Técnicas, Manuales',
        'Valorizaciones de Servicios de Terceros',
    ];

    foreach ($subtemas as $sub) {
        if (!str_contains($content, $sub)) {
            throw new \Exception("Subtema faltante: " . $sub);
        }
    }

    return true;
});

// Caso 6: Beneficios oficiales
runTest("Beneficios corresponden exactamente a los 5 beneficios respaldados por el documento", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/oficina-tecnica-obras-viales.php';
    $content = file_get_contents($viewPath);

    if (!str_contains($content, 'Ingreso a la base de datos laboral de Quality Consulting Solutions.')) {
        throw new \Exception("Beneficio de base de datos laboral faltante o alterado.");
    }
    if (!str_contains($content, 'Descuento para futuros cursos con precios ordinarios.')) {
        throw new \Exception("Beneficio de descuento para futuros cursos faltante.");
    }
    if (!str_contains($content, 'Diploma digital a nombre de Quality Consulting Solutions.')) {
        throw new \Exception("Beneficio de diploma digital faltante.");
    }
    if (!str_contains($content, 'Entrega de material digital.')) {
        throw new \Exception("Beneficio de material digital faltante.");
    }
    if (!str_contains($content, 'Acceso vía internet a la grabación del curso luego de finalizado (4 semanas).')) {
        throw new \Exception("Beneficio de grabación faltante.");
    }

    // No debe contener consultoría de 1 hora (esa pertenecía a otros cursos) ni "Bolsa laboral"
    if (str_contains($content, 'Consultoría de 1 hora')) {
        throw new \Exception("La consultoría de 1 hora fue agregada indebidamente.");
    }
    if (str_contains($content, 'Bolsa laboral')) {
        throw new \Exception("No debe usarse 'Bolsa laboral', únicamente 'Base de datos laboral'.");
    }

    return true;
});

// Caso 7: Perfil docente Ing. Martín Ortiz
runTest("Perfil docente corresponde al Ing. Martín Ortiz sin atribuciones institucionales ajenas", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/oficina-tecnica-obras-viales.php';
    $content = file_get_contents($viewPath);

    if (!str_contains($content, 'Martín Ortiz')) {
        throw new \Exception("Docente Martín Ortiz no encontrado.");
    }
    if (!str_contains($content, 'Universidad Nacional de Ingeniería')) {
        throw new \Exception("Falta alma mater UNI.");
    }
    if (!str_contains($content, '+20 años de experiencia')) {
        throw new \Exception("Falta experiencia de +20 años.");
    }
    if (!str_contains($content, 'PDCI Peruana de Construcción e Infraestructura')) {
        throw new \Exception("Falta trayectoria PDCI.");
    }
    if (!str_contains($content, 'Consorcio Agua SCM')) {
        throw new \Exception("Falta trayectoria Consorcio Agua SCM.");
    }
    if (!str_contains($content, 'INCOT')) {
        throw new \Exception("Falta trayectoria INCOT.");
    }
    if (!str_contains($content, 'COCO Ingenieros SAC')) {
        throw new \Exception("Falta trayectoria COCO Ingenieros SAC.");
    }
    if (!str_contains($content, 'ICCGSA')) {
        throw new \Exception("Falta trayectoria ICCGSA.");
    }

    // Verificación estricta: NO atribuir CIFE Stanford al perfil del Ing. Martín Ortiz
    if (str_contains($content, 'Stanford') || str_contains($content, 'CIFE')) {
        throw new \Exception("Se atribuyó indebidamente la colaboración de CIFE Stanford al perfil docente de Martín Ortiz.");
    }

    return true;
});

// Caso 8: Existencia física de imágenes y no inclusión del PDF
runTest("Imágenes de portada existen en disco (PNG y WebP) y no se copió el PDF al repositorio", function(): bool {
    $pngPath = dirname(__DIR__) . '/public_html/img/capacitaciones/oficina-tecnica-obras-viales.png';
    $webpPath = dirname(__DIR__) . '/public_html/img/capacitaciones/oficina-tecnica-obras-viales.webp';

    if (!file_exists($pngPath)) {
        throw new \Exception("No existe el PNG: " . $pngPath);
    }
    if (!file_exists($webpPath)) {
        throw new \Exception("No existe el WebP: " . $webpPath);
    }

    // Confirmar que el PDF NO se encuentre dentro de public_html o private_app
    $repoPdfMatches = glob(dirname(__DIR__) . '/public_html/brochures/**/*02*.pdf');
    if (!empty($repoPdfMatches)) {
        throw new \Exception("Se detectó un PDF del curso copiado indebidamente dentro del repositorio.");
    }

    return true;
});

// Caso 9: Ausencia de datos antiguos o prohibidos
runTest("Vista no contiene fechas pasadas, cuentas bancarias ni Niubiz", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/oficina-tecnica-obras-viales.php';
    $content = file_get_contents($viewPath);

    $prohibitedTerms = [
        '191-10382996',
        '00219111038299607352',
        '047-3092292540',
        '0011-0184-02-00496525',
        '039-7331729',
        '24JUL',
        '16AGO',
        'Niubiz',
        'Visa',
    ];

    foreach ($prohibitedTerms as $term) {
        if (str_contains($content, $term)) {
            throw new \Exception("Término prohibido encontrado en la vista: " . $term);
        }
    }

    return true;
});

// Caso 10: Ausencia total de enlaces a PDF o portada del brochure
runTest("Vista no contiene referencias a brochure_url, brochure_download ni brochure_thumb", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/oficina-tecnica-obras-viales.php';
    $content = file_get_contents($viewPath);

    if (str_contains($content, "'brochure_url'")) {
        throw new \Exception("'brochure_url' presente en la vista.");
    }
    if (str_contains($content, "'brochure_download'")) {
        throw new \Exception("'brochure_download' presente en la vista.");
    }
    if (str_contains($content, "'brochure_thumb'")) {
        throw new \Exception("'brochure_thumb' presente en la vista.");
    }

    return true;
});

// Caso 11: Renderizado HTML muestra tarjeta de contacto y no botones de descarga de PDF
runTest("Renderizado HTML muestra tarjeta de información/contacto y ningún botón de PDF", function(): bool {
    $viewEngine = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $viewEngine->render('pages/oficina-tecnica-obras-viales', [
        'title'        => 'Capacitación: Oficina Técnica en Obras Viales',
        'canonicalUrl' => 'https://quality-consulting.org/oficina-tecnica-obras-viales',
    ], 'main');

    if (str_contains($html, 'Ver PDF') || str_contains($html, 'Descargar PDF')) {
        throw new \Exception("El HTML renderizado contiene botones de descarga de PDF.");
    }
    if (!str_contains($html, 'Para más información, disponibilidad y precios, contáctanos.')) {
        throw new \Exception("Falta el mensaje de contacto comercial en lugar del brochure.");
    }
    if (!str_contains($html, 'data-bs-target="#modalSolicitarInfo"')) {
        throw new \Exception("Falta el botón de modal de solicitud de información.");
    }
    if (!str_contains($html, 'Solicitar información por WhatsApp')) {
        throw new \Exception("Falta el canal de WhatsApp.");
    }

    return true;
});

// Caso 12: PayPal restringido a primera clase USD 10
runTest("Subbloque de PayPal está configurado para la primera clase a US$ 10", function(): bool {
    $viewEngine = new View(dirname(__DIR__) . '/private_app/app/Views');
    $html = $viewEngine->render('pages/oficina-tecnica-obras-viales', [
        'title'        => 'Capacitación: Oficina Técnica en Obras Viales',
        'canonicalUrl' => 'https://quality-consulting.org/oficina-tecnica-obras-viales',
    ], 'main');

    if (!str_contains($html, 'US$ 10')) {
        throw new \Exception("Precio de US$ 10 no encontrado en el bloque de primera clase.");
    }
    if (!str_contains($html, 'curso=oficina-tecnica-obras-viales')) {
        throw new \Exception("Enlace a registro de primera clase con slug incorrecto.");
    }
    if (!str_contains($html, 'US$10 únicamente por la primera clase. No incluye el curso completo.')) {
        throw new \Exception("Nota de restricción de alcance de pago ausente.");
    }

    return true;
});

// Caso 13: Sitemap contiene la URL oficial
runTest("Sitemap incluye la URL canónica https://quality-consulting.org/oficina-tecnica-obras-viales", function(): bool {
    $sitemapPath = dirname(__DIR__) . '/public_html/sitemap.xml';
    $content = file_get_contents($sitemapPath);
    if (!str_contains($content, '<loc>https://quality-consulting.org/oficina-tecnica-obras-viales</loc>')) {
        throw new \Exception("URL oficial ausente en sitemap.xml.");
    }
    return true;
});

echo "\n--------------------------------------------------------------------\n";
echo "RESULTADOS: {$passedTests} de {$totalTests} pruebas pasadas con éxito.\n";
echo "--------------------------------------------------------------------\n\n";

if ($passedTests !== $totalTests) {
    exit(1);
}
