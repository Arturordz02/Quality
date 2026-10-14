<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Oficina Técnica en Edificaciones + Panel de Control 100% Real Time
 * Archivo: app/Views/pages/oficina-tecnica-edificaciones-panel-control.php
 *
 * Basado en la plantilla unificada aprobada: app/Views/partials/course_detail_unified.php
 * Contenido auditado estrictamente contra el documento oficial externo:
 * D:\Descargas D\Brouchure\Oficina Tecnica\BROCHURE OFICINA TÉCNICA EN EDIFICACIONES - F (2).pdf
 */

declare(strict_types=1);

$course = [
    // 1. Hero Banner
    'hero_badge'          => 'ÁREA DE OFICINA TÉCNICA • 17 HORAS NETAS • 16 PDU',
    'hero_badge_icon'     => 'fa-solid fa-chart-line',
    'title'               => 'OFICINA TÉCNICA EN EDIFICACIONES + PANEL DE CONTROL 100% REAL TIME',
    'summary'             => 'Presentar a los participantes los aspectos que componen la Gestión de la Oficina Técnica en proyectos de edificaciones de envergadura, con conceptos, criterios prácticos y herramientas útiles.',
    'hero_cards'          => [
        [
            'icon'  => 'fa-solid fa-building',
            'title' => 'EDIFICACIONES DE ENVERGADURA',
            'desc'  => 'Gestión integral de oficina técnica en proyectos de edificaciones: ingeniería, procura, construcción y control operativo.',
        ],
        [
            'icon'  => 'fa-solid fa-cloud-arrow-up',
            'title' => 'CLOUD DASHBOARD',
            'desc'  => 'Panel de control 100% en tiempo real vía cloud con Looker Studio (Google Data Studio) para toma de decisiones.',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '17 HORAS & 16 PDU',
            'desc'  => '17 horas netas de capacitación de alto nivel y 16 PDU en la categoría General Education Third-Party Provider del PMI®.',
        ],
        [
            'icon'  => 'fa-solid fa-briefcase',
            'title' => 'BASE DE DATOS LABORAL',
            'desc'  => 'Ingreso a la base de datos laboral de Quality Consulting Solutions y diploma digital oficial.',
        ],
    ],

    // 2. Objetivo del curso (Página 2 del documento oficial)
    'objective'           => 'Presentar a los participantes los aspectos que componen la Gestión de la Oficina Técnica en proyectos de edificaciones de envergadura, con conceptos, criterios prácticos y herramientas útiles.',
    'objective_image'     => 'img/capacitaciones/oficina-tecnica-edificaciones-panel-control.png',
    'objective_image_webp'=> 'img/capacitaciones/oficina-tecnica-edificaciones-panel-control.webp',
    'objective_image_alt' => 'Oficina Técnica en Edificaciones + Panel de Control 100% Real Time',
    'objective_highlights'=> [
        'Ingeniería y Procura: Administración de la información técnica, gestión de comunicaciones, compatibilización, presupuestos, cronogramas, líneas base, planes de calidad, logística de materiales y gestión de adelantos.',
        'Construcción y Control Operativo: Implementación de Last Planner (herramientas Lean), control de calidad, análisis de Valor Ganado, Resultado Operativo, gestión de contratos y negociación de claims.',
        'Cloud Dashboard en Tiempo Real: Implementación práctica de paneles de control 100% en tiempo real vía cloud con Looker Studio (Google Data Studio) conectados a los indicadores clave de obra.',
    ],

    // 3. Temario del curso (5 bloques oficiales según página 2 del documento oficial)
    'syllabus_intro'      => 'El programa aborda la gestión de la Oficina Técnica en edificaciones estructurado en 5 bloques temáticos oficiales:',
    'syllabus'            => [
        [
            'title'   => 'Ingeniería',
            'icon'    => 'fa-solid fa-compass-drafting',
            'content' => '<ul><li>Administración de la información técnica.</li><li>Gestión de las Comunicaciones.</li><li>Compatibilización.</li><li>Presupuesto, Cronograma, Línea base y Plan de calidad.</li></ul>',
        ],
        [
            'title'   => 'Procura',
            'icon'    => 'fa-solid fa-truck-ramp-box',
            'content' => '<ul><li>Logística de Materiales.</li><li>Cronogramas de Recursos.</li><li>Gestión de Adelantos.</li></ul>',
        ],
        [
            'title'   => 'Construcción',
            'icon'    => 'fa-solid fa-trowel-bricks',
            'content' => '<ul><li>Last Planner (Herramientas Lean).</li><li>Control de Calidad.</li></ul>',
        ],
        [
            'title'   => 'Gerenciamiento, costos y riesgos del proyecto',
            'icon'    => 'fa-solid fa-chart-pie',
            'content' => '<ul><li>Valor Ganado.</li><li>Resultado Operativo.</li><li>Gestión de Contratos.</li><li>Negociación de Claims.</li></ul>',
        ],
        [
            'title'   => 'Cloud Dashboard',
            'icon'    => 'fa-solid fa-cloud',
            'content' => '<ul><li>Panel de Control de 100% tiempo real y vía cloud con Looker Studio (Google Data Studio).</li></ul>',
        ],
    ],

    // 4. Perfil docente (Ing. Fernando Gonzales - Páginas 1 y 4 del documento oficial)
    'docente'             => [
        'photo'          => 'img/docentes/fernando-gonzales.png',
        'photo_webp'     => 'img/docentes/fernando-gonzales.webp',
        'photo_alt'      => 'Ing. Fernando Gonzales, docente de Oficina Técnica en Edificaciones',
        'alt'            => 'Ing. Fernando Gonzales, docente de Oficina Técnica en Edificaciones',
        'name'           => 'Ing. Fernando Gonzales',
        'experience_tag' => '+20 años de experiencia',
        'credentials'    => ['Ing. Civil UNI', 'CIP 62200', 'Magíster en Finanzas (MEF) – ESAN', 'MBA – Centrum PUCP', '+20 años de experiencia'],
        'summary'        => 'Ingeniero Civil de la Universidad Nacional de Ingeniería (UNI), Colegiado CIP 62,200. Magíster en Finanzas (MEF) en ESAN Graduate School of Business, MBA en Centrum Graduate Business School de la Pontificia Universidad Católica del Perú y estudios culminados de Maestría en Gerencia de Proyectos de Ingeniería en la UNFV. Cuenta con más de 20 años de experiencia en la industria de la construcción en proyectos de saneamiento, obras viales, edificaciones, infraestructura, obras medioambientales, retail y plantas industriales en Perú y el extranjero (Chile).',
        'highlights'     => [
            '<strong>Experiencia Directiva y Docente:</strong> Director Gerente de ACENET y Profesor de la Maestría en Dirección de la Construcción (MDC) y de programas especializados de finanzas e ingeniería de la UPC.',
            '<strong>Gerenciamiento y Control de Proyectos:</strong> Amplia experiencia en gerenciamiento de proyectos, formulación, evaluación, financiamiento y control de proyectos, estructuración financiera y elaboración de planes de negocio.',
            '<strong>Consultoría y Gestión de Activos:</strong> Especialista en valoración de empresas y activos inmobiliarios, due diligence, análisis HBU, ingeniería de valor, planeamiento estratégico y gerencia basada en procesos.',
        ],
        'full_bio_items' => [
            '<strong>ACENET:</strong> Director Gerente.',
            '<strong>Universidad Peruana de Ciencias Aplicadas (UPC):</strong> Profesor de la Maestría en Dirección de la Construcción (MDC) en Lima, Arequipa y Cusco.',
            '<strong>Escuela de Post Grado UPC:</strong> Profesor de los Programas Especializados de Finanzas y de Ingeniería (Lima).',
            '<strong>Trayectoria en Proyectos:</strong> Participación en proyectos del sector estatal, privado y esquemas mixtos (APPs, OxI) en Perú y Chile.',
            '<strong>Especialidades Clave:</strong> Estructuración financiera, planes de negocio, due diligence, análisis HBU, ingeniería de valor y consultoría en planeamiento estratégico y organizacional.',
        ],
        'recognition'    => 'Profesional de destacada trayectoria gerencial y académica en dirección de proyectos de construcción, modelado financiero y control directivo de obras a nivel nacional e internacional.',
    ],

    // 5. Beneficios oficiales (Página 3 del documento oficial)
    'benefits'            => [
        [
            'icon'  => 'fa-solid fa-briefcase',
            'title' => 'Base de datos laboral',
            'text'  => 'Ingreso a la base de datos laboral de Quality Consulting Solutions.',
        ],
        [
            'icon'  => 'fa-solid fa-percent',
            'title' => 'Descuentos futuros',
            'text'  => 'Descuento para futuros cursos con precios ordinarios.',
        ],
        [
            'icon'  => 'fa-solid fa-certificate',
            'title' => 'Diploma digital',
            'text'  => 'Diploma digital a nombre de Quality Consulting Solutions.',
        ],
        [
            'icon'  => 'fa-regular fa-file-lines',
            'title' => 'Material digital',
            'text'  => 'Entrega de material digital.',
        ],
        [
            'icon'  => 'fa-regular fa-circle-play',
            'title' => 'Grabación del curso',
            'text'  => 'Acceso vía internet a la grabación del curso luego de finalizado (4 semanas).',
        ],
    ],

    // 6. Datos de PDU y duración (Páginas 2 y 3 del documento oficial)
    'pdu'                 => '16 PDU',
    'hours'               => '17 horas netas',
    'pdu_count'           => '16 PDU',
    'duration_hours'      => '17 horas netas',
    'pdu_heading'         => 'Unidades de desarrollo profesional (16 PDU)',
    'pdu_title'           => 'Unidades de desarrollo profesional (16 PDU)',
    'pdu_text'            => 'Si tienes certificación del PMI® este curso te brinda 16 PDU (<em>Professional Development Unit</em>) para mantener tu certificación según la descripción provista por el PMI®: Categoría PMI® CCR: <em>General Education Third-Party Provider</em> – The PMI Talent Triangle®. Duración total: <strong>17 horas netas</strong>.',

    // 7. Información e inscripción (Sin brochure público)
    'enroll_bg_image'     => 'img/capacitaciones/oficina-tecnica-edificaciones-panel-control.webp',
    'whatsapp_url'        => 'https://api.whatsapp.com/send?phone=51993463118&text=' . urlencode('Hola Quality Consulting Solutions, deseo solicitar información sobre el curso de Oficina Técnica en Edificaciones + Panel de Control.'),
    'whatsapp_btn_text'   => 'Solicitar información por WhatsApp',
    'modal_service'       => 'Oficina Técnica en Edificaciones + Panel de Control',
    'paypal_slug'         => 'oficina-tecnica-edificaciones-panel-control',
    'first_class_label'   => 'Primera clase del curso – USD 10',
    'back_area_url'       => '/capacitacion-oficina-tecnica',
    'back_area_title'     => 'Volver al Área de Oficina Técnica',
    'videos'              => [],
];

echo $this->partial('course_detail_unified', ['course' => $course]);
