# Phase 2: Laravel, Filament and Frontend Foundation

## Objective

Establish a maintainable single Laravel application with a public
Blade/Livewire website and a protected Filament administration panel.

## Tasks

1.  Confirm the installed Laravel, PHP, Filament, Livewire and frontend
    dependency versions.
2.  Check official compatibility requirements before adding or changing
    packages.
3.  Define public and admin route boundaries.
4.  Establish design tokens for colour, typography, spacing, container
    widths, borders and transitions.
5.  Establish the Blade layout structure and reusable components.
6.  Define the Eloquent data model and relationships.
7.  Plan migrations and seeders using verified company information only.
8.  Configure image storage using Laravel's filesystem conventions.
9.  Configure Filament authentication and authorization.
10. Establish a clear project structure and naming conventions.

## Suggested data entities

-   Project.
-   ProjectCategory, if a separate category table is justified.
-   ProjectImage or a supported media relationship.
-   Service.
-   TeamMember.
-   ContactEnquiry.
-   SiteSetting or a structured settings mechanism.
-   Homepage content settings, if needed.

Avoid overengineering. Use JSON or relationships only when they are
appropriate to the installed stack and content requirements.

## Suggested public routes

-   `/`
-   `/company`
-   `/services`
-   `/projects`
-   `/projects/{project:slug}`
-   `/team`
-   `/contact`

Use named routes and route model binding. Ensure unpublished projects
and content are not visible publicly.

## Filament

Create the protected admin panel using the installed Filament version.
Do not assume resource APIs from another major version.

## Deliverables

-   Approved architecture.
-   Initial migrations and models.
-   Base Blade layout.
-   Public route skeleton.
-   Filament panel foundation.
-   Storage and asset approach.
-   Setup notes.

## Approval gate

Review the data model, admin access strategy and page structure before
proceeding with full visual implementation.
