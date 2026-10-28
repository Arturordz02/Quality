<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Componente Parcial: Barra de Navegación Principal (app/Views/partials/navbar.php)
 *
 * Contiene el menú responsive de Bootstrap 5 y enlaces a secciones y servicios.
 */

declare(strict_types=1);

$currentPage = $pageName ?? $activePage ?? '';

// Categorías oficiales de Capacitación
$capacitacionCategories = [
    'capacitacion',
    'capacitacion-calidad',
    'capacitacion-riesgos',
    'capacitacion-contratos',
    'capacitacion-gestion-de-proyectos',
    'capacitacion-oficina-tecnica',
];

// Comprobar si la página actual pertenece a Capacitación (hub, categorías o cursos)
$isCapacitacionActive = in_array($activePage, ['capacitacion'], true) ||
    in_array($currentPage, $capacitacionCategories, true) ||
    str_starts_with($currentPage, 'capacitacion-');

// Asegurar que páginas independientes no marquen activo el desplegable de Capacitación
if (in_array($currentPage, ['consultoria', 'investigacion', 'encuestas-proyectos', 'noticias', 'in-house', 'clientes', 'medios', 'contacto', 'nosotros', 'press', 'libro-de-reclamaciones', 'terminos-y-condiciones', '404'], true)) {
    $isCapacitacionActive = false;
}

// Comprobar si la página actual pertenece al menú MÁS
$isMasActive = in_array($currentPage, [
    'consultoria',
    'investigacion',
    'encuestas-proyectos',
    'noticias',
], true);
?>
<!-- Barra de Navegación Principal Horizontal con Bootstrap 5 -->
<nav class="navbar navbar-expand-lg main-navbar p-0" id="mainNavbar" aria-label="Navegación principal">
    <div class="header-container nav-container w-100">
        <div class="collapse navbar-collapse justify-content-center" id="navbarQuality">
            <ul class="navbar-nav nav-menu" id="navMenu">

                <!-- 1. NOSOTROS -->
                <li class="nav-item">
                    <a href="/nosotros" class="nav-link<?= $currentPage === 'nosotros' ? ' active' : '' ?>"<?= $currentPage === 'nosotros' ? ' aria-current="page"' : '' ?>>NOSOTROS</a>
                </li>

                <!-- 2. IN-HOUSE -->
                <li class="nav-item">
                    <a href="/in-house" class="nav-link<?= $currentPage === 'in-house' ? ' active' : '' ?>"<?= $currentPage === 'in-house' ? ' aria-current="page"' : '' ?>>IN-HOUSE</a>
                </li>

                <!-- 3. CAPACITACIÓN (Desplegable) -->
                <li class="nav-item dropdown">
                    <a href="/capacitacion" class="nav-link dropdown-toggle<?= $isCapacitacionActive ? ' active' : '' ?>" id="dropdownCapacitacion" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" aria-haspopup="true">
                        CAPACITACIÓN <i class="fa-solid fa-chevron-down arrow-icon" aria-hidden="true"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownCapacitacion">
                        <li><a href="/capacitacion" class="dropdown-item<?= $currentPage === 'capacitacion' ? ' active' : '' ?>"<?= $currentPage === 'capacitacion' ? ' aria-current="page"' : '' ?>>Ver catálogo de cursos</a></li>
                        <li><a href="/capacitacion-calidad" class="dropdown-item<?= $currentPage === 'capacitacion-calidad' ? ' active' : '' ?>"<?= $currentPage === 'capacitacion-calidad' ? ' aria-current="page"' : '' ?>>Calidad</a></li>
                        <li><a href="/capacitacion-riesgos" class="dropdown-item<?= $currentPage === 'capacitacion-riesgos' ? ' active' : '' ?>"<?= $currentPage === 'capacitacion-riesgos' ? ' aria-current="page"' : '' ?>>Riesgos</a></li>
                        <li><a href="/capacitacion-contratos" class="dropdown-item<?= $currentPage === 'capacitacion-contratos' ? ' active' : '' ?>"<?= $currentPage === 'capacitacion-contratos' ? ' aria-current="page"' : '' ?>>Gestión de Contratos</a></li>
                        <li><a href="/capacitacion-gestion-de-proyectos" class="dropdown-item<?= $currentPage === 'capacitacion-gestion-de-proyectos' ? ' active' : '' ?>"<?= $currentPage === 'capacitacion-gestion-de-proyectos' ? ' aria-current="page"' : '' ?>>Gestión de Proyectos</a></li>
                        <li><a href="/capacitacion-oficina-tecnica" class="dropdown-item<?= $currentPage === 'capacitacion-oficina-tecnica' ? ' active' : '' ?>"<?= $currentPage === 'capacitacion-oficina-tecnica' ? ' aria-current="page"' : '' ?>>Oficina Técnica</a></li>
                    </ul>
                </li>

                <!-- 4. CLIENTES -->
                <li class="nav-item">
                    <a href="/clientes" class="nav-link<?= $currentPage === 'clientes' ? ' active' : '' ?>"<?= $currentPage === 'clientes' ? ' aria-current="page"' : '' ?>>CLIENTES</a>
                </li>

                <!-- 5. MEDIOS Y PODCASTS -->
                <li class="nav-item">
                    <a href="/medios" class="nav-link<?= $currentPage === 'medios' ? ' active' : '' ?>"<?= $currentPage === 'medios' ? ' aria-current="page"' : '' ?>>MEDIOS Y PODCASTS</a>
                </li>

                <!-- 6. CONTACTO -->
                <li class="nav-item">
                    <a href="/contacto" class="nav-link<?= $currentPage === 'contacto' ? ' active' : '' ?>"<?= $currentPage === 'contacto' ? ' aria-current="page"' : '' ?>>CONTACTO</a>
                </li>

                <!-- 7. MÁS (Desplegable) -->
                <li class="nav-item dropdown dropdown-more">
                    <a href="javascript:void(0)" class="nav-link dropdown-toggle<?= $isMasActive ? ' active' : '' ?>" id="dropdownMas" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" aria-haspopup="true">
                        MÁS <i class="fa-solid fa-chevron-down arrow-icon" aria-hidden="true"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMas">
                        <li><a href="/consultoria" class="dropdown-item<?= $currentPage === 'consultoria' ? ' active' : '' ?>"<?= $currentPage === 'consultoria' ? ' aria-current="page"' : '' ?>>Consultoría</a></li>
                        <li><a href="/investigacion" class="dropdown-item<?= $currentPage === 'investigacion' ? ' active' : '' ?>"<?= $currentPage === 'investigacion' ? ' aria-current="page"' : '' ?>>Investigación</a></li>
                        <li><a href="/encuestas-proyectos" class="dropdown-item<?= $currentPage === 'encuestas-proyectos' ? ' active' : '' ?>"<?= $currentPage === 'encuestas-proyectos' ? ' aria-current="page"' : '' ?>>Encuestas de Proyectos</a></li>
                        <li><a href="/noticias" class="dropdown-item<?= $currentPage === 'noticias' ? ' active' : '' ?>"<?= $currentPage === 'noticias' ? ' aria-current="page"' : '' ?>>Noticias</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>

<!-- Overlay móvil -->
<div class="mobile-overlay" id="mobileOverlay"></div>
