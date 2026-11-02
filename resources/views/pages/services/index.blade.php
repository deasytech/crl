<x-layouts::site title="Services">
    <section class="mx-auto max-w-7xl px-6 py-24">
        <h1 class="text-4xl font-semibold">Services</h1>
        <ul class="mt-8 space-y-2">
            @foreach ($services as $service)
                <li><a href="{{ route('services.show', $service) }}">{{ $service->title }}</a></li>
            @endforeach
        </ul>
    </section>
</x-layouts::site>
