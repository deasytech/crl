# CRL Corporate Website: Master Development Prompt

## 1. Project overview

Develop a refined, modern corporate website for **Custom Realities
Limited (CRL)**, an architecture, construction, building services and
project management company based in Port Harcourt, Rivers State,
Nigeria.

Current development website: - https://qtribe.com.ng/dev/crl/

Client-approved design references: - FMA Architects:
https://fmaarchitects.com/ - Schmidt Architects:
https://schmidtarchitects.co/

The client likes both references. Study their visual presentation,
navigation, typography, project storytelling, photography, spacing,
responsive behaviour and interactions. Use them as inspiration, not as
templates to copy.

The primary content source is the supplied 36-page CRL company profile
PDF. Review the entire document, including its embedded photographs. It
contains company information, services, selected projects, project
statuses and years, team details, key personnel biographies and
portfolio images.

## 2. Project objective

Replace the current website with an original, premium digital presence
that communicates: - Architectural and design capability. - Construction
and project delivery experience. - Multidisciplinary technical
expertise. - Professional credibility and reliability. - Long-standing
experience in the Nigerian built environment. - A client-focused
approach and commitment to sustainable solutions.

The finished site should feel like the website of an established
architecture and engineering consultancy, not a generic contractor
template.

## 3. Technology and application architecture

### Required stack

Build the project using: - **Laravel** as the single application
foundation, backend and public website framework. - **Filament** as the
authenticated administration panel and content management system. -
**Blade** for server-rendered public pages. - **Livewire** for
interactive public components where appropriate, such as project
filtering or enquiry interactions. - The project's existing database,
asset pipeline and build tooling unless the audit identifies a reason to
change them.

Inspect the actual installed Laravel, PHP, Filament, Livewire, Vite and
frontend dependency versions before implementation. Follow the
compatibility requirements of those installed versions. Do not assume a
major version or upgrade dependencies without approval.

### Architecture principles

Use one Laravel application, not two disconnected applications.

The public website should be rendered by Laravel. Filament should
provide a protected admin area for authorized staff to manage website
content. The public frontend and admin panel should share the same
database, models, media storage and business rules.

Keep public-facing templates separate from Filament resources and admin
presentation.

Use Laravel conventions: - Models and Eloquent relationships. -
Migrations and seeders. - Form Requests or equivalent validation
patterns. - Policies and authorization. - Named routes. - Service
classes only where they improve separation of responsibilities. - Queues
only if required by implemented functionality. - Laravel's storage
system for uploaded media. - Environment variables for
environment-specific configuration.

Do not add unnecessary packages or infrastructure.

## 4. Design direction

### Overall aesthetic

Create an architectural editorial aesthetic: - Contemporary. -
Minimal. - Sophisticated. - Confident. - Image-led. - Spacious. -
Professional. - Technically credible.

Use the strongest design principles observed in the two reference
websites: - Strong architectural imagery and project presentation. -
Spacious layouts and considered typography. - Clear navigation and
service hierarchy. - Large editorial project features. - Restrained
motion and elegant hover states. - Consistent visual rhythm.

Do not copy their source code, branding, exact layouts or proprietary
assets.

### Colour direction

Suggested palette: - CRL red: `#A92F38` as an initial accent, adjusted
after inspecting the actual logo. - Charcoal: `#202020`. - Warm ivory:
`#F5F3EF`. - Stone grey: `#B8B6B0`. - White: `#FFFFFF`.

Retain the recognizable CRL red identity and existing logo. Do not
redesign the logo unless separately requested. Avoid overusing red; use
it selectively for calls to action, fine details and emphasis.

### Typography

Choose a cohesive type system. Possible options: - Headings: Manrope, DM
Sans or Plus Jakarta Sans. - Body: Inter or DM Sans. - Optional
editorial accent: Cormorant Garamond.

Do not load multiple font families unnecessarily. Establish a clear type
scale, readable body widths, responsive heading sizes and consistent
line heights.

### Photography

Prioritize actual CRL photographs from the company profile and existing
website assets. The portfolio must showcase genuine CRL work.

Use stock imagery only as clearly temporary or generic contextual
imagery, never as a falsely attributed CRL project. Do not use a stock
photograph as evidence of a project, client or service delivery.

