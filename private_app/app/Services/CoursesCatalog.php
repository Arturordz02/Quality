<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Repositorio Centralizado de Capacitaciones Oficiales
 * Archivo: app/Services/CoursesCatalog.php
 *
 * Fuente única de datos para el Catálogo General y las 5 Páginas de Categoría:
 * - Calidad (1–10)
 * - Oficina Técnica (11–14)
 * - Contratos (15–25)
 * - Riesgos (26–30)
 * - Gestión de Proyectos (31–49)
 * Total: 49 Registros Oficiales
 */

declare(strict_types=1);

namespace App\Services;

class CoursesCatalog
{
    /**
     * Lista oficial de las 49 capacitaciones según registro institucional.
     */
    public static function getAll(): array
    {
        return [
            // ==========================================
            // CALIDAD (Números 1 al 10 - Total: 10)
            // ==========================================
            [
                'number'        => 1,
                'title'         => 'GERENCIA DE LA CALIDAD EN LA CONSTRUCCIÓN',
                'category'      => 'Calidad',
                'category_slug' => 'calidad',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/gerencia-de-la-calidad-construccion.webp',
                'image_fallback'=> 'img/capacitaciones/gerencia-de-la-calidad-construccion.png',
                'route'         => '/gerencia-de-calidad',
                'description'   => 'Visión integrada y práctica de la gestión de la calidad: PPI, costos de calidad, nuevos indicadores determinísticos/estocásticos, Last Planner® System e Inteligencia Artificial.'
            ],
            [
                'number'        => 2,
                'title'         => 'ISO 9001 PARA LA CONSTRUCCIÓN USANDO IA',
                'category'      => 'Calidad',
                'category_slug' => 'calidad',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/iso-9001-construccion-usando-ia.webp',
                'image_fallback'=> 'img/capacitaciones/iso-9001-construccion-usando-ia.png',
                'route'         => '/iso-9001',
                'description'   => 'Criterios prácticos de las cláusulas ISO 9001 asociadas a casos de aplicación en construcción, usos de IA e incluye el libro oficial del curso.'
            ],
            [
                'number'        => 3,
                'title'         => 'ENFOQUE PMI DE LA GESTIÓN DE LA CALIDAD',
                'category'      => 'Calidad',
                'category_slug' => 'calidad',
                'type'          => 'Curso',
                'image'         => 'img/capmi1.webp',
                'image_fallback'=> 'img/capmi1.png',
                'route'         => '/calidad-y-pmi',
                'description'   => 'Gestión y control de la calidad bajo los lineamientos y estándares del Project Management Institute (PMI).'
            ],
            [
                'number'        => 4,
                'title'         => 'CONTROL DE CALIDAD EN TUNELERÍA',
                'category'      => 'Calidad',
                'category_slug' => 'calidad',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/control-de-calidad-en-tuneleria.webp',
                'image_fallback'=> 'img/capacitaciones/control-de-calidad-en-tuneleria.png',
                'route'         => '/control-de-calidad-en-tuneleria',
                'description'   => 'Control de calidad en el diseño y proceso constructivo de túneles y cavernas: concreto lanzado, pernos de anclaje, soporte, revestimiento y maquinaria.'
            ],
            [
                'number'        => 5,
                'title'         => 'DIRECCIÓN DE LA CALIDAD CON EL ENFOQUE PMI® PARA LA CONSTRUCCIÓN',
                'category'      => 'Calidad',
                'category_slug' => 'calidad',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/direccion-calidad-enfoque-pmi.webp',
                'image_fallback'=> 'img/capacitaciones/direccion-calidad-enfoque-pmi.png',
                'route'         => '/direccion-calidad-enfoque-pmi',
                'brochure'      => 'brochures/calidad/direccion-calidad-enfoque-pmi.pdf',
                'description'   => 'Alineamiento de los estándares del PMBOK® (6ta y 7ma Edición) y la Guía de Grupos de Procesos con la ejecución, aseguramiento y control en obra.'
            ],
            [
                'number'        => 6,
                'title'         => 'TALLER DE HERRAMIENTAS DE GESTIÓN DE CALIDAD EN LA CONSTRUCCIÓN + USO DE INTELIGENCIA ARTIFICIAL',
                'category'      => 'Calidad',
                'category_slug' => 'calidad',
                'type'          => 'Taller',
                'image'         => 'img/capacitaciones/taller-herramientas-gestion-calidad.webp',
                'image_fallback'=> 'img/capacitaciones/taller-herramientas-gestion-calidad.png',
                'route'         => '/herramientas',
                'brochure'      => 'brochures/calidad/taller-herramientas-gestion-calidad.pdf',
                'description'   => 'Herramientas colaborativas de análisis y diagnóstico: Ishikawa, diagrama de afinidad, Pareto (se brindará una base de datos), control estadístico, indicadores Last Planner y uso de Inteligencia Artificial.'
            ],
            [
                'number'        => 7,
                'title'         => 'CASOS DE APLICACIÓN DEL DIAGRAMA DE ISHIKAWA',
                'category'      => 'Calidad',
                'category_slug' => 'calidad',
                'type'          => 'Seminario',
                'image'         => 'img/capacitaciones/seminario-diagrama-ishikawa.webp',
                'image_fallback'=> 'img/capacitaciones/seminario-diagrama-ishikawa.png',
                'route'         => '/seminario-diagrama-ishikawa',
                'description'   => 'Análisis de causa raíz, acción correctiva vs. corrección y resolución práctica de no conformidades mediante casos y talleres guiados.'
            ],
            [
                'number'        => 8,
                'title'         => 'SEMINARIO COMPLETION - Evita el Síndrome del 90%',
                'category'      => 'Calidad',
                'category_slug' => 'calidad',
                'type'          => 'Seminario',
                'image'         => 'img/capacitaciones/seminario-completion-sindrome-del-90.webp',
                'image_fallback'=> 'img/capacitaciones/seminario-completion-sindrome-del-90.png',
                'route'         => '/sindrome-del-90',
                'description'   => 'Estrategias de comisionamiento, punch list y cierre efectivo para evitar demoras en la entrega final de obras.'
            ],
            [
                'number'        => 9,
                'title'         => 'SEMINARIO ISO 9001:2026',
                'category'      => 'Calidad',
                'category_slug' => 'calidad',
                'type'          => 'Seminario',
                'image'         => 'img/capacitaciones/seminario-iso-9001-2026.webp',
                'image_fallback'=> 'img/capacitaciones/seminario-iso-9001-2026.png',
                'route'         => '/seminario-iso-9001-2026',
                'description'   => 'Actualización y tendencias sobre la evolución y futura revisión del estándar internacional ISO 9001.'
            ],
            [
                'number'        => 10,
                'title'         => 'SEMINARIO INDICADORES AVANZADOS DE LA CALIDAD',
                'category'      => 'Calidad',
                'category_slug' => 'calidad',
                'type'          => 'Seminario',
                'image'         => 'img/capacitaciones/indicadores-avanzados-calidad-construccion.webp',
                'image_fallback'=> 'img/capacitaciones/indicadores-avanzados-calidad-construccion.png',
                'route'         => '/indicadores-de-calidad',
                'description'   => 'Diseño e interpretación de KPIs, métricas de desempeño y tableros de control de calidad para directivos.'
            ],

            // ==========================================
            // OFICINA TÉCNICA (Números 11 al 14 - Total: 4)
            // ==========================================
            [
                'number'        => 11,
                'title'         => 'OFICINA TÉCNICA EN EDIFICACIONES + PANEL DE CONTROL 100% REAL TIME',
                'category'      => 'Oficina Técnica',
                'category_slug' => 'oficina-tecnica',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/oficina-tecnica-edificaciones-panel-control.webp',
                'image_fallback'=> 'img/capacitaciones/oficina-tecnica-edificaciones-panel-control.png',
                'route'         => '/oficina-tecnica-edificaciones-panel-control',
                'description'   => 'Gestión de oficina técnica en edificaciones de envergadura con panel de control 100% en tiempo real vía cloud con Looker Studio.'
            ],
            [
                'number'        => 12,
                'title'         => 'OFICINA TÉCNICA EN EDIFICACIONES Y HOSPITALES',
                'category'      => 'Oficina Técnica',
                'category_slug' => 'oficina-tecnica',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/oficina-tecnica-hospitales-edificaciones.webp',
                'image_fallback'=> 'img/capacitaciones/oficina-tecnica-hospitales-edificaciones.png',
                'route'         => '/oficina-tecnica-hospitales-edificaciones',
                'description'   => 'Gestión de la oficina técnica en proyectos de edificaciones y hospitales: aspectos diferenciadores, criterios técnicos y equipamiento.'
            ],
            [
                'number'        => 13,
                'title'         => 'OFICINA TÉCNICA EN OBRAS VIALES',
                'category'      => 'Oficina Técnica',
                'category_slug' => 'oficina-tecnica',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/oficina-tecnica-obras-viales.webp',
                'image_fallback'=> 'img/capacitaciones/oficina-tecnica-obras-viales.png',
                'route'         => '/oficina-tecnica-obras-viales',
                'description'   => 'Administración técnica, movimientos de tierras, pavimentos y valorizaciones en carreteras y puentes.'
            ],
            [
                'number'        => 14,
                'title'         => 'OFICINA TÉCNICA EN INFRAESTRUCTURA MINERA (PADs, PRESAS DE RELAVE, GEOSINTÉTICOS)',
                'category'      => 'Oficina Técnica',
                'category_slug' => 'oficina-tecnica',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/oficina-tecnica-infraestructura-minera.webp',
                'image_fallback'=> 'img/capacitaciones/oficina-tecnica-infraestructura-minera.png',
                'route'         => '/oficina-tecnica-infraestructura-minera',
                'description'   => 'Gestión y estrategias de oficina técnica en proyectos de movimiento de tierras para infraestructura minera: PADs de lixiviación, presas de relave y geosintéticos.'
            ],

            // ==========================================
            // CONTRATOS (Números 15 al 25 - Total: 11)
            // ==========================================
            [
                'number'        => 15,
                'title'         => 'CONTRATOS COLABORATIVOS NEC3-F',
                'category'      => 'Contratos',
                'category_slug' => 'contratos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/contratos-colaborativos-nec3-f.webp',
                'image_fallback'=> 'img/capacitaciones/contratos-colaborativos-nec3-f.png',
                'route'         => '/contratos-colaborativos-nec3-f',
                'description'   => 'Marco integral de gestión contractual bajo el contrato colaborativo NEC3-F: Project Delivery System, distribución de riesgos, cláusulas clave y Last Planner®.'
            ],
            [
                'number'        => 16,
                'title'         => 'EL CONTRATO DE NEC4',
                'category'      => 'Contratos',
                'category_slug' => 'contratos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/contrato-nec4.webp',
                'image_fallback'=> 'img/capacitaciones/contrato-nec4.png',
                'route'         => '/contrato-nec4',
                'description'   => 'Cláusulas principales, opciones principales de la A a la F, resolución de disputas con cláusulas W y DAB, y cláusulas secundarias del contrato estándar NEC4.'
            ],
            [
                'number'        => 17,
                'title'         => 'CASOS PRÁCTICOS DE CONTRATOS NEC3-F',
                'category'      => 'Contratos',
                'category_slug' => 'contratos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/casos-practicos-contratos-nec3-f.webp',
                'image_fallback'=> 'img/capacitaciones/casos-practicos-contratos-nec3-f.png',
                'route'         => '/casos-practicos-contratos-nec3-f',
                'description'   => 'Términos y definiciones bilingües, obligaciones de las partes, gestión de riesgos, alertas tempranas, eventos compensables y casuística real.'
            ],
            [
                'number'        => 18,
                'title'         => 'CLAVES PARA EL ÉXITO EN LA JUNTA DE RESOLUCIÓN DE DISPUTAS - JRD (DAB) DE OBRAS',
                'category'      => 'Contratos',
                'category_slug' => 'contratos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/junta-resolucion-disputas-dab.webp',
                'image_fallback'=> 'img/capacitaciones/junta-resolucion-disputas-dab.png',
                'route'         => '/junta-resolucion-disputas-dab',
                'description'   => 'Prevención, asistencia y resolución temprana de controversias con Dispute Adjudication Boards en contratos NEC, FIDIC y regulación ICC.'
            ],
            [
                'number'        => 19,
                'title'         => 'CONTRATO COLABORATIVO NEC 3/4',
                'category'      => 'Contratos',
                'category_slug' => 'contratos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/contrato-colaborativo-nec-3-4.webp',
                'image_fallback'=> 'img/capacitaciones/contrato-colaborativo-nec-3-4.png',
                'route'         => '/contrato-colaborativo-nec-3-4',
                'description'   => 'Bases de aplicación específica del Contrato NEC-3/4: cláusulas principales (10-90), Opción F, opciones secundarias y casuística de proyectos.'
            ],
            [
                'number'        => 20,
                'title'         => 'GESTIÓN DE EVENTOS COMPENSABLES Y ALERTAS TEMPRANAS EN CONTRATOS NEC4',
                'category'      => 'Contratos',
                'category_slug' => 'contratos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/eventos-compensables-alertas-tempranas-nec4.webp',
                'image_fallback'=> 'img/capacitaciones/eventos-compensables-alertas-tempranas-nec4.png',
                'route'         => '/eventos-compensables-alertas-tempranas-nec4',
                'description'   => 'Gestión de Eventos Compensables y Alertas Tempranas en NEC4: cláusulas, Defined Costs, tiempos de presentación, sustento y escalamiento.'
            ],
            [
                'number'        => 21,
                'title'         => 'CONTRATOS FIDIC PARA CONTRATOS EPC Y CONSTRUCCIÓN',
                'category'      => 'Contratos',
                'category_slug' => 'contratos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/contratos-fidic-epc-construccion.webp',
                'image_fallback'=> 'img/capacitaciones/contratos-fidic-epc-construccion.png',
                'route'         => '/contratos-fidic-epc-construccion',
                'description'   => 'Rainbow Suite (Libro Rojo, Amarillo y Plata 1999 y 2017) para contratos EPC y de construcción: riesgos, reclamos y adecuación al derecho peruano.'
            ],
            [
                'number'        => 22,
                'title'         => 'GESTIÓN DE RECLAMOS EN CONTRATOS DE CONSTRUCCIÓN Y CONTRATOS COLABORATIVOS NEC Y FIDIC',
                'category'      => 'Contratos',
                'category_slug' => 'contratos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/gestion-reclamos-nec-fidic.webp',
                'image_fallback'=> 'img/capacitaciones/gestion-reclamos-nec-fidic.png',
                'route'         => '/gestion-reclamos-nec-fidic',
                'description'   => 'Estructura y formulación de claims bajo NEC y FIDIC: reclamos de plazo, demoras concurrentes, aceleración, daños, disruption, mitigación y análisis de cronograma.'
            ],
            [
                'number'        => 23,
                'title'         => 'GESTIÓN CONTRACTUAL EN LOS MEGAPROYECTOS DE CONSTRUCCIÓN MINEROS',
                'category'      => 'Contratos',
                'category_slug' => 'contratos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/gestion-contractual-megaproyectos-mineros.webp',
                'image_fallback'=> 'img/capacitaciones/gestion-contractual-megaproyectos-mineros.png',
                'route'         => '/gestion-contractual-megaproyectos-mineros',
                'description'   => 'Formación y administración integral de contratos de construcción mineros, técnicas de negociación, mitigación de riesgos y resolución de disputas.'
            ],
            [
                'number'        => 24,
                'title'         => 'GESTIÓN DEL CAMBIO EN LOS CONTRATOS CON EL ESTADO',
                'category'      => 'Contratos',
                'category_slug' => 'contratos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/gestion-cambios-contratos-estado.webp',
                'image_fallback'=> 'img/capacitaciones/gestion-cambios-contratos-estado.png',
                'route'         => '/gestion-cambios-contratos-estado',
                'description'   => 'Marco principal de la gestión de contratos con el Estado, causales y lineamientos para gestionar cambios, ampliaciones, adicionales y solución de controversias.'
            ],
            [
                'number'        => 25,
                'title'         => 'SEMINARIO VALORIZACIÓN DE OBRA EN CONTRATOS NEC',
                'category'      => 'Contratos',
                'category_slug' => 'contratos',
                'type'          => 'Seminario',
                'image'         => 'img/nec1.webp',
                'image_fallback'=> 'img/nec1.png',
                'route'         => '/nec',
                'description'   => 'Cálculo del Price for Work Done to Date (PWDD), estimación de costos reales y auditoría de pagos en NEC.'
            ],

            // ==========================================
            // RIESGOS (Números 26 al 30 - Total: 5)
            // ==========================================
            [
                'number'        => 26,
                'title'         => 'GESTIÓN DE RIESGOS TÉCNICOS EN LA CONSTRUCCIÓN CON EL NUEVO ESTÁNDAR DEL PMI® 2024',
                'category'      => 'Riesgos',
                'category_slug' => 'riesgos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/gestion-de-riesgos-tecnicos-construccion.webp',
                'image_fallback'=> 'img/capacitaciones/gestion-de-riesgos-tecnicos-construccion.png',
                'route'         => '/riesgos-tecnicos',
                'description'   => 'Procesos de gestión de riesgos del nuevo estándar PMI® 2024, lecciones aprendidas en obra, Inteligencia Artificial y libro de autoría incluido.'
            ],
            [
                'number'        => 27,
                'title'         => 'GESTIÓN DE RIESGOS, CAMBIOS Y RECLAMOS EN LA CONSTRUCCIÓN',
                'category'      => 'Riesgos',
                'category_slug' => 'riesgos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/gestion-de-riesgos-cambios-y-reclamos.webp',
                'image_fallback'=> 'img/capacitaciones/gestion-de-riesgos-cambios-y-reclamos.png',
                'route'         => '/gestion-de-riesgos',
                'description'   => 'Criterios de gestión de cambios, riesgos de plazo y alcance, variaciones y administración de reclamos en proyectos de construcción.'
            ],
            [
                'number'        => 28,
                'title'         => 'RIESGOS EN LA CADENA DE PRODUCCIÓN DE LA CONSTRUCCIÓN ISO 31000 USANDO BIM',
                'category'      => 'Riesgos',
                'category_slug' => 'riesgos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/iso-31000-riesgos-cadena-produccion.webp',
                'image_fallback'=> 'img/capacitaciones/iso-31000-riesgos-cadena-produccion.png',
                'route'         => '/riesgos-cadena-produccion',
                'description'   => 'Evaluación y tratamiento del riesgo operacional en suministros, contratistas y logística de obra bajo ISO 31000 y metodología BIM.'
            ],
            [
                'number'        => 29,
                'title'         => 'GESTIÓN DE RIESGOS EN PROYECTOS CON EL ENFOQUE PMI®',
                'category'      => 'Riesgos',
                'category_slug' => 'riesgos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/gestion-de-riesgos-enfoque-pmi.webp',
                'image_fallback'=> 'img/capacitaciones/gestion-de-riesgos-enfoque-pmi.png',
                'route'         => '/riesgos-pmi',
                'description'   => 'Identificación cualitativa y cuantitativa, matrices de frecuencia e impacto, plan de respuesta y monitoreo según estándares PMI®.'
            ],
            [
                'number'        => 30,
                'title'         => 'ANÁLISIS CUANTITATIVO DE RIESGOS DEL COSTO Y CRONOGRAMA CON SIMULACIÓN DE MONTE CARLO',
                'category'      => 'Riesgos',
                'category_slug' => 'riesgos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/analisis-cuantitativo-riesgos-monte-carlo.webp',
                'image_fallback'=> 'img/capacitaciones/analisis-cuantitativo-riesgos-monte-carlo.png',
                'route'         => '/analisis-cuantitativo-riesgos',
                'description'   => 'Modelación probabilística, simulación de Monte Carlo, gráficos de tornado y cálculo justificado de reservas de contingencia de costo y plazo.'
            ],

            // ==========================================
            // GESTIÓN DE PROYECTOS (15 Cursos Oficiales con Brochure)
            // ==========================================
            [
                'number'        => 31,
                'title'         => 'GESTIÓN DE PROYECTOS CON EL ENFOQUE PMI',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/qcs_gp_31_gestion-proyectos-enfoque-pmi_reunion-control-wbs-kpis_v1.webp',
                'image_fallback'=> 'img/capacitaciones/qcs_gp_31_gestion-proyectos-enfoque-pmi_reunion-control-wbs-kpis_v1.png',
                'route'         => '/gestion-proyectos-pmi',
                'brochure'      => 'brochures/gestion-proyectos/brochure-gestion-proyectos-pmi.pdf',
                'description'   => 'Principios y dominios de desempeño del PMBOK® 7ma Edición y la Guía Práctica de Grupos de Procesos, con taller colaborativo de riesgos y panel en Google Looker Studio.'
            ],
            [
                'number'        => 32,
                'title'         => 'GESTIÓN DE LA PMO & VMO',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/qcs_gp_32_pmo-vmo_gobierno-portafolio-dashboard_v1.webp',
                'image_fallback'=> 'img/capacitaciones/qcs_gp_32_pmo-vmo_gobierno-portafolio-dashboard_v1.png',
                'route'         => '/gestion-pmo-vmo',
                'brochure'      => 'brochures/gestion-proyectos/brochure-gestion-pmo-vmo.pdf',
                'description'   => 'Implementación de la Oficina de Gestión de Proyectos (PMO) y la Value Management Office (VMO Ágil), gobernanza estratégica, templates oficiales y tableros en tiempo real.'
            ],
            [
                'number'        => 33,
                'title'         => 'BRIGHTLINE INITIATIVE (ENFOQUE ESTRATÉGICO DEL PMI)',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/qcs_gp_33_brightline-initiative_estrategia-a-ejecucion_v1.webp',
                'image_fallback'=> 'img/capacitaciones/qcs_gp_33_brightline-initiative_estrategia-a-ejecucion_v1.png',
                'route'         => '/brightline-initiative',
                'brochure'      => 'brochures/gestion-proyectos/brochure-brightline-initiative.pdf',
                'description'   => 'Cierre de la brecha entre el diseño estratégico corporativo y la entrega efectiva mediante los 10 principios de Brightline Initiative del PMI.'
            ],
            [
                'number'        => 34,
                'title'         => 'GRÚAS TORRE (PLANIFICACIÓN Y PRODUCTIVIDAD)',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/qcs_gp_34_gruas-torre_planificacion-productividad-izaje_v1.webp',
                'image_fallback'=> 'img/capacitaciones/qcs_gp_34_gruas-torre_planificacion-productividad-izaje_v1.png',
                'route'         => '/gruas-torre',
                'brochure'      => 'brochures/gestion-proyectos/brochure-gruas-torre.pdf',
                'description'   => 'Criterios para elevar la productividad en obra mediante el uso eficiente de grúas torre, estudio de tiempos y movimientos, montaje, desmontaje y seguridad.'
            ],
            [
                'number'        => 35,
                'title'         => 'LEAN CONSTRUCTION EN EDIFICACIONES',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/qcs_gp_35_lean-construction-edificaciones_last-planner-edificacion_v1.webp',
                'image_fallback'=> 'img/capacitaciones/qcs_gp_35_lean-construction-edificaciones_last-planner-edificacion_v1.png',
                'route'         => '/lean-construction-edificaciones',
                'brochure'      => 'brochures/gestion-proyectos/brochure-lean-construction-edificaciones.pdf',
                'description'   => 'Filosofía Lean y Last Planner® System aplicados a edificaciones: sectorización, líneas de balance, trenes de trabajo, Lookahead y análisis de restricciones.'
            ],
            [
                'number'        => 36,
                'title'         => 'LEAN CONSTRUCTION EN INFRAESTRUCTURA',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/qcs_gp_36_lean-construction-infraestructura_planificacion-colaborativa-vial_v1.webp',
                'image_fallback'=> 'img/capacitaciones/qcs_gp_36_lean-construction-infraestructura_planificacion-colaborativa-vial_v1.png',
                'route'         => '/lean-construction-infraestructura',
                'brochure'      => 'brochures/gestion-proyectos/brochure-lean-construction-infraestructura.pdf',
                'description'   => 'Sistema de producción Lean y Last Planner® en megaproyectos lineales, obras viales, presas, movimientos de tierra e infraestructura minera.'
            ],
            [
                'number'        => 37,
                'title'         => 'LIDERAZGO EN LA CONSTRUCCIÓN',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/qcs_gp_37_liderazgo-en-la-construccion_liderazgo-obra_v1.webp',
                'image_fallback'=> 'img/capacitaciones/qcs_gp_37_liderazgo-en-la-construccion_liderazgo-obra_v1.png',
                'route'         => '/liderazgo-construccion',
                'brochure'      => 'brochures/gestion-proyectos/brochure-liderazgo-construccion.pdf',
                'description'   => 'Liderazgo transformacional, directivo y ágil en obra: gestión del capital humano, comunicación asertiva, negociación y resolución efectiva de conflictos.'
            ],
            [
                'number'        => 38,
                'title'         => 'RESULTADO OPERATIVO DE OBRA',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/qcs_gp_38_resultado-operativo-de-obra_tablero-productividad-obra_v1.webp',
                'image_fallback'=> 'img/capacitaciones/qcs_gp_38_resultado-operativo-de-obra_tablero-productividad-obra_v1.png',
                'route'         => '/resultado-operativo-obra',
                'brochure'      => 'brochures/gestion-proyectos/brochure-resultado-operativo-obra.pdf',
                'description'   => 'Control económico y proyección del margen al cierre: presupuesto meta, análisis de desviaciones de venta/costo y uso de índices CPI, SPI y TCPI.'
            ],
            [
                'number'        => 39,
                'title'         => 'VALOR GANADO CON MS PROJECT Y POWER BI',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/qcs_gp_39_valor-ganado-ms-project-power-bi_dashboard-evm-control_v1.webp',
                'image_fallback'=> 'img/capacitaciones/qcs_gp_39_valor-ganado-ms-project-power-bi_dashboard-evm-control_v1.png',
                'route'         => '/valor-ganado-ms-project-power-bi',
                'brochure'      => 'brochures/gestion-proyectos/brochure-valor-ganado-ms-project-power-bi.pdf',
                'description'   => 'Evaluación y control del avance de obra aplicando el Método del Valor Ganado (EVM), curvas S y modelamiento de paneles ejecutivos en Power BI.'
            ],
            [
                'number'        => 40,
                'title'         => 'COSTOS EN EDIFICACIONES CON POWER BI',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/qcs_gp_40_costos-edificaciones-power-bi_analisis-costos-dashboard_v1.webp',
                'image_fallback'=> 'img/capacitaciones/qcs_gp_40_costos-edificaciones-power-bi_analisis-costos-dashboard_v1.png',
                'route'         => '/costos-edificaciones-power-bi',
                'brochure'      => 'brochures/gestion-proyectos/brochure-costos-edificaciones-power-bi.pdf',
                'description'   => 'Seguimiento y control de costos previstos, reales y proyectados en edificaciones, presupuesto meta y dashboards dinámicos en Power BI.'
            ],
            [
                'number'        => 41,
                'title'         => 'CONTROL DE PROYECTOS CON BIM Y POWER BI',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/qcs_gp_41_control-proyectos-bim-power-bi_bim-analitica-dashboard_v1.webp',
                'image_fallback'=> 'img/capacitaciones/qcs_gp_41_control-proyectos-bim-power-bi_bim-analitica-dashboard_v1.png',
                'route'         => '/control-proyectos-bim-power-bi',
                'brochure'      => 'brochures/gestion-proyectos/brochure-control-proyectos-bim-power-bi.pdf',
                'description'   => 'Planificación y toma de decisiones integrando modelos BIM con Power BI: sectorización, automatización con Dynamo y análisis visual en tiempo real.'
            ],
            [
                'number'        => 42,
                'title'         => 'VIRTUAL DESIGN & CONSTRUCTION (VDC)',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/qcs_gp_42_vdc_virtual-design-construction_bim-coordinacion-clash_v1.webp',
                'image_fallback'=> 'img/capacitaciones/qcs_gp_42_vdc_virtual-design-construction_bim-coordinacion-clash_v1.png',
                'route'         => '/vdc',
                'brochure'      => 'brochures/gestion-proyectos/brochure-vdc.pdf',
                'description'   => 'Marco metodológico Stanford VDC: articulación de Sesiones ICE, modelamiento BIM multidisciplinario y Project Production Management (PPM).'
            ],
            [
                'number'        => 43,
                'title'         => 'CONTROL DE PROYECTOS CON PRIMAVERA P6',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/qcs_gp_43_control-proyectos-primavera-p6_cronograma-primavera_v1.webp',
                'image_fallback'=> 'img/capacitaciones/qcs_gp_43_control-proyectos-primavera-p6_cronograma-primavera_v1.png',
                'route'         => '/control-proyectos-primavera-p6',
                'brochure'      => 'brochures/gestion-proyectos/brochure-control-proyectos-primavera-p6.pdf',
                'description'   => 'Planificación avanzada con Primavera P6 Enterprise: WBS, calendarios, ruta crítica CPM, asignación de recursos y paneles en Power BI.'
            ],
            [
                'number'        => 44,
                'title'         => 'ANÁLISIS FORENSE DEL CRONOGRAMA CON PRIMAVERA P6',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/qcs_gp_44_analisis-forense-cronograma-primavera-p6_forensic-schedule-analysis_v1.webp',
                'image_fallback'=> 'img/capacitaciones/qcs_gp_44_analisis-forense-cronograma-primavera-p6_forensic-schedule-analysis_v1.png',
                'route'         => '/analisis-forense-cronograma-primavera-p6',
                'brochure'      => 'brochures/gestion-proyectos/brochure-analisis-forense-cronograma-primavera-p6.pdf',
                'description'   => 'Cuantificación pericial de retrasos y análisis de responsabilidades aplicando las metodologías forenses MIP 29R-03 de AACE® en Primavera P6.'
            ],
            [
                'number'        => 45,
                'title'         => 'SEMINARIO PANEL DE CONTROL DE COSTOS CON POWER BI',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Seminario',
                'image'         => 'img/costo1.webp',
                'image_fallback'=> 'img/costo1.png',
                'route'         => null,
                'description'   => 'Diseño de dashboards ejecutivos para monitoreo en tiempo real de variaciones presupuestales e indicadores clave.'
            ],
            [
                'number'        => 46,
                'title'         => 'SEMINARIO FLUJO DE CAJA EN OBRAS',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Seminario',
                'image'         => 'img/costo1.webp',
                'image_fallback'=> 'img/costo1.png',
                'route'         => null,
                'description'   => 'Proyecciones de liquidez, curvas de egresos e ingresos, y mitigación del déficit financiero en proyectos.'
            ],
            [
                'number'        => 47,
                'title'         => 'SEMINARIO RESULTADO OPERATIVO DE OBRA',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Seminario',
                'image'         => 'img/costo1.webp',
                'image_fallback'=> 'img/costo1.png',
                'route'         => null,
                'description'   => 'Técnicas avanzadas para el diagnóstico mensual del RO y determinación anticipada de desviaciones de margen.'
            ],
            [
                'number'        => 48,
                'title'         => 'SEMINARIO AUTOMATIZACIÓN DE LAST PLANNER SYSTEM',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Seminario',
                'image'         => 'img/index_LeanLast.webp',
                'image_fallback'=> 'img/index_LeanLast.png',
                'route'         => null,
                'description'   => 'Digitalización del Lookahead, cálculo automático del PPC y gestión ágil de restricciones con herramientas digitales.'
            ],
            [
                'number'        => null,
                'title'         => 'CONTROL DE PROYECTOS DE CONSTRUCCIÓN',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/capacitaciones/qcs_gp_control-proyectos-construccion_dashboard-integral_v1.webp',
                'image_fallback'=> 'img/capacitaciones/qcs_gp_control-proyectos-construccion_dashboard-integral_v1.png',
                'route'         => '/control-proyectos-construccion',
                'brochure'      => 'brochures/gestion-proyectos/brochure-control-proyectos-construccion.pdf',
                'description'   => 'Gestión integral del avance físico, cronograma, costos directos e indirectos, productividad y métricas para el éxito de proyectos constructivos.'
            ],
        ];
    }

