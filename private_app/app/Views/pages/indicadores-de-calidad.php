<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Detalle: Seminario Indicadores Avanzados de Calidad en la Construcción
 * Archivo: private_app/app/Views/pages/indicadores-de-calidad.php
 * Plantilla base compartida: app/Views/partials/course_detail_unified.php
 */

declare(strict_types=1);

$course = [
    // 1. Hero Banner
    'hero_badge'      => 'SEMINARIO ESPECIALIZADO DE CALIDAD',
    'hero_badge_icon' => 'fa-solid fa-chart-pie',
    'title'           => 'INDICADORES AVANZADOS DE CALIDAD EN LA CONSTRUCCIÓN',
    'summary'         => 'Diseño, formulación e interpretación de KPIs avanzados de calidad en obra: métricas de completion (Q6, Q6\', WIP), integración Lean Construction (PPC+, PPC++, PPCQ, PPCR), gestión de restricciones e indicadores estocásticos para la toma de decisiones basada en datos.',
    'hero_cards'      => [
        [
            'icon'  => 'fa-solid fa-gauge-high',
            'title' => 'KPIS DETERMINÍSTICOS Y ESTOCÁSTICOS',
            'desc'  => 'Métricas avanzadas para monitorear y predecir el ritmo de liberación de calidad en obra.',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '04 PDU OFICIALES',
            'desc'  => 'Horas acreditadas en el PMI Talent Triangle® para el mantenimiento de credenciales.',
        ],
        [
            'icon'  => 'fa-solid fa-diagram-project',
            'title' => 'INTEGRACIÓN LEAN CONSTRUCTION',
            'desc'  => 'Métricas reconocidas por IGLC articuladas con el sistema Last Planner®.',
        ],
    ],

    // 2. Objetivo del curso
    'objective'            => 'Brindar las bases metodológicas y analíticas para la definición, estructuración y control de <strong>indicadores avanzados de calidad</strong> en proyectos de construcción, superando las limitaciones de los reportes tradicionales mediante métricas cuantitativas de compleción, articulación con Last Planner® System y formulación de modelos probabilísticos y estocásticos para la prevención de fallas.',
    'objective_image'      => '',
    'objective_image_webp' => '',
    'objective_image_alt'  => 'Panel de control y métricas avanzadas de calidad en construcción',
    'objective_highlights' => [
        'Bases conceptuales sólidas para la definición matemática de indicadores operativos.',
        'Metodologías reconocidas internacionalmente por el International Group for Lean Construction (IGLC).',
        'Métricas de compleción y seguimiento del trabajo en proceso (Q6, Q6\', WIP).',
        'Articulación de indicadores determinísticos y estocásticos (Rpa, Rw) para la gestión predictiva.',
    ],

    // 3. Temario del curso
    'syllabus_intro'       => 'Estructura curricular enfocada en fundamentos de medición, KPIs operativos, restricciones y modelado estocástico:',
    'syllabus'             => [
        [
            'title'   => 'Bases para la definición de indicadores de calidad',
            'icon'    => 'fa-solid fa-shapes',
            'content' => '<p>Criterios metodológicos para la definición y diseño de indicadores de calidad en proyectos de edificación e infraestructura. Atributos de confiabilidad, periodicidad, sensibilidad e interpretabilidad. Alineamiento entre objetivos de calidad de la organización y el desempeño real en terreno.</p>',
        ],
        [
            'title'   => 'Indicadores de Completion: Q6, Q6\' y WIP de Calidad',
            'icon'    => 'fa-solid fa-chart-line',
            'content' => '<p>Cálculo y seguimiento del porcentaje de entregables liberados frente a partidas pendientes. Control del Work In Progress (WIP) en partidas críticas de arquitectura e instalaciones. Determinación de los índices Q6 y Q6\' para la detección temprana de cuellos de botella antes de la entrega final.</p>',
        ],
        [
            'title'   => 'Lean Construction y Calidad: PPC+, PPC++, PPCQ y PPCR',
            'icon'    => 'fa-solid fa-industry',
            'content' => '<p>Integración de los estándares de calidad con el Last Planner® System. Formulación y análisis de indicadores ampliados de confiabilidad del plan: PPC+ (Porcentaje de Plan Cumplido con calidad), PPC++, PPCQ (calidad certificada) y PPCR (reprogramaciones y restricciones liberadas).</p>',
        ],
        [
            'title'   => 'Gestión de Restricciones (Wp, Hp) e Indicadores Estocásticos (Rpa, Rw)',
            'icon'    => 'fa-solid fa-calculator',
            'content' => '<p>Cuantificación del impacto de restricciones operativas en el flujo de producción (Wp, Hp). Introducción al análisis probabilístico y estocástico de la calidad: cálculo e interpretación de los indicadores Rpa y Rw para la toma de decisiones ejecutivas basada en datos objetivos.</p>',
        ],
    ],

    // 4. Perfil docente
    'docente'              => [
        'photo'          => 'img/Omar_Samaniego.png',
        'photo_webp'     => 'img/Omar_Samaniego.webp',
        'name'           => 'Ing. Omar A. Samaniego',
        'experience_tag' => '+25 años de experiencia',
        'credentials'    => [
            'Master',
            'NEC4',
            'VDC - Stanford',
            'PMP®',
            'PMI-RMP®',
            'LSS Black Belt',
        ],
        'summary'        => 'Profesional con más de 25 años de experiencia en el Sector Construcción, Gestión de Proyectos, Riesgos y Calidad en empresas líderes en el Perú y el extranjero. Experiencia docente en principales universidades, ponente en prestigiosos congresos, contribuidor registrado de estándares fundacionales del PMI® (PMBOK® 8va Edición 2025 y Estándar de Riesgos del PMI®) y autor de libros técnicos.',
        'highlights'     => [
            '<strong>Director:</strong> Quality Consulting Solutions.',
            '<strong>IDOM (España):</strong> Risk Manager.',
            '<strong>Gleeds (UK):</strong> Risk & Quality Manager.',
            '<strong>Graña y Montero:</strong> Jefe Corporativo del Área de Calidad de GyM.',
            '<strong>Buenaventura Ingenieros:</strong> Gerente de Proyectos.',
        ],
        'full_bio_items' => [
            '<strong>Cosapi:</strong> Jefe de Calidad.',
            '<strong>Bechtel:</strong> Líder de Calidad Electromecánico.',
            '<strong>Universidad Peruana de Ciencias Aplicadas (UPC):</strong> Catedrático de Postgrado.',
            '<strong>MDI Centrum:</strong> Catedrático de Gestión de la Calidad.',
            '<strong>Congreso Global del PMI, Washington D.C. 2010:</strong> Expositor.',
            '<strong>Comité de la Calidad de CAPECO:</strong> Presidente.',
            '<strong>Revista Construcción e Industria (CAPECO) & Revista El Constructivo:</strong> Columnista.',
            '<strong>ASQ Perú:</strong> LMC executive board member.',
        ],
        'recognition'    => 'Metodologías reconocidas internacionalmente por el International Group for Lean Construction (IGLC). Contribuidor registrado del PMBOK® 8va Edición 2025.',
    ],

    // 5. Beneficios y materiales
    'benefits'             => [
        [
            'icon'  => 'fa-solid fa-briefcase',
            'title' => 'Bolsa laboral',
            'text'  => 'Ingreso a la base de datos laboral de Quality Consulting Solutions.',
        ],
        [
            'icon'  => 'fa-solid fa-tag',
            'title' => 'Descuento para futuros cursos',
            'text'  => 'Tarifas preferenciales de descuento para futuras capacitaciones con precios ordinarios.',
        ],
        [
            'icon'  => 'fa-solid fa-certificate',
            'title' => 'Diploma digital oficial',
            'text'  => 'Diploma digital de participación emitido a nombre de Quality Consulting Solutions.',
        ],
        [
            'icon'  => 'fa-solid fa-file-excel',
            'title' => 'Material digital y métricas',
            'text'  => 'Entrega completa de material digital con hojas de formulación y tableros de indicadores.',
        ],
        [
            'icon'  => 'fa-solid fa-clock-rotate-left',
            'title' => 'Acceso a grabaciones por 4 semanas',
            'text'  => 'Acceso vía internet a la grabación del curso luego de finalizado durante 4 semanas.',
        ],
    ],
    'pdu_heading'          => 'Unidades de desarrollo profesional (04 PDU)',
    'pdu_text'             => '04 PDU para mantener tu certificación del Project Management Institute (PMI®) en las categorías de Strategic and Business Management y Technical Project Management dentro del PMI Talent Triangle®.',

    // 6. Información e inscripción
    'enroll_bg_image'      => '',
    'whatsapp_url'         => 'https://api.whatsapp.com/send?phone=51993463118&text=' . urlencode('Hola Quality Consulting Solutions, deseo información sobre el Seminario Indicadores Avanzados de Calidad en la Construcción.'),
    'modal_service'        => 'Seminario Indicadores Avanzados de Calidad en la Construcción',
    'paypal_slug'          => 'indicadores-de-calidad',

    // 7. Videos (No declarados en este brochure)
    'videos'               => [],
];

echo $this->partial('course_detail_unified', ['course' => $course]);

