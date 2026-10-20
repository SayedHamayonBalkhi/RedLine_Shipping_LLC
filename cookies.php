<?php
require __DIR__ . '/includes/bootstrap.php';
$route = '/cookies';
partial('header');
partial('sections/legal-page', ['heading' => $pages['legal']['titles']['cookies'], 'text' => $pages['legal']['placeholder']]);
partial('footer');
