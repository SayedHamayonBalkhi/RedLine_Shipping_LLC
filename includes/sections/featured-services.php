<?php /** Home page: the services marked "featured" in content/services.json, plus a "View all" button. */ $s = $pages['home']['services']; ?>
<section class="services" aria-labelledby="featured-services-title">
  <div class="container">
    <?= section_heading($s['label'], $s['title'], $s['intro'], 'featured-services-title') ?>
    <?php partial('sections/service-grid', ['items' => $featuredServices, 'variant' => 'featured-grid']) ?>
    <div class="section-action">
      <?= button('/services', $pages['common']['buttons']['viewAllServices'], 'primary', 'arrow-right') ?>
    </div>
  </div>
</section>
