
@foreach (explode(' ', $txt) as $pal) 

    <span x-data="{ show: false }" class="relative group inline-block">
            <span
                @mouseenter="show = true"
                @mouseleave="show = false"
                class="underline decoration-dotted decoration-blue-500 cursor-help text-blue-700 font-semibold"
            >
                {{ $pal }}
            </span>
    </span>

@endforeach


{{-- @php
    use Illuminate\Support\Str;

    caso de ter alias

    $diciRaw = App\Traits\Helpers::getDicio();
    $dicionario = [];

    foreach ($diciRaw as $slug => $item) {
        $dicionario[$slug] = $item['def'];
        foreach ($item['aliases'] ?? [] as $alias) {
            $dicionario[Str::slug($alias)] = $item['def'];
        }
    }

    $arr = explode(' ', $txt);
@endphp

@foreach ($arr as $pal)
    @php
        $slugPal = Str::slug($pal);
        $isTooltip = array_key_exists($slugPal, $dicionario);
        $content = $isTooltip ? $dicionario[$slugPal] : null;
    @endphp

    @if($isTooltip)
        <span x-data="{ show: false }" class="relative group inline-block">
            <span
                @mouseenter="show = true"
                @mouseleave="show = false"
                class="underline decoration-dotted decoration-blue-500 cursor-help text-blue-700 font-semibold"
            >
                {{ $pal }}
            </span>
            <div
                x-show="show"
                x-transition.opacity.duration.200ms
                class="absolute z-50 bottom-full left-1/2 -translate-x-1/2 mb-2 px-3 py-2 rounded-md text-sm text-white bg-gray-800 shadow-lg w-64"
                x-cloak
            >
                {{ $content }}
            </div>
        </span>
    @else
        {{ $pal }}
    @endif
@endforeach --}}
