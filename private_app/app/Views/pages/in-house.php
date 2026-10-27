<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Capacitaciones In-House (Formación Corporativa a Medida)
 * Archivo: app/Views/pages/in-house.php
 */

declare(strict_types=1);

// Catálogo ordenado de los 19 logos oficiales de clientes de Quality
$clientLogos = [
    ['file' => '01_cosapi.png',                   'name' => 'Cosapi Ingeniería y Construcción'],
    ['file' => '02_abengoa.png',                  'name' => 'Abengoa'],
    ['file' => '03_proyec.png',                   'name' => 'Proyec Inmobiliaria'],
    ['file' => '04_wood_group.png',               'name' => 'Wood Group'],
    ['file' => '05_kk_ingenieros.png',            'name' => 'KK Ingenieros SAC'],
    ['file' => '06_produktiva.png',               'name' => 'Produktiva'],
    ['file' => '07_hispe.png',                    'name' => 'Hispe Ingeniería Modular'],
    ['file' => '08_amec_foster_wheeler.png',      'name' => 'Amec Foster Wheeler'],
    ['file' => '09_iccgsa.png',                   'name' => 'ICCGSA'],
    ['file' => '10_constructora_inmobiliaria.png','name' => 'Constructora Inmobiliaria'],
    ['file' => '11_gti_ingenieria.png',           'name' => 'GTI Grupo Técnico en Ingeniería'],
    ['file' => '12_buenaventura.png',             'name' => 'Compañía de Minas Buenaventura'],
    ['file' => '13_metis_gaia.png',               'name' => 'Metis Gaia'],
    ['file' => '14_antamina.png',                 'name' => 'Compañía Minera Antamina'],
    ['file' => '15_ciudaris.png',                 'name' => 'Ciudaris Inmobiliaria'],
    ['file' => '16_crovisa.png',                  'name' => 'Crovisa'],
    ['file' => '17_jjc_grupo.png',                'name' => 'JJC Grupo'],
    ['file' => '18_esparq_ciesa.png',             'name' => 'Esparq - Ciesa EOM Grupo'],
    ['file' => '19_prosac.png',                   'name' => 'Prosac'],
];
?>

