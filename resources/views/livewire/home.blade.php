@php
    function kmbt($number)
    {
        $abbrevs = [12 => 'T', 9 => 'B', 6 => 'M', 3 => 'K', 0 => ''];

        foreach ($abbrevs as $exponent => $abbrev) {
            if (abs($number) >= pow(10, $exponent)) {
                $display = $number / pow(10, $exponent);
                $decimals = ($exponent >= 3 && round($display) < 100) ? 1 : 0;
                $formatted = number_format($display, $decimals);

                if (str_ends_with($formatted, '.0')) {
                    $formatted = rtrim($formatted, '0');
                    $formatted = rtrim($formatted, '.');
                }

                return $formatted . $abbrev;
            }
        }

        return (string)$number;
    }
@endphp


<div class="py-2">
    <div class="max-w-12xl mx-auto">

        <!-- Mobile Dropdown Menu with Attractive Background -->
        <div class="block md:hidden px-2 py-5 space-y-4 rounded-xl shadow-md bg-gradient-to-br from-blue-50 to-blue-100 dark:from-gray-800 dark:to-gray-900 border border-green-200 dark:border-gray-700 print:hidden">
            <!-- Wrapper for Region Buttons -->
            <div class="flex flex-wrap gap-2 justify-center">
                <!-- BRASIL Link -->
                <x-nav-link class="px-2 py-1 text-sm bg-white dark:bg-gray-700 border border-green-600 dark:border-green-600 rounded-md  dark:text-white font-medium shadow hover:bg-gray-100 dark:hover:bg-gray-600 transition"
                            href="{{ route('home') }}" :active="request()->routeIs('home')">
                    Brasil
                </x-nav-link>

                @php
                    $ufs = collect([
                        ['uf' => 'AC', 'regiao_id' => 1], ['uf' => 'AL', 'regiao_id' => 2], ['uf' => 'AM', 'regiao_id' => 1],
                        ['uf' => 'AP', 'regiao_id' => 1], ['uf' => 'BA', 'regiao_id' => 2], ['uf' => 'CE', 'regiao_id' => 2],
                        ['uf' => 'DF', 'regiao_id' => 3], ['uf' => 'ES', 'regiao_id' => 4], ['uf' => 'GO', 'regiao_id' => 3],
                        ['uf' => 'MA', 'regiao_id' => 2], ['uf' => 'MG', 'regiao_id' => 4], ['uf' => 'MS', 'regiao_id' => 3],
                        ['uf' => 'MT', 'regiao_id' => 3], ['uf' => 'PA', 'regiao_id' => 1], ['uf' => 'PB', 'regiao_id' => 2],
                        ['uf' => 'PE', 'regiao_id' => 2], ['uf' => 'PI', 'regiao_id' => 2], ['uf' => 'PR', 'regiao_id' => 5],
                        ['uf' => 'RJ', 'regiao_id' => 4], ['uf' => 'RN', 'regiao_id' => 2], ['uf' => 'RO', 'regiao_id' => 1],
                        ['uf' => 'RR', 'regiao_id' => 1], ['uf' => 'RS', 'regiao_id' => 5], ['uf' => 'SC', 'regiao_id' => 5],
                        ['uf' => 'SE', 'regiao_id' => 2], ['uf' => 'SP', 'regiao_id' => 4], ['uf' => 'TO', 'regiao_id' => 1],
                    ])->map(fn($uf) => (object) $uf);

                    $ufsGrouped = $ufs->sortBy('uf')->sortByDesc('regiao_id')->groupBy('regiao_id');
                @endphp

                @foreach ($ufsGrouped as $regiao_id => $ufs)
                    @php
                        $regionName = match($regiao_id) {
                            1 => 'Norte', 2 => 'Nordeste', 3 => 'Centro-Oeste', 4 => 'Sudeste', 5 => 'Sul',
                        };
                    @endphp

                    <!-- Region Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <!-- Region Button -->
                        <button @click="open = !open"
                                class="px-2 py-1 text-sm bg-white dark:bg-gray-700 border border-green-600 text-green-600 dark:border-green-600 rounded-md  dark:text-white font-medium shadow hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                            {{ Str::limit($regionName, 6, '') }}
                        </button>

                        <!-- Dropdown -->
                        <div x-show="open" @click.away="open = false"
                             x-transition
                             class="absolute left-0 mt-2 z-50 max-w-screen-sm w-max bg-white dark:bg-gray-800 border border-green-600 dark:border-green-600 rounded-md shadow-lg p-2">
                            <div class="flex flex-wrap gap-1 max-w-full">
                                @foreach ($ufs as $uf)
                                    @php
                                        $isActive = request()->route('uf') === $uf->uf;
                                    @endphp
                                    <a href="{{ route('byuf', ['uf' => $uf->uf]) }}"
                                       class="w-12 text-center text-sm px-2 py-1 rounded border text-green-600 transition-all
                                            {{ $isActive 
                                                ? 'font-bold border-blue-600 text-blue-800 bg-blue-100 dark:bg-blue-600 dark:text-white' 
                                                : 'hover:bg-green-100 hover:text-green-800 hover:border-green-500 dark:hover:bg-green-900 dark:text-white border-green-300 dark:border-green-600' }}">
                                        {{ $uf->uf }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        <div class="px-4 py-3 mb-3 bg-gradient-to-r from-blue-50 via-white to-blue-50 rounded-lg shadow-md border border-green-600 dark:from-gray-800 dark:via-gray-700 dark:to-gray-800 dark:border-green-600 print:hidden mt-2">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-white leading-snug mb-1">
                {{ $ads->total() }}
                <span class="text-blue-600 dark:text-blue-400">Anúncios de Imóveis</span> em Leilão
            </h2>

            <p class="text-base sm:text-lg text-gray-600 dark:text-gray-300 font-medium">
                Garimpados com <span class="text-purple-600 dark:text-purple-400 font-semibold">Inteligência Artificial (IA)</span>
                @if(isset($rota['bairro_name']))
                    em <span class="text-gray-900 dark:text-white font-bold">{{ $rota['bairro_name'] }}</span>,
                    {{ $rota['cidade_name'] }} / {{ $rota['uf_name'] }}
                @elseif(isset($rota['cidade_name']))
                    em <span class="text-gray-900 dark:text-white font-bold">{{ $rota['cidade_name'] }}</span> / {{ $rota['uf_name'] }}
                @elseif(isset($rota['uf_name']))
                    no estado de <span class="text-gray-900 dark:text-white font-bold">{{ $rota['uf_name'] }}</span>
                @else
                    em todo o <span class="text-gray-900 dark:text-white font-bold">Brasil</span>
                @endif
            </p>
    </div>


<!-- Start mobile filter -->

        @if($ads->total() > 0)


       <div class="w-full overflow-x-auto sm:overflow-visible sm:flex-wrap flex-nowrap flex items-center gap-1 mb-3 px-1 py-3 rounded-xl shadow-md border border-green-600 bg-gradient-to-r from-white via-blue-50 to-white dark:from-gray-800 dark:via-gray-700 dark:to-gray-800 print:hidden">


            <!-- Tipos -->
            <div x-data="{ open: false }" x-cloak class="relative">
                <button @click="open = !open"
                    class=" px-1 py-1 text-xs md:px-2 md:text-sm bg-white dark:bg-gray-700 border border-green-600 dark:border-green-600 rounded-md text-green-600 dark:text-white font-medium shadow hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                    Tipos
                </button>

                <div x-show="open" @click.outside="open = false"
                    class="absolute z-10 mt-2 w-48 bg-white border rounded shadow-lg p-2 dark:bg-gray-700" x-transition>
                    @foreach ($this->tipos as $tipo)
                    <label class="flex items-center space-x-2 py-1">
                        <input type="checkbox" wire:model.live="tipos" value="{{ $tipo }}">
                        <span>{{ ucfirst($tipo) }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <!-- Campos -->
            <div x-data="{ open: false }" x-cloak class="relative">
                <button @click="open = !open"
                    class="px-1 py-1 text-xs md:px-2 md:text-sm bg-white dark:bg-gray-700 border border-green-600 dark:border-green-600 rounded-md text-green-600 dark:text-white font-medium shadow hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                    Campos
                </button>

                <div x-show="open" @click.outside="open = false"
                    class="absolute z-10 mt-2 w-48 bg-white border rounded shadow-lg p-2 dark:bg-gray-700" x-transition>
                    @foreach ($this->columns as $col => $label)
                    <label class="flex items-center space-x-2 py-1">
                        <input type="checkbox" wire:model.live="selectedColumns" value="{{ $col }}">
                        <span>{{ $label }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <!-- Ordenação -->
            <select wire:model.live="sortBy"
                class="px-1 py-1 md:px-2 md:text-sm border border-green-600 bg-white text-xs rounded text-green-600  hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                @foreach ($this->sortable as $key => $option)
                <option value="{{ $key }}">{{ $option['label'] }}</option>
                @endforeach
            </select>

            <!-- View Mode Toggle (Lista / Grid) -->
            <div class="inline-flex items-center gap-0 border border-green-600 rounded-md overflow-hidden">
                <!-- Lista Button -->
                <button wire:click="$set('modoBy', 'lista')" 
                    class="flex items-center gap-2 px-1 py-1 text-xs md:px-2 md:text-sm transition text-green-600 dark:text-white
                           {{ $modoBy === 'lista' 
                               ? 'font-semibold' 
                               : 'text-gray-500 hover:bg-gray-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 2.5 4h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 4.5z"/>
                    </svg>
                </button>

                <!-- Grid Button -->
                <button wire:click="$set('modoBy', 'grid')" 
                class="flex items-center gap-0 px-1 py-1 text-xs md:px-2 md:text-sm transition text-green-600 dark:text-white
                       border-l border-green-600
                       {{ $modoBy === 'grid' 
                           ? 'font-semibold bg-green-100' 
                           : 'text-gray-500 hover:bg-gray-100' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 3h6v6H3V3zm8 0h6v6h-6V3zM3 11h6v6H3v-6zm8 0h6v6h-6v-6z" />
                </svg>
            </button>

            </div>


        
          <!--   <button onclick="window.print()" class="flex items-center gap-1 px-2 py-1 text-sm text-gray-800 bg-white border border-green-600 rounded hover:bg-gray-100 dark:bg-gray-700 dark:text-green-600 print:hidden text-green-600 dark:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2M6 18v4h12v-4M6 14h12" />
                </svg>
            </button>
 -->
              <!-- Per Page -->
                <div class="flex items-center gap-0 sm:hidden">
                    <select id="perPage" wire:model.live="perPage"
                        class="min-w-[50px] px-1 py-1 border border-green-600 bg-white text-green-700 text-sm rounded hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:text-white dark:bg-gray-700">
                        <option value="10">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>

               <div class="flex items-center text-[10px] text-gray-700 border border-green-600 px-1 rounded dark:text-white whitespace-nowrap  text-ellipsis sm:hidden">
                <span class="truncate">
                    {{ $ads->firstItem() }}-{{ $ads->lastItem() }}
                </br>
                    de {{ $ads->total() }}
                </span>
            </div>



                    <!-- Botão Anterior -->
                    <button
                        wire:click="previousPage"
                        wire:loading.attr="disabled"
                        class="px-1 py-1 border border-green-600 text-sm rounded-md transition-all
                               focus:outline-none focus:ring-1 focus:ring-blue-500
                               disabled:text-gray-400 disabled:border-green-600 disabled:bg-gray-50
                               enabled:text-blue-600 enabled:border-gray-300 enabled:bg-white enabled:hover:bg-gray-100 dark:bg-gray-700 sm:hidden"
                        {{ $ads->onFirstPage() ? 'disabled' : '' }}
                    >
                        ←
                    </button>
                
                    <!-- Botão Próximo -->
                    <button
                        wire:click="nextPage"
                        wire:loading.attr="disabled"
                        class="px-1 py-1 border border-green-600 text-green-600 text-sm rounded-md transition-all
                               focus:outline-none focus:ring-1 focus:ring-blue-500
                               disabled:text-gray-400 disabled:border-gray-200 disabled:bg-gray-50
                               enabled:text-green-600 enabled:border-green-600 enabled:bg-white enabled:hover:bg-gray-100 dark:bg-gray-700 sm:hidden"
                        {{ !$ads->hasMorePages() ? 'disabled' : '' }}
                    >
                        →
                    </button>           
            <!-- End mobile filters -->

            <!-- Paginação -->
             <div class="ml-auto flex flex-wrap items-center gap-x-4 gap-y-1 text-sm sm:flex hidden">

                <!-- Per Page -->
                <div class="flex items-center gap-0">
                    <select id="perPage" wire:model.live="perPage"
                        class="min-w-[90px] px-1 py-1 border border-green-600 bg-white text-green-700 text-sm rounded hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:text-white dark:bg-gray-700">
                        <option value="10">20/pág</option>
                        <option value="50">50/pág</option>
                        <option value="100">100/pág</option>
                    </select>
                </div>

                <!-- Intervalo de resultados -->
                <div class="flex items-center">
                    {{ $ads->firstItem() }} - {{ $ads->lastItem() }} de {{ $ads->total() }}
                </div>

                <!-- Links de paginação -->
                <div class="flex items-center gap-2">

                    <!-- Botão Anterior -->
                    <button
                        wire:click="previousPage"
                        wire:loading.attr="disabled"
                        class="px-1 py-1 border border-green-600 text-sm rounded-md transition-all
                               focus:outline-none focus:ring-1 focus:ring-blue-500
                               disabled:text-gray-400 disabled:border-green-600 disabled:bg-gray-50
                               enabled:text-blue-600 enabled:border-gray-300 enabled:bg-white enabled:hover:bg-gray-100 dark:bg-gray-700"
                        {{ $ads->onFirstPage() ? 'disabled' : '' }}
                    >
                        ← Anterior
                    </button>
                
                    <!-- Botão Próximo -->
                    <button
                        wire:click="nextPage"
                        wire:loading.attr="disabled"
                        class="px-1 py-1 border border-green-600 text-green-600 text-sm rounded-md transition-all
                               focus:outline-none focus:ring-1 focus:ring-blue-500
                               disabled:text-gray-400 disabled:border-green-200 disabled:bg-gray-50
                               enabled:text-green-600 enabled:border-green-300 dark:bg-gray-700"
                        {{ !$ads->hasMorePages() ? 'disabled' : '' }}
                    >
                        Próximo →
                    </button>
                
                </div>

            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-0 text-gray-900">
                <div class="relative shadow-md sm:rounded-lg overflow-x-auto">

                    @if ($modoBy === 'imagens')
                        <div class="grid grid-cols-6 gap-x-2 gap-y-4 px-1">
                            @foreach ($ads as $ad)
                            <x-card-ads :ad="$ad" />
                            @endforeach
                        </div>

                    @elseif ($modoBy === 'lista')
                    <div class="relative overflow-x-auto">
                        <table class="table-auto min-w-full text-sm tracking-tight leading-tight font-sans text-gray-900 dark:text-gray-100">
                            <thead class="bg-gray-100 dark:bg-gray-800">
                                <tr class="h-8 dark:bg-black-700">
                                    <th class="p-0">
                                        <input id="select-all" type="checkbox" 
                                        value="{{ $ads->currentPage() }}" 
                                        wire:key="{{ $ads->currentPage() }}" 
                                        wire:model.live="selectPage"
                                            class="rounded bg-gray-200 dark:bg-gray-700 border-transparent focus:border-transparent focus:bg-gray-200 text-gray-700 focus:ring-1 focus:ring-offset-2 focus:ring-gray-500" />
                                    </th>
                                    @foreach ($this->columns as $column => $label)
                                    @if($this->showColumn($column))
                                    <th @if($column=='pracas' ) colspan="2" @elseif($column=='acoes' ) colspan="4" @endif
                                        class="text-center text-black font-bold text-gray-900 dark:text-gray-100">
                                        {{ $label }}
                                    </th>
                                    @endif
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 divide-solid dark:divide-gray-700 bg-white dark:bg-gray-900">
                                @forelse ($ads as $ad)
                                <x-tr-ads :ad="$ad" />
                                @empty
                                <tr>
                                    <td colspan="100%" class="text-center py-4">Sem registros</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @else
        <p class="text-center text-gray-500 py-10">Sem registros</p>
        @endif

        @if(count($selectedIds))
        <div class="mt-6 p-4 bg-gray-50 border border-gray-200 rounded-lg shadow-sm">
            <h3 class="text-sm font-semibold text-gray-700 mb-3">
                Ações para <span class="text-blue-600">{{ count($selectedIds) }}</span>
                selecionado{{ count($selectedIds) > 1 ? 's' : '' }}:
            </h3>

            <div class="flex flex-wrap gap-2">
                <button wire:click="filtrarSelecionados"
                    class="px-3 py-1 rounded btn btn-sm bg-blue-600 hover:bg-blue-700 text-white">
                    Filtrar Selecionados
                </button>

                <button wire:click="imprimirPagina" class="px-3 py-1 bg-green-500 text-white rounded text-sm">
                    Imprimir Página
                </button>

                <script>
                    window.addEventListener('imprimir-pagina', () => {
                            window.print();
                        });
                </script>


                <button wire:click="exportarCsv"
                    class="rounded px-3 py-1 btn btn-sm bg-yellow-400 hover:bg-yellow-500 text-black">
                    Exportar CSV
                </button>

                <button wire:click="exportarExcel"
                    class="rounded px-3 py-1 btn btn-sm bg-yellow-600 hover:bg-yellow-700 text-white">
                    Exportar Excel
                </button>

                <button wire:click="resetarSelecao"
                    class="rounded px-3 py-1 btn btn-sm bg-gray-500 hover:bg-gray-600 text-white">
                    Zerar Seleção
                </button>

                <button wire:click="marcarFavoritos"
                    class="rounded px-3 py-1 btn btn-sm bg-pink-500 hover:bg-pink-600 text-white">
                    Add aos Favoritos
                </button>

                <button wire:click="marcarAlertas"
                    class="rounded px-3 py-1 btn btn-sm bg-orange-500 hover:bg-orange-600 text-white">
                    Add aos Alertas
                </button>

                <div x-data
                    x-on:copiar-para-clipboard.window="navigator.clipboard.writeText($event.detail).then(() => alert('Copiado!'))">
                    <button wire:click="copiarLista" class="rounded px-3 py-1 bg-indigo-500 text-white rounded text-sm">
                        Copiar/Enviar Lista
                    </button>
                </div>


                <button wire:click="excluirSessao"
                    class="rounded px-3 py-1 btn btn-sm bg-red-600 hover:bg-red-700 text-white">
                    Excluir da Sessão
                </button>
            </div>
        </div>
        @endif

    </div>


    <div x-data="{
        show: @entangle('showToast'),
        message: @entangle('toastMessage')
    }" x-show="show" x-transition.opacity.duration.500ms x-init="
        $watch('show', val => {
            if (val) {
                clearTimeout(window.__toastTimeout);
                window.__toastTimeout = setTimeout(() => show = false, 16000);
            }
        })
    " class="fixed top-5 right-5 bg-green-600 text-white px-4 py-2 rounded shadow-lg z-50" style="display: none;">
        <span x-text="message"></span>
    </div>


    <script>
        window.addEventListener('copy-url', (event) => {
            const { url } = event.detail;
            navigator.clipboard.writeText(url)
                .then(() => alert('Link copiado para a área de transferência!'))
                .catch((err) => console.error('Erro ao copiar:', err));
        });
    </script>
</div>
