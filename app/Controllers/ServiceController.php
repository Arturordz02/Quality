<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Controlador de Servicios y Consultoría (app/Controllers/ServiceController.php)
 *
 * Responsabilidad:
 * - Gestionar la presentación de las páginas de servicios especializados de consultoría e ingeniería.
 * - Preparar metadatos SEO específicos de cada servicio y despachar sus vistas modulares.
 */

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class ServiceController extends Controller
{
    /**
     * Hub principal de servicios de consultoría técnica y gestión de proyectos.
     */
    public function consultoria(): void
    {
        $data = [
            'title'           => 'Servicios de Consultoría Técnica y Gestión de Proyectos | Quality Consulting Solutions',
            'metaDescription' => 'Acompañamos a las organizaciones del sector construcción, infraestructura y minería en la optimización de procesos, PMO, auditorías ISO 9001 y gestión de riesgos.',
            'canonical'       => 'https://quality-consulting.org/consultoria',
            'activePage'      => 'consultoria',
        ];

        $this->render('pages/consultoria', $data, 'main');
    }

    /**
     * Servicio: Gestión de la Calidad en Proyectos de Ingeniería y Construcción.
     */
    public function gestionCalidad(): void
    {
        $data = [
            'title'           => 'Gestión de la Calidad en Proyectos de Ingeniería y Construcción | Quality Consulting Solutions',
            'metaDescription' => 'Servicios integrales de Gestión de la Calidad, estandarización, auditoría técnica en obra, mejora continua y control de defectología postventa por Quality Consulting Solutions.',
            'canonical'       => 'https://quality-consulting.org/gestion-de-la-calidad',
            'activePage'      => 'consultoria',
        ];

        $this->render('pages/gestion-de-la-calidad', $data, 'main');
    }

    /**
     * Servicio: Gestión de la PMO y Proyectos.
     */
    public function gestionPmo(): void
    {
        $data = [
            'title'           => 'Gestión de la PMO y Proyectos | Quality Consulting Solutions',
            'metaDescription' => 'Desarrollo de PMO, metodología de gestión de proyectos, ciclo PHVA y auditoría de áreas y vendors por Quality Consulting Solutions.',
            'canonical'       => 'https://quality-consulting.org/gestion-de-pmo',
            'activePage'      => 'consultoria',
        ];

        $this->render('pages/gestion-de-pmo', $data, 'main');
    }

    /**
     * Servicio: Gestión del Riesgo Técnico y Contractual.
     */
    public function gestionRiesgos(): void
    {
        $data = [
            'title'           => 'Gestión del Riesgo | Quality Consulting Solutions',
            'metaDescription' => 'Identificación, análisis, respuesta y monitoreo estratégico de riesgos técnicos en proyectos de ingeniería y construcción por Quality Consulting Solutions.',
            'canonical'       => 'https://quality-consulting.org/gestion-de-riesgos',
            'activePage'      => 'consultoria',
        ];

        $this->render('pages/gestion-de-riesgos', $data, 'main');
    }

    /**
     * Servicio: Análisis Forense del Cronograma y Ruta Crítica (CPM).
     */
    public function cronogramaForense(): void
    {
        $data = [
            'title'           => 'Análisis Forense del Cronograma | Collapse As-Built & Ruta Crítica (CPM) | Quality Consulting Solutions',
            'metaDescription' => 'Servicio de Análisis Forense del Cronograma y metodología Collapse As-Built para evaluación técnica de retrasos, impactos en ruta crítica (CPM) y deslinde de responsabilidades.',
            'canonical'       => 'https://quality-consulting.org/cronograma-forense',
            'activePage'      => 'consultoria',
        ];

        $this->render('pages/cronograma-forense', $data, 'main');
    }

    /**
     * Servicio: Preparación para Homologación de Proveedores.
     */
    public function homologaciones(): void
    {
        $data = [
            'title'           => 'Preparación para Homologación de Proveedores | Quality Consulting Solutions',
            'metaDescription' => 'Asesoría integral y preparación para la auditoría de homologación de proveedores en construcción, ingeniería y actividades afines por Quality Consulting Solutions.',
            'canonical'       => 'https://quality-consulting.org/homologaciones',
            'activePage'      => 'consultoria',
        ];

        $this->render('pages/homologaciones', $data, 'main');
    }

    /**
     * Servicio: Headhunting Especializado para el Sector Construcción.
     */
    public function headhunting(): void
    {
        $data = [
            'title'           => 'Headhunting Especializado para la Construcción | Quality Consulting Solutions',
            'metaDescription' => 'Servicio de Headhunting especializado para el sector construcción e ingeniería. Atracción, evaluación técnica por ingenieros senior y selección de profesionales clave.',
            'canonical'       => 'https://quality-consulting.org/headhunting',
            'activePage'      => 'consultoria',
        ];

        $this->render('pages/headhunting', $data, 'main');
    }

    /**
     * Servicio: Gestión de Oficina Técnica para Obras Privadas y Públicas.
     */
    public function oficinaTecnica(): void
    {
        $data = [
            'title'           => 'Capacitación: Oficina Técnica Obras Privadas y Públicas | Quality Consulting Solutions',
            'metaDescription' => 'Curso especializado en Gestión de Oficina Técnica para Obras Privadas y Públicas. Aprende integración, alcance, plazo, costo, procura y control de proyectos de construcción.',
            'canonical'       => 'https://quality-consulting.org/oficina-tecnica',
            'activePage'      => 'consultoria',
        ];

        $this->render('pages/oficina-tecnica', $data, 'main');
    }

    /**
     * Servicio: Permisología, Licencias y Autorizaciones de Obra.
     */
    public function permisologia(): void
    {
        $data = [
            'title'           => 'Permisología, Licencias y Autorizaciones de Obra | Quality Consulting Solutions',
            'metaDescription' => 'Gestión integral de permisos, licencias de edificación, habilitaciones urbanas, opiniones favorables y saneamiento físico-legal por Quality Consulting Solutions.',
            'canonical'       => 'https://quality-consulting.org/permisologia',
            'activePage'      => 'consultoria',
        ];

        $this->render('pages/permisologia', $data, 'main');
    }

    /**
     * Servicio / Metodología: Evaluación del Riesgo del Cumplimiento del Plazo (Síndrome del 90%).
     */
    public function sindromeDel90(): void
    {
        $data = [
            'title'           => 'Evaluación del Riesgo del Cumplimiento del Plazo | Síndrome del 90% | Quality Consulting Solutions',
            'metaDescription' => 'Metodología única de Curva de Liberación ® para la evaluación del riesgo de cumplimiento del plazo y prevención del Síndrome del 90% por Quality Consulting Solutions.',
            'canonical'       => 'https://quality-consulting.org/sindrome-del-90',
            'activePage'      => 'consultoria',
        ];

        $this->render('pages/sindrome-del-90', $data, 'main');
    }
}

