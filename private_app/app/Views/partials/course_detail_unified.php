<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Plantilla Compartida Basada en Referencia ISO 9001: Detalle Uniforme de Capacitación
 * Archivo: app/Views/partials/course_detail_unified.php
 *
 * Estructura común:
 * 1. Banner Hero centrado (fondo oscuro con degradado dorado, etiqueta, título, resumen y tarjetas informativas)
 * 2. Objetivo del curso y Perfil docente (2 columnas alineadas arriba en escritorio, apiladas en móvil)
 * 3. Temario del curso (acordeón desplegable enriquecido con indicador oscuro/dorado e ícono temático)
 * 4. Beneficios y materiales + Unidades de desarrollo profesional (PDU dinámico)
 * 5. Brochure del curso (bloque único y discreto con "Ver PDF" y "Descargar PDF")
 * 6. Información e inscripción (WhatsApp, Modal Solicitar Información y PayPal Primera Clase)
 * 7. Sección opcional de videos cuando el curso cuenta con conferencias disponibles
 */

declare(strict_types=1);

/** @var array $course */
$course = $course ?? [];

$heroBadge         = $course['hero_badge'] ?? 'ÁREA DE GESTIÓN DE LA CALIDAD • 16 HORAS NETAS';
$heroBadgeIcon     = $course['hero_badge_icon'] ?? 'fa-solid fa-graduation-cap';
$title             = $course['title'] ?? '';
$summary           = $course['summary'] ?? '';
$heroCards         = $course['hero_cards'] ?? [];
$objective         = $course['objective'] ?? '';
$objectiveImage    = $course['objective_image'] ?? '';
$objectiveImgWebp  = $course['objective_image_webp'] ?? '';
$objectiveImgAlt   = $course['objective_image_alt'] ?? $title;
$objectiveHighlights = $course['objective_highlights'] ?? [];
$syllabusIntro     = $course['syllabus_intro'] ?? '';
$syllabus          = $course['syllabus'] ?? [];
$docente           = $course['docente'] ?? [];
$benefits          = $course['benefits'] ?? [];
$pduTitle = trim((string)($course['pdu_title'] ?? ''));
$pduText = $course['pdu_text'] ?? '';
$pduHeading = trim((string)($course['pdu_heading'] ?? ''));

if ($pduHeading === '') {
    $pduHeading = $pduTitle !== ''
        ? $pduTitle
        : 'Unidades de desarrollo profesional';
}
$enrollBgImage     = $course['enroll_bg_image'] ?? '';
$whatsappUrl       = $course['whatsapp_url'] ?? 'https://wa.me/51993463118';
$whatsappBtnText   = $course['whatsapp_btn_text'] ?? 'Solicitar información por WhatsApp';
$modalServiceTitle = $course['modal_service'] ?? $title;
$paypalSlug        = $course['paypal_slug'] ?? '';
$videos            = $course['videos'] ?? [];

