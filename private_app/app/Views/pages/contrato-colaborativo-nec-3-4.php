<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Contrato Colaborativo NEC 3/4
 * Archivo: app/Views/pages/contrato-colaborativo-nec-3-4.php
 *
 * Basado en la estructura unificada aprobada: app/Views/partials/course_detail_unified.php
 * Contenido auditado estrictamente contra el documento oficial externo:
 * D:\Descargas D\Brouchure\Gestion de contratos\Brochure Contratos Nec 3 y 4.pdf
 */

declare(strict_types=1);

$course = [
    // 1. Hero Banner
    'hero_badge'          => 'GESTIÓN DE CONTRATOS • 16 HORAS NETAS • 16 PDU',
    'hero_badge_icon'     => 'fa-solid fa-file-contract',
    'title'               => 'CONTRATO COLABORATIVO NEC 3/4',
    'summary'             => 'Ofrecer a los participantes las bases de aplicación específica del Contrato NEC-3/4: términos y definiciones clave, responsabilidades de las partes, opciones contractuales y casuística de proyectos de gran envergadura.',
    'hero_cards'          => [
        [
            'icon'  => 'fa-solid fa-file-contract',
            'title' => 'CLÁUSULAS PRINCIPALES',
            'desc'  => 'Dominio de las secciones 10 a 90: responsabilidades, tiempo, defectos, pagos y eventos compensables.',
        ],
        [
            'icon'  => 'fa-solid fa-sliders',
            'title' => 'OPCIÓN F Y VARIACIONES',
            'desc'  => 'Fundamentos de la Opción F y variaciones comparativas entre las opciones previstas en el contrato NEC.',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '16 HORAS & 16 PDU',
            'desc'  => '16 horas netas de capacitación especializada y 16 PDU en la categoría General Education Third-Party Provider del PMI®.',
        ],
        [
            'icon'  => 'fa-solid fa-briefcase',
            'title' => 'BASE DE DATOS LABORAL',
            'desc'  => 'Ingreso a la base de datos laboral de Quality Consulting Solutions y diploma digital oficial.',
        ],
    ],

    // 2. Objetivo del curso (Página 2 del documento oficial)
    'objective'           => 'Ofrecer a los participantes las bases de aplicación específica del Contrato NEC-3/4. Durante el curso se exploran los términos y definiciones clave del NEC-3/4, así como las responsabilidades del contratista, del Gerente de Proyectos y del Cliente, analizando ejemplos prácticos basados en proyectos de gran envergadura como los Juegos Panamericanos Lima 2019 y proyectos bajo el esquema G2G.',
    'objective_image'     => 'img/capacitaciones/contrato-colaborativo-nec-3-4.png',
    'objective_image_webp'=> 'img/capacitaciones/contrato-colaborativo-nec-3-4.webp',
    'objective_image_alt' => 'Contrato Colaborativo NEC 3/4',
    'objective_highlights'=> [
        'Cláusulas Principales: Estudio integral de las secciones 10 a 90, abordando gestión del tiempo, pruebas, pagos, eventos compensables y terminación.',
        'Opciones Contractuales: Análisis en detalle de la Opción F, así como fundamentos y variaciones entre las demás opciones previstas en el estándar NEC.',
        'Cláusulas Secundarias y Casuística: Revisión de las cláusulas secundarias más utilizadas y análisis de casos prácticos respaldados en infraestructura y proyectos G2G.',
    ],

    // 3. Temario del curso (Cláusulas principales 10-90, opciones y cláusulas secundarias según página 2 del documento oficial)
    'syllabus_intro'      => 'El programa se estructura según el contenido oficial del contrato colaborativo NEC-3/4:',
    'syllabus'            => [
        [
            'title'   => 'Cláusulas Principales (Secciones 10 a 90)',
            'icon'    => 'fa-solid fa-file-contract',
            'content' => '<ul><li><strong>Sección 10:</strong> General.</li><li><strong>Sección 20:</strong> Responsabilidades principales del contratista.</li><li><strong>Sección 30:</strong> Gestión del Tiempo.</li><li><strong>Sección 40:</strong> Pruebas y Defectos.</li><li><strong>Sección 50:</strong> Pagos.</li><li><strong>Sección 60:</strong> Eventos Compensables.</li><li><strong>Sección 70:</strong> Titularidad.</li><li><strong>Sección 80:</strong> Seguros y Responsabilidades.</li><li><strong>Sección 90:</strong> Terminación.</li></ul>',
        ],
        [
            'title'   => 'Opciones Contractuales NEC',
            'icon'    => 'fa-solid fa-sliders',
            'content' => '<ul><li>Opción F: Fundamentos, alcances y aplicación práctica.</li><li>Fundamentos y variaciones entre las demás opciones previstas en el contrato NEC.</li></ul>',
        ],
        [
            'title'   => 'Cláusulas Secundarias y Casuística',
            'icon'    => 'fa-solid fa-list-check',
            'content' => '<ul><li>Cláusulas secundarias más utilizadas en los contratos NEC.</li><li>Casos prácticos respaldados basados en megaproyectos y esquemas G2G (Juegos Panamericanos Lima 2019).</li></ul>',
        ],
    ],

    // 4. Perfil docente (Ing. Jaime Curo - Páginas 1 y 4 del documento oficial)
    'docente'             => [
        'photo'          => 'img/docentes/jaime-curo.png',
        'photo_webp'     => 'img/docentes/jaime-curo.webp',
        'photo_alt'      => 'Ing. Jaime Curo, docente de Contrato Colaborativo NEC 3/4',
        'alt'            => 'Ing. Jaime Curo, docente de Contrato Colaborativo NEC 3/4',
        'name'           => 'Ing. Jaime Curo',
        'experience_tag' => '+17 años de experiencia',
        'credentials'    => ['Ing. Industrial', 'Especialista en Contratos NEC', '+17 años de experiencia'],
        'summary'        => 'Ingeniero Industrial con experiencia profesional en organizaciones de gran envergadura, nacionales e internacionales en los rubros de oil & gas, minería y construcción. Altamente competente para asumir responsabilidades, retos y toma de decisiones eficaces bajo un liderazgo participativo. Cuenta con más de 17 años de experiencia en las áreas de compras, logística, proyectos y administración de contratos, con amplio conocimiento en temas de Supply Chain, Gestión de Procura, Gestión de Riesgos, Proyectos EPC, EPCM, Contratos NEC (New Engineering Contract) y Gestión de Proyectos de gran envergadura.',
        'highlights'     => [
            '<strong>Especialista Contractual:</strong> Amplia trayectoria en administración de contratos colaborativos NEC (NEC3 y NEC4), estructuración de procura y mitigación de riesgos en proyectos EPC y EPCM.',
            '<strong>Proyectos de Gran Envergadura y Esquemas G2G:</strong> Participación destacada como Coordinador de Contratos en Escuelas Bicentenarios PEIP-EB, Administrador Contractual en ARCC y Especialista en Logística para los Juegos Panamericanos Lima 2019.',
            '<strong>Liderazgo en Cadena de Suministro:</strong> Sólida experiencia directiva como Gerente de Cadena de Suministro en Stork-Fluor y ejecutivo en compras y logística en Wood y Graña y Montero.',
        ],
        'full_bio_items' => [
            '<strong>G2G Escuelas Bicentenarios PEIP-EB:</strong> Coordinador de Contratos.',
            '<strong>G2G ARCC:</strong> Administrador Contractual.',
            '<strong>G2G Lima 2019 Juegos Panamericanos:</strong> Especialista en Logística.',
            '<strong>Wood:</strong> Ejecutivo de Compras y Logística.',
            '<strong>Stork-Fluor:</strong> Gerente de Cadena de Suministro.',
            '<strong>Graña y Montero:</strong> Compras y Logística.',
            '<strong>Minera CMSS:</strong> Supervisor de Logística.',
            '<strong>MG Rocsa:</strong> Planificador de la Demanda.',
        ],
        'recognition'    => 'Profesional de destacada trayectoria en administración de contratos colaborativos NEC y gestión de la cadena de suministro en megaproyectos de infraestructura y esquemas de gobierno a gobierno.',
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
    'hours'               => '16 horas netas',
    'pdu_count'           => '16 PDU',
    'duration_hours'      => '16 horas netas',
    'pdu_heading'         => 'Unidades de desarrollo profesional (16 PDU)',
    'pdu_title'           => 'Unidades de desarrollo profesional (16 PDU)',
    'pdu_text'            => 'Si tienes certificación del PMI® este curso te brinda 16 PDU (<em>Professional Development Unit</em>) para mantener tu certificación según la descripción provista por el PMI®: Categoría PMI® CCR: <em>General Education Third-Party Provider</em> – The PMI Talent Triangle®. Duración total: <strong>16 horas netas</strong>.',

    // 7. Información e inscripción (Sin brochure público)
    'enroll_bg_image'     => 'img/capacitaciones/contrato-colaborativo-nec-3-4.webp',
    'whatsapp_url'        => 'https://api.whatsapp.com/send?phone=51993463118&text=' . urlencode('Hola Quality Consulting Solutions, deseo solicitar información sobre el curso de Contrato Colaborativo NEC 3/4.'),
    'whatsapp_btn_text'   => 'Solicitar información por WhatsApp',
    'modal_service'       => 'Contrato Colaborativo NEC 3/4',
    'paypal_slug'         => 'contrato-colaborativo-nec-3-4',
    'first_class_label'   => 'Primera clase del curso – USD 10',
    'back_area_url'       => '/capacitacion-contratos',
    'back_area_title'     => 'Volver a Gestión de Contratos',
    'videos'              => [],
];

echo $this->partial('course_detail_unified', ['course' => $course]);

