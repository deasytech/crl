<x-layouts::site :title="$page->seo_title" :description="$page->seo_description">
    <x-site.page-header :eyebrow="$page->eyebrow" :title="$page->title">
        {{ $page->intro }}
    </x-site.page-header>

    <section class="wrap py-24 md:py-32">
        <x-site.prose :text="$page->body" class="max-w-3xl text-lg text-ink/80" />
    </section>
</x-layouts::site>
