@php($site = \App\Models\SiteSetting::current())
<x-layouts::site title="Contact" description="Contact Custom Realities Limited in Port Harcourt, Nigeria.">
    <x-site.page-header eyebrow="Contact" title="Have a project in mind?">
        Let's discuss how our expertise can help bring your vision to life.
    </x-site.page-header>

    <section class="wrap grid gap-16 py-24 md:grid-cols-12 md:py-32">
        <dl class="space-y-10 md:col-span-5">
            @if ($site->address)
                <div><dt class="eyebrow">Office</dt><dd class="mt-3 text-lg">{{ $site->company_name }}<br>{{ $site->address }}</dd></div>
            @endif
            @if ($site->office_phone || $site->mobile_phone)
                <div>
                    <dt class="eyebrow">Telephone</dt>
                    <dd class="mt-3 space-y-1 text-lg">
                        @if ($site->office_phone)<p><span class="text-stone-dark">Office</span> <a class="font-medium hover:text-crl" href="tel:{{ preg_replace('/\s+/', '', $site->office_phone) }}">{{ $site->office_phone }}</a></p>@endif
                        @if ($site->mobile_phone)<p><span class="text-stone-dark">Mobile</span> <a class="font-medium hover:text-crl" href="tel:{{ preg_replace('/\s+/', '', $site->mobile_phone) }}">{{ $site->mobile_phone }}</a></p>@endif
                    </dd>
                </div>
            @endif
            @if ($site->primary_email)
                <div><dt class="eyebrow">Email</dt><dd class="mt-3 text-lg"><a class="font-medium hover:text-crl" href="mailto:{{ $site->primary_email }}">{{ $site->primary_email }}</a></dd></div>
            @endif
        </dl>

        {{-- Reserved for the enquiry form (Phase 6). No form is shown until it is built and tested. --}}
        <div class="border-t border-ink/15 pt-8 md:col-span-6 md:col-start-7" id="enquiry">
            <p class="eyebrow">Enquiries</p>
            <p class="mt-4 text-lg text-ink/80">For project enquiries, please telephone or email us using the details provided.</p>
        </div>
    </section>
</x-layouts::site>
