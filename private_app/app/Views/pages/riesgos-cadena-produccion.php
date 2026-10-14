<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Riesgos en la Cadena de Producción de la Construcción ISO 31000 usando BIM (Diseño Unificado)
 * Archivo: app/Views/pages/riesgos-cadena-produccion.php
 */

declare(strict_types=1);

$course = [
    'hero_badge'          => 'ESTÁNDAR ISO 31000 & HERRAMIENTAS ISO 31010 • ENFOQUE BIM • 16 HORAS',
    'hero_badge_icon'     => 'fa-solid fa-industry',
    'title'               => 'RIESGOS EN LA CADENA DE PRODUCCIÓN DE LA CONSTRUCCIÓN ISO 31000 USANDO BIM',
    'summary'             => 'Aplica los principios y directrices de la norma ISO 31000 y herramientas de la ISO 31010 a lo largo de la cadena de producción en proyectos de construcción, integrando la metodología BIM para la toma de decisiones y control de contingencias.',
    'hero_cards'          => [
        [
            'icon'  => 'fa-solid fa-network-wired',
            'title' => 'CADENA DE PRODUCCIÓN',
            'desc'  => 'Gestión integral de riesgos desde el abastecimiento, subcontratos y logística hasta la ejecución en obra.',
        ],
        [
            'icon'  => 'fa-solid fa-cube',
            'title' => 'INTEGRACIÓN BIM',
            'desc'  => 'Modelado de información de la construcción (BIM) aplicado a la identificación temprana y visualización de interferencias.',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '16 HORAS & 16 PDU',
            'desc'  => '16 PDU para el mantenimiento de credenciales PMI® (Categoría CCR: General Education Third-Party Provider).',
        ],
        [
            'icon'  => 'fa-solid fa-screwdriver-wrench',
            'title' => 'HERRAMIENTAS ISO 31010',
            'desc'  => 'Aplicación de Diagramas Bow Tie, Árbol de Fallas, Matriz PxI, EMV y mapas de calor en proyectos.',
        ],
    ],
    'objective'           => 'Presentar el vínculo de los procesos de la gestión de riesgos según el estándar internacional ISO 31000 y la norma técnica ISO 31010 con los aspectos prácticos de la cadena de producción en construcción. Brindar marcos sistemáticos para evaluar riesgos de proveedores, contratistas, logística y obra civil, complementando el análisis con entornos BIM.',
    'objective_highlights'=> [
        'Alineamiento riguroso a los principios, marco de referencia y procesos de la norma ISO 31000.',
        'Implementación de técnicas de evaluación de riesgos según ISO 31010 (Bow Tie, Ishikawa, Pareto, Árbol de decisiones y EMV).',
        'Integración de modelos BIM para detectar riesgos espaciales, temporales y constructivos en la cadena productiva.',
        'Desarrollo de planes de contingencia y matrices de probabilidad e impacto para salvaguardar costos y cronogramas.',
    ],
    'syllabus_intro'      => 'El programa se estructura en 5 módulos especializados que abarcan desde los fundamentos normativos hasta la aplicación práctica de herramientas y BIM:',
    'syllabus'            => [
        [
            'title'   => 'Principios y Marco de Referencia ISO 31000',
            'icon'    => 'fa-solid fa-shield-halved',
            'content' => '<p>Fundamentos de la gestión del riesgo según la ISO 31000: principios rectores, integración en el liderazgo organizacional, diseño del marco para la gestión del riesgo y mejora continua en organizaciones del sector construcción.</p>',
        ],
        [
            'title'   => 'Proceso de Gestión del Riesgo en la Cadena de Producción',
            'icon'    => 'fa-solid fa-diagram-project',
            'content' => '<p>Alcance, contexto y criterios de evaluación. Identificación sistemática de riesgos en la cadena de abastecimiento, análisis de causas y consecuencias, valoración y tratamiento de riesgos operativos, contractuales y logísticos.</p>',
        ],
        [
            'title'   => 'Herramientas Técnicas de Evaluación (ISO 31010 / PMI)',
            'icon'    => 'fa-solid fa-toolbox',
            'content' => '<p>Aplicación práctica de herramientas técnicas:</p><ul><li>Diagrama de afinidad y tormenta de ideas estructurada.</li><li>Árbol de fallas y árbol de eventos.</li><li>Diagrama de Pareto e Ishikawa causa-efecto.</li><li>Análisis Bow Tie aplicado a eventos críticos.</li><li>Valor Monetario Esperado (EMV), Matriz PxI y Mapas de Calor.</li></ul>',
        ],
        [
            'title'   => 'Modelado BIM Aplicado a la Gestión de Riesgos',
            'icon'    => 'fa-solid fa-cubes',
            'content' => '<p>Uso de modelos BIM (Building Information Modeling) para la detección temprana de colisiones, simulación 4D de fases constructivas, visualización de riesgos de seguridad y control de interferencias en la cadena de montaje y suministros.</p>',
        ],
        [
            'title'   => 'Plan de Respuesta, Monitoreo y Lecciones Aprendidas',
            'icon'    => 'fa-solid fa-clipboard-check',
            'content' => '<p>Formulación de planes de mitigación, contingencia y transferencia. Establecimiento de indicadores clave de riesgo (KRI), auditorías de control, registro dinámico y retroalimentación mediante lecciones aprendidas.</p>',
        ],
    ],
    'docente'             => [
        'name'            => 'Ing. Omar A. Samaniego',
        'experience_tag'  => 'Más de 25 años de experiencia',
        'photo'           => 'img/Omar_Samaniego.png',
        'photo_webp'      => 'img/Omar_Samaniego.webp',
        'credentials'     => ['CIP', 'PMP®', 'PMI-RMP®', 'NEC4', 'VDC - Stanford', 'LSS Black Belt'],
        'summary'         => 'Profesional con más de 25 años de experiencia en el Sector Construcción en Gestión de Proyectos, Riesgos y Calidad en empresas líderes en el Perú y el extranjero. Director de Quality Consulting Solutions, docente de postgrado y ponente en congresos internacionales.',
        'highlights'      => [
            '<strong>Contribuidor Registrado</strong> del nuevo <strong>Estándar de Riesgos del PMI® 2024</strong> y de la <strong>Guía del PMBOK® 7ma Edición</strong>.',
            'Autor de los libros <em>«Gestión de los Riesgos Técnicos en la Construcción»</em> e <em>«ISO 9001 para la Construcción»</em>.',
            'Trayectoria de alta dirección: Ex Risk & Quality Manager en Gleeds (UK), Jefe Corporativo de Calidad en Graña y Montero (GyM), Gerente de Proyectos en Buenaventura Ingenieros y Jefe de Calidad en Cosapi.',
            'Catedrático de postgrado en la Universidad Peruana de Ciencias Aplicadas (UPC), MDI PUCP - Universidad Politécnica de Madrid, Universidad de Lima e Instituto para la Calidad.',
        ],
        'recognition'     => 'Expositor en conferencias internacionales de Stanford University (Techsuyo, 2017), Global Congress PMI (Washington D.C., 2010) y Congreso Regional PMI Lima.',
    ],
    'benefits'            => [
        [
            'icon'  => 'fa-solid fa-network-wired',
            'title' => 'Enfoque Integral en Cadena de Producción',
            'text'  => 'Metodología aplicable a compras, subcontratación, logística y producción en obra civil.',
        ],
        [
            'icon'  => 'fa-solid fa-cube',
            'title' => 'Entornos y Metodología BIM',
            'text'  => 'Visualización y detección temprana de interferencias y riesgos con herramientas BIM.',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '16 Horas & 16 PDU Oficiales',
            'text'  => 'Acreditación oficial para el mantenimiento de credenciales PMI® bajo The PMI Talent Triangle®.',
        ],
        [
            'icon'  => 'fa-solid fa-certificate',
            'title' => 'Diploma Digital Oficial',
            'text'  => 'Diploma digital emitido a nombre de Quality Consulting Solutions.',
        ],
        [
            'icon'  => 'fa-solid fa-toolbox',
            'title' => 'Plantillas y Matrices ISO 31010',
            'text'  => 'Formatos editables de Bow Tie, matrices de probabilidad e impacto y mapas de calor.',
        ],
        [
            'icon'  => 'fa-solid fa-video',
            'title' => 'Grabaciones y Bolsa de Trabajo',
            'text'  => 'Acceso a grabaciones de clase durante 4 semanas e incorporación a nuestra bolsa de empleo.',
        ],
    ],
    'pdu_title'           => 'Acreditación Oficial de 16 PDU ante el PMI®',
    'pdu_text'            => 'Si tienes certificación del PMI® este curso te brinda <strong>16 PDU</strong> (Professional Development Unit) para mantener tu certificación según la descripción provista por el PMI®: <em>(Professional Development Unit) Categoría PMI® CCR: General Education Third-Party Provider. The PMI Talent Triangle®</em>.',
    'whatsapp_url'        => 'https://wa.me/51993463118?text=' . rawurlencode('Buen día, deseo solicitar información sobre el curso de Riesgos en la Cadena de Producción de la Construcción ISO 31000 usando BIM'),
    'whatsapp_btn_text'   => 'Solicitar información por WhatsApp',
    'modal_service'       => 'Riesgos en la Cadena de Producción ISO 31000 usando BIM',
    'paypal_slug'         => 'riesgos-cadena-produccion',
    'area_back_url'       => '/capacitacion-riesgos',
    'area_back_title'     => 'Volver al Área de Riesgos',
    'videos'              => [
        [
            'header'    => 'Cadena de Producción & Riesgos - Sesión 1',
            'embed_url' => 'https://www.youtube.com/embed/ZtqdT9OiPzo',
            'title'     => 'Riesgos de la Cadena de Producción - Video 1',
            'caption'   => '<strong>Cadena de Valor & Suministros:</strong> Mapeo integral de riesgos en el aprovisionamiento y procesos de obra.',
        ],
        [
            'header'    => 'Cadena de Producción & Riesgos - Sesión 2',
            'embed_url' => 'https://www.youtube.com/embed/rMK0nn3LkRU',
            'title'     => 'Riesgos de la Cadena de Producción - Video 2',
            'caption'   => '<strong>Herramientas ISO 31010:</strong> Aplicación práctica de diagramas de causa-efecto y matrices de mitigación.',
        ],
    ],
];

require __DIR__ . '/../partials/course_detail_unified.php';
