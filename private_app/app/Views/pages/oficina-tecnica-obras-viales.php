<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Oficina Técnica en Obras Viales
 * Archivo: app/Views/pages/oficina-tecnica-obras-viales.php
 *
 * Basado en la plantilla unificada aprobada: app/Views/partials/course_detail_unified.php
 * Contenido auditado estrictamente contra el documento oficial externo:
 * D:\Descargas D\Brouchure\Oficina Tecnica\02 - OFT EN OBRAS VIALES (1).pdf
 */

declare(strict_types=1);

$course = [
    // 1. Hero Banner
    'hero_badge'          => 'ÁREA DE OFICINA TÉCNICA • 16 HORAS NETAS • 16 PDU',
    'hero_badge_icon'     => 'fa-solid fa-road',
    'title'               => 'OFICINA TÉCNICA EN OBRAS VIALES',
    'summary'             => 'Presentar a los participantes los aspectos que componen la Gestión de la Oficina Técnica en proyectos de obras viales, con conceptos, criterios prácticos y herramientas útiles.',
    'hero_cards'          => [
        [
            'icon'  => 'fa-solid fa-road',
            'title' => 'OBRAS VIALES',
            'desc'  => 'Gestión integral de oficina técnica en proyectos de carreteras, infraestructura vial y puentes.',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '16 HORAS & 16 PDU',
            'desc'  => '16 horas netas de capacitación especializada y 16 PDU en la categoría General Education Third-Party Provider del PMI®.',
        ],
        [
            'icon'  => 'fa-solid fa-list-check',
            'title' => 'HERRAMIENTAS CLAVE',
            'desc'  => 'Contrato de Obra, Curva S, Last Planner System, Fórmula Polinómica, Resultado Operativo, RFI y Procura.',
        ],
        [
            'icon'  => 'fa-solid fa-briefcase',
            'title' => 'BASE DE DATOS LABORAL',
            'desc'  => 'Ingreso a la base de datos laboral de Quality Consulting Solutions y diploma digital oficial.',
        ],
    ],

    // 2. Objetivo del curso (Página 2 del documento oficial)
    'objective'           => 'Presentar a los participantes los aspectos que componen la Gestión de la Oficina Técnica en proyectos de obras viales, con conceptos, criterios prácticos y herramientas útiles.',
    'objective_image'     => 'img/capacitaciones/oficina-tecnica-obras-viales.png',
    'objective_image_webp'=> 'img/capacitaciones/oficina-tecnica-obras-viales.webp',
    'objective_image_alt' => 'Oficina Técnica en Obras Viales',
    'objective_highlights'=> [
        'Gestión de la Integración y Alcance: Contrato de obra, plan técnico, memoria descriptiva, planos, especificaciones, metrados, adelantos, valorizaciones, adicionales y deductivos.',
        'Control de Plazo y Costo: Cronograma de obra, avance valorizado, curva S, solicitudes de ampliaciones de plazo, Last Planner System, presupuestos contractual, interno y meta, fórmula polinómica y resultado operativo.',
        'Comunicaciones y Procura: Actas de reunión, cuadernos de obra, transmittal, submittal, RFI, procesos logísticos, catálogos, hojas técnicas, manuales y valorizaciones de servicios de terceros.',
    ],

    // 3. Temario del curso (6 bloques oficiales según página 2 del documento oficial)
    'syllabus_intro'      => 'El contenido del programa aborda los aspectos esenciales de la Oficina Técnica en proyectos de obras viales estructurado en 6 bloques temáticos:',
    'syllabus'            => [
        [
            'title'   => 'Gestión de la Integración',
            'icon'    => 'fa-solid fa-diagram-project',
            'content' => '<ul><li>Contrato de Obra.</li><li>Plan Técnico de Obra.</li></ul>',
        ],
        [
            'title'   => 'Alcance',
            'icon'    => 'fa-solid fa-layer-group',
            'content' => '<ul><li>Memoria Descriptiva.</li><li>Planos y Especificaciones.</li><li>Metrados, Solicitudes de Adelanto.</li><li>Valorizaciones.</li><li>Adicionales.</li><li>Deductivos.</li></ul>',
        ],
        [
            'title'   => 'Plazo',
            'icon'    => 'fa-solid fa-calendar-check',
            'content' => '<ul><li>Cronograma de Obra.</li><li>Avance Valorizado.</li><li>Curva S.</li><li>Solicitudes de Ampliaciones de Plazo.</li><li>Last Planner System.</li></ul>',
        ],
        [
            'title'   => 'Costo',
            'icon'    => 'fa-solid fa-coins',
            'content' => '<ul><li>Presupuesto Contractual.</li><li>Presupuesto Interno.</li><li>Presupuesto Meta.</li><li>Fórmula Polinómica.</li><li>Resultado Operativo.</li></ul>',
        ],
        [
            'title'   => 'Comunicaciones',
            'icon'    => 'fa-solid fa-comments',
            'content' => '<ul><li>Actas de Reunión.</li><li>Cuadernos de Obra.</li><li>Transmittal, Submittal, RFI.</li></ul>',
        ],
        [
            'title'   => 'Procura',
            'icon'    => 'fa-solid fa-truck-ramp-box',
            'content' => '<ul><li>Proceso Logístico.</li><li>Catálogos, Hojas Técnicas, Manuales.</li><li>Valorizaciones de Servicios de Terceros.</li></ul>',
        ],
    ],

    // 4. Perfil docente (Ing. Martín Ortiz - Páginas 1 y 4 del documento oficial)
    'docente'             => [
        'photo'          => 'img/docentes/martin-ortiz.png',
        'photo_webp'     => 'img/docentes/martin-ortiz.webp',
        'photo_alt'      => 'Ing. Martín Ortiz, docente de Oficina Técnica en Obras Viales',
        'alt'            => 'Ing. Martín Ortiz, docente de Oficina Técnica en Obras Viales',
        'name'           => 'Ing. Martín Ortiz',
        'experience_tag' => '+20 años de experiencia',
        'credentials'    => ['Ing. Civil', 'PMP®', 'Egresado UNI', 'Colegiado'],
        'summary'        => 'Ingeniero Civil con más de 20 años de experiencia en Obras Viales, Edificaciones, Infraestructura y Obras Hospitalarias. Egresado de la Universidad Nacional de Ingeniería, Colegiado, Diplomado Especializado en Planificación y Control de Proyectos de Construcción.',
        'highlights'     => [
            '<strong>Experiencia en Oficina Técnica:</strong> Gestión de contratos públicos y privados, implementación de herramientas de seguimiento y control.',
            '<strong>Gerenciamiento y Control:</strong> Planificación y control de proyectos hospitalarios, edificaciones, obras viales y mantenimientos viales.',
            '<strong>Sistema Integrado de Gestión:</strong> Conocimiento y aplicación en proyectos ejecutados a nivel nacional.',
        ],
        'full_bio_items' => [
            '<strong>PDCI Peruana de Construcción e Infraestructura:</strong> Coordinador de Propuestas.',
            '<strong>Consorcio Agua SCM:</strong> Jefe de Oficina Técnica.',
            '<strong>INCOT:</strong> Oficina Técnica.',
            '<strong>COCO Ingenieros SAC:</strong> Gerente General.',
            '<strong>ICCGSA:</strong> Responsable del Planeamiento y Control General de Proyectos - Gerencia Técnica.',
        ],
        'recognition'    => 'Profesional PMP® con amplia trayectoria en la dirección técnica, planeamiento y control integral de obras públicas y privadas en diversas regiones del país.',
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
    'hours'               => '16 horas netas',
    'pdu_count'           => '16 PDU',
    'duration_hours'      => '16 horas netas',
    'pdu_heading'         => 'Unidades de desarrollo profesional (16 PDU)',
    'pdu_title'           => 'Unidades de desarrollo profesional (16 PDU)',
    'pdu_text'            => 'Si tienes certificación del PMI®, este curso te brinda 16 PDU (<em>Professional Development Unit</em>) para mantener tu certificación según la descripción provista por el PMI®: Categoría PMI® CCR: <em>General Education Third-Party Provider</em> – The PMI Talent Triangle®. Duración total: <strong>16 horas netas</strong>.',

    // 7. Información e inscripción (Sin brochure público)
    'enroll_bg_image'     => 'img/capacitaciones/oficina-tecnica-obras-viales.webp',
    'whatsapp_url'        => 'https://api.whatsapp.com/send?phone=51993463118&text=' . urlencode('Hola Quality Consulting Solutions, deseo solicitar información sobre el curso de Oficina Técnica en Obras Viales.'),
    'whatsapp_btn_text'   => 'Solicitar información por WhatsApp',
    'modal_service'       => 'Oficina Técnica en Obras Viales',
    'paypal_slug'         => 'oficina-tecnica-obras-viales',
    'first_class_label'   => 'Primera clase del curso – USD 10',
    'back_area_url'       => '/capacitacion-oficina-tecnica',
    'back_area_title'     => 'Volver al Área de Oficina Técnica',
    'videos'              => [],
];

echo $this->partial('course_detail_unified', ['course' => $course]);
