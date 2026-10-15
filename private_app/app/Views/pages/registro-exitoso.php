<?php
declare(strict_types=1);
$name = htmlspecialchars((string)($summary['nombres'] ?? ''), ENT_QUOTES, 'UTF-8');
$course = htmlspecialchars((string)($summary['curso_titulo'] ?? ''), ENT_QUOTES, 'UTF-8');
?>
<main class="qcs-register-page bg-dark text-light min-vh-100"><div class="container py-5"><div class="row justify-content-center"><div class="col-12 col-md-9 col-lg-6">
 <section class="card bg-secondary bg-opacity-10 border border-success border-opacity-50 rounded-4 p-4 p-md-5 text-center shadow-lg">
  <div class="d-inline-flex justify-content-center align-items-center bg-success text-white rounded-circle mx-auto mb-3" style="width:60px;height:60px"><i class="fas fa-check fs-3"></i></div>
  <h1 class="h3 font-montserrat fw-bold text-white mb-3">Registro enviado</h1>
  <p class="text-white-50 mb-4">Gracias<?= $name !== '' ? ', <strong>' . $name . '</strong>' : '' ?>. Recibimos tus datos para la primera clase<?= $course !== '' ? ' de <strong>' . $course . '</strong>' : '' ?>.</p>
  <a href="/" class="btn btn-outline-light">Volver al inicio</a>
 </section>
</div></div></div></main>
