<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Componente Parcial: Breadcrumbs Globales y Dinámicos
 * Archivo: app/Views/partials/breadcrumbs.php
 *
 * Responsabilidad:
 * - Renderizar la ruta semántica y accesible de navegación horizontal.
 * - Separadores tipo '›' y estado activo en la página actual.
 * - Integrado una sola vez desde app/Views/layouts/main.php.
 */

declare(strict_types=1);

if (!class_exists(\App\Services\BreadcrumbsService::class, false)) {
    require_once dirname(__DIR__, 2) . '/Services/BreadcrumbsService.php';
}

use App\Services\BreadcrumbsService;

// Obtener todas las variables del scope de la vista
$context = get_defined_vars();
$items = BreadcrumbsService::getBreadcrumbs($context);

if (empty($items)) {
    return;
}

$isStatic = !empty($staticBuild);
?>
<!-- Migas de Pan (Breadcrumbs) Globales y Dinámicas -->
<nav aria-label="Ruta de navegación" class="qcs-breadcrumbs-nav">
    <div class="header-container qcs-breadcrumbs-container">
        <ol class="breadcrumb qcs-breadcrumb mb-0">
            <?php foreach ($items as $item): ?>
                <?php if (!empty($item['url'])): ?>
                    <li class="breadcrumb-item">
                        <a href="<?= htmlspecialchars(BreadcrumbsService::formatUrl($item['url'], $isStatic), ENT_QUOTES, 'UTF-8') ?>" class="qcs-breadcrumb-link"><?= htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') ?></a>
                    </li>
                <?php else: ?>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span class="qcs-breadcrumb-current"><?= htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') ?></span>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ol>
    </div>
</nav>
