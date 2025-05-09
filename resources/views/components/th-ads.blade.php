@props(['columName', 'visible'])

@if ($visible)
    <th @if($columName == 'acoes') colspan="4" @endif @if($columName == 'precos') colspan="2" @endif
        class="hover:text-pink-700 hover:underline text-center hover:decoration-4 hover:decoration-pink-700 underline text-black font-bold decoration-pink-500">
        {{ $this->columns[$columName] ?? Str::headline($columName) }}
    </th>
@endif