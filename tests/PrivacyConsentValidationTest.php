<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Test Suite Automatizado: Validación de Consentimiento de Privacidad en Formularios
 * Archivo: tests/PrivacyConsentValidationTest.php
 *
 * Cubre los 14 puntos obligatorios de la FASE 3B:
 * 1. Contacto contiene casilla obligatoria con texto oficial, enlace a /terminos-y-condiciones#clausula-6, target="_blank", rel="noopener noreferrer", name="privacidad", value="1".
 * 2. Modal contiene casilla obligatoria idéntica.
 * 3. Registro a primera clase contiene casilla obligatoria idéntica y feedback de error.
 * 4. In-House contiene solo una casilla consistente.
 * 5. Los 4 formularios comerciales tienen id único y label for correspondiente.
 * 6. send-contact.php rechaza envíos sin privacidad con HTTP 422 y mensaje exacto.
 * 7. send-contact.php no inserta en BD ni fallback ni envía correo si falta privacidad.
 * 8. PaymentController rechaza registro a primera clase sin privacidad.
 * 9. El Libro de Reclamaciones muestra la leyenda informativa oficial y enlace ARCO.
 * 10. El Libro de Reclamaciones no exige checkbox de privacidad ni en vista ni en backend.
 * 11. script.js valida las casillas comerciales, enfoca el control y no bloquea el Libro.
 * 12. No existen casillas premarcadas en ningún formulario.
 * 13. El campo Empresa continúa siendo opcional en Contacto y modal.
 * 14. El flujo PayPal.Me mantiene pending_manual_verification.
 */

declare(strict_types=1);

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
echo "EJECUTANDO SUITE DE PRUEBAS: CONSENTIMIENTO DE PRIVACIDAD EN FORMULARIOS\n";
echo "====================================================================\n\n";

$baseDir = dirname(__DIR__);
$contactoViewPath = $baseDir . '/private_app/app/Views/pages/contacto.php';
$infoModalPath = $baseDir . '/private_app/app/Views/partials/info_modal.php';
$registroViewPath = $baseDir . '/private_app/app/Views/pages/registro-primera-clase.php';
$inhouseViewPath = $baseDir . '/private_app/app/Views/pages/in-house.php';
$libroViewPath = $baseDir . '/private_app/app/Views/pages/libro-de-reclamaciones.php';
$scriptJsPath = $baseDir . '/public_html/script.js';
$stylesCssPath = $baseDir . '/public_html/styles.css';
$sendContactPath = $baseDir . '/private_app/backend/send-contact.php';
$submitClaimPath = $baseDir . '/private_app/backend/submit-claim.php';
$paymentControllerPath = $baseDir . '/private_app/app/Controllers/PaymentController.php';

$contactoView = file_get_contents($contactoViewPath);
$infoModalView = file_get_contents($infoModalPath);
$registroView = file_get_contents($registroViewPath);
$inhouseView = file_get_contents($inhouseViewPath);
$libroView = file_get_contents($libroViewPath);
$scriptJs = file_get_contents($scriptJsPath);
$stylesCss = file_get_contents($stylesCssPath);
$sendContact = file_get_contents($sendContactPath);
$submitClaim = file_get_contents($submitClaimPath);
$paymentController = file_get_contents($paymentControllerPath);

// Helper para limpiar tags PHP en vistas al inspeccionar estructura de tags HTML
function cleanPhpTags(string $html): string {
    return preg_replace('/<\?(=|php).*?\?>/s', '', $html);
}

$expectedLegalUrl = '/terminos-y-condiciones#clausula-6';
$expectedOfficialText = 'Acepto el tratamiento de mis datos personales para la atención de mi solicitud, conforme a la';
$expectedLegalAnchorText = 'Política de Privacidad y Protección de Datos';

