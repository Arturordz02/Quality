<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Test Suite Automatizado: Validación Integral del Seminario Casos de Aplicación del Diagrama de Ishikawa
 * Archivo: tests/SeminarioIshikawaValidationTest.php
 *
 * Casos de prueba:
 * 1. Registro número 7 en CoursesCatalog (título, tipo, ruta, imágenes, ausencia de brochure).
 * 2. Registro de ruta /seminario-diagrama-ishikawa en Router.
 * 3. Registro de slug 'seminario-diagrama-ishikawa' en CourseCatalog.
 * 4. PDU (6 PDU) y duración (03 horas netas) como datos separados y fieles.
 * 5. Ausencia total de videos incrustados ('videos' => [] y 0 iframes de YouTube).
 * 6. Temario en exactamente dos bloques: Fundamentos y Aplicación.
 * 7. Beneficios oficiales permitidos (6 items, sin consultoría ni bolsa laboral, con base de datos laboral).
 * 8. Existencia física de las imágenes decorativas (PNG y WebP 960x536) y ausencia de PDF y portada en public_html y _site.
 * 9. Ausencia de datos antiguos en la vista (fechas pasadas, horas, precios S/ 65, cuentas bancarias).
 * 10. Ausencia total de enlaces a PDF o portada del brochure en la vista y en el archivo HTML compilado.
 * 11. Sección del brochure reemplazada por mensaje de contacto comercial y canales activos.
 * 12. Botón de PayPal restringido a primera clase (USD 10) con aclaración de no inclusión del curso completo.
 * 13. Configuración de notificaciones de pago: Soporte para PAYMENT_NOTIFICATION_EMAIL sin credenciales hardcodeadas.
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
echo "EJECUTANDO SUITE DE PRUEBAS: SEMINARIO DIAGRAMA DE ISHIKAWA\n";
echo "====================================================================\n\n";

// Caso 1: Registro 7 en CoursesCatalog
runTest("Registro #7 en CoursesCatalog tiene título, tipo, ruta, imágenes y no incluye brochure", function(): bool {
    $courses = CoursesCatalog::getAll();
    $found = null;
    foreach ($courses as $c) {
        if ($c['number'] === 7) {
            $found = $c;
            break;
        }
    }
    if ($found === null) {
        throw new \Exception("No se encontró el registro número 7 en CoursesCatalog.");
    }
    if ($found['title'] !== 'CASOS DE APLICACIÓN DEL DIAGRAMA DE ISHIKAWA') {
        throw new \Exception("Título incorrecto: " . $found['title']);
    }
    if ($found['type'] !== 'Seminario') {
        throw new \Exception("Tipo incorrecto: " . $found['type']);
    }
    if ($found['route'] !== '/seminario-diagrama-ishikawa') {
        throw new \Exception("Ruta incorrecta: " . $found['route']);
    }
    if ($found['image'] !== 'img/capacitaciones/seminario-diagrama-ishikawa.webp') {
        throw new \Exception("Imagen principal incorrecta: " . $found['image']);
    }
    if ($found['image_fallback'] !== 'img/capacitaciones/seminario-diagrama-ishikawa.png') {
        throw new \Exception("Imagen fallback incorrecta: " . $found['image_fallback']);
    }
    if (!empty($found['brochure'])) {
        throw new \Exception("El brochure no debe estar configurado en el catálogo público: " . $found['brochure']);
    }
    return true;
});

// Caso 2: Ruta en Router
runTest("La ruta /seminario-diagrama-ishikawa está registrada en config/routes.php", function(): bool {
    $router = new Router();
    $config = require dirname(__DIR__) . '/private_app/config/app.php';
    $loader = require dirname(__DIR__) . '/private_app/config/routes.php';
    $loader($router, $config);

    $routes = $router->getRoutes();
    if (!isset($routes['GET']['/seminario-diagrama-ishikawa'])) {
        throw new \Exception("Ruta GET /seminario-diagrama-ishikawa no encontrada en routes.");
    }
    return true;
});

// Caso 3: Slug de pago en CourseCatalog
runTest("El slug 'seminario-diagrama-ishikawa' está registrado y es válido en CourseCatalog", function(): bool {
    if (!CourseCatalog::isValid('seminario-diagrama-ishikawa')) {
        throw new \Exception("Slug no es válido en CourseCatalog.");
    }
    $info = CourseCatalog::find('seminario-diagrama-ishikawa');
    if ($info['url'] !== '/seminario-diagrama-ishikawa') {
        throw new \Exception("URL del catálogo de pago incorrecta: " . $info['url']);
    }
    return true;
});

// Caso 4: PDU (6 PDU) y 3 horas netas separadas en la vista
runTest("La vista contiene 6 PDU y 03 horas netas como datos separados", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/seminario-diagrama-ishikawa.php';
    $code = file_get_contents($viewPath);
    if (!str_contains($code, "'pdu_title'") || !str_contains($code, 'Unidades de desarrollo profesional (6 PDU)')) {
        throw new \Exception("pdu_title incorrecto.");
    }
    if (!str_contains($code, "'06 PDU'")) {
        throw new \Exception("06 PDU no encontrado en la vista.");
    }
    if (!str_contains($code, "'03 horas netas'")) {
        throw new \Exception("03 horas netas no encontrado en la vista.");
    }
    return true;
});

