<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Gerencia de la Calidad para la Infraestructura y Construcción
 * Archivo: app/Views/pages/gerencia-de-calidad.php
 */

declare(strict_types=1);
?>
<main class="page-content">

        <!-- ==========================================================================
             1. SECCIÓN HERO / ENCABEZADO DEL CURSO (Azul Corporativo)
             ========================================================================== -->
        <section class="page-banner banner-gerencia-calidad">
            <div class="page-banner-bg" style="background-image: url('https://images.unsplash.com/photo-1541888946425-d0fbb186a5b3?auto=format&amp;fit=crop&amp;w=1920&amp;q=80'); background-size: cover; background-position: center;"></div>
            <div class="page-banner-overlay"></div>
            <div class="page-banner-container">
                
                <!-- Badge Superior Requerido -->
                <div class="page-title-wrap">
                    <span class="course-badge-upcoming">
                        <i class="fas fa-clock"></i> PROGRAMA ESPECIALIZADO | GERENCIA Y CONTROL TÉCNICO
                    </span>
                    <h1 class="page-main-title animate__animated animate__fadeInDown">GERENCIA DE LA CALIDAD PARA LA INFRAESTRUCTURA Y CONSTRUCCIÓN</h1>
                    <div class="title-underline"></div>
                </div>

                <!-- Subtítulo Requerido -->
                <div class="intro-card">
                    <p class="intro-text animate__animated animate__fadeInUp animate__delay-1s">
                        Aprende una visión integrada y práctica aplicando ISO 9001, Project Management y herramientas de gestión de calidad en obras.
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
                            <p class="hero-feature-desc animate__animated animate__fadeInUp animate__delay-1s">Clases grabadas 100% online con acceso disponible 24/7.</p>
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
                            <h3 class="hero-feature-title animate__animated animate__fadeInUp animate__delay-1s">Acreditación Profesional</h3>
                            <p class="hero-feature-desc animate__animated animate__fadeInUp animate__delay-1s">Incluye Diploma de Acreditación + Ingreso a Bolsa de Trabajo + Descuentos de Ex-alumno.</p>
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
                            <span class="sub-badge"><i class="fa-solid fa-user-graduate"></i> Liderazgo &amp; Excelencia Técnica</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">DOCENTE DEL PROGRAMA</h2>
                            <div class="heading-line"></div>
                        </div>

                        <!-- Tarjeta Técnica del Docente -->
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

                                <!-- Bio / Logros Requeridos -->
                                <p class="docente-profile">
                                    Profesional con más de 20 años de experiencia en Gestión de la Calidad en el Sector Construcción en empresas líderes del Perú y el extranjero.
                                </p>
                                <p class="docente-profile" style="margin-bottom: 0;">
                                    Docente de postgrado en las principales universidades del país y ponente en prestigiosos congresos.
                                </p>

                                <div class="docente-recognition-card">
                                    <i class="fa-solid fa-star text-gold"></i>
                                    <div class="docente-recognition-text">
                                        Auditor Líder IRCA ISO 9001, Six Sigma Black Belt y Contribuidor Registrado de los Estándares Globales del Project Management Institute (PMI®).
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Columna Derecha: Objetivo General + Imagen de Calidad e Infraestructura -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge"><i class="fa-solid fa-bullseye"></i> Control &amp; Aseguramiento de Calidad</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">OBJETIVO DEL CURSO</h2>
                            <div class="heading-line"></div>
                        </div>

                        <!-- Párrafo Explicativo Requerido -->
                        <p class="paragraph-text paragraph-lead">
                            Capacitar a los participantes en la visión integrada y práctica de la gestión de la calidad, mediante el uso de conceptos avanzados, herramientas de gestión, la aplicación de la norma ISO 9001 y las mejores prácticas del Project Management en proyectos de infraestructura.
                        </p>

                        <!-- Contenedor para Imagen de Gerencia de Calidad -->
                        <div class="course-img-preview-box" style="margin-top: 1.25rem; border-radius: 12px; overflow: hidden; box-shadow: var(--shadow-md); border: 1px solid var(--border-color);">
                            <!-- Imagen conceptual sobre gerencia de calidad e inspección en obra -->
                            <picture>
                                <source srcset="img/GERCA1.webp" type="image/webp">
                                <img src="img/GERCA1.png" alt="Inspección y gerencia de calidad en infraestructura de construcción" class="course-img-preview" loading="lazy" style="width: 100%; height: 260px; object-fit: cover; display: block;">
                            </picture>
                        </div>

                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             3. CONTENIDOS DEL CURSO (Grid Modular de 9 Ejes Temáticos)
             ========================================================================== -->
        <section class="content-section bg-alternate" id="estructura-curricular">
            <div class="section-container">
                
                <div class="section-header-center">
                    <span class="sub-badge"><i class="fa-solid fa-layer-group"></i> Malla Curricular Integral</span>
                    <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">ESTRUCTURA CURRICULAR Y HERRAMIENTAS PRÁCTICAS</h2>
                    <div class="heading-line center-line"></div>
                    <p class="section-subtitle-text">
                        Programa completo de 9 ejes estructurado para dominar desde los fundamentos normativos ISO 9001 hasta el control operativo, costos y recepción final de obra.
                    </p>
                </div>

                <!-- Grid Modular de 9 Tarjetas Interactivas -->
                <div class="temario-grid">
                    
                    <!-- Eje 1 -->
                    <div class="temario-card">
                        <div class="temario-card-header">
                            <span class="temario-number-badge">MÓDULO 01</span>
                            <div class="temario-icon"><i class="fa-solid fa-certificate"></i></div>
                        </div>
                        <h3 class="temario-title animate__animated animate__fadeInUp animate__delay-1s">1. Introducción a la Gerencia de Calidad</h3>
                        <p class="temario-desc">
                            Principios fundamentales y contexto del sector construcción. Evolución del aseguramiento y control de calidad (QA/QC) en obras de infraestructura.
                        </p>
                    </div>

                    <!-- Eje 2 -->
                    <div class="temario-card">
                        <div class="temario-card-header">
                            <span class="temario-number-badge">MÓDULO 02</span>
                            <div class="temario-icon"><i class="fa-solid fa-building"></i></div>
                        </div>
                        <h3 class="temario-title animate__animated animate__fadeInUp animate__delay-1s">2. Tipos de Proyectos</h3>
                        <p class="temario-desc">
                            Enfoques diferenciados para obras civiles, edificaciones e infraestructura vial, minera e industrial según sus especificaciones técnicas y tolerancias.
                        </p>
                    </div>

                    <!-- Eje 3 -->
                    <div class="temario-card">
                        <div class="temario-card-header">
                            <span class="temario-number-badge">MÓDULO 03</span>
                            <div class="temario-icon"><i class="fa-solid fa-arrows-split-up-and-left"></i></div>
                        </div>
                        <h3 class="temario-title animate__animated animate__fadeInUp animate__delay-1s">3. Planificación Integrada</h3>
                        <p class="temario-desc">
                            Alineación estratégica de calidad, alcance, costo, plazo y seguridad. Estructuración del Plan de Gestión de la Calidad (PGC) y Planes de Puntos de Inspección (PPI).
                        </p>
                    </div>

                    <!-- Eje 4 -->
                    <div class="temario-card">
                        <div class="temario-card-header">
                            <span class="temario-number-badge">MÓDULO 04</span>
                            <div class="temario-icon"><i class="fa-solid fa-toolbox"></i></div>
                        </div>
                        <h3 class="temario-title animate__animated animate__fadeInUp animate__delay-1s">4. Herramientas de Gestión de la Calidad</h3>
                        <p class="temario-desc">
                            Metodologías de control operativo y de gabinete: diagramas causa-efecto, Pareto, hojas de verificación, control estadístico y auditorías de procesos.
                        </p>
                    </div>

                    <!-- Eje 5 -->
                    <div class="temario-card">
                        <div class="temario-card-header">
                            <span class="temario-number-badge">MÓDULO 05</span>
                            <div class="temario-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
                        </div>
                        <h3 class="temario-title animate__animated animate__fadeInUp animate__delay-1s">5. Gestión de No Conformidades</h3>
                        <p class="temario-desc">
                            Identificación temprana, registro, análisis de causa raíz y tratamiento de No Conformidades. Formulación de acciones correctivas y preventivas eficaces.
                        </p>
                    </div>

                    <!-- Eje 6 -->
                    <div class="temario-card">
                        <div class="temario-card-header">
                            <span class="temario-number-badge">MÓDULO 06</span>
                            <div class="temario-icon"><i class="fa-solid fa-scale-balanced"></i></div>
                        </div>
                        <h3 class="temario-title animate__animated animate__fadeInUp animate__delay-1s">6. Costos de la Calidad</h3>
                        <p class="temario-desc">
                            Cuantificación del costo de conformidad (prevención y evaluación) vs. costo de no conformidad (fallas internas, retrabajos y fallas externas).
                        </p>
                    </div>

                    <!-- Eje 7 -->
                    <div class="temario-card">
                        <div class="temario-card-header">
                            <span class="temario-number-badge">MÓDULO 07</span>
                            <div class="temario-icon"><i class="fa-solid fa-chart-line"></i></div>
                        </div>
                        <h3 class="temario-title animate__animated animate__fadeInUp animate__delay-1s">7. Gestión de Indicadores de Calidad</h3>
                        <p class="temario-desc">
                            Diseño de KPIs específicos para obra y tableros de control (Dashboards) para el monitoreo del desempeño técnico y la satisfacción del cliente.
                        </p>
                    </div>

                    <!-- Eje 8 -->
                    <div class="temario-card">
                        <div class="temario-card-header">
                            <span class="temario-number-badge">MÓDULO 08</span>
                            <div class="temario-icon"><i class="fa-solid fa-clipboard-check"></i></div>
                        </div>
                        <h3 class="temario-title animate__animated animate__fadeInUp animate__delay-1s">8. Liberación y Entrega de Obra</h3>
                        <p class="temario-desc">
                            Protocolos de liberación de frentes, punch lists, dossier de calidad, recepción formal de obra y liquidación técnica final sin observaciones.
                        </p>
                    </div>

                    <!-- Eje 9 -->
                    <div class="temario-card">
                        <div class="temario-card-header">
                            <span class="temario-number-badge">MÓDULO 09</span>
                            <div class="temario-icon"><i class="fa-solid fa-shield-halved"></i></div>
                        </div>
                        <h3 class="temario-title animate__animated animate__fadeInUp animate__delay-1s">9. Riesgos de la Calidad</h3>
                        <p class="temario-desc">
                            Herramientas para la mitigación preventiva de fallas en obra: Matriz AMFE/FMEA aplicada a la construcción y planes de contingencia técnica.
                        </p>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             4. SECCIÓN MULTIMEDIA (2 Videos Promocionales de YouTube)
             ========================================================================== -->
        <section class="content-section" id="conferencias-calidad">
            <div class="section-container">
                
                <div class="section-header-center">
                    <span class="sub-badge"><i class="fa-brands fa-youtube"></i> Masterclasses &amp; Sesiones Técnicas</span>
                    <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">CONFERENCIAS Y PRESENTACIONES DEL PROGRAMA</h2>
                    <div class="heading-line center-line"></div>
                    <p class="section-subtitle-text">
                        Conferencias magistrales impartidas por el Ing. Omar Samaniego sobre la gerencia estratégica de la calidad e inspección técnica en obra.
                    </p>
                </div>

                <!-- Grid Responsive de 2 Columnas para Videos -->
                <div class="videos-promo-grid">
                    
                    <!-- Video 1 -->
                    <div class="video-card-wrapper">
                        <div class="video-header-bar">
                            <span><i class="fa-brands fa-youtube text-danger" style="color: #ef4444; margin-right: 0.35rem;"></i> Gerencia de Calidad en Obra - Parte 1</span>
                            <span class="video-live-pill">
                                <span class="video-live-dot"></span> HD 1080p
                            </span>
                        </div>
                        <div class="video-responsive-container">
                            <iframe src="https://www.youtube.com/embed/GIupuAHeqBQ" title="Gerencia de la Calidad para la Infraestructura y Construcción - Video 1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                        <div class="video-caption-box">
                            <p>
                                <i class="fa-solid fa-circle-play text-gold" style="color: var(--accent-gold); margin-right: 0.35rem;"></i> <strong>Fundamentos de Calidad &amp; ISO 9001:</strong> Enfoque integral de procesos y aseguramiento técnico en proyectos de infraestructura.
                            </p>
                        </div>
                    </div>

                    <!-- Video 2 -->
                    <div class="video-card-wrapper">
                        <div class="video-header-bar">
                            <span><i class="fa-brands fa-youtube text-danger" style="color: #ef4444; margin-right: 0.35rem;"></i> Gerencia de Calidad en Obra - Parte 2</span>
                            <span class="video-live-pill">
                                <span class="video-live-dot"></span> HD 1080p
                            </span>
                        </div>
                        <div class="video-responsive-container">
                            <iframe src="https://www.youtube.com/embed/gr0wmPU2_-Y" title="Gerencia de la Calidad para la Infraestructura y Construcción - Video 2" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                        <div class="video-caption-box">
                            <p>
                                <i class="fa-solid fa-circle-play text-gold" style="color: var(--accent-gold); margin-right: 0.35rem;"></i> <strong>Control Operativo &amp; Entrega de Obra:</strong> Gestión de no conformidades, dossier técnico y cierre formal de proyectos.
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
                        <i class="fa-solid fa-bolt"></i> FORMACIÓN APLICADA • CLASES GRABADAS
                    </span>

                    <h2 class="enroll-title animate__animated animate__fadeInUp animate__delay-1s">MATRICÚLATE EN EL CURSO DE GERENCIA DE CALIDAD</h2>
                    <p class="enroll-subtitle">
                        Elige tu canal preferido para solicitar atención personalizada, descargar la ficha técnica completa o realizar tu inscripción online al instante.
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
                            <span>Acceso a Grabaciones HD 24/7 sin Restricciones</span>
                        </div>

                        <div class="enroll-perk-item">
                            <div class="enroll-perk-icon">
                                <i class="fa-solid fa-certificate"></i>
                            </div>
                            <span>Diploma de Acreditación Oficial</span>
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
                        <a href="https://api.whatsapp.com/send?phone=51993463118&amp;text=w_%20%20%20%20%20%20Buen%20d%C3%ADa,%20%C2%BFpodr%C3%ADan%20enviarme%20informaci%C3%B3n%20sobre%20el%20curso%20de%20Gerencia%20de%20la%20Calidad%20para%20la%20Infraestructura?" target="_blank" rel="noopener noreferrer" class="btn-whatsapp payment-action-btn animate__animated animate__pulse animate__infinite" aria-label="Consultar información del curso de Gerencia de Calidad por WhatsApp">
                            <i class="fab fa-whatsapp"></i> Consultar por WhatsApp
                        </a>

                        <!-- 2. Botón Brochure / Ficha Técnica -->
                        <a href="https://docs.google.com/forms/d/e/1FAIpQLScjKEx-7RxLS_Z9FitKjwk57cRcKnebL_NS86NriCJS3hw4XQ/viewform" target="_blank" rel="noopener noreferrer" class="btn-outline payment-action-btn" aria-label="Descargar información y brochure del curso">
                            <i class="fas fa-file-pdf"></i> Info &amp; Brochure
                        </a>

                        <!-- 3. Botón Niubiz / VisaNet -->
                        <a href="https://www.visanetlink.pe/pagoseguro/QUALITYCONSULTINGSOLUTIONS/177481" target="_blank" rel="noopener noreferrer" class="btn-visanet payment-action-btn" aria-label="Pago Seguro con Niubiz y Visa">
                            <i class="fas fa-credit-card"></i> Pago Seguro Niubiz/Visa
                        </a>

                        <!-- 4. Botón PayPal Internacional -->
                        <a href="https://www.paypal.com/paypalme/qualityconsulting/225" target="_blank" rel="noopener noreferrer" class="btn-paypal payment-action-btn" aria-label="Pagar mediante PayPal">
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
                        <span class="cta-tag"><i class="fa-solid fa-certificate"></i> Capacitación y Asesoría en Calidad</span>
                        <h3 class="animate__animated animate__fadeInUp animate__delay-1s">Eleva el estándar técnico y la gestión de calidad en tus obras</h3>
                        <p>
                            Programas de capacitación aplicada 'In-House' y asesoría técnica especializada para orientar la gestión de calidad a la medida de tu organización y proyectos.
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
                        <a href="https://api.whatsapp.com/send?phone=51993463118&amp;text=w_%20%20%20%20%20%20Buen%20d%C3%ADa,%20%C2%BFpodr%C3%ADan%20enviarme%20informaci%C3%B3n%20sobre%20el%20curso%20de%20Gerencia%20de%20la%20Calidad%20para%20la%20Infraestructura?" target="_blank" rel="noopener noreferrer" class="btn btn-large btn-qcs-dark">
                            <i class="fa-brands fa-whatsapp"></i> Chat WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>
