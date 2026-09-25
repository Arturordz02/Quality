<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página Principal (Home)
 * Archivo: app/Views/pages/home.php
 */

declare(strict_types=1);
?>
<style>
body {
            background-color: var(--qcs-bg-light);
            color: #1e293b;
        }

        /* ----------------------------------------------------
           1. HERO PRINCIPAL DE ALTO IMPACTO (Home)
           ---------------------------------------------------- */
        .home-hero-section {
            position: relative;
            padding: 210px 1.5rem 110px 1.5rem;
            background: linear-gradient(145deg, #0F1113 0%, #1A1D20 50%, #24292E 100%);
            color: #ffffff;
            overflow: hidden;
            border-bottom: 4px solid var(--accent-gold);
        }

        .home-hero-section::before {
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

        .home-hero-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px);
            background-size: 28px 28px;
            opacity: 0.65;
            pointer-events: none;
        }

        .home-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1.25rem;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 700;
            font-family: var(--font-heading);
            margin-bottom: 1.5rem;
        }

        .home-hero-title {
            font-family: var(--font-heading);
            font-weight: 900;
            font-size: clamp(2.2rem, 4.5vw, 3.6rem);
            letter-spacing: -0.5px;
            color: #ffffff;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
        }

        .home-hero-subtitle {
            font-family: var(--font-body);
            font-size: clamp(1.1rem, 1.8vw, 1.35rem);
            color: #e2e8f0;
            max-width: 880px;
            margin: 0 auto 2.5rem auto;
            line-height: 1.7;
        }

        /* ----------------------------------------------------
           2. FRANJA DE NÚMEROS DE IMPACTO (Trust Counters)
           ---------------------------------------------------- */
        .trust-counters-strip {
            background: #ffffff;
            border-radius: 20px;
            padding: 2.5rem 2rem;
            box-shadow: 0 15px 40px rgba(15, 17, 19, 0.2);
            border: 1px solid #e2e8f0;
            margin-top: -55px;
            position: relative;
            z-index: 10;
        }

        @media (max-width: 991.98px) {
            .trust-counters-strip {
                margin-top: 1.5rem !important;
                padding: 1.5rem 1rem !important;
            }
        }

        .counter-card {
            text-align: center;
            padding: 0.75rem 1rem;
            border-right: 1px solid #e2e8f0;
        }

        .counter-card:last-child {
            border-right: none;
        }

        @media (max-width: 768px) {
            .counter-card {
                border-right: none;
                border-bottom: 1px solid #e2e8f0;
                padding-bottom: 1.25rem;
                margin-bottom: 1.25rem;
            }
            .counter-card:last-child {
                border-bottom: none;
                margin-bottom: 0;
            }
        }

        .counter-number {
            font-family: var(--font-heading);
            font-size: 2.4rem;
            font-weight: 900;
            color: var(--qcs-dark-slate);
            line-height: 1;
            margin-bottom: 0.4rem;
        }

        .counter-label {
            font-family: var(--font-heading);
            font-size: 0.88rem;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ----------------------------------------------------
           3. SECCIÓN CONSULTORÍA: CARDS DE EJES Y METODOLOGÍA
           ---------------------------------------------------- */
        .consulting-card {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 30px rgba(15, 35, 60, 0.06);
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .consulting-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 45px rgba(15, 17, 19, 0.2);
            border-color: var(--accent-gold);
        }

        .consulting-card-img-wrap {
            position: relative;
            height: 220px;
            overflow: hidden;
        }

        .consulting-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .consulting-card:hover .consulting-card-img {
            transform: scale(1.08);
        }

        .consulting-card-icon-badge {
            position: absolute;
            bottom: -20px;
            right: 1.5rem;
            width: 54px;
            height: 54px;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
        }

        .consulting-card-body {
            padding: 2.25rem 1.75rem 1.75rem 1.75rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            justify-content: space-between;
        }

        .consulting-card-title {
            font-family: var(--font-heading);
            font-weight: 800;
            font-size: 1.25rem;
            color: var(--qcs-dark-slate);
            margin-bottom: 0.75rem;
            line-height: 1.35;
        }

        .consulting-card-desc {
            font-size: 0.92rem;
            line-height: 1.7;
            color: #475569;
            margin-bottom: 1.25rem;
        }

        .consulting-badge-tag {
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.3rem 0.65rem;
            border-radius: 6px;
            background-color: var(--qcs-bg-light);
            color: #334155;
        }

        .methodology-feature-box {
            background: #ffffff;
            border-radius: 18px;
            padding: 1.5rem 1.25rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.03);
            text-align: center;
            height: 100%;
            transition: all 0.3s ease;
        }

        .methodology-feature-box:hover {
            transform: translateY(-4px);
            border-color: var(--accent-gold);
            box-shadow: 0 12px 25px rgba(15, 17, 19, 0.2);
        }

        /* ----------------------------------------------------
           4. SECCIÓN CAPACITACIÓN: GARANTÍA & CATÁLOGO DE CURSOS
           ---------------------------------------------------- */
        .value-guarantee-card {
            background: #ffffff;
            border-radius: 18px;
            padding: 1.75rem 1.5rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.04);
            height: 100%;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .value-guarantee-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-gold);
        }

        .value-icon {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            background: rgba(229, 168, 19, 0.08);
            color: var(--qcs-dark-slate);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin: 0 auto 1rem auto;
        }

        .course-card {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 25px rgba(15, 35, 60, 0.06);
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .course-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 45px rgba(15, 17, 19, 0.2);
            border-color: var(--accent-gold);
        }

        .course-card-img-wrap {
            position: relative;
            height: 190px;
            overflow: hidden;
        }

        .course-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .course-card:hover .course-card-img {
            transform: scale(1.08);
        }

        .course-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            z-index: 2;
            font-family: var(--font-heading);
            font-size: 0.73rem;
            font-weight: 800;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            padding: 0.35rem 0.75rem;
            border-radius: 6px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .course-card-body {
            padding: 1.75rem 1.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            justify-content: space-between;
        }

        .course-card-title {
            font-family: var(--font-heading);
            font-weight: 800;
            font-size: 1.12rem;
            color: var(--qcs-dark-slate);
            margin-bottom: 0.6rem;
            line-height: 1.35;
        }

        .course-card-desc {
            font-size: 0.88rem;
            line-height: 1.65;
            color: #64748b;
            margin-bottom: 1.25rem;
        }

        .course-instructor {
            font-size: 0.82rem;
            color: #334155;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.25rem;
            padding-top: 0.6rem;
            border-top: 1px dashed #e2e8f0;
        }

        /* ----------------------------------------------------
           5. BANNER IN-COMPANY Y CLIENTES
           ---------------------------------------------------- */
        .incompany-banner {
            background: linear-gradient(145deg, #0F1113 0%, #1A1D20 50%, #24292E 100%);
            border-radius: 24px;
            padding: 3rem 2.5rem;
            color: #ffffff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 45px rgba(15, 17, 19, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.12);
        }

        .incompany-banner::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -10%;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(229, 168, 19, 0.22) 0%, transparent 70%);
            pointer-events: none;
        }

        .clients-showcase-box {
            background: #ffffff;
            border-radius: 24px;
            border: 1px solid #e2e8f0;
            padding: 3rem 2.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            text-align: center;
        }

        .clients-img-frame {
            background: #F4F5F7;
            border-radius: 16px;
            padding: 2rem 1.5rem;
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 2rem 0;
            box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.02);
        }

        /* ----------------------------------------------------
           6. BANNER DE CONTACTO RÁPIDO & DIRECCIÓN
           ---------------------------------------------------- */
        .home-contact-banner {
            background: linear-gradient(145deg, #0F1113 0%, #1A1D20 50%, #24292E 100%);
            border-radius: 24px;
            padding: 3.5rem 2.5rem;
            color: #ffffff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 45px rgba(15, 17, 19, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .home-contact-banner::before {
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
             1. HERO PRINCIPAL DE ALTO IMPACTO
             ========================================================================== -->
        <section class="home-hero-section text-center">
            <div class="home-hero-pattern"></div>
            <div class="container position-relative" style="z-index: 25;">
                
                <!-- Badge Superior -->
                <div class="d-inline-block">
                    <span class="home-hero-badge shadow-sm">
                        <i class="fa-solid fa-graduation-cap text-warning"></i> CAPACITACIÓN Y ASESORÍA ESPECIALIZADA
                    </span>
                </div>

                <!-- Headline Principal -->
                <h1 class="home-hero-title animate__animated animate__fadeInDown">
                    FORMACIÓN ESPECIALIZADA EN GESTIÓN DE PROYECTOS Y CALIDAD
                </h1>

                <!-- Subtítulo -->
                <p class="home-hero-subtitle">
                    Formamos y desarrollamos las competencias de profesionales del sector construcción, infraestructura y minería mediante cursos, programas especializados y asesoría técnica.
                </p>

                <!-- Botones CTA -->
                <div class="d-flex justify-content-center flex-wrap gap-3">
                    <a href="/consultoria" class="btn btn-qcs-primary btn-lg fw-bold rounded-pill shadow">
                        <i class="fas fa-briefcase me-2"></i> Ver Asesoría Especializada
                    </a>
                    <a href="/capacitacion" class="btn btn-qcs-dark btn-lg fw-bold rounded-pill shadow">
                        <i class="fas fa-graduation-cap me-2"></i> Cursos &amp; Capacitaciones
                    </a>
                </div>

            </div>
        </section>

        <!-- ==========================================================================
             2. FRANJA DE NÚMEROS DE IMPACTO (Trust Counters)
             ========================================================================== -->
        <section class="pb-5">
            <div class="container">
                <div class="trust-counters-strip">
                    <div class="row g-0 align-items-center">
                        
                        <div class="col-lg-3 col-6">
                            <div class="counter-card">
                                <div class="counter-number">+20</div>
                                <div class="counter-label">Años de Experiencia</div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="counter-card">
                                <div class="counter-number">+1,000</div>
                                <div class="counter-label">Profesionales Capacitados</div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="counter-card">
                                <div class="counter-number">+50</div>
                                <div class="counter-label">Empresas Atendidas</div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="counter-card">
                                <div class="counter-number" style="font-size: 1.85rem; color: #E5A813;">ISO • PMO • BIM</div>
                                <div class="counter-label">Estándares Internacionales</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- ==========================================================================
             3. SECCIÓN DESTACADA: CONSULTORÍA TÉCNICA Y ESTRATÉGICA
             ========================================================================== -->
        <section class="py-5" id="consultoria">
            <div class="container">
                
                <!-- Encabezado de Sección -->
                <div class="text-center mb-5">
                    <span class="badge bg-warning-subtle text-dark fw-bold px-3 py-2 rounded-pill text-uppercase mb-2">
                        <i class="fa-solid fa-briefcase me-1"></i> Asesoría Especializada
                    </span>
                    <h2 class="fw-extrabold font-montserrat text-dark display-6 mb-2 animate__animated animate__fadeInUp animate__delay-1s" style="font-weight: 800;">
                        ASESORÍA TÉCNICA Y FORMATIVA EN GESTIÓN DE PROYECTOS Y CALIDAD
                    </h2>
                    <p class="text-muted mx-auto" style="max-width: 780px;">
                        Acompañamos y orientamos a profesionales y organizaciones del sector construcción, infraestructura y minería mediante asesoría especializada, transferencia de metodologías y programas de capacitación aplicada.
                    </p>
                </div>

                <!-- Grid de 4 Ejes Estratégicos de Consultoría -->
                <div class="row g-4">
                    
                    <!-- Eje 1: Gestión de la Calidad e ISO 9001 -->
                    <div class="col-lg-6 col-md-6">
                        <div class="consulting-card rounded-4 border-start border-4 border-warning" data-aos="fade-right">
                            <div class="consulting-card-img-wrap">
                                <img src="img/Index-GestionCalidad.png" alt="Gestión de la Calidad e ISO 9001 en Construcción" class="consulting-card-img" loading="lazy">
                                <div class="consulting-card-icon-badge">
                                    <i class="fas fa-certificate text-dark fs-3"></i>
                                </div>
                            </div>
                            <div class="consulting-card-body">
                                <div>
                                    <div class="d-flex gap-2 flex-wrap mb-2">
                                        <span class="consulting-badge-tag"><i class="fa-solid fa-check text-success me-1"></i> ISO 9001:2015</span>
                                        <span class="consulting-badge-tag"><i class="fa-solid fa-check text-success me-1"></i> Planes de Calidad</span>
                                        <span class="consulting-badge-tag"><i class="fa-solid fa-check text-success me-1"></i> No Conformidades</span>
                                    </div>
                                    <h3 class="consulting-card-title animate__animated animate__fadeInUp animate__delay-1s">Gestión de la Calidad e ISO 9001</h3>
                                    <p class="consulting-card-desc">
                                        Formación especializada en gestión de la calidad, ISO 9001, planes de calidad y control de no conformidades, orientada a profesionales del sector construcción.
                                    </p>
                                </div>
                                <div>
                                    <a href="/gestion-de-la-calidad" class="btn btn-qcs-dark w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="border-color: var(--qcs-yellow); color: var(--qcs-dark-slate);">
                                        Ver formación en Calidad <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Eje 2: Gestión de Proyectos & PMO -->
                    <div class="col-lg-6 col-md-6">
                        <div class="consulting-card rounded-4 border-start border-4 border-warning" data-aos="fade-up">
                            <div class="consulting-card-img-wrap">
                                <img src="img/Index-GobernanzaPMO.png" alt="Gestión de Proyectos y PMO" class="consulting-card-img" loading="lazy">
                                <div class="consulting-card-icon-badge">
                                    <i class="fas fa-sitemap text-success fs-3"></i>
                                </div>
                            </div>
                            <div class="consulting-card-body">
                                <div>
                                    <div class="d-flex gap-2 flex-wrap mb-2">
                                        <span class="consulting-badge-tag"><i class="fa-solid fa-check text-success me-1"></i> Gestión de PMO</span>
                                        <span class="consulting-badge-tag"><i class="fa-solid fa-check text-success me-1"></i> Gestión de Portafolios</span>
                                        <span class="consulting-badge-tag"><i class="fa-solid fa-check text-success me-1"></i> KPIs de Proyectos</span>
                                    </div>
                                    <h3 class="consulting-card-title animate__animated animate__fadeInUp animate__delay-1s">GESTIÓN DE PROYECTOS &amp; PMO</h3>
                                    <p class="consulting-card-desc">
                                        Formación especializada en gestión de PMO, planificación y control de proyectos, gestión de portafolios y KPIs, con herramientas y metodologías aplicadas al sector construcción.
                                    </p>
                                </div>
                                <div>
                                    <a href="/gestion-de-pmo" class="btn btn-qcs-dark w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="border-color: var(--qcs-yellow); color: var(--qcs-dark-slate);">
                                        Ver formación en PMO <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Eje 3: Gestión de Riesgos & Cronogramas Forenses -->
                    <div class="col-lg-6 col-md-6">
                        <div class="consulting-card rounded-4 border-start border-4 border-warning" data-aos="fade-left">
                            <div class="consulting-card-img-wrap">
                                <img src="img/Index-riesgos.png" alt="Gestión de Riesgos y Cronogramas Forenses" class="consulting-card-img" loading="lazy">
                                <div class="consulting-card-icon-badge">
                                    <i class="fas fa-shield-alt text-warning fs-3"></i>
                                </div>
                            </div>
                            <div class="consulting-card-body">
                                <div>
                                    <div class="d-flex gap-2 flex-wrap mb-2">
                                        <span class="consulting-badge-tag"><i class="fa-solid fa-check text-success me-1"></i> Curva de Liberación®</span>
                                        <span class="consulting-badge-tag"><i class="fa-solid fa-check text-success me-1"></i> Análisis de Demoras</span>
                                        <span class="consulting-badge-tag"><i class="fa-solid fa-check text-success me-1"></i> Riesgos Contractuales</span>
                                    </div>
                                    <h3 class="consulting-card-title animate__animated animate__fadeInUp animate__delay-1s">Gestión de Riesgos &amp; Cronogramas</h3>
                                    <p class="consulting-card-desc">
                                        Entrenamiento y asesoría técnica en metodologías de gestión de riesgos contractuales, análisis de demoras y aplicación de la Curva de Liberación®.
                                    </p>
                                </div>
                                <div>
                                    <a href="/gestion-de-riesgos" class="btn btn-qcs-dark w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="border-color: var(--qcs-yellow); color: var(--qcs-dark-slate);">
                                        Ver programas en Riesgos <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Eje 4: Homologación & Auditoría de Proveedores -->
                    <div class="col-lg-6 col-md-6">
                        <div class="consulting-card rounded-4 border-start border-4 border-warning" data-aos="fade-right">
                            <div class="consulting-card-img-wrap">
                                <img src="img/Index-Homologaciones.png" alt="Homologación y Auditoría de Proveedores" class="consulting-card-img" loading="lazy">
                                <div class="consulting-card-icon-badge">
                                    <i class="fas fa-truck-loading text-warning fs-3"></i>
                                </div>
                            </div>
                            <div class="consulting-card-body">
                                <div>
                                    <div class="d-flex gap-2 flex-wrap mb-2">
                                        <span class="consulting-badge-tag"><i class="fa-solid fa-check text-success me-1"></i> Cadena de Suministro</span>
                                        <span class="consulting-badge-tag"><i class="fa-solid fa-check text-success me-1"></i> Homologaciones</span>
                                        <span class="consulting-badge-tag"><i class="fa-solid fa-check text-success me-1"></i> Normativa Técnica</span>
                                    </div>
                                    <h3 class="consulting-card-title animate__animated animate__fadeInUp animate__delay-1s">Homologación de Proveedores</h3>
                                    <p class="consulting-card-desc">
                                        Asesoría técnica para orientar y preparar a empresas proveedoras en el cumplimiento de estándares, matrices de homologación y requisitos de clientes.
                                    </p>
                                </div>
                                <div>
                                    <a href="/homologaciones" class="btn btn-qcs-dark w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="border-color: var(--qcs-yellow); color: var(--qcs-dark-slate);">
                                        Conocer más de Homologaciones <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Franja de Respaldo Metodológico -->
                <div class="row g-3 mt-4">
                    <div class="col-lg-3 col-6">
                        <div class="methodology-feature-box">
                            <i class="fa-solid fa-user-check text-dark fs-3 mb-2"></i>
                            <h4 class="fw-bold font-montserrat fs-6 mb-1 text-dark">Asesoría Personalizada</h4>
                            <p class="small text-muted mb-0">Soluciones a medida para cada proyecto y tipo de contrato.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="methodology-feature-box">
                            <i class="fa-solid fa-building-columns text-success fs-3 mb-2"></i>
                            <h4 class="fw-bold font-montserrat fs-6 mb-1 text-dark">Metodología PMBOK® &amp; ISO</h4>
                            <p class="small text-muted mb-0">Marcos de referencia con reconocimiento global.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="methodology-feature-box">
                            <i class="fa-solid fa-chart-line text-warning fs-3 mb-2"></i>
                            <h4 class="fw-bold font-montserrat fs-6 mb-1 text-dark">Curva de Liberación®</h4>
                            <p class="small text-muted mb-0">Herramienta propietaria para prevención de atrasos.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="methodology-feature-box">
                            <i class="fa-solid fa-magnifying-glass-chart text-warning fs-3 mb-2"></i>
                            <h4 class="fw-bold font-montserrat fs-6 mb-1 text-dark">Metodología Forense y Análisis de Plazos</h4>
                            <p class="small text-muted mb-0">Técnicas analíticas para evaluación de demoras en obra.</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ==========================================================================
             4. SECCIÓN DESTACADA: CAPACITACIÓN EJECUTIVA & PORTAL ED-TECH
             ========================================================================== -->
        <section class="py-5 bg-white border-top border-bottom" id="capacitacion">
            <div class="container">
                
                <!-- Encabezado de Sección -->
                <div class="text-center mb-5">
                    <span class="badge bg-warning text-dark fw-bold px-3 py-2 rounded-pill text-uppercase mb-2 shadow-sm">
                        <i class="fas fa-graduation-cap me-1"></i> ED-TECH &amp; CAPACITACIÓN EJECUTIVA
                    </span>
                    <h2 class="fw-extrabold font-montserrat text-dark display-6 mb-2 animate__animated animate__fadeInUp animate__delay-1s" style="font-weight: 800;">
                        PROGRAMAS DE ESPECIALIZACIÓN PROFESIONAL
                    </h2>
                    <p class="text-muted mx-auto" style="max-width: 780px;">
                        Desarrolla competencias técnicas avanzadas en dirección de proyectos, contratos FIDIC/NEC, gerencia de calidad, BIM y valor ganado con docentes líderes de la industria.
                    </p>
                </div>

                <!-- 4 Garantías de Aprendizaje -->
                <div class="row g-4 mb-5">
                    
                    <div class="col-lg-3 col-md-6">
                        <div class="value-guarantee-card rounded-4 border-start border-4 border-warning" data-aos="fade-up">
                            <div class="value-icon"><i class="fa-solid fa-circle-play text-dark"></i></div>
                            <h4 class="fw-bold font-montserrat fs-6 text-dark">Clases Grabadas 100% Online</h4>
                            <p class="small text-muted mb-0">Acceso inmediato a las clases y disponible 24/7.</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="value-guarantee-card rounded-4 border-start border-4 border-warning" data-aos="fade-left">
                            <div class="value-icon"><i class="fa-solid fa-cloud-arrow-down text-success"></i></div>
                            <h4 class="fw-bold font-montserrat fs-6 text-dark">Acceso 24/7</h4>
                            <p class="small text-muted mb-0">Acceso inmediato a las clases y disponible 24/7.</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="value-guarantee-card rounded-4 border-start border-4 border-warning" data-aos="fade-right">
                            <div class="value-icon"><i class="fa-solid fa-certificate text-warning"></i></div>
                            <h4 class="fw-bold font-montserrat fs-6 text-dark">Diploma de Acreditación</h4>
                            <p class="small text-muted mb-0">Certificado oficial con horas académicas y código único de validación.</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="value-guarantee-card rounded-4 border-start border-4 border-warning" data-aos="fade-up">
                            <div class="value-icon"><i class="fa-solid fa-briefcase text-warning"></i></div>
                            <h4 class="fw-bold font-montserrat fs-6 text-dark">Bolsa de Trabajo</h4>
                            <p class="small text-muted mb-0">Conexión con empresas líderes del sector para oportunidades laborales.</p>
                        </div>
                    </div>

                </div>

                <!-- Subtítulo de Catálogo -->
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                    <div>
                        <h3 class="fw-bold font-montserrat text-dark fs-4 mb-0 animate__animated animate__fadeInUp animate__delay-1s">Cursos Ejecutivos Más Destacados</h3>
                        <p class="text-muted small mb-0">Programas con apertura de inscripciones y certificación internacional</p>
                    </div>
                    <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill font-montserrat fw-semibold">
                        <i class="fa-solid fa-layer-group text-dark me-1"></i> +16 Cursos Disponibles
                    </span>
                </div>

                <!-- Grid de Cursos Destacados -->
                <div class="row g-4">
                    
                    <!-- 1. FIDIC -->
                    <div class="col-lg-3 col-md-6">
                        <div class="course-card rounded-4 border-start border-4 border-warning" data-aos="fade-left">
                            <div class="course-card-img-wrap">
                                <span class="course-badge bg-dark text-warning border border-warning-subtle text-white">CONTRATOS</span>
                                <img src="img/Index-Contratos-Internacionales.png" alt="Contratos Internacionales FIDIC" class="course-card-img" loading="lazy">
                            </div>
                            <div class="course-card-body">
                                <div>
                                    <h4 class="course-card-title">Contratos Internacionales FIDIC</h4>
                                    <p class="course-card-desc">Administración de reclamos, cláusulas estándar y resolución de disputas en obras internacionales.</p>
                                    <div class="course-instructor"><i class="fa-solid fa-user-tie text-dark"></i> Especialistas FIDIC</div>
                                </div>
                                <div>
                                    <a href="/fidic" class="btn btn-sm w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="background-color: var(--qcs-yellow); color: var(--qcs-black); border-color: var(--qcs-yellow);">Ver Programa <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. PMO -->
                    <div class="col-lg-3 col-md-6">
                        <div class="course-card rounded-4 border-start border-4 border-warning" data-aos="fade-right">
                            <div class="course-card-img-wrap">
                                <span class="course-badge bg-success text-white">PMO</span>
                                <img src="img/Index-GestionPMO.png" alt="Gestión de la PMO" class="course-card-img" loading="lazy">
                            </div>
                            <div class="course-card-body">
                                <div>
                                    <h4 class="course-card-title">Gestión de la PMO</h4>
                                    <p class="course-card-desc">Diseño, implementación y gobernanza de Oficinas de Gestión de Proyectos en empresas de ingeniería.</p>
                                    <div class="course-instructor"><i class="fa-solid fa-user-tie text-success"></i> Expertos en PMO</div>
                                </div>
                                <div>
                                    <a href="/pmo" class="btn btn-sm w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="background-color: var(--qcs-yellow); color: var(--qcs-black); border-color: var(--qcs-yellow);">Ver Programa <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Gerencia de Calidad -->
                    <div class="col-lg-3 col-md-6">
                        <div class="course-card rounded-4 border-start border-4 border-warning" data-aos="fade-up">
                            <div class="course-card-img-wrap">
                                <span class="course-badge bg-warning text-dark">CALIDAD</span>
                                <img src="img/Index-GerenciaCalidadObras.png" alt="Gerencia de la Calidad para la Infraestructura" class="course-card-img" loading="lazy">
                            </div>
                            <div class="course-card-body">
                                <div>
                                    <h4 class="course-card-title">Gerencia de la Calidad en Obras</h4>
                                    <p class="course-card-desc">Control de aseguramiento, planes de inspección y ensayos (PIE) y auditorías en megaproyectos.</p>
                                    <div class="course-instructor"><i class="fa-solid fa-user-tie text-warning"></i> Auditores IRCA</div>
                                </div>
                                <div>
                                    <a href="/gerencia-de-calidad" class="btn btn-sm w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="background-color: var(--qcs-yellow); color: var(--qcs-black); border-color: var(--qcs-yellow);">Ver Programa <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Valor Ganado -->
                    <div class="col-lg-3 col-md-6">
                        <div class="course-card rounded-4 border-start border-4 border-warning" data-aos="fade-left">
                            <div class="course-card-img-wrap">
                                <span class="course-badge bg-warning text-dark text-dark">CONTROL</span>
                                <img src="img/Index_ValorGanado.png" alt="Método del Valor Ganado (EVM)" class="course-card-img" loading="lazy">
                            </div>
                            <div class="course-card-body">
                                <div>
                                    <h4 class="course-card-title">Método del Valor Ganado (EVM)</h4>
                                    <p class="course-card-desc">Control de costo y cronograma mediante índices SPI, CPI y proyecciones EAC de alta precisión.</p>
                                    <div class="course-instructor"><i class="fa-solid fa-user-tie text-warning"></i> Project Controls Lead</div>
                                </div>
                                <div>
                                    <a href="/valor-ganado" class="btn btn-sm w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="background-color: var(--qcs-yellow); color: var(--qcs-black); border-color: var(--qcs-yellow);">Ver Programa <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 5. BIM Revit Architecture -->
                    <div class="col-lg-3 col-md-6">
                        <div class="course-card rounded-4 border-start border-4 border-warning" data-aos="fade-right">
                            <div class="course-card-img-wrap">
                                <span class="course-badge bg-dark text-warning border border-warning-subtle text-white">BIM</span>
                                <img src="img/Index-BIMRevitArchitecture.png" alt="BIM Revit Architecture" class="course-card-img" loading="lazy">
                            </div>
                            <div class="course-card-body">
                                <div>
                                    <h4 class="course-card-title">BIM Revit Architecture</h4>
                                    <p class="course-card-desc">Modelado 3D, coordinación de interferencias y estándares del Plan BIM Perú en edificaciones.</p>
                                    <div class="course-instructor"><i class="fa-solid fa-user-tie text-dark"></i> BIM Managers</div>
                                </div>
                                <div>
                                    <a href="/bim-revit-architecture" class="btn btn-sm w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="background-color: var(--qcs-yellow); color: var(--qcs-black); border-color: var(--qcs-yellow);">Ver Programa <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 6. Oficina Técnica -->
                    <div class="col-lg-3 col-md-6">
                        <div class="course-card rounded-4 border-start border-4 border-warning" data-aos="fade-up">
                            <div class="course-card-img-wrap">
                                <span class="course-badge bg-secondary text-white">OFICINA TÉCNICA</span>
                                <img src="img/Index-OficinaTecnicaObras.png" alt="Oficina Técnica Obras Privadas y Públicas" class="course-card-img" loading="lazy">
                            </div>
                            <div class="course-card-body">
                                <div>
                                    <h4 class="course-card-title">Oficina Técnica en Obras</h4>
                                    <p class="course-card-desc">Control documentario, valorizaciones, metrados, RFI y submittals en la administración técnica.</p>
                                    <div class="course-instructor"><i class="fa-solid fa-user-tie text-secondary"></i> Jefes de Oficina Técnica</div>
                                </div>
                                <div>
                                    <a href="/oficina-tecnica" class="btn btn-sm w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="background-color: var(--qcs-yellow); color: var(--qcs-black); border-color: var(--qcs-yellow);">Ver Programa <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 7. Lean Last Planner -->
                    <div class="col-lg-3 col-md-6">
                        <div class="course-card rounded-4 border-start border-4 border-warning" data-aos="fade-left">
                            <div class="course-card-img-wrap">
                                <span class="course-badge bg-success text-white">PRODUCTIVIDAD</span>
                                <img src="img/index_LeanLast.png" alt="Lean Construction &amp; Last Planner" class="course-card-img" loading="lazy">
                            </div>
                            <div class="course-card-body">
                                <div>
                                    <h4 class="course-card-title">Lean &amp; Last Planner System</h4>
                                    <p class="course-card-desc">Optimización de flujos de producción, reducción de desperdicios y planificación colaborativa en obra.</p>
                                    <div class="course-instructor"><i class="fa-solid fa-user-tie text-success"></i> Consultores Lean</div>
                                </div>
                                <div>
                                    <a href="/lean-last-planner" class="btn btn-sm w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="background-color: var(--qcs-yellow); color: var(--qcs-black); border-color: var(--qcs-yellow);">Ver Programa <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 8. Riesgos PMI -->
                    <div class="col-lg-3 col-md-6">
                        <div class="course-card rounded-4 border-start border-4 border-warning" data-aos="fade-right">
                            <div class="course-card-img-wrap">
                                <span class="course-badge bg-warning text-dark">RIESGOS PMI</span>
                                <img src="img/Index-RiesgosPMI.png" alt="Gestión de Riesgos con Enfoque PMI" class="course-card-img" loading="lazy">
                            </div>
                            <div class="course-card-body">
                                <div>
                                    <h4 class="course-card-title">Gestión de Riesgos PMI</h4>
                                    <p class="course-card-desc">Estrategias de identificación, matrices de riesgo, simulación Monte Carlo y respuesta a contingencias.</p>
                                    <div class="course-instructor"><i class="fa-solid fa-user-tie text-warning"></i> PMP® / PMI-RMP®</div>
                                </div>
                                <div>
                                    <a href="/riesgos-pmi" class="btn btn-sm w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="background-color: var(--qcs-yellow); color: var(--qcs-black); border-color: var(--qcs-yellow);">Ver Programa <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Banner In-Company -->
                <div class="incompany-banner mt-5">
                    <div class="row align-items-center">
                        <div class="col-lg-8 mb-3 mb-lg-0">
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-2 shadow-sm">
                                <i class="fa-solid fa-building me-1"></i> CAPACITACIÓN CORPORATIVA IN-HOUSE
                            </span>
                            <h3 class="fw-bold font-montserrat text-white fs-4 mb-2 animate__animated animate__fadeInUp animate__delay-1s">
                                ¿Deseas capacitar a tu equipo de ingeniería a la medida?
                            </h3>
                            <p class="text-light text-opacity-90 mb-0 small" style="line-height: 1.7;">
                                Desarrollamos programas cerrados in-company alineados a los requerimientos técnicos y proyectos en ejecución de tu organización.
                            </p>
                        </div>
                        <div class="col-lg-4 text-lg-end text-center">
                            <a href="https://wa.me/51993463118?text=Hola,%20deseo%20cotizar%20un%20programa%20de%20capacitaci%C3%B3n%20in-company%20para%20mi%20empresa" target="_blank" rel="noopener noreferrer" class="btn btn-warning btn-md px-4 py-2 fw-bold rounded-pill shadow text-dark animate__animated animate__pulse animate__infinite btn-qcs-primary">
                                <i class="fab fa-whatsapp me-1"></i> Cotizar In-Company
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ==========================================================================
             5. SHOWCASE DE CLIENTES DESTACADOS
             ========================================================================== -->
        <section class="py-5">
            <div class="container">
                <div class="clients-showcase-box rounded-4 border-start border-4 border-warning" data-aos="fade-up">
                    <span class="badge bg-warning-subtle text-dark fw-bold px-3 py-2 rounded-pill text-uppercase mb-2">
                        <i class="fa-solid fa-handshake me-1"></i> Confianza Corporativa
                    </span>
                    <h2 class="fw-extrabold font-montserrat text-dark display-6 mb-2 animate__animated animate__fadeInUp animate__delay-1s" style="font-weight: 800;">
                        EMPRESAS QUE CONFÍAN EN NOSOTROS
                    </h2>
                    <p class="text-muted mx-auto mb-4" style="max-width: 680px;">
                        Brindamos soporte estratégico y capacitación a las organizaciones líderes en ingeniería, construcción, minería e infraestructura del país.
                    </p>

                    <!-- Imagen de Clientes -->
                    <div class="clients-img-frame">
                        <img src="img/ClientesQuality.png" alt="Empresas y Clientes que confían en Quality Consulting Solutions" class="img-fluid" style="max-height: 280px; object-fit: contain;" loading="lazy">
                    </div>

                    <div>
                        <a href="/clientes" class="btn btn-qcs-dark btn-lg px-5 py-3 fw-bold rounded-pill btn-qcs-primary" style="border-color: var(--qcs-yellow); color: var(--qcs-dark-slate);">
                            <i class="fas fa-users me-2"></i> Ver Portafolio Completo de Clientes
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==========================================================================
             6. BANNER DE CONTACTO RÁPIDO & DIRECCIÓN OFICIAL
             ========================================================================== -->
        <section class="py-5">
            <div class="container">
                <div class="home-contact-banner">
                    <div class="row align-items-center">
                        
                        <div class="col-lg-8 mb-4 mb-lg-0">
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm">
                                <i class="fa-solid fa-headset me-1"></i> ATENCIÓN INMEDIATA
                            </span>
                            <h2 class="fw-bold font-montserrat text-white mb-3 animate__animated animate__fadeInUp animate__delay-1s" style="font-size: clamp(1.6rem, 2.5vw, 2.3rem);">
                                ¿Listo para potenciar la gestión y calidad de tus proyectos?
                            </h2>
                            <p class="text-light text-opacity-90 mb-3" style="font-size: 1.05rem; line-height: 1.8;">
                                Contáctanos hoy mismo para coordinar reuniones técnicas, cotizaciones a la medida o inscripciones corporativas.
                            </p>
                            <div class="d-flex flex-wrap gap-4 text-light">
                                <div>
                                    <i class="fa-solid fa-phone text-warning me-2"></i>
                                    Teléfono / WhatsApp: <a href="tel:+51993463118" class="text-white fw-bold">+51 993 463 118</a>
                                </div>
                                <div>
                                    <i class="fa-solid fa-location-dot text-warning me-2"></i>
                                    Sede: <span class="text-white fw-semibold">Av. Javier Prado 757, piso 10 Magdalena, Lima 17</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 text-lg-end text-center">
                            <div class="d-flex flex-column gap-3 justify-content-center">
                                <a href="https://wa.me/51993463118" target="_blank" rel="noopener noreferrer" class="btn btn-warning btn-lg px-4 py-3 fw-bold rounded-pill shadow-lg text-dark animate__animated animate__pulse animate__infinite btn-qcs-primary">
                                    <i class="fab fa-whatsapp me-2"></i> Chatear por WhatsApp
                                </a>
                                <a href="/contacto" class="btn btn-outline-light btn-lg px-4 py-3 fw-bold rounded-pill btn-qcs-primary">
                                    <i class="fa-solid fa-envelope me-2"></i> Formulario de Contacto
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
</main>
