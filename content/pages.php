<?php
/**
 * Page copy: headlines, paragraphs, steps, FAQs and per-page browser titles.
 * Edit text here. Company name, phone and address come from site.php.
 * Returns a plain PHP array; includes/bootstrap.php loads it as $pages.
 */

/** @var array $site Loaded by bootstrap.php before this file is included. */
$name = $site['companyName'];

return [

    // Text shared by several pages.
    'common' => [
        'buttons' => [
            'requestQuote'   => 'Request a Quote',
            'viewAllServices'=> 'View all services',
            'exploreServices'=> 'Explore Our Services',
            'backHome'       => 'Back to Home',
            'learnMoreAbout' => 'Learn more about us',
            'exploreService' => 'Explore service',
            'call'           => 'Call',
        ],
        'contactInfo'  => ['label' => 'contact', 'title' => 'Contact Information'],
        'contactCards' => [
            'email'   => ['label' => 'Email',   'action' => 'Send an email'],
            'phone'   => ['label' => 'Phone',   'action' => 'Call now'],
            'address' => ['label' => 'Address', 'action' => 'Get directions'],
        ],
        'imageFallbackText' => 'REDLINE LLC',
        'pageHeroIndex'     => 'FREIGHT · TRANSPORTATION',
    ],

    'home' => [
        'hero' => [
            'headingLines'  => ['Your freight.', 'Our road.'],
            'headingAccent' => 'Ready to move.',
            'copy'          => 'We move freight across the USA with experienced drivers, careful planning, and responsive communication.',
            'chipsLabel'    => 'Service highlights',
            // Chip icons: map, shield, phone (see includes/icons.php)
            'chips' => [
                ['icon' => 'map-pin',      'label' => 'Nationwide coverage'],
                ['icon' => 'shield-check', 'label' => 'Safety-focused drivers'],
                ['icon' => 'phone',        'label' => 'Direct line to dispatch'],
            ],
            'indexText' => 'REDLINE LLC · TRANSPORTATION',
        ],
        'quote' => [
            'label' => 'get a quote',
            'title' => "Tell us what you're hauling",
            'intro' => 'Share a few details and our dispatch team will come back to you with a clear, honest quote.',
        ],
        'contactIntro' => 'Prefer to talk it through? Reach us any way that suits you.',
        'mission' => [
            'label' => 'about us',
            'title' => 'Built on safe miles and straight talk',
            'mission' => [
                'eyebrow' => 'Our Mission',
                'heading' => 'Dependable work, built on integrity.',
                'body'    => 'To move freight reliably and efficiently, and to look after the people who move it. We support our owner-operators and drivers with a safe, respectful environment, and we hold ourselves to a simple standard with every customer: do what we said, when we said, with integrity.',
            ],
            'vision' => [
                'eyebrow' => 'Our Vision',
                'heading' => 'A trusted partner for freight across the country.',
                'body'    => 'To become one of the most trusted trucking companies in the United States, known for excellence, smart innovation, and responsible, sustainable operations. We are building a community where drivers and owner-operators thrive, and where businesses can count on a supply chain that keeps moving.',
            ],
        ],
        'process' => [
            'label' => 'how it works',
            'title' => 'How It Works',
            'intro' => 'Simple from the first call to the final delivery.',
            'steps' => [
                ['title' => 'Plan It Together',  'description' => 'Tell us about your freight, lanes, and deadlines. We shape the plan around your needs, not the other way around.'],
                ['title' => 'Load It Right',     'description' => 'Careful loading and proper securement, then a driver who treats your cargo like their own.'],
                ['title' => 'Stay in the Loop',  'description' => 'You’ll hear from us along the way, so you’re never left wondering where your shipment is.'],
            ],
        ],
        'services' => [
            'label' => 'our services',
            'title' => 'Trucking and logistics, built around your freight',
            'intro' => "From cross-country hauls to same-region runs, we move your freight safely and on schedule. Pick the service that fits, or call us and we'll help you choose.",
        ],
        'why' => [
            'label' => 'why choose us',
            'title' => 'Why shippers stick with Redline',
            // Icons: badge-check, phone, compass, clock3 (see includes/icons.php)
            'items' => [
                ['title' => 'Reliable Delivery', 'icon' => 'badge-check', 'description' => 'We plan every run to arrive when we said it would, and we tell you early if anything changes.'],
                ['title' => 'Easy to Reach',     'icon' => 'phone',       'description' => 'Call, email, or send a message. You’ll get a real answer from a real person, not a maze of menus.'],
                ['title' => 'Expert Guidance',   'icon' => 'compass',     'description' => 'Not sure how to ship it? Our team helps you pick the right equipment, route, and timing.'],
                ['title' => 'Same-Day Options',  'icon' => 'clock3',     'description' => 'Urgent freight? Ask about same-day and expedited runs where lanes and capacity allow.'],
            ],
        ],
        'cta' => [
            'eyebrow' => 'Start a conversation',
            'title'   => 'Ready to Move Your Freight?',
            'body'    => 'Need dependable freight transportation? Contact our team to discuss your shipment and request a quote.',
        ],
    ],

    'servicesPage' => [
        'hero' => [
            'title'       => 'Our Services',
            'description' => 'Explore our freight transportation services and tell us about your shipment, route, and timing.',
        ],
        'list' => [
            'label' => 'our services',
            'title' => 'Trucking and logistics, built around your freight',
            'intro' => 'Explore our current service categories, then tell us about your freight, route, and timing so our team can discuss available options.',
        ],
        'safety' => [
            'eyebrow' => 'our promise',
            'title'   => 'Safety is how we work.',
            'intro'   => "Every mile starts with preparation. Here's what you can expect when your freight rides with Redline.",
            'promises' => [
                'Drivers who are rested, trained, and respected',
                'Equipment checked before it rolls',
                'Cargo properly secured, every load',
                "Honest communication, even when the news isn't perfect",
            ],
        ],
        'quote' => [
            'label' => 'request a quote',
            'title' => 'Ready when you are',
            'intro' => "Send us the details and we'll get back to you with a clear quote.",
        ],
    ],

    'aboutPage' => [
        'hero' => [
            'title'       => 'About Us',
            'description' => "$name is a freight transportation company based in McKinney, Texas.",
        ],
        'detail' => [
            'label'         => 'about us',
            'title'         => 'A US-based freight partner you can actually reach',
            'body'          => "$name is a trucking and logistics company based in McKinney, Texas. We keep things simple: dependable trucks, careful drivers, and clear communication from pickup to delivery.",
            'locationBadge' => 'McKinney, Texas',
        ],
        'faqs' => [
            ['question' => 'What services do you offer?',
             'answer'   => 'We offer long-haul and regional trucking, refrigerated transport, oversized loads, and expedited shipping, with expert guidance to match each shipment to the right solution.'],
            ['question' => 'Where are you located?',
             'answer'   => 'Our office is in McKinney, Texas, and we haul freight across the USA.'],
            ['question' => 'How do you keep deliveries on time?',
             'answer'   => 'Careful planning up front, one clear point of contact, and regular check-ins along the way. If something changes, you hear it from us first.'],
        ],
        'whatWeDo' => ['label' => 'service', 'title' => 'What we do'],
        'process' => [
            'label' => 'how it works',
            'title' => 'Fast, controlled, and safety-led',
            'intro' => 'A good delivery is no accident. Every shipment follows the same careful path, with safety checked at each step.',
            'steps' => [
                ['title' => 'Get a Quote',     'description' => 'Tell us what you’re shipping and when. We’ll reply with a clear, competitive quote.'],
                ['title' => 'Load & Secure',   'description' => 'Your freight is loaded carefully and secured to standard for the trip ahead.'],
                ['title' => 'On the Road',     'description' => 'An experienced driver takes it from here, with dispatch watching the clock and keeping you informed.'],
                ['title' => 'Delivered',       'description' => 'Your shipment arrives on schedule, and we check in to make sure everything went as it should.'],
            ],
        ],
        'team' => [
            'label' => 'our team',
            'title' => 'The people behind the miles',
            'intro' => 'Behind every load is a crew that cares how it gets there.',
            // Icons: truck, shield-check, message-circle (see includes/icons.php)
            'members' => [
                ['role' => 'Dispatch Desk',        'icon' => 'truck',          'description' => 'Coordinates pickup, routes, and shipment updates with a direct line to your load.'],
                ['role' => 'Safety & Compliance',  'icon' => 'shield-check',   'description' => 'Supports responsible planning, equipment checks, and freight securement.'],
                ['role' => 'Customer Support',     'icon' => 'message-circle', 'description' => 'Helps answer questions and keeps communication clear from first call onward.'],
            ],
        ],
    ],

    'contactPage' => [
        'hero' => [
            'title'       => 'Contact Us',
            'description' => "Have a question, a tricky load, or a deadline? Talk to $name and let's find the right solution.",
        ],
        'quote' => [
            'label' => 'get in touch',
            'title' => "Let's talk freight",
            'intro' => 'Tell us what you need to move. We’ll respond to your inquiry as soon as possible.',
        ],
        'infoIntro' => 'Talk with our team by email or phone, or find our office in McKinney.',
    ],

    // Legal pages are placeholders until real text is supplied.
    // To publish real text, replace 'placeholder' for that page with the final copy.
    'legal' => [
        'titles'          => ['terms' => 'Terms of Service', 'privacy' => 'Privacy Policy', 'cookies' => 'Cookie Policy'],
        'notFoundHeading' => 'Page not found',
        'placeholder'     => 'This page is being prepared.',
        'notFound'        => 'The page you are looking for could not be found.',
        // Added to the Privacy and Cookie pages only when analytics is switched on (config 'analytics_domain').
        'analyticsNote'   => 'This site uses privacy-friendly analytics. It sets no cookies and does not track individual visitors across other sites.',
    ],

    // Browser tab titles and search descriptions for each page.
    'meta' => [
        'routes' => [
            '/' => [
                'title'       => 'Redline Shipping LLC | Freight Transportation',
                'description' => "Request a freight quote from $name. Explore long-haul, regional, refrigerated, expedited, and oversized transportation.",
            ],
            '/services' => [
                'title'       => "Freight Services | $name",
                'description' => "Explore $name freight services, including long-haul, regional, refrigerated, expedited, and oversized transport.",
            ],
            '/about' => [
                'title'       => "About $name | McKinney, Texas",
                'description' => "Learn about $name, a freight transportation company based in McKinney, Texas.",
            ],
            '/contact' => [
                'title'       => "Request a Freight Quote | $name",
                'description' => "Contact $name to discuss your shipment and request a freight transportation quote.",
            ],
        ],
        // Used for the legal pages and for unknown addresses.
        'fallbackDescription' => "Contact $name about freight transportation and quote requests.",
        'notFoundTitle'       => 'Page Not Found',
    ],
];
