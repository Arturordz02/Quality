<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Vista: Pago Cancelado o No Completado
 *
 * Requisito 9: Si el pago se cancela o falla, no permitir el acceso al formulario
 * como compra confirmada y mostrar un mensaje apropiado.
 */

declare(strict_types=1);

$courseTitle = htmlspecialchars($course['title'] ?? 'Curso Especializado', ENT_QUOTES, 'UTF-8');
$courseSlug  = htmlspecialchars($courseSlug ?? ($course['slug'] ?? 'bim-revit-architecture'), ENT_QUOTES, 'UTF-8');
?>

<main class="py-5 bg-dark text-light min-vh-100" style="background: radial-gradient(circle at top, #1E232A 0%, #111317 100%);">
    <div class="container py-4">

        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 col-xl-7">

                <div class="card bg-secondary bg-opacity-10 border border-warning border-opacity-50 rounded-4 p-4 p-md-5 text-center shadow-lg">

                    <div class="d-inline-flex justify-content-center align-items-center bg-warning text-dark rounded-circle mx-auto mb-4" style="width: 72px; height: 72px;">
                        <i class="fas fa-exclamation-triangle fs-1"></i>
                    </div>

                    <span class="badge bg-warning text-dark px-3 py-2 text-uppercase fw-bold mb-2 align-self-center">
                        Operación No Culminada
                    </span>

                    <h1 class="h3 font-montserrat fw-bold text-white mb-2">
                        El pago no fue procesado o fue cancelado
                    </h1>

                    <p class="text-white-50 mb-4">
                        El proceso de pago a través de PayPal para la primera clase de <strong><?= $courseTitle ?></strong> fue interrumpido o cancelado. No se ha realizado ningún cobro a tu cuenta.
                    </p>

                    <!-- Advertencia de Bloqueo de Acceso -->
                    <div class="alert alert-dark border-secondary border-opacity-25 rounded-3 p-3 text-start mb-4 small text-white-50">
                        <i class="fas fa-lock text-warning me-2"></i>
                        <strong>Acceso restringido:</strong> El formulario de registro solo se habilita una vez que la orden de PayPal por el monto de <strong>USD 10.00</strong> haya sido confirmada y validada en el backend.
                    </div>

                    <!-- Acciones Disponibles -->
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                        <a href="/pagar-primera-clase?curso=<?= urlencode($courseSlug) ?>" class="btn btn-warning btn-lg fw-bold text-dark font-montserrat">
                            <i class="fab fa-paypal me-2"></i> Intentar Pagar Nuevamente ($10 USD)
                        </a>
                        <a href="https://api.whatsapp.com/send?phone=51993463118&amp;text=Hola,%20tuve%20un%20inconveniente%20al%20intentar%20pagar%20la%20primera%20clase%20de%20<?= urlencode($courseTitle) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-outline-success btn-lg">
                            <i class="fab fa-whatsapp me-2"></i> Consultar por WhatsApp
                        </a>
                    </div>

                    <div class="mt-4 pt-3 border-top border-secondary border-opacity-25 text-center">
                        <a href="/" class="text-white-50 text-decoration-none small">
                            <i class="fas fa-home me-1"></i> Regresar a la página principal
                        </a>
                    </div>

                </div>

            </div>
        </div>

    </div>
</main>
