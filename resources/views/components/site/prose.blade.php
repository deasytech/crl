@props(['text'])
<div {{ $attributes->class(['space-y-5']) }}>
    @foreach (preg_split('/\n{2,}/', trim((string) $text)) as $paragraph)
        <p>{{ $paragraph }}</p>
    @endforeach
</div>
