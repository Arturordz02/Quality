<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Dirección de la Calidad con el Enfoque PMI® para la Construcción
 * Archivo: app/Views/pages/calidad-y-pmi.php
 *
 * Basado en la plantilla unificada aprobada: app/Views/partials/course_detail_unified.php
 */

declare(strict_types=1);

$course = [
    // 1. Hero Banner
    'hero_badge'          => 'ÁREA DE GESTIÓN DE LA CALIDAD • 15 HORAS NETAS • 16 PDU',
    'hero_badge_icon'     => 'fa-solid fa-graduation-cap',
    'title'               => 'DIRECCIÓN DE LA CALIDAD CON EL ENFOQUE PMI® PARA LA CONSTRUCCIÓN',
    'summary'             => 'Contenidos y lineamientos de la dirección de la calidad con el enfoque PMI®, basado en la 6ta y 7ma Edición de la Guía del PMBOK® y la Guía Práctica de Grupos de Procesos, vinculando la gestión de proyectos con las operaciones en obra.',
    'hero_cards'          => [
        [
            'icon'  => 'fa-solid fa-book-bookmark',
            'title' => 'ESTÁNDARES PMI®',
            'desc'  => 'Basado en la 6ta y 7ma Edición de la Guía del PMBOK® y la Guía Práctica de Grupos de Procesos (PMI 2022).',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '15 HORAS & 16 PDU',
            'desc'  => 'Otorga 16 PDU para mantener tu certificación vigente (Categoría CCR – General Education Third-Party Provider).',
        ],
        [
            'icon'  => 'fa-solid fa-list-check',
            'title' => 'PPI & DEFECTOLOGÍA',
            'desc'  => 'Plan de Puntos de Inspección, indicadores Last Planner, defectología, auditorías técnicas y panel Looker Studio.',
        ],
        [
            'icon'  => 'fa-solid fa-user-check',
            'title' => 'CONSULTORÍA Y DIPLOMA',
            'desc'  => 'Consultoría de 1 hora durante el curso, diploma digital de Quality Consulting Solutions y acceso a bolsa laboral.',
        ],
    ],

    // 2. Objetivo del curso
    'objective'           => 'Presentar a los participantes los contenidos y lineamientos de la dirección de la calidad con el enfoque PMI®, basado en la 6ta y 7ma Edición de la Guía del PMBOK® y la NUEVA Guía Práctica de Grupos de Procesos (PMI 2022). Se presentará así un enfoque en la construcción, vinculando los términos usados en los proyectos con los empleados por los estándares del PMI® en su idioma original, lo que enriquece el significado de los términos y su aplicación real.',
    'objective_image'     => 'img/capmi1.png',
    'objective_image_webp'=> 'img/capmi1.webp',
    'objective_image_alt' => 'Dirección de la Calidad con el Enfoque PMI® para la Construcción',
    'objective_highlights'=> [
        'Planificar la dirección de la calidad: propósito de la planificación, entregables, requerimientos, política de calidad y Plan de Puntos de Inspección (PPI).',
        'Gestionar la calidad: dirección de la calidad como medio de ejecución, aseguramiento (assurance), listas de entregables, defectología y auditoría técnica.',
        'Controlar la calidad: control de conformidad (ensure), matriz de calidad, mediciones y panel de control con Looker Studio en la nube de Google.',
    ],

    // 3. Temario del curso (3 procesos oficiales según el brochure)
    'syllabus_intro'      => 'Estructura oficial del curso enfocada en los 3 procesos fundamentales de la dirección de la calidad según la Guía del PMBOK® y estándares del PMI®:',
    'syllabus'            => [
        [
            'title'   => 'Planificar la Dirección de la Calidad del Proyecto',
            'icon'    => 'fa-solid fa-compass-drafting',
            'content' => '<p>El curso abordará las entradas y salidas de los procesos, así como los principios de la dirección de la calidad según el enfoque PMI®, presentando ejemplos de aplicación.</p><p class="qcs-cd-syllabus-subhead">Alcance del proceso:</p><p>En esta sección se presenta el propósito de la planificación y su relación con los entregables, requerimientos, política de la calidad, mediciones del aseguramiento de la calidad y listas de verificación. Se presentan las entradas, herramientas y técnicas, y salidas del proceso. Entre las entradas se considera el acta de constitución del proyecto, obteniendo subsecuentemente el plan de dirección de la calidad.</p><p class="qcs-cd-syllabus-subhead">Herramientas aplicadas:</p><ul><li>Plan de Puntos de Inspección (PPI).</li><li>Indicadores avanzados de calidad: restricciones, Last Planner System, calidad de la ejecución general y calidad general de la entrega de obra.</li></ul>',
        ],
        [
            'title'   => 'Gestionar la Calidad del Proyecto',
            'icon'    => 'fa-solid fa-clipboard-check',
            'content' => '<p>Se presenta el proceso de la dirección de la calidad como medio de ejecución del plan de dirección de la calidad (auditorías y revisiones). Asimismo, se muestra la relación del aseguramiento (assurance) de la calidad con la gestión de riesgos.</p><p class="qcs-cd-syllabus-subhead">Herramientas y técnicas:</p><p>Se presentan las entradas, herramientas y técnicas (análisis de datos, toma de decisiones, representación de datos y métodos de mejora de la calidad) y salidas del proceso.</p><p class="qcs-cd-syllabus-subhead">Herramientas aplicadas:</p><ul><li>Lista de entregables.</li><li>Defectología y auditoría técnica.</li></ul>',
        ],
        [
            'title'   => 'Controlar la Calidad del Proyecto',
            'icon'    => 'fa-solid fa-chart-pie',
            'content' => '<p>Se plantea la definición de control de la calidad y su relación con el aseguramiento (ensure) de la conformidad de las salidas de los procesos.</p><p class="qcs-cd-syllabus-subhead">Entradas, técnicas y salidas:</p><p>Se presentan las entradas, herramientas, técnicas y salidas del proceso: solicitudes de cambio, mediciones del control de la calidad, entregables verificados e información del desempeño del trabajo.</p><p class="qcs-cd-syllabus-subhead">Herramientas aplicadas:</p><ul><li>Matriz de calidad.</li><li>Panel de control con Looker Studio («¡el panel en la nube de Google!»).</li></ul>',
        ],
    ],

    // 4. Perfil docente (Ing. Omar Samaniego)
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
            '<strong>Catedrático Universitario:</strong> Universidad Peruana de Ciencias Aplicadas (UPC), MDI PUCP - Universidad Politécnica de Madrid (Catedrático de dirección de la calidad), Universidad de Lima e Instituto para la Calidad.',
            '<strong>Expositor Internacional:</strong> Techsuyo en Stanford University (2017), Congreso Global del PMI (Washington D.C., 2010) y Congreso Regional del PMI (Lima, 2008).',
            '<strong>Liderazgo y Publicaciones:</strong> Presidente del Comité de la Calidad de Capeco, Columnista en Revista El Constructivo y Miembro Directivo de ASQ Perú LMC.',
            '<strong>Colaboración con Stanford:</strong> Acuerdo institucional con el Centro de Ingeniería para Instalaciones Integradas (CIFE) de Stanford University dando soporte a investigaciones nacionales en 2018 y 2019.',
        ],
        'recognition'    => 'Contribuidor registrado de la 6ta y 7ma Edición de la Guía del PMBOK® y del Estándar de Gestión de Riesgos del PMI® (2019 / 2024). Autor de los libros sobre ISO 9001 y Riesgos Técnicos en Construcción.',
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
    'pdu_title'           => 'Unidades de desarrollo profesional (16 PDU)',
    'pdu_text'            => 'Si tienes certificación del PMI®, este curso te brinda 16 PDU (<em>Professional Development Unit</em>) para mantener tu certificación vigente. Categoría PMI® CCR: <em>General Education (Third-Party Provider)</em>. Duración total: <strong>15 horas netas</strong>.',
    'brochure_url'        => 'brochures/calidad/direccion-calidad-enfoque-pmi.pdf',
    'brochure_download'   => 'Brochure-Direccion-Calidad-Enfoque-PMI.pdf',
    'brochure_thumb'      => 'img/brochures/portada-direccion-calidad-enfoque-pmi.png',

    // 6. Información e inscripción
    'enroll_bg_image'     => 'img/capmi1.webp',
    'whatsapp_url'        => 'https://api.whatsapp.com/send?phone=51993463118&text=Buen%20d%C3%ADa,%20deseo%20solicitar%20informaci%C3%B3n%20sobre%20el%20curso%20de%20Direcci%C3%B3n%20de%20la%20Calidad%20con%20Enfoque%20PMI',
    'modal_service'       => 'Dirección de la Calidad con el Enfoque PMI® para la Construcción',
    'paypal_slug'         => 'calidad-y-pmi',
    'videos'              => [
        [
            'header'    => 'Calidad PMI en Construcción - Parte 1',
            'embed_url' => 'https://www.youtube.com/embed/hbwy_uESkzI',
            'title'     => 'Enfoque PMI de la Gestión de la Calidad - Video 1',
            'caption'   => '<strong>Sesión técnica:</strong> Articulación de los estándares del PMI con la realidad operativa de obra.',
        ],
        [
            'header'    => 'Calidad PMI en Construcción - Parte 2',
            'embed_url' => 'https://www.youtube.com/embed/w-hf9BtsF0Q',
            'title'     => 'Enfoque PMI de la Gestión de la Calidad - Video 2',
            'caption'   => '<strong>Aplicación práctica:</strong> Lecciones aprendidas en aseguramiento y control de calidad en proyectos.',
        ],
    ],
];

echo $this->partial('course_detail_unified', ['course' => $course]);
