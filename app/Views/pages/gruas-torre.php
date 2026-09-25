<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de P?gina: Estrategia de Productividad y Planificaci?n con Gr?as Torre
 * Archivo: app/Views/pages/gruas-torre.php
 */

declare(strict_types=1);
?>
<style>
        body {
            background-color: #F4F5F7;
            color: #1e293b;
        }

        /* Hero Heavy Machinery & High-Rise Style */
        .crane-hero-banner {
            position: relative;
            padding: 190px 1.5rem 85px 1.5rem;
            background: linear-gradient(135deg, #0F1113 0%, #1A1D20 45%, #1A1D20 100%);
            color: #ffffff;
            overflow: hidden;
            border-bottom: 3px solid var(--accent-gold);
        }

        .crane-hero-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 80% 20%, rgba(229, 168, 19, 0.22) 0%, transparent 60%),
                        radial-gradient(circle at 15% 85%, rgba(245, 158, 11, 0.18) 0%, transparent 60%);
            pointer-events: none;
        }

        .crane-hero-card {
            background: rgba(23, 42, 69, 0.8);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(229, 168, 19, 0.35);
            border-radius: 14px;
            padding: 1.35rem 1.15rem;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
            text-align: center;
        }

        .crane-hero-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-gold);
            box-shadow: 0 16px 36px rgba(229, 168, 19, 0.25);
            background: rgba(36, 59, 85, 0.9);
        }

        .crane-hero-icon {
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

        .crane-hero-card-title {
            font-family: var(--font-heading);
            font-size: 1rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 0.35rem;
        }

        .crane-hero-card-desc {
            font-size: 0.84rem;
            color: #cbd5e1;
            margin: 0;
            line-height: 1.45;
        }

        /* Card Docente */
        .crane-docente-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-top: 4px solid var(--primary-blue);
            border-radius: 16px;
            padding: 2.25rem;
            height: 100%;
            box-shadow: var(--shadow-sm);
            transition: all var(--transition-normal);
        }

        .crane-docente-card:hover {
            border-top-color: var(--accent-gold);
            box-shadow: var(--shadow-md);
        }

        .docente-avatar-crane {
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

        /* Grid de 3 Módulos Temáticos */
        .crane-modules-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        @media (max-width: 992px) {
            .crane-modules-grid {
                grid-template-columns: 1fr;
            }
        }

        .crane-module-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-top: 4px solid var(--primary-blue);
            border-radius: 16px;
            padding: 2rem 1.6rem;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .crane-module-card:hover {
            transform: translateY(-6px);
            border-top-color: var(--accent-gold);
            border-color: var(--accent-gold);
            box-shadow: var(--shadow-lg);
        }

        .crane-module-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.25rem;
        }

        .crane-num-badge {
            background: linear-gradient(135deg, var(--primary-blue), #1A1D20);
            color: #ffffff;
            font-family: var(--font-heading);
            font-size: 0.85rem;
            font-weight: 800;
            padding: 0.35rem 0.8rem;
            border-radius: 6px;
            border: 1px solid var(--accent-gold);
        }

        .crane-module-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: rgba(15, 17, 19, 0.2);
            color: var(--primary-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            transition: all var(--transition-fast);
        }

        .crane-module-card:hover .crane-module-icon {
            background: var(--accent-gold);
            color: #ffffff;
            transform: scale(1.1);
        }

        .crane-module-title {
            font-family: var(--font-heading);
            font-size: 1.12rem;
            font-weight: 800;
            color: var(--primary-blue);
            margin-bottom: 0.65rem;
            line-height: 1.35;
        }

        .crane-module-desc {
            font-size: 0.9rem;
            color: #475569;
            line-height: 1.6;
            margin: 0;
            flex-grow: 1;
        }

        /* Sección Visual: Ciclo de Planificación */
        .crane-planning-wrapper {
            background: linear-gradient(135deg, #0F1113 0%, #1A1D20 100%);
            border: 1px solid rgba(229, 168, 19, 0.35);
            border-radius: 20px;
            padding: 3rem 2rem;
            color: #ffffff;
            box-shadow: var(--shadow-lg);
        }

        .crane-step-card {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(229, 168, 19, 0.3);
            border-radius: 14px;
            padding: 1.35rem 1rem;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
        }

        .crane-step-card:hover {
            background: rgba(229, 168, 19, 0.15);
            border-color: var(--accent-gold);
            transform: translateY(-4px);
        }

        .crane-step-num {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--accent-gold);
            color: #0F1113;
            font-family: var(--font-heading);
            font-weight: 800;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.65rem auto;
        }

        .crane-step-title {
            font-family: var(--font-heading);
            font-size: 0.88rem;
            font-weight: 700;
            color: #ffffff;
            margin: 0;
        }

        /* Modalidad y Beneficios */
        .crane-modalidad-card {
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

        /* Showcase & Enrollment Card */
        .crane-enrollment-card {
            background: #ffffff;
            border: 2px solid rgba(229, 168, 19, 0.4);
            border-radius: 20px;
            padding: 3rem 2.25rem;
            box-shadow: var(--shadow-lg);
            text-align: center;
        }

        .btn-crane-action {
            border-radius: 10px;
            font-family: var(--font-heading);
            font-weight: 700;
            padding: 0.9rem 1.25rem;
            transition: all var(--transition-normal);
        }

        .btn-crane-action:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        </style>

<main class="page-content">

        <!-- ==========================================================================
             1. ENCABEZADO HERO ESTILIZADO (Heavy Machinery & High-Rise Style)
             ========================================================================== -->
        <section class="crane-hero-banner">
            <div class="container text-center position-relative" style="z-index: 2;">
                
                <!-- Badge Neón Superior Requerido -->
                <div class="mb-3">
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-2 shadow-sm">
                        <i class="fas fa-truck-monster me-2"></i> PRODUCTIVIDAD &amp; EDIFICACIONES DE GRAN ALTURA
                    </span>
                </div>

                <h1 class="display-5 fw-extrabold text-white text-uppercase tracking-wide mb-3 animate__animated animate__fadeInDown" style="font-family: var(--font-heading); font-weight: 800;">
                    ESTRATEGIA DE PRODUCTIVIDAD Y PLANIFICACIÓN CON GRÚAS TORRE
                </h1>

                <p class="lead text-light opacity-90 mx-auto mb-4" style="max-width: 860px; font-size: 1.15rem; color: #e2e8f0;">
                    Aprende a elevar la productividad en el uso de grúas torre, criterios para montaje/desmontaje, planificación de tiempos y movimientos, y normativas técnicas.
                </p>

                <!-- Grid de 3 Tarjetas de Valor Ejecutivo dentro del Hero -->
                <div class="row g-3 justify-content-center mt-2">
                    
                    <!-- Tarjeta 1: Selección y Montaje -->
                    <div class="col-12 col-md-4">
                        <div class="crane-hero-card">
                            <div class="crane-hero-icon"><i class="fas fa-tools"></i></div>
                            <div class="crane-hero-card-title">Selección y Montaje</div>
                            <p class="crane-hero-card-desc">Criterios técnicos para la correcta selección, montaje, operación y desmontaje de grúas torre.</p>
                        </div>
                    </div>

                    <!-- Tarjeta 2: Gamificación y Tiempos -->
                    <div class="col-12 col-md-4">
                        <div class="crane-hero-card">
                            <div class="crane-hero-icon"><i class="fas fa-stopwatch"></i></div>
                            <div class="crane-hero-card-title">Gamificación y Tiempos</div>
                            <p class="crane-hero-card-desc">Aplica el método de estudio de tiempos/movimientos y gamificación para estructurar horarios eficientes.</p>
                        </div>
                    </div>

                    <!-- Tarjeta 3: Desarrollo Profesional -->
                    <div class="col-12 col-md-4">
                        <div class="crane-hero-card">
                            <div class="crane-hero-icon"><i class="fas fa-award"></i></div>
                            <div class="crane-hero-card-title">Desarrollo Profesional</div>
                            <p class="crane-hero-card-desc">Incluye Diploma + Ingreso a Bolsa de Trabajo + Descuentos como Ex-alumno.</p>
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
                        <div class="crane-docente-card d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="docente-avatar-crane">
                                        <i class="fa-solid fa-user-tie"></i>
                                    </div>
                                    <div>
                                        <span class="badge bg-warning-subtle text-dark fw-bold text-uppercase px-2 py-1 rounded">
                                            <i class="fa-solid fa-chalkboard-user me-1"></i> Docente Principal
                                        </span>
                                        <h3 class="fw-bold mb-0 text-dark mt-1 animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); color: var(--primary-blue); font-size: 1.3rem;">
                                            ING. RICARDO JARA
                                        </h3>
                                    </div>
                                </div>

                                <!-- Credenciales / Badges Requeridos -->
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge bg-dark text-warning border border-warning-subtle"><i class="fa-solid fa-hard-hat me-1"></i> Ingeniero Civil</span>
                                    <span class="badge bg-dark"><i class="fa-solid fa-graduation-cap me-1"></i> Máster</span>
                                    <span class="badge bg-warning text-dark text-dark"><i class="fa-solid fa-building me-1"></i> Especialista en Proyectos de Gran Altura</span>
                                </div>

                                <!-- Bio / Experiencia Requerida -->
                                <ul class="list-unstyled mb-0 text-secondary" style="font-size: 0.92rem; line-height: 1.6;">
                                    <li class="mb-2"><i class="fa-solid fa-check text-dark me-2"></i> Profesional con más de 20 años de experiencia en Dirección de la Construcción.</li>
                                    <li><i class="fa-solid fa-check text-dark me-2"></i> Gerenciamiento de proyectos de gran envergadura y edificaciones de Gran Altura bajo metodologías BIM, VDC y Lean Construction.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Columna Derecha: Objetivo General + Imagen Conceptual -->
                    <div class="col-12 col-lg-7">
                        <div class="crane-docente-card d-flex flex-column justify-content-between">
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
                                    Elevar la productividad en el uso de la grúa torre mediante criterios técnicos para su selección, montaje y desmontaje, normativas de seguridad vigentes, gestiones operativas y recomendaciones prácticas de utilización en obras de gran escala.
                                </p>
                            </div>

                            <!-- Visualizador de Imagen de Obras de Gran Altura Requerido -->
                            <div>
                                <!-- Imagen conceptual sobre uso de grúas torre e ingeniería de gran altura -->
                                <img src="https://images.unsplash.com/photo-1541888946425-d0fbb186a5b3?auto=format&amp;fit=crop&amp;w=800&amp;q=80" alt="Grúa torre en obra de edificación de gran altura" class="img-fluid rounded-4 shadow-lg mb-0 w-100" style="max-height: 220px; object-fit: cover;" loading="lazy">
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             3. CONTENIDOS DEL CURSO - GRID MODULAR (3 Módulos Temáticos)
             ========================================================================== -->
        <section class="py-5 bg-white border-top border-bottom" id="temario">
            <div class="container py-3">
                
                <div class="text-center mb-5">
                    <span class="badge bg-warning-subtle text-dark px-3 py-2 rounded-pill fw-bold text-uppercase mb-2 shadow-sm">
                        <i class="fa-solid fa-layer-group me-1"></i> Malla Curricular
                    </span>
                    <h2 class="fw-extrabold text-uppercase text-dark animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); color: var(--primary-blue);">
                        ESTRUCTURA Y CONTENIDOS DEL PROGRAMA
                    </h2>
                    <div class="title-underline mx-auto"></div>
                    <p class="text-secondary mx-auto mt-3" style="max-width: 780px;">
                        Módulos clave para maximizar el rendimiento, seguridad y planificación de grúas torre en proyectos de construcción.
                    </p>
                </div>

                <!-- Grid de 3 Módulos Temáticos -->
                <div class="crane-modules-grid">
                    
                    <!-- Módulo 01 -->
                    <div class="crane-module-card">
                        <div class="crane-module-header">
                            <span class="crane-num-badge">01</span>
                            <div class="crane-module-icon"><i class="fas fa-cogs"></i></div>
                        </div>
                        <h3 class="crane-module-title animate__animated animate__fadeInUp animate__delay-1s">01. Selección de la Mejor Torre Grúa para el Proyecto</h3>
                        <p class="crane-module-desc">
                            Conceptos básicos, clasificación de grúas torre, criterios para la toma de decisiones, plan de instalación de grúas torre y análisis de ejemplos en proyectos reales.
                        </p>
                    </div>

                    <!-- Módulo 02 -->
                    <div class="crane-module-card">
                        <div class="crane-module-header">
                            <span class="crane-num-badge">02</span>
                            <div class="crane-module-icon"><i class="fas fa-gamepad"></i></div>
                        </div>
                        <h3 class="crane-module-title animate__animated animate__fadeInUp animate__delay-1s">02. Operación y Productividad de Grúas Torre</h3>
                        <p class="crane-module-desc">
                            Instalación y operación segura de la grúa torre en obra, aplicada mediante el Método de Gamificación para optimizar la coordinación y maniobras en campo.
                        </p>
                    </div>

                    <!-- Módulo 03 -->
                    <div class="crane-module-card">
                        <div class="crane-module-header">
                            <span class="crane-num-badge">03</span>
                            <div class="crane-module-icon"><i class="fas fa-chart-pie"></i></div>
                        </div>
                        <h3 class="crane-module-title animate__animated animate__fadeInUp animate__delay-1s">03. Planificación de Grúas Torre</h3>
                        <p class="crane-module-desc">
                            Programación de grúas en proyectos de construcción, método del estudio de tiempos y movimientos, cómo estructurar un horario de grúa e impacto directo en tiempos y costos del proyecto.
                        </p>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             4. SECCIÓN VISUAL: DE LA SELECCIÓN AL CONTROL DE TIEMPOS Y COSTOS
             ========================================================================== -->
        <section class="py-5" style="background-color: var(--qcs-bg-light);" id="ciclo-planificacion">
            <div class="container py-3">
                
                <div class="crane-planning-wrapper">
                    <div class="text-center mb-4">
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold text-uppercase mb-2 shadow-sm">
                            <i class="fa-solid fa-route me-1"></i> Secuencia Logística &amp; Operativa
                        </span>
                        <h3 class="fw-extrabold text-white text-uppercase animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading);">
                            DE LA SELECCIÓN AL CONTROL DE TIEMPOS Y COSTOS
                        </h3>
                        <p class="text-light opacity-90 small mx-auto mb-0" style="max-width: 720px;">
                            Ciclo de gestión técnica para optimizar la logística vertical en edificaciones de gran altura.
                        </p>
                    </div>

                    <!-- 4 Pasos del Ciclo -->
                    <div class="row g-3 justify-content-center">
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="crane-step-card">
                                <div class="crane-step-num">1</div>
                                <h5 class="crane-step-title">Selección de Equipo</h5>
                                <p class="small text-light opacity-75 mb-0 mt-1">Cálculo de cargas, radios de giro y tipología óptima para el proyecto.</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="crane-step-card">
                                <div class="crane-step-num">2</div>
                                <h5 class="crane-step-title">Plan de Instalación</h5>
                                <p class="small text-light opacity-75 mb-0 mt-1">Logística de montaje, zapatas, arriostramientos y normativas de seguridad.</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="crane-step-card">
                                <div class="crane-step-num">3</div>
                                <h5 class="crane-step-title">Tiempos y Movimientos</h5>
                                <p class="small text-light opacity-75 mb-0 mt-1">Estructuración horaria con gamificación para eliminar tiempos muertos.</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="crane-step-card">
                                <div class="crane-step-num">4</div>
                                <h5 class="crane-step-title">Optimización de Costos</h5>
                                <p class="small text-light opacity-75 mb-0 mt-1">Control del rendimiento en obra y reducción del plazo total del ciclo.</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             5. MODALIDAD Y BENEFICIOS DEL CURSO
             ========================================================================== -->
        <section class="py-5 bg-white border-top border-bottom" id="modalidad-beneficios">
            <div class="container py-3">
                
                <!-- Modalidad en 4 Pasos -->
                <div class="text-center mb-4">
                    <span class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill fw-bold text-uppercase mb-2">
                        <i class="fa-solid fa-laptop-code me-1"></i> Entorno de Aprendizaje
                    </span>
                    <h3 class="fw-bold text-uppercase text-dark animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); color: var(--primary-blue);">
                        MODALIDAD DEL CURSO
                    </h3>
                </div>

                <div class="row g-3 mb-5 justify-content-center">
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="crane-modalidad-card">
                            <div class="fw-bold text-dark mb-1"><i class="fas fa-circle-play me-1"></i> Clases Grabadas Online</div>
                            <p class="small text-secondary mb-0">Acceso inmediato a las clases y disponible 24/7.</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="crane-modalidad-card">
                            <div class="fw-bold text-dark mb-1"><i class="fas fa-clock-rotate-left me-1"></i> Grabaciones 24/7</div>
                            <p class="small text-secondary mb-0">Acceso a las grabaciones sin límite de tiempo.</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="crane-modalidad-card">
                            <div class="fw-bold text-dark mb-1"><i class="fas fa-mobile-screen-button me-1"></i> Multiplataforma</div>
                            <p class="small text-secondary mb-0">Disponible en PC, Laptop, Tablet y Celular.</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="crane-modalidad-card">
                            <div class="fw-bold text-dark mb-1"><i class="fas fa-comments me-1"></i> Soporte y Casuística</div>
                            <p class="small text-secondary mb-0">Resolución de consultas y análisis de casuística en obra.</p>
                        </div>
                    </div>
                </div>

                <!-- 3 Tarjetas de Beneficios -->
                <div class="row g-4 justify-content-center">
                    <div class="col-12 col-md-4">
                        <div class="benefit-badge-card">
                            <div class="benefit-badge-icon"><i class="fas fa-certificate"></i></div>
                            <h5 class="fw-bold mb-2">Diploma de Acreditación</h5>
                            <p class="text-secondary small mb-0">Incluye Diploma de acuerdo con las condiciones académicas establecidas.</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="benefit-badge-card">
                            <div class="benefit-badge-icon"><i class="fas fa-briefcase"></i></div>
                            <h5 class="fw-bold mb-2">Bolsa de Trabajo</h5>
                            <p class="text-secondary small mb-0">Ingreso directo a la Bolsa de Trabajo de Quality Consulting Solutions para ofertas del sector.</p>
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
             6. SHOWCASE MULTIMEDIA - 2 VIDEOS DE YOUTUBE ORIGINALES
             ========================================================================== -->
        <section class="py-5" id="videos-gruas-torre">
            <div class="container py-3">
                
                <div class="text-center mb-5">
                    <span class="badge bg-danger text-white px-3 py-2 rounded-pill fw-bold text-uppercase mb-2 shadow-sm">
                        <i class="fa-brands fa-youtube me-1"></i> Sesiones Técnicas
                    </span>
                    <h2 class="fw-extrabold text-uppercase text-dark animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); color: var(--primary-blue);">
                        CONOCE MÁS SOBRE PLANIFICACIÓN CON GRÚAS TORRE
                    </h2>
                    <div class="title-underline mx-auto" style="background: #ef4444;"></div>
                    <p class="text-secondary mx-auto mt-3" style="max-width: 760px;">
                        Visualiza los contenidos audiovisuales sobre la gestión de equipos de izaje y logística en construcciones de gran altura.
                    </p>
                </div>

                <div class="row g-4 justify-content-center">
                    
                    <!-- Video 1 -->
                    <div class="col-12 col-lg-6">
                        <div class="ratio ratio-16x9 shadow-lg rounded-4 overflow-hidden mb-4 border border-2 border-dark-subtle">
                            <iframe src="https://www.youtube.com/embed/31XYKsIlzHc" title="Estrategia de Productividad y Planificación con Grúas Torre - Video 1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                    </div>

                    <!-- Video 2 -->
                    <div class="col-12 col-lg-6">
                        <div class="ratio ratio-16x9 shadow-lg rounded-4 overflow-hidden mb-4 border border-2 border-dark-subtle">
                            <iframe src="https://www.youtube.com/embed/6mcyCs0PNTs" title="Estrategia de Productividad y Planificación con Grúas Torre - Video 2" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             7. SECCIÓN DE INSCRIPCIÓN (CTA Principal - Sin Pasarelas de Pago)
             ========================================================================== -->
        <section class="py-5 bg-light border-top" id="matricula">
            <div class="container py-3">
                
                <div class="crane-enrollment-card">
                    
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold text-uppercase mb-3 shadow-sm">
                        <i class="fa-solid fa-bolt me-1"></i> CAPACITACIÓN ESPECIALIZADA • MODALIDAD ONLINE
                    </span>

                    <h2 class="display-6 fw-extrabold text-uppercase mb-2 animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); color: var(--primary-blue);">
                        SOLICITA INFORMACIÓN Y BROCHURE DEL CURSO
                    </h2>
                    <p class="text-secondary mx-auto mb-4" style="max-width: 740px;">
                        Elige tu canal preferido para solicitar asesoría técnica personalizada o descargar el brochure detallado con la estructura y temas de grúas torre.
                    </p>

                    <!-- Beneficios Rápidos de Matrícula -->
                    <div class="row g-3 mb-4 text-start justify-content-center">
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="p-3 rounded-3 border bg-white">
                                <i class="fa-solid fa-circle-play text-dark me-2"></i> <span class="small text-dark fw-bold">Clases Grabadas 100% Online</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="p-3 rounded-3 border bg-white">
                                <i class="fa-solid fa-cloud-arrow-down text-dark me-2"></i> <span class="small text-dark fw-bold">Grabaciones HD 24/7 sin Límite</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="p-3 rounded-3 border bg-white">
                                <i class="fa-solid fa-certificate text-dark me-2"></i> <span class="small text-dark fw-bold">Diploma de Acreditación Oficial</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="p-3 rounded-3 border bg-white">
                                <i class="fa-solid fa-briefcase text-dark me-2"></i> <span class="small text-dark fw-bold">Bolsa de Trabajo Exclusiva</span>
                            </div>
                        </div>
                    </div>

                    <!-- 2 Botones Oficiales (WhatsApp y Brochure) -->
                    <div class="row g-3 justify-content-center">
                        
                        <!-- 1. WhatsApp -->
                        <div class="col-12 col-md-5">
                            <a href="https://api.whatsapp.com/send?phone=51993463118&amp;text=Buen%20d%C3%ADa,%20%C2%BFpodr%C3%ADan%20enviarme%20informaci%C3%B3n%20sobre%20el%20curso%20de%20Estrategia%20de%20Productividad%20y%20Planificaci%C3%B3n%20con%20Gr%C3%BAas%20Torre?" target="_blank" rel="noopener noreferrer" class="btn btn-success btn-lg w-100 my-1 btn-crane-action btn-qcs-primary" aria-label="Consultar información del curso por WhatsApp">
                                <i class="fab fa-whatsapp me-2"></i> Consultar por WhatsApp
                            </a>
                        </div>

                        <!-- 2. Brochure / Ficha Técnica (Google Forms) -->
                        <div class="col-12 col-md-5">
                            <a href="https://docs.google.com/forms/d/e/1FAIpQLSe1OMzCFe27EKQGEHGfvR2pbwgFzOngKIUTFGc8d-__wQeS1A/viewform" target="_blank" rel="noopener noreferrer" class="btn btn-qcs-dark btn-lg w-100 my-1 btn-crane-action btn-qcs-primary" aria-label="Descargar información y brochure del curso">
                                <i class="fas fa-file-pdf me-2"></i> Info &amp; Brochure
                            </a>
                        </div>

                    </div>

                    <!-- Barra de Seguridad y Confianza -->
                    <div class="payment-trust-bar mt-4 pt-3 border-top">
                        <div class="payment-trust-item">
                            <i class="fa-solid fa-shield-halved text-dark"></i>
                            <span>Atención Directa y Personalizada</span>
                        </div>
                        <div class="payment-trust-item">
                            <i class="fa-solid fa-headset text-dark"></i>
                            <span>Soporte Académico y Técnico Permanente</span>
                        </div>
                        <div class="payment-trust-item">
                            <i class="fa-solid fa-building-circle-check text-dark"></i>
                            <span>Capacitación Especializada en Construcción</span>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             8. LLAMADO A LA ACCIÓN FINAL (Contacto Corporativo)
             ========================================================================== -->
        <section class="cta-banner-section" id="contacto-final">
            <div class="cta-container">
                <div class="cta-box">
                    <div class="cta-content">
                        <span class="cta-tag"><i class="fa-solid fa-truck-monster"></i> Edificación Vertical &amp; Maquinaria Pesada</span>
                        <h3 class="animate__animated animate__fadeInUp animate__delay-1s">Optimiza los tiempos y costos de tus edificaciones verticales</h3>
                        <p>
                            Aprende a planificar la logística de grúas torre y elevar la productividad en tus proyectos de construcción.
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
