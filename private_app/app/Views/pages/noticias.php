<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Noticias y Actualidad Técnica del Sector
 * Archivo: app/Views/pages/noticias.php
 */

declare(strict_types=1);
?>
<style>
        body {
            background-color: var(--qcs-bg-light);
            color: #1e293b;
        }

        /* ----------------------------------------------------
           1. HERO SECTION (Tech Newsroom Style)
           ---------------------------------------------------- */
        .news-hero-banner {
            position: relative;
            padding: 190px 1.5rem 85px 1.5rem;
            background: linear-gradient(145deg, #0F1113 0%, #1A1D20 50%, #24292E 100%);
            color: #ffffff;
            overflow: hidden;
            border-bottom: 4px solid var(--accent-gold);
        }

        .news-hero-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 85% 20%, rgba(229, 168, 19, 0.2) 0%, transparent 55%),
                        radial-gradient(circle at 15% 85%, rgba(142, 146, 151, 0.15) 0%, transparent 60%);
            pointer-events: none;
        }

        .news-hero-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px);
            background-size: 28px 28px;
            opacity: 0.6;
            pointer-events: none;
        }

        .news-hero-title {
            font-family: var(--font-heading);
            font-weight: 800;
            font-size: clamp(2rem, 4vw, 3.2rem);
            letter-spacing: -0.5px;
            color: #ffffff;
            margin-bottom: 1rem;
            text-shadow: 0 4px 16px rgba(0, 0, 0, 0.35);
        }

        .news-hero-subtitle {
            font-family: var(--font-body);
            font-size: clamp(1.05rem, 1.8vw, 1.25rem);
            color: #e2e8f0;
            max-width: 860px;
            margin: 0 auto;
            line-height: 1.7;
        }

        /* ----------------------------------------------------
           2. NOTICIA PRINCIPAL DESTACADA (Hero Feature Story)
           ---------------------------------------------------- */
        .feature-story-card {
            background: #ffffff;
            border-radius: 24px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 20px 45px rgba(15, 17, 19, 0.2);
            overflow: hidden;
            transition: transform 0.35s ease, box-shadow 0.35s ease;
        }

        .feature-story-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 55px rgba(15, 17, 19, 0.2);
        }

        .feature-img-wrapper {
            position: relative;
            height: 100%;
            min-height: 340px;
            overflow: hidden;
        }

        .feature-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .feature-story-card:hover .feature-img {
            transform: scale(1.05);
        }

        .feature-img-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(180deg, rgba(9, 26, 54, 0.1) 0%, rgba(9, 26, 54, 0.7) 100%);
            display: flex;
            align-items: flex-end;
            padding: 1.5rem;
        }

        .feature-content {
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .feature-title {
            font-family: var(--font-heading);
            font-weight: 800;
            font-size: clamp(1.4rem, 2.2vw, 1.95rem);
            color: #0F1113;
            line-height: 1.35;
            margin: 0.85rem 0 1rem 0;
        }

        .feature-desc {
            font-size: 1.02rem;
            line-height: 1.8;
            color: #475569;
            margin-bottom: 1.5rem;
        }

        /* ----------------------------------------------------
           3. GRID MODULAR DE NOTICIAS (News Cards)
           ---------------------------------------------------- */
        .news-card {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .news-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 20px 40px rgba(15, 17, 19, 0.2);
            border-color: #cbd5e1;
        }

        .news-card-img-wrap {
            position: relative;
            height: 210px;
            overflow: hidden;
            display: block;
        }

        .news-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .news-card:hover .news-card-img {
            transform: scale(1.08);
        }

        .news-card-badge {
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
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .news-card-body {
            padding: 1.75rem 1.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            justify-content: space-between;
        }

        .news-card-title {
            font-family: var(--font-heading);
            font-weight: 700;
            font-size: 1.15rem;
            color: #0F1113;
            line-height: 1.4;
            margin-bottom: 0.75rem;
        }

        .news-card-desc {
            font-size: 0.9rem;
            line-height: 1.65;
            color: #64748b;
            margin-bottom: 1.25rem;
        }

        /* ----------------------------------------------------
           4. SECCIÓN DE ANÁLISIS EN VIDEO
           ---------------------------------------------------- */
        .video-news-section {
            background: linear-gradient(135deg, #0F1113 0%, #1A1D20 100%);
            color: #ffffff;
            position: relative;
            padding: 5rem 0;
        }

        .video-news-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 10% 20%, rgba(239, 68, 68, 0.14) 0%, transparent 50%),
                        radial-gradient(circle at 90% 80%, rgba(229, 168, 19, 0.14) 0%, transparent 50%);
            pointer-events: none;
        }

        .video-news-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 20px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            height: 100%;
        }

        .video-news-card:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.25);
            transform: translateY(-4px);
            box-shadow: 0 16px 36px rgba(0, 0, 0, 0.4);
        }

        .video-title {
            font-family: var(--font-heading);
            font-size: 1.15rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0.5rem;
        }

        .video-desc {
            font-size: 0.88rem;
            color: #cbd5e1;
            margin-bottom: 1.25rem;
            line-height: 1.6;
        }

        /* ----------------------------------------------------
           5. LLAMADO A LA ACCIÓN FINAL
           ---------------------------------------------------- */
        .news-cta-banner {
            background: linear-gradient(145deg, #0F1113 0%, #1A1D20 50%, #24292E 100%);
            border-radius: 24px;
            padding: 3.5rem 2.5rem;
            color: #ffffff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 45px rgba(15, 17, 19, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .news-cta-banner::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(197, 155, 39, 0.18) 0%, transparent 70%);
            pointer-events: none;
        }
    </style>

<main>
        <!-- ==========================================================================
             1. ENCABEZADO HERO (Tech Newsroom Style)
             ========================================================================== -->
        <section class="news-hero-banner text-center">
            <div class="news-hero-pattern"></div>
            <div class="container position-relative">
                
                <!-- Badge Superior Neón -->
                <div class="d-inline-block mb-3">
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-2 shadow-sm">
                        <i class="fas fa-newspaper me-2"></i> CENTRO DE NOTICIAS &amp; ACTUALIDAD DEL SECTOR
                    </span>
                </div>

                <!-- Título Principal -->
                <h1 class="news-hero-title animate__animated animate__fadeInDown">NOTICIAS Y NOVEDADES TÉCNICAS</h1>

                <!-- Subtítulo -->
                <p class="news-hero-subtitle">
                    Mantente informado sobre los principales avances en Metodología BIM, PMO en Infraestructura, Control de Calidad e ISO 9001 y Gestión de Riesgos en el Perú y Latinoamérica.
                </p>

                <!-- Micro-badges temáticos -->
                <div class="d-flex justify-content-center flex-wrap gap-2 mt-4">
                    <span class="badge bg-light bg-opacity-25 text-white px-3 py-2 rounded-pill font-montserrat fw-semibold">
                        <i class="fa-solid fa-building me-1 text-warning"></i> Plan BIM Perú
                    </span>
                    <span class="badge bg-light bg-opacity-25 text-white px-3 py-2 rounded-pill font-montserrat fw-semibold">
                        <i class="fa-solid fa-chart-pie me-1 text-warning"></i> PMO Sector Público
                    </span>
                    <span class="badge bg-light bg-opacity-25 text-white px-3 py-2 rounded-pill font-montserrat fw-semibold">
                        <i class="fa-solid fa-check-double me-1 text-success"></i> ISO 9001:2015
                    </span>
                    <span class="badge bg-light bg-opacity-25 text-white px-3 py-2 rounded-pill font-montserrat fw-semibold">
                        <i class="fa-solid fa-triangle-exclamation me-1 text-danger"></i> Gestión de Riesgos
                    </span>
                </div>

            </div>
        </section>

        <!-- ==========================================================================
             2. NOTICIA PRINCIPAL DESTACADA (Hero Feature Story)
             ========================================================================== -->
        <section class="py-5">
            <div class="container">
                <div class="feature-story-card">
                    <div class="row g-0 align-items-stretch">
                        
                        <!-- Columna Izquierda: Imagen Clickeable con Badge -->
                        <div class="col-lg-6">
                            <a href="https://www.mef.gob.pe/planbimperu/novedadesbim.html" target="_blank" rel="noopener noreferrer" class="feature-img-wrapper d-block" aria-label="Leer más sobre Plan BIM Perú en MEF">
                                <img src="img/noti1.png" alt="Plan BIM Perú Ministerio de Economía y Finanzas" class="feature-img" loading="lazy">
                                <div class="feature-img-overlay">
                                    <span class="badge bg-dark text-warning border border-warning-subtle px-3 py-2 rounded-pill fw-bold shadow">
                                        <i class="fa-solid fa-cube me-1"></i> METODOLOGÍA BIM
                                    </span>
                                </div>
                            </a>
                        </div>

                        <!-- Columna Derecha: Titular y Resumen -->
                        <div class="col-lg-6">
                            <div class="feature-content">
                                <div class="mb-2">
                                    <span class="badge bg-dark text-warning border border-warning-subtle text-uppercase px-3 py-2 fw-bold rounded-pill">
                                        PLAN BIM PERÚ | MEF
                                    </span>
                                    <span class="text-muted small ms-2">
                                        <i class="fa-regular fa-clock me-1"></i> Actualidad Oficial
                                    </span>
                                </div>

                                <h2 class="feature-title animate__animated animate__fadeInUp animate__delay-1s">
                                    Adopción Obligatoria de BIM e Implementación de la Malla Curricular en la Inversión Pública
                                </h2>

                                <p class="feature-desc">
                                    El Ministerio de Economía y Finanzas (MEF) consolida la adopción obligatoria de la metodología BIM para más de 130 instituciones públicas y aprueba los estándares de los formatos piloto EIR y BEP para la estandarización de obras nacionales.
                                </p>

                                <div>
                                    <a href="https://www.mef.gob.pe/planbimperu/novedadesbim.html" target="_blank" rel="noopener noreferrer" class="btn btn-qcs-dark btn-lg fw-bold rounded-pill px-4 shadow-sm btn-qcs-primary" style="border-color: var(--qcs-yellow); color: var(--qcs-dark-slate);">
                                        <i class="fas fa-external-link-alt me-2"></i> Leer noticia en MEF.gob.pe
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- ==========================================================================
             3. GRID MODULAR DE NOTICIAS POR CATEGORÍAS (3 Columnas Responsive)
             ========================================================================== -->
        <section class="pb-5 pt-2">
            <div class="container">
                
                <div class="text-center mb-5">
                    <span class="badge bg-warning-subtle text-dark fw-bold px-3 py-2 rounded-pill text-uppercase mb-2">
                        <i class="fa-solid fa-newspaper me-1"></i> Sala de Prensa Técnica
                    </span>
                    <h2 class="fw-extrabold font-montserrat text-dark display-6 mb-2 animate__animated animate__fadeInUp animate__delay-1s" style="font-weight: 800;">
                        ÚLTIMAS NOTICIAS POR CATEGORÍA
                    </h2>
                    <p class="text-muted mx-auto" style="max-width: 700px;">
                        Artículos especializados, marcos regulatorios vigentes y novedades metodológicas recopiladas por nuestros consultores sénior.
                    </p>
                </div>

                <div class="row g-4">
                    
                    <!-- Noticia 1: BIM & Transformación Digital -->
                    <div class="col-lg-4 col-md-6">
                        <div class="news-card">
                            <a href="https://konstruedu.com/blog/bim-en-peru-el-plan-para-vivienda-construccion-y-saneamiento" target="_blank" rel="noopener noreferrer" class="news-card-img-wrap">
                                <span class="news-card-badge bg-warning text-dark text-dark">BIM</span>
                                <img src="img/noti2.png" alt="Plan BIM en Vivienda y Saneamiento" class="news-card-img" loading="lazy">
                            </a>
                            <div class="news-card-body">
                                <div>
                                    <h3 class="news-card-title animate__animated animate__fadeInUp animate__delay-1s">
                                        Plan de Implementación de la Metodología BIM en el Sector Vivienda y Construcción
                                    </h3>
                                    <p class="news-card-desc">
                                        Diagnóstico situacional y hoja de ruta para fortalecer capacidades, infraestructura tecnológica y procesos colaborativos en proyectos urbanos y de saneamiento.
                                    </p>
                                </div>
                                <div class="pt-2">
                                    <a href="https://konstruedu.com/blog/bim-en-peru-el-plan-para-vivienda-construccion-y-saneamiento" target="_blank" rel="noopener noreferrer" class="btn btn-sm w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="background-color: var(--qcs-yellow); color: var(--qcs-black); border-color: var(--qcs-yellow);">
                                        Leer artículo completo <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Noticia 2: PMO & Gobernanza de Proyectos -->
                    <div class="col-lg-4 col-md-6">
                        <div class="news-card">
                            <a href="https://www.gob.pe/institucion/mef/noticias/50666-entidades-del-sector-publico-comenzaran-proceso-de-implementacion-de-herramienta-de-gestion-de-proyectos-pmo" target="_blank" rel="noopener noreferrer" class="news-card-img-wrap">
                                <span class="news-card-badge bg-success text-white">PMO</span>
                                <img src="img/noti3.png" alt="Herramienta PMO para proyectos públicos" class="news-card-img" loading="lazy">
                            </a>
                            <div class="news-card-body">
                                <div>
                                    <h3 class="news-card-title animate__animated animate__fadeInUp animate__delay-1s">
                                        Implementación de la Herramienta PMO para la Reducción de la Brecha de Infraestructura
                                    </h3>
                                    <p class="news-card-desc">
                                        Lineamientos del sector público para la contratación de consultorías de PMO en megaobras de infraestructura vial y edificaciones públicas.
                                    </p>
                                </div>
                                <div class="pt-2">
                                    <a href="https://www.gob.pe/institucion/mef/noticias/50666-entidades-del-sector-publico-comenzaran-proceso-de-implementacion-de-herramienta-de-gestion-de-proyectos-pmo" target="_blank" rel="noopener noreferrer" class="btn btn-sm w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="background-color: var(--qcs-yellow); color: var(--qcs-black); border-color: var(--qcs-yellow);">
                                        Leer nota de prensa <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Noticia 3: Calidad & Norma ISO 9001 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="news-card">
                            <a href="/medios" class="news-card-img-wrap">
                                <span class="news-card-badge bg-warning text-dark">CALIDAD</span>
                                <img src="img/noti4.png" alt="Aseguramiento de la Calidad en Construcción" class="news-card-img" loading="lazy">
                            </a>
                            <div class="news-card-body">
                                <div>
                                    <h3 class="news-card-title animate__animated animate__fadeInUp animate__delay-1s">
                                        Aseguramiento de la Calidad y Control Operativo en Obras Civiles
                                    </h3>
                                    <p class="news-card-desc">
                                        Análisis sobre la importancia del control de no conformidades y auditorías de soporte para elevar el estándar de ejecución técnica.
                                    </p>
                                </div>
                                <div class="pt-2">
                                    <a href="/medios" class="btn btn-sm w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="background-color: var(--qcs-yellow); color: var(--qcs-black); border-color: var(--qcs-yellow);">
                                        Ver publicaciones QCS <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Noticia 4: Gestión de Riesgos -->
                    <div class="col-lg-4 col-md-6">
                        <div class="news-card">
                            <a href="https://www.linkedin.com/pulse/calidad-monitoreo-y-control-samaniego-pmp-irca-lss-black-belt" target="_blank" rel="noopener noreferrer" class="news-card-img-wrap">
                                <span class="news-card-badge bg-danger text-white">RIESGOS</span>
                                <img src="img/noti5.png" alt="Gestión de Riesgos en Contratos" class="news-card-img" loading="lazy">
                            </a>
                            <div class="news-card-body">
                                <div>
                                    <h3 class="news-card-title animate__animated animate__fadeInUp animate__delay-1s">
                                        Identificación y Tratamiento de Incertidumbres en Contratos de Construcción
                                    </h3>
                                    <p class="news-card-desc">
                                        Estrategias para la prevención de sobrecostos y atrasos mediante la matriz de riesgos y el análisis del impacto en cronogramas.
                                    </p>
                                </div>
                                <div class="pt-2">
                                    <a href="https://www.linkedin.com/pulse/calidad-monitoreo-y-control-samaniego-pmp-irca-lss-black-belt" target="_blank" rel="noopener noreferrer" class="btn btn-sm w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="background-color: var(--qcs-yellow); color: var(--qcs-black); border-color: var(--qcs-yellow);">
                                        Leer artículo LinkedIn <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Noticia 5: Contratación Pública & FIDIC -->
                    <div class="col-lg-4 col-md-6">
                        <div class="news-card">
                            <a href="/contratos-estado" class="news-card-img-wrap">
                                <span class="news-card-badge bg-dark text-white">CONTRATOS</span>
                                <img src="img/noti6.png" alt="Estrategias Contractuales en Obras Públicas" class="news-card-img" loading="lazy">
                            </a>
                            <div class="news-card-body">
                                <div>
                                    <h3 class="news-card-title animate__animated animate__fadeInUp animate__delay-1s">
                                        Estrategias Contractuales y Prevención de Controversias en Obras Públicas
                                    </h3>
                                    <p class="news-card-desc">
                                        Revisión de criterios para la gestión de adicionales, ampliaciones de plazo y uso de modelos internacionales en megaobras.
                                    </p>
                                </div>
                                <div class="pt-2">
                                    <a href="/contratos-estado" class="btn btn-sm w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="background-color: var(--qcs-yellow); color: var(--qcs-black); border-color: var(--qcs-yellow);">
                                        Ver detalles del curso <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Noticia 6: Productividad & Lean Construction -->
                    <div class="col-lg-4 col-md-6">
                        <div class="news-card">
                            <a href="/gruas-torre" class="news-card-img-wrap">
                                <span class="news-card-badge bg-secondary text-white">LEAN</span>
                                <img src="img/noti7.png" alt="Logística de Gran Altura y Grúas Torre" class="news-card-img" loading="lazy">
                            </a>
                            <div class="news-card-body">
                                <div>
                                    <h3 class="news-card-title animate__animated animate__fadeInUp animate__delay-1s">
                                        Innovaciones en Logística de Gran Altura y Uso Eficiente de Grúas Torre
                                    </h3>
                                    <p class="news-card-desc">
                                        Aplicación de estudios de tiempos y movimientos para maximizar el rendimiento en edificaciones verticales e infraestructura.
                                    </p>
                                </div>
                                <div class="pt-2">
                                    <a href="/gruas-torre" class="btn btn-sm w-100 py-2 fw-bold rounded-pill btn-qcs-primary" style="background-color: var(--qcs-yellow); color: var(--qcs-black); border-color: var(--qcs-yellow);">
                                        Ver detalles del curso <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             4. SECCIÓN DE ANÁLISIS EN VIDEO (Video News Section)
             ========================================================================== -->
        <section class="video-news-section">
            <div class="container position-relative">
                
                <div class="text-center mb-5">
                    <span class="badge bg-danger-subtle text-danger fw-bold px-3 py-2 rounded-pill text-uppercase mb-2">
                        <i class="fa-brands fa-youtube me-1"></i> Contenido Audiovisual
                    </span>
                    <h2 class="fw-extrabold font-montserrat text-white display-6 mb-2 animate__animated animate__fadeInUp animate__delay-1s" style="font-weight: 800;">
                        ANÁLISIS Y REPORTAJES EN VIDEO
                    </h2>
                    <p class="text-light text-opacity-75 mx-auto" style="max-width: 700px;">
                        Exposiciones magistrales, paneles técnicos y entrevistas con expertos sobre calidad operativa, control de plazos y mitigación de incertidumbre.
                    </p>
                </div>

                <div class="row g-4 justify-content-center">
                    
                    <!-- Video 1 -->
                    <div class="col-lg-6">
                        <div class="video-news-card">
                            <span class="badge bg-danger text-white px-3 py-1 rounded-pill mb-2 font-montserrat">
                                <i class="fa-solid fa-play me-1"></i> ANÁLISIS TÉCNICO 1
                            </span>
                            <h3 class="video-title animate__animated animate__fadeInUp animate__delay-1s">
                                Conferencia sobre Calidad y Control en Proyectos de Construcción
                            </h3>
                            <p class="video-desc">
                                Principios fundamentales para el despliegue del aseguramiento de la calidad en obra y metodologías de cero defectos.
                            </p>
                            <div class="ratio ratio-16x9 shadow-lg rounded-4 overflow-hidden mb-2">
                                <iframe src="https://www.youtube.com/embed/GIupuAHeqBQ" title="Calidad en la Construcción QCS" loading="lazy" allowfullscreen=""></iframe>
                            </div>
                        </div>
                    </div>

                    <!-- Video 2 -->
                    <div class="col-lg-6">
                        <div class="video-news-card">
                            <span class="badge bg-danger text-white px-3 py-1 rounded-pill mb-2 font-montserrat">
                                <i class="fa-solid fa-play me-1"></i> ANÁLISIS TÉCNICO 2
                            </span>
                            <h3 class="video-title animate__animated animate__fadeInUp animate__delay-1s">
                                Análisis de Gestión de Riesgos y Contratos
                            </h3>
                            <p class="video-desc">
                                Identificación y tratamiento preventivo de controversias contractuales en obras de envergadura.
                            </p>
                            <div class="ratio ratio-16x9 shadow-lg rounded-4 overflow-hidden mb-2">
                                <iframe src="https://www.youtube.com/embed/EJ-kUj2-keA" title="Gestión de Riesgos QCS" loading="lazy" allowfullscreen=""></iframe>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             5. LLAMADO A LA ACCIÓN FINAL (Contacto Corporativo)
             ========================================================================== -->
        <section class="py-5">
            <div class="container">
                <div class="news-cta-banner">
                    <div class="row align-items-center">
                        
                        <div class="col-lg-8 mb-4 mb-lg-0">
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm">
                                <i class="fa-solid fa-chalkboard-user me-1"></i> FORMACIÓN CORPORATIVA
                            </span>
                            <h2 class="fw-bold font-montserrat text-white mb-3 animate__animated animate__fadeInUp animate__delay-1s" style="font-size: clamp(1.6rem, 2.5vw, 2.3rem);">
                                Capacita a tu equipo en las últimas tendencias y normativas del sector
                            </h2>
                            <p class="text-light text-opacity-90 mb-3" style="font-size: 1.05rem; line-height: 1.8;">
                                Ofrecemos programas in-house sobre BIM, PMO, ISO 9001, Gestión de Riesgos y Contratos para empresas.
                            </p>
                            <p class="mb-0">
                                <i class="fa-solid fa-phone me-2 text-warning"></i>
                                Central de Consultas: <a href="tel:+51993463118" class="text-white fw-bold">+51 993 463 118</a>
                            </p>
                        </div>

                        <div class="col-lg-4 text-lg-end text-center">
                            <div class="d-flex flex-column gap-3 justify-content-center">
                                <a href="/contacto" class="btn btn-lg px-4 py-3 fw-bold rounded-pill shadow-lg btn-qcs-primary" style="background-color: var(--accent-gold); border-color: var(--accent-gold); color: #0F1113;">
                                    <i class="fa-solid fa-envelope me-2"></i> Contacto Directo
                                </a>
                                <a href="/lean-last-planner" class="btn btn-outline-light btn-lg px-4 py-3 fw-bold rounded-pill btn-qcs-primary">
                                    <i class="fa-solid fa-graduation-cap me-2"></i> Ver Catálogo de Capacitaciones
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </main>
