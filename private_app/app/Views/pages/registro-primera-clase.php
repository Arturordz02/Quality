<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Vista: Formulario Obligatorio de Registro Post-Pago de Primera Clase
 *
 * Campos mínimos solicitados:
 * - Nombres y apellidos
 * - Correo electrónico
 * - Número telefónico
 * - Curso seleccionado
 * - Código o referencia de la transacción PayPal
 */

declare(strict_types=1);

$courseTitle = htmlspecialchars($courseTitle ?? 'Curso Especializado', ENT_QUOTES, 'UTF-8');
$courseSlug  = htmlspecialchars($courseSlug ?? '', ENT_QUOTES, 'UTF-8');
$orderId     = htmlspecialchars($orderId ?? '', ENT_QUOTES, 'UTF-8');
$csrfToken   = htmlspecialchars($csrfToken ?? '', ENT_QUOTES, 'UTF-8');
$hpField     = htmlspecialchars($honeypotField ?? '_qcs_verification_hp', ENT_QUOTES, 'UTF-8');

$errors = isset($_SESSION['_qcs_form_errors']) ? $_SESSION['_qcs_form_errors'] : [];
$old    = isset($_SESSION['_qcs_form_old']) ? $_SESSION['_qcs_form_old'] : [];
if (isset($_SESSION)) {
    unset($_SESSION['_qcs_form_errors'], $_SESSION['_qcs_form_old']);
}
$isVerifiedInSession = !empty($isVerifiedInSession);
?>


