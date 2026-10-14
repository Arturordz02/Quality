<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Casos Prácticos de Contratos NEC3-F
 * Archivo: app/Views/pages/casos-practicos-contratos-nec3-f.php
 *
 * Basado en la estructura unificada aprobada: app/Views/partials/course_detail_unified.php
 * Contenido auditado estrictamente contra el documento oficial externo:
 * D:\Descargas D\Brouchure\Gestion de contratos\Brochure CASOS PRÁCTICOS NEC-3F.pdf
 */

declare(strict_types=1);

$course = [
    // 1. Hero Banner
    'hero_badge'          => 'GESTIÓN DE CONTRATOS • 12 HORAS NETAS • 12 PDU',
    'hero_badge_icon'     => 'fa-solid fa-file-contract',
    'title'               => 'CASOS PRÁCTICOS DE CONTRATOS NEC3-F',
    'summary'             => 'Aplicación específica del Contrato NEC3-F: términos y definiciones bilingües, obligaciones de las partes, gestión de riesgos, alertas tempranas, eventos compensables y casuística real de proyectos.',
    'hero_cards'          => [
        [
            'icon'  => 'fa-solid fa-book-bookmark',
            'title' => 'TÉRMINOS Y DEFINICIONES',
            'desc'  => 'Estructura y definiciones clave del Contrato NEC3-F con referencia comparativa Inglés / Español.',
        ],
        [
            'icon'  => 'fa-solid fa-users-gear',
            'title' => 'ROLES Y OBLIGACIONES',
            'desc'  => 'Obligaciones contractuales y facultades del contratista, del Gerente de Proyectos y del Cliente.',
        ],
        [
            'icon'  => 'fa-solid fa-triangle-exclamation',
            'title' => 'RIESGOS Y COMPENSABLES',
            'desc'  => 'Revisión del cronograma, alertas tempranas, gestión de riesgos, seguros y eventos compensables.',
        ],
        [
            'icon'  => 'fa-solid fa-briefcase',
            'title' => 'CASOS PRÁCTICOS',
            'desc'  => 'Desarrollo y análisis participativo de tres casos de estudio basados en la casuística de proyectos reales.',
        ],
    ],

    // 2. Objetivo del curso (Página 2 del brochure oficial)
    'objective'           => 'Proporcionar a los participantes los casos de aplicación específica del Contrato NEC-3F. El curso abordará los términos y definiciones NEC-3F, las obligaciones del contratista, del Gerente de Proyectos y del Cliente, presentando casos prácticos con un enfoque real del uso de los contratos NEC.',
    'objective_image'     => 'img/capacitaciones/casos-practicos-contratos-nec3-f.png',
    'objective_image_webp'=> 'img/capacitaciones/casos-practicos-contratos-nec3-f.webp',
    'objective_image_alt' => 'Capacitación Casos Prácticos de Contratos NEC3-F',
    'objective_highlights'=> [
        'Marco Normativo y Contractual NEC3-F: Comprensión rigurosa de los términos, condiciones y definiciones en inglés y español, así como la delimitación precisa de obligaciones y facultades de cada parte.',
        'Gestión Integral del Plazo, Riesgos y Costos: Dominio de la revisión del cronograma, alertas tempranas, gestión de riesgos, eventos compensables y condiciones de pago bajo la opción F.',
        'Casuística Real Aplicada: Análisis de tres casos prácticos basados en la experiencia de proyectos ejecutados bajo contratos NEC, fortaleciendo el criterio técnico en la prevención y resolución de disputas.',
    ],

    // 3. Temario del curso (Fundamentos y Casos Prácticos según página 2 del brochure oficial)
    'syllabus_intro'      => 'El programa se estructura según los bloques oficiales del brochure: Fundamentos y el desarrollo de casos prácticos:',
    'syllabus'            => [
        [
            'title'   => 'Fundamentos',
            'icon'    => 'fa-solid fa-compass',
            'content' => '<ul><li>Procesos de la Gestión de Proyectos de Construcción.</li><li>Contrato NEC 3F.</li><li>Definiciones y Términos del Contrato NEC 3F (referencia Inglés/Español).</li><li>Obligaciones del contratista.</li><li>Obligaciones del cliente.</li><li>Plazos.</li><li>Revisión del Cronograma.</li><li>Pruebas y Defectos.</li><li>Condiciones de Pago.</li><li>Gestión de Riesgos.</li><li>Alertas Tempranas.</li><li>Eventos Compensables.</li><li>Titularidad.</li><li>Riesgos y Seguros.</li><li>Extinción y Resolución.</li><li>Solución de Controversias.</li><li>Cierre del Contrato.</li></ul>',
        ],
        [
            'title'   => 'Caso Práctico 1',
            'icon'    => 'fa-solid fa-folder-open',
            'content' => '<p>Desarrollo y análisis del primer caso práctico aplicado de gestión contractual bajo el modelo NEC3-F.</p>',
        ],
        [
            'title'   => 'Caso Práctico 2',
            'icon'    => 'fa-solid fa-folder-open',
            'content' => '<p>Desarrollo y análisis del segundo caso práctico aplicado de gestión contractual bajo el modelo NEC3-F.</p>',
        ],
        [
            'title'   => 'Caso Práctico 3',
            'icon'    => 'fa-solid fa-folder-open',
            'content' => '<p>Desarrollo y análisis del tercer caso práctico aplicado de gestión contractual bajo el modelo NEC3-F.</p>',
        ],
    ],

    // 4. Perfil docente (Ing. Iván Benavides, PMP® - Páginas 1 y 4 del brochure oficial)
    'docente'             => [
        'photo'          => 'img/docentes/ivan-benavides.png',
        'photo_webp'     => 'img/docentes/ivan-benavides.webp',
        'photo_alt'      => 'Ing. Iván Benavides, PMP®, docente de Casos Prácticos de Contratos NEC3-F',
        'alt'            => 'Ing. Iván Benavides, PMP®, docente de Casos Prácticos de Contratos NEC3-F',
        'name'           => 'Ing. Iván Benavides',
        'experience_tag' => 'Especialista en Gestión de Riesgos, Calidad y Contratos NEC',
        'credentials'    => ['PMP®', 'Ingeniero'],
        'summary'        => 'Profesional con más de 18 años de experiencia en gestión de proyectos, riesgos, contratos NEC y gestión de la calidad. Ha liderado la gestión de riesgos bajo el enfoque NEC4 en el Consorcio Gestor de Escuelas Bicentenario y fue Responsable de Riesgos en Proyectos y Overlay, así como Coordinador Técnico del Contrato de Rigging en los Juegos Panamericanos Lima 2019.',
        'highlights'     => [
            '<strong>Gestor de Riesgos en Megaproyectos NEC:</strong> Gestor de Riesgos con el enfoque NEC4 en las Escuelas Bicentenario (PEIP vía Consorcio Gestor) y Responsable de Riesgos en Proyectos / Overlay y Coordinador Técnico de Rigging en los Juegos Panamericanos Lima 2019.',
            '<strong>Amplia Experiencia en Control de Calidad e Infraestructura:</strong> Jefe de Aseguramiento de Calidad en Peru Piping Spools para la Refinería de Talara y Jefe de Calidad en Graña y Montero en obras emblemáticas como Machu Picchu Fase 2 y Toromocho.',
            '<strong>Trayectoria Multisectorial de Alto Nivel:</strong> Más de 18 años liderando gestión de proyectos, riesgos operacionales y aseguramiento de calidad en empresas como Savia Perú e Ingeniería y Servicios Tecnológicos S.A.C.',
        ],
        'full_bio_items' => [
            '<strong>Proyecto Especial de Inversión Pública, Escuelas Bicentenario:</strong> Gestor de Riesgos con el enfoque NEC4 vía EB Consorcio Gestor.',
            '<strong>Savia Perú:</strong> Implementación de proyecto de entrega a Petroperú de instalaciones offshore por fin de contrato.',
            '<strong>Proyecto Especial Juegos Panamericanos Lima 2019:</strong> Responsable de Riesgos en Área de Proyectos, apoyo a la gestión en el Área de Overlay (Infraestructuras temporales) y Coordinador técnico del Contrato de Rigging.',
            '<strong>Peru Piping Spools:</strong> Jefe de Aseguramiento de Calidad. Prefabricación de spools de tubería de acero para Refinería de Talara.',
            '<strong>Graña y Montero:</strong> Jefe de Calidad de importantes proyectos como la Central Hidroeléctrica de Machu Picchu Fase 2 y Montaje del Área Húmeda de la Concentradora Toromocho.',
            '<strong>Ingeniería y Servicios Tecnológicos S.A.C.:</strong> Desarrolló proyectos de implementación de Sistemas de Gestión de la Calidad para diferentes proyectos como el Montaje de la Planta de Biodiesel para Pure Biodiesel.',
        ],
        'recognition'    => 'Ingeniero y profesional certificado PMP® con más de 18 años de trayectoria destacada en gestión de riesgos bajo contratos NEC, dirección de proyectos e implementación de sistemas de gestión de calidad en obras de infraestructura.',
    ],

    // 5. Beneficios oficiales (Página 3 del brochure oficial)
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

    // 6. Datos de PDU y duración (Página 3 del brochure oficial)
    'pdu'                 => '12 PDU',
    'hours'               => '12 horas netas',
    'pdu_count'           => '12 PDU',
    'duration_hours'      => '12 horas netas',
    'pdu_heading'         => 'Unidades de desarrollo profesional (12 PDU)',
    'pdu_title'           => 'Unidades de desarrollo profesional (12 PDU)',
    'pdu_text'            => 'Si tienes certificación del PMI® este curso te brinda 12 PDU (<em>Professional Development Unit</em>) para mantener tu certificación según la descripción provista por el PMI®: Categoría PMI® CCR: <em>General Education Third-Party Provider – The PMI Talent Triangle®</em>. Duración total: <strong>12 horas netas</strong>.',

    // 7. Información e inscripción (Sin brochure público)
    'enroll_bg_image'     => 'img/capacitaciones/casos-practicos-contratos-nec3-f.webp',
    'whatsapp_url'        => 'https://api.whatsapp.com/send?phone=51993463118&text=' . urlencode('Hola Quality Consulting Solutions, deseo solicitar información sobre el curso Casos Prácticos de Contratos NEC3-F.'),
    'whatsapp_btn_text'   => 'Solicitar información por WhatsApp',
    'modal_service'       => 'Casos Prácticos de Contratos NEC3-F',
    'paypal_slug'         => 'casos-practicos-contratos-nec3-f',
    'first_class_label'   => 'Primera clase del curso – USD 10',
    'back_area_url'       => '/capacitacion-contratos',
    'back_area_title'     => 'Volver a Gestión de Contratos',
    'videos'              => [],
];

echo $this->partial('course_detail_unified', ['course' => $course]);

