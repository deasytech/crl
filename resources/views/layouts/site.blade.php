@php($site = \App\Models\SiteSetting::current())
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ filled($title ?? null) ? $title.' | '.$site->company_name : $site->company_name }}</title>
        @isset($description)
            <meta name="description" content="{{ $description }}">
        @endisset
        <link rel="canonical" href="{{ url()->current() }}">
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-white text-neutral-900 antialiased">
        <a href="#main" class="sr-only focus:not-sr-only">Skip to content</a>
        <x-site.header />
        <main id="main">{{ $slot }}</main>
        <x-site.footer :site="$site" />
    </body>
</html>
