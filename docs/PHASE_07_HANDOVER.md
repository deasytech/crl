# Phase 7: QA Results, Handover and Deployment Checklist

No deployment, DNS, mail-routing or destructive database action was performed.
The deployment target has **not** been confirmed; the steps below are generic.

## QA results (run 2026-11-02, local Herd)

| Check | Result |
| --- | --- |
| Pest suite | 84 passed, 274 assertions, 0 failures |
| `npm run build` | Succeeds |
| `migrate:status` | No pending migrations |
| Public routes (`/`, `/company`, `/services`, `/services/*`, `/projects`, project details, `/team`, `/contact`, `/sitemap.xml`) | All HTTP 200 |
| Linked images, CSS, JS (`/images`, `/build`, `/storage`) on 8 sampled pages | No 404s |
| `/admin` while logged out | 302 to login; `/admin/login` 200 |
| `/.env` over HTTP | 404 (not exposed) |
| `laravel.log` | Only historical dev-time errors (missing class during file generation, 19:31 to 19:54). None recurring. `testing.WARNING` lines are expected: no enquiry recipient is configured in the test env. |

Not performed (need a human or a real browser session): visual and responsive
review at real device widths, browser-console review, screen-reader and
keyboard audit, Lighthouse/performance measurement, live Gmail delivery test,
Filament upload through the browser UI. Automated tests cover Filament CRUD,
draft/published visibility, authorization, contact validation and storage.

### Findings

1. **`public/robots.txt` hard-codes `Sitemap: https://crl.com.ng/sitemap.xml`.** The production domain is unconfirmed. Update once it is.
2. **`robots.txt` returned 404 via Herd's nginx** although the file is present and its body is served. Likely a Herd static-file quirk. Re-check on the real host.
3. **Open Graph fallback image is the JPG hero** (`/images/crl-hero-01.jpg`); the WebP versions are used on-page. Fine, but confirm the JPG is intended for sharing.
4. **Contact email is sent synchronously** (inside the request, failures are caught and reported). No queue worker is therefore required. If the SMTP host is slow, the visitor waits. Move to a queue only if that becomes a problem.
5. **`public/hot` exists locally** (Vite dev server marker). It is git-ignored; make sure it is absent on the server, or the site will try to load assets from `[::1]:5173`.
6. **`.env.example` has `APP_NAME=Laravel`** and `DB_CONNECTION=sqlite`. Set the real name, and confirm the production database engine.
7. **`APP_URL` must match the served scheme.** Locally `APP_URL=http://crl.test` while Herd serves https, so uploaded-image URLs are generated as http and blocked as mixed content (images appeared broken in a mobile screenshot test). Production must set `APP_URL=https://...`; locally use `https://crl.test`.
8. **Mobile check (390px, headless Chrome iframe):** home, project detail and contact pages show no horizontal overflow, the hamburger menu is present, and forms and footer stack correctly. Scroll-reveal text appears faded in static screenshots because the reveal animation had not fired; confirm in a real browser.
9. `robots.txt` blocks `/admin`; this is not a security control. The admin is protected by Filament authentication, and `canAccessPanel` requires a user role.

## Deployment checklist

Confirm the hosting target first (shared host, VPS, Laravel Cloud, other).

**Runtime**: PHP ^8.3 with `bcmath, ctype, curl, dom, fileinfo, gd or imagick, intl, json, mbstring, openssl, pdo (driver for the chosen DB), tokenizer, xml, zip, exif`. Imagick or GD is needed for WebP derivatives. Node 20+ only on the build machine.

**Install**
```
composer install --no-dev --optimize-autoloader
npm ci && npm run build
cp .env.example .env   # then fill in values; php artisan key:generate
php artisan migrate --force      # only with explicit approval
php artisan storage:link
php artisan crl:optimise-images   # only needed for existing uploads
```

**Environment variables (names only)**: `APP_NAME, APP_ENV=production, APP_DEBUG=false, APP_KEY, APP_URL (https), DB_*, SESSION_DRIVER, CACHE_STORE, MAIL_MAILER, MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD, MAIL_FROM_ADDRESS (must equal MAIL_USERNAME for Gmail), MAIL_FROM_NAME`, plus set the enquiry recipient in Filament, Site Settings (falls back to the primary email). Never commit `.env`.

**Optimise**: `php artisan optimize && php artisan filament:optimize`.

**Web server**: document root is `public/`; all requests fall back to `index.php`. HTTPS is required (admin login, session cookies; set `SESSION_SECURE_COOKIE=true`). `storage/` and `bootstrap/cache/` must be writable by the web user.

**Queue / scheduler**: not currently used for the site. `QUEUE_CONNECTION=database` in `.env.example` is only a default; no worker is needed.

**Backups / rollback**: back up the database and `storage/app/public` (uploaded media) before every deploy. Keep the previous release directory for rollback; migrations in this project have not been written with `down` tested in production, so restore from backup rather than rolling back migrations.

**Admin provisioning**: create the first user on the server (for example via the existing seeder or `php artisan tinker`) and set a role so `canAccessPanel` passes; use a strong unique password and enable two-factor (Fortify 2FA is installed). Do not ship default seeded credentials.

## Handover summary

- **Features**: public site (home, company, services, projects with filters and galleries, team, contact), Filament CMS for projects, categories, services, team, homepage, site settings and enquiries, SEO meta/Open Graph/JSON-LD/sitemap, WebP responsive images via Spatie Media Library, contact form with validation, honeypot, rate limit and email notification.
- **Architecture**: Laravel 13, Filament 5, Livewire 4, Blade, Vite/Tailwind. Controllers in `app/Http/Controllers`, Filament in `app/Filament`, image handling in `app/Models/Concerns/HasOptimisedImages.php`.
- **Database**: see `database/migrations` (CRL data model, `media` table added in Phase 6).
- **Admin usage**: sign in at `/admin`; manage content from the sidebar; set projects to draft/published; view enquiries under Contact Enquiries.

## Outstanding

- Confirm deployment target, production domain and database engine.
- Confirm enquiry recipient address and set up the Gmail/Workspace app password.
- Client approval of copy, project statuses (completed / ongoing / stalled), team biographies and affiliate consultants.
- Any missing real project photography (no stock imagery has been used).
- Manual visual, accessibility and performance review in browsers.
