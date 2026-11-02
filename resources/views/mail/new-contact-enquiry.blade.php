New enquiry received through the website.

Name: {{ $enquiry->name }}
Email: {{ $enquiry->email }}
Phone: {{ $enquiry->phone ?: '-' }}
Organisation: {{ $enquiry->organisation ?: '-' }}
Service: {{ $enquiry->service ?: '-' }}
Project location: {{ $enquiry->project_location ?: '-' }}

Message:
{{ $enquiry->message }}

Reply to this email to respond to the sender. The enquiry is also recorded in the admin panel.
