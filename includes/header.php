<?php
/**
 * Top of every page: <head>, topline, sticky header and navigation, opening <main>.
 * Set $route (e.g. '/services') before including. Optional: $status (e.g. 404) and $noindex.
 */
$meta       = page_meta($route);
$canonical  = absolute_url($route === '/' ? url('/') : url($route));
$shareImage = absolute_url(base_path() . '/assets/' . $site['seo']['shareImage']);
$analytics  = trim((string) ($config['analytics_domain'] ?? ''));
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($meta['title']) ?></title>
    <meta name="description" content="<?= e($meta['description']) ?>">
    <meta name="robots" content="<?= !empty($noindex) ? 'noindex, follow' : 'index, follow' ?>">
    <link rel="canonical" href="<?= e($canonical) ?>">
    <meta property="og:title" content="<?= e($meta['title']) ?>">
    <meta property="og:description" content="<?= e($site['seo']['shareDescription']) ?>">
    <meta property="og:image" content="<?= e($shareImage) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= e($canonical) ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e($meta['title']) ?>">
    <meta name="twitter:description" content="<?= e($site['seo']['shareDescription']) ?>">
    <meta name="twitter:image" content="<?= e($shareImage) ?>">
    <link rel="icon" type="image/svg+xml" href="<?= e(asset('images/favicon.svg')) ?>">
    <script type="application/ld+json">
<?= business_json_ld() ?>

    </script>
    <link rel="stylesheet" href="<?= e(asset('css/base.css')) ?>">
    <link rel="stylesheet" href="<?= e(asset('css/layout.css')) ?>">
    <link rel="stylesheet" href="<?= e(asset('css/sections.css')) ?>">
    <link rel="stylesheet" href="<?= e(asset('css/components.css')) ?>">
<?php if ($analytics !== ''): ?>
    <script defer data-domain="<?= e($analytics) ?>" src="<?= e((string) ($config['analytics_src'] ?? 'https://plausible.io/js/script.js')) ?>"></script>
<?php endif; ?>
  </head>
  <body>
    <div class="site-shell" data-fallback-text="<?= e($pages['common']['imageFallbackText']) ?>">
      <div class="topline">
        <div class="container topline-inner">
          <span><?= e($site['topline']) ?></span>
          <a class="topline-email" href="mailto:<?= e($site['contact']['email']) ?>"><?= icon('mail', 13) ?> <?= e($site['contact']['email']) ?></a>
        </div>
      </div>
      <header class="header">
        <div class="container nav-inner">
          <?php partial('brand') ?>
          <button class="menu-toggle" type="button" aria-label="<?= e($site['a11y']['openMenu']) ?>" aria-expanded="false" aria-controls="main-navigation"
                  data-label-open="<?= e($site['a11y']['openMenu']) ?>" data-label-close="<?= e($site['a11y']['closeMenu']) ?>">
            <?= icon('menu', 22, false, 'data-menu-icon="open"') ?>
            <?= icon('x', 22, false, 'data-menu-icon="close" hidden') ?>
          </button>
          <nav id="main-navigation" class="nav-links" aria-label="<?= e($site['a11y']['mainNavigation']) ?>">
<?php foreach ($site['nav'] as $item): $active = $item['to'] === $route; ?>
            <a href="<?= e(url($item['to'])) ?>"<?= $active ? ' class="active" aria-current="page"' : '' ?>><?= e($item['label']) ?></a>
<?php endforeach; ?>
            <a class="nav-quote" href="<?= e(url($site['navQuote']['to'])) ?>"><?= e($site['navQuote']['label']) ?></a>
          </nav>
        </div>
      </header>
      <main>