<main class="py-5 bg-dark text-light min-vh-100" style="background: radial-gradient(circle at top, #1E232A 0%, #111317 100%);">
    <div class="container py-4">

        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 col-xl-7">

                <?php if ($isVerifiedInSession): ?>
                <!-- Tarjeta de Verificación Exitosa de PayPal (API / Sesión) -->
                <div class="card bg-success bg-opacity-10 border border-success border-opacity-50 rounded-4 p-4 mb-4 text-center shadow-lg">
                    <div class="d-inline-flex justify-content-center align-items-center bg-success text-white rounded-circle mx-auto mb-3" style="width: 56px; height: 56px;">
                        <i class="fas fa-check fs-4"></i>
                    </div>
                    <h1 class="h4 font-montserrat fw-bold text-white mb-1">
                        ¡Pago de USD 10 Validado por PayPal!
                    </h1>
                    <p class="small text-white-50 mb-0">
                        Código de Transacción Confirmado: <strong class="text-warning font-monospace"><?= $orderId ?></strong>
                    </p>
                </div>
                <?php else: ?>
                <!-- Tarjeta de Registro Post-Pago PayPal (Enlace Oficial / PayPal.me) -->
                <div class="card bg-warning bg-opacity-10 border border-warning border-opacity-50 rounded-4 p-4 mb-4 text-center shadow-lg">
                    <div class="d-inline-flex justify-content-center align-items-center bg-warning text-dark rounded-circle mx-auto mb-3" style="width: 56px; height: 56px;">
                        <i class="fab fa-paypal fs-4"></i>
                    </div>
                    <h1 class="h4 font-montserrat fw-bold text-white mb-1">
                        Registro Obligatorio – Primera Clase (USD 10)
                    </h1>
                    <p class="small text-white-50 mb-0">
                        Ingresa a continuación tus datos y el código de recibo / transacción que PayPal te proporcionó tras tu pago de <strong>USD 10.00</strong>.
                    </p>
                </div>
                <?php endif; ?>

                <!-- Formulario Obligatorio de Registro -->
                <div class="card bg-secondary bg-opacity-10 border border-secondary border-opacity-25 rounded-4 p-4 p-md-5 shadow-lg">

                    <div class="mb-4 text-center">
                        <span class="badge bg-warning text-dark px-3 py-2 text-uppercase fw-bold mb-2">
                            Paso Final Obligatorio
                        </span>
                        <h2 class="h4 font-montserrat fw-bold text-white mb-2">
                            Registro de Datos del Alumno
                        </h2>
                        <p class="small text-white-50 mb-0">
                            Completa la siguiente información para coordinar tu acceso a la primera clase de <strong id="curso_nombre_badge"><?= $courseTitle ?></strong>.
                        </p>
                    </div>

                    <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger shadow-sm mb-4">
                        <i class="fas fa-exclamation-triangle me-2"></i> Por favor corrige los errores indicados a continuación.
                    </div>
                    <?php endif; ?>

                    <form action="/registro-primera-clase" method="POST" id="formRegistroPrimeraClase" novalidate>

                        <!-- Token de Protección CSRF -->
                        <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">

                        <!-- Campo Trampa Anti-Spam (Honeypot) -->
                        <div class="d-none" aria-hidden="true">
                            <input type="text" name="<?= $hpField ?>" tabindex="-1" autocomplete="off" value="">
                        </div>

                        <!-- 1. Curso Seleccionado (Solo Lectura - Fijado al curso de origen) -->
                        <div class="mb-3">
                            <label for="curso_display" class="form-label text-warning small fw-bold text-uppercase">
                                <i class="fas fa-book-open me-1"></i> Curso Seleccionado (Primera Clase):
                            </label>
                            <input type="text" id="curso_display" class="form-control bg-dark text-white border-secondary border-opacity-50 py-2 fs-6 fw-semibold" value="<?= $courseTitle ?>" readonly>
                            <input type="hidden" id="curso_hidden" name="curso" value="<?= $courseSlug ?>">
                            <?php if (isset($errors['curso'])): ?>
                                <div class="text-danger small mt-1"><?= htmlspecialchars($errors['curso'], ENT_QUOTES, 'UTF-8') ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- 2. Código de Transacción PayPal -->
                        <div class="mb-3">
                            <label for="paypal_order_id" class="form-label text-warning small fw-bold text-uppercase">
                                <i class="fab fa-paypal me-1"></i> <?= $isVerifiedInSession ? 'Código / Referencia PayPal Validado:' : 'Código o Referencia de Transacción PayPal: *' ?>
                            </label>
                            <?php if ($isVerifiedInSession): ?>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark text-success border-secondary border-opacity-50">
                                        <i class="fas fa-check-circle"></i>
                                    </span>
                                    <input type="text" id="paypal_order_id" name="paypal_order_id" class="form-control bg-dark text-white border-secondary border-opacity-50 font-monospace py-2" value="<?= htmlspecialchars($old['paypal_order_id'] ?? $orderId, ENT_QUOTES, 'UTF-8') ?>" readonly required>
                                </div>
                                <div class="form-text text-white-50 small">
                                    Esta referencia fue verificada en el servidor contra la API de PayPal por un monto de USD 10.00.
                                </div>
                            <?php else: ?>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark text-warning border-secondary border-opacity-50">
                                        <i class="fab fa-paypal"></i>
                                    </span>
                                    <input type="text" id="paypal_order_id" name="paypal_order_id" class="form-control bg-dark text-white border-secondary border-opacity-50 font-monospace py-2 <?= isset($errors['paypal_order_id']) ? 'is-invalid' : '' ?>" placeholder="Ej: 8RG78291HX123456T o número de recibo de PayPal" value="<?= htmlspecialchars($old['paypal_order_id'] ?? $orderId, ENT_QUOTES, 'UTF-8') ?>" required minlength="6" maxlength="35">
                                </div>
                                <?php if (isset($errors['paypal_order_id'])): ?>
                                    <div class="text-danger small mt-1"><?= htmlspecialchars($errors['paypal_order_id'], ENT_QUOTES, 'UTF-8') ?></div>
                                <?php endif; ?>
                                <div class="form-text text-white-50 small">
                                    Ingresa el código o número de transacción de USD 10.00 generado por PayPal (aparece en tu comprobante o correo de PayPal).
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- 3. Nombres y Apellidos -->
                        <div class="mb-3">
                            <label for="nombres" class="form-label text-light small fw-bold">
                                Nombres y Apellidos Completos: <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark text-warning border-secondary border-opacity-50">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" id="nombres" name="nombres" class="form-control bg-dark text-white border-secondary border-opacity-50 py-2 <?= isset($errors['nombres']) ? 'is-invalid' : '' ?>" placeholder="Ej: Ing. Carlos Ramos Salazar" value="<?= htmlspecialchars($old['nombres'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required minlength="3" maxlength="150">
                            </div>
                            <?php if (isset($errors['nombres'])): ?>
                                <div class="text-danger small mt-1"><?= htmlspecialchars($errors['nombres'], ENT_QUOTES, 'UTF-8') ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- 4. Correo Electrónico -->
                        <div class="mb-3">
                            <label for="email" class="form-label text-light small fw-bold">
                                Correo Electrónico para Enlace de Acceso: <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark text-warning border-secondary border-opacity-50">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" id="email" name="email" class="form-control bg-dark text-white border-secondary border-opacity-50 py-2 <?= isset($errors['email']) ? 'is-invalid' : '' ?>" placeholder="correo@ejemplo.com" value="<?= htmlspecialchars($old['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                            </div>
                            <?php if (isset($errors['email'])): ?>
                                <div class="text-danger small mt-1"><?= htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') ?></div>
                            <?php endif; ?>
                            <div class="form-text text-white-50 small">
                                A este correo te enviaremos el enlace de la sala virtual y materiales de la primera sesión.
                            </div>
                        </div>

                        <!-- 5. Teléfono / WhatsApp -->
                        <div class="mb-4">
                            <label for="telefono" class="form-label text-light small fw-bold">
                                Número Telefónico / WhatsApp: <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark text-warning border-secondary border-opacity-50">
                                    <i class="fab fa-whatsapp"></i>
                                </span>
                                <input type="tel" id="telefono" name="telefono" class="form-control bg-dark text-white border-secondary border-opacity-50 py-2 <?= isset($errors['telefono']) ? 'is-invalid' : '' ?>" placeholder="+51 999 999 999" value="<?= htmlspecialchars($old['telefono'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                            </div>
                            <?php if (isset($errors['telefono'])): ?>
                                <div class="text-danger small mt-1"><?= htmlspecialchars($errors['telefono'], ENT_QUOTES, 'UTF-8') ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Nota exclusiva del alcance -->
                        <div class="alert alert-dark border-secondary border-opacity-25 small text-warning mb-4 p-3 rounded-3 text-center">
                            <i class="fas fa-info-circle me-1"></i> Pago exclusivo de USD 10 por la primera clase del curso.
                        </div>

                        <!-- Botón de Envío -->
                        <div class="d-grid mb-3">
                            <button type="submit" id="btnSubmitRegistro" class="btn btn-warning btn-lg fw-bold text-dark font-montserrat shadow-sm py-3">
                                <i class="fas fa-paper-plane me-2"></i> Confirmar mi Registro a la Primera Clase
                            </button>
                        </div>

                    </form>

                </div>

            </div>
        </div>

    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const coursesCatalog = {
        'bim-revit-architecture': 'BIM Revit Architecture',
        'contratos-estado': 'Contrataciones con el Estado y Ley 30225',
        'contratos': 'Administración de Contratos de Construcción',
        'costos': 'Costos y Presupuestos en Edificaciones',
        'fidic': 'Contratos FIDIC en Infraestructura y Construcción',
        'gerencia-de-calidad': 'Gerencia de la Calidad en Construcción',
        'herramientas': 'Herramientas de Calidad en Construcción',
        'iso-9001': 'Interpretación e Implementación de la Norma ISO 9001:2015',
        'lean-last-planner': 'Lean Construction y Sistema Last Planner',
        'nec': 'Contratos NEC3 y NEC4 en Infraestructura',
        'oficina-tecnica': 'Gestión Integral de Oficina Técnica en Obras',
        'pmo': 'Gestión e Implementación de PMO en Construcción',
        'proyectos-pmi': 'Gestión de Proyectos bajo el Enfoque PMI / PMBOK',
        'riesgos-cadena-produccion': 'Gestión de Riesgos en la Cadena de Producción',
        'riesgos-pmi': 'Gestión de Riesgos bajo Estándares PMI',
        'riesgos-tecnicos': 'Gestión de Riesgos Técnicos en Obras',
        'valor-ganado': 'Gestión del Valor Ganado (EVM) en Construcción'
    };

    const params = new URLSearchParams(window.location.search);
    const slug = (params.get('curso') || '').trim().toLowerCase();
    const orderId = (params.get('order_id') || '').trim();

    if (slug && coursesCatalog[slug]) {
        const title = coursesCatalog[slug];
        const displayEl = document.getElementById('curso_display');
        const hiddenEl = document.getElementById('curso_hidden');
        const badgeEl = document.getElementById('curso_nombre_badge');
        if (displayEl) displayEl.value = title;
        if (hiddenEl) hiddenEl.value = slug;
        if (badgeEl) badgeEl.textContent = title;
    }

    if (orderId) {
        const orderInput = document.getElementById('paypal_order_id');
        if (orderInput && !orderInput.value) {
            orderInput.value = orderId;
        }
    }
});
</script>


