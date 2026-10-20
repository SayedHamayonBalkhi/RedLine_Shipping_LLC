<?php /** About page: list of every service next to a photo. */ $w = $pages['aboutPage']['whatWeDo']; ?>
<section class="what-we-do" aria-labelledby="what-we-do-title">
  <div class="container">
    <?= section_heading($w['label'], $w['title'], null, 'what-we-do-title') ?>
    <div class="what-we-do-grid">
      <div class="what-we-do-list">
<?php foreach ($services as $service): ?>
        <a class="service-check-row" href="<?= e(url('/services#' . $service['id'])) ?>">
          <span class="check-circle"><?= icon('check', 15) ?></span>
          <span>
            <strong><?= e($service['name']) ?></strong>
            <small><?= e($service['shortDescription']) ?></small>
          </span>
          <?= icon('arrow-up-right', 15) ?>
        </a>
<?php endforeach; ?>
      </div>
      <div class="what-we-do-image">
        <?= freight_image($images['whatWeDo']['src'], $images['whatWeDo']['alt']) ?>
      </div>
    </div>
  </div>
</section>
