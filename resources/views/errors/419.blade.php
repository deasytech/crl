<x-layouts::site title="Session expired">
    <x-site.page-header eyebrow="Error 419" title="Session expired">
        Your session has expired. Please go back, refresh the page and try again.
    </x-site.page-header>

    <section class="wrap py-16 md:py-24">
        <a href="{{ route('home') }}" class="btn btn-solid">Back to the homepage</a>
    </section>
</x-layouts::site>
