<?php /** Services page: "Safety is how we work" block. */ $safety = $pages['servicesPage']['safety']; ?>
<section class="promise-section" aria-labelledby="promise-title">
  <div class="container promise-grid">
    <div class="promise-copy">
      <div class="eyebrow"><?= e($safety['eyebrow']) ?></div>
      <h2 id="promise-title"><?= e($safety['title']) ?></h2>
      <p><?= e($safety['intro']) ?></p>
    </div>
    <div class="promise-list">
<?php foreach ($safety['promises'] as $promise): ?>
      <div class="promise-item">
        <span><?= icon('check', 21) ?></span>
        <p><?= e($promise) ?></p>
      </div>
<?php endforeach; ?>
    </div>
  </div>
</section>
