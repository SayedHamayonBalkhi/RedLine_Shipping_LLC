<?php
require __DIR__ . '/includes/bootstrap.php';
$route = '/terms';
partial('header');
partial('sections/legal-page', ['heading' => $pages['legal']['titles']['terms'], 'text' => $pages['legal']['placeholder']]);
partial('footer');
