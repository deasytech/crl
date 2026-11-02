<?php

namespace App\Mail;

use App\Models\ContactEnquiry;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class NewContactEnquiry extends Mailable
{
    public function __construct(public ContactEnquiry $enquiry) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: [new Address($this->enquiry->email, $this->enquiry->name)],
            subject: 'New website enquiry from '.$this->enquiry->name,
        );
    }

    public function content(): Content
    {
        return new Content(text: 'mail.new-contact-enquiry');
    }
}
