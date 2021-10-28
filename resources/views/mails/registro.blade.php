@component('mail::message')
Hola **Administrador**, {{-- use double space for line break --}}  
**Nombre:** {{$name}}  
**Apellido:** {{ $lastName }}  
**Tipo de documento:** {{ $tipoDocumento }}  
**Nº docomunto:** {{ $documento }}  
**País:** {{ $selectorPais }}  
**Dirección:** {{ $direccion }}  
**Provincia:** {{ $provincia }}  
**Población:** {{ $poblacion }}  
**Código Postal:** {{ $cp }}  
**Cuota:** {{ $cuota }}  
**Tipo de cuota:** {{ $tipoCuota }}  
**Número móvil:** {{ $phoneNumber }}  
**Número fijo de teléfono:** {{ $phoneNumber2 }}  
**Nombre del banco:** {{ $nameBank }}  
**IBAN:** {{ $iban }}  

Click below to start working right now }}  
@component('mail::button', ['url' => 'www.fundaciondonbosco.es' ])
Go to your inbox
@endcomponent
Sincerely,
Mailtrap team.
@endcomponent