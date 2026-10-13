<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Enfoque PMI de la Gestión de la Calidad
 * Archivo: app/Views/pages/calidad-y-pmi.php
 */

declare(strict_types=1);
?>
<main class="page-content">

        <!-- ==========================================================================
             1. SECCIÓN HERO / ENCABEZADO DEL CURSO (Hero Azul Corporativo)
             ========================================================================== -->
        <section class="page-banner banner-calidad-pmi">
            <div class="page-banner-bg banner-calidad-pmi-bg"></div>
            <div class="page-banner-overlay"></div>
            <div class="page-banner-container">
                
                <!-- Badge Superior Requerido -->
                <div class="page-title-wrap">
                    <span class="course-badge">
                        <i class="fas fa-award"></i> ESTÁNDAR PMBOK® SECCIÓN 8 | CALIDAD EN CONSTRUCCIÓN
                    </span>
                    <h1 class="page-main-title animate__animated animate__fadeInDown">ENFOQUE PMI DE LA GESTIÓN DE LA CALIDAD</h1>
                    <div class="title-underline"></div>
                </div>

                <!-- Subtítulo Requerido -->
                <div class="intro-card">
                    <p class="intro-text animate__animated animate__fadeInUp animate__delay-1s">
                        Aprende a vincular la Sección 8 de la Guía del PMBOK® con la realidad operativa, control de campo y lecciones aprendidas en proyectos de construcción.
                    </p>
                </div>

                <!-- Grid de 3 Tarjetas de Valor Ejecutivo dentro del Hero -->
                <div class="hero-cards-grid">
                    
                    <!-- Tarjeta 1: Modalidad Grabada Online -->
                    <div class="hero-feature-card">
                        <div class="hero-feature-icon">
                            <i class="fa-solid fa-circle-play"></i>
                        </div>
                        <div class="hero-feature-content">
                            <h3 class="hero-feature-title animate__animated animate__fadeInUp animate__delay-1s">Modalidad Grabada Online</h3>
                            <p class="hero-feature-desc animate__animated animate__fadeInUp animate__delay-1s">Modalidad grabada 100% online. Acceso inmediato a las clases y disponible 24/7.</p>
                        </div>
                    </div>

                    <!-- Tarjeta 2: Flexibilidad Multiplataforma -->
                    <div class="hero-feature-card">
                        <div class="hero-feature-icon">
                            <i class="fa-solid fa-laptop-code"></i>
                        </div>
                        <div class="hero-feature-content">
                            <h3 class="hero-feature-title animate__animated animate__fadeInUp animate__delay-1s">Flexibilidad Multiplataforma</h3>
                            <p class="hero-feature-desc animate__animated animate__fadeInUp animate__delay-1s">Disponible desde PC, Laptop, Tablet y Celular (Video HD y Chat interactivo).</p>
                        </div>
                    </div>

                    <!-- Tarjeta 3: Acreditación Profesional -->
                    <div class="hero-feature-card">
                        <div class="hero-feature-icon">
                            <i class="fa-solid fa-stamp"></i>
                        </div>
                        <div class="hero-feature-content">
                            <h3 class="hero-feature-title animate__animated animate__fadeInUp animate__delay-1s">Diploma y Beneficios</h3>
                            <p class="hero-feature-desc animate__animated animate__fadeInUp animate__delay-1s">Incluye Diploma físico + Ingreso a Bolsa de Trabajo + Descuentos de Ex-alumno.</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             2. PERFIL DEL DOCENTE, OBJETIVO E IMAGEN TÉCNICA (Layout 2 Columnas)
             ========================================================================== -->
        <section class="content-section" id="perfil-objetivo">
            <div class="section-container">
                
                <div class="grid-split-layout">
                    
                    <!-- Columna Izquierda: Perfil Docente Ejecutivo -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge"><i class="fa-solid fa-user-graduate"></i> Experiencia &amp; Liderazgo Técnico</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">DOCENTE DEL PROGRAMA</h2>
                            <div class="heading-line"></div>
                        </div>

                        <!-- Tarjeta Técnica del Docente -->
                        <div class="docente-card docente-pmi-highlight" style="margin-top: 1.25rem;">
                            <div class="docente-avatar-box">
                                <div class="docente-avatar"><picture><source srcset="img/Omar_Samaniego.webp" type="image/webp"><img src="img/Omar_Samaniego.png" alt="Ing. Omar Samaniego" class="rounded-circle shadow-sm" style="width: 100%; height: 100%; object-fit: cover; object-position: top;"></picture></div>
                                <span class="docente-verified-badge" title="Docente Principal Colegiado y Certificado">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                            </div>
                            <div class="docente-info">
                                <span class="docente-tag">Docente Principal</span>
                                <h3 class="docente-name animate__animated animate__fadeInUp animate__delay-1s">ING. OMAR SAMANIEGO</h3>
                                
                                <!-- Credenciales / Badges Requeridos -->
                                <div class="docente-credentials-row">
                                    <span class="credential-badge"><i class="fa-solid fa-id-card"></i> CIP</span>
                                    <span class="credential-badge"><i class="fa-solid fa-award"></i> PMP®</span>
                                    <span class="credential-badge"><i class="fa-solid fa-shield-halved"></i> PMI-RMP®</span>
                                    <span class="credential-badge"><i class="fa-solid fa-certificate"></i> IRCA</span>
                                    <span class="credential-badge"><i class="fa-solid fa-medal"></i> LSS Black Belt</span>
                                </div>

                                <!-- Bio / Logros Destacados Requeridos -->
                                <p class="docente-profile">
                                    Profesional con más de 20 años de experiencia en Gestión de la Calidad en el Sector Construcción en empresas líderes del Perú y el extranjero.
                                </p>
                                
                                <div class="docente-recognition-card">
                                    <i class="fa-solid fa-building-columns text-gold"></i>
                                    <div class="docente-recognition-text">
                                        Docente de postgrado en principales universidades del país y ponente en prestigiosos congresos del sector.
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Columna Derecha: Objetivo General + Imagen de Ingeniería -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge"><i class="fa-solid fa-bullseye"></i> Rigor Técnico y Aplicabilidad</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">OBJETIVO DEL CURSO</h2>
                            <div class="heading-line"></div>
                        </div>

                        <!-- Párrafo Explicativo Requerido -->
                        <p class="paragraph-text paragraph-lead">
                            Presentar los aspectos del PMBOK® Sección 8 (Gestión de la Calidad) con un enfoque directo en la construcción, vinculando los términos usados en obra y gabinete con los empleados por el estándar principal del PMI®. Identificar casos reales y compartir lecciones aprendidas donde se apliquen estos elementos de control.
                        </p>

                        <!-- Contenedor para Imagen de Control de Calidad en Obra -->
                        <!-- Imagen conceptual sobre ingeniería civil y control de calidad -->
                        <div class="course-img-preview-box">
                            <picture>
                                <source srcset="img/capmi1.webp" type="image/webp">
                                <img src="img/capmi1.png" alt="Ingenieros revisando control de calidad y planos en obra" class="course-img-preview" loading="lazy">
                            </picture>
                        </div>

                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             3. CONTENIDOS DEL CURSO (Reflexiones y Ejes del PMBOK® - Grid de Tarjetas)
             ========================================================================== -->
        <section class="content-section bg-alternate" id="estructura-analitica">
            <div class="section-container">
                
                <div class="section-header-center">
                    <span class="sub-badge"><i class="fa-solid fa-book-open"></i> Sección 8 de la Guía del PMBOK®</span>
                    <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">ESTRUCTURA CURRICULAR Y EJES ANALÍTICOS</h2>
                    <div class="heading-line center-line"></div>
                    <p class="section-subtitle-text">
                        Un desglose reflexivo y pragmático para transformar los conceptos teóricos de calidad en herramientas de control de alto impacto para la obra.
                    </p>
                </div>

                <div class="pmbok-grid-4">
                    
                    <!-- Tarjeta 1: Módulo Introductorio -->
                    <div class="pmbok-card">
                        <div class="pmbok-card-header">
                            <span class="pmbok-step-badge">MÓDULO 01</span>
                            <div class="pmbok-icon"><i class="fa-solid fa-compass-drafting"></i></div>
                        </div>
                        <span class="reflection-badge">Fundamentos &amp; Conceptos</span>
                        <h4 class="pmbok-card-title">Módulo Introductorio</h4>
                        <p class="pmbok-card-desc">
                            Fundamentos de la gestión de la calidad aplicada a proyectos de construcción e ingeniería. Alineación entre requisitos contractuales, especificaciones técnicas y expectativas de los interesados.
                        </p>
                        <div class="reflection-question">
                            <i class="fa-solid fa-circle-question text-gold"></i> <strong>Eje analítico:</strong> ¿Cómo integrar el estándar PMI® con las normativas técnicas nacionales e internacionales vigentes?
                        </div>
                    </div>

                    <!-- Tarjeta 2: Planificar la Gestión de la Calidad -->
                    <div class="pmbok-card">
                        <div class="pmbok-card-header">
                            <span class="pmbok-step-badge">MÓDULO 02</span>
                            <div class="pmbok-icon"><i class="fa-solid fa-file-signature"></i></div>
                        </div>
                        <span class="reflection-badge">Planificación &amp; Costo-Beneficio</span>
                        <h4 class="pmbok-card-title">Planificar la Gestión de la Calidad</h4>
                        <p class="pmbok-card-desc">
                            Criterios operativos y de gestión. Definición de métricas de calidad, planes de puntos de inspección (PPI) y análisis costo-beneficio de la documentación técnica.
                        </p>
                        <div class="reflection-question">
                            <i class="fa-solid fa-circle-question text-gold"></i> <strong>Reflexión crítica:</strong> ¿Es cierto que a más registros de control es mejor? (Evaluación del costo de la no conformidad vs. sobre-documentación).
                        </div>
                    </div>

                    <!-- Tarjeta 3: Gestionar la Calidad -->
                    <div class="pmbok-card">
                        <div class="pmbok-card-header">
                            <span class="pmbok-step-badge">MÓDULO 03</span>
                            <div class="pmbok-icon"><i class="fa-solid fa-gears"></i></div>
                        </div>
                        <span class="reflection-badge">Evolución del Estándar</span>
                        <h4 class="pmbok-card-title">Gestionar la Calidad</h4>
                        <p class="pmbok-card-desc">
                            Traducción del plan de calidad en actividades y procesos constructivos ejecutables. Auditorías de calidad, diseño para la excelencia y optimización continua de procesos en campo.
                        </p>
                        <div class="reflection-question">
                            <i class="fa-solid fa-circle-question text-gold"></i> <strong>Reflexión crítica:</strong> ¿Por qué el PMI® evolucionó del antiguo término "aseguramiento de la calidad" hacia "gestionar la calidad"? ¿Qué implica este cambio en proyectos reales?
                        </div>
                    </div>

                    <!-- Tarjeta 4: Controlar la Calidad -->
                    <div class="pmbok-card">
                        <div class="pmbok-card-header">
                            <span class="pmbok-step-badge">MÓDULO 04</span>
                            <div class="pmbok-icon"><i class="fa-solid fa-clipboard-check"></i></div>
                        </div>
                        <span class="reflection-badge">Control &amp; Trazabilidad</span>
                        <h4 class="pmbok-card-title">Controlar la Calidad</h4>
                        <p class="pmbok-card-desc">
                            Monitoreo y registro de los resultados de las actividades de calidad para evaluar el desempeño y garantizar que las entregas cumplan con la totalidad de los requisitos.
                        </p>
                        <div class="reflection-question">
                            <i class="fa-solid fa-circle-question text-gold"></i> <strong>Reflexión crítica:</strong> ¿Qué entendemos por control en obra? ¿Es sinónimo únicamente de protocolos de pruebas o abarca la trazabilidad completa del proyecto?
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             4. SECCIÓN MULTIMEDIA (2 Videos Promocionales de YouTube)
             ========================================================================== -->
        <section class="content-section" id="conferencias-videos">
            <div class="section-container">
                
                <div class="section-header-center">
                    <span class="sub-badge"><i class="fa-brands fa-youtube"></i> Masterclasses &amp; Sesiones Técnicas</span>
                    <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">CONFERENCIAS Y PRESENTACIONES DEL CURSO</h2>
                    <div class="heading-line center-line"></div>
                    <p class="section-subtitle-text">
                        Revisa ponencias y explicaciones especializadas sobre la aplicación del enfoque PMI en los procesos de calidad de proyectos de edificación e infraestructura.
                    </p>
                </div>

                <!-- Grid Responsive de 2 Columnas para Videos -->
                <div class="videos-promo-grid">
                    
                    <!-- Video 1 -->
                    <div class="video-card-wrapper">
                        <div class="video-header-bar">
                            <span><i class="fa-brands fa-youtube text-danger"></i> Calidad PMI en Construcción - Parte 1</span>
                            <span class="video-live-pill">
                                <span class="video-live-dot"></span> HD 1080p
                            </span>
                        </div>
                        <div class="video-responsive-container">
                            <iframe src="https://www.youtube.com/embed/hbwy_uESkzI" title="Enfoque PMI de la Gestión de la Calidad - Video 1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                        <div class="video-caption-box">
                            <p>
                                <i class="fa-solid fa-play-circle text-gold"></i> <strong>Fundamentos de la Sección 8:</strong> Vinculación del estándar PMBOK® con el control y ejecución en obra.
                            </p>
                        </div>
                    </div>

                    <!-- Video 2 -->
                    <div class="video-card-wrapper">
                        <div class="video-header-bar">
                            <span><i class="fa-brands fa-youtube text-danger"></i> Calidad PMI en Construcción - Parte 2</span>
                            <span class="video-live-pill">
                                <span class="video-live-dot"></span> HD 1080p
                            </span>
                        </div>
                        <div class="video-responsive-container">
                            <iframe src="https://www.youtube.com/embed/w-hf9BtsF0Q" title="Enfoque PMI de la Gestión de la Calidad - Video 2" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                        <div class="video-caption-box">
                            <p>
                                <i class="fa-solid fa-play-circle text-gold"></i> <strong>Lecciones Aprendidas:</strong> Casos prácticos de aseguramiento, gestión y control de calidad en obra.
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             5. SECCIÓN DE INSCRIPCIÓN Y PASARELAS DE PAGO (CTA Destacado)
             ========================================================================== -->
        <section class="content-section bg-alternate" id="matricula">
            <div class="section-container">
                
                <div class="course-enrollment-card">
                    
                    <span class="enroll-badge">
                        <i class="fa-solid fa-award"></i> PROGRAMA DE ALTA ESPECIALIZACIÓN
                    </span>

                    <h2 class="enroll-title animate__animated animate__fadeInUp animate__delay-1s">INSCRÍBETE Y DOMINA LA CALIDAD PMI EN OBRA</h2>
                    <p class="enroll-subtitle">
                        Obtén las herramientas metodológicas y criterios analíticos para liderar auditorías, optimizar protocolos y garantizar la conformidad técnica de tus proyectos.
                    </p>

                    <!-- Beneficios de la Matrícula -->
                    <div class="enroll-perks-grid">
                        <div class="enroll-perk-item">
                            <div class="enroll-perk-icon">
                                <i class="fa-solid fa-user-check"></i>
                            </div>
                            <span>Docente Contribuidor PMBOK® &amp; Auditor IRCA</span>
                        </div>

                        <div class="enroll-perk-item">
                            <div class="enroll-perk-icon">
                                <i class="fa-solid fa-circle-play"></i>
                            </div>
                            <span>Acceso inmediato a las clases y disponible 24/7.</span>
                        </div>

                        <div class="enroll-perk-item">
                            <div class="enroll-perk-icon">
                                <i class="fa-solid fa-graduation-cap"></i>
                            </div>
                            <span>Incluye Diploma físico.</span>
                        </div>

                        <div class="enroll-perk-item">
                            <div class="enroll-perk-icon">
                                <i class="fa-solid fa-tags"></i>
                            </div>
                            <span>Bolsa Laboral &amp; Descuentos de Ex-alumno</span>
                        </div>
                    </div>

                    <!-- 3 Botones de Acción y Pasarelas de Pago Requeridos -->
                    <div class="payment-buttons-grid-3">
                        
                        <!-- 1. Botón WhatsApp (Consultas Directas) -->
                        <a href="https://api.whatsapp.com/send?phone=51993463118&amp;text=w_%20%20%20%20%20%20Buen%20d%C3%ADa,%20%C2%BFpodr%C3%ADan%20enviarme%20informaci%C3%B3n%20sobre%20el%20curso%20de%20Enfoque%20PMI%20de%20la%20Gesti%C3%B3n%20de%20la%20Calidad?" target="_blank" rel="noopener noreferrer" class="btn-whatsapp payment-action-btn animate__animated animate__pulse animate__infinite" aria-label="Consultar información del curso de Calidad PMI por WhatsApp">
                            <i class="fab fa-whatsapp"></i> Consultar por WhatsApp
                        </a>

                        <!-- 2. Botón Más Información / Brochure (Google Forms) -->
                        <a href="https://docs.google.com/forms/d/e/1FAIpQLSdSFYYYkr_ucWEsF0YTmNt9FLQFzh1A8O0YkOLKyKay1vBGeg/viewform" target="_blank" rel="noopener noreferrer" class="btn-outline payment-action-btn" aria-label="Solicitar más información y brochure del curso en Google Forms">
                            <i class="fas fa-file-pdf"></i> Solicitar Más Información
                        </a>

                        <!-- 3. Botón Comprar Ahora / Hotmart (Checkout Inmediato) -->
                        <a href="https://pay.hotmart.com/A90717682C?bid=1787673008435" target="_blank" rel="noopener noreferrer" class="btn-hotmart payment-action-btn" aria-label="Inscribirse y pagar directamente en Hotmart">
                            <i class="fas fa-shopping-cart"></i> Inscribirse / Comprar en Hotmart
                        </a>

                    </div>

                    <!-- Barra de Confianza y Seguridad -->
                    <div class="payment-trust-bar">
                        <div class="payment-trust-item">
                            <i class="fa-solid fa-lock"></i>
                            <span>Pasarela Hotmart Certificada con SSL 256-bit</span>
                        </div>
                        <div class="payment-trust-item">
                            <i class="fa-solid fa-shield-halved"></i>
                            <span>Pago 100% Seguro y Acceso Inmediato</span>
                        </div>
                        <div class="payment-trust-item">
                            <i class="fa-solid fa-headset"></i>
                            <span>Soporte Académico y Técnico Permanente</span>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             6. LLAMADO A LA ACCIÓN FINAL (Contacto Corporativo)
             ========================================================================== -->
        <section class="cta-banner-section" id="contacto-final">
            <div class="cta-container">
                <div class="cta-box">
                    <div class="cta-content">
                        <span class="cta-tag"><i class="fa-solid fa-award"></i> Estándar de Excelencia</span>
                        <h3 class="animate__animated animate__fadeInUp animate__delay-1s">Eleva el estándar de calidad en tus proyectos</h3>
                        <p>
                            Contáctanos hoy mismo para asegurar tu vacante preferencial, coordinar capacitaciones in-house corporativas o resolver cualquier duda sobre el diploma físico.
                        </p>
                        
                        <!-- Teléfono Visible Clickeable Requerido -->
                        <div class="cta-phone-wrapper" style="margin-top: 1.25rem;">
                            <a href="tel:+51993463118" class="cta-phone-link" aria-label="Llamar al +51 993 463 118">
                                <i class="fa-solid fa-phone-volume"></i>
                                <span>+51 993 463 118</span>
                            </a>
                        </div>
                    </div>

                    <div class="cta-actions">
                        <a href="/contacto" class="btn btn-large btn-qcs-primary">
                            <i class="fa-solid fa-envelope"></i> Contacto Directo
                        </a>
                        <a href="https://api.whatsapp.com/send?phone=51993463118&amp;text=w_%20%20%20%20%20%20Buen%20d%C3%ADa,%20%C2%BFpodr%C3%ADan%20enviarme%20informaci%C3%B3n%20sobre%20el%20curso%20de%20Enfoque%20PMI%20de%20la%20Gesti%C3%B3n%20de%20la%20Calidad?" target="_blank" rel="noopener noreferrer" class="btn btn-large btn-qcs-dark">
                            <i class="fa-brands fa-whatsapp"></i> Chat WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>
