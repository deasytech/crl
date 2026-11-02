@props(['service', 'number'])
<a href="{{ route('services.show', $service) }}" class="group grid gap-4 border-t border-ink/15 py-8 transition-colors hover:border-crl md:grid-cols-12 md:gap-8" data-reveal>
    <span class="text-sm font-semibold text-crl md:col-span-1">{{ str_pad($number, 2, '0', STR_PAD_LEFT) }}</span>
    <h3 class="text-2xl font-semibold md:col-span-4 md:text-3xl">{{ $service->title }}</h3>
    <p class="text-ink/75 md:col-span-6">{{ $service->short_description }}</p>
    <span class="link-arrow md:col-span-1 md:justify-end"><span class="sr-only">{{ $service->title }}</span></span>
</a>
