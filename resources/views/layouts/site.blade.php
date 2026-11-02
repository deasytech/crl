@php($site = \App\Models\SiteSetting::current())
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @include('partials.seo')
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <script>if (!matchMedia('(prefers-reduced-motion: reduce)').matches) document.documentElement.classList.add('js')</script>
        @fonts('site')
        @vite(['resources/css/site.css', 'resources/js/site.js'])
    </head>
    <body>
        <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:bg-white focus:px-4 focus:py-2">Skip to content</a>
        <x-site.header />
        <main id="main">{{ $slot }}</main>
        <x-site.footer :site="$site" />
    </body>
</html>
