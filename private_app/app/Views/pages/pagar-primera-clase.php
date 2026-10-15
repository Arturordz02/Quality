<?php
declare(strict_types=1);

$catalog = $courseCatalog ?? [];
$isStatic = !empty($staticBuild);
$rawSlug = (string)($courseSlug ?? '');
$rawTitle = (string)($courseTitle ?? '');
$rawUrl = (string)($courseUrl ?? '/capacitacion');
?>

<main class="qcs-pay-page bg-dark text-light min-vh-100">
    <div class="container py-4 py-md-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-9 col-lg-6 col-xl-5">
                <section class="card bg-secondary bg-opacity-10 border border-warning border-opacity-50 rounded-4 p-4 p-md-5 shadow-lg text-center overflow-hidden">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-warning text-dark mx-auto mb-3" style="width:56px;height:56px">
                        <i class="fab fa-paypal fs-3" aria-hidden="true"></i>
                    </div>
                    <p class="text-uppercase text-warning small fw-bold mb-2">Primera clase del curso</p>
                    <h1 id="checkoutCourseTitle" class="h3 font-montserrat fw-bold text-white mb-3"><?= htmlspecialchars($rawTitle, ENT_QUOTES, 'UTF-8') ?></h1>
                    <p class="display-6 fw-bold text-white mb-2">USD 10</p>
                    <p class="text-white-50 mb-4">Este pago corresponde únicamente a la primera clase. No incluye el curso completo.</p>

                    <?php if ($isStatic): ?>
                        <div class="alert alert-dark border-secondary text-white-50 mb-4" role="status">
                            Pago disponible únicamente en el sitio oficial.
                        </div>
                    <?php else: ?>
                        <div id="paypal-button-container" class="mx-auto w-100" style="max-width:420px;min-height:48px">
                            <div id="paypalLoading" class="text-white-50 small py-3">
                                <span class="spinner-border spinner-border-sm text-warning me-2" aria-hidden="true"></span>Preparando PayPal…
                            </div>
                        </div>
                        <p id="paymentStatus" class="small text-white-50 mt-3 mb-0" aria-live="polite"></p>
                    <?php endif; ?>

                    <a id="cancelPaymentLink" href="<?= htmlspecialchars($rawUrl, ENT_QUOTES, 'UTF-8') ?>" class="d-inline-block mt-4 text-white-50 small text-decoration-none">
                        <i class="fas fa-arrow-left me-1" aria-hidden="true"></i>Cancelar y volver al curso
                    </a>
                </section>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const catalog = <?= json_encode($catalog, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
    const params = new URLSearchParams(window.location.search);
    const slug = (<?= json_encode($rawSlug) ?> || params.get('curso') || '').trim().toLowerCase();
    const course = catalog[slug] || null;
    const title = document.getElementById('checkoutCourseTitle');
    const cancel = document.getElementById('cancelPaymentLink');
    if (course) {
        if (title) title.textContent = course.title;
        if (cancel) cancel.href = <?= $isStatic ? "course.url.replace(/^\\//, '') + '.html'" : 'course.url' ?>;
    }

<?php if (!$isStatic): ?>
    const status = document.getElementById('paymentStatus');
    const apiBase = (window.QCS_API_BASE_URL || '').replace(/\/+$/, '');
    const fail = (message) => {
        const loading = document.getElementById('paypalLoading');
        if (loading) loading.remove();
        if (status) status.textContent = message;
    };

    fetch(`${apiBase}/api/paypal/config`, {credentials: 'include'})
        .then(response => response.json())
        .then(config => {
            if (!config.configured || !config.client_id) throw new Error('Pago no disponible por el momento.');
            const script = document.createElement('script');
            script.src = `https://www.paypal.com/sdk/js?client-id=${encodeURIComponent(config.client_id)}&currency=USD&locale=es_PE`;
            script.onload = function () {
                document.getElementById('paypalLoading')?.remove();
                paypal.Buttons({
                    style: {layout: 'vertical', color: 'gold', shape: 'rect', label: 'paypal', height: 44},
                    createOrder: () => fetch(`${apiBase}/api/paypal/create-order`, {
                        method: 'POST', credentials: 'include',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest'},
                        body: new URLSearchParams({curso: slug})
                    }).then(r => r.json().then(data => {
                        if (!r.ok || !data.order_id) throw new Error(data.message || 'No se pudo iniciar el pago.');
                        return data.order_id;
                    })),
                    onApprove: data => fetch(`${apiBase}/api/paypal/capture-order`, {
                        method: 'POST', credentials: 'include',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest'},
                        body: new URLSearchParams({order_id: data.orderID, curso: slug})
                    }).then(r => r.json().then(result => {
                        if (!r.ok || !result.success || !result.redirect) throw new Error(result.message || 'No se pudo confirmar el pago.');
                        window.location.assign(result.redirect);
                    })),
                    onCancel: () => window.location.assign(`/pago-cancelado?curso=${encodeURIComponent(slug)}`),
                    onError: () => window.location.assign(`/pago-cancelado?curso=${encodeURIComponent(slug)}`)
                }).render('#paypal-button-container');
            };
            script.onerror = () => fail('Pago no disponible por el momento.');
            document.head.appendChild(script);
        })
        .catch(() => fail('Pago no disponible por el momento.'));
<?php endif; ?>
});
</script>

