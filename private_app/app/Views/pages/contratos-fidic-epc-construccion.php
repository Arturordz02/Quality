<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Contratos FIDIC para Contratos EPC y Construcción
 * Archivo: app/Views/pages/contratos-fidic-epc-construccion.php
 *
 * Basado en la estructura unificada aprobada: app/Views/partials/course_detail_unified.php
 * Contenido auditado estrictamente contra el documento oficial externo:
 * D:\Descargas D\Brouchure\Gestion de contratos\Brochure CONTRATOS FIDIC.pdf
 */

declare(strict_types=1);

$course = [
    // 1. Hero Banner
    'hero_badge'          => 'GESTIÓN DE CONTRATOS • 20 HORAS NETAS • 16 PDU',
    'hero_badge_icon'     => 'fa-solid fa-file-contract',
    'title'               => 'CONTRATOS FIDIC PARA CONTRATOS EPC Y CONSTRUCCIÓN',
    'summary'             => 'Comprender la filosofía, conceptos y estructura de la Rainbow Suite FIDIC (Libro Rojo, Libro Amarillo y Libro Plata, ediciones 1999 y 2017) en la práctica internacional y su adecuación al derecho nacional.',
    'hero_cards'          => [
        [
            'icon'  => 'fa-solid fa-book',
            'title' => 'RAINBOW SUITE FIDIC',
            'desc'  => 'Libro Rojo, Libro Amarillo y Libro Plata de la FIDIC en sus ediciones 1999 y 2017.',
        ],
        [
            'icon'  => 'fa-solid fa-scale-balanced',
            'title' => 'GESTIÓN CONTRACTUAL & DERECHO',
            'desc'  => 'Riesgos, variaciones, reclamos, controversias y adecuaciones bajo la legislación peruana.',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '20 HORAS & 16 PDU',
            'desc'  => '20 horas netas de capacitación especializada y 16 PDU en la categoría General Education Third-Party Provider del PMI®.',
        ],
        [
            'icon'  => 'fa-solid fa-briefcase',
            'title' => 'BASE DE DATOS LABORAL',
            'desc'  => 'Ingreso a la base de datos laboral de Quality Consulting Solutions y diploma digital oficial.',
        ],
    ],

    // 2. Objetivo del curso (Página 2 del documento oficial)
    'objective'           => 'En este curso se abordará los contenidos de la Rainbow Suite conformado por el Libro Rojo, Libro Amarillo y Libro Plata de la FIDIC, en cuanto a su estructura general, así como sus aspectos particulares, relevantes y diferenciadores de otros tipos de contratos, ello teniendo en cuenta la versión FIDIC de 1999, y la nueva edición del año 2017. Comprender la filosofía, conceptos y planteamientos de este tipo de modelos de contratos de ingeniería y construcción en la práctica internacional considerando las regulaciones del derecho nacional, lo cual permitirá que puedan realizar una exitosa gestión contractual de proyectos, tanto a nivel nacional e internacional.',
    'objective_image'     => 'img/capacitaciones/contratos-fidic-epc-construccion.png',
    'objective_image_webp'=> 'img/capacitaciones/contratos-fidic-epc-construccion.webp',
    'objective_image_alt' => 'Contratos FIDIC para Contratos EPC y Construcción',
    'objective_highlights'=> [
        'Rainbow Suite (1999 y 2017): Análisis comparativo y estructural del Libro Rojo (Construcción), Libro Amarillo (Planta y Diseño-Construcción) y Libro Plata (EPC / Llave en Mano).',
        'Partes y Cláusulas Clave: Roles y funciones del Cliente, Contratista, Ingeniero y Subcontratistas, gestión de riesgos, variaciones, plazos, pagos, pruebas y resolución.',
        'Reclamos, Controversias y Caso Práctico: Sistema conflictual FIDIC, adecuación a condiciones particulares de acuerdo a la legislación peruana y resolución de casos prácticos.',
    ],

    // 3. Temario del curso (5 bloques oficiales según página 2 del documento oficial)
    'syllabus_intro'      => 'El programa se estructura según el contenido temático oficial de contratos FIDIC:',
    'syllabus'            => [
        [
            'title'   => 'Introducción a los modelos FIDIC',
            'icon'    => 'fa-solid fa-book-open',
            'content' => '<ul><li>Introducción a los modelos FIDIC.</li><li>Estructura del contrato.</li><li>Cláusulas o disposiciones generales.</li><li>Rainbow Suite: Libro Rojo, Libro Amarillo y Libro Plata (ediciones 1999 y 2017).</li></ul>',
        ],
        [
            'title'   => 'Partes Intervinientes',
            'icon'    => 'fa-solid fa-users-gear',
            'content' => '<ul><li>Las Partes (Cliente, Contratista, Ingeniero, Representante del Cliente, Subcontratistas).</li><li>Principales obligaciones y funciones de cada interviniente.</li></ul>',
        ],
        [
            'title'   => 'Cláusulas Principales',
            'icon'    => 'fa-solid fa-file-contract',
            'content' => '<ul><li>Diseño.</li><li>Suspensión y resolución.</li><li>Fuerza mayor o eventos excepcionales.</li><li>Riesgo y responsabilidades.</li><li>Gestión de variaciones y ajustes.</li><li>Inicio, demora, programa y prórroga.</li><li>Precio contractual y pago.</li><li>Pruebas de terminación.</li><li>Recepción de la obra.</li><li>Periodo de garantía de buen rendimiento y responsabilidad por defectos.</li></ul>',
        ],
        [
            'title'   => 'Sistema de Gestión Conflictual FIDIC',
            'icon'    => 'fa-solid fa-scale-balanced',
            'content' => '<ul><li>Gestión de Reclamaciones (Claims).</li><li>Gestión y resolución de Controversias (DAAB / Juntas de Disputas).</li></ul>',
        ],
        [
            'title'   => 'Condiciones Particulares y Derecho Nacional',
            'icon'    => 'fa-solid fa-gavel',
            'content' => '<ul><li>Aspectos a tener en cuenta para posibles adecuaciones en condiciones particulares de acuerdo a la legislación peruana.</li><li>Caso práctico de aplicación real.</li></ul>',
        ],
    ],

    // 4. Perfil docente (Sharon Grados - Páginas 1 y 4 del documento oficial)
    'docente'             => [
        'photo'          => 'img/docentes/sharon-grados.png',
        'photo_webp'     => 'img/docentes/sharon-grados.webp',
        'photo_alt'      => 'Sharon Grados, docente de Contratos FIDIC para EPC y Construcción',
        'alt'            => 'Sharon Grados, docente de Contratos FIDIC para EPC y Construcción',
        'name'           => 'Sharon Grados',
        'experience_tag' => 'Especialista en Contratos FIDIC',
        'credentials'    => ['Abogada', 'Consultora en Infraestructura', 'Especialista en Contratos FIDIC', 'Gestión Pública y Privada'],
        'summary'        => 'Abogada y consultora especialista en infraestructura, construcción y controversias, en gestión pública, privada y contratos FIDIC.',
        'highlights'     => [
            '<strong>Asesoría Contractual en Megaproyectos:</strong> Asesoramiento en la ejecución contractual (Contratos FIDIC y diversos modelos contractuales) del Proyecto de Modernización de la Refinería de Talara con Consorcio Internacional PMC Talara, en gestión de reclamaciones (Claims), prevención y resolución de controversias.',
            '<strong>Arbitrajes y Matrices de Riesgos:</strong> Experiencia en NPG Abogados liderando elaboración y revisión de contratos, matrices de riesgos, negociación, reclamos y conducción de arbitrajes nacionales e internacionales en proyectos de ingeniería, construcción e infraestructura.',
            '<strong>Gestión en Infraestructura y Sector Público:</strong> Gestión contractual y matrices de riesgo en ICCGSA, y miembro del equipo de arbitraje de la Procuraduría Pública del Ministerio de Transportes y Comunicaciones (MTC) en contrataciones con el estado, concesiones y expropiaciones.',
        ],
        'full_bio_items' => [
            '<strong>Consorcio Internacional PMC Talara:</strong> Asesoramiento en la ejecución contractual (Contratos FIDIC y diferentes tipos de contratos) del Proyecto de Modernización de la Refinería de Talara, en la gestión de reclamaciones (Claims), así como en la prevención y resolución de controversias.',
            '<strong>NPG Abogados:</strong> Encargada de la elaboración y revisión de diferentes contratos y matrices de riesgos. Asesoramiento legal en la negociación, ejecución contractual, resolución de reclamos y controversias de diferentes proyectos de construcción e infraestructura. Elaboración de estrategia y conducción de arbitrajes nacionales e internacionales en proyectos de ingeniería, construcción e infraestructura.',
            '<strong>ICCGSA:</strong> Elaboración de matrices de riesgo. Gestión contractual de proyectos de infraestructura. Revisión de contratos civiles y comerciales que se requirieron en obra. Absolución de consultas relacionadas a temas de construcción para los diferentes proyectos de la organización.',
            '<strong>Ministerio de Transportes y Comunicaciones (MTC):</strong> Formó parte del equipo de arbitraje de la procuraduría pública del MTC, encargado de los arbitrajes en contrataciones con el estado, concesiones y expropiaciones.',
            '<strong>Estudio Rivera Abogados:</strong> Renovación e inscripción de empresas participantes en el Registro Nacional de Proveedores. Elaboración de consultas y observaciones a las bases en el proceso de selección. Armado de expedientes de licitación. Investigación de normas relacionadas a las contrataciones públicas para diferentes informes. Consultoría externa respecto a gestión de reclamos en contratos de obras y redacción de apelaciones ante el Tribunal de Contrataciones.',
        ],
        'recognition'    => 'Abogada y consultora de destacada trayectoria en gestión contractual y resolución de controversias bajo contratos FIDIC en megaproyectos de infraestructura, energía y construcción.',
    ],

    // 5. Beneficios oficiales (Página 3 del documento oficial - exactamente los 5 beneficios oficiales)
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
    'hours'               => '20 horas netas',
    'pdu_count'           => '16 PDU',
    'duration_hours'      => '20 horas netas',
    'pdu_heading'         => 'Unidades de desarrollo profesional (16 PDU)',
    'pdu_title'           => 'Unidades de desarrollo profesional (16 PDU)',
    'pdu_text'            => 'Si tienes certificación del PMI® este curso te brinda 16 PDU (<em>Professional Development Unit</em>) para mantener tu certificación según la descripción provista por el PMI®: Categoría PMI® CCR: <em>General Education Third-Party Provider</em>. Technical Project Management – The PMI Talent Triangle®. Duración total: <strong>20 horas netas</strong>.',

    // 7. Información e inscripción (Sin brochure público)
    'enroll_bg_image'     => 'img/capacitaciones/contratos-fidic-epc-construccion.webp',
    'whatsapp_url'        => 'https://api.whatsapp.com/send?phone=51993463118&text=' . urlencode('Hola Quality Consulting Solutions, deseo solicitar información sobre el curso de Contratos FIDIC para Contratos EPC y Construcción.'),
    'whatsapp_btn_text'   => 'Solicitar información por WhatsApp',
    'modal_service'       => 'Contratos FIDIC para Contratos EPC y Construcción',
    'paypal_slug'         => 'contratos-fidic-epc-construccion',
    'first_class_label'   => 'Primera clase del curso – USD 10',
    'back_area_url'       => '/capacitacion-contratos',
    'back_area_title'     => 'Volver a Gestión de Contratos',
    'videos'              => [],
];

echo $this->partial('course_detail_unified', ['course' => $course]);