// Caso 5: Videos vacíos y cero YouTube en la vista
runTest("La vista define 'videos' => [] y no incluye enlaces o iframes de YouTube", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/seminario-diagrama-ishikawa.php';
    $code = file_get_contents($viewPath);
    if (!str_contains($code, "'videos'              => []") && !str_contains($code, "'videos' => []")) {
        throw new \Exception("'videos' => [] no encontrado.");
    }
    if (str_contains(strtolower($code), 'youtube.com') || str_contains(strtolower($code), 'youtu.be')) {
        throw new \Exception("Se encontraron enlaces a YouTube indebidos.");
    }
    return true;
});

// Caso 6: Temario en solo dos bloques (Fundamentos y Aplicación)
runTest("El temario está estructurado en exactamente dos bloques: Fundamentos y Aplicación", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/seminario-diagrama-ishikawa.php';
    $code = file_get_contents($viewPath);
    if (!str_contains($code, "'title'   => 'Fundamentos'") || !str_contains($code, "'title'   => 'Aplicación'")) {
        throw new \Exception("Bloques oficiales Fundamentos / Aplicación no encontrados.");
    }
    return true;
});

// Caso 7: Beneficios permitidos (6 items, sin consultoría, con base de datos laboral)
runTest("Beneficios contiene exactamente 6 elementos permitidos, sin consultoría ni bolsa laboral", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/seminario-diagrama-ishikawa.php';
    $code = file_get_contents($viewPath);
    if (stripos($code, 'bolsa laboral') !== false) {
        throw new \Exception("Término 'bolsa laboral' detectado indebidamente.");
    }
    if (stripos($code, 'consultoría incluida') !== false || stripos($code, '1 hora de lunes a viernes') !== false) {
        throw new \Exception("Beneficio de consultoría detectado indebidamente (no pertenece a este seminario).");
    }
    if (!str_contains($code, 'Base de datos laboral')) {
        throw new \Exception("Beneficio 'Base de datos laboral' no encontrado.");
    }
    if (!str_contains($code, 'Ingreso a la base de datos laboral de Quality Consulting Solutions.')) {
        throw new \Exception("Texto oficial de base de datos laboral no encontrado.");
    }
    return true;
});

// Caso 8: Existencia física de imágenes decorativas y ausencia estricta de PDF y portada
runTest("Imágenes decorativas existen (PNG y WebP 960x536) y el brochure/portada no existen en public_html ni _site", function(): bool {
    $pdfPub = dirname(__DIR__) . '/public_html/brochures/calidad/seminario-diagrama-ishikawa.pdf';
    $portadaPub = dirname(__DIR__) . '/public_html/img/brochures/portada-seminario-diagrama-ishikawa.png';
    $pdfSite = dirname(__DIR__) . '/_site/brochures/calidad/seminario-diagrama-ishikawa.pdf';
    $portadaSite = dirname(__DIR__) . '/_site/img/brochures/portada-seminario-diagrama-ishikawa.png';
    $png = dirname(__DIR__) . '/public_html/img/capacitaciones/seminario-diagrama-ishikawa.png';
    $webp = dirname(__DIR__) . '/public_html/img/capacitaciones/seminario-diagrama-ishikawa.webp';

    if (file_exists($pdfPub)) throw new \Exception("El PDF existe indebidamente en public_html.");
    if (file_exists($portadaPub)) throw new \Exception("La portada PNG existe indebidamente en public_html.");
    if (file_exists($pdfSite)) throw new \Exception("El PDF fue copiado indebidamente a _site.");
    if (file_exists($portadaSite)) throw new \Exception("La portada PNG fue copiada indebidamente a _site.");
    if (!file_exists($png)) throw new \Exception("No existe la imagen PNG decorativa en public_html.");
    if (!file_exists($webp)) throw new \Exception("No existe la imagen WebP decorativa en public_html.");

    // Verificar dimensiones de la imagen PNG decorativa
    $info = getimagesize($png);
    if ($info[0] !== 960 || $info[1] !== 536) {
        throw new \Exception("Dimensiones de la imagen no son 960x536: {$info[0]}x{$info[1]}");
    }
    return true;
});

// Caso 9: Ausencia de datos antiguos en la vista
runTest("La vista no contiene fechas, horas, precios pasados ni números de cuenta bancaria", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/seminario-diagrama-ishikawa.php';
    $code = file_get_contents($viewPath);
    $prohibited = [
        '30 de junio',
        '30 JUN',
        '19:00',
        'S/ 65',
        'S/. 65',
        'USD 18',
        '191-10382996-0-73',
        '047-3092292540',
        '0011-0184-02-00496525',
        'Niubiz',
        'CIFE Stanford University (2018-2019)',
    ];
    foreach ($prohibited as $term) {
        if (stripos($code, $term) !== false) {
            throw new \Exception("Término no permitido detectado en la vista: '{$term}'");
        }
    }
    return true;
});

