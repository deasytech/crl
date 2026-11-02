# Phase 5: Filament Content Management

## Objective

Make the website's regularly updated content manageable through a
protected Filament admin panel.

## Resources

### Projects

Fields should support: - Title and unique slug. - Summary and full
description. - Category. - Location. - Year or date range. - Status:
completed, ongoing, stalled or unspecified. - CRL involvement. -
Featured flag and sort order. - Main image and gallery. -
Published/draft state. - SEO title and description.

Do not default missing status to completed.

### Services

Manage title, slug, short and full descriptions, image, ordering,
publication state and SEO fields.

### Team members

Manage name, slug, designation, qualifications, biography, portrait,
core-team or affiliate classification, professional category, ordering
and publication state.

### Homepage settings

Manage hero text, image, CTA labels and destinations, introduction
content, featured projects/services and closing CTA.

Avoid building an unnecessarily complex page builder.

### Contact enquiries

Manage enquiry details, service requested, project location,
description, submission date, status and internal notes. Restrict
access.

### General settings

Manage company details, logo, address, telephone numbers, primary email,
footer content and confirmed social links.

## Media requirements

-   Use Laravel storage and Filament upload conventions.
-   Validate file types and sizes.
-   Ensure files are stored in a durable location.
-   Support image alt text or captions where useful.
-   Document storage symlink and production permissions.
-   Preserve original source assets.

## Security

-   Protect the Filament panel.
-   Configure authorization.
-   Restrict enquiry access.
-   Validate all user input and uploads.
-   Do not expose private records through public routes or APIs.
-   Do not create a default admin user with a known password.

## Deliverables

-   Filament resources and forms.
-   Tables and filters.
-   Relationships and upload handling.
-   Authorization rules.
-   Content publication behaviour.
-   Admin usage notes.
