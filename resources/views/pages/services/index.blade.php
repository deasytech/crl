@php
    $home = \App\Models\HomepageSetting::current();
    $page = \App\Models\SitePage::get('services');
@endphp
<x-layouts::site :title="$page->seo_title" :description="$page->seo_description">
    <x-site.page-header :eyebrow="$page->eyebrow" :title="$page->title">
        {{ $page->intro }}
    </x-site.page-header>

    <section class="wrap py-24 md:py-32">
        <div class="border-b border-ink/15">
            @foreach ($services as $service)
                <x-site.service-feature :service="$service" :number="$loop->iteration" />
            @endforeach
        </div>
    </section>

    <x-site.cta :home="$home" />
</x-layouts::site>
