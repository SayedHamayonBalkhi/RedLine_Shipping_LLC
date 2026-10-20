<?php
/** Numbered steps. Needs $label, $title, $intro, $steps, $dark (dark style is used on the About page). */
$titleId = 'process-' . ($dark ? 'about' : 'home') . '-title';
$count   = count($steps);
?>
<section class="process<?= $dark ? ' process-dark' : '' ?>" aria-labelledby="<?= $titleId ?>">
  <div class="container">
    <div class="process-head">
      <div>
        <div class="eyebrow"><?= e($label) ?></div>
        <h2 id="<?= $titleId ?>"><?= e($title) ?></h2>
      </div>
      <p><?= e($intro) ?></p>
    </div>
    <div class="steps<?= $count === 4 ? ' steps-four' : '' ?>">
<?php foreach ($steps as $i => $step): $n = str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT); ?>
      <article class="step">
        <div class="step-num"><?= $n ?> <span><?= $n ?> / <?= str_pad((string) $count, 2, '0', STR_PAD_LEFT) ?></span></div>
        <h3><?= e($step['title']) ?></h3>
        <p><?= e($step['description']) ?></p>
      </article>
<?php endforeach; ?>
    </div>
  </div>
</section>
