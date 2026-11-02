@php
    $labels = \App\Models\SitePage::navLabels();
    $ctaLabel = \App\Models\SitePage::get('global')->text('cta_label');
    $links = [
        [$labels['company'], 'company'],
        [$labels['services'], 'services.index'],
        [$labels['projects'], 'projects.index'],
        [$labels['team'], 'team'],
        [$labels['contact'], 'contact'],
    ];
@endphp
<header class="sticky top-0 z-40 border-b border-ink/10 bg-ivory/95 backdrop-blur">
    <div class="wrap flex items-center justify-between gap-6 py-3">
        <a href="{{ route('home') }}" aria-label="Custom Realities Limited, home" class="shrink-0">
            <x-site.picture :src="asset('images/logo-288.png')" :webp="asset('images/logo.webp')" alt="Custom Realities Limited" sizes="96px" priority class="h-11 w-auto" width="288" height="129" />
        </a>

        <nav aria-label="Primary" class="hidden items-center gap-9 lg:flex">
            @foreach ($links as [$label, $route])
                <a href="{{ route($route) }}" @class(['text-sm font-medium transition-colors hover:text-crl', 'text-crl' => request()->routeIs($route.'*')]) @if (request()->routeIs($route.'*')) aria-current="page" @endif>{{ $label }}</a>
            @endforeach
            <a href="{{ route('contact') }}" class="btn btn-solid !min-h-10 !px-5 !text-xs">{{ $ctaLabel }}</a>
        </nav>

        <button type="button" data-nav-toggle aria-expanded="false" aria-controls="mobile-nav" class="-mr-2 inline-flex size-11 items-center justify-center lg:hidden">
            <span class="sr-only">Menu</span>
            <svg aria-hidden="true" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 7h18M3 12h18M3 17h18"/></svg>
        </button>
    </div>

    <nav id="mobile-nav" data-nav-panel hidden aria-label="Mobile" class="fixed inset-x-0 top-[calc(3.75rem+1px)] bottom-0 overflow-y-auto bg-ivory lg:hidden">
        <ul class="wrap flex flex-col py-6">
            @foreach ($links as [$label, $route])
                <li class="border-b border-ink/10"><a href="{{ route($route) }}" class="block py-5 text-2xl font-semibold">{{ $label }}</a></li>
            @endforeach
            <li class="pt-8"><a href="{{ route('contact') }}" class="btn btn-solid w-full">{{ $ctaLabel }}</a></li>
        </ul>
    </nav>
</header>
