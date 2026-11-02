@props(['member'])
@php($portrait = \App\Support\Media::url($member->portrait))
<article class="border-t border-ink/15 pt-6" data-reveal>
    @if ($portrait)
        <img src="{{ $portrait }}" alt="Portrait of {{ $member->name }}" loading="lazy" class="mb-6 aspect-[4/5] w-full object-cover">
    @endif
    <h3 class="text-xl font-semibold">{{ $member->name }}</h3>
    @if ($member->designation)<p class="mt-1 text-sm font-semibold uppercase tracking-[0.12em] text-crl">{{ $member->designation }}</p>@endif
    @if ($member->qualifications)<p class="mt-2 text-sm text-stone-dark">{{ $member->qualifications }}</p>@endif
</article>
