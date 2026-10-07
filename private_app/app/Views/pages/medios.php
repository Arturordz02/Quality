<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Medios, Publicaciones y Podcasts
 * Archivo: app/Views/pages/medios.php
 */

declare(strict_types=1);
?>
<style>
        body {
            background-color: #F4F5F7;
            color: #1e293b;
        }

        /* Hero Media Hub Style */
        .media-hero-banner {
            position: relative;
            padding: 190px 1.5rem 85px 1.5rem;
            background: linear-gradient(135deg, #0F1113 0%, #1A1D20 50%, #24292E 100%);
            color: #ffffff;
            overflow: hidden;
            border-bottom: 3px solid var(--accent-gold);
        }

        .media-hero-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 80% 20%, rgba(239, 68, 68, 0.18) 0%, transparent 60%),
                        radial-gradient(circle at 15% 85%, rgba(30, 215, 96, 0.15) 0%, transparent 60%);
            pointer-events: none;
        }

        /* Mensaje Misión de Contenidos */
        .media-mission-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-left: 5px solid #ef4444;
            border-radius: 16px;
            padding: 2.25rem 2rem;
            box-shadow: var(--shadow-sm);
            transition: all var(--transition-normal);
            position: relative;
        }

        .media-mission-card:hover {
            box-shadow: var(--shadow-md);
            border-color: #ef4444;
        }

        .media-mission-icon {
            position: absolute;
            top: 1.5rem;
            right: 2rem;
            font-size: 2.8rem;
            color: rgba(239, 68, 68, 0.12);
            pointer-events: none;
        }

        .media-mission-text {
            font-size: 1.05rem;
            line-height: 1.8;
            color: #334155;
            font-weight: 500;
            margin: 0;
        }

        /* Section 1: Podcasts Spotify Style Glassmorphism */
        .podcast-section-bg {
            background: linear-gradient(135deg, #0F1113 0%, #1A1D20 100%);
            color: #ffffff;
            position: relative;
            padding: 4.5rem 0;
        }

        .podcast-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
        }

        @media (max-width: 992px) {
            .podcast-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .podcast-grid {
                grid-template-columns: 1fr;
            }
        }

        .podcast-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 14px;
            padding: 1.4rem 1.25rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .podcast-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.1);
            border-color: #1ed760;
            box-shadow: 0 12px 28px rgba(30, 215, 96, 0.2);
        }

        .podcast-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.85rem;
        }

        .podcast-badge-cat {
            background: rgba(30, 215, 96, 0.18);
            color: #1ed760;
            font-family: var(--font-heading);
            font-size: 0.72rem;
            font-weight: 700;
            padding: 0.25rem 0.65rem;
            border-radius: 20px;
            border: 1px solid rgba(30, 215, 96, 0.35);
        }

        .podcast-spotify-icon {
            color: #1ed760;
            font-size: 1.35rem;
        }

        .podcast-card-title {
            font-family: var(--font-heading);
            font-size: 0.96rem;
            font-weight: 700;
            color: #ffffff;
            line-height: 1.4;
            margin-bottom: 1rem;
        }

        .btn-podcast-listen {
            background: #1ed760;
            color: #0F1113;
            font-family: var(--font-heading);
            font-size: 0.8rem;
            font-weight: 800;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            transition: all var(--transition-fast);
            border: none;
        }

        .btn-podcast-listen:hover {
            background: #ffffff;
            color: #0F1113;
            transform: scale(1.03);
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3);
        }

        /* Section 2: LinkedIn Editorial Grid */
        .linkedin-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
        }

        @media (max-width: 992px) {
            .linkedin-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .linkedin-grid {
                grid-template-columns: 1fr;
            }
        }

        .linkedin-article-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-top: 4px solid #0077b5;
            border-radius: 14px;
            padding: 1.5rem 1.35rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
        }

        .linkedin-article-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
            border-color: #0077b5;
        }

        .linkedin-article-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.85rem;
        }

        .linkedin-author-badge {
            font-size: 0.76rem;
            color: #64748b;
            font-weight: 600;
        }

        .linkedin-icon-badge {
            color: #0077b5;
            font-size: 1.25rem;
        }

        .linkedin-article-title {
            font-family: var(--font-heading);
            font-size: 0.98rem;
            font-weight: 700;
            color: var(--primary-blue);
            line-height: 1.4;
            margin-bottom: 0.5rem;
        }

        .linkedin-article-desc {
            font-size: 0.84rem;
            color: #64748b;
            line-height: 1.5;
            margin-bottom: 1.15rem;
            flex-grow: 1;
        }

        .btn-linkedin-read {
            color: #0077b5;
            font-family: var(--font-heading);
            font-size: 0.82rem;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            transition: all var(--transition-fast);
        }

        .btn-linkedin-read:hover {
            color: var(--primary-blue);
            gap: 0.55rem;
        }

        /* Video Card & Past Events */
        .video-card-box {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 1.25rem;
            box-shadow: var(--shadow-sm);
            transition: all var(--transition-normal);
            height: 100%;
        }

        .video-card-box:hover {
            box-shadow: var(--shadow-md);
            border-color: var(--accent-gold);
        }

        .event-feature-box {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-left: 4px solid var(--accent-gold);
            border-radius: 16px;
            padding: 2rem 1.75rem;
            box-shadow: var(--shadow-sm);
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        </style>

<main class="page-content">

        <!-- ==========================================================================
             1. ENCABEZADO HERO ESTILIZADO (Media & Knowledge Hub Style)
             ========================================================================== -->
        <section class="media-hero-banner">
            <div class="container text-center position-relative" style="z-index: 2;">
                
                <div class="mb-3">
                    <span class="badge bg-danger text-white px-3 py-2 rounded-pill fw-bold mb-2 shadow-sm">
                        <i class="fas fa-photo-video me-2"></i> CONTENIDOS &amp; DIVULGACIÓN TÉCNICA
                    </span>
                </div>

                <h1 class="display-5 fw-extrabold text-white text-uppercase tracking-wide mb-3 animate__animated animate__fadeInDown" style="font-family: var(--font-heading); font-weight: 800;">
                    MEDIOS, PUBLICACIONES Y PODCASTS
                </h1>

                <p class="lead text-light opacity-90 mx-auto mb-4" style="max-width: 860px; font-size: 1.15rem; color: #e2e8f0;">
                    Explora nuestra biblioteca de contenidos, podcast oficial en Spotify, artículos especializados en LinkedIn y entrevistas sobre gestión de la calidad y dirección de proyectos.
                </p>

                <div>
                    <a href="https://www.youtube.com/channel/UCbCdXwbcl-uouYa6Y4_kY0A?view_as=subscriber" target="_blank" rel="noopener noreferrer" class="btn btn-danger btn-lg me-2 fw-bold shadow-sm btn-qcs-primary" style="border-radius: 30px; padding: 0.8rem 1.8rem;">
                        <i class="fab fa-youtube me-2"></i> Suscribirse al Canal de YouTube
                    </a>
                </div>

            </div>
        </section>

        <!-- ==========================================================================
             2. MENSAJE MISIÓN DE CONTENIDOS
             ========================================================================== -->
        <section class="py-5" id="mision-contenidos">
            <div class="container py-3">
                <div class="media-mission-card">
                    <i class="fa-solid fa-bullhorn media-mission-icon"></i>
                    <p class="media-mission-text">
                        "Dado que nuestra misión es crear contenidos en materia de gestión de la calidad, no cesamos de tener presencia en medios y publicaciones. Presentamos nuestro canal de YouTube, nuestro podcast especializado, así como los artículos y entrevistas realizadas. ¡Estamos siempre deseosos de recibir vuestro feedback para seguir impulsando la gestión de proyectos y la calidad en nuestra región!"
                    </p>
                </div>
            </div>
        </section>

        <!-- ==========================================================================
             3. SECCIÓN 1: PODCAST OFICIAL EN SPOTIFY (11 Episodios)
             ========================================================================== -->
        <section class="podcast-section-bg" id="podcast-spotify">
            <div class="container">
                
                <div class="text-center mb-5">
                    <span class="badge bg-success text-dark px-3 py-2 rounded-pill fw-bold text-uppercase mb-2 shadow-sm">
                        <i class="fa-brands fa-spotify me-1"></i> Spotify Channel
                    </span>
                    <h2 class="display-6 fw-extrabold text-uppercase text-white animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading);">
                        PODCAST: GESTIÓN DE PROYECTOS, RIESGOS Y CALIDAD
                    </h2>
                    <div class="title-underline mx-auto" style="background: #1ed760;"></div>
                    <p class="text-light opacity-75 mx-auto mt-3" style="max-width: 760px;">
                        Episodios y reflexiones técnicas para escuchar en cualquier momento y lugar.
                    </p>
                </div>

                <div class="podcast-grid">
                    
                    <!-- Episodio 01 -->
                    <div class="podcast-card">
                        <div>
                            <div class="podcast-card-top">
                                <span class="podcast-badge-cat">Riesgos</span>
                                <i class="fa-brands fa-spotify podcast-spotify-icon"></i>
                            </div>
                            <h3 class="podcast-card-title animate__animated animate__fadeInUp animate__delay-1s">Episodio 01: Grandes Categorías de Riesgos de los Proyectos</h3>
                        </div>
                        <div>
                            <a href="https://creators.spotify.com/pod/profile/project-management/episodes/Grandes-Categoras-de-Riesgos-de-los-Proyectos-e17tpc5/a-a6jictu" target="_blank" rel="noopener noreferrer" class="btn-podcast-listen w-100">
                                <i class="fa-solid fa-play"></i> Escuchar Episodio
                            </a>
                        </div>
                    </div>

                    <!-- Episodio 02 -->
                    <div class="podcast-card">
                        <div>
                            <div class="podcast-card-top">
                                <span class="podcast-badge-cat">Entorno</span>
                                <i class="fa-brands fa-spotify podcast-spotify-icon"></i>
                            </div>
                            <h3 class="podcast-card-title animate__animated animate__fadeInUp animate__delay-1s">Episodio 02: ¿En qué contexto se mueven los proyectos?</h3>
                        </div>
                        <div>
                            <a href="https://creators.spotify.com/pod/profile/project-management/episodes/En-qu-contexto-se-mueven-los-proyectos-eg1u6h/a-a2j04qr" target="_blank" rel="noopener noreferrer" class="btn-podcast-listen w-100">
                                <i class="fa-solid fa-play"></i> Escuchar Episodio
                            </a>
                        </div>
                    </div>

                    <!-- Episodio 03 -->
                    <div class="podcast-card">
                        <div>
                            <div class="podcast-card-top">
                                <span class="podcast-badge-cat">Mejora Continua</span>
                                <i class="fa-brands fa-spotify podcast-spotify-icon"></i>
                            </div>
                            <h3 class="podcast-card-title animate__animated animate__fadeInUp animate__delay-1s">Episodio 03: Lecciones aprendidas... ¿de verdad?</h3>
                        </div>
                        <div>
                            <a href="https://creators.spotify.com/pod/profile/project-management/episodes/Lecciones-aprendidas-de-verdad-eihbb8/a-a3107cb" target="_blank" rel="noopener noreferrer" class="btn-podcast-listen w-100">
                                <i class="fa-solid fa-play"></i> Escuchar Episodio
                            </a>
                        </div>
                    </div>

                    <!-- Episodio 04 -->
                    <div class="podcast-card">
                        <div>
                            <div class="podcast-card-top">
                                <span class="podcast-badge-cat">Cultura Org.</span>
                                <i class="fa-brands fa-spotify podcast-spotify-icon"></i>
                            </div>
                            <h3 class="podcast-card-title animate__animated animate__fadeInUp animate__delay-1s">Episodio 04: TIP: ¿Hay cultura de calidad en tu organización?</h3>
                        </div>
                        <div>
                            <a href="https://creators.spotify.com/pod/profile/project-management/episodes/TIP--Hay-cultura-de-calidad-en-tu-organizacin-eg2072/a-a2j0hrv" target="_blank" rel="noopener noreferrer" class="btn-podcast-listen w-100">
                                <i class="fa-solid fa-play"></i> Escuchar Episodio
                            </a>
                        </div>
                    </div>

                    <!-- Episodio 05 -->
                    <div class="podcast-card">
                        <div>
                            <div class="podcast-card-top">
                                <span class="podcast-badge-cat">Riesgos</span>
                                <i class="fa-brands fa-spotify podcast-spotify-icon"></i>
                            </div>
                            <h3 class="podcast-card-title animate__animated animate__fadeInUp animate__delay-1s">Episodio 05: Gestión de Riesgos: más allá de SSOMA</h3>
                        </div>
                        <div>
                            <a href="https://creators.spotify.com/pod/profile/project-management/episodes/Gestin-de-Riesgos--ms-all-de-SSOMA-e17t383/a-a6jid16" target="_blank" rel="noopener noreferrer" class="btn-podcast-listen w-100">
                                <i class="fa-solid fa-play"></i> Escuchar Episodio
                            </a>
                        </div>
                    </div>

                    <!-- Episodio 06 -->
                    <div class="podcast-card">
                        <div>
                            <div class="podcast-card-top">
                                <span class="podcast-badge-cat">Lean Construction</span>
                                <i class="fa-brands fa-spotify podcast-spotify-icon"></i>
                            </div>
                            <h3 class="podcast-card-title animate__animated animate__fadeInUp animate__delay-1s">Episodio 06: Entrevista: Last Planner System y Calidad - Parte 1</h3>
                        </div>
                        <div>
                            <a href="https://creators.spotify.com/pod/profile/project-management/episodes/Entrevista-Last-Planner-y-Calidad---Parte-1-eg368b/a-a2j70sf" target="_blank" rel="noopener noreferrer" class="btn-podcast-listen w-100">
                                <i class="fa-solid fa-play"></i> Escuchar Episodio
                            </a>
                        </div>
                    </div>

                    <!-- Episodio 07 -->
                    <div class="podcast-card">
                        <div>
                            <div class="podcast-card-top">
                                <span class="podcast-badge-cat">Lean Construction</span>
                                <i class="fa-brands fa-spotify podcast-spotify-icon"></i>
                            </div>
                            <h3 class="podcast-card-title animate__animated animate__fadeInUp animate__delay-1s">Episodio 07: Entrevista: Last Planner System y Calidad - Parte 2</h3>
                        </div>
                        <div>
                            <a href="https://creators.spotify.com/pod/profile/project-management/episodes/Entrevista-Last-Planner-y-Calidad---Parte-2-egargn/a-a2kiokg" target="_blank" rel="noopener noreferrer" class="btn-podcast-listen w-100">
                                <i class="fa-solid fa-play"></i> Escuchar Episodio
                            </a>
                        </div>
                    </div>

                    <!-- Episodio 08 -->
                    <div class="podcast-card">
                        <div>
                            <div class="podcast-card-top">
                                <span class="podcast-badge-cat">Construcción</span>
                                <i class="fa-brands fa-spotify podcast-spotify-icon"></i>
                            </div>
                            <h3 class="podcast-card-title animate__animated animate__fadeInUp animate__delay-1s">Episodio 08: Factores de Incertidumbre y Riesgos en la Construcción</h3>
                        </div>
                        <div>
                            <a href="https://creators.spotify.com/pod/profile/project-management/episodes/Factores-de-Incertidumbre-y-Riesgos-en-la-Construccin-e18spba/a-a6jdvfi" target="_blank" rel="noopener noreferrer" class="btn-podcast-listen w-100">
                                <i class="fa-solid fa-play"></i> Escuchar Episodio
                            </a>
                        </div>
                    </div>

                    <!-- Episodio 09 -->
                    <div class="podcast-card">
                        <div>
                            <div class="podcast-card-top">
                                <span class="podcast-badge-cat">Planificación</span>
                                <i class="fa-brands fa-spotify podcast-spotify-icon"></i>
                            </div>
                            <h3 class="podcast-card-title animate__animated animate__fadeInUp animate__delay-1s">Episodio 09: TIP: ¿Las restricciones son buenas o malas?</h3>
                        </div>
                        <div>
                            <a href="https://creators.spotify.com/pod/profile/project-management/episodes/TIP--Las-restricciones-son-buenas-o-malas-eg1vd8/a-a2j0d8i" target="_blank" rel="noopener noreferrer" class="btn-podcast-listen w-100">
                                <i class="fa-solid fa-play"></i> Escuchar Episodio
                            </a>
                        </div>
                    </div>

                    <!-- Episodio 10 -->
                    <div class="podcast-card">
                        <div>
                            <div class="podcast-card-top">
                                <span class="podcast-badge-cat">Casos de Éxito</span>
                                <i class="fa-brands fa-spotify podcast-spotify-icon"></i>
                            </div>
                            <h3 class="podcast-card-title animate__animated animate__fadeInUp animate__delay-1s">Episodio 10: Excelencia Operacional: La historia de Robert Davidson - Parte 1</h3>
                        </div>
                        <div>
                            <a href="https://creators.spotify.com/pod/profile/project-management/episodes/Excelencia-Operacional-La-historia-de-Robert-Davidson-Parte---1-eo207i/a-a465shf" target="_blank" rel="noopener noreferrer" class="btn-podcast-listen w-100">
                                <i class="fa-solid fa-play"></i> Escuchar Episodio
                            </a>
                        </div>
                    </div>

                    <!-- Episodio 11 -->
                    <div class="podcast-card">
                        <div>
                            <div class="podcast-card-top">
                                <span class="podcast-badge-cat">Gestión de Riesgos</span>
                                <i class="fa-brands fa-spotify podcast-spotify-icon"></i>
                            </div>
                            <h3 class="podcast-card-title animate__animated animate__fadeInUp animate__delay-1s">Episodio 11: Los riesgos no se planifican, se gestionan</h3>
                        </div>
                        <div>
                            <a href="https://creators.spotify.com/pod/profile/project-management/episodes/Los-riesgos-no-se-planifican--se-gestionan-eg1ki4/a-a2iue5t" target="_blank" rel="noopener noreferrer" class="btn-podcast-listen w-100">
                                <i class="fa-solid fa-play"></i> Escuchar Episodio
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             4. SECCIÓN 2: ARTÍCULOS ESPECIALIZADOS (LinkedIn Editorial Grid)
             ========================================================================== -->
        <section class="py-5 bg-white border-top border-bottom" id="articulos-linkedin">
            <div class="container py-3">
                
                <div class="text-center mb-5">
                    <span class="badge bg-warning-subtle text-dark px-3 py-2 rounded-pill fw-bold text-uppercase mb-2 shadow-sm">
                        <i class="fa-brands fa-linkedin me-1"></i> Artículos Técnicos
                    </span>
                    <h2 class="display-6 fw-extrabold text-uppercase text-dark animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); color: var(--primary-blue);">
                        ARTÍCULOS Y PUBLICACIONES EN LINKEDIN
                    </h2>
                    <div class="title-underline mx-auto"></div>
                    <p class="text-secondary mx-auto mt-3" style="max-width: 780px;">
                        Artículos técnicos desarrollados por el <strong>Ing. Omar Samaniego</strong> sobre gestión de proyectos, calidad, procesos y normativa.
                    </p>
                </div>

                <div class="linkedin-grid">
                    
                    <!-- 1 -->
                    <div class="linkedin-article-card">
                        <div>
                            <div class="linkedin-article-header">
                                <span class="linkedin-author-badge">Ing. Omar Samaniego</span>
                                <i class="fa-brands fa-linkedin linkedin-icon-badge"></i>
                            </div>
                            <h3 class="linkedin-article-title animate__animated animate__fadeInUp animate__delay-1s">Control de Proyectos y Calidad</h3>
                            <p class="linkedin-article-desc">Monitoreo, control y aseguramiento de la calidad en las etapas del ciclo de vida de los proyectos.</p>
                        </div>
                        <a href="https://www.linkedin.com/pulse/calidad-monitoreo-y-control-samaniego-pmp-irca-lss-black-belt" target="_blank" rel="noopener noreferrer" class="btn-linkedin-read">
                            Leer en LinkedIn <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                    </div>

                    <!-- 2 -->
                    <div class="linkedin-article-card">
                        <div>
                            <div class="linkedin-article-header">
                                <span class="linkedin-author-badge">Ing. Omar Samaniego</span>
                                <i class="fa-brands fa-linkedin linkedin-icon-badge"></i>
                            </div>
                            <h3 class="linkedin-article-title animate__animated animate__fadeInUp animate__delay-1s">2014, Creación del Comité de Calidad</h3>
                            <p class="linkedin-article-desc">Orígenes, antecedentes e hito fundacional en la industria de la construcción.</p>
                        </div>
                        <a href="https://www.linkedin.com/pulse/la-creaci%C3%B3n-del-comit%C3%A9-de-calidad-omar-a-samaniego-pmp-" target="_blank" rel="noopener noreferrer" class="btn-linkedin-read">
                            Leer en LinkedIn <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                    </div>

                    <!-- 3 -->
                    <div class="linkedin-article-card">
                        <div>
                            <div class="linkedin-article-header">
                                <span class="linkedin-author-badge">Ing. Omar Samaniego</span>
                                <i class="fa-brands fa-linkedin linkedin-icon-badge"></i>
                            </div>
                            <h3 class="linkedin-article-title animate__animated animate__fadeInUp animate__delay-1s">Gestión de Calidad y Proveedores</h3>
                            <p class="linkedin-article-desc">Evaluación, control de calidad y homologación en la cadena de suministro de obras.</p>
                        </div>
                        <a href="https://www.linkedin.com/pulse/20141126020937-42595720-gesti%C3%B3n-de-proveedores-y-calidad" target="_blank" rel="noopener noreferrer" class="btn-linkedin-read">
                            Leer en LinkedIn <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                    </div>

                    <!-- 4 -->
                    <div class="linkedin-article-card">
                        <div>
                            <div class="linkedin-article-header">
                                <span class="linkedin-author-badge">Ing. Omar Samaniego</span>
                                <i class="fa-brands fa-linkedin linkedin-icon-badge"></i>
                            </div>
                            <h3 class="linkedin-article-title animate__animated animate__fadeInUp animate__delay-1s">Excelencia Operacional y Calidad</h3>
                            <p class="linkedin-article-desc">Estrategias de optimización de procesos y mejora continua aplicadas a empresas de ingeniería.</p>
                        </div>
                        <a href="https://www.linkedin.com/pulse/20141009030125-42595720-excelencia-operacional-y-calidad" target="_blank" rel="noopener noreferrer" class="btn-linkedin-read">
                            Leer en LinkedIn <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                    </div>

                    <!-- 5 -->
                    <div class="linkedin-article-card">
                        <div>
                            <div class="linkedin-article-header">
                                <span class="linkedin-author-badge">Ing. Omar Samaniego</span>
                                <i class="fa-brands fa-linkedin linkedin-icon-badge"></i>
                            </div>
                            <h3 class="linkedin-article-title animate__animated animate__fadeInUp animate__delay-1s">¡Soluciónalo Ya!</h3>
                            <p class="linkedin-article-desc">Enfoque práctico ante problemas de no conformidad y resolución ágil de fallas en terreno.</p>
                        </div>
                        <a href="https://www.linkedin.com/pulse/20140718153858-42595720--solucionalo-ya" target="_blank" rel="noopener noreferrer" class="btn-linkedin-read">
                            Leer en LinkedIn <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                    </div>

                    <!-- 6 -->
                    <div class="linkedin-article-card">
                        <div>
                            <div class="linkedin-article-header">
                                <span class="linkedin-author-badge">Ing. Omar Samaniego</span>
                                <i class="fa-brands fa-linkedin linkedin-icon-badge"></i>
                            </div>
                            <h3 class="linkedin-article-title animate__animated animate__fadeInUp animate__delay-1s">Philip Crosby: 14 Pasos (Paso 3)</h3>
                            <p class="linkedin-article-desc">Evaluación y medición del costo de la calidad en las operaciones.</p>
                        </div>
                        <a href="https://www.linkedin.com/pulse/20140616152520-42595720-philip-crosby-14-pasos-para-la-mejora-de-la-calidad-paso-3" target="_blank" rel="noopener noreferrer" class="btn-linkedin-read">
                            Leer en LinkedIn <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                    </div>

                    <!-- 7 -->
                    <div class="linkedin-article-card">
                        <div>
                            <div class="linkedin-article-header">
                                <span class="linkedin-author-badge">Ing. Omar Samaniego</span>
                                <i class="fa-brands fa-linkedin linkedin-icon-badge"></i>
                            </div>
                            <h3 class="linkedin-article-title animate__animated animate__fadeInUp animate__delay-1s">Philip Crosby: 14 Pasos (Paso 2)</h3>
                            <p class="linkedin-article-desc">Conformación y liderazgo del equipo de mejora continua de la calidad.</p>
                        </div>
                        <a href="https://www.linkedin.com/pulse/20140525160856-42595720-philip-crosby-14-pasos-para-la-mejora-de-a-calidad-paso-2" target="_blank" rel="noopener noreferrer" class="btn-linkedin-read">
                            Leer en LinkedIn <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                    </div>

                    <!-- 8 -->
                    <div class="linkedin-article-card">
                        <div>
                            <div class="linkedin-article-header">
                                <span class="linkedin-author-badge">Ing. Omar Samaniego</span>
                                <i class="fa-brands fa-linkedin linkedin-icon-badge"></i>
                            </div>
                            <h3 class="linkedin-article-title animate__animated animate__fadeInUp animate__delay-1s">Philip Crosby: 14 Pasos (Paso 1)</h3>
                            <p class="linkedin-article-desc">Compromiso y visión estratégica de la alta dirección hacia la cultura de calidad.</p>
                        </div>
                        <a href="https://www.linkedin.com/pulse/20140512014410-42595720-philip-crosby-14-pasos-para-la-mejora-de-la-calidad-paso-1" target="_blank" rel="noopener noreferrer" class="btn-linkedin-read">
                            Leer en LinkedIn <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                    </div>

                    <!-- 9 -->
                    <div class="linkedin-article-card">
                        <div>
                            <div class="linkedin-article-header">
                                <span class="linkedin-author-badge">Ing. Omar Samaniego</span>
                                <i class="fa-brands fa-linkedin linkedin-icon-badge"></i>
                            </div>
                            <h3 class="linkedin-article-title animate__animated animate__fadeInUp animate__delay-1s">¿Tenemos Construcciones de Calidad?</h3>
                            <p class="linkedin-article-desc">Reflexión crítica sobre el estado del sector y la infraestructura actual en la región.</p>
                        </div>
                        <a href="https://www.linkedin.com/pulse/20140508151448-42595720--tenemos-construcciones-de-calidad" target="_blank" rel="noopener noreferrer" class="btn-linkedin-read">
                            Leer en LinkedIn <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                    </div>

                    <!-- 10 -->
                    <div class="linkedin-article-card">
                        <div>
                            <div class="linkedin-article-header">
                                <span class="linkedin-author-badge">Ing. Omar Samaniego</span>
                                <i class="fa-brands fa-linkedin linkedin-icon-badge"></i>
                            </div>
                            <h3 class="linkedin-article-title animate__animated animate__fadeInUp animate__delay-1s">ISO 9001: ¿Selfie o Foto Espontánea?</h3>
                            <p class="linkedin-article-desc">Certificación real para el crecimiento frente a la mera apariencia para el mercado.</p>
                        </div>
                        <a href="https://www.linkedin.com/pulse/20140501154856-42595720-certificaci%C3%B3n-iso-9001-selfie-para-el-mercado-o-una-foto-espontanea-de-la-organizaci%C3%B3n" target="_blank" rel="noopener noreferrer" class="btn-linkedin-read">
                            Leer en LinkedIn <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                    </div>

                    <!-- 11 -->
                    <div class="linkedin-article-card">
                        <div>
                            <div class="linkedin-article-header">
                                <span class="linkedin-author-badge">Ing. Omar Samaniego</span>
                                <i class="fa-brands fa-linkedin linkedin-icon-badge"></i>
                            </div>
                            <h3 class="linkedin-article-title animate__animated animate__fadeInUp animate__delay-1s">Enfoque al Cliente en Construcción</h3>
                            <p class="linkedin-article-desc">Satisfacción integral y estricto cumplimiento de requisitos técnicos en obra.</p>
                        </div>
                        <a href="https://www.linkedin.com/pulse/20140426141804-42595720-enfoque-al-cliente-durante-la-construcci%C3%B3n" target="_blank" rel="noopener noreferrer" class="btn-linkedin-read">
                            Leer en LinkedIn <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             5. SECCIÓN 3: ENTREVISTAS Y VIDEOS DESTACADOS (YouTube Video Grid)
             ========================================================================== -->
        <section class="py-5" style="background-color: var(--qcs-bg-light);" id="entrevistas-videos">
            <div class="container py-3">
                
                <div class="text-center mb-5">
                    <span class="badge bg-danger text-white px-3 py-2 rounded-pill fw-bold text-uppercase mb-2 shadow-sm">
                        <i class="fa-brands fa-youtube me-1"></i> Producciones Audiovisuales
                    </span>
                    <h2 class="display-6 fw-extrabold text-uppercase text-dark animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); color: var(--primary-blue);">
                        ENTREVISTAS Y PARTICIPACIÓN EN MEDIOS
                    </h2>
                    <div class="title-underline mx-auto" style="background: #ef4444;"></div>
                    <p class="text-secondary mx-auto mt-3" style="max-width: 760px;">
                        Ponencias, análisis del sector construcción y entrevistas técnicas transmitidas en diversos medios.
                    </p>
                </div>

                <div class="row g-4 justify-content-center">
                    
                    <!-- Video 1 -->
                    <div class="col-12 col-md-6">
                        <div class="video-card-box">
                            <h5 class="fw-bold mb-2 text-dark" style="font-family: var(--font-heading); font-size: 1rem;">
                                <i class="fa-solid fa-film text-danger me-2"></i> El precio de las viviendas y la calidad
                            </h5>
                            <div class="ratio ratio-16x9 shadow rounded-3 overflow-hidden">
                                <iframe src="https://www.youtube.com/embed/_9cJ9yAWDek" title="El precio de las viviendas y la calidad" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div>
                    </div>

                    <!-- Video 2 -->
                    <div class="col-12 col-md-6">
                        <div class="video-card-box">
                            <h5 class="fw-bold mb-2 text-dark" style="font-family: var(--font-heading); font-size: 1rem;">
                                <i class="fa-solid fa-film text-danger me-2"></i> Construcciones de Calidad y los Terremotos
                            </h5>
                            <div class="ratio ratio-16x9 shadow rounded-3 overflow-hidden">
                                <iframe src="https://www.youtube.com/embed/Qh4LQbryvms" title="Construcciones de Calidad y los Terremotos" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div>
                    </div>

                    <!-- Video 3 -->
                    <div class="col-12 col-md-6">
                        <div class="video-card-box">
                            <h5 class="fw-bold mb-2 text-dark" style="font-family: var(--font-heading); font-size: 1rem;">
                                <i class="fa-solid fa-film text-danger me-2"></i> Creación del Comité de Calidad de CAPECO
                            </h5>
                            <div class="ratio ratio-16x9 shadow rounded-3 overflow-hidden">
                                <iframe src="https://www.youtube.com/embed/3pCkxOPQ5_8" title="Creación del Comité de Calidad de CAPECO" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div>
                    </div>

                    <!-- Video 4 -->
                    <div class="col-12 col-md-6">
                        <div class="video-card-box">
                            <h5 class="fw-bold mb-2 text-dark" style="font-family: var(--font-heading); font-size: 1rem;">
                                <i class="fa-solid fa-film text-danger me-2"></i> Alcance y Calidad en Proyectos
                            </h5>
                            <div class="ratio ratio-16x9 shadow rounded-3 overflow-hidden">
                                <iframe src="https://www.youtube.com/embed/pnlZa_A5DPc" title="Alcance y Calidad en Proyectos" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div>
                    </div>

                    <!-- Video 5 Promocional Adicional -->
                    <div class="col-12 col-lg-8 mt-4">
                        <div class="video-card-box">
                            <h5 class="fw-bold mb-2 text-dark text-center" style="font-family: var(--font-heading); font-size: 1rem;">
                                <i class="fa-solid fa-bullhorn text-danger me-2"></i> Conferencia de Calidad QCS
                            </h5>
                            <div class="ratio ratio-16x9 shadow rounded-3 overflow-hidden">
                                <iframe src="https://www.youtube.com/embed/LqZBCKiF-4w" title="Conferencia de Calidad QCS" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             6. SECCIÓN 4: EVENTOS PASADOS, WEBINARS Y PANELES DE DISCUSIÓN
             ========================================================================== -->
        <section class="py-5 bg-white border-top border-bottom" id="eventos-webinars">
            <div class="container py-3">
                
                <div class="text-center mb-5">
                    <span class="badge bg-warning-subtle text-warning-emphasis px-3 py-2 rounded-pill fw-bold text-uppercase mb-2 shadow-sm">
                        <i class="fa-solid fa-users-viewfinder me-1"></i> Paneles de Expertos
                    </span>
                    <h2 class="display-6 fw-extrabold text-uppercase text-dark animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); color: var(--primary-blue);">
                        EVENTOS PASADOS, WEBINARS Y PANELES DE DISCUSIÓN
                    </h2>
                    <div class="title-underline mx-auto"></div>
                </div>

                <div class="row g-4 align-items-stretch">
                    
                    <!-- Columna Izquierda: Video del Panel -->
                    <div class="col-12 col-lg-6">
                        <div class="ratio ratio-16x9 shadow-lg rounded-4 overflow-hidden h-100 border border-2 border-dark-subtle">
                            <iframe src="https://www.youtube.com/embed/x41lT53XiMw" title="Panel Quality Consulting Solutions TV - Oportunidades en Eventos Adversos" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                    </div>

                    <!-- Columna Derecha: Tarjeta Descriptiva del Evento -->
                    <div class="col-12 col-lg-6">
                        <div class="event-feature-box">
                            <div>
                                <span class="badge bg-dark text-white mb-2">Panel Virtual Internacional</span>
                                <h3 class="fw-bold mb-3 animate__animated animate__fadeInUp animate__delay-1s" style="font-family: var(--font-heading); color: var(--primary-blue); font-size: 1.25rem;">
                                    ¿Qué oportunidades aprovechar durante eventos adversos? (#YoMeQuedoEnCasa #COVID19)
                                </h3>

                                <p class="text-secondary small mb-3">
                                    Encuentro técnico y estratégico organizado por <strong>Quality Consulting Solutions TV</strong> con destacados ponentes internacionales:
                                </p>

                                <ul class="list-unstyled mb-4 text-dark" style="font-size: 0.88rem; line-height: 1.6;">
                                    <li class="mb-1"><i class="fa-solid fa-user-tie text-dark me-2"></i> <strong>Eneida Góngora</strong> (México)</li>
                                    <li class="mb-1"><i class="fa-solid fa-user-tie text-dark me-2"></i> <strong>Gustavo Albera</strong> (Argentina)</li>
                                    <li class="mb-1"><i class="fa-solid fa-user-tie text-dark me-2"></i> <strong>Fernando Cerveró</strong> (España)</li>
                                </ul>

                                <div class="p-3 bg-light rounded-3 border">
                                    <h6 class="fw-bold text-uppercase small text-dark mb-2">
                                        <i class="fa-solid fa-chalkboard-user me-1"></i> Serie de Charlas Destacadas QCS:
                                    </h6>
                                    <ul class="list-unstyled mb-0 text-secondary" style="font-size: 0.84rem; line-height: 1.5;">
                                        <li class="mb-1">• <strong>Gestión de la Calidad &amp; Last Planner System</strong> (Omar Samaniego &amp; José Luis Salvatierra)</li>
                                        <li class="mb-1">• <strong>Project Management Activo en Tiempo de Crisis</strong> (Adriana Rodríguez)</li>
                                        <li>• <strong>Empleabilidad a Prueba de Crisis</strong> (Elizabeth Montoya)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             7. LLAMADO A LA ACCIÓN FINAL (Contacto & Feedback)
             ========================================================================== -->
        <section class="cta-banner-section" id="contacto-final">
            <div class="cta-container">
                <div class="cta-box">
                    <div class="cta-content">
                        <span class="cta-tag"><i class="fa-solid fa-microphone-lines"></i> Conferencias &amp; Capacitación In-House</span>
                        <h3 class="animate__animated animate__fadeInUp animate__delay-1s">¿Te gustaría organizar una charla o webinar in-house en tu empresa?</h3>
                        <p>
                            Escríbenos para coordinar conferencias técnicas, ponencias ejecutivas y capacitaciones a la medida de tu equipo de trabajo.
                        </p>
                        
                        <div class="cta-phone-wrapper" style="margin-top: 1.25rem;">
                            <a href="tel:+51993463118" class="cta-phone-link" aria-label="Llamar al +51 993 463 118">
                                <i class="fa-solid fa-phone-volume"></i>
                                <span>+51 993 463 118</span>
                            </a>
                        </div>
                    </div>

                    <div class="cta-actions">
                        <a href="https://api.whatsapp.com/send?phone=51993463118&amp;text=Hola,%20quisiera%20consultar%20sobre%20las%20charlas%20y%20publicaciones%20de%20Quality%20Consulting%20Solutions" target="_blank" rel="noopener noreferrer" class="btn btn-success btn-large btn-qcs-primary">
                            <i class="fab fa-whatsapp"></i> Contactar por WhatsApp
                        </a>
                        <a href="/contacto" class="btn btn-large btn-qcs-primary">
                            <i class="fa-solid fa-envelope"></i> Formulario de Contacto
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>
