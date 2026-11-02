<x-layouts::site :title="$project->seo_title ?? $project->title" :description="$project->seo_description ?? $project->summary">
    <section class="mx-auto max-w-7xl px-6 py-24">
        <h1 class="text-4xl font-semibold">{{ $project->title }}</h1>
        <dl class="mt-6 text-sm">
            <dt class="sr-only">Status</dt><dd>{{ $project->status->label() }}</dd>
        </dl>
    </section>
</x-layouts::site>
