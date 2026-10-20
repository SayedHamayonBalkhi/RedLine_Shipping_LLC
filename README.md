# Redline Shipping LLC website

Plain **HTML + CSS + vanilla JavaScript + PHP**. No Node, no build step, no Tailwind, no database, no Replit.
It looks and behaves like the previous React/Vite/Tailwind version (see "What changed" below).

## Contents
1. [Run it locally](#run-it-locally)
2. [Project structure](#project-structure)
3. [Deploy to PHP hosting](#deploy-to-php-hosting)
4. [Quote form (email) - STILL TO FINISH](#quote-form-email--still-to-finish)
5. [What changed from the React version](#what-changed-from-the-react-version)
6. [Tests that were run](#tests-that-were-run)
7. [Known limitations](#known-limitations)

See **MAINTENANCE.md** for how to change text, images, contact details and styles.

## Run it locally
Requires PHP 8.1 or newer (extensions `mbstring`, `json`; `curl`/`openssl` only for email).

```bash
php -S localhost:8000 router.php
```
Open http://localhost:8000. `router.php` is only for this local server; it copies the `.htaccess` rules.
XAMPP/MAMP also work: put the folder in `htdocs` (the included `.htaccess` needs `mod_rewrite` on, which XAMPP has by default).

## Project structure
```
index.php, services.php, about.php,      One file per page (clean URLs: /services, /about ...)
contact.php, terms.php, privacy.php,
cookies.php, 404.php
robots.php, sitemap.php                  Served as /robots.txt and /sitemap.xml
.htaccess                                Apache: clean URLs, blocks private folders, headers, caching
router.php                               Local dev server only
content/                                 ALL TEXT: site.php (company, contact, menu, footer), pages.php (page copy),
                                         form.php (form labels/messages), images.php (which photo where), services.json
includes/                                Page building blocks: header.php, footer.php, sections/*.php, quote-form.php,
                                         helpers.php, icons.php, bootstrap.php, quote-mail.php
assets/css/                              base.css (colours/fonts/reset), layout.css (header/footer),
                                         sections.css (page sections), components.css (cards, form, FAQ)
assets/js/main.js                        Menu, FAQ, header, image fallback, quote form
assets/images/  assets/fonts/            Photos (assets/images/_unused/ = files nothing uses) and self-hosted fonts
handlers/submit-quote.php                Receives the quote form
config/config.example.php                Settings template -> copy to config/config.php
storage/                                 Rate-limit files (must be writable)
```

## Deploy to PHP hosting
**Requirements:** PHP 8.1+, Apache with `mod_rewrite` (or see Nginx below). No database.

1. Copy `config/config.example.php` to `config/config.php` and set `site_url` (domain only, e.g. `https://www.example.com`).
2. Upload everything to the web root (`public_html`) via FTP/SFTP/Git. A subfolder works too; no setting is needed
   (if the site is in a subfolder and you use `.htaccess`, uncomment `RewriteBase` and the `ErrorDocument` path in it).
3. Make `storage/` writable (`chmod 775`, or 755 if the host runs PHP as your user).
4. Turn on HTTPS (free certificate from your host, e.g. Let's Encrypt/AutoSSL), then uncomment the HTTPS redirect in `.htaccess`.
5. Visit each page. If `/services` gives a 404 but `/services.php` works, mod_rewrite is off: either enable it or set
   `'clean_urls' => false` in `config/config.php` (links then use `.php` addresses; nothing else changes).
6. Document root: if your host lets you choose it, the project folder itself is the document root. For extra safety you can
   place `config/config.php` outside the web root and `require` it from `includes/bootstrap.php`; the `.htaccess` already blocks
   direct access to `config/`, `includes/`, `content/`, `storage/` and dotfiles.

**Nginx** (no `.htaccess`): add
```nginx
location / { try_files $uri $uri/ @pages; }
location @pages { rewrite ^/(services|about|contact|terms|privacy|cookies)/?$ /$1.php last; rewrite ^/robots\.txt$ /robots.php last; rewrite ^/sitemap\.xml$ /sitemap.php last; return 404; }
location ~ ^/(includes|content|config|storage|vendor)/ { deny all; }
location ~ /\.(?!well-known) { deny all; }
error_page 404 /404.php;
location ~ \.php$ { include fastcgi_params; fastcgi_pass unix:/run/php/php-fpm.sock; fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name; }
```
Static-only hosts (GitHub Pages, Netlify without PHP) cannot run this site: the pages and quote form need PHP.

## Quote form (email) - STILL TO FINISH
As agreed, the email part is left for you to finish and verify. What exists:
* The form (same fields, labels, validation and messages as before) posts JSON to `handlers/submit-quote.php`.
* The handler validates again on the server (lengths, email, phone, service must be one of the listed ones),
  has a hidden honeypot field, a per-IP rate limit, and answers 422 / 429 / 503 / 502 / 201 exactly like the old Node server.
* The browser shows **success only when the server answers `{"accepted":true}`**; on any failure it shows an error and keeps what the visitor typed.
* Until mail is configured the handler answers 503 and visitors see: "Quote email delivery is not configured yet. Please contact us by phone or email...".

To finish:
1. `composer require phpmailer/phpmailer` in the project folder (or `composer install`), then upload the `vendor/` folder.
   (No Composer? Download PHPMailer from GitHub and place it so `vendor/autoload.php` loads `PHPMailer\PHPMailer\PHPMailer`.)
2. Fill the `quote` section of `config/config.php` (recipient, sender, SMTP host/port/encryption/user/password), **or** set
   environment variables `REDLINE_QUOTE_TO`, `REDLINE_SMTP_FROM`, `REDLINE_SMTP_HOST`, `REDLINE_SMTP_PORT`,
   `REDLINE_SMTP_ENCRYPTION`, `REDLINE_SMTP_USER`, `REDLINE_SMTP_PASS`. Never commit passwords (`config/config.php` is git-ignored).
3. The sender (`from_email`) must be an address your mail provider lets you send from. The visitor's email is used only as Reply-To.
4. Send a real test quote and confirm it arrives. An SMTP "accepted" answer does not guarantee inbox delivery; check spam folders and SPF/DKIM.
5. Not implemented yet (the "enhancement" you will do): CSRF token, CAPTCHA, a no-JavaScript fallback, a copy/log of submissions.
   The email code in `includes/quote-mail.php` has **never been run against a real mail server**.

## What changed from the React version
**Removed:** React, React Router, Vite, TypeScript, Tailwind CSS (+ typography/animate plugins), the Node `server.mjs`, `package.json`,
Google Fonts request, GitHub-Pages workflow, `.bat` launcher. **Kept:** every page, URL, text, image, colour, size and breakpoint.
There were no Replit-specific files or services in this zip (no `.replit`, no Replit packages or environment variables).

Visual check against the original, same fonts, 5 pages x 5 widths: **24 of 25 full-page screenshots pixel-identical**; one differs by
52 pixels (a sub-pixel text shift in "03 / 03"). Element-by-element computed-style comparison at 16 widths (360 to 1440, including every breakpoint boundary) shows no visible differences except the items below.

Behaviour the old build had *by accident* and that is reproduced on purpose: the content width steps from Tailwind's `.container`
(640/768/1024px caps at some widths), and the fade-in is opacity-only (the slide-up in the source never actually ran).

**Defects found in the original** (reported, fixed only where noted):
1. *Fixed:* between 701px and 760px wide there was **no navigation at all** (menu button hidden, links hidden). The button now appears at 760px.
2. *Fixed:* in the open mobile menu, the current page's link was white on ivory (invisible) at the top of the page. It is now red.
3. *Not changed:* the header never sticks while scrolling (`.site-shell{overflow:hidden}` breaks `position:sticky`).
   To make it stick, change `.site-shell { overflow: hidden; }` to `overflow: clip;` in `assets/css/base.css`. (The header then turns ivory when scrolled; check it looks as you want.)
4. *Fixed:* every page had the home page as its canonical URL; each page now points to itself.
5. Terms, Privacy and Cookie pages still say "This page is being prepared." (unchanged placeholders).
6. Social links are empty (shown as "coming soon"); add URLs in `content/site.php`.
7. Ten images were not used anywhere; they are in `assets/images/_unused/` (delete when you wish).
8. Small additions: the first invalid field receives keyboard focus after a failed submit; `aria-current="page"` on the active menu link.
9. Fonts (Inter, Barlow Condensed; SIL OFL licence) are now self-hosted from `assets/fonts/` instead of Google.

## Tests that were run
Browser: Chromium via Playwright, PHP 8.3 built-in server, with `router.php`.
* All 7 pages return 200, unknown address returns 404, no console errors, no failed requests, no horizontal overflow at 390px - **pass**.
* Mobile menu open/close/Escape/focus, icon swap, link navigation, active link, scrolled header, FAQ accordion, `#hash` scroll, missing-image fallback - **pass**.
* Form: empty submit (5 errors), bad email/phone, values kept after errors, valid submit sends real JSON, honest error when mail is not configured,
  button re-enabled, honeypot sends nothing - **pass**.
* Handler: 201 honeypot, 422 (bad email, unknown service, 161-char name, 5001-char message, garbage body), 405, 413, 503 - **pass**.
* Private folders return 403; robots.txt and sitemap.xml render - **pass**. Subfolder install and `clean_urls=false` mode - **pass**.

**Not tested** (no access): sending a real email (SMTP/PHPMailer), 429 rate limit with a configured mailer, Apache `.htaccess` rules and Nginx snippet
(only the PHP router that mimics them), Safari/Firefox/real phones, double-submit under a slow network, HTTPS redirect.
