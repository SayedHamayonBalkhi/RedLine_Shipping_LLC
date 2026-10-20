<?php
/** Quote form text: headings, field labels, placeholders, validation and result messages. */
return [
    'heading'      => 'Get in touch with Redline Shipping LLC',
    'subheading'   => 'We’ll respond to your inquiry as soon as possible.',
    'sectionTitle' => ['number' => '01', 'label' => 'Shipment inquiry'],
    'fields' => [
        'fullName' => ['label' => 'Your Name',       'placeholder' => 'Enter your full name.'],
        'phone'    => ['label' => 'Tel/WhatsApp',    'placeholder' => 'Include your country code.'],
        'email'    => ['label' => 'Your Email',      'placeholder' => 'Enter your email address.'],
        'service'  => ['label' => 'Services Needed', 'placeholder' => 'Select the service you need.'],
        'message'  => ['label' => 'Your Message',    'placeholder' => 'Describe your shipment and requirements.'],
    ],
    'errors' => [
        'fullName' => 'Enter your full name.',
        'email'    => 'Enter a valid email address.',
        'phone'    => 'Enter a valid phone number, including your country code.',
        'service'  => 'Select one of the listed services.',
        'message'  => 'Describe your shipment in 5,000 characters or fewer.',
    ],
    'submit'     => 'Send Inquiry',
    'submitting' => 'Submitting...',
    'note'       => 'Your details are used to follow up about this inquiry.',
    // {phone} and {email} are filled in from site.php.
    'fallbackError' => 'We could not send your inquiry. Please call {phone} or email {email}.',
    // Message shown when the server has not been given mail settings yet.
    'notConfigured' => 'Quote email delivery is not configured yet. Please contact us by phone or email while we finish setup.',
    'deliveryFailed' => 'We could not deliver your inquiry just now. Your details are still in the form; please try again or contact us directly.',
    'rateLimited'   => 'Too many quote requests have been sent from this connection. Please wait a few minutes or contact us directly.',
    'invalidFields' => 'Please check the highlighted fields.',
    // Email subject prefix used by the handler.
    'emailSubject' => 'Quote request',
    'success' => 'Submission successful! Thank you for your message, we will reply to you as soon as possible.',
];
