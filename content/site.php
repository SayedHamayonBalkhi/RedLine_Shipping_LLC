<?php
/**
 * Site-wide content: company details, contact info, navigation, footer, default SEO.
 * Edit this file to change a phone number, email, address, menu item or footer link.
 * Returns a plain PHP array; includes/bootstrap.php loads it as $site.
 */

$email = 'dispatch@redlineshippingllc.com';
$phone = '+1 (469) 509-6876';
$address = [
    'street'     => '7228 Headingham Wy',
    'city'       => 'McKinney',
    'region'     => 'TX',
    'postalCode' => '75071',
    'country'    => 'US',
];

return [
    'companyName' => 'Redline Shipping LLC',

    'contact' => [
        'email'        => $email,
        'phone'        => $phone,
        // Built from $phone, so you only edit the phone number once.
        'phoneHref'    => 'tel:+' . preg_replace('/\D/', '', $phone),
        // Built from the address parts above.
        'address'      => "{$address['street']}, {$address['city']}, {$address['region']} {$address['postalCode']}",
        'mapUrl'       => 'https://www.google.com/maps/search/?api=1&query='
            . preg_replace('/\s+/', '+', implode(' ', [$address['street'], $address['city'], $address['region'], $address['postalCode']])),
        'addressParts' => $address,
    ],

    'credentials' => ['usdot' => '4907589', 'mc' => '90056618'],

    // Leave a link empty to show the label as "coming soon" text instead of a link.
    'social' => ['facebook' => '', 'instagram' => '', 'x' => ''],

    'brandAriaLabel' => 'RedLine LLC home',

    // Screen-reader labels for menus and links.
    'a11y' => [
        'mainNavigation'       => 'Main navigation',
        'openMenu'             => 'Open navigation',
        'closeMenu'            => 'Close navigation',
        'footerServices'       => 'Services',
        'footerCompany'        => 'Company',
        'footerContact'        => 'Quick contact',
        'footerLegal'          => 'Legal',
        'footerSocial'         => 'Follow us on social media',
        'socialComingSoon'     => 'profile link coming soon',
        'socialComingSoonHint' => 'The official profile link will be added here.',
    ],
    'topline' => 'Freight transportation · United States',

    'nav' => [
        ['label' => 'Home',         'to' => '/'],
        ['label' => 'Our Services', 'to' => '/services'],
        ['label' => 'About Us',     'to' => '/about'],
        ['label' => 'Contact',      'to' => '/contact'],
    ],
    'navQuote' => ['label' => 'Get a Quote', 'to' => '/contact#quote'],

    'footer' => [
        'blurb'         => 'Dependable freight transportation across the USA, with careful planning and clear communication.',
        'servicesTitle' => 'Services',
        'companyTitle'  => 'Company',
        'contactTitle'  => 'Quick Contact',
        'companyLinks'  => [
            ['label' => 'Home',         'to' => '/'],
            ['label' => 'About Us',     'to' => '/about'],
            ['label' => 'Our Services', 'to' => '/services'],
            ['label' => 'Contact Us',   'to' => '/contact'],
        ],
        'legalLinks' => [
            ['label' => 'Terms of Service', 'to' => '/terms'],
            ['label' => 'Privacy Policy',   'to' => '/privacy'],
            ['label' => 'Cookie Policy',    'to' => '/cookies'],
        ],
        // Shown as "© {year} {companyName}. All rights reserved." The year updates itself.
        'rights'       => 'All rights reserved.',
        'followUs'     => 'Follow Us',
        'socialLabels' => ['facebook' => 'Facebook', 'instagram' => 'Instagram', 'x' => 'X'],
    ],

    // Default head tags (used for the home page and as the base for link previews).
    'seo' => [
        'title'            => 'Redline Shipping LLC | Freight Transportation',
        'description'      => 'Redline Shipping LLC provides long-haul, regional, refrigerated, expedited, and oversized freight transportation across the United States.',
        'shareDescription' => 'Freight transportation with careful planning and clear communication.',
        // Path inside assets/. Used for link previews.
        'shareImage'       => 'images/hero-truck.jpeg',
    ],
];
