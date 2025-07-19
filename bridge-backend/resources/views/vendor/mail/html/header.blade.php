@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'CazeTV')
<img src="{{ env('APP_URL') }}/images/logo_cazetv.png" class="logo" alt="Cazetv Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
