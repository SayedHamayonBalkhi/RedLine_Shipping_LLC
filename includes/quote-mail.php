<?php
/**
 * Sends one quote request by email. This is the ONLY place that talks to a mail server.
 *
 * STATUS: written but not yet tested against a real mail account (see README.md, "Quote form").
 * It uses PHPMailer, installed with Composer:   composer require phpmailer/phpmailer
 * (Run it once in the project folder, then upload the generated "vendor" folder.)
 *
 * Returns 'sent', 'not_configured' (settings or PHPMailer missing) or 'failed'.
 */
declare(strict_types=1);

function quote_mail_settings(array $config): array
{
    $q = $config['quote'] ?? [];
    // Secrets can come from server environment variables instead of config.php.
    $env = static fn (string $name, $fallback) => (getenv($name) !== false && getenv($name) !== '') ? getenv($name) : $fallback;
    return [
        'to'         => (string) $env('REDLINE_QUOTE_TO', $q['to_email'] ?? ''),
        'from'       => (string) $env('REDLINE_SMTP_FROM', $q['from_email'] ?? ''),
        'from_name'  => (string) ($q['from_name'] ?? ''),
        'host'       => (string) $env('REDLINE_SMTP_HOST', $q['smtp_host'] ?? ''),
        'port'       => (int) $env('REDLINE_SMTP_PORT', $q['smtp_port'] ?? 0),
        'encryption' => (string) $env('REDLINE_SMTP_ENCRYPTION', $q['smtp_encryption'] ?? 'tls'),
        'user'       => (string) $env('REDLINE_SMTP_USER', $q['smtp_username'] ?? ''),
        'pass'       => (string) $env('REDLINE_SMTP_PASS', $q['smtp_password'] ?? ''),
    ];
}

function quote_mail_is_configured(array $s): bool
{
    return $s['host'] !== '' && $s['port'] >= 1 && $s['port'] <= 65535 && $s['user'] !== '' && $s['pass'] !== ''
        && filter_var($s['from'], FILTER_VALIDATE_EMAIL) && filter_var($s['to'], FILTER_VALIDATE_EMAIL)
        && is_file(ROOT_DIR . '/vendor/autoload.php');
}

/** @param array<string,string> $values already validated: fullName, phone, email, service, message */
function send_quote_email(array $values, array $s, string $companyName): string
{
    if (!quote_mail_is_configured($s)) {
        return 'not_configured';
    }
    require_once ROOT_DIR . '/vendor/autoload.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = $s['host'];
        $mail->Port       = $s['port'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $s['user'];
        $mail->Password   = $s['pass'];
        $mail->SMTPSecure = $s['encryption'] === 'ssl' ? PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS : PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Timeout    = 15;
        $mail->CharSet    = 'UTF-8';

        $mail->setFrom($s['from'], $s['from_name']);
        $mail->addAddress($s['to']);
        // The visitor's address is only used as Reply-To (already validated). PHPMailer also blocks header injection.
        $mail->addReplyTo($values['email'], $values['fullName']);

        $mail->Subject = 'Quote request: ' . $values['service'];
        $mail->Body = implode("\n", [
            'A new quote request was submitted through the ' . $companyName . ' website.',
            '',
            'Name: ' . $values['fullName'],
            'Telephone/WhatsApp: ' . $values['phone'],
            'Email: ' . $values['email'],
            'Service needed: ' . $values['service'],
            '',
            'Message:',
            $values['message'],
            '',
            'Submitted at: ' . gmdate('c'),
        ]);
        $mail->send();
        return 'sent';
    } catch (Throwable $e) {
        // Log only the error class/message, never the customer's details or the password.
        error_log('Quote email delivery failed: ' . get_class($e));
        return 'failed';
    }
}