    /**
     * Obtiene los cursos filtrados por slug de categoría.
     */
    public static function getByCategory(string $categorySlug): array
    {
        $normalized = strtolower(trim($categorySlug));
        return array_values(array_filter(self::getAll(), function ($course) use ($normalized) {
            return strtolower($course['category_slug']) === $normalized;
        }));
    }

    /**
     * Definición de las 5 categorías oficiales y sus contenidos estructurados.
     */
    public static function getCategories(): array
    {
        return [
            'calidad' => [
                'name'              => 'Calidad',
                'slug'              => 'capacitacion-calidad',
                'category_slug'     => 'calidad',
                'hero_badge'        => 'CAPACITACIÓN ESPECIALIZADA PARA CONSTRUCCIÓN',
                'hero_title'        => 'GESTIÓN DE LA CALIDAD',
                'hero_subtitle'     => 'Fortalece tus conocimientos en gestión y control de la calidad aplicada al sector construcción, a través de cursos, talleres y seminarios especializados.',
                'hero_image'        => 'img/Hero-Quality-Consulting.webp',
                'features'          => [
                    [
                        'icon'        => 'fa-solid fa-graduation-cap',
                        'title'       => 'CURSOS ESPECIALIZADOS',
                        'description' => 'Amplía tus conocimientos en gestión y control de la calidad aplicados a proyectos de construcción.'
                    ],
                    [
                        'icon'        => 'fa-solid fa-file-lines',
                        'title'       => 'TALLERES Y SEMINARIOS',
                        'description' => 'Profundiza en normas, metodologías y herramientas para la gestión de la calidad.'
                    ],
                    [
                        'icon'        => 'fa-solid fa-display',
                        'title'       => 'CAPACITACIÓN ONLINE FLEXIBLE',
                        'description' => 'Aprende a tu ritmo con cursos grabados y participa en nuestras capacitaciones en vivo programadas.'
                    ],
                ],
                'intro_headline'    => 'CONOCIMIENTOS QUE GENERAN PROYECTOS DE MAYOR CALIDAD',
                'intro_text_1'      => 'La gestión de la calidad es fundamental para garantizar el cumplimiento de los requisitos técnicos, optimizar procesos y reducir errores y retrabajos en los proyectos de construcción.',
                'intro_text_2'      => 'Nuestros cursos, talleres y seminarios abordan temas como Gerencia de la Calidad, ISO 9001, gestión de la calidad con enfoque PMI, control de calidad en obra y herramientas de mejora continua, con contenidos orientados a su aplicación profesional.',
                'intro_badge'       => 'Capacitaciones orientadas a tu desarrollo profesional.',
                'intro_image'       => 'img/Index-GerenciaCalidadObras.webp',
                'intro_image_fallback' => 'img/Index-GerenciaCalidadObras.png',
                'contact_title'     => '¿LISTO PARA FORTALECER TUS COMPETENCIAS PROFESIONALES?',
                'contact_desc'      => 'Encuentra la capacitación que necesitas para seguir creciendo profesionalmente. Contáctanos y recibe información sobre nuestros cursos, talleres y seminarios en Gestión de la Calidad.',
                'contact_image'     => 'img/Index-GestionCalidad.webp',
                'contact_image_fallback' => 'img/Index-GestionCalidad.png',
                'contact_image_alt' => 'Gestión y Control de Calidad en Obras de Construcción',
                'wa_message'        => 'Hola, deseo solicitar información sobre las capacitaciones en Gestión de la Calidad.',
            ],

            'riesgos' => [
                'name'              => 'Riesgos',
                'slug'              => 'capacitacion-riesgos',
                'category_slug'     => 'riesgos',
                'hero_badge'        => 'PREVENCIÓN Y CONTROL ESTRATÉGICO EN OBRA',
                'hero_title'        => 'GESTIÓN DE RIESGOS',
                'hero_subtitle'     => 'Domina las metodologías para anticipar, evaluar y mitigar riesgos técnicos, contractuales y operacionales en proyectos de ingeniería y construcción.',
                'hero_image'        => 'img/Index-riesgos.webp',
                'features'          => [
                    [
                        'icon'        => 'fa-solid fa-shield-halved',
                        'title'       => 'METODOLOGÍAS PMI & ISO 31000',
                        'description' => 'Aplica marcos de gestión de riesgos reconocidos internacionalmente en el sector infraestructura.'
                    ],
                    [
                        'icon'        => 'fa-solid fa-chart-pie',
                        'title'       => 'ANÁLISIS CUANTITATIVO',
                        'description' => 'Simulaciones Monte Carlo, reservas de contingencia y análisis probabilístico del cronograma.'
                    ],
                    [
                        'icon'        => 'fa-solid fa-triangle-exclamation',
                        'title'       => 'ENFOQUE PREVENTIVO EN OBRA',
                        'description' => 'Minimiza sobrecostos y retrasos mediante matrices activas de riesgos y administración de cambios.'
                    ],
                ],
                'intro_headline'    => 'ANTICIPACIÓN EFECTIVA PARA PROTEGER TUS PROYECTOS',
                'intro_text_1'      => 'La incertidumbre geológica, técnica y de mercado exige profesionales capacitados en estructurar planes de respuesta oportunos que resguarden la rentabilidad y el cumplimiento del plazo contractual.',
                'intro_text_2'      => 'Nuestros programas en riesgos cubren desde la gestión de riesgos técnicos en obra con el libro de lecciones aprendidas, riesgos en la cadena de producción bajo ISO 31000, hasta análisis cuantitativo del costo y cronograma con simulación Monte Carlo y enfoque PMI.',
                'intro_badge'       => 'Gestión proactiva para reducir contingencias y sobrecostos.',
                'intro_image'       => 'img/Index-riesgos.webp',
                'intro_image_fallback' => 'img/Index-riesgos.png',
                'contact_title'     => '¿DESEAS BLINDAR TUS PROYECTOS ANTE LA INCERTIDUMBRE?',
                'contact_desc'      => 'Solicita temarios y asesoría académica sobre nuestros cursos y programas de Gestión de Riesgos en la Construcción.',
                'contact_image'     => 'img/Index-RiesgosPMI.webp',
                'contact_image_fallback' => 'img/Index-RiesgosPMI.png',
                'contact_image_alt' => 'Gestión de Riesgos en Infraestructura y Construcción',
                'wa_message'        => 'Hola, deseo solicitar información sobre las capacitaciones en Gestión de Riesgos.',
            ],

            'contratos' => [
                'name'              => 'Contratos',
                'slug'              => 'capacitacion-contratos',
                'category_slug'     => 'contratos',
                'hero_badge'        => 'ESTÁNDARES INTERNACIONALES Y OBRAS PÚBLICAS',
                'hero_title'        => 'CONTRATOS Y GESTIÓN CONTRACTUAL',
                'hero_subtitle'     => 'Especialízate en los modelos contractuales colaborativos NEC, contratos internacionales FIDIC y gestión del cambio en contrataciones con el Estado.',
                'hero_image'        => 'img/Index-Contratos-Internacionales.webp',
                'features'          => [
                    [
                        'icon'        => 'fa-solid fa-file-contract',
                        'title'       => 'CONTRATOS COLABORATIVOS NEC',
                        'description' => 'Domina los estándares NEC3 y NEC4, alertas tempranas, gestión de cambios y compensaciones.'
                    ],
                    [
                        'icon'        => 'fa-solid fa-globe',
                        'title'       => 'SUITE INTERNACIONAL FIDIC',
                        'description' => 'Cláusulas estándar, administración de reclamos y contratos para construcción y proyectos EPC.'
                    ],
                    [
                        'icon'        => 'fa-solid fa-scale-balanced',
                        'title'       => 'RESOLUCIÓN DE DISPUTAS',
                        'description' => 'Junta de Resolución de Disputas (DAB), sustento técnico de reclamos y controversias en obra.'
                    ],
                ],
                'intro_headline'    => 'ADMINISTRACIÓN CONTRACTUAL RIGUROSA Y COLABORATIVA',
                'intro_text_1'      => 'El éxito de una obra depende críticamente de una sólida gestión de contratos que evite paralizaciones, controle eventos compensables y alinee a clientes y contratistas hacia objetivos comunes.',
                'intro_text_2'      => 'Esta categoría reúne cursos especializados en Contratos Colaborativos NEC 3 y NEC 4, contratos FIDIC (Libro Rojo, Amarillo, Plata), juntas de resolución de disputas (DAB), valorizaciones y gestión del cambio en contratos con el Estado.',
                'intro_badge'       => 'Especialización clave para ingenieros y administradores contractuales.',
                'intro_image'       => 'img/Index-Contratos-Internacionales.webp',
                'intro_image_fallback' => 'img/Index-Contratos-Internacionales.png',
                'contact_title'     => '¿NECESITAS DOMINAR CONTRATOS NEC, FIDIC O CONTRATACIONES DEL ESTADO?',
                'contact_desc'      => 'Contáctanos para recibir temarios detallados y asesoría sobre nuestros programas en Gestión Contractual.',
                'contact_image'     => 'img/Index-Contratos-Internacionales.webp',
                'contact_image_fallback' => 'img/Index-Contratos-Internacionales.png',
                'contact_image_alt' => 'Contratos Colaborativos NEC y FIDIC en Construcción',
                'wa_message'        => 'Hola, deseo solicitar información sobre las capacitaciones en Contratos (NEC, FIDIC y Estado).',
            ],

            'gestion-de-proyectos' => [
                'name'              => 'Gestión de Proyectos',
                'slug'              => 'capacitacion-gestion-de-proyectos',
                'category_slug'     => 'gestion-de-proyectos',
                'hero_badge'        => 'DIRECCIÓN ESTRATÉGICA, PMO Y CONTROL DE OBRAS',
                'hero_title'        => 'GESTIÓN DE PROYECTOS',
                'hero_subtitle'     => 'Desarrolla competencias de alto impacto en dirección según el PMI, implementación de PMO/VMO, Lean Construction, Valor Ganado, Power BI y Primavera P6.',
                'hero_image'        => 'img/Index-GestionPMO.webp',
                'features'          => [
                    [
                        'icon'        => 'fa-solid fa-sitemap',
                        'title'       => 'ESTÁNDARES PMI & PMO',
                        'description' => 'Planificación integral de proyectos, gobernanza y oficinas de gestión PMO/VMO orientadas al valor.'
                    ],
                    [
                        'icon'        => 'fa-solid fa-chart-line',
                        'title'       => 'CONTROL CON POWER BI Y PRIMAVERA',
                        'description' => 'Valor Ganado (EVM), tableros de costos, flujo de caja y análisis forense del cronograma.'
                    ],
                    [
                        'icon'        => 'fa-solid fa-cubes',
                        'title'       => 'LEAN CONSTRUCTION & VDC',
                        'description' => 'Last Planner System, integración BIM 4D/5D, metodología VDC Stanford y grúas torre.'
                    ],
                ],
                'intro_headline'    => 'LIDERAZGO TÉCNICO Y CONTROL INTEGRAL DEL RENDIMIENTO',
                'intro_text_1'      => 'La complejidad actual de las obras de construcción e infraestructura demanda un control riguroso de indicadores, planificación Lean y dominio de plataformas digitales de gestión.',
                'intro_text_2'      => 'Nuestros 18 programas en Gestión de Proyectos abarcan desde la dirección con enfoque PMI y gobernanza PMO, hasta Lean Construction en edificaciones e infraestructura, control forense de cronogramas con Primavera P6, Valor Ganado, control de costos con Power BI y metodología VDC.',
                'intro_badge'       => 'Formación integral para directores, jefes de proyecto y residentes.',
                'intro_image'       => 'img/Index-GestionPMO.webp',
                'intro_image_fallback' => 'img/Index-GestionPMO.png',
                'contact_title'     => '¿LISTO PARA DIRIGIR PROYECTOS CON MÁXIMO CONTROL Y EFICIENCIA?',
                'contact_desc'      => 'Escríbenos para recibir temarios y coordinar capacitaciones individuales o corporativas in-house en Gestión de Proyectos.',
                'contact_image'     => 'img/Index-GobernanzaPMO.webp',
                'contact_image_fallback' => 'img/Index-GobernanzaPMO.png',
                'contact_image_alt' => 'Dirección de Proyectos y Gobernanza PMO',
                'wa_message'        => 'Hola, deseo solicitar información sobre las capacitaciones en Gestión de Proyectos y PMO.',
            ],

            'oficina-tecnica' => [
                'name'              => 'Oficina Técnica',
                'slug'              => 'capacitacion-oficina-tecnica',
                'category_slug'     => 'oficina-tecnica',
                'hero_badge'        => 'GESTIÓN OPERATIVA EN SECTORES CLAVE',
                'hero_title'        => 'OFICINA TÉCNICA',
                'hero_subtitle'     => 'Capacitación práctica en administración técnica de obra, metrados, valorizaciones, RFI, submittals y control documentario aplicada a edificaciones, hospitales, obras viales y minería.',
                'hero_image'        => 'img/Index-OficinaTecnicaObras.webp',
                'features'          => [
                    [
                        'icon'        => 'fa-solid fa-building-user',
                        'title'       => 'APLICACIÓN SECTORIAL ESPECÍFICA',
                        'description' => 'Programas diferenciados para edificaciones, hospitales, carreteras y obras mineras.'
                    ],
                    [
                        'icon'        => 'fa-solid fa-clipboard-check',
                        'title'       => 'CONTROL DOCUMENTARIO Y RFI',
                        'description' => 'Gestión metódica de requerimientos de información, planos de obra y submittals de contratistas.'
                    ],
                    [
                        'icon'        => 'fa-solid fa-calculator',
                        'title'       => 'METRADOS Y VALORIZACIONES',
                        'description' => 'Sustento técnico preciso para la liquidación mensual y control de avances físicos en campo.'
                    ],
                ],
                'intro_headline'    => 'EL MOTOR TÉCNICO Y DOCUMENTARIO DE LA OBRA',
                'intro_text_1'      => 'La Oficina Técnica constituye el enlace vital entre la ingeniería del diseño y la ejecución en campo, garantizando que los planos, metrados y valorizaciones reflejen con exactitud la realidad constructiva.',
                'intro_text_2'      => 'Nuestras capacitaciones en Oficina Técnica brindan herramientas prácticas para desenvolverse con éxito en los cuatro grandes frentes de la industria: edificaciones, infraestructura hospitalaria, obras viales y operaciones mineras.',
                'intro_badge'       => 'Competencias operativas directas para ingenieros de campo y oficina.',
                'intro_image'       => 'img/Index-OficinaTecnicaObras.webp',
                'intro_image_fallback' => 'img/Index-OficinaTecnicaObras.png',
                'contact_title'     => '¿DESEAS ESPECIALIZARTE EN OFICINA TÉCNICA DE OBRAS?',
                'contact_desc'      => 'Consulta sobre nuestras capacitaciones especializadas en Oficina Técnica para edificaciones, hospitales, vialidad o minería.',
                'contact_image'     => 'img/Index-OficinaTecnicaObras.webp',
                'contact_image_fallback' => 'img/Index-OficinaTecnicaObras.png',
                'contact_image_alt' => 'Oficina Técnica y Control de Obras de Ingeniería',
                'wa_message'        => 'Hola, deseo solicitar información sobre las capacitaciones en Oficina Técnica.',
            ],
        ];
    }

