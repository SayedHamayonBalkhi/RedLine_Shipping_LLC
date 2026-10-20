<?php
/** Terms, Privacy and Cookie pages (placeholders for now) and the "page not found" page. Needs $heading, $text. */
$analyticsOn = trim((string) ($config['analytics_domain'] ?? '')) !== '';
$showNote    = $analyticsOn && in_array($route, ['/privacy', '/cookies'], true);
?>
<section class="legal-page">
  <div class="container">
    <div class="eyebrow"><?= e($site['companyName']) ?></div>
    <h1><?= e($heading) ?></h1>
    <p><?= e($text) ?></p>
<?php if ($showNote): ?>
    <p><?= e($pages['legal']['analyticsNote']) ?></p>
<?php endif; ?>
    <?= button('/', $pages['common']['buttons']['backHome'], 'primary', 'arrow-down', 14) ?>
  </div>
</section>
