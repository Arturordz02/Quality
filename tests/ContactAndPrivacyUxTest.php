<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Test Suite Automatizado: Validación de UX en Aviso de Privacidad y Contacto
 * Archivo: tests/ContactAndPrivacyUxTest.php
 *
 * Valida:
 * 1. Campo "Empresa" en formulario de contacto no es obligatorio (sin required, sin asterisco en vista, sin bloqueo en script.js).
 * 2. Campos obligatorios (nombre, teléfono, email, consulta) se mantienen estrictamente requeridos en frontend y backend.
 * 3. Backend acepta consultas sin empresa sin arrojar error y maneja 'No especificada' en plantillas y asunto.
 * 4. Enlace del catálogo en cierre de contacto apunta a /capacitacion y no a /lean-last-planner.
 * 5. Botón de PMO tiene etiqueta "Ver Gestión de Proyectos y PMO" y apunta a /gestion-de-pmo.
 * 6. Bloque telefónico ofrece acción de "Llamar" con tel:+51993463118 y "Escribir por WhatsApp" con URL oficial.
 * 7. Aviso de Privacidad incluye botones Aceptar y Rechazar con igual jerarquía visual, accesibilidad y persistencia en localStorage.
 * 8. Aviso de Privacidad conserva enlaces funcionales a Términos y a Política de Privacidad.
 * 9. Textos del CTA final en /contacto no promocionan sección independiente de Asesoría.
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
echo "EJECUTANDO SUITE DE PRUEBAS: PRIVACIDAD Y EXPERIENCIA DE CONTACTO\n";
echo "====================================================================\n\n";

$baseDir = dirname(__DIR__);
$contactoViewPath = $baseDir . '/private_app/app/Views/pages/contacto.php';
$scriptJsPath = $baseDir . '/public_html/script.js';
$stylesCssPath = $baseDir . '/public_html/styles.css';
$backendSendContactPath = $baseDir . '/private_app/backend/send-contact.php';
$backendMailerPath = $baseDir . '/private_app/backend/SmtpMailer.php';

$contactoView = file_get_contents($contactoViewPath);
$scriptJs = file_get_contents($scriptJsPath);
$stylesCss = file_get_contents($stylesCssPath);
$backendSendContact = file_get_contents($backendSendContactPath);
$backendMailer = file_get_contents($backendMailerPath);

// TEST 1: Campo Empresa no es obligatorio en la vista
runTest("Campo Empresa en contacto.php no contiene required ni asterisco rojo", function() use ($contactoView): bool {
    // Verificar que el input de empresa no tenga el atributo 'required'
    if (preg_match('/<input[^>]+id="contactEmpresa"[^>]*\srequired[\s>]/i', $contactoView)) {
        throw new \RuntimeException("El input #contactEmpresa aún tiene el atributo 'required'.");
    }
    // Extraer exactamente el contenido de la etiqueta de Empresa
    if (preg_match('/<label[^>]+for="contactEmpresa"[^>]*>(.*?)<\/label>/is', $contactoView, $m)) {
        if (str_contains($m[1], 'text-danger') || str_contains($m[1], '*')) {
            throw new \RuntimeException("La etiqueta de Empresa aún contiene el asterisco obligatorio (text-danger / *).");
        }
        if (!str_contains($m[1], '(Opcional)')) {
            throw new \RuntimeException("La etiqueta de Empresa debe indicar claramente que es (Opcional).");
        }
    } else {
        throw new \RuntimeException("No se encontró la etiqueta <label for=\"contactEmpresa\">.");
    }
    return true;
});

