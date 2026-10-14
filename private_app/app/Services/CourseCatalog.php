<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Catálogo Unificado de Cursos de Capacitación
 *
 * Responsabilidad:
 * - Centralizar la lista de cursos oficiales, nombres completos, slugs y rutas web.
 * - Validar de forma consistente qué cursos están disponibles para la compra de la primera clase.
 */

declare(strict_types=1);

namespace App\Services;

class CourseCatalog
{
    /**
     * Catálogo oficial de cursos disponibles con su slug y título completo.
     */
    private static array $courses = [
        'bim-revit-architecture' => [
            'slug'  => 'bim-revit-architecture',
            'title' => 'BIM Revit Architecture',
            'url'   => '/bim-revit-architecture',
        ],
        'contratos-estado' => [
            'slug'  => 'contratos-estado',
            'title' => 'Contrataciones con el Estado y Ley 30225',
            'url'   => '/contratos-estado',
        ],
        'contratos' => [
            'slug'  => 'contratos',
            'title' => 'Administración de Contratos de Construcción',
            'url'   => '/contratos',
        ],
        'costos' => [
            'slug'  => 'costos',
            'title' => 'Costos y Presupuestos en Edificaciones',
            'url'   => '/costos',
        ],
        'direccion-calidad-enfoque-pmi' => [
            'slug'  => 'direccion-calidad-enfoque-pmi',
            'title' => 'Dirección de la Calidad con el Enfoque PMI® para la Construcción',
            'url'   => '/direccion-calidad-enfoque-pmi',
        ],
        'fidic' => [
            'slug'  => 'fidic',
            'title' => 'Contratos FIDIC en Infraestructura y Construcción',
            'url'   => '/fidic',
        ],
        'control-de-calidad-en-tuneleria' => [
            'slug'  => 'control-de-calidad-en-tuneleria',
            'title' => 'Control de Calidad en Tunelería',
            'url'   => '/control-de-calidad-en-tuneleria',
        ],
        'gerencia-de-calidad' => [
            'slug'  => 'gerencia-de-calidad',
            'title' => 'Gerencia de la Calidad en Construcción',
            'url'   => '/gerencia-de-calidad',
        ],
        'herramientas' => [
            'slug'  => 'herramientas',
            'title' => 'Taller de Herramientas de Gestión de Calidad en la Construcción',
            'url'   => '/herramientas',
        ],
        'indicadores-de-calidad' => [
            'slug'  => 'indicadores-de-calidad',
            'title' => 'Seminario Indicadores Avanzados de Calidad en la Construcción',
            'url'   => '/indicadores-de-calidad',
        ],
        'iso-9001' => [
            'slug'  => 'iso-9001',
            'title' => 'Interpretación e Implementación de la Norma ISO 9001:2015',
            'url'   => '/iso-9001',
        ],
        'seminario-iso-9001-2026' => [
            'slug'  => 'seminario-iso-9001-2026',
            'title' => 'Seminario ISO 9001:2026',
            'url'   => '/seminario-iso-9001-2026',
        ],
        'sindrome-del-90' => [
            'slug'  => 'sindrome-del-90',
            'title' => 'Seminario Completion - Evita el Síndrome del 90%',
            'url'   => '/sindrome-del-90',
        ],
        'lean-last-planner' => [
            'slug'  => 'lean-last-planner',
            'title' => 'Lean Construction y Sistema Last Planner',
            'url'   => '/lean-last-planner',
        ],
        'nec' => [
            'slug'  => 'nec',
            'title' => 'Contratos NEC3 y NEC4 en Infraestructura',
            'url'   => '/nec',
        ],
        'oficina-tecnica' => [
            'slug'  => 'oficina-tecnica',
            'title' => 'Gestión Integral de Oficina Técnica en Obras',
            'url'   => '/oficina-tecnica',
        ],
        'pmo' => [
            'slug'  => 'pmo',
            'title' => 'Gestión e Implementación de PMO en Construcción',
            'url'   => '/pmo',
        ],
        'proyectos-pmi' => [
            'slug'  => 'proyectos-pmi',
            'title' => 'Gestión de Proyectos bajo el Enfoque PMI / PMBOK',
            'url'   => '/proyectos-pmi',
        ],
        'gestion-de-riesgos' => [
            'slug'  => 'gestion-de-riesgos',
            'title' => 'Gestión de Riesgos, Cambios y Reclamos en la Construcción',
            'url'   => '/gestion-de-riesgos',
        ],
        'riesgos-cadena-produccion' => [
            'slug'  => 'riesgos-cadena-produccion',
            'title' => 'Riesgos en la Cadena de Producción de la Construcción ISO 31000 usando BIM',
            'url'   => '/riesgos-cadena-produccion',
        ],
        'analisis-cuantitativo-riesgos' => [
            'slug'  => 'analisis-cuantitativo-riesgos',
            'title' => 'Análisis Cuantitativo de Riesgos del Costo y Cronograma con Simulación de Monte Carlo',
            'url'   => '/analisis-cuantitativo-riesgos',
        ],
        'riesgos-pmi' => [
            'slug'  => 'riesgos-pmi',
            'title' => 'Gestión de Riesgos en Proyectos con el Enfoque PMI®',
            'url'   => '/riesgos-pmi',
        ],
        'riesgos-tecnicos' => [
            'slug'  => 'riesgos-tecnicos',
            'title' => 'Gestión de Riesgos Técnicos en la Construcción',
            'url'   => '/riesgos-tecnicos',
        ],
        'valor-ganado' => [
            'slug'  => 'valor-ganado',
            'title' => 'Gestión del Valor Ganado (EVM) en Construcción',
            'url'   => '/valor-ganado',
        ],
    ];

    /**
     * Retorna todos los cursos catalogados.
     */
    public static function all(): array
    {
        return self::$courses;
    }

    /**
     * Busca un curso por su identificador slug.
     */
    public static function find(string $slug): ?array
    {
        $normalized = trim(strtolower($slug));
        return self::$courses[$normalized] ?? null;
    }

    /**
     * Verifica si un slug de curso es válido.
     */
    public static function isValid(string $slug): bool
    {
        $normalized = trim(strtolower($slug));
        return isset(self::$courses[$normalized]);
    }

    /**
     * Retorna el título descriptivo oficial de un curso o un fallback seguro.
     */
    public static function getTitle(string $slug): string
    {
        $normalized = trim(strtolower($slug));
        return self::$courses[$normalized]['title'] ?? 'Curso Especializado de Construcción';
    }
}

