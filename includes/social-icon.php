<?php /** Social network icon. $network is 'facebook', 'instagram' or 'x'. */ ?>
<?php if ($network === 'facebook'): ?>
<svg class="social-icon" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M20 12.06C20 7.61 16.42 4 12 4s-8 3.61-8 8.06c0 4.02 2.93 7.35 6.75 7.94v-5.61H8.72v-2.33h2.03v-1.78c0-2.02 1.2-3.15 3.04-3.15.88 0 1.8.16 1.8.16v1.98h-1.01c-1 0-1.31.62-1.31 1.25v1.54h2.23l-.36 2.33h-1.87V20c3.82-.59 6.75-3.92 6.75-7.94Z"></path></svg>
<?php elseif ($network === 'instagram'): ?>
<svg class="social-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="3.5" y="3.5" width="17" height="17" rx="5"></rect><circle cx="12" cy="12" r="4"></circle><circle cx="17.8" cy="6.5" r=".8" fill="currentColor" stroke="none"></circle></svg>
<?php else: ?>
<svg class="social-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="m4 4 16 16M20 4 4 20"></path></svg>
<?php endif; ?>