<main class="inhouse-page">

    <!-- ==========================================================================
         1. HERO BANNER (Estilo Ejecutivo Institucional Quality)
         ========================================================================== -->
    <section class="inhouse-hero text-center position-relative overflow-hidden">
        <div class="inhouse-hero-pattern" aria-hidden="true"></div>
        <div class="container position-relative">
            <!-- Badge Superior -->
            <div class="d-inline-block mb-3">
                <span class="badge bg-light text-dark px-3 py-2 rounded-pill fw-bold shadow-sm text-uppercase">
                    <i class="fas fa-building text-warning me-2"></i> Formación Corporativa para Empresas
                </span>
            </div>

            <!-- Título Principal -->
            <h1 class="inhouse-hero-title">
                Capacitaciones In-House
            </h1>

            <!-- Subtítulo -->
            <p class="inhouse-hero-subtitle">
                Formación a la medida de tu empresa
            </p>

            <p class="inhouse-hero-desc text-light text-opacity-90 mx-auto mb-4">
                Desarrollamos programas de capacitación diseñados específicamente para responder a los desafíos técnicos, normativos y contractuales de tus proyectos y equipos de trabajo.
            </p>

            <!-- Botones de Acción -->
            <div class="inhouse-hero-actions d-flex flex-wrap justify-content-center gap-3 mt-4">
                <a href="#solicitar-propuesta" class="btn btn-qcs-primary btn-lg px-4 py-3 rounded-pill shadow">
                    <i class="fas fa-file-signature me-2"></i> Solicitar propuesta
                </a>
                <a href="https://api.whatsapp.com/send?phone=51993463118&text=Hola,%20solicito%20una%20propuesta%20de%20capacitaci%C3%B3n%20In-House%20para%20mi%20empresa" target="_blank" rel="noopener noreferrer" class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill">
                    <i class="fab fa-whatsapp text-success me-2 fs-5 align-middle"></i> Contactar por WhatsApp
                </a>
            </div>
        </div>
    </section>

    <!-- ==========================================================================
         2. INTRODUCCIÓN AL SERVICIO EMPRESARIAL (Fondo Blanco)
         ========================================================================== -->
    <section class="inhouse-intro py-5 bg-white">
        <div class="container py-lg-4">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="pe-lg-3">
                        <span class="badge bg-warning-subtle text-dark fw-bold px-3 py-2 rounded-pill text-uppercase mb-3">
                            <i class="fas fa-check-double text-warning me-1"></i> Enfoque Corporativo Especializado
                        </span>
                        <h2 class="inhouse-section-title mb-4">
                            Fortalecemos las competencias técnicas de tus equipos de ingeniería y construcción
                        </h2>
                        <p class="text-secondary mb-3" style="font-size: 1.05rem; line-height: 1.8;">
                            En Quality Consulting Solutions entendemos que cada organización y proyecto enfrenta condiciones operativas y contractuales particulares. Nuestro servicio de capacitación <strong>In-House</strong> adapta el contenido, los casos de estudio y el cronograma para alinearse directamente con los objetivos estratégicos de su empresa.
                        </p>
                        <p class="text-secondary mb-4" style="line-height: 1.7;">
                            Impartido por especialistas en ejercicio profesional, este servicio permite a los participantes aplicar las mejores prácticas de la industria de forma inmediata en la gestión de calidad, el control de riesgos y la administración contractual de sus obras.
                        </p>
                        <div class="d-flex align-items-center gap-3 pt-2">
                            <div class="inhouse-stat-box">
                                <span class="inhouse-stat-num text-warning">+25</span>
                                <span class="inhouse-stat-label">Años de experiencia combinada</span>
                            </div>
                            <div class="vr mx-2 text-muted opacity-25"></div>
                            <div class="inhouse-stat-box">
                                <span class="inhouse-stat-num text-warning">+1,500</span>
                                <span class="inhouse-stat-label">Profesionales capacitados</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <!-- Pilares del Servicio In-House -->
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="inhouse-pillar-card p-4 rounded-4 h-100">
                                <div class="inhouse-pillar-icon mb-3">
                                    <i class="fas fa-sliders-h text-warning"></i>
                                </div>
                                <h3 class="h6 fw-bold mb-2">Diagnóstico y Personalización</h3>
                                <p class="small text-muted mb-0">Temarios adaptados al perfil del equipo, nivel de madurez y requisitos técnicos de la empresa.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="inhouse-pillar-card p-4 rounded-4 h-100">
                                <div class="inhouse-pillar-icon mb-3">
                                    <i class="fas fa-briefcase text-warning"></i>
                                </div>
                                <h3 class="h6 fw-bold mb-2">Casuística Real</h3>
                                <p class="small text-muted mb-0">Enfoque práctico fundamentado en situaciones de obra, análisis de riesgos y contratos reales.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="inhouse-pillar-card p-4 rounded-4 h-100">
                                <div class="inhouse-pillar-icon mb-3">
                                    <i class="fas fa-calendar-check text-warning"></i>
                                </div>
                                <h3 class="h6 fw-bold mb-2">Flexibilidad de Horarios</h3>
                                <p class="small text-muted mb-0">Modalidades y cronogramas planificados para compatibilizar con las jornadas laborales del equipo.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="inhouse-pillar-card p-4 rounded-4 h-100">
                                <div class="inhouse-pillar-icon mb-3">
                                    <i class="fas fa-user-shield text-warning"></i>
                                </div>
                                <h3 class="h6 fw-bold mb-2">Confidencialidad</h3>
                                <p class="small text-muted mb-0">Tratamiento estrictamente reservado de la información técnica y organizacional de su empresa.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================================================
         3. ÁREAS DE FORMACIÓN (Fondo Marfil / Ivory #FCFBF7)
         ========================================================================== -->
    <section class="inhouse-areas py-5" style="background-color: #FCFBF7; border-top: 1px solid #ECEAE3; border-bottom: 1px solid #ECEAE3;">
        <div class="container py-lg-4">
            
            <div class="text-center max-w-750 mx-auto mb-5">
                <span class="badge bg-warning text-dark fw-bold px-3 py-2 rounded-pill text-uppercase mb-2">
                    <i class="fas fa-graduation-cap me-1"></i> Especialidades Técnicas
                </span>
                <h2 class="inhouse-section-title mb-3">
                    Áreas de Formación In-House
                </h2>
                <p class="text-secondary">
                    Diseñamos programas a medida en las disciplinas clave de la ingeniería, la infraestructura y la edificación, enfocados en maximizar la eficiencia y prevenir contingencias operativas.
                </p>
            </div>

            <div class="row g-4">
                
                <!-- Área 1: Calidad -->
                <div class="col-lg-4 col-md-6">
                    <div class="inhouse-area-card bg-white rounded-4 overflow-hidden h-100 shadow-sm border">
                        <div class="inhouse-area-img-box">
                            <img src="img/Index-GerenciaCalidadObras.webp" alt="Formación In-House en Gestión de la Calidad" class="inhouse-area-img" loading="lazy">
                            <span class="inhouse-area-badge">Área 01</span>
                        </div>
                        <div class="p-4 d-flex flex-column justify-content-between flex-grow-1">
                            <div>
                                <h3 class="h5 fw-bold mb-3 font-montserrat text-dark">
                                    <i class="fas fa-award text-warning me-2"></i> Gestión de la Calidad
                                </h3>
                                <p class="text-secondary small mb-3" style="line-height: 1.7;">
                                    Sistemas integrados de gestión, aseguramiento y control de la calidad (QA/QC), protocolos de liberación en obra, planes de puntos de inspección (PPI), auditorías técnicas y aplicación práctica de las normas ISO 9001 e ISO 19011.
                                </p>
                            </div>
                            <div class="pt-3 border-top border-light-subtle">
                                <span class="badge bg-light text-dark fw-semibold small">
                                    <i class="fas fa-check text-success me-1"></i> Obras civiles, edificación e infraestructura
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Área 2: Riesgos -->
                <div class="col-lg-4 col-md-6">
                    <div class="inhouse-area-card bg-white rounded-4 overflow-hidden h-100 shadow-sm border">
                        <div class="inhouse-area-img-box">
                            <img src="img/Index-riesgos.webp" alt="Formación In-House en Gestión de Riesgos" class="inhouse-area-img" loading="lazy">
                            <span class="inhouse-area-badge">Área 02</span>
                        </div>
                        <div class="p-4 d-flex flex-column justify-content-between flex-grow-1">
                            <div>
                                <h3 class="h5 fw-bold mb-3 font-montserrat text-dark">
                                    <i class="fas fa-shield-alt text-warning me-2"></i> Gestión de Riesgos
                                </h3>
                                <p class="text-secondary small mb-3" style="line-height: 1.7;">
                                    Gestión integral de riesgos técnicos y operacionales en la construcción bajo estándares internacionales (ISO 31000, Enfoque PMI), identificación sistemática, análisis cualitativo y cuantitativo, y planes de respuesta y contingencia.
                                </p>
                            </div>
                            <div class="pt-3 border-top border-light-subtle">
                                <span class="badge bg-light text-dark fw-semibold small">
                                    <i class="fas fa-check text-success me-1"></i> Prevención de sobrecostos y retrasos
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Área 3: Contratos -->
                <div class="col-lg-4 col-md-6">
                    <div class="inhouse-area-card bg-white rounded-4 overflow-hidden h-100 shadow-sm border">
                        <div class="inhouse-area-img-box">
                            <img src="img/Index-Contratos-Internacionales.webp" alt="Formación In-House en Contratos y Reclamos" class="inhouse-area-img" loading="lazy">
                            <span class="inhouse-area-badge">Área 03</span>
                        </div>
                        <div class="p-4 d-flex flex-column justify-content-between flex-grow-1">
                            <div>
                                <h3 class="h5 fw-bold mb-3 font-montserrat text-dark">
                                    <i class="fas fa-file-contract text-warning me-2"></i> Contratos y Reclamos
                                </h3>
                                <p class="text-secondary small mb-3" style="line-height: 1.7;">
                                    Administración contractual proactiva, gestión de cambios y variaciones de alcance, solicitudes de ampliación de plazo, sustento de reclamos, contratos colaborativos (NEC, FIDIC) y prevención de disputas técnicas.
                                </p>
                            </div>
                            <div class="pt-3 border-top border-light-subtle">
                                <span class="badge bg-light text-dark fw-semibold small">
                                    <i class="fas fa-check text-success me-1"></i> Protección contractual y mitigación de disputas
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Área 4: Gestión de Proyectos / PMO -->
                <div class="col-lg-6 col-md-6">
                    <div class="inhouse-area-card bg-white rounded-4 overflow-hidden h-100 shadow-sm border">
                        <div class="inhouse-area-img-box">
                            <img src="img/Index-GestionPMO.webp" alt="Formación In-House en Gestión de Proyectos y PMO" class="inhouse-area-img" loading="lazy">
                            <span class="inhouse-area-badge">Área 04</span>
                        </div>
                        <div class="p-4 d-flex flex-column justify-content-between flex-grow-1">
                            <div>
                                <h3 class="h5 fw-bold mb-3 font-montserrat text-dark">
                                    <i class="fas fa-tasks text-warning me-2"></i> Gestión de Proyectos y PMO
                                </h3>
                                <p class="text-secondary small mb-3" style="line-height: 1.7;">
                                    Dirección y control de proyectos con enfoque PMI, metodologías de planificación integrada, gestión de cronogramas y costos mediante Valor Ganado (EVM), estandarización de procesos y optimización del desempeño de equipos multidisciplinarios.
                                </p>
                            </div>
                            <div class="pt-3 border-top border-light-subtle">
                                <span class="badge bg-light text-dark fw-semibold small">
                                    <i class="fas fa-check text-success me-1"></i> Control de plazos, costos y gobernanza de proyectos
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Área 5: Oficina Técnica -->
                <div class="col-lg-6 col-md-12">
                    <div class="inhouse-area-card bg-white rounded-4 overflow-hidden h-100 shadow-sm border">
                        <div class="inhouse-area-img-box">
                            <img src="img/Index-OficinaTecnicaObras.webp" alt="Formación In-House en Oficina Técnica de Obras" class="inhouse-area-img" loading="lazy">
                            <span class="inhouse-area-badge">Área 05</span>
                        </div>
                        <div class="p-4 d-flex flex-column justify-content-between flex-grow-1">
                            <div>
                                <h3 class="h5 fw-bold mb-3 font-montserrat text-dark">
                                    <i class="fas fa-pencil-ruler text-warning me-2"></i> Oficina Técnica de Obras
                                </h3>
                                <p class="text-secondary small mb-3" style="line-height: 1.7;">
                                    Control técnico en campo y gabinete, elaboración y sustento de valorizaciones, metrados y presupuestos de obra, gestión de subcontratistas, compatibilización de especialidades y optimización de productividad de recursos en obra.
                                </p>
                            </div>
                            <div class="pt-3 border-top border-light-subtle">
                                <span class="badge bg-light text-dark fw-semibold small">
                                    <i class="fas fa-check text-success me-1"></i> Productividad de campo y control documental riguroso
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ==========================================================================
         4. PROCESO DE ATENCIÓN (Fondo Blanco)
         ========================================================================== -->
    <section class="inhouse-process py-5 bg-white">
        <div class="container py-lg-4">
            
            <div class="text-center max-w-750 mx-auto mb-5">
                <span class="badge bg-light text-dark border fw-bold px-3 py-2 rounded-pill text-uppercase mb-2">
                    <i class="fas fa-network-wired text-warning me-1"></i> Metodología de Trabajo
                </span>
                <h2 class="inhouse-section-title mb-3">
                    Proceso de Atención y Coordinación
                </h2>
                <p class="text-secondary">
                    Un flujo ágil y transparente desde el primer contacto hasta el diseño definitivo de la propuesta corporativa.
                </p>
            </div>

            <div class="row g-4 justify-content-center">
                
                <!-- Paso 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="inhouse-step-card p-4 p-lg-5 rounded-4 h-100 border text-center">
                        <div class="inhouse-step-number mx-auto mb-3">01</div>
                        <h3 class="h5 fw-bold mb-3 font-montserrat">Comunicar la necesidad</h3>
                        <p class="text-secondary small mb-0" style="line-height: 1.7;">
                            La empresa comparte sus requerimientos, áreas de interés, cantidad estimada de participantes y los desafíos específicos que busca resolver en sus proyectos.
                        </p>
                    </div>
                </div>

                <!-- Paso 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="inhouse-step-card p-4 p-lg-5 rounded-4 h-100 border text-center">
                        <div class="inhouse-step-number mx-auto mb-3">02</div>
                        <h3 class="h5 fw-bold mb-3 font-montserrat">Coordinar el alcance</h3>
                        <p class="text-secondary small mb-0" style="line-height: 1.7;">
                            Nuestro equipo técnico analiza el perfil del grupo, estructura los temas clave, propone las fechas tentativas y acuerda la modalidad de impartición más adecuada.
                        </p>
                    </div>
                </div>

                <!-- Paso 3 -->
                <div class="col-lg-4 col-md-6">
                    <div class="inhouse-step-card p-4 p-lg-5 rounded-4 h-100 border text-center">
                        <div class="inhouse-step-number mx-auto mb-3">03</div>
                        <h3 class="h5 fw-bold mb-3 font-montserrat">Solicitar una propuesta</h3>
                        <p class="text-secondary small mb-0" style="line-height: 1.7;">
                            Entregamos una propuesta técnica y económica formal adaptada a los requerimientos definidos, lista para su evaluación y aprobación corporativa.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ==========================================================================
         5. CARRUSEL HORIZONTAL CONTINUO DE CLIENTES (Estilo Ejecutivo Quality)
         ========================================================================== -->
    <section class="inhouse-clients-section py-5 position-relative overflow-hidden" aria-label="Empresas que confían en Quality Consulting Solutions">
        <div class="container py-lg-2 text-center position-relative" style="z-index: 2;">
            <span class="badge bg-warning text-dark fw-bold px-3 py-2 rounded-pill text-uppercase mb-2">
                <i class="fas fa-handshake me-1"></i> Respaldo y Confianza
            </span>
            <h2 class="inhouse-section-title text-white mb-2">
                Empresas que confían en Quality Consulting Solutions
            </h2>
            <p class="text-light text-opacity-75 max-w-750 mx-auto mb-4">
                Profesionales y equipos de destacadas organizaciones de la ingeniería y la construcción participan de nuestros programas de formación especializada.
            </p>
        </div>

        <!-- Contenedor del Carrusel con máscara lateral suave y pausa al hover/focus -->
        <div class="inhouse-carousel-wrapper mt-3 position-relative" tabindex="0" role="region" aria-label="Carrusel de logos de empresas participantes">
            <div class="inhouse-carousel-track">
                
                <!-- Secuencia Principal (19 logos) -->
                <?php foreach ($clientLogos as $client): ?>
                    <div class="inhouse-client-item" title="<?= htmlspecialchars($client['name'], ENT_QUOTES, 'UTF-8') ?>">
                        <div class="inhouse-client-card">
                            <img src="img/clientes/<?= htmlspecialchars($client['file'], ENT_QUOTES, 'UTF-8') ?>" 
                                 alt="Logo <?= htmlspecialchars($client['name'], ENT_QUOTES, 'UTF-8') ?>" 
                                 class="inhouse-client-img" 
                                 loading="lazy">
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Secuencia Duplicada para bucle continuo infinito sin saltos -->
                <?php foreach ($clientLogos as $client): ?>
                    <div class="inhouse-client-item" aria-hidden="true" title="<?= htmlspecialchars($client['name'], ENT_QUOTES, 'UTF-8') ?>">
                        <div class="inhouse-client-card">
                            <img src="img/clientes/<?= htmlspecialchars($client['file'], ENT_QUOTES, 'UTF-8') ?>" 
                                 alt="" 
                                 class="inhouse-client-img" 
                                 loading="lazy">
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </section>

    <!-- ==========================================================================
         6. FORMULARIO Y CONTACTO INSTITUCIONAL (Fondo Oscuro Ejecutivo #0F1113)
         ========================================================================== -->
    <section class="inhouse-contact-section py-5 position-relative" id="solicitar-propuesta">
        <div class="container py-lg-4">
            
            <div class="text-center max-w-750 mx-auto mb-5 text-white">
                <span class="badge bg-warning text-dark fw-bold px-3 py-2 rounded-pill text-uppercase mb-2">
                    <i class="fas fa-paper-plane me-1"></i> Solicitud de Propuesta In-House
                </span>
                <h2 class="inhouse-section-title text-white mb-3">
                    Inicia la formación de tu equipo hoy
                </h2>
                <p class="text-light text-opacity-90">
                    Completa el formulario para coordinar una reunión de diagnóstico y recibir una propuesta adaptada a tu organización, o comunícate directamente con nuestra área comercial.
                </p>
            </div>

            <div class="row g-4 justify-content-center">
                
                <!-- Columna Izquierda: Formulario de Solicitud In-House -->
                <div class="col-lg-7">
                    <div class="inhouse-form-card shadow-lg rounded-4 p-4 p-md-5 bg-white">
                        
                        <div class="mb-4">
                            <h3 class="h5 fw-bold font-montserrat text-dark mb-1">
                                Formulario de Solicitud Corporativa
                            </h3>
                            <p class="text-muted small mb-0">
                                Los campos marcados con (<span class="text-danger">*</span>) son obligatorios.
                            </p>
                        </div>

                        <!-- Contenedor para Alertas Dinámicas -->
                        <div id="inhouseFormAlert" class="mb-3" style="display: none;"></div>

                        <form id="inhouseForm" action="/backend/send-contact.php" method="POST" novalidate>
                            
                            <!-- Campo Trampa Anti-Spam (Honeypot) -->
                            <div style="display:none !important; visibility:hidden !important; position:absolute; left:-9999px;" aria-hidden="true">
                                <label for="_qcs_inhouse_hp">No complete este campo si es humano</label>
                                <input type="text" id="_qcs_inhouse_hp" name="_qcs_verification_hp" tabindex="-1" autocomplete="off">
                            </div>

                            <!-- Identificador de Servicio -->
                            <input type="hidden" name="servicio" value="in-house">

                            <!-- Fila 1: Nombre y Empresa -->
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="inhouseNombre" class="form-label fw-bold small text-secondary">
                                        Nombre y Apellido <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                                        <input type="text" id="inhouseNombre" name="nombre" class="form-control border-start-0 ps-0" placeholder="Ej. Juan Pérez" required autocomplete="name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inhouseEmpresa" class="form-label fw-bold small text-secondary">
                                        Empresa u Organización <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-building text-muted"></i></span>
                                        <input type="text" id="inhouseEmpresa" name="empresa" class="form-control border-start-0 ps-0" placeholder="Nombre de la empresa" required autocomplete="organization">
                                    </div>
                                </div>
                            </div>

                            <!-- Fila 2: Correo y Teléfono -->
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="inhouseEmail" class="form-label fw-bold small text-secondary">
                                        Correo Corporativo <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                                        <input type="email" id="inhouseEmail" name="email" class="form-control border-start-0 ps-0" placeholder="ejemplo@empresa.com" required autocomplete="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inhouseTelefono" class="form-label fw-bold small text-secondary">
                                        Teléfono / WhatsApp <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-phone text-muted"></i></span>
                                        <input type="tel" id="inhouseTelefono" name="telefono" class="form-control border-start-0 ps-0" placeholder="+51 999 999 999" required autocomplete="tel">
                                    </div>
                                </div>
                            </div>

                            <!-- Fila 3: Área de Interés y Participantes Estimados -->
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="inhouseArea" class="form-label fw-bold small text-secondary">
                                        Área de Interés <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-layer-group text-muted"></i></span>
                                        <select id="inhouseArea" name="area_interes" class="form-select border-start-0 ps-0" required>
                                            <option value="" disabled selected>Seleccione un área</option>
                                            <option value="Gestión de la Calidad">Gestión de la Calidad</option>
                                            <option value="Gestión de Riesgos">Gestión de Riesgos</option>
                                            <option value="Contratos y Reclamos">Contratos y Reclamos</option>
                                            <option value="Gestión de Proyectos / PMO">Gestión de Proyectos / PMO</option>
                                            <option value="Oficina Técnica de Obras">Oficina Técnica de Obras</option>
                                            <option value="Múltiples Áreas / Programa a Medida">Múltiples Áreas / Programa a Medida</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inhouseParticipantes" class="form-label fw-bold small text-secondary">
                                        Participantes Estimados <span class="text-muted fw-normal">(Opcional)</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-users text-muted"></i></span>
                                        <select id="inhouseParticipantes" name="participantes" class="form-select border-start-0 ps-0">
                                            <option value="Por definir">Por definir</option>
                                            <option value="1 a 5 participantes">1 a 5 participantes</option>
                                            <option value="6 a 15 participantes">6 a 15 participantes</option>
                                            <option value="16 a 30 participantes">16 a 30 participantes</option>
                                            <option value="Más de 30 participantes">Más de 30 participantes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Mensaje / Detalle de la Necesidad -->
                            <div class="mb-3">
                                <label for="inhouseConsulta" class="form-label fw-bold small text-secondary">
                                    Detalle del Requerimiento o Consulta <span class="text-danger">*</span>
                                </label>
                                <textarea id="inhouseConsulta" name="consulta" class="form-control" rows="4" placeholder="Indícanos los objetivos del curso, perfil de los participantes, fechas tentativas o requerimientos particulares..." required></textarea>
                            </div>

                            <!-- Consentimiento de Privacidad (NO marcado por defecto) -->
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="inhousePrivacy" name="privacidad" required>
                                <label class="form-check-label small text-muted" for="inhousePrivacy">
                                    Acepto el tratamiento de mis datos personales para la atención de esta solicitud corporativa, conforme a la <a href="/terminos-y-condiciones#clausula-6" target="_blank" class="text-decoration-underline text-secondary">Política de Privacidad y Protección de Datos</a> de Quality Consulting Solutions.
                                </label>
                            </div>

                            <!-- Botón de Envío -->
                            <div>
                                <button type="submit" id="inhouseSubmitBtn" class="btn btn-lg w-100 py-3 fw-bold rounded-pill shadow btn-qcs-primary">
                                    <span class="btn-text"><i class="fas fa-file-signature me-2"></i> SOLICITAR PROPUESTA</span>
                                    <span class="btn-loading d-none"><i class="fas fa-spinner fa-spin me-2"></i> PROCESANDO SOLICITUD...</span>
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

                <!-- Columna Derecha: Tarjeta de Contacto Directo Institucional -->
                <div class="col-lg-5">
                    <div class="inhouse-support-card text-white rounded-4 p-4 p-md-5 shadow-lg d-flex flex-column justify-content-between h-100">
                        
                        <div>
                            <span class="badge bg-warning bg-opacity-25 text-warning border border-warning px-3 py-2 rounded-pill fw-bold mb-3">
                                <i class="fas fa-headset me-1"></i> ATENCIÓN CORPORATIVA DIRECTA
                            </span>
                            
                            <h3 class="fw-bold font-montserrat text-white mb-3" style="font-size: 1.55rem;">
                                ¿Necesitas coordinar de inmediato con un asesor comercial?
                            </h3>
                            
                            <p class="text-light text-opacity-90 mb-4" style="line-height: 1.8;">
                                Comunícate por nuestros canales oficiales para agendar una reunión ejecutiva, coordinar temarios o resolver consultas técnicas al instante.
                            </p>

                            <!-- Botón WhatsApp Directo In-House -->
                            <a href="https://api.whatsapp.com/send?phone=51993463118&text=Hola,%20solicito%20una%20propuesta%20de%20capacitaci%C3%B3n%20In-House%20para%20mi%20empresa" target="_blank" rel="noopener noreferrer" class="btn btn-success btn-lg w-100 py-3 my-2 fw-bold rounded-pill shadow">
                                <i class="fab fa-whatsapp me-2 fs-4 align-middle"></i> Solicitar por WhatsApp
                            </a>

                            <!-- Canal de Correo Comercial -->
                            <div class="inhouse-direct-box mt-3 p-3 rounded-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="inhouse-direct-icon text-warning fs-3">
                                        <i class="fas fa-envelope-open-text"></i>
                                    </div>
                                    <div>
                                        <span class="small text-light text-opacity-75 d-block">Correo Comercial Oficial</span>
                                        <a href="mailto:comercial@quality-consulting.org" class="text-white fw-bold text-decoration-none">
                                            comercial@quality-consulting.org
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Canal Telefónico Directo -->
                            <div class="inhouse-direct-box mt-2 p-3 rounded-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="inhouse-direct-icon text-success fs-3">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <div>
                                        <span class="small text-light text-opacity-75 d-block">Teléfono / WhatsApp</span>
                                        <a href="tel:+51993463118" class="text-white fw-bold text-decoration-none">
                                            +51 993 463 118
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Horario de Atención -->
                            <div class="schedule-box mt-4">
                                <h4 class="fw-bold font-montserrat text-white mb-2 fs-6">
                                    <i class="fa-regular fa-clock me-2 text-warning"></i> Horario de Atención
                                </h4>
                                <div class="schedule-row d-flex justify-content-between py-1 border-bottom border-white border-opacity-10 small">
                                    <span class="text-light text-opacity-75">Lunes a Viernes:</span>
                                    <span class="fw-bold text-white">8:00 am - 6:00 pm</span>
                                </div>
                                <div class="schedule-row d-flex justify-content-between py-1 small">
                                    <span class="text-light text-opacity-75">Sábados:</span>
                                    <span class="fw-bold text-white">9:00 am - 1:00 pm</span>
                                </div>
                            </div>
                        </div>

                        <!-- Dirección Sede Central -->
                        <div class="mt-4 pt-3 border-top border-white border-opacity-10 small text-light text-opacity-75">
                            <i class="fas fa-map-marker-alt text-warning me-2"></i>
                            Av. Javier Prado 757, piso 10 Magdalena, Lima 17, Perú
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>

</main>
