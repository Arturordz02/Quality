<?php
/**
 * QUALITY CONSULTING SOLUTIONS
 * Rendimiento: Paginador Obligatorio y Protección Anti-DoS
 * Evita la sobrecarga de memoria limitando el tamaño máximo de página.
 */

declare(strict_types=1);

if (!defined('QCS_BACKEND_ACCESS')) {
    define('QCS_BACKEND_ACCESS', true);
}

class Paginator {
    public const DEFAULT_PER_PAGE = 15;
    public const MAX_PER_PAGE = 50;

    /**
     * Sanitiza y normaliza los parámetros de paginación desde una petición
     *
     * @param array $queryParams Datos de $_GET
     * @param int $defaultPerPage Registros por página por defecto
     * @param int $maxPerPage Límite absoluto por página para prevenir DoS
     * @return array [page => int, per_page => int, offset => int]
     */
    public static function extractParams(array $queryParams, int $defaultPerPage = self::DEFAULT_PER_PAGE, int $maxPerPage = self::MAX_PER_PAGE): array {
        $page = isset($queryParams['page']) ? (int)$queryParams['page'] : 1;
        if ($page < 1) {
            $page = 1;
        }

        $perPage = isset($queryParams['limit']) ? (int)$queryParams['limit'] : (isset($queryParams['per_page']) ? (int)$queryParams['per_page'] : $defaultPerPage);
        if ($perPage < 1) {
            $perPage = $defaultPerPage;
        } elseif ($perPage > $maxPerPage) {
            $perPage = $maxPerPage;
        }

        $offset = ($page - 1) * $perPage;

        return [
            'page'     => $page,
            'per_page' => $perPage,
            'offset'   => $offset,
        ];
    }

    /**
     * Construye la respuesta estructurada con metadatos de paginación
     */
    public static function formatResponse(array $items, int $totalItems, int $page, int $perPage): array {
        $totalPages = $totalItems > 0 ? (int)ceil($totalItems / $perPage) : 1;

        return [
            'data' => $items,
            'pagination' => [
                'current_page' => $page,
                'per_page'     => $perPage,
                'total_items'  => $totalItems,
                'total_pages'  => $totalPages,
                'has_next'     => $page < $totalPages,
                'has_prev'     => $page > 1,
            ],
        ];
    }
}

