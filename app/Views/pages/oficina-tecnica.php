<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de P?gina: Gesti?n de Oficina T?cnica
 * Archivo: app/Views/pages/oficina-tecnica.php
 */

declare(strict_types=1);
?>
<style>
        body {
            background-color: #F4F5F7;
            color: #1e293b;
        }

        /* Hero Engineering Field & Tech Style */
        .site-hero-banner {
            position: relative;
            padding: 190px 1.5rem 85px 1.5rem;
            background: linear-gradient(135deg, #0F1113 0%, #1A1D20 50%, #24292E 100%);
            color: #ffffff;
            overflow: hidden;
            border-bottom: 3px solid var(--accent-gold);
        }

        .site-hero-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 80% 20%, rgba(229, 168, 19, 0.2) 0%, transparent 60%),
                        radial-gradient(circle at 15% 85%, rgba(37, 99, 235, 0.18) 0%, transparent 60%);
            pointer-events: none;
        }

        .site-hero-card {
            background: rgba(15, 17, 19, 0.2);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(229, 168, 19, 0.35);
            border-radius: 14px;
            padding: 1.35rem 1.15rem;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
            text-align: center;
        }

        .site-hero-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-gold);
            box-shadow: 0 16px 36px rgba(229, 168, 19, 0.25);
            background: rgba(23, 61, 109, 0.85);
        }

        .site-hero-icon {
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

        .site-hero-card-title {
            font-family: var(--font-heading);
            font-size: 1rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 0.35rem;
        }

        .site-hero-card-desc {
            font-size: 0.84rem;
            color: #cbd5e1;
            margin: 0;
            line-height: 1.45;
        }

        /* Card Docente con Marco Técnico */
        .site-docente-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-top: 4px solid var(--primary-blue);
            border-radius: 16px;
            padding: 2.25rem;
            height: 100%;
            box-shadow: var(--shadow-sm);
            transition: all var(--transition-normal);
        }

        .site-docente-card:hover {
            border-top-color: var(--accent-gold);
            box-shadow: var(--shadow-md);
        }

        .docente-avatar-site {
            width: 76px;
            height: 76px;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--primary-blue), #1A1D20);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #fef08a;
            border: 2px solid var(--accent-gold);
            box-shadow: 0 4px 16px rgba(15, 17, 19, 0.2);
            flex-shrink: 0;
        }

        /* Badge Flow del Enfoque del Programa */
        .process-flow-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-top: 1.5rem;
            padding: 1rem;
            background: #F4F5F7;
            border-radius: 12px;
            border: 1px solid var(--border-color);
        }

        .process-flow-step {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-family: var(--font-heading);
            font-size: 0.88rem;
            font-weight: 800;
            color: var(--primary-blue);
            background: #ffffff;
            padding: 0.45rem 0.9rem;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 5px rgba(0,0,0,0.04);
        }

        .process-flow-arrow {
            color: var(--accent-gold);
            font-size: 1rem;
            font-weight: 900;
        }

        /* Grid de 6 Áreas de la Oficina Técnica */
        .site-areas-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        @media (max-width: 992px) {
            .site-areas-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .site-areas-grid {
                grid-template-columns: 1fr;
            }
        }

        .site-area-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 1.6rem 1.35rem;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .site-area-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-gold);
            box-shadow: var(--shadow-lg);
        }

        .site-area-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.1rem;
        }

        .site-num-badge {
            background: linear-gradient(135deg, var(--primary-blue), #1A1D20);
            color: #ffffff;
            font-family: var(--font-heading);
            font-size: 0.78rem;
            font-weight: 800;
            padding: 0.3rem 0.7rem;
            border-radius: 6px;
            border: 1px solid var(--accent-gold);
        }

        .site-area-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: rgba(15, 17, 19, 0.2);
            color: var(--primary-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            transition: all var(--transition-fast);
        }

        .site-area-card:hover .site-area-icon {
            background: var(--accent-gold);
            color: #ffffff;
            transform: scale(1.1);
        }

        .site-area-title {
            font-family: var(--font-heading);
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--primary-blue);
            margin-bottom: 0.45rem;
        }

        .site-area-desc {
            font-size: 0.88rem;
            color: #475569;
            line-height: 1.55;
            margin: 0;
            flex-grow: 1;
        }

        /* Sección Metodología & Beneficios */
        .methodology-step-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1.25rem 1rem;
            text-align: center;
            box-shadow: var(--shadow-sm);
            height: 100%;
        }

        .benefit-badge-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 1.6rem 1.25rem;
            text-align: center;
            box-shadow: var(--shadow-sm);
            transition: all var(--transition-fast);
            height: 100%;
        }

        .benefit-badge-card:hover {
            border-color: var(--accent-gold);
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        .benefit-badge-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(229, 168, 19, 0.15);
            color: var(--primary-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin: 0 auto 0.85rem auto;
            border: 1px solid var(--accent-gold);
        }

        /* Showcase & Enrollment Container */
        .site-enrollment-card {
            background: #ffffff;
            border: 2px solid rgba(229, 168, 19, 0.35);
            border-radius: 20px;
            padding: 3rem 2.25rem;
            box-shadow: var(--shadow-lg);
            text-align: center;
        }

        .btn-site-action {
            border-radius: 10px;
            font-family: var(--font-heading);
            font-weight: 700;
            padding: 0.9rem 1.25rem;
            transition: all var(--transition-normal);
        }

        .btn-site-action:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        </style>

<main class="page-content">

        <!-- ==========================================================================
             1. ENCABEZADO HERO ESTILIZADO (Engineering Field & Tech Style)
             ========================================================================== -->
        <section class="site-hero-banner">
            <div class="container text-center position-relative" style="z-index: 2;">
                
                <!-- Badge Neón Superior Requerido -->
                <div class="mb-3">
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-2 shadow-sm">
                        <i class="fas fa-hard-hat me-2"></i> GESTIÓN DE PROYECTOS &amp; OFICINA TÉCNICA
                    </span>
                </div>

                <h1 class="display-5 fw-extrabold text-white text-uppercase tracking-wide mb-3 animate__animated animate__fadeInDown" style="font-family: var(--font-heading); font-weight: 800;">
                    OFICINA TÉCNICA OBRAS PRIVADAS Y PÚBLICAS
                </h1>

                <p class="lead text-light opacity-90 mx-auto mb-4" style="max-width: 860px; font-size: 1.15rem; color: #e2e8f0;">
                    Comprende la gestión integral de una Oficina Técnica mediante conceptos, criterios prácticos y herramientas aplicables a proyectos civiles, edificaciones, obras privadas y obras públicas.
                </p>

                <!-- Grid de 3 Tarjetas de Valor Ejecutivo dentro del Hero -->
                <div class="row g-3 justify-content-center mt-2">
                    
                    <!-- Tarjeta 1: Enfoque Práctico -->
                    <div class="col-12 col-md-4">
                        <div class="site-hero-card">
                            <div class="site-hero-icon"><i class="fas fa-tools"></i></div>
                            <div class="site-hero-card-title">Enfoque Práctico</div>
                            <p class="site-hero-card-desc">Conceptos y ejemplos aplicados a situaciones reales de proyectos de construcción.</p>
                        </div>
                    </div>

                    <!-- Tarjeta 2: Aplicación en Proyectos -->
                    <div class="col-12 col-md-4">
                        <div class="site-hero-card">
                            <div class="site-hero-icon"><i class="fas fa-project-diagram"></i></div>
                            <div class="site-hero-card-title">Aplicación en Proyectos</div>
                            <p class="site-hero-card-desc">Trabajo con casos reales, información brindada por los participantes y desarrollo de un proyecto de aplicación.</p>
                        </div>
                    </div>

                    <!-- Tarjeta 3: Desarrollo Profesional -->
                    <div class="col-12 col-md-4">
                        <div class="site-hero-card">
                            <div class="site-hero-icon"><i class="fas fa-award"></i></div>
                            <div class="site-hero-card-title">Desarrollo Profesional</div>
                            <p class="site-hero-card-desc">Incluye Diploma + Ingreso a Bolsa de Trabajo + Descuentos de Ex-alumno.</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             2. PERFIL DEL DOCENTE Y OBJETIVO GENERAL (Layout 2 Columnas Responsive)
             ========================================================================== -->
        <section class="py-5" id="perfil-objetivo">
            <div class="container py-3">
                
                <div class="row g-4 align-items-stretch">
                    
                    <!-- Columna Izquierda: Card del Docente Destacado -->
                    <div class="col-12 col-lg-5">
                        <div class="site-docente-card d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="docente-avatar-site">
                                        <i class="fa-solid fa-helmet-safety"></i>
                                    </div>
                                    <div>
                                        <span class="badge bg-warning-subtle text-dark fw-bold text-uppercase px-2 py-1 rounded">
                                            <i class="fa-solid fa-user-tie me-1"></i> Docente Principal
                                        </span>
                                        <h3 class="fw-bold mb-0 text-dark mt-1 animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); color: var(--primary-blue); font-size: 1.3rem;">
                                            ING. MARTÍN ORTIZ
                                        </h3>
                                    </div>
                                </div>

                                <!-- Credenciales / Badges Requeridos -->
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge bg-dark text-warning border border-warning-subtle"><i class="fa-solid fa-graduation-cap me-1"></i> Ingeniero Civil (UNI)</span>
                                    <span class="badge bg-dark"><i class="fa-solid fa-award text-warning me-1"></i> PMP®</span>
                                    <span class="badge bg-secondary"><i class="fa-solid fa-sliders me-1"></i> Diplomado en Planificación y Control</span>
                                </div>

                                <!-- Bio / Experiencia Requerida -->
                                <ul class="list-unstyled mb-0 text-secondary" style="font-size: 0.92rem; line-height: 1.6;">
                                    <li class="mb-2"><i class="fa-solid fa-check text-dark me-2"></i> Egresado de la Universidad Nacional de Ingeniería (UNI), Ingeniero Civil colegiado y Diplomado Especializado en Planificación y Control de Proyectos de Construcción.</li>
                                    <li class="mb-2"><i class="fa-solid fa-check text-dark me-2"></i> Amplia experiencia en Oficina Técnica de Obras, gestión de contratos públicos y privados e implementación de herramientas de seguimiento y control.</li>
                                    <li class="mb-2"><i class="fa-solid fa-check text-dark me-2"></i> Gerenciamiento de la Planificación y Control de proyectos hospitalarios, edificaciones, obras viales y mantenimientos ejecutados en diversas regiones del Perú.</li>
                                    <li><i class="fa-solid fa-check text-dark me-2"></i> Dominio en proyectos públicos y privados con conocimiento del Sistema Integrado de Gestión.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Columna Derecha: Objetivo General + Esquema de Gestión -->
                    <div class="col-12 col-lg-7">
                        <div class="site-docente-card d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <span class="badge bg-warning-subtle text-warning-emphasis fw-bold text-uppercase px-2 py-1 rounded">
                                        <i class="fa-solid fa-bullseye me-1"></i> Propósito &amp; Visión Operativa
                                    </span>
                                </div>

                                <h3 class="fw-bold mb-3 animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); color: var(--primary-blue);">
                                    OBJETIVO DEL CURSO
                                </h3>

                                <p class="text-secondary mb-3" style="font-size: 0.95rem; line-height: 1.65;">
                                    Brindar los conceptos, criterios prácticos y herramientas necesarias para la gestión integral de una Oficina Técnica en proyectos civiles y edificaciones, adaptables eficazmente tanto a proyectos privados como a obras públicas bajo los marcos normativos y contractuales actuales.
                                </p>
                            </div>

                            <!-- Visualizador del Enfoque del Programa -->
                            <div>
                                <h6 class="fw-bold text-uppercase small text-secondary mb-2">
                                    <i class="fa-solid fa-network-wired text-dark me-1"></i> Enfoque Secuencial del Programa
                                </h6>
                                <div class="process-flow-row">
                                    <div class="process-flow-step"><i class="fa-solid fa-calendar-check text-dark"></i> PLANIFICAR</div>
                                    <span class="process-flow-arrow">➔</span>
                                    <div class="process-flow-step"><i class="fa-solid fa-chart-line text-success"></i> CONTROLAR</div>
                                    <span class="process-flow-arrow">➔</span>
                                    <div class="process-flow-step"><i class="fa-solid fa-comments text-warning"></i> COORDINAR</div>
                                    <span class="process-flow-arrow">➔</span>
                                    <div class="process-flow-step"><i class="fa-solid fa-briefcase text-warning"></i> GESTIONAR</div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             3. CONTENIDOS DEL CURSO - GRID MODULAR (6 Áreas de la Oficina Técnica)
             ========================================================================== -->
        <section class="py-5 bg-white border-top border-bottom" id="temario">
            <div class="container py-3">
                
                <div class="text-center mb-5">
                    <span class="badge bg-warning-subtle text-dark px-3 py-2 rounded-pill fw-bold text-uppercase mb-2 shadow-sm">
                        <i class="fa-solid fa-sitemap me-1"></i> Malla Modular
                    </span>
                    <h2 class="fw-extrabold text-uppercase text-dark animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); color: var(--primary-blue);">
                        GESTIÓN INTEGRAL DE LA OFICINA TÉCNICA
                    </h2>
                    <div class="title-underline mx-auto"></div>
                    <p class="text-secondary mx-auto mt-3" style="max-width: 780px;">
                        Conoce las principales áreas que intervienen en la planificación, coordinación y control técnico de un proyecto. Para más detalle de las secciones solicita el brochure.
                    </p>
                </div>

                <!-- Grid de 6 Áreas Modulares -->
                <div class="site-areas-grid">
                    
                    <!-- 01. Integración -->
                    <div class="site-area-card">
                        <div class="site-area-header">
                            <span class="site-num-badge">01</span>
                            <div class="site-area-icon"><i class="fas fa-project-diagram"></i></div>
                        </div>
                        <h3 class="site-area-title animate__animated animate__fadeInUp animate__delay-1s">01. Gestión de la Integración</h3>
                        <p class="site-area-desc">Integración de los componentes y áreas de gestión que forman parte de la Oficina Técnica para una visión unificada del proyecto.</p>
                    </div>

                    <!-- 02. Alcance -->
                    <div class="site-area-card">
                        <div class="site-area-header">
                            <span class="site-num-badge">02</span>
                            <div class="site-area-icon"><i class="fas fa-bullseye"></i></div>
                        </div>
                        <h3 class="site-area-title animate__animated animate__fadeInUp animate__delay-1s">02. Alcance</h3>
                        <p class="site-area-desc">Gestión y seguimiento del alcance requerido para una correcta ejecución del proyecto sin desviaciones técnicas ni contractuales.</p>
                    </div>

                    <!-- 03. Plazo -->
                    <div class="site-area-card">
                        <div class="site-area-header">
                            <span class="site-num-badge">03</span>
                            <div class="site-area-icon"><i class="fas fa-calendar-alt"></i></div>
                        </div>
                        <h3 class="site-area-title animate__animated animate__fadeInUp animate__delay-1s">03. Plazo</h3>
                        <p class="site-area-desc">Planificación, seguimiento y control temporal de las actividades del proyecto, ruta crítica y cronogramas de obra.</p>
                    </div>

                    <!-- 04. Costo -->
                    <div class="site-area-card">
                        <div class="site-area-header">
                            <span class="site-num-badge">04</span>
                            <div class="site-area-icon"><i class="fas fa-coins"></i></div>
                        </div>
                        <h3 class="site-area-title animate__animated animate__fadeInUp animate__delay-1s">04. Costo</h3>
                        <p class="site-area-desc">Gestión y control de los aspectos económicos asociados a la ejecución de la obra, valorizaciones y presupuestos meta.</p>
                    </div>

                    <!-- 05. Comunicaciones -->
                    <div class="site-area-card">
                        <div class="site-area-header">
                            <span class="site-num-badge">05</span>
                            <div class="site-area-icon"><i class="fas fa-comments"></i></div>
                        </div>
                        <h3 class="site-area-title animate__animated animate__fadeInUp animate__delay-1s">05. Comunicaciones</h3>
                        <p class="site-area-desc">Coordinación y manejo adecuado de la información entre los participantes del proyecto (cliente, supervisión, contratistas y subcontratistas).</p>
                    </div>

                    <!-- 06. Procura -->
                    <div class="site-area-card">
                        <div class="site-area-header">
                            <span class="site-num-badge">06</span>
                            <div class="site-area-icon"><i class="fas fa-truck-loading"></i></div>
                        </div>
                        <h3 class="site-area-title animate__animated animate__fadeInUp animate__delay-1s">06. Procura</h3>
                        <p class="site-area-desc">Coordinación de adquisiciones, suministros y recursos requeridos para el desarrollo de actividades críticas en obra.</p>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             4. CARACTERÍSTICAS Y BENEFICIOS DEL CURSO
             ========================================================================== -->
        <section class="py-5" id="metodologia-beneficios">
            <div class="container py-3">
                
                <!-- Metodología en 4 Pasos -->
                <div class="text-center mb-4">
                    <span class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill fw-bold text-uppercase mb-2">
                        <i class="fa-solid fa-graduation-cap me-1"></i> Aprendizaje Práctico
                    </span>
                    <h3 class="fw-bold text-uppercase text-dark animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); color: var(--primary-blue);">
                        METODOLOGÍA DEL PROGRAMA
                    </h3>
                </div>

                <div class="row g-3 mb-5 justify-content-center">
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="methodology-step-card">
                            <div class="fw-bold text-dark mb-1">Paso 01</div>
                            <h6 class="fw-bold mb-1">Conceptos y Ejemplos</h6>
                            <p class="small text-secondary mb-0">Fundamentos técnicos ilustrados con casos reales de obra.</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="methodology-step-card">
                            <div class="fw-bold text-dark mb-1">Paso 02</div>
                            <h6 class="fw-bold mb-1">Casos Reales</h6>
                            <p class="small text-secondary mb-0">Análisis de situaciones complejas en proyectos civiles y edificaciones.</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="methodology-step-card">
                            <div class="fw-bold text-dark mb-1">Paso 03</div>
                            <h6 class="fw-bold mb-1">Datos de Alumnos</h6>
                            <p class="small text-secondary mb-0">Revisión de problemáticas e información aportada en clase.</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="methodology-step-card">
                            <div class="fw-bold text-dark mb-1">Paso 04</div>
                            <h6 class="fw-bold mb-1">Proyecto de Aplicación</h6>
                            <p class="small text-secondary mb-0">Desarrollo guiado de un modelo de oficina técnica de obra.</p>
                        </div>
                    </div>
                </div>

                <!-- 3 Tarjetas de Beneficios -->
                <div class="row g-4 justify-content-center">
                    <div class="col-12 col-md-4">
                        <div class="benefit-badge-card">
                            <div class="benefit-badge-icon"><i class="fas fa-certificate"></i></div>
                            <h5 class="fw-bold mb-2">Diploma</h5>
                            <p class="text-secondary small mb-0">Incluye Diploma al completar el programa de acuerdo con las condiciones académicas.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="benefit-badge-card">
                            <div class="benefit-badge-icon"><i class="fas fa-briefcase"></i></div>
                            <h5 class="fw-bold mb-2">Bolsa de Trabajo</h5>
                            <p class="text-secondary small mb-0">Ingreso directo a la Bolsa de Trabajo de Quality Consulting Solutions.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="benefit-badge-card">
                            <div class="benefit-badge-icon"><i class="fas fa-user-graduate"></i></div>
                            <h5 class="fw-bold mb-2">Descuento Ex-alumno</h5>
                            <p class="text-secondary small mb-0">Acceso a beneficios y tarifas especiales para ex-alumnos en futuras capacitaciones.</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ==========================================================================
             5. SHOWCASE MULTIMEDIA - VIDEO DE YOUTUBE ORIGINAL
             ========================================================================== -->
        <section class="py-5 bg-white border-top" id="video-oficina-tecnica">
            <div class="container py-3">
                
                <div class="text-center mb-5">
                    <span class="badge bg-danger text-white px-3 py-2 rounded-pill fw-bold text-uppercase mb-2 shadow-sm">
                        <i class="fa-brands fa-youtube me-1"></i> Sesión Informativa
                    </span>
                    <h2 class="fw-extrabold text-uppercase text-dark animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); color: var(--primary-blue);">
                        CONOCE MÁS SOBRE OFICINA TÉCNICA
                    </h2>
                    <div class="title-underline mx-auto"></div>
                    <p class="text-secondary mx-auto mt-3" style="max-width: 760px;">
                        Visualiza la presentación del programa y el impacto de la gestión de oficina técnica en la rentabilidad de las obras.
                    </p>
                </div>

                <div class="row justify-content-center">
                    <div class="col-12 col-lg-9">
                        <div class="ratio ratio-16x9 shadow-lg rounded-4 overflow-hidden mb-4 border border-2 border-dark-subtle">
                            <iframe src="https://www.youtube.com/embed/oxUAvNOSJhU" title="Oficina Técnica Obras Privadas y Públicas - Quality Consulting Solutions" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ==========================================================================
             6. SECCIÓN DE INSCRIPCIÓN Y PASARELAS DE PAGO (CTA Destacado)
             ========================================================================== -->
        <section class="py-5 bg-light border-top" id="matricula">
            <div class="container py-3">
                
                <div class="site-enrollment-card">
                    
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold text-uppercase mb-3 shadow-sm">
                        <i class="fa-solid fa-bolt me-1"></i> CAPACITACIÓN ESPECIALIZADA • MODALIDAD ONLINE
                    </span>

                    <h2 class="display-6 fw-extrabold text-uppercase mb-2 animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); color: var(--primary-blue);">
                        MATRICÚLATE EN EL CURSO DE OFICINA TÉCNICA
                    </h2>
                    <p class="text-secondary mx-auto mb-4" style="max-width: 740px;">
                        Elige tu canal preferido para solicitar asesoría técnica personalizada, descargar el brochure con la malla completa o formalizar tu inscripción online de forma segura.
                    </p>

                    <!-- Beneficios Rápidos de Matrícula -->
                    <div class="row g-3 mb-4 text-start justify-content-center">
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="p-3 rounded-3 border bg-white">
                                <i class="fa-solid fa-circle-play text-dark me-2"></i> <span class="small text-dark fw-bold">Modalidad grabada 100% online.</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="p-3 rounded-3 border bg-white">
                                <i class="fa-solid fa-cloud-arrow-down text-dark me-2"></i> <span class="small text-dark fw-bold">Acceso inmediato a las clases y disponible 24/7.</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="p-3 rounded-3 border bg-white">
                                <i class="fa-solid fa-certificate text-dark me-2"></i> <span class="small text-dark fw-bold">Incluye Diploma.</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="p-3 rounded-3 border bg-white">
                                <i class="fa-solid fa-briefcase text-dark me-2"></i> <span class="small text-dark fw-bold">Ingreso a bolsa de trabajo.</span>
                            </div>
                        </div>
                    </div>

                    <!-- 4 Botones Oficiales de Matrícula y Pasarelas -->
                    <div class="row g-3 justify-content-center">
                        
                        <!-- 1. WhatsApp -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <a href="https://api.whatsapp.com/send?phone=51993463118&amp;text=Buen%20d%C3%ADa,%20%C2%BFpodr%C3%ADan%20enviarme%20informaci%C3%B3n%20sobre%20el%20curso%20de%20Oficina%20T%C3%A9cnica%20para%20Obras%20Privadas%20y%20P%C3%BAblicas?" target="_blank" rel="noopener noreferrer" class="btn btn-success btn-lg w-100 my-1 btn-site-action btn-qcs-primary" aria-label="Consultar información del curso por WhatsApp">
                                <i class="fab fa-whatsapp me-2"></i> Consultar por WhatsApp
                            </a>
                        </div>

                        <!-- 2. Brochure / Ficha Técnica -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <a href="https://docs.google.com/forms/d/e/1FAIpQLSfH3j5S--4idfRRxsog1tDlq_WfpZIwLUY50XolYCl53S-JvA/viewform" target="_blank" rel="noopener noreferrer" class="btn btn-qcs-dark btn-lg w-100 my-1 btn-site-action btn-qcs-primary" aria-label="Descargar información y brochure del curso">
                                <i class="fas fa-file-pdf me-2"></i> Info &amp; Brochure
                            </a>
                        </div>

                        <!-- 3. Niubiz / VisaNet -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <a href="https://www.visanetlink.pe/pagoseguro/QUALITYCONSULTINGSOLUTIONS/58214" target="_blank" rel="noopener noreferrer" class="btn btn-lg w-100 my-1 btn-site-action btn-qcs-primary" aria-label="Pago Seguro con Niubiz y Visa">
                                <i class="fas fa-credit-card me-2"></i> Pago Seguro Niubiz / Visa
                            </a>
                        </div>

                        <!-- 4. PayPal Internacional -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <a href="https://www.paypal.com/paypalme/qualityconsulting/240" target="_blank" rel="noopener noreferrer" class="btn btn-dark btn-lg w-100 my-1 btn-site-action btn-qcs-primary" aria-label="Pagar mediante PayPal">
                                <i class="fab fa-paypal me-2"></i> Pagar con PayPal
                            </a>
                        </div>

                    </div>

                    <!-- Barra de Seguridad y Confianza -->
                    <div class="payment-trust-bar mt-4 pt-3 border-top">
                        <div class="payment-trust-item">
                            <i class="fa-solid fa-lock text-dark"></i>
                            <span>Plataforma con Encriptación SSL 256-bit</span>
                        </div>
                        <div class="payment-trust-item">
                            <i class="fa-solid fa-shield-halved text-dark"></i>
                            <span>Transacción 100% Segura y Verificada</span>
                        </div>
                        <div class="payment-trust-item">
                            <i class="fa-solid fa-headset text-dark"></i>
                            <span>Soporte Académico y Técnico Permanente</span>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             7. LLAMADO A LA ACCIÓN FINAL (Contacto Corporativo)
             ========================================================================== -->
        <section class="cta-banner-section" id="contacto-final">
            <div class="cta-container">
                <div class="cta-box">
                    <div class="cta-content">
                        <span class="cta-tag"><i class="fa-solid fa-hard-hat"></i> Control y Dirección de Obras</span>
                        <h3 class="animate__animated animate__fadeInUp animate__delay-1s">Fortalece la gestión técnica y el control de tus proyectos</h3>
                        <p>
                            Conoce cómo una Oficina Técnica correctamente gestionada puede integrar alcance, plazo, costo, comunicaciones y procura dentro de proyectos públicos y privados.
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
                            <i class="fa-solid fa-envelope"></i> Contacto Directo
                        </a>
                        <a href="/#capacitacion" class="btn btn-outline-light btn-large btn-qcs-primary" style="border: 2px solid #ffffff; color: #ffffff;">
                            <i class="fa-solid fa-graduation-cap"></i> Ver más capacitaciones
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>
