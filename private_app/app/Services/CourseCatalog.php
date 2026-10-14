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
        'contrato-colaborativo-nec-3-4' => [
            'slug'  => 'contrato-colaborativo-nec-3-4',
            'title' => 'Contrato Colaborativo NEC 3/4',
            'url'   => '/contrato-colaborativo-nec-3-4',
        ],
        'contrato-nec4' => [
            'slug'  => 'contrato-nec4',
            'title' => 'El Contrato de NEC4',
            'url'   => '/contrato-nec4',
        ],
        'contratos' => [
            'slug'  => 'contratos',
            'title' => 'Administración de Contratos de Construcción',
            'url'   => '/contratos',
        ],
        'contratos-fidic-epc-construccion' => [
            'slug'  => 'contratos-fidic-epc-construccion',
            'title' => 'Contratos FIDIC para Contratos EPC y Construcción',
            'url'   => '/contratos-fidic-epc-construccion',
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
        'eventos-compensables-alertas-tempranas-nec4' => [
            'slug'  => 'eventos-compensables-alertas-tempranas-nec4',
            'title' => 'Gestión de Eventos Compensables y Alertas Tempranas en Contratos NEC4',
            'url'   => '/eventos-compensables-alertas-tempranas-nec4',
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
        'gestion-cambios-contratos-estado' => [
            'slug'  => 'gestion-cambios-contratos-estado',
            'title' => 'Gestión del Cambio en los Contratos con el Estado',
            'url'   => '/gestion-cambios-contratos-estado',
        ],
        'gestion-contractual-megaproyectos-mineros' => [
            'slug'  => 'gestion-contractual-megaproyectos-mineros',
            'title' => 'Gestión Contractual en los Megaproyectos de Construcción Mineros',
            'url'   => '/gestion-contractual-megaproyectos-mineros',
        ],
        'gestion-reclamos-nec-fidic' => [
            'slug'  => 'gestion-reclamos-nec-fidic',
            'title' => 'Gestión de Reclamos en Contratos de Construcción y Contratos Colaborativos NEC y FIDIC',
            'url'   => '/gestion-reclamos-nec-fidic',
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
        'seminario-diagrama-ishikawa' => [
            'slug'  => 'seminario-diagrama-ishikawa',
            'title' => 'Casos de Aplicación del Diagrama de Ishikawa',
            'url'   => '/seminario-diagrama-ishikawa',
        ],
        'junta-resolucion-disputas-dab' => [
            'slug'  => 'junta-resolucion-disputas-dab',
            'title' => 'Claves para el Éxito en la Junta de Resolución de Disputas - JRD (DAB) de Obras',
            'url'   => '/junta-resolucion-disputas-dab',
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
        'oficina-tecnica-obras-viales' => [
            'slug'  => 'oficina-tecnica-obras-viales',
            'title' => 'Oficina Técnica en Obras Viales',
            'url'   => '/oficina-tecnica-obras-viales',
        ],
        'oficina-tecnica-hospitales-edificaciones' => [
            'slug'  => 'oficina-tecnica-hospitales-edificaciones',
            'title' => 'Oficina Técnica en Edificaciones y Hospitales',
            'url'   => '/oficina-tecnica-hospitales-edificaciones',
        ],
        'oficina-tecnica-infraestructura-minera' => [
            'slug'  => 'oficina-tecnica-infraestructura-minera',
            'title' => 'Oficina Técnica en Infraestructura Minera (PADs, Presas de Relave, Geosintéticos)',
            'url'   => '/oficina-tecnica-infraestructura-minera',
        ],
        'oficina-tecnica-edificaciones-panel-control' => [
            'slug'  => 'oficina-tecnica-edificaciones-panel-control',
            'title' => 'Oficina Técnica en Edificaciones + Panel de Control 100% Real Time',
            'url'   => '/oficina-tecnica-edificaciones-panel-control',
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

