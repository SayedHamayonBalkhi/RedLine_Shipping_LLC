<?php
/** Small template helpers shared by every page. Nothing here depends on a framework. */
declare(strict_types=1);

/** Escape text for safe output inside HTML. */
function e(?string $text): string
{
    return htmlspecialchars((string) $text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Folder the site lives in, e.g. "" for a domain root or "/redline" for a subfolder.
 * Detected automatically from the running script; override with 'base_path' in config.
 */
function base_path(): string
{
    global $config;
    if (isset($config['base_path']) && $config['base_path'] !== '') {
        return '/' . trim((string) $config['base_path'], '/');
    }
    $dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
    // Handlers live one folder down (/handlers/x.php); step back out to the site root.
    if (str_ends_with($dir, '/handlers')) {
        $dir = substr($dir, 0, -strlen('/handlers'));
    }
    return rtrim($dir === '.' ? '' : $dir, '/');
}

/** Public address of a page, e.g. url('/services#long-haul'). Honors the 'clean_urls' setting. */
function url(string $path): string
{
    global $config;
    $hash = '';
    if (($pos = strpos($path, '#')) !== false) {
        $hash = substr($path, $pos);
        $path = substr($path, 0, $pos);
    }
    if ($path !== '/' && !filter_var($config['clean_urls'] ?? true, FILTER_VALIDATE_BOOLEAN)) {
        $path .= '.php';
    }
    return base_path() . $path . $hash;
}

/** Address of a file in assets/ (adds ?v=timestamp so browsers pick up edits). */
function asset(string $path): string
{
    $path = ltrim($path, '/');
    $file = ROOT_DIR . '/assets/' . $path;
    $version = is_file($file) && preg_match('/\.(css|js)$/', $path) ? '?v=' . filemtime($file) : '';
    return base_path() . '/assets/' . $path . $version;
}

/** Full public address (https://example.com/...). Used for canonical and social-sharing tags. */
function absolute_url(string $path): string
{
    global $config;
    $origin = rtrim((string) ($config['site_url'] ?? ''), '/');
    if ($origin === '') {
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $origin = $scheme . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost');
    }
    return $origin . $path;
}

/** Inline SVG icon from includes/icons.php, e.g. icon('mail', 15). */
function icon(string $name, int $size, bool $decorative = true, string $extraAttrs = ''): string
{
    static $shapes = null;
    $shapes ??= require __DIR__ . '/icons.php';
    $inner = $shapes[$name] ?? '';
    $aria = ($decorative ? ' aria-hidden="true"' : '') . ($extraAttrs !== '' ? ' ' . $extraAttrs : '');
    return '<svg xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size
        . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-'
        . $name . '"' . $aria . '>' . $inner . '</svg>';
}

/** Include a partial from includes/ with its variables, e.g. partial('sections/hero'). */
function partial(string $name, array $vars = []): void
{
    global $config, $site, $pages, $formText, $images, $services, $featuredServices, $serviceNames, $route;
    extract($vars, EXTR_SKIP);
    require ROOT_DIR . '/includes/' . $name . '.php';
}

/**
 * Photo with a branded fallback box if the file is missing (assets/js/main.js swaps it in).
 * $eager = true for above-the-fold images that must not be lazy-loaded.
 */
function freight_image(string $src, string $alt, string $class = '', bool $eager = false): string
{
    $classAttr = $class !== '' ? ' class="' . e($class) . '"' : '';
    return '<img' . $classAttr . ' src="' . e(asset($src)) . '" alt="' . e($alt) . '" loading="' . ($eager ? 'eager' : 'lazy')
        . '" fetchpriority="' . ($eager ? 'high' : 'auto') . '" decoding="async" data-image-fallback>';
}

/** Red (primary) or outlined link-button. $icon is an icon name; $href may be an internal path. */
function button(string $href, string $label, string $variant = 'primary', ?string $icon = null, int $iconSize = 15): string
{
    $class = $variant === 'outline' ? 'button button-outline' : 'button';
    $isInternal = str_starts_with($href, '/');
    $iconHtml = $icon !== null ? ' ' . icon($icon, $iconSize) : '';
    return '<a class="' . $class . '" href="' . e($isInternal ? url($href) : $href) . '">' . e($label) . $iconHtml . '</a>';
}

/** Small label, big title and an optional intro paragraph. Used at the top of most sections. */
function section_heading(string $label, string $title, ?string $intro = null, ?string $id = null): string
{
    $idAttr = $id !== null ? ' id="' . e($id) . '"' : '';
    return '<div class="section-heading"><div><div class="eyebrow">' . e($label) . '</div><h2' . $idAttr . '>' . e($title) . '</h2></div>'
        . ($intro !== null && $intro !== '' ? '<p>' . e($intro) . '</p>' : '') . '</div>';
}

/** Title and description for the current route (legal pages and unknown addresses use the fallback). */
function page_meta(string $route): array
{
    global $pages, $site;
    if (isset($pages['meta']['routes'][$route])) {
        return $pages['meta']['routes'][$route];
    }
    $legalTitles = [
        '/terms'   => $pages['legal']['titles']['terms'],
        '/privacy' => $pages['legal']['titles']['privacy'],
        '/cookies' => $pages['legal']['titles']['cookies'],
    ];
    return [
        'title'       => ($legalTitles[$route] ?? $pages['meta']['notFoundTitle']) . ' | ' . $site['companyName'],
        'description' => $pages['meta']['fallbackDescription'],
    ];
}

/** LocalBusiness structured data (same fields as the original site). */
function business_json_ld(): string
{
    global $site;
    $c = $site['contact'];
    $data = [
        '@context'    => 'https://schema.org',
        '@type'       => 'LocalBusiness',
        'name'        => $site['companyName'],
        'description' => $site['seo']['description'],
        'url'         => absolute_url(base_path() . '/'),
        'image'       => absolute_url(base_path() . '/assets/' . $site['seo']['shareImage']),
        'telephone'   => str_replace('tel:', '', $c['phoneHref']),
        'email'       => $c['email'],
        'address'     => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => $c['addressParts']['street'],
            'addressLocality' => $c['addressParts']['city'],
            'addressRegion'   => $c['addressParts']['region'],
            'postalCode'      => $c['addressParts']['postalCode'],
            'addressCountry'  => $c['addressParts']['country'],
        ],
        'identifier'  => [
            ['@type' => 'PropertyValue', 'name' => 'USDOT', 'value' => $site['credentials']['usdot']],
            ['@type' => 'PropertyValue', 'name' => 'MC',    'value' => $site['credentials']['mc']],
        ],
    ];
    return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG);
}
