<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Detalle: Seminario Cambios en la ISO 9001:2026
 * Archivo: private_app/app/Views/pages/seminario-iso-9001-2026.php
 * Plantilla base compartida: app/Views/partials/course_detail_unified.php
 */

declare(strict_types=1);

$course = [
    // 1. Hero Banner
    'hero_badge'      => 'SEMINARIO ESPECIALIZADO EN VIVO',
    'hero_badge_icon' => 'fa-solid fa-clipboard-check',
    'title'           => 'CAMBIOS EN LA ISO 9001:2026',
    'summary'         => 'Análisis técnico y prospectivo sobre la evolución, estructura, nuevos enfoques y criterios de interpretación de la futura revisión de la norma internacional ISO 9001, con análisis de casos prácticos de aplicación en construcción.',
    'hero_cards'      => [
        [
            'icon'  => 'fa-solid fa-list-check',
            'title' => 'CRITERIOS DE INTERPRETACIÓN',
            'desc'  => 'Análisis comparativo de requisitos, definiciones y directrices de transición para sistemas de calidad.',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '06 PDU OFICIALES',
            'desc'  => 'Unidades de desarrollo profesional para mantener la vigencia de certificaciones del PMI®.',
        ],
        [
            'icon'  => 'fa-solid fa-video',
            'title' => 'CASOS PRÁCTICOS EN VIDEO',
            'desc'  => 'Estudio de casos reales de construcción mediante soporte audiovisual y debate técnico.',
        ],
    ],

    // 2. Objetivo del curso
    'objective'            => 'Analizar de forma integral y fundamentada las tendencias de evolución, definiciones clave y principales cambios previstos para el estándar internacional <strong>ISO 9001</strong>, proporcionando criterios técnicos de interpretación y evaluando su impacto práctico en los sistemas de gestión de la calidad dentro del sector construcción e ingeniería de infraestructura.',
    'objective_image'      => '',
    'objective_image_webp' => '',
    'objective_image_alt'  => 'Auditoría y gobernanza de sistemas de gestión de la calidad ISO 9001',
    'objective_highlights' => [
        'Evaluación de índices comparativos entre revisiones normativas y nuevas directrices.',
        'Criterios de interpretación técnica aplicados a procesos de ingeniería, procura y obra.',
        'Metodología orientada a la gobernanza de calidad y prevención de no conformidades.',
        'Estudio aplicado de casos reales mediante soporte audiovisual.',
    ],

    // 3. Temario del curso
    'syllabus_intro'       => 'Estructura curricular modular dividida en fundamentos normativos y aplicación práctica con casos de estudio:',
    'syllabus'             => [
        [
            'title'   => 'Fundamentos, definiciones e índices comparativos',
            'icon'    => 'fa-solid fa-scale-balanced',
            'content' => '<p>Bases conceptuales y antecedentes de la evolución de la norma ISO 9001. Análisis de índices comparativos respecto a ediciones anteriores, nuevas definiciones y fundamentos rectores del aseguramiento de la calidad en organizaciones de construcción.</p>',
        ],
        [
            'title'   => 'Principales cambios y evolución de cláusulas',
            'icon'    => 'fa-solid fa-arrows-split-up-and-left',
            'content' => '<p>Desglose de las modificaciones proyectadas en los requisitos del sistema: contexto de la organización, liderazgo y compromiso, planificación estratégica basada en riesgos, control operacional y gestión de la información documentada.</p>',
        ],
        [
            'title'   => 'Criterios de interpretación técnica para obras y proyectos',
            'icon'    => 'fa-solid fa-compass-drafting',
            'content' => '<p>Pautas de interpretación aplicadas a contratos de infraestructura civil y edificación. Adaptación de planes de inspección y ensayo (PPI), trazabilidad, aseguramiento de subcontratistas y alineamiento con estándares contractuales internacionales.</p>',
        ],
        [
            'title'   => 'Aplicación práctica - Presentación de casos en video',
            'icon'    => 'fa-solid fa-film',
            'content' => '<p>Análisis y discusión técnica del Caso 1 y Caso 2 en formato audiovisual: lecciones aprendidas en auditorías reales, tratamiento eficaz de no conformidades, acciones correctivas y mejora continua en entornos de obra.</p>',
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
        'summary'        => 'Profesional con más de 25 años de experiencia en el Sector Construcción, Gestión de Proyectos, Riesgos y Calidad en empresas líderes en el Perú y el extranjero. Experiencia docente en principales universidades, ponente en prestigiosos congresos, contribuidor registrado de estándares fundacionales del PMI® (PMBOK® 7ma Edición 2021 y Estándar de Riesgos del PMI®) y autor de libros técnicos especializados.',
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
            '<strong>Congreso Regional del PMI, Lima 2008:</strong> Expositor.',
            '<strong>Comité de la Calidad de CAPECO:</strong> Presidente.',
            '<strong>Revista Construcción e Industria (CAPECO) & Revista El Constructivo:</strong> Columnista.',
            '<strong>ASQ Perú:</strong> LMC executive board member.',
        ],
        'recognition'    => 'Contribuidor registrado del PMBOK® 7ma Edición 2021 y del Estándar de Riesgos del PMI®.',
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
            'text'  => 'Tarifas preferenciales de descuento para futuras capacitaciones y programas de actualización.',
        ],
        [
            'icon'  => 'fa-solid fa-certificate',
            'title' => 'Diploma digital oficial',
            'text'  => 'Certificado digital de participación emitido a nombre de Quality Consulting Solutions.',
        ],
        [
            'icon'  => 'fa-solid fa-file-pdf',
            'title' => 'Material digital del seminario',
            'text'  => 'Entrega completa de presentaciones, diapositivas y guías técnicas de interpretación.',
        ],
        [
            'icon'  => 'fa-solid fa-clock-rotate-left',
            'title' => 'Acceso a grabaciones por 4 semanas',
            'text'  => 'Acceso vía internet a la grabación de las sesiones durante 4 semanas tras la finalización del seminario.',
        ],
    ],
    'pdu_heading'          => 'Unidades de desarrollo profesional (06 PDU)',
    'pdu_text'             => '06 PDU oficiales para mantener tu certificación del Project Management Institute (PMI®). Válidas dentro de las categorías de formación profesional continua (CCR).',

    // 6. Información e inscripción
    'enroll_bg_image'      => '',
    'whatsapp_url'         => 'https://api.whatsapp.com/send?phone=51993463118&text=' . urlencode('Hola Quality Consulting Solutions, deseo información sobre el Seminario Cambios en la ISO 9001:2026.'),
    'modal_service'        => 'Seminario ISO 9001:2026',
    'paypal_slug'          => 'seminario-iso-9001-2026',

    // 7. Videos (No declarados en este brochure)
    'videos'               => [],
];

echo $this->partial('course_detail_unified', ['course' => $course]);

