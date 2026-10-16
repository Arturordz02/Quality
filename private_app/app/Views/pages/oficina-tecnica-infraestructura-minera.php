<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Oficina Técnica en Infraestructura Minera (PADs, Presas de Relave, Geosintéticos)
 * Archivo: app/Views/pages/oficina-tecnica-infraestructura-minera.php
 *
 * Basado en la plantilla unificada aprobada: app/Views/partials/course_detail_unified.php
 * Contenido auditado estrictamente contra el documento oficial externo:
 * D:\Descargas D\Brouchure\Oficina Tecnica\02 - OFT INFRAESTRUCTURA MINERA - JVX (1).pdf
 */

declare(strict_types=1);

$course = [
    // 1. Hero Banner
    'hero_badge'          => 'ÁREA DE OFICINA TÉCNICA • 15 HORAS NETAS • 16 PDU',
    'hero_badge_icon'     => 'fa-solid fa-mountain',
    'title'               => 'OFICINA TÉCNICA EN INFRAESTRUCTURA MINERA (PADs, PRESAS DE RELAVE, GEOSINTÉTICOS)',
    'summary'             => 'Presentar a los participantes los aspectos y estrategias que componen la gestión de la Oficina Técnica en proyectos de movimiento de tierras en la infraestructura minera, como son obras de PADs de lixiviación, presas de relave, accesos, instalación de geosintéticos.',
    'hero_cards'          => [
        [
            'icon'  => 'fa-solid fa-mountain-sun',
            'title' => 'INFRAESTRUCTURA MINERA',
            'desc'  => 'Gestión técnica especializada en movimiento de tierras, PADs de lixiviación, presas de relave y geosintéticos.',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '15 HORAS & 16 PDU',
            'desc'  => '15 horas netas de capacitación práctica y 16 PDU en la categoría General Education Third-Party Provider del PMI®.',
        ],
        [
            'icon'  => 'fa-solid fa-list-check',
            'title' => 'PLANIFICACIÓN Y COSTOS',
            'desc'  => 'Análisis de restricciones, Look Ahead, Curva S, Valor Ganado, Presupuesto Meta y Resultado Operativo.',
        ],
        [
            'icon'  => 'fa-solid fa-briefcase',
            'title' => 'BASE DE DATOS LABORAL',
            'desc'  => 'Ingreso a la base de datos laboral de Quality Consulting Solutions y diploma digital oficial.',
        ],
    ],

    // 2. Objetivo del curso (Página 2 del documento oficial)
    'objective'           => 'Presentar a los participantes los aspectos y estrategias que componen la gestión de la Oficina Técnica en proyectos de movimiento de tierras en la infraestructura minera, como son obras de PADs de lixiviación, presas de relave, accesos, instalación de geosintéticos.',
    'objective_image'     => 'img/capacitaciones/oficina-tecnica-infraestructura-minera.png',
    'objective_image_webp'=> 'img/capacitaciones/oficina-tecnica-infraestructura-minera.webp',
    'objective_image_alt' => 'Oficina Técnica en Infraestructura Minera',
    'objective_highlights'=> [
        'Organización y Gestión Contractual: Documentos técnicos (especificaciones técnicas, memorias, planos, informes EIA), control de documentos, agendas de reunión (calidad, SSOMA), administración del contrato y formulación de adicionales.',
        'Procura y Gestión de Adquisiciones: Gestión integral de subcontratos y administración de adquisiciones para equipos mayores, materiales e insumos mineros.',
        'Planificación, Control y Costos: Cronograma de obra y recursos, análisis de riesgos y restricciones, tren de actividades, Plan Semanal, Look Ahead, Curva S, Valor Ganado, presupuestos, proyecciones y Resultado Operativo (RO).',
    ],

    // 3. Temario del curso (5 bloques oficiales según página 2 del documento oficial)
    'syllabus_intro'      => 'El contenido del programa aborda los aspectos esenciales de la Oficina Técnica en proyectos de infraestructura minera estructurado en 5 bloques temáticos:',
    'syllabus'            => [
        [
            'title'   => 'Organización y contratos',
            'icon'    => 'fa-solid fa-sitemap',
            'content' => '<ul><li>Documentos técnicos (Especificaciones Técnicas, Memorias, Planos, Informes EIA).</li><li>Control de Documentos.</li><li>Agendas de reunión (incl. Calidad, SSOMA).</li></ul>',
        ],
        [
            'title'   => 'Gestión del alcance',
            'icon'    => 'fa-solid fa-layer-group',
            'content' => '<ul><li>Administración del Contrato y el Alcance.</li><li>Formulación de adicionales (nuevo alcance, mayores metrados, improductivos).</li></ul>',
        ],
        [
            'title'   => 'Procura',
            'icon'    => 'fa-solid fa-truck-ramp-box',
            'content' => '<ul><li>Gestión de Subcontratos.</li><li>Gestión de las Adquisiciones (equipos; materiales e insumos).</li></ul>',
        ],
        [
            'title'   => 'Planificación y control',
            'icon'    => 'fa-solid fa-calendar-check',
            'content' => '<ul><li>Cronograma de obra.</li><li>Cronograma de recursos.</li><li>Análisis de riesgos.</li><li>Tren de actividades.</li><li>Análisis de restricciones.</li><li>Plan Semanal.</li><li>Look Ahead.</li><li>Porcentaje de Plan Cumplido.</li><li>Curva S.</li><li>Valor Ganado.</li><li>Informes de productividad.</li></ul>',
        ],
        [
            'title'   => 'Control de costos',
            'icon'    => 'fa-solid fa-coins',
            'content' => '<ul><li>Presupuesto (propuesta, precios unitarios, planillas de control).</li><li>Presupuesto Meta.</li><li>Proyecciones.</li><li>Resultado operativo (RO).</li></ul>',
        ],
    ],

    // 4. Perfil docente (Ing. Jorge Valdivieso - Páginas 1 y 4 del documento oficial)
    'docente'             => [
        'photo'          => 'img/docentes/jorge-valdivieso.png',
        'photo_webp'     => 'img/docentes/jorge-valdivieso.webp',
        'photo_alt'      => 'Ing. Jorge Valdivieso, docente de Oficina Técnica en Infraestructura Minera',
        'alt'            => 'Ing. Jorge Valdivieso, docente de Oficina Técnica en Infraestructura Minera',
        'name'           => 'Ing. Jorge Valdivieso',
        'experience_tag' => '+16 años de experiencia',
        'credentials'    => ['Ing. Civil', 'Máster', 'PMP®', '+16 años de experiencia'],
        'summary'        => 'Ingeniero Civil, Máster, PMP®, con más de 16 años de experiencia en proyectos de movimiento de tierras para infraestructura minera desempeñando los roles de Jefe de Oficina Técnica, Residencia de Obra, Supervisión, con entendimiento práctico de la elaboración de presupuestos, control de avance y costos de obra.',
        'highlights'     => [
            '<strong>Especialidad en Minería:</strong> Especialista en proyectos de movimiento de tierras para infraestructura minera, PADs de lixiviación, presas de relave y obras civiles de gran envergadura.',
            '<strong>Gestión Técnica Integral:</strong> Amplio dominio en formulación y control de presupuestos meta, resultado operativo (RO), administración contractual y gestión de valorizaciones de obra.',
            '<strong>Planificación y Control:</strong> Implementación de tren de actividades, gestión de restricciones, Look Ahead, Curva S, Valor Ganado y análisis de riesgos en operaciones de alta exigencia.',
        ],
        'full_bio_items' => [
            '<strong>CISSAC:</strong> Jefe de Oficina Técnica.',
            '<strong>San Martin Contratistas Generales S.A.:</strong> Jefe de Oficina Técnica.',
            '<strong>SERGEAR SAC:</strong> Jefe de Oficina Técnica.',
            '<strong>Corporación Lindley:</strong> Supervisor de Proyectos.',
            '<strong>Livit Inmobiliaria y Construcción:</strong> Jefe de Oficina Técnica.',
            '<strong>Skanska Perú S.A.:</strong> Supervisor Civil.',
            '<strong>Coinsa – Constructores Interamericanos S.A.C.:</strong> Jefe de Oficina Técnica.',
            '<strong>Buenaventura Ingenieros S.A.:</strong> Jefe de Oficina Técnica.',
            '<strong>Consorcio Constructora Dávalos:</strong> Asistente de Obra.',
            '<strong>Prisma Promotora Constructora S.A.C.:</strong> Residente de Obra.',
            '<strong>Aureum Constructores S.A.C.:</strong> Asistente de Obra.',
        ],
        'recognition'    => 'Profesional PMP® con sólida trayectoria en la dirección de oficina técnica y supervisión de megaproyectos mineros e infraestructura pesada a nivel nacional.',
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
    'hours'               => '15 horas netas',
    'pdu_count'           => '16 PDU',
    'duration_hours'      => '15 horas netas',
    'pdu_heading'         => 'Unidades de desarrollo profesional (16 PDU)',
    'pdu_title'           => 'Unidades de desarrollo profesional (16 PDU)',
    'pdu_text'            => 'Si tienes certificación del PMI® este curso te brinda 16 PDU (<em>Professional Development Unit</em>) para mantener tu certificación según la descripción provista por el PMI®: Categoría PMI® CCR: <em>General Education Third-Party Provider</em>. The PMI Talent Triangle®. Duración total: <strong>15 horas netas</strong>.',

    // 7. Información e inscripción (Sin brochure público)
    'enroll_bg_image'     => 'img/capacitaciones/oficina-tecnica-infraestructura-minera.webp',
    'whatsapp_url'        => 'https://api.whatsapp.com/send?phone=51993463118&text=' . urlencode('Hola Quality Consulting Solutions, deseo solicitar información sobre el curso de Oficina Técnica en Infraestructura Minera.'),
    'whatsapp_btn_text'   => 'Solicitar información por WhatsApp',
    'modal_service'       => 'Oficina Técnica en Infraestructura Minera',
    'paypal_slug'         => 'oficina-tecnica-infraestructura-minera',
    'first_class_label'   => 'Primera clase del curso – USD 10',
    'back_area_url'       => '/capacitacion-oficina-tecnica',
    'back_area_title'     => 'Volver al Área de Oficina Técnica',
    'videos'              => [],
];

echo $this->partial('course_detail_unified', ['course' => $course]);
