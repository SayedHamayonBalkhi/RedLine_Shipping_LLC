<?php /** About page: photos, intro paragraph and FAQ. */ $detail = $pages['aboutPage']['detail']; $faqs = $pages['aboutPage']['faqs']; ?>
<section class="about-detail" aria-labelledby="about-detail-title">
  <div class="container about-detail-grid">
    <div class="about-composition">
      <?= freight_image($images['aboutMain']['src'], $images['aboutMain']['alt'], 'about-composition-main') ?>
      <?= freight_image($images['aboutDetail']['src'], $images['aboutDetail']['alt'], 'about-composition-small') ?>
      <span class="about-location"><?= icon('map-pin', 15) ?> <?= e($detail['locationBadge']) ?></span>
    </div>
    <div class="about-detail-copy">
      <?= section_heading($detail['label'], $detail['title'], null, 'about-detail-title') ?>
      <p><?= e($detail['body']) ?></p>
      <div class="faq-list">
<?php foreach ($faqs as $i => $faq): $open = $i === 0; $answerId = 'faq-answer-' . ($i + 1); ?>
        <div class="faq-item<?= $open ? ' is-open' : '' ?>">
          <button class="faq-question" type="button" aria-expanded="<?= $open ? 'true' : 'false' ?>" aria-controls="<?= $answerId ?>">
            <span><?= e($faq['question']) ?></span><?= icon('chevron-down', 17) ?>
          </button>
          <div class="faq-answer" id="<?= $answerId ?>" aria-hidden="<?= $open ? 'false' : 'true' ?>">
            <div><p><?= e($faq['answer']) ?></p></div>
          </div>
        </div>
<?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
