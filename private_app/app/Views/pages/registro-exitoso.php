<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Vista: Confirmación Exitosa de Registro en Primera Clase
 *
 * Muestra el resumen de la inscripción, el código de transacción de PayPal y
 * el estado transparente del despacho administrativo.
 */

declare(strict_types=1);

$nombres             = htmlspecialchars((string)($summary['nombres'] ?? 'Estimado Alumno'), ENT_QUOTES, 'UTF-8');
$email               = htmlspecialchars((string)($summary['email'] ?? ''), ENT_QUOTES, 'UTF-8');
$telefono            = htmlspecialchars((string)($summary['telefono'] ?? ''), ENT_QUOTES, 'UTF-8');
$curso               = htmlspecialchars((string)($summary['curso_titulo'] ?? 'Curso Especializado'), ENT_QUOTES, 'UTF-8');
$orderId             = htmlspecialchars((string)($summary['paypal_order_id'] ?? ''), ENT_QUOTES, 'UTF-8');
$monto               = htmlspecialchars((string)($summary['monto'] ?? 'USD 10.00'), ENT_QUOTES, 'UTF-8');
$recipientConfigured = !empty($summary['recipient_configured']);
$mailStatusNote      = htmlspecialchars((string)($summary['mail_status_note'] ?? ''), ENT_QUOTES, 'UTF-8');
$pendingVariable     = htmlspecialchars((string)($summary['pending_variable'] ?? ''), ENT_QUOTES, 'UTF-8');
?>

<main class="py-5 bg-dark text-light min-vh-100" style="background: radial-gradient(circle at top, #1E232A 0%, #111317 100%);">
    <div class="container py-4">

        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 col-xl-7">

                <div class="card bg-secondary bg-opacity-10 border border-success border-opacity-50 rounded-4 p-4 p-md-5 text-center shadow-lg">
                    
                    <div class="d-inline-flex justify-content-center align-items-center bg-success text-white rounded-circle mx-auto mb-4" style="width: 72px; height: 72px;">
                        <i class="fas fa-check-circle fs-1"></i>
                    </div>

                    <span class="badge bg-success px-3 py-2 text-uppercase fw-bold mb-2 align-self-center">
                        Inscripción de Primera Clase Confirmada
                    </span>

                    <h1 class="h3 font-montserrat fw-bold text-white mb-2">
                        ¡Gracias por tu inscripción, <?= $nombres ?>!
                    </h1>

                    <p class="text-white-50 mb-4">
                        Tu registro para la <strong>Primera Clase</strong> de <strong><?= $curso ?></strong> ha sido procesado y guardado correctamente en nuestra plataforma.
                    </p>

                    <!-- Resumen de Datos Confirmados -->
                    <div class="card bg-dark border border-secondary border-opacity-25 rounded-3 p-3 text-start mb-4">
                        <h2 class="h6 text-warning text-uppercase fw-bold mb-3 border-bottom border-secondary border-opacity-25 pb-2">
                            <i class="fas fa-file-invoice me-1"></i> Comprobante de Registro
                        </h2>
                        <ul class="list-unstyled mb-0 small text-light space-y-2">
                            <li class="mb-2 d-flex justify-content-between">
                                <span class="text-white-50">Concepto:</span>
                                <strong class="text-warning">Primera clase del curso – USD 10</strong>
                            </li>
                            <li class="mb-2 d-flex justify-content-between">
                                <span class="text-white-50">Curso:</span>
                                <strong class="text-white text-end"><?= $curso ?></strong>
                            </li>
                            <li class="mb-2 d-flex justify-content-between">
                                <span class="text-white-50">Referencia PayPal:</span>
                                <strong class="text-success font-monospace"><?= $orderId ?></strong>
                            </li>
                            <li class="mb-2 d-flex justify-content-between">
                                <span class="text-white-50">Monto pagado:</span>
                                <strong class="text-success"><?= $monto ?></strong>
                            </li>
                            <li class="mb-2 d-flex justify-content-between">
                                <span class="text-white-50">Correo registrado:</span>
                                <span class="text-white"><?= $email ?></span>
                            </li>
                            <li class="mb-0 d-flex justify-content-between">
                                <span class="text-white-50">Teléfono registrado:</span>
                                <span class="text-white"><?= $telefono ?></span>
                            </li>
                        </ul>
                    </div>

                    <!-- Nota sobre Estado del Envío de Correo (Requisito Estricto: Transparencia) -->
                    <?php if (!$recipientConfigured): ?>
                    <div class="alert alert-secondary bg-dark text-start border-warning border-opacity-50 p-3 rounded-3 mb-4 small">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-info-circle text-warning fs-5 me-2 mt-1"></i>
                            <div>
                                <strong class="text-warning d-block mb-1">Aviso de Configuración Administrativa:</strong>
                                <span class="text-white-50">
                                    El registro ha quedado persistido con éxito en la cola del servidor. El correo de coordinación académica del Ing. Omar Samaniego está pendiente de confirmación en el servidor (variable: <code class="text-warning"><?= $pendingVariable ?></code>). La recepción se verificará directamente por la coordinación técnica.
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="alert alert-success bg-dark text-start border-success border-opacity-50 p-3 rounded-3 mb-4 small text-white-50">
                        <i class="fas fa-paper-plane text-success me-2"></i>
                        Se ha generado la notificación formal a la coordinación académica de Quality Consulting Solutions.
                    </div>
                    <?php endif; ?>

                    <!-- Canales de Atención -->
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                        <a href="https://api.whatsapp.com/send?phone=51993463118&amp;text=Hola,%20acabo%20de%20pagar%20mi%20primera%20clase%20del%20curso%20de%20<?= urlencode($curso) ?>%20con%20referencia%20PayPal%20<?= urlencode($orderId) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-success btn-lg fw-bold font-montserrat">
                            <i class="fab fa-whatsapp me-2"></i> Contactar Coordinación por WhatsApp
                        </a>
                        <a href="/" class="btn btn-outline-secondary btn-lg text-white">
                            <i class="fas fa-home me-2"></i> Volver al Inicio
                        </a>
                    </div>

                </div>

            </div>
        </div>

    </div>
</main>
