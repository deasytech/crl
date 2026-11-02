@php($home = \App\Models\HomepageSetting::current())
<x-layouts::site :title="$service->seo_title ?? $service->title" :description="$service->seo_description ?? $service->short_description" :image="\App\Support\Media::url($service->image)">
    <x-site.page-header eyebrow="Services" :title="$service->title">
        {{ $service->short_description }}
    </x-site.page-header>

    <section class="wrap grid gap-12 py-24 md:grid-cols-12 md:gap-16 md:py-32">
        <div class="md:col-span-7" data-reveal>
            @if ($service->description)<x-site.prose :text="$service->description" class="text-lg text-ink/80" />@endif
            @if ($service->image)
                <x-site.picture :model="$service" column="image" :src="\App\Support\Media::url($service->image)" :alt="$service->image_alt ?? ''" sizes="(min-width: 768px) 58vw, 100vw" class="mt-12 aspect-[16/10] w-full object-cover" />
            @endif
        </div>
        @if (! empty($service->capabilities))
            <aside class="md:col-span-4 md:col-start-9" data-reveal>
                <p class="eyebrow">Capabilities</p>
                <ul class="mt-5 divide-y divide-ink/10 border-y border-ink/10">
                    @foreach ($service->capabilities as $capability)
                        <li class="py-4 font-medium">{{ $capability }}</li>
                    @endforeach
                </ul>
            </aside>
        @endif
    </section>

    @if ($projects->isNotEmpty())
        <section class="bg-white py-24 md:py-32">
            <div class="wrap">
                <div class="flex flex-wrap items-end justify-between gap-6">
                    <x-site.section-heading eyebrow="In practice" :title="'Selected '.\Illuminate\Support\Str::lower($service->title).' projects.'" />
                    <a href="{{ route('projects.index') }}" class="link-arrow text-crl">All projects</a>
                </div>
                <div class="mt-14 grid gap-10 md:grid-cols-3">
                    @foreach ($projects as $project)
                        <x-site.project-card :project="$project" ratio="aspect-[4/5]" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="wrap py-24 md:py-32">
        <p class="eyebrow">Other services</p>
        <div class="mt-8 border-b border-ink/15">
            @foreach ($others as $other)
                <x-site.service-feature :service="$other" :number="$loop->iteration" />
            @endforeach
        </div>
    </section>

    <x-site.cta :home="$home" />
</x-layouts::site>
