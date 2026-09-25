<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Asesoría Especializada y Gestión de Proyectos
 * Archivo: app/Views/pages/consultoria.php
 */

declare(strict_types=1);
?>
<style>
        body {
            background-color: var(--qcs-bg-light);
            color: #1e293b;
        }

        /* ----------------------------------------------------
           1. HERO CONSULTORÍA
           ---------------------------------------------------- */
        .consulting-hero-banner {
            position: relative;
            padding: 190px 1.5rem 85px 1.5rem;
            background: linear-gradient(145deg, #0F1113 0%, #1A1D20 50%, #24292E 100%);
            color: #ffffff;
            overflow: hidden;
            border-bottom: 4px solid var(--accent-gold);
        }

        .consulting-hero-banner::before {
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

        .consulting-hero-pattern {
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

        .consulting-hero-title {
            font-family: var(--font-heading);
            font-weight: 900;
            font-size: clamp(2rem, 4.2vw, 3.3rem);
            letter-spacing: -0.5px;
            color: #ffffff;
            margin-bottom: 1.25rem;
            text-shadow: 0 4px 16px rgba(0, 0, 0, 0.35);
        }

        .consulting-hero-subtitle {
            font-family: var(--font-body);
            font-size: clamp(1.05rem, 1.8vw, 1.25rem);
            color: #e2e8f0;
            max-width: 860px;
            margin: 0 auto;
            line-height: 1.8;
        }

        /* ----------------------------------------------------
           2. GRID DE 4 EJES DE CONSULTORÍA
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
            margin-bottom: 1.5rem;
        }

        /* ----------------------------------------------------
           3. BANNER Y MAPA DE UBICACIÓN
           ---------------------------------------------------- */
        .consulting-cta-banner {
            background: linear-gradient(145deg, #0F1113 0%, #1A1D20 50%, #24292E 100%);
            border-radius: 24px;
            padding: 3.5rem 2.5rem;
            color: #ffffff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 45px rgba(15, 17, 19, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .consulting-cta-banner::before {
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
             1. HERO Y PRESENTACIÓN (Consultoría)
             ========================================================================== -->
        <section class="consulting-hero-banner text-center">
            <div class="consulting-hero-pattern"></div>
            <div class="container position-relative">
                
                <!-- Badge Superior -->
                <div class="d-inline-block mb-3">
                    <span class="badge bg-light text-dark px-3 py-2 rounded-pill fw-bold mb-2 shadow-sm">
                        <i class="fas fa-briefcase me-2"></i> ASESORÍA ESPECIALIZADA
                    </span>
                </div>

                <!-- Título Principal -->
                <h1 class="consulting-hero-title animate__animated animate__fadeInDown">
                    ASESORÍA TÉCNICA Y FORMATIVA EN GESTIÓN DE PROYECTOS Y CALIDAD
                </h1>

                <!-- Subtítulo / Párrafo Introductorio -->
                <p class="consulting-hero-subtitle">
                    Acompañamos y orientamos a profesionales y organizaciones del sector construcción, infraestructura y minería mediante asesoría especializada, transferencia de metodologías y programas de capacitación aplicada.
                </p>

                <!-- Micro-badges -->
                <div class="d-flex justify-content-center flex-wrap gap-3 mt-4">
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold">
                        <i class="fa-solid fa-check-circle me-1"></i> Asesoría Personalizada
                    </span>
                    <span class="badge bg-light bg-opacity-25 text-white px-3 py-2 rounded-pill fw-semibold">
                        <i class="fa-solid fa-building-columns me-1"></i> Metodología PMBOK® &amp; ISO
                    </span>
                    <span class="badge bg-light bg-opacity-25 text-white px-3 py-2 rounded-pill fw-semibold">
                        <i class="fa-solid fa-clock-rotate-left me-1"></i> Curva de Liberación ®
                    </span>
                </div>

            </div>
        </section>

        <!-- ==========================================================================
             2. GRID DE 4 EJES DE CONSULTORÍA
             ========================================================================== -->
        <section class="py-5">
            <div class="container">
                
                <div class="text-center mb-5">
                    <span class="badge bg-warning-subtle text-dark fw-bold px-3 py-2 rounded-pill text-uppercase mb-2">
                        <i class="fa-solid fa-network-wired me-1"></i> Ejes Estratégicos
                    </span>
                    <h2 class="fw-extrabold font-montserrat text-dark display-6 mb-2 animate__animated animate__fadeInUp animate__delay-1s" style="font-weight: 800;">
                        ÁREAS CLAVE DE INTERVENCIÓN
                    </h2>
                    <p class="text-muted mx-auto" style="max-width: 700px;">
                        Diagnósticos metodológicos, transferencia de estándares y acompañamiento técnico para orientar y elevar el desempeño de tus proyectos.
                    </p>
                </div>

                <div class="row g-4 justify-content-center">
                    
                    <!-- Eje 1: Gestión de la Calidad e ISO 9001 -->
                    <div class="col-lg-6 col-md-6">
                        <div class="consulting-card rounded-4 border-start border-4 border-warning" data-aos="fade-right">
                            <div class="consulting-card-img-wrap">
                                <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?q=80&amp;w=800&amp;auto=format&amp;fit=crop" alt="Gestión de la Calidad e ISO 9001 en Construcción" class="consulting-card-img" loading="lazy">
                                <div class="consulting-card-icon-badge">
                                    <i class="fas fa-certificate text-dark fs-2"></i>
                                </div>
                            </div>
                            <div class="consulting-card-body">
                                <div>
                                    <h3 class="consulting-card-title animate__animated animate__fadeInUp animate__delay-1s">Gestión de la Calidad e ISO 9001</h3>
                                    <p class="consulting-card-desc">
                                        Formación especializada en gestión de la calidad, ISO 9001, planes de calidad y control de no conformidades, orientada a profesionales del sector construcción.
                                    </p>
                                </div>
                                <div>
                                    <a href="/gestion-de-la-calidad" class="btn btn-qcs-dark w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="border-color: var(--qcs-yellow); color: var(--qcs-dark-slate);">
                                        Conocer más de Calidad <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Eje 2: Gestión de Proyectos & PMO -->
                    <div class="col-lg-6 col-md-6">
                        <div class="consulting-card rounded-4 border-start border-4 border-warning" data-aos="fade-up">
                            <div class="consulting-card-img-wrap">
                                <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&amp;w=800&amp;auto=format&amp;fit=crop" alt="Gestión de Proyectos y PMO" class="consulting-card-img" loading="lazy">
                                <div class="consulting-card-icon-badge">
                                    <i class="fas fa-sitemap text-success fs-2"></i>
                                </div>
                            </div>
                            <div class="consulting-card-body">
                                <div>
                                    <h3 class="consulting-card-title animate__animated animate__fadeInUp animate__delay-1s">GESTIÓN DE PROYECTOS &amp; PMO</h3>
                                    <p class="consulting-card-desc">
                                        Formación especializada en gestión de PMO, planificación y control de proyectos, gestión de portafolios y KPIs, con herramientas y metodologías aplicadas al sector construcción.
                                    </p>
                                </div>
                                <div>
                                    <a href="/gestion-de-pmo" class="btn btn-qcs-dark w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="border-color: var(--qcs-yellow); color: var(--qcs-dark-slate);">
                                        Conocer más de PMO <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Eje 3: Gestión de Riesgos & Cronogramas -->
                    <div class="col-lg-6 col-md-6">
                        <div class="consulting-card rounded-4 border-start border-4 border-warning" data-aos="fade-left">
                            <div class="consulting-card-img-wrap">
                                <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?q=80&amp;w=800&amp;auto=format&amp;fit=crop" alt="Gestión de Riesgos y Cronogramas Forenses" class="consulting-card-img" loading="lazy">
                                <div class="consulting-card-icon-badge">
                                    <i class="fas fa-shield-alt text-warning fs-2"></i>
                                </div>
                            </div>
                            <div class="consulting-card-body">
                                <div>
                                    <h3 class="consulting-card-title animate__animated animate__fadeInUp animate__delay-1s">Gestión de Riesgos &amp; Cronogramas</h3>
                                    <p class="consulting-card-desc">
                                        Entrenamiento y asesoría en análisis de riesgos contractuales, aplicación de la Curva de Liberación® y técnicas de análisis forense de cronogramas.
                                    </p>
                                </div>
                                <div>
                                    <a href="/gestion-de-riesgos" class="btn btn-qcs-dark w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="border-color: var(--qcs-yellow); color: var(--qcs-dark-slate);">
                                        Conocer más de Riesgos <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Eje 4: Homologación & Auditoría de Proveedores -->
                    <div class="col-lg-6 col-md-6">
                        <div class="consulting-card rounded-4 border-start border-4 border-warning" data-aos="fade-right">
                            <div class="consulting-card-img-wrap">
                                <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&amp;w=800&amp;auto=format&amp;fit=crop" alt="Homologación y Auditoría de Proveedores" class="consulting-card-img" loading="lazy">
                                <div class="consulting-card-icon-badge">
                                    <i class="fas fa-truck-loading text-warning fs-2"></i>
                                </div>
                            </div>
                            <div class="consulting-card-body">
                                <div>
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

            </div>
        </section>

        <!-- ==========================================================================
             3. CTA DIRECTO A COTIZACIÓN & MAPA CORPORATIVO
             ========================================================================== -->
        <section class="py-5">
            <div class="container">
                <div class="consulting-cta-banner">
                    <div class="row align-items-center">
                        
                        <div class="col-lg-8 mb-4 mb-lg-0">
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm">
                                <i class="fa-solid fa-headset me-1"></i> ATENCIÓN TÉCNICA
                            </span>
                            <h2 class="fw-bold font-montserrat text-white mb-3 animate__animated animate__fadeInUp animate__delay-1s" style="font-size: clamp(1.6rem, 2.5vw, 2.3rem);">
                                Solicita una propuesta de asesoría técnica para tu empresa
                            </h2>
                            <p class="text-light text-opacity-90 mb-3" style="font-size: 1.05rem; line-height: 1.8;">
                                Diseñamos programas de formación in-house y asesoría técnica especializada adaptados a los retos específicos de tus proyectos de infraestructura.
                            </p>
                            <div class="d-flex flex-wrap gap-4 text-light">
                                <div>
                                    <i class="fa-solid fa-phone text-warning me-2"></i>
                                    WhatsApp Corporativo: <a href="https://wa.me/51993463118" target="_blank" rel="noopener noreferrer" class="text-white fw-bold animate__animated animate__pulse animate__infinite">+51 993 463 118</a>
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
                                    <i class="fab fa-whatsapp me-2"></i> Cotizar por WhatsApp
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
