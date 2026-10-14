<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Gestión de Riesgos en Proyectos con el Enfoque PMI® (Diseño Unificado)
 * Archivo: app/Views/pages/riesgos-pmi.php
 */

declare(strict_types=1);

$course = [
    'hero_badge'          => 'ESTÁNDARES FUNDACIONALES PMI® • 16 HORAS NETAS • 08 SESIONES',
    'hero_badge_icon'     => 'fa-solid fa-shield-alt',
    'title'               => 'GESTIÓN DE RIESGOS EN PROYECTOS CON EL ENFOQUE PMI®',
    'summary'             => 'Aprende los aspectos clave y consejos prácticos de la gestión de riesgos bajo los estándares y procesos del Project Management Institute (PMI®), impartido por el presidente fundador del Capítulo Peruano del PMI®.',
    'hero_cards'          => [
        [
            'icon'  => 'fa-solid fa-circle-play',
            'title' => '16 HORAS & 8 SESIONES',
            'desc'  => 'Estructura intensiva de 16 horas netas distribuidas en 8 sesiones especializadas.',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '16 PDU ACREDITADAS',
            'desc'  => 'Otorga 16 PDU ante el PMI® para el mantenimiento de credenciales profesionales vigentes.',
        ],
        [
            'icon'  => 'fa-solid fa-chalkboard-user',
            'title' => 'DOCENTE FUNDADOR PMI®',
            'desc'  => 'Impartido por el Ing. Félix Valdez – Torero, fundador del Capítulo Peruano del PMI®.',
        ],
        [
            'icon'  => 'fa-solid fa-video',
            'title' => 'GRABACIÓN POR 6 SEMANAS',
            'desc'  => 'Acceso vía campus virtual a las grabaciones durante 6 semanas con material digital incluido.',
        ],
    ],
    'objective'           => 'Exponer la conexión entre los procesos de gestión de riesgos siguiendo la metodología PMI® y su aplicación en situaciones concretas en el día a día de los proyectos. Identificar ejemplos y compartir experiencias en las que se ilustre la implementación efectiva de los procesos de gestión de riesgos.',
    'objective_highlights'=> [
        'Interconexión entre el acta de constitución, plan de gestión de proyectos y plan de gestión de riesgos.',
        'Técnicas de detección, recopilación de información y estructuración del registro de riesgos.',
        'Evaluación cualitativa y cuantitativa mediante matrices de frecuencia e impacto y mapa de calor.',
        'Estrategias aplicadas para enfrentar amenazas y oportunidades en el ciclo de vida del proyecto.',
    ],
    'syllabus_intro'      => 'Estructura modular dividida en los 6 procesos estándar de gestión de riesgos de la metodología PMI®:',
    'syllabus'            => [
        [
            'title'   => 'Planificar la Gestión de los Riesgos',
            'icon'    => 'fa-solid fa-compass-drafting',
            'content' => '<p>Se exponen los componentes de esta etapa, tales como el acta de constitución del proyecto y el plan de gestión de proyectos, junto con el empleo de juicio experto para desarrollar el plan de gestión de riesgos.</p>',
        ],
        [
            'title'   => 'Identificar los Riesgos',
            'icon'    => 'fa-solid fa-magnifying-glass-chart',
            'content' => '<p>Se detallan los componentes del proceso de detección de riesgos, abordando sus insumos como el plan de gestión de riesgos y acuerdos pertinentes. Se lleva a cabo la recopilación de información, se elabora el registro de riesgos y se generan otras salidas relevantes.</p>',
        ],
        [
            'title'   => 'Realizar el Análisis de Riesgos',
            'icon'    => 'fa-solid fa-chart-pie',
            'content' => '<p>Se expone el alcance del análisis, tanto desde una perspectiva cualitativa como cuantitativa. Se explora en detalle el análisis cualitativo, incluyendo sus diversas técnicas, y se procede a la evaluación de los resultados obtenidos. Se crea una matriz de frecuencia e impacto, se genera un mapa de calor y se establece la asignación de riesgos. Asimismo, se exponen los principios básicos del análisis cuantitativo.</p>',
        ],
        [
            'title'   => 'Planificar la Respuesta a los Riesgos',
            'icon'    => 'fa-solid fa-shield-halved',
            'content' => '<p>Se exploran las categorías de respuesta ante los riesgos, utilizando como punto de partida las entradas proporcionadas por este proceso. Se emplean diversas herramientas y técnicas, como estrategias para enfrentar tanto amenazas como oportunidades, así como el análisis de datos, con el propósito de generar resultados que incluyen solicitudes de cambios.</p>',
        ],
        [
            'title'   => 'Implementar la Respuesta a los Riesgos',
            'icon'    => 'fa-solid fa-gears',
            'content' => '<p>Se exponen las razones detrás de la falta de implementación de las respuestas a riesgos, y se presentan enfoques que promueven la ejecución de las respuestas de riesgos conforme al plan de gestión de riesgos.</p>',
        ],
        [
            'title'   => 'Monitorear los Riesgos',
            'icon'    => 'fa-solid fa-gauge-high',
            'content' => '<p>Se detallan los estándares para la supervisión de riesgos, basados en el plan de gestión del proyecto y en los datos de rendimiento laboral, empleando herramientas y técnicas como las auditorías, con el propósito de generar resultados como los informes de rendimiento laboral.</p>',
        ],
    ],
    'docente'             => [
        'name'            => 'Ing. Félix Valdez – Torero',
        'experience_tag'  => 'Más de 35 años de experiencia',
        'photo'           => 'img/Feliz-Valdes-Torero.jpg',
        'photo_webp'      => 'img/Feliz-Valdes-Torero.webp',
        'credentials'     => ['ING.', 'PhD(c)', 'MSc', 'PMP®'],
        'summary'         => 'Profesional con más de 35 años de experiencia en gestión de la ingeniería, consultoría y capacitación en gerencia de proyectos para empresas de gran nivel nacional e internacional. Presidente fundador del Capítulo Peruano del PMI®, contribuidor registrado de la Guía del PMBOK® 6ta Edición y miembro del Consejo Directivo del INACAL.',
        'highlights'      => [
            'Presidente Fundador del <strong>Capítulo Peruano del PMI®</strong> y Contribuidor Registrado de la <strong>Guía del PMBOK® 6ta Edición</strong>.',
            'Presidente del <strong>AACE International – Sección Perú</strong> (American Association for Cost Engineering) y miembro del Consejo Directivo del <strong>INACAL</strong> (Instituto Nacional de Calidad).',
            'Propietario de Proyectics, Director en Prosac, ex Director en Cosapi Data y ex Gerente de Ingeniería en Cosapi.',
            'Catedrático de postgrado en la Pontificia Universidad Católica del Perú (PUCP), Centrum Graduate Business School y Universidad Peruana de Ciencias Aplicadas (UPC).',
            'Consultoría y gerencia de proyectos para empresas de gran nivel: Antamina, BBVA Banco Continental, Banco Central de Reserva del Perú (BCRP), Belcorp, Buenaventura Ingenieros, Corporación Aceros Arequipa, Cosapi S.A., Doe Run Perú, Interbank, JJC Contratistas Generales, Knight Piésold, Occidental Petroleum, Tintaya (Xstrata), entre otras.',
        ],
    ],
    'benefits'            => [
        [
            'icon'  => 'fa-solid fa-award',
            'title' => 'Certificación de 16 PDU',
            'text'  => 'Acreditación oficial ante el PMI® para el mantenimiento de credenciales profesionales vigentes.',
        ],
        [
            'icon'  => 'fa-solid fa-certificate',
            'title' => 'Diploma Digital Incluido',
            'text'  => 'Diploma digital emitido a nombre de Quality Consulting Solutions incluido en la inversión.',
        ],
        [
            'icon'  => 'fa-solid fa-file-lines',
            'title' => 'Material Digital Completo',
            'text'  => 'Entrega de material digital, diapositivas de clase y matrices de gestión de riesgos.',
        ],
        [
            'icon'  => 'fa-solid fa-video',
            'title' => 'Grabación por 6 Semanas',
            'text'  => 'Acceso vía internet a las grabaciones completas del curso durante 6 semanas.',
        ],
        [
            'icon'  => 'fa-solid fa-users',
            'title' => 'Ingreso a Base Laboral',
            'text'  => 'Incorporación a la base de datos de profesionales y bolsa de trabajo de Quality Consulting Solutions.',
        ],
        [
            'icon'  => 'fa-solid fa-tags',
            'title' => 'Descuentos de Ex-alumno',
            'text'  => 'Descuentos y tarifas preferenciales para futuros cursos con precios ordinarios.',
        ],
    ],
    'pdu_title'           => 'Certificación Oficial de 16 PDU ante el PMI®',
    'pdu_text'            => 'Si ya tienes certificación del PMI®, este curso te brinda <strong>16 PDU</strong> (Professional Development Unit) para mantener vigente tu certificación: <em>PDU (Professional Development Unit) Categoría PMI® CCR: General Education Third-Party Provider – The PMI Talent Triangle®</em>.',
    'whatsapp_url'        => 'https://wa.me/51993463118?text=' . rawurlencode('Buen día, deseo solicitar información sobre el curso de Gestión de Riesgos en Proyectos con el Enfoque PMI®'),
    'whatsapp_btn_text'   => 'Solicitar información por WhatsApp',
    'modal_service'       => 'Gestión de Riesgos en Proyectos con el Enfoque PMI®',
    'paypal_slug'         => 'riesgos-pmi',
    'area_back_url'       => '/capacitacion-riesgos',
    'area_back_title'     => 'Volver al Área de Riesgos',
];

require __DIR__ . '/../partials/course_detail_unified.php';
