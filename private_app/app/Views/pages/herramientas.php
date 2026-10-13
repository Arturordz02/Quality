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
    'hero_badge'          => 'ÁREA DE GESTIÓN DE LA CALIDAD • 6 HORAS NETAS • 6 PDU',
    'hero_badge_icon'     => 'fa-solid fa-toolbox',
    'title'               => 'TALLER DE HERRAMIENTAS DE GESTIÓN DE CALIDAD EN LA CONSTRUCCIÓN + USO DE INTELIGENCIA ARTIFICIAL',
    'summary'             => 'Aplicación práctica y colaborativa de herramientas de análisis, diagnóstico y control estadístico de la calidad en proyectos de construcción, integrando indicadores para Last Planner® System y el uso de Inteligencia Artificial.',
    'hero_cards'          => [
        [
            'icon'  => 'fa-solid fa-toolbox',
            'title' => 'HERRAMIENTAS & USOS AI',
            'desc'  => 'Ishikawa, Pareto, afinidad, gráficos de control estadístico y Prompts de Inteligencia Artificial aplicados a obra.',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '6 HORAS NETAS & 6 PDU',
            'desc'  => 'Otorga 6 PDU para mantener tu certificación vigente (Categoría CCR – The PMI Talent Triangle®).',
        ],
        [
            'icon'  => 'fa-solid fa-chart-line',
            'title' => 'LAST PLANNER® SYSTEM',
            'desc'  => 'Medición de indicadores PPC, PPC+, PPC++, PPQ y PPR integrados con panel interactivo en Google Data Studio.',
        ],
        [
            'icon'  => 'fa-solid fa-certificate',
            'title' => 'DIPLOMA Y BOLSA LABORAL',
            'desc'  => 'Diploma digital de Quality Consulting Solutions, material digital e ingreso a la base de datos laboral institucional.',
        ],
    ],

    // 2. Objetivo del curso
    'objective'           => 'Aplicar herramientas colaborativas para realizar la gestión de calidad aplicada a la construcción a través del análisis y el diagnóstico. <strong>Se incluirá el uso de la INTELIGENCIA ARTIFICIAL</strong>, casos de estudio en obra, diagramas causa-efecto, Pareto, control estadístico y paneles interactivos en Google Data Studio.',
    'objective_image'     => '',
    'objective_image_webp'=> '',
    'objective_image_alt' => 'Taller de Herramientas de Gestión de Calidad en la Construcción',
    'objective_highlights'=> [
        'Diagnóstico situacional de obra: por qué medir la gestión de la calidad únicamente en función del estatus de no conformidades no es suficiente.',
        'Elaboración colaborativa de diagramas de Ishikawa y diagramas de afinidad basados en casos reales de proyectos.',
        'Priorización mediante análisis de Pareto con base de datos real, gráficos de control estadístico y tableros en Google Data Studio.',
    ],

    // 3. Temario del curso (8 módulos según el brochure)
    'syllabus_intro'      => 'Programa estructurado en 8 módulos prácticos enfocados en el diagnóstico, análisis causal, indicadores avanzados de calidad y herramientas de Inteligencia Artificial.',
    'syllabus'            => [
        [
            'title'   => 'Caso de Estudio en Construcción',
            'icon'    => 'fa-solid fa-file-contract',
            'content' => '<p>Presentación y análisis de un caso de estudio real de proyecto de construcción. Diagnóstico situacional de obra y fundamentos de por qué medir la gestión de la calidad sólo en función del estatus de no conformidades no es suficiente.</p>',
        ],
        [
            'title'   => 'Diagrama de Ishikawa (Basado en el Caso)',
            'icon'    => 'fa-solid fa-code-branch',
            'content' => '<p>Elaboración colaborativa del diagrama de causa-efecto (Ishikawa) aplicado al caso de estudio de obra. Identificación sistemática, categorización y análisis de las causas raíz de desviaciones y fallas de calidad.</p>',
        ],
        [
            'title'   => 'Diagrama de Afinidad (Basado en el Caso)',
            'icon'    => 'fa-solid fa-diagram-project',
            'content' => '<p>Construcción colaborativa del diagrama de afinidad a partir de los hallazgos del caso de estudio. Agrupación metódica de ideas, opiniones técnicas y hechos para estructurar planes de acción consensuados en equipo.</p>',
        ],
        [
            'title'   => 'Diagrama de Pareto (con Base de Datos Real)',
            'icon'    => 'fa-solid fa-chart-column',
            'content' => '<p>Aplicación de la regla 80/20 para la priorización de problemas de calidad en construcción. Se brindará una base de datos real de proyecto para procesar frecuencias, porcentajes acumulados y focalizar recursos en las causas vitales.</p>',
        ],
        [
            'title'   => 'Diagrama de Control Estadístico',
            'icon'    => 'fa-solid fa-chart-line',
            'content' => '<p>Introducción y aplicación práctica del control estadístico de procesos en la construcción. Elaboración e interpretación de gráficos de control para evaluar la estabilidad, variabilidad y límites de control en operaciones de obra.</p>',
        ],
        [
            'title'   => 'Indicadores para Last Planner® System',
            'icon'    => 'fa-solid fa-list-check',
            'content' => '<p>Integración de la gestión de la calidad con Lean Construction mediante el cálculo, análisis y monitoreo de indicadores clave: Porcentaje del Plan Cumplido (PPC), PPC+, PPC++, Porcentaje del Plan de Calidad (PPQ) y Porcentaje de Plan Replanificado (PPR).</p>',
        ],
        [
            'title'   => 'Panel con Google Data Studio',
            'icon'    => 'fa-solid fa-table-columns',
            'content' => '<p>Diseño y configuración de un panel de control interactivo (Dashboard) en Google Data Studio / Looker Studio. Conexión de fuentes de datos de obra para la visualización en tiempo real de indicadores de calidad y cumplimiento.</p>',
        ],
        [
            'title'   => 'Uso de Inteligencia Artificial en Gestión de la Calidad',
            'icon'    => 'fa-solid fa-robot',
            'content' => '<p>Aplicación práctica de herramientas de Inteligencia Artificial para el análisis de calidad en construcción: evaluación de enunciados de no conformidades, generación de prompts especializados y elaboración de resúmenes de diagnóstico.</p>',
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
            'title' => 'Descuentos exclusivos',
            'text'  => 'Alerta temprana de descuento para futuros cursos.',
        ],
        [
            'icon'  => 'fa-regular fa-file-lines',
            'title' => 'Material digital',
            'text'  => 'Material digital del curso (formatos y plantillas en línea).',
        ],
        [
            'icon'  => 'fa-solid fa-certificate',
            'title' => 'Diploma digital',
            'text'  => 'Diploma digital a nombre de Quality Consulting Solutions.',
        ],
        [
            'icon'  => 'fa-solid fa-users-viewfinder',
            'title' => 'Sesiones exclusivas',
            'text'  => 'Ingreso a sesiones virtuales de contenidos exclusivos sin costo adicional.',
        ],
    ],
    'pdu_text'            => 'Si cuentas con certificación del PMI®, este taller otorga 6 PDU (<em>Professional Development Units</em>) para el mantenimiento de tu certificación. Categoría PMI® CCR: <em>General Education (Third-Party Provider – The PMI Talent Triangle®)</em>. Duración total: <strong>6 horas netas</strong>.',
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
