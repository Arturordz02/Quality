<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Detalle: Seminario Método de la Curva de Completion para Evitar el Síndrome del 90%
 * Archivo: private_app/app/Views/pages/sindrome-del-90.php
 * Plantilla base compartida: app/Views/partials/course_detail_unified.php
 */

declare(strict_types=1);

$course = [
    // 1. Hero Banner
    'hero_badge'      => 'SEMINARIO EN VIVO • VIRTUAL TIEMPO REAL',
    'hero_badge_icon' => 'fa-solid fa-chart-line',
    'title'           => 'MÉTODO DE LA CURVA DE COMPLETION PARA EVITAR EL SÍNDROME DEL 90%',
    'summary'         => 'Metodología predictiva adoptada por INACAL (Guía Peruana GP 151) para estimar con precisión matemática la fecha de compleción del proyecto, diferenciar avance físico vs. compleción de entregables y prevenir desviaciones críticas en la entrega final de obras.',
    'hero_cards'      => [
        [
            'icon'  => 'fa-solid fa-book-bookmark',
            'title' => 'GUÍA PERUANA GP 151',
            'desc'  => 'Método de evaluación de compleción adoptado por INACAL y publicado para el sector construcción.',
        ],
        [
            'icon'  => 'fa-solid fa-scale-unbalanced',
            'title' => 'AVANCE VS. COMPLETION',
            'desc'  => 'Diferenciación conceptual y práctica para no interpretar como casi terminado un proyecto con saldo crítico.',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '04 PDU OFICIALES',
            'desc'  => 'Horas de desarrollo profesional categoría PMI® CCR dentro del Technical Project Management.',
        ],
        [
            'icon'  => 'fa-solid fa-laptop',
            'title' => 'VIRTUAL TIEMPO REAL',
            'desc'  => 'Seminario ágil interactivo con matrices de calidad y plantillas de cálculo de aplicación directa.',
        ],
    ],

    // 2. Objetivo del curso
    'objective'            => 'Presentar el <strong>Método de la Curva de Completion</strong> adoptado por el Instituto Nacional de Calidad (INACAL) y publicado en la <strong>Guía Peruana GP 151</strong> para estimar de manera confiable la fecha real de compleción del proyecto. Proporcionar criterios para diferenciar conceptual y prácticamente la medición del avance físico porcentual frente a la medición objetiva de la compleción de entregables, evitando que el último 10% del proyecto consuma demoras desproporcionadas en el cierre.',
    'objective_image'      => '',
    'objective_image_webp' => '',
    'objective_image_alt'  => 'Curva de Completion y control predictivo del plazo en construcción',
    'objective_highlights' => [
        'Diferenciación cuantitativa entre avance financiero/físico y compleción real de entregables.',
        'Metodología adoptada por INACAL y el International Group for Lean Construction (IGLC).',
        'Validada y presentada en foros internacionales: PMI Global Congress en Washington D.C., Techsuyo en Stanford University y Congreso Lean Construction en México.',
        'Herramientas prácticas: Matriz de Calidad, curvas de liberación y plantillas simplificadas de seguimiento.',
    ],

    // 3. Temario del curso
    'syllabus_intro'       => 'Estructura técnica y práctica orientada al control estricto de entregables, matrices de calidad y curvas de liberación:',
    'syllabus'             => [
        [
            'title'   => 'Presentación de la Guía Peruana GP 151 e Introducción al Síndrome del 90%',
            'icon'    => 'fa-solid fa-book-open',
            'content' => '<p>Marco técnico y antecedentes de la Guía Peruana GP 151 adoptada por INACAL para la evaluación de la compleción en proyectos de construcción. Diagnóstico del Síndrome del 90%: causas raíz por las cuales el avance porcentual reportado no refleja el saldo pendiente de liberación y cómo identificarlo oportunamente.</p>',
        ],
        [
            'title'   => 'Método estándar - Matriz de Calidad y Curva de Completion',
            'icon'    => 'fa-solid fa-table-cells',
            'content' => '<p>Estructuración de la Matriz de Calidad para el mapeo individualizado de entregables. Metodología de modelado y construcción de la Curva de Completion frente a la curva de avance tradicional. Determinación del límite superior de compleción y detección temprana de desfases operacionales.</p>',
        ],
        [
            'title'   => 'Método simplificado - Plantilla de cálculo y control de entregables',
            'icon'    => 'fa-solid fa-file-excel',
            'content' => '<p>Aplicación de la plantilla simplificada para construcciones provisionales, obras preliminares y partidas críticas de arquitectura e instalaciones. Formulación de los indicadores EV, Q3 y Q3\' para la cuantificación objetiva del progreso y estado de pruebas.</p>',
        ],
        [
            'title'   => 'Análisis de restricciones de liberación y toma de decisiones',
            'icon'    => 'fa-solid fa-filter-circle-xmark',
            'content' => '<p>Identificación sistemática de cuellos de botella en inspecciones, pruebas funcionales y comisionamiento. Gestión preventiva de restricciones para blindar la fecha contractual de entrega, mitigando sobrecostos por gastos generales extendidos y penalidades por retraso.</p>',
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
            'NECA',
            'VDC - Stanford',
            'PMP®',
            'PMI-RMP®',
            'LSS Black Belt',
        ],
        'summary'        => 'Profesional con más de 25 años de experiencia en Gestión de la Calidad en el Sector Construcción en empresas líderes en el Perú y el extranjero. Experiencia en principales corporaciones de infraestructura, ponente en congresos internacionales de primer nivel y docente de postgrado en universidades de prestigio. Contribuidor registrado de estándares fundacionales del Project Management Institute (PMI®).',
        'highlights'     => [
            '<strong>Gleeds:</strong> Risk & Quality Mgr.',
            '<strong>Graña y Montero:</strong> Jefe Corporativo del Área de Calidad de GyM.',
            '<strong>Buenaventura Ingenieros:</strong> Gerente de Proyectos.',
            '<strong>Cosapi:</strong> Jefe de Calidad.',
            '<strong>Bechtel:</strong> Líder de Calidad Electromecánico.',
        ],
        'full_bio_items' => [
            '<strong>Universidad Peruana de Ciencias Aplicadas (UPC):</strong> Catedrático de Postgrado.',
            '<strong>MDI Centrum:</strong> Catedrático de Gestión de la Calidad.',
            '<strong>PMI Global Congress, Washington D.C. 2010:</strong> Expositor de la metodología.',
            '<strong>Techsuyo at Stanford University:</strong> Ponente sobre prevención del Síndrome del 90%.',
            '<strong>Congreso Lean Construction México:</strong> Disertante sobre curvas de liberación.',
            '<strong>Comité de la Calidad de CAPECO:</strong> Presidente.',
            '<strong>Revistas Técnicas:</strong> Columnista en Construcción e Industria (CAPECO) y El Constructivo.',
            '<strong>ASQ Perú:</strong> LMC executive board member.',
        ],
        'recognition'    => 'Metodología adoptada oficialmente por el Instituto Nacional de Calidad (INACAL) bajo la Guía Peruana GP 151 y expuesta en Stanford University.',
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
            'title' => 'Alerta temprana de descuentos',
            'text'  => 'Tarifas preferenciales de descuento para futuros cursos y seminarios especializados.',
        ],
        [
            'icon'  => 'fa-solid fa-file-excel',
            'title' => 'Formatos y plantillas digitales',
            'text'  => 'Acceso a material digital del seminario, matriz de calidad y formatos de cálculo en línea.',
        ],
        [
            'icon'  => 'fa-solid fa-certificate',
            'title' => 'Diploma digital oficial',
            'text'  => 'Certificado digital de participación emitido a nombre de Quality Consulting Solutions.',
        ],
        [
            'icon'  => 'fa-solid fa-users',
            'title' => 'Sesiones exclusivas',
            'text'  => 'Ingreso a sesiones virtuales de contenidos técnicos complementarios sin costo adicional.',
        ],
    ],
    'pdu_heading'          => 'Unidades de desarrollo profesional (04 PDU)',
    'pdu_text'             => '04 PDU (Professional Development Unit) categoría PMI® CCR: General Education Third-Party Provider. Technical Project Management dentro del PMI Talent Triangle®. Válidas para mantener activas las certificaciones del Project Management Institute.',

    // 6. Información e inscripción
    'enroll_bg_image'      => '',
    'whatsapp_url'         => 'https://api.whatsapp.com/send?phone=51993463118&text=' . urlencode('Hola Quality Consulting Solutions, deseo información sobre el Seminario Método de la Curva de Completion para Evitar el Síndrome del 90%.'),
    'modal_service'        => 'Seminario Completion - Evita el Síndrome del 90%',
    'paypal_slug'          => 'sindrome-del-90',

    // 7. Video de conferencia
    'videos'               => [
        [
            'header'    => 'Techsuyo at Stanford University',
            'embed_url' => 'https://www.youtube.com/embed/Pxe6RP_J9Ek',
            'title'     => 'Conferencia sobre Prevención del Síndrome del 90% en Stanford University',
            'caption'   => '<strong>Conferencia Magistral:</strong> Exposición de la metodología de la Curva de Liberación y prevención del Síndrome del 90% presentada en Techsuyo, Stanford University.',
        ],
    ],
];

echo $this->partial('course_detail_unified', ['course' => $course]);
