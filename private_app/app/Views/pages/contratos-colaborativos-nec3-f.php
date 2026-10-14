<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Contratos Colaborativos NEC3-F
 * Archivo: app/Views/pages/contratos-colaborativos-nec3-f.php
 *
 * Basado en la estructura unificada aprobada: app/Views/partials/course_detail_unified.php
 * Contenido auditado estrictamente contra el documento oficial externo:
 * D:\Descargas D\Brouchure\Gestion de contratos\Brochure CONTRATOS NEC-3F.pdf
 */

declare(strict_types=1);

$course = [
    // 1. Hero Banner
    'hero_badge'          => 'GESTIÓN DE CONTRATOS • 14 HORAS NETAS • 14 PDU',
    'hero_badge_icon'     => 'fa-solid fa-file-contract',
    'title'               => 'CONTRATOS COLABORATIVOS NEC3-F',
    'summary'             => 'Marco integral de la gestión contractual en proyectos de construcción basado en el modelo colaborativo NEC3-F: Project Delivery System, distribución balanceada de riesgos, gestión del cambio y Last Planner® System.',
    'hero_cards'          => [
        [
            'icon'  => 'fa-solid fa-compass',
            'title' => 'VISIÓN HOLÍSTICA',
            'desc'  => 'Origen y filosofía colaborativa de contratos NEC, tipos de opciones y management contracting at risk.',
        ],
        [
            'icon'  => 'fa-solid fa-diagram-project',
            'title' => 'PROJECT DELIVERY',
            'desc'  => 'Enfoque colaborativo vs. design-bid-build, proyectos EPCM, variantes y riesgos del diseño.',
        ],
        [
            'icon'  => 'fa-solid fa-scale-balanced',
            'title' => 'DISTRIBUCIÓN DE RIESGOS',
            'desc'  => 'Principios de Abrahamson y Bunni, ranking de riesgos, confianza mutua, DAB y tribunal arbitral.',
        ],
        [
            'icon'  => 'fa-solid fa-clipboard-check',
            'title' => 'GESTIÓN DEL CAMBIO & LPS',
            'desc'  => 'Cláusulas clave del NEC3-F, Last Planner® System, debida diligencia técnica y análisis de retrasos.',
        ],
    ],

    // 2. Objetivo del curso (Página 2 del documento oficial)
    'objective'           => 'Brindar a los participantes el marco principal de la gestión de contratos en proyectos de construcción basado en el modelo de contrato colaborativo NEC3-F (NEC3 option F), el contrato usado exitosamente para los Juegos Panamericanos Lima 2019 y en la Reconstrucción con Cambios del Gobierno del Perú.',
    'objective_image'     => 'img/capacitaciones/contratos-colaborativos-nec3-f.png',
    'objective_image_webp'=> 'img/capacitaciones/contratos-colaborativos-nec3-f.webp',
    'objective_image_alt' => 'Capacitación Contratos Colaborativos NEC3-F',
    'objective_highlights'=> [
        'Filosofía Colaborativa y Gestión de Riesgos: Comprensión profunda de la cooperación mutua, comportamientos observables y aplicación de los principios de Abrahamson y Bunni para un reparto balanceado de contingencias.',
        'Administración de Cláusulas y Control del Cambio: Dominio de las cláusulas contractuales clave de la Opción F de NEC3 para gestionar eventos, condiciones y modificaciones del alcance con debida diligencia técnica.',
        'Integración con Last Planner® y Análisis Contractual: Articulación del análisis de restricciones con la gestión contractual, desempeño del cronograma, valor ganado y evaluación de retrasos por métodos modelados y observacionales.',
    ],

    // 3. Temario del curso (7 bloques oficiales según página 2 del documento oficial)
    'syllabus_intro'      => 'El programa se estructura según los siete bloques temáticos oficiales del curso:',
    'syllabus'            => [
        [
            'title'   => 'Visión Holística del Contrato NEC3-F',
            'icon'    => 'fa-solid fa-compass',
            'content' => '<ul><li>Reseña y origen de los contratos NEC.</li><li>Los tipos de opciones y su aplicación.</li></ul>',
        ],
        [
            'title'   => 'Project Delivery System',
            'icon'    => 'fa-solid fa-diagram-project',
            'content' => '<ul><li>Contexto actual, el enfoque design – bid – build y el enfoque colaborativo.</li><li>Los tipos de proyectos EPCM y sus variantes.</li><li>Los riesgos del diseño.</li><li>El contrato NEC 3 y la Opción F y el management contracting at risk.</li></ul>',
        ],
        [
            'title'   => 'Filosofía que Incentiva la Confianza y Cooperación Mutua',
            'icon'    => 'fa-solid fa-handshake',
            'content' => '<ul><li>La filosofía colaborativa.</li><li>Los comportamientos objetivos y observables.</li><li>Mecanismos alternativos de resolución de disputas.</li><li>La junta de resolución de disputas (Dispute Adjudication Board – DAB) y el tribunal arbitral.</li></ul>',
        ],
        [
            'title'   => 'Distribución Balanceada de Riesgos',
            'icon'    => 'fa-solid fa-shield-halved',
            'content' => '<ul><li>Riesgos propios de los proyectos de construcción.</li><li>Riesgos del negocio y tendencias.</li><li>Los principios de Abrahamson y los principios de Bunni.</li><li>Definición de la importancia (ranking) del riesgo y su tipificación.</li><li>Registro de la revisión del contrato.</li></ul>',
        ],
        [
            'title'   => 'Cláusulas Contractuales y la Gestión del Cambio',
            'icon'    => 'fa-solid fa-file-contract',
            'content' => '<ul><li>Cláusulas claves del contrato NEC 3F.</li><li>Gestión de los cambios del alcance (eventos; condiciones) y sus momentos.</li></ul>',
        ],
        [
            'title'   => 'Last Planner® System en la Gestión Contractual Colaborativa',
            'icon'    => 'fa-solid fa-list-check',
            'content' => '<ul><li>Criterios generales para la gestión eficiente de los cambios.</li><li>La debida diligencia técnica.</li><li>La relación entre el análisis de restricciones y la gestión contractual.</li></ul>',
        ],
        [
            'title'   => 'Análisis Contractual',
            'icon'    => 'fa-solid fa-chart-line',
            'content' => '<ul><li>Análisis del desempeño del cronograma.</li><li>Valor ganado.</li><li>Análisis de retrasos del proyecto vía métodos modelados y observacionales.</li><li>Análisis del desempeño del proyecto.</li></ul>',
        ],
    ],

    // 4. Perfil docente (Ing. Luis Ruiz - Páginas 1 y 4 del documento oficial)
    'docente'             => [
        'photo'          => 'img/docentes/luis-ruiz.png',
        'photo_webp'     => 'img/docentes/luis-ruiz.webp',
        'photo_alt'      => 'Ing. Luis Ruiz, MBA, docente de Contratos Colaborativos NEC3-F',
        'alt'            => 'Ing. Luis Ruiz, MBA, docente de Contratos Colaborativos NEC3-F',
        'name'           => 'Ing. Luis Ruiz',
        'experience_tag' => 'Especialista en Contratos Colaborativos y Gestión Contractual',
        'credentials'    => ['MBA', 'Ing. Civil'],
        'summary'        => 'Profesional con más de 25 años en gerencia de proyectos y gestión contractual. Miembro de la Junta de Resolución de Disputas (DAB – Dispute Adjudication Board) de los Juegos Panamericanos Lima 2019, así como miembro y presidente de DABs en la Autoridad para la Reconstrucción con Cambios (ARCC). Amplia experiencia docente en principales universidades y ponente en prestigiosos congresos del sector construcción.',
        'highlights'     => [
            '<strong>Liderazgo en Megaproyectos Colaborativos:</strong> Experiencia directa como miembro del Dispute Adjudication Board (DAB) en los Juegos Panamericanos Lima 2019 y presidente de DABs en proyectos de la Autoridad para la Reconstrucción con Cambios (ARCC).',
            '<strong>Trayectoria Directiva de Primer Nivel:</strong> Más de 25 años liderando gerencias generales, de proyectos, operaciones y recursos humanos en empresas destacadas de infraestructura, consultoría e inmobiliaria.',
            '<strong>Docencia y Especialización Técnica:</strong> Ponente internacional y docente de postgrado en las principales universidades del país en gestión contractual colaborativa, peritajes y debida diligencia técnica.',
        ],
        'full_bio_items' => [
            '<strong>Laurus Group:</strong> Gerente General. Empresa de servicios de consultoría especializados en el sector construcción, enfocados en evaluar la debida diligencia contractual de proyectos, reclamos y peritajes.',
            '<strong>Wescon Ingeniería y Construcción:</strong> Director. Grupo inmobiliario con más de 12 años de trayectoria en el mercado peruano con una amplia cartera de proyectos exitosos.',
            '<strong>Obrainsa:</strong> Gerente de Línea de Negocio de Obras Civiles. Responsable de gestionar el portafolio de proyectos de infraestructura pesada no vial.',
            '<strong>Cosapi S.A.:</strong> Gerente de Desarrollo Inmobiliario. Responsable de estructuración del plan de negocio y análisis de mercado.',
            '<strong>Cosapi S.A.:</strong> Gerente de Recursos Humanos. Responsable de formular e implementar las estrategias de Recursos Humanos en las líneas de atracción, retención y desarrollo del capital humano.',
            '<strong>Cosapi S.A.:</strong> Gerente de Proyectos de la unidad de Infraestructura, con participación en los proyectos más emblemáticos de la empresa.',
        ],
        'recognition'    => 'MBA e Ingeniero Civil con más de 25 años de trayectoria destacada en gestión contractual colaborativa NEC, dirección de infraestructura de gran escala y resolución de disputas como adjudicador DAB.',
    ],

    // 5. Beneficios oficiales (Página 3 del documento oficial)
    'benefits'            => [
        [
            'icon'  => 'fa-solid fa-user-tie',
            'title' => 'Base laboral',
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
    'pdu'                 => '14 PDU',
    'hours'               => '14 horas netas',
    'pdu_count'           => '14 PDU',
    'duration_hours'      => '14 horas netas',
    'pdu_heading'         => 'Unidades de desarrollo profesional (14 PDU)',
    'pdu_title'           => 'Unidades de desarrollo profesional (14 PDU)',
    'pdu_text'            => 'Si tienes certificación del PMI® este curso te brinda 14 PDU (<em>Professional Development Unit</em>) para mantener tu certificación según la descripción provista por el PMI®: Categorías PMI® CCR: <em>General Education Third-Party Provider</em>, <em>Technical Project Management – The PMI Talent Triangle®</em> y <em>Strategic & Business Management – The PMI Talent Triangle®</em>. Duración total: <strong>14 horas netas</strong>.',

    // 7. Información e inscripción (Sin brochure público)
    'enroll_bg_image'     => 'img/capacitaciones/contratos-colaborativos-nec3-f.webp',
    'whatsapp_url'        => 'https://api.whatsapp.com/send?phone=51993463118&text=' . urlencode('Hola Quality Consulting Solutions, deseo solicitar información sobre el curso Contratos Colaborativos NEC3-F.'),
    'whatsapp_btn_text'   => 'Solicitar información por WhatsApp',
    'modal_service'       => 'Contratos Colaborativos NEC3-F',
    'paypal_slug'         => 'contratos-colaborativos-nec3-f',
    'first_class_label'   => 'Primera clase del curso – USD 10',
    'back_area_url'       => '/capacitacion-contratos',
    'back_area_title'     => 'Volver a Gestión de Contratos',
    'videos'              => [],
];

echo $this->partial('course_detail_unified', ['course' => $course]);
