<?php $cta = $pages['home']['cta']; ?>
<section class="final-cta" aria-labelledby="final-cta-title">
  <div class="container final-cta-inner">
    <div>
      <div class="eyebrow"><?= e($cta['eyebrow']) ?></div>
      <h2 id="final-cta-title"><?= e($cta['title']) ?></h2>
      <p><?= e($cta['body']) ?></p>
    </div>
    <div class="final-cta-actions">
      <?= button($site['navQuote']['to'], $pages['common']['buttons']['requestQuote'], 'primary', 'arrow-right') ?>
      <?= button('/services', $pages['common']['buttons']['exploreServices'], 'outline', 'arrow-up-right') ?>
    </div>
  </div>
</section>
