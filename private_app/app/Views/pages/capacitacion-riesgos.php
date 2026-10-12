<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Categoría: Gestión de Riesgos
 * Archivo: app/Views/pages/capacitacion-riesgos.php
 */

declare(strict_types=1);

$category = $category ?? \App\Services\CoursesCatalog::getCategoryData('riesgos');
require dirname(__DIR__) . '/partials/category_page_content.php';

