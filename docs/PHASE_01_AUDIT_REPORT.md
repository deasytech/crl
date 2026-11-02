# Phase 1 audit report

## Application (at audit time)
PHP 8.3.30, Laravel 13.39, Livewire 4.1, Flux 2.13, Fortify 1.37, Tailwind 4 via Vite+, Pest 4,
MySQL `crl_db`. Starter-kit migrations only; no CRL models, routes or views. **Filament was not installed.**

## Current dev site (qtribe.com.ng/dev/crl)
Single-page template with placeholder content: lorem ipsum, one repeated image, dead `#` links, typos
("Port-Hacourt"), wrong email domain `customrealties.com.ng`, unsupported "25+ Years" claim. Nothing to preserve.

## Benchmarks
FMA Architects returned only a bot-check page; the Schmidt fetch returned an unrelated template.
Neither could be assessed from text extraction. The client letter of 28 Oct 2026 also names MAA.
Screenshots or a browser review are needed.

## Company profile (36 pages)
Source: `~/My Docs/D2 Projects/CRL/CRL PROFILE.pdf` (not in repo). Photos are embedded in slide
composites (low-resolution, several are renders). No team portraits. Pages 9, 11, 13 are image-only.
Slide-to-project mapping supported by captions: 25 Sterling Yenagoa; 26 Sterling Abuja; 27-28 Rainbow Town;
29 Cobef; 30 Bekens; 31 La Sien; 32-33 NBA Secretariat; 34 RCCG House of Grace.

## Items needing client confirmation
1. Office phone: profile `07055981238` vs letterhead `07055891238`.
2. Address: "Rumukwurushi" (profile) vs "Rumuokwurusi" (letterhead); letterhead adds P.O. Box 2819.
3. Secondary emails: profile `mail.customrealities@gmail.com`; letterhead `customrealitiesltd@gmail.com`.
4. Bekens: "Office Complex, Completed 2021" (table) vs "Office Block for Bekens Motors, Trans-Amadi, 2009" (slide 30).
5. Sterling Bank Abuja: "Design" (table) vs "Design / Supervision" (slide 26).
6. Rainbow Town: table says Design, Stalled, **no year**; slides say Consultancy.
7. Cobef: table says Enugu; slide 29 says Port Harcourt, Rivers State.
8. Trinity Garden Estate 2016 (p.16) vs Trinity Gardens, Igbo-Etche Road 2005-2010 (p.19).
9. Jewels Apartments Umuahia 2017 (p.16) vs Jewels Apartments Woji 2021-2022 (p.19).
10. Team designations (p.20 vs pp.23-24 for Bozimo and Dateme); affiliate qualifications (p.21) are not aligned to names.
11. Founding year 1992 appears only in the MD biography.
12. Spelling: Yenegoa / Yenogoa / Yenagoa (normalised to Yenagoa).

## Scope decisions (approved)
Supervision and QA/QC is a fifth service. The CRC subdomain is out of scope.
