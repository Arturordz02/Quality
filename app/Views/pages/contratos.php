<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de P?gina: Gesti?n Contractual en Proyectos de Construcci?n
 * Archivo: app/Views/pages/contratos.php
 */

declare(strict_types=1);
?>
<style>
        body {
            background-color: #F4F5F7;
            color: #1e293b;
        }

        /* Hero Legal-Tech & Contract Strategy Style */
        .contract-hero-banner {
            position: relative;
            padding: 190px 1.5rem 85px 1.5rem;
            background: linear-gradient(135deg, #0F1113 0%, #1A1D20 45%, #1A1D20 100%);
            color: #ffffff;
            overflow: hidden;
            border-bottom: 3px solid var(--accent-gold);
        }

        .contract-hero-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 80% 20%, rgba(229, 168, 19, 0.22) 0%, transparent 60%),
                        radial-gradient(circle at 15% 85%, rgba(37, 99, 235, 0.18) 0%, transparent 60%);
            pointer-events: none;
        }

        .contract-hero-card {
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

        .contract-hero-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-gold);
            box-shadow: 0 16px 36px rgba(229, 168, 19, 0.25);
            background: rgba(24, 59, 107, 0.9);
        }

        .contract-hero-icon {
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

        .contract-hero-card-title {
            font-family: var(--font-heading);
            font-size: 1rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 0.35rem;
        }

        .contract-hero-card-desc {
            font-size: 0.84rem;
            color: #cbd5e1;
            margin: 0;
            line-height: 1.45;
        }

        /* Card Docente */
        .contract-docente-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-top: 4px solid var(--primary-blue);
            border-radius: 16px;
            padding: 2.25rem;
            height: 100%;
            box-shadow: var(--shadow-sm);
            transition: all var(--transition-normal);
        }

        .contract-docente-card:hover {
            border-top-color: var(--accent-gold);
            box-shadow: var(--shadow-md);
        }

        .docente-avatar-contract {
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

        /* Esquema Secuencial del Flujo Contractual */
        .contract-process-flow-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.4rem;
            flex-wrap: wrap;
            margin-top: 1.5rem;
            padding: 1.15rem 1rem;
            background: #F4F5F7;
            border-radius: 12px;
            border: 1px solid var(--border-color);
        }

        .contract-process-flow-step {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-family: var(--font-heading);
            font-size: 0.76rem;
            font-weight: 800;
            color: var(--primary-blue);
            background: #ffffff;
            padding: 0.45rem 0.6rem;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 5px rgba(0,0,0,0.04);
        }

        .contract-process-flow-arrow {
            color: var(--accent-gold);
            font-size: 0.95rem;
            font-weight: 900;
        }

        /* Grid de 9 Ejes Curriculares */
        .contract-modules-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
        }

        @media (max-width: 992px) {
            .contract-modules-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .contract-modules-grid {
                grid-template-columns: 1fr;
            }
        }

        .contract-module-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 1.5rem 1.25rem;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .contract-module-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-gold);
            box-shadow: var(--shadow-lg);
        }

        .contract-module-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .contract-num-badge {
            background: linear-gradient(135deg, var(--primary-blue), #1A1D20);
            color: #ffffff;
            font-family: var(--font-heading);
            font-size: 0.78rem;
            font-weight: 800;
            padding: 0.3rem 0.7rem;
            border-radius: 6px;
            border: 1px solid var(--accent-gold);
        }

        .contract-module-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(15, 17, 19, 0.2);
            color: var(--primary-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            transition: all var(--transition-fast);
        }

        .contract-module-card:hover .contract-module-icon {
            background: var(--accent-gold);
            color: #ffffff;
            transform: scale(1.1);
        }

        .contract-module-title {
            font-family: var(--font-heading);
            font-size: 1.02rem;
            font-weight: 800;
            color: var(--primary-blue);
            margin-bottom: 0.4rem;
        }

        .contract-module-desc {
            font-size: 0.86rem;
            color: #475569;
            line-height: 1.55;
            margin: 0;
            flex-grow: 1;
        }

        /* Modalidad y Beneficios */
        .contract-modalidad-card {
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
        .contract-enrollment-card {
            background: #ffffff;
            border: 2px solid rgba(229, 168, 19, 0.4);
            border-radius: 20px;
            padding: 3rem 2.25rem;
            box-shadow: var(--shadow-lg);
            text-align: center;
        }

        .btn-contract-action {
            border-radius: 10px;
            font-family: var(--font-heading);
            font-weight: 700;
            padding: 0.9rem 1.25rem;
            transition: all var(--transition-normal);
        }

        .btn-contract-action:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        </style>

<main class="page-content">

        <!-- ==========================================================================
             1. ENCABEZADO HERO ESTILIZADO (Legal-Tech & Contract Strategy Style)
             ========================================================================== -->
        <section class="contract-hero-banner">
            <div class="container text-center position-relative" style="z-index: 2;">
                
                <!-- Badge Neón Superior Requerido -->
                <div class="mb-3">
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-2 shadow-sm">
                        <i class="fas fa-file-contract me-2"></i> CURSO ESPECIALIZADO | GESTIÓN CONTRACTUAL
                    </span>
                </div>

                <h1 class="display-5 fw-extrabold text-white text-uppercase tracking-wide mb-3 animate__animated animate__fadeInDown" style="font-family: var(--font-heading); font-weight: 800;">
                    GESTIÓN CONTRACTUAL EN PROYECTOS DE CONSTRUCCIÓN
                </h1>

                <p class="lead text-light opacity-90 mx-auto mb-4" style="max-width: 860px; font-size: 1.15rem; color: #e2e8f0;">
                    Aprende el marco estratégico de la gestión de contratos, matriz de riesgos, prevención de controversias y administración de reclamos en la construcción.
                </p>

                <!-- Grid de 3 Tarjetas de Valor Ejecutivo dentro del Hero -->
                <div class="row g-3 justify-content-center mt-2">
                    
                    <!-- Tarjeta 1: Modalidad Grabada Online -->
                    <div class="col-12 col-md-4">
                        <div class="contract-hero-card">
                            <div class="contract-hero-icon"><i class="fas fa-circle-play"></i></div>
                            <div class="contract-hero-card-title">Modalidad Grabada Online</div>
                            <p class="contract-hero-card-desc">Clases grabadas 100% online con acceso disponible 24/7.</p>
                        </div>
                    </div>

                    <!-- Tarjeta 2: Acceso Multiplataforma -->
                    <div class="col-12 col-md-4">
                        <div class="contract-hero-card">
                            <div class="contract-hero-icon"><i class="fas fa-laptop"></i></div>
                            <div class="contract-hero-card-title">Acceso Multiplataforma</div>
                            <p class="contract-hero-card-desc">Acceso desde PC, Laptop, Tablet y Celular mediante video y chat interactivo.</p>
                        </div>
                    </div>

                    <!-- Tarjeta 3: Acreditación Físico -->
                    <div class="col-12 col-md-4">
                        <div class="contract-hero-card">
                            <div class="contract-hero-icon"><i class="fas fa-award"></i></div>
                            <div class="contract-hero-card-title">Acreditación Oficial</div>
                            <p class="contract-hero-card-desc">Incluye Diploma Físico + Ingreso a Bolsa de Trabajo + Descuentos como Ex-alumno.</p>
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
                        <div class="contract-docente-card d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="docente-avatar-contract">
                                        <i class="fa-solid fa-user-tie"></i>
                                    </div>
                                    <div>
                                        <span class="badge bg-warning-subtle text-dark fw-bold text-uppercase px-2 py-1 rounded">
                                            <i class="fa-solid fa-chalkboard-user me-1"></i> Docente Principal
                                        </span>
                                        <h3 class="fw-bold mb-0 text-dark mt-1 animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); color: var(--primary-blue); font-size: 1.3rem;">
                                            ING. LUIS RUIZ
                                        </h3>
                                    </div>
                                </div>

                                <!-- Credenciales / Badges Requeridos -->
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge bg-dark text-warning border border-warning-subtle"><i class="fa-solid fa-graduation-cap me-1"></i> Ingeniero Civil</span>
                                    <span class="badge bg-dark"><i class="fa-solid fa-award text-warning me-1"></i> MBA</span>
                                    <span class="badge bg-secondary"><i class="fa-solid fa-scale-balanced me-1"></i> Experto en Gestión Contractual</span>
                                </div>

                                <!-- Bio / Experiencia Requerida -->
                                <ul class="list-unstyled mb-0 text-secondary" style="font-size: 0.92rem; line-height: 1.6;">
                                    <li class="mb-2"><i class="fa-solid fa-check text-dark me-2"></i> Profesional con más de 25 años en gerencia de proyectos, cargos ejecutivos, gestión contractual y consultoría en las principales empresas constructoras del país.</li>
                                    <li><i class="fa-solid fa-check text-dark me-2"></i> Cuenta con experiencia docente en principales universidades de posgrado y participación como ponente en prestigiosos congresos del sector.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Columna Derecha: Objetivo General + Esquema de Estrategia Contractual -->
                    <div class="col-12 col-lg-7">
                        <div class="contract-docente-card d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <span class="badge bg-warning-subtle text-warning-emphasis fw-bold text-uppercase px-2 py-1 rounded">
                                        <i class="fa-solid fa-bullseye me-1"></i> Propósito &amp; Visión Legal-Técnica
                                    </span>
                                </div>

                                <h3 class="fw-bold mb-3 animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); color: var(--primary-blue);">
                                    OBJETIVO DEL CURSO
                                </h3>

                                <p class="text-secondary mb-3" style="font-size: 0.95rem; line-height: 1.65;">
                                    Brindar a los participantes el marco conceptual y práctico de la gestión contractual en construcción, analizando casos reales de aplicación, buenas prácticas de la industria, administración de riesgos y formulación de estrategias contractuales para salvaguardar los intereses técnicos y económicos del proyecto.
                                </p>
                            </div>

                            <!-- Visualizador del Flujo Contractual Requerido -->
                            <div>
                                <h6 class="fw-bold text-uppercase small text-secondary mb-2">
                                    <i class="fa-solid fa-timeline text-dark me-1"></i> Flujo Estratégico de Administración Contractual
                                </h6>
                                <div class="contract-process-flow-row">
                                    <div class="contract-process-flow-step"><i class="fa-solid fa-flag-checkered text-dark"></i> LÍNEA BASE</div>
                                    <span class="contract-process-flow-arrow">➔</span>
                                    <div class="contract-process-flow-step"><i class="fa-solid fa-triangle-exclamation text-warning"></i> MATRIZ RIESGOS</div>
                                    <span class="contract-process-flow-arrow">➔</span>
                                    <div class="contract-process-flow-step"><i class="fa-solid fa-folder-open text-warning"></i> CONTROL DOC.</div>
                                    <span class="contract-process-flow-arrow">➔</span>
                                    <div class="contract-process-flow-step"><i class="fa-solid fa-chart-line text-danger"></i> IMPACTO</div>
                                    <span class="contract-process-flow-arrow">➔</span>
                                    <div class="contract-process-flow-step"><i class="fa-solid fa-handshake text-success"></i> PREVENCIÓN</div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             3. CONTENIDOS DEL CURSO - GRID MODULAR (9 Ejes del Programa)
             ========================================================================== -->
        <section class="py-5 bg-white border-top border-bottom" id="temario">
            <div class="container py-3">
                
                <div class="text-center mb-5">
                    <span class="badge bg-warning-subtle text-dark px-3 py-2 rounded-pill fw-bold text-uppercase mb-2 shadow-sm">
                        <i class="fa-solid fa-gavel me-1"></i> Malla Curricular
                    </span>
                    <h2 class="fw-extrabold text-uppercase text-dark animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); color: var(--primary-blue);">
                        ESTRUCTURA CURRICULAR DEL PROGRAMA
                    </h2>
                    <div class="title-underline mx-auto"></div>
                    <p class="text-secondary mx-auto mt-3" style="max-width: 780px;">
                        Módulos clave para dominar la administración de contratos y mitigar riesgos en proyectos de construcción.
                    </p>
                </div>

                <!-- Grid de 9 Ejes Curriculares -->
                <div class="contract-modules-grid">
                    
                    <!-- 01. Estándar para la Gestión Contractual -->
                    <div class="contract-module-card">
                        <div class="contract-module-header">
                            <span class="contract-num-badge">01</span>
                            <div class="contract-module-icon"><i class="fas fa-balance-scale"></i></div>
                        </div>
                        <h3 class="contract-module-title animate__animated animate__fadeInUp animate__delay-1s">01. Estándar para la Gestión Contractual</h3>
                        <p class="contract-module-desc">Principios y marcos de referencia internacionales aplicados a la construcción y dirección de obras.</p>
                    </div>

                    <!-- 02. Mapa de Actores y Factores -->
                    <div class="contract-module-card">
                        <div class="contract-module-header">
                            <span class="contract-num-badge">02</span>
                            <div class="contract-module-icon"><i class="fas fa-users-cog"></i></div>
                        </div>
                        <h3 class="contract-module-title animate__animated animate__fadeInUp animate__delay-1s">02. Mapa de Actores y Factores</h3>
                        <p class="contract-module-desc">Identificación y gestión de partes involucradas en el contrato, roles del cliente, contratista y supervisión.</p>
                    </div>

                    <!-- 03. Determinación de la Línea Base Contractual -->
                    <div class="contract-module-card">
                        <div class="contract-module-header">
                            <span class="contract-num-badge">03</span>
                            <div class="contract-module-icon"><i class="fas fa-flag-checkered"></i></div>
                        </div>
                        <h3 class="contract-module-title animate__animated animate__fadeInUp animate__delay-1s">03. Determinación de la Línea Base Contractual</h3>
                        <p class="contract-module-desc">Establecimiento de alcances, plazos, hitos contractuales y obligaciones iniciales de las partes.</p>
                    </div>

                    <!-- 04. Revisión del Contrato Principal y Matriz de Riesgos -->
                    <div class="contract-module-card">
                        <div class="contract-module-header">
                            <span class="contract-num-badge">04</span>
                            <div class="contract-module-icon"><i class="fas fa-exclamation-triangle"></i></div>
                        </div>
                        <h3 class="contract-module-title animate__animated animate__fadeInUp animate__delay-1s">04. Revisión del Contrato Principal y Matriz de Riesgos</h3>
                        <p class="contract-module-desc">Análisis clausulado, distribución de responsabilidades y asignación cuantitativa de contingencias.</p>
                    </div>

                    <!-- 05. Concepto de Asunto Potencialmente Polémico (PCE) -->
                    <div class="contract-module-card">
                        <div class="contract-module-header">
                            <span class="contract-num-badge">05</span>
                            <div class="contract-module-icon"><i class="fas fa-gavel"></i></div>
                        </div>
                        <h3 class="contract-module-title animate__animated animate__fadeInUp animate__delay-1s">05. Concepto de Asunto Potencialmente Polémico (PCE)</h3>
                        <p class="contract-module-desc">Detección temprana de reclamos, desacuerdos y alertas previas a la formalización de disputas.</p>
                    </div>

                    <!-- 06. Control Documentario Contractual -->
                    <div class="contract-module-card">
                        <div class="contract-module-header">
                            <span class="contract-num-badge">06</span>
                            <div class="contract-module-icon"><i class="fas fa-folder-open"></i></div>
                        </div>
                        <h3 class="contract-module-title animate__animated animate__fadeInUp animate__delay-1s">06. Control Documentario Contractual</h3>
                        <p class="contract-module-desc">Trazabilidad, cartas, cuadernos de obra, registros fotográficos y respaldo probatorio documental.</p>
                    </div>

                    <!-- 07. Análisis del Impacto en el Cronograma Contractual -->
                    <div class="contract-module-card">
                        <div class="contract-module-header">
                            <span class="contract-num-badge">07</span>
                            <div class="contract-module-icon"><i class="fas fa-calendar-times"></i></div>
                        </div>
                        <h3 class="contract-module-title animate__animated animate__fadeInUp animate__delay-1s">07. Análisis del Impacto en el Cronograma Contractual</h3>
                        <p class="contract-module-desc">Evaluación técnica de extensiones de plazo (EOT), retrasos concurrentes y atrasos compensables.</p>
                    </div>

                    <!-- 08. Juicio Experto -->
                    <div class="contract-module-card">
                        <div class="contract-module-header">
                            <span class="contract-num-badge">08</span>
                            <div class="contract-module-icon"><i class="fas fa-user-tie"></i></div>
                        </div>
                        <h3 class="contract-module-title animate__animated animate__fadeInUp animate__delay-1s">08. Juicio Experto</h3>
                        <p class="contract-module-desc">Criterios técnicos, periciales y legales para respaldar posiciones contractuales ante reclamos.</p>
                    </div>

                    <!-- 09. Fundamentos de Resolución de Controversias -->
                    <div class="contract-module-card">
                        <div class="contract-module-header">
                            <span class="contract-num-badge">09</span>
                            <div class="contract-module-icon"><i class="fas fa-handshake"></i></div>
                        </div>
                        <h3 class="contract-module-title animate__animated animate__fadeInUp animate__delay-1s">09. Fundamentos de Resolución de Controversias</h3>
                        <p class="contract-module-desc">Dispute Boards (JRD), trato directo, conciliación y arbitraje en proyectos de infraestructura.</p>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             4. MODALIDAD Y BENEFICIOS DEL CURSO
             ========================================================================== -->
        <section class="py-5" style="background-color: var(--qcs-bg-light);" id="modalidad-beneficios">
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
                        <div class="contract-modalidad-card">
                            <div class="fw-bold text-dark mb-1"><i class="fas fa-circle-play me-1"></i> Clases Grabadas Online</div>
                            <p class="small text-secondary mb-0">Acceso inmediato a las clases y disponible 24/7.</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="contract-modalidad-card">
                            <div class="fw-bold text-dark mb-1"><i class="fas fa-clock-rotate-left me-1"></i> Grabaciones 24/7</div>
                            <p class="small text-secondary mb-0">Acceso a las grabaciones sin límite de tiempo.</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="contract-modalidad-card">
                            <div class="fw-bold text-dark mb-1"><i class="fas fa-mobile-screen-button me-1"></i> Multiplataforma</div>
                            <p class="small text-secondary mb-0">Disponible en PC, Laptop, Tablet y Celular.</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="contract-modalidad-card">
                            <div class="fw-bold text-dark mb-1"><i class="fas fa-comments me-1"></i> Soporte y Casuística</div>
                            <p class="small text-secondary mb-0">Casuística práctica y análisis de controversias reales.</p>
                        </div>
                    </div>
                </div>

                <!-- 3 Tarjetas de Beneficios -->
                <div class="row g-4 justify-content-center">
                    <div class="col-12 col-md-4">
                        <div class="benefit-badge-card">
                            <div class="benefit-badge-icon"><i class="fas fa-certificate"></i></div>
                            <h5 class="fw-bold mb-2">Diploma Físico</h5>
                            <p class="text-secondary small mb-0">Incluye Diploma físico de acreditación al finalizar el programa de forma satisfactoria.</p>
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
                            <h5 class="fw-bold mb-2">Descuentos Ex-alumno</h5>
                            <p class="text-secondary small mb-0">Acceso a precios y tarifas especiales para ex-alumnos en futuros programas ejecutivos.</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ==========================================================================
             5. SHOWCASE MULTIMEDIA - VIDEO DE YOUTUBE ORIGINAL
             ========================================================================== -->
        <section class="py-5 bg-white border-top" id="video-contratos">
            <div class="container py-3">
                
                <div class="text-center mb-5">
                    <span class="badge bg-danger text-white px-3 py-2 rounded-pill fw-bold text-uppercase mb-2 shadow-sm">
                        <i class="fa-brands fa-youtube me-1"></i> Sesión Informativa
                    </span>
                    <h2 class="fw-extrabold text-uppercase text-dark animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); color: var(--primary-blue);">
                        CONOCE MÁS SOBRE GESTIÓN CONTRACTUAL
                    </h2>
                    <div class="title-underline mx-auto" style="background: #ef4444;"></div>
                    <p class="text-secondary mx-auto mt-3" style="max-width: 760px;">
                        Visualiza la presentación del programa y descubre las claves para mitigar controversias en proyectos de construcción.
                    </p>
                </div>

                <div class="row justify-content-center">
                    <div class="col-12 col-lg-9">
                        <div class="ratio ratio-16x9 shadow-lg rounded-4 overflow-hidden mb-4 border border-2 border-dark-subtle">
                            <iframe src="https://www.youtube.com/embed/zTwiEutndgo" title="Gestión Contractual en Proyectos de Construcción - Quality Consulting Solutions" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ==========================================================================
             6. SECCIÓN DE INSCRIPCIÓN Y PASARELAS DE PAGO (CTA Principal)
             ========================================================================== -->
        <section class="py-5 bg-light border-top" id="matricula">
            <div class="container py-3">
                
                <div class="contract-enrollment-card">
                    
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold text-uppercase mb-3 shadow-sm">
                        <i class="fa-solid fa-bolt me-1"></i> PROGRAMA ESPECIALIZADO • CLASES GRABADAS
                    </span>

                    <h2 class="display-6 fw-extrabold text-uppercase mb-2 animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); color: var(--primary-blue);">
                        MATRICÚLATE EN EL CURSO DE GESTIÓN CONTRACTUAL
                    </h2>
                    <p class="text-secondary mx-auto mb-4" style="max-width: 740px;">
                        Elige tu canal preferido para solicitar asesoría técnica personalizada, descargar el brochure con los módulos o formalizar tu inscripción online de forma segura.
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
                                <i class="fa-solid fa-certificate text-dark me-2"></i> <span class="small text-dark fw-bold">Diploma Físico Oficial</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="p-3 rounded-3 border bg-white">
                                <i class="fa-solid fa-briefcase text-dark me-2"></i> <span class="small text-dark fw-bold">Bolsa de Trabajo Exclusiva</span>
                            </div>
                        </div>
                    </div>

                    <!-- 3 Botones Oficiales de Matrícula y Pasarelas -->
                    <div class="row g-3 justify-content-center">
                        
                        <!-- 1. WhatsApp -->
                        <div class="col-12 col-md-4">
                            <a href="https://api.whatsapp.com/send?phone=51993463118&amp;text=Buen%20d%C3%ADa,%20%C2%BFpodr%C3%ADan%20enviarme%20informaci%C3%B3n%20sobre%20el%20curso%20de%20Gesti%C3%B3n%20Contractual%20en%20Proyectos%20de%20Construcci%C3%B3n?" target="_blank" rel="noopener noreferrer" class="btn btn-success btn-lg w-100 my-1 btn-contract-action btn-qcs-primary" aria-label="Consultar información del curso por WhatsApp">
                                <i class="fab fa-whatsapp me-2"></i> Consultar por WhatsApp
                            </a>
                        </div>

                        <!-- 2. Brochure / Ficha Técnica (Google Forms) -->
                        <div class="col-12 col-md-4">
                            <a href="https://docs.google.com/forms/d/e/1FAIpQLSe4r-byQVQ2MHJxzG3E5eIoPrugrvjl3R_Vb3_2MO8skgoEnQ/viewform" target="_blank" rel="noopener noreferrer" class="btn btn-qcs-dark btn-lg w-100 my-1 btn-contract-action btn-qcs-primary" aria-label="Descargar más información y brochure del curso">
                                <i class="fas fa-file-pdf me-2"></i> Más Información / Brochure
                            </a>
                        </div>

                        <!-- 3. PayPal Internacional -->
                        <div class="col-12 col-md-4">
                            <a href="https://www.paypal.com/paypalme/qualityconsulting/140" target="_blank" rel="noopener noreferrer" class="btn btn-dark btn-lg w-100 my-1 btn-contract-action btn-qcs-primary" aria-label="Pagar mediante PayPal">
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
                        <span class="cta-tag"><i class="fa-solid fa-scale-balanced"></i> Estrategia y Control Contractual</span>
                        <h3 class="animate__animated animate__fadeInUp animate__delay-1s">Protege y optimiza la ejecución contractual de tus obras</h3>
                        <p>
                            Aprende a gestionar riesgos, reclamos y controversias con criterios técnicos y estratégicos.
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
