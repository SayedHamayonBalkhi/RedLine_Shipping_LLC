<?php
/**
 * Receives the quote form (JSON via POST from assets/js/main.js), validates it again on the
 * server, and emails it. Replies with JSON:  {"accepted":true}  or  {"message":"...","errors":{...}}
 *
 * Same rules as the original Node server: 422 invalid, 503 not configured, 429 too many, 502 delivery failed.
 */
declare(strict_types=1);

require __DIR__ . '/../includes/bootstrap.php';
require __DIR__ . '/../includes/quote-mail.php';

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

function reply(int $status, array $body): never
{
    http_response_code($status);
    echo json_encode($body, JSON_UNESCAPED_UNICODE);
    exit;
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    header('Allow: POST');
    reply(405, ['message' => 'Method not allowed.']);
}

$raw = file_get_contents('php://input', false, null, 0, 32 * 1024 + 1);
if ($raw === false || strlen($raw) > 32 * 1024) {
    reply(413, ['message' => 'Request too large.']);
}
$input = json_decode($raw, true);
$input = is_array($input) ? $input : [];
$str = static fn ($v): string => is_scalar($v) ? (string) $v : '';

$values = [
    'fullName' => trim(preg_replace('/[\r\n\t]+/', ' ', $str($input['fullName'] ?? '')) ?? ''),
    'email'    => trim($str($input['email'] ?? '')),
    'phone'    => trim($str($input['phone'] ?? '')),
    'service'  => trim($str($input['service'] ?? '')),
    'message'  => trim($str($input['message'] ?? '')),
];
$err = $formText['errors'];
$errors = [];

if ($values['fullName'] === '' || mb_strlen($values['fullName']) > 160) $errors['fullName'] = $err['fullName'];
if (mb_strlen($values['email']) > 254 || !preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $values['email'])) $errors['email'] = $err['email'];
$digits = preg_replace('/\D/', '', $values['phone']);
if (mb_strlen($values['phone']) > 30 || strlen($digits) < 7 || strlen($digits) > 15) $errors['phone'] = $err['phone'];
if (!in_array($values['service'], $serviceNames, true)) $errors['service'] = $err['service'];
// Normalise line breaks and strip control characters from the message.
$values['message'] = preg_replace('/[\x00-\x08\x0b\x0c\x0e-\x1f\x7f]/', '', preg_replace('/\r\n?/', "\n", $values['message']));
if (trim($values['message']) === '' || mb_strlen($values['message']) > 5000) $errors['message'] = $err['message'];

// Bots fill the hidden "website" field: pretend success and send nothing.
if (trim($str($input['website'] ?? '')) !== '') {
    reply(201, ['accepted' => true]);
}
if ($errors) {
    reply(422, ['message' => $formText['invalidFields'], 'errors' => $errors]);
}

$settings = quote_mail_settings($config);
if (!quote_mail_is_configured($settings)) {
    reply(503, ['message' => $formText['notConfigured']]);
}

// Basic rate limit per visitor address (files in storage/, which must be writable).
$limit  = max(1, (int) ($config['quote']['rate_limit_max'] ?? 5));
$window = max(1, (int) ($config['quote']['rate_limit_minutes'] ?? 10)) * 60;
$dir = ROOT_DIR . '/storage';
$file = $dir . '/rate-' . hash('sha256', $_SERVER['REMOTE_ADDR'] ?? 'unknown') . '.json';
$now = time();
$hits = is_file($file) ? (json_decode((string) file_get_contents($file), true) ?: []) : [];
$hits = array_values(array_filter($hits, static fn ($t): bool => is_int($t) && $t > $now - $window));
if (count($hits) >= $limit) {
    reply(429, ['message' => $formText['rateLimited']]);
}
$hits[] = $now;
if (is_dir($dir) && is_writable($dir)) {
    @file_put_contents($file, json_encode($hits), LOCK_EX);
}

$result = send_quote_email($values, $settings, $site['companyName']);
if ($result !== 'sent') {
    reply(502, ['message' => $formText['deliveryFailed']]);
}
reply(201, ['accepted' => true]);
