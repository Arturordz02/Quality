<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de P?gina: Gesti?n de Riesgos con el Enfoque PMI
 * Archivo: app/Views/pages/riesgos-pmi.php
 */

declare(strict_types=1);
?>
<main class="page-content">

        <!-- ==========================================================================
             1. SECCIÓN HERO / ENCABEZADO DEL CURSO (Hero Azul Corporativo)
             ========================================================================== -->
        <section class="page-banner banner-riesgos-pmi">
            <div class="page-banner-bg banner-riesgos-pmi-bg"></div>
            <div class="page-banner-overlay"></div>
            <div class="page-banner-container">
                
                <!-- Badge Superior Requerido -->
                <div class="page-title-wrap">
                    <span class="course-badge">
                        <i class="fas fa-shield-alt"></i> CURSO ESPECIALIZADO EN ENFOQUE PMI
                    </span>
                    <h1 class="page-main-title animate__animated animate__fadeInDown">GESTIÓN DE RIESGOS CON EL ENFOQUE PMI</h1>
                    <div class="title-underline"></div>
                </div>

                <!-- Subtítulo Requerido -->
                <div class="intro-card">
                    <p class="intro-text animate__animated animate__fadeInUp animate__delay-1s">
                        Aprende los aspectos clave y consejos prácticos de la gestión de riesgos bajo los estándares del Project Management Institute.
                    </p>
                </div>

                <!-- Grid de 3 Tarjetas de Características Destacadas dentro del Hero -->
                <div class="hero-cards-grid">
                    
                    <!-- Tarjeta 1: Modalidad Grabada Online -->
                    <div class="hero-feature-card">
                        <div class="hero-feature-icon">
                            <i class="fa-solid fa-circle-play"></i>
                        </div>
                        <div class="hero-feature-content">
                            <h3 class="hero-feature-title animate__animated animate__fadeInUp animate__delay-1s">Modalidad Grabada Online</h3>
                            <p class="hero-feature-desc animate__animated animate__fadeInUp animate__delay-1s">Clases grabadas 100% online en alta definición + Acceso 24/7 a tu propio ritmo.</p>
                        </div>
                    </div>

                    <!-- Tarjeta 2: Acceso Multiplataforma -->
                    <div class="hero-feature-card">
                        <div class="hero-feature-icon">
                            <i class="fa-solid fa-laptop-code"></i>
                        </div>
                        <div class="hero-feature-content">
                            <h3 class="hero-feature-title animate__animated animate__fadeInUp animate__delay-1s">Acceso Multiplataforma</h3>
                            <p class="hero-feature-desc animate__animated animate__fadeInUp animate__delay-1s">Disponible desde PC, Laptop, Tablet y Celular (Video HD y Chat interactivo).</p>
                        </div>
                    </div>

                    <!-- Tarjeta 3: Beneficios -->
                    <div class="hero-feature-card">
                        <div class="hero-feature-icon">
                            <i class="fa-solid fa-stamp"></i>
                        </div>
                        <div class="hero-feature-content">
                            <h3 class="hero-feature-title animate__animated animate__fadeInUp animate__delay-1s">Beneficios</h3>
                            <p class="hero-feature-desc animate__animated animate__fadeInUp animate__delay-1s">Incluye Diploma físico de acreditación + Ingreso a Bolsa de Trabajo + Descuentos de Ex-alumno.</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             2. PERFIL DEL DOCENTE Y OBJETIVO DEL CURSO (Layout 2 Columnas)
             ========================================================================== -->
        <section class="content-section" id="perfil-objetivo">
            <div class="section-container">
                
                <div class="grid-split-layout">
                    
                    <!-- Columna Izquierda: Perfil del Docente Destacado -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge"><i class="fa-solid fa-user-graduate"></i> Experiencia &amp; Liderazgo en Proyectos</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">DOCENTE DEL PROGRAMA</h2>
                            <div class="heading-line"></div>
                        </div>

                        <!-- Tarjeta del Docente Destacado con Fondo Diferenciado -->
                        <div class="docente-card docente-pmi-highlight" style="margin-top: 1.25rem;">
                            <div class="docente-avatar-box">
                                <div class="docente-avatar"><img src="img/Feliz-Valdes-Torero.jpg" alt="MSc. Félix Valdés-Torero" class="rounded-circle shadow-sm" style="width: 100%; height: 100%; object-fit: cover; object-position: top;"></div>
                                <span class="docente-verified-badge" title="Docente Principal Certificado">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                            </div>
                            <div class="docente-info">
                                <span class="docente-tag">Docente Principal</span>
                                <h3 class="docente-name animate__animated animate__fadeInUp animate__delay-1s">FELIX VALDEZ-TORERO</h3>
                                
                                <!-- Credenciales / Badges Requeridos -->
                                <div class="docente-credentials-row">
                                    <span class="credential-badge"><i class="fa-solid fa-graduation-cap"></i> MSc</span>
                                    <span class="credential-badge"><i class="fa-solid fa-book-open-reader"></i> PhD(c)</span>
                                    <span class="credential-badge"><i class="fa-solid fa-award"></i> PMP®</span>
                                </div>

                                <!-- Bio / Logros Destacados Requeridos -->
                                <p class="docente-profile" style="margin-bottom: 0;">
                                    Profesional con más de 30 años de experiencia en gestión de la ingeniería, consultoría y capacitación en gerencia de proyectos para empresas de primer nivel.
                                </p>
                            </div>
                        </div>

                    </div>

                    <!-- Columna Derecha: Objetivo General del Curso -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge"><i class="fa-solid fa-bullseye"></i> Estándares y Aplicabilidad Práctica</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">OBJETIVO DEL CURSO</h2>
                            <div class="heading-line"></div>
                        </div>

                        <!-- Párrafo Explicativo Requerido -->
                        <p class="paragraph-text paragraph-lead">
                            Presentar a los participantes los aspectos fundamentales que componen la Gestión de Riesgos bajo el enfoque PMI, brindando consejos prácticos, metodologías probadas y herramientas útiles directamente aplicables a sus respectivos proyectos.
                        </p>

                        <!-- Puntos Clave de Valor Metodológico -->
                        <div class="course-highlights-list" style="margin-top: 1.5rem;">
                            <div class="course-highlight-item">
                                <i class="fa-solid fa-circle-check"></i>
                                <span>Marco de trabajo alineado al estándar global de Project Management Institute (PMI®).</span>
                            </div>
                            <div class="course-highlight-item">
                                <i class="fa-solid fa-circle-check"></i>
                                <span>Técnicas de análisis cualitativo y cuantitativo para la toma de decisiones informada.</span>
                            </div>
                            <div class="course-highlight-item">
                                <i class="fa-solid fa-circle-check"></i>
                                <span>Estrategias de respuesta proactivas para salvaguardar el alcance, costo y cronograma.</span>
                            </div>
                            <div class="course-highlight-item">
                                <i class="fa-solid fa-circle-check"></i>
                                <span>Casos reales y metodologías aplicables a empresas del sector público y privado.</span>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             3. SECCIÓN MULTIMEDIA (2 Videos Promocionales de YouTube)
             ========================================================================== -->
        <section class="content-section bg-alternate" id="multimedia-videos">
            <div class="section-container">
                
                <div class="section-header-center">
                    <span class="sub-badge"><i class="fa-brands fa-youtube"></i> Conferencias &amp; Metodología en Video</span>
                    <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">VIDEOS Y CONFERENCIAS DEL CURSO</h2>
                    <div class="heading-line center-line"></div>
                    <p class="section-subtitle-text">
                        Accede a las sesiones introductorias y explicaciones técnicas del curso sobre la gestión de riesgos según las mejores prácticas del PMI.
                    </p>
                </div>

                <!-- Grid Responsive de 2 Columnas para Videos -->
                <div class="videos-promo-grid">
                    
                    <!-- Video 1 -->
                    <div class="video-card-wrapper">
                        <div class="video-header-bar">
                            <span><i class="fa-brands fa-youtube text-danger"></i> Gestión de Riesgos PMI - Sesión 1</span>
                            <span class="video-live-pill">
                                <span class="video-live-dot"></span> HD 1080p
                            </span>
                        </div>
                        <div class="video-responsive-container">
                            <iframe src="https://www.youtube.com/embed/XyM4AkTBEDw" title="Gestión de Riesgos con Enfoque PMI - Video 1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                        <div class="video-caption-box">
                            <p>
                                <i class="fa-solid fa-play-circle text-gold"></i> <strong>Fundamentos del Enfoque PMI:</strong> Planificación estratégica e identificación exhaustiva de riesgos en proyectos de ingeniería.
                            </p>
                        </div>
                    </div>

                    <!-- Video 2 -->
                    <div class="video-card-wrapper">
                        <div class="video-header-bar">
                            <span><i class="fa-brands fa-youtube text-danger"></i> Gestión de Riesgos PMI - Sesión 2</span>
                            <span class="video-live-pill">
                                <span class="video-live-dot"></span> HD 1080p
                            </span>
                        </div>
                        <div class="video-responsive-container">
                            <iframe src="https://www.youtube.com/embed/aYsuGztWH0U" title="Gestión de Riesgos con Enfoque PMI - Video 2" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                        <div class="video-caption-box">
                            <p>
                                <i class="fa-solid fa-play-circle text-gold"></i> <strong>Análisis y Control:</strong> Aplicación de análisis cualitativo/cuantitativo y monitoreo continuo del plan de respuesta.
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             4. MÓDULOS DEL TEMARIO / CONTENIDOS DEL CURSO (Grid Modular con Hover)
             ========================================================================== -->
        <section class="content-section" id="estructura-curricular">
            <div class="section-container">
                
                <div class="section-header-center">
                    <span class="sub-badge"><i class="fa-solid fa-diagram-project"></i> Procesos Estándar del Project Management Institute</span>
                    <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">ESTRUCTURA CURRICULAR (ESTÁNDAR PMI)</h2>
                    <div class="heading-line center-line"></div>
                    <p class="section-subtitle-text">
                        Desarrollo integral de los 7 procesos oficiales para gestionar la incertidumbre y maximizar las oportunidades en proyectos complejos.
                    </p>
                </div>

                <!-- Grid Modular de 7 Tarjetas Interactivas con Hover -->
                <div class="pmbok-grid-7">
                    
                    <!-- Módulo 1 -->
                    <div class="pmbok-card">
                        <div class="pmbok-card-header">
                            <span class="pmbok-step-badge">PROCESO 01</span>
                            <div class="pmbok-icon">
                                <i class="fa-solid fa-compass-drafting"></i>
                            </div>
                        </div>
                        <h3 class="pmbok-card-title animate__animated animate__fadeInUp animate__delay-1s">1. Planificar la Gestión de los Riesgos</h3>
                        <p class="pmbok-card-desc">
                            Definición de metodologías, roles, responsabilidades, financiamiento, categorías y límites de tolerancia al riesgo para el proyecto.
                        </p>
                    </div>

                    <!-- Módulo 2 -->
                    <div class="pmbok-card">
                        <div class="pmbok-card-header">
                            <span class="pmbok-step-badge">PROCESO 02</span>
                            <div class="pmbok-icon">
                                <i class="fa-solid fa-magnifying-glass-chart"></i>
                            </div>
                        </div>
                        <h3 class="pmbok-card-title animate__animated animate__fadeInUp animate__delay-1s">2. Identificar los Riesgos</h3>
                        <p class="pmbok-card-desc">
                            Determinación de qué riesgos pueden afectar al proyecto y documentación de sus características mediante lluvia de ideas, Delphi y listas de control.
                        </p>
                    </div>

                    <!-- Módulo 3 -->
                    <div class="pmbok-card">
                        <div class="pmbok-card-header">
                            <span class="pmbok-step-badge">PROCESO 03</span>
                            <div class="pmbok-icon">
                                <i class="fa-solid fa-chart-pie"></i>
                            </div>
                        </div>
                        <h3 class="pmbok-card-title animate__animated animate__fadeInUp animate__delay-1s">3. Realizar el Análisis Cualitativo de los Riesgos</h3>
                        <p class="pmbok-card-desc">
                            Priorización de los riesgos individuales para acción posterior evaluando su probabilidad de ocurrencia e impacto mediante matrices PxI y evaluación de urgencia.
                        </p>
                    </div>

                    <!-- Módulo 4 -->
                    <div class="pmbok-card">
                        <div class="pmbok-card-header">
                            <span class="pmbok-step-badge">PROCESO 04</span>
                            <div class="pmbok-icon">
                                <i class="fa-solid fa-calculator"></i>
                            </div>
                        </div>
                        <h3 class="pmbok-card-title animate__animated animate__fadeInUp animate__delay-1s">4. Realizar el Análisis Cuantitativo de los Riesgos</h3>
                        <p class="pmbok-card-desc">
                            Análisis numérico del efecto combinado de los riesgos identificados sobre los objetivos generales del proyecto mediante simulación Monte Carlo y árboles de decisión.
                        </p>
                    </div>

                    <!-- Módulo 5 -->
                    <div class="pmbok-card">
                        <div class="pmbok-card-header">
                            <span class="pmbok-step-badge">PROCESO 05</span>
                            <div class="pmbok-icon">
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>
                        </div>
                        <h3 class="pmbok-card-title animate__animated animate__fadeInUp animate__delay-1s">5. Planificar la Respuesta a los Riesgos</h3>
                        <p class="pmbok-card-desc">
                            Desarrollo de opciones, selección de estrategias y acuerdo sobre acciones para abordar la exposición general al riesgo y los riesgos individuales.
                        </p>
                    </div>

                    <!-- Módulo 6 -->
                    <div class="pmbok-card">
                        <div class="pmbok-card-header">
                            <span class="pmbok-step-badge">PROCESO 06</span>
                            <div class="pmbok-icon">
                                <i class="fa-solid fa-gears"></i>
                            </div>
                        </div>
                        <h3 class="pmbok-card-title animate__animated animate__fadeInUp animate__delay-1s">6. Implementar la Respuesta a los Riesgos</h3>
                        <p class="pmbok-card-desc">
                            Aseguramiento de que las respuestas planificadas a los riesgos se ejecuten según lo convenido para minimizar amenazas individuales y maximizar oportunidades.
                        </p>
                    </div>

                    <!-- Módulo 7 -->
                    <div class="pmbok-card">
                        <div class="pmbok-card-header">
                            <span class="pmbok-step-badge">PROCESO 07</span>
                            <div class="pmbok-icon">
                                <i class="fa-solid fa-gauge-high"></i>
                            </div>
                        </div>
                        <h3 class="pmbok-card-title animate__animated animate__fadeInUp animate__delay-1s">7. Monitorear los Riesgos</h3>
                        <p class="pmbok-card-desc">
                            Monitoreo de la implementación de las respuestas acordadas, seguimiento a riesgos identificados, identificación y análisis de nuevos riesgos y evaluación de la efectividad.
                        </p>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             5. SECCIÓN DE INSCRIPCIÓN Y PASARELAS DE PAGO (CTA Destacado)
             ========================================================================== -->
        <section class="content-section bg-alternate" id="inscripcion">
            <div class="section-container">
                
                <div class="course-enrollment-card">
                    
                    <span class="enroll-badge">
                        <i class="fa-solid fa-bolt"></i> PRONTO INICIO • VACANTES PREFERENCIALES
                    </span>
                    
                    <h2 class="enroll-title animate__animated animate__fadeInUp animate__delay-1s">ASEGURA TU VACANTE EN EL PROGRAMA</h2>
                    <p class="enroll-subtitle">
                        Accede a la formación especializada en riesgos bajo el estándar global del PMI con respaldo institucional, docentes de primer nivel y certificación oficial.
                    </p>

                    <!-- Beneficios de la Matrícula -->
                    <div class="enroll-perks-grid">
                        <div class="enroll-perk-item">
                            <div class="enroll-perk-icon">
                                <i class="fa-solid fa-chalkboard-user"></i>
                            </div>
                            <span>Docente con más de 30 Años de Experiencia</span>
                        </div>

                        <div class="enroll-perk-item">
                            <div class="enroll-perk-icon">
                                <i class="fa-solid fa-cloud-arrow-down"></i>
                            </div>
                            <span>Acceso 24/7 a Grabaciones y Material Exclusivo</span>
                        </div>

                        <div class="enroll-perk-item">
                            <div class="enroll-perk-icon">
                                <i class="fa-solid fa-certificate"></i>
                            </div>
                            <span>Diploma Físico de Acreditación Oficial</span>
                        </div>

                        <div class="enroll-perk-item">
                            <div class="enroll-perk-icon">
                                <i class="fa-solid fa-briefcase"></i>
                            </div>
                            <span>Bolsa de Trabajo &amp; Beneficios de Ex-alumno</span>
                        </div>
                    </div>

                    <!-- 4 Botones de Acción y Pasarelas de Pago Requeridos -->
                    <div class="payment-buttons-grid">
                        
                        <!-- 1. Botón WhatsApp (Consultas e Información) -->
                        <a href="https://api.whatsapp.com/send?phone=51993463118&amp;text=w_%20%20%20%20%20%20Buen%20d%C3%ADa,%20%C2%BFpodr%C3%ADan%20enviarme%20informaci%C3%B3n%20sobre%20el%20curso%20de%20Gesti%C3%B3n%20de%20Riesgos%20PMI?" target="_blank" rel="noopener noreferrer" class="btn-whatsapp payment-action-btn animate__animated animate__pulse animate__infinite" aria-label="Consultar información del curso de Gestión de Riesgos PMI por WhatsApp">
                            <i class="fab fa-whatsapp"></i> Consultar por WhatsApp
                        </a>

                        <!-- 2. Botón Brochure / Ficha Técnica (Google Forms) -->
                        <a href="https://docs.google.com/forms/d/e/1FAIpQLSdodGi_Gm4EKx031n4tPnmNccYfEyZtYyXKRaWwyuC56ZyjVA/viewform" target="_blank" rel="noopener noreferrer" class="btn-outline payment-action-btn" aria-label="Solicitar información y brochure del curso en Google Forms">
                            <i class="fas fa-file-pdf"></i> Info &amp; Brochure
                        </a>

                        <!-- 3. Botón Pago Seguro VisaNet (Niubiz) -->
                        <a href="https://www.visanetlink.pe/pagoseguro/QUALITYCONSULTINGSOLUTIONS/58214" target="_blank" rel="noopener noreferrer" class="btn-visanet payment-action-btn" aria-label="Realizar pago seguro con VisaNet o Niubiz">
                            <i class="fas fa-credit-card"></i> Pago Seguro Niubiz/Visa
                        </a>

                        <!-- 4. Botón Pago PayPal (Internacional) -->
                        <a href="https://www.paypal.com/paypalme/qualityconsulting/240" target="_blank" rel="noopener noreferrer" class="btn-paypal payment-action-btn" aria-label="Realizar pago internacional seguro a través de PayPal">
                            <i class="fab fa-paypal"></i> Pagar con PayPal
                        </a>

                    </div>

                    <!-- Barra de Confianza y Seguridad -->
                    <div class="payment-trust-bar">
                        <div class="payment-trust-item">
                            <i class="fa-solid fa-lock"></i>
                            <span>Plataforma con Encriptación SSL 256-bit</span>
                        </div>
                        <div class="payment-trust-item">
                            <i class="fa-solid fa-shield-halved"></i>
                            <span>Transacción 100% Segura y Verificada</span>
                        </div>
                        <div class="payment-trust-item">
                            <i class="fa-solid fa-headset"></i>
                            <span>Soporte Académico y Administrativo Permanente</span>
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
                        <span class="cta-tag"><i class="fa-solid fa-calendar-check"></i> Próxima Convocatoria</span>
                        <h3 class="animate__animated animate__fadeInUp animate__delay-1s">Inscríbete y potencia la gestión de tus proyectos</h3>
                        <p>
                            Contáctanos hoy mismo para asegurar tu vacante preferencial, resolver consultas curriculares o consultar por planes corporativos para tu empresa.
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
                        <a href="https://api.whatsapp.com/send?phone=51993463118&amp;text=w_%20%20%20%20%20%20Buen%20d%C3%ADa,%20%C2%BFpodr%C3%ADan%20enviarme%20informaci%C3%B3n%20sobre%20el%20curso%20de%20Gesti%C3%B3n%20de%20Riesgos%20PMI?" target="_blank" rel="noopener noreferrer" class="btn btn-large btn-qcs-dark">
                            <i class="fa-brands fa-whatsapp"></i> Chat WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>
