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
$mailSent            = !empty($summary['mail_sent']);
$mailStatusNote      = htmlspecialchars((string)($summary['mail_status_note'] ?? ''), ENT_QUOTES, 'UTF-8');
?>

<main class="qcs-register-page bg-dark text-light min-vh-100">
    <div class="container py-3">

        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 col-xl-7">

                <div class="card bg-secondary bg-opacity-10 border border-success border-opacity-50 rounded-4 p-4 p-md-5 text-center shadow-lg">
                    
                    <div class="qcs-register-badge-circle bg-success text-white">
                        <i class="fas fa-check-circle fs-2"></i>
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
                                <span class="text-white-50">Monto verificado:</span>
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

                    <!-- Estado Transparente de la Notificación -->
                    <?php if ($mailSent): ?>
                    <div class="alert alert-success bg-dark text-start border-success border-opacity-50 p-3 rounded-3 mb-4 small text-white-50">
                        <i class="fas fa-paper-plane text-success me-2"></i>
                        Se ha generado y enviado la notificación formal a la coordinación comercial de Quality Consulting Solutions (<strong class="text-white">comercial@quality-consulting.org</strong>).
                    </div>
                    <?php else: ?>
                    <div class="alert alert-warning bg-dark text-start border-warning border-opacity-50 p-3 rounded-3 mb-4 small">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-clock text-warning fs-5 me-2 mt-1"></i>
                            <div>
                                <strong class="text-warning d-block mb-1">Estado de la Notificación: En Cola de Contingencia</strong>
                                <span class="text-white-50">
                                    Tu inscripción se encuentra <strong>guardada con éxito</strong> en el sistema con orden <code class="text-warning"><?= $orderId ?></code>. La notificación por correo se encuentra en cola de procesamiento (<code class="text-warning">FallbackQueue</code>) y será despachada automáticamente. <strong>No necesitas realizar ningún pago adicional ni volver a enviar el formulario.</strong>
                                </span>
                            </div>
                        </div>
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

