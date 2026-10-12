<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Componente Reutilizable: Vista Estructurada de Páginas de Categoría
 * Archivo: app/Views/partials/category_page_content.php
 *
 * Implementa las 4 secciones según referencia oficial:
 * A. Banner del área (Hero con título, imagen, intro, CTAs y 3 tarjetas de beneficios)
 * B. Introducción del área (Composición simétrica imagen + contenido técnico del sector)
 * C. Capacitaciones del área (Tarjetas con números oficiales, tipo, imagen, descripción y botón)
 * D. Bloque final de contacto (Banner oficial Quality con WhatsApp y enlace al catálogo)
 */

declare(strict_types=1);

/** @var array $category */
$category = $category ?? [];
$courses = $category['courses'] ?? [];
$courseCount = count($courses);
$waMessage = $category['wa_message'] ?? 'Hola, deseo solicitar información sobre las capacitaciones en ' . ($category['name'] ?? 'Quality Consulting Solutions');
?>
<main class="category-page-main">

    <!-- ==========================================================================
         A. BANNER DEL ÁREA (HERO DE ALTO IMPACTO)
         ========================================================================== -->
    <section class="category-hero-section text-center text-lg-start">
        <div class="category-hero-overlay"></div>
        <div class="container position-relative" style="z-index: 5;">
            <div class="row align-items-center g-4 pt-4">
                
                <div class="col-lg-8">
                    <!-- Badge Superior con Icono -->
                    <div class="d-inline-flex align-items-center mb-3">
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold shadow-sm font-montserrat">
                            <i class="fa-solid fa-graduation-cap me-2"></i><?= htmlspecialchars($category['hero_badge'] ?? 'CAPACITACIÓN ESPECIALIZADA', ENT_QUOTES, 'UTF-8') ?>
                        </span>
                    </div>

                    <!-- Título Principal del Área -->
                    <h1 class="category-hero-title animate__animated animate__fadeInDown">
                        <?= htmlspecialchars($category['hero_title'] ?? $category['name'], ENT_QUOTES, 'UTF-8') ?>
                    </h1>

                    <!-- Subtítulo e Introducción Breve -->
                    <p class="category-hero-subtitle">
                        <?= htmlspecialchars($category['hero_subtitle'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                    </p>

                    <!-- Botones de Acción -->
                    <div class="d-flex flex-wrap gap-3 pt-2 justify-content-center justify-content-lg-start">
                        <a href="#capacitaciones-area" class="btn btn-warning btn-lg px-4 py-3 fw-bold rounded-pill text-dark shadow btn-qcs-primary">
                            <i class="fa-solid fa-compass me-2"></i> EXPLORAR CAPACITACIONES <i class="fa-solid fa-chevron-down ms-1"></i>
                        </a>
                        <a href="/capacitacion" class="btn btn-outline-light btn-lg px-4 py-3 fw-bold rounded-pill">
                            <i class="fa-solid fa-table-cells me-2"></i> Catálogo Completo (48 Cursos)
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 text-center d-none d-lg-block">
                    <div class="category-hero-badge-panel p-4 rounded-4 shadow-lg text-white">
                        <div class="display-4 fw-bold text-warning font-montserrat mb-1"><?= $courseCount ?></div>
                        <div class="text-uppercase fw-semibold tracking-wide small text-light">Cursos y Programas</div>
                        <div class="text-white-50 small mt-2">100% grabados con acceso flexible y certificación oficial</div>
                        <hr class="border-warning my-3 opacity-50">
                        <div class="d-flex align-items-center justify-content-center gap-2 small text-warning">
                            <i class="fa-solid fa-certificate"></i>
                            <span class="text-light">Certificación Quality</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- 3 Tarjetas de Beneficios / Características del Área -->
            <?php if (!empty($category['features'])): ?>
            <div class="row g-3 g-md-4 mt-4 pt-3">
                <?php foreach ($category['features'] as $feat): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="category-feature-card h-100 p-4 rounded-4 shadow-sm">
                        <div class="d-flex align-items-start gap-3">
                            <div class="category-feature-icon flex-shrink-0">
                                <i class="<?= htmlspecialchars($feat['icon'], ENT_QUOTES, 'UTF-8') ?>"></i>
                            </div>
                            <div>
                                <h3 class="category-feature-title mb-1"><?= htmlspecialchars($feat['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                                <p class="category-feature-desc mb-0"><?= htmlspecialchars($feat['description'], ENT_QUOTES, 'UTF-8') ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- ==========================================================================
         B. INTRODUCCIÓN DEL ÁREA (Composición de Referencia: Imagen + Contenido)
         ========================================================================== -->
    <section class="py-5 bg-white border-bottom">
        <div class="container py-lg-3">
            <div class="row align-items-center g-4 g-lg-5">
                
                <!-- Columna Izquierda: Imagen Representativa -->
                <div class="col-lg-5" data-aos="fade-right">
                    <div class="category-intro-img-frame position-relative rounded-4 overflow-hidden shadow-lg border border-2 border-warning-subtle">
                        <picture>
                            <source srcset="<?= htmlspecialchars($category['intro_image'] ?? 'img/Hero-Quality-Consulting.webp', ENT_QUOTES, 'UTF-8') ?>" type="image/webp">
                            <img src="<?= htmlspecialchars($category['intro_image_fallback'] ?? $category['intro_image'] ?? 'img/Hero-Quality-Consulting.png', ENT_QUOTES, 'UTF-8') ?>" 
                                 alt="<?= htmlspecialchars($category['name'] ?? '', ENT_QUOTES, 'UTF-8') ?> - Quality Consulting Solutions" 
                                 class="img-fluid w-100 category-intro-img" 
                                 loading="lazy">
                        </picture>
                        <div class="category-intro-img-badge">
                            <i class="fa-solid fa-hard-hat text-warning me-1"></i> Ingeniería Aplicada
                        </div>
                    </div>
                </div>

                <!-- Columna Derecha: Texto Técnico y Contextual -->
                <div class="col-lg-7" data-aos="fade-left">
                    <span class="badge bg-warning-subtle text-dark fw-bold px-3 py-2 rounded-pill text-uppercase mb-3 font-montserrat">
                        <i class="fa-solid fa-award me-1"></i> Especialización en <?= htmlspecialchars($category['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                    </span>

                    <h2 class="category-intro-headline font-montserrat fw-extrabold text-dark mb-3">
                        <?= htmlspecialchars($category['intro_headline'] ?? 'CONOCIMIENTOS TÉCNICOS PARA TUS PROYECTOS', ENT_QUOTES, 'UTF-8') ?>
                    </h2>

                    <p class="text-secondary lead fs-6 mb-3" style="line-height: 1.8;">
                        <?= htmlspecialchars($category['intro_text_1'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                    </p>

                    <p class="text-secondary fs-6 mb-4" style="line-height: 1.8;">
                        <?= htmlspecialchars($category['intro_text_2'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                    </p>

                    <!-- Callout de Confianza Profesional -->
                    <div class="category-intro-callout p-3 rounded-3 d-flex align-items-center gap-3 border-start border-4 border-warning">
                        <div class="category-callout-icon text-warning fs-3">
                            <i class="fa-solid fa-user-check"></i>
                        </div>
                        <div class="fw-bold text-dark font-montserrat">
                            <?= htmlspecialchars($category['intro_badge'] ?? 'Capacitaciones orientadas a tu desarrollo profesional.', ENT_QUOTES, 'UTF-8') ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ==========================================================================
         C. CAPACITACIONES DEL ÁREA (Tarjetas Oficiales del Área)
         ========================================================================== -->
    <section class="py-5" id="capacitaciones-area">
        <div class="container py-lg-3">
            
            <!-- Encabezado de la Sección de Tarjetas -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 pb-2 border-bottom">
                <div>
                    <span class="badge bg-warning-subtle text-dark fw-bold px-3 py-2 rounded-pill text-uppercase mb-2 font-montserrat">
                        <i class="fa-solid fa-layer-group me-1"></i> Programas Disponibles
                    </span>
                    <h2 class="font-montserrat fw-extrabold text-dark display-6 mb-1">
                        NUESTRAS <span class="text-warning">CAPACITACIONES</span>
                    </h2>
                    <p class="text-muted mb-0">
                        Mostrando <?= $courseCount ?> capacitaciones oficiales en el área de <strong><?= htmlspecialchars($category['name'] ?? '', ENT_QUOTES, 'UTF-8') ?></strong>.
                    </p>
                </div>
                <div class="mt-3 mt-md-0">
                    <a href="/capacitacion" class="btn btn-outline-dark btn-sm rounded-pill px-3 py-2 fw-semibold">
                        <i class="fa-solid fa-arrow-left me-1"></i> Ver Catálogo Completo (48 Cursos)
                    </a>
                </div>
            </div>

            <!-- Grilla Adaptable de Tarjetas (3 col desktop, 2 col tablet, 1 col móvil) -->
            <div class="row g-4">
                <?php foreach ($courses as $c): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="course-card rounded-4 border-start border-4 border-warning h-100" data-aos="fade-up">
                        
                        <!-- Encabezado de la Tarjeta con Imagen y Badges -->
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

                        <!-- Cuerpo de la Tarjeta -->
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

                            <!-- Botón de Acción -->
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

            <!-- Botón inferior para regresar al catálogo -->
            <div class="text-center mt-5 pt-3">
                <a href="/capacitacion" class="btn btn-outline-dark btn-lg px-4 py-3 fw-bold rounded-pill">
                    <i class="fa-solid fa-table-cells me-2"></i> Explorar las 48 Capacitaciones en el Catálogo General
                </a>
            </div>

        </div>
    </section>

    <!-- ==========================================================================
         D. BLOQUE FINAL DE CONTACTO (Estilo Institucional Quality)
         ========================================================================== -->
    <section class="py-5">
        <div class="container">
            <div class="category-contact-banner rounded-4 p-4 p-lg-5 text-white position-relative overflow-hidden shadow-lg">
                <div class="category-contact-overlay"></div>
                <div class="row align-items-center position-relative g-4" style="z-index: 5;">
                    
                    <div class="col-lg-8">
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm font-montserrat">
                            <i class="fa-solid fa-headset me-1"></i> CAPACITACIÓN ESPECIALIZADA
                        </span>

                        <h2 class="font-montserrat fw-extrabold text-white display-6 mb-3">
                            <?= htmlspecialchars($category['contact_title'] ?? '¿LISTO PARA FORTALECER TUS COMPETENCIAS PROFESIONALES?', ENT_QUOTES, 'UTF-8') ?>
                        </h2>

                        <p class="text-white-50 lead fs-6 mb-4" style="line-height: 1.8;">
                            <?= htmlspecialchars($category['contact_desc'] ?? 'Encuentra la capacitación que necesitas para seguir creciendo profesionalmente. Contáctanos y recibe información sobre nuestros cursos, talleres y seminarios.', ENT_QUOTES, 'UTF-8') ?>
                        </p>

                        <!-- Botón WhatsApp Oficial -->
                        <div class="d-flex flex-wrap gap-3 align-items-center mb-4">
                            <a href="https://wa.me/51993463118?text=<?= urlencode($waMessage) ?>" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="btn btn-warning btn-lg px-4 py-3 fw-bold rounded-pill text-dark shadow-lg animate__animated animate__pulse animate__infinite btn-qcs-primary">
                                <i class="fab fa-whatsapp fa-lg me-2"></i> SOLICITAR INFORMACIÓN POR WHATSAPP <i class="fa-solid fa-chevron-right ms-1"></i>
                            </a>
                            <a href="/capacitacion" class="btn btn-outline-light btn-lg px-4 py-3 fw-semibold rounded-pill">
                                <i class="fa-solid fa-layer-group me-1"></i> Ver Todas las Categorías
                            </a>
                        </div>

                        <p class="text-white-50 small mb-0">
                            Nuestro equipo te ayudará a conocer las capacitaciones disponibles y programas in-house.
                        </p>
                    </div>

                    <div class="col-lg-4 text-center d-none d-lg-block">
                        <div class="category-contact-photo-frame position-relative rounded-4 overflow-hidden shadow-lg border border-2 border-warning-subtle">
                            <picture>
                                <source srcset="<?= htmlspecialchars($category['contact_image'] ?? 'img/Hero-Quality-Consulting.webp', ENT_QUOTES, 'UTF-8') ?>" type="image/webp">
                                <img src="<?= htmlspecialchars($category['contact_image_fallback'] ?? $category['contact_image'] ?? 'img/Hero-Quality-Consulting.png', ENT_QUOTES, 'UTF-8') ?>" 
                                     alt="<?= htmlspecialchars($category['contact_image_alt'] ?? 'Capacitación en Construcción - Quality Consulting Solutions', ENT_QUOTES, 'UTF-8') ?>" 
                                     class="img-fluid w-100 category-contact-photo" 
                                     loading="lazy">
                            </picture>
                            <div class="category-contact-photo-badge">
                                <i class="fa-solid fa-award text-warning me-1"></i> Quality Consulting
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Franja de 3 Garantías Rápidas en Footer del Banner -->
                <div class="row g-3 pt-4 mt-4 border-top border-white border-opacity-10 position-relative" style="z-index: 5;">
                    <div class="col-md-4">
                        <div class="d-flex align-items-center gap-2 small text-light">
                            <i class="fa-solid fa-headset text-warning fs-5"></i>
                            <span><strong>Atención personalizada</strong> vía telefónica y WhatsApp</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center gap-2 small text-light">
                            <i class="fa-solid fa-laptop text-warning fs-5"></i>
                            <span><strong>Resuelve tus dudas</strong> directamente con especialistas</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center gap-2 small text-light">
                            <i class="fa-solid fa-file-lines text-warning fs-5"></i>
                            <span><strong>Recibe información</strong> y temarios detallados en PDF</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

