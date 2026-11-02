@props(['site'])
<footer class="border-t border-neutral-200 mt-24">
    <div class="mx-auto max-w-7xl px-6 py-12 text-sm">
        <p class="font-medium">{{ $site->company_name }}</p>
        @if ($site->registration_number)<p>RC {{ $site->registration_number }}</p>@endif
        @if ($site->address)<p>{{ $site->address }}</p>@endif
        @if ($site->primary_email)<p><a href="mailto:{{ $site->primary_email }}">{{ $site->primary_email }}</a></p>@endif
    </div>
</footer>
