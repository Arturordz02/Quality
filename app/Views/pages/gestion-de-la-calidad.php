<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Gestión de la Calidad en Proyectos
 * Archivo: app/Views/pages/gestion-de-la-calidad.php
 */

declare(strict_types=1);
?>
<main class="page-content">

        <!-- ==========================================================================
             1. SECCIÓN HERO / ENCABEZADO PRINCIPAL (Hero Azul Corporativo)
             ========================================================================== -->
        <section class="page-banner banner-calidad">
            <div class="page-banner-bg banner-calidad-bg"></div>
            <div class="page-banner-overlay"></div>
            <div class="page-banner-container">
                
                <div class="page-title-wrap">
                    <span class="section-tag"><i class="fa-solid fa-square-check"></i> Estandarización &amp; Control Operativo</span>
                    <h1 class="page-main-title animate__animated animate__fadeInDown">GESTIÓN DE LA CALIDAD</h1>
                    <div class="title-underline"></div>
                </div>

                <!-- Subtítulo / Párrafo Requerido -->
                <div class="intro-card">
                    <p class="intro-text animate__animated animate__fadeInUp animate__delay-1s">
                        Estandarización, control, auditoría y mejora continua para obtener resultados más consistentes y trazables en proyectos de ingeniería y construcción.
                    </p>
                </div>

                <!-- Grid de 3 Tarjetas dentro del Hero -->
                <div class="hero-cards-grid">
                    <!-- Tarjeta 1 -->
                    <div class="hero-feature-card">
                        <div class="hero-feature-icon">
                            <i class="fa-solid fa-file-circle-check"></i>
                        </div>
                        <div class="hero-feature-content">
                            <h3 class="hero-feature-title animate__animated animate__fadeInUp animate__delay-1s">ESTANDARIZACIÓN Y DOCUMENTACIÓN</h3>
                            <p class="hero-feature-desc animate__animated animate__fadeInUp animate__delay-1s">Manuales, planes y formatos de control de utilidad real.</p>
                        </div>
                    </div>

                    <!-- Tarjeta 2 -->
                    <div class="hero-feature-card">
                        <div class="hero-feature-icon">
                            <i class="fa-solid fa-clipboard-check"></i>
                        </div>
                        <div class="hero-feature-content">
                            <h3 class="hero-feature-title animate__animated animate__fadeInUp animate__delay-1s">PAUTAS DE AUDITORÍA Y CONTROL</h3>
                            <p class="hero-feature-desc animate__animated animate__fadeInUp animate__delay-1s">Evaluación de trazabilidad, no conformidades y gestión.</p>
                        </div>
                    </div>

                    <!-- Tarjeta 3 -->
                    <div class="hero-feature-card">
                        <div class="hero-feature-icon">
                            <i class="fa-solid fa-rotate-right"></i>
                        </div>
                        <div class="hero-feature-content">
                            <h3 class="hero-feature-title animate__animated animate__fadeInUp animate__delay-1s">MEJORA CONTINUA Y POSTVENTA</h3>
                            <p class="hero-feature-desc animate__animated animate__fadeInUp animate__delay-1s">Análisis de causa raíz y gestión de defectología.</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ==========================================================================
             2. INTRODUCCIÓN AL SERVICIO (Layout de 2 Columnas)
             ========================================================================== -->
        <section class="content-section" id="introduccion-calidad">
            <div class="section-container">
                
                <div class="grid-split-layout">
                    
                    <!-- Columna Izquierda: Texto Explicativo y Badge Destacado -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge">Estandarización Práctica en Proyectos</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">REDUCCIÓN DE LA VARIABILIDAD DE RESULTADOS</h2>
                            <div class="heading-line"></div>
                        </div>

                        <p class="paragraph-text paragraph-lead">
                            En Quality Consulting Solutions brindamos asesoría técnica y capacitación aplicada para orientar la estandarización de procesos constructivos y de ingeniería, fortaleciendo el desempeño en obra.
                        </p>

                        <p class="paragraph-text">
                            Nuestro enfoque se centra en dotar a los equipos de herramientas de aseguramiento y control que sean verdaderamente prácticas, eliminando la sobrecarga burocrática y promoviendo que cada entregable cumpla con las especificaciones técnicas desde la primera vez.
                        </p>

                        <!-- Badge / Caja Destacada Obligatoria -->
                        <div class="quote-badge-box">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            <span>No es necesario buscar una certificación ISO 9001 para comenzar a mejorar la gestión de la calidad en tus proyectos.</span>
                        </div>

                        <p class="paragraph-text" style="font-size: 0.92rem; color: #475569;">
                            Ayudamos a tu organización a encontrar el equilibrio óptimo entre el rigor documental y la agilidad de ejecución en campo, asegurando la trazabilidad total requerida por clientes y supervisores.
                        </p>
                    </div>

                    <!-- Columna Derecha: Tarjetas de Documentación Útil (Grid 2x2) -->
                    <div class="split-image-col">
                        <div class="doc-2x2-grid">
                            
                            <!-- Tarjeta 1: Manuales de Calidad -->
                            <div class="doc-card">
                                <div class="doc-card-icon">
                                    <i class="fa-solid fa-book-bookmark"></i>
                                </div>
                                <h4 class="doc-card-title">Manuales de Calidad</h4>
                                <p class="doc-card-desc">
                                    Políticas, alcance y directrices claras de gestión adaptadas a la escala y tipo de obra, sin exceso de teoría.
                                </p>
                            </div>

                            <!-- Tarjeta 2: Planes de Calidad -->
                            <div class="doc-card">
                                <div class="doc-card-icon">
                                    <i class="fa-solid fa-diagram-project"></i>
                                </div>
                                <h4 class="doc-card-title">Planes de Calidad</h4>
                                <p class="doc-card-desc">
                                    Protocolos de Inspección y Ensayo (PIE) y matrices de responsabilidades por especialidad constructiva.
                                </p>
                            </div>

                            <!-- Tarjeta 3: Formatos de Control -->
                            <div class="doc-card">
                                <div class="doc-card-icon">
                                    <i class="fa-solid fa-list-check"></i>
                                </div>
                                <h4 class="doc-card-title">Formatos de Control</h4>
                                <p class="doc-card-desc">
                                    Listas de chequeo y protocolos de liberación ágiles, fáciles de llenar y verificar en campo por la supervisión.
                                </p>
                            </div>

                            <!-- Tarjeta 4: Herramientas a Medida -->
                            <div class="doc-card">
                                <div class="doc-card-icon">
                                    <i class="fa-solid fa-sliders"></i>
                                </div>
                                <h4 class="doc-card-title">Herramientas a Medida</h4>
                                <p class="doc-card-desc">
                                    Dashboards dinámicos para el seguimiento en tiempo real de No Conformidades (RNC) y dossier de calidad.
                                </p>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             4. AUDITORÍA DE LA GESTIÓN DE LA CALIDAD E IMAGEN OBLIGATORIA 1
             ========================================================================== -->
        <section class="content-section bg-alternate" id="auditoria-calidad">
            <div class="section-container">
                
                <div class="grid-split-layout">
                    
                    <!-- Columna Izquierda: Texto Explicativo y Alerta -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge">Control en Campo &amp; Trazabilidad</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">ASESORÍA EN GESTIÓN DE LA CALIDAD</h2>
                            <div class="heading-line"></div>
                        </div>

                        <p class="paragraph-text paragraph-lead">
                            Brindamos asesoría especializada para orientar a los equipos en la implementación de protocolos de calidad, pautas de auditoría interna y verificación documental, asegurando la trazabilidad de materiales, ensayos y liberación de frentes de trabajo.
                        </p>

                        <p class="paragraph-text">
                            Orientamos en el análisis de causas de las no conformidades recurrentes y facilitamos herramientas para evaluar el grado de cumplimiento de los protocolos contractuales, previniendo contingencias durante la recepción de la obra.
                        </p>

                        <!-- Banner de Alerta Estilizado Obligatorio -->
                        <div class="alert-box-quality">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <div>
                                <strong>Una mala gestión de la calidad puede atrasar la recepción formal de tu proyecto.</strong>
                                <p style="margin: 0.35rem 0 0 0; font-size: 0.86rem; color: #475569;">
                                    Las observaciones no levantadas a tiempo y los vacíos en el dossier de calidad impiden la firma de actas de recepción, demorando valorizaciones finales y liquidaciones contractuales.
                                </p>
                            </div>
                        </div>

                        <!-- Puntos destacados de inspección -->
                        <div class="pmo-levels-grid" style="margin-top: 1.25rem;">
                            <div class="pmo-card">
                                <div class="pmo-card-icon"><i class="fa-solid fa-magnifying-glass-location"></i></div>
                                <div class="pmo-card-body">
                                    <h4 class="pmo-card-title">Inspección In Situ</h4>
                                    <p class="pmo-card-desc">Validación de tolerancias constructivas y contrastación física frente a planos vigentes.</p>
                                </div>
                            </div>
                            <div class="pmo-card">
                                <div class="pmo-card-icon"><i class="fa-solid fa-folder-closed"></i></div>
                                <div class="pmo-card-body">
                                    <h4 class="pmo-card-title">Dossier Continuo</h4>
                                    <p class="pmo-card-desc">Armado progresivo del expediente técnico final para una entrega fluida al cliente.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Columna Derecha: Imagen Obligatoria 1 -->
                    <div class="split-image-col">
                        <div class="image-card-wrapper">
                            <div class="image-container">
                                <picture>
                                    <source srcset="img/gesCa1.webp" type="image/webp">
                                    <img src="img/gesCa1.png" alt="Inspección de seguridad y control de calidad en obra" class="section-image" loading="lazy" width="600" height="400">
                                </picture>
                                <div class="image-badge-tag badge-gold">
                                    <i class="fa-solid fa-clipboard-check"></i> Protocolos de Calidad
                                </div>
                            </div>
                            <div class="image-caption-box">
                                <p><strong>Control de Calidad:</strong> Orientación técnica en protocolos de liberación, trazabilidad de concreto, aceros e instalaciones en obra.</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             5. MEJORA CONTINUA Y CAUSA RAÍZ E IMAGEN OBLIGATORIA 2
             ========================================================================== -->
        <section class="content-section" id="mejora-continua">
            <div class="section-container">
                
                <div class="grid-split-layout">
                    
                    <!-- Columna Izquierda: Diagrama de Flujo Causa Raíz -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge">Ciclo de Aprendizaje Operativo</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">MEJORA CONTINUA Y CAUSA RAÍZ</h2>
                            <div class="heading-line"></div>
                        </div>

                        <p class="paragraph-text paragraph-lead">
                            Corregir el síntoma no evita que el error se repita. Promovemos metodologías estructuradas de análisis de causa raíz (Ishikawa, 5 Porqués) para identificar el origen sistémico de los defectos constructivos.
                        </p>

                        <!-- Flujo Causa Raíz mediante Badges Interactivos -->
                        <div class="flow-badge-chain" aria-label="Flujo de Mejora Continua y Causa Raíz">
                            <div class="flow-badge-item" style="border-color: #ef4444; color: #dc2626;">
                                <i class="fa-solid fa-circle-exclamation" style="color: #ef4444;"></i> Problema / No Conformidad
                            </div>
                            <i class="fa-solid fa-chevron-right flow-badge-arrow"></i>
                            
                            <div class="flow-badge-item">
                                <i class="fa-solid fa-magnifying-glass-chart"></i> Análisis de Causa Raíz
                            </div>
                            <i class="fa-solid fa-chevron-right flow-badge-arrow"></i>
                            
                            <div class="flow-badge-item">
                                <i class="fa-solid fa-wrench"></i> Acción Correctiva
                            </div>
                            <i class="fa-solid fa-chevron-right flow-badge-arrow"></i>
                            
                            <div class="flow-badge-item">
                                <i class="fa-solid fa-lightbulb"></i> Lección Aprendida
                            </div>
                            <i class="fa-solid fa-chevron-right flow-badge-arrow"></i>
                            
                            <div class="flow-badge-item highlight-success">
                                <i class="fa-solid fa-arrow-trend-up"></i> Mejora Sostenible
                            </div>
                        </div>

                        <p class="paragraph-text" style="font-size: 0.92rem; color: #475569;">
                            Al transformar cada no conformidad en una lección aprendida documentada, blindamos los siguientes frentes de trabajo y transferimos el conocimiento a toda la organización para reducir costos por retrabajos.
                        </p>
                    </div>

                    <!-- Columna Derecha: Imagen Obligatoria 2 -->
                    <div class="split-image-col">
                        <div class="image-card-wrapper">
                            <div class="image-container">
                                <picture>
                                    <source srcset="img/gesCa2.webp" type="image/webp">
                                    <img src="img/gesCa2.png" alt="Manual abierto de procesos de negocio y mejora continua" class="section-image" loading="lazy" width="600" height="400">
                                </picture>
                                <div class="image-badge-tag badge-gold">
                                    <i class="fa-solid fa-book-open"></i> Estandarización
                                </div>
                            </div>
                            <div class="image-caption-box">
                                <p><strong>Gestión del Conocimiento:</strong> Documentación sistemática de lecciones aprendidas y actualización continua de los estándares operativos.</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             6. POSTVENTA Y PANEL DE CONTROL DE DEFECTOLOGÍA
             ========================================================================== -->
        <section class="content-section bg-alternate" id="postventa-defectologia">
            <div class="section-container">
                
                <div class="section-header-center">
                    <span class="sub-badge">Gestión de Garantías &amp; Retrabajos</span>
                    <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">POSTVENTA COMO OPORTUNIDAD DE MEJORA</h2>
                    <div class="heading-line center-line"></div>
                    <p class="section-subtitle-text">
                        La postventa no debe ser solo un centro de atención a reclamos, sino la fuente primaria de datos para retroalimentar la ingeniería y los procesos constructivos.
                    </p>
                </div>

                <!-- Grid de 3 Tarjetas de Reflexión Estratégica -->
                <div class="reflection-3-grid">
                    
                    <!-- Tarjeta 1 -->
                    <div class="reflection-card">
                        <span class="reflection-q-badge">Pregunta Clave 01</span>
                        <h4 class="reflection-question">¿Tu organización conoce la frecuencia de ocurrencia de sus defectos?</h4>
                        <p class="reflection-answer">
                            Sin una clasificación estadística rigurosa, los mismos errores de acabado e instalaciones se repiten de obra en obra, absorbiendo márgenes de utilidad en costos de garantía.
                        </p>
                    </div>

                    <!-- Tarjeta 2 -->
                    <div class="reflection-card">
                        <span class="reflection-q-badge">Pregunta Clave 02</span>
                        <h4 class="reflection-question">¿Existe un flujo efectivo para compartir las lecciones recogidas en postventa?</h4>
                        <p class="reflection-answer">
                            La desconexión habitual entre los equipos de atención de garantías y los ingenieros de producción impide corregir las causas de raíz durante la etapa de construcción.
                        </p>
                    </div>

                    <!-- Tarjeta 3 -->
                    <div class="reflection-card">
                        <span class="reflection-q-badge">Pregunta Clave 03</span>
                        <h4 class="reflection-question">¿Qué medidas preventivas se toman a partir de la información obtenida?</h4>
                        <p class="reflection-answer">
                            Ayudamos a convertir los datos históricos de postventa en modificaciones directas a los protocolos de control, especificaciones de compra y capacitación de subcontratistas.
                        </p>
                    </div>

                </div>

                <!-- Módulo Gráfico Conceptual: Panel de Control de Defectología -->
                <div class="defect-panel-box">
                    
                    <div class="defect-panel-header">
                        <h3 class="defect-panel-title animate__animated animate__fadeInUp animate__delay-1s">
                            <i class="fa-solid fa-chart-pie"></i> Panel de Control de Postventa &amp; Defectología
                        </h3>
                        <span class="badge-tag badge-gold">Monitoreo Predictivo</span>
                    </div>

                    <!-- Métricas Principales -->
                    <div class="defect-metrics-grid">
                        <div class="defect-metric-item">
                            <div class="defect-metric-val">100%</div>
                            <div class="defect-metric-label">Trazabilidad de Reclamos</div>
                        </div>
                        <div class="defect-metric-item">
                            <div class="defect-metric-val">-65%</div>
                            <div class="defect-metric-label">Reducción de Retrabajos</div>
                        </div>
                        <div class="defect-metric-item">
                            <div class="defect-metric-val">98.2%</div>
                            <div class="defect-metric-label">Cierre a Primera Inspección</div>
                        </div>
                    </div>

                    <!-- Barras de Tendencias y Frecuencias -->
                    <div class="defect-bars-wrapper">
                        
                        <div class="defect-bar-item">
                            <div class="defect-bar-info">
                                <span>Defectos en Acabados &amp; Pintura</span>
                                <span>85% Mitigado</span>
                            </div>
                            <div class="defect-progress-track">
                                <div class="defect-progress-fill" style="width: 85%;"></div>
                            </div>
                        </div>

                        <div class="defect-bar-item">
                            <div class="defect-bar-info">
                                <span>Instalaciones Sanitarias &amp; Fugas</span>
                                <span>92% Controlado</span>
                            </div>
                            <div class="defect-progress-track">
                                <div class="defect-progress-fill fill-blue" style="width: 92%;"></div>
                            </div>
                        </div>

                        <div class="defect-bar-item">
                            <div class="defect-bar-info">
                                <span>Fisuras &amp; Juntas de Dilatación</span>
                                <span>96% Optimizado</span>
                            </div>
                            <div class="defect-progress-track">
                                <div class="defect-progress-fill fill-green" style="width: 96%;"></div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             7. RESUMEN: LOS 4 PILARES DEL SERVICIO (Grid 2x2)
             ========================================================================== -->
        <section class="content-section" id="pilares-calidad">
            <div class="section-container">
                
                <div class="section-header-center">
                    <span class="sub-badge">Marco Integral de Servicios</span>
                    <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">LOS 4 PILARES DE LA GESTIÓN DE LA CALIDAD</h2>
                    <div class="heading-line center-line"></div>
                    <p class="section-subtitle-text">
                        Una propuesta integral diseñada para acompañar a tu empresa desde la estandarización documental inicial hasta el control de calidad en campo y la gestión de postventa.
                    </p>
                </div>

                <!-- Grid 2x2 de Pilares -->
                <div class="pillars-2x2-grid">
                    
                    <!-- Pilar 1: Gestión de la Calidad -->
                    <div class="pillar-card">
                        <div class="pillar-icon-box">
                            <i class="fa-solid fa-file-shield"></i>
                        </div>
                        <div class="pillar-content">
                            <h4 class="pillar-title">1. Gestión de la Calidad</h4>
                            <p class="pillar-desc">
                                Estandarización de procesos, elaboración de manuales de calidad, planes de aseguramiento (PAQ) y diseño de formatos de control útiles, adaptados a la realidad de la obra.
                            </p>
                        </div>
                    </div>

                    <!-- Pilar 2: Auditoría Técnica -->
                    <div class="pillar-card">
                        <div class="pillar-icon-box">
                            <i class="fa-solid fa-clipboard-check"></i>
                        </div>
                        <div class="pillar-content">
                            <h4 class="pillar-title">2. Pautas de Auditoría Interna</h4>
                            <p class="pillar-desc">
                                Orientación y criterios metodológicos para evaluar el estado de la calidad, trazabilidad de materiales, cierre oportuno de observaciones y preparación del dossier final.
                            </p>
                        </div>
                    </div>

                    <!-- Pilar 3: Mejora Continua -->
                    <div class="pillar-card">
                        <div class="pillar-icon-box">
                            <i class="fa-solid fa-arrow-trend-up"></i>
                        </div>
                        <div class="pillar-content">
                            <h4 class="pillar-title">3. Mejora Continua</h4>
                            <p class="pillar-desc">
                                Análisis sistemático de causa raíz ante no conformidades, implementación de acciones correctivas de fondo y registro estructurado de lecciones aprendidas.
                            </p>
                        </div>
                    </div>

                    <!-- Pilar 4: Postventa -->
                    <div class="pillar-card">
                        <div class="pillar-icon-box">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <div class="pillar-content">
                            <h4 class="pillar-title">4. Postventa</h4>
                            <p class="pillar-desc">
                                Estudio estadístico de defectología, paneles de control predictivos y retroalimentación directa a los equipos de compras y construcción para evitar reincidencias.
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             8. LLAMADO A LA ACCIÓN (CTA FINAL)
             ========================================================================== -->
        <section class="cta-banner-section forense-cta-section" id="contacto-calidad">
            <div class="cta-container">
                <div class="cta-box">
                    <div class="cta-content">
                        <span class="cta-tag"><i class="fa-solid fa-shield-halved"></i> Asesoría Especializada</span>
                        <h3 class="animate__animated animate__fadeInUp animate__delay-1s">Mejora la gestión de la calidad de tus proyectos</h3>
                        <p class="cta-subtext">
                            Estandariza tus procesos, asegura la trazabilidad en obra y elimina sobrecostos por retrabajos con el acompañamiento de nuestros especialistas senior.
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
