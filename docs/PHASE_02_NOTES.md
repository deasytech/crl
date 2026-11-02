# Phase 2 notes: architecture and foundation

## Added
- Filament 5.11 admin panel at `/admin` (no resources yet; Phase 5). Brand colour `#A92F38`.
- Access: `users.role` (`admin` | `editor`, null = no access). `User::canAccessPanel()` requires a role.
  `role` is not mass-assignable. Public registration is disabled. Create admins with
  `php artisan crl:make-admin you@example.com` (prompts for the password; nothing is stored in code).
- Tables: `project_categories`, `projects`, `project_images`, `services`, `team_members`,
  `contact_enquiries`, `site_settings`, `homepage_settings`. All migrations are additive.
- Draft/publish: content is public only when `published_at` is set and not in the future.
- Project status is explicit (`completed`, `ongoing`, `stalled`, `unspecified`) and defaults to `unspecified`.
- Public routes: `/`, `/company`, `/services`, `/services/{slug}`, `/projects`, `/projects/{slug}`, `/team`, `/contact`.
  Layout `layouts/site.blade.php` with placeholder header/footer; real design is Phase 3.
- Seeders (`php artisan db:seed`) create only missing records and never overwrite admin edits. Content comes
  from the profile; each uncertain record carries an `admin_notes` line starting `NEEDS CONFIRMATION`.
  The Supervision and QA/QC service is seeded as an unpublished draft because no copy exists.
- `/dashboard` now redirects to `/admin`. The starter `welcome` view was removed.

## Storage
Uploads will use the `public` disk (`php artisan storage:link`). Originals are never modified.

## Checks (local)
Pest 44/44 passing, Pint clean, PHPStan level per project config: 0 errors.
