@component('mail::message')
**COMUNICADO NUEVO**,  {{-- use double space for line break --}}

Click below to start working right now
@component('mail::button', ['url' => 'www.fundaciondonbosco.es' ])
Go to your inbox
@endcomponent
Sincerely,
Mailtrap team.
@endcomponent