<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Clientes
 * Archivo: app/Views/pages/clientes.php
 *
 * Muestra el agradecimiento corporativo, galería de marcas líderes que confían en QCS,
 * y el catálogo de los 10 servicios y soluciones técnicas desarrolladas.
 */

declare(strict_types=1);
?>
<!-- Estilos Especializados Corporate Social Proof & Trust Showcase -->
<style>
    body {
        background-color: #F4F5F7;
        color: #1e293b;
    }

    /* Hero Corporate Trust & Excellence Style */
    .clientes-hero-banner {
        position: relative;
        padding: 190px 1.5rem 85px 1.5rem;
        background: linear-gradient(135deg, #0F1113 0%, #1A1D20 50%, #1A1D20 100%);
        color: #ffffff;
        overflow: hidden;
        border-bottom: 3px solid var(--accent-gold);
    }

    .clientes-hero-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 80% 20%, rgba(229, 168, 19, 0.2) 0%, transparent 60%),
                    radial-gradient(circle at 15% 85%, rgba(142, 146, 151, 0.15) 0%, transparent 60%);
        pointer-events: none;
    }

    .clientes-hero-card {
        background: rgba(26, 29, 32, 0.8);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border: 1px solid rgba(229, 168, 19, 0.35);
        border-radius: 14px;
        padding: 1.35rem 1.15rem;
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
        text-align: center;
    }

    .clientes-hero-card:hover {
        transform: translateY(-5px);
        border-color: var(--accent-gold);
        box-shadow: 0 16px 36px rgba(229, 168, 19, 0.25);
        background: rgba(22, 62, 109, 0.9);
    }

    .clientes-hero-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: rgba(229, 168, 19, 0.15);
        color: #fef08a;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        margin: 0 auto 0.85rem auto;
        border: 1px solid rgba(229, 168, 19, 0.4);
    }

    .clientes-hero-card-title {
        font-family: var(--font-heading);
        font-size: 1rem;
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 0.35rem;
    }

    .clientes-hero-card-desc {
        font-size: 0.84rem;
        color: #cbd5e1;
        margin: 0;
    }

    /* Frase Institucional de Confianza */
    .trust-quote-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        padding: 3rem 2.5rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.04);
        position: relative;
        text-align: center;
        max-width: 960px;
        margin: -40px auto 2rem auto;
        z-index: 3;
    }

    .trust-quote-icon {
        font-size: 2.5rem;
        color: var(--accent-gold);
        margin-bottom: 1.25rem;
        opacity: 0.85;
    }

    .trust-quote-text {
        font-size: 1.12rem;
        line-height: 1.85;
        color: #334155;
        font-style: italic;
        margin: 0;
    }

    /* Grid de Servicios Realizados (10 Tarjetas) */
    .services-performed-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .service-perf-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        padding: 1.75rem 1.4rem;
        transition: all var(--transition-medium);
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        height: 100%;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.03);
    }

    .service-perf-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--accent-gold);
        opacity: 0;
        transition: opacity var(--transition-fast);
    }

    .service-perf-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 32px rgba(15, 17, 19, 0.1);
        border-color: #cbd5e1;
    }

    .service-perf-card:hover::before {
        opacity: 1;
    }

    .service-perf-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .service-perf-num {
        font-family: var(--font-heading);
        font-size: 1.35rem;
        font-weight: 800;
        color: #94a3b8;
        line-height: 1;
    }

    .service-perf-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: rgba(22, 62, 109, 0.08);
        color: var(--primary-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        transition: all var(--transition-fast);
    }

    .service-perf-card:hover .service-perf-icon {
        background: var(--accent-gold);
        color: #ffffff;
        transform: scale(1.1);
    }

    .service-perf-title {
        font-family: var(--font-heading);
        font-size: 1.02rem;
        font-weight: 800;
        color: var(--primary-blue);
        margin-bottom: 0.45rem;
        line-height: 1.35;
    }

    .service-perf-desc {
        font-size: 0.86rem;
        color: #475569;
        line-height: 1.55;
        margin: 0;
        flex-grow: 1;
    }
</style>

