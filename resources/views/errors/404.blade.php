<x-layouts::site title="Page not found">
    <x-site.page-header eyebrow="Error 404" title="Page not found">
        The page you are looking for does not exist or has moved.
    </x-site.page-header>

    <section class="wrap py-16 md:py-24">
        <a href="{{ route('home') }}" class="btn btn-solid">Back to the homepage</a>
    </section>
</x-layouts::site>
