<?php
/**
 * QUALITY CONSULTING SOLUTIONS - ARQUITECTURA MVC
 * Vista de Transición / Redirección Estática: Contratos Colaborativos NEC
 * Archivo: app/Views/pages/nec.php
 *
 * Esta vista provee redirección automática y accesible hacia el curso oficial
 * consolidado (/contratos-colaborativos-nec3-f) en entornos de compilación estática
 * (GitHub Pages) sin duplicar temarios, plana docente ni métricas.
 */

declare(strict_types=1);

$targetUrl = '/contratos-colaborativos-nec3-f';
?>
<main class="page-content py-5" style="min-height: 60vh; display: flex; align-items: center; justify-content: center;">
    <div class="container text-center py-4">
        <div class="card border-0 shadow-sm mx-auto p-4 p-md-5" style="max-width: 680px; border-radius: 16px; background: #ffffff;">
            <div class="mb-4">
                <span class="badge bg-warning text-dark px-3 py-2 text-uppercase fw-bold" style="letter-spacing: 0.5px; border-radius: 8px;">
                    <i class="fa-solid fa-arrows-rotate me-1"></i> Redirección Oficial
                </span>
            </div>
            
            <h1 class="h3 fw-bold text-dark mb-3">CONTRATOS COLABORATIVOS NEC3-F</h1>
            
            <p class="text-secondary mb-4" style="line-height: 1.6;">
                La información oficial de este programa ha sido consolidada en nuestra página especializada de <strong>Contratos Colaborativos NEC3-F</strong>.
            </p>

            <div class="alert alert-light border mb-4 text-start small text-muted">
                <i class="fa-solid fa-circle-info text-primary me-2"></i>
                Estás siendo redirigido automáticamente. Si tu navegador no avanza en unos segundos, haz clic en el siguiente botón:
            </div>

            <div>
                <a href="<?= htmlspecialchars($targetUrl, ENT_QUOTES, 'UTF-8') ?>" class="btn btn-warning fw-bold px-4 py-3 shadow-sm text-dark" style="border-radius: 8px; font-size: 1rem;">
                    <i class="fa-solid fa-arrow-right me-2"></i> Ir a Contratos Colaborativos NEC3-F
                </a>
            </div>
        </div>
    </div>
</main>

<script>
    (function() {
        var target = 'contratos-colaborativos-nec3-f.html';
        if (window.location.pathname.endsWith('/nec/') || window.location.pathname.endsWith('/nec')) {
            target = '../contratos-colaborativos-nec3-f.html';
        }
        window.location.replace(target);
    })();
</script>
<noscript>
    <meta http-equiv="refresh" content="0; url=contratos-colaborativos-nec3-f.html">
</noscript>
