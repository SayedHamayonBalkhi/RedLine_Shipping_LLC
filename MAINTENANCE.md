# Maintenance guide

Everything below is a small edit in a readable file. After any change, reload the page; no build step.

## Change contact details, company name, menu, footer, social links
Edit **`content/site.php`**: `$email`, `$phone`, `$address` at the top (the phone link, map link and full address are built from them),
`companyName`, `credentials` (USDOT/MC), `social` (paste profile URLs; empty = "coming soon"), `nav` (menu items), `footer` text/links.
The phone number, email and address appear in the top bar, hero, contact cards, footer and the search-engine data automatically.

## Change text on a page
Edit **`content/pages.php`** (headlines, paragraphs, steps, FAQs, team, button labels, browser-tab titles and search descriptions under `meta`).
Quote form labels, placeholders and messages: **`content/form.php`**.

## Services (names, descriptions, photos, order)
Edit **`content/services.json`**. One block per service. The service **name** is also the choice in the form's dropdown and the footer link.
`"featured": true` shows it in the four cards on the home page. To add a service, copy a block and give it a new unique `id`.
(The "Explore" cards on the home page expect 4 featured services to look balanced.)

## Replace images
1. Put the new file in `assets/images/` (JPG/PNG/WebP). Same file name = just overwrite it, nothing else to do.
2. A different file name: change the name in `content/images.php` (page photos) or `content/services.json` (service photos).
3. Update the `alt` text next to it (describe the photo for people who cannot see it).
* Logo: replace `assets/images/redline-shipping-logo.jpeg` (it is shown at 114px wide, 76px tall, never stretched).
* Hero/banner crop: photos fill their box and are cropped, not stretched. Adjust the focus with `object-position`
  in `assets/css/sections.css` (`.hero-background-image`, `.page-hero-image`), e.g. `center 30%` shows more of the top.
* Tip: keep photos under ~500 KB (resize to about 1600px wide) so pages stay fast.
* If a photo file is missing, a grey "REDLINE LLC" box shows instead of a broken icon.

## Colours, fonts, shared styles
**`assets/css/base.css`** top section (`:root`): brand colours (`--redline-red`, `--brand-charcoal`, `--warm-ivory`...), fonts, and the
shared **button** style (`.button`). Changing a value there updates every place that uses it.
Other files: `layout.css` (header/footer), `sections.css` (page sections), `components.css` (cards, form, FAQ).
Mobile rules sit at the end of each block inside `@media (max-width: ...)`.

## Add a new page
1. Copy `terms.php` to e.g. `shipping.php`, change `$route` and the content.
2. Add the address to the rewrite line in `.htaccess` (and `router.php`), to `nav` in `content/site.php`, to the list in `sitemap.php`,
   and a title/description in `content/pages.php` -> `meta` -> `routes`.

## Replace the legal pages
Terms/Privacy/Cookies currently show "This page is being prepared." Put final text into `includes/sections/legal-page.php`
(or give each page its own copy) when you have it.

## Analytics (optional)
Set `analytics_domain` in `config/config.php` to enable Plausible (cookie-free). Empty = no tracking.
