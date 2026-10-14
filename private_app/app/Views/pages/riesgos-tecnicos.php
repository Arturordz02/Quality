<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Gestión de Riesgos Técnicos en la Construcción (Diseño Unificado)
 * Archivo: app/Views/pages/riesgos-tecnicos.php
 */

declare(strict_types=1);

$course = [
    'hero_badge'          => 'NUEVO ESTÁNDAR DE RIESGOS PMI® 2024 • INCLUYE USOS AI • 16 HORAS NETAS',
    'hero_badge_icon'     => 'fa-solid fa-shield-halved',
    'title'               => 'GESTIÓN DE RIESGOS TÉCNICOS EN LA CONSTRUCCIÓN CON EL NUEVO ESTÁNDAR DEL PMI® 2024',
    'summary'             => 'Presenta el vínculo directo de los procesos de gestión de riesgos según el nuevo Estándar de Riesgos PMI® 2024 con la realidad práctica y lecciones aprendidas en obra. Incluye taller de Inteligencia Artificial aplicada, panel de control en la nube y entrega del libro de autoría del docente.',
    'hero_cards'          => [
        [
            'icon'  => 'fa-solid fa-book',
            'title' => 'LIBRO DE ESPECIALIDAD',
            'desc'  => 'Incluye el libro «Gestión de los Riesgos Técnicos en la Construcción» de autoría del Ing. Omar Samaniego.',
        ],
        [
            'icon'  => 'fa-solid fa-robot',
            'title' => 'INTELIGENCIA ARTIFICIAL',
            'desc'  => 'Aplicación de herramientas y prompts de IA para la identificación, evaluación y mitigación predictiva de riesgos.',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '16 HORAS & 16 PDU',
            'desc'  => '16 PDU para el mantenimiento de credenciales PMI® (Categoría CCR – The PMI Talent Triangle®).',
        ],
        [
            'icon'  => 'fa-solid fa-cloud',
            'title' => 'PANEL CLOUD Y GRABACIÓN',
            'desc'  => 'Panel de control 100% en la nube, entregables descargables y acceso a grabaciones durante 4 semanas.',
        ],
    ],
    'objective'           => 'Presentar el vínculo de los procesos de la gestión de los riesgos según el nuevo estándar de riesgos PMI®, con los aspectos prácticos de la construcción. Identificar casos y compartir lecciones aprendidas donde se muestre la aplicación de los procesos de gestión de los riesgos. Nuestro docente es contribuidor registrado del nuevo Estándar de Riesgos para Portafolios, Programas y Proyectos del PMI®.',
    'objective_highlights'=> [
        'Alineamiento estricto al nuevo Estándar de Riesgos del PMI® 2024 y PMBOK® 7ma Edición.',
        'Estructuración de matrices cualitativas y cuantitativas adaptadas a las realidades contractuales y técnicas en campo.',
        'Formulación de planes de respuesta preventiva y contingencias para blindar plazo, costo y calidad constructiva.',
        'Aplicación de casos prácticos reales y lecciones aprendidas en proyectos de edificación, minería e infraestructura.',
    ],
    'syllabus_intro'      => 'El programa comprende 6 procesos fundamentales de gestión de riesgos adaptados a la construcción y un taller de aplicación integral con Inteligencia Artificial:',
    'syllabus'            => [
        [
            'title'   => 'Planificación de la Gestión de los Riesgos',
            'icon'    => 'fa-solid fa-compass-drafting',
            'content' => '<p>Se presentan los elementos de este proceso, como son el acta de constitución del proyecto, el plan de gestión de proyectos, entre otros, y cómo se interrelacionan a través, por ejemplo, del juicio experto para generar el plan de gestión de riesgos.</p>',
        ],
        [
            'title'   => 'Identificación de Riesgos (+Caso de Aplicación)',
            'icon'    => 'fa-solid fa-magnifying-glass-chart',
            'content' => '<p>Se explican los elementos del proceso de identificación de riesgos, considerando sus entradas, como el plan de gestión de riesgos, acuerdos, etc., para que a partir de técnicas como la recopilación de datos, generar el registro de riesgos, entre otras salidas. Incluye caso de aplicación práctica en obra.</p>',
        ],
        [
            'title'   => 'Realizar el Análisis de Riesgos',
            'icon'    => 'fa-solid fa-chart-pie',
            'content' => '<p>Se explica el alcance del análisis, tanto cualitativo y cuantitativo. Se desarrolla el análisis cualitativo, en cuanto a sus técnicas, y se evalúan los resultados. Se elabora una matriz de frecuencia – impacto, se genera el mapa de calor, y se define la asignación de riesgos. Se presentan los fundamentos del análisis cuantitativo.</p>',
        ],
        [
            'title'   => 'Elaboración del Plan de Respuesta a Riesgos (+Caso de Aplicación)',
            'icon'    => 'fa-solid fa-shield-halved',
            'content' => '<p>Se desarrollan los tipos de respuesta a riesgos, a partir de las entradas de este proceso, haciendo uso de herramientas y técnicas, como las estrategias para abordar amenazas, oportunidades, el análisis de datos, a fin de obtener salidas como las solicitudes de cambios. Incluye caso de aplicación práctica.</p>',
        ],
        [
            'title'   => 'Implementación de la Respuesta a Riesgos',
            'icon'    => 'fa-solid fa-gears',
            'content' => '<p>Se presentan las causas de la no implementación de las respuestas a riesgos, así como un modelo para crear un hábito para propiciar la respuesta a riesgos según lo planificado en la gestión de proyectos.</p>',
        ],
        [
            'title'   => 'Elaboración del Panel de Monitoreo de Riesgos',
            'icon'    => 'fa-solid fa-gauge-high',
            'content' => '<p>Se exponen los criterios para el monitoreo de riesgo, a partir del plan de gestión del proyecto, datos de desempeño del trabajo, haciendo uso de auditorías, entre otras técnicas y herramientas, propiciando salidas como informes de desempeño del trabajo.</p>',
        ],
        [
            'title'   => 'Taller de Aplicación Práctica con Inteligencia Artificial',
            'icon'    => 'fa-solid fa-robot',
            'content' => '<p>Elaboración de entregables y herramientas aplicadas en el sector construcción:</p><ul><li>Matriz Probabilidad por Impacto adaptada a obra.</li><li>Listado y registro integral de riesgos.</li><li>Plan formal de respuesta a riesgos.</li><li>Panel de Control 100% Nube (Cloud).</li><li>Usos prácticos de <strong>Inteligencia Artificial</strong> para analizar y predecir riesgos.</li></ul>',
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
            'icon'  => 'fa-solid fa-book',
            'title' => 'Libro de Especialidad',
            'text'  => 'Entrega del libro «Gestión de los Riesgos Técnicos en la Construcción» de autoría del docente.',
        ],
        [
            'icon'  => 'fa-solid fa-robot',
            'title' => 'Herramientas e Inteligencia Artificial',
            'text'  => 'Uso de prompts y flujos de IA para la identificación, análisis y mitigación de riesgos.',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => 'Certificación de 16 PDU',
            'text'  => 'Acreditación oficial para el mantenimiento de credenciales PMI® bajo The PMI Talent Triangle®.',
        ],
        [
            'icon'  => 'fa-solid fa-certificate',
            'title' => 'Diploma Digital Oficial',
            'text'  => 'Diploma digital emitido a nombre de Quality Consulting Solutions.',
        ],
        [
            'icon'  => 'fa-solid fa-cloud',
            'title' => 'Panel en la Nube y Plantillas',
            'text'  => 'Acceso a panel de control cloud, formatos editables y matrices técnicas de trabajo.',
        ],
        [
            'icon'  => 'fa-solid fa-video',
            'title' => 'Grabación y Bolsa Laboral',
            'text'  => 'Acceso a grabaciones durante 4 semanas e incorporación a la base de datos laboral institucional.',
        ],
    ],
    'pdu_title'           => 'Acreditación Oficial de 16 PDU ante el PMI®',
    'pdu_text'            => 'Si tienes certificación del PMI® este curso te brinda <strong>16 PDU</strong> (Professional Development Unit) para mantener tu certificación según la descripción provista por el PMI®: <em>(Professional Development Unit) Categoría PMI® CCR: General Education Third-Party Provider. The PMI Talent Triangle®</em>.',
    'whatsapp_url'        => 'https://wa.me/51993463118?text=' . rawurlencode('Buen día, deseo solicitar información sobre el curso de Gestión de Riesgos Técnicos en la Construcción con el Estándar PMI® 2024'),
    'whatsapp_btn_text'   => 'Solicitar información por WhatsApp',
    'modal_service'       => 'Gestión de Riesgos Técnicos en la Construcción',
    'paypal_slug'         => 'riesgos-tecnicos',
    'area_back_url'       => '/capacitacion-riesgos',
    'area_back_title'     => 'Volver al Área de Riesgos',
    'videos'              => [
        [
            'header'    => 'Metodología y Casos Prácticos - Parte 1',
            'embed_url' => 'https://www.youtube.com/embed/i_SoabWi3uo',
            'title'     => 'Gestión de Riesgos Técnicos de la Construcción - Video 1',
            'caption'   => '<strong>Fundamentos y Enfoque PMBOK®:</strong> Identificación técnica y estructuración del plan de riesgos en fases tempranas del proyecto.',
        ],
        [
            'header'    => 'Aplicación y Lecciones en Obra - Parte 2',
            'embed_url' => 'https://www.youtube.com/embed/lMo47jd1z8w',
            'title'     => 'Gestión de Riesgos Técnicos de la Construcción - Video 2',
            'caption'   => '<strong>Respuesta y Control Operativo:</strong> Implementación y monitoreo continuo de contingencias para blindar el plazo y costo contractual.',
        ],
    ],
];

require __DIR__ . '/../partials/course_detail_unified.php';
