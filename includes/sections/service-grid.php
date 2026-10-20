<?php
/** Grid of service cards. Needs $items and $variant ('featured-grid' or 'services-grid'). Built from content/services.json. */
$total = count($items);
?>
<div class="service-grid <?= e($variant) ?>">
<?php foreach ($items as $i => $service): ?>
  <a class="service-card" href="<?= e(url('/services#' . $service['id'])) ?>"<?= $variant === 'services-grid' ? ' id="' . e($service['id']) . '"' : '' ?>>
    <div class="service-image">
      <span class="service-number"><?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?> / <?= str_pad((string) $total, 2, '0', STR_PAD_LEFT) ?></span>
      <?= freight_image($service['image'], $service['imageAlt']) ?>
    </div>
    <div class="service-body">
      <div class="service-category"><?= e($service['category']) ?></div>
      <h3><?= e($service['name']) ?></h3>
      <p><?= e($service['description']) ?></p>
      <span class="service-link"><?= e($pages['common']['buttons']['exploreService']) ?> <?= icon('arrow-up-right', 14) ?></span>
    </div>
  </a>
<?php endforeach; ?>
</div>
