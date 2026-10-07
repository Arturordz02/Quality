<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Análisis Forense del Cronograma
 * Archivo: app/Views/pages/cronograma-forense.php
 */

declare(strict_types=1);
?>
<main class="page-content">

        <!-- ==========================================================================
             1. SECCIÓN HERO / ENCABEZADO PRINCIPAL (Hero Azul Corporativo)
             ========================================================================== -->
        <section class="page-banner banner-forense">
            <div class="page-banner-bg banner-forense-bg"></div>
            <div class="page-banner-overlay"></div>
            <div class="page-banner-container">
                
                <div class="page-title-wrap">
                    <span class="section-tag"><i class="fa-solid fa-scale-balanced"></i> Asesoría Técnica &amp; Claims</span>
                    <h1 class="page-main-title animate__animated animate__fadeInDown">ANÁLISIS FORENSE DEL CRONOGRAMA</h1>
                    <div class="title-underline"></div>
                </div>

                <!-- Subtítulo / Párrafo Requerido -->
                <div class="intro-card">
                    <p class="intro-text animate__animated animate__fadeInUp animate__delay-1s">
                        Evaluación técnica de retrasos, impactos en la ruta crítica y responsabilidades entre las partes de un proyecto.
                    </p>
                </div>

                <!-- Grid de 3 Tarjetas dentro del Hero -->
                <div class="hero-cards-grid">
                    <!-- Tarjeta 1 -->
                    <div class="hero-feature-card">
                        <div class="hero-feature-icon">
                            <i class="fa-solid fa-network-wired"></i>
                        </div>
                        <div class="hero-feature-content">
                            <h3 class="hero-feature-title animate__animated animate__fadeInUp animate__delay-1s">MÉTODO COLLAPSE AS-BUILT</h3>
                            <p class="hero-feature-desc animate__animated animate__fadeInUp animate__delay-1s">Simulación objetiva del cronograma real ejecutado.</p>
                        </div>
                    </div>

                    <!-- Tarjeta 2 -->
                    <div class="hero-feature-card">
                        <div class="hero-feature-icon">
                            <i class="fa-solid fa-route"></i>
                        </div>
                        <div class="hero-feature-content">
                            <h3 class="hero-feature-title animate__animated animate__fadeInUp animate__delay-1s">RUTA CRÍTICA (CPM)</h3>
                            <p class="hero-feature-desc animate__animated animate__fadeInUp animate__delay-1s">Análisis riguroso mediante Critical Path Method.</p>
                        </div>
                    </div>

                    <!-- Tarjeta 3 -->
                    <div class="hero-feature-card">
                        <div class="hero-feature-icon">
                            <i class="fa-solid fa-gavel"></i>
                        </div>
                        <div class="hero-feature-content">
                            <h3 class="hero-feature-title animate__animated animate__fadeInUp animate__delay-1s">EVALUACIÓN DE IMPACTOS</h3>
                            <p class="hero-feature-desc animate__animated animate__fadeInUp animate__delay-1s">Sustento técnico para reclamos y conciliaciones.</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ==========================================================================
             2. INTRODUCCIÓN AL SERVICIO (Layout de 2 Columnas Responsive)
             ========================================================================== -->
        <section class="content-section" id="introduccion-forense">
            <div class="section-container">
                
                <div class="grid-split-layout">
                    
                    <!-- Columna Izquierda: Texto Explicativo -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge">Análisis de Demoras y Controversias</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">METODOLOGÍA Y ANÁLISIS FORENSE DEL CRONOGRAMA</h2>
                            <div class="heading-line"></div>
                        </div>

                        <p class="paragraph-text paragraph-lead">
                            El servicio de asesoría y capacitación en <strong>Análisis Forense del Cronograma</strong> de Quality Consulting Solutions orienta a los equipos técnicos en la evaluación rigurosa de retrasos ocurridos en proyectos, utilizando la metodología <strong>Collapse As-Built</strong>.
                        </p>

                        <p class="paragraph-text">
                            A través de este enfoque retrospectivo, reconstruimos la verdadera historia cronológica del proyecto mediante la red de precedencias de la Ruta Crítica (CPM). Identificamos eventos de impacto, demoras concurrentes, suspensiones e interferencias para aislar matemáticamente las causas de desviación del plazo contractual.
                        </p>

                        <p class="paragraph-text">
                            Nuestra asesoría técnica y metodológica entrega criterios cuantificables y transparentes con un alto estándar analítico, constituyendo el soporte idóneo para orientar la resolución de controversias, sustentar solicitudes de ampliación de plazo y fundamentar técnicamente expedientes ante juntas de resolución de disputas (DAB) o instancias contractuales.
                        </p>

                        <!-- Puntos destacados de rigor -->
                        <div class="pmo-levels-grid" style="margin-top: 1.5rem;">
                            <div class="pmo-card">
                                <div class="pmo-card-icon"><i class="fa-solid fa-check-double"></i></div>
                                <div class="pmo-card-body">
                                    <h4 class="pmo-card-title">Estándares Internacionales</h4>
                                    <p class="pmo-card-desc">Aplicación alineada con las prácticas recomendadas de AACE International y SCL Delay Protocol.</p>
                                </div>
                            </div>
                            <div class="pmo-card">
                                <div class="pmo-card-icon"><i class="fa-solid fa-magnifying-glass-chart"></i></div>
                                <div class="pmo-card-body">
                                    <h4 class="pmo-card-title">Rigor Metodológico</h4>
                                    <p class="pmo-card-desc">Modelado numérico independiente sin supuestos teóricos subjetivos ni sesgos contractuales.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Columna Derecha: Imagen Obligatoria 1 -->
                    <div class="split-image-col">
                        <div class="image-card-wrapper">
                            <div class="image-container">
                                <picture>
                                    <source srcset="img/crono1.webp" type="image/webp">
                                    <img src="img/crono1.png" alt="Análisis Forense del Cronograma - Quality Consulting Solutions" class="section-image" loading="lazy" width="600" height="400">
                                </picture>
                                <div class="image-badge-tag badge-gold">
                                    <i class="fa-solid fa-award"></i> Metodología Oficial
                                </div>
                            </div>
                            <div class="image-caption-box">
                                <p><strong>Modelado Retrospectivo:</strong> Reconstrucción analítica de redes CPM para deslinde de responsabilidades y cálculo de impacto en plazo final.</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             3. SECCIÓN ¿QUÉ ES EL COLLAPSE AS-BUILT? (Flujo de Proceso Conectado)
             ========================================================================== -->
        <section class="content-section bg-alternate" id="que-es-collapse-as-built">
            <div class="section-container">
                
                <div class="section-header-center">
                    <span class="sub-badge">Simulación Dinámica de Escenarios CPM</span>
                    <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">¿QUÉ ES EL COLLAPSE AS-BUILT?</h2>
                    <div class="heading-line center-line"></div>
                    <p class="section-subtitle-text">
                        El método <strong>Collapse As-Built</strong> (también denominado <em>As-Built Subtracted</em>) es una técnica analítica retrospectiva que utiliza el cronograma real ejecutado (As-Built) y simula qué habría sucedido con la fecha de culminación si se sustraen las actividades de retraso o eventos imputables a una de las partes, recalculando la red mediante el Método de la Ruta Crítica (CPM).
                    </p>
                </div>

                <!-- Representación visual horizontal / vertical conectada -->
                <div class="flow-process-container">
                    
                    <!-- Paso 1 -->
                    <div class="flow-step-wrapper">
                        <div class="flow-step-node">
                            <span class="flow-step-number">01</span>
                            <div class="flow-step-icon">
                                <i class="fa-solid fa-calendar-check"></i>
                            </div>
                            <h4 class="flow-step-title">Cronograma As-Built</h4>
                            <p class="flow-step-desc">Levantamiento completo del cronograma real ejecutado con fechas reales y lógica de precedencias de obra.</p>
                        </div>
                        <div class="flow-arrow-separator">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>

                    <!-- Paso 2 -->
                    <div class="flow-step-wrapper">
                        <div class="flow-step-node">
                            <span class="flow-step-number">02</span>
                            <div class="flow-step-icon">
                                <i class="fa-solid fa-filter-circle-xmark"></i>
                            </div>
                            <h4 class="flow-step-title">Identificación de Retrasos</h4>
                            <p class="flow-step-desc">Detección, categorización y documentación de los eventos y actividades causantes de demora.</p>
                        </div>
                        <div class="flow-arrow-separator">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>

                    <!-- Paso 3 -->
                    <div class="flow-step-wrapper">
                        <div class="flow-step-node">
                            <span class="flow-step-number">03</span>
                            <div class="flow-step-icon">
                                <i class="fa-solid fa-eraser"></i>
                            </div>
                            <h4 class="flow-step-title">Sustracción de Actividades</h4>
                            <p class="flow-step-desc">Eliminación o ajuste de la duración de las actividades de retraso imputadas dentro del modelo CPM.</p>
                        </div>
                        <div class="flow-arrow-separator">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>

                    <!-- Paso 4 -->
                    <div class="flow-step-wrapper">
                        <div class="flow-step-node">
                            <span class="flow-step-number">04</span>
                            <div class="flow-step-icon">
                                <i class="fa-solid fa-compress-arrows-alt"></i>
                            </div>
                            <h4 class="flow-step-title">As-Built Collapsed</h4>
                            <p class="flow-step-desc">Recálculo del cronograma colapsado para proyectar la fecha en que el proyecto habría concluido sin tales eventos.</p>
                        </div>
                        <div class="flow-arrow-separator">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>

                    <!-- Paso 5 -->
                    <div class="flow-step-wrapper" style="flex: 1;">
                        <div class="flow-step-node">
                            <span class="flow-step-number">05</span>
                            <div class="flow-step-icon">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>
                            <h4 class="flow-step-title">Comparación y Evaluación</h4>
                            <p class="flow-step-desc">Contraste entre la fecha real y la fecha colapsada para cuantificar el impacto neto atribuible con exactitud.</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             4. ANÁLISIS DESDE AMBAS PARTES (Layout Frente a Frente / 2 Columnas)
             ========================================================================== -->
        <section class="content-section" id="analisis-partes">
            <div class="section-container">
                
                <div class="section-header-center">
                    <span class="sub-badge">Equidad e Imparcialidad Contractual</span>
                    <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">ANÁLISIS DESDE AMBAS PARTES</h2>
                    <div class="heading-line center-line"></div>
                    <p class="section-subtitle-text">
                        La metodología Collapse As-Built es inherentemente objetiva y neutral. Permite modelar escenarios periciales con el mismo rigor científico desde la perspectiva de cualquiera de las partes contratantes.
                    </p>
                </div>

                <!-- Grid Frente a Frente (2 Columnas) -->
                <div class="versus-container">
                    
                    <!-- Perspectiva del Contratista -->
                    <div class="versus-card contractor-card">
                        <div class="versus-header">
                            <div class="versus-header-icon">
                                <i class="fa-solid fa-helmet-safety"></i>
                            </div>
                            <div>
                                <span class="versus-badge">Defensa de Plazo &amp; Costos</span>
                                <h3 class="versus-title animate__animated animate__fadeInUp animate__delay-1s">Perspectiva del Contratista</h3>
                            </div>
                        </div>

                        <p class="versus-lead">
                            Análisis de retrasos atribuibles al propietario/cliente y su impacto en la fecha de término.
                        </p>

                        <ul class="versus-list">
                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                <span><strong>Demoras en Aprobaciones:</strong> Cuantificación de tiempos perdidos por entrega tardía de ingeniería, RFI o submittals críticos.</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                <span><strong>Falta de Liberación de Áreas:</strong> Impacto en ruta crítica por retrasos del cliente en la entrega de terrenos, licencias o frentes de trabajo.</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                <span><strong>Variaciones de Alcance:</strong> Sustento del efecto temporal acumulado derivado de órdenes de cambio imprevistas.</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                <span><strong>Sustento de Ampliación de Plazo:</strong> Respaldo incontrovertible para reclamaciones de tiempo adicional y mayores costos directos e indirectos.</span>
                            </li>
                        </ul>

                        <div class="versus-footer-note">
                            <strong>Beneficio Clave:</strong> Permite probar ante el cliente que el proyecto habría culminado dentro del plazo contractual de no haber existido eventos imputables a este.
                        </div>
                    </div>

                    <!-- Perspectiva del Dueño / Owner -->
                    <div class="versus-card owner-card">
                        <div class="versus-header">
                            <div class="versus-header-icon">
                                <i class="fa-solid fa-building-user"></i>
                            </div>
                            <div>
                                <span class="versus-badge">Control &amp; Auditoría de Claims</span>
                                <h3 class="versus-title animate__animated animate__fadeInUp animate__delay-1s">Perspectiva del Dueño / Owner</h3>
                            </div>
                        </div>

                        <p class="versus-lead">
                            Análisis de retrasos atribuibles al contratista y su impacto sobre el cronograma.
                        </p>

                        <ul class="versus-list">
                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                <span><strong>Bajo Rendimiento Operativo:</strong> Detección de pérdidas de ritmo y falta de dotación de cuadrillas o maquinaria comprometida.</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                <span><strong>Retrasos en Procura del Constructor:</strong> Aislamiento de demoras causadas por gestión ineficiente de materiales y subcontratos.</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                <span><strong>Trabajos Defectuosos y Rehacer:</strong> Evaluación del impacto generado por no conformidades y retrasos en levantamiento de observaciones.</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                <span><strong>Defensa ante Claims Improcedentes:</strong> Determinación de retrasos concurrentes para desestimar penalidades indebidas o reclamos sin fundamento.</span>
                            </li>
                        </ul>

                        <div class="versus-footer-note">
                            <strong>Beneficio Clave:</strong> Otorga al propietario la justificación técnica necesaria para aplicar penalidades por mora o negociar compensaciones justas.
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             5. NUESTRO PROCESO DE ANÁLISIS & CONTROL DE CRONOGRAMA
             ========================================================================== -->
        <section class="content-section bg-alternate" id="proceso-analisis">
            <div class="section-container">
                
                <div class="grid-split-layout" style="margin-bottom: 3.5rem;">
                    
                    <!-- Columna Izquierda: Introducción del Proceso -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge">Metodología Paso a Paso</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">NUESTRO PROCESO DE ANÁLISIS FORENSE</h2>
                            <div class="heading-line"></div>
                        </div>

                        <p class="paragraph-text paragraph-lead">
                            Desarrollamos una metodología estructurada en 5 etapas secuenciales de alta rigurosidad técnica para auditar la red de actividades y determinar el impacto de cada evento.
                        </p>

                        <p class="paragraph-text">
                            A través de herramientas periciales especializadas (Primavera P6, MS Project) y el rigor del método de la Ruta Crítica (CPM), modelamos las desviaciones reales frente a la línea base aprobada para sustentar conclusiones técnicas indiscutibles.
                        </p>
                    </div>

                    <!-- Columna Derecha: Imagen Obligatoria 2 -->
                    <div class="split-image-col">
                        <div class="image-card-wrapper">
                            <div class="image-container">
                                <picture>
                                    <source srcset="img/crono2.webp" type="image/webp">
                                    <img src="img/crono2.png" alt="Control de Cronograma y Planificación" class="section-image" loading="lazy" width="600" height="400">
                                </picture>
                                <div class="image-badge-tag badge-gold">
                                    <i class="fa-solid fa-diagram-project"></i> Planificación &amp; Control
                                </div>
                            </div>
                            <div class="image-caption-box">
                                <p><strong>Auditoría de Cronogramas:</strong> Control riguroso de líneas base, reprogramaciones y seguimiento de la red de precedencias CPM en proyectos de gran envergadura.</p>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Grid numerado de 5 tarjetas -->
                <div class="stages-5-grid">
                    
                    <!-- Etapa 1 -->
                    <div class="stage-card">
                        <div class="stage-card-number">01</div>
                        <h4 class="stage-card-title">Recopilación de Información</h4>
                        <p class="stage-card-desc">Revisión minuciosa de cronogramas contractuales vigentes, cuadernos de obra, informes diarios, correspondencia técnica, actas de obra y valorizaciones.</p>
                    </div>

                    <!-- Etapa 2 -->
                    <div class="stage-card">
                        <div class="stage-card-number">02</div>
                        <h4 class="stage-card-title">Identificación de Eventos de Retraso</h4>
                        <p class="stage-card-desc">Filtrado y clasificación cronológica de actividades demoradas, interferencias de ingeniería, suspensiones y cambios críticos en el alcance del proyecto.</p>
                    </div>

                    <!-- Etapa 3 -->
                    <div class="stage-card">
                        <div class="stage-card-number">03</div>
                        <h4 class="stage-card-title">Análisis del Cronograma As-Built</h4>
                        <p class="stage-card-desc">Reconstrucción y validación de la red lógica As-Built mediante el enfoque de la Ruta Crítica (CPM), verificando precedencias y holguras reales consumidas.</p>
                    </div>

                    <!-- Etapa 4 -->
                    <div class="stage-card">
                        <div class="stage-card-number">04</div>
                        <h4 class="stage-card-title">Aplicación del Collapse As-Built</h4>
                        <p class="stage-card-desc">Sustracción controlada de los eventos de demora imputables dentro del modelo de programación para calcular la nueva fecha de terminación simulada.</p>
                    </div>

                    <!-- Etapa 5 -->
                    <div class="stage-card">
                        <div class="stage-card-number">05</div>
                        <h4 class="stage-card-title">Comparación y Evaluación</h4>
                        <p class="stage-card-desc">Cuantificación precisa del impacto neto en días sobre la fecha final y emisión del informe pericial con conclusiones claras sobre la atribución de responsabilidades.</p>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             6. ¿PARA QUÉ PUEDE UTILIZARSE? (Tarjetas de Aplicación Técnica)
             ========================================================================== -->
        <section class="content-section" id="aplicaciones-tecnicas">
            <div class="section-container">
                
                <div class="section-header-center">
                    <span class="sub-badge">Casos de Aplicación Técnica</span>
                    <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">¿PARA QUÉ PUEDE UTILIZARSE?</h2>
                    <div class="heading-line center-line"></div>
                    <p class="section-subtitle-text">
                        Nuestro análisis forense proporciona el sustento pericial indispensable en los momentos más críticos de la relación contractual de un proyecto.
                    </p>
                </div>

                <!-- 4 Tarjetas limpias -->
                <div class="application-4-grid">
                    
                    <!-- Tarjeta 1 -->
                    <div class="app-card">
                        <div class="app-card-icon">
                            <i class="fa-solid fa-hourglass-half"></i>
                        </div>
                        <h4 class="app-card-title">Evaluación de Retrasos</h4>
                        <p class="app-card-desc">Medición objetiva y cuantitativa del tiempo real perdido durante la obra, aislando retrasos críticos de demoras no críticas con holgura disponible.</p>
                    </div>

                    <!-- Tarjeta 2 -->
                    <div class="app-card">
                        <div class="app-card-icon">
                            <i class="fa-solid fa-scale-unbalanced-flip"></i>
                        </div>
                        <h4 class="app-card-title">Análisis de Responsabilidades</h4>
                        <p class="app-card-desc">Deslinde transparente y técnicamente sustentado entre retrasos imputables al cliente, al contratista o debidos a fuerza mayor o eventos no compensables.</p>
                    </div>

                    <!-- Tarjeta 3 -->
                    <div class="app-card">
                        <div class="app-card-icon">
                            <i class="fa-solid fa-file-invoice-dollar"></i>
                        </div>
                        <h4 class="app-card-title">Sustento en Reclamos</h4>
                        <p class="app-card-desc">Orientación técnica y fundamentación metodológica para expedientes de reclamo (claims) en solicitudes de ampliación de plazo y mayores gastos generales.</p>
                    </div>

                    <!-- Tarjeta 4 -->
                    <div class="app-card">
                        <div class="app-card-icon">
                            <i class="fa-solid fa-handshake-angle"></i>
                        </div>
                        <h4 class="app-card-title">Respaldo en Conciliación</h4>
                        <p class="app-card-desc">Asesoría especializada y acompañamiento técnico en mesas de trato directo, Juntas de Resolución de Disputas (DAB) y análisis contractual.</p>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             7. LLAMADO A LA ACCIÓN (CTA FINAL)
             ========================================================================== -->
        <section class="cta-banner-section forense-cta-section" id="contacto-forense">
            <div class="cta-container">
                <div class="cta-box">
                    <div class="cta-content">
                        <span class="cta-tag"><i class="fa-solid fa-shield-halved"></i> Asesoría Especializada</span>
                        <h3 class="animate__animated animate__fadeInUp animate__delay-1s">Analiza técnicamente los retrasos de tu proyecto</h3>
                        <p class="cta-subtext">
                            Capacita a tu equipo o accede a asesoría técnica especializada basada en la metodología Collapse As-Built para fundamentar análisis de demoras contractuales.
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
