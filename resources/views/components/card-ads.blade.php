<div wire:key="ad-{{ $ad->id }}"
    class="relative w-[220px] min-h-[240px] rounded-xl shadow-md overflow-hidden mx-autogroup">

    <a wire:navigate href="{{ route('imovel', $ad->slug) }}">


        <img src="{{ $ad->img->path ?? 'https://via.placeholder.com/500x500?text=Imagem+do+imóvel' }}"
            alt="{{ $ad->getNome() }}" class="absolute inset-0 w-full h-full object-cover z-0" />

        {{-- Sobreposição com conteúdo --}}
        <div
            class="relative z-10 h-full w-full bg-white/30 backdrop-blur-sm p-3 flex flex-col justify-between rounded-xl">

            {{-- Selo + localização --}}
            <div class="flex justify-between items-center text-[11px] text-gray-700">
                <span
                    class="bg-yellow-200 text-yellow-800 px-2 py-0.5 rounded-full font-semibold uppercase text-[10px]">
                    {{ $ad->tipo }}
                </span>

                <span
                    class="bg-blue-200 text-blue-800 px-2 py-0.5 rounded-full font-semibold uppercase text-[10px]">
                    {{ $ad->getArea() }}
                </span>


            </div>

            @php
            $e = $ad->end;
            $c = $e?->cidade;
            $u = $c?->uf;
            $b = $e?->bairro;
            @endphp
        
            <div class="flex justify-between items-center text-[11px] text-gray-700">
       
                @if ($e && $c)
                <a class="rounded no-underline text-blue-600 hover:text-blue-700 hover:underline hover:decoration-4 hover:decoration-blue-400"
                    wire:navigate href="{{ route('bycidade', [$u, $c]) }}">
                    {{ Str::words($c->nome ?? '', 5) }}
                </a>
                @endif


   
                @if ($e && $u)
                <a class="rounded no-underline text-blue-800 hover:text-blue-900 hover:underline hover:decoration-4 hover:decoration-blue-400"
                    wire:navigate href="{{ route('byuf', [$u]) }}">
                    {{ $u->uf ?? '' }}
                </a>
                @endif

            </div>



            {{-- <h3 class="text-[12px] text-gray-500">
                {{ $ad->getNome() }}
            </h3> --}}


            <div class="flex items-center space-x-2">
                
                <span class="px-2 text-center text-green-700 bg-green-100/50 rounded text-2xl font-bold">{{ $ad->formataPreco('p1') }}</span>
                <span class="px-2 text-center text-green-800 bg-green-300/50 rounded text-xl">{{ $ad->formataPreco('p2') }}</span>
            </div>
        </div>

    </a>
            
        <div class="flex items-center space-x-2">
            @php
            $liked = auth()->check() ? auth()->user()->hasStatus($ad, \App\Garimpia\Enums\AdUserStatus::LIKE) : false;
            $alerted = auth()->check() ? auth()->user()->hasStatus($ad, \App\Garimpia\Enums\AdUserStatus::ALERT) : false;
            $trashed = auth()->check() ? auth()->user()->hasStatus($ad, \App\Garimpia\Enums\AdUserStatus::TRASH) : false;

            @endphp
            <button wire:click="toggleAdStatus({{ $ad->id }}, {{ \App\Garimpia\Enums\AdUserStatus::LIKE }})">
                @if ($liked) ❤️ @else 🤍 @endif
            </button>
        
            <button x-data @click="$dispatch('copy-url', { url: '{{ route('byid', ['ad' => $ad->id]) }}' })">
                🔗
            </button>
        
            <button wire:click="toggleAdStatus({{ $ad->id }}, {{ \App\Garimpia\Enums\AdUserStatus::ALERT }})">
                @if ($alerted) 🔔 @else 👁️ @endif
            </button>
        
            <button wire:click="toggleAdStatus({{ $ad->id }}, {{ \App\Garimpia\Enums\AdUserStatus::TRASH }})">
                @if ($trashed) ❌ @else 🗑️ @endif
            </button>
        </div>




   

</div>
