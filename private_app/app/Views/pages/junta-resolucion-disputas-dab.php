<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Claves para el Éxito en la Junta de Resolución de Disputas - JRD (DAB) de Obras
 * Archivo: app/Views/pages/junta-resolucion-disputas-dab.php
 *
 * Basado en la estructura unificada aprobada: app/Views/partials/course_detail_unified.php
 * Contenido auditado estrictamente contra el documento oficial externo:
 * D:\Descargas D\Brouchure\Gestion de contratos\Brochure DAB.pdf
 */

declare(strict_types=1);

$course = [
    // 1. Hero Banner
    'hero_badge'          => 'GESTIÓN DE CONTRATOS • 16 HORAS NETAS • 8 SESIONES • 16 PDU',
    'hero_badge_icon'     => 'fa-solid fa-scale-balanced',
    'title'               => 'CLAVES PARA EL ÉXITO EN LA JUNTA DE RESOLUCIÓN DE DISPUTAS - JRD (DAB) DE OBRAS',
    'summary'             => 'Mecanismos de prevención, asistencia temprana y resolución de controversias con Dispute Adjudication Boards (DAB) en contratos de construcción, NEC, FIDIC y regulación ICC.',
    'hero_cards'          => [
        [
            'icon'  => 'fa-solid fa-gavel',
            'title' => 'JRD (DAB) EN OBRAS',
            'desc'  => 'Definición, propósito, prerrogativas, esquema de gobernanza y flujo de comunicación de la JRD.',
        ],
        [
            'icon'  => 'fa-solid fa-comments',
            'title' => 'HERRAMIENTAS & PROCESO',
            'desc'  => 'Consulta informal, hoja de ruta, preguntas poderosas y definición de la causa raíz de la controversia.',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '16 HORAS & 16 PDU',
            'desc'  => '16 horas netas en 8 sesiones y 16 PDU en la categoría General Education Third-Party Provider del PMI®.',
        ],
        [
            'icon'  => 'fa-solid fa-file-contract',
            'title' => 'CONTRATOS NEC & FIDIC',
            'desc'  => 'Casuística real en acuerdos Gobierno a Gobierno (G2G NEC3) y proyectos públicos bajo contratos FIDIC.',
        ],
    ],

    // 2. Objetivo del curso (Página 2 del documento oficial)
    'objective'           => 'Brindar las características y propósitos de la Junta de Resolución de Disputas (Dispute Adjudication Board - DAB) para obtener el mejor provecho de este órgano resolutivo ya sea del lado del contratista y/o del cliente. En ese sentido, el programa está orientado para los usuarios de DAB y los proyectos que prevén incorporar este órgano en su marco de gobernanza.',
    'objective_image'     => 'img/capacitaciones/junta-resolucion-disputas-dab.png',
    'objective_image_webp'=> 'img/capacitaciones/junta-resolucion-disputas-dab.webp',
    'objective_image_alt' => 'Claves para el Éxito en la Junta de Resolución de Disputas - JRD (DAB) de Obras',
    'objective_highlights'=> [
        'Gobernanza y Prerrogativas de la JRD: Definición, propósito, esquema de gobernanza, prerrogativas y diferencias sustanciales frente a la conciliación y el arbitraje.',
        'Herramientas de Previsión y Asistencia: Aplicación de consultas informales, reuniones de hoja de ruta, preguntas poderosas e identificación de la causa raíz para evitar recurrencias.',
        'Regulación y Experiencias Reales: Normativa contractual e ICC junto con análisis de casos prácticos en proyectos G2G bajo contratos NEC3 y obras públicas bajo contratos FIDIC.',
    ],

    // 3. Temario del curso (6 bloques oficiales según página 2 del documento oficial)
    'syllabus_intro'      => 'El programa se estructura según el contenido oficial del Dispute Adjudication Board (DAB):',
    'syllabus'            => [
        [
            'title'   => 'Junta de Resolución de Disputas - JRD (DAB)',
            'icon'    => 'fa-solid fa-scale-balanced',
            'content' => '<ul><li>Definición, propósito y prerrogativas de la JRD.</li><li>Configuración y esquema de gobernanza.</li><li>Flujo de comunicación de la Junta de Resolución de Disputas (Dispute Board; Dispute Adjudication Board).</li></ul>',
        ],
        [
            'title'   => 'Diferencias entre la JRD, Conciliación y Arbitraje',
            'icon'    => 'fa-solid fa-code-compare',
            'content' => '<ul><li>Principales diferencias entre los mecanismos de resolución de controversias.</li><li>Propósitos y filosofía de intervención.</li><li>Etapa de aplicación y alcances específicos.</li></ul>',
        ],
        [
            'title'   => 'Herramientas y Proceso de la JRD',
            'icon'    => 'fa-solid fa-toolbox',
            'content' => '<ul><li>Herramientas y procesos aplicables a la actuación de la JRD sobre previsión, asistencia y resolución:</li><li><strong>Consulta informal:</strong> Preguntas de exploración primaria para pre-contextualizar la controversia o puntos iniciales de desacuerdo.</li><li><strong>Reunión de las partes para la hoja de ruta:</strong> Para ayudar a las partes en el entendimiento común de la controversia y definir los puntos a aclarar en la JRD para resolver las disputas.</li><li><strong>Preguntas poderosas:</strong> Preguntas de exploración profunda de la JRD a las partes para identificar y mapear puntos de controversia y contextualizar el caso.</li><li><strong>Definición del problema:</strong> Ayudar a las partes a asegurar un entendimiento común mediante la identificación de la causa raíz del problema para evitar la recurrencia.</li></ul>',
        ],
        [
            'title'   => 'Regulación de las JRD',
            'icon'    => 'fa-solid fa-book-bookmark',
            'content' => '<ul><li>Regulación de las JRD vía configuración contractual y/o ICC (International Chamber of Commerce).</li><li>Actuaciones de prevención, asistencia y resolución vía configuración contractual.</li></ul>',
        ],
        [
            'title'   => 'Experiencias de Aplicación de la JRD en Contratos NEC',
            'icon'    => 'fa-solid fa-file-contract',
            'content' => '<ul><li>Presentación de casos en el contexto de los New Engineering Contract (NEC3).</li><li>Aplicación en el marco de proyectos del acuerdo Gobierno a Gobierno (G2G).</li></ul>',
        ],
        [
            'title'   => 'Experiencias de Aplicación de la JRD en Contratos FIDIC',
            'icon'    => 'fa-solid fa-building-columns',
            'content' => '<ul><li>Presentación de casos en el contexto de los contratos FIDIC (Fédération Internationale des Ingénieurs-Conseils).</li><li>Aplicación práctica en proyectos públicos.</li></ul>',
        ],
    ],

    // 4. Perfil docente (Ing. Luis Ruiz - Páginas 1 y 4 del documento oficial)
    'docente'             => [
        'photo'          => 'img/docentes/luis-ruiz.png',
        'photo_webp'     => 'img/docentes/luis-ruiz.webp',
        'photo_alt'      => 'Ing. Luis Ruiz, docente de Junta de Resolución de Disputas (DAB) en Obras',
        'alt'            => 'Ing. Luis Ruiz, docente de Junta de Resolución de Disputas (DAB) en Obras',
        'name'           => 'Ing. Luis Ruiz',
        'experience_tag' => 'Más de 30 años de experiencia',
        'credentials'    => ['MBA', 'Ingeniero Civil', 'Adjudicador DAB Panamericanos 2019', 'Presidente DAB ARCC'],
        'summary'        => 'Profesional con más de 30 años en gerencia de proyectos y gestión contractual. Miembro de la Junta de Resolución de Disputas (DAB – Dispute Adjudication Board) de los Panamericanos Lima 2019, miembro y presidente de DAB’s en la Autoridad de la Reconstrucción con Cambios (ARCC). Experiencia docente en principales universidades y ponente en prestigiosos congresos.',
        'highlights'     => [
            '<strong>Adjudicador DAB en Panamericanos y ARCC:</strong> Miembro de la Junta de Resolución de Disputas (DAB) de los Juegos Panamericanos Lima 2019 y presidente de DAB’s en proyectos de la Autoridad de la Reconstrucción con Cambios (ARCC).',
            '<strong>Consultoría Contractual y Peritajes:</strong> Gerente General en Laurus Group, especializado en debida diligencia contractual, evaluación de reclamos y peritajes en el sector construcción.',
            '<strong>Liderazgo y Gestión en Megaproyectos:</strong> Ex Director en Wescon Ingeniería y Construcción, Gerente de Línea de Obras Civiles en Obrainsa, y Gerente de Proyectos de Infraestructura, Recursos Humanos y Desarrollo Inmobiliario en Cosapi S.A.',
        ],
        'full_bio_items' => [
            '<strong>Laurus Group:</strong> Gerente General. Empresa de servicios de consultoría especializados en el sector construcción, enfocados en evaluar la debida diligencia contractual de proyectos, reclamos y peritajes.',
            '<strong>Wescon Ingeniería y Construcción:</strong> Director. Grupo inmobiliario con más de 12 años de trayectoria en el mercado peruano, teniendo en su haber una amplia cartera de proyectos exitosos.',
            '<strong>Obrainsa:</strong> Gerente de Línea de Negocio de Obras Civiles. Responsable de gestionar el portafolio de proyectos de infraestructura pesada no vial.',
            '<strong>Cosapi S.A.:</strong> Gerente de Desarrollo Inmobiliario. Responsable de desarrollar el negocio inmobiliario en Cosapi. Estructuración del Plan de Negocio y Análisis del Mercado.',
            '<strong>Cosapi S.A.:</strong> Gerente de Recursos Humanos. Responsable de formular e implementar las estrategias de Recursos Humanos en las líneas de atracción, retención y desarrollo del capital Humano.',
            '<strong>Cosapi S.A.:</strong> Gerente de Proyectos de la unidad de Infraestructura, con participación en los proyectos más emblemáticos de la Empresa.',
        ],
        'recognition'    => 'Ingeniero Civil con MBA y más de 30 años de trayectoria especializada en gerencia de proyectos de infraestructura pesada, gestión contractual, gobernanza de proyectos y liderazgo como adjudicador de Juntas de Resolución de Disputas (DAB).',
    ],

    // 5. Beneficios oficiales (Página 3 del documento oficial)
    'benefits'            => [
        [
            'icon'  => 'fa-solid fa-percent',
            'title' => 'Descuentos futuros',
            'text'  => 'Descuento para futuros cursos con precios ordinarios.',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => 'Asignación de PDU',
            'text'  => 'Certificación de 16 PDU (PMI®) para quienes ya posean certificación del PMI®.',
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
            'text'  => 'Acceso vía internet a la grabación del curso luego de finalizado (6 semanas).',
        ],
    ],

    // 6. Datos de PDU y duración (Páginas 2 y 3 del documento oficial)
    'pdu'                 => '16 PDU',
    'hours'               => '16 horas netas',
    'pdu_count'           => '16 PDU',
    'duration_hours'      => '16 horas netas',
    'sessions'            => '8 sesiones',
    'pdu_heading'         => 'Unidades de desarrollo profesional (16 PDU)',
    'pdu_title'           => 'Unidades de desarrollo profesional (16 PDU)',
    'pdu_text'            => 'Si ya tienes certificación del PMI® este curso te brinda 16 PDU (<em>Professional Development Unit</em>) para mantener vigente tu certificación según la descripción provista por el PMI®: Categoría PMI® CCR: <em>General Education Third-Party Provider – The PMI Talent Triangle®</em>. Duración total: <strong>16 horas netas</strong> distribuidas en <strong>8 sesiones</strong>.',

    // 7. Información e inscripción (Sin brochure público)
    'enroll_bg_image'     => 'img/capacitaciones/junta-resolucion-disputas-dab.webp',
    'whatsapp_url'        => 'https://api.whatsapp.com/send?phone=51993463118&text=' . urlencode('Hola Quality Consulting Solutions, deseo solicitar información sobre el curso de Claves para el Éxito en la Junta de Resolución de Disputas - JRD (DAB) de Obras.'),
    'whatsapp_btn_text'   => 'Solicitar información por WhatsApp',
    'modal_service'       => 'Claves para el Éxito en la Junta de Resolución de Disputas - JRD (DAB) de Obras',
    'paypal_slug'         => 'junta-resolucion-disputas-dab',
    'first_class_label'   => 'Primera clase del curso – USD 10',
    'back_area_url'       => '/capacitacion-contratos',
    'back_area_title'     => 'Volver a Gestión de Contratos',
    'videos'              => [],
];

echo $this->partial('course_detail_unified', ['course' => $course]);
