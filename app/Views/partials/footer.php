<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Componente Parcial: Pie de Página Corporativo (app/Views/partials/footer.php)
 *
 * Contiene identidad de marca, enlaces rápidos, datos de contacto oficiales y enlace al Libro de Reclamaciones.
 */

declare(strict_types=1);

$year = $currentYear ?? date('Y');
?>
<!-- ==========================================================================
     FOOTER CORPORATIVO
     ========================================================================== -->
<footer class="main-footer">
    <div class="footer-container">
        <div class="footer-grid">
            
            <!-- Columna 1: Identidad Corporativa -->
            <div class="footer-col brand-col">
                <div class="logo-badge d-flex align-items-center mb-3">
                    <picture>
                        <source srcset="img/Logo.webp" type="image/webp">
                        <img src="img/Logo.png" alt="Quality Consulting Solutions Logo" width="44" height="44" class="d-inline-block align-text-top rounded-2 me-2 brand-logo animate__animated animate__bounceIn" style="object-fit: cover; width: 44px; height: 44px;">
                    </picture>
                    <div class="logo-text-wrap">
                        <span class="logo-title text-light">QUALITY CONSULTING</span>
                        <span class="logo-sub">SOLUTIONS</span>
                    </div>
                </div>
                <p class="footer-desc">
                    Programas de capacitación especializada, cursos y asesoría técnica en gestión de proyectos, calidad y PMO para profesionales del sector construcción.
                </p>
                <div class="footer-socials mt-3">
                    <a href="https://pe.linkedin.com/in/omarsamaniego" target="_blank" rel="noopener noreferrer" class="social-btn linkedin" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="https://www.facebook.com/qaqcconsulting" target="_blank" rel="noopener noreferrer" class="social-btn facebook" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://www.youtube.com/channel/UCbCdXwbcl-uouYa6Y4_kY0A?view_as=subscriber" target="_blank" rel="noopener noreferrer" class="social-btn youtube" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    <a href="https://wa.me/51993463118" target="_blank" rel="noopener noreferrer" class="social-btn whatsapp animate__animated animate__pulse animate__infinite" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>

            <!-- Columna 2: Enlaces Rápidos -->
            <div class="footer-col links-col">
                <h4 class="footer-heading">Enlaces Rápidos</h4>
                <ul class="footer-links">
                    <li><a href="/"><i class="fa-solid fa-angle-right"></i> Home</a></li>
                    <li><a href="/nosotros"><i class="fa-solid fa-angle-right"></i> Nosotros</a></li>
                    <li><a href="/consultoria"><i class="fa-solid fa-angle-right"></i> Asesoría</a></li>
                    <li><a href="/capacitacion"><i class="fa-solid fa-angle-right"></i> Capacitación</a></li>
                    <li><a href="/medios"><i class="fa-solid fa-angle-right"></i> Medios y Podcasts</a></li>
                    <li><a href="/clientes"><i class="fa-solid fa-angle-right"></i> Clientes</a></li>
                </ul>
            </div>

            <!-- Columna 3: Contacto & Libro de Reclamaciones -->
            <div class="footer-col contact-col">
                <h4 class="footer-heading">Contacto Oficial</h4>
                <p><i class="fa-solid fa-location-dot me-2 text-warning"></i> Av. Javier Prado 757, piso 10 Magdalena, Lima 17</p>
                <p><i class="fa-solid fa-envelope me-2 text-warning"></i> <a href="mailto:contacto@quality-consulting.org" class="text-light">contacto@quality-consulting.org</a></p>
                <p><i class="fa-solid fa-phone me-2 text-warning"></i> <a href="tel:+51993463118" class="text-light">+51 993 463 118</a></p>
                <div class="mt-3">
                    <a href="/libro-de-reclamaciones" class="btn btn-outline-warning btn-sm fw-bold d-inline-flex align-items-center rounded-pill px-3 py-2 btn-qcs-dark">
                        <i class="fas fa-book-open me-2 text-warning"></i> Libro de Reclamaciones
                    </a>
                </div>
            </div>

        </div>

        <div class="footer-bottom">
            <p>© <?= htmlspecialchars((string)$year, ENT_QUOTES, 'UTF-8') ?> Quality Consulting Solutions. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>

