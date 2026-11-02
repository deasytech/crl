@php($home = \App\Models\HomepageSetting::current())
<x-layouts::site title="Services" description="Architecture, construction, building services and project management from Custom Realities Limited.">
    <x-site.page-header eyebrow="Services" title="Integrated services across the building lifecycle.">
        Architecture, construction, building services and project management, delivered by one multidisciplinary practice.
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
