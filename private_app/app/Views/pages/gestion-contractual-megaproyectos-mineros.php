<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Gestión Contractual en los Megaproyectos de Construcción Mineros
 * Archivo: app/Views/pages/gestion-contractual-megaproyectos-mineros.php
 *
 * Basado en la estructura unificada aprobada: app/Views/partials/course_detail_unified.php
 * Contenido auditado estrictamente contra el documento oficial externo:
 * D:\Descargas D\Brouchure\Gestion de contratos\Brochure MEGAPROYECTOS - Mineros.pdf
 */

declare(strict_types=1);

$course = [
    // 1. Hero Banner
    'hero_badge'          => 'GESTIÓN DE CONTRATOS • 16 HORAS NETAS • 12 PDU',
    'hero_badge_icon'     => 'fa-solid fa-file-contract',
    'title'               => 'GESTIÓN CONTRACTUAL EN LOS MEGAPROYECTOS DE CONSTRUCCIÓN MINEROS',
    'summary'             => 'Aplicación de principios de gestión de contratos de construcción en su formación y gestión integral, técnicas de negociación, mitigación de riesgos y resolución de disputas.',
    'hero_cards'          => [
        [
            'icon'  => 'fa-solid fa-file-circle-check',
            'title' => 'FORMACIÓN CONTRACTUAL',
            'desc'  => 'Conceptos básicos, requerimientos iniciales, estrategias y responsabilidades del administrador de contratos.',
        ],
        [
            'icon'  => 'fa-solid fa-handshake',
            'title' => 'NEGOCIACIÓN & CLÁUSULAS',
            'desc'  => 'Estrategias de negociación, tipos de contratos, cláusulas comunes y elaboración de documentos contractuales.',
        ],
        [
            'icon'  => 'fa-solid fa-list-check',
            'title' => 'SUPERVISIÓN & CONTROL',
            'desc'  => 'Seguimiento del cumplimiento y progreso del trabajo, control de costos, plazos y comunicación efectiva.',
        ],
        [
            'icon'  => 'fa-solid fa-shield-halved',
            'title' => 'RIESGOS & DISPUTAS',
            'desc'  => 'Administración de cambios, seguros, fianzas, garantías, resolución de disputas y liquidación de contratos.',
        ],
    ],

    // 2. Objetivo del curso (Página 2 del documento oficial)
    'objective'           => 'Aplicar principios básicos de gestión de contratos de construcción en su formación y gestión integral, ejecutar técnicas de negociación, administrar contratos eficientemente, identificar y mitigar riesgos y resolver conflictos profesionalmente.',
    'objective_image'     => 'img/capacitaciones/gestion-contractual-megaproyectos-mineros.png',
    'objective_image_webp'=> 'img/capacitaciones/gestion-contractual-megaproyectos-mineros.webp',
    'objective_image_alt' => 'Capacitación Gestión Contractual en los Megaproyectos de Construcción Mineros',
    'objective_highlights'=> [
        'Formación y Negociación Contractual: Comprensión de los conceptos básicos, requerimientos iniciales, estrategias de formación y técnicas efectivas de negociación de contratos.',
        'Supervisión y Control de Cumplimiento: Seguimiento riguroso del cumplimiento contractual, avance del trabajo, control de costos y plazos en megaproyectos de construcción.',
        'Administración de Cambios y Resolución de Disputas: Identificación y mitigación de riesgos, seguros, fianzas, garantías, procedimientos de reclamación, arbitraje y liquidación de contratos.',
    ],

    // 3. Temario del curso (6 bloques oficiales según página 2 del documento oficial)
    'syllabus_intro'      => 'El programa se estructura según los seis bloques temáticos oficiales del curso:',
    'syllabus'            => [
        [
            'title'   => 'Introducción a la Gerencia de Contratos de Construcción',
            'icon'    => 'fa-solid fa-book-open',
            'content' => '<ul><li>Conceptos básicos de contratos de construcción.</li><li>Tipos de contratos y sus características.</li><li>Importancia de la gestión de contratos en proyectos de construcción.</li><li>Responsabilidades del administrador de contratos.</li></ul>',
        ],
        [
            'title'   => 'Formación de Contratos',
            'icon'    => 'fa-solid fa-file-circle-check',
            'content' => '<ul><li>Necesidad del Proyecto.</li><li>Requerimientos iniciales.</li><li>Estrategias de Formación.</li><li>Gestión del Equipo de Proyecto para la formación de un Contrato.</li></ul>',
        ],
        [
            'title'   => 'Preparación y Negociación de Contratos',
            'icon'    => 'fa-solid fa-handshake',
            'content' => '<ul><li>Análisis de requisitos del proyecto.</li><li>Estrategias de negociación.</li><li>Tipos de contratos y cláusulas comunes.</li><li>Elaboración de documentos contractuales.</li></ul>',
        ],
        [
            'title'   => 'Supervisión del Cumplimiento Contractual',
            'icon'    => 'fa-solid fa-list-check',
            'content' => '<ul><li>Seguimiento del cumplimiento contractual.</li><li>Seguimiento del progreso del trabajo.</li><li>Control de costos y plazos.</li><li>Comunicación efectiva con las partes interesadas.</li></ul>',
        ],
        [
            'title'   => 'Gestión de Riesgos y Administración de Cambios en Contratos',
            'icon'    => 'fa-solid fa-shield-halved',
            'content' => '<ul><li>Identificación y evaluación de riesgos.</li><li>Administración de cambios en el contrato.</li><li>Estrategias de mitigación de riesgos.</li><li>Seguro y fianzas en contratos de construcción.</li><li>Garantías principales.</li></ul>',
        ],
        [
            'title'   => 'Resolución de Disputas y Cierre de Contratos',
            'icon'    => 'fa-solid fa-scale-balanced',
            'content' => '<ul><li>Métodos alternativos de resolución de disputas.</li><li>Procedimientos de reclamación y arbitraje.</li><li>Cierre y liquidación de contratos.</li></ul>',
        ],
    ],

    // 4. Perfil docente (Ing. Tomás La Rosa Sánchez - Páginas 1 y 4 del documento oficial)
    // Cifra de años omitida debido a la discrepancia entre "+25 años" (portada) y "quince años" (perfil)
    'docente'             => [
        'photo'          => 'img/docentes/tomas-la-rosa-sanchez.png',
        'photo_webp'     => 'img/docentes/tomas-la-rosa-sanchez.webp',
        'photo_alt'      => 'Ing. Tomás La Rosa Sánchez, docente de Gestión Contractual en los Megaproyectos de Construcción Mineros',
        'alt'            => 'Ing. Tomás La Rosa Sánchez, docente de Gestión Contractual en los Megaproyectos de Construcción Mineros',
        'name'           => 'Ing. Tomás La Rosa Sánchez',
        'experience_tag' => 'Especialista en Gestión Contractual y Megaproyectos',
        'credentials'    => ['Ingeniero Metalúrgico y de Materiales', 'MSc Supply Chain Management', 'MBA ESAN Mención Finanzas'],
        'summary'        => 'Ingeniero Metalúrgico y de Materiales de la Universidad de Lima, Master of Science en Supply Chain Management y Tecnología de la Universidad Ramon Llull – La Salle y Magíster en Administración de Negocios de ESAN con mención en Finanzas. Dominio de procesos de gestión en administración de proyectos, operaciones y supply chain management. Especialista en negociación y abastecimiento de equipos y servicios minero-metalúrgicos y de construcción en megaproyectos.',
        'highlights'     => [
            '<strong>Gestión Contractual en Megaproyectos:</strong> Trayectoria directiva en corporaciones globales líderes de ingeniería y construcción, incluyendo Fluor Corporation, Bechtel Corporation, Jacobs y Barrick Gold Corporation.',
            '<strong>Negociación y Cadena de Suministros:</strong> Dominio de procesos integrales de gestión de proyectos, operaciones, negociación contractual y abastecimiento estratégico de equipos y servicios para minería y construcción.',
            '<strong>Sólida Formación Multidisciplinaria:</strong> M.Sc. en Supply Chain Management y Tecnología por la Universidad Ramon Llull – La Salle, MBA de ESAN con mención en Finanzas e Ingeniero Metalúrgico y de Materiales por la Universidad de Lima.',
        ],
        'full_bio_items' => [
            '<strong>Formación Académica de Postgrado:</strong> Master of Science en Supply Chain Management y Tecnología de la Universidad Ramon Llull – La Salle; Magíster en Administración de Negocios de ESAN con Mención en Finanzas.',
            '<strong>Formación Profesional de Base:</strong> Ingeniero Metalúrgico y de Materiales graduado de la Universidad de Lima.',
            '<strong>Fluor Corporation:</strong> Gerencia Senior de Contratos, Especialista Senior de Reclamos y Administrador Senior de Contratos.',
            '<strong>NewFields Project & Construction Management:</strong> Lead Contract Administrator.',
            '<strong>Barrick Gold Corporation:</strong> Superintendente de Contratos.',
            '<strong>Jacobs:</strong> Gerencia Senior de Contratos.',
            '<strong>SSK Montajes e Instalaciones S.A.C.:</strong> Sub Gerente de Contratos.',
            '<strong>Doe Run Peru:</strong> Líder de Procura / Cadena de Suministros.',
            '<strong>Bechtel Corporation:</strong> Administrador Senior de Contratos.',
        ],
        'recognition'    => 'Destacado especialista en administración contractual, evaluación de reclamos, negociación estratégica y gestión de compras y suministros en megaproyectos minero-metalúrgicos y de infraestructura en empresas nacionales y multinacionales.',
    ],

    // 5. Beneficios oficiales (Página 3 del documento oficial)
    'benefits'            => [
        [
            'icon'  => 'fa-solid fa-user-tie',
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
            'text'  => 'Diploma digital a nombre de Quality Consulting Solutions incluido en el precio.',
        ],
        [
            'icon'  => 'fa-regular fa-file-lines',
            'title' => 'Material digital',
            'text'  => 'Entrega de material digital incluido en el precio.',
        ],
        [
            'icon'  => 'fa-regular fa-circle-play',
            'title' => 'Grabación del curso',
            'text'  => 'Acceso por internet a la grabación del curso luego de finalizado (4 semanas).',
        ],
    ],

    // 6. Datos de PDU y duración (Páginas 2 y 3 del documento oficial)
    'pdu'                 => '12 PDU',
    'hours'               => '16 horas netas',
    'pdu_count'           => '12 PDU',
    'duration_hours'      => '16 horas netas',
    'pdu_heading'         => 'Unidades de desarrollo profesional (12 PDU)',
    'pdu_title'           => 'Unidades de desarrollo profesional (12 PDU)',
    'pdu_text'            => 'Si ya tienes certificación del PMI® este curso te brinda 12 PDU (<em>Professional Development Unit</em>) para mantener vigente tu certificación según la descripción provista por el PMI®: Categoría PMI® CCR: <em>General Education Third-Party Provider – The PMI Talent Triangle®</em>. Duración total: <strong>16 horas netas</strong>.',

    // 7. Información e inscripción (Sin brochure público)
    'enroll_bg_image'     => 'img/capacitaciones/gestion-contractual-megaproyectos-mineros.webp',
    'whatsapp_url'        => 'https://api.whatsapp.com/send?phone=51993463118&text=' . urlencode('Hola Quality Consulting Solutions, deseo solicitar información sobre el curso de Gestión Contractual en los Megaproyectos de Construcción Mineros.'),
    'whatsapp_btn_text'   => 'Solicitar información por WhatsApp',
    'modal_service'       => 'Gestión Contractual en los Megaproyectos de Construcción Mineros',
    'paypal_slug'         => 'gestion-contractual-megaproyectos-mineros',
    'first_class_label'   => 'Primera clase del curso – USD 10',
    'back_area_url'       => '/capacitacion-contratos',
    'back_area_title'     => 'Volver a Gestión de Contratos',
    'videos'              => [],
];

echo $this->partial('course_detail_unified', ['course' => $course]);