<main class="page-content">

    <!-- ==========================================================================
         1. ENCABEZADO HERO ESTILIZADO (Corporate Trust & Excellence Style)
         ========================================================================== -->
    <section class="clientes-hero-banner">
        <div class="container text-center position-relative" style="z-index: 2;">
            
            <!-- Badge Neón Superior Requerido -->
            <div class="mb-3">
                <span class="badge bg-light text-dark px-3 py-2 rounded-pill fw-bold mb-2 shadow-sm">
                    <i class="fas fa-handshake me-2"></i> CONFIANZA &amp; COMPROMISO CORPORATIVO
                </span>
            </div>

            <h1 class="display-5 fw-extrabold text-white text-uppercase tracking-wide mb-3 animate__animated animate__fadeInDown" style="font-family: var(--font-heading); font-weight: 800;">
                NUESTROS CLIENTES
            </h1>

            <p class="lead text-light opacity-90 mx-auto mb-4" style="max-width: 860px; font-size: 1.15rem; color: #e2e8f0;">
                Agradecemos a las empresas líderes del sector construcción, ingeniería y minería por confiar en nuestros programas de capacitación y asesoría técnica especializada.
            </p>

            <!-- Grid de 3 Tarjetas de Pilares de Valor en el Hero -->
            <div class="row g-3 justify-content-center mt-2">
                
                <!-- Pilar 1: Compromiso -->
                <div class="col-12 col-md-4">
                    <div class="clientes-hero-card">
                        <div class="clientes-hero-icon"><i class="fas fa-shield-alt"></i></div>
                        <div class="clientes-hero-card-title">Compromiso Total</div>
                        <p class="clientes-hero-card-desc">Impregnamos nuestros valores corporativos en cada proyecto encomendado.</p>
                    </div>
                </div>

                <!-- Pilar 2: Visión Estratégica -->
                <div class="col-12 col-md-4">
                    <div class="clientes-hero-card">
                        <div class="clientes-hero-icon"><i class="fas fa-chart-line"></i></div>
                        <div class="clientes-hero-card-title">Visión Estratégica</div>
                        <p class="clientes-hero-card-desc">Cada servicio es una oportunidad para que nuestros clientes logren sus objetivos.</p>
                    </div>
                </div>

                <!-- Pilar 3: Enfoque al Cliente -->
                <div class="col-12 col-md-4">
                    <div class="clientes-hero-card">
                        <div class="clientes-hero-icon"><i class="fas fa-user-check"></i></div>
                        <div class="clientes-hero-card-title">Enfoque al Cliente</div>
                        <p class="clientes-hero-card-desc">Entendemos a profundidad sus necesidades para exceder sus expectativas.</p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ==========================================================================
         2. MENSAJE INSTITUCIONAL DE AGRADECIMIENTO
         ========================================================================== -->
    <section class="py-5" id="agradecimiento">
        <div class="container py-3">
            <div class="trust-quote-card">
                <i class="fa-solid fa-quote-right trust-quote-icon"></i>
                <p class="trust-quote-text">
                    "Agradecemos a nuestros clientes por la confianza brindada a nuestros servicios, en cada uno de los cuales impregnamos nuestros valores. Cada servicio significa para nosotros una oportunidad para que nuestros clientes logren sus objetivos estratégicos a través de nuestra contribución. Nuestro enfoque en el cliente se basa en entender a profundidad sus necesidades y requisitos, para el reto de proveer un producto que satisfaga sus necesidades y exceda sus expectativas."
                </p>
            </div>
        </div>
    </section>

    <!-- ==========================================================================
         3. GALERÍA DE CLIENTES Y MARCAS DESTACADAS (Imagen Local Obligatoria)
         ========================================================================== -->
    <section class="py-4 bg-white border-top border-bottom" id="galeria-clientes">
        <div class="container py-3">
            
            <div class="text-center mb-5">
                <span class="badge bg-warning-subtle text-dark px-3 py-2 rounded-pill fw-bold text-uppercase mb-2 shadow-sm">
                    <i class="fa-solid fa-building me-1"></i> Respaldo Institucional
                </span>
                <h2 class="fw-extrabold text-uppercase text-dark animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); color: var(--primary-blue);">
                    EMPRESAS QUE CONFÍAN EN NOSOTROS
                </h2>
                <div class="title-underline mx-auto"></div>
                <p class="text-secondary mx-auto mt-3" style="max-width: 780px;">
                    Organizaciones líderes del sector público y privado que han transformado sus procesos junto a Quality Consulting Solutions.
                </p>
            </div>

            <!-- Contenedor para la imagen local descargada -->
            <div class="card shadow-lg rounded-4 overflow-hidden border-0 p-4 text-center bg-white mb-5">
                <picture>
                    <source srcset="img/ClientesQuality.webp" type="image/webp">
                    <img src="img/ClientesQuality.png" alt="Logotipos de clientes que confían en Quality Consulting Solutions (Cosapi, Abengoa, Proyec, Wood Group, Produktiva, Hispe, Amec Foster Wheeler, ICCGSA, GTI, Buenaventura, Antamina, Ciudaris, JJC Grupo, Prosac, entre otros)" class="img-fluid rounded-3 mx-auto" loading="lazy">
                </picture>
            </div>

        </div>
    </section>

    <!-- ==========================================================================
         4. SECCIÓN "SERVICIOS REALIZADOS" - GRID MODULAR DE 10 TARJETAS
         ========================================================================== -->
    <section class="py-5" style="background-color: var(--qcs-bg-light);" id="servicios-realizados">
        <div class="container py-3">
            
            <div class="text-center mb-5">
                <span class="badge bg-warning-subtle text-warning-emphasis px-3 py-2 rounded-pill fw-bold text-uppercase mb-2 shadow-sm">
                    <i class="fa-solid fa-briefcase me-1"></i> Experiencia Comprobada
                </span>
                <h2 class="fw-extrabold text-uppercase text-dark animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); color: var(--primary-blue);">
                    SERVICIOS Y SOLUCIONES DESARROLLADAS
                </h2>
                <div class="title-underline mx-auto"></div>
                <p class="text-secondary mx-auto mt-3" style="max-width: 780px;">
                    Principales intervenciones y consultorías técnicas ejecutadas con éxito para nuestra cartera de clientes.
                </p>
            </div>

            <!-- Grid de 10 Tarjetas -->
            <div class="services-performed-grid">
                
                <!-- 01. Evaluación del Riesgo del Cumplimiento del Plazo -->
                <div class="service-perf-card">
                    <div class="service-perf-header">
                        <span class="service-perf-num">01</span>
                        <div class="service-perf-icon"><i class="fas fa-clock"></i></div>
                    </div>
                    <h3 class="service-perf-title animate__animated animate__fadeInUp animate__delay-1s">01. Evaluación del Riesgo del Cumplimiento del Plazo</h3>
                    <p class="service-perf-desc">Diagnóstico y análisis preventivo de desviaciones de tiempo en obra para asegurar hitos contractuales.</p>
                </div>

                <!-- 02. Homologación de Proveedores -->
                <div class="service-perf-card">
                    <div class="service-perf-header">
                        <span class="service-perf-num">02</span>
                        <div class="service-perf-icon"><i class="fas fa-truck-loading"></i></div>
                    </div>
                    <h3 class="service-perf-title animate__animated animate__fadeInUp animate__delay-1s">02. Homologación de Proveedores</h3>
                    <p class="service-perf-desc">Evaluación, auditoría y estandarización de la cadena de suministro y contratistas para proyectos.</p>
                </div>

                <!-- 03. Elaboración de Plan de Calidad -->
                <div class="service-perf-card">
                    <div class="service-perf-header">
                        <span class="service-perf-num">03</span>
                        <div class="service-perf-icon"><i class="fas fa-file-signature"></i></div>
                    </div>
                    <h3 class="service-perf-title animate__animated animate__fadeInUp animate__delay-1s">03. Elaboración de Plan de Calidad</h3>
                    <p class="service-perf-desc">Diseño de planes de gestión de calidad a medida para organizaciones, megaproyectos y obras complejas.</p>
                </div>

                <!-- 04. Soporte en Propuestas de Gestión y Calidad -->
                <div class="service-perf-card">
                    <div class="service-perf-header">
                        <span class="service-perf-num">04</span>
                        <div class="service-perf-icon"><i class="fas fa-lightbulb"></i></div>
                    </div>
                    <h3 class="service-perf-title animate__animated animate__fadeInUp animate__delay-1s">04. Soporte en Propuestas de Gestión y Calidad</h3>
                    <p class="service-perf-desc">Asesoría técnica estratégica en licitaciones privadas y públicas de alto impacto.</p>
                </div>

                <!-- 05. Manual de Funciones -->
                <div class="service-perf-card">
                    <div class="service-perf-header">
                        <span class="service-perf-num">05</span>
                        <div class="service-perf-icon"><i class="fas fa-sitemap"></i></div>
                    </div>
                    <h3 class="service-perf-title animate__animated animate__fadeInUp animate__delay-1s">05. Manual de Funciones</h3>
                    <p class="service-perf-desc">Estructuración de roles, responsabilidades, competencias y perfiles operativos para equipos técnicos.</p>
                </div>

                <!-- 06. Manual de Gestión de Proyectos -->
                <div class="service-perf-card">
                    <div class="service-perf-header">
                        <span class="service-perf-num">06</span>
                        <div class="service-perf-icon"><i class="fas fa-book"></i></div>
                    </div>
                    <h3 class="service-perf-title animate__animated animate__fadeInUp animate__delay-1s">06. Manual de Gestión de Proyectos</h3>
                    <p class="service-perf-desc">Estandarización de procesos de dirección de proyectos bajo mejores prácticas y estándares globales.</p>
                </div>

                <!-- 07. Capacitación en Gestión de Proyectos, Riesgos y Calidad -->
                <div class="service-perf-card">
                    <div class="service-perf-header">
                        <span class="service-perf-num">07</span>
                        <div class="service-perf-icon"><i class="fas fa-graduation-cap"></i></div>
                    </div>
                    <h3 class="service-perf-title animate__animated animate__fadeInUp animate__delay-1s">07. Capacitación en Proyectos, Riesgos y Calidad</h3>
                    <p class="service-perf-desc">Programas especializados in-house adaptados a las necesidades reales de cada empresa.</p>
                </div>

                <!-- 08. Auditoría de Gestión Técnica -->
                <div class="service-perf-card">
                    <div class="service-perf-header">
                        <span class="service-perf-num">08</span>
                        <div class="service-perf-icon"><i class="fas fa-clipboard-check"></i></div>
                    </div>
                    <h3 class="service-perf-title animate__animated animate__fadeInUp animate__delay-1s">08. Auditoría de Gestión Técnica</h3>
                    <p class="service-perf-desc">Evaluación de campo sobre el estado real de la calidad, control técnico y trazabilidad en obra.</p>
                </div>

                <!-- 09. Auditoría de Proveedores -->
                <div class="service-perf-card">
                    <div class="service-perf-header">
                        <span class="service-perf-num">09</span>
                        <div class="service-perf-icon"><i class="fas fa-tasks"></i></div>
                    </div>
                    <h3 class="service-perf-title animate__animated animate__fadeInUp animate__delay-1s">09. Auditoría de Proveedores</h3>
                    <p class="service-perf-desc">Control de cumplimiento técnico, normativo y de calidad en plantas, talleres y subcontratistas.</p>
                </div>

                <!-- 10. Auditoría de Soporte de Certificación -->
                <div class="service-perf-card">
                    <div class="service-perf-header">
                        <span class="service-perf-num">10</span>
                        <div class="service-perf-icon"><i class="fas fa-award"></i></div>
                    </div>
                    <h3 class="service-perf-title animate__animated animate__fadeInUp animate__delay-1s">10. Auditoría de Soporte de Certificación</h3>
                    <p class="service-perf-desc">Acompañamiento técnico y auditorías internas para la preparación hacia certificaciones ISO.</p>
                </div>

            </div>

        </div>
    </section>

    <!-- ==========================================================================
         5. LLAMADO A LA ACCIÓN FINAL (Contacto Corporativo)
         ========================================================================== -->
    <section class="cta-banner-section" id="contacto-final">
        <div class="cta-container">
            <div class="cta-box">
                <div class="cta-content">
                    <span class="cta-tag"><i class="fa-solid fa-handshake"></i> Alianzas Estratégicas</span>
                    <h3 class="animate__animated animate__fadeInUp animate__delay-1s">¿Listo para elevar el estándar técnico de tus proyectos?</h3>
                    <p>
                        Conversa con nuestro equipo sobre programas de capacitación in-house, cursos especializados y asesoría técnica a la medida de tu organización.
                    </p>
                    
                    <!-- Teléfono Visible Clickeable Requerido -->
                    <div class="cta-phone-wrapper" style="margin-top: 1.25rem;">
                        <a href="tel:+51993463118" class="cta-phone-link" aria-label="Llamar al +51 993 463 118">
                            <i class="fa-solid fa-phone-volume"></i>
                            <span>+51 993 463 118</span>
                        </a>
                    </div>
                </div>

                <div class="cta-actions">
                    <a href="/contacto" class="btn btn-large btn-qcs-primary">
                        <i class="fa-solid fa-envelope"></i> Solicitar propuesta corporativa
                    </a>
                    <a href="/consultoria" class="btn btn-outline-light btn-large btn-qcs-primary" style="border: 2px solid #ffffff; color: #ffffff;">
                        <i class="fa-solid fa-briefcase"></i> Ver asesoría especializada
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

