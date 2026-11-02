<x-layouts::site title="Too many requests">
    <x-site.page-header eyebrow="Error 429" title="Too many requests">
        Please wait a moment before trying again.
    </x-site.page-header>

    <section class="wrap py-16 md:py-24">
        <a href="{{ route('home') }}" class="btn btn-solid">Back to the homepage</a>
    </section>
</x-layouts::site>
