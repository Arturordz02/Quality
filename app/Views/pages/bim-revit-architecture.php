<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Modelamiento y Diseño BIM con Autodesk Revit Architecture
 * Archivo: app/Views/pages/bim-revit-architecture.php
 */

declare(strict_types=1);
?>
<style>
        body {
            background-color: #F4F5F7;
            color: #e2e8f0;
        }

        /* Hero BIM Workspace 3D / Dark Slate & Cyan */
        .bim-hero-banner {
            position: relative;
            padding: 190px 1.5rem 85px 1.5rem;
            background: linear-gradient(135deg, #0F1113 0%, #1A1D20 45%, #24292E 100%);
            color: #ffffff;
            overflow: hidden;
            border-bottom: 1px solid rgba(229, 168, 19, 0.25);
        }

        .bim-hero-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 75% 25%, rgba(229, 168, 19, 0.25) 0%, transparent 60%),
                        radial-gradient(circle at 20% 75%, rgba(142, 146, 151, 0.15) 0%, transparent 60%);
            pointer-events: none;
        }

        /* Rejilla isométrica sutil de fondo */
        .bim-grid-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-size: 40px 40px;
            background-image: 
                linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            pointer-events: none;
        }

        .bim-viewport-card {
            background: rgba(26, 29, 32, 0.85);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(229, 168, 19, 0.25);
            border-radius: 14px;
            padding: 1.4rem 1.15rem;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
            text-align: left;
            position: relative;
            overflow: hidden;
        }

        .bim-viewport-card:hover {
            transform: translateY(-6px);
            border-color: #E5A813;
            box-shadow: 0 16px 36px rgba(229, 168, 19, 0.25);
        }

        .bim-viewport-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, #E5A813, #E5A813);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .bim-viewport-card:hover::after {
            opacity: 1;
        }

        .bim-viewport-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: rgba(229, 168, 19, 0.25);
            color: #E5A813;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-bottom: 0.85rem;
            border: 1px solid rgba(229, 168, 19, 0.25);
        }

        .bim-viewport-title {
            font-family: var(--font-heading);
            font-size: 1.05rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 0.35rem;
            letter-spacing: 0.5px;
        }

        .bim-viewport-desc {
            font-size: 0.82rem;
            color: #94a3b8;
            line-height: 1.45;
            margin: 0;
        }

        /* Sección Estudio / Layout Asimétrico */
        .bim-studio-card {
            background: #1A1D20;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 2.25rem;
            height: 100%;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
            transition: all var(--transition-normal);
        }

        .bim-studio-card:hover {
            border-color: rgba(229, 168, 19, 0.25);
            box-shadow: 0 16px 40px rgba(229, 168, 19, 0.25);
        }

        .docente-avatar-bim {
            width: 76px;
            height: 76px;
            border-radius: 16px;
            background: linear-gradient(135deg, #C9910D, #1A1D20);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #ffffff;
            border: 2px solid rgba(229, 168, 19, 0.25);
            box-shadow: 0 4px 16px rgba(229, 168, 19, 0.25);
        }

        /* Grid de 10 Fases BIM */
        .bim-modules-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.25rem;
        }

        @media (min-width: 992px) {
            .bim-modules-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .bim-modules-grid {
                grid-template-columns: 1fr;
            }
        }

        .bim-module-item {
            background: #1A1D20;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 1.4rem;
            display: flex;
            align-items: flex-start;
            gap: 1.15rem;
            transition: all 0.3s ease;
        }

        .bim-module-item:hover {
            background: #1A1D20;
            border-color: rgba(229, 168, 19, 0.25);
            transform: translateX(4px);
        }

        .bim-num-badge {
            background: linear-gradient(135deg, #C9910D, #E5A813);
            color: #ffffff;
            font-family: var(--font-heading);
            font-size: 0.82rem;
            font-weight: 800;
            padding: 0.4rem 0.75rem;
            border-radius: 8px;
            flex-shrink: 0;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 12px rgba(8, 145, 178, 0.3);
        }

        .bim-module-title {
            font-family: var(--font-heading);
            font-size: 1.02rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0.35rem;
        }

        .bim-module-desc {
            font-size: 0.85rem;
            color: #94a3b8;
            margin: 0;
            line-height: 1.5;
        }

        /* Sección de Videos */
        .bim-video-card {
            background: #1A1D20;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.35);
            transition: all 0.3s ease;
        }

        .bim-video-card:hover {
            transform: translateY(-5px);
            border-color: rgba(229, 168, 19, 0.25);
            box-shadow: 0 16px 36px rgba(229, 168, 19, 0.25);
        }

        .bim-video-header {
            background: #1A1D20;
            padding: 0.85rem 1.15rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.82rem;
            font-weight: 700;
            color: #e2e8f0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .bim-video-caption {
            padding: 1.1rem;
            font-size: 0.85rem;
            color: #94a3b8;
            margin: 0;
            line-height: 1.45;
        }

        /* Tarjeta Matrícula */
        .bim-enrollment-card {
            background: linear-gradient(135deg, #1A1D20 0%, #1A1D20 100%);
            border: 2px solid rgba(229, 168, 19, 0.25);
            border-radius: 20px;
            padding: 3rem 2.25rem;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.45);
            text-align: center;
        }

        /* Botones de acción */
        .btn-bim-action {
            border-radius: 10px;
            font-family: var(--font-heading);
            font-weight: 700;
            padding: 0.9rem 1.25rem;
            transition: all var(--transition-normal);
        }

        .btn-bim-action:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
        }

        /* ==========================================================
           REAJUSTE DE NAVEGACIÓN: AISLAMIENTO DE BOOTSTRAP 5
           ========================================================== */
                </style>

