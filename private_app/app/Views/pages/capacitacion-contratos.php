<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Categoría: Contratos y Gestión Contractual
 * Archivo: app/Views/pages/capacitacion-contratos.php
 */

declare(strict_types=1);

$category = $category ?? \App\Services\CoursesCatalog::getCategoryData('contratos');
require dirname(__DIR__) . '/partials/category_page_content.php';

