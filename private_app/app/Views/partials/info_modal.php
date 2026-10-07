<?php
/**
 * QUALITY CONSULTING SOLUTIONS - MODAL GLOBAL DE INFORMACIÓN Y ASESORÍA
 * Archivo: app/Views/partials/info_modal.php
 * 
 * Modal interactivo completo y seguro para solicitar temarios,
 * información de cursos o asesoría técnica con los mismos campos
 * completos de contacto.
 */
declare(strict_types=1);
?>
<!-- Modal Global de Solicitud de Información y Asesoría -->
<div class="modal fade" id="modalSolicitarInfo" tabindex="-1" aria-labelledby="modalSolicitarInfoLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            
            <!-- Cabecera del Modal -->
            <div class="modal-header border-0 bg-dark text-white p-4 position-relative" style="background: linear-gradient(135deg, #0F1113 0%, #1A1D20 100%);">
                <div class="pe-4">
                    <span class="badge bg-warning text-dark fw-bold px-3 py-1 rounded-pill mb-2">
                        <i class="fa-solid fa-headset me-1"></i> ATENCIÓN INMEDIATA
                    </span>
                    <h4 class="modal-title font-montserrat fw-bold text-white mb-1" id="modalSolicitarInfoLabel">
                        Solicitar Información y Asesoría Técnica
                    </h4>
                    <p class="text-white-50 small mb-0">
                        Completa tus datos para recibir temarios detallados, cotización personalizada y asesoría con nuestros especialistas.
                    </p>
                </div>
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-4" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <!-- Cuerpo del Modal con Scroll Interno -->
            <div class="modal-body p-4 bg-light">
                <div class="row g-4">
                    
                    <!-- Columna Izquierda: Contacto Directo WhatsApp y Datos Institucionales -->
                    <div class="col-lg-5 d-flex flex-column justify-content-between border-end-lg pe-lg-4">
                        <div>
                            <h6 class="fw-bold text-dark mb-2 font-montserrat">
                                <i class="fa-solid fa-bolt text-warning me-2"></i>Respuesta Inmediata
                            </h6>
                            <p class="small text-muted mb-3">
                                ¿Deseas una atención al instante? Escríbenos directamente a nuestra central de WhatsApp.
                            </p>
                            
                            <a id="modalWhatsAppBtn" href="https://api.whatsapp.com/send?phone=51993463118&text=Hola,%20deseo%20solicitar%20informaci%C3%B3n%20sobre%20sus%20programas." target="_blank" rel="noopener noreferrer" class="btn btn-success w-100 py-2 fw-bold rounded-3 shadow-sm d-flex align-items-center justify-content-center gap-2 mb-3">
                                <i class="fab fa-whatsapp fa-lg"></i> Chatear por WhatsApp
                            </a>

                            <div class="card border-0 bg-white shadow-sm p-3 rounded-3 mt-2">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-warning-subtle text-dark p-2 rounded-circle">
                                        <i class="fa-solid fa-envelope"></i>
                                    </div>
                                    <div class="small">
                                        <div class="text-muted" style="font-size: 0.78rem;">Correo institucional</div>
                                        <a href="mailto:contacto@quality-consulting.org" class="text-dark fw-semibold text-decoration-none" style="font-size: 0.85rem;">contacto@quality-consulting.org</a>
                                    </div>
                                </div>
                            </div>

                            <div class="card border-0 bg-white shadow-sm p-3 rounded-3 mt-2">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-warning-subtle text-dark p-2 rounded-circle">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>
                                    <div class="small">
                                        <div class="text-muted" style="font-size: 0.78rem;">Central telefónica</div>
                                        <a href="tel:+51993463118" class="text-dark fw-semibold text-decoration-none" style="font-size: 0.85rem;">+51 993 463 118</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top text-muted" style="font-size: 0.8rem;">
                            <i class="fa-solid fa-shield-halved text-warning me-1"></i> Tus datos son tratados con estricta confidencialidad bajo estándares de privacidad.
                        </div>
                    </div>

                    <!-- Columna Derecha: Formulario Completo -->
                    <div class="col-lg-7 ps-lg-4">
                        <h6 class="fw-bold text-dark mb-3 font-montserrat">
                            <i class="fa-solid fa-file-signature text-warning me-2"></i>Datos de Contacto
                        </h6>

                        <!-- Contenedor para Alertas Dinámicas Ajax -->
                        <div id="modalFormFeedback" class="d-none alert py-2 px-3 small mb-3"></div>

                        <form id="modalInfoForm" action="/backend/send-contact.php" method="POST" novalidate>
                            
                            <!-- Campo Honeypot Anti-Spam (Invisible) -->
                            <div style="display:none !important; visibility:hidden !important; position:absolute; left:-9999px;" aria-hidden="true">
                                <label for="_qcs_modal_verification_hp">No completar</label>
                                <input type="text" id="_qcs_modal_verification_hp" name="_qcs_verification_hp" tabindex="-1" autocomplete="off">
                            </div>

                            <!-- Programa / Servicio de Interés -->
                            <div class="mb-3">
                                <label for="modalInputPrograma" class="form-label small fw-bold text-secondary mb-1">Programa o Servicio de Interés <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="fa-solid fa-graduation-cap"></i></span>
                                    <input type="text" class="form-control border-start-0 ps-0 bg-white" id="modalInputPrograma" name="programa" placeholder="Curso, Diplomado o Asesoría" required>
                                </div>
                            </div>

                            <!-- Nombre y Apellidos -->
                            <div class="mb-3">
                                <label for="modalInputNombre" class="form-label small fw-bold text-secondary mb-1">Nombre y Apellidos <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="fa-solid fa-user"></i></span>
                                    <input type="text" class="form-control border-start-0 ps-0 bg-white" id="modalInputNombre" name="nombre" placeholder="Ej. Carlos Rodríguez Mendoza" required autocomplete="name">
                                </div>
                            </div>

                            <!-- Empresa / Organización -->
                            <div class="mb-3">
                                <label for="modalInputEmpresa" class="form-label small fw-bold text-secondary mb-1">Empresa / Organización <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="fa-solid fa-building"></i></span>
                                    <input type="text" class="form-control border-start-0 ps-0 bg-white" id="modalInputEmpresa" name="empresa" placeholder="Empresa donde laboras o Independiente" required autocomplete="organization">
                                </div>
                            </div>

                            <!-- Correo y Teléfono en dos columnas -->
                            <div class="row g-2 mb-3">
                                <div class="col-sm-6">
                                    <label for="modalInputEmail" class="form-label small fw-bold text-secondary mb-1">Correo Electrónico <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="fa-solid fa-envelope"></i></span>
                                        <input type="email" class="form-control border-start-0 ps-0 bg-white" id="modalInputEmail" name="email" placeholder="ejemplo@correo.com" required autocomplete="email">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="modalInputTelefono" class="form-label small fw-bold text-secondary mb-1">Teléfono / WhatsApp <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="fa-solid fa-phone"></i></span>
                                        <input type="tel" class="form-control border-start-0 ps-0 bg-white" id="modalInputTelefono" name="telefono" placeholder="+51 999 999 999" required autocomplete="tel">
                                    </div>
                                </div>
                            </div>

                            <!-- Consulta o Mensaje Específico -->
                            <div class="mb-3">
                                <label for="modalInputConsulta" class="form-label small fw-bold text-secondary mb-1">Consulta o Mensaje <span class="text-danger">*</span></label>
                                <textarea class="form-control bg-white" id="modalInputConsulta" name="consulta" rows="3" placeholder="Indícanos tus consultas sobre temarios, fechas, modalidades o requerimientos in-house..." required></textarea>
                            </div>

                            <!-- Botón Enviar -->
                            <div class="mt-4">
                                <button type="submit" id="modalSubmitBtn" class="btn btn-warning w-100 py-3 fw-bold text-dark rounded-pill shadow-sm font-montserrat btn-qcs-primary">
                                    <span class="btn-text"><i class="fa-solid fa-paper-plane me-2"></i> ENVIAR SOLICITUD</span>
                                    <span class="btn-loading d-none"><i class="fas fa-spinner fa-spin me-2"></i> ENVIANDO...</span>
                                </button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