<main class="page-content">

        <!-- ==========================================================================
             1. HERO DE IMPACTO BIM TECH (Estilo Workspace 3D / Dark Slate & Cyan)
             ========================================================================== -->
        <section class="bim-hero-banner">
            <div class="bim-grid-pattern"></div>
            <div class="container text-center position-relative" style="z-index: 2;">
                
                <!-- Badge Neón Superior Requerido -->
                <div class="mb-3">
                    <span class="badge bg-warning text-dark text-dark px-3 py-2 rounded-pill fw-bold shadow-sm">
                        <i class="fas fa-cube me-2"></i> METODOLOGÍA BIM &amp; VDC | AUTODESK REVIT
                    </span>
                </div>

                <h1 class="display-5 fw-extrabold text-white text-uppercase tracking-wide mb-3 animate__animated animate__fadeInDown" style="font-family: var(--font-heading); font-weight: 800; letter-spacing: 0.5px;">
                    MODELAMIENTO Y DISEÑO BIM CON NUEVOS APPs AUTODESK, REVIT ARCHITECTURE
                </h1>

                <p class="lead text-light opacity-90 mx-auto mb-4" style="max-width: 860px; font-size: 1.15rem; color: #cbd5e1;">
                    Aprende a modelar edificaciones bajo metodología BIM, generando documentación paramétrica, metrados y reportes de alta precisión.
                </p>

                <!-- Display Interactivo de Dimensiones BIM (4 Tarjetas estilo viewport 3D) -->
                <div class="row g-3 justify-content-center mt-2">
                    
                    <!-- Tarjeta 1: Modelado 3D -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="bim-viewport-card">
                            <div class="bim-viewport-icon"><i class="fa-solid fa-cubes"></i></div>
                            <div class="bim-viewport-title">MODELADO 3D</div>
                            <p class="bim-viewport-desc">Componentes de edificación, familias paramétricas y diseño arquitectónico digital.</p>
                        </div>
                    </div>

                    <!-- Tarjeta 2: Documentación -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="bim-viewport-card">
                            <div class="bim-viewport-icon"><i class="fa-solid fa-file-lines"></i></div>
                            <div class="bim-viewport-title">DOCUMENTACIÓN</div>
                            <p class="bim-viewport-desc">Generación automática de planos, plantas, elevaciones, cortes y detalles constructivos.</p>
                        </div>
                    </div>

                    <!-- Tarjeta 3: Cómputos y Tablas -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="bim-viewport-card">
                            <div class="bim-viewport-icon"><i class="fa-solid fa-table-list"></i></div>
                            <div class="bim-viewport-title">CÓMPUTOS Y TABLAS</div>
                            <p class="bim-viewport-desc">Cómputos métricos automáticos, cuantificación de materiales y cuadros de vanos.</p>
                        </div>
                    </div>

                    <!-- Tarjeta 4: Entornos VDC -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="bim-viewport-card">
                            <div class="bim-viewport-icon"><i class="fa-solid fa-network-wired"></i></div>
                            <div class="bim-viewport-title">ENTORNOS VDC</div>
                            <p class="bim-viewport-desc">Optimización, detección de interferencias, interoperabilidad IFC y coordinación multidisciplinaria.</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             2. PERFIL DEL DOCENTE Y OBJETIVO (Layout Asimétrico / Bootstrap Flex Studio)
             ========================================================================== -->
        <section class="py-5" style="background-color: #0F1113;" id="perfil-objetivo">
            <div class="container py-3">
                
                <div class="row g-4 align-items-stretch">
                    
                    <!-- Columna Izquierda: Card Ejecutiva de Rolando Híjar -->
                    <div class="col-12 col-lg-5">
                        <div class="bim-studio-card d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="docente-avatar-bim">
                                        <i class="fa-solid fa-user-gear"></i>
                                    </div>
                                    <div>
                                        <span class="badge bg-warning-subtle text-dark fw-bold text-uppercase px-2 py-1 rounded">
                                            <i class="fa-solid fa-chalkboard-user me-1"></i> Docente Principal
                                        </span>
                                        <h3 class="fw-bold mb-0 text-white mt-1 animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); font-size: 1.35rem;">
                                            ING. ROLANDO HÍJAR
                                        </h3>
                                    </div>
                                </div>

                                <!-- Credenciales / Badges Requeridos -->
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge bg-dark border border-warning-subtle text-warning px-2 py-1">
                                        <i class="fa-solid fa-graduation-cap me-1"></i> Ingeniero Civil (UNI)
                                    </span>
                                    <span class="badge bg-dark border border-warning-subtle text-warning px-2 py-1">
                                        <i class="fa-solid fa-certificate me-1"></i> Certificado VDC - Stanford University
                                    </span>
                                </div>

                                <!-- Bio / Logros Requeridos -->
                                <p class="text-light opacity-90 mb-3" style="font-size: 0.93rem; line-height: 1.65;">
                                    Más de 15 años de experiencia en diseño y gestión de proyectos. Graduado de la Universidad Nacional de Ingeniería (UNI). Director de Prometheus Ingenieros S.A.C. Expositor en la conferencia Techsuyo realizada en Stanford University (2017).
                                </p>

                                <div class="p-3 rounded-3 border-start border-4 border-warning" style="background: rgba(229, 168, 19, 0.25);">
                                    <p class="small text-light mb-0">
                                        <i class="fa-solid fa-microchip text-warning me-1"></i> Especialista en implementación BIM/VDC y automatización de procesos constructivos para proyectos de gran escala.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Columna Derecha: Objetivo General + Card de Metodología VDC + Imagen -->
                    <div class="col-12 col-lg-7">
                        <div class="bim-studio-card d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <span class="badge bg-warning text-dark text-dark fw-bold text-uppercase px-2 py-1 rounded">
                                        <i class="fa-solid fa-bullseye me-1"></i> Propósito &amp; Competencias BIM
                                    </span>
                                </div>

                                <h3 class="fw-bold mb-3 text-white animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading);">
                                    OBJETIVO DEL CURSO
                                </h3>

                                <p class="text-light opacity-90 mb-3" style="font-size: 0.95rem; line-height: 1.65;">
                                    Capacitar a los participantes en el aprendizaje práctico de Autodesk Revit Architecture aplicado a edificaciones, identificando alternativas directas de mejora de la productividad en obra y dominando los flujos de trabajo de la metodología Virtual Design and Construction (VDC).
                                </p>
                            </div>

                            <!-- Visualizador de Imagen Arquitectónica -->
                            <div class="mt-2 text-center">
                                <!-- Imagen conceptual sobre modelado BIM y arquitectura en Revit -->
                                <picture>
                                    <source srcset="img/BIM1.webp" type="image/webp">
                                    <img src="img/BIM1.png" alt="Modelado BIM y diseño de arquitectura en Autodesk Revit" class="img-fluid rounded-4 shadow-lg mb-0 border border-secondary border-opacity-25" loading="lazy" style="max-height: 240px; width: 100%; object-fit: cover;">
                                </picture>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             3. CONTENIDOS DEL CURSO (Grid Modular de 10 Tarjetas de Modelado 3D)
             ========================================================================== -->
        <section class="py-5" style="background-color: #0F1113; border-top: 1px solid rgba(255, 255, 255, 0.08); border-bottom: 1px solid rgba(255, 255, 255, 0.08);" id="temario">
            <div class="container py-3">
                
                <div class="text-center mb-5">
                    <span class="badge bg-warning text-dark text-dark px-3 py-2 rounded-pill fw-bold text-uppercase mb-2 shadow-sm">
                        <i class="fa-solid fa-cubes-stacked me-1"></i> Plan de Estudios por Fases
                    </span>
                    <h2 class="fw-extrabold text-uppercase text-white animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); letter-spacing: 0.5px;">
                        ESTRUCTURA Y TEMARIO DEL PROGRAMA BIM
                    </h2>
                    <div class="title-underline mx-auto" style="background: #E5A813;"></div>
                    <p class="text-light opacity-75 mx-auto mt-3" style="max-width: 780px;">
                        10 fases modulares progresivas que abarcan desde el entorno de trabajo inicial y modelado volumétrico hasta la documentación ejecutiva y exportación interoperable.
                    </p>
                </div>

                <!-- Grid de 10 Módulos BIM -->
                <div class="bim-modules-grid">
                    
                    <!-- Fase 01 -->
                    <div class="bim-module-item">
                        <span class="bim-num-badge">01</span>
                        <div>
                            <h3 class="bim-module-title animate__animated animate__fadeInUp animate__delay-1s">Introducción y Conceptos Fundamentales</h3>
                            <p class="bim-module-desc">Diferencias clave entre CAD tradicional y Metodología BIM. Interfaz, configuración de unidades y navegación en Autodesk Revit.</p>
                        </div>
                    </div>

                    <!-- Fase 02 -->
                    <div class="bim-module-item">
                        <span class="bim-num-badge">02</span>
                        <div>
                            <h3 class="bim-module-title animate__animated animate__fadeInUp animate__delay-1s">Iniciando un Proyecto</h3>
                            <p class="bim-module-desc">Creación de plantillas arquitectónicas, definición de niveles de edificación y trazado de rejillas/ejes estructurales.</p>
                        </div>
                    </div>

                    <!-- Fase 03 -->
                    <div class="bim-module-item">
                        <span class="bim-num-badge">03</span>
                        <div>
                            <h3 class="bim-module-title animate__animated animate__fadeInUp animate__delay-1s">Herramientas Básicas de Modelado</h3>
                            <p class="bim-module-desc">Modelado paramétrico de muros arquitectónicos, suelos, cubiertas, techos y componentes volumétricos base.</p>
                        </div>
                    </div>

                    <!-- Fase 04 -->
                    <div class="bim-module-item">
                        <span class="bim-num-badge">04</span>
                        <div>
                            <h3 class="bim-module-title animate__animated animate__fadeInUp animate__delay-1s">Acotado y Restricciones</h3>
                            <p class="bim-module-desc">Alineación, cotas temporales y permanentes, restricciones geométricas y parametrización de elementos constructivos.</p>
                        </div>
                    </div>

                    <!-- Fase 05 -->
                    <div class="bim-module-item">
                        <span class="bim-num-badge">05</span>
                        <div>
                            <h3 class="bim-module-title animate__animated animate__fadeInUp animate__delay-1s">Componentes de la Edificación</h3>
                            <p class="bim-module-desc">Inserción y edición de puertas, ventanas, escaleras, barandillas, rampas y diseño de muros cortina avanzados.</p>
                        </div>
                    </div>

                    <!-- Fase 06 -->
                    <div class="bim-module-item">
                        <span class="bim-num-badge">06</span>
                        <div>
                            <h3 class="bim-module-title animate__animated animate__fadeInUp animate__delay-1s">Reportes y Tablas de Cómputos Métricos</h3>
                            <p class="bim-module-desc">Generación automática de tablas de planificación, cuadros de vanos, metrados de materiales y exportación de datos.</p>
                        </div>
                    </div>

                    <!-- Fase 07 -->
                    <div class="bim-module-item">
                        <span class="bim-num-badge">07</span>
                        <div>
                            <h3 class="bim-module-title animate__animated animate__fadeInUp animate__delay-1s">Detalles y Vistas del Dibujo</h3>
                            <p class="bim-module-desc">Creación de secciones longitudinales/transversales, llamadas de detalle (Callouts), vistas 3D seccionadas y renderizado.</p>
                        </div>
                    </div>

                    <!-- Fase 08 -->
                    <div class="bim-module-item">
                        <span class="bim-num-badge">08</span>
                        <div>
                            <h3 class="bim-module-title animate__animated animate__fadeInUp animate__delay-1s">Anotaciones y Etiquetado Paramétrico</h3>
                            <p class="bim-module-desc">Textos inteligentes, etiquetas paramétricas de elementos, cotas de elevación y simbología técnica estandarizada.</p>
                        </div>
                    </div>

                    <!-- Fase 09 -->
                    <div class="bim-module-item">
                        <span class="bim-num-badge">09</span>
                        <div>
                            <h3 class="bim-module-title animate__animated animate__fadeInUp animate__delay-1s">Presentación y Documentación</h3>
                            <p class="bim-module-desc">Composición de láminas profesionales, membretes personalizados, escalas gráficas y configuración de impresión en PDF/DWG.</p>
                        </div>
                    </div>

                    <!-- Fase 10 -->
                    <div class="bim-module-item">
                        <span class="bim-num-badge">10</span>
                        <div>
                            <h3 class="bim-module-title animate__animated animate__fadeInUp animate__delay-1s">Exportación e Interoperabilidad</h3>
                            <p class="bim-module-desc">Exportación a formato IFC para OpenBIM, vinculación con archivos CAD (DWG/DXF) y preparación para entornos colaborativos Autodesk.</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             4. SHOWCASE MULTIMEDIA (Grid de 3 Videos Promocionales de YouTube)
             ========================================================================== -->
        <section class="py-5" style="background-color: #0F1113;" id="tutoriales-bim">
            <div class="container py-3">
                
                <div class="text-center mb-5">
                    <span class="badge bg-danger text-white px-3 py-2 rounded-pill fw-bold text-uppercase mb-2 shadow-sm">
                        <i class="fa-brands fa-youtube me-1"></i> Sesiones y Demostraciones
                    </span>
                    <h2 class="fw-extrabold text-uppercase text-white animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading);">
                        TUTORIALES Y DEMOSTRACIONES EN REVIT ARCHITECTURE
                    </h2>
                    <div class="title-underline mx-auto" style="background: #ef4444;"></div>
                    <p class="text-light opacity-75 mx-auto mt-3" style="max-width: 760px;">
                        Aprende con las demostraciones prácticas del Ing. Rolando Híjar sobre el modelado de elementos, metrados y flujos de trabajo VDC.
                    </p>
                </div>

                <!-- Grid de 3 Videos de YouTube -->
                <div class="row g-4">
                    
                    <!-- Video 1 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="bim-video-card h-100 d-flex flex-column justify-content-between">
                            <div>
                                <div class="bim-video-header">
                                    <span><i class="fa-solid fa-play text-danger me-2"></i> Revit Architecture - Demo 1</span>
                                    <span class="badge bg-dark text-warning border border-warning-subtle">HD</span>
                                </div>
                                <div class="ratio ratio-16x9">
                                    <iframe src="https://www.youtube.com/embed/2Aipb6erJ60" title="Tutorial Revit Architecture - Video 1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" loading="lazy">
                                    </iframe>
                                </div>
                            </div>
                            <p class="bim-video-caption">
                                <i class="fa-solid fa-cube text-warning me-1"></i> <strong>Modelado de Componentes:</strong> Configuración de muros, niveles y elementos paramétricos en Revit.
                            </p>
                        </div>
                    </div>

                    <!-- Video 2 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="bim-video-card h-100 d-flex flex-column justify-content-between">
                            <div>
                                <div class="bim-video-header">
                                    <span><i class="fa-solid fa-play text-danger me-2"></i> Revit Architecture - Demo 2</span>
                                    <span class="badge bg-dark text-warning border border-warning-subtle">HD</span>
                                </div>
                                <div class="ratio ratio-16x9">
                                    <iframe src="https://www.youtube.com/embed/OjxNmWthb9Q" title="Tutorial Revit Architecture - Video 2" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" loading="lazy">
                                    </iframe>
                                </div>
                            </div>
                            <p class="bim-video-caption">
                                <i class="fa-solid fa-layer-group text-warning me-1"></i> <strong>Detalles y Cortes:</strong> Creación de vistas arquitectónicas y documentación técnica de alta precisión.
                            </p>
                        </div>
                    </div>

                    <!-- Video 3 -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="bim-video-card h-100 d-flex flex-column justify-content-between">
                            <div>
                                <div class="bim-video-header">
                                    <span><i class="fa-solid fa-play text-danger me-2"></i> Revit Architecture - Demo 3</span>
                                    <span class="badge bg-dark text-warning border border-warning-subtle">HD</span>
                                </div>
                                <div class="ratio ratio-16x9">
                                    <iframe src="https://www.youtube.com/embed/-Wv5qdz2DNc" title="Tutorial Revit Architecture - Video 3" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" loading="lazy">
                                    </iframe>
                                </div>
                            </div>
                            <p class="bim-video-caption">
                                <i class="fa-solid fa-table text-warning me-1"></i> <strong>Tablas y Cómputos:</strong> Extracción automatizada de metrados de obra y cuadros de vanos.
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             5. MÓDULO DE MATRÍCULA Y PASARELAS DE PAGO (CTA Destacado)
             ========================================================================== -->
        <section class="py-5" style="background-color: #0F1113; border-top: 1px solid rgba(255, 255, 255, 0.08);" id="matricula">
            <div class="container py-3">
                
                <div class="bim-enrollment-card">
                    
                    <span class="badge bg-warning text-dark text-dark px-3 py-2 rounded-pill fw-bold text-uppercase mb-3 shadow-sm">
                        <i class="fa-solid fa-bolt me-1"></i> CURSO ESPECIALIZADO • MODALIDAD ONLINE
                    </span>

                    <h2 class="display-6 fw-extrabold text-white text-uppercase mb-2 animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading);">
                        MATRICÚLATE EN EL CURSO DE BIM REVIT ARCHITECTURE
                    </h2>
                    <p class="text-light opacity-75 mx-auto mb-4" style="max-width: 740px;">
                        Elige tu canal preferido para solicitar asesoría técnica, descargar el brochure con el temario completo o formalizar tu matrícula de forma segura.
                    </p>

                    <!-- Beneficios de la Matrícula -->
                    <div class="row g-3 mb-4 text-start justify-content-center">
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="p-3 rounded-3 border border-secondary border-opacity-25" style="background: rgba(255, 255, 255, 0.03);">
                                <i class="fa-solid fa-circle-play text-warning me-2"></i> <span class="small text-light">Clases Grabadas 100% Online</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="p-3 rounded-3 border border-secondary border-opacity-25" style="background: rgba(255, 255, 255, 0.03);">
                                <i class="fa-solid fa-cloud-arrow-down text-warning me-2"></i> <span class="small text-light">Acceso a Grabaciones HD 24/7</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="p-3 rounded-3 border border-secondary border-opacity-25" style="background: rgba(255, 255, 255, 0.03);">
                                <i class="fa-solid fa-certificate text-warning me-2"></i> <span class="small text-light">Diploma de Acreditación Oficial</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="p-3 rounded-3 border border-secondary border-opacity-25" style="background: rgba(255, 255, 255, 0.03);">
                                <i class="fa-solid fa-briefcase text-warning me-2"></i> <span class="small text-light">Bolsa Laboral &amp; Red de Contactos</span>
                            </div>
                        </div>
                    </div>

                    <!-- 4 Botones de Acción de Alto Contraste -->
                    <div class="row g-3 justify-content-center">
                        
                        <!-- 1. Botón WhatsApp -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <a href="https://api.whatsapp.com/send?phone=51993463118&amp;text=w_%20%20%20%20%20%20Buen%20d%C3%ADa,%20%C2%BFpodr%C3%ADan%20enviarme%20informaci%C3%B3n%20sobre%20el%20curso%20de%20BIM%20Revit%20Architecture?" target="_blank" rel="noopener noreferrer" class="btn btn-success btn-lg w-100 my-1 btn-bim-action btn-qcs-primary" aria-label="Consultar información del curso BIM Revit Architecture por WhatsApp">
                                <i class="fab fa-whatsapp me-2"></i> Consultar por WhatsApp
                            </a>
                        </div>

                        <!-- 2. Botón Brochure / Ficha Técnica -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <a href="https://docs.google.com/forms/d/e/1FAIpQLSen65_jeSMSK7PYK7vwM_S0IR_XCdm-XBUiWWE4gqeKSPLLNw/viewform" target="_blank" rel="noopener noreferrer" class="btn btn-qcs-dark btn-lg w-100 my-1 btn-bim-action btn-qcs-primary" aria-label="Descargar información y brochure del curso">
                                <i class="fas fa-file-pdf me-2"></i> Info &amp; Brochure
                            </a>
                        </div>

                        <!-- 3. Botón Niubiz PagoLink -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <a href="https://www.visanetlink.pe/pagoseguro/QUALITYCONSULTINGSOLUTIONS/58218" target="_blank" rel="noopener noreferrer" class="btn btn-lg w-100 my-1 btn-bim-action btn-qcs-primary" aria-label="Pago Seguro con Niubiz y Visa">
                                <i class="fas fa-credit-card me-2"></i> Pago Seguro Niubiz
                            </a>
                        </div>

                        <!-- 4. Botón PayPal Internacional -->
                        <div class="col-12 col-md-6 col-lg-3">
                            <a href="https://www.paypal.com/paypalme/qualityconsulting/135" target="_blank" rel="noopener noreferrer" class="btn btn-dark btn-lg w-100 my-1 btn-bim-action border border-secondary btn-qcs-primary" aria-label="Pagar mediante PayPal">
                                <i class="fab fa-paypal me-2"></i> Pagar con PayPal
                            </a>
                        </div>

                    </div>

                    <!-- Barra de Seguridad y Confianza -->
                    <div class="payment-trust-bar mt-4 pt-3 border-top border-secondary border-opacity-25">
                        <div class="payment-trust-item text-light">
                            <i class="fa-solid fa-lock text-warning"></i>
                            <span>Plataforma con Encriptación SSL 256-bit</span>
                        </div>
                        <div class="payment-trust-item text-light">
                            <i class="fa-solid fa-shield-halved text-warning"></i>
                            <span>Transacción 100% Segura y Verificada</span>
                        </div>
                        <div class="payment-trust-item text-light">
                            <i class="fa-solid fa-headset text-warning"></i>
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
                        <span class="cta-tag"><i class="fa-solid fa-cube"></i> Capacitación y Asesoría BIM</span>
                        <h3 class="animate__animated animate__fadeInUp animate__delay-1s">Transforma la gestión de proyectos con metodología BIM y VDC</h3>
                        <p>
                            Programas de capacitación especializada y asesoría técnica para orientar la adopción de estándares BIM en empresas de arquitectura, ingeniería y construcción.
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
                        <a href="https://api.whatsapp.com/send?phone=51993463118&amp;text=w_%20%20%20%20%20%20Buen%20d%C3%ADa,%20%C2%BFpodr%C3%ADan%20enviarme%20informaci%C3%B3n%20sobre%20el%20curso%20de%20BIM%20Revit%20Architecture?" target="_blank" rel="noopener noreferrer" class="btn btn-large btn-qcs-dark">
                            <i class="fa-brands fa-whatsapp"></i> Chat WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>
