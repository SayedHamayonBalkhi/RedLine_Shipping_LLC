<?php
require __DIR__ . '/includes/bootstrap.php';
$route = '/contact';
partial('header');
partial('sections/page-hero', [
    'title' => $pages['contactPage']['hero']['title'], 'description' => $pages['contactPage']['hero']['description'], 'image' => $images['contactHero'],
]);
partial('sections/quote-section', [
    'id' => 'quote', 'formId' => 'contact-quote',
    'label' => $pages['contactPage']['quote']['label'], 'title' => $pages['contactPage']['quote']['title'], 'intro' => $pages['contactPage']['quote']['intro'],
    'photo' => $images['contactWorker'],
]);
partial('sections/contact-info', ['intro' => $pages['contactPage']['infoIntro'], 'large' => true]);
partial('footer');
