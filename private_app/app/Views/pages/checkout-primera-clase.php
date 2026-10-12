<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Vista: Checkout Primera Clase del Curso (USD 10)
 *
 * Requisitos:
 * - Dejar absolutamente claro que el pago de USD 10 corresponde únicamente a: "Primera clase del curso – USD 10".
 * - NO presentar PayPal como pago del curso completo, matrícula completa ni acceso total.
 */

declare(strict_types=1);

$allCourses  = $allCourses ?? (class_exists(\App\Services\CourseCatalog::class) ? \App\Services\CourseCatalog::all() : []);
$course      = $course ?? (!empty($allCourses) ? reset($allCourses) : ['title' => 'Curso Especializado', 'slug' => 'bim-revit-architecture']);
$courseTitle  = htmlspecialchars($course['title'] ?? 'Curso Especializado', ENT_QUOTES, 'UTF-8');
$courseSlug   = htmlspecialchars($course['slug'] ?? 'bim-revit-architecture', ENT_QUOTES, 'UTF-8');
$isConfigured = !empty($isConfigured);
?>



<main class="py-5 bg-dark text-light min-vh-100" style="background: radial-gradient(circle at top, #1E232A 0%, #111317 100%);">
    <div class="container py-4">

        <!-- Migas de Pan (Breadcrumbs) -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-warning text-decoration-none"><i class="fas fa-home me-1"></i> Inicio</a></li>
                <li class="breadcrumb-item"><a href="/capacitacion" class="text-warning text-decoration-none">Capacitación</a></li>
                <li class="breadcrumb-item active text-light" aria-current="page">Primera clase – USD 10</li>
            </ol>
        </nav>

        <?php if (!empty($errorFlash)): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i> <?= htmlspecialchars($errorFlash, ENT_QUOTES, 'UTF-8') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
        <?php endif; ?>

        <div class="row g-4 justify-content-center">

            <!-- Columna Izquierda: Información del Curso y Alcance del Pago -->
            <div class="col-12 col-lg-7">
                <div class="card bg-secondary bg-opacity-10 border border-secondary border-opacity-25 rounded-4 p-4 shadow-lg h-100">
                    
                    <div class="d-inline-flex align-items-center gap-2 mb-3">
                        <span class="badge bg-warning text-dark px-3 py-2 fs-6 fw-bold text-uppercase">
                            <i class="fab fa-paypal me-1"></i> Primera clase del curso – USD 10
                        </span>
                    </div>

                    <h1 class="h3 font-montserrat fw-bold text-white mb-3">
                        Adquiere la Primera Clase Introductoria
                    </h1>

                    <!-- Selector de Curso -->
                    <div class="mb-4">
                        <label for="selectCurso" class="form-label text-warning small fw-bold text-uppercase">
                            Curso Seleccionado:
                        </label>
                        <select id="selectCurso" class="form-select bg-dark text-white border-secondary border-opacity-50 py-2 fs-6 fw-semibold" onchange="window.location.href='/pagar-primera-clase?curso=' + encodeURIComponent(this.value);">
                            <?php foreach ($allCourses as $c): ?>
                                <option value="<?= htmlspecialchars($c['slug'], ENT_QUOTES, 'UTF-8') ?>" <?= ($c['slug'] === $courseSlug) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($c['title'], ENT_QUOTES, 'UTF-8') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- DESCARGO DE RESPONSABILIDAD CRÍTICO (REQUISITO ESTRICTO 3 Y 4) -->
                    <div class="alert alert-warning border-warning border-opacity-50 bg-dark text-light p-3 rounded-3 mb-4">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-exclamation-circle text-warning fs-4 me-3 mt-1"></i>
                            <div>
                                <h2 class="h6 fw-bold text-warning mb-1 text-uppercase">
                                    Alcance Exclusivo del Pago de USD 10
                                </h2>
                                <p class="small mb-1 text-light">
                                    Este pago de <strong>USD 10.00</strong> corresponde <u>única y exclusivamente</u> a la <strong>Primera Clase del curso</strong>: <em><?= $courseTitle ?></em>.
                                </p>
                                <p class="small mb-0 text-white-50">
                                    <strong class="text-warning">IMPORTANTE:</strong> Este pago <strong>NO</strong> representa la matrícula completa, el programa integral, las sesiones completas ni la certificación total del curso. Para matricularte en el programa completo, comunícate con nuestro equipo de asesoría técnica.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Qué incluye la primera clase -->
                    <div class="card bg-dark border-0 p-3 rounded-3 mb-4">
                        <h3 class="h6 text-warning text-uppercase fw-bold mb-3">
                            <i class="fas fa-check-circle me-1"></i> Beneficios de la Primera Clase
                        </h3>
                        <ul class="list-unstyled mb-0 small text-light space-y-2">
                            <li class="mb-2"><i class="fas fa-video text-warning me-2"></i> Acceso a la sesión en vivo / clase introductoria de especialización.</li>
                            <li class="mb-2"><i class="fas fa-file-alt text-warning me-2"></i> Material base y diapositivas de la sesión inicial.</li>
                            <li class="mb-2"><i class="fas fa-comments text-warning me-2"></i> Interacción con el docente especialista en tiempo real.</li>
                            <li class="mb-0"><i class="fas fa-shield-alt text-warning me-2"></i> Descuento del valor de esta clase si decides continuar con el curso completo.</li>
                        </ul>
                    </div>

                    <div class="mt-auto pt-3 border-top border-secondary border-opacity-25 d-flex align-items-center justify-content-between">
                        <a href="/<?= $courseSlug ?>" class="btn btn-outline-secondary btn-sm text-light">
                            <i class="fas fa-arrow-left me-1"></i> Ver temario completo del curso
                        </a>
                        <a href="https://api.whatsapp.com/send?phone=51993463118&amp;text=Deseo%20informaci%C3%B3n%20sobre%20el%20curso%20completo%20de%20<?= urlencode((string)($course['title'] ?? 'Curso Especializado')) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-outline-success btn-sm">
                            <i class="fab fa-whatsapp me-1"></i> Consultar curso completo
                        </a>
                    </div>

                </div>
            </div>

            <!-- Columna Derecha: Pasarela PayPal y Resumen de Pago -->
            <div class="col-12 col-lg-5">
                <div class="card bg-secondary bg-opacity-10 border border-secondary border-opacity-25 rounded-4 p-4 shadow-lg">

                    <h2 class="h5 font-montserrat fw-bold text-white mb-3">
                        Resumen de la Transacción
                    </h2>

                    <div class="bg-dark p-3 rounded-3 mb-4 border border-secondary border-opacity-25">
                        <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom border-secondary border-opacity-25">
                            <span class="text-white-50 small">Concepto:</span>
                            <span class="fw-bold text-warning text-end small">Primera clase del curso</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom border-secondary border-opacity-25">
                            <span class="text-white-50 small">Curso:</span>
                            <span class="fw-semibold text-white text-end small"><?= $courseTitle ?></span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-white fw-bold">Monto a pagar:</span>
                            <span class="fs-4 fw-extrabold text-success">USD 10.00</span>
                        </div>
                    </div>

                    <!-- Mensaje de estado dinámico -->
                    <div id="paypalStatusMessage" class="d-none alert alert-info py-2 px-3 small rounded-3 mb-3"></div>

                    <!-- Contenedor del Botón de PayPal -->
                    <div class="mb-3">
                        <div class="text-center mb-2 text-white-50 small">
                            <i class="fas fa-lock text-warning me-1"></i> Pago procesado directamente por PayPal
                        </div>

                        <div id="paypal-button-container" class="w-100"></div>

                        <?php if (!$isConfigured): ?>
                        <!-- Modo de Demostración / Desarrollo cuando aún no hay API Keys reales en el entorno -->
                        <div class="card bg-dark border border-warning border-opacity-50 p-3 rounded-3 mt-3 text-center">
                            <span class="badge bg-warning text-dark mb-2 align-self-center">Entorno de Pruebas / Validación</span>
                            <p class="small text-white-50 mb-2">
                                Credenciales de PayPal en modo sandbox/placeholder. Puedes simular el flujo de pago aprobado para validar la redirección y el formulario obligatorio.
                            </p>
                            <button type="button" id="btnSimulatePayment" class="btn btn-warning fw-bold text-dark w-100">
                                <i class="fab fa-paypal me-2"></i> Simular Pago Aprobado ($10 USD)
                            </button>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Botón Cancelar Pago -->
                    <div class="text-center mt-3 pt-3 border-top border-secondary border-opacity-25">
                        <a href="/pago-cancelado?curso=<?= urlencode($courseSlug) ?>" class="text-white-50 text-decoration-none small">
                            <i class="fas fa-times-circle me-1"></i> Cancelar compra y salir
                        </a>
                    </div>

                    <!-- Sellos de Seguridad -->
                    <div class="mt-4 pt-3 text-center border-top border-secondary border-opacity-25">
                        <div class="row g-2 text-white-50 small">
                            <div class="col-6">
                                <i class="fas fa-shield-alt text-warning d-block fs-5 mb-1"></i>
                                <span>Encriptación SSL 256-bit</span>
                            </div>
                            <div class="col-6">
                                <i class="fas fa-check-double text-warning d-block fs-5 mb-1"></i>
                                <span>Verificación en Servidor</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</main>

