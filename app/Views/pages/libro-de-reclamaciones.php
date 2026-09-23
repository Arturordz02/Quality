<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Libro de Reclamaciones Virtual
 * Archivo: app/Views/pages/libro-de-reclamaciones.php
 */

declare(strict_types=1);
?>
    <main>
        <!-- ==========================================================================
             1. HEADER HERO DEL LIBRO DE RECLAMACIONES (Normativa Legal)
             ========================================================================== -->
        <section class="page-banner text-center" style="padding-top: 170px; padding-bottom: 75px; background: linear-gradient(145deg, #0F1113 0%, #1A1D20 50%, #24292E 100%); color: #ffffff; border-bottom: 4px solid var(--qcs-yellow);">
            <div class="container position-relative">
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm animate__animated animate__fadeInDown">
                    <i class="fas fa-gavel me-2"></i> CONFORME A LA LEY N° 29571 / D.S. 011-2011-PCM
                </span>
                <h1 class="page-main-title text-white mb-2 animate__animated animate__fadeInDown">LIBRO DE RECLAMACIONES VIRTUAL</h1>
                <p class="text-light text-opacity-90 mx-auto mb-4 animate__animated animate__fadeInUp animate__delay-1s" style="max-width: 800px; font-size: 1.05rem; line-height: 1.7;">
                    De conformidad con lo establecido en el Código de Protección y Defensa del Consumidor, Quality Consulting Solutions pone a disposición de sus clientes y usuarios su Libro de Reclamaciones Virtual.
                </p>

                <!-- Tarjeta de Identificación del Proveedor -->
                <div class="card border-0 rounded-4 shadow-lg p-4 text-start mx-auto mt-4" style="max-width: 860px; background: rgba(255, 255, 255, 0.98); color: #1e293b;">
                    <div class="row g-3 align-items-center">
                        <div class="col-12 col-md-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="p-3 bg-warning-subtle text-warning rounded-3 fs-3 text-dark">
                                    <i class="fas fa-building text-dark"></i>
                                </div>
                                <div>
                                    <small class="text-muted text-uppercase fw-bold d-block">Razón Social del Proveedor</small>
                                    <strong class="text-dark fs-6">Quality Consulting Solutions S.A.C.</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="p-3 bg-light text-secondary rounded-3 fs-3">
                                    <i class="fas fa-map-marker-alt text-dark"></i>
                                </div>
                                <div>
                                    <small class="text-muted text-uppercase fw-bold d-block">Sede Central y Domicilio Legal</small>
                                    <span class="text-secondary small">Av. Javier Prado 757, piso 10 Magdalena, Lima 17</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ==========================================================================
             2. FORMULARIO OFICIAL DE HOJA DE RECLAMACIÓN
             ========================================================================== -->
        <section class="py-5">
            <div class="container" style="max-width: 900px;">
                <div class="bg-white rounded-4 border p-4 p-md-5 shadow-lg">
                    
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 border-bottom pb-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-warning bg-opacity-25 text-warning p-3 rounded-circle fs-3 text-dark">
                                <i class="fas fa-book-open text-dark"></i>
                            </div>
                            <div>
                                <span class="badge bg-dark text-white fw-bold px-3 py-1 rounded-pill mb-1">HOJA DE RECLAMACIÓN</span>
                                <h2 class="fw-bold font-montserrat text-dark fs-4 mb-0">REGISTRO DE QUEJA O RECLAMO</h2>
                            </div>
                        </div>
                        <div class="text-muted small text-md-end">
                            Canal Oficial Indecopi Perú
                        </div>
                    </div>

                    <!-- Cuadro Informativo de Definiciones Legales -->
                    <div class="alert alert-light border rounded-3 p-3 mb-4 small text-muted">
                        <p class="mb-1"><strong><i class="fas fa-info-circle text-warning me-1"></i> Consideraciones según Ley:</strong></p>
                        <ul class="mb-0 ps-3">
                            <li><strong>Reclamo:</strong> Disconformidad relacionada a los servicios o capacitaciones brindadas.</li>
                            <li><strong>Queja:</strong> Malestar o descontento respecto a la atención al público.</li>
                            <li>El plazo legal máximo de respuesta es de <strong>15 días hábiles</strong> improrrogables.</li>
                        </ul>
                    </div>

                    <!-- Contenedor para Alertas Dinámicas de Envío -->
                    <div id="claimFormAlert" class="mb-4" style="display: none;"></div>

                    <form id="claimForm" action="/backend/submit-claim.php" method="POST" novalidate>
                        
                        <!-- Campo Trampa Anti-Spam (Honeypot) -->
                        <div style="display:none !important; visibility:hidden !important; position:absolute; left:-9999px;" aria-hidden="true">
                            <label for="_qcs_claim_hp">No complete este campo si es humano</label>
                            <input type="text" id="_qcs_claim_hp" name="_qcs_verification_hp" tabindex="-1" autocomplete="off">
                        </div>

                        <div class="row g-3">
                            
                            <!-- 1. Identificación del Consumidor Reclamante -->
                            <div class="col-12 mt-2">
                                <h5 class="fw-bold text-dark font-montserrat border-bottom pb-2 small text-uppercase" style="letter-spacing: 0.5px;">
                                    1. Identificación del Consumidor Reclamante
                                </h5>
                            </div>

                            <div class="col-md-6">
                                <label for="claimNombre" class="form-label fw-bold small text-secondary">Nombre y Apellido / Razón Social <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                                    <input type="text" id="claimNombre" name="nombre" class="form-control border-start-0 ps-0" placeholder="Ej. Juan Pérez / Empresa S.A.C." required autocomplete="name">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="claimDocumento" class="form-label fw-bold small text-secondary">Documento de Identidad (DNI / CE / RUC) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-id-card text-muted"></i></span>
                                    <input type="text" id="claimDocumento" name="documento" class="form-control border-start-0 ps-0" placeholder="N° de Documento" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="claimEmail" class="form-label fw-bold small text-secondary">Correo Electrónico <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                                    <input type="email" id="claimEmail" name="email" class="form-control border-start-0 ps-0" placeholder="ejemplo@correo.com" required autocomplete="email">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="claimTelefono" class="form-label fw-bold small text-secondary">Teléfono o Celular de Contacto <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-phone text-muted"></i></span>
                                    <input type="tel" id="claimTelefono" name="telefono" class="form-control border-start-0 ps-0" placeholder="+51 999 999 999" required autocomplete="tel">
                                </div>
                            </div>

                            <!-- 2. Detalle de la Reclamación -->
                            <div class="col-12 mt-4">
                                <h5 class="fw-bold text-dark font-montserrat border-bottom pb-2 small text-uppercase" style="letter-spacing: 0.5px;">
                                    2. Detalle de la Reclamación y Pedido
                                </h5>
                            </div>

                            <div class="col-md-6">
                                <label for="claimTipo" class="form-label fw-bold small text-secondary">Tipo de Registro <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-list-check text-muted"></i></span>
                                    <select id="claimTipo" name="tipo" class="form-select border-start-0 ps-0" required>
                                        <option value="">Seleccione el tipo...</option>
                                        <option value="reclamo">Reclamo (Disconformidad con el servicio o curso)</option>
                                        <option value="queja">Queja (Malestar con la atención al cliente)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="claimServicio" class="form-label fw-bold small text-secondary">Servicio o Curso Contratado <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-tag text-muted"></i></span>
                                    <input type="text" id="claimServicio" name="servicio" class="form-control border-start-0 ps-0" placeholder="Nombre del servicio, curso o consultoría" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="claimDetalle" class="form-label fw-bold small text-secondary">Detalle de los Hechos y Motivo <span class="text-danger">*</span></label>
                                <textarea id="claimDetalle" name="detalle" class="form-control" rows="5" placeholder="Describa con claridad y precisión los hechos ocurridos..." required></textarea>
                            </div>

                            <div class="col-12 text-end mt-4">
                                <button type="submit" id="claimSubmitBtn" class="btn btn-qcs-primary btn-lg fw-bold rounded-pill px-5 py-3 shadow">
                                    <span class="btn-text"><i class="fas fa-paper-plane me-2"></i> ENVIAR HOJA DE RECLAMACIÓN</span>
                                    <span class="btn-loading d-none"><i class="fas fa-spinner fa-spin me-2"></i> PROCESANDO REGISTRO...</span>
                                </button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </section>

    </main>
