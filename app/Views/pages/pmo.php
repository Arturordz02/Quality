<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Curso de Especialización en Gestión de la PMO
 * Archivo: app/Views/pages/pmo.php
 */

declare(strict_types=1);
?>
<style>
.pmo-grid-8 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin-top: 2.5rem;
        }

        .pmo-module-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 1.75rem 1.4rem;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all var(--transition-normal);
        }

        .pmo-module-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-blue), var(--accent-gold));
            opacity: 0;
            transition: opacity var(--transition-fast);
        }

        .pmo-module-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-lg);
            border-color: rgba(197, 155, 39, 0.45);
        }

        .pmo-module-card:hover::before {
            opacity: 1;
        }

        .pmo-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.1rem;
        }

        .pmo-step-badge {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: #fef08a;
            font-family: var(--font-heading);
            font-size: 0.74rem;
            font-weight: 800;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            border: 1px solid rgba(229, 168, 19, 0.35);
        }

        .pmo-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: rgba(15, 17, 19, 0.2);
            color: var(--primary-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: all var(--transition-fast);
        }

        .pmo-module-card:hover .pmo-icon {
            background: linear-gradient(135deg, var(--accent-gold), #C9910D);
            color: #ffffff;
            transform: scale(1.1);
        }

        .pmo-card-title {
            font-family: var(--font-heading);
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
            line-height: 1.35;
        }

        .pmo-card-desc {
            font-size: 0.85rem;
            color: var(--text-muted);
            line-height: 1.55;
            margin: 0;
            flex-grow: 1;
        }

        @media (max-width: 1200px) {
            .pmo-grid-8 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .pmo-grid-8 {
                grid-template-columns: 1fr;
                gap: 1.15rem;
            }
        }
</style>

<main class="page-content">
<!-- ==========================================================================
             1. SECCIÓN HERO / ENCABEZADO DEL CURSO (Azul Corporativo)
             ========================================================================== -->
        <section class="page-banner banner-pmo">
            <div class="page-banner-bg" style="background-image: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&amp;fit=crop&amp;w=1920&amp;q=80'); background-size: cover; background-position: center;"></div>
            <div class="page-banner-overlay"></div>
            <div class="page-banner-container">
                
                <!-- Badge Superior Requerido -->
                <div class="page-title-wrap">
                    <span class="course-badge"><i class="fas fa-project-diagram"></i> PROGRAMA DE ESPECIALIZACIÓN</span>
                    <h1 class="page-main-title animate__animated animate__fadeInDown">GESTIÓN DE PROYECTOS & PMO</h1>
                    <div class="title-underline"></div>
                </div>

                <!-- Subtítulo Requerido -->
                <div class="intro-card">
                    <p class="intro-text animate__animated animate__fadeInUp animate__delay-1s">
                        Domina la alineación estratégica, estructuras de gobernanza y gestión de portafolios, programas y proyectos.
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
                            <p class="hero-feature-desc animate__animated animate__fadeInUp animate__delay-1s">Incluye Diploma + Ingreso a Bolsa de Trabajo + Descuentos de Ex-alumno.</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             2. PERFIL DEL DOCENTE Y OBJETIVO GENERAL (Layout 2 Columnas)
             ========================================================================== -->
        <section class="content-section" id="perfil-objetivo">
            <div class="section-container">
                
                <div class="grid-split-layout">
                    
                    <!-- Columna Izquierda: Perfil Docente Ejecutivo -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge"><i class="fa-solid fa-user-tie"></i> Liderazgo &amp; Consultoría Estratégica</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">DOCENTE DEL PROGRAMA</h2>
                            <div class="heading-line"></div>
                        </div>

                        <!-- Tarjeta Técnica del Docente -->
                        <div class="docente-card" style="margin-top: 1.25rem;">
                            <div class="docente-avatar-box">
                                <div class="docente-avatar"><img src="img/Feliz-Valdes-Torero.jpg" alt="MSc. Félix Valdés-Torero" class="rounded-circle shadow-sm" style="width: 100%; height: 100%; object-fit: cover; object-position: top;"></div>
                                <span class="docente-verified-badge" title="Docente Principal Certificado">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                            </div>
                            <div class="docente-info">
                                <span class="docente-tag">Docente Principal</span>
                                <h3 class="docente-name animate__animated animate__fadeInUp animate__delay-1s">MSC. FELIX VALDEZ-TORERO</h3>
                                
                                <!-- Credenciales / Badges Requeridos -->
                                <div class="docente-credentials-row">
                                    <span class="credential-badge"><i class="fa-solid fa-graduation-cap"></i> MSc</span>
                                    <span class="credential-badge"><i class="fa-solid fa-book-bookmark"></i> PhD(c)</span>
                                    <span class="credential-badge"><i class="fa-solid fa-award"></i> PMP®</span>
                                </div>

                                <!-- Bio / Logros Requeridos -->
                                <p class="docente-profile">
                                    Profesional con más de 30 años de experiencia en gestión de la ingeniería, consultoría y capacitación en gerencia de proyectos para empresas de primer nivel.
                                </p>

                                <div class="docente-recognition-card">
                                    <i class="fa-solid fa-sitemap text-gold"></i>
                                    <div class="docente-recognition-text">
                                        Especialista consultor en diseño, despliegue y madurez de Oficinas de Dirección de Proyectos (PMO) en sectores de infraestructura, minería y servicios.
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Columna Derecha: Objetivo General + Imagen de PMO -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge"><i class="fa-solid fa-bullseye"></i> Propósito &amp; Valor Organizacional</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">OBJETIVO DEL CURSO</h2>
                            <div class="heading-line"></div>
                        </div>

                        <!-- Párrafo Explicativo Requerido -->
                        <p class="paragraph-text paragraph-lead">
                            Presentar a los participantes los aspectos fundamentales que componen la Gestión de una Oficina de Dirección de Proyectos (PMO), brindando consejos prácticos, estructuras de implementación y metodologías útiles para sus respectivas organizaciones.
                        </p>

                        <!-- Contenedor para Imagen de Gestión de Proyectos y PMO -->
                        <div class="course-img-preview-box" style="margin-top: 1.25rem; border-radius: 12px; overflow: hidden; box-shadow: var(--shadow-md); border: 1px solid var(--border-color);">
                            <!-- Imagen conceptual sobre gestión de PMO y portafolios -->
                            <img src="img/gpmo1.png" alt="Gestión de PMO, Portafolios y Proyectos" class="course-img-preview" loading="lazy" style="width: 100%; height: 260px; object-fit: cover; display: block;">
                        </div>

                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             3. CONTENIDOS DEL CURSO (Grid Modular de 8 Ejes de la PMO)
             ========================================================================== -->
        <section class="content-section bg-alternate" id="estructura-curricular">
            <div class="section-container">
                
                <div class="section-header-center">
                    <span class="sub-badge"><i class="fa-solid fa-cubes"></i> Malla Curricular Integral</span>
                    <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">ESTRUCTURA CURRICULAR Y PASOS DE IMPLEMENTACIÓN</h2>
                    <div class="heading-line center-line"></div>
                    <p class="section-subtitle-text">
                        8 ejes modulares diseñados para comprender desde la justificación estratégica de la PMO hasta su proceso práctico de diseño, gobierno e implementación operativa.
                    </p>
                </div>

                <!-- Grid Modular de 8 Tarjetas Interactivas -->
                <div class="pmo-grid-8">
                    
                    <!-- Eje 1 -->
                    <div class="pmo-module-card">
                        <div class="pmo-card-header">
                            <span class="pmo-step-badge">MÓDULO 01</span>
                            <div class="pmo-icon"><i class="fa-solid fa-sitemap"></i></div>
                        </div>
                        <h3 class="pmo-card-title animate__animated animate__fadeInUp animate__delay-1s">1. Introducción a la PMO</h3>
                        <p class="pmo-card-desc">
                            Conceptos clave de gobernanza y valor organizacional. Justificación estratégica y beneficios cuantificables para la alta dirección.
                        </p>
                    </div>

                    <!-- Eje 2 -->
                    <div class="pmo-module-card">
                        <div class="pmo-card-header">
                            <span class="pmo-step-badge">MÓDULO 02</span>
                            <div class="pmo-icon"><i class="fa-solid fa-layer-group"></i></div>
                        </div>
                        <h3 class="pmo-card-title animate__animated animate__fadeInUp animate__delay-1s">2. Gestión de Portafolios</h3>
                        <p class="pmo-card-desc">
                            Selección, priorización y alineación de proyectos con los objetivos estratégicos corporativos y balance de recursos.
                        </p>
                    </div>

                    <!-- Eje 3 -->
                    <div class="pmo-module-card">
                        <div class="pmo-card-header">
                            <span class="pmo-step-badge">MÓDULO 03</span>
                            <div class="pmo-icon"><i class="fa-solid fa-diagram-project"></i></div>
                        </div>
                        <h3 class="pmo-card-title animate__animated animate__fadeInUp animate__delay-1s">3. Gestión de Programas</h3>
                        <p class="pmo-card-desc">
                            Dirección de grupos de proyectos relacionados para obtener beneficios consolidados y sinergias que no se logran de forma individual.
                        </p>
                    </div>

                    <!-- Eje 4 -->
                    <div class="pmo-module-card">
                        <div class="pmo-card-header">
                            <span class="pmo-step-badge">MÓDULO 04</span>
                            <div class="pmo-icon"><i class="fa-solid fa-list-check"></i></div>
                        </div>
                        <h3 class="pmo-card-title animate__animated animate__fadeInUp animate__delay-1s">4. Gestión de Proyectos</h3>
                        <p class="pmo-card-desc">
                            Estandarización de metodologías, plantillas, herramientas de control y métricas de desempeño (KPIs y dashboards ejecutivos).
                        </p>
                    </div>

                    <!-- Eje 5 -->
                    <div class="pmo-module-card">
                        <div class="pmo-card-header">
                            <span class="pmo-step-badge">MÓDULO 05</span>
                            <div class="pmo-icon"><i class="fa-solid fa-sliders"></i></div>
                        </div>
                        <h3 class="pmo-card-title animate__animated animate__fadeInUp animate__delay-1s">5. Funciones de la PMO</h3>
                        <p class="pmo-card-desc">
                            Tipos de PMO (De Soporte, Control o Directiva) y sus roles tácticos según las necesidades y cultura de la organización.
                        </p>
                    </div>

                    <!-- Eje 6 -->
                    <div class="pmo-module-card">
                        <div class="pmo-card-header">
                            <span class="pmo-step-badge">MÓDULO 06</span>
                            <div class="pmo-icon"><i class="fa-solid fa-users-gear"></i></div>
                        </div>
                        <h3 class="pmo-card-title animate__animated animate__fadeInUp animate__delay-1s">6. Estructura de la PMO</h3>
                        <p class="pmo-card-desc">
                            Organización del equipo de trabajo, perfiles, roles clave, niveles de autoridad y canales de comunicación dentro de la empresa.
                        </p>
                    </div>

                    <!-- Eje 7 -->
                    <div class="pmo-module-card">
                        <div class="pmo-card-header">
                            <span class="pmo-step-badge">MÓDULO 07</span>
                            <div class="pmo-icon"><i class="fa-solid fa-chart-pie"></i></div>
                        </div>
                        <h3 class="pmo-card-title animate__animated animate__fadeInUp animate__delay-1s">7. Requisitos para la Implementación</h3>
                        <p class="pmo-card-desc">
                            Análisis de madurez organizacional (OPM3/P3M3), mapa de stakeholders, gestión del cambio y patrocinio ejecutivo necesario.
                        </p>
                    </div>

                    <!-- Eje 8 -->
                    <div class="pmo-module-card">
                        <div class="pmo-card-header">
                            <span class="pmo-step-badge">MÓDULO 08</span>
                            <div class="pmo-icon"><i class="fa-solid fa-route"></i></div>
                        </div>
                        <h3 class="pmo-card-title animate__animated animate__fadeInUp animate__delay-1s">8. Proceso de Implementación</h3>
                        <p class="pmo-card-desc">
                            Hoja de ruta paso a paso para el despliegue progresivo, victorias tempranas (Quick Wins) y consolidación de una PMO de alto impacto.
                        </p>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             4. SECCIÓN MULTIMEDIA (2 Videos Promocionales de YouTube)
             ========================================================================== -->
        <section class="content-section" id="conferencias-pmo">
            <div class="section-container">
                
                <div class="section-header-center">
                    <span class="sub-badge"><i class="fa-brands fa-youtube"></i> Masterclasses &amp; Sesiones Técnicas</span>
                    <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">CONFERENCIAS Y PRESENTACIONES SOBRE LA PMO</h2>
                    <div class="heading-line center-line"></div>
                    <p class="section-subtitle-text">
                        Conferencias magistrales impartidas por el MSc. Felix Valdez-Torero sobre el valor estratégico, gobierno y funciones críticas de una PMO.
                    </p>
                </div>

                <!-- Grid Responsive de 2 Columnas para Videos -->
                <div class="videos-promo-grid">
                    
                    <!-- Video 1 -->
                    <div class="video-card-wrapper">
                        <div class="video-header-bar">
                            <span><i class="fa-brands fa-youtube text-danger" style="color: #ef4444; margin-right: 0.35rem;"></i> Conferencia Gestión de la PMO - Sesión 1</span>
                            <span class="video-live-pill">
                                <span class="video-live-dot"></span> HD 1080p
                            </span>
                        </div>
                        <div class="video-responsive-container">
                            <iframe src="https://www.youtube.com/embed/SamU4ATLlNo" title="Conferencias y Presentaciones sobre la PMO - Video 1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                        <div class="video-caption-box">
                            <p>
                                <i class="fa-solid fa-circle-play text-gold" style="color: var(--accent-gold); margin-right: 0.35rem;"></i> <strong>Fundamentos y Tipologías de PMO:</strong> Alineación estratégica entre proyectos corporativos y toma de decisiones.
                            </p>
                        </div>
                    </div>

                    <!-- Video 2 -->
                    <div class="video-card-wrapper">
                        <div class="video-header-bar">
                            <span><i class="fa-brands fa-youtube text-danger" style="color: #ef4444; margin-right: 0.35rem;"></i> Conferencia Gestión de la PMO - Sesión 2</span>
                            <span class="video-live-pill">
                                <span class="video-live-dot"></span> HD 1080p
                            </span>
                        </div>
                        <div class="video-responsive-container">
                            <iframe src="https://www.youtube.com/embed/OIOa69aOCt4" title="Conferencias y Presentaciones sobre la PMO - Video 2" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                        <div class="video-caption-box">
                            <p>
                                <i class="fa-solid fa-circle-play text-gold" style="color: var(--accent-gold); margin-right: 0.35rem;"></i> <strong>Implementación y Madurez Organizacional:</strong> Estructura operativa, monitoreo de portafolio y factores críticos de éxito.
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
                        <i class="fa-solid fa-bolt"></i> PROGRAMA ESPECIALIZADO • CLASES GRABADAS
                    </span>

                    <h2 class="enroll-title animate__animated animate__fadeInUp animate__delay-1s">MATRICÚLATE EN EL CURSO DE GESTIÓN DE LA PMO</h2>
                    <p class="enroll-subtitle">
                        Elige tu canal preferido para recibir atención personalizada, descargar la ficha técnica completa o efectuar tu matrícula en línea de forma segura.
                    </p>

                    <!-- Beneficios de la Matrícula -->
                    <div class="enroll-perks-grid">
                        <div class="enroll-perk-item">
                            <div class="enroll-perk-icon">
                                <i class="fa-solid fa-circle-play"></i>
                            </div>
                            <span>Clases Grabadas 100% Online</span>
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
                        
                        <!-- 1. Botón WhatsApp -->
                        <a href="https://api.whatsapp.com/send?phone=51993463118&amp;text=w_%20%20%20%20%20%20Buen%20d%C3%ADa,%20%C2%BFpodr%C3%ADan%20enviarme%20informaci%C3%B3n%20sobre%20el%20curso%20de%20Gesti%C3%B3n%20de%20la%20PMO?" target="_blank" rel="noopener noreferrer" class="btn-whatsapp payment-action-btn animate__animated animate__pulse animate__infinite" aria-label="Consultar información del curso de PMO por WhatsApp">
                            <i class="fab fa-whatsapp"></i> Consultar por WhatsApp
                        </a>

                        <!-- 2. Botón Brochure / Ficha Técnica -->
                        <a href="https://docs.google.com/forms/d/e/1FAIpQLSebCzdfgUiXYiVof5klRLTbj2wqIX2WZFktmfMm3woWCKvhtw/viewform" target="_blank" rel="noopener noreferrer" class="btn-outline payment-action-btn" aria-label="Descargar información y brochure del curso PMO">
                            <i class="fas fa-file-pdf"></i> Info &amp; Brochure
                        </a>

                        <!-- 3. Botón Niubiz / VisaNet -->
                        <a href="https://www.visanetlink.pe/pagoseguro/QUALITYCONSULTINGSOLUTIONS/58214" target="_blank" rel="noopener noreferrer" class="btn-visanet payment-action-btn" aria-label="Pago Seguro con VisaNet o Niubiz">
                            <i class="fas fa-credit-card"></i> Pago Seguro Niubiz/Visa
                        </a>

                        <!-- 4. Botón PayPal Internacional -->
                        <a href="https://www.paypal.com/paypalme/qualityconsulting/240" target="_blank" rel="noopener noreferrer" class="btn-paypal payment-action-btn" aria-label="Pagar mediante PayPal">
                            <i class="fab fa-paypal"></i> Pagar con PayPal
                        </a>

                    </div>

                    <!-- Barra de Seguridad y Confianza -->
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
                        <span class="cta-tag"><i class="fa-solid fa-sitemap"></i> Asesoría &amp; Despliegue de PMO</span>
                        <h3 class="animate__animated animate__fadeInUp animate__delay-1s">Estructura la PMO de tu organización con estándares globales</h3>
                        <p>
                            Diseñamos programas 'In-House' y asesoramos a corporaciones en la implementación de Oficinas de Gestión de Proyectos a la medida de sus metas estratégicas.
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
                        <a href="https://api.whatsapp.com/send?phone=51993463118&amp;text=w_%20%20%20%20%20%20Buen%20d%C3%ADa,%20%C2%BFpodr%C3%ADan%20enviarme%20informaci%C3%B3n%20sobre%20el%20curso%20de%20Gesti%C3%B3n%20de%20la%20PMO?" target="_blank" rel="noopener noreferrer" class="btn btn-large btn-qcs-dark">
                            <i class="fa-brands fa-whatsapp"></i> Chat WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </section>
</main>