<!-- Integración del SDK de PayPal -->
<?php if ($isConfigured && !empty($paypalClientId)): ?>
<script src="https://www.paypal.com/sdk/js?client-id=<?= urlencode($paypalClientId) ?>&currency=<?= urlencode($paypalCurrency) ?>&intent=capture"></script>
<?php endif; ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const currentCourse = "<?= addslashes($courseSlug) ?>";
    const statusMsg = document.getElementById("paypalStatusMessage");

    function showStatus(text, type = "info") {
        if (!statusMsg) return;
        statusMsg.className = `alert alert-${type} py-2 px-3 small rounded-3 mb-3`;
        statusMsg.textContent = text;
        statusMsg.classList.remove("d-none");
    }

    const isStaticPreview = window.location.hostname.includes('github.io');
    if (isStaticPreview) {
        showStatus("Aviso de Entorno: Te encuentras en la previsualización estática de GitHub Pages. GitHub Pages no ejecuta PHP ni APIs del backend. Para procesar o validar transacciones en el servidor, despliega el sistema en un hosting PHP (GoDaddy / cPanel) o ejecútalo con el servidor local de PHP.", "warning");
    }


    // Flujo PayPal oficial vía SDK cuando está disponible
    if (typeof paypal !== "undefined" && document.getElementById("paypal-button-container")) {
        paypal.Buttons({
            style: {
                layout: 'vertical',
                color:  'gold',
                shape:  'rect',
                label:  'paypal'
            },
            createOrder: function(data, actions) {
                showStatus("Iniciando orden segura de USD 10 en PayPal...", "info");
                return fetch("/api/paypal/create-order", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    body: JSON.stringify({ curso: currentCourse })
                })
                .then(function(res) { return res.json(); })
                .then(function(order) {
                    if (order && order.id) {
                        return order.id;
                    }
                    throw new Error(order.message || "Error al generar la orden en el backend.");
                })
                .catch(function(err) {
                    showStatus("Error al crear la orden: " + err.message, "danger");
                    throw err;
                });
            },
            onApprove: function(data, actions) {
                showStatus("Validando pago en el backend... Por favor espera.", "warning");
                return fetch("/api/paypal/capture-order", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    body: JSON.stringify({
                        orderID: data.orderID,
                        curso: currentCourse
                    })
                })
                .then(function(res) { return res.json(); })
                .then(function(details) {
                    if (details && details.success && details.redirect) {
                        showStatus("¡Pago validado exitosamente! Redirigiendo al formulario obligatorio...", "success");
                        window.location.href = details.redirect;
                    } else {
                        throw new Error(details.message || "La validación del pago falló en el servidor.");
                    }
                })
                .catch(function(err) {
                    showStatus("Error en la validación del pago: " + err.message, "danger");
                });
            },
            onCancel: function(data) {
                window.location.href = "/pago-cancelado?curso=" + encodeURIComponent(currentCourse);
            },
            onError: function(err) {
                showStatus("Ocurrió un error en la pasarela de PayPal. Intente nuevamente.", "danger");
            }
        }).render('#paypal-button-container');
    }

    // Botón de simulación para entornos de desarrollo / pruebas
    const btnSimulate = document.getElementById("btnSimulatePayment");
    if (btnSimulate) {
        btnSimulate.addEventListener("click", function() {
            if (isStaticPreview) {
                showStatus("No es posible procesar pagos en GitHub Pages: Este entorno es una previsualización estática y no ejecuta el backend PHP para validar ni registrar la orden. Por favor, prueba este flujo en un servidor con PHP habilitado.", "danger");
                return;
            }
            showStatus("Simulando creación de orden de prueba de USD 10...", "info");
            fetch("/api/paypal/create-order", {

                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                },
                body: JSON.stringify({ curso: currentCourse })
            })
            .then(function(r) { return r.json(); })
            .then(function(createRes) {
                if (!createRes.success || !createRes.order_id) {
                    throw new Error(createRes.message || "No se pudo crear la orden de prueba.");
                }
                showStatus("Capturando y validando pago de prueba en el backend...", "warning");
                return fetch("/api/paypal/capture-order", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    body: JSON.stringify({
                        orderID: createRes.order_id,
                        curso: currentCourse
                    })
                });
            })
            .then(function(r) { return r.json(); })
            .then(function(capRes) {
                if (capRes.success && capRes.redirect) {
                    showStatus("¡Pago aprobado! Redirigiendo al formulario de registro...", "success");
                    window.location.href = capRes.redirect;
                } else {
                    throw new Error(capRes.message || "Fallo en la validación del pago.");
                }
            })
            .catch(function(e) {
                showStatus("Error: " + e.message, "danger");
            });
        });
    }
});
</script>

