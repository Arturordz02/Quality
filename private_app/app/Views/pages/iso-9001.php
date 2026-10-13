<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: ISO 9001 para la Construcción usando IA (Diseño Basado en Referencia ISO 9001)
 * Archivo: app/Views/pages/iso-9001.php
 */

declare(strict_types=1);

$course = [
    'hero_badge'          => 'INCLUYE LIBRO OFICIAL • INCLUYE USOS AI • 16 HORAS NETAS',
    'hero_badge_icon'     => 'fas fa-book-bookmark',
    'title'               => 'ISO 9001 PARA LA CONSTRUCCIÓN USANDO IA',
    'summary'             => 'Aborda todas las (sub)cláusulas de la norma y el significado de los términos en su idioma original (Inglés), asociadas a casos reales de aplicación en la construcción e integrando usos de Inteligencia Artificial.',
    'hero_cards'          => [
        [
            'icon'  => 'fa-solid fa-book-bookmark',
            'title' => 'INCLUYE LIBRO Y USOS AI',
            'desc'  => 'Incluye el libro "ISO 9001 para la Construcción" del Ing. Omar A. Samaniego y aplicación de herramientas AI.',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '16 HORAS NETAS & 16 PDU',
            'desc'  => 'Otorga 16 PDU para mantener tu certificación vigente (Categoría CCR – The PMI Talent Triangle®).',
        ],
        [
            'icon'  => 'fa-solid fa-circle-play',
            'title' => 'MATERIAL Y GRABACIÓN',
            'desc'  => 'Consultoría de 1 hora durante el curso, entrega de material digital y acceso vía internet a la grabación del curso.',
        ],
        [
            'icon'  => 'fa-solid fa-certificate',
            'title' => 'DIPLOMA Y BOLSA LABORAL',
            'desc'  => 'Diploma digital de Quality Consulting Solutions, ingreso a la base de datos laboral y descuentos en futuros cursos.',
        ],
    ],
    'objective'           => 'Brindar a los participantes los criterios de la ISO 9001 relacionándolos con los aspectos prácticos de la construcción, vinculando los términos empleados en los proyectos con los utilizados en la norma. Identificar casos y compartir lecciones aprendidas donde se apliquen los elementos citados por la ISO 9001.',
    'objective_image'     => 'img/ISO1.png',
    'objective_image_webp'=> 'img/ISO1.webp',
    'objective_image_alt' => 'ISO 9001 para la Construcción usando IA',
    'objective_highlights'=> [
        'Análisis de todas las (sub)cláusulas de la norma en su sentido original en inglés aplicado a obras.',
        'Casos prácticos de aseguramiento, control de procesos, liberación, trazabilidad, auditoría y mejora.',
        'Entrega del libro oficial "ISO 9001 para la Construcción" y aplicación de Prompts con Inteligencia Artificial.',
    ],
    'syllabus_intro'      => 'El curso abordará todas las (sub)cláusulas de la norma, y el significado de los términos en su idioma original (Inglés), <strong>ASOCIADAS A CASOS DE APLICACIÓN EN LA CONSTRUCCIÓN</strong>.',
    'syllabus'            => [
        [
            'title'   => 'Contexto de la Organización',
            'icon'    => 'fa-solid fa-building-columns',
            'clause'  => 'Cláusula 4 ISO 9001',
            'content' => '<p>Se presentará las formas cómo definir el contexto de la organización a la luz de la norma, así como se abordarán las sub-cláusulas sobre las partes interesadas y el alcance del Sistema de Gestión de la Calidad.</p>',
        ],
        [
            'title'   => 'Liderazgo',
            'icon'    => 'fa-solid fa-users-gear',
            'clause'  => 'Cláusula 5 ISO 9001',
            'content' => '<p>Se explicará las implicancias del liderazgo y el compromiso, este último revisando las acepciones que usa la norma en su idioma original. Asimismo, se presenta la relación de la política de la calidad con la autonomía responsable.</p>',
        ],
        [
            'title'   => 'Planificación',
            'icon'    => 'fa-solid fa-compass-drafting',
            'clause'  => 'Cláusula 6 ISO 9001',
            'content' => '<p>Se explicará las diferencias e implicancias del término aseguramiento en su idioma original con acepciones que se pierden en su traducción al Español. Se presentarán las sub-cláusulas de riesgos y su relación con otros estándares, los distintos tipos de objetivos y la planificación de los cambios.</p>',
        ],
        [
            'title'   => 'Apoyo',
            'icon'    => 'fa-solid fa-folder-tree',
            'clause'  => 'Cláusula 7 ISO 9001',
            'content' => '<p>Se explicará el detalle de las sub-cláusulas brindando el sentido real y práctico que da la norma en su idioma original, en lo concerniente al apoyo, competencia y toma de conciencia; así como las sub-cláusulas de comunicación e información documentada.</p>',
        ],
        [
            'title'   => 'Operación',
            'icon'    => 'fa-solid fa-gears',
            'clause'  => 'Cláusula 8 ISO 9001',
            'content' => '<p>Sub-cláusulas de planificación, requisitos y alcance de diseño en relación con las empresas constructoras. Control de procesos y productos y su diferencia con el monitoreo. Concepto de liberación, requerimientos de trazabilidad y su relación con la incertidumbre, variabilidad y el riesgo.</p>',
        ],
        [
            'title'   => 'Evaluación',
            'icon'    => 'fa-solid fa-magnifying-glass-chart',
            'clause'  => 'Cláusula 9 ISO 9001',
            'content' => '<p>Requerimientos de seguimiento, medición, análisis y evaluación. Se explicará el término análisis, el cual suele confundirse con revisión y evaluación. Explicación sobre las sub-cláusulas de auditoría interna y revisión por la dirección.</p>',
        ],
        [
            'title'   => 'Mejora',
            'icon'    => 'fa-solid fa-arrow-trend-up',
            'clause'  => 'Cláusula 10 ISO 9001',
            'content' => '<p>Sub-cláusulas de no conformidades y mejora continua. Explicación del término adecuación vs conveniencia a la luz de la versión en Inglés, cuya diferenciación suele perderse en la traducción al Español tanto en la implementación del SGC como en las auditorías.</p>',
        ],
    ],
    'docente'             => [
        'photo'          => 'img/Omar_Samaniego.png',
        'photo_webp'     => 'img/Omar_Samaniego.webp',
        'name'           => 'Ing. Omar A. Samaniego',
        'experience_tag' => '+25 años de experiencia',
        'credentials'    => ['ING., Master', 'NEC4', 'VDC-Stanford', 'PMP®', 'PMI-RMP®', 'LSS Black Belt'],
        'summary'        => 'Profesional con más de 25 años de experiencia en el Sector Construcción en Gestión de Proyectos, Riesgos y Calidad en empresas líderes en el Perú y el extranjero. Experiencia docente en principales universidades, ponente en prestigiosos congresos, contribuidor registrado de estándares fundacionales del PMI® y autor de los libros <em>ISO 9001 para la Construcción</em> y <em>Riesgos Técnicos en la Construcción</em>.',
        'highlights'     => [
            '<strong>Quality Consulting Solutions:</strong> Director.',
            '<strong>Gleeds (G2G Perú Reino Unido):</strong> Risk &amp; Quality Mgr.',
            '<strong>Graña y Montero (GyM):</strong> Jefe Corporativo del Área de Calidad.',
            '<strong>Buenaventura Ingenieros:</strong> Gerente de Proyectos.',
        ],
        'full_bio_items' => [
            '<strong>Cosapi:</strong> Jefe de Calidad | <strong>Bechtel:</strong> Líder de Calidad Electromecánico.',
            '<strong>Catedrático de Postgrado:</strong> Universidad Peruana de Ciencias Aplicadas (UPC), MDI PUCP Universidad Politécnica de Madrid, Universidad de Lima e Instituto para la Calidad.',
            '<strong>Expositor Internacional:</strong> Conferencia Techsuyo Stanford University (2017), Congreso Global del PMI Washington D.C. (2010) y Congreso Regional del PMI Lima (2008).',
            '<strong>Liderazgo Institucional:</strong> Presidente del Comité de la Calidad de Capeco, Columnista en Revista El Constructivo y ASQ Perú LMC executive board member.',
        ],
        'recognition'    => 'Contribuidor registrado de la Guía del PMBOK® 7ma Edición y del Estándar de Riesgos del PMI® 2019.',
    ],
    'benefits'            => [
        [
            'icon'  => 'fa-solid fa-book-bookmark',
            'title' => 'Libro oficial y usos AI',
            'text'  => 'Incluye el libro <em>ISO 9001 para la Construcción</em> (Ing. Omar A. Samaniego) e incluye usos AI.',
        ],
        [
            'icon'  => 'fa-solid fa-user-check',
            'title' => 'Consultoría incluida',
            'text'  => 'Consultoría de 1 hora en horario de 9am – 5pm durante el periodo del curso.',
        ],
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
            'text'  => 'Acceso vía internet a la grabación del curso.',
        ],
    ],
    'pdu_title'           => 'Unidades de desarrollo profesional (16 PDU)',
    'pdu_text'            => 'Si tienes certificación del PMI®, este curso te brinda 16 PDU (<em>Professional Development Unit</em>) para mantener tu certificación vigente. Categoría PMI® CCR: <em>General Education (Third-Party Provider – The PMI Talent Triangle®)</em>. Duración total: <strong>16 horas netas</strong>.',
    'enroll_bg_image'     => 'img/ISO1.webp',
    'whatsapp_url'        => 'https://api.whatsapp.com/send?phone=51993463118&text=Buen%20d%C3%ADa,%20deseo%20solicitar%20informaci%C3%B3n%20sobre%20el%20curso%20de%20ISO%209001%20para%20la%20Construcci%C3%B3n%20usando%20IA',
    'modal_service'       => 'ISO 9001 para la Construcción usando IA',
    'paypal_slug'         => 'iso-9001',
    'videos'              => [
        [
            'header'    => 'ISO 9001 - Sesión 1',
            'embed_url' => 'https://www.youtube.com/embed/EJ-kUj2-keA',
            'title'     => 'Conferencia ISO 9001 en Construcción - Video 1',
            'caption'   => '<strong>Fundamentos de la Norma:</strong> Contexto, liderazgo y aseguramiento en su sentido original.',
        ],
        [
            'header'    => 'ISO 9001 - Sesión 2',
            'embed_url' => 'https://www.youtube.com/embed/v6BPe0MwRdM',
            'title'     => 'Conferencia ISO 9001 en Construcción - Video 2',
            'caption'   => '<strong>Operación en Obra:</strong> Control de procesos, trazabilidad, variabilidad y liberación.',
        ],
        [
            'header'    => 'ISO 9001 - Sesión 3',
            'embed_url' => 'https://www.youtube.com/embed/MAtVkeqZOqE',
            'title'     => 'Conferencia ISO 9001 en Construcción - Video 3',
            'caption'   => '<strong>Evaluación y Mejora:</strong> Auditorías internas, no conformidades y mejora continua.',
        ],
    ],
];

echo $this->partial('course_detail_unified', ['course' => $course]);
