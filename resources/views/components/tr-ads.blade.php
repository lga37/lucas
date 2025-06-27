<tr wire:key="ad-{{ $ad->id }}" class="odd:bg-white hover:bg-gray-200 even:bg-gray-100 border-b h-14">

    <td class="px-1 py-0 leading-5 whitespace-no-wrap">
        <input type="checkbox" wire:model.live="selectedIds" value="{{ $ad->id }}">
    </td>


    @if($this->showColumn('id'))
        <td class="px-0 py-0 text-xs">
            {{ $ad->id }}
        </td>
    @endif




    @if($this->showColumn('created_at'))
        <td class="px-0 py-0 text-xs">
            {{ rand(1, 30) ?? '' }}
        </td>
    @endif

    @if ($this->showColumn('tipo'))
        @php
            $cor = 'red';
        @endphp
        <td class="px-0 py-0 text-xs">
            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-{{ $cor }}-300 text-{{ $cor }}-800">
                {{ ucfirst($ad->tipo ?? '') }}
            </span>
        </td>
    @endif


    <td class="px-0 py-0">
        @if ($ad->slug && $ad->end)
            <a class="no-underline text-blue-400 hover:text-blue-600 hover:underline
                            hover:decoration-4 hover:decoration-blue-400" wire:navigate
                href="{{ route('imovel', $ad->slug) }}">

                {{ Str::words($ad->slug, 12) }}
            </a>
        @else
            erro slug/end
        @endif
    </td>


    @php
        $e = $ad->end;
        $c = 1;
        $u = 2;
        $b = 3;
    @endphp

@if ($this->showColumn('bairro'))
<td class="px-0 py-0">
        @if ($e && $b)
            <a class="no-underline text-blue-500 hover:text-blue-600 hover:underline hover:decoration-4 hover:decoration-blue-400"
                wire:navigate href="{{ route('bybairro', [$u, $c, $b]) }}">
                {{ $ad->bairro }}
            </a>
        @endif
    </td>
@endif

@if ($this->showColumn('cidade'))

    <td class="px-0 py-0">
        @if ($e && $c)
            <a class="no-underline text-blue-600 hover:text-blue-700 hover:underline hover:decoration-4 hover:decoration-blue-400"
                wire:navigate href="{{ route('bycidade', [$u, $c]) }}">
                {{ $ad->cidade }}
            </a>
        @endif
    </td>
    @endif

    @if ($this->showColumn('uf'))

    <td class="px-0 py-0 text-left">
        @if ($e && $u)
            <a class="no-underline text-blue-800 hover:text-blue-900 hover:underline hover:decoration-4 hover:decoration-blue-400"
                wire:navigate href="{{ route('byuf', [$u]) }}">
                {{ $ad->uf ?? '' }}
            </a>
        @endif
    </td>
    @endif

    @if ($this->showColumn('area'))

    <td class="pl-2 py-0 text-xs">
        {{ $ad->area }}
    </td>
    @endif

    @if ($this->showColumn('img'))

    <td class="px-0 py-0">
        @if($n = $ad->img)
            <img width="60px" alt="{{ $ad->slug }}" height="60px" class="w-12 h-12 rounded" src="{{ $n }}" />
        @else
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="stroke-1 stroke-gray-500 hover:stroke-gray-700 size-12">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
            </svg>
        @endif

    </td>
    @endif

    @if ($this->showColumn('pracas'))

    <td class="px-0 py-0">
        @if ($ad->preco1 > 0)
            <div class="flex flex-col">
                <span class="text-center text-green-500 text-2xl font-bold">{{ kmbt($ad->preco1) }}</span>
                <span class="text-center text-sm">{{ \Carbon\Carbon::createFromFormat('d/m', $ad->prazo1) }}
            </div>
        @endif
    </td>
    <td class="px-0 py-0">
        @if ($ad->preco2 > 0)
            <div class="flex flex-col">
                <span class="text-center text-green-900 text-2xl font-bold">{{ kmbt($ad->preco2) }}</span>
                <span class="text-center text-sm">{{ \Carbon\Carbon::createFromFormat('d/m', $ad->prazo2) }}
                </span>
            </div>
        @endif
    </td>
    @endif


    @if ($this->showColumn('acoes'))

    @php
        $liked = auth()->check() ? auth()->user()->hasStatus($ad, \App\Garimpia\Enums\AdUserStatus::LIKE) : false;
        $alerted = auth()->check() ? auth()->user()->hasStatus($ad, \App\Garimpia\Enums\AdUserStatus::ALERT) : false;
        $trashed = auth()->check() ? auth()->user()->hasStatus($ad, \App\Garimpia\Enums\AdUserStatus::TRASH) : false;

    @endphp
    <td>

        <button wire:click="toggleAdStatus({{ $ad->id }}, 1)">
            @if ($liked) ❤️ @else 🤍 @endif
        </button>
    </td>

    <td>
        <button x-data @click="$dispatch('copy-url', { url: '{{ route('byid', ['ad' => $ad->id]) }}' })"
            class="text-blue-500 hover:text-blue-700" title="Compartilhar">
            🔗
        </button>
    </td>

    <td>
        <button wire:click="toggleAdStatus({{ $ad->id }}, 2)">
            @if ($alerted) 🔔 @else 👁️ @endif
        </button>
    </td>

    <td>
        <button wire:click="toggleAdStatus({{ $ad->id }}, 3)">
            @if ($trashed) ❌ @else 🗑️ @endif
        </button>
    </td>

    @endif



    {{-- <td>
        <a href="{{ $ad->url }}" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="stroke-2 stroke-green-500 hover:stroke-green-900 size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
            </svg>
        </a>
    </td>

    <td>
        <a href="#" wire:click.prevent="toggleLike({{ $ad->id }})" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="stroke-2 stroke-red-500 hover:stroke-red-900 size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
            </svg>
        </a>
    </td>

    <td>
        <a href="{{ $ad->url }}" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="stroke-2 stroke-orange-500 hover:stroke-orange-900 size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
            </svg>
        </a>
    </td>
    <td>
        <a href="{{ $ad->url }}" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="stroke-2 stroke-red-500 hover:stroke-red-900 size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
            </svg>

        </a>
    </td> --}}

    @if ($this->showColumn('parc_id'))

        <td class="text-right pr-2">
            <a wire:navigate href="{{ route('byleiloeiro', $ad->parc) }}">
                ..abc
            </a>
        </td>
    @endif

</tr>
