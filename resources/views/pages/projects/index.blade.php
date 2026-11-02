<x-layouts::site title="Projects">
    <section class="mx-auto max-w-7xl px-6 py-24">
        <h1 class="text-4xl font-semibold">Projects</h1>
        <ul class="mt-8 space-y-2">
            @foreach ($projects as $project)
                <li>
                    <a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a>
                    <span class="text-neutral-500">{{ $project->status->label() }}@if ($project->year_label), {{ $project->year_label }}@endif</span>
                </li>
            @endforeach
        </ul>
    </section>
</x-layouts::site>
