<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Layout Maestro (app/Views/layouts/main.php)
 *
 * Estructura HTML5 base que envuelve las páginas del sitio.
 * Integra encabezado, navegación, pie de página corporativo, dependencias CSS y scripts.
 */

declare(strict_types=1);

$pageTitle = $title ?? 'Quality Consulting Solutions | Ingeniería, PMO y Calidad';
$description = $metaDescription ?? 'Soluciones integrales en ingeniería, gestión de proyectos, PMO, homologación de proveedores y capacitación corporativa especializada.';
$canonicalUrl = $canonical ?? '';
$activePage = $activePage ?? '';
$showFloat = $showWhatsAppFloat ?? true;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <meta name="description" content="<?= htmlspecialchars($description, ENT_QUOTES, 'UTF-8') ?>">
    <?php if (!empty($canonicalUrl)): ?>
    <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8') ?>">
    <?php endif; ?>
    <?php if (!empty($robots)): ?>
    <meta name="robots" content="<?= htmlspecialchars($robots, ENT_QUOTES, 'UTF-8') ?>">
    <?php endif; ?>

    <!-- Favicon Oficial -->
    <link rel="icon" type="image/png" href="img/Logo.png">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link rel="apple-touch-icon" href="img/Logo.png">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Animate.css (Efectos principales de entrada) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <!-- AOS (Animate On Scroll) -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">
    
    <!-- Hoja de estilos principal del sitio -->
    <link rel="stylesheet" href="styles.css?v=3.2">

    <!-- Estilos específicos de cada vista si se requieren -->
    <?= $extraStyles ?? '' ?>
</head>
<body>

    <!-- Encabezado Principal y Menú de Navegación -->
    <header class="main-header" id="mainHeader">
        <?= $this->partial('header', $headerData ?? []) ?>
        <?php if (empty($hideNavbar)): ?>
        <?= $this->partial('navbar', ['activePage' => $activePage]) ?>
        <?php endif; ?>
    </header>

    <!-- Contenido Dinámico de la Vista -->
    <?= $content ?>

    <!-- Pie de Página Corporativo -->
    <?= $this->partial('footer') ?>

    <!-- Widget Flotante de WhatsApp -->
    <?php if ($showFloat): ?>
        <?= $this->partial('whatsapp_float') ?>
    <?php endif; ?>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script Principal del sitio -->
    <script src="script.js?v=3.2"></script>

    <!-- AOS init -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    once: true,
                    offset: 100
                });
            }
        });
    </script>

    <!-- Scripts adicionales inyectados por la vista -->
    <?= $extraScripts ?? '' ?>
</body>
</html>

