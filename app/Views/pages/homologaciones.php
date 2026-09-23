<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de P?gina: Preparaci?n para Homologaci?n de Proveedores
 * Archivo: app/Views/pages/homologaciones.php
 */

declare(strict_types=1);
?>
<main class="page-content">

        <!-- ==========================================================================
             1. SECCIÓN HERO / ENCABEZADO PRINCIPAL (Hero Azul Corporativo)
             ========================================================================== -->
        <section class="page-banner banner-homologaciones">
            <div class="page-banner-bg banner-homologaciones-bg"></div>
            <div class="page-banner-overlay"></div>
            <div class="page-banner-container">
                
                <div class="page-title-wrap">
                    <span class="section-tag"><i class="fa-solid fa-certificate"></i> Calificación &amp; Auditoría</span>
                    <h1 class="page-main-title animate__animated animate__fadeInDown">PREPARACIÓN PARA HOMOLOGACIÓN</h1>
                    <div class="title-underline"></div>
                </div>

                <!-- Subtítulo / Párrafo Requerido -->
                <div class="intro-card">
                    <p class="intro-text animate__animated animate__fadeInUp animate__delay-1s">
                        Preparamos a tu organización para lograr un resultado exitoso en la auditoría de homologación de tu empresa.
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
                            <h3 class="hero-feature-title animate__animated animate__fadeInUp animate__delay-1s">CUMPLIMIENTO NORMATIVO</h3>
                            <p class="hero-feature-desc animate__animated animate__fadeInUp animate__delay-1s">Alineación con criterios del cliente y entidades homologadoras.</p>
                        </div>
                    </div>

                    <!-- Tarjeta 2 -->
                    <div class="hero-feature-card">
                        <div class="hero-feature-icon">
                            <i class="fa-solid fa-folder-tree"></i>
                        </div>
                        <div class="hero-feature-content">
                            <h3 class="hero-feature-title animate__animated animate__fadeInUp animate__delay-1s">REVISIÓN DOCUMENTARIA</h3>
                            <p class="hero-feature-desc animate__animated animate__fadeInUp animate__delay-1s">Ordenamiento y preparación exhaustiva de expedientes.</p>
                        </div>
                    </div>

                    <!-- Tarjeta 3 -->
                    <div class="hero-feature-card">
                        <div class="hero-feature-icon">
                            <i class="fa-solid fa-user-shield"></i>
                        </div>
                        <div class="hero-feature-content">
                            <h3 class="hero-feature-title animate__animated animate__fadeInUp animate__delay-1s">ACOMPAÑAMIENTO EN AUDITORÍA</h3>
                            <p class="hero-feature-desc animate__animated animate__fadeInUp animate__delay-1s">Soporte especializado para el sector construcción e ingeniería.</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ==========================================================================
             2. INTRODUCCIÓN AL SERVICIO E IMAGEN OBLIGATORIA 1
             ========================================================================== -->
        <section class="content-section" id="introduccion-homologacion">
            <div class="section-container">
                
                <div class="grid-split-layout">
                    
                    <!-- Columna Izquierda: Texto Explicativo y Flujo de Badges -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge">Calificación Integral de Proveedores</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">¿QUÉ ES UNA HOMOLOGACIÓN DE PROVEEDORES?</h2>
                            <div class="heading-line"></div>
                        </div>

                        <p class="paragraph-text paragraph-lead">
                            La <strong>homologación de proveedores</strong> es un proceso técnico y formal mediante el cual una empresa cliente o una entidad auditora especializada evalúa, califica y valida las capacidades de un proveedor bajo parámetros preestablecidos.
                        </p>

                        <p class="paragraph-text">
                            Este procedimiento busca garantizar que el proveedor cuente con los estándares necesarios para ejecutar servicios o suministrar bienes con los más altos niveles de calidad, solvencia financiera, seguridad laboral, gestión ambiental y cumplimiento legal.
                        </p>

                        <!-- Diagrama de flujo simplificado mediante badges -->
                        <div class="flow-badge-chain" aria-label="Secuencia del Proceso de Homologación">
                            <div class="flow-badge-item">
                                <i class="fa-solid fa-building"></i> Proveedor
                            </div>
                            <i class="fa-solid fa-chevron-right flow-badge-arrow"></i>
                            
                            <div class="flow-badge-item">
                                <i class="fa-solid fa-list-check"></i> Evaluación
                            </div>
                            <i class="fa-solid fa-chevron-right flow-badge-arrow"></i>
                            
                            <div class="flow-badge-item">
                                <i class="fa-solid fa-circle-check"></i> Cumplimiento
                            </div>
                            <i class="fa-solid fa-chevron-right flow-badge-arrow"></i>
                            
                            <div class="flow-badge-item highlight-success">
                                <i class="fa-solid fa-award"></i> Homologación Exitosa
                            </div>
                        </div>

                        <p class="paragraph-text" style="font-size: 0.92rem; color: #475569;">
                            En Quality Consulting Solutions estructuramos, ordenamos y validamos previamente cada requisito para asegurar que tu empresa alcance el máximo puntaje de calificación ante entidades auditoras como SGS, Bureau Veritas, Hodelpe, AENOR, entre otras.
                        </p>
                    </div>

                    <!-- Columna Derecha: Imagen Obligatoria 1 -->
                    <div class="split-image-col">
                        <div class="image-card-wrapper">
                            <div class="image-container">
                                <picture>
                                    <source srcset="img/homo1.webp" type="image/webp">
                                    <img src="img/homo1.png" alt="Preparación para Homologación de Proveedores" class="section-image" loading="lazy" width="600" height="400">
                                </picture>
                                <div class="image-badge-tag badge-gold">
                                    <i class="fa-solid fa-shield-check"></i> Calificación Garantizada
                                </div>
                            </div>
                            <div class="image-caption-box">
                                <p><strong>Auditoría de Proveedores:</strong> Validación exhaustiva de capacidades técnicas, operativas, financieras y de seguridad para acceder a licitaciones corporativas.</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             4. SECCIÓN COMPARATIVA: HOMOLOGACIÓN VS. CERTIFICACIÓN ISO
             ========================================================================== -->
        <section class="content-section bg-alternate" id="homologacion-vs-iso">
            <div class="section-container">
                
                <div class="section-header-center">
                    <span class="sub-badge">Diferenciación Conceptual &amp; Práctica</span>
                    <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">HOMOLOGACIÓN VS. CERTIFICACIÓN ISO</h2>
                    <div class="heading-line center-line"></div>
                    <p class="section-subtitle-text">
                        Comprende las diferencias estructurales entre ambos procesos para identificar con precisión el alcance y objetivo de tu requerimiento.
                    </p>
                </div>

                <!-- Dos tarjetas comparativas frente a frente -->
                <div class="versus-container">
                    
                    <!-- Tarjeta Homologación -->
                    <div class="versus-card contractor-card">
                        <div class="versus-header">
                            <div class="versus-header-icon">
                                <i class="fa-solid fa-clipboard-check"></i>
                            </div>
                            <div>
                                <span class="versus-badge">Calificación Comercial &amp; Operativa</span>
                                <h3 class="versus-title animate__animated animate__fadeInUp animate__delay-1s">Proceso de Homologación</h3>
                            </div>
                        </div>

                        <p class="versus-lead">
                            Enfoque en evaluación integral de proveedores bajo criterios definidos por el cliente o la entidad auditora.
                        </p>

                        <ul class="versus-list">
                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                <span><strong>Criterios del Cliente:</strong> Los cuestionarios y ponderaciones responden a las exigencias particulares de la empresa contratante.</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                <span><strong>Evaluación Multidisciplinaria:</strong> Revisa simultáneamente aspectos comerciales, financieros, legales, de SST, medio ambiente y calidad.</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                <span><strong>Preparación Documentaria Ágil:</strong> Ordenamiento y recopilación de evidencias operativas para superar la auditoría en plazos inmediatos.</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                <span><strong>Objetivo Inmediato:</strong> Habilitar a la empresa para participar en licitaciones, contratos de obra o compras corporativas.</span>
                            </li>
                        </ul>

                        <div class="versus-footer-note">
                            <strong>Enfoque Práctico:</strong> Evalúa la idoneidad y el cumplimiento real del proveedor para mitigar riesgos directos en la cadena de suministro del cliente.
                        </div>
                    </div>

                    <!-- Tarjeta Certificación ISO -->
                    <div class="versus-card owner-card">
                        <div class="versus-header">
                            <div class="versus-header-icon">
                                <i class="fa-solid fa-award"></i>
                            </div>
                            <div>
                                <span class="versus-badge">Estándar Internacional de Gestión</span>
                                <h3 class="versus-title animate__animated animate__fadeInUp animate__delay-1s">Certificación ISO</h3>
                            </div>
                        </div>

                        <p class="versus-lead">
                            Referencia comparativa basada en normas internacionales específicas de sistemas de gestión.
                        </p>

                        <ul class="versus-list">
                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                <span><strong>Normas Específicas:</strong> Cada certificación audita una disciplina puntual (ISO 9001 para Calidad, ISO 14001 para Ambiente, ISO 45001 para SST, etc.).</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                <span><strong>Estructura Estandarizada:</strong> Los requisitos se rigen bajo la estructura de alto nivel fijada por la Organización Internacional de Normalización (ISO).</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                <span><strong>Ciclo de Mantenimiento:</strong> Requiere auditorías de certificación inicial y auditorías anuales de seguimiento por 3 años.</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                <span><strong>Objetivo Estratégico:</strong> Madurez de procesos internos, estandarización organizacional y posicionamiento de marca global.</span>
                            </li>
                        </ul>

                        <div class="versus-footer-note">
                            <strong>Enfoque Sistémico:</strong> Certifica que el sistema de gestión de la organización opera bajo un modelo de mejora continua y control estandarizado.
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             5. ¿PARA QUÉ SIRVE UNA HOMOLOGACIÓN? (Grid de Áreas Evaluadas)
             ========================================================================== -->
        <section class="content-section" id="areas-evaluadas">
            <div class="section-container">
                
                <div class="section-header-center">
                    <span class="sub-badge">Áreas Evaluadas en Auditoría</span>
                    <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">¿PARA QUÉ SIRVE UNA HOMOLOGACIÓN?</h2>
                    <div class="heading-line center-line"></div>
                    <p class="section-subtitle-text">
                        La homologación permite validar ante tus clientes que tu empresa cumple rigurosamente con los 4 pilares fundamentales de evaluación técnica y corporativa.
                    </p>
                </div>

                <!-- Grid de 4 Áreas Evaluadas -->
                <div class="application-4-grid">
                    
                    <!-- Área 1: Seguridad y Salud Ocupacional -->
                    <div class="app-card">
                        <div class="app-card-icon">
                            <i class="fa-solid fa-shield-heart"></i>
                        </div>
                        <h4 class="app-card-title">Seguridad y Salud Ocupacional</h4>
                        <p class="app-card-desc">
                            Revisión de la Política de SST, matrices IPERC por puesto de trabajo, Comité o Supervisor de SST, entrega de EPP, inducciones, planes de emergencia e índices de accidentabilidad bajo la Ley 29783.
                        </p>
                    </div>

                    <!-- Área 2: Medio Ambiente -->
                    <div class="app-card">
                        <div class="app-card-icon">
                            <i class="fa-solid fa-leaf"></i>
                        </div>
                        <h4 class="app-card-title">Medio Ambiente</h4>
                        <p class="app-card-desc">
                            Validación de la matriz de aspectos e impactos ambientales, plan de manejo de residuos sólidos (segregación, transporte y disposición final), control de emisiones y cumplimiento ambiental.
                        </p>
                    </div>

                    <!-- Área 3: Requerimientos Generales y Financieros -->
                    <div class="app-card">
                        <div class="app-card-icon">
                            <i class="fa-solid fa-file-invoice-dollar"></i>
                        </div>
                        <h4 class="app-card-title">Requerimientos Generales y Financieros</h4>
                        <p class="app-card-desc">
                            Verificación de estados financieros auditados, ratios de liquidez y solvencia patrimonial, reporte tributario (SUNAT), licencias de funcionamiento, vigencia de poder y solvencia comercial.
                        </p>
                    </div>

                    <!-- Área 4: Requerimientos Técnicos Específicos -->
                    <div class="app-card">
                        <div class="app-card-icon">
                            <i class="fa-solid fa-gears"></i>
                        </div>
                        <h4 class="app-card-title">Requerimientos Técnicos Específicos</h4>
                        <p class="app-card-desc">
                            Evaluación de capacidad operativa, CVs y competencias del personal clave, calibración de equipos, procedimientos técnicos de trabajo, pólizas CAR/SCTR y constancias de experiencia de obras ejecutadas.
                        </p>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             6. ¿POR QUÉ QUALITY CONSULTING SOLUTIONS? E IMAGEN OBLIGATORIA 2
             ========================================================================== -->
        <section class="content-section bg-alternate" id="por-que-quality">
            <div class="section-container">
                
                <div class="grid-split-layout">
                    
                    <!-- Columna Izquierda: Texto del Valor Diferencial -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge">Especialización en Construcción &amp; Ingeniería</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">¿POR QUÉ QUALITY CONSULTING SOLUTIONS?</h2>
                            <div class="heading-line"></div>
                        </div>

                        <p class="paragraph-text paragraph-lead">
                            A diferencia de consultoras genéricas, en <strong>Quality Consulting Solutions</strong> nos especializamos en el sector de <strong>construcción, ingeniería y proyectos electromecánicos e industriales</strong>.
                        </p>

                        <p class="paragraph-text">
                            Comprendemos la terminología técnica, la dinámica real de las obras y los estándares contractuales más exigentes. Nuestros consultores senior cuentan con amplia experiencia en la estructuración de expedientes para las principales entidades homologadoras del país (SGS, Bureau Veritas, Hodelpe, Mega, AENOR, etc.).
                        </p>

                        <p class="paragraph-text">
                            No solo te ayudamos a obtener el certificado de homologación con la máxima calificación (categoría A / sobresaliente), sino que dejamos implementados procedimientos y registros útiles que elevan la productividad y la seguridad de tu operación.
                        </p>

                        <!-- Puntos clave de valor -->
                        <div class="pmo-levels-grid" style="margin-top: 1.5rem;">
                            <div class="pmo-card">
                                <div class="pmo-card-icon"><i class="fa-solid fa-bullseye"></i></div>
                                <div class="pmo-card-body">
                                    <h4 class="pmo-card-title">Máxima Calificación</h4>
                                    <p class="pmo-card-desc">Optimizamos cada sección del cuestionario para superar el 95% de puntuación en auditoría.</p>
                                </div>
                            </div>
                            <div class="pmo-card">
                                <div class="pmo-card-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
                                <div class="pmo-card-body">
                                    <h4 class="pmo-card-title">Respuesta Rápida</h4>
                                    <p class="pmo-card-desc">Planes de preparación intensivos adaptados a los plazos urgentes de licitaciones y contratos.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Columna Derecha: Imagen Obligatoria 2 -->
                    <div class="split-image-col">
                        <div class="image-card-wrapper">
                            <div class="image-container">
                                <picture>
                                    <source srcset="img/homo2.webp" type="image/webp">
                                    <img src="img/homo2.png" alt="Ingeniero en obra inspeccionando documentación en tablet" class="section-image" loading="lazy" width="600" height="400">
                                </picture>
                                <div class="image-badge-tag badge-gold">
                                    <i class="fa-solid fa-hard-hat"></i> Enfoque en Obra
                                </div>
                            </div>
                            <div class="image-caption-box">
                                <p><strong>Supervisión en Campo:</strong> Consultores con experiencia directa en obra, garantizando que la documentación refleje la realidad operativa de tus proyectos.</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             6. NUESTRO PROCESO DE PREPARACIÓN (Stepper Interactivo de 5 Etapas)
             ========================================================================== -->
        <section class="content-section" id="proceso-homologacion">
            <div class="section-container">
                
                <div class="section-header-center">
                    <span class="sub-badge">Ruta de Preparación Técnica</span>
                    <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">NUESTRO PROCESO DE PREPARACIÓN</h2>
                    <div class="heading-line center-line"></div>
                    <p class="section-subtitle-text">
                        Acompañamos a tu organización a través de un roadmap secuencial de 5 etapas especializadas para asegurar una auditoría con el 100% de conformidad.
                    </p>
                </div>

                <!-- Contenedor del Stepper Moderno -->
                <div class="stepper-process-wrapper">
                    
                    <!-- Barra de Progreso y Nodos Superiores Conectados (Desktop) -->
                    <div class="stepper-track-bar" aria-label="Progreso de Etapas de Homologación">
                        <div class="stepper-node active">
                            <div class="stepper-node-circle">01</div>
                            <span class="stepper-node-label">Diagnóstico</span>
                        </div>
                        <div class="stepper-node">
                            <div class="stepper-node-circle">02</div>
                            <span class="stepper-node-label">Plan de Trabajo</span>
                        </div>
                        <div class="stepper-node">
                            <div class="stepper-node-circle">03</div>
                            <span class="stepper-node-label">Documentación</span>
                        </div>
                        <div class="stepper-node">
                            <div class="stepper-node-circle">04</div>
                            <span class="stepper-node-label">Asesoría</span>
                        </div>
                        <div class="stepper-node">
                            <div class="stepper-node-circle">05</div>
                            <span class="stepper-node-label">Auditoría</span>
                        </div>
                    </div>

                    <!-- Grid de Tarjetas del Stepper -->
                    <div class="stepper-cards-grid">
                        
                        <!-- Etapa 1 -->
                        <div class="stepper-card">
                            <div class="stepper-card-header">
                                <span class="stepper-stage-badge">Etapa 01</span>
                                <div class="stepper-icon-box">
                                    <i class="fa-solid fa-magnifying-glass-chart"></i>
                                </div>
                            </div>
                            <h4 class="stepper-card-title">Diagnóstico Previo</h4>
                            <p class="stepper-card-desc">
                                Evaluación inicial de brechas frente al cuestionario específico requerido por la empresa contratante o la entidad auditora.
                            </p>
                            <div class="stepper-deliverable-pill">
                                <i class="fa-solid fa-circle-check"></i> Matriz de Brechas
                            </div>
                        </div>

                        <!-- Etapa 2 -->
                        <div class="stepper-card">
                            <div class="stepper-card-header">
                                <span class="stepper-stage-badge">Etapa 02</span>
                                <div class="stepper-icon-box">
                                    <i class="fa-solid fa-list-check"></i>
                                </div>
                            </div>
                            <h4 class="stepper-card-title">Plan de Trabajo</h4>
                            <p class="stepper-card-desc">
                                Estructuración cronológica de actividades, asignación de responsables y definición de entregables según las fechas límites fijadas.
                            </p>
                            <div class="stepper-deliverable-pill">
                                <i class="fa-solid fa-circle-check"></i> Cronograma de Acción
                            </div>
                        </div>

                        <!-- Etapa 3 -->
                        <div class="stepper-card">
                            <div class="stepper-card-header">
                                <span class="stepper-stage-badge">Etapa 03</span>
                                <div class="stepper-icon-box">
                                    <i class="fa-solid fa-file-shield"></i>
                                </div>
                            </div>
                            <h4 class="stepper-card-title">Revisión de Documentos</h4>
                            <p class="stepper-card-desc">
                                Elaboración, redacción, ordenamiento y validación técnica rigurosa de cada expediente, matriz y registro operativo.
                            </p>
                            <div class="stepper-deliverable-pill">
                                <i class="fa-solid fa-circle-check"></i> Expediente Validado
                            </div>
                        </div>

                        <!-- Etapa 4 -->
                        <div class="stepper-card">
                            <div class="stepper-card-header">
                                <span class="stepper-stage-badge">Etapa 04</span>
                                <div class="stepper-icon-box">
                                    <i class="fa-solid fa-chalkboard-user"></i>
                                </div>
                            </div>
                            <h4 class="stepper-card-title">Asesoría &amp; Seguimiento</h4>
                            <p class="stepper-card-desc">
                                Acompañamiento continuo en la implementación de mejoras operativas, inducción del personal y simulacro previo de auditoría.
                            </p>
                            <div class="stepper-deliverable-pill">
                                <i class="fa-solid fa-circle-check"></i> Mejoras Implementadas
                            </div>
                        </div>

                        <!-- Etapa 5 (Final) -->
                        <div class="stepper-card final-stage">
                            <div class="stepper-card-header">
                                <span class="stepper-stage-badge" style="color: #E5A813; background: rgba(5,150,105,0.1); border-color: rgba(5,150,105,0.35);">Etapa 05</span>
                                <div class="stepper-icon-box">
                                    <i class="fa-solid fa-award"></i>
                                </div>
                            </div>
                            <h4 class="stepper-card-title">Acompañamiento en Auditoría</h4>
                            <p class="stepper-card-desc">
                                Soporte y asesoría técnica directa durante la jornada de evaluación ante los auditores externos para garantizar el máximo puntaje.
                            </p>
                            <div class="stepper-deliverable-pill">
                                <i class="fa-solid fa-circle-check"></i> Homologación Aprobada
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             7. LLAMADO A LA ACCIÓN (CTA FINAL)
             ========================================================================== -->
        <section class="cta-banner-section forense-cta-section" id="contacto-homologacion">
            <div class="cta-container">
                <div class="cta-box">
                    <div class="cta-content">
                        <span class="cta-tag"><i class="fa-solid fa-shield-halved"></i> Calificación Asegurada</span>
                        <h3 class="animate__animated animate__fadeInUp animate__delay-1s">Prepárate para tu proceso de homologación</h3>
                        <p class="cta-subtext">
                            Obtén la máxima calificación en tu auditoría de homologación y consolida a tu empresa como proveedor preferente en los proyectos más importantes.
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
