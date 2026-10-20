<?php
/** Served as /robots.txt. The sitemap address comes from 'site_url' in config. */
require __DIR__ . '/includes/bootstrap.php';
header('Content-Type: text/plain; charset=utf-8');
echo "User-agent: *\nAllow: /\n\nSitemap: " . absolute_url(base_path() . '/sitemap.xml') . "\n";