$heroCardCount = count($heroCards);
$heroColClass  = $heroCardCount === 3 ? 'col-12 col-md-4' : 'col-12 col-sm-6 col-lg-3';
?>
<main class="qcs-course-detail" id="main-content">

    <!-- ==========================================================================
         1. HERO BANNER (COMPOSICIÓN DE REFERENCIA ISO 9001)
         ========================================================================== -->
    <section class="qcs-iso-hero-banner">
        <div class="container text-center position-relative" style="z-index: 2;">

            <!-- Etiqueta Superior Centrada -->
            <div class="mb-3">
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-2 shadow-sm qcs-iso-hero-pill">
                    <i class="<?= htmlspecialchars($heroBadgeIcon, ENT_QUOTES, 'UTF-8') ?> me-2" aria-hidden="true"></i><?= htmlspecialchars($heroBadge, ENT_QUOTES, 'UTF-8') ?>
                </span>
            </div>

            <!-- Título Grande, Centrado y en Negrita -->
            <h1 class="qcs-iso-hero-title mb-3">
                <?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?>
            </h1>

            <!-- Resumen Centrado con Ancho de Lectura Controlado -->
            <p class="qcs-iso-hero-summary mx-auto mb-4">
                <?= htmlspecialchars($summary, ENT_QUOTES, 'UTF-8') ?>
            </p>

            <!-- Tarjetas Informativas del Hero con Íconos y Detalles Dorados -->
            <?php if (!empty($heroCards)): ?>
            <div class="row g-3 justify-content-center mt-2">
                <?php foreach ($heroCards as $hc): ?>
                <div class="<?= $heroColClass ?>">
                    <div class="qcs-iso-benefit-card">
                        <div class="qcs-iso-benefit-icon" aria-hidden="true">
                            <i class="<?= htmlspecialchars($hc['icon'] ?? 'fa-solid fa-award', ENT_QUOTES, 'UTF-8') ?>"></i>
                        </div>
                        <div class="qcs-iso-benefit-title">
                            <?= htmlspecialchars($hc['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                        </div>
                        <p class="qcs-iso-benefit-desc">
                            <?= htmlspecialchars($hc['desc'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- ==========================================================================
         2. OBJETIVO DEL CURSO Y PERFIL DOCENTE (DOS COLUMNAS ALINEADAS ARRIBA)
         ========================================================================== -->
    <section class="qcs-cd-section" id="objetivo-y-docente">
        <div class="container">
            <div class="row g-4 align-items-start">

                <!-- Columna Izquierda: Objetivo del curso -->
                <div class="col-12 col-lg-6" id="objetivo-curso">
                    <div class="qcs-iso-audit-card">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="qcs-iso-sub-badge">
                                <i class="fa-solid fa-bullseye me-1" aria-hidden="true"></i> Propósito Académico Oficial
                            </span>
                        </div>

                        <h2 class="qcs-iso-card-heading">Objetivo del curso</h2>
                        <div class="qcs-iso-heading-line mb-3"></div>

                        <p class="qcs-iso-body-text mb-3">
                            <?= $objective ?>
                        </p>

                        <?php if (!empty($objectiveImage)): ?>
                        <div class="qcs-iso-objective-media my-3">
                            <picture>
                                <?php if (!empty($objectiveImgWebp)): ?>
                                <source srcset="<?= htmlspecialchars($objectiveImgWebp, ENT_QUOTES, 'UTF-8') ?>" type="image/webp">
                                <?php endif; ?>
                                <img src="<?= htmlspecialchars($objectiveImage, ENT_QUOTES, 'UTF-8') ?>"
                                     alt="<?= htmlspecialchars($objectiveImgAlt, ENT_QUOTES, 'UTF-8') ?>"
                                     class="qcs-iso-objective-img"
                                     loading="lazy">
                            </picture>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($objectiveHighlights)): ?>
                        <div class="qcs-iso-scope-box mt-3">
                            <div class="qcs-iso-scope-title">
                                <i class="fa-solid fa-compass-drafting text-warning me-2" aria-hidden="true"></i>Enfoque y alcance técnico
                            </div>
                            <ul class="qcs-iso-scope-list mb-0">
                                <?php foreach ($objectiveHighlights as $ohl): ?>
                                <li><?= $ohl ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Columna Derecha: Perfil docente -->
                <div class="col-12 col-lg-6" id="perfil-docente">
                    <?php
                    $hasPhoto        = !empty($docente['photo']);
                    $docPhoto        = $docente['photo'] ?? '';
                    $docPhotoWebp    = $docente['photo_webp'] ?? '';
                    $docName         = $docente['name'] ?? '';
                    $docExpTag       = $docente['experience_tag'] ?? '';
                    $docCredentials  = $docente['credentials'] ?? [];
                    $docSummary      = $docente['summary'] ?? '';
                    $docHighlights   = $docente['highlights'] ?? [];
                    $docFullBioItems = $docente['full_bio_items'] ?? [];
                    $docRecognition  = $docente['recognition'] ?? '';
                    ?>
                    <div class="qcs-iso-audit-card">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="qcs-iso-sub-badge">
                                <i class="fa-solid fa-user-graduate me-1" aria-hidden="true"></i> Especialista a Cargo
                            </span>
                        </div>

                        <h2 class="qcs-iso-card-heading">Perfil docente</h2>
                        <div class="qcs-iso-heading-line mb-3"></div>

                        <div class="qcs-iso-docente-identity-row mb-3">
                            <?php if ($hasPhoto): ?>
                            <div class="qcs-iso-auditor-seal">
                                <picture>
                                    <?php if (!empty($docPhotoWebp)): ?>
                                    <source srcset="<?= htmlspecialchars($docPhotoWebp, ENT_QUOTES, 'UTF-8') ?>" type="image/webp">
                                    <?php endif; ?>
                                    <img src="<?= htmlspecialchars($docPhoto, ENT_QUOTES, 'UTF-8') ?>"
                                         alt="<?= htmlspecialchars($docName, ENT_QUOTES, 'UTF-8') ?>"
                                         loading="lazy">
                                </picture>
                            </div>
                            <?php endif; ?>

                            <div class="qcs-iso-docente-title-wrap">
                                <?php if (!empty($docExpTag)): ?>
                                <span class="qcs-iso-exp-badge">
                                    <i class="fa-solid fa-medal me-1" aria-hidden="true"></i><?= htmlspecialchars($docExpTag, ENT_QUOTES, 'UTF-8') ?>
                                </span>
                                <?php endif; ?>
                                <h3 class="qcs-iso-docente-name mt-1 mb-0">
                                    <?= htmlspecialchars($docName, ENT_QUOTES, 'UTF-8') ?>
                                </h3>
                            </div>
                        </div>

                        <?php if (!empty($docCredentials)): ?>
                        <div class="d-flex flex-wrap gap-2 mb-3" aria-label="Credenciales del docente">
                            <?php foreach ($docCredentials as $cred): ?>
                            <span class="qcs-iso-cred-pill">
                                <i class="fa-solid fa-certificate text-warning me-1" aria-hidden="true"></i><?= htmlspecialchars($cred, ENT_QUOTES, 'UTF-8') ?>
                            </span>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($docSummary)): ?>
                        <p class="qcs-iso-body-text mb-3">
                            <?= $docSummary ?>
                        </p>
                        <?php endif; ?>

                        <?php if (!empty($docHighlights)): ?>
                        <ul class="qcs-iso-docente-list mb-3">
                            <?php foreach ($docHighlights as $hl): ?>
                            <li><?= $hl ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>

                        <?php if (!empty($docFullBioItems) || !empty($docRecognition)): ?>
                        <details class="qcs-cd-bio-details">
                            <summary class="qcs-cd-bio-toggle">
                                <span>Ver trayectoria completa</span>
                                <i class="fa-solid fa-chevron-down" aria-hidden="true"></i>
                            </summary>
                            <div class="qcs-cd-bio-expanded">
                                <?php if (!empty($docFullBioItems)): ?>
                                <ul class="qcs-iso-docente-list mb-3">
                                    <?php foreach ($docFullBioItems as $bioItem): ?>
                                    <li><?= $bioItem ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php endif; ?>

                                <?php if (!empty($docRecognition)): ?>
                                <div class="qcs-iso-recognition-box">
                                    <i class="fa-solid fa-circle-check text-warning me-2" aria-hidden="true"></i>
                                    <span><?= $docRecognition ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </details>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ==========================================================================
         3. TEMARIO DEL CURSO (ACORDEÓN MEJORADO BASADO EN REFERENCIA ISO 9001)
         ========================================================================== -->
    <section class="qcs-cd-section bg-white border-top border-bottom" id="temario-curso">
        <div class="container">

            <div class="text-center mb-4 pb-1">
                <span class="qcs-iso-section-badge">
                    <i class="fa-solid fa-layer-group me-1" aria-hidden="true"></i> Estructura curricular oficial
                </span>
                <h2 class="qcs-iso-section-title mt-2">Temario del curso</h2>
                <div class="qcs-iso-title-underline mx-auto"></div>
                <?php if (!empty($syllabusIntro)): ?>
                <p class="qcs-iso-section-subtitle mx-auto mt-3">
                    <?= $syllabusIntro ?>
                </p>
                <?php endif; ?>
            </div>

            <div class="qcs-cd-syllabus-accordion mx-auto">
                <?php foreach ($syllabus as $idx => $item):
                    $numFormatted = str_pad((string)($idx + 1), 2, '0', STR_PAD_LEFT);
                    $itemTitle    = $item['title'] ?? '';
                    $itemIcon     = $item['icon'] ?? 'fa-solid fa-cube';
                    $itemClause   = $item['clause'] ?? '';
                    $itemContent  = $item['content'] ?? '';
                ?>
                <details class="qcs-cd-syllabus-item" <?= $idx === 0 ? 'open' : '' ?>>
                    <summary class="qcs-cd-syllabus-summary">
                        <span class="qcs-cd-syllabus-num" aria-hidden="true"><?= htmlspecialchars($numFormatted, ENT_QUOTES, 'UTF-8') ?></span>
                        <span class="qcs-cd-syllabus-icon" aria-hidden="true">
                            <i class="<?= htmlspecialchars($itemIcon, ENT_QUOTES, 'UTF-8') ?>"></i>
                        </span>
                        <span class="qcs-cd-syllabus-heading-wrap">
                            <span class="qcs-cd-syllabus-title"><?= htmlspecialchars($itemTitle, ENT_QUOTES, 'UTF-8') ?></span>
                            <?php if (!empty($itemClause)): ?>
                            <span class="qcs-cd-syllabus-clause"><?= htmlspecialchars($itemClause, ENT_QUOTES, 'UTF-8') ?></span>
                            <?php endif; ?>
                        </span>
                        <span class="qcs-cd-syllabus-chevron" aria-hidden="true">
                            <i class="fa-solid fa-chevron-down"></i>
                        </span>
                    </summary>
                    <div class="qcs-cd-syllabus-body">
                        <?= $itemContent ?>
                    </div>
                </details>
                <?php endforeach; ?>
            </div>

        </div>
    </section>

    <!-- ==========================================================================
         4. BENEFICIOS Y MATERIALES + FRANJA PDU
         ========================================================================== -->
    <section class="qcs-cd-section qcs-cd-section--ivory" id="beneficios-materiales">
        <div class="container">

            <div class="text-center mb-4 pb-2">
                <span class="qcs-cd-ivory-eyebrow">ALCANCE DEL PROGRAMA</span>
                <h2 class="qcs-iso-section-title mt-1">Beneficios y materiales</h2>
                <div class="qcs-iso-title-underline mx-auto"></div>
            </div>

            <!-- Bloques abiertos de beneficios (3 cols desktop, 2 cols tablet, 1 col móvil, última fila equilibrada) -->
            <div class="row g-4 justify-content-center qcs-cd-benefits-open-row mx-auto">
                <?php foreach ($benefits as $benefit): ?>
                <div class="col-12 col-md-6 col-lg-4 d-flex">
                    <div class="qcs-cd-benefit-open-item">
                        <div class="qcs-cd-benefit-circle-icon" aria-hidden="true">
                            <i class="<?= htmlspecialchars($benefit['icon'] ?? 'fa-solid fa-check', ENT_QUOTES, 'UTF-8') ?>"></i>
                        </div>
                        <div class="qcs-cd-benefit-open-body">
                            <?php if (!empty($benefit['title'])): ?>
                            <h3 class="qcs-cd-benefit-open-title"><?= htmlspecialchars($benefit['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                            <?php endif; ?>
                            <p class="qcs-cd-benefit-open-desc mb-0"><?= $benefit['text'] ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Franja oscura con acentos dorados para Unidades de desarrollo profesional (PDU dinámico) -->
            <?php if (!empty($pduText) || !empty($pduTitle)): ?>
            <div class="qcs-cd-pdu-dark-bar mx-auto">
                <div class="qcs-cd-pdu-medal" aria-hidden="true">
                    <i class="fa-solid fa-award"></i>
                </div>
                <div class="qcs-cd-pdu-divider" aria-hidden="true"></div>
                <div class="qcs-cd-pdu-copy">
                    <h3 class="qcs-cd-pdu-dark-heading"><?= htmlspecialchars($pduHeading, ENT_QUOTES, 'UTF-8') ?></h3>
                    <?php if (!empty($pduText)): ?>
                    <p class="qcs-cd-pdu-dark-text mb-0"><?= $pduText ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- ==========================================================================
         5. INFORMACIÓN E INSCRIPCIÓN (PANEL OSCURO DE 2 COLUMNAS)
         ========================================================================== -->
    <section class="qcs-cd-section qcs-cd-section--enroll-wrap" id="informacion-inscripcion">
        <div class="container">
            <div class="qcs-cd-enroll-panel mx-auto<?= !empty($enrollBgImage) ? ' qcs-cd-enroll-panel--has-bg' : '' ?>"<?= !empty($enrollBgImage) ? ' style="--qcs-enroll-bg: url(\'' . htmlspecialchars($enrollBgImage, ENT_QUOTES, 'UTF-8') . '\');"' : '' ?>>
                <div class="qcs-cd-enroll-grid">

                    <!-- Columna izquierda: Explicación -->
                    <div class="qcs-cd-enroll-left">
                        <span class="qcs-cd-enroll-pill">CAPACITACIÓN ESPECIALIZADA</span>
                        <h2 class="qcs-cd-enroll-heading">Información e inscripción</h2>
                        <p class="qcs-cd-enroll-lead">
                            Consulta precios y disponibilidad.<br>
                            Te orientamos para elegir tu capacitación.
                        </p>
                        <div class="qcs-cd-enroll-accent-line" aria-hidden="true"></div>
                    </div>

                    <!-- Columna derecha: Acciones y Subbloque de Primera Clase -->
                    <div class="qcs-cd-enroll-right">
                        <!-- 1. Botón principal dorado: Solicitar información -->
                        <button type="button"
                                class="btn qcs-cd-btn-enroll-primary w-100"
                                data-bs-toggle="modal"
                                data-bs-target="#modalSolicitarInfo"
                                data-service="<?= htmlspecialchars($modalServiceTitle, ENT_QUOTES, 'UTF-8') ?>">
                            <i class="fa-solid fa-headset me-2" aria-hidden="true"></i>Solicitar información
                        </button>

                        <!-- 2. Botón secundario: WhatsApp -->
                        <a href="<?= htmlspecialchars($whatsappUrl, ENT_QUOTES, 'UTF-8') ?>"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn qcs-cd-btn-enroll-whatsapp w-100"
                           aria-label="<?= htmlspecialchars($whatsappBtnText, ENT_QUOTES, 'UTF-8') ?> sobre <?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?>">
                            <i class="fab fa-whatsapp qcs-whatsapp-icon me-2" aria-hidden="true"></i><?= htmlspecialchars($whatsappBtnText, ENT_QUOTES, 'UTF-8') ?>
                        </a>

                        <!-- 3. Subbloque diferenciado para la primera clase (US$ 10 + PayPal) -->
                        <?php if (!empty($paypalSlug)): ?>
                        <div class="qcs-cd-first-class-box">
                            <div class="qcs-cd-fc-price-col">
                                <span class="qcs-cd-fc-label">PRIMERA CLASE</span>
                                <span class="qcs-cd-fc-amount">US$ 10</span>
                            </div>

                            <div class="qcs-cd-fc-btn-col">
                                <a href="/registro-primera-clase?curso=<?= htmlspecialchars($paypalSlug, ENT_QUOTES, 'UTF-8') ?>"
                                   class="btn qcs-cd-btn-paypal-fc btn-paypal-first-class"
                                   data-course-slug="<?= htmlspecialchars($paypalSlug, ENT_QUOTES, 'UTF-8') ?>"
                                   aria-label="Pagar primera clase de <?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?> por US$ 10 mediante PayPal">
                                    <i class="fab fa-paypal me-2" aria-hidden="true"></i>Pagar primera clase
                                </a>
                            </div>

                            <p class="qcs-cd-fc-note mb-0">
                                US$10 únicamente por la primera clase. No incluye el curso completo.
                            </p>
                        </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>

            <!-- Enlaces discretos debajo del panel -->
            <div class="qcs-cd-enroll-footer-links mx-auto">
                <a href="/capacitacion-calidad" class="qcs-cd-back-link">
                    <i class="fa-solid fa-arrow-left me-1" aria-hidden="true"></i>Volver al Área de Calidad
                </a>
                <span class="qcs-cd-link-sep" aria-hidden="true">|</span>
                <a href="/capacitacion" class="qcs-cd-back-link">
                    <i class="fa-solid fa-table-cells-large me-1" aria-hidden="true"></i>Ver catálogo general
                </a>
            </div>
        </div>
    </section>

    <!-- ==========================================================================
         7. SECCIÓN OPCIONAL: VIDEOS Y CONFERENCIAS (ESTILO ISO 9001)
         ========================================================================== -->
    <?php if (!empty($videos)): ?>
    <section class="qcs-cd-section bg-white border-top" id="videos-curso">
        <div class="container">

            <div class="text-center mb-4 pb-1">
                <span class="badge bg-danger text-white px-3 py-2 rounded-pill fw-bold text-uppercase mb-2 shadow-sm">
                    <i class="fa-brands fa-youtube me-1" aria-hidden="true"></i> Sesiones Técnicas &amp; Masterclasses
                </span>
                <h2 class="qcs-iso-section-title mt-1">Conferencias y presentaciones</h2>
                <div class="qcs-iso-title-underline mx-auto"></div>
            </div>

            <div class="row g-4 justify-content-center">
                <?php
                $colClass = count($videos) === 2 ? 'col-12 col-md-6' : 'col-12 col-md-6 col-lg-4';
                foreach ($videos as $vid):
                ?>
                <div class="<?= $colClass ?>">
                    <div class="qcs-iso-video-card h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="qcs-iso-video-header">
                                <span><i class="fa-solid fa-play text-danger me-2" aria-hidden="true"></i><?= htmlspecialchars($vid['header'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
                                <span class="badge bg-dark text-warning">HD</span>
                            </div>
                            <div class="ratio ratio-16x9">
                                <iframe src="<?= htmlspecialchars($vid['embed_url'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                        title="<?= htmlspecialchars($vid['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen=""
                                        loading="lazy"></iframe>
                            </div>
                        </div>
                        <?php if (!empty($vid['caption'])): ?>
                        <p class="qcs-iso-video-caption">
                            <i class="fa-solid fa-certificate text-warning me-1" aria-hidden="true"></i> <?= $vid['caption'] ?>
                        </p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>
    <?php endif; ?>

</main>
