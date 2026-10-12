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
?>


<main class="py-5 bg-dark text-light min-vh-100" style="background: radial-gradient(circle at top, #1E232A 0%, #111317 100%);">
    <div class="container py-4">

        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 col-xl-7">

                <!-- Tarjeta de Verificación Exitosa de PayPal -->
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
                            Completa la siguiente información para coordinar tu acceso a la primera clase de <strong><?= $courseTitle ?></strong>.
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

                        <!-- 1. Curso Seleccionado (Solo Lectura) -->
                        <div class="mb-3">
                            <label for="curso_display" class="form-label text-warning small fw-bold text-uppercase">
                                <i class="fas fa-book-open me-1"></i> Curso Seleccionado (Primera Clase):
                            </label>
                            <input type="text" id="curso_display" class="form-control bg-dark text-white border-secondary border-opacity-50 py-2 fs-6 fw-semibold" value="<?= $courseTitle ?>" readonly>
                            <input type="hidden" name="curso" value="<?= $courseSlug ?>">
                            <?php if (isset($errors['curso'])): ?>
                                <div class="text-danger small mt-1"><?= htmlspecialchars($errors['curso'], ENT_QUOTES, 'UTF-8') ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- 2. Código de Transacción PayPal (Solo Lectura / Verificado en Backend) -->
                        <div class="mb-3">
                            <label for="paypal_order_id" class="form-label text-warning small fw-bold text-uppercase">
                                <i class="fab fa-paypal me-1"></i> Código / Referencia PayPal Validado:
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark text-success border-secondary border-opacity-50">
                                    <i class="fas fa-check-circle"></i>
                                </span>
                                <input type="text" id="paypal_order_id" name="paypal_order_id" class="form-control bg-dark text-white border-secondary border-opacity-50 font-monospace py-2" value="<?= htmlspecialchars($old['paypal_order_id'] ?? $orderId, ENT_QUOTES, 'UTF-8') ?>" readonly required>
                            </div>
                            <?php if (isset($errors['paypal_order_id'])): ?>
                                <div class="text-danger small mt-1"><?= htmlspecialchars($errors['paypal_order_id'], ENT_QUOTES, 'UTF-8') ?></div>
                            <?php endif; ?>
                            <div class="form-text text-white-50 small">
                                Esta referencia fue verificada en el servidor contra la API de PayPal por un monto de USD 10.00.
                            </div>
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

                        <!-- Recordatorio explícito del alcance -->
                        <div class="alert alert-dark border-secondary border-opacity-25 small text-white-50 mb-4 p-3 rounded-3">
                            <i class="fas fa-info-circle text-warning me-1"></i>
                            <strong>Recordatorio:</strong> Tu registro queda asignado a la <em>primera clase del curso</em> por USD 10. Si deseas matricularte al programa integral o solicitar convalidación completa posterior, un asesor se comunicará contigo.
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

