@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Hola! Restablece la contraseña')

# @lang('')
@endif
@endif



{{-- Action Button --}}
# @lang('¿Has solicitado cambiar tu contraseña?. 
si has sido tú, puedes ingresar una nueva contraseña si no ignora este mensaje.')
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
    
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset







{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
    "Si tienes cualquier fallo".
    ' Puedes pegar este enlace en tu navegador. ',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
@endslot
@endisset
@endcomponent
