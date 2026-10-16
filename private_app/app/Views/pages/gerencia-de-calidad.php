<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Gerencia de la Calidad en la Construcción (Diseño Basado en Referencia ISO 9001)
 * Archivo: app/Views/pages/gerencia-de-calidad.php
 */

declare(strict_types=1);

$course = [
    'hero_badge'          => 'INCLUYE USOS AI • INDICADORES AVANZADOS • 16 HORAS NETAS',
    'hero_badge_icon'     => 'fas fa-microchip',
    'title'               => 'GERENCIA DE LA CALIDAD APLICADA A LA CONSTRUCCIÓN',
    'summary'             => 'Visión integrada y práctica de la gestión de la calidad mediante conceptos, herramientas de gestión de la calidad y gerencia de proyectos, con aprendizaje de indicadores determinísticos, estocásticos, mixtos y aplicación de Inteligencia Artificial.',
    'hero_cards'          => [
        [
            'icon'  => 'fa-solid fa-chart-line',
            'title' => 'INDICADORES & USOS AI',
            'desc'  => 'Indicadores prácticos determinísticos, estocásticos, integración con Last Planner® System y evaluación con Prompts de IA.',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '16 HORAS NETAS & 16 PDU',
            'desc'  => 'Otorga 16 PDU para mantener tu certificación vigente (Categoría CCR – The PMI Talent Triangle®).',
        ],
        [
            'icon'  => 'fa-solid fa-user-check',
            'title' => 'CONSULTORÍA Y GRABACIÓN',
            'desc'  => 'Incluye 1 hora de consultoría durante el periodo del curso, entrega de material digital y grabación (4 semanas).',
        ],
        [
            'icon'  => 'fa-solid fa-certificate',
            'title' => 'DIPLOMA Y BOLSA LABORAL',
            'desc'  => 'Diploma digital de Quality Consulting Solutions, ingreso a la base de datos laboral y descuentos en futuros cursos.',
        ],
    ],
    'objective'           => 'Capacitar a los participantes en la visión integrada y práctica de la gestión de la calidad, mediante el uso de los conceptos y el empleo de herramientas de gestión de la calidad, y gerencia de proyectos. <strong>Aprendizaje de indicadores determinístico, estocásticos y mixtos.</strong>',
    'objective_image'     => 'img/GERCA1.png',
    'objective_image_webp'=> 'img/GERCA1.webp',
    'objective_image_alt' => 'Gerencia de la Calidad Aplicada a la Construcción',
    'objective_highlights'=> [
        'Integración de la planificación de la calidad con la planificación del proyecto y Last Planner® System.',
        'Configuración de Planes de Puntos de Inspección (PPI), costos de calidad, no conformidades y entrega de obra (completion).',
        'Evaluación de enunciados de no conformidades y resúmenes mediante Prompts de Inteligencia Artificial.',
    ],
    'syllabus_intro'      => 'Programa estructurado en 9 ejes temáticos con aplicación práctica en obra, indicadores determinísticos y estocásticos, integración con Last Planner® System e Inteligencia Artificial.',
    'syllabus'            => [
        [
            'title'   => 'Tipos de Proyectos',
            'icon'    => 'fa-solid fa-building',
            'content' => '<p>Presentación general de los conceptos principales de calidad. Presentación de los tipos de proyectos según su alcance y según la manera como son gestionados.</p>',
        ],
        [
            'title'   => 'Planificación Integrada',
            'icon'    => 'fa-solid fa-diagram-project',
            'content' => '<p>Se presentarán los criterios para integrar la planificación de la calidad con la planificación del proyecto. Se explica las diferencias entre programar y planificar.</p>',
        ],
        [
            'title'   => 'Herramientas de Gestión de Calidad',
            'icon'    => 'fa-solid fa-toolbox',
            'content' => '<p>Se presentarán las herramientas para el control de planos, control de equipos de medición y ensayo. Así también, se muestran las 7 herramientas de calidad, entre ellos el diagrama de control X-R (valores medios y rangos) para análisis efectivos de la variabilidad.</p>',
        ],
        [
            'title'   => 'Gestión de No Conformidades',
            'icon'    => 'fa-solid fa-triangle-exclamation',
            'content' => '<p>Se expone la definición de la no conformidad, así como la diferencia con las desviaciones. Análisis de Causa Raíz y definición de Correcciones y Acciones Correctivas.</p>',
        ],
        [
            'title'   => 'Costos de La Calidad',
            'icon'    => 'fa-solid fa-scale-balanced',
            'content' => '<p>Se expone el concepto de costos de la calidad, se presentan plantillas para su estimación, así como dos métodos para la estimación de los costos.</p>',
        ],
        [
            'title'   => 'Planes de Puntos de Inspecciones (PPI)',
            'icon'    => 'fa-solid fa-list-check',
            'content' => '<p>Configuración del PPI y mapeo de especificaciones de ingeniería, de la obra, estándares y buenas prácticas, definición de parámetros y tolerancias, frecuencia de inspección/prueba, witness and hold points.</p>',
        ],
        [
            'title'   => 'Nuevos Indicadores de Calidad',
            'icon'    => 'fa-solid fa-chart-line',
            'content' => '<p>Se presentan indicadores de gestión de la calidad, entre ellos dos indicadores a ser usados durante la ejecución del proyecto y la entrega de este; se muestran datos reales de aplicación. Indicadores prácticos determinísticos y estocásticos, así como indicadores que integran la gestión de la calidad con Last Planner® System.</p>',
        ],
        [
            'title'   => 'Gestión de la Liberación (completion) y Entrega de Obra',
            'icon'    => 'fa-solid fa-clipboard-check',
            'content' => '<p>Se presentan los criterios de gestión para la liberación, como son la administración e indicadores de pendientes (punch list). Se presentan indicadores de completion que forman parte del cuerpo de conocimiento oficial de Lean Construction.</p>',
        ],
        [
            'title'   => 'Inteligencia Artificial',
            'icon'    => 'fa-solid fa-robot',
            'content' => '<p>Uso de inteligencia artificial para evaluar enunciados de no conformidades y resumen con PROMPTs especiales para la gestión de la calidad.</p>',
        ],
    ],
    'docente'             => [
        'photo'          => 'img/Omar_Samaniego.png',
        'photo_webp'     => 'img/Omar_Samaniego.webp',
        'name'           => 'Ing. Omar A. Samaniego',
        'experience_tag' => '+25 años de experiencia',
        'credentials'    => ['ING. Master', 'NEC4', 'VDC – Stanford', 'PMP®', 'PMI-RMP®', 'LSS Black Belt'],
        'summary'        => 'Profesional con más de 25 años de experiencia en el Sector Construcción en Gestión de Proyectos, Riesgos y Calidad en empresas líderes en el Perú y el extranjero. Experiencia docente en principales universidades, ponente en prestigiosos congresos, contribuidor registrado de estándares fundacionales del PMI® y autor de los libros <em>Riesgos Técnicos en la Construcción</em> e <em>ISO 9001 para la Construcción</em>.',
        'highlights'     => [
            '<strong>Gleeds (G2G ARCC PEIP-EB):</strong> Quality &amp; Risk Manager.',
            '<strong>Quality Consulting Solutions:</strong> Director.',
            '<strong>Graña y Montero (GyM):</strong> Jefe Corporativo del Área de Calidad.',
            '<strong>Buenaventura Ingenieros:</strong> Gerente de Proyectos.',
        ],
        'full_bio_items' => [
            '<strong>Cosapi:</strong> Jefe de Calidad | <strong>Bechtel:</strong> Líder de Calidad Electromecánico.',
            '<strong>Catedrático de Postgrado:</strong> Universidad Peruana de Ciencias Aplicadas (UPC), MDI PUCP – Universidad Politécnica de Madrid, Universidad de Lima e Instituto para la Calidad.',
            '<strong>Expositor Internacional:</strong> Conferencia Lean Construction IGLC (New Zealand, 2024), Techsuyo Stanford University (2017), Congreso Global del PMI Washington D.C. (2010) y Congreso Regional del PMI Lima (2008).',
            '<strong>Liderazgo Institucional:</strong> Presidente del Comité de la Calidad de Capeco, Columnista en Revista El Constructivo y miembro directivo de ASQ Perú LMC.',
        ],
        'recognition'    => 'Contribuidor registrado de la Guía del PMBOK® (6ta y 7ma Edición) y del Estándar de Riesgos del PMI® 2019.',
    ],
    'benefits'            => [
        [
            'icon'  => 'fa-solid fa-briefcase',
            'title' => 'Bolsa laboral',
            'text'  => 'Ingreso a la base de datos laboral de Quality Consulting Solutions.',
        ],
        [
            'icon'  => 'fa-solid fa-percent',
            'title' => 'Descuentos',
            'text'  => 'Descuento para futuros cursos con precios ordinarios.',
        ],
        [
            'icon'  => 'fa-solid fa-user-check',
            'title' => 'Consultoría incluida',
            'text'  => 'Consultoría de 1 hora en horario de 9am – 5pm durante el periodo del curso.',
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
    'pdu_title'           => 'Unidades de desarrollo profesional (16 PDU)',
    'pdu_text'            => 'Si tienes certificación del PMI®, este curso te brinda 16 PDU (<em>Professional Development Unit</em>) para mantener tu certificación vigente. Categoría PMI® CCR: <em>General Education (Third-Party Provider – The PMI Talent Triangle®)</em>. Duración total: <strong>16 horas netas</strong>.',
    'enroll_bg_image'     => 'img/Index-GerenciaCalidadObras.webp',
    'whatsapp_url'        => 'https://api.whatsapp.com/send?phone=51993463118&text=Buen%20d%C3%ADa,%20deseo%20solicitar%20informaci%C3%B3n%20sobre%20el%20curso%20de%20Gerencia%20de%20la%20Calidad%20en%20la%20Construcci%C3%B3n',
    'modal_service'       => 'Gerencia de la Calidad en la Construcción',
    'paypal_slug'         => 'gerencia-de-calidad',
    'videos'              => [
        [
            'header'    => 'Gerencia de Calidad en Obra - Parte 1',
            'embed_url' => 'https://www.youtube.com/embed/GIupuAHeqBQ',
            'title'     => 'Gerencia de la Calidad en la Construcción - Video 1',
            'caption'   => '<strong>Planificación Integrada &amp; PPI:</strong> Enfoque integral de procesos y aseguramiento técnico en proyectos de construcción.',
        ],
        [
            'header'    => 'Gerencia de Calidad en Obra - Parte 2',
            'embed_url' => 'https://www.youtube.com/embed/gr0wmPU2_-Y',
            'title'     => 'Gerencia de la Calidad en la Construcción - Video 2',
            'caption'   => '<strong>Control Operativo &amp; Entrega de Obra:</strong> Gestión de no conformidades, indicadores de calidad y completion.',
        ],
    ],
];

echo $this->partial('course_detail_unified', ['course' => $course]);
