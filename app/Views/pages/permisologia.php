<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de P?gina: Permisolog?a, Licencias y Autorizaciones de Obra
 * Archivo: app/Views/pages/permisologia.php
 */

declare(strict_types=1);
?>
<main class="page-content">

        <!-- ==========================================================================
             1. SECCIÓN HERO / ENCABEZADO PRINCIPAL (Hero Azul Corporativo)
             ========================================================================== -->
        <section class="page-banner banner-permisologia">
            <div class="page-banner-bg banner-permisologia-bg"></div>
            <div class="page-banner-overlay"></div>
            <div class="page-banner-container">
                
                <div class="page-title-wrap">
                    <span class="section-tag"><i class="fa-solid fa-file-contract"></i> Gestión de Autorizaciones &amp; Licencias</span>
                    <h1 class="page-main-title animate__animated animate__fadeInDown">PERMISOLOGÍA</h1>
                    <div class="title-underline"></div>
                </div>

                <!-- Subtítulo / Párrafo Requerido -->
                <div class="intro-card">
                    <p class="intro-text animate__animated animate__fadeInUp animate__delay-1s">
                        Gestionamos la obtención de autorizaciones y permisos para que puedas iniciar tu proyecto de manera confiable y dentro de plazos adecuados.
                    </p>
                </div>

                <!-- Grid de 3 Tarjetas dentro del Hero -->
                <div class="hero-cards-grid">
                    <!-- Tarjeta 1 -->
                    <div class="hero-feature-card">
                        <div class="hero-feature-icon">
                            <i class="fa-solid fa-building-circle-check"></i>
                        </div>
                        <div class="hero-feature-content">
                            <h3 class="hero-feature-title animate__animated animate__fadeInUp animate__delay-1s">GESTIÓN DE AUTORIZACIONES</h3>
                            <p class="hero-feature-desc animate__animated animate__fadeInUp animate__delay-1s">Licencias, permisos de obra y habilitaciones urbanas.</p>
                        </div>
                    </div>

                    <!-- Tarjeta 2 -->
                    <div class="hero-feature-card">
                        <div class="hero-feature-icon">
                            <i class="fa-solid fa-stamp"></i>
                        </div>
                        <div class="hero-feature-content">
                            <h3 class="hero-feature-title animate__animated animate__fadeInUp animate__delay-1s">OPINIONES FAVORABLES</h3>
                            <p class="hero-feature-desc animate__animated animate__fadeInUp animate__delay-1s">Coordinación ante entidades administradoras de infraestructura.</p>
                        </div>
                    </div>

                    <!-- Tarjeta 3 -->
                    <div class="hero-feature-card">
                        <div class="hero-feature-icon">
                            <i class="fa-solid fa-map-location-dot"></i>
                        </div>
                        <div class="hero-feature-content">
                            <h3 class="hero-feature-title animate__animated animate__fadeInUp animate__delay-1s">SANEAMIENTO FÍSICO-LEGAL</h3>
                            <p class="hero-feature-desc animate__animated animate__fadeInUp animate__delay-1s">Saneamiento de terrenos para proyectos de inversión.</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ==========================================================================
             2. INTRODUCCIÓN A LA PERMISOLOGÍA E IMAGEN OBLIGATORIA 1
             ========================================================================== -->
        <section class="content-section" id="introduccion-permisologia">
            <div class="section-container">
                
                <div class="grid-split-layout">
                    
                    <!-- Columna Izquierda: Texto Explicativo y Flujo de Badges -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge">Gestión Multigubernamental &amp; Cumplimiento</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">VIABILIDAD Y AUTORIZACIONES PARA TU PROYECTO</h2>
                            <div class="heading-line"></div>
                        </div>

                        <p class="paragraph-text paragraph-lead">
                            La <strong>permisología</strong> es el conjunto coordinado de gestiones técnicas y administrativas indispensables para tramitar, sustentar y obtener las licencias, autorizaciones y permisos exigidos por los <strong>tres niveles de gobierno</strong> (Local, Regional y Nacional).
                        </p>

                        <p class="paragraph-text">
                            En Quality Consulting Solutions aseguramos la conformidad técnica y legal de tus expedientes para garantizar el cumplimiento riguroso de fiscalizaciones municipales, sectoriales y urbanísticas, evitando paralizaciones de obra y sobrecostos por sanciones administrativas.
                        </p>

                        <!-- Diagrama de flujo simplificado mediante badges -->
                        <div class="flow-badge-chain" aria-label="Secuencia de Gestión de Permisos">
                            <div class="flow-badge-item">
                                <i class="fa-solid fa-folder-open"></i> Proyecto
                            </div>
                            <i class="fa-solid fa-chevron-right flow-badge-arrow"></i>
                            
                            <div class="flow-badge-item">
                                <i class="fa-solid fa-list-check"></i> Requisitos
                            </div>
                            <i class="fa-solid fa-chevron-right flow-badge-arrow"></i>
                            
                            <div class="flow-badge-item">
                                <i class="fa-solid fa-landmark"></i> Gestión ante Entidades
                            </div>
                            <i class="fa-solid fa-chevron-right flow-badge-arrow"></i>
                            
                            <div class="flow-badge-item">
                                <i class="fa-solid fa-file-circle-check"></i> Permisos Aprobados
                            </div>
                            <i class="fa-solid fa-chevron-right flow-badge-arrow"></i>
                            
                            <div class="flow-badge-item highlight-success">
                                <i class="fa-solid fa-person-digging"></i> Inicio de Obra
                            </div>
                        </div>

                        <p class="paragraph-text" style="font-size: 0.92rem; color: #475569;">
                            Articulamos ágilmente con cada autoridad involucrada para asegurar que los permisos se obtengan en los plazos planificados, protegiendo la ruta crítica de tu inversión.
                        </p>
                    </div>

                    <!-- Columna Derecha: Imagen Obligatoria 1 -->
                    <div class="split-image-col">
                        <div class="image-card-wrapper">
                            <div class="image-container">
                                <!-- Mantener imagen original de planos y permisología -->
                                <picture>
                                    <source srcset="img/permi1.webp" type="image/webp">
                                    <img src="img/permi1.png" alt="Planos y cascos de gestión de permisos en construcción" class="section-image" loading="lazy" width="600" height="400">
                                </picture>
                                <div class="image-badge-tag badge-gold">
                                    <i class="fa-solid fa-compass-drafting"></i> Viabilidad Técnica
                                </div>
                            </div>
                            <div class="image-caption-box">
                                <p><strong>Compatibilización y Tramitación:</strong> Revisión multidisciplinaria de planos y expedientes para su ingreso conforme ante entidades públicas y privadas.</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             4. SECCIÓN "NUESTRO SERVICIO" (Grid de 5 Tarjetas de Servicios)
             ========================================================================== -->
        <section class="content-section bg-alternate" id="servicios-permisologia">
            <div class="section-container">
                
                <div class="section-header-center">
                    <span class="sub-badge">Especialidades en Tramitación</span>
                    <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">NUESTROS SERVICIOS EN PERMISOLOGÍA</h2>
                    <div class="heading-line center-line"></div>
                    <p class="section-subtitle-text">
                        Brindamos soluciones integrales de gestión técnica, legal y administrativa para cada etapa del desarrollo inmobiliario y de infraestructura.
                    </p>
                </div>

                <!-- Grid de 5 Tarjetas de Servicios -->
                <div class="permits-5-grid">
                    
                    <!-- Tarjeta 1: Autorizaciones y Licencias -->
                    <div class="permit-service-card">
                        <div class="permit-card-icon">
                            <i class="fa-solid fa-building-circle-check"></i>
                        </div>
                        <h4 class="permit-card-title">Autorizaciones y Licencias</h4>
                        <p class="permit-card-desc">
                            Gestión integral de licencias de edificación en todas sus modalidades (A, B, C y D), autorizaciones de demolición, remodelación, ampliación y ejecución de obras civiles.
                        </p>
                        <div class="permit-card-scope">
                            <i class="fa-solid fa-check"></i> Municipalidades Distritales y Provinciales
                        </div>
                    </div>

                    <!-- Tarjeta 2: Habilitaciones Urbanas -->
                    <div class="permit-service-card">
                        <div class="permit-card-icon">
                            <i class="fa-solid fa-city"></i>
                        </div>
                        <h4 class="permit-card-title">Habilitaciones Urbanas</h4>
                        <p class="permit-card-desc">
                            Trámites completos de habilitación urbana con fines residenciales, comerciales e industriales, cambios de zonificación, independizaciones y subdivisión de terrenos.
                        </p>
                        <div class="permit-card-scope">
                            <i class="fa-solid fa-check"></i> Desarrollo y Expansión de Terrenos
                        </div>
                    </div>

                    <!-- Tarjeta 3: Permisos para Ejecución de Obras -->
                    <div class="permit-service-card">
                        <div class="permit-card-icon">
                            <i class="fa-solid fa-road-barrier"></i>
                        </div>
                        <h4 class="permit-card-title">Permisos para Ejecución de Obras</h4>
                        <p class="permit-card-desc">
                            Obtención de permisos de interferencia de vías (PIV), planes de desvío vehicular, rotura y reposición de pavimentos, y autorizaciones de uso de derecho de vía.
                        </p>
                        <div class="permit-card-scope">
                            <i class="fa-solid fa-check"></i> GOREs, Provías Nacional y Descentralizado (MTC)
                        </div>
                    </div>

                    <!-- Tarjeta 4: Opiniones Favorables -->
                    <div class="permit-service-card">
                        <div class="permit-card-icon">
                            <i class="fa-solid fa-stamp"></i>
                        </div>
                        <h4 class="permit-card-title">Opiniones Favorables</h4>
                        <p class="permit-card-desc">
                            Coordinación técnica e informes de compatibilidad vial y de infraestructura ante Rutas de Lima, Línea Amarilla, Protransporte, Protránsito y Municipalidad de Lima.
                        </p>
                        <div class="permit-card-scope">
                            <i class="fa-solid fa-check"></i> Concesionarias y Entidades Viales
                        </div>
                    </div>

                    <!-- Tarjeta 5: Saneamiento Físico-Legal -->
                    <div class="permit-service-card">
                        <div class="permit-card-icon">
                            <i class="fa-solid fa-map-location-dot"></i>
                        </div>
                        <h4 class="permit-card-title">Saneamiento Físico-Legal</h4>
                        <p class="permit-card-desc">
                            Regularización registral y catastral de terrenos, constitución de servidumbres de paso, rectificación de áreas y linderos e inscripción ante SUNARP para proyectos de inversión.
                        </p>
                        <div class="permit-card-scope">
                            <i class="fa-solid fa-check"></i> Saneamiento e Infraestructura
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             5. ¿CÓMO ACOMPAÑAMOS EL PROCESO? E IMAGEN OBLIGATORIA 2
             ========================================================================== -->
        <section class="content-section" id="proceso-acompanamiento">
            <div class="section-container">
                
                <div class="grid-split-layout">
                    
                    <!-- Columna Izquierda: Roadmap de 5 Pasos -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge">Acompañamiento Integral Paso a Paso</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">¿CÓMO ACOMPAÑAMOS EL PROCESO?</h2>
                            <div class="heading-line"></div>
                        </div>

                        <p class="paragraph-text paragraph-lead">
                            Desarrollamos una metodología estructurada en 5 etapas secuenciales para asegurar una gestión documental prolija, minimizando observaciones y tiempos de espera.
                        </p>

                        <!-- Lista de 5 Pasos -->
                        <div class="roadmap-steps-list">
                            
                            <!-- Paso 1 -->
                            <div class="roadmap-step-item">
                                <div class="roadmap-step-num">01</div>
                                <div class="roadmap-step-content">
                                    <h4 class="roadmap-step-title">Paso 1: Revisión del Requerimiento</h4>
                                    <p class="roadmap-step-desc">Comprensión integral del proyecto, alcance técnico de las obras y análisis de la normativa aplicable.</p>
                                </div>
                            </div>

                            <!-- Paso 2 -->
                            <div class="roadmap-step-item">
                                <div class="roadmap-step-num">02</div>
                                <div class="roadmap-step-content">
                                    <h4 class="roadmap-step-title">Paso 2: Identificación de Trámites</h4>
                                    <p class="roadmap-step-desc">Determinación de las entidades competentes, elaboración de la matriz de requisitos y cronograma de hitos.</p>
                                </div>
                            </div>

                            <!-- Paso 3 -->
                            <div class="roadmap-step-item">
                                <div class="roadmap-step-num">03</div>
                                <div class="roadmap-step-content">
                                    <h4 class="roadmap-step-title">Paso 3: Preparación Documental</h4>
                                    <p class="roadmap-step-desc">Estructuración, revisión y compatibilización rigurosa del expediente técnico, planos y memorias descriptivas.</p>
                                </div>
                            </div>

                            <!-- Paso 4 -->
                            <div class="roadmap-step-item">
                                <div class="roadmap-step-num">04</div>
                                <div class="roadmap-step-content">
                                    <h4 class="roadmap-step-title">Paso 4: Gestión ante Entidades</h4>
                                    <p class="roadmap-step-desc">Ingreso formal de expedientes, sustentación técnica en mesas de trabajo y seguimiento activo de cada trámite.</p>
                                </div>
                            </div>

                            <!-- Paso 5 -->
                            <div class="roadmap-step-item">
                                <div class="roadmap-step-num">05</div>
                                <div class="roadmap-step-content">
                                    <h4 class="roadmap-step-title">Paso 5: Seguimiento y Cierre</h4>
                                    <p class="roadmap-step-desc">Monitoreo constante, levantamiento oportuno de observaciones y obtención formal de la licencia o autorización.</p>
                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- Columna Derecha: Imagen Obligatoria 2 -->
                    <div class="split-image-col">
                        <div class="image-card-wrapper">
                            <div class="image-container">
                                <!-- Mantener imagen original de elaboración de documentos -->
                                <picture>
                                    <source srcset="img/permi2.webp" type="image/webp">
                                    <img src="img/permi2.png" alt="Elaboración y revisión de expedientes documentarios" class="section-image" loading="lazy" width="600" height="400">
                                </picture>
                                <div class="image-badge-tag badge-gold">
                                    <i class="fa-solid fa-file-signature"></i> Gestión Documental
                                </div>
                            </div>
                            <div class="image-caption-box">
                                <p><strong>Revisión Técnica y Legal:</strong> Estructuración precisa de expedientes para asegurar su aprobación fluida ante evaluadores y comisiones técnicas.</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             6. GESTIONES ANTE DISTINTAS ENTIDADES Y MENSAJE DE VALOR
             ========================================================================== -->
        <section class="content-section bg-alternate" id="gestiones-entidades">
            <div class="section-container">
                
                <div class="section-header-center">
                    <span class="sub-badge">Articulación Institucional</span>
                    <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">GESTIONES ANTE DISTINTAS ENTIDADES</h2>
                    <div class="heading-line center-line"></div>
                    <p class="section-subtitle-text">
                        Contamos con sólida capacidad de interlocución técnica y legal para coordinar expedientes ante las principales autoridades públicas y entidades administradoras.
                    </p>
                </div>

                <!-- Grid de 4 Entidades -->
                <div class="entities-4-grid">
                    
                    <!-- Entidad 1: Gobiernos Locales -->
                    <div class="entity-card">
                        <div class="entity-icon">
                            <i class="fa-solid fa-landmark"></i>
                        </div>
                        <h4 class="entity-title">Gobiernos Locales</h4>
                        <p class="entity-desc">
                            Municipalidades distritales y provinciales para licencias de edificación, habilitaciones urbanas, conformidad de obra y autorizaciones de interferencia de vías.
                        </p>
                    </div>

                    <!-- Entidad 2: Gobiernos Regionales -->
                    <div class="entity-card">
                        <div class="entity-icon">
                            <i class="fa-solid fa-building-columns"></i>
                        </div>
                        <h4 class="entity-title">Gobiernos Regionales</h4>
                        <p class="entity-desc">
                            Direcciones regionales sectoriales para autorizaciones de obras de infraestructura, proyectos viales departamentales y compatibilidad territorial.
                        </p>
                    </div>

                    <!-- Entidad 3: MTC / Provías -->
                    <div class="entity-card">
                        <div class="entity-icon">
                            <i class="fa-solid fa-road"></i>
                        </div>
                        <h4 class="entity-title">MTC / Provías</h4>
                        <p class="entity-desc">
                            Ministerio de Transportes y Comunicaciones, Provías Nacional y Provías Descentralizado para autorizaciones de uso de derecho de vía nacional y desvíos.
                        </p>
                    </div>

                    <!-- Entidad 4: Entidades Administradoras -->
                    <div class="entity-card">
                        <div class="entity-icon">
                            <i class="fa-solid fa-route"></i>
                        </div>
                        <h4 class="entity-title">Administradoras de Vías</h4>
                        <p class="entity-desc">
                            Concesionarias viales (Rutas de Lima, Línea Amarilla), ATU, Protransporte, Protránsito y Municipalidad Metropolitana de Lima para opiniones favorables.
                        </p>
                    </div>

                </div>

                <!-- Bloque de Mensaje de Valor (Blockquote) -->
                <div class="quote-banner-callout">
                    <i class="fa-solid fa-quote-left quote-banner-icon"></i>
                    <p class="quote-banner-text">
                        "Los permisos y autorizaciones forman parte esencial de la planificación de un proyecto. Una adecuada gestión ayuda a reducir incertidumbre y mantener ordenado el proceso previo a la ejecución."
                    </p>
                </div>

            </div>
        </section>

        <!-- ==========================================================================
             7. LLAMADO A LA ACCIÓN (CTA FINAL)
             ========================================================================== -->
        <section class="cta-banner-section forense-cta-section" id="contacto-permisologia">
            <div class="cta-container">
                <div class="cta-box">
                    <div class="cta-content">
                        <span class="cta-tag"><i class="fa-solid fa-shield-halved"></i> Viabilidad Asegurada</span>
                        <h3 class="animate__animated animate__fadeInUp animate__delay-1s">Gestiona los permisos necesarios para tu proyecto</h3>
                        <p class="cta-subtext">
                            Asegura la viabilidad técnica y legal de tu obra, evitando paralizaciones y multas con el respaldo de nuestro equipo especializado.
                        </p>
                        
                        <!-- Teléfono Visible Clickeable -->
                        <div class="cta-phone-wrapper">
                            <a href="tel:+51993463118" class="cta-phone-link" aria-label="Llamar al +51 993 463 118">
                                <i class="fa-solid fa-phone-volume"></i>
                                <span>+51 993 463 118</span>
                            </a>
                        </div>
                    </div>

                    <div class="cta-actions">
                        <a href="/contacto" class="btn btn-large btn-qcs-primary">
                            <i class="fa-solid fa-clipboard-check"></i> Solicitar asesoría
                        </a>
                        <a href="https://wa.me/51993463118" target="_blank" rel="noopener noreferrer" class="btn btn-large animate__animated animate__pulse animate__infinite btn-qcs-dark">
                            <i class="fa-brands fa-whatsapp"></i> Contactar por WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>