Preserve original image files. Create optimized derivatives for the
website where needed. Use descriptive filenames and alt text. Use
appropriate aspect ratios and image focal points so buildings are not
awkwardly cropped.

## 5. Information architecture

Create these public pages: 1. Home. 2. The Company. 3. Services. 4.
Projects. 5. Individual Project Detail. 6. Our Team. 7. Contact.

Suggested primary navigation: - Home - The Company - Services -
Projects - Our Team - Contact

Include a restrained "Start a Project" or "Let's Talk" call to action.

Use a sticky or fixed header only if it improves the experience. Mobile
navigation must be accessible, usable and tested.

## 6. Homepage requirements

### 6.1 Hero

Create a memorable, image-led architectural hero.

Suggested headline: **Building Vision. Creating Realities.**

Suggested supporting copy: "Custom Realities Limited delivers integrated
architectural, construction and project management solutions,
transforming ideas into functional, sustainable and enduring built
environments."

Suggested calls to action: - Explore Our Projects. - Discover Our
Services.

Use a genuine CRL project photograph if a suitable image is available.
Ensure readable contrast, deliberate image cropping and responsive
behaviour. Do not overload the hero with too much text or animation.

### 6.2 Company introduction

Suggested heading: **We Create Distinctive Built Environments.**

Introduce CRL as a multidisciplinary company delivering architectural,
construction and supporting services. Explain its approach to combining
creativity, technical expertise, innovation and professional project
execution.

Use an editorial two-column layout with text and a genuine project or
team photograph. Link to The Company page.

### 6.3 Company highlights

Possible verified highlights: - Founded in 1992, according to the
company profile. - Multidisciplinary professional team. - Residential
and commercial project experience. - Architecture, construction and
project management expertise.

Do not invent numerical statistics, project counts, staff counts,
turnover, awards or performance claims.

### 6.4 Services preview

Present the four primary services: 1. Architecture. 2. Construction. 3.
Building Services. 4. Project Management.

Each item should include a relevant image, concise description and link
to its detail section or service page. Use a sophisticated editorial
grid rather than generic icon cards.

### 6.5 Selected projects

Feature a curated selection of genuine CRL projects. Candidate projects
include: - Sterling Bank Yenagoa. - NBA Secretariat, Abuja. - Jewels
Apartments, Umuahia. - Rainbow Town Development, Port Harcourt. - Bekens
Office Complex, Port Harcourt. - Royal Suites, Port Harcourt. - Shawsand
Medical Centre. - Cole Residence, Rivers State.

Only feature a project when its name, image and CRL involvement can be
supported by the company profile or verified client-provided material.

Show project name, category, location and documented CRL involvement.
Show year and status only when verified. Include a link to the project
detail page.

### 6.6 Approach

Present a clear explanation of how CRL works. A proposed editorial
sequence is: 1. Consultation and Planning. 2. Design and Development. 3.
Project Execution. 4. Supervision and Delivery.

These are presentation labels for the website, not a claim that the
company formally uses this exact process. Do not imply that every
engagement follows an identical process.

### 6.7 Why CRL

Communicate supported strengths: - Multidisciplinary technical
expertise. - Experienced architects and engineers. - Project management
capabilities. - Client-focused approach. - Technical and financial
project oversight. - Commitment to quality and sustainable solutions.

### 6.8 People preview

Introduce the professional team and feature the Managing Director or
selected key personnel using genuine portraits where available. Link to
the complete team page.

### 6.9 Vision and mission

Use the statements from the company profile:

**Vision**

"To consistently deliver excellent sustainable customized solutions that
are environmentally friendly through creativity and innovation."

**Mission**

"We create distinctive buildings and supporting services for the built
environment using best business practices that promote team cohesion and
guarantees our strong leadership position."

Preserve the original meaning. Minor grammar edits may be made for
publication only if they do not change the statement; retain the source
wording in the content record if an edited display version is used.

### 6.10 Closing CTA and footer

Suggested CTA: **Let's Build Something Remarkable Together.**

Supporting copy: "Have a project in mind? Let's discuss how our
expertise can help bring your vision to life."

Footer should include the CRL logo, short company description,
navigation, services, verified address, primary telephone numbers and
primary email.

## 7. Company page

