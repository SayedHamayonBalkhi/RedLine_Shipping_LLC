<?php
require __DIR__ . '/includes/bootstrap.php';
$route = '/services';
partial('header');
partial('sections/page-hero', [
    'title' => $pages['servicesPage']['hero']['title'], 'description' => $pages['servicesPage']['hero']['description'], 'image' => $images['servicesHero'],
]);
partial('sections/services-list');
partial('sections/safety');
partial('sections/quote-section', [
    'id' => 'quote', 'formId' => 'services-quote', 'reverse' => true,
    'label' => $pages['servicesPage']['quote']['label'], 'title' => $pages['servicesPage']['quote']['title'], 'intro' => $pages['servicesPage']['quote']['intro'],
    'photo' => $images['servicesQuote'],
]);
partial('footer');
