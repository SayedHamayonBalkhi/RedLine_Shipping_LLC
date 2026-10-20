<?php /** Banner at the top of the Services, About and Contact pages. Needs $title, $description, $image. */ ?>
<section class="page-hero" aria-labelledby="page-hero-title">
  <?= freight_image($image['src'], '', 'page-hero-image', true) ?>
  <div class="container page-hero-content">
    <div class="eyebrow"><?= e($site['companyName']) ?></div>
    <h1 id="page-hero-title"><?= e($title) ?></h1>
    <p><?= e($description) ?></p>
  </div>
  <div class="page-hero-index" aria-hidden="true"><?= e($pages['common']['pageHeroIndex']) ?></div>
</section>