Create a polished company profile page with: - About Custom Realities
Limited. - Company history and establishment in 1992. - Vision and
mission. - Client relationships and philosophy. - Technical expertise. -
Multidisciplinary capabilities. - Company registration reference, RC
449630. - Professional team introduction.

Use the company profile as the content source. Do not invent
certifications, affiliations or corporate claims.

## 8. Services page

Create a services overview and dedicated sections or detail pages for
each service.

### Architecture

The company profile describes CRL's work in creating developments that
meet target-market needs, suit proposed sites and address environmental,
zoning and regulatory requirements. It describes the work of architects
and planners, design coordination and blending client programmes and
market demand with environmental and statutory requirements.

Present this accurately. Possible topics include: - Architectural
design. - Development planning. - Site suitability. - Environmental and
statutory considerations. - Design coordination. - Building design and
documentation.

### Construction

The company profile describes experience in building projects,
professional resources, mobilization and delivery to high standards.

Present supported capabilities such as: - Building construction. -
Construction execution. - Site coordination. - Resource mobilization. -
Quality and project delivery.

### Building Services

The profile describes design and execution of building services,
engineering design support, maintenance through the building lifecycle
and representation of building product manufacturers.

Present these areas without inventing specific technical disciplines or
certifications not documented in the profile.

### Project Management

The profile describes planning, organizing and managing projects to
achieve project-specific goals within budget and time frames, with
experienced professionals, cost control mechanisms and manpower.

Present: - Project planning. - Project coordination. - Cost control. -
Resource management. - Construction supervision. - Time and budget
oversight. - Project execution.

Each service section should have relevant imagery, detailed content and
a contact CTA.

## 9. Projects and portfolio

The portfolio is a major proof point and should receive significant
design attention.

### Categories

Provide useful category filters: - Residential. - Commercial and
Industrial. - Religious. - Educational. - Healthcare. - Hospitality. -
Infrastructure and Roads. - Institutional.

Only assign a category when the source material supports it.

### Projects documented in the company profile

**Residential** - TFC Properties, Abuja. - Trinity Garden Estate. -
Jewels Apartments, Umuahia. - Cole Residence, Rivers State. - Guest
House Oloko, Umuahia. - Force Avenue.

**Commercial and Industrial** - Shawsand Estate, Port Harcourt. -
Sterling Bank HQ, Abuja. - Deborah Lawson House. - Rainbow Town Project,
Port Harcourt. - FIRS Moscow Road, Port Harcourt. - NBA Secretariat,
Abuja. - Sterling Bank Yenagoa. - Cobef Limited, Enugu. - Bekens Office
Complex.

**Religious** - Chapel of Redemption, University of Calabar, Phase 1. -
RCCG House of Grace, Province 5, Woji, Port Harcourt.

**Educational** - Mount Olives Group of Schools, Anambra State. -
Primary Schools for Rivers State Government, supervised by CRL according
to the profile.

**Healthcare** - Shawsand Medical Centre, Port Harcourt.

**Hospitality** - Royal Suites, Port Harcourt. - La Sien Hotel, Port
Harcourt.

**Infrastructure** - 2-KM Oghege Obagle Nevbuosa Road, Edo State. -
Raphael Avenue by Fido Road, Kpansia, Yenagoa.

The profile also documents other selected projects and monitoring
assignments. Review the PDF pages carefully before finalizing the
database seed data.

### Status and date accuracy

The profile distinguishes projects as completed, ongoing or stalled and
includes various years and date ranges. Preserve these distinctions
exactly where the source provides them. Never turn a stalled or ongoing
project into a completed project. Where status is missing or unclear,
leave it unspecified and flag it for confirmation.

### Project detail pages

Each project should support: - Project title. - Category. - Location. -
Year or date range, if documented. - Status, if documented. - CRL's
involvement, such as design, construction, supervision or consultancy,
where documented. - Description based only on supported facts. - Main
image and gallery. - Before/after images when available and correctly
identified.

Use attractive editorial layouts, varied image proportions, lightbox
viewing and responsive galleries. Do not force all projects into
identical cards.

## 10. Team page

