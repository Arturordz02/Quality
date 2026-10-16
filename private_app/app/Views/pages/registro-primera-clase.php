<?php
declare(strict_types=1);
$isStatic = !empty($staticBuild);
$courseTitleSafe = htmlspecialchars((string)($courseTitle ?? ''), ENT_QUOTES, 'UTF-8');
$courseSlugSafe = htmlspecialchars((string)($courseSlug ?? ''), ENT_QUOTES, 'UTF-8');
$orderIdSafe = htmlspecialchars((string)($orderId ?? ''), ENT_QUOTES, 'UTF-8');
$captureIdSafe = htmlspecialchars((string)($captureId ?? ''), ENT_QUOTES, 'UTF-8');
$csrfSafe = htmlspecialchars((string)($csrfToken ?? ''), ENT_QUOTES, 'UTF-8');
$honeypotSafe = htmlspecialchars((string)($honeypotField ?? '_qcs_verification_hp'), ENT_QUOTES, 'UTF-8');
$paymentErrorSafe = htmlspecialchars((string)($paymentError ?? ''), ENT_QUOTES, 'UTF-8');
$isManual = !empty($manualVerification);
$errors = isset($_SESSION) ? ($_SESSION['_qcs_form_errors'] ?? []) : [];
$old = isset($_SESSION) ? ($_SESSION['_qcs_form_old'] ?? []) : [];
if (isset($_SESSION)) {
    unset($_SESSION['_qcs_form_errors'], $_SESSION['_qcs_form_old']);
}
?>
<main class="qcs-register-page bg-dark text-light min-vh-100">
 <div class="container py-4 py-md-5"><div class="row justify-content-center"><div class="col-12 col-md-10 col-lg-7 col-xl-6">
  <section class="card bg-secondary bg-opacity-10 border border-secondary border-opacity-25 rounded-4 p-3 p-sm-4 p-md-5 shadow-lg overflow-hidden">
   <div class="text-center mb-4">
    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-warning text-dark mb-3" style="width:56px;height:56px"><i class="fas fa-user-check fs-4" aria-hidden="true"></i></div>
    <h1 class="h3 font-montserrat fw-bold text-white mb-2">Completa tus datos</h1>
    <p class="text-light text-opacity-75 mb-0">Registro para la primera clase de <strong class="text-white" id="headerCourseTitle"><?= $courseTitleSafe ?></strong></p>
   </div>
   <?php if ($isStatic): ?>
    <div class="alert alert-dark border-secondary text-white-50 text-center mb-0">Pago disponible únicamente en el sitio oficial.</div>
   <?php else: ?>
    <?php if ($paymentErrorSafe !== ''): ?><div class="alert alert-danger" role="alert"><?= $paymentErrorSafe ?></div><?php endif; ?>
    <form action="/registro-primera-clase" method="POST" id="formRegistroPrimeraClase" novalidate>
     <input type="hidden" name="_csrf_token" value="<?= $csrfSafe ?>">
     <?php if (!$isManual): ?>
      <input type="hidden" name="paypal_order_id" value="<?= $orderIdSafe ?>">
      <input type="hidden" name="paypal_capture_id" value="<?= $captureIdSafe ?>">
     <?php endif; ?>
     <input type="hidden" name="curso" value="<?= $courseSlugSafe ?>">
     <div class="visually-hidden" aria-hidden="true"><label for="<?= $honeypotSafe ?>">Dejar vacío</label><input type="text" id="<?= $honeypotSafe ?>" name="<?= $honeypotSafe ?>" tabindex="-1" autocomplete="off"></div>
     <div class="mb-3"><label for="nombres" class="form-label text-white fw-semibold">Nombres y apellidos</label><input type="text" class="form-control<?= isset($errors['nombres']) ? ' is-invalid' : '' ?>" id="nombres" name="nombres" maxlength="150" required autocomplete="name" value="<?= htmlspecialchars((string)($old['nombres'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"><?php if (isset($errors['nombres'])): ?><div class="invalid-feedback"><?= htmlspecialchars((string)$errors['nombres'], ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?></div>
     <div class="mb-3"><label for="email" class="form-label text-white fw-semibold">Correo electrónico</label><input type="email" class="form-control<?= isset($errors['email']) ? ' is-invalid' : '' ?>" id="email" name="email" maxlength="150" required autocomplete="email" value="<?= htmlspecialchars((string)($old['email'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"><?php if (isset($errors['email'])): ?><div class="invalid-feedback"><?= htmlspecialchars((string)$errors['email'], ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?></div>
     <div class="mb-3"><label for="telefono" class="form-label text-white fw-semibold">Número telefónico/WhatsApp</label><input type="tel" class="form-control<?= isset($errors['telefono']) ? ' is-invalid' : '' ?>" id="telefono" name="telefono" maxlength="30" required autocomplete="tel" value="<?= htmlspecialchars((string)($old['telefono'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"><?php if (isset($errors['telefono'])): ?><div class="invalid-feedback"><?= htmlspecialchars((string)$errors['telefono'], ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?></div>
     <div class="mb-3"><label for="curso_display" class="form-label text-white fw-semibold">Curso</label><input type="text" class="form-control bg-secondary bg-opacity-25 text-white border-secondary" id="curso_display" value="<?= $courseTitleSafe ?>" readonly></div>
     <?php if ($isManual): ?>
      <div class="mb-4"><label for="paypal_order_id" class="form-label text-white fw-semibold">Código o referencia de la transacción PayPal</label><input type="text" class="form-control<?= isset($errors['paypal_order_id']) ? ' is-invalid' : '' ?>" id="paypal_order_id" name="paypal_order_id" minlength="6" maxlength="127" required autocomplete="off" value="<?= htmlspecialchars((string)($old['paypal_order_id'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"><div class="form-text text-light text-opacity-85">El registro quedará pendiente hasta verificar el pago.</div><?php if (isset($errors['paypal_order_id'])): ?><div class="invalid-feedback"><?= htmlspecialchars((string)$errors['paypal_order_id'], ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?></div>
     <?php else: ?>
      <p class="small text-white-50 mb-4"><i class="fab fa-paypal me-1" aria-hidden="true"></i>Pago verificado. Referencia terminada en <span class="font-monospace"><?= htmlspecialchars(substr($orderIdSafe, -6), ENT_QUOTES, 'UTF-8') ?></span>.</p>
     <?php endif; ?>
     <button type="submit" class="btn btn-warning text-dark fw-bold w-100 py-3">Enviar mis datos</button>
    </form>
   <?php endif; ?>
  </section>
 </div></div></div>
</main>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const catalog = <?= json_encode($courseCatalog ?? [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
    const params = new URLSearchParams(window.location.search);
    const slug = (<?= json_encode($courseSlugSafe) ?> || params.get('curso') || '').trim().toLowerCase();
    const course = catalog[slug] || null;
    if (course) {
        const display = document.getElementById('curso_display');
        const hiddenCurso = document.querySelector('input[name="curso"]');
        const headerCourse = document.getElementById('headerCourseTitle');
        if (display && (!display.value || display.value === '')) display.value = course.title;
        if (hiddenCurso && (!hiddenCurso.value || hiddenCurso.value === '')) hiddenCurso.value = slug;
        if (headerCourse) headerCourse.textContent = course.title;
    }
});
</script>
