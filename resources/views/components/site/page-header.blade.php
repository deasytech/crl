@props(['eyebrow', 'title'])
<header class="border-b border-ink/10">
    <div class="wrap py-20 md:py-28">
        <p class="eyebrow">{{ $eyebrow }}</p>
        <h1 class="display mt-5 max-w-4xl">{{ $title }}</h1>
        @if (trim($slot))<div class="lead mt-8 text-ink/75">{{ $slot }}</div>@endif
    </div>
</header>