    /**
     * Obtiene los metadatos y cursos de una categoría por su slug.
     */
    public static function getCategoryData(string $categorySlug): ?array
    {
        $categories = self::getCategories();
        $normalized = strtolower(trim(str_replace('capacitacion-', '', $categorySlug)));
        
        if (!isset($categories[$normalized])) {
            return null;
        }

        $data = $categories[$normalized];
        $data['courses'] = self::getByCategory($normalized);
        return $data;
    }

    /**
     * Resumen dinámico de categorías oficiales con conteo exacto de capacitaciones.
     */
    public static function getCategoriesSummary(): array
    {
        $all = self::getAll();
        $counts = [];
        foreach ($all as $c) {
            $slug = strtolower(trim((string)($c['category_slug'] ?? '')));
            if ($slug !== '') {
                $counts[$slug] = ($counts[$slug] ?? 0) + 1;
            }
        }

        $categories = self::getCategories();
        $order = ['calidad', 'gestion-de-proyectos', 'contratos', 'riesgos', 'oficina-tecnica'];

        $result = [];
        foreach ($order as $slug) {
            if (isset($categories[$slug])) {
                $result[$slug] = [
                    'name'  => $categories[$slug]['name'],
                    'slug'  => $slug,
                    'count' => $counts[$slug] ?? 0,
                ];
            }
        }

        return $result;
    }

    /**
     * Resumen dinámico de tipos de capacitación con conteo exacto.
     */
    public static function getTypesSummary(): array
    {
        $all = self::getAll();
        $order = [
            'curso'     => 'Cursos',
            'seminario' => 'Seminarios',
            'taller'    => 'Talleres',
        ];

        $counts = [];
        foreach ($all as $c) {
            $type = strtolower(trim((string)($c['type'] ?? 'curso')));
            $counts[$type] = ($counts[$type] ?? 0) + 1;
        }

        $result = [];
        foreach ($order as $slug => $label) {
            $result[$slug] = [
                'name'  => $label,
                'slug'  => $slug,
                'count' => $counts[$slug] ?? 0,
            ];
        }

        return $result;
    }
}

