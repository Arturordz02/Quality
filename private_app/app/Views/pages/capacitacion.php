<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Capacitación Ejecutiva y Programas de Especialización
 * Archivo: app/Views/pages/capacitacion.php
 */

declare(strict_types=1);

$courses = $courses ?? \App\Services\CoursesCatalog::getAll();
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
                            <div class="value-icon"><i class="fa-solid fa-chalkboard-user text-dark"></i></div>
                            <h4 class="fw-bold font-montserrat fs-6 text-dark">Capacitaciones Grabadas y En Vivo</h4>
                            <p class="small text-muted mb-0">Aprende a tu ritmo con clases grabadas o consulta disponibilidad para sesiones en vivo con nuestros especialistas.</p>
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
                            <h4 class="fw-bold font-montserrat fs-6 text-dark">Diploma</h4>
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
             3. CATÁLOGO GENERAL DE 48 CAPACITACIONES (Filtros, Buscador y Grilla)
             ========================================================================== -->
        <section class="pb-5" id="catalogo">
            <div class="container">
                
                <!-- Encabezado de la Sección del Catálogo -->
                <div class="text-center mb-4">
                    <span class="badge bg-warning-subtle text-dark fw-bold px-3 py-2 rounded-pill text-uppercase mb-2 font-montserrat">
                        <i class="fa-solid fa-book-open-reader me-1"></i> Especializaciones Oficiales
                    </span>
                    <h2 class="fw-extrabold font-montserrat text-dark display-6 mb-2" style="font-weight: 800;">
                        CATÁLOGO OFICIAL DE CAPACITACIONES
                    </h2>
                    <p class="text-muted mx-auto" style="max-width: 760px;">
                        Explora nuestros 48 programas, cursos, talleres y seminarios especializados para profesionales del sector construcción, infraestructura y minería.
                    </p>
                </div>

                <!-- Barra de Búsqueda y Filtros de Categoría -->
                <div class="catalog-controls-card p-3 p-md-4 rounded-4 bg-white shadow-sm border mb-4">
                    
                    <!-- Fila 1: Buscador en ancho completo -->
                    <div class="catalog-search-wrap position-relative mb-3">
                        <i class="fa-solid fa-magnifying-glass search-icon"></i>
                        <input type="text" id="catalogSearchInput" class="form-control catalog-search-input" placeholder="Buscar capacitaciones por título, especialidad o palabra clave..." aria-label="Buscar capacitaciones" autocomplete="off">
                        <button type="button" id="catalogClearSearch" class="btn btn-clear-search d-none" aria-label="Limpiar búsqueda">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <!-- Fila 2: Filtros de Categoría Adaptables -->
                    <div class="catalog-filter-bar d-flex flex-wrap gap-2 align-items-center mb-3">
                        <button type="button" class="catalog-filter-btn active" data-category="todos">
                            <span>Todos</span> <span class="badge rounded-pill ms-1">48</span>
                        </button>
                        <button type="button" class="catalog-filter-btn" data-category="calidad">
                            <span>Calidad</span> <span class="badge rounded-pill ms-1">10</span>
                        </button>
                        <button type="button" class="catalog-filter-btn" data-category="riesgos">
                            <span>Riesgos</span> <span class="badge rounded-pill ms-1">5</span>
                        </button>
                        <button type="button" class="catalog-filter-btn" data-category="contratos">
                            <span>Contratos</span> <span class="badge rounded-pill ms-1">11</span>
                        </button>
                        <button type="button" class="catalog-filter-btn" data-category="gestion-de-proyectos">
                            <span>Gestión de Proyectos</span> <span class="badge rounded-pill ms-1">18</span>
                        </button>
                        <button type="button" class="catalog-filter-btn" data-category="oficina-tecnica">
                            <span>Oficina Técnica</span> <span class="badge rounded-pill ms-1">4</span>
                        </button>
                    </div>

                    <!-- Fila 3: Contador debajo de los filtros y botón Restablecer búsqueda -->
                    <div class="catalog-status-bar d-flex justify-content-between align-items-center flex-wrap gap-2 pt-2 border-top">
                        <div id="catalogResultsCount" class="text-muted small fw-semibold">
                            Mostrando <strong>48</strong> de 48 capacitaciones
                        </div>
                        <button type="button" id="catalogResetFiltersBtn" class="btn btn-link btn-sm text-decoration-none text-danger p-0 d-none fw-semibold">
                            <i class="fa-solid fa-arrow-rotate-left me-1"></i> Restablecer búsqueda
                        </button>
                    </div>

                </div>

                <!-- Grilla Adaptable de las 48 Capacitaciones -->
                <div class="row g-4" id="catalogGrid">
                    <?php foreach ($courses as $c): ?>
                    <div class="col-lg-4 col-md-6 catalog-item-col" 
                         data-category="<?= htmlspecialchars($c['category_slug'], ENT_QUOTES, 'UTF-8') ?>"
                         data-type="<?= htmlspecialchars(strtolower($c['type']), ENT_QUOTES, 'UTF-8') ?>"
                         data-number="<?= (int)$c['number'] ?>"
                         data-search="<?= htmlspecialchars(strtolower($c['title'] . ' ' . $c['category'] . ' ' . $c['type'] . ' ' . $c['description']), ENT_QUOTES, 'UTF-8') ?>">
                        
                        <div class="course-card rounded-4 border-start border-4 border-warning h-100">
                            
                            <div class="course-card-img-wrap">
                                <span class="course-badge <?= $c['type'] === 'Seminario' ? 'bg-info text-dark' : ($c['type'] === 'Taller' ? 'bg-primary text-white' : 'bg-warning text-dark') ?>">
                                    <?= strtoupper(htmlspecialchars($c['type'], ENT_QUOTES, 'UTF-8')) ?>
                                </span>
                                <picture>
                                    <source srcset="<?= htmlspecialchars($c['image'], ENT_QUOTES, 'UTF-8') ?>" type="image/webp">
                                    <img src="<?= htmlspecialchars($c['image_fallback'] ?? $c['image'], ENT_QUOTES, 'UTF-8') ?>" 
                                         alt="<?= htmlspecialchars($c['title'], ENT_QUOTES, 'UTF-8') ?>" 
                                         class="course-card-img" 
                                         loading="lazy">
                                </picture>
                            </div>

                            <div class="course-card-body d-flex flex-column justify-content-between">
                                <div>
                                    <div class="course-category-tag mb-2">
                                        <i class="fa-solid fa-tag text-warning me-1"></i>
                                        <span><?= htmlspecialchars($c['category'], ENT_QUOTES, 'UTF-8') ?></span>
                                    </div>
                                    <h3 class="course-card-title">
                                        <?= htmlspecialchars($c['title'], ENT_QUOTES, 'UTF-8') ?>
                                    </h3>
                                    <p class="course-card-desc">
                                        <?= htmlspecialchars($c['description'], ENT_QUOTES, 'UTF-8') ?>
                                    </p>
                                </div>

                                <div class="pt-3 border-top mt-auto">
                                    <?php if (!empty($c['route'])): ?>
                                    <a href="<?= htmlspecialchars($c['route'], ENT_QUOTES, 'UTF-8') ?>" class="btn btn-warning w-100 py-2 fw-bold rounded-pill text-dark btn-qcs-primary shadow-sm">
                                        VER CAPACITACIÓN <i class="fa-solid fa-chevron-right ms-1"></i>
                                    </a>
                                    <?php else: ?>
                                    <button type="button" class="btn btn-warning w-100 py-2 fw-bold rounded-pill text-dark btn-qcs-primary shadow-sm btn-open-course-info" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalSolicitarInfo" 
                                            data-course-title="<?= htmlspecialchars($c['title'], ENT_QUOTES, 'UTF-8') ?>"
                                            data-course-category="<?= htmlspecialchars($c['category'], ENT_QUOTES, 'UTF-8') ?>">
                                        SOLICITAR INFORMACIÓN <i class="fa-solid fa-chevron-right ms-1"></i>
                                    </button>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>

                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Estado Sin Resultados (Empty State) -->
                <div id="catalogEmptyState" class="text-center py-5 d-none">
                    <div class="empty-state-icon text-muted mb-3">
                        <i class="fa-solid fa-magnifying-glass-chart display-3 text-warning"></i>
                    </div>
                    <h4 class="fw-bold font-montserrat text-dark mb-2">No se encontraron capacitaciones</h4>
                    <p class="text-muted small mx-auto mb-4" style="max-width: 500px;">
                        No existen cursos que coincidan con los criterios de búsqueda o filtro seleccionados. Prueba buscando con otros términos o limpiando los filtros.
                    </p>
                    <button type="button" class="btn btn-warning btn-md px-4 py-2 rounded-pill fw-bold text-dark btn-qcs-primary" id="catalogEmptyResetBtn">
                        <i class="fa-solid fa-arrow-rotate-left me-1"></i> Restablecer búsqueda
                    </button>
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
