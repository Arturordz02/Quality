<?php
declare(strict_types=1);
$courseTitle = htmlspecialchars((string)($course['title'] ?? ''), ENT_QUOTES, 'UTF-8');
$courseSlug = htmlspecialchars((string)($courseSlug ?? ($course['slug'] ?? '')), ENT_QUOTES, 'UTF-8');
$courseUrl = htmlspecialchars((string)($course['url'] ?? '/capacitacion'), ENT_QUOTES, 'UTF-8');
?>
<main class="bg-dark text-light min-vh-100"><div class="container py-5"><div class="row justify-content-center"><div class="col-12 col-md-9 col-lg-6">
 <section class="card bg-secondary bg-opacity-10 border border-warning border-opacity-50 rounded-4 p-4 p-md-5 text-center shadow-lg">
  <div class="d-inline-flex justify-content-center align-items-center bg-warning text-dark rounded-circle mx-auto mb-3" style="width:60px;height:60px"><i class="fas fa-arrow-rotate-left fs-3"></i></div>
  <h1 class="h3 font-montserrat fw-bold text-white mb-3">Pago no completado</h1>
  <p class="text-white-50 mb-4">No se confirmó el pago de la primera clase<?= $courseTitle !== '' ? ' de <strong>' . $courseTitle . '</strong>' : '' ?>.</p>
  <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
   <?php if ($courseSlug !== ''): ?><a href="/pagar-primera-clase?curso=<?= $courseSlug ?>" class="btn btn-warning fw-bold">Reintentar pago</a><?php endif; ?>
   <a href="<?= $courseUrl ?>" class="btn btn-outline-light">Volver al curso</a>
  </div>
 </section>
</div></div></div></main>
