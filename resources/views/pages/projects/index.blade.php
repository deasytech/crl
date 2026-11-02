@php
    $home = \App\Models\HomepageSetting::current();
    $layout = [
        ['md:col-span-7', 'aspect-[4/3]', ''],
        ['md:col-span-5', 'aspect-[4/5]', 'md:mt-24'],
        ['md:col-span-5', 'aspect-[4/5]', ''],
        ['md:col-span-7', 'aspect-[4/3]', 'md:mt-24'],
        ['md:col-span-4', 'aspect-square', ''],
        ['md:col-span-8', 'aspect-[16/9]', 'md:mt-16'],
    ];
@endphp
<x-layouts::site :title="$active ? $active->name.' Projects' : 'Projects'" description="Selected architecture, construction and supervision projects by Custom Realities Limited.">
    <x-site.page-header eyebrow="Projects" title="A record of work across sectors.">
        Projects are shown with the status and CRL role documented in our company profile.
    </x-site.page-header>

    <section class="wrap py-16 md:py-24">
        <nav aria-label="Filter projects by category" class="flex flex-wrap gap-x-8 gap-y-3 border-b border-ink/15 pb-5 text-sm font-semibold uppercase tracking-[0.12em]">
            <a href="{{ route('projects.index') }}#projects" @if (! $active) aria-current="page" @endif @class(['pb-1', 'border-b-2 border-crl text-crl' => ! $active, 'text-ink/70 hover:text-ink' => $active])>All</a>
            @foreach ($categories as $category)
                @php($current = $active?->is($category))
                <a href="{{ route('projects.index', ['category' => $category->slug]) }}#projects" @if ($current) aria-current="page" @endif @class(['pb-1', 'border-b-2 border-crl text-crl' => $current, 'text-ink/70 hover:text-ink' => ! $current])>{{ $category->name }}</a>
            @endforeach
        </nav>

        <h2 id="projects" class="sr-only">{{ $active?->name ?? 'All' }} projects</h2>
        <p class="mt-6 text-sm text-stone-dark" aria-live="polite">{{ trans_choice('{0} No projects|{1} 1 project|[2,*] :count projects', $projects->count()) }}</p>

        <div class="mt-12 grid gap-x-8 gap-y-14 md:grid-cols-12">
            @forelse ($projects as $project)
                @php([$span, $ratio, $offset] = $layout[$loop->index % count($layout)])
                <div class="{{ $span }} {{ $offset }}">
                    <x-site.project-card :project="$project" :ratio="$ratio" />
                </div>
            @empty
                <p class="md:col-span-12">No projects are published in this category yet.</p>
            @endforelse
        </div>
    </section>

    <x-site.cta :home="$home" />
</x-layouts::site>
