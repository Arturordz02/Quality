<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Vista: Pago y Formulario Obligatorio de Registro de Primera Clase (USD 10)
 *
 * Flujo riguroso:
 * 1. Selección y pago oficial de US$ 10.00 en PayPal.
 * 2. Verificación estricta en el servidor (status COMPLETED, monto 10 USD, cuenta receptora, no reutilizado).
 * 3. Habilitación del formulario de registro exclusivamente tras validación del pago.
 * 4. Envío y notificación a comercial@quality-consulting.org.
 */

declare(strict_types=1);

$courseTitle = htmlspecialchars($courseTitle ?? 'Curso Especializado', ENT_QUOTES, 'UTF-8');
$courseSlug  = htmlspecialchars($courseSlug ?? '', ENT_QUOTES, 'UTF-8');
$orderId     = htmlspecialchars($orderId ?? '', ENT_QUOTES, 'UTF-8');
$captureId   = htmlspecialchars($captureId ?? '', ENT_QUOTES, 'UTF-8');
$csrfToken   = htmlspecialchars($csrfToken ?? '', ENT_QUOTES, 'UTF-8');
$hpField     = htmlspecialchars($honeypotField ?? '_qcs_verification_hp', ENT_QUOTES, 'UTF-8');
$paymentError= htmlspecialchars($paymentError ?? '', ENT_QUOTES, 'UTF-8');

$errors = isset($_SESSION['_qcs_form_errors']) ? $_SESSION['_qcs_form_errors'] : [];
$old    = isset($_SESSION['_qcs_form_old']) ? $_SESSION['_qcs_form_old'] : [];
if (isset($_SESSION)) {
    unset($_SESSION['_qcs_form_errors'], $_SESSION['_qcs_form_old']);
}
$isVerifiedInSession = !empty($isVerifiedInSession);
?>

