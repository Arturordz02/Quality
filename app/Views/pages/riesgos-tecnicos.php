<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de P?gina: Gesti?n de Riesgos T?cnicos de la Construcci?n
 * Archivo: app/Views/pages/riesgos-tecnicos.php
 */

declare(strict_types=1);
?>
<main class="page-content">

        <!-- ==========================================================================
             1. SECCIÓN HERO / ENCABEZADO DEL CURSO (Hero Azul Corporativo)
             ========================================================================== -->
        <section class="page-banner banner-riesgos-tecnicos">
            <div class="page-banner-bg banner-riesgos-tecnicos-bg"></div>
            <div class="page-banner-overlay"></div>
            <div class="page-banner-container">
                
                <!-- Badge Superior Requerido -->
                <div class="page-title-wrap">
                    <span class="course-badge-upcoming">
                        <i class="fas fa-clock"></i> FORMACIÓN APLICADA | CAPACITACIÓN ESPECIALIZADA
                    </span>
                    <h1 class="page-main-title animate__animated animate__fadeInDown">GESTIÓN DE RIESGOS TÉCNICOS DE LA CONSTRUCCIÓN</h1>
                    <div class="title-underline"></div>
                </div>

                <!-- Subtítulo Requerido -->
                <div class="intro-card">
                    <p class="intro-text animate__animated animate__fadeInUp animate__delay-1s">
                        Aprende a vincular los procesos de gestión de riesgos de la Guía del PMBOK® con los aspectos prácticos y lecciones aprendidas en obra.
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
                            <p class="hero-feature-desc animate__animated animate__fadeInUp animate__delay-1s">Modalidad grabada 100% online. Acceso inmediato a las clases y disponible 24/7.</p>
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

                    <!-- Tarjeta 3: Beneficios de Acreditación -->
                    <div class="hero-feature-card">
                        <div class="hero-feature-icon">
                            <i class="fa-solid fa-stamp"></i>
                        </div>
                        <div class="hero-feature-content">
                            <h3 class="hero-feature-title animate__animated animate__fadeInUp animate__delay-1s">Diploma y Beneficios</h3>
                            <p class="hero-feature-desc animate__animated animate__fadeInUp animate__delay-1s">Incluye Diploma + Ingreso a Bolsa de Trabajo + Descuentos de Ex-alumno.</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>



        <!-- ==========================================================================
             3. PERFIL DEL DOCENTE Y OBJETIVO DEL CURSO (Layout 2 Columnas)
             ========================================================================== -->
        <section class="content-section" id="perfil-objetivo">
            <div class="section-container">
                
                <div class="grid-split-layout">
                    
                    <!-- Columna Izquierda: Perfil del Docente Destacado -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge"><i class="fa-solid fa-user-graduate"></i> Excelencia Académica &amp; Profesional</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">DOCENTE DEL PROGRAMA</h2>
                            <div class="heading-line"></div>
                        </div>

                        <!-- Tarjeta del Docente Destacado -->
                        <div class="docente-card" style="margin-top: 1.25rem;">
                            <div class="docente-avatar-box">
                                <div class="docente-avatar"><picture><source srcset="img/Omar_Samaniego.webp" type="image/webp"><img src="img/Omar_Samaniego.png" alt="Ing. Omar Samaniego" class="rounded-circle shadow-sm" style="width: 100%; height: 100%; object-fit: cover; object-position: top;"></picture></div>
                                <span class="docente-verified-badge" title="Docente Principal Certificado">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                            </div>
                            <div class="docente-info">
                                <span class="docente-tag">Docente Principal</span>
                                <h3 class="docente-name animate__animated animate__fadeInUp animate__delay-1s">ING. OMAR SAMANIEGO</h3>
                                
                                <!-- Credenciales / Badges Requeridos -->
                                <div class="docente-credentials-row">
                                    <span class="credential-badge"><i class="fa-solid fa-certificate"></i> CIP</span>
                                    <span class="credential-badge"><i class="fa-solid fa-award"></i> PMP®</span>
                                    <span class="credential-badge"><i class="fa-solid fa-shield-halved"></i> PMI-RMP®</span>
                                    <span class="credential-badge"><i class="fa-solid fa-check-double"></i> IRCA</span>
                                    <span class="credential-badge"><i class="fa-solid fa-medal"></i> LSS Black Belt</span>
                                </div>

                                <!-- Bio / Logros Destacados Requeridos -->
                                <p class="docente-profile">
                                    Profesional con más de 20 años de experiencia en Gestión de la Calidad en el Sector Construcción en empresas líderes del Perú y el extranjero.
                                </p>
                                <p class="docente-profile" style="margin-bottom: 0;">
                                    Docente de postgrado en las principales universidades del país y ponente en prestigiosos congresos.
                                </p>

                                <!-- Reconocimiento Clave Requerido -->
                                <div class="docente-recognition-card">
                                    <i class="fa-solid fa-star text-gold"></i>
                                    <div class="docente-recognition-text">
                                        <strong>Reconocimiento Clave:</strong> Contribuidor Registrado del Estándar de Gestión de Riesgos del PMI® y Contribuidor Registrado de la Guía del PMBOK®.
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Columna Derecha: Objetivo General del Curso -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge"><i class="fa-solid fa-bullseye"></i> Enfoque Teórico-Práctico en Obra</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">OBJETIVO DEL CURSO</h2>
                            <div class="heading-line"></div>
                        </div>

                        <!-- Párrafo Explicativo Requerido -->
                        <p class="paragraph-text paragraph-lead">
                            Presentar el vínculo de los procesos de la gestión de los riesgos según la Guía del PMBOK®, con los aspectos prácticos de la construcción. Identificar casos reales y compartir lecciones aprendidas donde se muestre la aplicación de los procesos de gestión de los riesgos en proyectos de ingeniería y obra.
                        </p>

                        <!-- Puntos Clave de Valor Metodológico -->
                        <div class="course-highlights-list" style="margin-top: 1.5rem;">
                            <div class="course-highlight-item">
                                <i class="fa-solid fa-circle-check"></i>
                                <span>Alineamiento estricto a las mejores prácticas internacionales del PMI-RMP® y PMBOK®.</span>
                            </div>
                            <div class="course-highlight-item">
                                <i class="fa-solid fa-circle-check"></i>
                                <span>Matrices cualitativas y cuantitativas adaptadas a las realidades contractuales y de campo.</span>
                            </div>
                            <div class="course-highlight-item">
                                <i class="fa-solid fa-circle-check"></i>
                                <span>Estrategias de mitigación proactivas frente a retrasos de cronograma y sobrecostos técnicos.</span>
                            </div>
                            <div class="course-highlight-item">
                                <i class="fa-solid fa-circle-check"></i>
                                <span>Lecciones aprendidas en mega-obras de edificación, minería, energía e infraestructura vial.</span>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             4. SECCIÓN MULTIMEDIA (2 Videos Promocionales de YouTube Responsive)
             ========================================================================== -->
        <section class="content-section bg-alternate" id="multimedia-videos">
            <div class="section-container">
                
                <div class="section-header-center">
                    <span class="sub-badge"><i class="fa-brands fa-youtube"></i> Cápsulas de Conocimiento &amp; Metodología</span>
                    <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">CONOCE MÁS SOBRE LA METODOLOGÍA Y RIESGOS TÉCNICOS</h2>
                    <div class="heading-line center-line"></div>
                    <p class="section-subtitle-text">
                        Visualiza las presentaciones y explicaciones del Ing. Omar Samaniego sobre la aplicación real de la gestión de riesgos en proyectos de alta complejidad.
                    </p>
                </div>

                <!-- Grid Responsive de 2 Columnas para Videos -->
                <div class="videos-promo-grid">
                    
                    <!-- Video 1 -->
                    <div class="video-card-wrapper">
                        <div class="video-header-bar">
                            <span><i class="fa-brands fa-youtube text-danger"></i> Metodología y Casos Prácticos - Parte 1</span>
                            <span class="video-live-pill">
                                <span class="video-live-dot"></span> HD 1080p
                            </span>
                        </div>
                        <div class="video-responsive-container">
                            <iframe src="https://www.youtube.com/embed/i_SoabWi3uo" title="Gestión de Riesgos Técnicos de la Construcción - Video 1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                        <div class="video-caption-box">
                            <p>
                                <i class="fa-solid fa-play-circle text-gold"></i> <strong>Fundamentos y Enfoque PMBOK®:</strong> Identificación técnica y estructuración del plan de riesgos en fases tempranas del proyecto.
                            </p>
                        </div>
                    </div>

                    <!-- Video 2 -->
                    <div class="video-card-wrapper">
                        <div class="video-header-bar">
                            <span><i class="fa-brands fa-youtube text-danger"></i> Aplicación y Lecciones en Obra - Parte 2</span>
                            <span class="video-live-pill">
                                <span class="video-live-dot"></span> HD 1080p
                            </span>
                        </div>
                        <div class="video-responsive-container">
                            <iframe src="https://www.youtube.com/embed/lMo47jd1z8w" title="Gestión de Riesgos Técnicos de la Construcción - Video 2" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                        <div class="video-caption-box">
                            <p>
                                <i class="fa-solid fa-play-circle text-gold"></i> <strong>Respuesta y Control Operativo:</strong> Implementación y monitoreo continuo de contingencias para blindar el plazo y costo contractual.
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             5. MÓDULOS DEL TEMARIO / CONTENIDOS DEL CURSO (Grid Modular PMBOK®)
             ========================================================================== -->
        <section class="content-section" id="estructura-curricular">
            <div class="section-container">
                
                <div class="section-header-center">
                    <span class="sub-badge"><i class="fa-solid fa-diagram-project"></i> Estándares Globales PMI®</span>
                    <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">ESTRUCTURA CURRICULAR</h2>
                    <div class="heading-line center-line"></div>
                    <p class="section-subtitle-text">
                        Programa dividido en 6 módulos especializados correspondientes a los procesos fundamentales de la Guía del PMBOK® aplicados al sector construcción.
                    </p>
                </div>

                <!-- Grid Modular de 6 Tarjetas Interactivas con Hover -->
                <div class="pmbok-grid-6">
                    
                    <!-- Módulo 1 -->
                    <div class="pmbok-card">
                        <div class="pmbok-card-header">
                            <span class="pmbok-step-badge">PROCESO 01</span>
                            <div class="pmbok-icon">
                                <i class="fa-solid fa-compass-drafting"></i>
                            </div>
                        </div>
                        <h3 class="pmbok-card-title animate__animated animate__fadeInUp animate__delay-1s">1. Planificar la Gestión de Riesgos</h3>
                        <p class="pmbok-card-desc">
                            Definición del enfoque metodológico, roles, responsabilidades, presupuesto de contingencia, periodicidad y categorías de riesgo técnico (RBS) adaptadas al entorno de obra.
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
                            Técnicas de levantamiento en campo: talleres interdisciplinarios, listas de chequeo, análisis de supuestos, lecciones aprendidas y registro detallado de riesgos de ingeniería y procura.
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
                        <h3 class="pmbok-card-title animate__animated animate__fadeInUp animate__delay-1s">3. Analizar los Riesgos</h3>
                        <p class="pmbok-card-desc">
                            Evaluación cualitativa (Probabilidad e Impacto, matriz PxI, urgencia y criticidad) y conceptos de análisis cuantitativo aplicados a incertidumbres en cronograma y presupuesto.
                        </p>
                    </div>

                    <!-- Módulo 4 -->
                    <div class="pmbok-card">
                        <div class="pmbok-card-header">
                            <span class="pmbok-step-badge">PROCESO 04</span>
                            <div class="pmbok-icon">
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>
                        </div>
                        <h3 class="pmbok-card-title animate__animated animate__fadeInUp animate__delay-1s">4. Planificar la Respuesta a Riesgos</h3>
                        <p class="pmbok-card-desc">
                            Diseño de estrategias efectivas frente a amenazas (mitigar, evitar, transferir, aceptar) y oportunidades (explotar, mejorar, compartir). Asignación de propietarios y reservas de contingencia.
                        </p>
                    </div>

                    <!-- Módulo 5 -->
                    <div class="pmbok-card">
                        <div class="pmbok-card-header">
                            <span class="pmbok-step-badge">PROCESO 05</span>
                            <div class="pmbok-icon">
                                <i class="fa-solid fa-gears"></i>
                            </div>
                        </div>
                        <h3 class="pmbok-card-title animate__animated animate__fadeInUp animate__delay-1s">5. Implementar la Respuesta a Riesgos</h3>
                        <p class="pmbok-card-desc">
                            Ejecución operativa de los planes de mitigación acordados dentro del cronograma y procesos constructivos diarios, garantizando el involucramiento activo de contratistas y supervisión.
                        </p>
                    </div>

                    <!-- Módulo 6 -->
                    <div class="pmbok-card">
                        <div class="pmbok-card-header">
                            <span class="pmbok-step-badge">PROCESO 06</span>
                            <div class="pmbok-icon">
                                <i class="fa-solid fa-gauge-high"></i>
                            </div>
                        </div>
                        <h3 class="pmbok-card-title animate__animated animate__fadeInUp animate__delay-1s">6. Monitorear los Riesgos</h3>
                        <p class="pmbok-card-desc">
                            Seguimiento al estado de los riesgos registrados, identificación de riesgos emergentes, auditorías de riesgo técnico, reevaluación periódica y actualización de lecciones aprendidas.
                        </p>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             6. SECCIÓN DE INSCRIPCIÓN Y PASARELAS DE PAGO (CTA Destacado)
             ========================================================================== -->
        <section class="content-section bg-alternate" id="inscripcion">
            <div class="section-container">
                
                <div class="course-enrollment-card">
                    
                    <span class="enroll-badge">
                        <i class="fa-solid fa-bolt"></i> CURSO ESPECIALIZADO • CLASES GRABADAS
                    </span>
                    
                    <h2 class="enroll-title animate__animated animate__fadeInUp animate__delay-1s">ASEGURA TU VACANTE EN EL PROGRAMA</h2>
                    <p class="enroll-subtitle">
                        Accede a la formación de más alto nivel en riesgos para la construcción con respaldo institucional, docentes de primer nivel y diploma.
                    </p>

                    <!-- Beneficios de la Matrícula -->
                    <div class="enroll-perks-grid">
                        <div class="enroll-perk-item">
                            <div class="enroll-perk-icon">
                                <i class="fa-solid fa-chalkboard-user"></i>
                            </div>
                            <span>Docente Contribuidor PMBOK® y Estándar PMI®</span>
                        </div>

                        <div class="enroll-perk-item">
                            <div class="enroll-perk-icon">
                                <i class="fa-solid fa-cloud-arrow-down"></i>
                            </div>
                            <span>Acceso inmediato a las clases y disponible 24/7.</span>
                        </div>

                        <div class="enroll-perk-item">
                            <div class="enroll-perk-icon">
                                <i class="fa-solid fa-certificate"></i>
                            </div>
                            <span>Incluye Diploma.</span>
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
                        <a href="https://api.whatsapp.com/send?phone=51993463118&amp;text=w_%20%20%20%20%20%20Buen%20d%C3%ADa,%20%C2%BFpodr%C3%ADan%20enviarme%20informaci%C3%B3n%20sobre%20el%20curso%20de%20Gesti%C3%B3n%20de%20Riesgos%20T%C3%A9cnicos?" target="_blank" rel="noopener noreferrer" class="btn-whatsapp payment-action-btn animate__animated animate__pulse animate__infinite" aria-label="Consultar información del curso de Riesgos Técnicos por WhatsApp">
                            <i class="fab fa-whatsapp"></i> Consultar por WhatsApp
                        </a>

                        <!-- 2. Botón Brochure / Ficha Técnica (Google Forms) -->
                        <a href="https://docs.google.com/forms/d/e/1FAIpQLSdG6DxrwAwUbAKicVXhgyV3TXrXcKVLhlVTc-BO95mJkgCe0g/viewform" target="_blank" rel="noopener noreferrer" class="btn-outline payment-action-btn" aria-label="Solicitar información y brochure del curso en Google Forms">
                            <i class="fas fa-file-pdf"></i> Info &amp; Brochure
                        </a>

                        <!-- 3. Botón Pago Seguro VisaNet (Niubiz) -->
                        <a href="https://www.visanetlink.pe/pagoseguro/QUALITYCONSULTINGSOLUTIONS/177481" target="_blank" rel="noopener noreferrer" class="btn-visanet payment-action-btn" aria-label="Realizar pago seguro con VisaNet o Niubiz">
                            <i class="fas fa-credit-card"></i> Pago Seguro Niubiz/Visa
                        </a>

                        <!-- 4. Botón Pago PayPal (Internacional) -->
                        <a href="https://www.paypal.com/paypalme/qualityconsulting/225" target="_blank" rel="noopener noreferrer" class="btn-paypal payment-action-btn" aria-label="Realizar pago internacional seguro a través de PayPal">
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
             7. LLAMADO A LA ACCIÓN FINAL (Contacto Corporativo)
             ========================================================================== -->
        <section class="cta-banner-section" id="contacto-final">
            <div class="cta-container">
                <div class="cta-box">
                    <div class="cta-content">
                        <span class="cta-tag"><i class="fa-solid fa-calendar-check"></i> Próxima Convocatoria</span>
                        <h3 class="animate__animated animate__fadeInUp animate__delay-1s">Reserva tu cupo para la próxima apertura</h3>
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
                        <a href="https://api.whatsapp.com/send?phone=51993463118&amp;text=w_%20%20%20%20%20%20Buen%20d%C3%ADa,%20%C2%BFpodr%C3%ADan%20enviarme%20informaci%C3%B3n%20sobre%20el%20curso%20de%20Gesti%C3%B3n%20de%20Riesgos%20T%C3%A9cnicos?" target="_blank" rel="noopener noreferrer" class="btn btn-large btn-qcs-dark">
                            <i class="fa-brands fa-whatsapp"></i> Chat WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>