// 1. Contacto contiene casilla obligatoria con texto, enlace a /terminos-y-condiciones#clausula-6, target _blank, noopener noreferrer, name privacidad, value 1
runTest("1. Contacto contiene casilla obligatoria con texto oficial y enlace a clausula-6", function() use ($contactoView, $expectedLegalUrl, $expectedOfficialText): bool {
    $clean = cleanPhpTags($contactoView);
    if (!preg_match('/<input[^>]+name="privacidad"[^>]+value="1"[^>]*required/i', $clean) &&
        !preg_match('/<input[^>]+required[^>]+name="privacidad"[^>]+value="1"/i', $clean)) {
        throw new \RuntimeException("contacto.php no tiene input con name='privacidad', value='1' y required.");
    }
    if (!str_contains($contactoView, $expectedOfficialText)) {
        throw new \RuntimeException("contacto.php no contiene la redacción autorizada de consentimiento.");
    }
    if (!str_contains($contactoView, 'href="' . $expectedLegalUrl . '"')) {
        throw new \RuntimeException("contacto.php no enlaza a {$expectedLegalUrl}.");
    }
    if (!preg_match('/<a[^>]+href="\/terminos-y-condiciones#clausula-6"[^>]+target="_blank"[^>]+rel="noopener noreferrer"/i', $contactoView) &&
        !preg_match('/<a[^>]+href="\/terminos-y-condiciones#clausula-6"[^>]+rel="noopener noreferrer"[^>]+target="_blank"/i', $contactoView)) {
        throw new \RuntimeException("El enlace legal en contacto.php debe tener target='_blank' y rel='noopener noreferrer'.");
    }
    return true;
});

// 2. Modal contiene casilla obligatoria idéntica
runTest("2. Modal de información contiene casilla obligatoria idéntica", function() use ($infoModalView, $expectedLegalUrl, $expectedOfficialText): bool {
    $clean = cleanPhpTags($infoModalView);
    if (!preg_match('/<input[^>]+name="privacidad"[^>]+value="1"[^>]*required/i', $clean) &&
        !preg_match('/<input[^>]+required[^>]+name="privacidad"[^>]+value="1"/i', $clean)) {
        throw new \RuntimeException("info_modal.php no tiene input con name='privacidad', value='1' y required.");
    }
    if (!str_contains($infoModalView, $expectedOfficialText)) {
        throw new \RuntimeException("info_modal.php no contiene la redacción autorizada de consentimiento.");
    }
    if (!str_contains($infoModalView, 'href="' . $expectedLegalUrl . '"')) {
        throw new \RuntimeException("info_modal.php no enlaza a {$expectedLegalUrl}.");
    }
    if (!str_contains($infoModalView, 'target="_blank"') || !str_contains($infoModalView, 'rel="noopener noreferrer"')) {
        throw new \RuntimeException("info_modal.php no contiene target='_blank' y rel='noopener noreferrer'.");
    }
    return true;
});

// 3. Registro contiene casilla obligatoria idéntica
runTest("3. Registro a primera clase contiene casilla obligatoria idéntica", function() use ($registroView, $expectedLegalUrl, $expectedOfficialText): bool {
    $clean = cleanPhpTags($registroView);
    if (!preg_match('/<input[^>]+name="privacidad"[^>]+value="1"[^>]*required/i', $clean) &&
        !preg_match('/<input[^>]+required[^>]+name="privacidad"[^>]+value="1"/i', $clean)) {
        throw new \RuntimeException("registro-primera-clase.php no tiene input con name='privacidad', value='1' y required.");
    }
    if (!str_contains($registroView, $expectedOfficialText)) {
        throw new \RuntimeException("registro-primera-clase.php no contiene el texto de consentimiento.");
    }
    if (!str_contains($registroView, 'href="' . $expectedLegalUrl . '"')) {
        throw new \RuntimeException("registro-primera-clase.php no enlaza a {$expectedLegalUrl}.");
    }
    if (!str_contains($registroView, 'target="_blank"') || !str_contains($registroView, 'rel="noopener noreferrer"')) {
        throw new \RuntimeException("registro-primera-clase.php no contiene target='_blank' y rel='noopener noreferrer'.");
    }
    return true;
});

