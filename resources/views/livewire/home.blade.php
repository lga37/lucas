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
        <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">
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
        <div class="flex flex-wrap items-center gap-2 mb-2 px-2">
            <!-- Tipos -->
            <div x-data="{ open: false }" x-cloak class="relative">
                <button @click="open = !open"
                    class="px-3 py-2 border border-gray-300 bg-white text-sm rounded hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    Tipos
                </button>

                <div x-show="open" @click.outside="open = false"
                    class="absolute z-10 mt-2 w-48 bg-white border rounded shadow-lg p-2" x-transition>
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
                    class="px-3 py-2 border border-gray-300 bg-white text-sm rounded hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    Campos
                </button>

                <div x-show="open" @click.outside="open = false"
                    class="absolute z-10 mt-2 w-48 bg-white border rounded shadow-lg p-2" x-transition>
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
                class="px-3 py-2 border border-gray-300 bg-white text-sm rounded hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500">
                @foreach ($this->sortable as $key => $option)
                <option value="{{ $key }}">{{ $option['label'] }}</option>
                @endforeach
            </select>

            <!-- Modos -->
            <select wire:model.live="modoBy"
                class="px-3 py-2 border border-gray-300 bg-white text-sm rounded hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500">
                @foreach ($this->modos as $key => $modo)
                <option value="{{ $key }}">{{ $modo['label'] }}</option>
                @endforeach
            </select>

            <!-- Paginação -->
            <div class="ml-auto flex flex-wrap items-center gap-x-4 gap-y-1 text-sm text-gray-700">

                <!-- Per Page -->
                <div class="flex items-center gap-2">
                    <select id="perPage" wire:model.live="perPage"
                        class="min-w-[90px] px-3 py-2 border border-gray-300 bg-white text-sm rounded hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500">
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
                        class="px-3 py-2 border text-sm rounded-md transition-all
                               focus:outline-none focus:ring-1 focus:ring-blue-500
                               disabled:text-gray-400 disabled:border-gray-200 disabled:bg-gray-50
                               enabled:text-blue-600 enabled:border-gray-300 enabled:bg-white enabled:hover:bg-gray-100"
                        {{ $ads->onFirstPage() ? 'disabled' : '' }}
                    >
                        ← Anterior
                    </button>
                
                    <!-- Botão Próximo -->
                    <button
                        wire:click="nextPage"
                        wire:loading.attr="disabled"
                        class="px-3 py-2 border text-sm rounded-md transition-all
                               focus:outline-none focus:ring-1 focus:ring-blue-500
                               disabled:text-gray-400 disabled:border-gray-200 disabled:bg-gray-50
                               enabled:text-blue-600 enabled:border-gray-300 enabled:bg-white enabled:hover:bg-gray-100"
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
                        <table class="table-auto min-w-full text-sm tracking-tight leading-tight font-sans">
                            <thead>
                                <tr class="h-8 bg-blue-200">
                                    <th class="p-0">
                                        <input id="select-all" type="checkbox" 
                                        value="{{ $ads->currentPage() }}" 
                                        wire:key="{{ $ads->currentPage() }}" 
                                        wire:model.live="selectPage"
                                            class="rounded bg-gray-200 border-transparent focus:border-transparent focus:bg-gray-200 text-gray-700 focus:ring-1 focus:ring-offset-2 focus:ring-gray-500" />
                                    </th>
                                    @foreach ($this->columns as $column => $label)
                                    @if($this->showColumn($column))
                                    <th @if($column=='pracas' ) colspan="2" @elseif($column=='acoes' ) colspan="4" @endif
                                        class="text-center text-black font-bold">
                                        {{ $label }}
                                    </th>
                                    @endif
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
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
