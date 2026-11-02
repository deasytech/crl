# Phase 7: Quality Assurance and Deployment Readiness

## Objective

Verify the complete website and prepare deployment documentation without
deploying to production unless explicitly authorized.

## Visual QA

Review: - Homepage first impression. - Typography and spacing. - Image
quality and attribution. - Portfolio storytelling. - Brand
consistency. - Responsive layouts. - Consistency between public pages.

## Functional QA

Test: - All public routes. - Navigation and mobile menu. - Project
filters and detail pages. - Galleries and image viewing. - Contact form
validation and storage. - Email notification if configured. - Filament
CRUD operations. - Media uploads. - Publication and draft visibility. -
Authorization and access restrictions.

## Technical QA

Check: - Laravel logs. - Browser console. - Route errors. - Missing
assets. - Database migration status. - Validation failures. -
Authorization failures. - Accessibility issues. - Performance
bottlenecks. - Broken links.

Run the test suite and relevant static/build checks available in the
project. Report actual results.

## Deployment preparation

Document: - Required PHP extensions and runtime version. - Composer
installation steps. - Frontend build commands. - Environment variables,
without exposing secrets. - Database setup and migration procedure. -
Storage symlink and permissions. - Cache and optimization commands. -
Queue and scheduler requirements only if actually used. - Web server
document root and rewrite requirements. - HTTPS requirement. - Backup
and rollback considerations. - Filament admin account provisioning
procedure.

Do not assume a VPS, hosting provider or deployment target. Confirm the
target environment first.

## Safety restrictions

Do not: - Change DNS. - Replace production files. - Run destructive
migrations. - Delete original assets. - Modify live mail routing. -
Deploy to production.

These actions require explicit authorization.

## Final handover

Provide: - Implemented features. - Key files and architecture summary. -
Database changes. - Admin usage instructions. - Tests performed and
results. - Remaining content gaps. - Required client approvals. -
Deployment checklist.
