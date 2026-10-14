<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Oficina Técnica en Edificaciones y Hospitales
 * Archivo: app/Views/pages/oficina-tecnica-hospitales-edificaciones.php
 *
 * Basado en la plantilla unificada aprobada: app/Views/partials/course_detail_unified.php
 * Contenido auditado estrictamente contra el documento oficial externo:
 * D:\Descargas D\Brouchure\Oficina Tecnica\02 - OFT HOSPITALES Y EDIFICACIONES - FMX (1).pdf
 */

declare(strict_types=1);

$course = [
    // 1. Hero Banner
    'hero_badge'          => 'ÁREA DE OFICINA TÉCNICA • 16 HORAS NETAS • 16 PDU',
    'hero_badge_icon'     => 'fa-solid fa-hospital',
    'title'               => 'OFICINA TÉCNICA EN EDIFICACIONES Y HOSPITALES',
    'summary'             => 'Presentar a los participantes los aspectos que componen la gestión de la Oficina Técnica en proyectos de edificaciones y hospitalarios, con conceptos, criterios prácticos y herramientas útiles, aplicables a proyectos privados y también públicos.',
    'hero_cards'          => [
        [
            'icon'  => 'fa-solid fa-hospital',
            'title' => 'EDIFICACIONES Y HOSPITALES',
            'desc'  => 'Gestión de oficina técnica en edificios y hospitales con aspectos diferenciadores, criterios técnicos y de equipamiento.',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '16 HORAS & 16 PDU',
            'desc'  => '16 horas netas de capacitación especializada y 16 PDU en la categoría General Education Third-Party Provider del PMI®.',
        ],
        [
            'icon'  => 'fa-solid fa-list-check',
            'title' => 'CONTROL Y SEGUIMIENTO',
            'desc'  => 'Expediente técnico, Curva S, Last Planner® System, Resultado Operativo, RFI y Procura de Recursos.',
        ],
        [
            'icon'  => 'fa-solid fa-briefcase',
            'title' => 'BASE DE DATOS LABORAL',
            'desc'  => 'Ingreso a la base de datos laboral de Quality Consulting Solutions y diploma digital oficial.',
        ],
    ],

    // 2. Objetivo del curso (Página 2 del documento oficial)
    'objective'           => 'Presentar a los participantes los aspectos que componen la gestión de la Oficina Técnica en proyectos de edificaciones y hospitalarios, con conceptos, criterios prácticos y herramientas útiles, aplicables a proyectos privados y también públicos.',
    'objective_image'     => 'img/capacitaciones/oficina-tecnica-hospitales-edificaciones.png',
    'objective_image_webp'=> 'img/capacitaciones/oficina-tecnica-hospitales-edificaciones.webp',
    'objective_image_alt' => 'Oficina Técnica en Edificaciones y Hospitales',
    'objective_highlights'=> [
        'Aspectos Diferenciadores: Información sobre aspectos diferenciadores, criterios técnicos y de equipamiento entre proyectos de edificaciones y proyectos hospitalarios.',
        'Gestión Integral de Alcance y Costo: Contrato de obra, expediente técnico, ingeniería, solicitudes de adelantos, valorizaciones, adicionales, deductivos, presupuestos contractual, interno y meta, y resultado operativo.',
        'Plazo, Comunicaciones y Procura: Cronograma, avance valorizado, Curva S, ampliaciones de plazo, Last Planner® System, actas de reunión, cuadernos de obra, transmittal, submittal, RFI y procesos logísticos.',
    ],

    // 3. Temario del curso (5 bloques oficiales según página 2 del documento oficial)
    'syllabus_intro'      => 'El curso aborda la gestión de la Oficina Técnica para el caso de Edificios y también de Hospitales, estructurado en 5 áreas temáticas oficiales:',
    'syllabus'            => [
        [
            'title'   => 'Alcance',
            'icon'    => 'fa-solid fa-layer-group',
            'content' => '<ul><li>Contrato de Obra.</li><li>Expediente técnico.</li><li>Ingeniería.</li><li>Solicitudes de Adelantos.</li><li>Valorizaciones.</li><li>Adicionales y Deductivos.</li><li>Liquidación de obra.</li></ul>',
        ],
        [
            'title'   => 'Plazo',
            'icon'    => 'fa-solid fa-calendar-check',
            'content' => '<ul><li>Cronograma.</li><li>Avance Valorizado.</li><li>Curva S.</li><li>Ampliaciones de Plazo.</li><li>Last Planner® System.</li></ul>',
        ],
        [
            'title'   => 'Costo',
            'icon'    => 'fa-solid fa-coins',
            'content' => '<ul><li>Presupuesto Contractual.</li><li>Presupuesto Interno.</li><li>Presupuesto Meta.</li><li>Resultado Operativo.</li></ul>',
        ],
        [
            'title'   => 'Comunicaciones',
            'icon'    => 'fa-solid fa-comments',
            'content' => '<ul><li>Actas de Reunión.</li><li>Cuadernos de Obra.</li><li>Control de Cartas.</li><li>Transmittal.</li><li>Submittal.</li><li>RFI.</li></ul>',
        ],
        [
            'title'   => 'Procura',
            'icon'    => 'fa-solid fa-truck-ramp-box',
            'content' => '<ul><li>Proceso Logístico.</li><li>Documentos Técnicos.</li><li>Valorizaciones de Terceros.</li><li>Cronogramas de Recursos.</li></ul>',
        ],
    ],

    // 4. Perfil docente (Ing. Fanny Muro - Páginas 1 y 4 del documento oficial)
    'docente'             => [
        'photo'          => 'img/docentes/fanny-muro.png',
        'photo_webp'     => 'img/docentes/fanny-muro.webp',
        'photo_alt'      => 'Ing. Fanny Muro, docente de Oficina Técnica en Edificaciones y Hospitales',
        'alt'            => 'Ing. Fanny Muro, docente de Oficina Técnica en Edificaciones y Hospitales',
        'name'           => 'Ing. Fanny Muro',
        'experience_tag' => '+15 años de experiencia',
        'credentials'    => ['Ing. Civil', 'Máster', 'ESAN', 'PUCP', 'La Salle BCN'],
        'summary'        => 'Ingeniera Civil, Máster, con más de 15 años de experiencia laboral en proyectos de construcción basados en el enfoque PMI® y Lean Construction. Especialista en Edificaciones, así como en infraestructura Hospitalaria. Maestría y especializaciones en Universidad ESAN, Pontificia Universidad Católica del Perú y La Salle BCN.',
        'highlights'     => [
            '<strong>Especialidad Técnica:</strong> Especialista en control de costos y productividad de obra, programación de obras, gestión de subcontratistas, valorizaciones con el cliente, análisis del Valor Ganado (EVM) y estimación de presupuestos.',
            '<strong>Proyectos Hospitalarios:</strong> Jefe de Obra de Oficina Técnica en el Hospital de Llata para el Ministerio de Salud (proyecto de más de S/. 111,000,000.00) e Ingeniera de Costos para el Hospital Regional de Lambayeque y Hospital Heysen Incháustegui.',
            '<strong>Edificaciones Complejas:</strong> Jefe de Oficina Técnica en el edificio Primera Visión con sistema Top Down, Hotel Atton Miraflores, Centro Nacional de Imágenes Satelitales (CNOIS) y centros comerciales.',
        ],
        'full_bio_items' => [
            '<strong>COSAPI:</strong> Jefe de Obra de Oficina Técnica en el Hospital de Llata para el Ministerio de Salud (Proyecto de más de S/. 111,000,000.00).',
            '<strong>COSAPI:</strong> Jefe de Oficina Técnica para la fase de acabados y equipamientos para el Hotel Atton, Miraflores.',
            '<strong>COSAPI:</strong> Jefe de Oficina Técnica, edificio Primera Visión, con el sistema Top Down (construcción de sótanos y pisos superiores en simultáneo).',
            '<strong>GRAÑA Y MONTERO:</strong> Jefe de Oficina Técnica del proyecto del Centro Nacional de Imágenes Satelitales (CNOIS).',
            '<strong>GRAÑA Y MONTERO:</strong> Jefe de Oficina Técnica del Edificio Corporativo de Graña y Montero – Petit Thouars, y remodelación de la sede existente.',
            '<strong>OTROS PROYECTOS:</strong> Ingeniera de Costos para el proyecto del Hospital Regional de Lambayeque y Hospital Heysen Incháustegui.',
            '<strong>OTROS PROYECTOS:</strong> Jefe de Oficina Técnica para el proyecto de Ampliación del Centro Comercial Real Plaza Chiclayo y Centro Comercial Open Plaza Chiclayo.',
        ],
        'recognition'    => 'Especialista en control de costos, productividad de obra, programación de proyectos y gestión contractual en edificaciones de alta envergadura e infraestructura hospitalaria.',
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
            'text'  => 'Acceso vía internet a la grabación durante cuatro semanas después de finalizar.',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '16 PDU',
            'text'  => '16 PDU (Professional Development Unit) Categoría PMI® CCR: General Education Third-Party Provider.',
        ],
    ],

    // 6. Datos de PDU y duración (Páginas 2 y 3 del documento oficial)
    'pdu'                 => '16 PDU',
    'hours'               => '16 horas netas',
    'pdu_count'           => '16 PDU',
    'duration_hours'      => '16 horas netas',
    'pdu_heading'         => 'Unidades de desarrollo profesional (16 PDU)',
    'pdu_title'           => 'Unidades de desarrollo profesional (16 PDU)',
    'pdu_text'            => 'Si tienes certificación del PMI®, este curso te brinda 16 PDU (<em>Professional Development Unit</em>) para mantener tu certificación según la descripción provista por el PMI®: Categoría PMI® CCR: <em>General Education Third-Party Provider</em>. Technical Project Management – The PMI Talent Triangle®. Duración total: <strong>16 horas netas</strong>.',

    // 7. Información e inscripción (Sin brochure público)
    'enroll_bg_image'     => 'img/capacitaciones/oficina-tecnica-hospitales-edificaciones.webp',
    'whatsapp_url'        => 'https://api.whatsapp.com/send?phone=51993463118&text=' . urlencode('Hola Quality Consulting Solutions, deseo solicitar información sobre el curso de Oficina Técnica en Edificaciones y Hospitales.'),
    'whatsapp_btn_text'   => 'Solicitar información por WhatsApp',
    'modal_service'       => 'Oficina Técnica en Edificaciones y Hospitales',
    'paypal_slug'         => 'oficina-tecnica-hospitales-edificaciones',
    'first_class_label'   => 'Primera clase del curso – USD 10',
    'back_area_url'       => '/capacitacion-oficina-tecnica',
    'back_area_title'     => 'Volver al Área de Oficina Técnica',
    'videos'              => [],
];

echo $this->partial('course_detail_unified', ['course' => $course]);