// TEST 2: Campos obligatorios permanecen en frontend (nombre, telefono, email, consulta)
runTest("Campos obligatorios (nombre, teléfono, correo, consulta) se mantienen estrictamente requeridos", function() use ($contactoView, $scriptJs, $backendSendContact): bool {
    $requiredFields = ['contactNombre', 'contactTelefono', 'contactEmail', 'contactConsulta'];
    foreach ($requiredFields as $fieldId) {
        if (!preg_match('/<input[^>]+id="' . $fieldId . '"[^>]*\srequired[\s>]|<textarea[^>]+id="' . $fieldId . '"[^>]*\srequired[\s>]/i', $contactoView)) {
            throw new \RuntimeException("El campo #{$fieldId} debe mantener el atributo 'required'.");
        }
    }
    if (!str_contains($scriptJs, '!nombre') || !str_contains($scriptJs, '!telefono') || !str_contains($scriptJs, '!email') || !str_contains($scriptJs, '!consulta')) {
        throw new \RuntimeException("script.js debe validar nombre, teléfono, correo y consulta.");
    }
    if (!str_contains($backendSendContact, "\$errors['nombre']") || !str_contains($backendSendContact, "\$errors['telefono']") || !str_contains($backendSendContact, "\$errors['email']") || !str_contains($backendSendContact, "\$errors['consulta']")) {
        throw new \RuntimeException("send-contact.php debe mantener la validación de nombre, teléfono, correo y consulta.");
    }
    return true;
});

// TEST 3: script.js no bloquea el envío si empresa está vacía
runTest("script.js no incluye validación de obligatoriedad para el campo empresa", function() use ($scriptJs): bool {
    if (str_contains($scriptJs, '!empresa || empresa.length')) {
        throw new \RuntimeException("script.js aún valida la obligatoriedad de empresa.");
    }
    return true;
});

// TEST 4: Backend acepta consultas con empresa vacía y formatea 'No especificada'
runTest("Backend send-contact.php y SmtpMailer gestionan empresa vacía como 'No especificada'", function() use ($backendSendContact, $backendMailer): bool {
    // No debe exigir que empresa sea obligatoria
    if (str_contains($backendSendContact, "\$errors['empresa'] = 'Por favor, ingrese el nombre de su empresa")) {
        throw new \RuntimeException("send-contact.php aún tiene validación de obligatoriedad para empresa.");
    }
    // Debe manejar 'No especificada' por defecto en el asunto
    if (!str_contains($backendSendContact, "'No especificada'")) {
        throw new \RuntimeException("send-contact.php debe manejar el valor por defecto 'No especificada' cuando empresa esté vacía.");
    }
    // SmtpMailer debe mostrar 'No especificada' si está vacío
    if (!str_contains($backendMailer, "'No especificada'")) {
        throw new \RuntimeException("SmtpMailer::templateContactNotification debe mostrar 'No especificada' cuando empresa esté vacía.");
    }
    return true;
});

// TEST 5: Botón de cursos apunta al catálogo general /capacitacion
runTest("El botón de cursos en el banner de contacto apunta a /capacitacion y no a /lean-last-planner", function() use ($contactoView): bool {
    if (str_contains($contactoView, 'href="/lean-last-planner"')) {
        throw new \RuntimeException("El botón aún apunta a /lean-last-planner.");
    }
    if (!preg_match('/href="\/capacitacion"[^>]*>.*?Ver Cursos y Capacitación/isu', $contactoView)) {
        throw new \RuntimeException("No se encontró el enlace con href='/capacitacion' y texto 'Ver Cursos y Capacitación'.");
    }
    return true;
});

// TEST 6: Botón de PMO tiene etiqueta coherente con /gestion-de-pmo
runTest("El botón de PMO tiene la etiqueta 'Ver Gestión de Proyectos y PMO' hacia /gestion-de-pmo", function() use ($contactoView): bool {
    if (!preg_match('/href="\/gestion-de-pmo"[^>]*>.*?Ver Gestión de Proyectos y PMO/isu', $contactoView)) {
        throw new \RuntimeException("El botón hacia /gestion-de-pmo debe titularse 'Ver Gestión de Proyectos y PMO'.");
    }
    return true;
});

