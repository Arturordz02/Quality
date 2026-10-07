<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de P?gina: Headhunting Especializado para la Construcci?n
 * Archivo: app/Views/pages/headhunting.php
 */

declare(strict_types=1);
?>
<main class="page-content">

        <!-- ==========================================================================
             2. SECCIÓN HERO / ENCABEZADO PRINCIPAL (Con Grid de 3 Problemáticas)
             ========================================================================== -->
        <section class="page-banner">
            <div class="page-banner-bg banner-headhunting-bg"></div>
            <div class="page-banner-overlay"></div>
            <div class="page-banner-container">


                <div class="page-title-wrap">
                    <span class="section-tag"><i class="fa-solid fa-user-check"></i> Selección de Talento Senior</span>
                    <h1 class="page-main-title animate__animated animate__fadeInDown">HEADHUNTING ESPECIALIZADO PARA LA CONSTRUCCIÓN</h1>
                    <div class="title-underline"></div>
                </div>

                <div class="intro-card intro-card-highlight">
                    <p class="intro-text animate__animated animate__fadeInUp animate__delay-1s">
                        Encontramos a los profesionales idóneos para posiciones estratégicas en proyectos de ingeniería y construcción. Entendemos los requerimientos técnicos reales de la obra y el gabinete porque <strong>somos ingenieros evaluando ingenieros</strong>.
                    </p>
                </div>

                <!-- Grid de 3 Tarjetas de Problemáticas Clave -->
                <div class="problems-grid">
                    
                    <!-- Tarjeta 1 -->
                    <div class="problem-card">
                        <div class="problem-icon-wrap">
                            <i class="fa-solid fa-stopwatch"></i>
                        </div>
                        <div class="problem-content">
                            <span class="problem-tag">Urgencia Operativa</span>
                            <h3 class="problem-title animate__animated animate__fadeInUp animate__delay-1s">Llegada inesperada de múltiples requerimientos para posiciones clave.</h3>
                        </div>
                    </div>

                    <!-- Tarjeta 2 -->
                    <div class="problem-card">
                        <div class="problem-icon-wrap">
                            <i class="fa-solid fa-file-invoice"></i>
                        </div>
                        <div class="problem-content">
                            <span class="problem-tag">Complejidad Técnica</span>
                            <h3 class="problem-title animate__animated animate__fadeInUp animate__delay-1s">Información técnica fragmentada o difícil de comprender.</h3>
                        </div>
                    </div>

                    <!-- Tarjeta 3 -->
                    <div class="problem-card">
                        <div class="problem-icon-wrap">
                            <i class="fa-solid fa-user-gear"></i>
                        </div>
                        <div class="problem-content">
                            <span class="problem-tag">Brecha de Comunicación</span>
                            <h3 class="problem-title animate__animated animate__fadeInUp animate__delay-1s">Necesidad de explicar extensamente los perfiles técnicos requeridos.</h3>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             3. PRESENTACIÓN DEL SERVICIO (Layout de 2 Columnas Responsive)
             ========================================================================== -->
        <section class="content-section section-headhunting-about" id="presentacion-servicio">
            <div class="section-container">
                
                <div class="grid-split-layout research-split-layout">
                    
                    <!-- Columna Izquierda: Texto Explicativo -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge">Soluciones de Selección Técnica</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">Atracción y Selección de Talento de Alto Rendimiento</h2>
                            <div class="heading-line"></div>
                        </div>

                        <p class="paragraph-text paragraph-lead">
                            El éxito de un proyecto de construcción reside en la idoneidad, liderazgo y competencia técnica de quienes lo dirigen. Nuestro servicio de Headhunting Especializado conecta a las empresas constructoras, inmobiliarias y de ingeniería con profesionales probados en el campo.
                        </p>

                        <p class="paragraph-text">
                            A diferencia del reclutamiento tradicional, nuestro equipo de consultores senior comprende al detalle el lenguaje de obra, las tipologías contractuales (NEC, FIDIC, Ley de Contrataciones con el Estado), los estándares internacionales (PMI, Lean Construction, BIM) y las exigencias de plazos y costos.
                        </p>

                        <p class="paragraph-text">
                            Realizamos evaluaciones técnicas rigurosas y análisis de competencias blandas, entregando ternas calificadas listas para integrarse y aportar valor operativo desde el primer día.
                        </p>

                        <div class="headhunting-features-list">
                            <div class="feature-item-inline">
                                <i class="fa-solid fa-circle-check"></i>
                                <span>Evaluaciones técnicas diseñadas por consultores senior.</span>
                            </div>
                            <div class="feature-item-inline">
                                <i class="fa-solid fa-circle-check"></i>
                                <span>Validación de experiencia en proyectos de alta complejidad.</span>
                            </div>
                            <div class="feature-item-inline">
                                <i class="fa-solid fa-circle-check"></i>
                                <span>Tiempos de respuesta ágiles y garantía de reemplazo.</span>
                            </div>
                        </div>
                    </div>

                    <!-- Columna Derecha: Video Responsive 16:9 -->
                    <div class="split-image-col">
                        <div class="responsive-video-box video-headhunting-card">
                            <div class="video-container-16-9">
                                <iframe src="https://www.youtube.com/embed/2H6YHpanuac" title="Headhunting Especializado para la Construcción - Quality Consulting Solutions" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                            <div class="video-box-caption">
                                <span><i class="fa-brands fa-youtube"></i> Conoce nuestra metodología de Headhunting en Construcción</span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             4. BLOQUES DE INFORMACIÓN DEL SERVICIO (4 Cards / Grid 2x2 Limpio)
             ========================================================================== -->
        <section class="content-section bg-alternate section-pillars" id="pilares-servicio">
            <div class="section-container">
                
                <div class="section-header-center">
                    <span class="sub-badge">Ejes Estratégicos</span>
                    <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">NUESTRO VALOR EN EL MERCADO</h2>
                    <div class="heading-line center-line"></div>
                    <p class="section-subtitle-text">Una estructura metodológica diseñada para garantizar precisión, agilidad y efectividad en cada proceso de selección.</p>
                </div>

                <!-- Grid de 4 Cards (2x2 en Desktop, 1 Columna en Mobile) -->
                <div class="pillars-grid">
                    
                    <!-- Card 1: Nuestro Servicio -->
                    <div class="pillar-card">
                        <div class="pillar-header">
                            <div class="pillar-icon"><i class="fa-solid fa-users-gear"></i></div>
                            <div class="pillar-title-wrap">
                                <span class="pillar-tag">Alcance Integral</span>
                                <h3 class="pillar-title animate__animated animate__fadeInUp animate__delay-1s">Nuestro servicio</h3>
                            </div>
                        </div>
                        <div class="pillar-body">
                            <ul class="pillar-checklist">
                                <li>
                                    <i class="fa-solid fa-check"></i>
                                    <span>Búsqueda directa (Executive Search) para posiciones directivas, gerenciales y de mando medio en obra y gabinete.</span>
                                </li>
                                <li>
                                    <i class="fa-solid fa-check"></i>
                                    <span>Especialistas en Gerentes de Proyecto, Residentes de Obra, Jefes de Oficina Técnica, Control de Proyectos/PMO y Coordinadores BIM.</span>
                                </li>
                                <li>
                                    <i class="fa-solid fa-check"></i>
                                    <span>Evaluación integral que abarca solidez técnica, antecedentes en megaproyectos y alineamiento a la cultura corporativa.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Card 2: ¿Qué nos diferencia? -->
                    <div class="pillar-card">
                        <div class="pillar-header">
                            <div class="pillar-icon"><i class="fa-solid fa-star"></i></div>
                            <div class="pillar-title-wrap">
                                <span class="pillar-tag">Ventaja Competitiva</span>
                                <h3 class="pillar-title animate__animated animate__fadeInUp animate__delay-1s">¿Qué nos diferencia?</h3>
                            </div>
                        </div>
                        <div class="pillar-body">
                            <ul class="pillar-checklist">
                                <li>
                                    <i class="fa-solid fa-check"></i>
                                    <span><strong>Ingenieros evaluando ingenieros:</strong> No tercerizamos el filtro técnico; evaluamos con rigor práctico el conocimiento de obra.</span>
                                </li>
                                <li>
                                    <i class="fa-solid fa-check"></i>
                                    <span>Dominio de marcos de trabajo vigentes: PMI®, Last Planner® System, metodologías VDC/BIM y gestión de reclamos/claims.</span>
                                </li>
                                <li>
                                    <i class="fa-solid fa-check"></i>
                                    <span>Comunicación directa y técnica con su equipo, sin necesidad de extensas explicaciones sobre los perfiles solicitados.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Card 3: ¿Qué nos respalda? -->
                    <div class="pillar-card">
                        <div class="pillar-header">
                            <div class="pillar-icon"><i class="fa-solid fa-shield-halved"></i></div>
                            <div class="pillar-title-wrap">
                                <span class="pillar-tag">Confianza &amp; Trayectoria</span>
                                <h3 class="pillar-title animate__animated animate__fadeInUp animate__delay-1s">¿Qué nos respalda?</h3>
                            </div>
                        </div>
                        <div class="pillar-body">
                            <ul class="pillar-checklist">
                                <li>
                                    <i class="fa-solid fa-check"></i>
                                    <span>Más de 7 años de liderazgo en consultoría y capacitación corporativa para el sector construcción en el Perú.</span>
                                </li>
                                <li>
                                    <i class="fa-solid fa-check"></i>
                                    <span>Pioneros en investigación académica con el <strong>CIFE de Stanford University</strong> en tecnologías BIM e indicadores predictivos.</span>
                                </li>
                                <li>
                                    <i class="fa-solid fa-check"></i>
                                    <span>Extensa red de contactos de profesionales calificados y evaluados en los proyectos de infraestructura más importantes del país.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Card 4: Nuestro proceso -->
                    <div class="pillar-card">
                        <div class="pillar-header">
                            <div class="pillar-icon"><i class="fa-solid fa-timeline"></i></div>
                            <div class="pillar-title-wrap">
                                <span class="pillar-tag">Flujo Metodológico</span>
                                <h3 class="pillar-title animate__animated animate__fadeInUp animate__delay-1s">Nuestro proceso</h3>
                            </div>
                        </div>
                        <div class="pillar-body">
                            <ul class="pillar-checklist">
                                <li>
                                    <i class="fa-solid fa-check"></i>
                                    <span><strong>1. Relevamiento:</strong> Definición precisa de la matriz de competencias técnicas y requerimientos del proyecto.</span>
                                </li>
                                <li>
                                    <i class="fa-solid fa-check"></i>
                                    <span><strong>2. Hunting &amp; Long list:</strong> Mapeo exhaustivo en nuestra base de datos activa y redes del sector.</span>
                                </li>
                                <li>
                                    <i class="fa-solid fa-check"></i>
                                    <span><strong>3. Filtro Técnico Especializado:</strong> Entrevistas a profundidad y resolución de casos reales.</span>
                                </li>
                                <li>
                                    <i class="fa-solid fa-check"></i>
                                    <span><strong>4. Short list &amp; Informe:</strong> Presentación de la terna final acompañada de un dictamen de idoneidad.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             5. LLAMADO A LA ACCIÓN (CTA DESTACADO CON TELÉFONO Y WHATSAPP)
             ========================================================================== -->
        <section class="cta-banner-section headhunting-cta-section">
            <div class="cta-container">
                <div class="cta-box headhunting-cta-box">
                    <div class="cta-content">
                        <span class="cta-tag"><i class="fa-solid fa-bolt"></i> Long List de Cortesía</span>
                        <h3 class="animate__animated animate__fadeInUp animate__delay-1s">¿Necesitas encontrar al profesional adecuado para tu proyecto?</h3>
                        <p class="cta-subtext">"Envíanos tu requerimiento y te daremos un long list de cortesía."</p>
                        
                        <!-- Teléfono Visible Clickeable -->
                        <div class="cta-phone-wrapper">
                            <a href="tel:+51993463118" class="cta-phone-link" aria-label="Llamar al +51 993 463 118">
                                <i class="fa-solid fa-phone-volume"></i>
                                <span>+51 993 463 118</span>
                            </a>
                        </div>
                    </div>

                    <div class="cta-actions">
                        <a href="https://wa.me/51993463118" target="_blank" rel="noopener noreferrer" class="btn btn-large animate__animated animate__pulse animate__infinite btn-qcs-primary">
                            <i class="fa-brands fa-whatsapp"></i> Solicitar información
                        </a>
                        <a href="/contacto" class="btn btn-large btn-qcs-dark">
                            <i class="fa-solid fa-envelope"></i> Enviar Requerimiento
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==========================================================================
             6. SECCIÓN DE CONVOCATORIAS ACTUALES (Grid de 3 Tarjetas)
             ========================================================================== -->
        <section class="content-section section-convocatorias" id="convocatorias">
            <div class="section-container">
                
                <div class="section-header-center">
                    <span class="sub-badge">Oportunidades Laborales Vigentes</span>
                    <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">CONVOCATORIAS ACTUALES</h2>
                    <div class="heading-line center-line"></div>
                    <p class="section-subtitle-text">Explora las posiciones estratégicas abiertas para nuestros clientes y forma parte de los proyectos de mayor envergadura.</p>
                </div>

                <!-- Grid de 3 Tarjetas de Convocatorias -->
                <div class="convocatorias-grid">
                    
                    <!-- ================================================================= -->
                    <!-- CONVOCATORIA 1                                                    -->
                    <!-- ================================================================= -->
                    <div class="convocatoria-card">
                        <div class="convocatoria-media">
                            <a href="https://docs.google.com/forms/d/e/1FAIpQLSf71Xw2zzKfEyP9NGErWgcPDKFU-iu8KoMEcMT8siJmLIWmlw/viewform" target="_blank" rel="noopener noreferrer" aria-label="Ver convocatoria Residente de Obra Senior">
                                <!-- Reemplazar por imagen de convocatoria: img/convocatoria1.jpg -->
                                <picture>
                                    <source srcset="img/add-hh-1910-01_orig.webp" type="image/webp">
                                    <img src="img/add-hh-1910-01_orig.png" alt="Convocatoria 1 - Residente de Obra Senior" class="convocatoria-img" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1541888946425-d0fbb180c5f7?q=80&amp;w=600&amp;auto=format&amp;fit=crop';" loading="lazy" width="600" height="380">
                                </picture>
                                <div class="convocatoria-badge"><i class="fa-solid fa-briefcase"></i> Convocatoria Activa</div>
                            </a>
                        </div>
                        <div class="convocatoria-content">
                            <span class="convocatoria-ref">REF: POS-01 / CONSTRUCCIÓN</span>
                            <h3 class="convocatoria-title animate__animated animate__fadeInUp animate__delay-1s">Residente de Obra Senior - Edificaciones</h3>
                            <p class="convocatoria-desc">Profesional colegiado con experiencia mínima de 8 años en proyectos multifamiliares y corporativos de mediana y gran altura.</p>
                            <div class="convocatoria-meta">
                                <span><i class="fa-solid fa-location-dot"></i> Lima, Perú</span>
                                <span><i class="fa-solid fa-clock"></i> Tiempo Completo</span>
                            </div>
                            <div class="convocatoria-action">
                                <a href="https://docs.google.com/forms/d/e/1FAIpQLSf71Xw2zzKfEyP9NGErWgcPDKFU-iu8KoMEcMT8siJmLIWmlw/viewform" target="_blank" rel="noopener noreferrer" class="btn-postular">
                                    <i class="fa-solid fa-paper-plane"></i> Ver convocatoria / Postular
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- ================================================================= -->
                    <!-- CONVOCATORIA 2                                                    -->
                    <!-- ================================================================= -->
                    <div class="convocatoria-card">
                        <div class="convocatoria-media">
                            <a href="https://docs.google.com/forms/d/e/1FAIpQLSf71Xw2zzKfEyP9NGErWgcPDKFU-iu8KoMEcMT8siJmLIWmlw/viewform" target="_blank" rel="noopener noreferrer" aria-label="Ver convocatoria Jefe de Oficina Técnica &amp; Control de Proyectos">
                                <!-- Reemplazar por imagen de convocatoria: img/convocatoria2.jpg -->
                                <picture>
                                    <source srcset="img/add-hh-1910-02_orig.webp" type="image/webp">
                                    <img src="img/add-hh-1910-02_orig.png" alt="Convocatoria 2 - Jefe de Oficina Técnica &amp; Control de Proyectos" class="convocatoria-img" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1503387762-592deb58ef4e?q=80&amp;w=600&amp;auto=format&amp;fit=crop';" loading="lazy" width="600" height="380">
                                </picture>
                                <div class="convocatoria-badge"><i class="fa-solid fa-briefcase"></i> Convocatoria Activa</div>
                            </a>
                        </div>
                        <div class="convocatoria-content">
                            <span class="convocatoria-ref">REF: POS-02 / PMO &amp; CONTROL</span>
                            <h3 class="convocatoria-title animate__animated animate__fadeInUp animate__delay-1s">Jefe de Oficina Técnica &amp; Control de Proyectos</h3>
                            <p class="convocatoria-desc">Ingeniero Civil con dominio avanzado de Valor Ganado (EVM), contratos colaborativos (NEC) y metodologías Last Planner®.</p>
                            <div class="convocatoria-meta">
                                <span><i class="fa-solid fa-location-dot"></i> Infraestructura / Lima</span>
                                <span><i class="fa-solid fa-clock"></i> Tiempo Completo</span>
                            </div>
                            <div class="convocatoria-action">
                                <a href="https://docs.google.com/forms/d/e/1FAIpQLSf71Xw2zzKfEyP9NGErWgcPDKFU-iu8KoMEcMT8siJmLIWmlw/viewform" target="_blank" rel="noopener noreferrer" class="btn-postular">
                                    <i class="fa-solid fa-paper-plane"></i> Ver convocatoria / Postular
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- ================================================================= -->
                    <!-- CONVOCATORIA 3                                                    -->
                    <!-- ================================================================= -->
                    <div class="convocatoria-card">
                        <div class="convocatoria-media">
                            <a href="https://docs.google.com/forms/d/e/1FAIpQLSf71Xw2zzKfEyP9NGErWgcPDKFU-iu8KoMEcMT8siJmLIWmlw/viewform" target="_blank" rel="noopener noreferrer" aria-label="Ver convocatoria Coordinador BIM LOD 400 &amp; VDC Lead">
                                <!-- Reemplazar por imagen de convocatoria: img/convocatoria3.jpg -->
                                <picture>
                                    <source srcset="img/add-hh-1912-01_orig.webp" type="image/webp">
                                    <img src="img/add-hh-1912-01_orig.png" alt="Convocatoria 3 - Coordinador BIM LOD 400 &amp; VDC Lead" class="convocatoria-img" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1581092160607-ee22621dd758?q=80&amp;w=600&amp;auto=format&amp;fit=crop';" loading="lazy" width="600" height="380">
                                </picture>
                                <div class="convocatoria-badge"><i class="fa-solid fa-briefcase"></i> Convocatoria Activa</div>
                            </a>
                        </div>
                        <div class="convocatoria-content">
                            <span class="convocatoria-ref">REF: POS-03 / BIM &amp; VDC</span>
                            <h3 class="convocatoria-title animate__animated animate__fadeInUp animate__delay-1s">Coordinador BIM LOD 400 &amp; VDC Lead</h3>
                            <p class="convocatoria-desc">Especialista en integración de modelos BIM multidisciplinarios (Revit/Navisworks), detección de interferencias y metrados de precisión.</p>
                            <div class="convocatoria-meta">
                                <span><i class="fa-solid fa-location-dot"></i> Lima, Perú</span>
                                <span><i class="fa-solid fa-laptop-code"></i> Híbrido</span>
                            </div>
                            <div class="convocatoria-action">
                                <a href="https://docs.google.com/forms/d/e/1FAIpQLSf71Xw2zzKfEyP9NGErWgcPDKFU-iu8KoMEcMT8siJmLIWmlw/viewform" target="_blank" rel="noopener noreferrer" class="btn-postular">
                                    <i class="fa-solid fa-paper-plane"></i> Ver convocatoria / Postular
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

    </main>
