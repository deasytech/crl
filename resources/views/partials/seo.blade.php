@php
    $siteName = $site->company_name;
    $pageTitle = filled($title ?? null) ? $title.' | '.$siteName : ($site->seo_title ?: $siteName.' | Architecture, Construction, Services');
    $pageDescription = $description ?? $site->seo_description ?? 'Custom Realities Limited delivers integrated architectural, construction and project management solutions from Port Harcourt, Nigeria.';
    $pageImage = $image ?? \App\Support\Media::url($site->og_image) ?? asset('images/logo.png');
    $canonical = url()->current();
    $organisation = array_filter([
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => $siteName,
        'url' => url('/'),
        'logo' => asset('images/logo.png'),
        'email' => $site->primary_email,
        'telephone' => $site->office_phone ?: $site->mobile_phone,
        'address' => $site->address,
        'sameAs' => collect($site->social_links ?? [])->pluck('url')->filter()->values()->all() ?: null,
    ]);
@endphp
<title>{{ $pageTitle }}</title>
<meta name="description" content="{{ $pageDescription }}">
<link rel="canonical" href="{{ $canonical }}">
@if ($noindex ?? false)<meta name="robots" content="noindex, follow">@endif
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:type" content="{{ $type ?? 'website' }}">
<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $pageDescription }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $pageImage }}">
<meta name="twitter:card" content="{{ ($image ?? null) || $site->og_image ? 'summary_large_image' : 'summary' }}">
<meta name="twitter:title" content="{{ $pageTitle }}">
<meta name="twitter:description" content="{{ $pageDescription }}">
<meta name="twitter:image" content="{{ $pageImage }}">
<script type="application/ld+json">{!! json_encode($organisation, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) !!}</script>
