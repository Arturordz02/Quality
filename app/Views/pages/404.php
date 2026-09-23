<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Página: Error 404 (Página no encontrada)
 * Archivo: app/Views/pages/404.php
 */

declare(strict_types=1);
?>
<style>
    .error-section {
        min-height: calc(100vh - 380px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 80px 1.5rem;
        background: linear-gradient(135deg, #0F1113 0%, #1A1D20 50%, #24292E 100%);
        color: #ffffff;
        position: relative;
        overflow: hidden;
        border-bottom: 4px solid var(--accent-gold, #e5a813);
    }
    .error-card {
        max-width: 680px;
        width: 100%;
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(229, 168, 19, 0.25);
        border-radius: 16px;
        padding: 50px 40px;
        text-align: center;
        backdrop-filter: blur(10px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
    }
    .error-code {
        font-family: 'Montserrat', sans-serif;
        font-size: clamp(5rem, 14vw, 8rem);
        font-weight: 900;
        line-height: 1;
        background: linear-gradient(135deg, #e5a813 0%, #ffffff 70%, #8e9297 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 15px;
        letter-spacing: -2px;
    }
    .error-title {
        font-family: 'Montserrat', sans-serif;
        font-size: clamp(1.4rem, 4vw, 1.85rem);
        font-weight: 700;
        margin-bottom: 18px;
        color: #ffffff;
    }
    .error-desc {
        font-family: 'Open Sans', sans-serif;
        font-size: 1.05rem;
        color: #cbd5e1;
        line-height: 1.65;
        margin-bottom: 35px;
    }
    .error-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        justify-content: center;
    }
    .btn-gold {
        background-color: #e5a813;
        color: #000000;
        font-weight: 700;
        padding: 12px 28px;
        border-radius: 8px;
        border: none;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }
    .btn-gold:hover {
        background-color: #d1940b;
        color: #000000;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(229, 168, 19, 0.35);
    }
    .btn-outline-light-custom {
        border: 1.5px solid rgba(255, 255, 255, 0.4);
        color: #ffffff;
        font-weight: 600;
        padding: 12px 28px;
        border-radius: 8px;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }
    .btn-outline-light-custom:hover {
        border-color: #ffffff;
        background-color: rgba(255, 255, 255, 0.1);
        color: #ffffff;
        transform: translateY(-2px);
    }
</style>

<main class="error-section">
    <div class="error-card">
        <div class="error-code">404</div>
        <h2 class="error-title">Página no encontrada</h2>
        <p class="error-desc">
            Lo sentimos, la página que buscas no existe, ha sido movida o la dirección ingresada no es correcta. Te invitamos a retornar a nuestra página principal o contactarnos si necesitas asistencia.
        </p>
        <div class="error-actions">
            <a href="/" class="btn-gold">
                <i class="fa-solid fa-house me-2"></i> Volver al Inicio
            </a>
            <a href="/contacto" class="btn-outline-light-custom">
                <i class="fa-solid fa-envelope me-2"></i> Atención al Cliente
            </a>
        </div>
    </div>
</main>

