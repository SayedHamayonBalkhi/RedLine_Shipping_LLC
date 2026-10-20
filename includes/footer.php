<?php
/** Bottom of every page: closes <main>, footer, scripts. */
$social = [
    'facebook'  => $site['social']['facebook'],
    'instagram' => $site['social']['instagram'],
    'x'         => $site['social']['x'],
];
?>
      </main>
      <footer class="footer">
        <div class="container">
          <div class="footer-main">
            <div class="footer-brand">
              <?php partial('brand', ['footer' => true]) ?>
              <p><?= e($site['footer']['blurb']) ?></p>
            </div>
            <div>
              <h2 class="footer-title"><?= e($site['footer']['servicesTitle']) ?></h2>
              <nav class="footer-nav" aria-label="<?= e($site['a11y']['footerServices']) ?>">
<?php foreach ($services as $service): ?>
                <a href="<?= e(url('/services#' . $service['id'])) ?>"><?= e($service['name']) ?></a>
<?php endforeach; ?>
              </nav>
            </div>
            <div>
              <h2 class="footer-title"><?= e($site['footer']['companyTitle']) ?></h2>
              <nav class="footer-nav" aria-label="<?= e($site['a11y']['footerCompany']) ?>">
<?php foreach ($site['footer']['companyLinks'] as $link): ?>
                <a href="<?= e(url($link['to'])) ?>"><?= e($link['label']) ?></a>
<?php endforeach; ?>
              </nav>
            </div>
            <div>
              <h2 class="footer-title"><?= e($site['footer']['contactTitle']) ?></h2>
              <nav class="footer-nav footer-contact" aria-label="<?= e($site['a11y']['footerContact']) ?>">
                <a href="<?= e($site['contact']['mapUrl']) ?>" target="_blank" rel="noopener noreferrer"><?= icon('map-pin', 15) ?><?= e($site['contact']['address']) ?></a>
                <a href="<?= e($site['contact']['phoneHref']) ?>"><?= icon('phone', 15) ?><?= e($site['contact']['phone']) ?></a>
                <a href="mailto:<?= e($site['contact']['email']) ?>"><?= icon('mail', 15) ?><?= e($site['contact']['email']) ?></a>
              </nav>
            </div>
          </div>
          <div class="footer-bottom">
            <nav class="legal-links" aria-label="<?= e($site['a11y']['footerLegal']) ?>">
<?php foreach ($site['footer']['legalLinks'] as $link): ?>
              <a href="<?= e(url($link['to'])) ?>"><?= e($link['label']) ?></a>
<?php endforeach; ?>
            </nav>
            <span class="footer-copyright">© <?= date('Y') ?> <?= e($site['companyName']) ?>. <?= e($site['footer']['rights']) ?></span>
            <div class="social-follow">
              <strong><?= e($site['footer']['followUs']) ?></strong>
              <nav class="social-links" aria-label="<?= e($site['a11y']['footerSocial']) ?>">
<?php foreach ($social as $network => $href): $label = $site['footer']['socialLabels'][$network]; ?>
<?php if ($href !== ''): ?>
                <a href="<?= e($href) ?>" target="_blank" rel="noopener noreferrer" aria-label="Follow <?= e($site['companyName']) ?> on <?= e($label) ?>"><?php partial('social-icon', ['network' => $network]) ?><span><?= e($label) ?></span></a>
<?php else: ?>
                <span class="social-link-unconfigured" aria-label="<?= e($label . ' ' . $site['a11y']['socialComingSoon']) ?>" title="<?= e($site['a11y']['socialComingSoonHint']) ?>"><?php partial('social-icon', ['network' => $network]) ?><span><?= e($label) ?></span></span>
<?php endif; ?>
<?php endforeach; ?>
              </nav>
            </div>
          </div>
        </div>
      </footer>
    </div>
    <script src="<?= e(asset('js/main.js')) ?>" defer></script>
  </body>
</html>
