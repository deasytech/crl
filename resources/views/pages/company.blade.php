@php
    $site = \App\Models\SiteSetting::current();
    $home = \App\Models\HomepageSetting::current();
    $page = \App\Models\SitePage::get('company');
@endphp
<x-layouts::site :title="$page->seo_title" :description="$page->seo_description">
    <x-site.page-header :eyebrow="$page->eyebrow" :title="$page->title">
        {{ $page->intro ?: $site->tagline }}
    </x-site.page-header>

    {{-- About and registration --}}
    <section class="wrap grid gap-12 py-24 md:grid-cols-12 md:gap-16 md:py-32">
        <div class="md:col-span-7" data-reveal>
            <p class="eyebrow">{{ $page->text('about_eyebrow') }}</p>
            @if ($site->about_body)<x-site.prose :text="$site->about_body" class="lead mt-6 !max-w-none text-ink/80" />@endif
        </div>
        <dl class="grid grid-cols-2 gap-8 border-t border-ink/15 pt-8 md:col-span-4 md:col-start-9 md:grid-cols-1" data-reveal>
            @if ($site->founded_year)
                <div><dt class="eyebrow">{{ $page->text('established_label') }}</dt><dd class="mt-2 text-3xl font-semibold">{{ $site->founded_year }}</dd></div>
            @endif
            @if ($site->registration_number)
                <div><dt class="eyebrow">{{ $page->text('registration_label') }}</dt><dd class="mt-2 text-3xl font-semibold">RC {{ $site->registration_number }}</dd></div>
            @endif
        </dl>
    </section>

    {{-- Vision and mission --}}
    @if ($site->vision || $site->mission)
        <section class="bg-ink py-24 text-white md:py-32">
            <div class="wrap grid gap-16 md:grid-cols-2">
                @foreach ([$page->text('vision_label') => $site->vision, $page->text('mission_label') => $site->mission] as $label => $text)
                    @if ($text)
                        <div data-reveal>
                            <p class="eyebrow !text-stone">{{ $label }}</p>
                            <p class="mt-5 text-2xl font-medium leading-snug md:text-3xl">{{ $text }}</p>
                        </div>
                    @endif
                @endforeach
            </div>
        </section>
    @endif

    {{-- Clients, relationships, people and expertise --}}
    <section class="wrap py-24 md:py-32">
        <div class="space-y-24 md:space-y-32">
            @foreach ([
                [$page->text('clients_eyebrow'), $page->text('clients_heading'), $site->client_philosophy],
                [$page->text('relationships_eyebrow'), $page->text('relationships_heading'), $site->client_relationships],
                [$page->text('team_eyebrow'), $page->text('team_heading'), $site->team_philosophy],
                [$page->text('expertise_eyebrow'), $page->text('expertise_heading'), $site->technical_expertise],
            ] as [$eyebrow, $heading, $text])
                @if (filled($text))
                    <div class="grid gap-8 md:grid-cols-12 md:gap-16" data-reveal>
                        <div class="md:col-span-5">
                            <p class="eyebrow">{{ $eyebrow }}</p>
                            <h2 class="h2 mt-4">{{ $heading }}</h2>
                        </div>
                        <x-site.prose :text="$text" class="text-lg text-ink/80 md:col-span-7" />
                    </div>
                @endif
            @endforeach
        </div>
    </section>

    {{-- Capabilities --}}
    @if ($services->isNotEmpty())
        <section class="bg-white py-24 md:py-32">
            <div class="wrap">
                <x-site.section-heading :eyebrow="$page->text('capabilities_eyebrow')" :title="$page->text('capabilities_title')" />
                <div class="mt-14 border-b border-ink/15">
                    @foreach ($services as $service)
                        <x-site.service-feature :service="$service" :number="$loop->iteration" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Leadership --}}
    @if ($team->isNotEmpty())
        <section class="wrap py-24 md:py-32">
            <div class="flex flex-wrap items-end justify-between gap-6">
                <x-site.section-heading :eyebrow="$page->text('leadership_eyebrow')" :title="$page->text('leadership_title')" />
                <a href="{{ route('team') }}" class="link-arrow text-crl">{{ $page->text('team_link_label') }}</a>
            </div>
            <div class="mt-14 grid gap-10 md:grid-cols-3">
                @foreach ($team as $member)
                    <x-site.team-preview :member="$member" />
                @endforeach
            </div>
        </section>
    @endif

    <x-site.cta :home="$home" />
</x-layouts::site>
