<?php
require __DIR__ . '/includes/bootstrap.php';
$route = '/';
partial('header');
partial('sections/hero');
partial('sections/quote-section', [
    'id' => 'quote', 'formId' => 'home-quote',
    'label' => $pages['home']['quote']['label'], 'title' => $pages['home']['quote']['title'], 'intro' => $pages['home']['quote']['intro'],
    'photo' => $images['homeQuote'],
]);
partial('sections/contact-info', ['intro' => $pages['home']['contactIntro']]);
partial('sections/mission');
partial('sections/how-it-works', [
    'label' => $pages['home']['process']['label'], 'title' => $pages['home']['process']['title'], 'intro' => $pages['home']['process']['intro'],
    'steps' => $pages['home']['process']['steps'], 'dark' => false,
]);
partial('sections/featured-services');
partial('sections/why-choose');
partial('sections/final-cta');
partial('footer');
