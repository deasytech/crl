@php
    $home = \App\Models\HomepageSetting::current();
    $page = \App\Models\SitePage::get('team');
@endphp
<x-layouts::site :title="$page->seo_title" :description="$page->seo_description">
    <x-site.page-header :eyebrow="$page->eyebrow" :title="$page->title">
        {{ $page->intro }}
    </x-site.page-header>

    <section class="wrap py-24 md:py-32" aria-labelledby="core-heading">
        <h2 id="core-heading" class="h2">{{ $page->text('core_heading') }}</h2>
        <div class="mt-14 grid gap-x-12 gap-y-14 md:grid-cols-2">
            @foreach ($core as $member)
                @php($portrait = \App\Support\Media::url($member->portrait))
                <article class="border-t border-ink/15 pt-6 @if ($member->biography) md:col-span-2 @endif" data-reveal>
                    <div class="grid gap-6 @if ($member->biography) md:grid-cols-12 md:gap-12 @endif">
                        <div class="@if ($member->biography) md:col-span-5 @endif">
                            @if ($portrait)
                                <x-site.picture :model="$member" column="portrait" :src="$portrait" :alt="'Portrait of '.$member->name" sizes="20rem" class="mb-6 aspect-[4/5] w-full max-w-xs object-cover" />
                            @endif
                            <h3 class="text-2xl font-semibold">{{ $member->name }}</h3>
                            @if ($member->designation)<p class="mt-2 text-sm font-semibold uppercase tracking-[0.12em] text-crl">{{ $member->designation }}</p>@endif
                            @if ($member->qualifications)<p class="mt-2 text-sm text-stone-dark">{{ $member->qualifications }}</p>@endif
                        </div>
                        @if ($member->biography)
                            <details class="md:col-span-7" @if ($loop->first) open @endif>
                                <summary class="cursor-pointer text-sm font-semibold uppercase tracking-[0.12em]">{{ $page->text('biography_label') }}</summary>
                                <x-site.prose :text="$member->biography" class="mt-4 text-ink/80" />
                            </details>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    @if ($affiliates->isNotEmpty())
        <section class="bg-white py-24 md:py-32">
            <div class="wrap">
                <x-site.section-heading :eyebrow="$page->text('affiliates_eyebrow')" :title="$page->text('affiliates_title')" />
                <div class="mt-14 grid gap-x-12 gap-y-12 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($affiliates as $category => $members)
                        <div class="border-t border-ink/15 pt-6" data-reveal>
                            <h3 class="eyebrow">{{ $category }}</h3>
                            <ul class="mt-4 space-y-3">
                                @foreach ($members as $member)
                                    <li>
                                        <p class="font-semibold">{{ $member->name }}</p>
                                        @if ($member->qualifications)<p class="text-sm text-stone-dark">{{ $member->qualifications }}</p>@endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <x-site.cta :home="$home" />
</x-layouts::site>
