<?php
/**
 * Local development only. Mimics the .htaccess rules for PHP's built-in server:
 *
 *     php -S localhost:8000 router.php
 *
 * It is not used on a real web host.
 */
$path = rawurldecode((string) parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH));

// Folders that must never be served directly.
if (preg_match('#^/(includes|content|config|storage|vendor)(/|$)#', $path) || preg_match('#(^|/)\.#', $path)) {
    http_response_code(403);
    echo 'Forbidden';
    return true;
}

$clean = [
    '/'            => 'index.php',
    '/services'    => 'services.php',
    '/about'       => 'about.php',
    '/contact'     => 'contact.php',
    '/terms'       => 'terms.php',
    '/privacy'     => 'privacy.php',
    '/cookies'     => 'cookies.php',
    '/robots.txt'  => 'robots.php',
    '/sitemap.xml' => 'sitemap.php',
];
$trimmed = $path === '/' ? '/' : rtrim($path, '/');

if (isset($clean[$trimmed])) {
    $_SERVER['SCRIPT_NAME'] = '/' . $clean[$trimmed];
    require __DIR__ . '/' . $clean[$trimmed];
    return true;
}

// Real files (CSS, images, direct .php pages, the form handler) are served as they are.
if ($path !== '/' && is_file(__DIR__ . $path)) {
    return false;
}

$_SERVER['SCRIPT_NAME'] = '/404.php';
require __DIR__ . '/404.php';
return true;
