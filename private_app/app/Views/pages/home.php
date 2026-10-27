<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página Principal (Home)
 * Archivo: app/Views/pages/home.php
 */

declare(strict_types=1);

$coursesCount = $coursesCount ?? count(\App\Services\CoursesCatalog::getAll());
?>
<style>
body {
            background-color: var(--qcs-bg-light);
            color: #1e293b;
        }

        /* ----------------------------------------------------
           1. HERO PRINCIPAL PANORÁMICO DE ALTO IMPACTO (Home)
           ---------------------------------------------------- */
        .home-hero-section {
            position: relative;
            min-height: 86vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 195px 1.5rem 105px 1.5rem;
            background-color: #07090A;
            color: #ffffff;
            overflow: hidden;
            border-bottom: 4px solid var(--accent-gold, #E5A813);
        }

        /* Capa de imagen fotográfica de fondo en alta definición y sin bloqueos */
        .home-hero-bg-layer {
            position: absolute;
            inset: 0;
            background-image: url('img/Hero-Quality-Consulting.webp');
            background-size: cover;
            background-position: center 38%;
            background-repeat: no-repeat;
            filter: brightness(0.92) contrast(1.08) saturate(1.12);
            transform: scale(1.01);
            pointer-events: none;
            z-index: 1;
            transition: transform 10s ease-out;
        }

        /* Gradiente cinemático inteligente: Oscuro en extremos y cristalino al centro */
        .home-hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, 
                rgba(7, 9, 10, 0.78) 0%, 
                rgba(7, 9, 10, 0.22) 32%, 
                rgba(7, 9, 10, 0.28) 65%, 
                rgba(7, 9, 10, 0.88) 100%
            ),
            radial-gradient(ellipse at 50% 50%, rgba(0, 0, 0, 0) 0%, rgba(7, 9, 10, 0.45) 100%);
            pointer-events: none;
            z-index: 2;
        }

        .home-hero-pattern {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px);
            background-size: 32px 32px;
            opacity: 0.25;
            pointer-events: none;
            z-index: 3;
        }

        /* Contenedor Flotante Abierto y Elegante */
        .home-hero-content-wrap {
            max-width: 1060px;
            margin: 0 auto;
            position: relative;
            z-index: 10;
        }

        /* Badge Superior Glass con punto de pulso */
        .home-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            color: #ffffff;
            border: 1px solid rgba(229, 168, 19, 0.45);
            padding: 0.55rem 1.4rem;
            border-radius: 50px;
            font-size: 0.84rem;
            font-weight: 700;
            font-family: var(--font-heading);
            margin-bottom: 1.35rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4), 0 0 15px rgba(229, 168, 19, 0.15);
            text-transform: uppercase;
            letter-spacing: 0.6px;
        }

        .badge-pulse-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: var(--accent-gold, #E5A813);
            box-shadow: 0 0 10px var(--accent-gold, #E5A813);
            display: inline-block;
            animation: pulseGlow 2s infinite ease-in-out;
        }

        @keyframes pulseGlow {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(0.85); }
        }

        .home-hero-title {
            font-family: var(--font-heading);
            font-weight: 900;
            font-size: clamp(2.3rem, 4.8vw, 3.85rem);
            letter-spacing: -0.5px;
            color: #ffffff;
            line-height: 1.15;
            margin-bottom: 1.25rem;
            text-shadow: 0 4px 25px rgba(0, 0, 0, 0.9), 0 2px 8px rgba(0, 0, 0, 0.85);
        }

        /* Cápsula de la Cita con Glassmorfismo Ultraligero */
        .home-hero-quote-box {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(15, 17, 19, 0.55);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(229, 168, 19, 0.35);
            border-radius: 50px;
            padding: 0.75rem 2rem;
            margin: 0 auto 1.4rem auto;
            max-width: 980px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.45);
        }

        @media (max-width: 767.98px) {
            .home-hero-quote-box {
                border-radius: 18px;
                padding: 0.85rem 1.25rem;
                flex-direction: column;
                gap: 0.4rem;
            }
        }

        .quote-icon {
            color: var(--accent-gold, #E5A813);
            font-size: 1rem;
            opacity: 0.9;
        }

        .home-hero-quote-text {
            font-family: var(--font-heading);
            font-weight: 600;
            font-style: italic;
            color: #fef08a;
            font-size: clamp(0.95rem, 1.6vw, 1.18rem);
            line-height: 1.5;
            margin: 0;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.9);
        }

        .home-hero-subtitle {
            font-family: var(--font-body);
            font-size: clamp(1.02rem, 1.4vw, 1.15rem);
            color: #f1f5f9;
            max-width: 920px;
            margin: 0 auto 2.25rem auto;
            line-height: 1.75;
            text-shadow: 0 3px 12px rgba(0, 0, 0, 0.9);
        }

        /* Micro-tags de áreas clave */
        .hero-tag-pill {
            background: rgba(15, 23, 42, 0.55);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 30px;
            padding: 0.4rem 1.1rem;
            font-size: 0.82rem;
            color: #e2e8f0;
            font-weight: 600;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.9);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.25);
            transition: all 0.3s ease;
        }

        .hero-tag-pill:hover {
            border-color: var(--accent-gold, #E5A813);
            transform: translateY(-2px);
            color: #ffffff;
        }

        .btn-qcs-hero-primary {
            background: linear-gradient(135deg, #E5A813 0%, #D4920B 100%);
            color: #0F1113 !important;
            font-weight: 800;
            border: none;
            box-shadow: 0 8px 30px rgba(229, 168, 19, 0.5);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-qcs-hero-primary:hover {
            transform: translateY(-3px) scale(1.04);
            box-shadow: 0 14px 40px rgba(229, 168, 19, 0.7);
            color: #000000 !important;
        }

        .btn-qcs-hero-secondary {
            background: rgba(15, 23, 42, 0.75);
            color: #ffffff !important;
            border: 1.5px solid rgba(229, 168, 19, 0.55);
            font-weight: 700;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.35);
        }

        .btn-qcs-hero-secondary:hover {
            background: rgba(229, 168, 19, 0.25);
            border-color: var(--accent-gold);
            transform: translateY(-3px);
            color: #ffffff !important;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.5);
        }

        .btn-qcs-hero-outline {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff !important;
            border: 1.5px solid rgba(255, 255, 255, 0.6);
            font-weight: 700;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.35);
        }

        .btn-qcs-hero-outline:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: #ffffff;
            transform: translateY(-3px);
            color: #ffffff !important;
            box-shadow: 0 12px 30px rgba(255, 255, 255, 0.25);
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
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: default;
        }

        .counter-card:hover {
            transform: translateY(-4px);
        }

        .counter-icon-wrap {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(229, 168, 19, 0.12);
            color: var(--accent-gold, #E5A813);
            margin-bottom: 0.65rem;
            font-size: 1.25rem;
            transition: all 0.3s ease;
        }

        .counter-card:hover .counter-icon-wrap {
            background: var(--accent-gold, #E5A813);
            color: #0F1113;
            transform: scale(1.1);
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
           5. BANNER IN-HOUSE Y CLIENTES
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
        <!-- ==========================================================================
             1. HERO PRINCIPAL DE ALTO IMPACTO (Cinematic Blurred Background)
             ========================================================================== -->
        <section class="home-hero-section text-center">
            <div class="home-hero-bg-layer"></div>
            <div class="home-hero-overlay"></div>
            <div class="home-hero-pattern"></div>
            
            <div class="container position-relative" style="z-index: 25;">
                
                <div class="home-hero-content-wrap animate__animated animate__fadeIn">
                    
                    <!-- Badge Superior Elegante con efecto Glass y Neon Amber -->
                    <div class="d-inline-flex align-items-center mb-3">
                        <span class="home-hero-badge shadow">
                            <span class="badge-pulse-dot"></span>
                            <span>CAPACITACIÓN ESPECIALIZADA EN INGENIERÍA</span>
                        </span>
                    </div>

                    <!-- Headline Principal Majestuoso -->
                    <h1 class="home-hero-title animate__animated animate__fadeInDown">
                        QUALITY CONSULTING SOLUTIONS
                    </h1>

                    <!-- Cita Emblemática en Cápsula Glassmórfica Transparente -->
                    <div class="home-hero-quote-box">
                        <i class="fa-solid fa-quote-left quote-icon me-2"></i>
                        <span class="home-hero-quote-text">
                            Para mejorar la calidad de las cosas que hacen las personas, debemos mejorar la calidad de las personas que hacen las cosas
                        </span>
                        <i class="fa-solid fa-quote-right quote-icon ms-2"></i>
                    </div>

                    <!-- Párrafo Descriptivo Ejecutivo -->
                    <p class="home-hero-subtitle">
                        La calidad es un tema estratégico para alcanzar la excelencia y sostenibilidad. Impulsamos a profesionales y organizaciones del sector construcción e infraestructura mediante metodologías aplicadas de alto nivel.
                    </p>

                    <!-- Botones CTA de Alto Impacto -->
                    <div class="d-flex justify-content-center flex-wrap gap-2 gap-md-3 mb-4 position-relative" style="z-index: 2;">
                        <a href="/capacitacion" class="btn btn-qcs-hero-primary btn-lg rounded-pill px-4 py-3 shadow-lg">
                            <i class="fas fa-graduation-cap me-2"></i> CAPACITACIÓN
                        </a>
                        <a href="/medios" class="btn btn-qcs-hero-outline btn-lg rounded-pill px-4 py-3 shadow">
                            <i class="fas fa-podcast me-2 text-warning"></i> MEDIOS Y PODCASTS
                        </a>
                    </div>

                    <!-- Micro-Pills de Especialidades -->
                    <div class="home-hero-tags-row d-flex justify-content-center flex-wrap gap-2 gap-md-3 pt-2">
                        <span class="hero-tag-pill"><i class="fa-solid fa-circle-check text-warning me-1"></i> Metodología PMBOK® &amp; Ágil</span>
                        <span class="hero-tag-pill"><i class="fa-solid fa-shield-halved text-warning me-1"></i> Sistemas ISO 9001</span>
                        <span class="hero-tag-pill"><i class="fa-solid fa-cubes text-warning me-1"></i> BIM &amp; Contratos NEC / FIDIC</span>
                    </div>

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
                                <div class="counter-icon-wrap">
                                    <i class="fa-solid fa-award"></i>
                                </div>
                                <div class="counter-number">+20</div>
                                <div class="counter-label">Años de Experiencia</div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="counter-card">
                                <div class="counter-icon-wrap">
                                    <i class="fa-solid fa-user-graduate"></i>
                                </div>
                                <div class="counter-number">+1,500</div>
                                <div class="counter-label">Profesionales Capacitados</div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="counter-card">
                                <div class="counter-icon-wrap">
                                    <i class="fa-solid fa-building"></i>
                                </div>
                                <div class="counter-number">+50</div>
                                <div class="counter-label">Empresas Atendidas</div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="counter-card">
                                <div class="counter-icon-wrap">
                                    <i class="fa-solid fa-certificate"></i>
                                </div>
                                <div class="counter-number" style="font-size: 1.85rem; color: #E5A813;">ISO • PMO • BIM</div>
                                <div class="counter-label">Estándares Internacionales</div>
                            </div>
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
                            <div class="value-icon"><i class="fa-solid fa-chalkboard-user text-dark"></i></div>
                            <h4 class="fw-bold font-montserrat fs-6 text-dark">Capacitaciones Grabadas y En Vivo</h4>
                            <p class="small text-muted mb-0">Aprende a tu ritmo con clases grabadas o consulta disponibilidad para sesiones en vivo con nuestros especialistas.</p>
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
                            <h4 class="fw-bold font-montserrat fs-6 text-dark">Diploma</h4>
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
                        <p class="text-muted small mb-0">Programas con apertura de inscripciones y diploma</p>
                    </div>
                    <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill font-montserrat fw-semibold">
                        <i class="fa-solid fa-layer-group text-dark me-1"></i> <?= (int)$coursesCount ?> Cursos Disponibles
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
                                    <h4 class="course-card-title">GESTIÓN DE PROYECTOS & PMO</h4>
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

                <!-- Banner In-House -->
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
                                Desarrollamos programas cerrados in-house alineados a los requerimientos técnicos y proyectos en ejecución de tu organización.
                            </p>
                        </div>
                        <div class="col-lg-4 text-lg-end text-center">
                            <a href="https://wa.me/51993463118?text=Hola,%20deseo%20cotizar%20un%20programa%20de%20capacitaci%C3%B3n%20in-house%20para%20mi%20empresa" target="_blank" rel="noopener noreferrer" class="btn btn-warning btn-md px-4 py-2 fw-bold rounded-pill shadow text-dark animate__animated animate__pulse animate__infinite btn-qcs-primary">
                                <i class="fab fa-whatsapp me-1"></i> Cotizar In-House
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
