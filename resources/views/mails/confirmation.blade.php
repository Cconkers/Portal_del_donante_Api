@component('mail::message')
**¡Hola, {{$name}} {{$lastName}}!**   

Haz click en el botón para confirmar tu correo electrónico  {{$email}}
@component('mail::button', ['url' => 'http://localhost:8000/api/confirm-email/'.$id])
CONFIRMAR
@endcomponent
Un saludo,
equipo de programadores de Don Bosco.
@endcomponent