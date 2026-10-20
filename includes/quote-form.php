<?php
/**
 * The quote form. Needs $formId (unique per form on the page, e.g. "home-quote").
 * Validation and sending are handled by assets/js/main.js and handlers/submit-quote.php.
 * Labels, placeholders and messages live in content/form.php; service choices come from content/services.json.
 */
$f = $formText['fields'];
$fields = [
    ['name' => 'fullName', 'type' => 'text',   'icon' => 'user-round',          'multiline' => false],
    ['name' => 'phone',    'type' => 'tel',    'icon' => 'phone',               'multiline' => false],
    ['name' => 'email',    'type' => 'email',  'icon' => 'mail',                'multiline' => false],
    ['name' => 'service',  'type' => 'select', 'icon' => 'package',             'multiline' => false],
    ['name' => 'message',  'type' => 'text',   'icon' => 'message-square-text', 'multiline' => true],
];
$fallbackError = str_replace(['{phone}', '{email}'], [$site['contact']['phone'], $site['contact']['email']], $formText['fallbackError']);
?>
<form class="quote-form" method="post" action="<?= e(base_path() . '/handlers/submit-quote.php') ?>" novalidate aria-busy="false"
      data-quote-form data-fallback-error="<?= e($fallbackError) ?>" data-success="<?= e($formText['success']) ?>"
      data-submit-label="<?= e($formText['submit']) ?>" data-submitting-label="<?= e($formText['submitting']) ?>"
      data-error-fullname="<?= e($formText['errors']['fullName']) ?>" data-error-email="<?= e($formText['errors']['email']) ?>"
      data-error-phone="<?= e($formText['errors']['phone']) ?>" data-error-service="<?= e($formText['errors']['service']) ?>"
      data-error-message="<?= e($formText['errors']['message']) ?>">
  <input class="quote-honeypot" type="text" name="website" tabindex="-1" autocomplete="off" aria-hidden="true">
  <div class="form-heading">
    <h3><?= e($formText['heading']) ?></h3>
    <p><?= e($formText['subheading']) ?></p>
  </div>
  <div class="form-status" hidden aria-live="polite" data-form-status>
    <?= icon('circle-check', 19, true, 'data-status-icon="success" hidden') ?>
    <?= icon('circle-alert', 19, true, 'data-status-icon="error" hidden') ?>
    <span data-status-text></span>
  </div>
  <div class="form-section-title"><span><?= e($formText['sectionTitle']['number']) ?></span> <?= e($formText['sectionTitle']['label']) ?></div>
  <div class="form-grid">
<?php foreach ($fields as $field):
    $name = $field['name'];
    $id = $formId . '-' . $name;
    $text = $f[$name];
    $common = 'id="' . e($id) . '" name="' . $name . '" placeholder="' . e($text['placeholder']) . '" required'
        . ($name === 'message' ? ' maxlength="5000"' : '') . ' aria-invalid="false" aria-required="true"';
?>
    <div class="field<?= $field['multiline'] ? ' full' : '' ?>">
      <label for="<?= e($id) ?>"><?= icon($field['icon'], 15) ?><span><?= e($text['label']) ?><span class="required" aria-hidden="true"> *</span></span></label>
<?php if ($field['multiline']): ?>
      <textarea <?= $common ?> rows="4"></textarea>
<?php elseif ($field['type'] === 'select'): ?>
      <select <?= $common ?>>
        <option value="" disabled selected><?= e($text['placeholder']) ?></option>
<?php foreach ($serviceNames as $option): ?>
        <option value="<?= e($option) ?>"><?= e($option) ?></option>
<?php endforeach; ?>
      </select>
<?php else: ?>
      <input <?= $common ?> type="<?= $field['type'] ?>">
<?php endif; ?>
    </div>
<?php endforeach; ?>
  </div>
  <button class="button form-submit" type="submit"><?= e($formText['submit']) ?><?= icon('send', 16) ?></button>
  <p class="form-note"><?= icon('shield-check', 15) ?> <?= e($formText['note']) ?></p>
</form>