// 4. In-House contiene solo una casilla consistente
runTest("4. In-House contiene exactamente una sola casilla consistente", function() use ($inhouseView, $expectedLegalUrl): bool {
    $clean = cleanPhpTags($inhouseView);
    $count = preg_match_all('/<input[^>]+name="privacidad"/i', $clean, $matches);
    if ($count !== 1) {
        throw new \RuntimeException("in-house.php debe tener exactamente 1 casilla con name='privacidad', se encontraron {$count}.");
    }
    if (!preg_match('/<input[^>]+name="privacidad"[^>]+value="1"/i', $clean) &&
        !preg_match('/<input[^>]+value="1"[^>]+name="privacidad"/i', $clean)) {
        throw new \RuntimeException("in-house.php no tiene value='1' en el input de privacidad.");
    }
    if (!str_contains($inhouseView, 'href="' . $expectedLegalUrl . '"')) {
        throw new \RuntimeException("in-house.php no enlaza a {$expectedLegalUrl}.");
    }
    if (!str_contains($inhouseView, 'target="_blank"') || !str_contains($inhouseView, 'rel="noopener noreferrer"')) {
        throw new \RuntimeException("in-house.php no contiene target='_blank' y rel='noopener noreferrer'.");
    }
    return true;
});

// 5. Los 4 formularios comerciales tienen id único y label for correspondiente
runTest("5. Los 4 formularios comerciales tienen ID único y label for correspondiente", function() use ($contactoView, $infoModalView, $registroView, $inhouseView): bool {
    $ids = [];

    // Contacto
    $cleanContacto = cleanPhpTags($contactoView);
    if (!preg_match('/<input[^>]+id="([^"]+)"[^>]+name="privacidad"/i', $cleanContacto, $m) &&
        !preg_match('/<input[^>]+name="privacidad"[^>]+id="([^"]+)"/i', $cleanContacto, $m)) {
        throw new \RuntimeException("contacto.php no tiene ID en la casilla de privacidad.");
    }
    $ids['contacto'] = $m[1];
    if (!str_contains($contactoView, 'for="' . $ids['contacto'] . '"')) {
        throw new \RuntimeException("contacto.php no tiene <label for='{$ids['contacto']}'>.");
    }

    // Modal
    $cleanModal = cleanPhpTags($infoModalView);
    if (!preg_match('/<input[^>]+id="([^"]+)"[^>]+name="privacidad"/i', $cleanModal, $m) &&
        !preg_match('/<input[^>]+name="privacidad"[^>]+id="([^"]+)"/i', $cleanModal, $m)) {
        throw new \RuntimeException("info_modal.php no tiene ID en la casilla de privacidad.");
    }
    $ids['modal'] = $m[1];
    if (!str_contains($infoModalView, 'for="' . $ids['modal'] . '"')) {
        throw new \RuntimeException("info_modal.php no tiene <label for='{$ids['modal']}'>.");
    }

    // Registro
    $cleanRegistro = cleanPhpTags($registroView);
    if (!preg_match('/<input[^>]+id="([^"]+)"[^>]+name="privacidad"/i', $cleanRegistro, $m) &&
        !preg_match('/<input[^>]+name="privacidad"[^>]+id="([^"]+)"/i', $cleanRegistro, $m)) {
        throw new \RuntimeException("registro-primera-clase.php no tiene ID en la casilla de privacidad.");
    }
    $ids['registro'] = $m[1];
    if (!str_contains($registroView, 'for="' . $ids['registro'] . '"')) {
        throw new \RuntimeException("registro-primera-clase.php no tiene <label for='{$ids['registro']}'>.");
    }

    // In-House
    $cleanInhouse = cleanPhpTags($inhouseView);
    if (!preg_match('/<input[^>]+id="([^"]+)"[^>]+name="privacidad"/i', $cleanInhouse, $m) &&
        !preg_match('/<input[^>]+name="privacidad"[^>]+id="([^"]+)"/i', $cleanInhouse, $m)) {
        throw new \RuntimeException("in-house.php no tiene ID en la casilla de privacidad.");
    }
    $ids['inhouse'] = $m[1];
    if (!str_contains($inhouseView, 'for="' . $ids['inhouse'] . '"')) {
        throw new \RuntimeException("in-house.php no tiene <label for='{$ids['inhouse']}'>.");
    }

    // Verificar unicidad
    $uniqueIds = array_unique(array_values($ids));
    if (count($uniqueIds) !== 4) {
        throw new \RuntimeException("Los IDs de privacidad no son únicos: " . implode(', ', $ids));
    }

    return true;
});

