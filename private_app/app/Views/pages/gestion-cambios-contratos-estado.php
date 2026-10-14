<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Gestión del Cambio en los Contratos con el Estado
 * Archivo: app/Views/pages/gestion-cambios-contratos-estado.php
 *
 * Basado en la estructura unificada aprobada: app/Views/partials/course_detail_unified.php
 * Contenido auditado estrictamente contra el documento oficial externo:
 * D:\Descargas D\Brouchure\Gestion de contratos\BROCHURE Gestión de Cambios en Contatos con el Estado.pdf
 */

declare(strict_types=1);

$course = [
    // 1. Hero Banner
    'hero_badge'          => 'GESTIÓN DE CONTRATOS • 16 HORAS NETAS • 16 PDU',
    'hero_badge_icon'     => 'fa-solid fa-file-contract',
    'title'               => 'GESTIÓN DEL CAMBIO EN LOS CONTRATOS CON EL ESTADO',
    'summary'             => 'Marco principal de la gestión de contratos con el Estado y lineamientos para gestionar cambios, causales, procesos, leyes, reglamentos aplicables y casuística.',
    'hero_cards'          => [
        [
            'icon'  => 'fa-solid fa-arrows-split-up-and-left',
            'title' => 'GESTIÓN DE CAMBIOS',
            'desc'  => 'Marco contractual, causales, procesos, leyes y reglamentos aplicables a contratos con el Estado.',
        ],
        [
            'icon'  => 'fa-solid fa-clock-rotate-left',
            'title' => 'PLAZOS & ADICIONALES',
            'desc'  => 'Ampliación de plazo, adicionales de obra, reducciones, deductivos y afectación de valorizaciones.',
        ],
        [
            'icon'  => 'fa-solid fa-timeline',
            'title' => 'SUSPENSIÓN & RUTA CRÍTICA',
            'desc'  => 'Suspensión y paralización de obra, actualización de cronograma y retrasos injustificados.',
        ],
        [
            'icon'  => 'fa-solid fa-scale-balanced',
            'title' => 'SOLUCIÓN DE CONTROVERSIAS',
            'desc'  => 'Junta de Resolución de Disputas (JRD), conciliación y arbitrajes (ad-hoc e institucional).',
        ],
    ],

    // 2. Objetivo del curso (Página 2 del documento oficial)
    'objective'           => 'Brindar el marco principal de la gestión de contratos con el Estado y los lineamientos para gestionar cambios, sus causales, procesos, leyes, reglamentos aplicables y casuística.',
    'objective_image'     => 'img/capacitaciones/gestion-cambios-contratos-estado.png',
    'objective_image_webp'=> 'img/capacitaciones/gestion-cambios-contratos-estado.webp',
    'objective_image_alt' => 'Capacitación Gestión del Cambio en los Contratos con el Estado',
    'objective_highlights'=> [
        'Marco y Lineamientos de Cambios: Comprensión integral de las causales, procesos, leyes y reglamentos aplicables a la gestión de modificaciones contractuales con el Estado.',
        'Control Técnico-Contractual de Obras: Análisis y sustentación de ampliaciones de plazo, adicionales de obra, deductivos, suspensiones, paralizaciones y verificación de ruta crítica.',
        'Mecanismos para Solución de Disputas: Alcances, configuración y prerrogativas de la Junta de Resolución de Disputas, centros de conciliación y tribunales arbitrales.',
    ],

    // 3. Temario del curso (9 temas oficiales según página 2 del documento oficial)
    'syllabus_intro'      => 'El contenido de las cláusulas contractuales así como su enfoque se desarrollan en los siguientes temas oficiales:',
    'syllabus'            => [
        [
            'title'   => 'Ampliación de plazo',
            'icon'    => 'fa-solid fa-calendar-plus',
            'content' => '<ul><li>Proceso de solicitud de ampliación del plazo pactado por atrasos y paralizaciones.</li><li>Causales y comprobación de estas.</li><li>Límites en el reglamento.</li></ul>',
        ],
        [
            'title'   => 'Adicionales de obra',
            'icon'    => 'fa-solid fa-folder-plus',
            'content' => '<ul><li>Identificación y categorización de adicionales según las entregas de bienes, servicios u obras que no estaban originalmente consideradas en el contrato, en las bases integradas o en la propuesta presentada.</li><li>Límites previstos para adicionales.</li></ul>',
        ],
        [
            'title'   => 'Reducción y deductivo',
            'icon'    => 'fa-solid fa-calculator',
            'content' => '<ul><li>Criterios para la evaluación de reducciones y deductivos (vinculados y no vinculados).</li><li>Aplicables a las menores prestaciones y afectación de las valorizaciones.</li><li>Límites a las reducciones y mecanismo de aplicación.</li></ul>',
        ],
        [
            'title'   => 'Suspensión y paralización de obra',
            'icon'    => 'fa-solid fa-circle-pause',
            'content' => '<ul><li>Diferencia y alcances entre la suspensión y paralización de obra.</li><li>Evaluación para la suspensión de obra sin imputación de las partes, mecanismo de registro e identificación de gastos.</li><li>Evaluación de la paralización debido a la detención de la ejecución de todas las actividades y/o partidas que forman parte de la misma.</li></ul>',
        ],
        [
            'title'   => 'Actualización del cronograma',
            'icon'    => 'fa-solid fa-timeline',
            'content' => '<ul><li>Modificación de las fechas de ejecución de la obra y sus causales (suspensiones, etc.).</li><li>Formulación de los acuerdos entre las partes.</li><li>Nuevo calendario de avance valorizado y sus periodos según las bases del contrato.</li><li>Verificación de ruta crítica.</li></ul>',
        ],
        [
            'title'   => 'Retrasos injustificados',
            'icon'    => 'fa-solid fa-triangle-exclamation',
            'content' => '<ul><li>Identificación de retraso injustificado del contratista con el monto de la valorización acumulada ejecutada a una fecha determinada.</li><li>Sustentos y propuesta de recuperación, sus plazos, registro y aplicación de aceleraciones.</li></ul>',
        ],
        [
            'title'   => 'Junta de Resolución de Disputas',
            'icon'    => 'fa-solid fa-scale-balanced',
            'content' => '<ul><li>Alcances y configuración de la Junta de Resolución de Disputas en materia de solución de controversias entre las partes sobre la ejecución, interpretación, resolución, inexistencia, ineficacia o invalidez del contrato.</li></ul>',
        ],
        [
            'title'   => 'Conciliación',
            'icon'    => 'fa-solid fa-handshake',
            'content' => '<ul><li>Alcances y configuración del mecanismo de Conciliación para la solución de conflictos.</li><li>Proceso para recurrir al Centro de Conciliación, sus tipos y alcances.</li></ul>',
        ],
        [
            'title'   => 'Arbitrajes',
            'icon'    => 'fa-solid fa-gavel',
            'content' => '<ul><li>Alcances y configuración del mecanismo de Arbitraje para la solución de controversias.</li><li>Arbitraje Ad-hoc e institucional.</li><li>Definición y prerrogativas del Tribunal Arbitral.</li></ul>',
        ],
    ],

    // 4. Perfil docente (Ing. Luis Condori Hospina - Páginas 1 y 4 del documento oficial)
    'docente'             => [
        'photo'          => 'img/docentes/luis-condori-hospina.png',
        'photo_webp'     => 'img/docentes/luis-condori-hospina.webp',
        'photo_alt'      => 'Ing. Luis Condori Hospina, docente de Gestión del Cambio en los Contratos con el Estado',
        'alt'            => 'Ing. Luis Condori Hospina, docente de Gestión del Cambio en los Contratos con el Estado',
        'name'           => 'Ing. Luis Condori Hospina',
        'experience_tag' => 'Más de 30 años de experiencia',
        'credentials'    => ['Ingeniero Civil', 'Consultor Contractual', 'Perito INNOVA PUCP', 'Miembro Adjudicador CIP-LIMA'],
        'summary'        => 'Ingeniero Civil egresado de la Universidad Nacional Federico Villarreal con más de 30 años de experiencia como Consultor y Asesor Técnico-Contractual en estudios, supervisión, obras, servicios y concesiones en contratos públicos y privados. Asesor de arbitrajes, expositor y conferencista en temas contractuales del sector público.',
        'highlights'     => [
            '<strong>Consultor y Asesor Técnico-Contractual:</strong> Asesoría en estudios, supervisión, obras, servicios y concesiones en contratos públicos y privados, administración de contratos de obras y gerenciamiento de obras.',
            '<strong>Perito y Miembro Adjudicador:</strong> Perito Independiente, Perito de INNOVA PUCP (Pontificia Universidad Católica del Perú) y Miembro Adjudicador de Resolución de Disputas CIP-LIMA.',
            '<strong>Trayectoria Directiva y Académica:</strong> Gerente General de Asesoría Integral de Ingeniería SAC, con especialización en Resolución de Conflictos-Arbitraje PUCP y ex docente universitario en la UNI y UAP.',
        ],
        'full_bio_items' => [
            '<strong>Perfil Profesional:</strong> Ingeniero Civil egresado de la Universidad Nacional Federico Villarreal, con amplia experiencia en administración de contratos de obras y gerenciamiento de obras en el sector público y privado.',
            '<strong>Consultoría Contractual y Arbitrajes:</strong> Actual Consultor y Asesor Técnico-Contractual en estudios, supervisión, obras, servicios, concesiones en contratos públicos y privados, asesor de arbitrajes, expositor y conferencista en temas contractuales del sector público.',
            '<strong>Peritajes y Resolución de Disputas:</strong> Perito Independiente, Perito de INNOVA PUCP (Pontificia Universidad Católica del Perú) y Miembro Adjudicador de Resolución de Disputas CIP-LIMA.',
            '<strong>Especialización y Gestión:</strong> Gerente General de Asesoría Integral de Ingeniería SAC, con estudios de Especialización en Resolución de Conflictos-Arbitraje PUCP.',
            '<strong>Docencia Universitaria:</strong> Ex docente universitario en la Universidad Nacional de Ingeniería y en la Universidad Particular Alas Peruanas.',
        ],
        'recognition'    => 'Ingeniero Civil con más de 30 años de experiencia técnica y contractual en obras públicas y privadas, peritajes ante INNOVA PUCP y adjudicación de disputas en el Colegio de Ingenieros del Perú (CIP-Lima).',
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
            'text'  => '16 PDU aplicables para quienes ya posean certificación del PMI®.',
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
            'text'  => 'Acceso por internet a la grabación durante seis semanas.',
        ],
    ],

    // 6. Datos de PDU y duración (Páginas 2 y 3 del documento oficial)
    'pdu'                 => '16 PDU',
    'hours'               => '16 horas netas',
    'pdu_count'           => '16 PDU',
    'duration_hours'      => '16 horas netas',
    'pdu_heading'         => 'Unidades de desarrollo profesional (16 PDU)',
    'pdu_title'           => 'Unidades de desarrollo profesional (16 PDU)',
    'pdu_text'            => 'Si ya tienes certificación del PMI® este curso brinda 16 PDU (<em>Professional Development Unit</em>) para mantener vigente tu certificación según la descripción provista por el PMI®: Categoría PMI® CCR: <em>General Education Third-Party Provider – The PMI Talent Triangle®</em>. Duración total: <strong>16 horas netas</strong>.',

    // 7. Información e inscripción (Sin brochure público)
    'enroll_bg_image'     => 'img/capacitaciones/gestion-cambios-contratos-estado.webp',
    'whatsapp_url'        => 'https://api.whatsapp.com/send?phone=51993463118&text=' . urlencode('Hola Quality Consulting Solutions, deseo solicitar información sobre el curso de Gestión del Cambio en los Contratos con el Estado.'),
    'whatsapp_btn_text'   => 'Solicitar información por WhatsApp',
    'modal_service'       => 'Gestión del Cambio en los Contratos con el Estado',
    'paypal_slug'         => 'gestion-cambios-contratos-estado',
    'first_class_label'   => 'Primera clase del curso – USD 10',
    'back_area_url'       => '/capacitacion-contratos',
    'back_area_title'     => 'Volver a Gestión de Contratos',
    'videos'              => [],
];

echo $this->partial('course_detail_unified', ['course' => $course]);
