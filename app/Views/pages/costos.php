<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de P?gina: Estrategias y Conceptos de Costos en Edificaciones
 * Archivo: app/Views/pages/costos.php
 */

declare(strict_types=1);
?>
<main class="page-content">

        <!-- ==========================================================================
             1. SECCIÓN HERO / ENCABEZADO DEL CURSO (Hero Azul Corporativo)
             ========================================================================== -->
        <section class="page-banner banner-costos">
            <div class="page-banner-bg banner-costos-bg"></div>
            <div class="page-banner-overlay"></div>
            <div class="page-banner-container">
                
                <!-- Badge Superior Requerido -->
                <div class="page-title-wrap">
                    <span class="course-badge">
                        <i class="fas fa-calculator"></i> CONTROL ECONÓMICO Y FINANCIERO DE OBRAS
                    </span>
                    <h1 class="page-main-title animate__animated animate__fadeInDown">ESTRATEGIAS Y CONCEPTOS DE COSTOS EN EDIFICACIONES</h1>
                    <div class="title-underline"></div>
                </div>

                <!-- Subtítulo Requerido -->
                <div class="intro-card">
                    <p class="intro-text animate__animated animate__fadeInUp animate__delay-1s">
                        Aprende a planificar, controlar y optimizar los costos previstos, reales y proyectados en obras públicas y privadas.
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
             2. PERFIL DE LA DOCENTE Y OBJETIVO DEL CURSO (Layout 2 Columnas)
             ========================================================================== -->
        <section class="content-section" id="perfil-objetivo">
            <div class="section-container">
                
                <div class="grid-split-layout">
                    
                    <!-- Columna Izquierda: Perfil Docente Destacado -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge"><i class="fa-solid fa-user-graduate"></i> Experiencia en Control Financiero</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">DOCENTE DEL PROGRAMA</h2>
                            <div class="heading-line"></div>
                        </div>

                        <!-- Tarjeta Técnica de la Docente -->
                        <div class="docente-card docente-pmi-highlight" style="margin-top: 1.25rem;">
                            <div class="docente-avatar-box">
                                <div class="docente-avatar">
                                    <i class="fa-solid fa-user-tie"></i>
                                </div>
                                <span class="docente-verified-badge" title="Docente Principal Colegiada y Certificada">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                            </div>
                            <div class="docente-info">
                                <span class="docente-tag">Docente Principal</span>
                                <h3 class="docente-name animate__animated animate__fadeInUp animate__delay-1s">ING. ANA ROMANÍ</h3>
                                
                                <!-- Credenciales / Badges Requeridos -->
                                <div class="docente-credentials-row">
                                    <span class="credential-badge"><i class="fa-solid fa-id-card"></i> Ingeniera Civil (UNI)</span>
                                    <span class="credential-badge"><i class="fa-solid fa-graduation-cap"></i> MBA</span>
                                    <span class="credential-badge"><i class="fa-solid fa-certificate"></i> Posgrado Gerencia de Construcción</span>
                                </div>

                                <!-- Bio / Logros Destacados Requeridos -->
                                <p class="docente-profile">
                                    Magíster en Administración de Empresas, colegiada y titulada en Ingeniería Civil de la Universidad Nacional de Ingeniería (UNI).
                                </p>
                                
                                <div class="docente-recognition-card">
                                    <i class="fa-solid fa-building text-gold"></i>
                                    <div class="docente-recognition-text">
                                        Más de 13 años de experiencia en obras para el sector público y privado: edificaciones, plantas industriales, minería e infraestructura.
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Columna Derecha: Objetivo General + Imagen de Ingeniería -->
                    <div class="split-text-col">
                        <div class="section-header-compact">
                            <span class="sub-badge"><i class="fa-solid fa-bullseye"></i> Control &amp; Previsión Económica</span>
                            <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">OBJETIVO DEL CURSO</h2>
                            <div class="heading-line"></div>
                        </div>

                        <!-- Párrafo Explicativo Requerido -->
                        <p class="paragraph-text paragraph-lead">
                            Brindar a los participantes los conceptos fundamentales de costos y las herramientas aplicables para el control continuo en obra, identificando y gestionando la brecha entre el costo previsto, el costo real y el proyectado.
                        </p>

                        <!-- Contenedor para Imagen de Control de Costos -->
                        <!-- Imagen conceptual sobre costos y valorizaciones -->
                        <div class="course-img-preview-box">
                            <picture>
                                <source srcset="img/costo1.webp" type="image/webp">
                                <img src="img/costo1.png" alt="Control financiero, presupuestos y presupuestación en MS Excel y S10" class="course-img-preview" loading="lazy">
                            </picture>
                        </div>

                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             3. CONTENIDOS DEL CURSO (Grid Modular de 3 Ejes Prácticos)
             ========================================================================== -->
        <section class="content-section bg-alternate" id="estructura-curricular">
            <div class="section-container">
                
                <div class="section-header-center">
                    <span class="sub-badge"><i class="fa-solid fa-coins"></i> Metodología y Aplicabilidad</span>
                    <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">ESTRUCTURA CURRICULAR Y APLICACIÓN PRÁCTICA</h2>
                    <div class="heading-line center-line"></div>
                    <p class="section-subtitle-text">
                        Herramientas analíticas y dinámicas prácticas para asegurar la rentabilidad, conciliación presupuestal y control operativo de la obra.
                    </p>
                </div>

                <div class="costos-grid-3">
                    
                    <!-- Módulo 1 -->
                    <div class="costos-module-card">
                        <div class="pmbok-card-header">
                            <span class="pmbok-step-badge">MÓDULO 01</span>
                            <div class="pmbok-icon"><i class="fa-solid fa-chart-line"></i></div>
                        </div>
                        <h4 class="pmbok-card-title">Planificación y Control de Costos de Edificación</h4>
                        <p class="pmbok-card-desc">
                            Metodologías para la estructuración y seguimiento de los costos de obra en gabinete y campo.
                        </p>
                        <ul class="costos-module-list">
                            <li><i class="fa-solid fa-check-circle"></i> Plan de Fases de control (ejemplos prácticos en MS Excel y S10).</li>
                            <li><i class="fa-solid fa-check-circle"></i> Fundamentos de Valor Ganado (EVM) aplicado a obras.</li>
                            <li><i class="fa-solid fa-check-circle"></i> Informe Semanal de Producción (ISP) y Resultado Operativo de Obra.</li>
                            <li><i class="fa-solid fa-check-circle"></i> Conversión del presupuesto contractual al Resultado Operativo y Presupuesto Meta.</li>
                            <li><i class="fa-solid fa-check-circle"></i> Análisis de causas del resultado pendiente y conciliación con contabilidad.</li>
                        </ul>
                    </div>

                    <!-- Módulo 2 -->
                    <div class="costos-module-card">
                        <div class="pmbok-card-header">
                            <span class="pmbok-step-badge">MÓDULO 02</span>
                            <div class="pmbok-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                        </div>
                        <h4 class="pmbok-card-title">Gestión de los Costos de los Recursos</h4>
                        <p class="pmbok-card-desc">
                            Control detallado de insumos y estructuración financiera de las valorizaciones periódicas.
                        </p>
                        <ul class="costos-module-list">
                            <li><i class="fa-solid fa-check-circle"></i> Control de Mano de Obra, Materiales y Equipos.</li>
                            <li><i class="fa-solid fa-check-circle"></i> Elaboración de Valorizaciones de Obra y gestión de la planificación.</li>
                            <li><i class="fa-solid fa-check-circle"></i> Rendimientos y ratios de productividad de recursos en campo.</li>
                            <li><i class="fa-solid fa-check-circle"></i> Conciliación de almacenes y consumos reales vs. teóricos.</li>
                        </ul>
                    </div>

                    <!-- Módulo 3 -->
                    <div class="costos-module-card">
                        <div class="pmbok-card-header">
                            <span class="pmbok-step-badge">MÓDULO 03</span>
                            <div class="pmbok-icon"><i class="fa-solid fa-calculator"></i></div>
                        </div>
                        <h4 class="pmbok-card-title">Ejemplos de Aplicación Real</h4>
                        <p class="pmbok-card-desc">
                            Casos de estudio y evaluación del impacto de desvíos en el balance financiero del proyecto.
                        </p>
                        <ul class="costos-module-list">
                            <li><i class="fa-solid fa-check-circle"></i> Análisis de la variación de los recursos en el resultado económico final de la obra.</li>
                            <li><i class="fa-solid fa-check-circle"></i> Modelos dinámicos de proyección de costos a término (EAC / ETC).</li>
                            <li><i class="fa-solid fa-check-circle"></i> Plan de contingencias y toma de decisiones correctivas oportunas.</li>
                        </ul>
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
                    <h2 class="section-heading animate__animated animate__fadeInUp animate__delay-1s">CONFERENCIAS Y PRESENTACIONES SOBRE COSTOS</h2>
                    <div class="heading-line center-line"></div>
                    <p class="section-subtitle-text">
                        Aprende de especialistas en presupuestación, resultado operativo y control financiero de proyectos inmobiliarios y de infraestructura.
                    </p>
                </div>

                <!-- Grid Responsive de 2 Columnas para Videos -->
                <div class="videos-promo-grid">
                    
                    <!-- Video 1 -->
                    <div class="video-card-wrapper">
                        <div class="video-header-bar">
                            <span><i class="fa-brands fa-youtube text-danger"></i> Control de Costos en Obra - Parte 1</span>
                            <span class="video-live-pill">
                                <span class="video-live-dot"></span> HD 1080p
                            </span>
                        </div>
                        <div class="video-responsive-container">
                            <iframe src="https://www.youtube.com/embed/daZya3OZ21M" title="Estrategias y Conceptos de Costos en Edificaciones - Video 1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                        <div class="video-caption-box">
                            <p>
                                <i class="fa-solid fa-play-circle text-gold"></i> <strong>Planificación &amp; Presupuesto Meta:</strong> Estructuración de fases de control y herramientas de seguimiento.
                            </p>
                        </div>
                    </div>

                    <!-- Video 2 -->
                    <div class="video-card-wrapper">
                        <div class="video-header-bar">
                            <span><i class="fa-brands fa-youtube text-danger"></i> Control de Costos en Obra - Parte 2</span>
                            <span class="video-live-pill">
                                <span class="video-live-dot"></span> HD 1080p
                            </span>
                        </div>
                        <div class="video-responsive-container">
                            <iframe src="https://www.youtube.com/embed/EWdbxbrpLx4" title="Estrategias y Conceptos de Costos en Edificaciones - Video 2" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                        <div class="video-caption-box">
                            <p>
                                <i class="fa-solid fa-play-circle text-gold"></i> <strong>Resultado Operativo &amp; Conciliación:</strong> Análisis de desviaciones en mano de obra, materiales y equipos.
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
                        <i class="fa-solid fa-bolt"></i> CURSO ESPECIALIZADO • MODALIDAD ONLINE
                    </span>

                    <h2 class="enroll-title animate__animated animate__fadeInUp animate__delay-1s">ASEGURA TU VACANTE EN EL PROGRAMA DE COSTOS</h2>
                    <p class="enroll-subtitle">
                        Domina la formulación del Resultado Operativo, evita sobrecostos imprevistos y lidera el control económico de tus proyectos.
                    </p>

                    <!-- Beneficios de la Matrícula -->
                    <div class="enroll-perks-grid">
                        <div class="enroll-perk-item">
                            <div class="enroll-perk-icon">
                                <i class="fa-solid fa-chalkboard-user"></i>
                            </div>
                            <span>Docente UNI &amp; MBA con +13 años de experiencia</span>
                        </div>

                        <div class="enroll-perk-item">
                            <div class="enroll-perk-icon">
                                <i class="fa-solid fa-file-excel"></i>
                            </div>
                            <span>Plantillas y Formatos Editables en MS Excel y S10</span>
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
                        
                        <!-- 1. Botón WhatsApp (Consultas e Información) -->
                        <a href="https://api.whatsapp.com/send?phone=51993463118&amp;text=w_%20%20%20%20%20%20Buen%20d%C3%ADa,%20%C2%BFpodr%C3%ADan%20enviarme%20informaci%C3%B3n%20sobre%20el%20curso%20de%20Estrategias%20y%20Conceptos%20de%20Costos%20en%20Edificaciones?" target="_blank" rel="noopener noreferrer" class="btn-whatsapp payment-action-btn animate__animated animate__pulse animate__infinite" aria-label="Consultar información del curso de Costos en Edificaciones por WhatsApp">
                            <i class="fab fa-whatsapp"></i> Consultar por WhatsApp
                        </a>

                        <!-- 2. Botón Brochure / Ficha Técnica (Google Forms) -->
                        <a href="https://docs.google.com/forms/d/e/1FAIpQLSfxo-0CnM2ZtrBQw86hzMzc77KFt5pNQIkgEPZgy0AUdlZoHA/viewform" target="_blank" rel="noopener noreferrer" class="btn-outline payment-action-btn" aria-label="Solicitar información y brochure del curso de Costos en Google Forms">
                            <i class="fas fa-file-pdf"></i> Info &amp; Brochure
                        </a>

                        <!-- 3. Botón Pago Seguro VisaNet (Niubiz) -->
                        <a href="https://www.visanetlink.pe/pagoseguro/QUALITYCONSULTINGSOLUTIONS/177481" target="_blank" rel="noopener noreferrer" class="btn-visanet payment-action-btn" aria-label="Realizar pago seguro con Niubiz/VisaNet">
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
             6. LLAMADO A LA ACCIÓN FINAL (Contacto Corporativo)
             ========================================================================== -->
        <section class="cta-banner-section" id="contacto-final">
            <div class="cta-container">
                <div class="cta-box">
                    <div class="cta-content">
                        <span class="cta-tag"><i class="fa-solid fa-calculator"></i> Gestión Económica Eficiente</span>
                        <h3 class="animate__animated animate__fadeInUp animate__delay-1s">Inscríbete y toma el control económico de tus obras</h3>
                        <p>
                            Contáctanos hoy mismo para asegurar tu vacante preferencial, coordinar programas corporativos in-house para tu equipo o solicitar asesoría técnica.
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
                        <a href="https://api.whatsapp.com/send?phone=51993463118&amp;text=w_%20%20%20%20%20%20Buen%20d%C3%ADa,%20%C2%BFpodr%C3%ADan%20enviarme%20informaci%C3%B3n%20sobre%20el%20curso%20de%20Estrategias%20y%20Conceptos%20de%20Costos%20en%20Edificaciones?" target="_blank" rel="noopener noreferrer" class="btn btn-large btn-qcs-dark">
                            <i class="fa-brands fa-whatsapp"></i> Chat WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>
