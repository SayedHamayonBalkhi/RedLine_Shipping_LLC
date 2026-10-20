<?php /** Logo link. Pass ['footer' => true] for the larger footer version. */ ?>
<a class="brand<?= !empty($footer) ? ' brand-footer' : '' ?>" href="<?= e(url('/')) ?>" aria-label="<?= e($site['brandAriaLabel']) ?>">
  <img class="brand-logo" src="<?= e(asset('images/redline-shipping-logo.jpeg')) ?>" alt="" width="1536" height="1024">
</a>
