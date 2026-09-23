<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de P?gina: Gesti?n del Riesgo
 * Archivo: app/Views/pages/gestion-de-riesgos.php
 */

declare(strict_types=1);
?>
<main class="page-content">

        <!-- ==========================================================================
             2. BANNER / HERO PRINCIPAL DE LA PÁGINA
             ========================================================================== -->
        <!-- Reemplazar imagen de fondo por /img/hero-riesgos.jpg -->
        <section class="page-banner banner-riesgos">
            <div class="page-banner-bg banner-riesgos-bg"></div>
            <div class="page-banner-overlay"></div>
            <div class="page-banner-container">


                <div class="page-title-wrap">
                    <span class="section-tag"><i class="fa-solid fa-shield-halved"></i> Consultoría Estratégica</span>
                    <h1 class="page-main-title animate__animated animate__fadeInDown">GESTIÓN DEL RIESGO</h1>
                    <div class="title-underline"></div>
                </div>

                <!-- Subtítulo / Párrafo Requerido -->
                <div class="intro-card intro-card-highlight">
                    <p class="intro-text animate__animated animate__fadeInUp animate__delay-1s">
                        <strong>Identificación, análisis, respuesta y monitoreo estratégico</strong> de riesgos en proyectos de ingeniería y construcción para maximizar la predictibilidad, proteger el margen y garantizar el cumplimiento de objetivos.
                    </p>
                </div>

            </div>
        </section>

        <!-- ==========================================================================
             3. INTRODUCCIÓN AL SERVICIO (Layout de 2 Columnas Responsive)
             ========================================================================== -->
        <section class="content-section section-risk-intro" id="introduccion">
            <div class="section-container">
                
                <div class="grid-split-layout">
                    
                    <!-- Columna Izquierda: Texto Explicativo -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge">Enfoque Operativo &amp; Estratégico</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">GESTIÓN DE RIESGOS TÉCNICOS EN OPERACIONES</h2>
                            <div class="heading-line"></div>
                        </div>

                        <p class="paragraph-text paragraph-lead">
                            La gestión de riesgos abarca no solo seguridad, salud y finanzas, sino principalmente el <strong>Riesgo Técnico de las Operaciones</strong>.
                        </p>

                        <p class="paragraph-text">
                            En el sector de la ingeniería y construcción, las desviaciones más severas suelen originarse en la incertidumbre técnica: constructabilidad no evaluada, variaciones geotécnicas imprevistas, incompatibilidad en modelos de ingeniería, problemas en la cadena de suministros y cuellos de botella en la productividad operativa.
                        </p>

                        <!-- Puntos clave destacados -->
                        <div class="pmo-levels-grid">
                            <div class="pmo-card">
                                <div class="pmo-card-icon"><i class="fa-solid fa-helmet-safety"></i></div>
                                <div class="pmo-card-body">
                                    <h4 class="pmo-card-title">Más Allá de la Seguridad &amp; Finanzas</h4>
                                    <p class="pmo-card-desc">Integramos los riesgos tradicionales con la realidad técnica del frente de trabajo.</p>
                                </div>
                            </div>
                            <div class="pmo-card">
                                <div class="pmo-card-icon"><i class="fa-solid fa-gears"></i></div>
                                <div class="pmo-card-body">
                                    <h4 class="pmo-card-title">Foco en Riesgos Técnicos Operativos</h4>
                                    <p class="pmo-card-desc">Análisis cuantitativo de constructabilidad, rendimientos y contingencias de diseño.</p>
                                </div>
                            </div>
                            <div class="pmo-card">
                                <div class="pmo-card-icon"><i class="fa-solid fa-chart-line"></i></div>
                                <div class="pmo-card-body">
                                    <h4 class="pmo-card-title">Protección de Plazo, Costo y Calidad</h4>
                                    <p class="pmo-card-desc">Decisiones anticipadas que evitan sobrecostos y controversias contractuales.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Columna Derecha: Ilustración Visual (Placeholder) -->
                    <div class="split-image-col">
                        <div class="image-card-wrapper">
                            <!-- ========================================================================= -->
                            <!-- INSERTAR IMAGEN AQUÍ: /img/hero-riesgos.jpg o gráfico técnico (600x400)   -->
                            <!-- ========================================================================= -->
                            <div class="image-container">
                                <picture>
                                    <source srcset="img/gesRi1.webp" type="image/webp">
                                    <img src="img/gesRi1.png" alt="Gestión de riesgos técnicos en proyectos de ingeniería y construcción" class="section-image" loading="lazy" width="600" height="400">
                                </picture>
                                <div class="image-badge-tag">
                                    <i class="fa-solid fa-shield-halved"></i> Riesgo Técnico Controlado
                                </div>
                            </div>
                            <div class="image-caption">
                                <p><i class="fa-solid fa-circle-check"></i> Mitigación proactiva de desviaciones en proyectos complejos de ingeniería y construcción.</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             4. SECCIÓN "NUESTRO PROCESO DE GESTIÓN DE RIESGOS" (Roadmap 6 Pasos)
             ========================================================================== -->
        <section class="content-section bg-alternate section-process" id="proceso-riesgos">
            <div class="section-container">
                
                <div class="section-header-center">
                    <span class="sub-badge">Ciclo Integral de Gestión</span>
                    <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">NUESTRO PROCESO DE GESTIÓN DE RIESGOS</h2>
                    <div class="heading-line center-line"></div>
                    <p class="section-subtitle-text">Metodología estructurada de 6 etapas continuas para asegurar la previsibilidad y éxito del proyecto.</p>
                </div>

                <!-- Roadmap / Flujo de 6 Pasos (Horizontal en Desktop / Vertical en Móvil) -->
                <div class="risk-roadmap-container">
                    
                    <!-- Paso 1 -->
                    <div class="roadmap-step">
                        <div class="step-badge-number">01</div>
                        <div class="step-icon-wrap">
                            <i class="fa-solid fa-clipboard-list"></i>
                        </div>
                        <div class="step-content">
                            <span class="step-tag">Paso 1</span>
                            <h3 class="step-title animate__animated animate__fadeInUp animate__delay-1s">Planificación de la Gestión de Riesgos</h3>
                            <p class="step-desc">Revisión del proyecto, documentación, contexto y desarrollo del Plan de Gestión.</p>
                        </div>
                    </div>

                    <!-- Paso 2 -->
                    <div class="roadmap-step">
                        <div class="step-badge-number">02</div>
                        <div class="step-icon-wrap">
                            <i class="fa-solid fa-magnifying-glass-chart"></i>
                        </div>
                        <div class="step-content">
                            <span class="step-tag">Paso 2</span>
                            <h3 class="step-title animate__animated animate__fadeInUp animate__delay-1s">Identificación de Riesgos</h3>
                            <p class="step-desc">Documentación de riesgos individuales y fuentes generales.</p>
                        </div>
                    </div>

                    <!-- Paso 3 -->
                    <div class="roadmap-step">
                        <div class="step-badge-number">03</div>
                        <div class="step-icon-wrap">
                            <i class="fa-solid fa-chart-column"></i>
                        </div>
                        <div class="step-content">
                            <span class="step-tag">Paso 3</span>
                            <h3 class="step-title animate__animated animate__fadeInUp animate__delay-1s">Análisis de Riesgos</h3>
                            <p class="step-desc">Evaluación por probabilidad, impacto y prioridad.</p>
                        </div>
                    </div>

                    <!-- Paso 4 -->
                    <div class="roadmap-step">
                        <div class="step-badge-number">04</div>
                        <div class="step-icon-wrap">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <div class="step-content">
                            <span class="step-tag">Paso 4</span>
                            <h3 class="step-title animate__animated animate__fadeInUp animate__delay-1s">Planificación de Respuestas</h3>
                            <p class="step-desc">Estrategias y opciones para abordar cada riesgo.</p>
                        </div>
                    </div>

                    <!-- Paso 5 -->
                    <div class="roadmap-step">
                        <div class="step-badge-number">05</div>
                        <div class="step-icon-wrap">
                            <i class="fa-solid fa-gears"></i>
                        </div>
                        <div class="step-content">
                            <span class="step-tag">Paso 5</span>
                            <h3 class="step-title animate__animated animate__fadeInUp animate__delay-1s">Implementación de Respuestas</h3>
                            <p class="step-desc">Ejecución de las acciones acordadas frente a riesgos.</p>
                        </div>
                    </div>

                    <!-- Paso 6 -->
                    <div class="roadmap-step">
                        <div class="step-badge-number">06</div>
                        <div class="step-icon-wrap">
                            <i class="fa-solid fa-eye"></i>
                        </div>
                        <div class="step-content">
                            <span class="step-tag">Paso 6</span>
                            <h3 class="step-title animate__animated animate__fadeInUp animate__delay-1s">Monitoreo de Riesgos</h3>
                            <p class="step-desc">Seguimiento continuo con indicadores y dashboards.</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             5. ELEMENTO VISUAL: REPRESENTACIÓN DE MATRIZ DE RIESGOS (Probabilidad x Impacto)
             ========================================================================== -->
        <section class="content-section section-matrix" id="matriz-riesgos">
            <div class="section-container">
                
                <div class="grid-split-layout matrix-split-layout">
                    
                    <!-- Columna de Texto Explicativo -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge">Herramienta Cuantitativa &amp; Cualitativa</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">MATRIZ DE PROBABILIDAD E IMPACTO</h2>
                            <div class="heading-line"></div>
                        </div>

                        <p class="paragraph-text">
                            La Matriz de Riesgos categoriza cada evento identificado según su probabilidad de ocurrencia e impacto potencial en los objetivos clave (alcance, costo, plazo y calidad). Permite priorizar la atención en los riesgos de severidad Alta (zona roja) y Media (zona amarilla), asignando recursos y planes de contingencia eficientes.
                        </p>

                        <div class="matrix-legend-box">
                            <h4 class="legend-box-title"><i class="fa-solid fa-layer-group"></i> Criterios de Severidad:</h4>
                            <div class="legend-items-list">
                                <div class="legend-item">
                                    <span class="legend-color-dot dot-red"></span>
                                    <div>
                                        <strong>Riesgo Alto (Zona Roja):</strong>
                                        <p>Acción y mitigación inmediata. Requiere plan de respuesta prioritario.</p>
                                    </div>
                                </div>
                                <div class="legend-item">
                                    <span class="legend-color-dot dot-orange"></span>
                                    <div>
                                        <strong>Riesgo Medio (Zona Naranja / Amarilla):</strong>
                                        <p>Monitoreo activo y definición de contingencias operativas.</p>
                                    </div>
                                </div>
                                <div class="legend-item">
                                    <span class="legend-color-dot dot-green"></span>
                                    <div>
                                        <strong>Riesgo Bajo (Zona Verde):</strong>
                                        <p>Aceptación informada y seguimiento periódico en el registro de riesgos.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Columna de Matriz Interactiva en CSS -->
                    <div class="split-image-col">
                        <div class="risk-matrix-card">
                            <div class="matrix-card-header">
                                <h4><i class="fa-solid fa-table-cells"></i> Matriz de Evaluación 5×5</h4>
                                <span class="matrix-tag">PMI / ISO 31000</span>
                            </div>

                            <div class="matrix-visual-wrapper">
                                <!-- Eje Y (Probabilidad) -->
                                <div class="matrix-y-label">
                                    <span>PROBABILIDAD <i class="fa-solid fa-arrow-up"></i></span>
                                </div>

                                <div class="matrix-grid-box">
                                    <!-- Fila 5: Muy Alta -->
                                    <div class="matrix-row">
                                        <span class="row-label">Muy Alta (5)</span>
                                        <div class="matrix-cell cell-yellow" title="P: Muy Alta | I: Muy Bajo">5</div>
                                        <div class="matrix-cell cell-orange" title="P: Muy Alta | I: Bajo">10</div>
                                        <div class="matrix-cell cell-red" title="P: Muy Alta | I: Medio">15</div>
                                        <div class="matrix-cell cell-red" title="P: Muy Alta | I: Alto">20</div>
                                        <div class="matrix-cell cell-red" title="P: Muy Alta | I: Muy Alto">25</div>
                                    </div>

                                    <!-- Fila 4: Alta -->
                                    <div class="matrix-row">
                                        <span class="row-label">Alta (4)</span>
                                        <div class="matrix-cell cell-yellow" title="P: Alta | I: Muy Bajo">4</div>
                                        <div class="matrix-cell cell-orange" title="P: Alta | I: Bajo">8</div>
                                        <div class="matrix-cell cell-orange" title="P: Alta | I: Medio">12</div>
                                        <div class="matrix-cell cell-red" title="P: Alta | I: Alto">16</div>
                                        <div class="matrix-cell cell-red" title="P: Alta | I: Muy Alto">20</div>
                                    </div>

                                    <!-- Fila 3: Media -->
                                    <div class="matrix-row">
                                        <span class="row-label">Media (3)</span>
                                        <div class="matrix-cell cell-green" title="P: Media | I: Muy Bajo">3</div>
                                        <div class="matrix-cell cell-yellow" title="P: Media | I: Bajo">6</div>
                                        <div class="matrix-cell cell-orange" title="P: Media | I: Medio">9</div>
                                        <div class="matrix-cell cell-orange" title="P: Media | I: Alto">12</div>
                                        <div class="matrix-cell cell-red" title="P: Muy Alta | I: Muy Alto">15</div>
                                    </div>

                                    <!-- Fila 2: Baja -->
                                    <div class="matrix-row">
                                        <span class="row-label">Baja (2)</span>
                                        <div class="matrix-cell cell-green" title="P: Baja | I: Muy Bajo">2</div>
                                        <div class="matrix-cell cell-green" title="P: Baja | I: Bajo">4</div>
                                        <div class="matrix-cell cell-yellow" title="P: Baja | I: Medio">6</div>
                                        <div class="matrix-cell cell-orange" title="P: Baja | I: Alto">8</div>
                                        <div class="matrix-cell cell-orange" title="P: Baja | I: Muy Alto">10</div>
                                    </div>

                                    <!-- Fila 1: Muy Baja -->
                                    <div class="matrix-row">
                                        <span class="row-label">Muy Baja (1)</span>
                                        <div class="matrix-cell cell-green" title="P: Muy Baja | I: Muy Bajo">1</div>
                                        <div class="matrix-cell cell-green" title="P: Muy Baja | I: Bajo">2</div>
                                        <div class="matrix-cell cell-green" title="P: Muy Baja | I: Medio">3</div>
                                        <div class="matrix-cell cell-yellow" title="P: Muy Baja | I: Alto">4</div>
                                        <div class="matrix-cell cell-yellow" title="P: Muy Baja | I: Muy Alto">5</div>
                                    </div>

                                    <!-- Eje X (Impacto) -->
                                    <div class="matrix-x-labels">
                                        <span></span>
                                        <span>1 (M.B.)</span>
                                        <span>2 (B)</span>
                                        <span>3 (M)</span>
                                        <span>4 (A)</span>
                                        <span>5 (M.A.)</span>
                                    </div>
                                </div>
                            </div>

                            <div class="matrix-x-title">
                                <span>IMPACTO EN OBJETIVOS <i class="fa-solid fa-arrow-right"></i></span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             6. SECCIÓN "¿QUÉ NOS DIFERENCIA DE OTRAS PROPUESTAS?"
             ========================================================================== -->
        <section class="content-section bg-alternate section-differentiators" id="diferenciadores">
            <div class="section-container">
                
                <div class="section-header-center">
                    <span class="sub-badge">Valor Agregado &amp; Especialización</span>
                    <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">¿QUÉ NOS DIFERENCIA DE OTRAS PROPUESTAS?</h2>
                    <div class="heading-line center-line"></div>
                    <p class="section-subtitle-text">Nuestra propuesta de valor combina experiencia en campo, rigor metodológico y estándares globales.</p>
                </div>

                <!-- Grid de 3 Tarjetas de Diferenciadores -->
                <div class="feature-grid">
                    
                    <div class="feature-card rounded-4 border-start border-4 border-warning" data-aos="fade-right">
                        <div class="feature-icon">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                        <h4>Experiencia del Equipo</h4>
                        <p>Experiencia comprobada de nuestro equipo en proyectos operativos y ejecutivos del sector construcción, minería e infraestructura.</p>
                    </div>

                    <div class="feature-card rounded-4 border-start border-4 border-warning" data-aos="fade-up">
                        <div class="feature-icon">
                            <i class="fa-solid fa-hard-hat"></i>
                        </div>
                        <h4>Riesgo Técnico Especializado</h4>
                        <p>Conocimiento especializado y profundo en gestión de riesgo técnico para diagnosticar y mitigar fallas en obra antes de su ocurrencia.</p>
                    </div>

                    <div class="feature-card rounded-4 border-start border-4 border-warning" data-aos="fade-left">
                        <div class="feature-icon">
                            <i class="fa-solid fa-certificate"></i>
                        </div>
                        <h4>Estándares PMI e ISO 31000</h4>
                        <p>Aplicación rigurosa de buenas prácticas internacionales basadas en la Guía PMBOK® del PMI y el estándar ISO 31000 de Gestión del Riesgo.</p>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             7. SECCIÓN ESTÁNDARES Y MARCOS DE TRABAJO
             ========================================================================== -->
        <section class="content-section section-standards" id="estandares">
            <div class="section-container">
                
                <div class="section-header-center">
                    <span class="sub-badge">Marcos Normativos Internacionales</span>
                    <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">ESTÁNDARES Y MARCOS DE TRABAJO</h2>
                    <div class="heading-line center-line"></div>
                    <p class="section-subtitle-text">Garantizamos metodologías alineadas a los organismos internacionales líderes en gestión y gobernanza de proyectos.</p>
                </div>

                <!-- Grid de 2 Tarjetas de Estándares -->
                <div class="pillars-grid">
                    
                    <!-- Tarjeta PMI -->
                    <div class="pillar-card standard-card">
                        <div class="pillar-header">
                            <div class="pillar-icon">
                                <i class="fa-solid fa-award"></i>
                            </div>
                            <div>
                                <span class="pillar-tag">Project Management Institute</span>
                                <h3 class="pillar-title animate__animated animate__fadeInUp animate__delay-1s">PMI – Gestión de Riesgos</h3>
                            </div>
                        </div>
                        <div class="pillar-body">
                            <div class="standard-media-wrap">
                                <!-- Reemplazar por /img/pmi-risk.jpg -->
                                <picture>
                                    <source srcset="img/Index-RiesgosPMI.webp" type="image/webp">
                                    <img src="img/Index-RiesgosPMI.png" alt="PMI Risk Management" class="standard-img" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&amp;w=600&amp;auto=format&amp;fit=crop';" loading="lazy">
                                </picture>
                            </div>
                            <p class="standard-desc">
                                Aplicamos los lineamientos del <em>Practice Standard for Project Risk Management</em> del PMI, estructurando planes de gestión cuantitativos y cualitativos para cada ciclo de vida del proyecto.
                            </p>
                        </div>
                    </div>

                    <!-- Tarjeta ISO 31000 -->
                    <div class="pillar-card standard-card">
                        <div class="pillar-header">
                            <div class="pillar-icon">
                                <i class="fa-solid fa-shield-check"></i>
                            </div>
                            <div>
                                <span class="pillar-tag">International Organization for Standardization</span>
                                <h3 class="pillar-title animate__animated animate__fadeInUp animate__delay-1s">ISO 31000 – Risk Management</h3>
                            </div>
                        </div>
                        <div class="pillar-body">
                            <div class="standard-media-wrap">
                                <!-- Reemplazar por /img/iso-31000.jpg -->
                                <picture>
                                    <source srcset="img/ISO1.webp" type="image/webp">
                                    <img src="img/ISO1.png" alt="ISO 31000" class="standard-img" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1507679799987-c73779587ccf?q=80&amp;w=600&amp;auto=format&amp;fit=crop';" loading="lazy">
                                </picture>
                            </div>
                            <p class="standard-desc">
                                Implementamos la arquitectura de gobernanza de la norma ISO 31000, integrando el marco de gestión de riesgos en la cultura corporativa y en la toma de decisiones directivas.
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             8. FRASE DESTACADA (Quote Banner)
             ========================================================================== -->
        <section class="quote-banner-section">
            <div class="quote-container">
                <div class="quote-card">
                    <div class="quote-icon"><i class="fa-solid fa-quote-left"></i></div>
                    <blockquote class="quote-text">
                        “El problema de ayer es el riesgo de hoy, y el problema de hoy el riesgo del mañana.”
                    </blockquote>
                    <div class="quote-divider"></div>
                    <span class="quote-author">Quality Consulting Solutions • Principio de Gestión Proactiva</span>
                </div>
            </div>
        </section>

        <!-- ==========================================================================
             9. LLAMADO A LA ACCIÓN (CTA Final)
             ========================================================================== -->
        <section class="cta-banner-section">
            <div class="cta-container">
                <div class="cta-box">
                    <div class="cta-content">
                        <span class="cta-tag"><i class="fa-solid fa-shield-halved"></i> Prevención &amp; Control</span>
                        <h3 class="animate__animated animate__fadeInUp animate__delay-1s">Gestiona los riesgos antes de que se conviertan en problemas</h3>
                        <p>Anticípate a las contingencias operativas y asegura la rentabilidad de tu proyecto con nuestra asesoría especializada.</p>
                        
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
                            <i class="fa-solid fa-envelope"></i> Solicitar asesoría
                        </a>
                        <a href="https://wa.me/51993463118" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp btn-large animate__animated animate__pulse animate__infinite btn-qcs-primary">
                            <i class="fa-brands fa-whatsapp"></i> WhatsApp Directo
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>
