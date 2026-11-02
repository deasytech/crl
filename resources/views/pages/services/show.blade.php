<x-layouts::site :title="$service->seo_title ?? $service->title" :description="$service->seo_description ?? $service->short_description">
    <section class="mx-auto max-w-7xl px-6 py-24">
        <h1 class="text-4xl font-semibold">{{ $service->title }}</h1>
        <p class="mt-6 max-w-2xl">{{ $service->short_description }}</p>
    </section>
</x-layouts::site>
