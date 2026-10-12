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
        'fidic' => [
            'slug'  => 'fidic',
            'title' => 'Contratos FIDIC en Infraestructura y Construcción',
            'url'   => '/fidic',
        ],
        'gerencia-de-calidad' => [
            'slug'  => 'gerencia-de-calidad',
            'title' => 'Gerencia de la Calidad en Construcción',
            'url'   => '/gerencia-de-calidad',
        ],
        'herramientas' => [
            'slug'  => 'herramientas',
            'title' => 'Herramientas de Calidad en Construcción',
            'url'   => '/herramientas',
        ],
        'iso-9001' => [
            'slug'  => 'iso-9001',
            'title' => 'Interpretación e Implementación de la Norma ISO 9001:2015',
            'url'   => '/iso-9001',
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
        'riesgos-cadena-produccion' => [
            'slug'  => 'riesgos-cadena-produccion',
            'title' => 'Gestión de Riesgos en la Cadena de Producción',
            'url'   => '/riesgos-cadena-produccion',
        ],
        'riesgos-pmi' => [
            'slug'  => 'riesgos-pmi',
            'title' => 'Gestión de Riesgos bajo Estándares PMI',
            'url'   => '/riesgos-pmi',
        ],
        'riesgos-tecnicos' => [
            'slug'  => 'riesgos-tecnicos',
            'title' => 'Gestión de Riesgos Técnicos en Obras',
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
