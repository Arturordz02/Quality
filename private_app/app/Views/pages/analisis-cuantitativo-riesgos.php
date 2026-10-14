<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Análisis Cuantitativo de Riesgos del Costo y Cronograma con Simulación de Monte Carlo (Diseño Unificado)
 * Archivo: app/Views/pages/analisis-cuantitativo-riesgos.php
 */

declare(strict_types=1);

$course = [
    'hero_badge'          => 'SIMULACIÓN DE MONTE CARLO • MODELADO DE COSTO Y CRONOGRAMA • 12 HORAS NETAS',
    'hero_badge_icon'     => 'fa-solid fa-chart-line',
    'title'               => 'ANÁLISIS CUANTITATIVO DE RIESGOS DEL COSTO Y CRONOGRAMA CON SIMULACIÓN DE MONTE CARLO',
    'summary'             => 'Domina las técnicas avanzadas de modelado probabilístico y simulación de Monte Carlo aplicadas a costos y cronogramas en proyectos de construcción, estimando contingencias reales mediante herramientas cuantitativas de clase mundial.',
    'hero_cards'          => [
        [
            'icon'  => 'fa-solid fa-chart-pie',
            'title' => 'SIMULACIÓN MONTE CARLO',
            'desc'  => 'Modelado probabilístico con miles de iteraciones para estimar contingencias de tiempo y costo con certeza estadística.',
        ],
        [
            'icon'  => 'fa-solid fa-tornado',
            'title' => 'GRÁFICOS DE TORNADO',
            'desc'  => 'Análisis de sensibilidad y drivers de riesgo para identificar actividades críticas con mayor impacto en el proyecto.',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '12 HORAS & 12 PDU',
            'desc'  => '12 PDU para credenciales PMI® (CCR: General Education Third-Party Provider – The PMI Talent Triangle®).',
        ],
        [
            'icon'  => 'fa-solid fa-calculator',
            'title' => 'REPORTES DE CONTINGENCIA',
            'desc'  => 'Generación de curvas S probabilísticas, percentiles P50/P80 y justificación cuantitativa de reservas de contingencia.',
        ],
    ],
    'objective'           => 'Desarrollar competencias en la aplicación de técnicas cuantitativas de análisis de riesgos orientadas a determinar con rigor estadístico las contingencias de costo y plazo en proyectos de construcción y minería. Mediante simulación de Monte Carlo y análisis de sensibilidad (diagramas de tornado), los participantes modelarán la incertidumbre del cronograma y presupuesto para sustentar la toma de decisiones directivas.',
    'objective_highlights'=> [
        'Comprensión e implementación de los procesos de gestión de riesgos según estándares internacionales.',
        'Modelado probabilístico de distribuciones de probabilidad (Beta, Triangular, Normal) en duraciones y costos.',
        'Ejecución e interpretación de simulaciones de Monte Carlo para curvas S de probabilidad acumulada (P50, P80).',
        'Identificación de drivers de riesgo, gráficos de tornado y cálculo justificado de reservas de contingencia.',
    ],
    'syllabus_intro'      => 'El programa se desarrolla en 3 módulos intensivos (06 sesiones / 12 horas netas) con enfoque 100% práctico y cuantitativo:',
    'syllabus'            => [
        [
            'title'   => 'Procesos de Gestión de Riesgos',
            'icon'    => 'fa-solid fa-diagram-project',
            'content' => '<p>Alineamiento metodológico de la gestión de riesgos en proyectos:</p><ul><li>Planificar la gestión de riesgos en proyectos de envergadura.</li><li>Identificación integral de riesgos de cronograma y presupuesto.</li><li>Análisis cualitativo de riesgos y priorización preliminar.</li><li>Plan de respuesta a los riesgos y estrategias de contingencia.</li><li>Monitoreo y control continuo de riesgos.</li></ul>',
        ],
        [
            'title'   => 'Análisis Cuantitativo de Riesgos (Monte Carlo & Sensibilidad)',
            'icon'    => 'fa-solid fa-chart-line',
            'content' => '<p>Desarrollo técnico de herramientas cuantitativas avanzadas:</p><ul><li>Estimación de contingencias de costo y cronograma.</li><li>Valor Monetario Esperado (EMV) y Análisis del Árbol de Decisiones.</li><li>Definición de funciones y distribuciones de probabilidad.</li><li>Identificación de drivers de riesgo e incertidumbre en actividades.</li><li>Simulación de Monte Carlo: iteraciones, convergencia y análisis de sensibilidad (diagrama de tornado).</li><li>Técnicas de modelado con software especializado (Primavera Risk Analysis / herramientas de simulación).</li></ul>',
        ],
        [
            'title'   => 'Reporte y Sustentación de Contingencias',
            'icon'    => 'fa-solid fa-file-invoice-dollar',
            'content' => '<p>Elaboración de entregables ejecutivos para comités de dirección y clientes:</p><ul><li>Interpretación de curvas de probabilidad acumulada (percentiles P50, P70, P80).</li><li>Definición y justificación de reservas de contingencia para contingencias de plazo y costo.</li><li>Reporte ejecutivo de riesgos cuantitativos y recomendaciones para el plan de respuesta.</li></ul>',
        ],
    ],
    'docente'             => [
        'name'            => 'Ing. Edwar Marcelo',
        'experience_tag'  => 'Más de 15 años de experiencia',
        'photo'           => '',
        'photo_webp'      => '',
        'credentials'     => ['ING.', 'PMP®', 'PMI-RMP®', 'PMI-SP®', 'ECCDA', 'PRINCE2®'],
        'summary'         => 'Ingeniero con más de 15 años de experiencia profesional en control de proyectos, gestión de riesgos cuantitativos, programación y costos en proyectos de construcción, infraestructura y minería. Especialista en simulación de Monte Carlo, Primavera Risk Analysis y estándares internacionales de gestión de proyectos.',
        'highlights'      => [
            'Certificaciones internacionales de alto nivel en gestión de riesgos y programación: <strong>PMP®</strong>, <strong>PMI-RMP®</strong> (Risk Management Professional), <strong>PMI-SP®</strong> (Scheduling Professional) y <strong>PRINCE2®</strong>.',
            'Vasta trayectoria como especialista y consultor en empresas líderes del sector como <strong>IDON</strong>, <strong>Asesores y Consultores TF</strong>, <strong>DISMET</strong> y <strong>VQ Ingeniería</strong>.',
            'Especialista en modelado probabilístico de cronogramas y costos mediante simulación de Monte Carlo, curvas S probabilísticas y determinación de contingencias contractuales.',
            'Docente y capacitador corporativo en metodologías cuantitativas de riesgos y herramientas avanzadas de control de proyectos.',
        ],
        'recognition'     => 'Especialista en software de simulación estocástica y conferencista en congresos de dirección de proyectos.',
    ],
    'benefits'            => [
        [
            'icon'  => 'fa-solid fa-chart-line',
            'title' => 'Modelado Cuantitativo y Monte Carlo',
            'text'  => 'Dominio de simulaciones estadísticas con miles de iteraciones para plazo y costo.',
        ],
        [
            'icon'  => 'fa-solid fa-tornado',
            'title' => 'Análisis de Sensibilidad y Tornado',
            'text'  => 'Identificación de actividades y riesgos críticos que gobiernan la variabilidad del proyecto.',
        ],
        [
            'icon'  => 'fa-solid fa-award',
            'title' => '12 Horas & 12 PDU Oficiales',
            'text'  => '12 PDU reconocidos ante el PMI® (CCR: General Education Third-Party Provider – The PMI Talent Triangle®).',
        ],
        [
            'icon'  => 'fa-solid fa-certificate',
            'title' => 'Diploma Digital Oficial',
            'text'  => 'Diploma digital emitido a nombre de Quality Consulting Solutions.',
        ],
        [
            'icon'  => 'fa-solid fa-file-excel',
            'title' => 'Modelos y Plantillas Cuantitativas',
            'text'  => 'Archivos de simulación, hojas de cálculo y modelos de distribución probabilística.',
        ],
        [
            'icon'  => 'fa-solid fa-video',
            'title' => 'Grabaciones y Bolsa de Trabajo',
            'text'  => 'Acceso a grabaciones durante 4 semanas e incorporación a la bolsa de trabajo institucional.',
        ],
    ],
    'pdu_title'           => 'Acreditación Oficial de 12 PDU ante el PMI®',
    'pdu_text'            => 'Si tienes certificación del PMI® este curso te brinda <strong>12 PDU</strong> (Professional Development Unit) para mantener tu certificación según la descripción provista por el PMI®: <em>(Professional Development Unit) Categoría PMI® CCR: General Education Third-Party Provider – The PMI Talent Triangle®</em>.',
    'whatsapp_url'        => 'https://wa.me/51993463118?text=' . rawurlencode('Buen día, deseo solicitar información sobre el curso de Análisis Cuantitativo de Riesgos del Costo y Cronograma con Simulación de Monte Carlo'),
    'whatsapp_btn_text'   => 'Solicitar información por WhatsApp',
    'modal_service'       => 'Análisis Cuantitativo de Riesgos del Costo y Cronograma con Simulación de Monte Carlo',
    'paypal_slug'         => 'analisis-cuantitativo-riesgos',
    'area_back_url'       => '/capacitacion-riesgos',
    'area_back_title'     => 'Volver al Área de Riesgos',
    'videos'              => [],
];

require __DIR__ . '/../partials/course_detail_unified.php';

