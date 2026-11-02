@props(['site'])
@php
    $services = \App\Models\Service::published()->ordered()->get(['title', 'slug']);
    $labels = \App\Models\SitePage::navLabels();
    $global = \App\Models\SitePage::get('global');
    $hasPrivacy = filled(\App\Models\SitePage::query()->where('key', 'privacy')->value('body'));
    $socials = collect($site->social_links ?? [])->filter(fn ($link) => filled($link['url'] ?? null));
@endphp
<footer class="mt-0 bg-ink text-white">
    <div class="wrap grid gap-12 py-16 md:grid-cols-12">
        <div class="md:col-span-5">
            <p class="text-xl font-semibold">{{ $site->company_name }}</p>
            @if ($site->tagline)<p class="eyebrow mt-2 !text-stone">{{ $site->tagline }}</p>@endif
            @if ($site->footer_text)<p class="mt-6 max-w-sm text-sm text-stone">{{ $site->footer_text }}</p>@endif
            @if ($site->registration_number)<p class="mt-6 text-xs text-stone">RC {{ $site->registration_number }}</p>@endif
        </div>

        <nav aria-label="Footer" class="md:col-span-2">
            <p class="eyebrow !text-stone">{{ $global->text('footer_explore_label') }}</p>
            <ul class="mt-4 space-y-2 text-sm">
                <li><a class="hover:text-stone" href="{{ route('company') }}">{{ $labels['company'] }}</a></li>
                <li><a class="hover:text-stone" href="{{ route('projects.index') }}">{{ $labels['projects'] }}</a></li>
                <li><a class="hover:text-stone" href="{{ route('team') }}">{{ $labels['team'] }}</a></li>
                <li><a class="hover:text-stone" href="{{ route('contact') }}">{{ $labels['contact'] }}</a></li>
                @if ($hasPrivacy)<li><a class="hover:text-stone" href="{{ route('privacy') }}">{{ $labels['privacy'] }}</a></li>@endif
            </ul>
        </nav>

        <nav aria-label="Services" class="md:col-span-2">
            <p class="eyebrow !text-stone">{{ $global->text('footer_services_label') }}</p>
            <ul class="mt-4 space-y-2 text-sm">
                @foreach ($services as $service)
                    <li><a class="hover:text-stone" href="{{ route('services.show', $service->slug) }}">{{ $service->title }}</a></li>
                @endforeach
            </ul>
        </nav>

        <address class="text-sm not-italic md:col-span-3">
            <p class="eyebrow !text-stone">{{ $global->text('footer_contact_label') }}</p>
            @if ($site->address)<p class="mt-4 text-stone">{{ $site->address }}</p>@endif
            <p class="mt-4 space-y-1">
                @if ($site->office_phone)<a class="block hover:text-stone" href="tel:{{ preg_replace('/\s+/', '', $site->office_phone) }}">{{ $site->office_phone }}</a>@endif
                @if ($site->mobile_phone)<a class="block hover:text-stone" href="tel:{{ preg_replace('/\s+/', '', $site->mobile_phone) }}">{{ $site->mobile_phone }}</a>@endif
                @if ($site->primary_email)<a class="block hover:text-stone" href="mailto:{{ $site->primary_email }}">{{ $site->primary_email }}</a>@endif
            </p>
            @if ($socials->isNotEmpty())
                <p class="eyebrow mt-8 !text-stone">{{ $global->text('footer_social_label') }}</p>
                <ul class="mt-3 flex flex-wrap gap-x-5 gap-y-2">
                    @foreach ($socials as $link)
                        <li><a class="hover:text-stone" rel="noopener" target="_blank" href="{{ $link['url'] }}">{{ $link['platform'] ?? $link['url'] }}</a></li>
                    @endforeach
                </ul>
            @endif
        </address>
    </div>
    <div class="border-t border-white/10">
        <p class="wrap py-6 text-xs text-stone">&copy; {{ date('Y') }} {{ $site->company_name }}. {{ $global->text('footer_rights') }}</p>
    </div>
</footer>