The company profile lists the following core personnel: 1. Arc. Oriaku
Hanson Oyet-Ile, MD/CEO. 2. Arc. Ebiwene O. Bozimo. 3. Arc. Peter Honest
Dateme. 4. Albert Michael Tamunoibuomi. 5. Onyeanyi Uchenna Cosmas. 6.
Aderemi Ogunsakin John. 7. Noble Nnabugwu. 8. Egwuonwu Obinna Goodnews.

Use the exact qualifications and designations documented in the profile.
The profile also provides detailed biographies for key personnel,
including the Managing Director and project managers. Extract those
details carefully.

Include affiliate consultants under their documented professional
categories: - Architects. - Structural Engineers. - MEP Engineers. -
Land Surveyors. - Quantity Surveyors.

Do not fabricate missing portraits, qualifications or biographies. Allow
a team profile to be published without a photograph if no approved
photograph exists.

## 11. Contact page

Use the following contact information from the company profile:

**Company:** Custom Realities Limited\
**Office address:** 36 Old Aba Road, Rumukwurushi, Port Harcourt, Rivers
State, Nigeria.\
**Office phone:** 07055981238\
**Mobile:** 07030812545\
**Primary email:** info@customrealities.com.ng\
**Website:** www.customrealities.com.ng

Other emails listed in the profile: - mail.customrealities@gmail.com -
nigostix@gmail.com

Use `info@customrealities.com.ng` as the primary public email. Do not
give all listed addresses equal prominence. Confirm with the client
which secondary addresses, if any, should be displayed.

Contact form fields: - Full name. - Email. - Phone. - Company or
organization. - Service required. - Project location. - Project
description.

Implement real backend validation, secure processing, spam protection
appropriate to the project, clear success/error feedback and a
configurable notification recipient. Do not expose secrets in frontend
code. Confirm the recipient mailbox and mail transport configuration
before enabling production notifications.

Embed a map only after verifying the correct office location. Provide
clickable phone and email links.

## 12. Filament CMS requirements

Filament is the administration interface for managing the public
website. Inspect the installed Filament version and follow its current
conventions.

Create appropriate resources and relationships for the following
content.

### Projects

Suggested fields: - Title. - Slug. - Short summary. - Full
description. - Category. - Location. - Project year or date range. -
Project status: completed, ongoing, stalled, or not specified. - CRL
involvement. - Featured flag. - Sort order. - Main image. - Gallery
images. - SEO title. - SEO description. - Published/draft status.

Use validation and prevent duplicate slugs. Make project status explicit
and do not default every project to completed.

### Services

Suggested fields: - Title. - Slug. - Short description. - Full
description. - Featured image. - Sort order. - Published status. - SEO
title and description.

### Team members

Suggested fields: - Full name. - Slug. - Position/designation. -
Qualifications. - Biography. - Portrait. - Core team or affiliate
consultant classification. - Professional category. - Sort order. -
Published status.

### Homepage content

Provide manageable content for: - Hero headline and supporting copy. -
Hero image. - CTA labels and destinations. - Introduction text and
image. - Featured projects. - Featured services. - Team preview. -
Closing CTA.

Do not create a complex page builder unless it is genuinely needed. A
structured set of Filament-managed homepage settings is sufficient.

### Contact enquiries

Store contact form submissions in the database. Provide an admin
resource with: - Contact details. - Service required. - Project location
and description. - Submission date. - Status such as new, in progress,
responded or closed. - Internal notes, if appropriate.

Restrict access to enquiries by authorization. Do not expose enquiries
publicly.

### General settings

Where useful, manage: - Company name. - Logo. - Address. - Telephone
numbers. - Primary email. - Social links, only if confirmed. - Footer
text. - SEO defaults.

### Media management

Use Filament's upload fields and Laravel storage conventions. Validate
file types and sizes. Store image alt text or captions where useful. Do
not store uploaded files in a temporary location that is not publicly
served. Ensure production storage symlinks and permissions are
documented.

### Admin security

-   Protect the Filament panel with authentication.
-   Use authorization and roles/permissions where needed.
-   Do not expose admin-only data in public queries.
-   Validate all uploaded content.
-   Avoid publicly guessable or unprotected admin actions.
-   Do not create a default public admin account with a known password.

## 13. Motion and interaction

Use restrained, purposeful motion: - Smooth scrolling. - Subtle page and
section reveals. - Image reveal transitions. - Refined hover states. -
Portfolio image zoom. - Responsive navigation transitions. - Smooth
category filtering. - Parallax only where it adds value and does not
impair performance.

