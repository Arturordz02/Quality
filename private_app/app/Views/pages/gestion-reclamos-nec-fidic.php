<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Gestión de Reclamos en Contratos de Construcción y Contratos Colaborativos NEC y FIDIC
 * Archivo: app/Views/pages/gestion-reclamos-nec-fidic.php
 *
 * Basado en la estructura unificada aprobada: app/Views/partials/course_detail_unified.php
 * Contenido auditado estrictamente contra el documento oficial externo:
 * D:\Descargas D\Brouchure\Gestion de contratos\Brochure GESTIÓN DE RECLAMOS NEC Y FIDIC (1).pdf
 */

declare(strict_types=1);

$course = [
    // 1. Hero Banner
    'hero_badge'          => 'GESTIÓN DE CONTRATOS • 23 HORAS NETAS • 23 PDU',
    'hero_badge_icon'     => 'fa-solid fa-file-contract',
    'title'               => 'GESTIÓN DE RECLAMOS EN CONTRATOS DE CONSTRUCCIÓN Y CONTRATOS COLABORATIVOS NEC Y FIDIC',
    'summary'             => 'Estructura, formulación y sustento de reclamaciones contractuales (Claims) en proyectos de construcción bajo modelos colaborativos NEC y contratos estándar FIDIC.',
    'hero_cards'          => [
        [
            'icon'  => 'fa-solid fa-file-shield',
            'title' => 'CLAIMS FIDIC Y NEC',
            'desc'  => 'Procedimientos para identificar, notificar y evaluar reclamaciones bajo FIDIC y NEC 3 Opción F.',
        ],
        [
            'icon'  => 'fa-solid fa-scale-balanced',
            'title' => 'ESTRUCTURA DEL CLAIM',
            'desc'  => 'Causa, Efecto (Causalidad), Derecho y Sustento técnico-económico de la reclamación.',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '23 HORAS & 23 PDU',
            'desc'  => '23 horas netas de capacitación especializada y 23 PDU en la categoría General Education Third-Party Provider del PMI®.',
        ],
        [
            'icon'  => 'fa-solid fa-briefcase',
            'title' => 'BASE DE DATOS LABORAL',
            'desc'  => 'Ingreso a la base de datos laboral de Quality Consulting Solutions y diploma digital oficial.',
        ],
    ],

    // 2. Objetivo del curso (Página 2 del documento oficial)
    'objective'           => 'Conocer y dominar los principios, metodologías y estándares aplicables a la identificación, formulación, sustento y cuantificación de reclamaciones contractuales (Claims) generadas durante las distintas fases de proyectos de construcción bajo los estándares FIDIC y NEC. Desarrollar criterios técnicos y contractuales sólidos para la prevención, mitigación y resolución eficiente de demoras, sobrecostos y controversias.',
    'objective_image'     => 'img/capacitaciones/gestion-reclamos-nec-fidic.png',
    'objective_image_webp'=> 'img/capacitaciones/gestion-reclamos-nec-fidic.webp',
    'objective_image_alt' => 'Gestión de Reclamos en Contratos de Construcción y Contratos Colaborativos NEC y FIDIC',
    'objective_highlights'=> [
        'Identificar la estructura de la reclamación a fin de realizar una óptima preparación y formulación de aquella, conociendo el origen de los Reclamos Contractuales (Claims) generados durante distintas fases del proyecto.',
        'Conocer los distintos tipos de reclamaciones que surgen a fin de realizar su correcta prevención y gestión de acuerdo con sus características técnicas y legales.',
        'Conocer y aplicar técnicas comprobadas para identificar, reducir, controlar, mitigar y cuantificar los impactos de eventos compensables o de reclamación, estableciendo recomendaciones para una gestión preventiva.',
    ],

    // 3. Temario del curso (7 bloques oficiales según página 2 del documento oficial)
    'syllabus_intro'      => 'El programa se estructura según el contenido temático oficial de gestión de reclamos:',
    'syllabus'            => [
        [
            'title'   => 'Aspectos generales de los Claims (FIDIC)',
            'icon'    => 'fa-solid fa-book-open',
            'content' => '<ul><li>Introducción a los modelos FIDIC.</li><li>Filosofía y estructura del contrato (Libro rojo, amarillo y plata).</li></ul>',
        ],
        [
            'title'   => 'Aspectos generales de los Claims (NEC)',
            'icon'    => 'fa-solid fa-file-lines',
            'content' => '<ul><li>Procedimiento para identificar, notificar y evaluar un Claim. NEC 3 opción F.</li><li>Estructura y formulación de un Claim: Causa, Efecto (Causalidad), derecho y sustento.</li></ul>',
        ],
        [
            'title'   => 'Principales reclamaciones de plazo',
            'icon'    => 'fa-solid fa-business-time',
            'content' => '<ul><li>Reclamos de ampliación de plazo.</li><li>Reclamaciones de demoras concurrentes (Cliente y Contratista).</li><li>Reclamaciones por aceleración.</li></ul>',
        ],
        [
            'title'   => 'Principales reclamaciones de costo',
            'icon'    => 'fa-solid fa-calculator',
            'content' => '<ul><li>Reclamos de daños.</li><li>Reclamaciones por Disruption y pérdida de productividad.</li></ul>',
        ],
        [
            'title'   => 'Reclamos Globales',
            'icon'    => 'fa-solid fa-globe',
            'content' => '<ul><li>Reclamos multifactores en tiempo y plazo.</li></ul>',
        ],
        [
            'title'   => 'Factor común de las Reclamaciones',
            'icon'    => 'fa-solid fa-shield-halved',
            'content' => '<ul><li>Mitigación de demora y de pérdida.</li><li>Test de previsibilidad.</li></ul>',
        ],
        [
            'title'   => 'Técnicas de análisis de demoras',
            'icon'    => 'fa-solid fa-chart-line',
            'content' => '<ul><li>Análisis de cronograma.</li></ul>',
        ],
    ],

    // 4. Perfil docente (Sharon Grados - Páginas 1 y 4 del documento oficial)
    'docente'             => [
        'photo'          => 'img/docentes/sharon-grados.png',
        'photo_webp'     => 'img/docentes/sharon-grados.webp',
        'photo_alt'      => 'Sharon Grados, docente de Gestión de Reclamos en Contratos NEC y FIDIC',
        'alt'            => 'Sharon Grados, docente de Gestión de Reclamos en Contratos NEC y FIDIC',
        'name'           => 'Sharon Grados',
        'experience_tag' => 'Especialista en Claims NEC y FIDIC',
        'credentials'    => ['Abogada', 'Árbitro en Construcción', 'Legal Contract Manager PMO G2G', 'Especialista en Claims NEC y FIDIC'],
        'summary'        => 'Árbitro y abogada experta en Derecho de la Construcción y en Mecanismos de Resolución de Controversias. Legal Contract Manager en la PMO del G2G Francia-Perú. Con experiencia en diseño y negociación de contratos, asesoría en gestión contractual y reclamaciones, así como en el manejo y resolución de controversias complejas para diferentes megaproyectos de construcción, infraestructura y servicios públicos.',
        'highlights'     => [
            '<strong>PMO G2G Francia-Perú y Megaproyectos:</strong> Legal Contract Manager en la PMO del G2G Francia-Perú para hospitales y Legal Claims Advisor en Consorcio Natividad de Chinchero (CNCH) para el Aeropuerto Internacional de Chinchero.',
            '<strong>Megaproyectos PMC Talara y Arbitrajes NPG:</strong> Contract and Disputes Lawyer en el Proyecto de Modernización de la Refinería de Talara con Consorcio Internacional PMC Talara, y asesora legal en diseño, ejecución, reclamos y arbitrajes en NPG Abogados.',
            '<strong>Infraestructura ICCGSA, MTC y Estudio Rivera:</strong> Gestión contractual en ICCGSA, equipo de arbitraje de la Procuraduría Pública del MTC, y consultoría en gestión de reclamos de obras y apelaciones en Estudio Rivera Abogados.',
        ],
        'full_bio_items' => [
            '<strong>Egis Batiments International (PMO Francia-Perú):</strong> Ejerce como Legal Contract Manager, encargada del soporte jurídico/legal en la procura (adquisición) y ejecución de los contratos suscritos en el marco del Contrato Gobierno a Gobierno (G2G) entre Perú y Francia para la PMO hospitales.',
            '<strong>Consorcio Natividad de Chinchero (CNCH):</strong> Ejerció como Legal Claims Advisor, encargada del soporte jurídico/legal/contractual en la ejecución contractual, gestión de reclamaciones (Claims) y resolución de controversias para el proyecto del Aeropuerto Internacional de Chinchero.',
            '<strong>Consorcio Internacional PMC Talara:</strong> Ejerció como Contract and Disputes Lawyer, brindando asesoramiento en la ejecución contractual (Contratos FIDIC, contrato PMC, contrato Framework y otros contratos) del Proyecto de Modernización de la Refinería de Talara, en la gestión de reclamaciones (Claims), así como en la prevención y resolución de controversias complejas.',
            '<strong>NPG Abogados:</strong> Asesoramiento legal en el diseño, ejecución contractual, gestión de reclamos y resolución de controversias de diferentes proyectos de construcción e infraestructura. Elaboración de estrategia y conducción de arbitrajes nacionales e internacionales en proyectos de ingeniería, construcción e infraestructura.',
            '<strong>ICCGSA:</strong> Encargada de la gestión contractual de diferentes proyectos de infraestructura. Soporte legal en el diseño de contratos civiles y comerciales relacionados a los proyectos de ingeniería y construcción. Absolución de consultas relacionadas a temas de construcción para proyectos públicos y privados. Manejo de contingencias legales con subcontratistas, contratistas y clientes.',
            '<strong>Ministerio de Transportes y Comunicaciones (MTC):</strong> Formó parte del equipo de arbitraje de la procuraduría pública del MTC, encargado de los arbitrajes en contrataciones con el estado, concesiones y expropiaciones.',
            '<strong>Estudio Rivera Abogados:</strong> Encargada de la renovación e inscripción de empresas participantes en el Registro Nacional de Proveedores, de la elaboración de consultas y observaciones a las bases y otras actuaciones requeridas en los procesos de selección. Investigación de normas relacionadas a las contrataciones públicas para diferentes informes. Consultoría externa respecto a gestión de reclamos en contratos de obras y redacción de apelaciones ante el Tribunal de Contrataciones.',
        ],
        'recognition'    => 'Abogada por la UNFV, con estudios de maestría en Derecho Civil y Comercial en la UNMSM, y postgrados en Contrataciones con el Estado, concesiones, Contratos APP, Gerencia de Proyectos, contratos FIDIC, arbitraje nacional e internacional y Dispute Board. Miembro de la Sociedad de Derecho de la Construcción UK (Londres) y de la Sociedad Peruana de Derecho de la Construcción.',
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

    // 6. Datos de PDU y duración (Páginas 1, 2 y 3 del documento oficial)
    'pdu'                 => '23 PDU',
    'hours'               => '23 horas netas',
    'pdu_count'           => '23 PDU',
    'duration_hours'      => '23 horas netas',
    'pdu_heading'         => 'Unidades de desarrollo profesional (23 PDU)',
    'pdu_title'           => 'Unidades de desarrollo profesional (23 PDU)',
    'pdu_text'            => 'Si tienes certificación del PMI® este curso te brinda 23 PDU (<em>Professional Development Unit</em>) para mantener tu certificación según la descripción provista por el PMI®: Categoría PMI® CCR: <em>General Education Third-Party Provider</em>. Technical Project Management – The PMI Talent Triangle®. Duración total: <strong>23 horas netas</strong>.',

    // 7. Información e inscripción (Sin brochure público)
    'enroll_bg_image'     => 'img/capacitaciones/gestion-reclamos-nec-fidic.webp',
    'whatsapp_url'        => 'https://api.whatsapp.com/send?phone=51993463118&text=' . urlencode('Hola Quality Consulting Solutions, deseo solicitar información sobre el curso de Gestión de Reclamos en Contratos de Construcción y Contratos Colaborativos NEC y FIDIC.'),
    'whatsapp_btn_text'   => 'Solicitar información por WhatsApp',
    'modal_service'       => 'Gestión de Reclamos en Contratos de Construcción y Contratos Colaborativos NEC y FIDIC',
    'paypal_slug'         => 'gestion-reclamos-nec-fidic',
    'first_class_label'   => 'Primera clase del curso – USD 10',
    'back_area_url'       => '/capacitacion-contratos',
    'back_area_title'     => 'Volver a Gestión de Contratos',
    'videos'              => [],
];

echo $this->partial('course_detail_unified', ['course' => $course]);
