<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Nosotros (Quiénes Somos)
 * Archivo: app/Views/pages/nosotros.php
 *
 * Muestra el propósito institucional, misión, visión, valores corporativos,
 * métricas de impacto, perfil de la dirección ejecutiva y diferenciadores clave.
 */

declare(strict_types=1);
?>
<!-- Estilos Especializados Corporate Executive Style para Nosotros -->
<style>
    body {
        background-color: var(--qcs-bg-light);
        color: #1e293b;
        overflow-x: hidden;
    }

    /* Hero Ejecutivo Especializado */
    .nosotros-exec-hero {
        position: relative;
        padding: 210px 1.5rem 120px 1.5rem;
        background: linear-gradient(145deg, #0f1113 0%, #1a1d20 50%, #24292e 100%);
        color: #ffffff;
        overflow: hidden;
        border-bottom: 4px solid var(--qcs-yellow);
    }

    .nosotros-hero-grid-pattern {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: 
            linear-gradient(rgba(229, 168, 19, 0.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(229, 168, 19, 0.05) 1px, transparent 1px);
        background-size: 36px 36px;
        opacity: 0.7;
        pointer-events: none;
    }

    .nosotros-hero-glow-1 {
        position: absolute;
        top: -20%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(229, 168, 19, 0.18) 0%, transparent 70%);
        pointer-events: none;
    }

    .nosotros-hero-glow-2 {
        position: absolute;
        bottom: -20%;
        left: -10%;
        width: 450px;
        height: 450px;
        background: radial-gradient(circle, rgba(142, 146, 151, 0.15) 0%, transparent 70%);
        pointer-events: none;
    }

    /* Tarjetas Flotantes de Misión, Visión y Valores */
    .floating-exec-card {
        background: #ffffff;
        border-radius: 1.25rem;
        border: 1px solid #e2e8f0;
        border-top: 5px solid var(--qcs-yellow) !important;
        padding: 2.5rem 2rem;
        box-shadow: 0 12px 32px rgba(15, 17, 19, 0.06);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .floating-exec-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 45px rgba(229, 168, 19, 0.15);
        border-color: var(--qcs-yellow);
    }

    .exec-card-icon-wrap {
        width: 65px;
        height: 65px;
        border-radius: 16px;
        background: rgba(229, 168, 19, 0.12);
        color: var(--qcs-yellow);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        margin-bottom: 1.5rem;
        border: 1px solid rgba(229, 168, 19, 0.25);
        transition: all 0.3s ease;
    }

    .floating-exec-card:hover .exec-card-icon-wrap {
        background: var(--qcs-yellow);
        color: var(--qcs-black);
        transform: rotate(6deg) scale(1.05);
    }

    /* Sección de Métricas de Impacto */
    .stats-dark-strip {
        background: linear-gradient(135deg, #1a1d20 0%, #0f1113 100%);
        border-radius: 1.5rem;
        padding: 3rem 2.5rem;
        border: 1px solid rgba(229, 168, 19, 0.25);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
        position: relative;
        overflow: hidden;
    }

    .stats-dark-strip::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--qcs-yellow), transparent);
    }

    .stat-item-box {
        text-align: center;
        padding: 1rem;
    }

    .stat-icon {
        font-size: 2rem;
        color: var(--qcs-yellow);
        margin-bottom: 0.75rem;
        display: inline-block;
    }

    .stat-number {
        font-family: var(--font-heading);
        font-size: clamp(2.2rem, 3.5vw, 3rem);
        font-weight: 900;
        color: var(--qcs-yellow);
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-family: var(--font-heading);
        font-size: 0.88rem;
        font-weight: 700;
        color: #e2e8f0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Diferenciadores y Timeline */
    .diff-feature-item {
        display: flex;
        align-items: flex-start;
        gap: 1.25rem;
        padding: 1.25rem;
        border-radius: 1rem;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        margin-bottom: 1.25rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        transition: all 0.3s ease;
    }

    .diff-feature-item:hover {
        transform: translateX(6px);
        border-left: 4px solid var(--qcs-yellow);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
    }

    .diff-check-icon {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: rgba(229, 168, 19, 0.15);
        color: var(--qcs-yellow);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
        flex-shrink: 0;
    }

    /* Tarjeta de Liderazgo */
    .director-profile-card {
        background: #ffffff;
        border-radius: 1.25rem;
        border: 1px solid #e2e8f0;
        padding: 2.25rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        position: relative;
    }

    .director-img-container {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        border: 4px solid var(--qcs-yellow);
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(229, 168, 19, 0.25);
        margin: 0 auto 1.5rem auto;
    }

    .director-img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top;
    }

    /* Banner CTA 2026 */
    .exec-cta-banner {
        background: linear-gradient(135deg, #1a1d20 0%, #0f1113 70%, #24292e 100%);
        border-radius: 1.5rem;
        padding: 3.5rem 2.5rem;
        color: #ffffff;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.25);
        border: 1px solid rgba(229, 168, 19, 0.3);
    }

    .exec-cta-banner::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(229, 168, 19, 0.2) 0%, transparent 70%);
        pointer-events: none;
    }

    .pilar-badge-pill {
        display: inline-block;
        background: #F4F5F7;
        color: #1e293b;
        font-size: 0.82rem;
        font-weight: 700;
        padding: 0.4rem 0.85rem;
        border-radius: 30px;
        margin-right: 0.4rem;
        margin-bottom: 0.5rem;
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease;
    }

    .pilar-badge-pill:hover {
        background: var(--qcs-yellow);
        color: var(--qcs-black);
        border-color: var(--qcs-yellow);
    }
