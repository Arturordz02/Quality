<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Controlador de Capacitación y Programas de Especialización (app/Controllers/TrainingController.php)
 *
 * Responsabilidad:
 * - Gestionar la presentación del hub de capacitación y los programas de especialización técnica.
 * - Inyectar metadatos SEO dinámicos y despachar vistas modulares reutilizando el layout maestro.
 */

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class TrainingController extends Controller
{
    /**
     * Hub principal de capacitación ejecutiva y catálogo de programas de especialización.
     */
    public function capacitacion(): void
    {
        $data = [
            'title'           => 'Capacitación Ejecutiva y Catálogo Oficial de Cursos | Quality Consulting Solutions',
            'metaDescription' => 'Catálogo completo de las 49 capacitaciones oficiales en Calidad, Riesgos, Contratos, Gestión de Proyectos y Oficina Técnica. Cursos grabados con acceso flexible y certificación.',
            'canonical'       => 'https://quality-consulting.org/capacitacion',
            'activePage'      => 'capacitacion',
            'courses'         => \App\Services\CoursesCatalog::getAll(),
        ];

        $this->render('pages/capacitacion', $data, 'main');
    }

    /**
     * Categoría: Gestión de la Calidad.
     */
    public function capacitacionCalidad(): void
    {
        $data = [
            'title'           => 'Capacitación en Gestión de la Calidad | Quality Consulting Solutions',
            'metaDescription' => 'Cursos, talleres y seminarios especializados en Gestión de la Calidad, ISO 9001, enfoque PMI y control de calidad en obra.',
            'canonical'       => 'https://quality-consulting.org/capacitacion-calidad',
            'activePage'      => 'capacitacion',
            'category'        => \App\Services\CoursesCatalog::getCategoryData('calidad'),
        ];

        $this->render('pages/capacitacion-calidad', $data, 'main');
    }

    /**
     * Categoría: Gestión de Riesgos.
     */
    public function capacitacionRiesgos(): void
    {
        $data = [
            'title'           => 'Capacitación en Gestión de Riesgos | Quality Consulting Solutions',
            'metaDescription' => 'Cursos especializados en gestión de riesgos técnicos en construcción, cadena de producción ISO 31000, simulación Monte Carlo y enfoque PMI.',
            'canonical'       => 'https://quality-consulting.org/capacitacion-riesgos',
            'activePage'      => 'capacitacion',
            'category'        => \App\Services\CoursesCatalog::getCategoryData('riesgos'),
        ];

        $this->render('pages/capacitacion-riesgos', $data, 'main');
    }

    /**
     * Categoría: Contratos y Gestión Contractual.
     */
    public function capacitacionContratos(): void
    {
        $data = [
            'title'           => 'Capacitación en Contratos NEC, FIDIC y Estado | Quality Consulting Solutions',
            'metaDescription' => 'Especialización en contratos colaborativos NEC 3 y 4, FIDIC, juntas de disputas (DAB) y contrataciones con el Estado.',
            'canonical'       => 'https://quality-consulting.org/capacitacion-contratos',
            'activePage'      => 'capacitacion',
            'category'        => \App\Services\CoursesCatalog::getCategoryData('contratos'),
        ];

        $this->render('pages/capacitacion-contratos', $data, 'main');
    }

    /**
     * Categoría: Gestión de Proyectos.
     */
    public function capacitacionGestionProyectos(): void
    {
        $data = [
            'title'           => 'Capacitación en Gestión de Proyectos, PMO y Control de Obras | Quality Consulting Solutions',
            'metaDescription' => 'Programas especializados en enfoque PMI, PMO, Lean Construction, Valor Ganado, Power BI y Primavera P6.',
            'canonical'       => 'https://quality-consulting.org/capacitacion-gestion-de-proyectos',
            'activePage'      => 'capacitacion',
            'category'        => \App\Services\CoursesCatalog::getCategoryData('gestion-de-proyectos'),
        ];

        $this->render('pages/capacitacion-gestion-de-proyectos', $data, 'main');
    }

    /**
     * Categoría: Oficina Técnica.
     */
    public function capacitacionOficinaTecnica(): void
    {
        $data = [
            'title'           => 'Capacitación en Oficina Técnica de Obras | Quality Consulting Solutions',
            'metaDescription' => 'Especialización en administración de oficina técnica en edificaciones, hospitales, obras viales y mineras.',
            'canonical'       => 'https://quality-consulting.org/capacitacion-oficina-tecnica',
            'activePage'      => 'capacitacion',
            'category'        => \App\Services\CoursesCatalog::getCategoryData('oficina-tecnica'),
        ];

        $this->render('pages/capacitacion-oficina-tecnica', $data, 'main');
    }

    /**
     * Curso: Modelamiento y Diseño BIM con Autodesk Revit Architecture.
     */
    public function bimRevitArchitecture(): void
    {
        $data = [
            'title'           => 'Capacitación: Modelamiento y Diseño BIM con Autodesk Revit Architecture | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Modelamiento y Diseño BIM con nuevos Apps Autodesk, Revit Architecture. Domina la metodología BIM, VDC, documentación paramétrica y metrados automáticos.',
            'canonical'       => 'https://quality-consulting.org/bim-revit-architecture',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/bim-revit-architecture', $data, 'main');
    }

    /**
     * Curso: Enfoque PMI de la Gestión de la Calidad.
     */
    public function calidadPmi(): void
    {
        $data = [
            'title'           => 'Capacitación: Enfoque PMI de la Gestión de la Calidad | Quality Consulting Solutions',
            'metaDescription' => 'Curso de alta especialización en gestión de la calidad bajo la Sección 8 de la Guía del PMBOK® aplicado a la construcción e ingeniería civil.',
            'canonical'       => 'https://quality-consulting.org/calidad-y-pmi',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/calidad-y-pmi', $data, 'main');
    }

    /**
     * Curso: Dirección de la Calidad con el Enfoque PMI® para la Construcción.
     */
    public function direccionCalidadEnfoquePmi(): void
    {
        $data = [
            'title'           => 'Dirección de la Calidad con el Enfoque PMI® para la Construcción | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en dirección de la calidad bajo la Guía del PMBOK® y estándares del PMI® aplicado a proyectos de construcción e infraestructura.',
            'canonical'       => 'https://quality-consulting.org/direccion-calidad-enfoque-pmi',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/direccion-calidad-enfoque-pmi', $data, 'main');
    }

    /**
     * Curso: Gestión Contractual en Proyectos de Construcción.
     */
    public function contratos(): void
    {
        $data = [
            'title'           => 'Capacitación: Gestión Contractual en Proyectos de Construcción | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Gestión Contractual en Proyectos de Construcción. Aprende matriz de riesgos, administración de reclamos, PCE, control documentario y resolución de controversias.',
            'canonical'       => 'https://quality-consulting.org/contratos',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/contratos', $data, 'main');
    }

    /**
     * Curso: Gestión de Adicionales y Ampliación del Plazo con el Estado.
     */
    public function contratosEstado(): void
    {
        $data = [
            'title'           => 'Capacitación: Gestión de Adicionales y Ampliación del Plazo con el Estado | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Gestión de Adicionales (≤15%) y Ampliaciones de Plazo en Obras Públicas y Contratos FIDIC. Aprende los criterios técnicos, legales y procedimentales para contrataciones con el Estado.',
            'canonical'       => 'https://quality-consulting.org/contratos-estado',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/contratos-estado', $data, 'main');
    }

    /**
     * Curso: Control de Calidad en Tunelería.
     */
    public function controlCalidadTuneleria(): void
    {
        $data = [
            'title'           => 'Capacitación: Control de Calidad en Tunelería | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Control de Calidad en Tunelería. Control de calidad en el diseño y proceso constructivo de túneles y cavernas: concreto lanzado, pernería, soporte, revestimiento y maquinaria.',
            'canonical'       => 'https://quality-consulting.org/control-de-calidad-en-tuneleria',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/control-de-calidad-en-tuneleria', $data, 'main');
    }

    /**
     * Curso: Estrategias y Conceptos de Costos en Edificaciones.
     */
    public function costos(): void
    {
        $data = [
            'title'           => 'Capacitación: Estrategias y Conceptos de Costos en Edificaciones | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en control económico y financiero de obras de edificación: Resultado Operativo, Presupuesto Meta, EVM, MS Excel y S10.',
            'canonical'       => 'https://quality-consulting.org/costos',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/costos', $data, 'main');
    }

    /**
     * Curso: Contratos Internacionales FIDIC.
     */
    public function fidic(): void
    {
        $data = [
            'title'           => 'Capacitación: Contratos Internacionales FIDIC | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado de alto nivel en Contratos Internacionales FIDIC: Rainbow Suite (Red Book, Yellow Book, Silver Book) 1999 y 2017. Asesoría legal y técnica en infraestructura.',
            'canonical'       => 'https://quality-consulting.org/fidic',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/fidic', $data, 'main');
    }

    /**
     * Curso: Gerencia de la Calidad en la Construcción.
     */
    public function gerenciaCalidad(): void
    {
        $data = [
            'title'           => 'Capacitación: Gerencia de la Calidad en la Construcción | Quality Consulting Solutions',
            'metaDescription' => 'Curso de Gerencia de la Calidad Aplicada a la Construcción con usos de IA e indicadores avanzados (determinísticos, estocásticos y mixtos). Docente: Ing. Omar A. Samaniego.',
            'canonical'       => 'https://quality-consulting.org/gerencia-de-calidad',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/gerencia-de-calidad', $data, 'main');
    }

    /**
     * Curso: Estrategia de Productividad y Planificación con Grúas Torre.
     */
    public function gruasTorre(): void
    {
        $data = [
            'title'           => 'Capacitación: Estrategia de Productividad y Planificación con Grúas Torre | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Estrategia de Productividad y Planificación con Grúas Torre. Criterios de selección, montaje/desmontaje, gamificación y estudio de tiempos y movimientos en obras de gran altura.',
            'canonical'       => 'https://quality-consulting.org/gruas-torre',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/gruas-torre', $data, 'main');
    }

    /**
     * Taller: Herramientas de Gestión de Calidad en la Construcción + uso de IA.
     */
    public function herramientas(): void
    {
        $data = [
            'title'           => 'Taller de Herramientas de Gestión de Calidad en la Construcción + uso de Inteligencia Artificial | Quality Consulting Solutions',
            'metaDescription' => 'Taller especializado en herramientas de gestión de la calidad aplicada a la construcción con uso de IA. Diagramas de Pareto, Ishikawa, afinidad, control estadístico, indicadores Last Planner y 6 PDU.',
            'canonical'       => 'https://quality-consulting.org/herramientas',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/herramientas', $data, 'main');
    }

    /**
     * Curso: ISO 9001 para la Construcción usando IA.
     */
    public function iso9001(): void
    {
        $data = [
            'title'           => 'Capacitación: ISO 9001 para la Construcción usando IA | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en ISO 9001 para la Construcción usando IA. Incluye libro oficial del Ing. Omar A. Samaniego y análisis de cláusulas aplicadas a proyectos.',
            'canonical'       => 'https://quality-consulting.org/iso-9001',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/iso-9001', $data, 'main');
    }

    /**
     * Curso: Lean Construction y Last Planner.
     */
    public function leanLastPlanner(): void
    {
        $data = [
            'title'           => 'Capacitación: Lean Construction y Last Planner | Quality Consulting Solutions',
            'metaDescription' => 'Curso de capacitación especializada en Lean Construction y Last Planner System. Aprende flujo de trabajo, análisis de restricciones y optimización de la productividad en proyectos de construcción con Quality Consulting Solutions.',
            'canonical'       => 'https://quality-consulting.org/lean-last-planner',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/lean-last-planner', $data, 'main');
    }

    /**
     * Ruta consolidada: Redirección permanente HTTP 301 hacia el curso oficial NEC3-F.
     * Descarta parámetros de consulta para consolidar SEO de forma limpia y evitar bucles.
     */
    public function nec(): void
    {
        $this->redirect('/contratos-colaborativos-nec3-f', 301);
    }

    /**
     * Curso: Gestión de Proyectos con el Enfoque PMI.
     */
    public function proyectosPmi(): void
    {
        $data = [
            'title'           => 'Capacitación: Gestión de Proyectos con el Enfoque PMI | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Gestión de Proyectos con el Enfoque PMI. Domina las 11 áreas de conocimiento del PMBOK: alcance, cronograma, costos, calidad, riesgos, procura y stakeholders.',
            'canonical'       => 'https://quality-consulting.org/proyectos-pmi',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/proyectos-pmi', $data, 'main');
    }

    /**
     * Curso / Evaluación: Riesgo del Plazo.
     */
    public function riesgoDelPlazo(): void
    {
        $data = [
            'title'           => 'Evaluación del Riesgo del Cumplimiento del Plazo | Quality Consulting Solutions',
            'metaDescription' => 'Evaluación del síndrome del 90% y metodología de la Curva de Liberación para el control del plazo y prevención de demoras en proyectos.',
            'canonical'       => 'https://quality-consulting.org/riesgo-del-plazo',
            'activePage'      => 'consultoria',
        ];

        $this->render('pages/riesgo-del-plazo', $data, 'main');
    }

    /**
     * Curso: Riesgos en la Cadena de Producción de la Construcción ISO 31000 usando BIM.
     */
    public function riesgosCadenaProduccion(): void
    {
        $data = [
            'title'           => 'Riesgos en la Cadena de Producción de la Construcción ISO 31000 usando BIM | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en gestión de riesgos en la cadena de producción de la construcción con el estándar ISO 31000, herramientas ISO 31010 y entornos BIM.',
            'canonical'       => 'https://quality-consulting.org/riesgos-cadena-produccion',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/riesgos-cadena-produccion', $data, 'main');
    }

    /**
     * Curso: Análisis Cuantitativo de Riesgos del Costo y Cronograma con Simulación de Monte Carlo.
     */
    public function analisisCuantitativoRiesgos(): void
    {
        $data = [
            'title'           => 'Análisis Cuantitativo de Riesgos del Costo y Cronograma con Simulación de Monte Carlo | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en modelado probabilístico, simulación de Monte Carlo, diagramas de tornado y estimación de reservas de contingencia en construcción.',
            'canonical'       => 'https://quality-consulting.org/analisis-cuantitativo-riesgos',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/analisis-cuantitativo-riesgos', $data, 'main');
    }

    /**
     * Curso: Gestión de Riesgos, Cambios y Reclamos en la Construcción.
     */
    public function gestionRiesgos(): void
    {
        $data = [
            'title'           => 'Capacitación: Gestión de Riesgos, Cambios y Reclamos en la Construcción | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Gestión de Riesgos, Cambios y Reclamos en el Plazo y Alcance en la Construcción. Impartido por el Ing. Víctor Viteri Valiente.',
            'canonical'       => 'https://quality-consulting.org/gestion-de-riesgos',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/gestion-de-riesgos', $data, 'main');
    }

    /**
     * Curso: Gestión de Riesgos en Proyectos con el Enfoque PMI®.
     */
    public function riesgosPmi(): void
    {
        $data = [
            'title'           => 'Capacitación: Gestión de Riesgos con el Enfoque PMI | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Gestión de Riesgos bajo los estándares y procesos del Project Management Institute (PMI). Impartido por Felix Valdez-Torero MSc, PhD(c), PMP®.',
            'canonical'       => 'https://quality-consulting.org/riesgos-pmi',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/riesgos-pmi', $data, 'main');
    }

    /**
     * Curso: Gestión de Riesgos Técnicos de la Construcción.
     */
    public function riesgosTecnicos(): void
    {
        $data = [
            'title'           => 'Capacitación: Gestión de Riesgos Técnicos de la Construcción | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Gestión de Riesgos Técnicos de la Construcción alineado a la Guía del PMBOK® y Estándares PMI®. Casos prácticos y lecciones aprendidas en obra con el Ing. Omar Samaniego.',
            'canonical'       => 'https://quality-consulting.org/riesgos-tecnicos',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/riesgos-tecnicos', $data, 'main');
    }

    /**
     * Programa: Universidad Corporativa & Formación Empresarial.
     */
    public function universidadCorporativa(): void
    {
        $data = [
            'title'           => 'Universidad Corporativa & Formación Empresarial | Quality Consulting Solutions',
            'metaDescription' => 'Asesoría especializada para orientar el diseño de academias corporativas, mallas formativas y programas de capacitación in-house para empresas.',
            'canonical'       => 'https://quality-consulting.org/universidad-corporativa',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/universidad-corporativa', $data, 'main');
    }

    /**
     * Curso: Avance de Obra con el Uso del Método del Valor Ganado (EVM).
     */
    public function valorGanado(): void
    {
        $data = [
            'title'           => 'Capacitación: Avance de Obra con el Uso del Método del Valor Ganado (EVM) | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado de alto nivel en Control de Proyectos y Avance de Obra con el Método del Valor Ganado (Earned Value Management - EVM) según la Guía del PMBOK®.',
            'canonical'       => 'https://quality-consulting.org/valor-ganado',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/valor-ganado', $data, 'main');
    }

    /**
     * Curso: Especialización en Gestión de la PMO (Project Management Office).
     */
    public function pmo(): void
    {
        $data = [
            'title'           => 'Capacitación: Gestión de la PMO | Quality Consulting Solutions',
            'metaDescription' => 'Curso de capacitación especializada en Gestión de la PMO (Project Management Office). Domina la alineación estratégica, gobernanza y gestión de portafolios, programas y proyectos.',
            'canonical'       => 'https://quality-consulting.org/pmo',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/pmo', $data, 'main');
    }

    /**
     * Seminario: Método de la Curva de Completion para Evitar el Síndrome del 90%.
     */
    public function sindromeDel90(): void
    {
        $data = [
            'title'           => 'Seminario: Método de la Curva de Completion (Síndrome del 90%) | Quality Consulting Solutions',
            'metaDescription' => 'Seminario especializado en el Método de la Curva de Completion adoptado por INACAL (Guía GP 151) para evitar el Síndrome del 90% y asegurar el cierre de proyectos.',
            'canonical'       => 'https://quality-consulting.org/sindrome-del-90',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/sindrome-del-90', $data, 'main');
    }

    /**
     * Seminario: Cambios en la ISO 9001:2026.
     */
    public function seminarioIso90012026(): void
    {
        $data = [
            'title'           => 'Seminario: Cambios en la ISO 9001:2026 | Quality Consulting Solutions',
            'metaDescription' => 'Seminario especializado en los cambios previstos, evolución y criterios de interpretación técnica de la ISO 9001:2026 aplicados al sector construcción.',
            'canonical'       => 'https://quality-consulting.org/seminario-iso-9001-2026',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/seminario-iso-9001-2026', $data, 'main');
    }

    /**
     * Seminario: Indicadores Avanzados de Calidad en la Construcción.
     */
    public function indicadoresDeCalidad(): void
    {
        $data = [
            'title'           => 'Seminario: Indicadores Avanzados de Calidad en la Construcción | Quality Consulting Solutions',
            'metaDescription' => 'Seminario especializado en diseño e interpretación de KPIs avanzados de calidad en obra: métricas de completion (Q6, Q6\', WIP), Last Planner® y modelado estocástico.',
            'canonical'       => 'https://quality-consulting.org/indicadores-de-calidad',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/indicadores-de-calidad', $data, 'main');
    }

    /**
     * Seminario: Casos de Aplicación del Diagrama de Ishikawa.
     */
    public function seminarioDiagramaIshikawa(): void
    {
        $data = [
            'title'           => 'Seminario: Casos de Aplicación del Diagrama de Ishikawa | Quality Consulting Solutions',
            'metaDescription' => 'Seminario especializado en análisis de causa raíz, acción correctiva vs. corrección y resolución práctica de no conformidades mediante el Diagrama de Ishikawa.',
            'canonical'       => 'https://quality-consulting.org/seminario-diagrama-ishikawa',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/seminario-diagrama-ishikawa', $data, 'main');
    }

    /**
     * Curso: Oficina Técnica en Obras Viales.
     */
    public function oficinaTecnicaObrasViales(): void
    {
        $data = [
            'title'           => 'Capacitación: Oficina Técnica en Obras Viales | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Gestión de la Oficina Técnica en Obras Viales: integración, alcance, plazo, costo, comunicaciones y procura. 16 horas netas y 16 PDU.',
            'canonical'       => 'https://quality-consulting.org/oficina-tecnica-obras-viales',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/oficina-tecnica-obras-viales', $data, 'main');
    }

    /**
     * Curso: Oficina Técnica en Edificaciones y Hospitales.
     */
    public function oficinaTecnicaHospitalesEdificaciones(): void
    {
        $data = [
            'title'           => 'Capacitación: Oficina Técnica en Edificaciones y Hospitales | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Gestión de la Oficina Técnica en Edificaciones y Hospitales: alcance, plazo, costo, comunicaciones y procura. 16 horas netas y 16 PDU.',
            'canonical'       => 'https://quality-consulting.org/oficina-tecnica-hospitales-edificaciones',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/oficina-tecnica-hospitales-edificaciones', $data, 'main');
    }

    /**
     * Curso: Oficina Técnica en Infraestructura Minera (PADs, Presas de Relave, Geosintéticos).
     */
    public function oficinaTecnicaInfraestructuraMinera(): void
    {
        $data = [
            'title'           => 'Capacitación: Oficina Técnica en Infraestructura Minera | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Gestión de la Oficina Técnica en Infraestructura Minera (PADs, presas de relave y geosintéticos): organización, alcance, procura, planificación y costos. 15 horas netas y 16 PDU.',
            'canonical'       => 'https://quality-consulting.org/oficina-tecnica-infraestructura-minera',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/oficina-tecnica-infraestructura-minera', $data, 'main');
    }

    /**
     * Curso: Oficina Técnica en Edificaciones + Panel de Control 100% Real Time.
     */
    public function oficinaTecnicaEdificacionesPanelControl(): void
    {
        $data = [
            'title'           => 'Capacitación: Oficina Técnica en Edificaciones + Panel de Control 100% Real Time | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Gestión de la Oficina Técnica en Edificaciones con Panel de Control en tiempo real vía cloud con Looker Studio: ingeniería, procura, construcción y costos. 17 horas netas y 16 PDU.',
            'canonical'       => 'https://quality-consulting.org/oficina-tecnica-edificaciones-panel-control',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/oficina-tecnica-edificaciones-panel-control', $data, 'main');
    }

    /**
     * Curso: Contrato Colaborativo NEC 3/4.
     */
    public function contratoColaborativoNec34(): void
    {
        $data = [
            'title'           => 'Capacitación: Contrato Colaborativo NEC 3/4 | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Contrato Colaborativo NEC 3/4: cláusulas principales 10 a 90, Opción F, opciones secundarias y casuística práctica. 16 horas netas y 16 PDU.',
            'canonical'       => 'https://quality-consulting.org/contrato-colaborativo-nec-3-4',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/contrato-colaborativo-nec-3-4', $data, 'main');
    }

    /**
     * Curso: Contratos FIDIC para Contratos EPC y Construcción.
     */
    public function contratosFidicEpcConstruccion(): void
    {
        $data = [
            'title'           => 'Capacitación: Contratos FIDIC para Contratos EPC y Construcción | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Contratos FIDIC para EPC y Construcción: Rainbow Suite (Red, Yellow y Silver Books 1999 y 2017), gestión de riesgos, reclamos y adecuación al derecho peruano. 20 horas netas y 16 PDU.',
            'canonical'       => 'https://quality-consulting.org/contratos-fidic-epc-construccion',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/contratos-fidic-epc-construccion', $data, 'main');
    }

    /**
     * Curso: Gestión de Reclamos en Contratos de Construcción y Contratos Colaborativos NEC y FIDIC.
     */
    public function gestionReclamosNecFidic(): void
    {
        $data = [
            'title'           => 'Capacitación: Gestión de Reclamos en Contratos de Construcción y Contratos Colaborativos NEC y FIDIC | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Gestión de Reclamos en Contratos de Construcción y Contratos Colaborativos NEC y FIDIC: estructura del claim, ampliaciones de plazo, demoras concurrentes, aceleración, daños, disruption y análisis de cronograma. 23 horas netas y 23 PDU.',
            'canonical'       => 'https://quality-consulting.org/gestion-reclamos-nec-fidic',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/gestion-reclamos-nec-fidic', $data, 'main');
    }

    /**
     * Curso: Claves para el Éxito en la Junta de Resolución de Disputas - JRD (DAB) de Obras.
     */
    public function juntaResolucionDisputasDab(): void
    {
        $data = [
            'title'           => 'Capacitación: Claves para el Éxito en la Junta de Resolución de Disputas - JRD (DAB) de Obras | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en la Junta de Resolución de Disputas (DAB): gobernanza, consulta informal, hoja de ruta, preguntas poderosas, regulación ICC y experiencias en contratos NEC y FIDIC. 16 horas netas y 16 PDU.',
            'canonical'       => 'https://quality-consulting.org/junta-resolucion-disputas-dab',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/junta-resolucion-disputas-dab', $data, 'main');
    }

    /**
     * Curso: Gestión del Cambio en los Contratos con el Estado.
     */
    public function gestionCambiosContratosEstado(): void
    {
        $data = [
            'title'           => 'Capacitación: Gestión del Cambio en los Contratos con el Estado | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Gestión del Cambio en los Contratos con el Estado: marco contractual, causales, ampliaciones de plazo, adicionales, deductivos, cronograma y solución de controversias. 16 horas netas y 16 PDU.',
            'canonical'       => 'https://quality-consulting.org/gestion-cambios-contratos-estado',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/gestion-cambios-contratos-estado', $data, 'main');
    }

    /**
     * Curso: Gestión Contractual en los Megaproyectos de Construcción Mineros.
     */
    public function gestionContractualMegaproyectosMineros(): void
    {
        $data = [
            'title'           => 'Capacitación: Gestión Contractual en los Megaproyectos de Construcción Mineros | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Gestión Contractual en Megaproyectos Mineros: formación y negociación de contratos, supervisión del cumplimiento, administración de riesgos y cambios, resolución de disputas y cierre. 16 horas netas y 12 PDU.',
            'canonical'       => 'https://quality-consulting.org/gestion-contractual-megaproyectos-mineros',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/gestion-contractual-megaproyectos-mineros', $data, 'main');
    }

    /**
     * Curso: El Contrato de NEC4.
     */
    public function contratoNec4(): void
    {
        $data = [
            'title'           => 'Capacitación: El Contrato de NEC4 | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en El Contrato de NEC4: cláusulas principales 10 a 80, opciones principales A a F, resolución y prevención de disputas con cláusulas W y DAB, y cláusulas secundarias. 14 horas netas y 14 PDU.',
            'canonical'       => 'https://quality-consulting.org/contrato-nec4',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/contrato-nec4', $data, 'main');
    }

    /**
     * Curso: Gestión de Eventos Compensables y Alertas Tempranas en Contratos NEC4.
     */
    public function eventosCompensablesAlertasTempranasNec4(): void
    {
        $data = [
            'title'           => 'Capacitación: Gestión de Eventos Compensables y Alertas Tempranas en Contratos NEC4 | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Gestión de Eventos Compensables y Alertas Tempranas en Contratos NEC4: cláusulas, Defined Costs, tiempos de presentación, sustento y escalamiento. 16 horas netas, 8 sesiones y 16 PDU.',
            'canonical'       => 'https://quality-consulting.org/eventos-compensables-alertas-tempranas-nec4',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/eventos-compensables-alertas-tempranas-nec4', $data, 'main');
    }

    /**
     * Curso: Contratos Colaborativos NEC3-F.
     */
    public function inHouse(): void
    {
        $data = [
            'title'           => 'Capacitaciones In-House | Formación a la Medida para Empresas - Quality Consulting Solutions',
            'metaDescription' => 'Programas de capacitación corporativa in-house para empresas en Calidad, Gestión de Riesgos, Contratos Colaborativos, PMO y Oficina Técnica. Formación especializada adaptada a tus proyectos reales.',
            'canonical'       => 'https://quality-consulting.org/in-house',
            'activePage'      => 'in-house',
        ];

        $this->render('pages/in-house', $data, 'main');
    }

    public function contratosColaborativosNec3f(): void
    {
        $data = [
            'title'           => 'Capacitación: Contratos Colaborativos NEC3-F | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Contratos Colaborativos NEC3-F: Project Delivery System, distribución balanceada de riesgos, cláusulas clave, gestión del cambio y Last Planner® System. 14 horas netas y 14 PDU.',
            'canonical'       => 'https://quality-consulting.org/contratos-colaborativos-nec3-f',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/contratos-colaborativos-nec3-f', $data, 'main');
    }

    /**
     * Curso: Casos Prácticos de Contratos NEC3-F.
     */
    public function casosPracticosContratosNec3f(): void
    {
        $data = [
            'title'           => 'Capacitación: Casos Prácticos de Contratos NEC3-F | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Casos Prácticos de Contratos NEC3-F: términos, obligaciones del contratista y del cliente, gestión de riesgos, alertas tempranas, eventos compensables y casuística real. 12 horas netas y 12 PDU.',
            'canonical'       => 'https://quality-consulting.org/casos-practicos-contratos-nec3-f',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/casos-practicos-contratos-nec3-f', $data, 'main');
    }

    /**
     * Curso: Gestión de Proyectos con el Enfoque PMI.
     */
    public function gestionProyectosPmi(): void
    {
        $data = [
            'title'           => 'Capacitación: Gestión de Proyectos con el Enfoque PMI | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Gestión de Proyectos con el Enfoque PMI: principios y dominios de desempeño del PMBOK® 7ma Edición, taller de riesgos y panel en Google Looker Studio. 20 horas netas y 20 PDU.',
            'canonical'       => 'https://quality-consulting.org/gestion-proyectos-pmi',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/gestion-proyectos-pmi', $data, 'main');
    }

    /**
     * Curso: Gestión de la PMO & VMO.
     */
    public function gestionPmoVmo(): void
    {
        $data = [
            'title'           => 'Capacitación: Gestión de la PMO & VMO | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Gestión de la PMO & VMO: implementación de oficinas de gestión de proyectos, Value Management Office (VMO Ágil), templates oficiales del PMI y tableros en Google Looker Studio. 15 horas netas y 15 PDU.',
            'canonical'       => 'https://quality-consulting.org/gestion-pmo-vmo',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/gestion-pmo-vmo', $data, 'main');
    }

    /**
     * Curso: Brightline Initiative (Enfoque Estratégico del PMI).
     */
    public function brightlineInitiative(): void
    {
        $data = [
            'title'           => 'Capacitación: Brightline Initiative (Enfoque Estratégico del PMI) | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Brightline Initiative: cierre de la brecha entre diseño estratégico y entrega efectiva aplicando los 10 principios del PMI. 15 horas netas y 15 PDU.',
            'canonical'       => 'https://quality-consulting.org/brightline-initiative',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/brightline-initiative', $data, 'main');
    }

    /**
     * Curso: Lean Construction en Edificaciones.
     */
    public function leanConstructionEdificaciones(): void
    {
        $data = [
            'title'           => 'Capacitación: Lean Construction en Edificaciones | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Lean Construction en Edificaciones: Last Planner® System, sectorización, líneas de balance, trenes de trabajo, Lookahead y análisis de restricciones. 16 horas netas y 16 PDU.',
            'canonical'       => 'https://quality-consulting.org/lean-construction-edificaciones',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/lean-construction-edificaciones', $data, 'main');
    }

    /**
     * Curso: Lean Construction en Infraestructura.
     */
    public function leanConstructionInfraestructura(): void
    {
        $data = [
            'title'           => 'Capacitación: Lean Construction en Infraestructura | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Lean Construction en Infraestructura: Last Planner® System en megaproyectos lineales, obras viales y minería, Pull Planning, líneas de balance y mejora continua. 16 horas netas y 16 PDU.',
            'canonical'       => 'https://quality-consulting.org/lean-construction-infraestructura',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/lean-construction-infraestructura', $data, 'main');
    }

    /**
     * Curso: Liderazgo en la Construcción.
     */
    public function liderazgoConstruccion(): void
    {
        $data = [
            'title'           => 'Capacitación: Liderazgo en la Construcción | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Liderazgo en la Construcción: liderazgo directivo, transformacional, Management 3.0, comunicación asertiva, escucha empática y feedback. 12 horas netas y 12 PDU.',
            'canonical'       => 'https://quality-consulting.org/liderazgo-construccion',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/liderazgo-construccion', $data, 'main');
    }

    /**
     * Curso: Resultado Operativo de Obra.
     */
    public function resultadoOperativoObra(): void
    {
        $data = [
            'title'           => 'Capacitación: Resultado Operativo de Obra | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Resultado Operativo de Obra: control económico de obra, presupuesto venta vs meta, indicadores CPI/SPI/TCPI, proyecciones de costo al cierre y planes de acción. 12 horas netas y 12 PDU.',
            'canonical'       => 'https://quality-consulting.org/resultado-operativo-obra',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/resultado-operativo-obra', $data, 'main');
    }

    /**
     * Curso: Valor Ganado con MS Project y Power BI.
     */
    public function valorGanadoMsProjectPowerBi(): void
    {
        $data = [
            'title'           => 'Capacitación: Valor Ganado con MS Project y Power BI | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Valor Ganado con MS Project y Power BI: método del valor ganado (EVM), líneas base, métricas de rendimiento y desarrollo de tableros en Power BI. 14 horas netas y 14 PDU.',
            'canonical'       => 'https://quality-consulting.org/valor-ganado-ms-project-power-bi',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/valor-ganado-ms-project-power-bi', $data, 'main');
    }

    /**
     * Curso: Costos en Edificaciones con Power BI.
     */
    public function costosEdificacionesPowerBi(): void
    {
        $data = [
            'title'           => 'Capacitación: Costos en Edificaciones con Power BI | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Costos en Edificaciones con Power BI: cuentas de control, informe semanal de producción (ISP), resultado operativo, presupuesto meta y tableros interactivos. 14 horas netas y 14 PDU.',
            'canonical'       => 'https://quality-consulting.org/costos-edificaciones-power-bi',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/costos-edificaciones-power-bi', $data, 'main');
    }

    /**
     * Curso: Control de Proyectos con BIM y Power BI.
     */
    public function controlProyectosBimPowerBi(): void
    {
        $data = [
            'title'           => 'Capacitación: Control de Proyectos con BIM y Power BI | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Control de Proyectos con BIM y Power BI: modelamiento digital de estructuras, sectorización, automatización con Dynamo y tableros analíticos en Power BI. 14 horas netas y 14 PDU.',
            'canonical'       => 'https://quality-consulting.org/control-proyectos-bim-power-bi',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/control-proyectos-bim-power-bi', $data, 'main');
    }

    /**
     * Curso: Virtual Design & Construction - VDC.
     */
    public function vdc(): void
    {
        $data = [
            'title'           => 'Capacitación: Virtual Design & Construction - VDC | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Virtual Design & Construction (VDC): marco metodológico de Stanford University, objetivos del cliente, sesiones ICE, BIM, PPM y estándar COBie. 14 horas netas y 14 PDU.',
            'canonical'       => 'https://quality-consulting.org/vdc',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/vdc', $data, 'main');
    }

    /**
     * Curso: Control de Proyectos con Primavera P6.
     */
    public function controlProyectosPrimaveraP6(): void
    {
        $data = [
            'title'           => 'Capacitación: Control de Proyectos con Primavera P6 | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Control de Proyectos con Primavera P6: estructura Enterprise (EPS), WBS, ruta crítica, curvas S, valor ganado y tableros en Power BI. 14 horas netas y 14 PDU.',
            'canonical'       => 'https://quality-consulting.org/control-proyectos-primavera-p6',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/control-proyectos-primavera-p6', $data, 'main');
    }

    /**
     * Curso: Análisis Forense del Cronograma con Primavera P6.
     */
    public function analisisForenseCronogramaPrimaveraP6(): void
    {
        $data = [
            'title'           => 'Capacitación: Análisis Forense del Cronograma con Primavera P6 | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Análisis Forense del Cronograma con Primavera P6: metodologías AACE MIP 29R-03 y protocolo SCL, demoras concurrentes, fragnets y peritajes técnicos. 15 horas netas y 15 PDU.',
            'canonical'       => 'https://quality-consulting.org/analisis-forense-cronograma-primavera-p6',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/analisis-forense-cronograma-primavera-p6', $data, 'main');
    }

    /**
     * Curso: Control de Proyectos de Construcción.
     */
    public function controlProyectosConstruccion(): void
    {
        $data = [
            'title'           => 'Capacitación: Control de Proyectos de Construcción | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Control de Proyectos de Construcción: alcance (WBS), cronograma (CPM/PERT), costos directos e indirectos, presupuesto venta vs meta y valor ganado. 15 horas netas y 15 PDU.',
            'canonical'       => 'https://quality-consulting.org/control-proyectos-construccion',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/control-proyectos-construccion', $data, 'main');
    }
}



