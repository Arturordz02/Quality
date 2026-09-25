<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Contacto y Atención Corporativa
 * Archivo: app/Views/pages/contacto.php
 */

declare(strict_types=1);
?>
    <style>
        body {
            background-color: var(--qcs-bg-light);
            color: #1e293b;
        }

        /* ----------------------------------------------------
           1. HERO SECTION (Executive Helpdesk Style)
           ---------------------------------------------------- */
        .contact-hero-banner {
            position: relative;
            padding: 190px 1.5rem 85px 1.5rem;
            background: linear-gradient(145deg, #0F1113 0%, #1A1D20 50%, #24292E 100%);
            color: #ffffff;
            overflow: hidden;
            border-bottom: 4px solid var(--accent-gold);
        }

        .contact-hero-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 85% 25%, rgba(229, 168, 19, 0.22) 0%, transparent 60%),
                        radial-gradient(circle at 15% 80%, rgba(142, 146, 151, 0.15) 0%, transparent 60%);
            pointer-events: none;
        }

        .contact-hero-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1px, transparent 1px);
            background-size: 28px 28px;
            opacity: 0.6;
            pointer-events: none;
        }

        .contact-hero-title {
            font-family: var(--font-heading);
            font-weight: 800;
            font-size: clamp(2.2rem, 4.5vw, 3.4rem);
            letter-spacing: -0.5px;
            color: #ffffff;
            margin-bottom: 1rem;
            text-shadow: 0 4px 16px rgba(0, 0, 0, 0.35);
        }

        .contact-hero-subtitle {
            font-family: var(--font-body);
            font-size: clamp(1.05rem, 1.8vw, 1.25rem);
            color: #e2e8f0;
            max-width: 820px;
            margin: 0 auto 2.5rem auto;
            line-height: 1.7;
        }

        /* Hero Quick Channels Grid */
        .hero-channel-card {
            background: rgba(255, 255, 255, 0.07);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.16);
            border-radius: 18px;
            padding: 1.5rem 1.25rem;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
        }

        .hero-channel-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.14);
            border-color: var(--accent-gold);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
        }

        .hero-channel-icon {
            width: 52px;
            height: 52px;
            margin: 0 auto 1rem auto;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
        }

        .hero-channel-name {
            font-family: var(--font-heading);
            font-size: 0.95rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0.35rem;
        }

        .hero-channel-desc {
            font-size: 0.84rem;
            color: #cbd5e1;
            margin-bottom: 0.6rem;
        }

        /* ----------------------------------------------------
           2. FORMULARIO & TARJETA DE SOPORTE (Layout 2 Col)
           ---------------------------------------------------- */
        .contact-form-card {
            border: 1px solid #e2e8f0;
            transition: box-shadow 0.3s ease;
        }

        .contact-form-card:hover {
            box-shadow: 0 20px 45px rgba(15, 17, 19, 0.2) !important;
        }

        .contact-form-title {
            font-family: var(--font-heading);
            font-weight: 800;
            font-size: 1.65rem;
            color: var(--qcs-dark-slate);
            letter-spacing: -0.3px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--qcs-yellow);
            box-shadow: 0 0 0 0.25rem rgba(15, 17, 19, 0.2);
        }

        .input-group-text {
            border-color: #dee2e6;
        }

        /* Tarjeta de Soporte y WhatsApp */
        .support-info-card {
            background: linear-gradient(145deg, #0F1113 0%, #1A1D20 60%, #1A1D20 100%);
            border: 1px solid rgba(255, 255, 255, 0.12);
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .support-info-card::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -30%;
            width: 280px;
            height: 280px;
            background: radial-gradient(circle, rgba(34, 197, 94, 0.15) 0%, transparent 70%);
            pointer-events: none;
        }

        .schedule-box {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 14px;
            padding: 1.25rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            margin: 1.5rem 0;
        }

        .schedule-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
            padding: 0.4rem 0;
            border-bottom: 1px dashed rgba(255, 255, 255, 0.12);
        }

        .schedule-row:last-child {
            border-bottom: none;
        }

        .social-pill-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            font-size: 1.15rem;
            transition: all var(--transition-fast);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .social-pill-btn.linkedin:hover { background: #0077b5; border-color: #0077b5; transform: translateY(-3px); }
        .social-pill-btn.facebook:hover { background: #1877f2; border-color: #1877f2; transform: translateY(-3px); }
        .social-pill-btn.youtube:hover { background: #ff0000; border-color: #ff0000; transform: translateY(-3px); }
        .social-pill-btn.whatsapp:hover { background: #25d366; border-color: #25d366; transform: translateY(-3px); }

        /* ----------------------------------------------------
           3. MAPA & CIERRE CORPORATIVO
           ---------------------------------------------------- */
        .map-section-wrapper {
            background: #ffffff;
            border-radius: 24px;
            border: 1px solid #e2e8f0;
            padding: 3rem 2.5rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.04);
        }

        .contact-cta-banner {
            background: linear-gradient(145deg, #0F1113 0%, #1A1D20 50%, #24292E 100%);
            border-radius: 24px;
            padding: 3.5rem 2.5rem;
            color: #ffffff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 45px rgba(15, 17, 19, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .contact-cta-banner::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(229, 168, 19, 0.2) 0%, transparent 70%);
            pointer-events: none;
        }
    </style>
    <main>
        <!-- ==========================================================================
             1. ENCABEZADO HERO (Executive Helpdesk Style)
             ========================================================================== -->
        <section class="contact-hero-banner text-center">
            <div class="contact-hero-pattern"></div>
            <div class="container position-relative">
                
                <!-- Badge Superior Neón -->
                <div class="d-inline-block mb-3">
                    <span class="badge bg-light text-dark px-3 py-2 rounded-pill fw-bold mb-2 shadow-sm">
                        <i class="fas fa-headset me-2"></i> ATENCIÓN Y COMUNICACIÓN DIRECTA
                    </span>
                </div>

                <!-- Título Principal -->
                <h1 class="contact-hero-title animate__animated animate__fadeInDown">QUEREMOS ESCUCHARTE</h1>

                <!-- Subtítulo -->
                <p class="contact-hero-subtitle">
                    Ponte en contacto con nuestro equipo de especialistas. Estamos listos para atender tus consultas sobre cursos, programas de capacitación in-house y asesoría técnica especializada.
                </p>

                <!-- Grid de 3 Tarjetas de Canales de Respuesta Rápida -->
                <div class="row g-4 justify-content-center text-start">
                    
                    <!-- Canal 1: Teléfono Directo & WhatsApp -->
                    <div class="col-lg-4 col-md-6">
                        <div class="hero-channel-card">
                            <div class="hero-channel-icon text-success">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <h3 class="hero-channel-name animate__animated animate__fadeInUp animate__delay-1s">Teléfono Directo &amp; WhatsApp</h3>
                            <p class="hero-channel-desc">Llamadas e interacción inmediata</p>
                            <a href="tel:+51993463118" class="text-white fw-bold d-inline-flex align-items-center gap-1">
                                <i class="fab fa-whatsapp text-success me-2"></i> +51 993 463 118
                            </a>
                        </div>
                    </div>

                    <!-- Canal 2: Correo Comercial -->
                    <div class="col-lg-4 col-md-6">
                        <div class="hero-channel-card">
                            <div class="hero-channel-icon text-warning">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <h3 class="hero-channel-name animate__animated animate__fadeInUp animate__delay-1s">Correo Comercial</h3>
                            <p class="hero-channel-desc">Solicitud de cotizaciones y propuestas</p>
                            <a href="mailto:contacto@quality-consulting.org" class="text-white fw-bold d-inline-flex align-items-center gap-1">
                                <i class="fas fa-envelope text-warning me-2"></i> contacto@quality-consulting.org
                            </a>
                        </div>
                    </div>

                    <!-- Canal 3: Atención Presencial -->
                    <div class="col-lg-4 col-md-6">
                        <div class="hero-channel-card">
                            <div class="hero-channel-icon text-warning">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <h3 class="hero-channel-name animate__animated animate__fadeInUp animate__delay-1s">Atención Presencial</h3>
                            <p class="hero-channel-desc">Sede Central y Oficinas</p>
                            <span class="text-white fw-bold d-inline-flex align-items-center gap-1" style="font-size: 0.92rem;">
                                <i class="fas fa-map-marker-alt text-warning me-2"></i> Av. Javier Prado 757, piso 10 Magdalena, Lima 17
                            </span>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ==========================================================================
             2. LAYOUT PRINCIPAL DE 2 COLUMNAS (Formulario + Card de Soporte)
             ========================================================================== -->
        <section class="py-5">
            <div class="container">
                <div class="row g-4 justify-content-center">
                    
                    <!-- Columna Izquierda: Formulario de Contacto Flotante -->
                    <div class="col-lg-7">
                        <div class="contact-form-card shadow-lg rounded-4 p-4 p-md-5 bg-white h-100">
                            
                            <div class="mb-4">
                                <span class="badge bg-warning-subtle text-dark fw-bold px-3 py-2 rounded-pill text-uppercase mb-2">
                                    <i class="fa-solid fa-paper-plane me-1"></i> Formulario de Contacto
                                </span>
                                <h2 class="contact-form-title animate__animated animate__fadeInUp animate__delay-1s">ENVÍANOS TU CONSULTA</h2>
                                <p class="text-muted small mb-0">
                                    Los campos marcados con (<span class="text-danger">*</span>) son obligatorios.
                                </p>
                            </div>

                            <!-- Contenedor para Alertas Dinámicas de Éxito / Error -->
                            <div id="contactFormAlert" class="mb-3" style="display: none;"></div>

                            <form id="contactForm" action="/backend/send-contact.php" method="POST" novalidate>
                                
                                <!-- Campo Trampa Anti-Spam (Honeypot) - Invisible para usuarios -->
                                <div style="display:none !important; visibility:hidden !important; position:absolute; left:-9999px;" aria-hidden="true">
                                    <label for="_qcs_verification_hp">No complete este campo si es humano</label>
                                    <input type="text" id="_qcs_verification_hp" name="_qcs_verification_hp" tabindex="-1" autocomplete="off">
                                </div>

                                <!-- Nombre y Apellido -->
                                <div class="mb-3">
                                    <label for="contactNombre" class="form-label fw-bold small text-secondary">Nombre y Apellido <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                                        <input type="text" id="contactNombre" name="nombre" class="form-control border-start-0 ps-0" placeholder="Ej. Juan Pérez" required autocomplete="name">
                                    </div>
                                </div>

                                <!-- Teléfono / WhatsApp -->
                                <div class="mb-3">
                                    <label for="contactTelefono" class="form-label fw-bold small text-secondary">Teléfono / WhatsApp <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-phone text-muted"></i></span>
                                        <input type="tel" id="contactTelefono" name="telefono" class="form-control border-start-0 ps-0" placeholder="+51 999 999 999" required autocomplete="tel">
                                    </div>
                                </div>

                                <!-- Empresa / Organización -->
                                <div class="mb-3">
                                    <label for="contactEmpresa" class="form-label fw-bold small text-secondary">Empresa <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-building text-muted"></i></span>
                                        <input type="text" id="contactEmpresa" name="empresa" class="form-control border-start-0 ps-0" placeholder="Nombre de tu empresa o institución" required autocomplete="organization">
                                    </div>
                                </div>

                                <!-- Correo Electrónico -->
                                <div class="mb-3">
                                    <label for="contactEmail" class="form-label fw-bold small text-secondary">Correo electrónico <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                                        <input type="email" id="contactEmail" name="email" class="form-control border-start-0 ps-0" placeholder="ejemplo@empresa.com" required autocomplete="email">
                                    </div>
                                </div>

                                <!-- Consulta o Mensaje -->
                                <div class="mb-3">
                                    <label for="contactConsulta" class="form-label fw-bold small text-secondary">Consulta o Mensaje <span class="text-danger">*</span></label>
                                    <textarea id="contactConsulta" name="consulta" class="form-control" rows="4" placeholder="Escribe aquí los detalles de tu consulta sobre cursos, capacitaciones in-house o asesoría técnica..." required></textarea>
                                </div>

                                <!-- Botón de Envío -->
                                <div class="mt-4">
                                    <button type="submit" id="contactSubmitBtn" class="btn btn-lg w-100 py-3 fw-bold rounded-pill shadow btn-qcs-primary">
                                        <span class="btn-text"><i class="fas fa-paper-plane me-2"></i> ENVIAR CONSULTA</span>
                                        <span class="btn-loading d-none"><i class="fas fa-spinner fa-spin me-2"></i> ENVIANDO...</span>
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>

                    <!-- Columna Derecha: Tarjeta de Contacto Directo & Redes Oficiales -->
                    <div class="col-lg-5">
                        <div class="support-info-card text-white rounded-4 p-4 p-md-5 shadow-lg d-flex flex-direction-column flex-column justify-content-between">
                            
                            <div>
                                <span class="badge bg-success bg-opacity-25 text-success border border-success px-3 py-2 rounded-pill fw-bold mb-3">
                                    <i class="fa-solid fa-bolt me-1"></i> ATENCIÓN INMEDIATA
                                </span>
                                
                                <h3 class="fw-bold font-montserrat text-white mb-3 animate__animated animate__fadeInUp animate__delay-1s" style="font-size: 1.55rem;">
                                    ¿Prefieres una respuesta al instante?
                                </h3>
                                
                                <p class="text-light text-opacity-90 mb-4" style="line-height: 1.8;">
                                    Escríbenos directamente por WhatsApp para coordinar reuniones, cotizaciones o resolver tus dudas en tiempo real.
                                </p>

                                <!-- Botón WhatsApp Oficial -->
                                <a href="https://api.whatsapp.com/send?phone=51993463118&amp;text=Hola,%20deseo%20realizar%20una%20consulta%20desde%20la%20p%C3%A1gina%20de%20contacto" target="_blank" rel="noopener noreferrer" class="btn btn-success btn-lg w-100 py-3 my-3 fw-bold rounded-pill shadow">
                                    <i class="fab fa-whatsapp me-2 fs-4 align-middle"></i> Chatear por WhatsApp
                                </a>

                                <!-- Horario de Atención Corporativa -->
                                <div class="schedule-box">
                                    <h4 class="fw-bold font-montserrat text-white mb-2 fs-6">
                                        <i class="fa-regular fa-clock me-2 text-warning"></i> Horario de Atención Corporativa
                                    </h4>
                                    <div class="schedule-row">
                                        <span class="text-light text-opacity-75">Lunes a Viernes:</span>
                                        <span class="fw-bold text-white">8:00 am - 6:00 pm</span>
                                    </div>
                                    <div class="schedule-row">
                                        <span class="text-light text-opacity-75">Sábados:</span>
                                        <span class="fw-bold text-white">9:00 am - 1:00 pm</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Redes Sociales Oficiales -->
                            <div class="mt-4 pt-3 border-top border-white border-opacity-10">
                                <p class="small text-light text-opacity-75 fw-bold mb-3 text-uppercase" style="letter-spacing: 1px;">
                                    Conéctate con Nosotros
                                </p>
                                <div class="d-flex gap-3">
                                    <a href="https://pe.linkedin.com/in/omarsamaniego" target="_blank" rel="noopener noreferrer" class="social-pill-btn linkedin" aria-label="LinkedIn">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    <a href="https://www.facebook.com/qaqcconsulting" target="_blank" rel="noopener noreferrer" class="social-pill-btn facebook" aria-label="Facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="https://www.youtube.com/channel/UCbCdXwbcl-uouYa6Y4_kY0A?view_as=subscriber" target="_blank" rel="noopener noreferrer" class="social-pill-btn youtube" aria-label="YouTube">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                    <a href="https://wa.me/51993463118" target="_blank" rel="noopener noreferrer" class="social-pill-btn whatsapp animate__animated animate__pulse animate__infinite" aria-label="WhatsApp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- ==========================================================================
             3. MAPA GEOLOCALIZADO DE UBICACIÓN CENTRAL
             ========================================================================== -->
        <section class="pb-5">
            <div class="container">
                <div class="map-section-wrapper">
                    
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
                        <div>
                            <span class="badge bg-warning-subtle text-dark fw-bold px-3 py-2 rounded-pill text-uppercase mb-2">
                                <i class="fa-solid fa-location-dot me-1"></i> Presencia en Lima
                            </span>
                            <h2 class="fw-extrabold font-montserrat text-dark fs-3 mb-0 animate__animated animate__fadeInUp animate__delay-1s" style="font-weight: 800;">
                                NUESTRA UBICACIÓN
                            </h2>
                        </div>
                        <div class="text-muted small">
                            <i class="fa-solid fa-building me-1 text-dark"></i> Sede Central: Av. Javier Prado 757, piso 10, Magdalena del Mar, Lima 17
                        </div>
                    </div>

                    <!-- Contenedor Responsive Ratio 21x9 -->
                    <div class="ratio ratio-21x9 shadow-lg rounded-4 overflow-hidden my-4 border">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.353392348507!2d-77.0674558!3d-12.0911765!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c907b22a0149%3A0xb3634ca3364f3316!2sAv.%20Javier%20Prado%20Oeste%20757%2C%20Magdalena%20del%20Mar%2015076!5e0!3m2!1ses!2spe!4v1700000000000!5m2!1ses!2spe" title="Ubicación de Quality Consulting Solutions en Av. Javier Prado 757, piso 10 Magdalena, Lima 17" loading="lazy" allowfullscreen=""></iframe>
                    </div>

                </div>
            </div>
        </section>



        <!-- ==========================================================================
             4. CIERRE CORPORATIVO
             ========================================================================== -->
        <section class="pb-5">
            <div class="container">
                <div class="contact-cta-banner">
                    <div class="row align-items-center">
                        
                        <div class="col-lg-8 mb-4 mb-lg-0">
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3 shadow-sm">
                                <i class="fa-solid fa-layer-group me-1"></i> CAPACITACIÓN Y ASESORÍA
                            </span>
                            <h2 class="fw-bold font-montserrat text-white mb-3 animate__animated animate__fadeInUp animate__delay-1s" style="font-size: clamp(1.6rem, 2.5vw, 2.2rem);">
                                Conoce nuestras Soluciones en Formación y Asesoría Especializada
                            </h2>
                            <p class="text-light text-opacity-90 mb-0" style="font-size: 1.05rem; line-height: 1.8;">
                                Explora nuestro catálogo de formación técnica especializada o solicita asesoría especializada para orientar la gestión de PMO, directrices ISO 9001 y gestión de riesgos contractuales.
                            </p>
                        </div>

                        <div class="col-lg-4 text-lg-end text-center">
                            <div class="d-flex flex-column gap-3 justify-content-center">
                                <a href="/gestion-de-pmo" class="btn btn-warning btn-lg px-4 py-3 fw-bold rounded-pill shadow-lg btn-qcs-primary">
                                    <i class="fa-solid fa-chart-pie me-2"></i> Ver Asesoría Especializada
                                </a>
                                <a href="/lean-last-planner" class="btn btn-outline-light btn-lg px-4 py-3 fw-bold rounded-pill btn-qcs-primary">
                                    <i class="fa-solid fa-graduation-cap me-2"></i> Ver Cursos y Capacitación
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </main>
