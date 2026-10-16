<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Categoría: Oficina Técnica
 * Archivo: app/Views/pages/capacitacion-oficina-tecnica.php
 */

declare(strict_types=1);

$category = $category ?? \App\Services\CoursesCatalog::getCategoryData('oficina-tecnica');
require dirname(__DIR__) . '/partials/category_page_content.php';

