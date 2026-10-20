<?php
/**
 * Loaded first by every page. Loads settings and content, and exposes:
 *   $config   settings (config/config.php, falls back to config/config.example.php)
 *   $site     company details, navigation, footer       (content/site.php)
 *   $pages    page copy                                 (content/pages.php)
 *   $formText quote form text                           (content/form.php)
 *   $images   page images                               (content/images.php)
 *   $services the service list                          (content/services.json)
 */
declare(strict_types=1);

define('ROOT_DIR', dirname(__DIR__));

$configFile = is_file(ROOT_DIR . '/config/config.php') ? 'config.php' : 'config.example.php';
$config = require ROOT_DIR . '/config/' . $configFile;

// Environment variables win over the config file (handy on hosts that provide them).
foreach (['site_url', 'base_path', 'clean_urls', 'analytics_domain'] as $key) {
    $env = getenv('REDLINE_' . strtoupper($key));
    if ($env !== false && $env !== '') {
        $config[$key] = $env;
    }
}

require_once __DIR__ . '/helpers.php';

$site     = require ROOT_DIR . '/content/site.php';
$pages    = require ROOT_DIR . '/content/pages.php';
$formText = require ROOT_DIR . '/content/form.php';
$images   = require ROOT_DIR . '/content/images.php';
$services = json_decode((string) file_get_contents(ROOT_DIR . '/content/services.json'), true, 512, JSON_THROW_ON_ERROR);
$featuredServices = array_values(array_filter($services, static fn (array $s): bool => !empty($s['featured'])));
$serviceNames     = array_column($services, 'name');
