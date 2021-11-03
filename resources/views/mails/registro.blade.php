@component('mail::message')
**Petición de registro de nuevo usuario:** {{-- use double space for line break --}}  
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

Click en el botón para aceder al listado de donantes y aprobar su cuenta
@component('mail::button', ['url' => 'http://localhost:8080/buscardonantes' ])
Listado de Donantes
@endcomponent
Un saludo,
coders de Don Bosco
@endcomponent