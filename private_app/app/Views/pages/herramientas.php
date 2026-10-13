<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Taller de Herramientas de Gestión de Calidad en la Construcción + uso de IA
 * Archivo: app/Views/pages/herramientas.php
 *
 * Basado en la plantilla unificada aprobada: app/Views/partials/course_detail_unified.php
 */

declare(strict_types=1);

$course = [
    // 1. Hero Banner
    'hero_badge'          => 'ÁREA DE GESTIÓN DE LA CALIDAD • 6 HORAS NETAS • 06 PDU',
    'hero_badge_icon'     => 'fa-solid fa-toolbox',
    'title'               => 'TALLER DE HERRAMIENTAS DE GESTIÓN DE CALIDAD EN LA CONSTRUCCIÓN + USO DE INTELIGENCIA ARTIFICIAL',
    'summary'             => 'Aplicación de herramientas colaborativas para realizar la gestión de calidad aplicada a la construcción a través del análisis y el diagnóstico. Se incluirá el uso de la Inteligencia Artificial.',
    'hero_cards'          => [
        [
            'icon'  => 'fa-solid fa-toolbox',
            'title' => 'HERRAMIENTAS & USO DE IA',
            'desc'  => 'Ishikawa, afinidad, Pareto, control estadístico, indicadores Last Planner y el uso de Inteligencia Artificial.',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '06 PDU & 6 HORAS',
            'desc'  => '06 PDU (Professional Development Unit) Categoría PMI® CCR : General Education Third-Party Provider.',
        ],
        [
            'icon'  => 'fa-solid fa-chart-line',
            'title' => 'INDICADORES LAST PLANNER',
            'desc'  => 'Indicadores PPC, PPC+, PPC++, PPQ y PPR, e incluye panel con Google Data Studio.',
        ],
        [
            'icon'  => 'fa-solid fa-certificate',
            'title' => 'BENEFICIOS OFICIALES',
            'desc'  => 'Diploma digital a nombre de Quality Consulting Solutions, material digital e ingreso a la base de datos laboral.',
        ],
    ],

    // 2. Objetivo del curso
    'objective'           => 'Aplicar herramientas colaborativas para realizar la gestión de calidad aplicada a la construcción a través del análisis y el diagnóstico. <strong>Se incluirá el uso de la INTELIGENCIA ARTIFICIAL.</strong>',
    'objective_image'     => '',
    'objective_image_webp'=> '',
    'objective_image_alt' => 'Taller de Herramientas de Gestión de Calidad en la Construcción',
    'objective_highlights'=> [
        'Diagnóstico y análisis: medir la gestión de la calidad sólo en función de estatus de no conformidades no es suficiente.',
        'Elaboración colaborativa: Diagrama de Ishikawa y Diagrama de afinidad basados en el caso de estudio.',
        'Herramientas aplicadas: Diagrama de Pareto (se brindará una base de datos), control estadístico, indicadores Last Planner (PPC, PPC+, PPC++, PPQ, PPR) y panel con Google Data Studio.',
    ],

    // 3. Temario del curso (7 temas según el brochure oficial)
    'syllabus_intro'      => 'Temario oficial estructurado en los 7 temas prácticos de análisis, diagnóstico y medición de la calidad establecidos en el brochure:',
    'syllabus'            => [
        [
            'title'   => 'Caso de estudio',
            'icon'    => 'fa-solid fa-file-contract',
            'content' => '<p>Presentación y desarrollo del caso de estudio aplicado a la construcción. Diagnóstico y análisis: medir la gestión de la calidad sólo en función de estatus de no conformidades no es suficiente.</p>',
        ],
        [
            'title'   => 'Diagrama de Ishikawa (basado en el caso)',
            'icon'    => 'fa-solid fa-code-branch',
            'content' => '<p>Elaboración colaborativa del diagrama de causa-efecto (Ishikawa) basado en el caso de estudio.</p>',
        ],
        [
            'title'   => 'Diagrama de afinidad (basado en el caso)',
            'icon'    => 'fa-solid fa-diagram-project',
            'content' => '<p>Elaboración colaborativa del diagrama de afinidad basado en el caso de estudio para la estructuración y análisis de factores de calidad.</p>',
        ],
        [
            'title'   => 'Diagrama de Pareto (se brindará una base de datos)',
            'icon'    => 'fa-solid fa-chart-column',
            'content' => '<p>Elaboración y aplicación del diagrama de Pareto para el análisis y priorización en calidad. Se brindará una base de datos.</p>',
        ],
        [
            'title'   => 'Diagrama de control estadístico',
            'icon'    => 'fa-solid fa-chart-line',
            'content' => '<p>Aplicación e interpretación del diagrama de control estadístico para el monitoreo y control de calidad en los procesos constructivos.</p>',
        ],
        [
            'title'   => 'Indicadores para Last Planner (PPC, PPC+, PPC++, PPQ y PPR)',
            'icon'    => 'fa-solid fa-list-check',
            'content' => '<p>Medición y análisis de indicadores para Last Planner: PPC (Porcentaje del Plan Cumplido), PPC+, PPC++, PPQ (Porcentaje del Plan de Calidad) y PPR (Porcentaje de Plan Replanificado).</p>',
        ],
        [
            'title'   => 'Panel con Google Data Studio',
            'icon'    => 'fa-solid fa-table-columns',
            'content' => '<p>Configuración y visualización de panel interactivo con Google Data Studio para el seguimiento de indicadores y datos de calidad.</p>',
        ],
    ],

    // 4. Perfil docente (Ing. Omar Samaniego)
    'docente'             => [
        'photo'          => 'img/Omar_Samaniego.png',
        'photo_webp'     => 'img/Omar_Samaniego.webp',
        'name'           => 'Ing. Omar A. Samaniego',
        'experience_tag' => '+25 años de experiencia',
        'credentials'    => ['ING., MASTER', 'NEC4', 'VDC Stanford', 'PMP®', 'PMI-RMP®', 'LSS Black Belt'],
        'summary'        => 'Profesional con más de 25 años de experiencia en Gestión de la Calidad en el Sector Construcción en empresas líderes en el Perú y el extranjero. Experiencia en principales empresas, ponente en prestigiosos congresos, docente de postgrado en principales universidades y contribuidor registrado de estándares fundacionales del PMI®.',
        'highlights'     => [
            '<strong>Gleeds (UK):</strong> Quality Mgmt Lead.',
            '<strong>Quality Consulting Solutions:</strong> Director.',
            '<strong>Graña y Montero (GyM):</strong> Jefe Corporativo del Área de Calidad.',
            '<strong>Buenaventura Ingenieros:</strong> Gerente de Proyectos.',
        ],
        'full_bio_items' => [
            '<strong>Cosapi:</strong> Jefe de Calidad | <strong>Bechtel:</strong> Líder de Calidad Electromecánico.',
            '<strong>Catedrático de Postgrado:</strong> Universidad Peruana de Ciencias Aplicadas (UPC) y MDI Centrum Católica.',
            '<strong>Expositor Internacional:</strong> Congreso Global del PMI (Washington D.C., 2010) y Congreso Regional del PMI (Lima, 2008).',
            '<strong>Liderazgo Institucional:</strong> Presidente del Comité de la Calidad de Capeco, Columnista en Revista El Constructivo y Miembro Directivo de ASQ Perú LMC.',
            '<strong>Colaboración Académica:</strong> Investigaciones en colaboración con el Centro de Ingeniería para Instalaciones Integradas (CIFE) de la Universidad de Stanford.',
        ],
        'recognition'    => 'Contribuidor registrado de estándares fundacionales del Project Management Institute (PMI®) y autor de los libros <em>ISO 9001 para la Construcción</em> y <em>Riesgos Técnicos en la Construcción</em>.',
    ],

    // 5. Beneficios, PDU y Brochure
    'benefits'            => [
        [
            'icon'  => 'fa-solid fa-briefcase',
            'title' => 'Bolsa laboral',
            'text'  => 'Ingreso a la base de datos laboral de Quality Consulting Solutions.',
        ],
        [
            'icon'  => 'fa-solid fa-percent',
            'title' => 'Descuentos futuros',
            'text'  => 'Alerta temprana de descuento para futuros cursos.',
        ],
        [
            'icon'  => 'fa-regular fa-file-lines',
            'title' => 'Material digital',
            'text'  => 'Material digital del curso (formatos en línea).',
        ],
        [
            'icon'  => 'fa-solid fa-certificate',
            'title' => 'Diploma digital',
            'text'  => 'Diploma digital a nombre de Quality Consulting Solutions.',
        ],
        [
            'icon'  => 'fa-solid fa-users-viewfinder',
            'title' => 'Sesiones exclusivas',
            'text'  => 'Ingreso a sesiones virtuales de contenidos exclusivos sin costo.',
        ],
    ],
    'pdu_text'            => '06 PDU (Professional Development Unit) Categoría PMI® CCR : General Education Third-Party Provider. The PMI Talent Triangle®. Duración total: 6 horas netas.',
    'brochure_url'        => 'brochures/calidad/taller-herramientas-gestion-calidad.pdf',
    'brochure_download'   => 'Brochure-Taller-Herramientas-Gestion-Calidad.pdf',
    'brochure_thumb'      => 'img/brochures/portada-taller-herramientas-calidad.png',

    // 6. Información e inscripción
    'enroll_bg_image'     => '',
    'whatsapp_url'        => 'https://api.whatsapp.com/send?phone=51993463118&text=Buen%20d%C3%ADa,%20deseo%20solicitar%20informaci%C3%B3n%20sobre%20el%20Taller%20de%20Herramientas%20de%20Gesti%C3%B3n%20de%20la%20Calidad',
    'modal_service'       => 'Taller de Herramientas de Gestión de Calidad en la Construcción',
    'paypal_slug'         => 'herramientas',
    'videos'              => [],
];

echo $this->partial('course_detail_unified', ['course' => $course]);
