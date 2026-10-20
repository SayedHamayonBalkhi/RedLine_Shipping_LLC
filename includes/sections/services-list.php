<?php /** Services page: every service. */ $s = $pages['servicesPage']['list']; ?>
<section class="services services-page" aria-labelledby="services-title">
  <div class="container">
    <?= section_heading($s['label'], $s['title'], $s['intro'], 'services-title') ?>
    <?php partial('sections/service-grid', ['items' => $services, 'variant' => 'services-grid']) ?>
  </div>
</section>
