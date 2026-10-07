<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: ISO 9001:2015 para la Infraestructura y Construcción
 * Archivo: app/Views/pages/iso-9001.php
 */

declare(strict_types=1);
?>
<style>
        body {
            background-color: #F4F5F7;
            color: #1e293b;
        }

        /* Hero Compliance & ISO Audit (Verde Oscuro / Azulado / Oro) */
        .iso-hero-banner {
            position: relative;
            padding: 190px 1.5rem 85px 1.5rem;
            background: linear-gradient(135deg, #0F1113 0%, #1A1D20 45%, #1A1D20 100%);
            color: #ffffff;
            overflow: hidden;
            border-bottom: 2px solid rgba(229, 168, 19, 0.4);
        }

        .iso-hero-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 80% 20%, rgba(229, 168, 19, 0.18) 0%, transparent 60%),
                        radial-gradient(circle at 15% 85%, rgba(142, 146, 151, 0.15) 0%, transparent 60%);
            pointer-events: none;
        }

        /* Tarjetas de Beneficios Exclusivos en Hero */
        .iso-benefit-card {
            background: rgba(26, 29, 32, 0.75);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(229, 168, 19, 0.35);
            border-radius: 14px;
            padding: 1.25rem 1rem;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .iso-benefit-card:hover {
            transform: translateY(-5px);
            border-color: #E5A813;
            box-shadow: 0 16px 36px rgba(229, 168, 19, 0.25);
            background: rgba(26, 29, 32, 0.9);
        }

        .iso-benefit-icon {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: rgba(229, 168, 19, 0.15);
            color: #fef08a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin: 0 auto 0.75rem auto;
            border: 1px solid rgba(229, 168, 19, 0.4);
        }

        .iso-benefit-title {
            font-family: var(--font-heading);
            font-size: 0.95rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 0.25rem;
        }

        .iso-benefit-desc {
            font-size: 0.8rem;
            color: #cbd5e1;
            margin: 0;
            line-height: 1.4;
        }

        /* Card Docente Estilo Auditoría */
        .iso-audit-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-top: 4px solid #1A1D20;
            border-radius: 16px;
            padding: 2.25rem;
            height: 100%;
            box-shadow: var(--shadow-md);
            transition: all var(--transition-normal);
        }

        .iso-audit-card:hover {
            border-top-color: #E5A813;
            box-shadow: var(--shadow-lg);
        }

        .iso-auditor-seal {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1A1D20, #1A1D20);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            color: #fef08a;
            border: 3px solid #E5A813;
            box-shadow: 0 4px 16px rgba(26, 29, 32, 0.25);
            flex-shrink: 0;
        }

        /* Bloques Interactivos del Ciclo PHVA */
        .phva-interactive-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        @media (max-width: 768px) {
            .phva-interactive-grid {
                grid-template-columns: 1fr;
            }
        }

        .phva-quadrant {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            padding: 1.75rem 1.5rem;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.35s ease;
        }

        .phva-quadrant:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .phva-plan { border-left: 5px solid #E5A813; }
        .phva-plan:hover { border-color: #E5A813; }
        .phva-plan .phva-letter-badge { background: #E5A813; }

        .phva-do { border-left: 5px solid #E5A813; }
        .phva-do:hover { border-color: #E5A813; }
        .phva-do .phva-letter-badge { background: #E5A813; }

        .phva-check { border-left: 5px solid #C9910D; }
        .phva-check:hover { border-color: #C9910D; }
        .phva-check .phva-letter-badge { background: #C9910D; }

        .phva-act { border-left: 5px solid #dc2626; }
        .phva-act:hover { border-color: #dc2626; }
        .phva-act .phva-letter-badge { background: #dc2626; }

        .phva-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .phva-letter-badge {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            color: #ffffff;
            font-family: var(--font-heading);
            font-size: 1.4rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            flex-shrink: 0;
        }

        .phva-title {
            font-family: var(--font-heading);
            font-size: 1.15rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
            line-height: 1.3;
        }

        .phva-clauses {
            font-size: 0.78rem;
            font-weight: 700;
            color: #1A1D20;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .phva-desc {
            font-size: 0.88rem;
            color: #475569;
            line-height: 1.6;
            margin: 0;
        }

        /* Sección Multimedia */
        .iso-video-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }

        .iso-video-card:hover {
            transform: translateY(-5px);
            border-color: #1A1D20;
            box-shadow: var(--shadow-lg);
        }

        .iso-video-header {
            background: #1A1D20;
            padding: 0.85rem 1.15rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.82rem;
            font-weight: 700;
            color: #ffffff;
        }

        .iso-video-caption {
            padding: 1.1rem;
            font-size: 0.86rem;
            color: #475569;
            margin: 0;
            line-height: 1.45;
        }

        /* Tarjeta de Matrícula */
        .iso-enrollment-card {
            background: #ffffff;
            border: 2px solid rgba(26, 29, 32, 0.3);
            border-radius: 20px;
            padding: 3rem 2.25rem;
            box-shadow: var(--shadow-lg);
            text-align: center;
        }

        .btn-iso-action {
            border-radius: 10px;
            font-family: var(--font-heading);
            font-weight: 700;
            padding: 0.9rem 1.25rem;
            transition: all var(--transition-normal);
        }

        .btn-iso-action:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        /* ==========================================================
           REAJUSTE DE NAVEGACIÓN: AISLAMIENTO DE BOOTSTRAP 5
           ========================================================== */
                </style>

<main class="page-content">

        <!-- ==========================================================================
             1. ENCABEZADO HERO ESTILIZADO (Compliance & ISO Audit Style)
             ========================================================================== -->
        <section class="iso-hero-banner">
            <div class="container text-center position-relative" style="z-index: 2;">
                
                <!-- Badge Superior Neón Requerido -->
                <div class="mb-3">
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-2 shadow-sm">
                        <i class="fas fa-certificate me-2"></i> PROGRAMA ESPECIALIZADO | INCLUYE LIBRO
                    </span>
                </div>

                <h1 class="display-5 fw-extrabold text-white text-uppercase tracking-wide mb-3 animate__animated animate__fadeInDown" style="font-family: var(--font-heading); font-weight: 800;">
                    ISO 9001:2015 PARA LA INFRAESTRUCTURA Y CONSTRUCCIÓN
                </h1>

                <p class="lead text-light opacity-90 mx-auto mb-4" style="max-width: 860px; font-size: 1.15rem; color: #e2e8f0;">
                    Aprende a interpretar e implementar los requisitos de la norma ISO 9001:2015 adaptados al control operativo, la gestión de riesgos y la realidad de las obras.
                </p>

                <!-- Display de Beneficios Exclusivos (Bootstrap Row/Badges) -->
                <div class="row g-3 justify-content-center mt-2">
                    
                    <!-- Tarjeta 1: Libro Oficial -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="iso-benefit-card">
                            <div class="iso-benefit-icon"><i class="fa-solid fa-book-bookmark"></i></div>
                            <div class="iso-benefit-title">¡LIBRO OFICIAL INCLUIDO!</div>
                            <p class="iso-benefit-desc">Material bibliográfico exclusivo en formato físico o digital para consulta en obra.</p>
                        </div>
                    </div>

                    <!-- Tarjeta 2: Modalidad Grabada Online -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="iso-benefit-card">
                            <div class="iso-benefit-icon"><i class="fa-solid fa-circle-play"></i></div>
                            <div class="iso-benefit-title">MODALIDAD GRABADA ONLINE</div>
                            <p class="iso-benefit-desc">Acceso inmediato a las clases y disponible 24/7.</p>
                        </div>
                    </div>

                    <!-- Tarjeta 3: Acceso Multiplataforma -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="iso-benefit-card">
                            <div class="iso-benefit-icon"><i class="fa-solid fa-laptop-code"></i></div>
                            <div class="iso-benefit-title">MULTIPLATAFORMA</div>
                            <p class="iso-benefit-desc">Disponible en PC, Laptop, Tablet y Celular con transmisión en HD y chat activo.</p>
                        </div>
                    </div>

                    <!-- Tarjeta 4: Acreditación -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="iso-benefit-card">
                            <div class="iso-benefit-icon"><i class="fa-solid fa-award"></i></div>
                            <div class="iso-benefit-title">DIPLOMA Y BENEFICIOS</div>
                            <p class="iso-benefit-desc">Incluye Diploma + ¡Libro Incluido! + Ingreso a Bolsa de Trabajo + Descuentos de Ex-alumno.</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             2. PERFIL DEL DOCENTE Y OBJETIVO (Layout Asimétrico)
             ========================================================================== -->
        <section class="py-5" id="perfil-objetivo">
            <div class="container py-3">
                
                <div class="row g-4 align-items-stretch">
                    
                    <!-- Columna Izquierda: Card Ejecutiva de Omar Samaniego -->
                    <div class="col-12 col-lg-5">
                        <div class="iso-audit-card d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="iso-auditor-seal">
                                        <i class="fa-solid fa-user-tie"></i>
                                    </div>
                                    <div>
                                        <span class="badge bg-success-subtle text-success-emphasis fw-bold text-uppercase px-2 py-1 rounded">
                                            <i class="fa-solid fa-stamp me-1"></i> Auditor Líder Principal
                                        </span>
                                        <h3 class="fw-bold mb-0 text-dark mt-1 animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); color: #1A1D20; font-size: 1.3rem;">
                                            ING. OMAR A. SAMANIEGO
                                        </h3>
                                    </div>
                                </div>

                                <!-- Credenciales / Badges Requeridos -->
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge bg-light text-dark border px-2 py-1"><i class="fa-solid fa-award text-warning me-1"></i> PMP®</span>
                                    <span class="badge bg-light text-dark border px-2 py-1"><i class="fa-solid fa-shield-halved text-warning me-1"></i> PMI-RMP®</span>
                                    <span class="badge bg-light text-dark border px-2 py-1"><i class="fa-solid fa-check-double text-success me-1"></i> Auditor Líder IRCA</span>
                                    <span class="badge bg-light text-dark border px-2 py-1"><i class="fa-solid fa-medal text-warning me-1"></i> LSS Black Belt</span>
                                </div>

                                <!-- Bio / Logros Requeridos -->
                                <p class="text-secondary mb-3" style="font-size: 0.95rem; line-height: 1.65;">
                                    Más de 20 años de experiencia en Gestión de la Calidad en el Sector Construcción en empresas líderes del Perú y el extranjero. Experiencia docente en principales universidades y ponente en prestigiosos congresos del sector.
                                </p>

                                <div class="p-3 rounded-3 border-start border-4 border-success bg-light">
                                    <p class="small text-dark mb-0 fw-semibold">
                                        <i class="fa-solid fa-circle-check text-success me-1"></i> Auditor Líder IRCA ISO 9001 y evaluador de sistemas integrados de gestión para infraestructura vial, edificación y minería.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Columna Derecha: Objetivo General + Imagen de Control ISO -->
                    <div class="col-12 col-lg-7">
                        <div class="iso-audit-card d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <span class="badge bg-warning-subtle text-warning-emphasis fw-bold text-uppercase px-2 py-1 rounded">
                                        <i class="fa-solid fa-bullseye me-1"></i> Enfoque Práctico &amp; Operativo
                                    </span>
                                </div>

                                <h3 class="fw-bold mb-3 animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); color: #1A1D20;">
                                    OBJETIVO DEL CURSO
                                </h3>

                                <p class="text-secondary mb-3" style="font-size: 0.95rem; line-height: 1.65;">
                                    Brindar a los participantes los conocimientos, herramientas y criterios prácticos para interpretar e implementar cada una de las cláusulas de la norma ISO 9001:2015 articuladas con la realidad constructiva de las obras, enfatizando el pensamiento basado en riesgos, la reducción de no conformidades y las lecciones aprendidas.
                                </p>
                            </div>

                            <!-- Visualizador de Imagen de Control de Calidad e Inspección -->
                            <div class="mt-2 text-center">
                                <!-- Imagen conceptual sobre auditoría y norma ISO 9001 -->
                                <picture>
                                    <source srcset="img/ISO1.webp" type="image/webp">
                                    <img src="img/ISO1.png" alt="Inspección y auditoría de calidad ISO 9001 en construcción" class="img-fluid rounded-4 shadow-lg mb-0 border border-secondary border-opacity-25" loading="lazy" style="max-height: 240px; width: 100%; object-fit: cover;">
                                </picture>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             3. CONTENIDOS DEL CURSO (Diseño Interactivo del Ciclo PHVA)
             ========================================================================== -->
        <section class="py-5 bg-white border-top border-bottom" id="temario">
            <div class="container py-3">
                
                <div class="text-center mb-5">
                    <span class="badge bg-success-subtle text-success-emphasis px-3 py-2 rounded-pill fw-bold text-uppercase mb-2 shadow-sm">
                        <i class="fa-solid fa-arrows-rotate me-1"></i> Mejora Continua de Shewhart
                    </span>
                    <h2 class="fw-extrabold text-uppercase text-dark animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); color: #1A1D20;">
                        ESTRUCTURA CURRICULAR Y ARTICULACIÓN CON EL CICLO DE SHEWHART (PHVA)
                    </h2>
                    <div class="title-underline mx-auto" style="background: #1A1D20;"></div>
                    <p class="text-secondary mx-auto mt-3" style="max-width: 780px;">
                        Malla curricular estructurada bajo el ciclo de Deming/Shewhart, mapeando rigurosamente los requisitos normativos con su aplicación en proyectos de ingeniería.
                    </p>
                </div>

                <!-- Cuadrícula Interactiva de 4 Bloques PHVA -->
                <div class="phva-interactive-grid">
                    
                    <!-- P - PLANIFICAR -->
                    <div class="phva-quadrant phva-plan">
                        <div class="phva-header">
                            <div class="phva-letter-badge">P</div>
                            <div>
                                <span class="phva-clauses"><i class="fa-solid fa-book-open me-1"></i> Cláusulas 4, 5, 6</span>
                                <h3 class="phva-title animate__animated animate__fadeInUp animate__delay-1s">PLANIFICAR (Plan)</h3>
                            </div>
                        </div>
                        <p class="phva-desc">
                            Contexto de la organización, partes interesadas, alcance del SGC, liderazgo y compromiso de la alta dirección. Política de calidad, roles y responsabilidades. Planificación estratégica y herramientas esenciales para la <strong>Gestión de Riesgos y Oportunidades</strong> en la versión 2015.
                        </p>
                    </div>

                    <!-- H - HACER -->
                    <div class="phva-quadrant phva-do">
                        <div class="phva-header">
                            <div class="phva-letter-badge">H</div>
                            <div>
                                <span class="phva-clauses"><i class="fa-solid fa-gears me-1"></i> Cláusulas 7, 8</span>
                                <h3 class="phva-title animate__animated animate__fadeInUp animate__delay-1s">HACER (Do)</h3>
                            </div>
                        </div>
                        <p class="phva-desc">
                            Gestión de recursos, competencia del personal, toma de conciencia e información documentada. Planificación y control operacional en obra, requisitos de productos y servicios, diseño, control de procesos subcontratados y <strong>liberación de servicios en construcción</strong>.
                        </p>
                    </div>

                    <!-- V - VERIFICAR -->
                    <div class="phva-quadrant phva-check">
                        <div class="phva-header">
                            <div class="phva-letter-badge">V</div>
                            <div>
                                <span class="phva-clauses"><i class="fa-solid fa-chart-line me-1"></i> Cláusula 9</span>
                                <h3 class="phva-title animate__animated animate__fadeInUp animate__delay-1s">VERIFICAR (Check)</h3>
                            </div>
                        </div>
                        <p class="phva-desc">
                            Seguimiento, medición, análisis y evaluación del desempeño. Medición de la satisfacción del cliente, ejecución de <strong>Auditorías Internas de Calidad</strong> y Revisión por la Dirección para verificar la eficacia del sistema de gestión.
                        </p>
                    </div>

                    <!-- A - ACTUAR -->
                    <div class="phva-quadrant phva-act">
                        <div class="phva-header">
                            <div class="phva-letter-badge">A</div>
                            <div>
                                <span class="phva-clauses"><i class="fa-solid fa-arrow-trend-up me-1"></i> Cláusula 10</span>
                                <h3 class="phva-title animate__animated animate__fadeInUp animate__delay-1s">ACTUAR (Act)</h3>
                            </div>
                        </div>
                        <p class="phva-desc">
                            Determinación de oportunidades de mejora. Identificación, registro, análisis de causa raíz y tratamiento riguroso de <strong>No Conformidades</strong>. Formulación, implementación y seguimiento de acciones correctivas para evitar la recurrencia de fallas.
                        </p>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             4. SHOWCASE MULTIMEDIA (Grid de 3 Videos Promocionales de YouTube)
             ========================================================================== -->
        <section class="py-5" id="videos-iso">
            <div class="container py-3">
                
                <div class="text-center mb-5">
                    <span class="badge bg-danger text-white px-3 py-2 rounded-pill fw-bold text-uppercase mb-2 shadow-sm">
                        <i class="fa-brands fa-youtube me-1"></i> Sesiones Técnicas &amp; Masterclasses
                    </span>
                    <h2 class="fw-extrabold text-uppercase text-dark animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); color: #1A1D20;">
                        CONFERENCIAS Y TUTORIALES SOBRE ISO 9001 EN CONSTRUCCIÓN
                    </h2>
                    <div class="title-underline mx-auto" style="background: #ef4444;"></div>
                    <p class="text-secondary mx-auto mt-3" style="max-width: 760px;">
                        Masterclasses impartidas por el Ing. Omar Samaniego sobre la interpretación y auditoría práctica de la norma en proyectos de infraestructura.
                    </p>
                </div>

                <div class="row g-4">
                    
                    <!-- Video 1 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="iso-video-card h-100 d-flex flex-column justify-content-between">
                            <div>
                                <div class="iso-video-header">
                                    <span><i class="fa-solid fa-play text-danger me-2"></i> ISO 9001:2015 - Sesión 1</span>
                                    <span class="badge bg-dark text-warning">HD</span>
                                </div>
                                <div class="ratio ratio-16x9">
                                    <iframe src="https://www.youtube.com/embed/EJ-kUj2-keA" title="Conferencia ISO 9001:2015 en Construcción - Video 1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" loading="lazy">
                                    </iframe>
                                </div>
                            </div>
                            <p class="iso-video-caption">
                                <i class="fa-solid fa-certificate text-warning me-1"></i> <strong>Fundamentos de la Norma:</strong> Enfoque de procesos, liderazgo y pensamiento basado en riesgos.
                            </p>
                        </div>
                    </div>

                    <!-- Video 2 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="iso-video-card h-100 d-flex flex-column justify-content-between">
                            <div>
                                <div class="iso-video-header">
                                    <span><i class="fa-solid fa-play text-danger me-2"></i> ISO 9001:2015 - Sesión 2</span>
                                    <span class="badge bg-dark text-warning">HD</span>
                                </div>
                                <div class="ratio ratio-16x9">
                                    <iframe src="https://www.youtube.com/embed/v6BPe0MwRdM" title="Conferencia ISO 9001:2015 en Construcción - Video 2" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" loading="lazy">
                                    </iframe>
                                </div>
                            </div>
                            <p class="iso-video-caption">
                                <i class="fa-solid fa-gears text-warning me-1"></i> <strong>Operación en Obra:</strong> Control de la producción, trazabilidad y liberación de servicios técnicos.
                            </p>
                        </div>
                    </div>

                    <!-- Video 3 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="iso-video-card h-100 d-flex flex-column justify-content-between">
                            <div>
                                <div class="iso-video-header">
                                    <span><i class="fa-solid fa-play text-danger me-2"></i> ISO 9001:2015 - Sesión 3</span>
                                    <span class="badge bg-dark text-warning">HD</span>
                                </div>
                                <div class="ratio ratio-16x9">
                                    <iframe src="https://www.youtube.com/embed/MAtVkeqZOqE" title="Conferencia ISO 9001:2015 en Construcción - Video 3" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" loading="lazy">
                                    </iframe>
                                </div>
                            </div>
                            <p class="iso-video-caption">
                                <i class="fa-solid fa-clipboard-check text-warning me-1"></i> <strong>Auditorías &amp; No Conformidades:</strong> Evaluación del desempeño y planes de acción correctiva.
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             5. MÓDULO DE MATRÍCULA Y PASARELAS DE PAGO (CTA Destacado)
             ========================================================================== -->
        <section class="py-5 bg-white border-top" id="matricula">
            <div class="container py-3">
                
                <div class="iso-enrollment-card">
                    
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold text-uppercase mb-3 shadow-sm">
                        <i class="fa-solid fa-bolt me-1"></i> CAPACITACIÓN ESPECIALIZADA • CLASES GRABADAS
                    </span>

                    <h2 class="display-6 fw-extrabold text-uppercase mb-2 animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); color: #1A1D20;">
                        MATRICÚLATE EN EL CURSO DE ISO 9001:2015
                    </h2>
                    <p class="text-secondary mx-auto mb-4" style="max-width: 740px;">
                        Elige tu canal preferido para solicitar asesoría técnica, descargar el brochure con el temario completo o formalizar tu inscripción online de forma segura.
                    </p>

                    <!-- Beneficios de la Matrícula -->
                    <div class="row g-3 mb-4 text-start justify-content-center">
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="p-3 rounded-3 border bg-light">
                                <i class="fa-solid fa-book-bookmark text-success me-2"></i> <span class="small text-dark fw-bold">Libro Oficial Incluido</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="p-3 rounded-3 border bg-light">
                                <i class="fa-solid fa-circle-play text-success me-2"></i> <span class="small text-dark fw-bold">Clases Grabadas 100% Online</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="p-3 rounded-3 border bg-light">
                                <i class="fa-solid fa-cloud-arrow-down text-success me-2"></i> <span class="small text-dark fw-bold">Acceso inmediato a las clases y disponible 24/7.</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="p-3 rounded-3 border bg-light">
                                <i class="fa-solid fa-certificate text-success me-2"></i> <span class="small text-dark fw-bold">Incluye Diploma.</span>
                            </div>
                        </div>
                    </div>

                    <!-- 4 Botones de Acción -->
                    <div class="row g-3 justify-content-center">
                        
                        <!-- 1. Botón WhatsApp -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <a href="https://api.whatsapp.com/send?phone=51993463118&amp;text=w_%20%20%20%20%20%20Buen%20d%C3%ADa,%20%C2%BFpodr%C3%ADan%20enviarme%20informaci%C3%B3n%20sobre%20el%20curso%20de%20ISO%209001:2015?" target="_blank" rel="noopener noreferrer" class="btn btn-success btn-lg w-100 my-1 btn-iso-action btn-qcs-primary" aria-label="Consultar información del curso ISO 9001 por WhatsApp">
                                <i class="fab fa-whatsapp me-2"></i> Consultar por WhatsApp
                            </a>
                        </div>

                        <!-- 2. Botón Brochure / Ficha Técnica -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <a href="https://docs.google.com/forms/d/e/1FAIpQLSc3XRp6hLYU7PUID_6itflNkwfLgmN5edzLcubjb_r7RPTx3g/viewform" target="_blank" rel="noopener noreferrer" class="btn btn-outline-warning btn-lg w-100 my-1 btn-iso-action text-dark btn-qcs-primary" aria-label="Descargar información y brochure del curso">
                                <i class="fas fa-file-pdf me-2"></i> Info &amp; Brochure
                            </a>
                        </div>

                        <!-- 3. Botón Niubiz / VisaNet -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <a href="https://www.visanetlink.pe/pagoseguro/QUALITYCONSULTINGSOLUTIONS/23074" target="_blank" rel="noopener noreferrer" class="btn btn-lg w-100 my-1 btn-iso-action btn-qcs-primary" aria-label="Pago Seguro con Niubiz y Visa">
                                <i class="fas fa-credit-card me-2"></i> Pago Seguro Niubiz
                            </a>
                        </div>

                        <!-- 4. Botón PayPal Internacional -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <a href="https://www.paypal.com/paypalme/qualityconsulting/140" target="_blank" rel="noopener noreferrer" class="btn btn-dark btn-lg w-100 my-1 btn-iso-action btn-qcs-primary" aria-label="Pagar mediante PayPal">
                                <i class="fab fa-paypal me-2"></i> Pagar con PayPal
                            </a>
                        </div>

                    </div>

                    <!-- Barra de Seguridad y Confianza -->
                    <div class="payment-trust-bar mt-4 pt-3 border-top">
                        <div class="payment-trust-item">
                            <i class="fa-solid fa-lock text-success"></i>
                            <span>Plataforma con Encriptación SSL 256-bit</span>
                        </div>
                        <div class="payment-trust-item">
                            <i class="fa-solid fa-shield-halved text-success"></i>
                            <span>Transacción 100% Segura y Verificada</span>
                        </div>
                        <div class="payment-trust-item">
                            <i class="fa-solid fa-headset text-success"></i>
                            <span>Soporte Académico y Técnico Permanente</span>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             6. LLAMADO A LA ACCIÓN FINAL (Contacto Corporativo)
             ========================================================================== -->
        <section class="cta-banner-section" id="contacto-final">
            <div class="cta-container">
                <div class="cta-box">
                    <div class="cta-content">
                        <span class="cta-tag"><i class="fa-solid fa-certificate"></i> Capacitación y Asesoría ISO</span>
                        <h3 class="animate__animated animate__fadeInUp animate__delay-1s">Fortalece tus sistemas de gestión de calidad auditables y de alto impacto</h3>
                        <p>
                            Programas de capacitación especializada y asesoría técnica para orientar la adopción de la norma ISO 9001:2015 en empresas constructoras, consultoras e industriales.
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
                        <a href="https://api.whatsapp.com/send?phone=51993463118&amp;text=w_%20%20%20%20%20%20Buen%20d%C3%ADa,%20%C2%BFpodr%C3%ADan%20enviarme%20informaci%C3%B3n%20sobre%20el%20curso%20de%20ISO%209001:2015?" target="_blank" rel="noopener noreferrer" class="btn btn-large btn-qcs-dark">
                            <i class="fa-brands fa-whatsapp"></i> Chat WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>
