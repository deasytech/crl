@php
    $introImage = \App\Support\Media::url($home->intro_image);
    $introProject = $projects->first(fn ($p) => filled($p->main_image));
    $layout = [
        ['md:col-span-7', 'aspect-[4/3]', ''],
        ['md:col-span-5', 'aspect-[4/5]', 'md:mt-24'],
        ['md:col-span-5', 'aspect-[4/5]', ''],
        ['md:col-span-7', 'aspect-[4/3]', 'md:mt-24'],
    ];
@endphp
<x-layouts::site>
    <x-site.hero :home="$home" />

    {{-- Company introduction --}}
    <section class="wrap grid gap-12 py-24 md:grid-cols-12 md:gap-16 md:py-32">
        <div class="md:col-span-6 md:pt-8" data-reveal>
            <p class="eyebrow">About Custom Realities</p>
            <h2 class="h2 mt-4">{{ $home->intro_heading }}</h2>
            <div class="lead mt-8 space-y-5 text-ink/80">
                @foreach (preg_split('/\n{2,}/', (string) $home->intro_body) as $para)
                    <p>{{ $para }}</p>
                @endforeach
            </div>
            <a href="{{ route('company') }}" class="link-arrow mt-10 text-crl">The Company</a>
        </div>

        <figure class="md:col-span-6" data-reveal>
            @if ($introImage)
                <x-site.picture :model="$home" column="intro_image" :src="$introImage" :alt="$home->intro_image_alt ?? ''" sizes="(min-width: 768px) 40vw, 100vw" class="aspect-[4/5] w-full object-cover" />
            @elseif ($introProject)
                <x-site.picture :model="$introProject" column="main_image" :src="\App\Support\Media::url($introProject->main_image)" :alt="$introProject->main_image_alt ?? ''" sizes="(min-width: 768px) 40vw, 100vw" class="aspect-[4/5] w-full object-cover" />
                <figcaption class="mt-3 text-xs text-stone-dark">{{ $introProject->title }}@if ($introProject->location), {{ $introProject->location }}@endif @if ($introProject->crl_involvement) · {{ $introProject->crl_involvement }}@endif</figcaption>
            @endif
        </figure>
    </section>

    {{-- Highlights (verified statements only; no invented statistics) --}}
    @if (! empty($home->highlights))
        <section class="border-y border-ink/10" aria-label="Company highlights">
            <ul class="wrap grid divide-ink/10 sm:grid-cols-2 sm:divide-x lg:grid-cols-4">
                @foreach ($home->highlights as $item)
                    <li class="py-8 sm:px-8 sm:first:pl-0" data-reveal>
                        <p class="text-lg font-semibold">{{ $item['title'] }}</p>
                        <p class="mt-2 text-sm text-ink/70">{{ $item['body'] }}</p>
                    </li>
                @endforeach
            </ul>
        </section>
    @endif

    {{-- Services --}}
    <section class="wrap py-24 md:py-32">
        <x-site.section-heading eyebrow="What we do" title="Integrated services across the building lifecycle." />
        <div class="mt-14 border-b border-ink/15">
            @foreach ($services as $service)
                <x-site.service-feature :service="$service" :number="$loop->iteration" />
            @endforeach
        </div>
    </section>

    {{-- Selected projects --}}
    <section class="bg-white py-24 md:py-32">
        <div class="wrap">
            <div class="flex flex-wrap items-end justify-between gap-6">
                <x-site.section-heading eyebrow="Selected projects" title="Work we have designed, built and supervised." />
                <a href="{{ route('projects.index') }}" class="link-arrow text-crl">All projects</a>
            </div>
            <div class="mt-16 grid gap-x-8 gap-y-14 md:grid-cols-12">
                @foreach ($projects as $project)
                    @php([$span, $ratio, $offset] = $layout[$loop->index % 4])
                    <div class="{{ $span }} {{ $offset }}">
                        <x-site.project-card :project="$project" :ratio="$ratio" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Approach: presentation labels, not a claim of one fixed process --}}
    @if (! empty($home->approach_steps))
        <section class="bg-ink py-24 text-white md:py-32">
            <div class="wrap">
                <x-site.section-heading light eyebrow="Our approach" title="From first conversation to final handover." />
                <ol class="mt-16 grid gap-10 md:grid-cols-2 lg:grid-cols-4">
                    @foreach ($home->approach_steps as $step)
                        <li class="border-t border-white/20 pt-6" data-reveal>
                            <span class="text-sm font-semibold text-stone">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <h3 class="mt-4 text-xl font-semibold">{{ $step['title'] }}</h3>
                            <p class="mt-3 text-sm text-stone">{{ $step['body'] }}</p>
                        </li>
                    @endforeach
                </ol>
            </div>
        </section>
    @endif

    {{-- Why CRL --}}
    @if (! empty($home->why_points))
        <section class="wrap py-24 md:py-32">
            <x-site.section-heading eyebrow="Why Custom Realities" title="A practice built on expertise and long-term relationships." />
            <ul class="mt-16 grid gap-x-12 gap-y-10 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($home->why_points as $point)
                    <li class="border-t border-ink/15 pt-6" data-reveal>
                        <h3 class="text-lg font-semibold">{{ $point['title'] }}</h3>
                        <p class="mt-2 text-ink/70">{{ $point['body'] }}</p>
                    </li>
                @endforeach
            </ul>
        </section>
    @endif

    {{-- People --}}
    @if ($team->isNotEmpty())
        <section class="bg-white py-24 md:py-32">
            <div class="wrap">
                <div class="flex flex-wrap items-end justify-between gap-6">
                    <x-site.section-heading eyebrow="Our people" title="Led by experienced architects and project managers." />
                    <a href="{{ route('team') }}" class="link-arrow text-crl">Full team</a>
                </div>
                <div class="mt-14 grid gap-10 md:grid-cols-3">
                    @foreach ($team as $member)
                        <x-site.team-preview :member="$member" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Vision and mission (source wording from the company profile) --}}
    @php($site = \App\Models\SiteSetting::current())
    @if ($site->vision || $site->mission)
        <section class="wrap grid gap-16 py-24 md:grid-cols-2 md:py-32">
            @foreach (['Vision' => $site->vision, 'Mission' => $site->mission] as $label => $text)
                @if ($text)
                    <div data-reveal>
                        <p class="eyebrow">{{ $label }}</p>
                        <p class="mt-5 text-2xl font-medium leading-snug md:text-3xl">&ldquo;{{ $text }}&rdquo;</p>
                    </div>
                @endif
            @endforeach
        </section>
    @endif

    <x-site.cta :home="$home" />
</x-layouts::site>
