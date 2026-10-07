<?php
/**
 * QUALITY CONSULTING SOLUTIONS - MODAL GLOBAL DE INFORMACIÓN Y ASESORÍA
 * Archivo: app/Views/partials/info_modal.php
 * 
 * Modal reutilizable en todas las páginas para solicitar temarios,
 * información de cursos o asesoría técnica en 1 solo clic.
 */
declare(strict_types=1);
?>
<!-- Modal Global de Solicitud de Información y Asesoría -->
<div class="modal fade" id="modalSolicitarInfo" tabindex="-1" aria-labelledby="modalSolicitarInfoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            
            <!-- Cabecera del Modal -->
            <div class="modal-header border-0 bg-dark text-white p-4 position-relative" style="background: linear-gradient(135deg, #0F1113 0%, #1A1D20 100%);">
                <div class="pe-4">
                    <span class="badge bg-warning text-dark fw-bold px-3 py-1 rounded-pill mb-2">
                        <i class="fa-solid fa-headset me-1"></i> ATENCIÓN INMEDIATA
                    </span>
                    <h4 class="modal-title font-montserrat fw-bold text-white mb-1" id="modalSolicitarInfoLabel">
                        Solicitar Información y Asesoría
                    </h4>
                    <p class="text-white-50 small mb-0">
                        Recibe el temario detallado, fechas de inicio y asesoría académica personalizada.
                    </p>
                </div>
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-4" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <!-- Cuerpo del Modal -->
            <div class="modal-body p-4 bg-light">
                <div class="row g-4">
                    
                    <!-- Columna Izquierda: Contacto Rápido WhatsApp -->
                    <div class="col-lg-5 d-flex flex-column justify-content-between border-end-lg pe-lg-4">
                        <div>
                            <h6 class="fw-bold text-dark mb-3 font-montserrat">
                                <i class="fa-solid fa-bolt text-warning me-2"></i>¿Prefieres atención al instante?
                            </h6>
                            <p class="small text-muted mb-4">
                                Chatea directamente con uno de nuestros asesores por WhatsApp para una respuesta inmediata.
                            </p>
                            
                            <a id="modalWhatsAppBtn" href="https://api.whatsapp.com/send?phone=51993463118&text=Hola,%20deseo%20solicitar%20informaci%C3%B3n%20sobre%20sus%20programas." target="_blank" rel="noopener noreferrer" class="btn btn-success w-100 py-2 fw-bold rounded-3 shadow-sm d-flex align-items-center justify-content-center gap-2 mb-3">
                                <i class="fab fa-whatsapp fa-lg"></i> Consultar por WhatsApp
                            </a>

                            <div class="card border-0 bg-white shadow-sm p-3 rounded-3 mt-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-warning-subtle text-dark p-2 rounded-circle">
                                        <i class="fa-solid fa-envelope"></i>
                                    </div>
                                    <div class="small">
                                        <div class="text-muted">Correo institucional</div>
                                        <a href="mailto:contacto@quality-consulting.org" class="text-dark fw-semibold text-decoration-none">contacto@quality-consulting.org</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top small text-muted">
                            <i class="fa-solid fa-shield-halved text-warning me-1"></i> Tus datos están protegidos bajo estricta confidencialidad.
                        </div>
                    </div>

                    <!-- Columna Derecha: Formulario Rápido -->
                    <div class="col-lg-7 ps-lg-4">
                        <h6 class="fw-bold text-dark mb-3 font-montserrat">
                            <i class="fa-solid fa-file-signature text-warning me-2"></i>Déjanos tus datos
                        </h6>

                        <form id="modalInfoForm" action="backend/send-contact.php" method="POST" novalidate>
                            
                            <!-- Campo Honeypot Anti-Spam -->
                            <input type="text" name="_qcs_verification_hp" style="display:none !important;" tabindex="-1" autocomplete="off">

                            <!-- Programa o Servicio de Interés -->
                            <div class="mb-3">
                                <label for="modalInputPrograma" class="form-label small fw-semibold text-secondary">Programa / Servicio de Interés</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="fa-solid fa-graduation-cap"></i></span>
                                    <input type="text" class="form-control border-start-0 ps-0 bg-white" id="modalInputPrograma" name="programa" placeholder="Curso o Especialización" readonly>
                                </div>
                            </div>

                            <!-- Nombre y Apellidos -->
                            <div class="mb-3">
                                <label for="modalInputNombre" class="form-label small fw-semibold text-secondary">Nombres y Apellidos *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="fa-solid fa-user"></i></span>
                                    <input type="text" class="form-control border-start-0 ps-0 bg-white" id="modalInputNombre" name="nombre" placeholder="Tu nombre completo" required>
                                </div>
                            </div>

                            <!-- Correo y Teléfono en dos columnas -->
                            <div class="row g-2 mb-3">
                                <div class="col-sm-6">
                                    <label for="modalInputEmail" class="form-label small fw-semibold text-secondary">Correo Electrónico *</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="fa-solid fa-envelope"></i></span>
                                        <input type="email" class="form-control border-start-0 ps-0 bg-white" id="modalInputEmail" name="email" placeholder="correo@ejemplo.com" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="modalInputTelefono" class="form-label small fw-semibold text-secondary">Teléfono / WhatsApp *</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="fa-solid fa-phone"></i></span>
                                        <input type="tel" class="form-control border-start-0 ps-0 bg-white" id="modalInputTelefono" name="telefono" placeholder="+51 999 999 999" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Mensaje o Consulta Adicional -->
                            <div class="mb-3">
                                <label for="modalInputMensaje" class="form-label small fw-semibold text-secondary">Consulta o requerimiento específico (Opcional)</label>
                                <textarea class="form-control bg-white" id="modalInputMensaje" name="mensaje" rows="2" placeholder="Indícanos si requieres información individual o corporativa..."></textarea>
                            </div>

                            <!-- Mensaje de Feedback Ajax -->
                            <div id="modalFormFeedback" class="d-none alert py-2 px-3 small mb-3"></div>

                            <!-- Botón Enviar -->
                            <button type="submit" id="modalSubmitBtn" class="btn btn-warning w-100 py-2 fw-bold text-dark rounded-3 shadow-sm font-montserrat">
                                <i class="fa-solid fa-paper-plane me-2"></i> Enviar Solicitud
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
