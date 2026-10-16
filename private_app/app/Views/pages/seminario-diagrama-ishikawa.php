<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Seminario Casos de Aplicación del Diagrama de Ishikawa
 * Archivo: app/Views/pages/seminario-diagrama-ishikawa.php
 *
 * Basado en la plantilla unificada aprobada: app/Views/partials/course_detail_unified.php
 * Programa especializado de formación continua en gestión de calidad.
 */

declare(strict_types=1);

$course = [
    // 1. Hero Banner
    'hero_badge'          => 'ÁREA DE GESTIÓN DE LA CALIDAD • 03 HORAS NETAS • 06 PDU',
    'hero_badge_icon'     => 'fa-solid fa-graduation-cap',
    'title'               => 'CASOS DE APLICACIÓN DEL DIAGRAMA DE ISHIKAWA',
    'summary'             => 'Seminario especializado en el análisis de causa raíz, diferenciación entre acción correctiva y corrección, y aplicación práctica del Diagrama de Ishikawa mediante talleres interactivos y análisis de casos reales en video.',
    'hero_cards'          => [
        [
            'icon'  => 'fa-solid fa-brain',
            'title' => 'FUNDAMENTOS Y MITOS',
            'desc'  => 'Análisis de causa raíz, acción correctiva vs. corrección, diagrama de Ishikawa y mitos sobre la herramienta.',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '03 HORAS & 06 PDU',
            'desc'  => '03 horas netas de capacitación en vivo y 06 PDU para mantener tu certificación del PMI®.',
        ],
        [
            'icon'  => 'fa-solid fa-diagram-project',
            'title' => 'CASOS REALES EN VIDEO',
            'desc'  => 'Presentación de casos de estudio mediante video y resolución participativa de talleres aplicados.',
        ],
        [
            'icon'  => 'fa-solid fa-certificate',
            'title' => 'DIPLOMA Y BENEFICIOS',
            'desc'  => 'Diploma digital a nombre de Quality Consulting Solutions, entrega de material digital e ingreso a la base de datos laboral.',
        ],
    ],

    // 2. Objetivo del curso (Fiel al contenido del brochure)
    'objective'           => 'Presentar los fundamentos y la metodología de análisis de causa raíz mediante el Diagrama de Ishikawa, diferenciando la acción correctiva de la corrección y desmontando mitos comunes en la aplicación técnica. El seminario incluye el desarrollo práctico de talleres basados en la presentación de dos casos reales en video.',
    'objective_image'     => 'img/capacitaciones/seminario-diagrama-ishikawa.png',
    'objective_image_webp'=> 'img/capacitaciones/seminario-diagrama-ishikawa.webp',
    'objective_image_alt' => 'Casos de Aplicación del Diagrama de Ishikawa',
    'objective_highlights'=> [
        'Fundamentos metodológicos: análisis de causa raíz, acción correctiva versus corrección, estructura del Diagrama de Ishikawa y análisis de mitos comunes.',
        'Casos prácticos de aplicación: presentación de casos reales mediante video y desarrollo interactivo de talleres de análisis causa-efecto.',
        '03 horas netas de capacitación en vivo y 06 PDU para mantener la certificación del PMI®.',
    ],

    // 3. Temario del curso (Exactamente dos bloques oficiales según página 2 del brochure)
    'syllabus_intro'      => 'Estructura curricular organizada en dos bloques principales de aprendizaje metodológico y aplicación práctica:',
    'syllabus'            => [
        [
            'title'   => 'Fundamentos',
            'icon'    => 'fa-solid fa-brain',
            'content' => '<p>En este bloque se revisan los conceptos fundamentales del análisis metodológico de problemas en la gestión de calidad:</p><ul><li>Análisis de causa raíz.</li><li>Acción correctiva vs. corrección.</li><li>Diagrama de Ishikawa.</li><li>Mitos sobre el Diagrama de Ishikawa.</li></ul>',
        ],
        [
            'title'   => 'Aplicación',
            'icon'    => 'fa-solid fa-diagram-project',
            'content' => '<p>En este bloque se ejecutan los talleres y la aplicación práctica de la herramienta a través de casos de estudio:</p><ul><li>Presentación del caso 1 mediante video.</li><li>Taller del caso 1.</li><li>Presentación del caso 2 mediante video.</li><li>Taller del caso 2.</li></ul>',
        ],
    ],

    // 4. Perfil docente (Ing. Omar Samaniego - Páginas 1 y 2 del brochure)
    'docente'             => [
        'photo'          => 'img/Omar_Samaniego.png',
        'photo_webp'     => 'img/Omar_Samaniego.webp',
        'name'           => 'Ing. Omar A. Samaniego',
        'experience_tag' => '+25 años de experiencia',
        'credentials'    => ['ING., MASTER', 'NEC4', 'VDC Stanford', 'PMP®', 'PMI-RMP®', 'LSS Black Belt'],
        'summary'        => 'Profesional con más de 25 años de experiencia en el Sector Construcción en Gestión de Proyectos, Riesgos y Calidad en empresas líderes en el Perú y el extranjero. Experiencia docente en principales universidades, ponente en prestigiosos congresos, contribuidor registrado de estándares fundacionales del PMI® y autor de libros.',
        'highlights'     => [
            '<strong>Quality Consulting Solutions:</strong> Director.',
            '<strong>Gleeds (UK):</strong> Risk & Quality Mgr.',
            '<strong>Graña y Montero:</strong> Jefe Corporativo del Área de Calidad de GyM.',
            '<strong>Buenaventura Ingenieros:</strong> Gerente de Proyectos.',
        ],
        'full_bio_items' => [
            '<strong>Cosapi:</strong> Jefe de Calidad | <strong>Bechtel:</strong> Líder de Calidad Electromecánico.',
            '<strong>Catedrático Universitario:</strong> Universidad Peruana de Ciencias Aplicadas (UPC - Postgrado) y MDI Centrum (Catedrático de Gestión de la Calidad).',
            '<strong>Expositor Internacional:</strong> Congreso Global del PMI (Washington D.C., 2010) y Congreso Regional del PMI (Lima - Perú, 2008).',
            '<strong>Liderazgo y Publicaciones:</strong> Presidente del Comité de la Calidad de Capeco, Columnista en Revista Construcción e Industria – Capeco, Columnista en Revista El Constructivo y Miembro Directivo de ASQ Perú LMC.',
        ],
        'recognition'    => 'Contribuidor registrado de estándares fundacionales del PMI® y autor de libros especializados en construcción.',
    ],

    // 5. Beneficios oficiales permitidos (Página 3 del brochure - Sin consultoría)
    'benefits'            => [
        [
            'icon'  => 'fa-solid fa-briefcase',
            'title' => 'Base de datos laboral',
            'text'  => 'Ingreso a la base de datos laboral de Quality Consulting Solutions.',
        ],
        [
            'icon'  => 'fa-solid fa-percent',
            'title' => 'Descuento para futuros cursos',
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
            'text'  => 'Acceso vía internet a la grabación del curso luego de finalizado (4 semanas).',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '06 PDU',
            'text'  => '06 PDU para mantener tu certificación del PMI®.',
        ],
    ],

    // 6. Datos separados de PDU y duración (Páginas 1 y 3 del brochure)
    'pdu'                 => '06 PDU',
    'hours'               => '03 horas netas',
    'pdu_count'           => '06 PDU',
    'duration_hours'      => '03 horas netas',
    'pdu_title'           => 'Unidades de desarrollo profesional (6 PDU)',
    'pdu_text'            => '06 PDU para mantener tu certificación del PMI®.',

    // 7. Información e inscripción (Página 3 del brochure - Reutilizando flujo USD 10)
    'enroll_bg_image'     => 'img/capacitaciones/seminario-diagrama-ishikawa.webp',
    'whatsapp_url'        => 'https://api.whatsapp.com/send?phone=51993463118&text=Buen%20d%C3%ADa,%20deseo%20solicitar%20informaci%C3%B3n%20sobre%20el%20Seminario%20de%20Casos%20de%20Aplicaci%C3%B3n%20del%20Diagrama%20de%20Ishikawa',
    'whatsapp_btn_text'   => 'Solicitar información por WhatsApp',
    'modal_service'       => 'Seminario: Casos de Aplicación del Diagrama de Ishikawa',
    'paypal_slug'         => 'seminario-diagrama-ishikawa',
    'videos'              => [],
];

echo $this->partial('course_detail_unified', ['course' => $course]);
