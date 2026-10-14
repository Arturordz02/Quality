<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Gestión de Riesgos, Cambios y Reclamos en la Construcción (Diseño Unificado)
 * Archivo: app/Views/pages/gestion-de-riesgos.php
 */

declare(strict_types=1);

$course = [
    'hero_badge'          => 'CONTROL DE PLAZO Y ALCANCE • 14 HORAS NETAS • ACREDITACIÓN PMI®',
    'hero_badge_icon'     => 'fa-solid fa-scale-balanced',
    'title'               => 'GESTIÓN DE RIESGOS, CAMBIOS Y RECLAMOS EN EL PLAZO Y ALCANCE EN LA CONSTRUCCIÓN',
    'summary'             => 'Aprende los principios y criterios técnicos para la gestión de cambios, administración de reclamos y control de riesgos del plazo y alcance en proyectos de construcción, impartido por el Ing. Víctor Viteri Valiente.',
    'hero_cards'          => [
        [
            'icon'  => 'fa-solid fa-clock',
            'title' => '14 HORAS NETAS',
            'desc'  => 'Formación práctica intensiva enfocada en lecciones de campo y gobernanza contractual.',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '14 PDU ACREDITADAS',
            'desc'  => '14 PDU otorgadas ante el PMI® bajo el modelo The PMI Talent Triangle®.',
        ],
        [
            'icon'  => 'fa-solid fa-user-shield',
            'title' => 'DIRECCIÓN PMO CBRE',
            'desc'  => 'A cargo de un Director PMO con más de 23 años liderando obras EPCM y contratos de envergadura.',
        ],
        [
            'icon'  => 'fa-solid fa-video',
            'title' => 'GRABACIONES Y CAMPUS',
            'desc'  => 'Acceso virtual a las grabaciones durante 4 semanas con materiales descargables.',
        ],
    ],
    'objective'           => 'Entender y aplicar los principios y criterios específicos de la gestión de cambios en los proyectos de construcción, aunado a la gestión de reclamos y riesgos del plazo y alcance, así como la relación de la gestión del cambio con la gestión de portafolios y programas.',
    'objective_highlights'=> [
        'Articulación de la gestión de cambios con la gestión estratégica de portafolios y programas.',
        'Evaluación y tratamiento del riesgo en alcance, cronograma, contrataciones, calidad y costos.',
        'Estrategias de recuperación de plazo: aceleraciones, convergencias y mitigación de retrasos.',
        'Manejo técnico de variaciones de método constructivo, metrados adicionales y resolución de disputas.',
    ],
    'syllabus_intro'      => 'El programa abarca 8 ejes modulares para el control integral de riesgos, cambios y reclamos en proyectos de obra:',
    'syllabus'            => [
        [
            'title'   => 'Fundamentos de Portafolios, Programas y Proyectos',
            'icon'    => 'fa-solid fa-sitemap',
            'content' => '<p>Se presentan los conceptos y diferencias que definen los portafolios, programas y proyectos, así como sus propósitos estratégicos en organizaciones del sector construcción.</p>',
        ],
        [
            'title'   => 'Gestión de Riesgos en el Proyecto',
            'icon'    => 'fa-solid fa-shield-halved',
            'content' => '<p>Se profundiza en los conceptos clave de la gestión de riesgos y las bases para estructurar un sistema robusto y preventivo de riesgos para el proyecto de construcción.</p>',
        ],
        [
            'title'   => 'Riesgo de Alcance, Cronograma, Contrataciones, Calidad y Costos',
            'icon'    => 'fa-solid fa-chart-pie',
            'content' => '<p>Se presentan los riesgos particulares del alcance, cronograma, contrataciones, calidad y costos, junto con los criterios generales para abordarlos a efectos de reducir su probabilidad e impacto.</p>',
        ],
        [
            'title'   => 'Gestión de Cambios en Portafolios, Programas y Proyectos',
            'icon'    => 'fa-solid fa-arrows-split-up-and-left',
            'content' => '<p>Se exponen los lineamientos y particularidades de la gestión de cambios para portafolios, programas y proyectos, así como los aspectos comunes y diferenciadores enmarcados en un sistema general de gestión de cambios.</p>',
        ],
        [
            'title'   => 'El Cambio del Plazo',
            'icon'    => 'fa-solid fa-business-time',
            'content' => '<p>Se presentan estrategias prácticas como recuperaciones, aceleraciones y convergencias, fundamentales para abordar los riesgos en el cumplimiento de los plazos establecidos contractualmente.</p>',
        ],
        [
            'title'   => 'Cambios de Alcance',
            'icon'    => 'fa-solid fa-ruler-combined',
            'content' => '<p>Se exponen las variaciones de método constructivo, cantidades y trabajos adicionales que afectan la línea base del alcance del proyecto, y se presentan criterios técnicos para la evaluación integral de las variaciones.</p>',
        ],
        [
            'title'   => 'Cambio de Contrataciones',
            'icon'    => 'fa-solid fa-file-contract',
            'content' => '<p>Se analizan los cambios que afectan el contrato de ejecución, servicios y procura durante la vida del proyecto, así como los casos particulares de administración de estos cambios contractuales.</p>',
        ],
        [
            'title'   => 'Gestión de Reclamos y Disputas',
            'icon'    => 'fa-solid fa-gavel',
            'content' => '<p>Se presenta el esquema formal de escalamiento de reclamos y controversias técnicas, así como los medios y mecanismos idóneos para abordarlos vía conciliaciones, dispute boards y arbitrajes.</p>',
        ],
    ],
    'docente'             => [
        'name'            => 'Ing. Víctor Viteri Valiente',
        'experience_tag'  => 'Más de 23 años de experiencia',
        'credentials'     => ['ING.', 'MBA', 'PMP®', 'APEC'],
        'summary'         => 'Ingeniero Civil APEC, MBA y Project Management Professional (PMP®) con más de 23 años de trayectoria en la industria de la construcción, desempeñando cargos de Director PMO, Gerente de Operaciones, Gerente de Proyectos, Superintendente y Administrador de Contratos en corporaciones de primer nivel.',
        'highlights'      => [
            'Project Management Director en <strong>CBRE Peru</strong>: gestión y desarrollo del portafolio de proyectos en el Perú (Gerencia y Consultoría de Obra, PMO, aliados estratégicos, seguridad y calidad).',
            'Consultor en <strong>Global Resource Solutions (GRS Consultants)</strong>: dirección de propuestas, coordinación con aliados estratégicos, planificación, control y calidad de servicios.',
            'Gerente de Proyectos en <strong>Skanska</strong>: dirección de programas de proyectos, planificación y control de recursos alineados a seguridad, calidad, costo y plazo.',
            'Gerente de Proyecto en <strong>San Martín Contratistas Generales</strong> y en <strong>Buenaventura Ingenieros</strong> (desarrollo integral de proyectos EPCM, EPC y EC).',
            'Administrador de Contratos en <strong>DOE RUN</strong> (elaboración, adjudicación y administración contractual del proyecto PAMA).',
            'Jefe de Oficina Técnica Senior en <strong>Graña y Montero</strong>: construcción de Planta de Procesos Cerro Corona y blindaje del Pique «El Platanal».',
        ],
    ],
    'benefits'            => [
        [
            'icon'  => 'fa-solid fa-award',
            'title' => 'Certificación de 14 PDU',
            'text'  => '14 PDU oficiales ante el PMI® para mantener vigentes tus credenciales profesionales.',
        ],
        [
            'icon'  => 'fa-solid fa-certificate',
            'title' => 'Diploma Digital Oficial',
            'text'  => 'Diploma digital a nombre de Quality Consulting Solutions incluido en la inversión.',
        ],
        [
            'icon'  => 'fa-solid fa-file-shield',
            'title' => 'Material Técnico Digital',
            'text'  => 'Entrega de material digital, plantillas de gestión de cambios y formatos de reclamo.',
        ],
        [
            'icon'  => 'fa-solid fa-video',
            'title' => 'Grabaciones por 4 Semanas',
            'text'  => 'Acceso virtual a las grabaciones de las sesiones para repaso y consulta continua.',
        ],
        [
            'icon'  => 'fa-solid fa-users',
            'title' => 'Bolsa Laboral Institucional',
            'text'  => 'Ingreso a la base de datos laboral de profesionales de Quality Consulting Solutions.',
        ],
        [
            'icon'  => 'fa-solid fa-percent',
            'title' => 'Descuento de Ex-alumno',
            'text'  => 'Tarifas preferenciales para futuras capacitaciones y programas ejecutivos.',
        ],
    ],
    'pdu_title'           => 'Acreditación Oficial de 14 PDU ante el PMI®',
    'pdu_text'            => 'Si tienes certificación del PMI® este curso te brinda <strong>14 PDU</strong> (Professional Development Unit) para mantener tu certificación según la descripción provista por el PMI®: <em>PDU (Professional Development Unit) Categoría PMI® CCR: General Education Third-Party Provider – The PMI Talent Triangle®</em>.',
    'whatsapp_url'        => 'https://wa.me/51993463118?text=' . rawurlencode('Buen día, deseo solicitar información sobre el curso de Gestión de Riesgos, Cambios y Reclamos en la Construcción'),
    'whatsapp_btn_text'   => 'Solicitar información por WhatsApp',
    'modal_service'       => 'Gestión de Riesgos, Cambios y Reclamos en la Construcción',
    'paypal_slug'         => 'gestion-de-riesgos',
    'area_back_url'       => '/capacitacion-riesgos',
    'area_back_title'     => 'Volver al Área de Riesgos',
];

require __DIR__ . '/../partials/course_detail_unified.php';
