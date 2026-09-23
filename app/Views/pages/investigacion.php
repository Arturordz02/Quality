<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Investigación y Colaboración con Stanford University
 * Archivo: app/Views/pages/investigacion.php
 */

declare(strict_types=1);
?>
<main class="page-content">

        <!-- ==========================================================================
             2. BANNER PRINCIPAL / ENCABEZADO DE LA PÁGINA
             ========================================================================== -->
        <section class="page-banner">
            <div class="page-banner-bg banner-research-bg"></div>
            <div class="page-banner-overlay"></div>
            <div class="page-banner-container">


                <div class="page-title-wrap">
                    <span class="section-tag"><i class="fa-solid fa-microscope"></i> Vanguardia Científica &amp; BIM</span>
                    <h1 class="page-main-title animate__animated animate__fadeInDown">Investigación y Colaboración con Stanford University</h1>
                    <div class="title-underline"></div>
                </div>

                <div class="intro-card">
                    <p class="intro-text animate__animated animate__fadeInUp animate__delay-1s">
                        Innovación técnica y rigor metodológico: Conozca las investigaciones científicas, publicaciones conjuntas y proyectos piloto desarrollados por <strong>Quality Consulting Solutions</strong> en estrecha alianza con el <strong>Center for Integrated Facility Engineering (CIFE) de Stanford University</strong>.
                    </p>
                </div>

            </div>
        </section>

        <!-- ==========================================================================
             3. SECCIÓN 1: STANFORD UNIVERSITY
             ========================================================================== -->
        <section class="content-section section-stanford" id="stanford-cife">
            <div class="section-container">
                
                <div class="grid-split-layout research-split-layout">
                    
                    <!-- Columna Izquierda: Imagen Clickeable de CIFE Stanford -->
                    <div class="split-image-col">
                        <div class="image-card-wrapper research-media-wrapper">
                            <!-- ================================================================= -->
                            <!-- Reemplazar imagen por la captura/banner de CIFE Stanford           -->
                            <!-- Recomendado: img/stanford_cife_orig.jpg                           -->
                            <!-- ================================================================= -->
                            <a href="https://cife.stanford.edu/" target="_blank" rel="noopener noreferrer" class="cife-image-link" aria-label="Visitar el sitio oficial del Centro de Ingeniería Integrada para Instalaciones (CIFE) de Stanford University">
                                <div class="image-container research-image-container">
                                    <img src="img/INV1.png" alt="Stanford CIFE - Center for Integrated Facility Engineering" class="section-image research-image" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&amp;w=600&amp;auto=format&amp;fit=crop';" loading="lazy" width="600" height="380">
                                    <div class="image-badge-tag badge-red">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i> Visitar CIFE Stanford
                                    </div>
                                    <div class="hover-overlay-hint">
                                        <span><i class="fa-solid fa-globe"></i> cife.stanford.edu</span>
                                    </div>
                                </div>
                            </a>
                            <div class="image-caption">
                                <p><i class="fa-solid fa-building-columns"></i> Center for Integrated Facility Engineering (CIFE) - Stanford University.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Columna Derecha: Texto Explicativo -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge">Alianza Académica Internacional</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">STANFORD UNIVERSITY</h2>
                            <div class="heading-line"></div>
                        </div>

                        <p class="paragraph-text paragraph-lead">
                            Quality Consulting Solutions con sus más de 7 años en el mercado es la única empresa en el medio que lleva a cabo colaboraciones con el Centro de Ingeniería Integrada para Instalaciones (CIFE) de la Universidad de Stanford (TOP 5 a nivel mundial).
                        </p>

                        <div class="stanford-highlights-pills">
                            <div class="highlight-pill">
                                <i class="fa-solid fa-ranking-star"></i>
                                <span>Universidad TOP 5 Global</span>
                            </div>
                            <div class="highlight-pill">
                                <i class="fa-solid fa-award"></i>
                                <span>Única Empresa Colaboradora en el Medio</span>
                            </div>
                            <div class="highlight-pill">
                                <i class="fa-solid fa-cubes"></i>
                                <span>Investigación en BIM LOD 400</span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             BANNER CLICKEABLE INTERMEDIO 1
             ========================================================================== -->
        <div class="banner-anuncio-container">
            <div class="header-container">
                <a href="/#capacitacion" class="banner-anuncio" aria-label="Anuncio: Capacitaciones Quality Consulting Solutions">
                    <span class="anuncio-icon-wrap"><i class="fa-solid fa-bullhorn"></i></span>
                    <span class="anuncio-text">ANUNCIO : CAPACITACIONES - QUALITY CONSULTING SOLUTIONS</span>
                    <span class="anuncio-arrow"><i class="fa-solid fa-arrow-right"></i></span>
                </a>
            </div>
        </div>

        <!-- ==========================================================================
             4. SECCIÓN 2: COLABORACIÓN 2019
             ========================================================================== -->
        <section class="content-section section-collab-2019 bg-alternate" id="colaboracion-2019">
            <div class="section-container">
                
                <div class="grid-split-layout research-split-layout">
                    
                    <!-- Columna Izquierda: 2 Videos de YouTube con Containers Responsive 16:9 -->
                    <div class="split-image-col videos-stack-col">
                        
                        <!-- Video 1 -->
                        <div class="responsive-video-box">
                            <div class="video-container-16-9">
                                <iframe src="https://www.youtube.com/embed/FjK7U4N5pLg" title="Colaboración 2019 CIFE Stanford &amp; Quality Consulting Solutions - Video 1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                            <div class="video-box-caption">
                                <span><i class="fa-brands fa-youtube"></i> Video 1: Monitoreo y Dashboard BIM</span>
                            </div>
                        </div>

                        <!-- Video 2 -->
                        <div class="responsive-video-box">
                            <div class="video-container-16-9">
                                <iframe src="https://www.youtube.com/embed/aHzNinSWCFI" title="Colaboración 2019 CIFE Stanford &amp; Quality Consulting Solutions - Video 2" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                            <div class="video-box-caption">
                                <span><i class="fa-brands fa-youtube"></i> Video 2: Implementación en Proyecto Las Begonias</span>
                            </div>
                        </div>

                    </div>

                    <!-- Columna Derecha: Texto Explicativo -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge">Investigación Aplicada en Campo</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">COLABORACIÓN 2019</h2>
                            <div class="heading-line"></div>
                        </div>

                        <p class="paragraph-text">
                            El junio de 2019 se llevó la segunda colaboración de Quality Consulting Solutions con el CIFE - Stanford, en esta oportunidad la investigación añadió un panel de monitoreo (dashboard; segundo 39 del video de 2:34 min).
                        </p>

                        <p class="paragraph-text">
                            Se seleccionó un proyecto de oficinas en el distrito de San Isidro, la zona financiera de Lima - Perú. Se contó con la participación de Cosapi s.a., una de las más grandes constructoras del medio, quienes abrieron las puertas de su proyecto Las Begonias.
                        </p>

                        <p class="paragraph-text">
                            Se trabajaron dos partidas (trades): muros de albañilería y tubería eléctrica (conduit). El modelado fue de LOD 400 (Level of Detail). Con un modelado BIM a ese detalle se puede tener alrededor del 95% de aproximación de los metrados (cantidades) de obra al contabilizar todos los elementos.
                        </p>

                        <p class="paragraph-text">
                            Asimismo, y como propuesta de Quality Consulting Solutions, se hizo una lectura sobre un nuevo indicador complementario al PPC (Percent Plan Complete), que tiene que ver con la lectura de "compleción de actividad a la primera" (BAPa)...
                        </p>

                        <p class="paragraph-text">
                            Se hizo una corrida del BAPa (PPC+) y se obtuvo que independiente del PPC el valor de este nuevo indicador era de alrededor del 25% para la semana.
                        </p>

                        <!-- Botón de llamada a la acción hacia el video del nuevo indicador -->
                        <div class="btn-action-wrapper">
                            <a href="https://www.youtube.com/watch?v=LvC_sDi1VSk" target="_blank" rel="noopener noreferrer" class="btn-saber-mas" aria-label="Ver video explicativo sobre el nuevo indicador BAPa en YouTube">
                                <i class="fa-brands fa-youtube"></i> Para saber más sobre el nuevo indicador click aquí <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             SEGUNDO BANNER CLICKEABLE INTERMEDIO 2
             ========================================================================== -->
        <div class="banner-anuncio-container">
            <div class="header-container">
                <a href="/#capacitacion" class="banner-anuncio" aria-label="Anuncio: Capacitaciones Quality Consulting Solutions">
                    <span class="anuncio-icon-wrap"><i class="fa-solid fa-bullhorn"></i></span>
                    <span class="anuncio-text">ANUNCIO : CAPACITACIONES - QUALITY CONSULTING SOLUTIONS</span>
                    <span class="anuncio-arrow"><i class="fa-solid fa-arrow-right"></i></span>
                </a>
            </div>
        </div>

        <!-- ==========================================================================
             5. SECCIÓN 3: COLABORACIÓN 2018
             ========================================================================== -->
        <section class="content-section section-collab-2018" id="colaboracion-2018">
            <div class="section-container">
                
                <div class="grid-split-layout research-split-layout">
                    
                    <!-- Columna Izquierda: Multimedia (Imagen + Video 3) -->
                    <div class="split-image-col videos-stack-col">
                        
                        <!-- Imagen Colaboración 2018 -->
                        <div class="image-card-wrapper research-media-wrapper">
                            <!-- ============================================================================ -->
                            <!-- Colocar IMAGEN con el nombre "icon-stanford-2_orig" dentro de la carpeta /img/ -->
                            <!-- ============================================================================ -->
                            <div class="image-container research-image-container">
                                <img src="img/cife.png" alt="Colaboración 2018 Stanford CIFE y Quality Consulting Solutions" class="section-image research-image" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1504384308090-c894fdcc538d?q=80&amp;w=600&amp;auto=format&amp;fit=crop';" loading="lazy" width="600" height="340">
                                <div class="image-badge-tag">
                                    <i class="fa-solid fa-award"></i> Hitos BIM Perú 2018
                                </div>
                            </div>
                        </div>

                        <!-- Video 3 -->
                        <div class="responsive-video-box">
                            <div class="video-container-16-9">
                                <iframe src="https://www.youtube.com/embed/O1dpihyo2eU" title="Colaboración 2018 CIFE Stanford &amp; Quality Consulting Solutions - Video 3" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                            <div class="video-box-caption">
                                <span><i class="fa-brands fa-youtube"></i> Video 3: Primera Investigación BIM Stanford en Perú</span>
                            </div>
                        </div>

                    </div>

                    <!-- Columna Derecha: Texto Explicativo con Viñetas -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge">Pioneros en Tecnología BIM</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">COLABORACIÓN 2018</h2>
                            <div class="heading-line"></div>
                        </div>

                        <p class="paragraph-text paragraph-lead">
                            El año 2018 se llevó a cabo la primera colaboración con el CIFE, logrando tres importantes hitos en nuestro país en materia de BIM (Building Information Modeling) en el sector construcción e inmobiliario:
                        </p>

                        <!-- Lista con viñetas de hitos históricos -->
                        <div class="hitos-checklist-wrap">
                            <ul class="hitos-checklist">
                                <li>
                                    <div class="hito-icon-badge"><i class="fa-solid fa-check"></i></div>
                                    <div class="hito-text">
                                        <strong>Se logró implementar la primera Sala BIM a pie de Obra.</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="hito-icon-badge"><i class="fa-solid fa-check"></i></div>
                                    <div class="hito-text">
                                        <strong>Se logró implementar el primer entorno BIM interactivo con personal capataz e ingenieros.</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="hito-icon-badge"><i class="fa-solid fa-check"></i></div>
                                    <div class="hito-text">
                                        <strong>Se logró la primera investigación en BIM en Perú por una universidad del prestigio de Stanford University.</strong>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <!-- Párrafos de Cierre -->
                        <p class="paragraph-text">
                            Nuestra Colaboración consistió en dar apoyo de soporte y coordinación para que un doctorando de dicha universidad visite nuestro país y lleve a cabo parte de su investigación doctoral en un proyecto de construcción donde se modelara en LOD 400...
                        </p>

                        <p class="paragraph-text">
                            Todo eso fue posible gracias a la sólida red de contactos que mantenemos en Quality Consulting Solutions y a la confianza lograda con el CIFE - Stanford.
                        </p>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             6. BANNER DE CONTACTO / CALL TO ACTION
             ========================================================================== -->
        <section class="cta-banner-section">
            <div class="cta-container">
                <div class="cta-box">
                    <div class="cta-content">
                        <span class="cta-tag">Innovación y Metodología Aplicada</span>
                        <h3 class="animate__animated animate__fadeInUp animate__delay-1s">¿Desea implementar metodologías de nivel Stanford en sus proyectos?</h3>
                        <p>Integre soluciones avanzadas de BIM LOD 400, Last Planner y analítica predictiva con nuestro equipo consultor.</p>
                    </div>
                    <div class="cta-actions">
                        <a href="/contacto" class="btn btn-large btn-qcs-primary">
                            <i class="fa-solid fa-envelope"></i> Solicitar Asesoría Técnica
                        </a>
                        <a href="https://whatsapp.com" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp btn-large animate__animated animate__pulse animate__infinite btn-qcs-primary">
                            <i class="fa-brands fa-whatsapp"></i> Contactar por WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>
