<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Términos y Condiciones de Uso y Aviso Legal
 * Archivo: app/Views/pages/terminos-y-condiciones.php
 *
 * Página institucional formal que establece las condiciones de contratación de consultoría,
 * políticas de capacitación, propiedad intelectual y protección de datos (Ley N° 29733).
 */

declare(strict_types=1);
?>
<style>
    body {
        background-color: #f8fafc;
        color: #1e293b;
    }

    /* ----------------------------------------------------
       1. HERO SECTION INSTITUCIONAL FORMAL
       ---------------------------------------------------- */
    .legal-hero-banner {
        position: relative;
        padding: 190px 1.5rem 70px 1.5rem;
        background: linear-gradient(145deg, #0F1113 0%, #1A1D20 50%, #24292E 100%);
        color: #ffffff;
        overflow: hidden;
        border-bottom: 4px solid var(--accent-gold, #E5A813);
    }

    .legal-hero-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 85% 20%, rgba(229, 168, 19, 0.18) 0%, transparent 60%),
                    radial-gradient(circle at 15% 80%, rgba(142, 146, 151, 0.12) 0%, transparent 60%);
        pointer-events: none;
    }

    .legal-hero-pattern {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px);
        background-size: 28px 28px;
        opacity: 0.5;
        pointer-events: none;
    }

    .legal-hero-title {
        font-family: var(--font-heading, 'Montserrat', sans-serif);
        font-weight: 800;
        font-size: clamp(2rem, 3.8vw, 3rem);
        letter-spacing: -0.5px;
        color: #ffffff;
        margin-bottom: 0.85rem;
        text-shadow: 0 4px 16px rgba(0, 0, 0, 0.35);
    }

    .legal-hero-subtitle {
        font-family: var(--font-body, 'Open Sans', sans-serif);
        font-size: clamp(1rem, 1.5vw, 1.15rem);
        color: #cbd5e1;
        max-width: 820px;
        margin: 0 auto 2rem auto;
        line-height: 1.7;
    }

    .legal-corp-card {
        background: rgba(255, 255, 255, 0.98);
        border: 1px solid rgba(226, 232, 240, 0.9);
        border-radius: 16px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        color: #1e293b;
        max-width: 860px;
        margin: 0 auto;
        padding: 1.5rem 2rem;
    }

    /* ----------------------------------------------------
       2. ESTRUCTURA DE NAVEGACIÓN Y CLÁUSULAS
       ---------------------------------------------------- */
    [id^="clausula-"] {
        scroll-margin-top: 170px;
    }

    .legal-sidebar-sticky {
        position: sticky;
        top: 160px;
        z-index: 10;
    }

    .legal-sidebar-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        padding: 1.75rem 1.5rem;
    }

    .legal-sidebar-header {
        padding-bottom: 1rem;
        margin-bottom: 1.25rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .legal-sidebar-badge {
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: #b45309;
        display: block;
        margin-bottom: 0.25rem;
    }

    .legal-sidebar-title {
        font-family: var(--font-heading, 'Montserrat', sans-serif);
        font-size: 1.15rem;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
    }

    .legal-nav-list {
        display: flex;
        flex-direction: column;
        gap: 0.35rem;
    }

    .legal-nav-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.6rem 0.85rem;
        border-radius: 10px;
        color: #475569;
        text-decoration: none;
        font-size: 0.88rem;
        font-weight: 500;
        transition: all 0.2s ease;
        border-left: 3px solid transparent;
    }

    .legal-nav-item:hover {
        background-color: #f1f5f9;
        color: #0f172a;
        border-left-color: var(--accent-gold, #E5A813);
        padding-left: 1.1rem;
    }

    .legal-nav-num {
        font-family: var(--font-heading, 'Montserrat', sans-serif);
        font-size: 0.78rem;
        font-weight: 700;
        color: #94a3b8;
        min-width: 20px;
    }

    .legal-nav-item:hover .legal-nav-num {
        color: #b45309;
    }

    .legal-sidebar-footer {
        margin-top: 1.5rem;
        padding-top: 1.25rem;
        border-top: 1px solid #e2e8f0;
    }

    /* ----------------------------------------------------
       3. TARJETAS DE CLÁUSULAS
       ---------------------------------------------------- */
    .legal-clause-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.03);
        padding: 2.25rem;
        margin-bottom: 1.75rem;
        transition: border-color 0.2s ease;
    }

    .legal-clause-card:hover {
        border-color: #cbd5e1;
    }

    .clause-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.25rem;
        padding-bottom: 0.85rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .clause-num-badge {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: #0f172a;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--font-heading, 'Montserrat', sans-serif);
        font-weight: 800;
        font-size: 0.92rem;
        flex-shrink: 0;
        box-shadow: 0 2px 6px rgba(15, 23, 42, 0.15);
    }

    .clause-title {
        font-family: var(--font-heading, 'Montserrat', sans-serif);
        font-weight: 800;
        font-size: 1.25rem;
        color: #0f172a;
        margin: 0;
        letter-spacing: -0.2px;
    }

    .legal-clause-card p {
        color: #334155;
        line-height: 1.8;
        font-size: 0.95rem;
    }

    .legal-clause-card ul {
        color: #334155;
        line-height: 1.8;
        font-size: 0.95rem;
    }

    .legal-clause-card li {
        margin-bottom: 0.5rem;
    }

    .legal-note-box {
        background: #f8fafc;
        border-left: 3px solid var(--accent-gold, #E5A813);
        border-radius: 0 10px 10px 0;
        padding: 1.15rem 1.25rem;
        margin-top: 1.25rem;
    }
</style>

<main>
    <!-- ==========================================================================
         HERO BANNER: TÉRMINOS Y CONDICIONES
         ========================================================================== -->
    <section class="legal-hero-banner text-center">
        <div class="legal-hero-pattern"></div>
        <div class="container position-relative" style="z-index: 2;">
            <div class="d-inline-block mb-3">
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold shadow-sm" style="font-size: 0.8rem; letter-spacing: 0.5px;">
                    <i class="fa-solid fa-scale-balanced me-2"></i> MARCO LEGAL Y TRANSPARENCIA CORPORATIVA
                </span>
            </div>
            <h1 class="legal-hero-title">Términos y Condiciones de Uso y Aviso Legal</h1>
            <p class="legal-hero-subtitle">
                Condiciones generales de acceso, navegación, prestación de consultoría técnica, programas de capacitación profesional y protección de datos de Quality Consulting Solutions S.A.C.
            </p>
            
            <!-- Ficha de Datos Corporativos -->
            <div class="legal-corp-card text-start">
                <div class="row g-3 align-items-center text-center text-md-start">
                    <div class="col-12 col-md-4">
                        <small class="text-muted text-uppercase fw-bold d-block" style="font-size: 0.72rem; letter-spacing: 0.5px;">Razón Social</small>
                        <strong class="text-dark" style="font-size: 0.95rem;">Quality Consulting Solutions S.A.C.</strong>
                    </div>
                    <div class="col-12 col-md-4">
                        <small class="text-muted text-uppercase fw-bold d-block" style="font-size: 0.72rem; letter-spacing: 0.5px;">Sede y Jurisdicción</small>
                        <span class="text-secondary small fw-semibold">Lima, República del Perú</span>
                    </div>
                    <div class="col-12 col-md-4">
                        <small class="text-muted text-uppercase fw-bold d-block" style="font-size: 0.72rem; letter-spacing: 0.5px;">Canal Oficial Legal</small>
                        <a href="mailto:contacto@quality-consulting.org" class="text-dark fw-bold text-decoration-none small">contacto@quality-consulting.org</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================================================
         CONTENIDO PRINCIPAL: CLÁUSULAS LEGALES
         ========================================================================== -->
    <section class="py-5" style="background-color: #f8fafc;">
        <div class="container">
            <div class="row g-4 align-items-start">
                
                <!-- Menú Lateral de Navegación Rápida -->
                <div class="col-lg-4 d-none d-lg-block">
                    <div class="legal-sidebar-sticky">
                        <div class="legal-sidebar-card">
                            <div class="legal-sidebar-header">
                                <span class="legal-sidebar-badge">ESTRUCTURA DEL DOCUMENTO</span>
                                <h3 class="legal-sidebar-title">Índice de Cláusulas</h3>
                            </div>
                            <nav class="legal-nav-list">
                                <a href="#clausula-1" class="legal-nav-item">
                                    <span class="legal-nav-num">01</span>
                                    <span>Información General y Titularidad</span>
                                </a>
                                <a href="#clausula-2" class="legal-nav-item">
                                    <span class="legal-nav-num">02</span>
                                    <span>Objeto y Alcance de Servicios</span>
                                </a>
                                <a href="#clausula-3" class="legal-nav-item">
                                    <span class="legal-nav-num">03</span>
                                    <span>Cotizaciones, Precios y Pagos</span>
                                </a>
                                <a href="#clausula-4" class="legal-nav-item">
                                    <span class="legal-nav-num">04</span>
                                    <span>Capacitación y Certificación</span>
                                </a>
                                <a href="#clausula-5" class="legal-nav-item">
                                    <span class="legal-nav-num">05</span>
                                    <span>Propiedad Intelectual</span>
                                </a>
                                <a href="#clausula-6" class="legal-nav-item">
                                    <span class="legal-nav-num">06</span>
                                    <span>Protección de Datos Personales</span>
                                </a>
                                <a href="#clausula-7" class="legal-nav-item">
                                    <span class="legal-nav-num">07</span>
                                    <span>Libro de Reclamaciones</span>
                                </a>
                                <a href="#clausula-8" class="legal-nav-item">
                                    <span class="legal-nav-num">08</span>
                                    <span>Exclusión de Responsabilidad</span>
                                </a>
                                <a href="#clausula-9" class="legal-nav-item">
                                    <span class="legal-nav-num">09</span>
                                    <span>Modificación de Términos</span>
                                </a>
                                <a href="#clausula-10" class="legal-nav-item">
                                    <span class="legal-nav-num">10</span>
                                    <span>Jurisdicción y Ley Aplicable</span>
                                </a>
                            </nav>
                            <div class="legal-sidebar-footer">
                                <p class="small text-muted mb-2">Para consultas formales o contractuales:</p>
                                <a href="/contacto" class="btn btn-outline-dark btn-sm w-100 rounded-pill py-2 fw-bold d-flex align-items-center justify-content-center gap-2">
                                    <i class="fa-solid fa-envelope"></i> Mesa de Contacto Oficial
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cuerpo de Términos y Condiciones -->
                <div class="col-lg-8">
                    
                    <!-- Cláusula 1 -->
                    <article class="legal-clause-card" id="clausula-1">
                        <div class="clause-header">
                            <span class="clause-num-badge">01</span>
                            <h2 class="clause-title">Información General y Titularidad</h2>
                        </div>
                        <p>
                            El presente documento regula el acceso, navegación y utilización de los portales web oficiales <strong>quality-consulting.org</strong> y <strong>pmo-solutions.com</strong>, de titularidad de <strong>Quality Consulting Solutions S.A.C.</strong> (en adelante, <em>"LA EMPRESA"</em> o <em>"QUALITY CONSULTING SOLUTIONS"</em>), con domicilio legal en Av. Javier Prado 757, piso 10, Magdalena del Mar, Lima 17, Perú, y correo electrónico oficial de contacto: <a href="mailto:contacto@quality-consulting.org" class="text-dark fw-bold text-decoration-underline">contacto@quality-consulting.org</a>.
                        </p>
                        <p class="mb-0">
                            El acceso y uso de este portal atribuye la condición de <strong>"USUARIO"</strong>, quien declara conocer y aceptar plenamente y sin reservas las disposiciones contenidas en este aviso legal. El usuario que no estuviera conforme con las mismas deberá abstenerse de hacer uso de la plataforma.
                        </p>
                    </article>

                    <!-- Cláusula 2 -->
                    <article class="legal-clause-card" id="clausula-2">
                        <div class="clause-header">
                            <span class="clause-num-badge">02</span>
                            <h2 class="clause-title">Objeto y Alcance de los Servicios</h2>
                        </div>
                        <p>
                            LA EMPRESA brinda servicios de ingeniería especializada, dirección estratégica de proyectos y programas de formación profesional para los sectores de construcción, infraestructura y minería. Los servicios comprenden:
                        </p>
                        <ul class="mb-0 ps-3">
                            <li><strong>Consultoría Técnica y Gestión Contractual:</strong> Asesoría especializada en contratos FIDIC, NEC3/NEC4, Contrataciones con el Estado (OSCE), Oficina Técnica, aseguramiento QA/QC, auditorías técnicas y análisis de cronogramas.</li>
                            <li><strong>Oficina de Gestión de Proyectos (PMO):</strong> Diseño, estructuración, gobernanza y madurez de PMOs según estándares internacionales del PMI.</li>
                            <li><strong>Programas de Capacitación Corporativa:</strong> Cursos in-house, talleres ejecutivos, capacitaciones especializadas y metodologías de gestión (Lean Construction, Last Planner System, Lego Serious Play).</li>
                            <li><strong>Headhunting Técnico Especializado:</strong> Selección e intermediación de talento directivo y técnico para proyectos de ingeniería e infraestructura.</li>
                        </ul>
                    </article>

                    <!-- Cláusula 3 -->
                    <article class="legal-clause-card" id="clausula-3">
                        <div class="clause-header">
                            <span class="clause-num-badge">03</span>
                            <h2 class="clause-title">Cotizaciones, Precios y Condiciones de Pago</h2>
                        </div>
                        <p>
                            La información sobre precios, temarios y programas publicada en el sitio web tiene carácter referencial e informativo. La relación comercial se rige conforme a las siguientes pautas:
                        </p>
                        <div class="legal-note-box">
                            <ul class="mb-0 ps-3">
                                <li><strong>Propuestas Formales:</strong> Los alcances técnicos, plazos de ejecución y honorarios definitivos quedan fijados en la Propuesta Técnico-Económica (PTE) o Contrato de Servicios formalizado entre las partes.</li>
                                <li><strong>Impuestos:</strong> Salvo indicación expresa, los importes cotizados no incluyen el Impuesto General a las Ventas (IGV - 18%).</li>
                                <li><strong>Comprobantes de Pago:</strong> LA EMPRESA emitirá la correspondiente Factura Electrónica o Boleta de Venta conforme a la normativa de la SUNAT tras la acreditación bancaria del pago.</li>
                            </ul>
                        </div>
                    </article>

                    <!-- Cláusula 4 -->
                    <article class="legal-clause-card" id="clausula-4">
                        <div class="clause-header">
                            <span class="clause-num-badge">04</span>
                            <h2 class="clause-title">Políticas de Capacitación, Certificación y Cancelaciones</h2>
                        </div>
                        <h6 class="fw-bold text-dark mt-2 mb-1" style="font-size: 0.95rem;">4.1. Emisión de Certificados y Diplomas</h6>
                        <p>
                            La acreditación académica y entrega del diploma correspondiente requiere el cumplimiento de los requisitos establecidos en el sílabo respectivo, incluyendo una asistencia mínima del <strong>80%</strong> a las sesiones lectivas y la aprobación de las evaluaciones programadas.
                        </p>
                        <h6 class="fw-bold text-dark mt-3 mb-1" style="font-size: 0.95rem;">4.2. Reprogramaciones y Sustituciones</h6>
                        <p class="mb-0">
                            El cliente podrá sustituir a un participante registrado notificándolo por escrito con un mínimo de <strong>48 horas de anticipación</strong> al inicio del programa. Una vez iniciado el curso o facilitadas las credenciales de acceso al material digital, no se aplicarán devoluciones económicas.
                        </p>
                    </article>

                    <!-- Cláusula 5 -->
                    <article class="legal-clause-card" id="clausula-5">
                        <div class="clause-header">
                            <span class="clause-num-badge">05</span>
                            <h2 class="clause-title">Propiedad Intelectual y Derechos de Autor</h2>
                        </div>
                        <p>
                            Todos los contenidos, marcas comerciales, logotipos, metodologías propietarias (como la <em>Curva de Liberación®</em> o el <em>Síndrome del 90%</em>), matrices de riesgo, plantillas, casos de estudio, material didáctico y código fuente son propiedad exclusiva de <strong>Quality Consulting Solutions S.A.C.</strong> o de sus legítimos licenciantes.
                        </p>
                        <p class="mb-0">
                            Queda terminantemente prohibida su reproducción total o parcial, retransmisión, distribución comercial o explotación pública sin la debida autorización previa, expresa y por escrito de LA EMPRESA.
                        </p>
                    </article>

                    <!-- Cláusula 6 -->
                    <article class="legal-clause-card" id="clausula-6">
                        <div class="clause-header">
                            <span class="clause-num-badge">06</span>
                            <h2 class="clause-title">Protección de Datos Personales (Ley N° 29733)</h2>
                        </div>
                        <p>
                            En estricto cumplimiento de la <strong>Ley N° 29733 (Ley de Protección de Datos Personales de la República del Perú)</strong> y su Reglamento (D.S. N° 003-2013-JUS), los datos proporcionados voluntariamente a través de formularios serán tratados con estricta reserva y confidencialidad.
                        </p>
                        <div class="legal-note-box">
                            <p class="fw-bold mb-1 text-dark">Finalidades del Tratamiento:</p>
                            <p class="small text-secondary mb-2">Atención de cotizaciones, gestión de inscripciones académicas, emisión de constancias, tramitación en el Libro de Reclamaciones y envío de comunicaciones técnicas relevantes.</p>
                            <p class="fw-bold mb-1 text-dark">Ejercicio de Derechos ARCO:</p>
                            <p class="small text-secondary mb-0">El titular de los datos personales podrá ejercer sus derechos de Acceso, Rectificación, Cancelación y Oposición remitiendo una solicitud al correo <a href="mailto:contacto@quality-consulting.org" class="text-dark fw-bold">contacto@quality-consulting.org</a> acreditando su identidad.</p>
                        </div>
                    </article>

                    <!-- Cláusula 7 -->
                    <article class="legal-clause-card" id="clausula-7">
                        <div class="clause-header">
                            <span class="clause-num-badge">07</span>
                            <h2 class="clause-title">Libro de Reclamaciones Virtual (Ley N° 29571)</h2>
                        </div>
                        <p>
                            En conformidad con el Código de Protección y Defensa del Consumidor, LA EMPRESA pone a disposición del público su plataforma virtual de Libro de Reclamaciones.
                        </p>
                        <p class="mb-3">
                            Al formular un reclamo o queja, la plataforma generará una constancia automática con código único al correo del usuario. Conforme a la legislación vigente, el plazo máximo de atención no superará los <strong>15 días hábiles</strong>.
                        </p>
                        <a href="/libro-de-reclamaciones" class="btn btn-outline-dark btn-sm rounded-pill px-4 py-2 fw-bold d-inline-flex align-items-center gap-2">
                            <i class="fa-solid fa-book-open"></i> Acceder al Libro de Reclamaciones
                        </a>
                    </article>

                    <!-- Cláusula 8 -->
                    <article class="legal-clause-card" id="clausula-8">
                        <div class="clause-header">
                            <span class="clause-num-badge">08</span>
                            <h2 class="clause-title">Exclusión de Responsabilidad</h2>
                        </div>
                        <p class="mb-0">
                            Los artículos técnicos, publicaciones divulgativas y contenidos de medios compartidos en este portal tienen finalidad didáctica y de orientación general. No constituyen dictamen vinculante ni sustituyen el peritaje técnico específico en obra. LA EMPRESA no asume responsabilidad por incidencias atribuibles a fallas en redes de telecomunicaciones o supuestos de caso fortuito o fuerza mayor.
                        </p>
                    </article>

                    <!-- Cláusula 9 -->
                    <article class="legal-clause-card" id="clausula-9">
                        <div class="clause-header">
                            <span class="clause-num-badge">09</span>
                            <h2 class="clause-title">Modificación de los Términos</h2>
                        </div>
                        <p class="mb-0">
                            QUALITY CONSULTING SOLUTIONS se reserva la potestad de actualizar, modificar o precisar estos términos y condiciones para adecuarlos a reformas normativas o mejoras en la prestación de servicios. Dichas actualizaciones serán plenamente vinculantes desde el momento de su publicación en el presente portal.
                        </p>
                    </article>

                    <!-- Cláusula 10 -->
                    <article class="legal-clause-card" id="clausula-10">
                        <div class="clause-header">
                            <span class="clause-num-badge">10</span>
                            <h2 class="clause-title">Legislación Aplicable y Jurisdicción</h2>
                        </div>
                        <p class="mb-0">
                            Para toda controversia o interpretación derivada del uso del sitio web o de los presentes términos, las partes se someten de manera expresa a las leyes de la <strong>República del Perú</strong> y a la competencia territorial de los <strong>Jueces y Tribunales del Distrito Judicial de Lima Centro</strong>, con renuncia a cualquier otro fuero jurisdiccional.
                        </p>
                    </article>

                </div>

            </div>
        </div>
    </section>
</main>
