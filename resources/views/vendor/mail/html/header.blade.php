@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
{{-- {{ $slot }} --}}
<img src="https://uploaddeimagens.com.br/images/004/650/337/full/Logo_02.png?1698512224" class="logo" alt="">
@endif
</a>
</td>
</tr>
