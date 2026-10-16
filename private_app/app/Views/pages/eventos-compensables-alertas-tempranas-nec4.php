<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Gestión de Eventos Compensables y Alertas Tempranas en Contratos NEC4
 * Archivo: app/Views/pages/eventos-compensables-alertas-tempranas-nec4.php
 *
 * Basado en la estructura unificada aprobada: app/Views/partials/course_detail_unified.php
 * Contenido auditado estrictamente contra el documento oficial externo:
 * D:\Descargas D\Brouchure\Gestion de contratos\Brochure EVENTOS COMPENSABLES NEC4.pdf
 */

declare(strict_types=1);

$course = [
    // 1. Hero Banner
    'hero_badge'          => 'GESTIÓN DE CONTRATOS • 16 HORAS NETAS • 8 SESIONES • 16 PDU',
    'hero_badge_icon'     => 'fa-solid fa-file-contract',
    'title'               => 'GESTIÓN DE EVENTOS COMPENSABLES Y ALERTAS TEMPRANAS EN CONTRATOS NEC4',
    'summary'             => 'Conocimientos y herramientas técnicas para la gestión de Eventos Compensables en contratos NEC4: cláusulas principales, opciones, Early Warning, Defined Costs, sustento, réplica y escalamiento formal.',
    'hero_cards'          => [
        [
            'icon'  => 'fa-solid fa-file-contract',
            'title' => 'CONTRATOS NEC4',
            'desc'  => 'Esquema de cláusulas principales, opciones y cláusulas especiales aplicables a la gestión de cambios.',
        ],
        [
            'icon'  => 'fa-solid fa-triangle-exclamation',
            'title' => 'ALERTAS TEMPRANAS',
            'desc'  => 'Early Warning, Instructions, Defined Costs, Disallowed Costs, Fee, Share y componentes de costo.',
        ],
        [
            'icon'  => 'fa-solid fa-file-lines',
            'title' => 'EVENTOS COMPENSABLES',
            'desc'  => 'Causales generales y especiales, tiempos para presentación y réplica, sustento y formato.',
        ],
        [
            'icon'  => 'fa-solid fa-scale-balanced',
            'title' => 'ESCALAMIENTO FORMAL',
            'desc'  => 'Senior Representatives, Adjudicator, Dispute Avoidance Board (DAB), Tribunal y cláusulas W1, W2 y W3.',
        ],
    ],

    // 2. Objetivo del curso (Página 2 del documento oficial)
    'objective'           => 'El objetivo de este curso es proporcionar el conocimiento para la gestión de Eventos Compensables en el entorno de los contratos NEC4. Para ello, se abordan las cláusulas principales y opciones, alertas tempranas, instrucciones, y otros elementos necesarios para el adecuado sustento de los Eventos Compensables. También se aborda el proceso de escalamiento a través de Representantes Senior, Adjudicador, DAB y Tribunal.',
    'objective_image'     => 'img/capacitaciones/eventos-compensables-alertas-tempranas-nec4.png',
    'objective_image_webp'=> 'img/capacitaciones/eventos-compensables-alertas-tempranas-nec4.webp',
    'objective_image_alt' => 'Capacitación Gestión de Eventos Compensables y Alertas Tempranas en Contratos NEC4',
    'objective_highlights'=> [
        'Administración Contractual NEC4: Dominio del esquema de cláusulas principales, opciones y cláusulas especiales aplicables a la gestión de controversias y cambios.',
        'Alertas Tempranas y Componentes de Costo: Identificación oportuna de Early Warnings, Defined Costs, Disallowed Costs, Dividing Date, Fee, Share y Schedule of Cost Components.',
        'Sustento Técnico y Escalamiento: Cuantificación rigurosa de causales generales y especiales, cumplimiento perentorio de plazos y escalamiento vía Senior Representatives, Adjudicator, DAB y Tribunal bajo cláusulas W.',
    ],

    // 3. Temario del curso (4 bloques oficiales según página 2 del documento oficial)
    'syllabus_intro'      => 'El programa se estructura según los cuatro bloques temáticos oficiales del curso:',
    'syllabus'            => [
        [
            'title'   => 'Contratos NEC4',
            'icon'    => 'fa-solid fa-file-contract',
            'content' => '<ul><li>Esquema de Cláusulas Principales.</li><li>Opciones.</li><li>Cláusulas Especiales.</li></ul>',
        ],
        [
            'title'   => 'Elementos del Contrato NEC4',
            'icon'    => 'fa-solid fa-cubes',
            'content' => '<ul><li>Early Warning.</li><li>Eventos Compensables.</li><li>Instructions.</li><li>Defined Costs.</li><li>Disallowed Costs.</li><li>Dividing Date.</li><li>Fee.</li><li>Share.</li><li>Schedule of Cost Components.</li></ul>',
        ],
        [
            'title'   => 'Eventos Compensables',
            'icon'    => 'fa-solid fa-file-circle-check',
            'content' => '<ul><li>Causales generales.</li><li>Causales especiales.</li><li>Tiempos para la presentación y réplica.</li><li>Elaboración del sustento.</li><li>Formato de presentación.</li></ul>',
        ],
        [
            'title'   => 'Escalamiento de los Eventos Compensables',
            'icon'    => 'fa-solid fa-scale-balanced',
            'content' => '<ul><li>Senior Representatives.</li><li>Adjudicator.</li><li>DAB (Dispute Avoidance Board).</li><li>Tribunal.</li><li>Cláusula W1.</li><li>Cláusula W2.</li><li>Cláusula W3.</li></ul>',
        ],
    ],

    // 4. Perfil docente (Ing. Víctor Cruz - Reutilizado exactamente de /contrato-nec4)
    'docente'             => [
        'photo'          => 'img/docentes/victor-cruz.png',
        'photo_webp'     => 'img/docentes/victor-cruz.webp',
        'photo_alt'      => 'Ing. Víctor Cruz, docente de Gestión de Eventos Compensables y Alertas Tempranas en Contratos NEC4',
        'alt'            => 'Ing. Víctor Cruz, docente de Gestión de Eventos Compensables y Alertas Tempranas en Contratos NEC4',
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
            'icon'  => 'fa-solid fa-percent',
            'title' => 'Descuentos futuros',
            'text'  => 'Descuento para futuros cursos con precios ordinarios.',
        ],
        [
            'icon'  => 'fa-solid fa-user-tie',
            'title' => 'Base laboral',
            'text'  => 'Ingreso a la base de datos laboral de Quality Consulting Solutions.',
        ],
        [
            'icon'  => 'fa-solid fa-certificate',
            'title' => 'Diploma digital',
            'text'  => 'Diploma digital incluido en el precio a nombre de Quality Consulting Solutions.',
        ],
        [
            'icon'  => 'fa-regular fa-file-lines',
            'title' => 'Material digital',
            'text'  => 'Entrega de material digital incluido en el precio.',
        ],
        [
            'icon'  => 'fa-regular fa-circle-play',
            'title' => 'Grabación del curso',
            'text'  => 'Acceso vía internet a la grabación del curso disponible durante seis semanas.',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '16 PDU (PMI®)',
            'text'  => '16 PDU para mantener vigente tu certificación según los lineamientos del PMI®.',
        ],
    ],

    // 6. Datos de PDU y duración (Páginas 2 y 3 del documento oficial)
    'pdu'                 => '16 PDU',
    'hours'               => '16 horas netas',
    'pdu_count'           => '16 PDU',
    'duration_hours'      => '16 horas netas (8 sesiones)',
    'pdu_heading'         => 'Unidades de desarrollo profesional (16 PDU)',
    'pdu_title'           => 'Unidades de desarrollo profesional (16 PDU)',
    'pdu_text'            => 'Si ya tienes certificación del PMI® este curso te brinda 16 PDU (<em>Professional Development Unit</em>) para mantener vigente tu certificación según la descripción provista por el PMI®: Categoría PMI® CCR: <em>General Education Third-Party Provider – The PMI Talent Triangle®</em>. Duración total: <strong>16 horas netas</strong> (distribuidas en <strong>8 sesiones</strong>).',

    // 7. Información e inscripción (Sin brochure público)
    'enroll_bg_image'     => 'img/capacitaciones/eventos-compensables-alertas-tempranas-nec4.webp',
    'whatsapp_url'        => 'https://api.whatsapp.com/send?phone=51993463118&text=' . urlencode('Hola Quality Consulting Solutions, deseo solicitar información sobre el curso Gestión de Eventos Compensables y Alertas Tempranas en Contratos NEC4.'),
    'whatsapp_btn_text'   => 'Solicitar información por WhatsApp',
    'modal_service'       => 'Gestión de Eventos Compensables y Alertas Tempranas en Contratos NEC4',
    'paypal_slug'         => 'eventos-compensables-alertas-tempranas-nec4',
    'first_class_label'   => 'Primera clase del curso – USD 10',
    'back_area_url'       => '/capacitacion-contratos',
    'back_area_title'     => 'Volver a Gestión de Contratos',
    'videos'              => [],
];

echo $this->partial('course_detail_unified', ['course' => $course]);
