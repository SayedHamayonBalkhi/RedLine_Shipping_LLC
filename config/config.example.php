<?php
/**
 * Site settings. To use: copy this file to config/config.php and edit the copy.
 * config/config.php is ignored by Git, so real values never reach a public repository.
 *
 * Best practice on a real host: keep secrets (SMTP password) in server environment
 * variables, or place config.php outside the public web folder and point to it from here.
 */
return [

    // ---- Website address --------------------------------------------------------------
    // Your domain ONLY, with no trailing slash and no folder, e.g. 'https://www.example.com'.
    // (If the site is in a subfolder, the folder is added automatically.)
    // Used for canonical links, link previews, sitemap.xml and robots.txt.
    // Leave empty to detect it from the visitor's request.
    'site_url' => '',

    // Subfolder the site is uploaded to ('' for a domain root, '/redline' for a subfolder).
    // Leave empty: it is detected automatically.
    'base_path' => '',

    // true  -> addresses like /services  (needs the included .htaccess, or the nginx rules in README.md)
    // false -> addresses like /services.php (works on any PHP host with no rewrite rules)
    'clean_urls' => true,

    // ---- Optional analytics (off when empty) -------------------------------------------
    // Plausible (cookie-free). Set to your domain, e.g. 'redlineshippingllc.com'.
    'analytics_domain' => '',
    'analytics_src'    => 'https://plausible.io/js/script.js',

    // ---- Quote form email ---------------------------------------------------------------
    // Used by handlers/submit-quote.php. Mail delivery is NOT active until these are filled in
    // (see "Quote form" in README.md). Until then visitors see the "not configured" message
    // with the phone number and email address.
    'quote' => [
        // Where quote requests are delivered.
        'to_email' => 'dispatch@redlineshippingllc.com',

        // Sender address. Use an address your mail provider allows you to send from.
        'from_email' => 'website@example.com',
        'from_name'  => 'Redline Shipping LLC website',

        'smtp_host'       => '',          // e.g. smtp.yourprovider.com
        'smtp_port'       => 587,         // 587 (STARTTLS) or 465 (SSL)
        'smtp_encryption' => 'tls',       // 'tls' (STARTTLS, port 587) or 'ssl' (port 465)
        'smtp_username'   => '',
        'smtp_password'   => '',          // keep this out of Git; prefer an environment variable

        // Requests allowed per visitor IP address per window (basic abuse protection).
        'rate_limit_max'     => 5,
        'rate_limit_minutes' => 10,
    ],
];