Respect reduced-motion preferences. Do not make content dependent on
animation to become visible. Avoid distracting motion and excessive
scroll effects.

## 14. Responsive design and accessibility

Design intentionally for: - Large desktop. - Standard desktop and
laptop. - Tablet. - Mobile.

Requirements: - No horizontal overflow. - Legible typography at all
sizes. - Accessible mobile navigation. - Keyboard-accessible controls. -
Visible focus states. - Sufficient colour contrast. - Semantic headings
and landmarks. - Form labels and useful validation messages. -
Descriptive alt text. - Reduced-motion support. - Touch-friendly
controls.

Do not simply shrink desktop layouts. Recompose grids and image
treatments for smaller screens.

## 15. SEO and performance

Implement: - Unique page titles and meta descriptions. - Canonical
URLs. - Open Graph metadata. - Descriptive image alt text. - XML
sitemap. - Robots.txt. - Semantic HTML. - Correct heading hierarchy. -
Organization structured data using verified information. - Relevant
service and project metadata. - Human-readable project slugs.

Performance: - Optimize images and generate modern formats where
supported. - Use responsive image sizes. - Lazy-load below-the-fold
images. - Do not lazy-load the primary hero image if it harms Largest
Contentful Paint. - Load fonts efficiently. - Avoid unnecessary packages
and scripts. - Minimize layout shift. - Cache public pages and assets
appropriately. - Keep admin assets and scripts out of public pages when
possible.

Aim for strong Core Web Vitals and Lighthouse results. Do not claim a
score unless it has actually been measured.

## 16. Content accuracy and editorial rules

The CRL company profile is the primary source of truth.

Never invent: - Project details. - Project status. - Completion years. -
Client relationships. - Awards. - Certifications. - Professional
memberships. - Staff qualifications. - Staff biographies. -
Testimonials. - Company statistics. - Contact information.

Correct obvious typographical errors in website copy without changing
factual meaning. If the profile contains conflicting, incomplete or
unclear information, flag it for client confirmation rather than
silently reconciling it.

Do not publish the PDF as the website. Convert its useful information
into accessible, responsive web content.

## 17. Quality assurance

Before completion, verify:

### Visual

-   Premium architecture consultancy aesthetic.
-   Strong homepage first impression.
-   Consistent typography and spacing.
-   High-quality, correctly attributed imagery.
-   Clear project storytelling.
-   Consistent brand application.
-   No copied benchmark layout.

### Functional

-   Navigation works.
-   Mobile menu works.
-   Project filters work.
-   Project detail pages load.
-   Galleries and lightboxes work.
-   Contact form validates and stores enquiries.
-   Email notification works if configured.
-   Filament CRUD operations work.
-   Uploads work and images display.
-   Published/draft visibility behaves correctly.
-   No broken links.

### Technical

-   No PHP or JavaScript errors.
-   No broken routes.
-   No missing assets.
-   No unhandled validation errors.
-   No public exposure of admin data.
-   No avoidable accessibility failures.
-   No obvious performance bottlenecks.
-   Migrations and seeders are safe and repeatable.

## 18. Delivery expectations

Provide: - A functioning Laravel public website. - A protected Filament
admin panel. - Content models and migrations. - Filament resources for
editable website content. - Responsive public pages. - Project portfolio
and detail pages. - Functional contact enquiry workflow. - SEO
foundations. - Setup and deployment documentation. - A list of
client-supplied assets or facts still required.

Do not deploy to production or modify DNS without explicit
authorization.

## 19. Final creative direction

Think like an architectural creative director and a senior
Laravel/Filament engineer.

The website should demonstrate the same care and discipline that an
architecture firm applies to designing a building. Every page needs a
clear purpose, visual hierarchy, thoughtful composition and consistent
relationship to the wider site.

Prioritize: 1. Exceptional homepage presentation. 2. A distinctive and
credible project portfolio. 3. Sophisticated typography. 4. Genuine CRL
photography. 5. Professional corporate storytelling. 6. A useful
Filament content management experience. 7. Responsive accessibility. 8.
Performance and maintainability.

Start with the repository audit and project discovery. Do not rush into
implementation before understanding the current application, installed
dependencies, company profile and available assets.
