@props(['model' => null, 'column' => null, 'src', 'alt' => '', 'sizes' => '100vw', 'priority' => false, 'webp' => null])
@php($media = $model?->optimisedImage($column))
<picture>
    @if ($media)
        <source type="image/webp" srcset="{{ preg_replace('/,\s*data:\S+\s+\d+w/', '', $media->getSrcset('web')) }}" sizes="{{ $sizes }}">
    @elseif ($webp)
        <source type="image/webp" srcset="{{ $webp }}" sizes="{{ $sizes }}">
    @endif
    <img src="{{ $src }}" alt="{{ $alt }}" decoding="async" @if ($priority) fetchpriority="high" @else loading="lazy" @endif {{ $attributes }}>
</picture>
