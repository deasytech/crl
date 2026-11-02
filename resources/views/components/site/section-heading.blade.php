@props(['eyebrow' => null, 'title', 'light' => false])
<div {{ $attributes->class(['max-w-3xl']) }} data-reveal>
    @if ($eyebrow)<p @class(['eyebrow', '!text-stone' => $light])>{{ $eyebrow }}</p>@endif
    <h2 @class(['h2', 'mt-4' => $eyebrow, 'text-white' => $light])>{{ $title }}</h2>
    @if (trim($slot))<div @class(['lead mt-6', 'text-stone' => $light, 'text-ink/75' => ! $light])>{{ $slot }}</div>@endif
</div>
