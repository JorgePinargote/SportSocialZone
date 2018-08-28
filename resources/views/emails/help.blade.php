@component('mail::message')

{{ $nombre }}<br>
{{ $email }}<br>
<p>Asunto: </p> <h3>{{ $asunto }}</h3> <br>
<p>Mensaje: </p> <h3> {{ $mensaje }}</h3>  <br>

Gracias, <br>
{{ config('app.name') }}

@endcomponent
