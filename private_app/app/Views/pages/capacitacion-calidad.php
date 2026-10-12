<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Categoría: Gestión de la Calidad
 * Archivo: app/Views/pages/capacitacion-calidad.php
 */

declare(strict_types=1);

$category = $category ?? \App\Services\CoursesCatalog::getCategoryData('calidad');
require dirname(__DIR__) . '/partials/category_page_content.php';