</style>

<main>
    
    <!-- ==========================================================================
         A. HERO SECTION DE PRESENTACIÓN DE ALTO IMPACTO (Corporate Executive Style)
         ========================================================================== -->
    <section class="nosotros-exec-hero">
        <div class="nosotros-hero-grid-pattern"></div>
        <div class="nosotros-hero-glow-1"></div>
        <div class="nosotros-hero-glow-2"></div>
        
        <div class="container position-relative z-2 text-center">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    
                    <!-- Badge Neón -->
                    <div>
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3 animate__animated animate__fadeInDown shadow-sm">
                            <i class="fas fa-building me-2"></i> LIDERAZGO EN CONSULTORÍA &amp; CAPACITACIÓN TÉCNICA
                        </span>
                    </div>

                    <!-- Título Principal -->
                    <h1 class="animate__animated animate__fadeInDown fw-extrabold text-white mb-3" style="font-size: clamp(2rem, 3.8vw, 3.2rem); font-family: var(--font-heading); line-height: 1.25; font-weight: 800;">
                        Impulsamos la Excelencia en la Gestión de Proyectos de Ingeniería y Construcción
                    </h1>

                    <!-- Subtítulo -->
                    <p class="animate__animated animate__fadeInUp animate__delay-1s text-light text-opacity-90 lead mb-4 mx-auto" style="max-width: 880px; font-size: 1.15rem; line-height: 1.8;">
                        Somos Quality Consulting Solutions, una firma dedicada a conectar la experiencia técnica de alto nivel con soluciones prácticas para profesionales y organizaciones.
                    </p>

                    <!-- Botones de Acción -->
                    <div class="d-flex justify-content-center gap-3 flex-wrap pt-2">
                        <a href="#mision-vision" class="btn btn-qcs-primary px-4 py-3 rounded-pill fw-bold">
                            <i class="fa-solid fa-compass me-2"></i> Conoce Nuestro Propósito
                        </a>
                        <a href="/contacto" class="btn btn-qcs-dark px-4 py-3 rounded-pill fw-bold">
                            <i class="fa-solid fa-envelope me-2"></i> Contactar Consultoría
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================================================
         B. GRID INTERACTIVO DE MISIÓN, VISIÓN Y VALORES (Layout Cajas Flotantes)
         ========================================================================== -->
    <section class="py-5" id="mision-vision" style="margin-top: -40px;">
        <div class="container">
            <div class="row g-4">
                
                <!-- 1. Nuestra Misión -->
                <div class="col-lg-4" data-aos="fade-right">
                    <div class="floating-exec-card">
                        <div>
                            <div class="exec-card-icon-wrap">
                                <i class="fa-solid fa-bullseye"></i>
                            </div>
                            <span class="badge bg-warning-subtle text-dark fw-bold text-uppercase px-2 py-1 rounded mb-2">Propósito Fundamental</span>
                            <h3 class="fw-bold text-dark font-montserrat fs-4 mb-3">Nuestra Misión</h3>
                            <p class="text-secondary" style="line-height: 1.75; font-size: 0.98rem;">
                                Capacitar y asesorar a profesionales y empresas con metodologías avanzadas de gestión, ingeniería de costos, control contractual y BIM para elevar los estándares de la industria.
                            </p>
                        </div>
                        <div class="pt-3 border-top border-light-subtle d-flex align-items-center text-warning fw-bold small">
                            <span>Impacto Técnico Transformador</span>
                            <i class="fa-solid fa-arrow-right ms-auto"></i>
                        </div>
                    </div>
                </div>

                <!-- 2. Nuestra Visión -->
                <div class="col-lg-4" data-aos="fade-up">
                    <div class="floating-exec-card">
                        <div>
                            <div class="exec-card-icon-wrap">
                                <i class="fa-solid fa-eye"></i>
                            </div>
                            <span class="badge bg-warning-subtle text-dark fw-bold text-uppercase px-2 py-1 rounded mb-2">Visión de Futuro</span>
                            <h3 class="fw-bold text-dark font-montserrat fs-4 mb-3">Nuestra Visión</h3>
                            <p class="text-secondary" style="line-height: 1.75; font-size: 0.98rem;">
                                Ser reconocidos como el centro de consultoría y capacitación técnica referente en el país, destacado por la calidad de nuestra plana docente y la efectividad de nuestras soluciones.
                            </p>
                        </div>
                        <div class="pt-3 border-top border-light-subtle d-flex align-items-center text-warning fw-bold small">
                            <span>Liderazgo &amp; Reconocimiento</span>
                            <i class="fa-solid fa-arrow-right ms-auto"></i>
                        </div>
                    </div>
                </div>

                <!-- 3. Nuestros Pilares -->
                <div class="col-lg-4" data-aos="fade-left">
                    <div class="floating-exec-card">
                        <div>
                            <div class="exec-card-icon-wrap">
                                <i class="fa-solid fa-gem"></i>
                            </div>
                            <span class="badge bg-warning-subtle text-dark fw-bold text-uppercase px-2 py-1 rounded mb-2">Valores Corporativos</span>
                            <h3 class="fw-bold text-dark font-montserrat fs-4 mb-3">Nuestros Pilares</h3>
                            <p class="text-secondary mb-3" style="line-height: 1.6; font-size: 0.95rem;">
                                Principios innegociables que guían cada uno de nuestros servicios de consultoría y programas de formación:
                            </p>
                            <div class="mt-2">
                                <span class="pilar-badge-pill"><i class="fa-solid fa-check text-warning me-1"></i> Excelencia Académica</span>
                                <span class="pilar-badge-pill"><i class="fa-solid fa-check text-warning me-1"></i> Rigor Técnico</span>
                                <span class="pilar-badge-pill"><i class="fa-solid fa-check text-warning me-1"></i> Innovación Continuada</span>
                                <span class="pilar-badge-pill"><i class="fa-solid fa-check text-warning me-1"></i> Integridad y Transparencia</span>
                            </div>
                        </div>
                        <div class="pt-3 border-top border-light-subtle d-flex align-items-center text-warning fw-bold small mt-3">
                            <span>Cultura de Calidad Total</span>
                            <i class="fa-solid fa-arrow-right ms-auto"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ==========================================================================
         C. CONTADOR / MÉTRICAS DE IMPACTO (Stats Section)
         ========================================================================== -->
    <section class="py-5">
        <div class="container">
            <div class="stats-dark-strip" data-aos="zoom-in">
                <div class="row g-4 text-center align-items-center">
                    
                    <!-- Métrica 1 -->
                    <div class="col-lg-3 col-6 border-end border-white border-opacity-10">
                        <div class="stat-item-box">
                            <div class="stat-icon"><i class="fa-solid fa-calendar-check"></i></div>
                            <div class="stat-number">+25</div>
                            <div class="stat-label">Años de Experiencia Combinada</div>
                        </div>
                    </div>

                    <!-- Métrica 2 -->
                    <div class="col-lg-3 col-6 border-end border-white border-opacity-10">
                        <div class="stat-item-box">
                            <div class="stat-icon"><i class="fa-solid fa-user-graduate"></i></div>
                            <div class="stat-number">+1,500</div>
                            <div class="stat-label">Profesionales Capacitados</div>
                        </div>
                    </div>

                    <!-- Métrica 3 -->
                    <div class="col-lg-3 col-6 border-end border-white border-opacity-10">
                        <div class="stat-item-box">
                            <div class="stat-icon"><i class="fa-solid fa-hard-hat"></i></div>
                            <div class="stat-number">100%</div>
                            <div class="stat-label">Casuística Real Aplicada a Obras</div>
                        </div>
                    </div>

                    <!-- Métrica 4 -->
                    <div class="col-lg-3 col-6">
                        <div class="stat-item-box">
                            <div class="stat-icon"><i class="fa-solid fa-diagram-project"></i></div>
                            <div class="stat-number">+10</div>
                            <div class="stat-label">Programas Especializados Activos</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================================================
         D. POR QUÉ ELEGIRNOS (Timeline / Diferenciadores & Autoridad)
         ========================================================================== -->
    <section class="py-5">
        <div class="container">
            
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="badge bg-warning text-dark fw-bold px-3 py-2 rounded-pill text-uppercase mb-2 shadow-sm">
                    <i class="fa-solid fa-shield-halved me-1"></i> Autoridad Técnica &amp; Trayectoria
                </span>
                <h2 class="fw-extrabold font-montserrat text-dark display-6 mb-2" style="font-weight: 800;">
                    ¿POR QUÉ ELEGIR QUALITY CONSULTING SOLUTIONS?
                </h2>
                <p class="text-secondary mx-auto" style="max-width: 720px; font-size: 1.05rem;">
                    Conectamos el rigor metodológico internacional con la realidad operativa de los megaproyectos y empresas líderes en el sector construcción e infraestructura.
                </p>
            </div>

            <div class="row g-4 align-items-center">
                
                <!-- Columna 1: Tarjeta Institucional de Dirección & Plana Docente -->
                <div class="col-lg-5" data-aos="fade-right">
                    <div class="director-profile-card text-center rounded-4 border-start border-4 border-warning">
                        <div class="director-img-container">
                            <picture>
                                <source srcset="img/Omar_Samaniego.webp" type="image/webp">
                                <img src="img/Omar_Samaniego.png" alt="Ing. Omar Samaniego - Director Ejecutivo" class="img-fluid">
                            </picture>
                        </div>
                        <span class="badge bg-warning text-dark fw-bold text-uppercase px-3 py-1 rounded-pill mb-2">Dirección Ejecutiva</span>
                        <h3 class="fw-bold font-montserrat text-dark fs-4 mb-1">Ing. Omar Samaniego</h3>
                        <p class="small text-muted mb-3 font-montserrat fw-semibold">Director &amp; Consultor Principal</p>
                        
                        <!-- Badges de Certificaciones -->
                        <div class="d-flex flex-wrap justify-content-center gap-2 mb-3">
                            <span class="badge bg-dark"><i class="fa-solid fa-id-card text-warning me-1"></i> CIP</span>
                            <span class="badge bg-dark"><i class="fa-solid fa-award text-warning me-1"></i> PMP®</span>
                            <span class="badge bg-dark"><i class="fa-solid fa-shield-halved text-warning me-1"></i> PMI-RMP®</span>
                            <span class="badge bg-dark"><i class="fa-solid fa-certificate text-warning me-1"></i> IRCA</span>
                            <span class="badge bg-dark"><i class="fa-solid fa-medal text-warning me-1"></i> LSS Black Belt</span>
                        </div>

                        <p class="text-secondary text-start small mb-3" style="line-height: 1.7;">
                            Más de 20 años de experiencia en Gestión de la Calidad, PMO y Riesgos en el sector construcción. Autor de publicaciones especializadas, docente de posgrado y conferencista internacional.
                        </p>

                        <div class="p-3 rounded-3 bg-light border border-light-subtle text-start">
                            <div class="d-flex align-items-center gap-2 text-dark small fw-bold">
                                <i class="fa-solid fa-check-circle text-warning fs-5"></i>
                                <span>Garantía de rigor técnico y aplicabilidad directa en campo.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Columna 2: Diferenciadores Clave -->
                <div class="col-lg-7" data-aos="fade-left">
                    
                    <!-- Diferenciador 1 -->
                    <div class="diff-feature-item">
                        <div class="diff-check-icon">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold font-montserrat fs-6 text-dark mb-1">Plana Docente de Primer Nivel</h4>
                            <p class="text-secondary mb-0 small" style="line-height: 1.65;">
                                Conformada por peritos, adjudicadores DAB y consultores activos en megaproyectos de minería, infraestructura vial, edificaciones y obras públicas.
                            </p>
                        </div>
                    </div>

                    <!-- Diferenciador 2 -->
                    <div class="diff-feature-item">
                        <div class="diff-check-icon">
                            <i class="fa-solid fa-scale-balanced"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold font-montserrat fs-6 text-dark mb-1">Solución de Controversias y Control Contractual</h4>
                            <p class="text-secondary mb-0 small" style="line-height: 1.65;">
                                Enfoque directo en contratos colaborativos (NEC, FIDIC), gestión de reclamos, análisis de cronogramas forenses y prevención de disputas en obra.
                            </p>
                        </div>
                    </div>

                    <!-- Diferenciador 3 -->
                    <div class="diff-feature-item">
                        <div class="diff-check-icon">
                            <i class="fa-solid fa-certificate"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold font-montserrat fs-6 text-dark mb-1">Acreditación y Respaldo Ejecutivo</h4>
                            <p class="text-secondary mb-0 small" style="line-height: 1.65;">
                                Programas alineados a las mejores prácticas globales de PMI®, ISO 9001, Lean Construction Institute y VDC Stanford University.
                            </p>
                        </div>
                    </div>

                    <!-- Diferenciador 4 -->
                    <div class="diff-feature-item">
                        <div class="diff-check-icon">
                            <i class="fa-solid fa-laptop-code"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold font-montserrat fs-6 text-dark mb-1">Tecnología y Casuística Real</h4>
                            <p class="text-secondary mb-0 small" style="line-height: 1.65;">
                                Casos de estudio reales, modelos BIM, plantillas parametrizadas y simuladores de gestión de valor ganado aplicados a proyectos vigentes.
                            </p>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>

    <!-- ==========================================================================
         E. BANNER CTA DE CIERRE (Llamado a la Acción 2026)
         ========================================================================== -->
    <section class="py-5">
        <div class="container">
            <div class="exec-cta-banner" data-aos="zoom-in">
                <div class="row align-items-center position-relative z-2">
                    
                    <div class="col-lg-8 mb-4 mb-lg-0">
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm">
                            <i class="fa-solid fa-handshake me-1"></i> SOLUCIONES CORPORATIVAS 2026
                        </span>
                        <h2 class="fw-bold font-montserrat text-white mb-3" style="font-size: clamp(1.7rem, 2.5vw, 2.3rem); font-weight: 800;">
                            Eleva el Rendimiento y la Calidad de tus Proyectos
                        </h2>
                        <p class="text-light text-opacity-90 mb-3" style="font-size: 1.05rem; line-height: 1.8;">
                            Diseñamos programas de capacitación in-company y servicios de consultoría técnica ajustados a las metas operativas y estratégicas de tu organización.
                        </p>
                        <div class="d-flex flex-wrap gap-4 text-light pt-2">
                            <div>
                                <i class="fa-solid fa-phone text-warning me-2"></i>
                                Atención Inmediata: <a href="tel:+51993463118" class="text-white fw-bold">+51 993 463 118</a>
                            </div>
                            <div>
                                <i class="fa-solid fa-envelope text-warning me-2"></i>
                                Correo: <a href="mailto:contacto@quality-consulting.org" class="text-white fw-bold">contacto@quality-consulting.org</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 text-lg-end text-center">
                        <div class="d-flex flex-column gap-3 justify-content-center">
                            <a href="https://wa.me/51993463118" target="_blank" rel="noopener noreferrer" class="btn btn-warning btn-lg px-4 py-3 fw-bold rounded-pill shadow-lg text-dark btn-qcs-primary">
                                <i class="fa-brands fa-whatsapp me-2"></i> Consultar por WhatsApp
                            </a>
                            <a href="/capacitacion" class="btn btn-outline-light btn-lg px-4 py-3 fw-bold rounded-pill btn-qcs-dark">
                                <i class="fa-solid fa-graduation-cap me-2"></i> Catálogo de Cursos
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</main>