// 6. send-contact.php rechaza envíos sin privacidad con HTTP 422 y mensaje exacto
runTest("6. send-contact.php rechaza envíos sin privacidad con HTTP 422 y mensaje exacto", function() use ($sendContact): bool {
    if (!str_contains($sendContact, '$inputData[\'privacidad\']')) {
        throw new \RuntimeException("send-contact.php no evalúa \$inputData['privacidad'].");
    }
    if (!str_contains($sendContact, 'Debe aceptar la política de protección de datos personales para continuar.')) {
        throw new \RuntimeException("send-contact.php no contiene el mensaje de error de privacidad exacto.");
    }
    if (!preg_match('/Security::jsonError\([^,]+,\s*422/i', $sendContact)) {
        throw new \RuntimeException("send-contact.php no emite HTTP 422 en la validación de errores.");
    }
    return true;
});

// 7. send-contact.php no inserta en BD ni fallback ni envía correo si falta privacidad
runTest("7. send-contact.php no inserta en BD ni fallback ni envía correo si falta privacidad", function() use ($sendContact): bool {
    $privacyPos = strpos($sendContact, '$inputData[\'privacidad\']');
    $errorExitPos = strpos($sendContact, 'Security::jsonError', $privacyPos);
    $dbPos = strpos($sendContact, 'Database::saveContact');
    $queuePos = strpos($sendContact, 'FallbackQueue::save');
    $mailerDispatchPos = strpos($sendContact, 'sendNotification');

    if ($privacyPos === false || $errorExitPos === false) {
        throw new \RuntimeException("Validación de privacidad o Security::jsonError no encontrados.");
    }
    if ($dbPos !== false && $errorExitPos > $dbPos) {
        throw new \RuntimeException("Security::jsonError se ejecuta después de Database::saveContact.");
    }
    if ($queuePos !== false && $errorExitPos > $queuePos) {
        throw new \RuntimeException("Security::jsonError se ejecuta después de FallbackQueue::save.");
    }
    if ($mailerDispatchPos !== false && $errorExitPos > $mailerDispatchPos) {
        throw new \RuntimeException("Security::jsonError se ejecuta después de enviar notificación por correo.");
    }
    return true;
});

// 8. PaymentController rechaza registro sin privacidad
runTest("8. PaymentController rechaza registro a primera clase sin privacidad", function() use ($paymentController): bool {
    if (!str_contains($paymentController, '$this->getPost(\'privacidad\'')) {
        throw new \RuntimeException("PaymentController no valida el campo privacidad.");
    }
    if (!str_contains($paymentController, '$errors[\'privacidad\']')) {
        throw new \RuntimeException("PaymentController no asigna \$errors['privacidad'].");
    }
    if (!str_contains($paymentController, 'Debe aceptar la política de protección de datos personales para continuar.')) {
        throw new \RuntimeException("PaymentController no contiene el mensaje exacto de privacidad.");
    }
    $privacyPos = strpos($paymentController, '$this->getPost(\'privacidad\'');
    $orderPos = strpos($paymentController, '$registrationData = [', $privacyPos);
    if ($privacyPos === false || $orderPos === false || $privacyPos > $orderPos) {
        throw new \RuntimeException("La validación de privacidad debe ocurrir antes de armar registrationData.");
    }
    return true;
});

// 9. El Libro de Reclamaciones muestra la leyenda informativa
runTest("9. El Libro de Reclamaciones muestra la leyenda informativa y enlace ARCO", function() use ($libroView, $expectedLegalUrl): bool {
    $expectedLegend = 'Los datos proporcionados serán tratados para la atención y gestión de su reclamo o queja. Puede consultar la información sobre';
    $expectedAnchor = 'protección de datos personales y el ejercicio de sus derechos ARCO';
    if (!str_contains($libroView, $expectedLegend)) {
        throw new \RuntimeException("libro-de-reclamaciones.php no contiene la leyenda informativa oficial.");
    }
    if (!str_contains($libroView, $expectedAnchor)) {
        throw new \RuntimeException("libro-de-reclamaciones.php no contiene el texto de enlace ARCO.");
    }
    if (!str_contains($libroView, 'href="' . $expectedLegalUrl . '"')) {
        throw new \RuntimeException("libro-de-reclamaciones.php no enlaza a {$expectedLegalUrl}.");
    }
    if (!str_contains($libroView, 'target="_blank"') || !str_contains($libroView, 'rel="noopener noreferrer"')) {
        throw new \RuntimeException("El enlace en Libro de Reclamaciones debe tener target='_blank' y rel='noopener noreferrer'.");
    }
    return true;
});

