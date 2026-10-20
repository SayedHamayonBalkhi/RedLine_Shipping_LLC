<?php
/**
 * Headline, short intro, the quote form and a photo.
 * Needs: $id, $label, $title, $intro, $photo, $formId. Optional: $reverse.
 */
$reverse = $reverse ?? false;
?>
<section class="quote-section quote-section-photo<?= $reverse ? ' quote-section-reversed' : '' ?>" id="<?= e($id) ?>" aria-labelledby="<?= e($formId) ?>-title">
  <div class="container">
    <div class="quote-layout">
      <div class="quote-column">
        <div class="eyebrow"><?= e($label) ?></div>
        <h2 id="<?= e($formId) ?>-title"><?= e($title) ?></h2>
        <p class="quote-description"><?= e($intro) ?></p>
        <?php partial('quote-form', ['formId' => $formId]) ?>
      </div>
      <div class="quote-photo">
        <?= freight_image($photo['src'], $photo['alt']) ?>
<?php if ($id === 'quote'): ?>
        <span class="quote-photo-label"><?= e($site['companyName']) ?></span>
<?php endif; ?>
      </div>
    </div>
  </div>
</section>
