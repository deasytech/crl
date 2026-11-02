@php
    $home = \App\Models\HomepageSetting::current();
    $page = \App\Models\SitePage::get('projects');
    $mainUrl = \App\Support\Media::url($project->main_image);
    $known = $project->status !== \App\Enums\ProjectStatus::Unspecified;
    $facts = array_filter([
        'Category' => $project->category?->name,
        'Location' => $project->location,
        'Year' => $project->year_label,
        'Status' => $known ? $project->status->label() : null,
        'CRL role' => $project->crl_involvement,
    ]);
    // The lightbox walks the main photograph followed by the gallery, in order.
    $photos = collect([$mainUrl ? ['src' => $mainUrl, 'alt' => $project->main_image_alt ?? $project->title, 'caption' => null] : null])
        ->merge($project->images->map(fn ($image) => ['src' => \App\Support\Media::url($image->path), 'alt' => $image->alt ?? $project->title, 'caption' => $image->caption]))
        ->filter()->values();
@endphp
<x-layouts::site :title="$project->seo_title ?? $project->title" :description="$project->seo_description ?? $project->summary" :image="$mainUrl" type="article">
    <article>
        <header class="border-b border-ink/10">
            <div class="wrap py-16 md:py-24">
                <a href="{{ route('projects.index') }}" class="link-arrow text-stone-dark [&::after]:hidden">&larr; All projects</a>
                <h1 class="display mt-8 max-w-5xl">{{ $project->title }}</h1>
                @if ($project->summary)<p class="lead mt-8 text-ink/75">{{ $project->summary }}</p>@endif
            </div>
        </header>

        <div class="wrap grid gap-12 py-16 md:grid-cols-12 md:gap-16 md:py-24">
            <dl class="grid grid-cols-2 gap-x-6 gap-y-6 self-start border-t border-ink/15 pt-6 md:col-span-4 md:grid-cols-1">
                @foreach ($facts as $label => $value)
                    <div>
                        <dt class="eyebrow">{{ $label }}</dt>
                        <dd @class(['mt-1 font-medium', 'text-crl' => $label === 'Status' && $project->status === \App\Enums\ProjectStatus::Stalled])>{{ $value }}</dd>
                    </div>
                @endforeach
            </dl>

            <div class="md:col-span-8">
                @if ($mainUrl)
                    <figure>
                        <button type="button" data-lightbox="{{ 0 }}" class="block w-full cursor-zoom-in" aria-label="Enlarge photograph of {{ $project->title }}">
                            <x-site.picture :model="$project" column="main_image" :src="$mainUrl" :alt="$project->main_image_alt ?? $project->title" sizes="(min-width: 768px) 66vw, 100vw" priority class="aspect-[4/3] w-full object-cover" />
                        </button>
                    </figure>
                @endif
                @if ($project->description)
                    <x-site.prose :text="$project->description" :class="$mainUrl ? 'mt-12 text-lg text-ink/80' : 'text-lg text-ink/80'" />
                @elseif (! $mainUrl)
                    <p class="text-ink/70">A fuller description of this project has not yet been published.</p>
                @endif
            </div>
        </div>

        @if ($project->images->isNotEmpty())
            @php($offset = $mainUrl ? 1 : 0)
            <section class="bg-white py-16 md:py-24" aria-labelledby="gallery-heading">
                <div class="wrap">
                    <h2 id="gallery-heading" class="h2">{{ $page->text('gallery_heading') }}</h2>
                    <ul class="mt-10 columns-1 gap-6 sm:columns-2 lg:columns-3 [&>li]:mb-6 [&>li]:break-inside-avoid">
                        @foreach ($project->images as $image)
                            <li>
                                <button type="button" data-lightbox="{{ $loop->index + $offset }}" class="block w-full cursor-zoom-in" aria-label="Enlarge image {{ $loop->iteration }} of {{ $project->images->count() }}">
                                    <x-site.picture :model="$image" column="path" :src="\App\Support\Media::url($image->path)" :alt="$image->alt ?? $project->title" sizes="(min-width: 1024px) 33vw, (min-width: 640px) 50vw, 100vw" class="w-full object-cover" />
                                </button>
                                @if ($image->caption)<p class="mt-2 text-sm text-stone-dark">{{ $image->caption }}</p>@endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        @endif

        @if ($photos->isNotEmpty())
            <dialog data-lightbox-dialog aria-label="Project photographs" class="m-auto max-h-[92svh] w-[min(96vw,72rem)] bg-ink p-0 text-white backdrop:bg-black/80">
                <script type="application/json" data-lightbox-data>@json($photos)</script>
                <figure class="relative">
                    <img data-lightbox-image src="" alt="" class="max-h-[80svh] w-full object-contain">
                    <figcaption data-lightbox-caption class="px-5 py-3 text-sm text-stone"></figcaption>
                </figure>
                <div class="absolute right-3 top-3 flex gap-2">
                    <button type="button" data-lightbox-prev class="btn btn-line-light !min-h-10 !px-4" aria-label="Previous image">&larr;</button>
                    <button type="button" data-lightbox-next class="btn btn-line-light !min-h-10 !px-4" aria-label="Next image">&rarr;</button>
                    <button type="button" data-lightbox-close class="btn btn-line-light !min-h-10 !px-4">Close</button>
                </div>
            </dialog>
        @endif

        <nav aria-label="More projects" class="wrap flex justify-between gap-6 border-t border-ink/10 py-10 text-sm font-semibold uppercase tracking-[0.12em]">
            @if ($previous)<a href="{{ route('projects.show', $previous) }}" rel="prev">&larr; {{ $previous->title }}</a>@else<span></span>@endif
            @if ($next)<a href="{{ route('projects.show', $next) }}" rel="next" class="text-right">{{ $next->title }} &rarr;</a>@endif
        </nav>
    </article>

    <x-site.cta :home="$home" />
</x-layouts::site>
