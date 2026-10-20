<?php
require __DIR__ . '/includes/bootstrap.php';
$route = '/privacy';
partial('header');
partial('sections/legal-page', ['heading' => $pages['legal']['titles']['privacy'], 'text' => $pages['legal']['placeholder']]);
partial('footer');
