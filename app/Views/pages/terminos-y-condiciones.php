<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Términos y Condiciones de Uso y Aviso Legal
 * Archivo: app/Views/pages/terminos-y-condiciones.php
 *
 * Página institucional que establece las condiciones de contratación de consultoría,
 * políticas de capacitación, propiedad intelectual y protección de datos (Ley N° 29733).
 */

declare(strict_types=1);
?>
<style>
    body {
        background-color: var(--qcs-bg-light);
        color: #1e293b;
    }

    /* ----------------------------------------------------
       1. HERO SECTION (Executive Helpdesk Style)
       ---------------------------------------------------- */
    .contact-hero-banner {
        position: relative;
        padding: 190px 1.5rem 85px 1.5rem;
        background: linear-gradient(145deg, #0F1113 0%, #1A1D20 50%, #24292E 100%);
        color: #ffffff;
        overflow: hidden;
        border-bottom: 4px solid var(--accent-gold);
    }

    .contact-hero-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 85% 25%, rgba(229, 168, 19, 0.22) 0%, transparent 60%),
                    radial-gradient(circle at 15% 80%, rgba(142, 146, 151, 0.15) 0%, transparent 60%);
        pointer-events: none;
    }

    .contact-hero-pattern {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px);
        background-size: 28px 28px;
        opacity: 0.6;
        pointer-events: none;
    }

    .contact-hero-title {
        font-family: var(--font-heading);
        font-weight: 800;
        font-size: clamp(2.2rem, 4.5vw, 3.4rem);
        letter-spacing: -0.5px;
        color: #ffffff;
        margin-bottom: 1rem;
        text-shadow: 0 4px 16px rgba(0, 0, 0, 0.35);
    }

    .contact-hero-subtitle {
        font-family: var(--font-body);
        font-size: clamp(1.05rem, 1.8vw, 1.25rem);
        color: #e2e8f0;
        max-width: 820px;
        margin: 0 auto 2.5rem auto;
        line-height: 1.7;
    }

    /* Hero Quick Channels Grid */
    .hero-channel-card {
        background: rgba(255, 255, 255, 0.07);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.16);
        border-radius: 18px;
        padding: 1.5rem 1.25rem;
        text-align: center;
        transition: all 0.3s ease;
        height: 100%;
    }

    .hero-channel-card:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.14);
        border-color: var(--accent-gold);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
    }

    .hero-channel-icon {
        width: 52px;
        height: 52px;
        margin: 0 auto 1rem auto;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
    }

    .hero-channel-name {
        font-family: var(--font-heading);
        font-size: 0.95rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 0.35rem;
    }

    .hero-channel-desc {
        font-size: 0.84rem;
        color: #cbd5e1;
        margin-bottom: 0.6rem;
    }

    /* ----------------------------------------------------
       2. FORMULARIO & TARJETA DE SOPORTE (Layout 2 Col)
       ---------------------------------------------------- */
    .contact-form-card {
        border: 1px solid #e2e8f0;
        transition: box-shadow 0.3s ease;
    }

    .contact-form-card:hover {
        box-shadow: 0 20px 45px rgba(15, 17, 19, 0.2) !important;
    }

    .contact-form-title {
        font-family: var(--font-heading);
        font-weight: 800;
        font-size: 1.65rem;
        color: var(--qcs-dark-slate);
        letter-spacing: -0.3px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--qcs-yellow);
        box-shadow: 0 0 0 0.25rem rgba(15, 17, 19, 0.2);
    }

    .input-group-text {
        border-color: #dee2e6;
    }

    /* Tarjeta de Soporte y WhatsApp */
    .support-info-card {
        background: linear-gradient(145deg, #0F1113 0%, #1A1D20 60%, #1A1D20 100%);
        border: 1px solid rgba(255, 255, 255, 0.12);
        position: relative;
        overflow: hidden;
        height: 100%;
    }

    .support-info-card::before {
        content: '';
        position: absolute;
        top: -30%;
        right: -30%;
        width: 280px;
        height: 280px;
        background: radial-gradient(circle, rgba(34, 197, 94, 0.15) 0%, transparent 70%);
        pointer-events: none;
    }

    .schedule-box {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 14px;
        padding: 1.25rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        margin: 1.5rem 0;
    }

    .schedule-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.9rem;
        padding: 0.4rem 0;
        border-bottom: 1px dashed rgba(255, 255, 255, 0.12);
    }

    .schedule-row:last-child {
        border-bottom: none;
    }

    .social-pill-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        color: #ffffff;
        font-size: 1.15rem;
        transition: all var(--transition-fast);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .social-pill-btn.linkedin:hover { background: #0077b5; border-color: #0077b5; transform: translateY(-3px); }
    .social-pill-btn.facebook:hover { background: #1877f2; border-color: #1877f2; transform: translateY(-3px); }
    .social-pill-btn.youtube:hover { background: #ff0000; border-color: #ff0000; transform: translateY(-3px); }
    .social-pill-btn.whatsapp:hover { background: #25d366; border-color: #25d366; transform: translateY(-3px); }

    /* ----------------------------------------------------
       3. MAPA & CIERRE CORPORATIVO
       ---------------------------------------------------- */
    .map-section-wrapper {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid #e2e8f0;
        padding: 3rem 2.5rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.04);
    }

    .contact-cta-banner {
        background: linear-gradient(145deg, #0F1113 0%, #1A1D20 50%, #24292E 100%);
        border-radius: 24px;
        padding: 3.5rem 2.5rem;
        color: #ffffff;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 45px rgba(15, 17, 19, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .contact-cta-banner::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(229, 168, 19, 0.2) 0%, transparent 70%);
        pointer-events: none;
    }
</style>

<main>
    <!-- ==========================================================================
         HERO BANNER: TÉRMINOS Y CONDICIONES
         ========================================================================== -->
    <section class="page-banner text-center" style="padding-top: 180px; padding-bottom: 80px; background: linear-gradient(145deg, #0F1113 0%, #1A1D20 50%, #24292E 100%); color: #ffffff; border-bottom: 4px solid var(--accent-gold);">
        <div class="container position-relative" style="z-index: 2;">
            <div class="d-inline-block mb-3">
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold shadow-sm">
                    <i class="fas fa-shield-halved me-2"></i> MARCO LEGAL Y PROTECCIÓN AL USUARIO
                </span>
            </div>
            <h1 class="display-5 fw-bold text-white mb-3">Términos y Condiciones de Uso y Aviso Legal</h1>
            <p class="lead text-light text-opacity-90 mx-auto" style="max-width: 820px; font-size: 1.1rem; line-height: 1.7;">
                Transparencia, condiciones de contratación de consultoría y capacitación, y políticas de protección de datos personales de Quality Consulting Solutions S.A.C.
            </p>
            
            <!-- Ficha de Datos Corporativos -->
            <div class="card border-0 rounded-4 shadow-lg p-3 text-start mx-auto mt-4" style="max-width: 860px; background: rgba(255, 255, 255, 0.95); color: #1e293b;">
                <div class="row g-3 align-items-center text-center text-md-start">
                    <div class="col-12 col-md-4">
                        <small class="text-muted text-uppercase fw-bold d-block">Titular de la Web</small>
                        <strong class="text-dark">Quality Consulting Solutions S.A.C.</strong>
                    </div>
                    <div class="col-12 col-md-4">
                        <small class="text-muted text-uppercase fw-bold d-block">Registro Tributario (SUNAT)</small>
                        <span class="badge bg-secondary text-white fw-bold">RUC: [En trámite / Por actualizar]</span>
                    </div>
                    <div class="col-12 col-md-4">
                        <small class="text-muted text-uppercase fw-bold d-block">Sede y Jurisdicción</small>
                        <span class="text-secondary small">Lima, República del Perú</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================================================
         CONTENIDO PRINCIPAL: CLÁUSULAS LEGALES
         ========================================================================== -->
    <section class="py-5" style="background-color: var(--qcs-bg-light);">
        <div class="container">
            <div class="row g-4">
                
                <!-- Menú Lateral de Navegación Rápida -->
                <div class="col-lg-4 d-none d-lg-block">
                    <div class="card border rounded-4 shadow-sm p-4 sticky-top" style="top: 100px;">
                        <h5 class="fw-bold font-montserrat text-dark mb-3 pb-2 border-bottom">
                            <i class="fas fa-list-ol text-warning me-2"></i> Índice de Cláusulas
                        </h5>
                        <ul class="list-unstyled mb-0 small">
                            <li class="mb-2"><a href="#clausula-1" class="text-decoration-none text-dark fw-semibold"><i class="fas fa-angle-right text-warning me-1"></i> 1. Información General</a></li>
                            <li class="mb-2"><a href="#clausula-2" class="text-decoration-none text-dark fw-semibold"><i class="fas fa-angle-right text-warning me-1"></i> 2. Objeto de Servicios</a></li>
                            <li class="mb-2"><a href="#clausula-3" class="text-decoration-none text-dark fw-semibold"><i class="fas fa-angle-right text-warning me-1"></i> 3. Cotizaciones y Pagos</a></li>
                            <li class="mb-2"><a href="#clausula-4" class="text-decoration-none text-dark fw-semibold"><i class="fas fa-angle-right text-warning me-1"></i> 4. Capacitación y Certificación</a></li>
                            <li class="mb-2"><a href="#clausula-5" class="text-decoration-none text-dark fw-semibold"><i class="fas fa-angle-right text-warning me-1"></i> 5. Propiedad Intelectual</a></li>
                            <li class="mb-2"><a href="#clausula-6" class="text-decoration-none text-dark fw-semibold"><i class="fas fa-angle-right text-warning me-1"></i> 6. Protección de Datos (Ley 29733)</a></li>
                            <li class="mb-2"><a href="#clausula-7" class="text-decoration-none text-dark fw-semibold"><i class="fas fa-angle-right text-warning me-1"></i> 7. Libro de Reclamaciones</a></li>
                            <li class="mb-2"><a href="#clausula-8" class="text-decoration-none text-dark fw-semibold"><i class="fas fa-angle-right text-warning me-1"></i> 8. Exclusión de Responsabilidad</a></li>
                            <li class="mb-2"><a href="#clausula-9" class="text-decoration-none text-dark fw-semibold"><i class="fas fa-angle-right text-warning me-1"></i> 9. Modificación de Términos</a></li>
                            <li class="mb-2"><a href="#clausula-10" class="text-decoration-none text-dark fw-semibold"><i class="fas fa-angle-right text-warning me-1"></i> 10. Jurisdicción en Perú</a></li>
                        </ul>
                        <div class="mt-4 pt-3 border-top text-center">
                            <a href="/contacto" class="btn btn-warning fw-bold w-100 rounded-pill py-2 shadow-sm">
                                <i class="fas fa-headset me-2"></i> ¿Dudas? Escríbenos
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Cuerpo de Términos y Condiciones -->
                <div class="col-lg-8">
                    
                    <!-- Cláusula 1 -->
                    <div class="card border rounded-4 shadow-sm p-4 p-md-5 mb-4" id="clausula-1">
                        <div class="d-flex align-items-center mb-3">
                            <span class="p-2 bg-warning-subtle text-warning rounded-3 me-3 fs-5"><i class="fas fa-building text-dark"></i></span>
                            <h3 class="h4 fw-bold font-montserrat text-dark mb-0">1. Información General y Titularidad</h3>
                        </div>
                        <p class="text-secondary">
                            El presente documento regula el acceso, navegación y utilización de los sitios web corporativos <strong>quality-consulting.org</strong> y <strong>pmo-solutions.com</strong>, operados por <strong>Quality Consulting Solutions S.A.C.</strong> (en adelante, <em>"LA EMPRESA"</em> o <em>"QUALITY CONSULTING SOLUTIONS"</em>), con <strong>RUC: [En trámite / Por actualizar]</strong>, domicilio legal en Av. Javier Prado 757, piso 10, Magdalena del Mar, Lima 17, Perú, y correo electrónico oficial de contacto: <a href="mailto:contacto@quality-consulting.org" class="text-warning fw-bold">contacto@quality-consulting.org</a>.
                        </p>
                        <p class="text-secondary mb-0">
                            El acceso y uso de este portal atribuye la condición de <strong>"USUARIO"</strong>, quien declara conocer y aceptar sin reservas todos los términos y condiciones aquí contemplados. Si no está de acuerdo con alguna disposición, deberá abstenerse de utilizar el sitio.
                        </p>
                    </div>

                    <!-- Cláusula 2 -->
                    <div class="card border rounded-4 shadow-sm p-4 p-md-5 mb-4" id="clausula-2">
                        <div class="d-flex align-items-center mb-3">
                            <span class="p-2 bg-warning-subtle text-warning rounded-3 me-3 fs-5"><i class="fas fa-briefcase text-dark"></i></span>
                            <h3 class="h4 fw-bold font-montserrat text-dark mb-0">2. Objeto y Alcance de los Servicios</h3>
                        </div>
                        <p class="text-secondary">
                            LA EMPRESA brinda servicios de ingeniería especializada, dirección estratégica de proyectos y programas de formación profesional para los sectores de construcción, infraestructura y minería. Los servicios comprenden:
                        </p>
                        <ul class="text-secondary mb-0">
                            <li><strong>Consultoría Técnica y Gestión Contractual:</strong> Administración experta en contratos FIDIC, NEC3/NEC4, Contrataciones con el Estado (OSCE), Oficina Técnica, aseguramiento QA/QC, auditorías de proyectos y peritajes forenses de cronogramas.</li>
                            <li><strong>Oficina de Gestión de Proyectos (PMO):</strong> Diseño, estructuración, gobernanza y madurez de PMOs según estándares internacionales del PMI.</li>
                            <li><strong>Programas de Capacitación Corporativa:</strong> Cursos in-company, talleres ejecutivos, diplomados y metodologías ágiles (Lean Construction, Last Planner System, Lego Serious Play).</li>
                            <li><strong>Headhunting Técnico Especializado:</strong> Búsqueda y selección de talento directivo y operativo para obras civiles y megaproyectos.</li>
                        </ul>
                    </div>

                    <!-- Cláusula 3 -->
                    <div class="card border rounded-4 shadow-sm p-4 p-md-5 mb-4" id="clausula-3">
                        <div class="d-flex align-items-center mb-3">
                            <span class="p-2 bg-warning-subtle text-warning rounded-3 me-3 fs-5"><i class="fas fa-file-invoice-dollar text-dark"></i></span>
                            <h3 class="h4 fw-bold font-montserrat text-dark mb-0">3. Cotizaciones, Precios y Condiciones de Pago</h3>
                        </div>
                        <p class="text-secondary">
                            Los precios, temarios y promociones mostrados en la web tienen carácter informativo. La contratación efectiva se rige bajo los siguientes principios:
                        </p>
                        <div class="alert alert-light border rounded-3 p-3 mb-0">
                            <ul class="mb-0 text-secondary ps-3">
                                <li><strong>Propuestas Formales:</strong> Los alcances técnicos, plazos y costos finales quedan fijados en la Propuesta Técnico-Económica (PTE) o Contrato de Locación de Servicios aceptado por el cliente.</li>
                                <li><strong>Impuestos:</strong> Los importes cotizados no incluyen el Impuesto General a las Ventas (IGV - 18%), salvo que se señale expresamente lo contrario.</li>
                                <li><strong>Comprobantes de Pago:</strong> LA EMPRESA emitirá la correspondiente Factura Electrónica o Boleta de Venta conforme a la normativa de la SUNAT una vez confirmado el abono bancario.</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Cláusula 4 -->
                    <div class="card border rounded-4 shadow-sm p-4 p-md-5 mb-4" id="clausula-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="p-2 bg-warning-subtle text-warning rounded-3 me-3 fs-5"><i class="fas fa-graduation-cap text-dark"></i></span>
                            <h3 class="h4 fw-bold font-montserrat text-dark mb-0">4. Políticas de Capacitación, Certificación y Cancelaciones</h3>
                        </div>
                        <h6 class="fw-bold text-dark mt-3">4.1. Emisión de Certificados y Diplomas</h6>
                        <p class="text-secondary">
                            La entrega del diploma o certificado de participación/aprobación requiere el cumplimiento de los requisitos académicos estipulados en el sílabo, incluyendo una asistencia mínima del <strong>80%</strong> a las sesiones lectivas y la aprobación de las evaluaciones programadas.
                        </p>
                        <h6 class="fw-bold text-dark mt-3">4.2. Reprogramaciones y Sustituciones</h6>
                        <p class="text-secondary mb-0">
                            El cliente podrá sustituir a un participante registrado notificándolo por escrito con un mínimo de <strong>48 horas de anticipación</strong> al inicio del curso. Una vez iniciado el programa o facilitadas las credenciales de acceso al material digital, no se admitirán devoluciones económicas.
                        </p>
                    </div>

                    <!-- Cláusula 5 -->
                    <div class="card border rounded-4 shadow-sm p-4 p-md-5 mb-4" id="clausula-5">
                        <div class="d-flex align-items-center mb-3">
                            <span class="p-2 bg-warning-subtle text-warning rounded-3 me-3 fs-5"><i class="fas fa-copyright text-dark"></i></span>
                            <h3 class="h4 fw-bold font-montserrat text-dark mb-0">5. Propiedad Intelectual y Derechos de Autor</h3>
                        </div>
                        <p class="text-secondary">
                            Todos los elementos del sitio web (marcas comerciales, logotipos, metodologías propietarias como <em>Síndrome del 90%</em>, matrices de riesgo, plantillas de valor ganado, presentaciones, casos de estudio y código fuente) son propiedad exclusiva de <strong>Quality Consulting Solutions S.A.C.</strong>
                        </p>
                        <p class="text-secondary mb-0">
                            Queda terminantemente prohibida su reproducción, retransmisión, distribución pública, comercialización o explotación sin autorización previa, expresa y por escrito de LA EMPRESA.
                        </p>
                    </div>

                    <!-- Cláusula 6 -->
                    <div class="card border rounded-4 shadow-sm p-4 p-md-5 mb-4" id="clausula-6">
                        <div class="d-flex align-items-center mb-3">
                            <span class="p-2 bg-warning-subtle text-warning rounded-3 me-3 fs-5"><i class="fas fa-user-shield text-dark"></i></span>
                            <h3 class="h4 fw-bold font-montserrat text-dark mb-0">6. Protección de Datos Personales (Ley N° 29733)</h3>
                        </div>
                        <p class="text-secondary">
                            En cumplimiento de la <strong>Ley N° 29733 (Ley de Protección de Datos Personales del Perú)</strong> y su Reglamento (D.S. N° 003-2013-JUS), los datos suministrados a través de formularios serán tratados con estricta confidencialidad y medidas de seguridad técnicas.
                        </p>
                        <div class="alert alert-light border rounded-3 p-3 mb-0">
                            <p class="fw-bold mb-1 text-dark"><i class="fas fa-info-circle text-warning me-1"></i> Finalidades del Tratamiento:</p>
                            <p class="small text-secondary mb-2">Atención de cotizaciones, gestión de inscripciones académicas, emisión de constancias, procesamiento del Libro de Reclamaciones y envío de información técnica especializada.</p>
                            <p class="fw-bold mb-1 text-dark">Ejercicio de Derechos ARCO:</p>
                            <p class="small text-secondary mb-0">El titular de los datos puede ejercer sus derechos de Acceso, Rectificación, Cancelación y Oposición enviando un correo a <a href="mailto:contacto@quality-consulting.org" class="text-warning fw-bold">contacto@quality-consulting.org</a> adjuntando copia de su documento de identidad.</p>
                        </div>
                    </div>

                    <!-- Cláusula 7 -->
                    <div class="card border rounded-4 shadow-sm p-4 p-md-5 mb-4" id="clausula-7">
                        <div class="d-flex align-items-center mb-3">
                            <span class="p-2 bg-warning-subtle text-warning rounded-3 me-3 fs-5"><i class="fas fa-book-open text-dark"></i></span>
                            <h3 class="h4 fw-bold font-montserrat text-dark mb-0">7. Libro de Reclamaciones Virtual (Ley N° 29571)</h3>
                        </div>
                        <p class="text-secondary">
                            Conforme a lo dispuesto por el Código de Protección y Defensa del Consumidor, LA EMPRESA cuenta con una plataforma virtual de Libro de Reclamaciones.
                        </p>
                        <p class="text-secondary mb-3">
                            Al enviar una queja o reclamo, el sistema emitirá automáticamente una constancia con código único al correo del usuario. Conforme a ley, el plazo de respuesta es no mayor a <strong>15 días hábiles improrrogables</strong>.
                        </p>
                        <a href="/libro-de-reclamaciones" class="btn btn-outline-dark btn-sm rounded-pill px-3 py-2 fw-bold">
                            <i class="fas fa-external-link-alt me-1 text-warning"></i> Ir al Libro de Reclamaciones Virtual
                        </a>
                    </div>

                    <!-- Cláusula 8 -->
                    <div class="card border rounded-4 shadow-sm p-4 p-md-5 mb-4" id="clausula-8">
                        <div class="d-flex align-items-center mb-3">
                            <span class="p-2 bg-warning-subtle text-warning rounded-3 me-3 fs-5"><i class="fas fa-hand-holding-hand text-dark"></i></span>
                            <h3 class="h4 fw-bold font-montserrat text-dark mb-0">8. Exclusión de Responsabilidad</h3>
                        </div>
                        <p class="text-secondary mb-0">
                            Los artículos, podcasts y opiniones técnicas publicados en el portal tienen fines orientativos e informativos. No constituyen dictamen pericial vinculante sin un análisis específico de ingeniería in situ. Asimismo, LA EMPRESA no responde por interrupciones en la disponibilidad derivadas de proveedores de telecomunicaciones o incidencias de fuerza mayor.
                        </p>
                    </div>

                    <!-- Cláusula 9 -->
                    <div class="card border rounded-4 shadow-sm p-4 p-md-5 mb-4" id="clausula-9">
                        <div class="d-flex align-items-center mb-3">
                            <span class="p-2 bg-warning-subtle text-warning rounded-3 me-3 fs-5"><i class="fas fa-rotate text-dark"></i></span>
                            <h3 class="h4 fw-bold font-montserrat text-dark mb-0">9. Modificación de los Términos</h3>
                        </div>
                        <p class="text-secondary mb-0">
                            QUALITY CONSULTING SOLUTIONS se reserva el derecho de actualizar, modificar o reemplazar estos términos para adecuarlos a nuevas disposiciones legales o mejoras operativas. Las modificaciones entrarán en vigencia desde su publicación en esta página.
                        </p>
                    </div>

                    <!-- Cláusula 10 -->
                    <div class="card border rounded-4 shadow-sm p-4 p-md-5 mb-0" id="clausula-10">
                        <div class="d-flex align-items-center mb-3">
                            <span class="p-2 bg-warning-subtle text-warning rounded-3 me-3 fs-5"><i class="fas fa-gavel text-dark"></i></span>
                            <h3 class="h4 fw-bold font-montserrat text-dark mb-0">10. Legislación Aplicable y Jurisdicción</h3>
                        </div>
                        <p class="text-secondary mb-0">
                            Para todos los efectos legales, las partes se someten expresamente a las leyes de la <strong>República del Perú</strong> y a la competencia territorial de los <strong>Jueces y Tribunales del Distrito Judicial de Lima Centro</strong>, renunciando a cualquier otro fuero que pudiera corresponderles.
                        </p>
                    </div>

                </div>

            </div>
        </div>
    </section>
</main>

