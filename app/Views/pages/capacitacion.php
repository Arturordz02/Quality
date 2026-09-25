<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Capacitación Ejecutiva y Programas de Especialización
 * Archivo: app/Views/pages/capacitacion.php
 */

declare(strict_types=1);
?>
<style>
        body {
            background-color: var(--qcs-bg-light);
            color: #1e293b;
        }

        /* ----------------------------------------------------
           1. HERO CAPACITACIÓN / ED-TECH
           ---------------------------------------------------- */
        .edtech-hero-banner {
            position: relative;
            padding: 190px 1.5rem 85px 1.5rem;
            background: linear-gradient(145deg, #0F1113 0%, #1A1D20 50%, #24292E 100%);
            color: #ffffff;
            overflow: hidden;
            border-bottom: 4px solid var(--accent-gold);
        }

        .edtech-hero-banner::before {
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

        .edtech-hero-pattern {
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

        .edtech-hero-title {
            font-family: var(--font-heading);
            font-weight: 900;
            font-size: clamp(2rem, 4.2vw, 3.3rem);
            letter-spacing: -0.5px;
            color: #ffffff;
            margin-bottom: 1.25rem;
            text-shadow: 0 4px 16px rgba(0, 0, 0, 0.35);
        }

        .edtech-hero-subtitle {
            font-family: var(--font-body);
            font-size: clamp(1.05rem, 1.8vw, 1.25rem);
            color: #e2e8f0;
            max-width: 860px;
            margin: 0 auto;
            line-height: 1.8;
        }

        /* ----------------------------------------------------
           2. GARANTÍA DE VALOR (Value Grid)
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

        /* ----------------------------------------------------
           3. GRID DEL CATÁLOGO DE CURSOS (Ed-Tech Cards)
           ---------------------------------------------------- */
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
            height: 200px;
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
            font-size: 0.75rem;
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
            font-size: 1.15rem;
            color: var(--qcs-dark-slate);
            margin-bottom: 0.65rem;
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
            padding-top: 0.5rem;
            border-top: 1px dashed #e2e8f0;
        }

        /* ----------------------------------------------------
           4. BANNER CTA
           ---------------------------------------------------- */
        .edtech-cta-banner {
            background: linear-gradient(145deg, #0F1113 0%, #1A1D20 50%, #24292E 100%);
            border-radius: 24px;
            padding: 3.5rem 2.5rem;
            color: #ffffff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 45px rgba(15, 17, 19, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .edtech-cta-banner::before {
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
             1. HERO CAPACITACIÓN / ED-TECH
             ========================================================================== -->
        <section class="edtech-hero-banner text-center">
            <div class="edtech-hero-pattern"></div>
            <div class="container position-relative">
                
                <!-- Badge Superior -->
                <div class="d-inline-block mb-3">
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-2 shadow-sm">
                        <i class="fas fa-graduation-cap me-2"></i> ED-TECH &amp; CAPACITACIÓN EJECUTIVA
                    </span>
                </div>

                <!-- Título Principal -->
                <h1 class="edtech-hero-title animate__animated animate__fadeInDown">
                    PROGRAMAS DE ESPECIALIZACIÓN PROFESIONAL
                </h1>

                <!-- Subtítulo / Párrafo Introductorio -->
                <p class="edtech-hero-subtitle">
                    Desarrolla competencias clave en dirección de proyectos, contratos FIDIC, gerencia de calidad, BIM y valor ganado. Clases grabadas en línea con docentes líderes de la industria.
                </p>

                <!-- Filtros rápidos -->
                <div class="d-flex justify-content-center flex-wrap gap-2 mt-4">
                    <span class="badge bg-light bg-opacity-25 text-white px-3 py-2 rounded-pill font-montserrat fw-semibold">
                        <i class="fa-solid fa-gavel me-1 text-warning"></i> Contratos FIDIC &amp; NEC
                    </span>
                    <span class="badge bg-light bg-opacity-25 text-white px-3 py-2 rounded-pill font-montserrat fw-semibold">
                        <i class="fa-solid fa-cube me-1 text-warning"></i> BIM Revit Architecture
                    </span>
                    <span class="badge bg-light bg-opacity-25 text-white px-3 py-2 rounded-pill font-montserrat fw-semibold">
                        <i class="fa-solid fa-chart-line me-1 text-success"></i> Valor Ganado &amp; PMO
                    </span>
                    <span class="badge bg-light bg-opacity-25 text-white px-3 py-2 rounded-pill font-montserrat fw-semibold">
                        <i class="fa-solid fa-certificate me-1 text-warning"></i> ISO 9001:2015
                    </span>
                </div>

            </div>
        </section>

        <!-- ==========================================================================
             2. GARANTÍA DE VALOR (Beneficios Académicos)
             ========================================================================== -->
        <section class="py-5">
            <div class="container">
                <div class="row g-4">
                    
                    <div class="col-lg-3 col-md-6">
                        <div class="value-guarantee-card rounded-4 border-start border-4 border-warning" data-aos="fade-right">
                            <div class="value-icon"><i class="fa-solid fa-circle-play text-dark"></i></div>
                            <h4 class="fw-bold font-montserrat fs-6 text-dark">Clases Grabadas 100% Online</h4>
                            <p class="small text-muted mb-0">Acceso inmediato a las clases y disponible 24/7.</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="value-guarantee-card rounded-4 border-start border-4 border-warning" data-aos="fade-up">
                            <div class="value-icon"><i class="fa-solid fa-cloud-arrow-down text-success"></i></div>
                            <h4 class="fw-bold font-montserrat fs-6 text-dark">Acceso 24/7</h4>
                            <p class="small text-muted mb-0">Acceso inmediato a las clases y disponible 24/7.</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="value-guarantee-card rounded-4 border-start border-4 border-warning" data-aos="fade-left">
                            <div class="value-icon"><i class="fa-solid fa-certificate text-warning"></i></div>
                            <h4 class="fw-bold font-montserrat fs-6 text-dark">Diploma de Acreditación</h4>
                            <p class="small text-muted mb-0">Certificado oficial con horas académicas y código único de validación.</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="value-guarantee-card rounded-4 border-start border-4 border-warning" data-aos="fade-right">
                            <div class="value-icon"><i class="fa-solid fa-briefcase text-warning"></i></div>
                            <h4 class="fw-bold font-montserrat fs-6 text-dark">Bolsa de Trabajo</h4>
                            <p class="small text-muted mb-0">Conexión con empresas líderes del sector para oportunidades laborales.</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- ==========================================================================
             3. CATÁLOGO COMPLETO DE CURSOS (Grid 3 Columnas)
             ========================================================================== -->
        <section class="pb-5">
            <div class="container">
                
                <div class="text-center mb-5">
                    <span class="badge bg-warning-subtle text-dark fw-bold px-3 py-2 rounded-pill text-uppercase mb-2">
                        <i class="fa-solid fa-book-open-reader me-1"></i> Especializaciones
                    </span>
                    <h2 class="fw-extrabold font-montserrat text-dark display-6 mb-2 animate__animated animate__fadeInUp animate__delay-1s" style="font-weight: 800;">
                        CATÁLOGO DE CURSOS EJECUTIVOS
                    </h2>
                    <p class="text-muted mx-auto" style="max-width: 720px;">
                        Selecciona el programa que necesitas para fortalecer tu perfil profesional o el rendimiento de tu equipo técnico.
                    </p>
                </div>

                <div class="row g-4">
                    
                    <!-- 1. FIDIC -->
                    <div class="col-lg-4 col-md-6">
                        <div class="course-card rounded-4 border-start border-4 border-warning" data-aos="fade-up">
                            <div class="course-card-img-wrap">
                                <span class="course-badge bg-dark text-warning border border-warning-subtle text-white">CONTRATOS</span>
                                <picture>
                                    <source srcset="img/Index-Contratos-Internacionales.webp" type="image/webp">
                                    <img src="img/Index-Contratos-Internacionales.png" alt="Contratos Internacionales FIDIC" class="course-card-img" loading="lazy">
                                </picture>
                            </div>
                            <div class="course-card-body">
                                <div>
                                    <h3 class="course-card-title animate__animated animate__fadeInUp animate__delay-1s">Contratos Internacionales FIDIC</h3>
                                    <p class="course-card-desc">Administración de reclamos, cláusulas estándar y resolución de disputas en obras internacionales.</p>
                                    <div class="course-instructor"><i class="fa-solid fa-user-tie text-dark"></i> Consultores Especialistas FIDIC</div>
                                </div>
                                <div>
                                    <a href="/fidic" class="btn btn-sm w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="background-color: var(--qcs-yellow); color: var(--qcs-black); border-color: var(--qcs-yellow);">Ver Programa Completo <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. PMO -->
                    <div class="col-lg-4 col-md-6">
                        <div class="course-card rounded-4 border-start border-4 border-warning" data-aos="fade-left">
                            <div class="course-card-img-wrap">
                                <span class="course-badge bg-success text-white">PMO</span>
                                <picture>
                                    <source srcset="img/Index-GestionPMO.webp" type="image/webp">
                                    <img src="img/Index-GestionPMO.png" alt="Gestión de la PMO" class="course-card-img" loading="lazy">
                                </picture>
                            </div>
                            <div class="course-card-body">
                                <div>
                                    <h3 class="course-card-title animate__animated animate__fadeInUp animate__delay-1s">Gestión de la PMO</h3>
                                    <p class="course-card-desc">Diseño, implementación y gobernanza de Oficinas de Gestión de Proyectos en empresas de ingeniería.</p>
                                    <div class="course-instructor"><i class="fa-solid fa-user-tie text-success"></i> Expertos en Gobernanza PMO</div>
                                </div>
                                <div>
                                    <a href="/pmo" class="btn btn-sm w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="background-color: var(--qcs-yellow); color: var(--qcs-black); border-color: var(--qcs-yellow);">Ver Programa Completo <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Gerencia de Calidad -->
                    <div class="col-lg-4 col-md-6">
                        <div class="course-card rounded-4 border-start border-4 border-warning" data-aos="fade-right">
                            <div class="course-card-img-wrap">
                                <span class="course-badge bg-warning text-dark">CALIDAD</span>
                                <picture>
                                    <source srcset="img/Index-GerenciaCalidadObras.webp" type="image/webp">
                                    <img src="img/Index-GerenciaCalidadObras.png" alt="Gerencia de la Calidad para la Infraestructura" class="course-card-img" loading="lazy">
                                </picture>
                            </div>
                            <div class="course-card-body">
                                <div>
                                    <h3 class="course-card-title animate__animated animate__fadeInUp animate__delay-1s">Gerencia de la Calidad para la Infraestructura</h3>
                                    <p class="course-card-desc">Control de aseguramiento, planes de inspección y ensayos (PIE) y auditorías en megaproyectos.</p>
                                    <div class="course-instructor"><i class="fa-solid fa-user-tie text-warning"></i> Auditores Líderes IRCA</div>
                                </div>
                                <div>
                                    <a href="/gerencia-de-calidad" class="btn btn-sm w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="background-color: var(--qcs-yellow); color: var(--qcs-black); border-color: var(--qcs-yellow);">Ver Programa Completo <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Valor Ganado -->
                    <div class="col-lg-4 col-md-6">
                        <div class="course-card rounded-4 border-start border-4 border-warning" data-aos="fade-up">
                            <div class="course-card-img-wrap">
                                <span class="course-badge bg-warning text-dark text-dark">CONTROL</span>
                                <picture>
                                    <source srcset="img/Index_ValorGanado.webp" type="image/webp">
                                    <img src="img/Index_ValorGanado.png" alt="Método del Valor Ganado (EVM)" class="course-card-img" loading="lazy">
                                </picture>
                            </div>
                            <div class="course-card-body">
                                <div>
                                    <h3 class="course-card-title animate__animated animate__fadeInUp animate__delay-1s">Avance de Obra con Método del Valor Ganado</h3>
                                    <p class="course-card-desc">Control de costo y cronograma mediante índices SPI, CPI y proyecciones EAC de alta precisión.</p>
                                    <div class="course-instructor"><i class="fa-solid fa-user-tie text-warning"></i> Project Controls Specialists</div>
                                </div>
                                <div>
                                    <a href="/valor-ganado" class="btn btn-sm w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="background-color: var(--qcs-yellow); color: var(--qcs-black); border-color: var(--qcs-yellow);">Ver Programa Completo <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 5. BIM Revit Architecture -->
                    <div class="col-lg-4 col-md-6">
                        <div class="course-card rounded-4 border-start border-4 border-warning" data-aos="fade-left">
                            <div class="course-card-img-wrap">
                                <span class="course-badge bg-dark text-warning border border-warning-subtle text-white">BIM</span>
                                <picture>
                                    <source srcset="img/Index-BIMRevitArchitecture.webp" type="image/webp">
                                    <img src="img/Index-BIMRevitArchitecture.png" alt="BIM Revit Architecture" class="course-card-img" loading="lazy">
                                </picture>
                            </div>
                            <div class="course-card-body">
                                <div>
                                    <h3 class="course-card-title animate__animated animate__fadeInUp animate__delay-1s">BIM Revit Architecture</h3>
                                    <p class="course-card-desc">Modelado 3D, coordinación de interferencias y estándares del Plan BIM Perú para proyectos de edificación.</p>
                                    <div class="course-instructor"><i class="fa-solid fa-user-tie text-dark"></i> BIM Managers Certificados</div>
                                </div>
                                <div>
                                    <a href="/bim-revit-architecture" class="btn btn-sm w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="background-color: var(--qcs-yellow); color: var(--qcs-black); border-color: var(--qcs-yellow);">Ver Programa Completo <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 6. ISO 9001:2015 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="course-card rounded-4 border-start border-4 border-warning" data-aos="fade-right">
                            <div class="course-card-img-wrap">
                                <span class="course-badge bg-warning text-dark">ISO</span>
                                <picture>
                                    <source srcset="img/ISO1.webp" type="image/webp">
                                    <img src="img/ISO1.png" alt="ISO 9001:2015 para la Construcción" class="course-card-img" loading="lazy">
                                </picture>
                            </div>
                            <div class="course-card-body">
                                <div>
                                    <h3 class="course-card-title animate__animated animate__fadeInUp animate__delay-1s">ISO 9001:2015 para la Construcción</h3>
                                    <p class="course-card-desc">Implementación y auditoría interna de sistemas de gestión de calidad en obras y oficinas centrales.</p>
                                    <div class="course-instructor"><i class="fa-solid fa-user-tie text-warning"></i> Auditores ISO 9001</div>
                                </div>
                                <div>
                                    <a href="/iso-9001" class="btn btn-sm w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="background-color: var(--qcs-yellow); color: var(--qcs-black); border-color: var(--qcs-yellow);">Ver Programa Completo <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 7. Oficina Técnica -->
                    <div class="col-lg-4 col-md-6">
                        <div class="course-card rounded-4 border-start border-4 border-warning" data-aos="fade-up">
                            <div class="course-card-img-wrap">
                                <span class="course-badge bg-secondary text-white">OFICINA TÉCNICA</span>
                                <picture>
                                    <source srcset="img/Index-OficinaTecnicaObras.webp" type="image/webp">
                                    <img src="img/Index-OficinaTecnicaObras.png" alt="Oficina Técnica Obras Privadas y Públicas" class="course-card-img" loading="lazy">
                                </picture>
                            </div>
                            <div class="course-card-body">
                                <div>
                                    <h3 class="course-card-title animate__animated animate__fadeInUp animate__delay-1s">Oficina Técnica Obras Privadas y Públicas</h3>
                                    <p class="course-card-desc">Control documentario, valorizaciones, metrados, RFI y submittals en la administración de proyectos.</p>
                                    <div class="course-instructor"><i class="fa-solid fa-user-tie text-secondary"></i> Jefes de Oficina Técnica</div>
                                </div>
                                <div>
                                    <a href="/oficina-tecnica" class="btn btn-sm w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="background-color: var(--qcs-yellow); color: var(--qcs-black); border-color: var(--qcs-yellow);">Ver Programa Completo <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 8. Herramientas de Calidad -->
                    <div class="col-lg-4 col-md-6">
                        <div class="course-card rounded-4 border-start border-4 border-warning" data-aos="fade-left">
                            <div class="course-card-img-wrap">
                                <span class="course-badge bg-warning text-dark text-dark">HERRAMIENTAS</span>
                                <picture>
                                    <source srcset="img/GERCA1.webp" type="image/webp">
                                    <img src="img/GERCA1.png" alt="Herramientas de Calidad para la Construcción" class="course-card-img" loading="lazy">
                                </picture>
                            </div>
                            <div class="course-card-body">
                                <div>
                                    <h3 class="course-card-title animate__animated animate__fadeInUp animate__delay-1s">Herramientas de Calidad para la Construcción</h3>
                                    <p class="course-card-desc">Pareto, Ishikawa, 5 Porqués, matrices de no conformidades y control estadístico de procesos en obra.</p>
                                    <div class="course-instructor"><i class="fa-solid fa-user-tie text-warning"></i> Especialistas Lean Six Sigma</div>
                                </div>
                                <div>
                                    <a href="/herramientas" class="btn btn-sm w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="background-color: var(--qcs-yellow); color: var(--qcs-black); border-color: var(--qcs-yellow);">Ver Programa Completo <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 9. Proyectos PMI -->
                    <div class="col-lg-4 col-md-6">
                        <div class="course-card rounded-4 border-start border-4 border-warning" data-aos="fade-right">
                            <div class="course-card-img-wrap">
                                <span class="course-badge bg-dark text-warning border border-warning-subtle text-white">PMI</span>
                                <picture>
                                    <source srcset="img/Index-RiesgosPMI.webp" type="image/webp">
                                    <img src="img/Index-RiesgosPMI.png" alt="Gestión de Proyectos con Enfoque PMI" class="course-card-img" loading="lazy">
                                </picture>
                            </div>
                            <div class="course-card-body">
                                <div>
                                    <h3 class="course-card-title animate__animated animate__fadeInUp animate__delay-1s">Gestión de Proyectos con Enfoque PMI</h3>
                                    <p class="course-card-desc">Dirección estratégica basada en la Guía del PMBOK®: integración, alcance, tiempo, costo y riesgos.</p>
                                    <div class="course-instructor"><i class="fa-solid fa-user-tie text-dark"></i> Project Management Professionals PMP®</div>
                                </div>
                                <div>
                                    <a href="/proyectos-pmi" class="btn btn-sm w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="background-color: var(--qcs-yellow); color: var(--qcs-black); border-color: var(--qcs-yellow);">Ver Programa Completo <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 10. Contratos -->
                    <div class="col-lg-4 col-md-6">
                        <div class="course-card rounded-4 border-start border-4 border-warning" data-aos="fade-up">
                            <div class="course-card-img-wrap">
                                <span class="course-badge bg-dark text-white">CONTRATOS</span>
                                <picture>
                                    <source srcset="img/nec1.webp" type="image/webp">
                                    <img src="img/nec1.png" alt="Gestión Contractual en Construcción" class="course-card-img" loading="lazy">
                                </picture>
                            </div>
                            <div class="course-card-body">
                                <div>
                                    <h3 class="course-card-title animate__animated animate__fadeInUp animate__delay-1s">Gestión Contractual en Construcción</h3>
                                    <p class="course-card-desc">Estrategias legales y técnicas para la administración eficiente de contratos y mitigación de reclamos.</p>
                                    <div class="course-instructor"><i class="fa-solid fa-user-tie text-dark"></i> Abogados &amp; Ingenieros Contractuales</div>
                                </div>
                                <div>
                                    <a href="/contratos" class="btn btn-sm w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="background-color: var(--qcs-yellow); color: var(--qcs-black); border-color: var(--qcs-yellow);">Ver Programa Completo <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 11. Contratos Estado -->
                    <div class="col-lg-4 col-md-6">
                        <div class="course-card rounded-4 border-start border-4 border-warning" data-aos="fade-left">
                            <div class="course-card-img-wrap">
                                <span class="course-badge bg-danger text-white">ESTADO</span>
                                <picture>
                                    <source srcset="img/Index-Contratos-Internacionales.webp" type="image/webp">
                                    <img src="img/Index-Contratos-Internacionales.png" alt="Adicionales y Ampliaciones con el Estado" class="course-card-img" loading="lazy">
                                </picture>
                            </div>
                            <div class="course-card-body">
                                <div>
                                    <h3 class="course-card-title animate__animated animate__fadeInUp animate__delay-1s">Adicionales y Ampliaciones con el Estado</h3>
                                    <p class="course-card-desc">Sustentación técnica y normativa ante la Ley de Contrataciones del Estado (OSCE) y Contraloría.</p>
                                    <div class="course-instructor"><i class="fa-solid fa-user-tie text-danger"></i> Peritos y Consultores en Obras Públicas</div>
                                </div>
                                <div>
                                    <a href="/contratos-estado" class="btn btn-sm w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="background-color: var(--qcs-yellow); color: var(--qcs-black); border-color: var(--qcs-yellow);">Ver Programa Completo <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 12. Grúas Torre -->
                    <div class="col-lg-4 col-md-6">
                        <div class="course-card rounded-4 border-start border-4 border-warning" data-aos="fade-right">
                            <div class="course-card-img-wrap">
                                <span class="course-badge bg-secondary text-white">EQUIPOS</span>
                                <picture>
                                    <source srcset="img/Index-OficinaTecnicaObras.webp" type="image/webp">
                                    <img src="img/Index-OficinaTecnicaObras.png" alt="Estrategia y Planificación con Grúas Torre" class="course-card-img" loading="lazy">
                                </picture>
                            </div>
                            <div class="course-card-body">
                                <div>
                                    <h3 class="course-card-title animate__animated animate__fadeInUp animate__delay-1s">Estrategia y Planificación con Grúas Torre</h3>
                                    <p class="course-card-desc">Productividad, radio de giro, logística vertical, montaje seguro y dimensionamiento de izajes.</p>
                                    <div class="course-instructor"><i class="fa-solid fa-user-tie text-secondary"></i> Ingenieros Mecánicos y de Producción</div>
                                </div>
                                <div>
                                    <a href="/gruas-torre" class="btn btn-sm w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="background-color: var(--qcs-yellow); color: var(--qcs-black); border-color: var(--qcs-yellow);">Ver Programa Completo <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             4. BANNER CTA IN-HOUSE & UBICACIÓN
             ========================================================================== -->
        <section class="py-5">
            <div class="container">
                <div class="edtech-cta-banner">
                    <div class="row align-items-center">
                        
                        <div class="col-lg-8 mb-4 mb-lg-0">
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm">
                                <i class="fa-solid fa-building me-1"></i> PROGRAMAS IN-HOUSE
                            </span>
                            <h2 class="fw-bold font-montserrat text-white mb-3 animate__animated animate__fadeInUp animate__delay-1s" style="font-size: clamp(1.6rem, 2.5vw, 2.3rem);">
                                Capacitación a la medida de tu equipo de ingenieros
                            </h2>
                            <p class="text-light text-opacity-90 mb-3" style="font-size: 1.05rem; line-height: 1.8;">
                                Diseñamos temarios personalizados adaptados a las normas y desafíos de tu empresa u obra. Consulta por tarifas grupales.
                            </p>
                            <div class="d-flex flex-wrap gap-4 text-light">
                                <div>
                                    <i class="fa-solid fa-phone text-warning me-2"></i>
                                    Atención Académica: <a href="tel:+51993463118" class="text-white fw-bold">+51 993 463 118</a>
                                </div>
                                <div>
                                    <i class="fa-solid fa-location-dot text-warning me-2"></i>
                                    Sede Central: <span class="text-white fw-semibold">Av. Javier Prado 757, piso 10 Magdalena, Lima 17</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 text-lg-end text-center">
                            <div class="d-flex flex-column gap-3 justify-content-center">
                                <a href="https://wa.me/51993463118" target="_blank" rel="noopener noreferrer" class="btn btn-warning btn-lg px-4 py-3 fw-bold rounded-pill shadow-lg text-dark animate__animated animate__pulse animate__infinite btn-qcs-primary">
                                    <i class="fab fa-whatsapp me-2"></i> Consultar Inscripciones
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