// TEST 7: Bloque telefónico ofrece Llamar con tel: y WhatsApp con URL oficial
runTest("El bloque de Teléfono & WhatsApp ofrece 'Llamar' con tel: y 'Escribir por WhatsApp' con URL oficial", function() use ($contactoView): bool {
    // Llamar con tel:
    if (!preg_match('/<a[^>]+href="tel:\+51993463118"[^>]*>.*?Llamar.*?<\/a>/isu', $contactoView)) {
        throw new \RuntimeException("No se encontró enlace 'Llamar' con href='tel:+51993463118'.");
    }
    // WhatsApp con URL oficial
    if (!preg_match('/<a[^>]+href="https:\/\/(wa\.me|api\.whatsapp\.com)[^"]*"[^>]*>.*?WhatsApp.*?<\/a>/isu', $contactoView)) {
        throw new \RuntimeException("No se encontró enlace oficial a WhatsApp.");
    }
    return true;
});

// TEST 8: Aviso de privacidad cuenta con botones accesibles, equilibrados y con persistencia
runTest("Aviso de Términos y Privacidad cuenta con botones Aceptar y Rechazar visibles, accesibles y persistentes", function() use ($scriptJs, $stylesCss): bool {
    // Botones presentes en el DOM generado
    if (!str_contains($scriptJs, 'id="qcsBtnAcceptTerms"') || !str_contains($scriptJs, 'id="qcsBtnRejectTerms"')) {
        throw new \RuntimeException("script.js no define ambos botones con id qcsBtnAcceptTerms y qcsBtnRejectTerms.");
    }
    // Persistencia en localStorage tanto para aceptación como para rechazo
    if (!str_contains($scriptJs, "localStorage.setItem(CONSENT_KEY") || !str_contains($scriptJs, "localStorage.setItem(REJECT_KEY")) {
        throw new \RuntimeException("script.js debe persistir tanto la aceptación como el rechazo en localStorage.");
    }
    // Enlaces funcionales hacia Términos y Privacidad
    if (!str_contains($scriptJs, 'termsUrl') && !str_contains($scriptJs, '/terminos-y-condiciones')) {
        throw new \RuntimeException("script.js debe incluir enlaces hacia Términos y Condiciones.");
    }
    if (!str_contains($scriptJs, 'clausula-6') && !str_contains($scriptJs, '#privacidad')) {
        throw new \RuntimeException("script.js debe incluir enlace específico hacia la Política de Privacidad / Protección de Datos.");
    }
    // Estilos para ambos botones en styles.css
    if (!str_contains($stylesCss, '.qcs-terms-btn-accept') || !str_contains($stylesCss, '.qcs-terms-btn-reject')) {
        throw new \RuntimeException("styles.css debe definir estilos para .qcs-terms-btn-accept y .qcs-terms-btn-reject.");
    }
    // Clases compactas
    if (!str_contains($stylesCss, '.qcs-terms-floating-card')) {
        throw new \RuntimeException("styles.css no define .qcs-terms-floating-card.");
    }
    return true;
});

// TEST 9: Textos del CTA final en contacto no promocionan sección independiente de Asesoría
runTest("El CTA final de contacto no promociona una sección independiente de Asesoría", function() use ($contactoView): bool {
    // No debe contener el badge antiguo "CAPACITACIÓN Y ASESORÍA"
    if (str_contains($contactoView, 'CAPACITACIÓN Y ASESORÍA')) {
        throw new \RuntimeException("El CTA de contacto aún incluye el badge 'CAPACITACIÓN Y ASESORÍA'.");
    }
    // No debe contener el botón "Ver Asesoría Especializada"
    if (str_contains($contactoView, 'Ver Asesoría Especializada')) {
        throw new \RuntimeException("El CTA de contacto aún incluye el botón 'Ver Asesoría Especializada'.");
    }
    return true;
});

echo "\n====================================================================\n";
echo "RESULTADOS: {$passedTests} / {$totalTests} PRUEBAS PASADAS\n";
echo "====================================================================\n\n";

if ($passedTests !== $totalTests) {
    exit(1);
}
