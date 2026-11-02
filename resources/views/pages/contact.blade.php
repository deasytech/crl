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

        <div class="border-t border-ink/15 pt-8 md:col-span-6 md:col-start-7" id="enquiry" tabindex="-1">
            <h2 class="eyebrow">Send an enquiry</h2>

            @if (session('enquiry_sent'))
                <div role="status" class="mt-6 border-l-4 border-crl bg-white p-6">
                    <p class="text-lg font-semibold">Thank you. Your enquiry has been received.</p>
                    <p class="mt-2 text-ink/80">We will review it and get back to you. For anything urgent, please telephone us.</p>
                </div>
            @else
                @if ($errors->any())
                    <div role="alert" class="mt-6 border-l-4 border-crl-dark bg-white p-6" tabindex="-1" data-form-errors>
                        <p class="font-semibold">Please correct the following and send again:</p>
                        <ul class="mt-2 list-disc pl-5 text-sm">
                            @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}" class="mt-8 space-y-6" novalidate>
                    @csrf
                    <div class="absolute -left-[9999px]" aria-hidden="true">
                        <label for="homepage_url">Leave this field empty</label>
                        <input type="text" id="homepage_url" name="homepage_url" tabindex="-1" autocomplete="off">
                    </div>
                    @php($attrs = fn (string $name): string => 'id="'.$name.'" name="'.$name.'" aria-invalid="'.($errors->has($name) ? 'true' : 'false').'"' . ($errors->has($name) ? ' aria-describedby="'.$name.'-error"' : ''))

                    <div>
                        <label for="name" class="field-label">Full name <span class="text-crl-dark" aria-hidden="true">*</span></label>
                        <input type="text" class="field" value="{{ old('name') }}" required autocomplete="name" {!! $attrs('name') !!}>
                        @error('name')<p class="field-error" id="name-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="grid gap-6 sm:grid-cols-2">
                        <div>
                            <label for="email" class="field-label">Email <span class="text-crl-dark" aria-hidden="true">*</span></label>
                            <input type="email" class="field" value="{{ old('email') }}" required autocomplete="email" {!! $attrs('email') !!}>
                            @error('email')<p class="field-error" id="email-error">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="phone" class="field-label">Telephone</label>
                            <input type="tel" class="field" value="{{ old('phone') }}" autocomplete="tel" {!! $attrs('phone') !!}>
                            @error('phone')<p class="field-error" id="phone-error">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div>
                        <label for="organisation" class="field-label">Company or organisation</label>
                        <input type="text" class="field" value="{{ old('organisation') }}" autocomplete="organization" {!! $attrs('organisation') !!}>
                        @error('organisation')<p class="field-error" id="organisation-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="grid gap-6 sm:grid-cols-2">
                        <div>
                            <label for="service" class="field-label">Service required</label>
                            <select class="field" {!! $attrs('service') !!}>
                                <option value="">Select a service</option>
                                @foreach ($services as $option)
                                    <option value="{{ $option }}" @selected(old('service') === $option)>{{ $option }}</option>
                                @endforeach
                            </select>
                            @error('service')<p class="field-error" id="service-error">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="project_location" class="field-label">Project location</label>
                            <input type="text" class="field" value="{{ old('project_location') }}" {!! $attrs('project_location') !!}>
                            @error('project_location')<p class="field-error" id="project_location-error">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div>
                        <label for="message" class="field-label">Project description <span class="text-crl-dark" aria-hidden="true">*</span></label>
                        <textarea rows="6" class="field" required {!! $attrs('message') !!}>{{ old('message') }}</textarea>
                        @error('message')<p class="field-error" id="message-error">{{ $message }}</p>@enderror
                    </div>
                    <p class="text-sm text-stone-dark">Fields marked * are required. We use your details only to respond to your enquiry.</p>
                    <button type="submit" class="btn btn-solid">Send enquiry</button>
                </form>
            @endif
        </div>
    </section>
</x-layouts::site>
