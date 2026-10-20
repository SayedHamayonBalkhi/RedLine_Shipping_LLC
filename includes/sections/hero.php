<?php /** Home page top banner. */ $hero = $pages['home']['hero']; ?>
<section class="hero" id="top" aria-labelledby="hero-title">
  <?= freight_image($images['homeHero']['src'], '', 'hero-background-image', true) ?>
  <div class="container hero-content">
    <div class="eyebrow fade-in"><?= e($site['companyName']) ?></div>
    <h1 class="fade-in delay" id="hero-title"><?php foreach ($hero['headingLines'] as $line): ?><?= e($line) ?><br><?php endforeach; ?><span><?= e($hero['headingAccent']) ?></span></h1>
    <p class="hero-copy fade-in delay"><?= e($hero['copy']) ?></p>
    <div class="hero-actions fade-in delay">
      <?= button($site['navQuote']['to'], $pages['common']['buttons']['requestQuote'], 'primary', 'arrow-right') ?>
      <?= button($site['contact']['phoneHref'], $pages['common']['buttons']['call'] . ' ' . $site['contact']['phone'], 'outline', 'phone', 14) ?>
    </div>
    <div class="trust-chips" aria-label="<?= e($hero['chipsLabel']) ?>">
<?php foreach ($hero['chips'] as $chip): ?>
      <span><?= icon($chip['icon'], 15) ?> <?= e($chip['label']) ?></span>
<?php endforeach; ?>
    </div>
  </div>
  <div class="hero-index" aria-hidden="true"><?= e($hero['indexText']) ?></div>
</section>
