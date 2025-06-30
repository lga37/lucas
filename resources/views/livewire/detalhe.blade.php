<div class="max-w-7xl mx-auto p-4 space-y-6">
    <!-- Breadcrumbs -->
    <nav class="flex items-center text-sm text-gray-600 print:hidden" aria-label="Breadcrumb">

        <ol class="flex flex-wrap md:inline-flex items-center gap-y-1 space-x-0 md:space-x-2 rtl:space-x-reverse text-sm">
    <li class="inline-flex items-center">
        <a href="/" class="inline-flex items-center hover:underline dark:text-white pl-2 pr-2">
            Brasil
        </a>
    </li>

    <li class="flex items-center m-0 md:m-2">
        <span class="mx-1 text-gray-400">/</span>
        <a href="#" class="hover:underline dark:text-white pl-2 pr-2">{{ $ad->uf }}</a>
    </li>

    <li class="flex items-center m-0 md:m-2">
        <span class="mx-1 text-gray-400">/</span>
        <a href="#" class="hover:underline dark:text-white pl-2 pr-2">{{ $ad->cidade }}</a>
    </li>

    <li class="flex items-center m-0 md:m-2">
        <span class="mx-1 text-gray-400">/</span>
        <a href="#" class="hover:underline dark:text-white pl-2 pr-2">{{ $ad->bairro }}</a>
    </li>

    <li class="flex items-center m-0 md:m-2">
        <span class="mx-1 text-gray-400 dark:text-white">/</span>
        <span class="text-gray-500 dark:text-white pl-2 pr-2">{{ $ad->rua }}</span>
    </li>

    <li class="flex items-center m-0 md:m-2">
        <span class="mx-1 text-gray-400 dark:text-white">#</span>
        <span class="text-gray-500 dark:text-white pl-2 pr-2">{{ $ad->id }}</span>
    </li>
</ol>

    </nav>


    <!-- Título -->
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $ad->nome }}</h1>

    <!-- Localização / Maps -->
    <a href="https://www.google.com/maps/search/{{ $ad->nome }}" target="_blank"
        class="inline-flex items-center text-blue-600 hover:underline print:hidden">
        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
        </svg>
        <span>Ver no Maps</span>
    </a>

    @php
        $liked = auth()->check() ? auth()->user()->hasStatus($ad, 1) : false;
        $alerted = auth()->check() ? auth()->user()->hasStatus($ad, 0) : false;
        $trashed = auth()->check() ? auth()->user()->hasStatus($ad, 1) : false;

    @endphp
    <button wire:click="toggleAdStatus({{ $ad->id }}, 1)">
        @if ($liked) ❤️ @else 🤍 @endif
    </button>

    <button x-data @click="$dispatch('copy-url', { url: '{{ route('byid', ['ad' => $ad->id]) }}' })"
        class="text-blue-500 hover:text-blue-700" title="Compartilhar">
        🔗
    </button>

    <button wire:click="toggleAdStatus({{ $ad->id }}, 2)">
        @if ($alerted) 🔔 @else 👁️ @endif
    </button>

    <button wire:click="toggleAdStatus({{ $ad->id }}, 3)">
        @if ($trashed) ❌ @else 🗑️ @endif
    </button>

    <a href="{{ $ad->url }}" target="_blank" title="Leiloeiro" class="" role="button">
    Leiloeiro
    </a>
    <a href="{{ $ad->url }}" target="_blank" title="Leiloeiro" class="" role="button">
    Imprimir
    </a>
    <button onclick="window.print()" class="px-1 py-1 border border-gray-300 bg-white text-sm rounded hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:bg-gray-700 print:hidden">
    Print
    </button>

    <!-- Preços -->
        <div class="flex flex-nowrap overflow-x-auto items-center gap-4">
            @if ($ad->preco1)
            <div class="min-w-[150px] bg-blue-100 p-4 rounded shadow shrink-0">
                <p class="text-4xl font-bold text-blue-700">R$ 5M</p>
                <p class="text-xs text-gray-600">@money($ad->preco1) em {{ \Carbon\Carbon::createFromFormat('d/m', $ad->prazo1) }}</p>
            </div>
            @endif

            @if ($ad->preco2)
            <div class="min-w-[150px] bg-blue-100 p-4 rounded shadow shrink-0">
                <p class="text-4xl font-bold text-blue-700">R$ 193K</p>
                <p class="text-xs text-gray-600">@money($ad->preco2) em {{ \Carbon\Carbon::createFromFormat('d/m', $ad->prazo2) }}</p>
            </div>
            @endif
        </div>


    <!-- Descrição -->
    <div class="">
        @adm
        <textarea wire:model.defer="descricao" class="w-full border rounded p-2" rows="6">{{ $ad->desc }}</textarea>
        @else
        <x-desc :txt="$ad->desc" label="Descrição" />
        @endadm
    </div>

    <!-- Galeria -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach ($ad->imgs as $img)
        <div class="relative group overflow-hidden rounded shadow hover:shadow-lg transition">
            <img src="{{ $img }}" alt="{{ $ad->slug }}"
                class="w-full h-auto object-cover cursor-pointer transition duration-200 group-hover:scale-105"
                @click="window.open('{{ $img }}', '_blank')" />

          


        </div>
        @endforeach
    </div>



    Nao deixe de conferir tbm :.<br>
    Vitrines



</div>
