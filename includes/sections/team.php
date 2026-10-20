<?php $team = $pages['aboutPage']['team']; ?>
<section class="team-section" aria-labelledby="team-title">
  <div class="container">
    <?= section_heading($team['label'], $team['title'], $team['intro'], 'team-title') ?>
    <div class="team-grid">
<?php foreach ($team['members'] as $member): ?>
      <article class="team-card">
        <span class="team-icon"><?= icon($member['icon'], 27) ?></span>
        <div class="eyebrow"><?= e($site['companyName']) ?></div>
        <h3><?= e($member['role']) ?></h3>
        <p><?= e($member['description']) ?></p>
      </article>
<?php endforeach; ?>
    </div>
  </div>
</section>
