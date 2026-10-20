<?php
/** "Contact Information" block with email, phone and address cards. Needs $intro. Optional: $large. */
$large   = $large ?? false;
$titleId = $large ? 'contact-info-page-title' : 'contact-info-title';
$cards   = $pages['common']['contactCards'];
$contacts = [
    ['label' => $cards['email']['label'],   'value' => $site['contact']['email'],   'href' => 'mailto:' . $site['contact']['email'], 'action' => $cards['email']['action'],   'icon' => 'mail',   'external' => false],
    ['label' => $cards['phone']['label'],   'value' => $site['contact']['phone'],   'href' => $site['contact']['phoneHref'],          'action' => $cards['phone']['action'],   'icon' => 'phone',  'external' => false],
    ['label' => $cards['address']['label'], 'value' => $site['contact']['address'], 'href' => $site['contact']['mapUrl'],             'action' => $cards['address']['action'], 'icon' => 'map-pin', 'external' => true],
];
?>
<section class="contact-info<?= $large ? ' contact-info-large' : '' ?>" aria-labelledby="<?= $titleId ?>">
  <div class="container">
    <?= section_heading($pages['common']['contactInfo']['label'], $pages['common']['contactInfo']['title'], $intro, $titleId) ?>
    <div class="contact-cards<?= $large ? ' contact-cards-large' : '' ?>">
<?php foreach ($contacts as $card): ?>
      <a class="contact-card" href="<?= e($card['href']) ?>"<?= $card['external'] ? ' target="_blank" rel="noopener noreferrer"' : '' ?>>
        <span class="contact-icon"><?= icon($card['icon'], 20) ?></span>
        <span class="contact-label"><?= e($card['label']) ?></span>
        <span class="contact-value"><?= e($card['value']) ?></span>
        <span class="contact-action"><?= e($card['action']) ?><?= icon('arrow-up-right', 13) ?></span>
      </a>
<?php endforeach; ?>
    </div>
  </div>
</section>
