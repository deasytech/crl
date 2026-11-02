# Phase 5 notes: Filament content management

## Admin navigation
- **Content**: Homepage (single page), Projects (with Gallery relation manager), Services, Team members, Project categories.
- **Enquiries**: Contact enquiries (admin only; submitted details are read-only, only status and internal notes change; none can be created in the panel).
- **Settings**: Company settings (admin only): company details, contact details, social links, company page copy, site SEO and sharing image.

## Roles
| | Admin | Editor |
|---|---|---|
| Create / edit content, homepage | yes | yes |
| Delete / restore content | yes | no |
| Enquiries | yes | no |
| Company settings | yes | no |

Policies: `app/Policies` (`ContentPolicy` base, `ContactEnquiryPolicy`). Create users with `php artisan crl:make-admin`; no default account exists. Only admins can currently be created by that command; set `users.role` to `editor` for editors.

## Publishing
`published_at` empty = draft; future date = scheduled; past/now = published. Public pages show only published items. Tables show the state and offer bulk "Publish now" / "Move to draft". Project status is chosen explicitly and defaults to "Not specified".

## Homepage
Hero, intro, highlight/approach/why blocks and closing CTA are edited on the Homepage page. Featured projects and services are controlled by the "Featured" toggle on each. CTA destinations must be a site path (`/contact`) or an http(s) URL.

## Media
- Disk `public`; directories `projects`, `projects/gallery`, `services`, `team`, `homepage`, `site`. Run `php artisan storage:link` on every environment.
- Uploads: JPEG, PNG or WebP only, max 5 MB, validated server-side. Alt text fields on project, service, homepage and gallery images.
- Production: the web user must be able to write to `storage/app/public` (e.g. `chmod -R ug+rw storage bootstrap/cache`, owned by the web user). Back up `storage/app/public`; it is the only copy of admin uploads.
- Existing source assets (logo at `public/images/logo.png`, seeder source photos) are untouched.

## Decisions / open items
- Logo is not an admin upload: the existing `public/images/logo.png` stays as-is. Say if you want it managed in settings.
- Social links are stored but not yet shown on the site; add confirmed accounts and the footer can render them.
- `enquiry_recipient` is editable now; the contact form and email notification are Phase 6.
- Body text fields are plain text (rendered safely as paragraphs), not a rich-text editor.
- Team portraits and the Supervision & QA/QC service remain content gaps to be supplied by the client.

## Tests
`tests/Feature/FilamentCmsTest.php`: role access, enquiry restrictions, unspecified-status default, slug uniqueness, upload type validation, bulk publish, homepage link validation, settings save. Full suite 69/69, Pint clean, PHPStan 0 errors.