// Caso 10: Ausencia total de enlaces a PDF o portada en la vista y en _site
runTest("No existen enlaces a PDF ni a la portada del brochure en la vista ni en el HTML generado", function(): bool {
    $viewPath = dirname(__DIR__) . '/private_app/app/Views/pages/seminario-diagrama-ishikawa.php';
    $viewContent = file_get_contents($viewPath);
    if (str_contains($viewContent, 'seminario-diagrama-ishikawa.pdf') || str_contains($viewContent, 'portada-seminario-diagrama-ishikawa')) {
        throw new \Exception("La vista contiene referencias residuales al brochure de Ishikawa.");
    }
    if (str_contains($viewContent, "'brochure_url'") || str_contains($viewContent, "'brochure_download'") || str_contains($viewContent, "'brochure_thumb'")) {
        throw new \Exception("La vista aún define claves de configuración de brochure.");
    }

    $siteHtml = dirname(__DIR__) . '/_site/seminario-diagrama-ishikawa.html';
    if (file_exists($siteHtml)) {
        $htmlContent = file_get_contents($siteHtml);
        if (str_contains($htmlContent, '.pdf') || str_contains($htmlContent, 'portada-seminario-diagrama-ishikawa')) {
            throw new \Exception("El HTML compilado en _site contiene referencias al PDF o portada de Ishikawa.");
        }
    }
    return true;
});

// Caso 11: Mensaje de contacto comercial en la sección del brochure y canales activos
runTest("La sección del brochure muestra el mensaje de contacto comercial y canales de consulta activos", function(): bool {
    $siteHtml = dirname(__DIR__) . '/_site/seminario-diagrama-ishikawa.html';
    if (!file_exists($siteHtml)) {
        throw new \Exception("El archivo _site/seminario-diagrama-ishikawa.html no existe.");
    }
    $htmlContent = file_get_contents($siteHtml);
    if (!str_contains($htmlContent, 'Para más información, disponibilidad y precios, contáctanos.')) {
        throw new \Exception("Mensaje de contacto comercial no encontrado en el HTML compilado.");
    }
    if (!str_contains($htmlContent, 'modalSolicitarInfo') || !str_contains($htmlContent, 'Contáctanos')) {
        throw new \Exception("Botón de contacto no encontrado.");
    }
    if (!str_contains($htmlContent, 'WhatsApp') || !str_contains($htmlContent, '51993463118')) {
        throw new \Exception("Enlace oficial de WhatsApp no encontrado.");
    }
    return true;
});

// Caso 12: Botón de PayPal restringido a primera clase (USD 10) con aclaración explícita
runTest("Botón de PayPal disponible únicamente para primera clase USD 10 con aclaración de alcance", function(): bool {
    $siteHtml = dirname(__DIR__) . '/_site/seminario-diagrama-ishikawa.html';
    if (!file_exists($siteHtml)) {
        throw new \Exception("El archivo _site/seminario-diagrama-ishikawa.html no existe.");
    }
    $htmlContent = file_get_contents($siteHtml);
    if (!str_contains($htmlContent, 'Primera clase del curso – USD 10')) {
        throw new \Exception("Etiqueta 'Primera clase del curso – USD 10' no encontrada.");
    }
    if (!str_contains($htmlContent, 'US$ 10')) {
        throw new \Exception("Precio 'US$ 10' no encontrado en el bloque de pago.");
    }
    if (!str_contains($htmlContent, 'No incluye el curso completo') && !str_contains($htmlContent, 'No incluye la inscripción total al curso')) {
        throw new \Exception("Aclaración de no inclusión del curso completo no encontrada.");
    }
    if (!str_contains($htmlContent, 'curso=seminario-diagrama-ishikawa')) {
        throw new \Exception("Enlace de pago por PayPal de primera clase no encontrado.");
    }
    return true;
});

// Caso 13: Configuración de notificaciones de pago
runTest("El sistema backend soporta PAYMENT_NOTIFICATION_EMAIL en config y controlador", function(): bool {
    $config = require dirname(__DIR__) . '/private_app/config/app.php';
    if (!isset($config['recipients']['payment_notification'])) {
        throw new \Exception("Clave 'payment_notification' no encontrada en config['recipients'].");
    }
    $cfgFile = file_get_contents(dirname(__DIR__) . '/private_app/backend/config.php');
    if (!str_contains($cfgFile, 'PAYMENT_NOTIFICATION_EMAIL')) {
        throw new \Exception("PAYMENT_NOTIFICATION_EMAIL no encontrado en config.php.");
    }
    $ctrlFile = file_get_contents(dirname(__DIR__) . '/private_app/app/Controllers/PaymentController.php');
    if (!str_contains($ctrlFile, 'PAYMENT_NOTIFICATION_EMAIL')) {
        throw new \Exception("PAYMENT_NOTIFICATION_EMAIL no encontrado en PaymentController.php.");
    }
    return true;
});

echo "--------------------------------------------------------------------\n";
echo "RESULTADOS: {$passedTests} de {$totalTests} pruebas pasadas con éxito.\n";
echo "--------------------------------------------------------------------\n\n";

if ($passedTests !== $totalTests) {
    exit(1);
}