<main class="qcs-register-page bg-dark text-light min-vh-100">
    <div class="container py-3">

        <div class="row justify-content-center">
            <div class="col-12 col-lg-9 col-xl-8">

                <!-- ENCABEZADO PRINCIPAL DE LA PÁGINA (Con espacio superior corregido para el menú fijo) -->
                <div class="card bg-secondary bg-opacity-10 border border-warning border-opacity-50 rounded-4 p-4 mb-4 text-center shadow-lg">
                    <div class="qcs-register-badge-circle bg-warning text-dark">
                        <i class="fab fa-paypal fs-2" aria-hidden="true"></i>
                    </div>
                    <span class="badge bg-warning text-dark px-3 py-2 text-uppercase fw-bold mb-2 align-self-center font-montserrat">
                        Inscripción de Primera Clase
                    </span>
                    <h1 class="h3 font-montserrat fw-bold text-white mb-2">
                        Pago y Registro – Primera Clase
                    </h1>
                    <p class="small text-warning fw-semibold mb-0">
                        <i class="fas fa-info-circle me-1" aria-hidden="true"></i> US$10 únicamente por la primera clase. No incluye el curso completo.
                    </p>
                </div>

                <?php if (!empty($paymentError)): ?>
                <div class="alert alert-danger shadow-sm mb-4 rounded-3 border-danger">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-exclamation-triangle fs-5 me-2 mt-1"></i>
                        <div>
                            <strong>Incidencia de Verificación:</strong><br>
                            <?= $paymentError ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- ALERTA DE COMPATIBILIDAD CON GITHUB PAGES (Generada dinámicamente en frontend) -->
                <div id="githubPagesNotice" class="alert alert-info bg-dark text-info border-info border-opacity-50 rounded-3 p-3 mb-4 d-none">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-server fs-5 me-2 mt-1"></i>
                        <div class="small">
                            <strong>Aviso de Demostración Estática (GitHub Pages):</strong><br>
                            Esta versión estática sirve como vista preliminar y no ejecuta el backend PHP necesario para la verificación automática ni el almacenamiento en base de datos. Para formalizar tu inscripción oficial tras tu pago en PayPal, por favor remite tu comprobante directamente a <strong class="text-white">comercial@quality-consulting.org</strong> o vía WhatsApp al <strong class="text-white">+51 993 463 118</strong>.
                        </div>
                    </div>
                </div>

                <!-- PASO 1: PAGO Y VERIFICACIÓN EN EL SERVIDOR -->
                <div class="card bg-secondary bg-opacity-10 border border-secondary border-opacity-25 rounded-4 p-4 p-md-5 mb-4 shadow-lg">
                    <div class="d-flex align-items-center gap-3 mb-3 pb-2 border-bottom border-secondary border-opacity-25">
                        <span class="badge rounded-circle bg-warning text-dark fs-6 d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">1</span>
                        <div>
                            <h2 class="h5 font-montserrat fw-bold text-white mb-0">Paso 1: Pago Seguro de Primera Clase (US$ 10.00)</h2>
                            <small class="text-white-50">Capacitación seleccionada: <strong id="curso_nombre_badge" class="text-warning"><?= $courseTitle ?></strong></small>
                        </div>
                    </div>

                    <!-- Contenedor Oficial de PayPal Checkout -->
                    <div id="paypalCheckoutWrapper" class="p-3 bg-dark bg-opacity-50 rounded-3 border border-secondary border-opacity-25 mb-3">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3 pb-2 border-bottom border-secondary border-opacity-25">
                            <span class="text-white-50 small fw-semibold">
                                <i class="fab fa-paypal text-warning me-1"></i> Pasarela oficial protegida por cifrado SSL:
                            </span>
                            <span class="badge bg-warning bg-opacity-25 text-warning border border-warning border-opacity-50">
                                Importe fijado: USD 10.00
                            </span>
                        </div>

                        <!-- Contenedor dinámico de botones de PayPal -->
                        <div id="paypal-button-container" class="mx-auto" style="max-width: 440px; min-height: 48px;">
                            <div id="paypalLoadingPlaceholder" class="text-center py-3 text-white-50 small">
                                <span class="spinner-border spinner-border-sm text-warning me-2" role="status"></span>
                                Conectando con la pasarela de pagos segura...
                            </div>
                        </div>

                        <!-- Bloque de aviso cuando las credenciales no están configuradas en el servidor -->
                        <div id="paypalUnconfiguredNotice" class="alert alert-warning bg-dark text-warning border-warning border-opacity-50 rounded-3 p-3 text-start small mb-0 d-none">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-info-circle fs-5 me-2 mt-1"></i>
                                <div>
                                    <strong class="text-white">Pasarela de pago en configuración técnica:</strong><br>
                                    Para formalizar tu inscripción a la primera clase (US$ 10.00) y recibir tus credenciales de acceso, por favor contacta directamente a nuestra Dirección Comercial:
                                    <div class="d-flex flex-wrap gap-2 mt-2">
                                        <a href="mailto:comercial@quality-consulting.org" class="btn btn-sm btn-outline-warning"><i class="fas fa-envelope me-1"></i> comercial@quality-consulting.org</a>
                                        <a href="https://wa.me/51993463118?text=Hola,%20deseo%20inscribirme%20a%20la%20primera%20clase%20del%20curso" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-success"><i class="fab fa-whatsapp me-1"></i> +51 993 463 118</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mensaje dinámico de estado de verificación -->
                    <div id="verificacionStatusBox" class="alert <?= $isVerifiedInSession ? 'alert-success border-success' : 'alert-secondary border-secondary' ?> bg-dark bg-opacity-75 p-3 rounded-3 mb-3 small">
                        <div class="d-flex align-items-center">
                            <i id="verificacionStatusIcon" class="fas <?= $isVerifiedInSession ? 'fa-check-circle text-success' : 'fa-shield-alt text-warning' ?> fs-5 me-2"></i>
                            <div id="verificacionStatusText">
                                <?php if ($isVerifiedInSession): ?>
                                    <strong class="text-success">¡Pago Verificado en el Servidor!</strong> Orden: <span class="font-monospace text-warning"><?= $orderId ?></span> (US$ 10.00). El formulario del Paso 2 se encuentra habilitado para ingresar tus datos.
                                <?php else: ?>
                                    <span class="text-white-50">Completa el pago con el botón amarillo de PayPal superior. Al completarse, el formulario de inscripción se desbloqueará de inmediato.</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Asistencia alternativa: Verificación manual de orden aprobada -->
                    <div class="pt-2">
                        <a class="text-white-50 small text-decoration-none d-inline-flex align-items-center" data-bs-toggle="collapse" href="#contingencyVerificationCollapse" role="button" aria-expanded="false" aria-controls="contingencyVerificationCollapse">
                            <i class="fas fa-question-circle me-1 text-warning"></i> ¿Ya cuentas con una orden aprobada o código de transacción? <span class="text-warning text-decoration-underline ms-1">Verificar manualmente</span>
                        </a>
                        <div class="collapse mt-2" id="contingencyVerificationCollapse">
                            <div class="p-3 bg-dark bg-opacity-75 rounded-3 border border-secondary border-opacity-25">
                                <label for="paypal_order_input" class="form-label text-white-50 small fw-semibold">Código de orden o transacción de PayPal:</label>
                                <div class="input-group">
                                    <input type="text" 
                                           id="paypal_order_input" 
                                           class="form-control bg-dark text-white border-secondary border-opacity-50 font-monospace py-2" 
                                           placeholder="Ej: 5C91234567890123A" 
                                           value="<?= htmlspecialchars($old['paypal_order_id'] ?? $orderId, ENT_QUOTES, 'UTF-8') ?>"
                                           <?= $isVerifiedInSession ? 'readonly' : '' ?>>
                                    <button type="button" 
                                            id="btnVerificarTransaccion" 
                                            class="btn btn-warning fw-bold text-dark font-montserrat px-3"
                                            <?= $isVerifiedInSession ? 'disabled' : '' ?>>
                                        <span id="btnVerifySpinner" class="spinner-border spinner-border-sm me-1 d-none" role="status" aria-hidden="true"></span>
                                        <span id="btnVerifyText"><?= $isVerifiedInSession ? 'Verificado' : 'Verificar en Servidor' ?></span>
                                    </button>
                                </div>
                                <small class="text-white-50 d-block mt-1" style="font-size: 0.78rem;">
                                    Permite validar una orden existente directamente contra la API de PayPal en el backend.
                                </small>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- PASO 2: FORMULARIO DE REGISTRO DEL PARTICIPANTE -->
                <div class="card bg-secondary bg-opacity-10 border border-secondary border-opacity-25 rounded-4 p-4 p-md-5 shadow-lg">

                    <div class="d-flex align-items-center gap-3 mb-4 pb-2 border-bottom border-secondary border-opacity-25">
                        <span class="badge rounded-circle <?= $isVerifiedInSession ? 'bg-warning text-dark' : 'bg-secondary text-white' ?> fs-6 d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">2</span>
                        <div>
                            <h2 class="h5 font-montserrat fw-bold text-white mb-0">Paso 2: Datos de Inscripción del Participante</h2>
                            <small class="text-white-50">Información para coordinar la asistencia a la primera sesión</small>
                        </div>
                    </div>

                    <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger shadow-sm mb-4 rounded-3 border-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i> Por favor corrige los errores indicados en el formulario.
                    </div>
                    <?php endif; ?>

                    <form action="/registro-primera-clase" method="POST" id="formRegistroPrimeraClase" novalidate>

                        <!-- Token de Protección CSRF -->
                        <input type="hidden" name="_csrf_token" id="csrfTokenField" value="<?= $csrfToken ?>">

                        <!-- Campo Trampa Anti-Spam (Honeypot) -->
                        <div class="d-none" aria-hidden="true">
                            <input type="text" name="<?= $hpField ?>" tabindex="-1" autocomplete="off" value="">
                        </div>

                        <!-- Identificador de Orden, Captura y Curso Ocultos -->
                        <input type="hidden" id="paypal_order_id_hidden" name="paypal_order_id" value="<?= htmlspecialchars($old['paypal_order_id'] ?? $orderId, ENT_QUOTES, 'UTF-8') ?>">
                        <input type="hidden" id="paypal_capture_id_hidden" name="paypal_capture_id" value="<?= htmlspecialchars($old['paypal_capture_id'] ?? $captureId, ENT_QUOTES, 'UTF-8') ?>">
                        <input type="hidden" id="curso_hidden" name="curso" value="<?= $courseSlug ?>">

                        <div class="row g-3">

                            <!-- Curso Seleccionado (Fijado) -->
                            <div class="col-12">
                                <label for="curso_display" class="form-label text-warning small fw-bold text-uppercase">
                                    <i class="fas fa-book-open me-1"></i> Curso / Seminario Seleccionado:
                                </label>
                                <input type="text" id="curso_display" class="form-control bg-dark text-white border-secondary border-opacity-50 py-2 fs-6 fw-semibold" value="<?= $courseTitle ?>" readonly>
                                <?php if (isset($errors['curso'])): ?>
                                    <div class="text-danger small mt-1"><?= htmlspecialchars($errors['curso'], ENT_QUOTES, 'UTF-8') ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Nombres y Apellidos -->
                            <div class="col-12">
                                <label for="nombres" class="form-label text-light small fw-bold">
                                    Nombres y Apellidos Completos: <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark text-warning border-secondary border-opacity-50">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" 
                                           id="nombres" 
                                           name="nombres" 
                                           class="form-control bg-dark text-white border-secondary border-opacity-50 py-2 <?= isset($errors['nombres']) ? 'is-invalid' : '' ?>" 
                                           placeholder="Ej: Ing. Carlos Ramos Salazar" 
                                           value="<?= htmlspecialchars($old['nombres'] ?? '', ENT_QUOTES, 'UTF-8') ?>" 
                                           required 
                                           minlength="3" 
                                           maxlength="150"
                                           <?= !$isVerifiedInSession ? 'disabled' : '' ?>>
                                </div>
                                <?php if (isset($errors['nombres'])): ?>
                                    <div class="text-danger small mt-1"><?= htmlspecialchars($errors['nombres'], ENT_QUOTES, 'UTF-8') ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Correo Electrónico -->
                            <div class="col-12 col-md-6">
                                <label for="email" class="form-label text-light small fw-bold">
                                    Correo Electrónico de Contacto: <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark text-warning border-secondary border-opacity-50">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" 
                                           id="email" 
                                           name="email" 
                                           class="form-control bg-dark text-white border-secondary border-opacity-50 py-2 <?= isset($errors['email']) ? 'is-invalid' : '' ?>" 
                                           placeholder="correo@ejemplo.com" 
                                           value="<?= htmlspecialchars($old['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" 
                                           required
                                           <?= !$isVerifiedInSession ? 'disabled' : '' ?>>
                                </div>
                                <?php if (isset($errors['email'])): ?>
                                    <div class="text-danger small mt-1"><?= htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') ?></div>
                                <?php endif; ?>
                                <small class="text-white-50 d-block mt-1" style="font-size: 0.78rem;">
                                    Nuestro equipo de coordinación comercial y académica te contactará a este correo para coordinar los accesos y detalles de la primera sesión.
                                </small>
                            </div>

                            <!-- Teléfono / WhatsApp -->
                            <div class="col-12 col-md-6">
                                <label for="telefono" class="form-label text-light small fw-bold">
                                    Número Telefónico / WhatsApp: <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark text-warning border-secondary border-opacity-50">
                                        <i class="fab fa-whatsapp"></i>
                                    </span>
                                    <input type="tel" 
                                           id="telefono" 
                                           name="telefono" 
                                           class="form-control bg-dark text-white border-secondary border-opacity-50 py-2 <?= isset($errors['telefono']) ? 'is-invalid' : '' ?>" 
                                           placeholder="+51 999 999 999" 
                                           value="<?= htmlspecialchars($old['telefono'] ?? '', ENT_QUOTES, 'UTF-8') ?>" 
                                           required
                                           <?= !$isVerifiedInSession ? 'disabled' : '' ?>>
                                </div>
                                <?php if (isset($errors['telefono'])): ?>
                                    <div class="text-danger small mt-1"><?= htmlspecialchars($errors['telefono'], ENT_QUOTES, 'UTF-8') ?></div>
                                <?php endif; ?>
                                <small class="text-white-50 d-block mt-1" style="font-size: 0.78rem;">
                                    Para confirmación directa y asistencia técnica personalizada de la coordinación.
                                </small>
                            </div>

                        </div>

                        <!-- Nota sobre el alcance del pago -->
                        <div class="alert alert-dark border-secondary border-opacity-25 small text-warning my-4 p-3 rounded-3 text-center">
                            <i class="fas fa-info-circle me-1"></i> US$10 únicamente por la primera clase. No incluye el curso completo.
                        </div>

                        <!-- Botón de Envío -->
                        <div class="d-grid mb-2">
                            <button type="submit" 
                                    id="btnSubmitRegistro" 
                                    class="btn btn-warning btn-lg fw-bold text-dark font-montserrat shadow-sm py-3"
                                    <?= !$isVerifiedInSession ? 'disabled' : '' ?>>
                                <i class="fas fa-paper-plane me-2"></i> Confirmar mi Registro a la Primera Clase
                            </button>
                        </div>

                        <div id="formUnlockHelp" class="text-center small <?= $isVerifiedInSession ? 'd-none' : '' ?>">
                            <span class="text-white-50"><i class="fas fa-lock me-1 text-warning"></i> Para habilitar el botón de envío, completa el Paso 1 verificando tu transacción.</span>
                        </div>

                    </form>

                </div>

            </div>
        </div>

    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const coursesCatalog = <?= json_encode(
        array_map(static fn(array $course): string => (string)$course['title'], $courseCatalog ?? []),
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
    ) ?>;

    const isGitHubPages = window.location.hostname.includes('github.io');
    const apiBase = (window.QCS_API_BASE_URL || '').replace(/\/+$/, '');

    if (isGitHubPages) {
        const noticeEl = document.getElementById('githubPagesNotice');
        if (noticeEl) noticeEl.classList.remove('d-none');
    }

    const params = new URLSearchParams(window.location.search);
    const slug = (params.get('curso') || '').trim().toLowerCase();
    const orderIdParam = (params.get('order_id') || '').trim();

    if (slug && coursesCatalog[slug]) {
        const title = coursesCatalog[slug];
        const displayEl = document.getElementById('curso_display');
        const hiddenEl = document.getElementById('curso_hidden');
        const badgeEl = document.getElementById('curso_nombre_badge');
        if (displayEl) displayEl.value = title;
        if (hiddenEl) hiddenEl.value = slug;
        if (badgeEl) badgeEl.textContent = title;
    }

    const orderInput = document.getElementById('paypal_order_input');
    const hiddenOrderInput = document.getElementById('paypal_order_id_hidden');
    const hiddenCaptureInput = document.getElementById('paypal_capture_id_hidden');
    if (orderIdParam && orderInput && !orderInput.value) {
        orderInput.value = orderIdParam;
        if (hiddenOrderInput) hiddenOrderInput.value = orderIdParam;
    }

    // Sincronizar input visible con hidden
    if (orderInput && hiddenOrderInput) {
        orderInput.addEventListener('input', function() {
            hiddenOrderInput.value = this.value.trim();
        });
    }

    const btnVerify = document.getElementById('btnVerificarTransaccion');
    const statusBox = document.getElementById('verificacionStatusBox');
    const statusIcon = document.getElementById('verificacionStatusIcon');
    const statusText = document.getElementById('verificacionStatusText');
    const btnSpinner = document.getElementById('btnVerifySpinner');
    const btnText = document.getElementById('btnVerifyText');
    const submitBtn = document.getElementById('btnSubmitRegistro');
    const unlockHelp = document.getElementById('formUnlockHelp');
    const nombresInput = document.getElementById('nombres');
    const emailInput = document.getElementById('email');
    const telefonoInput = document.getElementById('telefono');
    const csrfToken = document.getElementById('csrfTokenField') ? document.getElementById('csrfTokenField').value : '';
    const paypalPlaceholder = document.getElementById('paypalLoadingPlaceholder');
    const paypalUnconfigured = document.getElementById('paypalUnconfiguredNotice');

    function unlockFormWithPayment(orderId, captureId, amountText) {
        if (statusBox) {
            statusBox.className = 'alert alert-success border-success bg-dark bg-opacity-75 p-3 rounded-3 mb-3 small';
        }
        if (statusIcon) {
            statusIcon.className = 'fas fa-check-circle text-success fs-5 me-2';
        }
        if (statusText) {
            const capInfo = captureId ? ` | Captura: <span class="font-monospace text-warning">${captureId}</span>` : '';
            statusText.innerHTML = `<strong class="text-success">¡Pago Verificado en Servidor!</strong> Orden: <span class="font-monospace text-warning">${orderId}</span>${capInfo} (${amountText || 'US$ 10.00'}). El formulario del Paso 2 está habilitado para ingresar tus datos.`;
        }

        if (orderInput) {
            orderInput.value = orderId;
            orderInput.readOnly = true;
        }
        if (hiddenOrderInput) hiddenOrderInput.value = orderId;
        if (hiddenCaptureInput && captureId) hiddenCaptureInput.value = captureId;
        if (btnVerify) {
            btnVerify.disabled = true;
            if (btnText) btnText.textContent = 'Verificado';
        }

        if (nombresInput) nombresInput.disabled = false;
        if (emailInput) emailInput.disabled = false;
        if (telefonoInput) telefonoInput.disabled = false;
        if (submitBtn) submitBtn.disabled = false;
        if (unlockHelp) unlockHelp.classList.add('d-none');

        if (nombresInput) nombresInput.focus();
    }

    // Inicializar pasarela oficial PayPal Checkout v2 si el backend está disponible
    async function initPayPalGateway() {
        const currentCourse = (document.getElementById('curso_hidden') ? document.getElementById('curso_hidden').value : '').trim();

        // Si ya está verificado en sesión PHP previa, habilitar formulario de inmediato
        const isSessionVerified = <?= $isVerifiedInSession ? 'true' : 'false' ?>;
        if (isSessionVerified) {
            if (paypalPlaceholder) paypalPlaceholder.remove();
            return;
        }

        // Si estamos en GitHub Pages y no hay API_BASE_URL configurada, mostrar aviso institucional
        if (isGitHubPages && !apiBase) {
            if (paypalPlaceholder) paypalPlaceholder.remove();
            if (paypalUnconfigured) paypalUnconfigured.classList.remove('d-none');
            return;
        }

        try {
            const configUrl = `${apiBase}/api/paypal/config`;
            const resp = await fetch(configUrl, {
                method: 'GET',
                credentials: 'include',
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            if (!resp.ok) {
                throw new Error('Configuración de pasarela no disponible.');
            }

            const config = await resp.json();

            if (!config.configured || !config.client_id) {
                // Pasarela en configuración técnica: mostrar aviso institucional limpio
                if (paypalPlaceholder) paypalPlaceholder.remove();
                if (paypalUnconfigured) paypalUnconfigured.classList.remove('d-none');
                return;
            }

            // Inyectar dinámicamente el SDK oficial de PayPal Orders v2
            const script = document.createElement('script');
            script.src = `https://www.paypal.com/sdk/js?client-id=${encodeURIComponent(config.client_id)}&currency=${encodeURIComponent(config.currency || 'USD')}&locale=es_PE`;
            script.async = true;

            script.onload = function () {
                if (paypalPlaceholder) paypalPlaceholder.remove();
                if (typeof paypal === 'undefined' || !paypal.Buttons) {
                    if (paypalUnconfigured) paypalUnconfigured.classList.remove('d-none');
                    return;
                }

                paypal.Buttons({
                    style: {
                        layout: 'vertical',
                        color: 'gold',
                        shape: 'rect',
                        label: 'paypal',
                        height: 44
                    },
                    createOrder: async function () {
                        const targetCourse = (document.getElementById('curso_hidden') ? document.getElementById('curso_hidden').value : currentCourse).trim();
                        const createUrl = `${apiBase}/api/paypal/create-order`;

                        const res = await fetch(createUrl, {
                            method: 'POST',
                            credentials: 'include',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: new URLSearchParams({
                                curso: targetCourse,
                                _csrf_token: csrfToken
                            })
                        });

                        const data = await res.json();
                        if (!res.ok || !data.success || !data.order_id) {
                            throw new Error(data.message || 'No fue posible inicializar la orden segura en PayPal.');
                        }
                        return data.order_id;
                    },
                    onApprove: async function (data) {
                        const targetCourse = (document.getElementById('curso_hidden') ? document.getElementById('curso_hidden').value : currentCourse).trim();
                        
                        if (statusBox) {
                            statusBox.className = 'alert alert-info border-info bg-dark bg-opacity-75 p-3 rounded-3 mb-3 small';
                        }
                        if (statusIcon) {
                            statusIcon.className = 'fas fa-spinner fa-spin text-info fs-5 me-2';
                        }
                        if (statusText) {
                            statusText.innerHTML = '<strong class="text-info">Procesando captura...</strong> Validando acreditación de fondos en el servidor de Quality.';
                        }

                        const captureUrl = `${apiBase}/api/paypal/capture-order`;
                        const res = await fetch(captureUrl, {
                            method: 'POST',
                            credentials: 'include',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: new URLSearchParams({
                                order_id: data.orderID,
                                curso: targetCourse,
                                _csrf_token: csrfToken
                            })
                        });

                        const captureData = await res.json();
                        if (res.ok && captureData.success) {
                            unlockFormWithPayment(captureData.order_id, captureData.capture_id, captureData.amount);
                        } else {
                            if (statusBox) statusBox.className = 'alert alert-danger border-danger bg-dark bg-opacity-75 p-3 rounded-3 mb-3 small';
                            if (statusIcon) statusIcon.className = 'fas fa-times-circle text-danger fs-5 me-2';
                            if (statusText) statusText.innerHTML = `<strong class="text-danger">Captura no completada:</strong> ${captureData.message || 'El pago no pudo ser confirmado por el servidor.'}`;
                        }
                    },
                    onError: function (err) {
                        console.error('Error en PayPal Buttons:', err);
                        if (statusBox) statusBox.className = 'alert alert-danger border-danger bg-dark bg-opacity-75 p-3 rounded-3 mb-3 small';
                        if (statusIcon) statusIcon.className = 'fas fa-exclamation-triangle text-danger fs-5 me-2';
                        if (statusText) statusText.innerHTML = '<strong class="text-danger">Aviso de pasarela:</strong> La transacción de PayPal fue cancelada o no pudo procesarse. Puedes reintentar con el botón superior.';
                    }
                }).render('#paypal-button-container');
            };

            script.onerror = function () {
                if (paypalPlaceholder) paypalPlaceholder.remove();
                if (paypalUnconfigured) paypalUnconfigured.classList.remove('d-none');
            };

            document.head.appendChild(script);

        } catch (e) {
            if (paypalPlaceholder) paypalPlaceholder.remove();
            if (paypalUnconfigured) paypalUnconfigured.classList.remove('d-none');
        }
    }

    initPayPalGateway();

    // Verificación manual de orden existente (Contingencia)
    if (btnVerify) {
        btnVerify.addEventListener('click', async function () {
            const currentOrderId = (orderInput ? orderInput.value : '').trim();
            const currentCourse = (document.getElementById('curso_hidden') ? document.getElementById('curso_hidden').value : '').trim();

            if (!currentOrderId) {
                alert('Por favor ingresa el código o recibo de transacción emitido por PayPal.');
                if (orderInput) orderInput.focus();
                return;
            }

            if (isGitHubPages && !apiBase) {
                alert('Esta página corre en GitHub Pages (demostración estática sin backend PHP). Para formalizar tu registro tras pagar en PayPal, por favor escribe a comercial@quality-consulting.org o por WhatsApp al +51 993 463 118.');
                return;
            }

            btnVerify.disabled = true;
            if (btnSpinner) btnSpinner.classList.remove('d-none');
            if (btnText) btnText.textContent = 'Verificando...';

            try {
                const formData = new FormData();
                formData.append('order_id', currentOrderId);
                formData.append('curso', currentCourse);
                if (csrfToken) formData.append('_csrf_token', csrfToken);

                const response = await fetch(`${apiBase}/api/paypal/verify-transaction`, {
                    method: 'POST',
                    body: formData,
                    credentials: 'include',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    unlockFormWithPayment(data.order_id, data.capture_id || '', data.amount);
                } else {
                    statusBox.className = 'alert alert-danger border-danger bg-dark bg-opacity-75 p-3 rounded-3 mb-3 small';
                    statusIcon.className = 'fas fa-times-circle text-danger fs-5 me-2';
                    statusText.innerHTML = `<strong class="text-danger">No se pudo verificar:</strong> ${data.message || 'La transacción no cumple con los requisitos del servidor.'}`;
                    btnVerify.disabled = false;
                    if (btnText) btnText.textContent = 'Reintentar Verificación';
                }
            } catch (err) {
                statusBox.className = 'alert alert-danger border-danger bg-dark bg-opacity-75 p-3 rounded-3 mb-3 small';
                statusIcon.className = 'fas fa-exclamation-triangle text-danger fs-5 me-2';
                statusText.innerHTML = '<strong class="text-danger">Error de comunicación:</strong> No fue posible contactar al servidor para verificar el pago.';
                btnVerify.disabled = false;
                if (btnText) btnText.textContent = 'Reintentar Verificación';
            } finally {
                if (btnSpinner) btnSpinner.classList.add('d-none');
            }
        });
    }

    // Interceptar submit en GitHub Pages si no hay backend activo
    const regForm = document.getElementById('formRegistroPrimeraClase');
    if (regForm) {
        if (apiBase) {
            regForm.action = `${apiBase}/registro-primera-clase`;
        } else if (isGitHubPages) {
            regForm.addEventListener('submit', function (e) {
                e.preventDefault();
                alert('En GitHub Pages no se pueden guardar formularios ni procesar inscripciones sin un servidor PHP activo. Por favor contacta a comercial@quality-consulting.org o vía WhatsApp al +51 993 463 118 adjuntando tus datos y comprobante.');
            });
        }
    }
});
</script>
