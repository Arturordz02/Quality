<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Gestión de la PMO y Proyectos
 * Archivo: app/Views/pages/gestion-de-pmo.php
 */

declare(strict_types=1);
?>
<main class="page-content">

        <!-- ==========================================================================
             2. BANNER / ENCABEZADO PRINCIPAL DE LA PÁGINA
             ========================================================================== -->
        <section class="page-banner">
            <div class="page-banner-bg"></div>
            <div class="page-banner-overlay"></div>
            <div class="page-banner-container">


                <div class="page-title-wrap">
                    <span class="section-tag"><i class="fa-solid fa-sitemap"></i> Servicio Especializado</span>
                    <h1 class="page-main-title animate__animated animate__fadeInDown">GESTIÓN DE LA PMO Y PROYECTOS</h1>
                    <div class="title-underline"></div>
                </div>

                <!-- Párrafo de Introducción Requerido -->
                <div class="intro-card">
                    <p class="intro-text animate__animated animate__fadeInUp animate__delay-1s">
                        Asesoría especializada para orientar el diseño, adopción y consolidación de Oficinas de Gestión de Proyectos (PMO) en organizaciones y proyectos de construcción, integrando las áreas de conocimiento del project management: alcance, costo, plazo, calidad, riesgos y gobernanza, fortaleciendo las capacidades del equipo interno.
                    </p>
                </div>

            </div>
        </section>

        <!-- ==========================================================================
             3. SECCIÓN 1: DESARROLLO DE LA PMO
             ========================================================================== -->
        <section class="content-section section-pmo-dev" id="desarrollo-pmo">
            <div class="section-container">
                
                <div class="grid-split-layout">
                    
                    <!-- Columna de Texto -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge">Nivel de Madurez Organizacional</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">DESARROLLO DE LA PMO</h2>
                            <div class="heading-line"></div>
                        </div>

                        <p class="paragraph-text">
                            Brindamos asesoría especializada para orientar la estructuración de la PMO al nivel requerido por tu organización: a nivel de gestor de estándares, gestor de proyectos o nivel estratégico. Acompañamos en el ordenamiento de estándares, transferencia metodológica e integración con tus stakeholders clave. Brindamos soporte técnico y juicio experto para evaluar soluciones informáticas de administración de proyectos, con un enfoque práctico y no burocrático.
                        </p>

                        <!-- Tarjetas de los 3 Niveles de Desarrollo de la PMO -->
                        <div class="pmo-levels-grid">
                            <div class="pmo-card level-card">
                                <div class="pmo-card-icon"><i class="fa-solid fa-list-check"></i></div>
                                <div class="pmo-card-body">
                                    <h4 class="pmo-card-title">Nivel de Gestor de Estándares</h4>
                                    <p class="pmo-card-desc">Compilación, homologación y estructuración de plantillas y normativas corporativas.</p>
                                </div>
                            </div>
                            <div class="pmo-card level-card">
                                <div class="pmo-card-icon"><i class="fa-solid fa-diagram-project"></i></div>
                                <div class="pmo-card-body">
                                    <h4 class="pmo-card-title">Nivel de Gestor de Proyecto</h4>
                                    <p class="pmo-card-desc">Control integral de alcance, cronograma de plazo y costo en tiempo real.</p>
                                </div>
                            </div>
                            <div class="pmo-card level-card">
                                <div class="pmo-card-icon"><i class="fa-solid fa-chess-knight"></i></div>
                                <div class="pmo-card-body">
                                    <h4 class="pmo-card-title">Nivel Estratégico</h4>
                                    <p class="pmo-card-desc">Alineamiento del portafolio con los objetivos de negocio y retorno de inversión.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Columna de Imagen (Placeholder) -->
                    <div class="split-image-col">
                        <div class="image-card-wrapper">
                            <!-- ========================================== -->
                            <!-- INSERTAR IMAGEN AQUÍ: Desarrollo de la PMO -->
                            <!-- Recomendado: Dimensiones 600x400 px        -->
                            <!-- ========================================== -->
                            <div class="image-container">
                                <picture>
                                    <source srcset="img/gesPMO1.webp" type="image/webp">
                                    <img src="img/gesPMO1.png" alt="Equipo de gestión de proyectos y desarrollo de PMO" class="section-image" loading="lazy" width="600" height="400">
                                </picture>
                                <div class="image-badge-tag">
                                    <i class="fa-solid fa-chart-pie"></i> PMO Estratégica
                                </div>
                            </div>
                            <div class="image-caption">
                                <p><i class="fa-solid fa-circle-check"></i> Integración fluida con contratistas y stakeholders clave.</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             4. SECCIÓN 2: NUESTRA METODOLOGÍA (Ciclo PHVA y Prevención del 90%)
             ========================================================================== -->
        <section class="content-section section-methodology bg-alternate" id="metodologia">
            <div class="section-container">
                
                <div class="grid-split-layout reverse-on-desktop">
                    
                    <!-- Columna de Imagen / Diagrama (Placeholder) -->
                    <div class="split-image-col">
                        <div class="image-card-wrapper">
                            <!-- ================================================================= -->
                            <!-- INSERTAR IMAGEN AQUÍ: Diagrama de Metodología y Ciclo PHVA / PMO  -->
                            <!-- Recomendado: Dimensiones 600x400 px                               -->
                            <!-- ================================================================= -->
                            <div class="image-container">
                                <picture>
                                    <source srcset="img/gesPMO2.webp" type="image/webp">
                                    <img src="img/gesPMO2.png" alt="Metodología de mejora continua y ciclo PHVA en gestión de proyectos" class="section-image" loading="lazy" width="600" height="400">
                                </picture>
                                <div class="image-badge-tag badge-gold">
                                    <i class="fa-solid fa-arrows-rotate"></i> Ciclo PHVA
                                </div>
                            </div>
                            
                            <!-- Tarjeta destacada Foro Académico Global -->
                            <div class="stanford-academic-card">
                                <div class="academic-card-icon">
                                    <i class="fa-solid fa-building-columns"></i>
                                </div>
                                <div class="academic-card-body">
                                    <span class="academic-badge">Foro Académico Global</span>
                                    <p class="academic-text">
                                        Metodología expuesta en la <a href="/investigacion" class="link-stanford">Universidad de Stanford</a> para la <a href="/sindrome-del-90" class="link-sindrome-90">prevención del síndrome del 90%</a>.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Columna de Texto -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge">Marco de Trabajo &amp; Excelencia</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">NUESTRA METODOLOGÍA</h2>
                            <div class="heading-line"></div>
                        </div>

                        <p class="paragraph-text">
                            Nos basamos en el ciclo de mejora continua de Shewhart PHVA, en ese sentido definimos en la planificación los activos de los procesos de gestión de la organización, recopilamos las prácticas vigentes, configuramos una propuesta y la validamos con recorridos (process mapping).
                        </p>

                        <p class="paragraph-text">
                            Subsecuentemente, brindamos acompañamiento y asesoría para orientar la adopción gradual de procesos y evaluamos los entregables según costo-beneficio. Planteamos los ajustes metodológicos requeridos para fortalecer las capacidades internas hasta que la PMO sea sostenible por sí misma en la organización.
                        </p>

                        <!-- Card destacado: Control Riguroso del Plazo -->
                        <div class="methodology-card-highlight">
                            <div class="methodology-card-icon">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                            </div>
                            <div class="methodology-card-content">
                                <h4 class="methodology-card-title">Control Riguroso del Plazo</h4>
                                <p class="methodology-card-desc">
                                    Asimismo, transferimos y aplicamos nuestra metodología única para la evaluación del cumplimiento del plazo <a href="/sindrome-del-90" class="link-sindrome-90">(prevención del síndrome del 90%)</a>, metodología que ha sido expuesta en importantes foros como en la <a href="/investigacion" class="link-stanford">Universidad de Stanford</a>.
                                </p>
                            </div>
                        </div>

                        <!-- Grid de Tarjetas PHVA -->
                        <div class="phva-cards-grid">
                            <div class="phva-card">
                                <span class="phva-badge">P</span>
                                <span class="phva-label">Planificar</span>
                            </div>
                            <div class="phva-card">
                                <span class="phva-badge">H</span>
                                <span class="phva-label">Hacer</span>
                            </div>
                            <div class="phva-card">
                                <span class="phva-badge">V</span>
                                <span class="phva-label">Verificar</span>
                            </div>
                            <div class="phva-card">
                                <span class="phva-badge">A</span>
                                <span class="phva-label">Actuar</span>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             5. SECCIÓN 3: AUDITORÍA DE ÁREAS Y VENDORES
             ========================================================================== -->
        <section class="content-section section-audit" id="auditoria">
            <div class="section-container">
                
                <div class="grid-split-layout">
                    
                    <!-- Columna de Texto -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge">Diagnóstico &amp; Madurez</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">EVALUACIÓN Y MADUREZ DE ÁREAS Y PROVEEDORES</h2>
                            <div class="heading-line"></div>
                        </div>

                        <p class="paragraph-text">
                            Asesoramos en la evaluación de la madurez del sistema de gestión de proyectos de la organización y sus proveedores, brindando criterios técnicos para diagnosticar el nivel de sistematización, estandarización y aporte a la cadena de valor, analizando entregables, indicadores y requerimientos.
                        </p>

                        <!-- Tarjetas de Criterios de Auditoría -->
                        <div class="audit-cards-grid">
                            <div class="pmo-card audit-card">
                                <div class="pmo-card-icon audit-icon"><i class="fa-solid fa-layer-group"></i></div>
                                <div class="pmo-card-body">
                                    <h4 class="pmo-card-title">Nivel de Sistematización</h4>
                                    <p class="pmo-card-desc">Diagnóstico de herramientas y procesos activos en cada unidad organizativa.</p>
                                </div>
                            </div>
                            <div class="pmo-card audit-card">
                                <div class="pmo-card-icon audit-icon"><i class="fa-solid fa-arrow-trend-up"></i></div>
                                <div class="pmo-card-body">
                                    <h4 class="pmo-card-title">Aporte a la Cadena de Valor</h4>
                                    <p class="pmo-card-desc">Medición del impacto real de cada entregable en los resultados del proyecto.</p>
                                </div>
                            </div>
                            <div class="pmo-card audit-card">
                                <div class="pmo-card-icon audit-icon"><i class="fa-solid fa-gauge-high"></i></div>
                                <div class="pmo-card-body">
                                    <h4 class="pmo-card-title">Gestión de Requerimientos &amp; KPIs</h4>
                                    <p class="pmo-card-desc">Revisión técnica de métricas e indicadores de rendimiento operativo.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Columna de Imagen (Placeholder) -->
                    <div class="split-image-col">
                        <div class="image-card-wrapper">
                            <!-- ======================================================== -->
                            <!-- INSERTAR IMAGEN AQUÍ: Auditoría de Áreas y Vendors      -->
                            <!-- Recomendado: Dimensiones 600x400 px                      -->
                            <!-- ======================================================== -->
                            <div class="image-container">
                                <picture>
                                    <source srcset="img/gesPMO3.webp" type="image/webp">
                                    <img src="img/gesPMO3.png" alt="Auditoría de áreas, procesos y evaluación de vendors" class="section-image" loading="lazy" width="600" height="400">
                                </picture>
                                <div class="image-badge-tag">
                                    <i class="fa-solid fa-shield-halved"></i> Calidad Garantizada
                                </div>
                            </div>
                            <div class="image-caption">
                                <p><i class="fa-solid fa-magnifying-glass-chart"></i> Auditorías exhaustivas con enfoque en la eficiencia del gasto y cumplimiento técnico.</p>
                            </div>
                        </div>
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
                        <span class="cta-tag">Asesoría de Alto Impacto</span>
                        <h3 class="animate__animated animate__fadeInUp animate__delay-1s">¿Desea implementar o auditar la PMO de su organización?</h3>
                        <p>Nuestros consultores senior están listos para diseñar la solución que su proyecto necesita.</p>
                    </div>
                    <div class="cta-actions">
                        <a href="/contacto" class="btn btn-large btn-qcs-primary">
                            <i class="fa-solid fa-envelope"></i> Contactar a un Especialista
                        </a>
                        <a href="https://wa.me/51993463118" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp btn-large animate__animated animate__pulse animate__infinite btn-qcs-primary">
                            <i class="fa-brands fa-whatsapp"></i> WhatsApp Directo
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>
