<header class="border-b border-neutral-200">
    <nav aria-label="Primary" class="mx-auto flex max-w-7xl items-center justify-between gap-6 px-6 py-4">
        <a href="{{ route('home') }}" aria-label="Custom Realities Limited, home">
            <img src="{{ asset('images/logo.png') }}" alt="Custom Realities Limited" class="h-10 w-auto" width="747" height="334">
        </a>
        <ul class="flex flex-wrap gap-x-6 gap-y-2 text-sm">
            <li><a href="{{ route('company') }}">The Company</a></li>
            <li><a href="{{ route('services.index') }}">Services</a></li>
            <li><a href="{{ route('projects.index') }}">Projects</a></li>
            <li><a href="{{ route('team') }}">Our Team</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
        </ul>
    </nav>
</header>
