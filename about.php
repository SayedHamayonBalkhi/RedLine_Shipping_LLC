<?php
require __DIR__ . '/includes/bootstrap.php';
$route = '/about';
partial('header');
partial('sections/page-hero', [
    'title' => $pages['aboutPage']['hero']['title'], 'description' => $pages['aboutPage']['hero']['description'], 'image' => $images['aboutHero'],
]);
partial('sections/about-detail');
partial('sections/what-we-do');
partial('sections/how-it-works', [
    'label' => $pages['aboutPage']['process']['label'], 'title' => $pages['aboutPage']['process']['title'], 'intro' => $pages['aboutPage']['process']['intro'],
    'steps' => $pages['aboutPage']['process']['steps'], 'dark' => true,
]);
partial('sections/team');
partial('footer');
