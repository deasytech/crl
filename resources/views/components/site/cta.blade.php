@props(['home'])
<section class="bg-crl text-white">
    <div class="wrap grid gap-8 py-20 md:grid-cols-12 md:items-end md:py-28">
        <div class="md:col-span-8" data-reveal>
            <h2 class="h2">{{ $home->closing_heading }}</h2>
            @if ($home->closing_body)<p class="lead mt-6 text-white/90">{{ $home->closing_body }}</p>@endif
        </div>
        @if ($home->closing_cta_label)
            <div class="md:col-span-4 md:text-right"><a href="{{ $home->closing_cta_url }}" class="btn btn-line-light">{{ $home->closing_cta_label }}</a></div>
        @endif
    </div>
</section>
