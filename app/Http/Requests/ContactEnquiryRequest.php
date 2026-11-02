<?php

namespace App\Http\Requests;

use App\Models\Service;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactEnquiryRequest extends FormRequest
{
    /** Value used for the "other / not sure" service choice. */
    public const OTHER_SERVICE = 'Other / not sure';

    /** @return array<string, ValidationRule|array<mixed>|string> */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email:rfc', 'max:190'],
            'phone' => ['nullable', 'string', 'max:40', 'regex:/^[0-9+()\-.\s]+$/'],
            'organisation' => ['nullable', 'string', 'max:160'],
            'service' => ['nullable', 'string', Rule::in(self::serviceChoices())],
            'project_location' => ['nullable', 'string', 'max:160'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
            // Honeypot: hidden from people; bots fill it. The controller treats a filled value as spam.
            'homepage_url' => ['nullable', 'string', 'max:255'],
        ];
    }

    /** @return array<string, string> */
    public function messages(): array
    {
        return [
            'phone.regex' => 'Please enter a valid telephone number.',
            'message.min' => 'Please tell us a little more about your project (at least 10 characters).',
            'service.in' => 'Please choose one of the listed services.',
        ];
    }

    /** @return array<int, string> */
    public static function serviceChoices(): array
    {
        return Service::published()->ordered()->get(['title'])
            ->map(fn (Service $service): string => $service->title)
            ->push(self::OTHER_SERVICE)
            ->values()
            ->all();
    }
}
