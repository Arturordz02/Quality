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
 * - Gestión de Proyectos (31–48)
 * Total: 48 Registros Oficiales
 */

declare(strict_types=1);

namespace App\Services;

class CoursesCatalog
{
    /**
     * Lista oficial de las 48 capacitaciones según registro institucional.
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
                'brochure'      => 'brochures/calidad/gerencia-de-la-calidad-en-la-construccion.pdf',
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
                'brochure'      => 'brochures/calidad/iso-9001-para-la-construccion-usando-ia.pdf',
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
                'brochure'      => 'brochures/calidad/control-de-calidad-en-tuneleria.pdf',
                'description'   => 'Control de calidad en el diseño y proceso constructivo de túneles y cavernas: concreto lanzado, pernos de anclaje, soporte, revestimiento y maquinaria.'
            ],
            [
                'number'        => 5,
                'title'         => 'DIRECCIÓN DE LA CALIDAD CON EL ENFOQUE PMI',
                'category'      => 'Calidad',
                'category_slug' => 'calidad',
                'type'          => 'Curso',
                'image'         => 'img/capmi1.webp',
                'image_fallback'=> 'img/capmi1.png',
                'route'         => '/calidad-y-pmi',
                'description'   => 'Liderazgo estratégico y aseguramiento de la calidad en proyectos de infraestructura según la Guía del PMBOK®.'
            ],
            [
                'number'        => 6,
                'title'         => 'TALLER HERRAMIENTAS DE GESTIÓN DE LA CALIDAD',
                'category'      => 'Calidad',
                'category_slug' => 'calidad',
                'type'          => 'Taller',
                'image'         => 'img/capacitaciones/taller-herramientas-gestion-calidad.webp',
                'image_fallback'=> 'img/capacitaciones/taller-herramientas-gestion-calidad.png',
                'route'         => '/herramientas',
                'brochure'      => 'brochures/calidad/taller-herramientas-gestion-calidad.pdf',
                'description'   => 'Herramientas colaborativas de análisis y diagnóstico en obra: Ishikawa, Pareto con base de datos, afinidad, control estadístico, indicadores Last Planner® y uso de Inteligencia Artificial.'
            ],
            [
                'number'        => 7,
                'title'         => 'SEMINARIO DIAGRAMA DE ISHIKAWA',
                'category'      => 'Calidad',
                'category_slug' => 'calidad',
                'type'          => 'Seminario',
                'image'         => 'img/GERCA1.webp',
                'image_fallback'=> 'img/GERCA1.png',
                'route'         => null,
                'description'   => 'Análisis de causa raíz y resolución metódica de no conformidades mediante el diagrama causa-efecto.'
            ],
            [
                'number'        => 8,
                'title'         => 'SEMINARIO COMPLETION - Evita el Síndrome del 90%',
                'category'      => 'Calidad',
                'category_slug' => 'calidad',
                'type'          => 'Seminario',
                'image'         => 'img/s901.webp',
                'image_fallback'=> 'img/s901.png',
                'route'         => '/sindrome-del-90',
                'description'   => 'Estrategias de comisionamiento, punch list y cierre efectivo para evitar demoras en la entrega final de obras.'
            ],
            [
                'number'        => 9,
                'title'         => 'SEMINARIO ISO 9001:2026',
                'category'      => 'Calidad',
                'category_slug' => 'calidad',
                'type'          => 'Seminario',
                'image'         => 'img/ISO1.webp',
                'image_fallback'=> 'img/ISO1.png',
                'route'         => '/iso-9001',
                'description'   => 'Actualización y tendencias sobre la evolución y futura revisión del estándar internacional ISO 9001.'
            ],
            [
                'number'        => 10,
                'title'         => 'SEMINARIO INDICADORES AVANZADOS DE LA CALIDAD',
                'category'      => 'Calidad',
                'category_slug' => 'calidad',
                'type'          => 'Seminario',
                'image'         => 'img/gesCa1.webp',
                'image_fallback'=> 'img/gesCa1.png',
                'route'         => null,
                'description'   => 'Diseño e interpretación de KPIs, métricas de desempeño y tableros de control de calidad para directivos.'
            ],

            // ==========================================
            // OFICINA TÉCNICA (Números 11 al 14 - Total: 4)
            // ==========================================
            [
                'number'        => 11,
                'title'         => 'OFICINA TÉCNICA EN EDIFICACIONES',
                'category'      => 'Oficina Técnica',
                'category_slug' => 'oficina-tecnica',
                'type'          => 'Curso',
                'image'         => 'img/Index-OficinaTecnicaObras.webp',
                'image_fallback'=> 'img/Index-OficinaTecnicaObras.png',
                'route'         => '/oficina-tecnica',
                'description'   => 'Gestión integral de oficina técnica en edificios residenciales y comerciales: metrados, RFI y submittals.'
            ],
            [
                'number'        => 12,
                'title'         => 'OFICINA TÉCNICA EN HOSPITALES',
                'category'      => 'Oficina Técnica',
                'category_slug' => 'oficina-tecnica',
                'type'          => 'Curso',
                'image'         => 'img/Index-OficinaTecnicaObras.webp',
                'image_fallback'=> 'img/Index-OficinaTecnicaObras.png',
                'route'         => '/oficina-tecnica',
                'description'   => 'Control técnico, instalaciones especiales y especificaciones biomédicas en infraestructura hospitalaria.'
            ],
            [
                'number'        => 13,
                'title'         => 'OFICINA TÉCNICA EN OBRAS VIALES',
                'category'      => 'Oficina Técnica',
                'category_slug' => 'oficina-tecnica',
                'type'          => 'Curso',
                'image'         => 'img/Index-OficinaTecnicaObras.webp',
                'image_fallback'=> 'img/Index-OficinaTecnicaObras.png',
                'route'         => '/oficina-tecnica',
                'description'   => 'Administración técnica, movimientos de tierras, pavimentos y valorizaciones en carreteras y puentes.'
            ],
            [
                'number'        => 14,
                'title'         => 'OFICINA TÉCNICA EN OBRAS MINERAS',
                'category'      => 'Oficina Técnica',
                'category_slug' => 'oficina-tecnica',
                'type'          => 'Curso',
                'image'         => 'img/Index-OficinaTecnicaObras.webp',
                'image_fallback'=> 'img/Index-OficinaTecnicaObras.png',
                'route'         => '/oficina-tecnica',
                'description'   => 'Gestión contractual, control de avance y estándares de alta exigencia en proyectos mineros y plantas.'
            ],

            // ==========================================
            // CONTRATOS (Números 15 al 25 - Total: 11)
            // ==========================================
            [
                'number'        => 15,
                'title'         => 'CONTRATOS COLABORATIVOS NEC 3F',
                'category'      => 'Contratos',
                'category_slug' => 'contratos',
                'type'          => 'Curso',
                'image'         => 'img/nec1.webp',
                'image_fallback'=> 'img/nec1.png',
                'route'         => '/nec',
                'description'   => 'Estructura y cláusulas clave del contrato NEC3 Opción F para gerenciamiento de proyectos complejos.'
            ],
            [
                'number'        => 16,
                'title'         => 'CONTRATOS COLABORATIVOS NEC 4',
                'category'      => 'Contratos',
                'category_slug' => 'contratos',
                'type'          => 'Curso',
                'image'         => 'img/nec1.webp',
                'image_fallback'=> 'img/nec1.png',
                'route'         => '/nec',
                'description'   => 'Novedades y mecanismos de colaboración del estándar NEC4: alertas tempranas y compensación.'
            ],
            [
                'number'        => 17,
                'title'         => 'CASOS DE APLICACIÓN EN CONTRATOS NEC4',
                'category'      => 'Contratos',
                'category_slug' => 'contratos',
                'type'          => 'Curso',
                'image'         => 'img/nec1.webp',
                'image_fallback'=> 'img/nec1.png',
                'route'         => '/nec',
                'description'   => 'Casuística real, resolución de disputas y administración de cambios en contratos internacionales NEC4.'
            ],
            [
                'number'        => 18,
                'title'         => 'JUNTA DE RESOLUCIÓN DE DISPUTAS (DAB) EN OBRAS',
                'category'      => 'Contratos',
                'category_slug' => 'contratos',
                'type'          => 'Curso',
                'image'         => 'img/Index-Contratos-Internacionales.webp',
                'image_fallback'=> 'img/Index-Contratos-Internacionales.png',
                'route'         => '/contratos',
                'description'   => 'Mecanismos de prevención y solución temprana de controversias con Dispute Adjudication Boards en infraestructura.'
            ],
            [
                'number'        => 19,
                'title'         => 'CONTRATOS COLABORATIVOS NEC 3 Y 4',
                'category'      => 'Contratos',
                'category_slug' => 'contratos',
                'type'          => 'Curso',
                'image'         => 'img/nec1.webp',
                'image_fallback'=> 'img/nec1.png',
                'route'         => '/nec',
                'description'   => 'Comparativa estratégica, lecciones aprendidas y mejores prácticas entre las versiones NEC3 y NEC4.'
            ],
            [
                'number'        => 20,
                'title'         => 'GESTIÓN DE EVENTOS COMPENSABLES Y ALERTAS NEC4',
                'category'      => 'Contratos',
                'category_slug' => 'contratos',
                'type'          => 'Curso',
                'image'         => 'img/nec1.webp',
                'image_fallback'=> 'img/nec1.png',
                'route'         => '/nec',
                'description'   => 'Procedimiento formal, plazos perentorios y cuantificación de eventos compensables y notificaciones de alerta.'
            ],
            [
                'number'        => 21,
                'title'         => 'CONTRATOS FIDIC PARA EPC Y CONSTRUCCIÓN',
                'category'      => 'Contratos',
                'category_slug' => 'contratos',
                'type'          => 'Curso',
                'image'         => 'img/Index-Contratos-Internacionales.webp',
                'image_fallback'=> 'img/Index-Contratos-Internacionales.png',
                'route'         => '/fidic',
                'description'   => 'Administración de contratos FIDIC Libro Rojo, Amarillo y Plata (EPC/Turnkey) en grandes proyectos.'
            ],
            [
                'number'        => 22,
                'title'         => 'GESTIÓN DE RECLAMOS EN CONTRATOS FIDIC Y NEC',
                'category'      => 'Contratos',
                'category_slug' => 'contratos',
                'type'          => 'Curso',
                'image'         => 'img/Index-Contratos-Internacionales.webp',
                'image_fallback'=> 'img/Index-Contratos-Internacionales.png',
                'route'         => '/contratos',
                'description'   => 'Formulación, sustento técnico-económico y defensa de claims contractuales bajo estándares FIDIC y NEC.'
            ],
            [
                'number'        => 23,
                'title'         => 'CONTRATOS EN MEGAPROYECTOS DE CONSTRUCCIÓN',
                'category'      => 'Contratos',
                'category_slug' => 'contratos',
                'type'          => 'Curso',
                'image'         => 'img/Index-Contratos-Internacionales.webp',
                'image_fallback'=> 'img/Index-Contratos-Internacionales.png',
                'route'         => '/contratos',
                'description'   => 'Gobernanza contractual, asignación de riesgos y marcos legales aplicados a megaproyectos de infraestructura.'
            ],
            [
                'number'        => 24,
                'title'         => 'GESTIÓN DEL CAMBIO EN CONTRATOS CON EL ESTADO',
                'category'      => 'Contratos',
                'category_slug' => 'contratos',
                'type'          => 'Curso',
                'image'         => 'img/Index-Contratos-Internacionales.webp',
                'image_fallback'=> 'img/Index-Contratos-Internacionales.png',
                'route'         => '/contratos-estado',
                'description'   => 'Sustentación de adicionales de obra, deductivos y ampliaciones de plazo bajo la Ley de Contrataciones del Estado.'
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
                'title'         => 'GESTIÓN DE LOS RIESGOS TÉCNICOS + LIBRO',
                'category'      => 'Riesgos',
                'category_slug' => 'riesgos',
                'type'          => 'Curso',
                'image'         => 'img/Index-riesgos.webp',
                'image_fallback'=> 'img/Index-riesgos.png',
                'route'         => '/riesgos-tecnicos',
                'description'   => 'Metodología integral para identificar, mitigar y controlar riesgos geotécnicos, estructurales y constructivos.'
            ],
            [
                'number'        => 27,
                'title'         => 'GESTIÓN DE RIESGOS, CAMBIOS Y RECLAMOS',
                'category'      => 'Riesgos',
                'category_slug' => 'riesgos',
                'type'          => 'Curso',
                'image'         => 'img/Index-riesgos.webp',
                'image_fallback'=> 'img/Index-riesgos.png',
                'route'         => '/gestion-de-riesgos',
                'description'   => 'Interconexión entre la gestión preventiva de riesgos y la administración eficiente de cambios y controversias.'
            ],
            [
                'number'        => 28,
                'title'         => 'ISO 31000 RIESGOS EN LA CADENA DE PRODUCCIÓN',
                'category'      => 'Riesgos',
                'category_slug' => 'riesgos',
                'type'          => 'Curso',
                'image'         => 'img/caprodu1.webp',
                'image_fallback'=> 'img/caprodu1.png',
                'route'         => '/riesgos-cadena-produccion',
                'description'   => 'Evaluación y tratamiento del riesgo operacional en suministros, contratistas y logística de obra bajo ISO 31000.'
            ],
            [
                'number'        => 29,
                'title'         => 'GESTIÓN DE RIESGOS CON EL ENFOQUE PMI',
                'category'      => 'Riesgos',
                'category_slug' => 'riesgos',
                'type'          => 'Curso',
                'image'         => 'img/Index-RiesgosPMI.webp',
                'image_fallback'=> 'img/Index-RiesgosPMI.png',
                'route'         => '/riesgos-pmi',
                'description'   => 'Procesos de identificación cualitativa, cuantitativa y respuesta al riesgo según los estándares del PMI.'
            ],
            [
                'number'        => 30,
                'title'         => 'ANÁLISIS CUANTITATIVO DE RIESGOS DEL COSTO Y CRONOGRAMA CON SIMULACIÓN DE MONTE CARLO',
                'category'      => 'Riesgos',
                'category_slug' => 'riesgos',
                'type'          => 'Curso',
                'image'         => 'img/Index-RiesgosPMI.webp',
                'image_fallback'=> 'img/Index-RiesgosPMI.png',
                'route'         => '/riesgos-pmi',
                'description'   => 'Modelación probabilística, reservas de contingencia y análisis Monte Carlo en cronogramas y presupuestos.'
            ],

            // ==========================================
            // GESTIÓN DE PROYECTOS (Números 31 al 48 - Total: 18)
            // ==========================================
            [
                'number'        => 31,
                'title'         => 'GESTIÓN DE PROYECTOS CON EL ENFOQUE PMI',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/10-pmi_orig.webp',
                'image_fallback'=> 'img/10-pmi_orig.jpg',
                'route'         => '/proyectos-pmi',
                'description'   => 'Dirección integral de proyectos según el PMBOK: integración, alcance, cronograma, costos y calidad.'
            ],
            [
                'number'        => 32,
                'title'         => 'GESTIÓN DE LA PMO & VMO',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/Index-GestionPMO.webp',
                'image_fallback'=> 'img/Index-GestionPMO.png',
                'route'         => '/pmo',
                'description'   => 'Implementación y operación de la Oficina de Gestión de Proyectos (PMO) y Value Management Office (VMO).'
            ],
            [
                'number'        => 33,
                'title'         => 'BLIGHTLINE INITIATIVE (ENFOQUE ESTRATÉGICO DEL PMI)',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/gesPMO1.webp',
                'image_fallback'=> 'img/gesPMO1.png',
                'route'         => null,
                'description'   => 'Cierre de la brecha entre la estrategia corporativa y la ejecución efectiva de proyectos según PMI Brightline.'
            ],
            [
                'number'        => 34,
                'title'         => 'GRÚAS TORRE (PLANIFICACIÓN Y PRODUCTIVIDAD)',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/Index-OficinaTecnicaObras.webp',
                'image_fallback'=> 'img/Index-OficinaTecnicaObras.png',
                'route'         => '/gruas-torre',
                'description'   => 'Planificación de izajes, logística vertical, selección de equipos y seguridad operacional en edificios altos.'
            ],
            [
                'number'        => 35,
                'title'         => 'LEAN CONSTRUCTION EN EDIFICACIONES',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/index_LeanLast.webp',
                'image_fallback'=> 'img/index_LeanLast.png',
                'route'         => '/lean-last-planner',
                'description'   => 'Filosofía Lean, reducción de pérdidas y optimización de flujos de trabajo en obras de edificación urbana.'
            ],
            [
                'number'        => 36,
                'title'         => 'LEAN CONSTRUCTION EN INFRAESTRUCTURA',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/index_LeanLast.webp',
                'image_fallback'=> 'img/index_LeanLast.png',
                'route'         => '/lean-last-planner',
                'description'   => 'Aplicación del sistema Lean a obras viales, saneamiento, puentes y grandes movimientos de tierras.'
            ],
            [
                'number'        => 37,
                'title'         => 'LIDERAZGO EN LA CONSTRUCCIÓN',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/Omar_Samaniego.webp',
                'image_fallback'=> 'img/Omar_Samaniego.png',
                'route'         => null,
                'description'   => 'Desarrollo de habilidades blandas, negociación, gestión de equipos multidisciplinarios y toma de decisiones.'
            ],
            [
                'number'        => 38,
                'title'         => 'RESULTADO OPERATIVO DE OBRA',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/costo1.webp',
                'image_fallback'=> 'img/costo1.png',
                'route'         => '/costos',
                'description'   => 'Control económico, proyección de márgenes, balance de materiales y análisis del RO en proyectos de construcción.'
            ],
            [
                'number'        => 39,
                'title'         => 'VALOR GANADO CON MS PROJECT Y POWER BI',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/Index_ValorGanado.webp',
                'image_fallback'=> 'img/Index_ValorGanado.png',
                'route'         => '/valor-ganado',
                'description'   => 'Cálculo de SPI, CPI, curvas S y tableros interactivos de control en Power BI combinados con MS Project.'
            ],
            [
                'number'        => 40,
                'title'         => 'COSTOS EN EDIFICACIONES CON POWER BI',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/costo1.webp',
                'image_fallback'=> 'img/costo1.png',
                'route'         => '/costos',
                'description'   => 'Estructuración de presupuestos, seguimiento de gastos reales y visualización dinámica del costo de obra.'
            ],
            [
                'number'        => 41,
                'title'         => 'CONTROL DE PROYECTOS CON BIM Y POWER BI',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/Index-BIMRevitArchitecture.webp',
                'image_fallback'=> 'img/Index-BIMRevitArchitecture.png',
                'route'         => '/bim-revit-architecture',
                'description'   => 'Integración 4D y 5D: sincronización de modelos BIM paramétricos con tableros ejecutivos de control en Power BI.'
            ],
            [
                'number'        => 42,
                'title'         => 'VIRTUAL DESIGN & CONSTRUCTION VDC',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/Index-BIMRevitArchitecture.webp',
                'image_fallback'=> 'img/Index-BIMRevitArchitecture.png',
                'route'         => '/bim-revit-architecture',
                'description'   => 'Metodología Stanford CIFE: integración de BIM, sesiones ICE y gestión por procesos (PPM) en construcción.'
            ],
            [
                'number'        => 43,
                'title'         => 'CONTROL DE PROYECTOS CON PRIMAVERA P6',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/crono1.webp',
                'image_fallback'=> 'img/crono1.png',
                'route'         => null,
                'description'   => 'Programación avanzada con Primavera P6: línea base, camino crítico (CPM), asignación de recursos y seguimiento.'
            ],
            [
                'number'        => 44,
                'title'         => 'ANÁLISIS FORENSE DEL CRONOGRAMA CON PRIMAVERA P6',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Curso',
                'image'         => 'img/crono2.webp',
                'image_fallback'=> 'img/crono2.png',
                'route'         => '/cronograma-forense',
                'description'   => 'Metodologías de análisis de demoras (As-Built vs As-Planned, Time Impact Analysis) y peritajes técnicos.'
            ],
            [
                'number'        => 45,
                'title'         => 'SEMINARIO PANEL DE CONTROL DE COSTOS CON POWER BI',
                'category'      => 'Gestión de Proyectos',
                'category_slug' => 'gestion-de-proyectos',
                'type'          => 'Seminario',
                'image'         => 'img/costo1.webp',
                'image_fallback'=> 'img/costo1.png',
                'route'         => '/costos',
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
                'route'         => '/costos',
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
                'route'         => '/costos',
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
                'route'         => '/lean-last-planner',
                'description'   => 'Digitalización del Lookahead, cálculo automático del PPC y gestión ágil de restricciones con herramientas digitales.'
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
}

