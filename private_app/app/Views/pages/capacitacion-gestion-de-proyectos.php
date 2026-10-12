<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Categoría: Gestión de Proyectos
 * Archivo: app/Views/pages/capacitacion-gestion-de-proyectos.php
 */

declare(strict_types=1);

$category = $category ?? \App\Services\CoursesCatalog::getCategoryData('gestion-de-proyectos');
require dirname(__DIR__) . '/partials/category_page_content.php';

