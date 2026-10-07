<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Componente Parcial: Widget Flotante de WhatsApp Multipaís (app/Views/partials/whatsapp_float.php)
 *
 * Menú de atención internacional rápida con números directos por país.
 */
declare(strict_types=1);
?>
<!-- Selector Flotante Multipaís de WhatsApp -->
<div class="whatsapp-floating-widget" id="whatsappFloatingWidget">
    <div class="whatsapp-floating-menu" id="whatsappFloatingMenu" aria-hidden="true">
        <div class="whatsapp-menu-header">
            <div class="d-flex align-items-center justify-content-between mb-1">
                <div class="d-flex align-items-center gap-2">
                    <i class="fab fa-whatsapp fs-5 text-white"></i>
                    <span class="fw-bold text-white font-montserrat" style="font-size: 0.95rem;">Atención WhatsApp</span>
                </div>
                <button class="whatsapp-close-btn" id="whatsappCloseBtn" aria-label="Cerrar ventana de WhatsApp">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <span class="small text-light text-opacity-75" style="font-size: 0.78rem;">Selecciona tu país de contacto:</span>
        </div>
        <div class="whatsapp-menu-body">
            <!-- Perú -->
            <a href="https://api.whatsapp.com/send?phone=51993463118&text=Buen%20d%C3%ADa%20Quality%20Consulting%20Solutions,%20deseo%20informaci%C3%B3n%20de%20sus%20servicios/cursos" target="_blank" rel="noopener noreferrer" class="whatsapp-country-item">
                <span class="country-flag">🇵🇪</span>
                <div class="country-info">
                    <span class="country-name">Perú (Central)</span>
                    <span class="country-phone">+51 993 463 118</span>
                </div>
                <i class="fas fa-chevron-right arrow-go"></i>
            </a>
            <!-- Chile -->
            <a href="https://api.whatsapp.com/send?phone=56990760986&text=Buen%20d%C3%ADa%20Quality%20Consulting%20Solutions,%20deseo%20informaci%C3%B3n%20de%20sus%20servicios/cursos" target="_blank" rel="noopener noreferrer" class="whatsapp-country-item">
                <span class="country-flag">🇨🇱</span>
                <div class="country-info">
                    <span class="country-name">Chile</span>
                    <span class="country-phone">+56 9 9076 0986</span>
                </div>
                <i class="fas fa-chevron-right arrow-go"></i>
            </a>
            <!-- Ecuador -->
            <a href="https://api.whatsapp.com/send?phone=573152276029&text=Buen%20d%C3%ADa%20Quality%20Consulting%20Solutions,%20deseo%20informaci%C3%B3n%20de%20sus%20servicios/cursos" target="_blank" rel="noopener noreferrer" class="whatsapp-country-item">
                <span class="country-flag">🇪🇨</span>
                <div class="country-info">
                    <span class="country-name">Ecuador</span>
                    <span class="country-phone">+57 315 227 6029</span>
                </div>
                <i class="fas fa-chevron-right arrow-go"></i>
            </a>
            <!-- Panamá -->
            <a href="https://api.whatsapp.com/send?phone=50768195911&text=Buen%20d%C3%ADa%20Quality%20Consulting%20Solutions,%20deseo%20informaci%C3%B3n%20de%20sus%20servicios/cursos" target="_blank" rel="noopener noreferrer" class="whatsapp-country-item">
                <span class="country-flag">🇵🇦</span>
                <div class="country-info">
                    <span class="country-name">Panamá</span>
                    <span class="country-phone">+507 6819 5911</span>
                </div>
                <i class="fas fa-chevron-right arrow-go"></i>
            </a>
            <!-- México -->
            <a href="https://api.whatsapp.com/send?phone=525537208429&text=Buen%20d%C3%ADa%20Quality%20Consulting%20Solutions,%20deseo%20informaci%C3%B3n%20de%20sus%20servicios/cursos" target="_blank" rel="noopener noreferrer" class="whatsapp-country-item">
                <span class="country-flag">🇲🇽</span>
                <div class="country-info">
                    <span class="country-name">México</span>
                    <span class="country-phone">+52 55 3720 8429</span>
                </div>
                <i class="fas fa-chevron-right arrow-go"></i>
            </a>
        </div>
    </div>
    <button class="whatsapp-floating-btn" id="whatsappFloatingBtn" aria-label="Contactar por WhatsApp" aria-expanded="false">
        <i class="fab fa-whatsapp"></i>
        <span class="whatsapp-floating-pulse"></span>
    </button>
</div>
