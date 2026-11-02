@props(['project', 'ratio' => 'aspect-[4/3]', 'priority' => false])
@php($url = \App\Support\Media::url($project->main_image))
<a href="{{ route('projects.show', $project) }}" class="group block" data-reveal>
    <div @class(['relative overflow-hidden bg-ink', $ratio])>
        @if ($url)
            <img src="{{ $url }}" alt="{{ $project->main_image_alt ?? $project->title }}" loading="{{ $priority ? 'eager' : 'lazy' }}" decoding="async" class="size-full object-cover transition-transform duration-700 ease-site group-hover:scale-105">
        @else
            <div class="flex size-full items-end p-6"><span class="text-xl font-semibold text-white/80">{{ $project->title }}</span></div>
        @endif
    </div>
    <div class="mt-4 flex items-start justify-between gap-4">
        <div>
            <h3 class="text-lg font-semibold transition-colors group-hover:text-crl">{{ $project->title }}</h3>
            <p class="mt-1 text-sm text-stone-dark">{{ collect([$project->category?->name, $project->location])->filter()->implode(' · ') }}</p>
        </div>
        @if ($project->status !== \App\Enums\ProjectStatus::Unspecified)
            <p class="shrink-0 text-right text-xs uppercase tracking-[0.12em] text-stone-dark">{{ $project->status->label() }}@if ($project->year_label)<br>{{ $project->year_label }}@endif</p>
        @endif
    </div>
</a>
