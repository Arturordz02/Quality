<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: El Contrato de NEC4
 * Archivo: app/Views/pages/contrato-nec4.php
 *
 * Basado en la estructura unificada aprobada: app/Views/partials/course_detail_unified.php
 * Contenido auditado estrictamente contra el documento oficial externo:
 * D:\Descargas D\Brouchure\Gestion de contratos\02 - NEC4 VCX -NEW2025.pdf
 */

declare(strict_types=1);

$course = [
    // 1. Hero Banner
    'hero_badge'          => 'GESTIÓN DE CONTRATOS • 14 HORAS NETAS • 14 PDU',
    'hero_badge_icon'     => 'fa-solid fa-file-contract',
    'title'               => 'EL CONTRATO DE NEC4',
    'summary'             => 'Conocimiento integral del estándar NEC4, sus diferentes opciones principales de la A a la F, cláusulas especiales, alertas tempranas, instrucciones y el proceso de escalamiento de controversias.',
    'hero_cards'          => [
        [
            'icon'  => 'fa-solid fa-book-open',
            'title' => 'CLÁUSULAS PRINCIPALES',
            'desc'  => 'Secciones 10 a 80: responsabilidades, tiempo, calidad, pagos, eventos compensables, titularidad y seguros.',
        ],
        [
            'icon'  => 'fa-solid fa-layer-group',
            'title' => 'OPCIONES A A LA F',
            'desc'  => 'Contratos a precio fijo, precio objetivo, costos reembolsables y gerencia con listas de actividades y cantidades.',
        ],
        [
            'icon'  => 'fa-solid fa-scale-balanced',
            'title' => 'PREVENCIÓN DE DISPUTAS',
            'desc'  => 'Empleo de cláusulas W y mecanismo de escalamiento con Representantes Senior, Adjudicador, DAB y Tribunal.',
        ],
        [
            'icon'  => 'fa-solid fa-sliders',
            'title' => 'CLÁUSULAS SECUNDARIAS',
            'desc'  => 'Ajustes de precio, cambios legales, múltiples monedas, garantías, terminación y colaboración multiparte.',
        ],
    ],

    // 2. Objetivo del curso (Página 2 del documento oficial)
    'objective'           => 'El objetivo de este curso es proporcionar el conocimiento del contenido NEC4 y sus diferentes opciones, así como cláusulas especiales. Para ello, se abordan las cláusulas principales y opciones, alertas tempranas, instrucciones, y el proceso de escalamiento a través de Representantes Senior, Adjudicador, DAB y Tribunal.',
    'objective_image'     => 'img/capacitaciones/contrato-nec4.png',
    'objective_image_webp'=> 'img/capacitaciones/contrato-nec4.webp',
    'objective_image_alt' => 'Capacitación El Contrato de NEC4',
    'objective_highlights'=> [
        'Comprensión de Cláusulas Principales y Opciones: Análisis de las secciones 10 a 80 del contrato estándar NEC4 y dominio de las opciones principales A, B, C, D, E y F según la estructura de precios del proyecto.',
        'Gestión Contractual Proactiva: Aplicación práctica de alertas tempranas, instrucciones del director del proyecto y administración técnica de eventos compensables.',
        'Prevención y Resolución de Disputas: Empleo de las cláusulas W y el proceso formal de escalamiento mediante Representantes Senior, Adjudicador, Dispute Avoidance Board (DAB) y Tribunal.',
    ],

    // 3. Temario del curso (4 bloques oficiales según página 2 del documento oficial)
    'syllabus_intro'      => 'El programa se estructura según los cuatro bloques temáticos oficiales del curso:',
    'syllabus'            => [
        [
            'title'   => 'Esquema de Cláusulas Principales',
            'icon'    => 'fa-solid fa-book-open',
            'content' => '<ul><li>Sección 10 General</li><li>Sección 20 Responsabilidades principales del contratista</li><li>Sección 30 Gestión del Tiempo</li><li>Sección 40 Gestión de la Calidad</li><li>Sección 50 Pagos</li><li>Sección 60 Eventos Compensables</li><li>Sección 70 Titularidad</li><li>Sección 80 Seguros y Responsabilidades</li></ul>',
        ],
        [
            'title'   => 'Opciones',
            'icon'    => 'fa-solid fa-layer-group',
            'content' => '<ul><li>Opción A. Contrato a precio fijo con lista de actividades.</li><li>Opción B. Contrato a precio fijo con lista de cantidades.</li><li>Opción C. Contrato a precio objetivo con lista de actividades.</li><li>Opción D. Contrato a precio objetivo con lista de cantidades.</li><li>Opción E. Contrato a costos reembolsables.</li><li>Opción F. Contrato de gerencia.</li></ul>',
        ],
        [
            'title'   => 'Resolución y Prevención de Disputas',
            'icon'    => 'fa-solid fa-scale-balanced',
            'content' => '<ul><li>Empleo de las cláusulas W y el mecanismo para escalamiento al Dispute Avoidance Board (DAB).</li><li>Representantes Senior y Adjudicador.</li><li>Escalamiento formal a Tribunal.</li></ul>',
        ],
        [
            'title'   => 'Cláusulas Secundarias',
            'icon'    => 'fa-solid fa-sliders',
            'content' => '<ul><li>Ajuste de precio, cambios legales y múltiples monedas.</li><li>Garantía de empresa matriz y finalización seccional.</li><li>Bonificación por finalización anticipada y daños por demora.</li><li>Compromisos con el cliente y transferencia de derechos.</li><li>Modelado de información y terminación por el cliente.</li><li>Colaboración multiparte, entre otras.</li></ul>',
        ],
    ],

    // 4. Perfil docente (Ing. Víctor Cruz - Páginas 1 y 4 del documento oficial)
    'docente'             => [
        'photo'          => 'img/docentes/victor-cruz.png',
        'photo_webp'     => 'img/docentes/victor-cruz.webp',
        'photo_alt'      => 'Ing. Víctor Cruz, docente de El Contrato de NEC4',
        'alt'            => 'Ing. Víctor Cruz, docente de El Contrato de NEC4',
        'name'           => 'Ing. Víctor Cruz',
        'experience_tag' => 'Especialista en Contratos NEC, LCE y OxI',
        'credentials'    => ['Ing. Civil', 'PMP®'],
        'summary'        => 'Profesional con más de 14 años en proyectos de ingeniería y construcción; con experiencia en dirección de proyectos, residencia y supervisión de obra, administración de contratos, procesos de licitación, gestión de riesgos, reclamos y negociación. Experiencia en contratos NEC, ley de contrataciones del estado (LCE), ley de arbitraje y la ley de obras por impuestos (OxI).',
        'highlights'     => [
            '<strong>Especialista en Contratos NEC:</strong> Experiencia contrastada en la administración de contratos NEC y en la gestión integral de controversias en grandes proyectos de construcción.',
            '<strong>Gestión de Proyectos e Ingeniería:</strong> Trayectoria sólida en dirección, residencia, supervisión de obra, licitaciones, gestión de riesgos y negociación técnica.',
            '<strong>Marco Normativo Integral:</strong> Dominio de la Ley de Contrataciones del Estado (LCE), Ley de Arbitraje y la Ley de Obras por Impuestos (OxI).',
        ],
        'full_bio_items' => [
            '<strong>Consorcio SyP:</strong> Especialista en Contratos NEC.',
            '<strong>BESALCO STRACON:</strong> Administrador de Contratos NEC, LEC, Ox.I.',
            '<strong>Cosapi:</strong> Analista de Gestión de Controversias.',
            '<strong>JJC:</strong> Jefe de Obra, Ingenieros de Oficina Técnica.',
            '<strong>CESEL:</strong> Jefe de Proyectos.',
            '<strong>AKER SOLUTIONS:</strong> Ingeniero de Planeamientos y Costos.',
            '<strong>JACOBS:</strong> Ingeniero de Planeamientos y Costos.',
        ],
        'recognition'    => 'Ingeniero Civil y Project Management Professional (PMP®) con amplia trayectoria en dirección de obras, administración de contratos NEC y resolución de controversias en el sector construcción.',
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
    'pdu_text'            => 'Si tienes certificación del PMI® este curso te brinda 14 PDU (<em>Professional Development Unit</em>) para mantener tu certificación según la descripción provista por el PMI®: Categoría PMI® CCR: <em>General Education Third-Party Provider – The PMI Talent Triangle®</em>. Duración total: <strong>14 horas netas</strong>.',

    // 7. Información e inscripción (Sin brochure público)
    'enroll_bg_image'     => 'img/capacitaciones/contrato-nec4.webp',
    'whatsapp_url'        => 'https://api.whatsapp.com/send?phone=51993463118&text=' . urlencode('Hola Quality Consulting Solutions, deseo solicitar información sobre el curso El Contrato de NEC4.'),
    'whatsapp_btn_text'   => 'Solicitar información por WhatsApp',
    'modal_service'       => 'El Contrato de NEC4',
    'paypal_slug'         => 'contrato-nec4',
    'first_class_label'   => 'Primera clase del curso – USD 10',
    'back_area_url'       => '/capacitacion-contratos',
    'back_area_title'     => 'Volver a Gestión de Contratos',
    'videos'              => [],
];

echo $this->partial('course_detail_unified', ['course' => $course]);
