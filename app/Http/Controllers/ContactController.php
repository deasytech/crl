<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactEnquiryRequest;
use App\Mail\NewContactEnquiry;
use App\Models\ContactEnquiry;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Throwable;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('pages.contact', ['services' => ContactEnquiryRequest::serviceChoices()]);
    }

    public function store(ContactEnquiryRequest $request): RedirectResponse
    {
        // Bots that fill the hidden field get the normal success page but nothing is stored or sent.
        if ($request->filled('homepage_url')) {
            return redirect()->to(route('contact').'#enquiry')->with('enquiry_sent', true);
        }

        $enquiry = ContactEnquiry::create([
            ...$request->safe()->except('homepage_url'),
            // Keyed hash, so repeat senders can be spotted without storing the address itself.
            'ip_hash' => hash_hmac('sha256', (string) $request->ip(), (string) config('app.key')),
        ]);

        $this->notify($enquiry);

        return redirect()->to(route('contact').'#enquiry')->with('enquiry_sent', true);
    }

    /** The enquiry is already stored, so a mail failure is logged and never shown as a form error. */
    private function notify(ContactEnquiry $enquiry): void
    {
        $site = SiteSetting::current();
        $recipient = $site->enquiry_recipient ?: $site->primary_email;

        if (blank($recipient)) {
            Log::warning('Contact enquiry stored but no enquiry recipient is configured.', ['enquiry' => $enquiry->id]);

            return;
        }

        try {
            Mail::to($recipient)->send(new NewContactEnquiry($enquiry));
        } catch (Throwable $e) {
            report($e);
        }
    }
}
