<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Dirección de la Calidad con el Enfoque PMI® para la Construcción
 * Archivo: app/Views/pages/direccion-calidad-enfoque-pmi.php
 *
 * Basado en la plantilla unificada aprobada: app/Views/partials/course_detail_unified.php
 * Contenido auditado estrictamente contra el brochure oficial:
 * public_html/brochures/calidad/direccion-calidad-enfoque-pmi.pdf
 */

declare(strict_types=1);

$course = [
    // 1. Hero Banner
    'hero_badge'          => 'ÁREA DE GESTIÓN DE LA CALIDAD • 15 HORAS NETAS • 16 PDU',
    'hero_badge_icon'     => 'fa-solid fa-graduation-cap',
    'title'               => 'DIRECCIÓN DE LA CALIDAD CON EL ENFOQUE PMI® PARA LA CONSTRUCCIÓN',
    'summary'             => 'Contenidos y lineamientos de la dirección de la calidad con el enfoque PMI®, basado en la 6ta y 7ma Edición de la Guía del PMBOK® y la NUEVA Guía Práctica de Grupos de Procesos (PMI 2022), vinculando los proyectos de construcción con los estándares del PMI®.',
    'hero_cards'          => [
        [
            'icon'  => 'fa-solid fa-book-bookmark',
            'title' => 'ESTÁNDARES PMI®',
            'desc'  => 'Basado en la 6ta y 7ma Edición del PMBOK® y la NUEVA Guía Práctica de Grupos de Procesos (PMI 2022).',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '15 HORAS & 16 PDU',
            'desc'  => '16 PDU (Categoría PMI® CCR: General Education Third-Party Provider) y 15 horas netas de duración.',
        ],
        [
            'icon'  => 'fa-solid fa-list-check',
            'title' => 'HERRAMIENTAS CLAVE',
            'desc'  => 'Lista de entregables, defectología, Plan de Puntos de Inspección, indicadores Last Planner, matriz y Looker Studio.',
        ],
        [
            'icon'  => 'fa-solid fa-user-check',
            'title' => 'CONSULTORÍA Y BENEFICIOS',
            'desc'  => 'Consultoría de 1 hora durante el curso, diploma digital de Quality Consulting Solutions y acceso a bolsa laboral.',
        ],
    ],

    // 2. Objetivo del curso (Fiel a la página 2 del brochure)
    'objective'           => 'Presentar a los participantes los contenidos y lineamientos de la dirección de la calidad con el enfoque PMI®, basado en la 6ta y 7ma Edición de la Guía del PMBOK® y la NUEVA Guía Práctica de Grupos de Procesos (PMI 2022). Se presentará así un enfoque en la construcción, vinculando los términos usados en los proyectos con los empleados por los estándares del PMI® en su idioma original, lo que enriquece el significado de los términos y su aplicación real.',
    'objective_image'     => 'img/capacitaciones/direccion-calidad-enfoque-pmi.png',
    'objective_image_webp'=> 'img/capacitaciones/direccion-calidad-enfoque-pmi.webp',
    'objective_image_alt' => 'Dirección de la Calidad con el Enfoque PMI® para la Construcción',
    'objective_highlights'=> [
        'Planificar la dirección de la calidad: propósito de la planificación, entregables, requerimientos, política de la calidad, lista de entregables, defectología y auditoría técnica.',
        'Gestionar la calidad: medio de ejecución del plan de dirección de la calidad, aseguramiento (assurance), Plan de Puntos de Inspección e indicadores avanzados (restricciones, Last Planner System, ejecución general y entrega de obra).',
        'Controlar la calidad: definición y relación con el aseguramiento (ensure) de conformidad de salidas, matriz de calidad y panel de control con Looker Studio («¡el panel en la nube de Google!»).',
    ],

    // 3. Temario del curso (3 procesos oficiales según página 2 del brochure)
    'syllabus_intro'      => 'El curso abordará las entradas y salidas de los procesos, así como los principios de la dirección de la calidad según el enfoque PMI®, presentando ejemplos de aplicación en 3 procesos fundamentales:',
    'syllabus'            => [
        [
            'title'   => 'Planificar la Dirección de la Calidad del Proyecto',
            'icon'    => 'fa-solid fa-compass-drafting',
            'content' => '<p>En esta sección se presenta el propósito de la planificación, y su relación con los entregables, requerimientos, política de la calidad, mediciones del aseguramiento de la calidad, listas de verificación.</p><p>Se presentan las entradas, herramientas y técnicas, y salidas del proceso. Entre las entradas se considera el acta de constitución del proyecto, obteniendo subsecuentemente el plan de dirección de la calidad.</p><p class="qcs-cd-syllabus-subhead">Herramientas respaldadas por el brochure:</p><ul><li>Lista de entregables.</li><li>Defectología y auditoría técnica.</li></ul>',
        ],
        [
            'title'   => 'Gestionar la Calidad del Proyecto',
            'icon'    => 'fa-solid fa-clipboard-check',
            'content' => '<p>Se presenta el proceso de la dirección de la calidad como medio de ejecución del plan de dirección de la calidad (auditorías y revisiones). Asimismo, se muestra la relación con el aseguramiento (assurance) de la calidad con la gestión de riesgo.</p><p>Se presentan las entradas, herramientas y técnicas, y salidas del proceso. Entre las herramientas y técnicas se presentan el análisis de datos, toma de decisiones, representación de datos, métodos de mejora de la calidad.</p><p class="qcs-cd-syllabus-subhead">Herramientas respaldadas por el brochure:</p><ul><li>Plan de Puntos de Inspección (PPI).</li><li>Indicadores avanzados de calidad (restricciones; Last Planner System; Calidad de la Ejecución General; Calidad de General de la Entrega de Obra).</li></ul>',
        ],
        [
            'title'   => 'Controlar la Calidad del Proyecto',
            'icon'    => 'fa-solid fa-chart-pie',
            'content' => '<p>Se plantea la definición de control de la calidad y su relación con el aseguramiento (ensure) de la conformidad de las salidas de los procesos.</p><p>Se presentan las entradas, herramientas y técnicas, y salidas del proceso. Entre las salidas del proceso se presentan las solicitudes de cambio, mediciones del control de la calidad, entregables verificados, información del desempeño del trabajo.</p><p class="qcs-cd-syllabus-subhead">Herramientas respaldadas por el brochure:</p><ul><li>Matriz de calidad.</li><li>Panel de control con Looker Studio («¡el panel en la nube de Google!»).</li></ul>',
        ],
    ],

    // 4. Perfil docente (Ing. Omar Samaniego - Páginas 1, 4 y 5 del brochure)
    'docente'             => [
        'photo'          => 'img/Omar_Samaniego.png',
        'photo_webp'     => 'img/Omar_Samaniego.webp',
        'name'           => 'Ing. Omar A. Samaniego',
        'experience_tag' => '+25 años de experiencia',
        'credentials'    => ['ING., MASTER', 'NEC4', 'VDC Stanford', 'PMP®', 'PMI-RMP®', 'LSS Black Belt'],
        'summary'        => 'Profesional con más de 25 años de experiencia en el Sector Construcción en Gestión de Proyectos, Riesgos y Calidad en empresas líderes en el Perú y el extranjero. Experiencia docente en principales universidades, ponente en prestigiosos congresos, contribuidor registrado de estándares fundacionales del PMI® y autor de dos libros.',
        'highlights'     => [
            '<strong>Quality Consulting Solutions:</strong> Director.',
            '<strong>Gleeds (UK):</strong> Quality & Risk Manager.',
            '<strong>Graña y Montero:</strong> Jefe Corporativo del Área de Calidad de GyM.',
            '<strong>Buenaventura Ingenieros:</strong> Gerente de Proyectos.',
        ],
        'full_bio_items' => [
            '<strong>Cosapi:</strong> Jefe de Calidad | <strong>Bechtel:</strong> Líder de Calidad Electromecánico.',
            '<strong>Catedrático Universitario:</strong> Universidad Peruana de Ciencias Aplicadas (UPC - Postgrado), MDI PUCP - Universidad Politécnica de Madrid (Catedrático de dirección de la calidad), Universidad de Lima (Ingeniería Civil e Ingeniería Industrial) e Instituto para la Calidad.',
            '<strong>Expositor Internacional:</strong> Techsuyo en Stanford University (2017), Congreso Global del PMI (Washington D.C., 2010) y Congreso Regional del PMI (Lima - Perú, 2008).',
            '<strong>Liderazgo y Publicaciones:</strong> Presidente del Comité de la Calidad de Capeco, Columnista en Revista El Constructivo y Miembro Directivo de ASQ Perú LMC.',
            '<strong>Colaboración con Stanford:</strong> Acuerdo institucional con el Centro de Ingeniería para Instalaciones Integradas (CIFE) de Stanford University dando soporte a investigación en 2018 y 2019.',
        ],
        'recognition'    => 'Contribuidor registrado de la 6ta y 7ma Edición de la Guía del PMBOK® y del Estándar de Gestión de Riesgos del PMI® (2019 / 2024). Autor de libros especializados en construcción.',
    ],

    // 5. Beneficios oficiales (Página 3 del brochure)
    'benefits'            => [
        [
            'icon'  => 'fa-solid fa-briefcase',
            'title' => 'Bolsa laboral',
            'text'  => 'Ingreso a la base de datos laboral de Quality Consulting Solutions.',
        ],
        [
            'icon'  => 'fa-solid fa-percent',
            'title' => 'Descuentos futuros',
            'text'  => 'Descuento para futuros cursos con precios ordinarios.',
        ],
        [
            'icon'  => 'fa-solid fa-user-check',
            'title' => 'Consultoría incluida',
            'text'  => 'Consultoría de 1 hora de lunes a viernes en horario de 6pm – 8pm durante el periodo del curso.',
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

    // 6. Datos separados de PDU y duración (Página 3 del brochure)
    'pdu'                 => '16 PDU',
    'hours'               => '15 horas netas',
    'pdu_count'           => '16 PDU',
    'duration_hours'      => '15 horas netas',
    'pdu_title'           => 'Unidades de desarrollo profesional (16 PDU)',
    'pdu_text'            => 'Si tienes certificación del PMI®, este curso te brinda 16 PDU (<em>Professional Development Unit</em>) para mantener tu certificación según la descripción provista por el PMI®: Categoría PMI® CCR: <em>General Education Third-Party Provider</em>. Duración total: <strong>15 horas netas</strong>.',
    'brochure_url'        => 'brochures/calidad/direccion-calidad-enfoque-pmi.pdf',
    'brochure_download'   => 'Brochure-Direccion-Calidad-Enfoque-PMI.pdf',
    'brochure_thumb'      => 'img/brochures/portada-direccion-calidad-enfoque-pmi.png',

    // 7. Información e inscripción (Página 3 del brochure)
    'enroll_bg_image'     => 'img/capacitaciones/direccion-calidad-enfoque-pmi.webp',
    'whatsapp_url'        => 'https://api.whatsapp.com/send?phone=51993463118&text=Buen%20d%C3%ADa,%20deseo%20solicitar%20informaci%C3%B3n%20sobre%20el%20curso%20de%20Direcci%C3%B3n%20de%20la%20Calidad%20con%20Enfoque%20PMI',
    'modal_service'       => 'Dirección de la Calidad con el Enfoque PMI® para la Construcción',
    'paypal_slug'         => 'direccion-calidad-enfoque-pmi',
    'videos'              => [],
];

echo $this->partial('course_detail_unified', ['course' => $course]);
