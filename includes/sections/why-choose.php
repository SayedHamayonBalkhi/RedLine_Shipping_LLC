<?php $why = $pages['home']['why']; ?>
<section class="why-us" aria-labelledby="why-us-title">
  <div class="container">
    <?= section_heading($why['label'], $why['title'], null, 'why-us-title') ?>
    <div class="why-grid">
<?php foreach ($why['items'] as $item): ?>
      <article class="why-item">
        <span class="why-icon"><?= icon($item['icon'], 26) ?></span>
        <h3><?= e($item['title']) ?></h3>
        <p><?= e($item['description']) ?></p>
      </article>
<?php endforeach; ?>
    </div>
  </div>
</section>
