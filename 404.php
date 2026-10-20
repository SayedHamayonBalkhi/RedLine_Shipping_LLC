<?php
/** "Page not found". Apache serves this through ErrorDocument in .htaccess; router.php does the same locally. */
require __DIR__ . '/includes/bootstrap.php';
http_response_code(404);
$route = '/404';
$noindex = true;
partial('header');
partial('sections/legal-page', ['heading' => $pages['legal']['notFoundHeading'], 'text' => $pages['legal']['notFound']]);
partial('footer');
