<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Test Suite: Tarea 9 - Correccion de Problemas Frontend Confirmados
 */

declare(strict_types=1);

$testsPassed = 0;
$testsTotal = 0;

function assertTest(string $desc, bool $condition, string $detail = ''): void {
    global $testsPassed, $testsTotal;
    $testsTotal++;
    if ($condition) {
        $testsPassed++;
        echo "  [PASS] {$desc}\n";
    } else {
        echo "  [FAIL] {$desc} - {$detail}\n";
    }
}

echo "======================================================\n";
echo "TEST SUITE: TAREA 9 - CORRECCION FRONTEND             \n";
echo "======================================================\n\n";

$rootDir = dirname(__DIR__, 2);

// 1. CTAs que apuntaban a index.html#contacto
echo "--- 1. Validacion de CTAs Corregidos a contacto.html ---\n";
$targetFiles = [
    'gestion-de-pmo.html',
    'gestion-de-riesgos.html',
    'headhunting.html',
    'investigacion.html',
    'lego-serious-play.html',
    'sindrome-del-90.html'
];

foreach ($targetFiles as $file) {
    $filePath = $rootDir . '/' . $file;
    $content = file_get_contents($filePath);
    assertTest("{$file}: No contiene enlaces rotos a index.html#contacto", strpos($content, 'index.html#contacto') === false);
    assertTest("{$file}: El CTA principal apunta correctamente a contacto.html", strpos($content, 'href="contacto.html"') !== false);
}

// Verificar que ningun HTML del proyecto contenga index.html#contacto
$allHtmlFiles = glob($rootDir . '/*.html');
$foundBrokenLinks = [];
foreach ($allHtmlFiles as $htmlFile) {
    $c = file_get_contents($htmlFile);
    if (strpos($c, 'index.html#contacto') !== false) {
        $foundBrokenLinks[] = basename($htmlFile);
    }
}
assertTest("Ningun archivo HTML del proyecto contiene 'index.html#contacto'", empty($foundBrokenLinks), implode(', ', $foundBrokenLinks));

// 2. Revision de placeholder en riesgo-del-plazo.html
echo "\n--- 2. Validacion de Imagen en riesgo-del-plazo.html ---\n";
$riesgoPlazoContent = file_get_contents($rootDir . '/riesgo-del-plazo.html');
assertTest("riesgo-del-plazo.html NO contiene URL placeholder externa", strpos($riesgoPlazoContent, 'via.placeholder.com') === false);
assertTest("riesgo-del-plazo.html referencia el asset existente img/s901.png", strpos($riesgoPlazoContent, 'src="img/s901.png"') !== false);
assertTest("El asset img/s901.png existe fisicamente en disco", file_exists($rootDir . '/img/s901.png') && filesize($rootDir . '/img/s901.png') > 0);

// 3. Revision del widget de WhatsApp
echo "\n--- 3. Verificacion de Integridad de Datos en WhatsApp Widget ---\n";
$scriptContent = file_get_contents($rootDir . '/script.js');
assertTest("script.js conserva el numero original de Ecuador (+57 315 227 6029)", strpos($scriptContent, '+57 315 227 6029') !== false);
assertTest("script.js contiene el link de WhatsApp con el numero registrado", strpos($scriptContent, '573152276029') !== false);

// 4. Revision responsive de Terminos y Condiciones y WhatsApp
echo "\n--- 4. Validacion Responsive (320px, 375px, 390px, 430px) ---\n";
$stylesContent = file_get_contents($rootDir . '/styles.css');
assertTest("styles.css define separacion vertical para pantallas moviles (bottom: 78px)", strpos($stylesContent, 'bottom: 78px') !== false);
assertTest("styles.css incluye reglas para pantallas compactas <= 375px", strpos($stylesContent, '@media (max-width: 375px)') !== false);
assertTest("styles.css ajusta el boton de WhatsApp a 48px en <= 375px para evitar superposicion", strpos($stylesContent, 'width: 48px !important') !== false);
assertTest("styles.css otorga z-index prioritario (10005) al menu WhatsApp", strpos($stylesContent, 'z-index: 10005 !important') !== false);
assertTest("Tarjeta de terminos no solapa a WhatsApp con bottom: 15px en moviles", strpos($stylesContent, 'bottom: 78px') !== false && strpos($stylesContent, 'bottom: 68px') !== false);

echo "\n======================================================\n";
echo "RESULTADOS: {$testsPassed} de {$testsTotal} pruebas aprobadas.\n";
echo "======================================================\n";

if ($testsPassed === $testsTotal) {
    echo "\n>>> TODAS LAS PRUEBAS DE LA TAREA 9 PASARON CON EXITO <<<\n";
    exit(0);
} else {
    echo "\n>>> HUBO FALLOS EN LAS PRUEBAS <<<\n";
    exit(1);
}
