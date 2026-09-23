<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Componente Parcial: Widget Flotante de WhatsApp (app/Views/partials/whatsapp_float.php)
 *
 * Enlace directo de atención rápida por WhatsApp.
 */

declare(strict_types=1);

$phone = $phone ?? '51993463118';
$message = $message ?? 'Hola, deseo solicitar información sobre los servicios de Quality Consulting Solutions.';
$url = 'https://wa.me/' . urlencode((string)$phone) . '?text=' . urlencode((string)$message);
?>
<!-- Botón Flotante de WhatsApp Corporativo -->
<div class="qcs-whatsapp-float" style="position: fixed; bottom: 25px; right: 25px; z-index: 1050;">
    <a href="<?= htmlspecialchars($url, ENT_QUOTES, 'UTF-8') ?>" 
       target="_blank" 
       rel="noopener noreferrer" 
       class="btn btn-success rounded-circle shadow-lg d-flex align-items-center justify-content-center animate__animated animate__pulse animate__infinite" 
       style="width: 56px; height: 56px; font-size: 28px; background-color: #25d366; border-color: #25d366; text-decoration: none;"
       aria-label="Contactar por WhatsApp">
        <i class="fa-brands fa-whatsapp text-white"></i>
    </a>
</div>

