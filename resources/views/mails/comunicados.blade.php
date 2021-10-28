@component('mail::message')
Hello ** NONAME **,  {{-- use double space for line break --}}
Thank you for choosing Mailtrap!

Click below to start working right now
@component('mail::button', ['url' => 'www.fundaciondonbosco.es' ])
Go to your inbox
@endcomponent
Sincerely,
Mailtrap team.
@endcomponent