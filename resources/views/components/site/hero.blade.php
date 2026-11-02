@props(['home'])
@php
    $image = \App\Support\Media::url($home->hero_image);
    $alt = $home->hero_image_alt ?? '';
    $slides = [
        ['name' => 'slide-1', 'alt' => 'Illustrative concept image of a contemporary building at sunset'],
        ['name' => 'slide-2', 'alt' => 'Illustrative concept image of a contemporary building in warm evening light'],
    ];
@endphp
<section class="relative isolate flex h-[min(calc(100svh-4.5rem),56rem)] min-h-[32rem] items-end overflow-hidden bg-ink text-white">
    @if ($image)
        <x-site.picture :model="$home" column="hero_image" :src="$image" :alt="$alt" priority class="absolute inset-0 -z-20 size-full object-cover object-right" />
    @else
        @foreach ($slides as $slide)
            <div class="hero-slide absolute inset-0 -z-20" style="animation-delay: -{{ $loop->index * 7 }}s">
                <x-site.picture :src="asset('images/'.$slide['name'].'.jpg')" :webp="asset('images/'.$slide['name'].'.webp')" :alt="$slide['alt']" :priority="$loop->first" class="size-full object-cover object-center" />
            </div>
        @endforeach
    @endif
    <div class="absolute inset-0 -z-10 bg-gradient-to-t from-ink/90 via-ink/40 to-ink/10 md:bg-gradient-to-r md:from-ink/85 md:via-ink/45 md:to-transparent"></div>

    <div class="wrap pb-16 pt-32 md:pb-24">
        <p class="eyebrow !text-white/70">Architecture &bull; Construction &bull; Services</p>
        <h1 class="display mt-5 max-w-4xl">{{ $home->hero_headline }}</h1>
        @if ($home->hero_subheading)<p class="lead mt-7 text-white/85">{{ $home->hero_subheading }}</p>@endif
        <div class="mt-10 flex flex-wrap gap-4">
            @if ($home->primary_cta_label)<a href="{{ $home->primary_cta_url }}" class="btn btn-solid">{{ $home->primary_cta_label }}</a>@endif
            @if ($home->secondary_cta_label)<a href="{{ $home->secondary_cta_url }}" class="btn btn-line-light">{{ $home->secondary_cta_label }}</a>@endif
        </div>
    </div>
</section>
