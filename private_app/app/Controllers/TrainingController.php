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
            'metaDescription' => 'Catálogo completo de las 48 capacitaciones oficiales en Calidad, Riesgos, Contratos, Gestión de Proyectos y Oficina Técnica. Cursos grabados con acceso flexible y certificación.',
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
     * Curso: Contratos Colaborativos NEC.
     */
    public function nec(): void
    {
        $data = [
            'title'           => 'Capacitación: Contratos Colaborativos NEC | Quality Consulting Solutions',
            'metaDescription' => 'Curso de capacitación especializada en Contratos Colaborativos NEC (New Engineering Contract). Domina el estándar NEC3 Opción F utilizado en los Juegos Panamericanos Lima 2019.',
            'canonical'       => 'https://quality-consulting.org/nec',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/nec', $data, 'main');
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
     * Curso: Riesgos de la Cadena de Producción de la Construcción.
     */
    public function riesgosCadenaProduccion(): void
    {
        $data = [
            'title'           => 'Capacitación: Riesgos de la Cadena de Producción de la Construcción | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en gestión de riesgos en la cadena de producción de la construcción con marcos ISO 31000 y herramientas prácticas ISO 31010.',
            'canonical'       => 'https://quality-consulting.org/riesgos-cadena-produccion',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/riesgos-cadena-produccion', $data, 'main');
    }

    /**
     * Curso: Gestión de Riesgos con el Enfoque PMI.
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
}

