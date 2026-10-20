<?php /** Home page "about us" block: mission and vision panels. */ $mission = $pages['home']['mission']; $more = $pages['common']['buttons']['learnMoreAbout']; ?>
<section class="mission-section" aria-labelledby="mission-title">
  <div class="container">
    <?= section_heading($mission['label'], $mission['title'], null, 'mission-title') ?>
    <div class="mission-grid">
      <article class="mission-panel mission-panel-dark">
        <span class="mission-icon"><?= icon('route', 30) ?></span>
        <div class="eyebrow"><?= e($mission['mission']['eyebrow']) ?></div>
        <h3><?= e($mission['mission']['heading']) ?></h3>
        <p><?= e($mission['mission']['body']) ?></p>
        <a class="text-link" href="<?= e(url('/about')) ?>"><?= e($more) ?> <?= icon('arrow-right', 15) ?></a>
      </article>
      <article class="mission-panel mission-panel-vision">
        <span class="mission-icon"><?= icon('eye', 30) ?></span>
        <div class="eyebrow"><?= e($mission['vision']['eyebrow']) ?></div>
        <h3><?= e($mission['vision']['heading']) ?></h3>
        <p><?= e($mission['vision']['body']) ?></p>
        <a class="text-link" href="<?= e(url('/about')) ?>"><?= e($more) ?> <?= icon('arrow-right', 15) ?></a>
      </article>
    </div>
  </div>
</section>
