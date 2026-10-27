<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Componente Parcial: Barra de Navegación Principal (app/Views/partials/navbar.php)
 *
 * Contiene el menú responsive de Bootstrap 5 y enlaces a secciones y servicios.
 */

declare(strict_types=1);

$activePage = $activePage ?? '';
?>
<!-- Barra de Navegación Principal Horizontal con Bootstrap 5 -->
<nav class="navbar navbar-expand-lg main-navbar p-0" id="mainNavbar" aria-label="Navegación principal">
    <div class="header-container nav-container w-100">
        <div class="collapse navbar-collapse justify-content-center" id="navbarQuality">
            <ul class="navbar-nav nav-menu" id="navMenu">

                <!-- HOME -->
                <li class="nav-item">
                    <a href="/" class="nav-link<?= $activePage === 'home' ? ' active' : '' ?>">HOME</a>
                </li>

                <!-- NOSOTROS -->
                <li class="nav-item">
                    <a href="/nosotros" class="nav-link<?= $activePage === 'nosotros' ? ' active' : '' ?>">NOSOTROS</a>
                </li>

<!-- IN-HOUSE -->
<li class="nav-item">
    <a href="/in-house" class="nav-link<?= $activePage === 'in-house' ? ' active' : '' ?>">IN-HOUSE</a>
</li>
                <!-- CAPACITACION (Desplegable) -->
                <li class="nav-item dropdown">
                    <a href="/capacitacion" class="nav-link dropdown-toggle<?= $activePage === 'capacitacion' ? ' active' : '' ?>" id="dropdownCapacitacion" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        CAPACITACION <i class="fa-solid fa-chevron-down arrow-icon"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownCapacitacion">
                        <li><a href="/capacitacion" class="dropdown-item">Ver catálogo de cursos</a></li>
                        <li><a href="/capacitacion-calidad" class="dropdown-item">Calidad</a></li>
                        <li><a href="/capacitacion-riesgos" class="dropdown-item">Riesgos</a></li>
                        <li><a href="/capacitacion-contratos" class="dropdown-item">Contratos</a></li>
                        <li><a href="/capacitacion-gestion-de-proyectos" class="dropdown-item">Gestión de Proyectos</a></li>
                        <li><a href="/capacitacion-oficina-tecnica" class="dropdown-item">Oficina Técnica</a></li>
                    </ul>
                </li>

                <!-- PRESS -->
                <li class="nav-item">
                    <a href="/press" class="nav-link<?= $activePage === 'press' ? ' active' : '' ?>">PRESS</a>
                </li>

                <!-- MEDIOS -->
                <li class="nav-item">
                    <a href="/medios" class="nav-link<?= $activePage === 'medios' ? ' active' : '' ?>">MEDIOS</a>
                </li>

                <!-- CLIENTES -->
                <li class="nav-item">
                    <a href="/clientes" class="nav-link<?= $activePage === 'clientes' ? ' active' : '' ?>">CLIENTES</a>
                </li>

                <!-- MÁS... -->
                <li class="nav-item dropdown dropdown-more">
                    <a href="javascript:void(0)" class="nav-link dropdown-toggle<?= in_array($activePage, ['investigacion', 'contacto', 'noticias', 'legal']) ? ' active' : '' ?>" id="dropdownMas" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        MÁS... <i class="fa-solid fa-chevron-down arrow-icon"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMas">
                        <li class="dropdown-submenu">
                            <a href="/investigacion" class="dropdown-item submenu-toggle<?= $activePage === 'investigacion' ? ' active' : '' ?>">
                                <span>INVESTIGACION</span>
                                <i class="fa-solid fa-chevron-right submenu-arrow"></i>
                            </a>
                            <ul class="dropdown-menu-lateral">
                                <li><a href="/encuestas-proyectos" class="dropdown-item">Encuestas-Proyectos</a></li>
                            </ul>
                        </li>
                        <li><a href="/contacto" class="dropdown-item<?= $activePage === 'contacto' ? ' active' : '' ?>">CONTACTO</a></li>
                        <li><a href="/noticias" class="dropdown-item<?= $activePage === 'noticias' ? ' active' : '' ?>">NOTICIAS</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>

<!-- Overlay móvil -->
<div class="mobile-overlay" id="mobileOverlay"></div>
