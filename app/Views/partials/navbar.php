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

                <!-- ASESORÍA (Desplegable) -->
                <li class="nav-item dropdown">
                    <a href="/consultoria" class="nav-link dropdown-toggle<?= $activePage === 'consultoria' ? ' active' : '' ?>" id="dropdownConsultoria" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        ASESORÍA <i class="fa-solid fa-chevron-down arrow-icon"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownConsultoria">
                        <li><a href="/gestion-de-pmo" class="dropdown-item">GESTION DE PMO</a></li>
                        <li><a href="/headhunting" class="dropdown-item">HEADHUNTING</a></li>
                        <li><a href="/gestion-de-riesgos" class="dropdown-item">GESTION DE RIESGOS</a></li>
                        <li><a href="/riesgo-del-plazo" class="dropdown-item">RIESGO DEL PLAZO</a></li>
                        <li><a href="/lego-serious-play" class="dropdown-item">LEGO SERIOUS PLAY</a></li>
                        <li><a href="/cronograma-forense" class="dropdown-item">CRONOGRAMA-FORENSE</a></li>
                        <li><a href="/homologaciones" class="dropdown-item">HOMOLOGACIONES</a></li>
                        <li><a href="/gestion-de-la-calidad" class="dropdown-item">GESTION DE LA CALIDAD</a></li>
                        <li><a href="/permisologia" class="dropdown-item">PERMISOLOGIA</a></li>
                        <li><a href="/universidad-corporativa" class="dropdown-item">UNIVERSIDAD CORPORATIVA</a></li>
                    </ul>
                </li>

                <!-- CAPACITACION (Desplegable Extenso) -->
                <li class="nav-item dropdown dropdown-large">
                    <a href="/capacitacion" class="nav-link dropdown-toggle<?= $activePage === 'capacitacion' ? ' active' : '' ?>" id="dropdownCapacitacion" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        CAPACITACION <i class="fa-solid fa-chevron-down arrow-icon"></i>
                    </a>
                    <ul class="dropdown-menu scrollable-menu" aria-labelledby="dropdownCapacitacion">
                        <li><a href="/lean-last-planner" class="dropdown-item">LEAN-LAST-PLANNER</a></li>
                        <li><a href="/riesgos-tecnicos" class="dropdown-item">RIESGOS TECNICOS</a></li>
                        <li><a href="/riesgos-pmi" class="dropdown-item">RIESGOS PMI</a></li>
                        <li><a href="/riesgos-cadena-produccion" class="dropdown-item">RIESGOS CADENA PRODUCCION</a></li>
                        <li><a href="/calidad-y-pmi" class="dropdown-item">CALIDAD Y PMI</a></li>
                        <li><a href="/costos" class="dropdown-item">COSTOS</a></li>
                        <li><a href="/nec" class="dropdown-item">NEC</a></li>
                        <li><a href="/fidic" class="dropdown-item">FIDIC</a></li>
                        <li><a href="/pmo" class="dropdown-item">PMO</a></li>
                        <li><a href="/gerencia-de-calidad" class="dropdown-item">GERENCIA DE CALIDAD</a></li>
                        <li><a href="/valor-ganado" class="dropdown-item">VALOR GANADO</a></li>
                        <li><a href="/bim-revit-architecture" class="dropdown-item">BIM REVIT ARCHITECTURE</a></li>
                        <li><a href="/iso-9001" class="dropdown-item">ISO 9001</a></li>
                        <li><a href="/oficina-tecnica" class="dropdown-item">OFICINA-TECNICA</a></li>
                        <li><a href="/herramientas" class="dropdown-item">HERRAMIENTAS</a></li>
                        <li><a href="/proyectos-pmi" class="dropdown-item">PROYECTOS PMI</a></li>
                        <li><a href="/contratos" class="dropdown-item">CONTRATOS</a></li>
                        <li><a href="/contratos-estado" class="dropdown-item">CONTRATOS-ESTADO</a></li>
                        <li><a href="/gruas-torre" class="dropdown-item">GRUAS TORRE</a></li>
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