// 10. El Libro de Reclamaciones no exige checkbox de privacidad
runTest("10. El Libro de Reclamaciones no exige checkbox de privacidad ni en vista ni en backend", function() use ($libroView, $submitClaim): bool {
    if (preg_match('/<input[^>]+name="privacidad"/i', $libroView)) {
        throw new \RuntimeException("libro-de-reclamaciones.php no debe tener casilla con name='privacidad'.");
    }
    if (str_contains($submitClaim, 'privacidad')) {
        throw new \RuntimeException("submit-claim.php no debe exigir validación del campo 'privacidad'.");
    }
    return true;
});

// 11. script.js valida las casillas comerciales y enfoca el control
runTest("11. script.js valida las casillas comerciales y enfoca el control", function() use ($scriptJs): bool {
    if (!str_contains($scriptJs, 'contactPrivacidad') || !str_contains($scriptJs, 'contactPrivacidad.focus()')) {
        throw new \RuntimeException("script.js no valida ni enfoca contactPrivacidad.");
    }
    if (!str_contains($scriptJs, 'inhousePrivacy') || !str_contains($scriptJs, 'inhousePrivacy.focus()')) {
        throw new \RuntimeException("script.js no valida ni enfoca inhousePrivacy.");
    }
    if (!str_contains($scriptJs, 'modalPrivacidad') || !str_contains($scriptJs, 'modalPrivacidad.focus()')) {
        throw new \RuntimeException("script.js no valida ni enfoca modalPrivacidad.");
    }
    if (!str_contains($scriptJs, 'Debe aceptar la política de protección de datos personales para continuar.')) {
        throw new \RuntimeException("script.js no muestra el mensaje oficial de privacidad.");
    }
    return true;
});

// 12. No existen casillas premarcadas
runTest("12. No existen casillas de consentimiento premarcadas en ningún formulario", function() use ($contactoView, $infoModalView, $registroView, $inhouseView): bool {
    $views = [
        'contacto.php' => cleanPhpTags($contactoView),
        'info_modal.php' => cleanPhpTags($infoModalView),
        'registro-primera-clase.php' => cleanPhpTags($registroView),
        'in-house.php' => cleanPhpTags($inhouseView),
    ];
    foreach ($views as $name => $html) {
        if (preg_match('/<input[^>]+name="privacidad"[^>]*\schecked[\s>]/i', $html)) {
            throw new \RuntimeException("La casilla de privacidad en {$name} viene premarcada (checked).");
        }
    }
    return true;
});

// 13. Empresa continúa siendo opcional en Contacto y modal
runTest("13. Empresa continúa siendo opcional en Contacto y modal", function() use ($contactoView, $infoModalView): bool {
    $cleanContacto = cleanPhpTags($contactoView);
    $cleanModal = cleanPhpTags($infoModalView);
    if (preg_match('/<input[^>]+id="contactEmpresa"[^>]*\srequired[\s>]/i', $cleanContacto)) {
        throw new \RuntimeException("contactEmpresa tiene required en contacto.php.");
    }
    if (preg_match('/<input[^>]+id="modalEmpresa"[^>]*\srequired[\s>]/i', $cleanModal)) {
        throw new \RuntimeException("modalEmpresa tiene required en info_modal.php.");
    }
    return true;
});

// 14. El flujo PayPal.Me mantiene pending_manual_verification
runTest("14. El flujo PayPal.Me mantiene pending_manual_verification", function() use ($paymentController): bool {
    if (!str_contains($paymentController, 'pending_manual_verification')) {
        throw new \RuntimeException("PaymentController no contiene el estado 'pending_manual_verification'.");
    }
    return true;
});

echo "\n====================================================================\n";
echo "RESULTADOS: {$passedTests} / {$totalTests} PRUEBAS PASADAS\n";
echo "====================================================================\n\n";

if ($passedTests !== $totalTests) {
    exit(1);
}
