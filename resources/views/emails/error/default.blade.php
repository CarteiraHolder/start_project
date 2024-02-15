<x-mail::message>
# Error:

<p>
    {{$msg ?? ''}}
</p>
<hr>
<p>
    DADOS: {{$data ?? ''}}
</p>

Obrigado,<br>
{{ config('app.name') }}
</x-mail::message>
