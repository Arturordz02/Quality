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
            'title'           => 'Capacitación Ejecutiva y Programas de Especialización | Quality Consulting Solutions',
            'metaDescription' => 'Programas de especialización profesional en Dirección de Proyectos, Contratos FIDIC, Gestión de Calidad, BIM, PMO y Valor Ganado. Cursos 100% online con grabaciones en alta definición y certificación.',
            'canonical'       => 'https://quality-consulting.org/capacitacion',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/capacitacion', $data, 'main');
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
     * Curso: Gerencia de la Calidad para la Infraestructura y Construcción.
     */
    public function gerenciaCalidad(): void
    {
        $data = [
            'title'           => 'Capacitación: Gerencia de la Calidad para la Infraestructura y Construcción | Quality Consulting Solutions',
            'metaDescription' => 'Curso de capacitación especializada en Gerencia de la Calidad para la Infraestructura y Construcción. Domina la norma ISO 9001, Project Management y herramientas de gestión de calidad en obra.',
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
     * Curso: Herramientas de Calidad para la Infraestructura y Construcción.
     */
    public function herramientas(): void
    {
        $data = [
            'title'           => 'Capacitación: Herramientas de Calidad para la Infraestructura y Construcción | Quality Consulting Solutions',
            'metaDescription' => 'Curso taller de herramientas de gestión de la calidad para proyectos de infraestructura y construcción. Las 7 herramientas clásicas, indicadores y toma de decisiones basada en datos.',
            'canonical'       => 'https://quality-consulting.org/herramientas',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/herramientas', $data, 'main');
    }

    /**
     * Curso: ISO 9001:2015 para la Infraestructura y Construcción.
     */
    public function iso9001(): void
    {
        $data = [
            'title'           => 'Capacitación: ISO 9001:2015 para la Infraestructura y Construcción | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en interpretación y aplicación de la norma ISO 9001:2015 en obras. Ciclo PHVA, control de no conformidades y gestión de riesgos.',
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
     * Taller / Metodología: LEGO® SERIOUS PLAY®.
     */
    public function legoSeriousPlay(): void
    {
        $data = [
            'title'           => 'LEGO® SERIOUS PLAY® | Quality Consulting Solutions',
            'metaDescription' => 'Metodología corporativa LEGO® SERIOUS PLAY® para facilitar la comunicación, resolución de problemas, generación de ideas y toma de decisiones estratégicas en equipos.',
            'canonical'       => 'https://quality-consulting.org/lego-serious-play',
            'activePage'      => 'capacitacion',
        ];

        $this->render('pages/lego-serious-play', $data, 'main');
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
            'title'           => 'Riesgo del Plazo | Quality Consulting Solutions',
            'metaDescription' => 'Evaluación del síndrome del 90% y gestión de restricciones para proyectar la fecha de completación en proyectos de construcción.',
            'canonical'       => 'https://quality-consulting.org/riesgo-del-plazo',
            'activePage'      => 'capacitacion',
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
}
