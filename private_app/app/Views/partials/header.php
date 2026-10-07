<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Componente Parcial: Encabezado Superior (app/Views/partials/header.php)
 *
 * Contiene el logo oficial, título institucional centrado, redes sociales y botón móvil.
 */

declare(strict_types=1);
?>
<div class="header-top">
    <div class="header-container top-container">
        
        <!-- Logo a la izquierda -->
        <div class="header-logo">
            <a href="/" class="logo-link" aria-label="Quality Consulting Solutions Inicio">
                <div class="logo-badge d-flex align-items-center">
                    <picture>
                        <source srcset="img/Logo.webp" type="image/webp">
                        <img src="img/Logo.png" alt="Quality Consulting Solutions Logo" width="44" height="44" class="d-inline-block align-text-top rounded-2 me-2 brand-logo animate__animated animate__bounceIn" style="object-fit: cover; width: 44px; height: 44px;">
                    </picture>
                    <div class="logo-text-wrap">
                        <span class="logo-title">QUALITY CONSULTING</span>
                        <span class="logo-sub">SOLUTIONS</span>
                    </div>
                </div>
            </a>
        </div>

        <!-- Título Centrado -->
        <div class="header-center-title">
            <h1 class="animate__animated animate__fadeInDown">QUALITY CONSULTING SOLUTIONS</h1>
            <p class="tagline animate__animated animate__fadeInUp animate__delay-1s">Ingeniería • Gestión de Proyectos • Capacitación • Calidad</p>
        </div>

        <!-- Redes Sociales a la derecha & Botón Móvil -->
        <div class="header-actions">
            <div class="social-networks" aria-label="Redes Sociales">
                <a href="https://pe.linkedin.com/in/omarsamaniego" target="_blank" rel="noopener noreferrer" class="social-btn linkedin" aria-label="LinkedIn">
                    <i class="fa-brands fa-linkedin-in"></i>
                </a>
                <a href="https://www.facebook.com/qaqcconsulting" target="_blank" rel="noopener noreferrer" class="social-btn facebook" aria-label="Facebook">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
                <a href="https://www.youtube.com/channel/UCbCdXwbcl-uouYa6Y4_kY0A?view_as=subscriber" target="_blank" rel="noopener noreferrer" class="social-btn youtube" aria-label="YouTube">
                    <i class="fa-brands fa-youtube"></i>
                </a>
                <a href="https://wa.me/51993463118" target="_blank" rel="noopener noreferrer" class="social-btn whatsapp animate__animated animate__pulse animate__infinite" aria-label="WhatsApp">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
            </div>

            <!-- Botón Hamburguesa Nativo Bootstrap 5 para Mobile -->
            <button class="navbar-toggler mobile-toggle-btn" id="mobileToggleBtn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarQuality" aria-controls="navbarQuality" aria-expanded="false" aria-label="Abrir menú de navegación">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>

    </div>
</div>

