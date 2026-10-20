<?php
/** Served as /sitemap.xml. To add a page, add its route to the list below. */
require __DIR__ . '/includes/bootstrap.php';
header('Content-Type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach (['/', '/services', '/about', '/contact'] as $route) {
    echo '  <url><loc>' . e(absolute_url(url($route))) . '</loc></url>' . "\n";
}
echo "</urlset>\n";
