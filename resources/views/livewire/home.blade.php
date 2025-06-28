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


        <!-- Mobile Dropdown Menu -->
        <div class="block md:hidden md:flex items-center space-x-4 px-4 py-2 print:hidden">

            <!-- BRASIL Link -->
            <x-nav-link class="px-2 py-1 h-9 border border-blue-200 rounded-md text-blue-800 hover:bg-blue-200"
                        href="{{ route('home') }}" :active="request()->routeIs('home')">
                BRASIL
            </x-nav-link>
           <!-- Wrapper for all region buttons (inline on mobile) -->
            <div class="block md:hidden mt-4 flex flex-wrap gap-2">

                @php
                    $ufs = collect([
                        ['uf' => 'AC', 'regiao_id' => 1],
                        ['uf' => 'AL', 'regiao_id' => 2],
                        ['uf' => 'AM', 'regiao_id' => 1],
                        ['uf' => 'AP', 'regiao_id' => 1],
                        ['uf' => 'BA', 'regiao_id' => 2],
                        ['uf' => 'CE', 'regiao_id' => 2],
                        ['uf' => 'DF', 'regiao_id' => 3],
                        ['uf' => 'ES', 'regiao_id' => 4],
                        ['uf' => 'GO', 'regiao_id' => 3],
                        ['uf' => 'MA', 'regiao_id' => 2],
                        ['uf' => 'MG', 'regiao_id' => 4],
                        ['uf' => 'MS', 'regiao_id' => 3],
                        ['uf' => 'MT', 'regiao_id' => 3],
                        ['uf' => 'PA', 'regiao_id' => 1],
                        ['uf' => 'PB', 'regiao_id' => 2],
                        ['uf' => 'PE', 'regiao_id' => 2],
                        ['uf' => 'PI', 'regiao_id' => 2],
                        ['uf' => 'PR', 'regiao_id' => 5],
                        ['uf' => 'RJ', 'regiao_id' => 4],
                        ['uf' => 'RN', 'regiao_id' => 2],
                        ['uf' => 'RO', 'regiao_id' => 1],
                        ['uf' => 'RR', 'regiao_id' => 1],
                        ['uf' => 'RS', 'regiao_id' => 5],
                        ['uf' => 'SC', 'regiao_id' => 5],
                        ['uf' => 'SE', 'regiao_id' => 2],
                        ['uf' => 'SP', 'regiao_id' => 4],
                        ['uf' => 'TO', 'regiao_id' => 1],
                    ])->map(fn($uf) => (object) $uf);

                    $ufsGrouped = $ufs->sortBy('uf')->sortByDesc('regiao_id')->groupBy('regiao_id');
                @endphp

                @foreach ($ufsGrouped as $regiao_id => $ufs)
                    @php
                        $regionName = match($regiao_id) {
                            1 => 'Norte',
                            2 => 'Nordeste',
                            3 => 'Centro-Oeste',
                            4 => 'Sudeste',
                            5 => 'Sul',
                            default => 'Região',
                        };
                    @endphp

                    <!-- Region button + dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <!-- Inline region button -->
                        <button @click="open = !open"
                                class="px-3 py-1 border border-gray-300 rounded-md bg-white text-gray-800 text-sm hover:bg-gray-100">
                            {{ $regionName }}
                        </button>

                        <!-- Inline dropdown (below the button) -->
                        <div x-show="open" @click.away="open = false"
                             x-transition
                             class="absolute mt-1 z-10 bg-white border border-gray-200 rounded-md shadow-md p-2 w-56">
                            <div class="flex flex-wrap gap-1">
                                @foreach ($ufs as $uf)
                                    @php
                                        $isActive = request()->route('uf') === $uf->uf;
                                    @endphp
                                    <a href="{{ route('byuf', ['uf' => $uf->uf]) }}"
                                       class="text-center text-sm px-2 py-1 rounded border 
                                       {{ $isActive ? 'font-bold border-blue-900 text-blue-900 bg-blue-200' : 'hover:bg-green-200 hover:text-green-800 hover:border-green-800' }}">
                                        {{ $uf->uf }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight px-4 dark:text-white print:hidden">
            {{ $ads->total() }} Anúncios de Imóveis em Leilão, garimpados com Inteligencia Artificial (IA) -




            @if(isset($rota['bairro_name']))
            em <strong>{{ $rota['bairro_name'] }}</strong>, {{ $rota['cidade_name'] }} / {{ $rota['uf_name'] }}
            @elseif(isset($rota['cidade_name']))
            em <strong>{{ $rota['cidade_name'] }}</strong> / {{ $rota['uf_name'] }}
            @elseif(isset($rota['uf_name']))
            no estado de <strong>{{ $rota['uf_name'] }}</strong>
            @else
            no Brasil
            @endif

        </h2>

        @if($ads->total() > 0)
        <div class="flex flex-wrap items-center gap-2 mb-2 px-2 print:hidden">
            <!-- Tipos -->
            <div x-data="{ open: false }" x-cloak class="relative">
                <button @click="open = !open"
                    class="px-3 py-2 border border-gray-300 bg-white text-sm rounded hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:bg-gray-700">
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
                    class="px-1 py-1 border border-gray-300 bg-white text-sm rounded hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:bg-gray-700">
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
                class="px-1 py-1 border border-gray-300 bg-white text-sm rounded hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:bg-gray-700">
                @foreach ($this->sortable as $key => $option)
                <option value="{{ $key }}">{{ $option['label'] }}</option>
                @endforeach
            </select>

            <!-- Modos -->
            <select wire:model.live="modoBy"
                class="px-1 py-1 border border-gray-300 bg-white text-sm rounded hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:bg-gray-700">
                @foreach ($this->modos as $key => $modo)
                <option value="{{ $key }}">{{ $modo['label'] }}</option>
                @endforeach
            </select>

            <button onclick="window.print()" class="px-1 py-1 border border-gray-300 bg-white text-sm rounded hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:bg-gray-700 print:hidden">
                Print Table
            </button>


            <!-- Paginação -->
            <div class="ml-auto flex flex-wrap items-center gap-x-4 gap-y-1 text-sm text-gray-700">

                <!-- Per Page -->
                <div class="flex items-center gap-2">
                    <select id="perPage" wire:model.live="perPage"
                        class="min-w-[90px] px-1 py-1 border border-gray-300 bg-white text-sm rounded hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500 dark:text-white dark:bg-gray-700">
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
                        class="px-1 py-1 border text-sm rounded-md transition-all
                               focus:outline-none focus:ring-1 focus:ring-blue-500
                               disabled:text-gray-400 disabled:border-gray-200 disabled:bg-gray-50
                               enabled:text-blue-600 enabled:border-gray-300 enabled:bg-white enabled:hover:bg-gray-100 dark:bg-gray-700"
                        {{ $ads->onFirstPage() ? 'disabled' : '' }}
                    >
                        ← Anterior
                    </button>
                
                    <!-- Botão Próximo -->
                    <button
                        wire:click="nextPage"
                        wire:loading.attr="disabled"
                        class="px-1 py-1 border text-sm rounded-md transition-all
                               focus:outline-none focus:ring-1 focus:ring-blue-500
                               disabled:text-gray-400 disabled:border-gray-200 disabled:bg-gray-50
                               enabled:text-blue-600 enabled:border-gray-300 enabled:bg-white enabled:hover:bg-gray-100 dark:bg-gray-700"
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
