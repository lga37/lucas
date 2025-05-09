<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Illuminate\Pagination\LengthAwarePaginator;

class Home extends Component
{

    public string $modoBy = 'lista'; // valor padrão

    public array $modos = [
        'imagens' => ['label' => 'Imagens'],
        'lista' => ['label' => 'Lista'],
    ];

    public array $selectedIds = [];
    public bool $selectPage = false;

    public array $tipos = ['casa','apto'];

    public string $sortBy = 'Aleatoria';
    public int $perPage = 10;
    public array $rota_value = [];

    public array $sortable = [
        'Aleatoria' => ['k' => 'random', 'sens' => null, 'label' => 'Aleatória'],

        #'Padrao' => ['k' => 'id', 'sens' => 'desc', 'label' => 'Padrão'],
        'byIdAsc' => ['k' => 'id', 'sens' => 'asc', 'label' => 'ID ↑'],
        'byIdDesc' => ['k' => 'id', 'sens' => 'desc', 'label' => 'ID ↓'],
        'Menor Praça' => ['k' => 'preco1', 'sens' => 'asc', 'label' => 'Menor Praça'],
        'Maior Praça' => ['k' => 'preco1', 'sens' => 'desc', 'label' => 'Maior Praça'],
        'Mais recente' => ['k' => 'created_at', 'sens' => 'desc', 'label' => 'Mais recente'],
        'Mais antigo' => ['k' => 'created_at', 'sens' => 'asc', 'label' => 'Mais antigo'],
    ];

    public array $columns = [
        'id' => 'id',
        'created_at' => 'data',
        'tipo' => 'tipo',
        'logradouro' => 'endereco',
        'bairro' => 'bairro',
        'cidade' => 'cidade',
        'uf' => 'uf',
        'area' => 'area',
        'img' => 'img',
        'pracas' => 'pracas',
        'acoes' => 'acoes',
        'parc_id' => 'leilao',
    ];

   
    public array $selectedColumns = []; // default será todas, ou definido no mount

    public function showColumn(string $col): bool
    {
        return in_array($col, $this->selectedColumns);
    }


    public function mount(Request $req)
    {
        #$this->tipos = $req->query('tipos', array_column(Tipos::cases(), 'value'));
        $this->selectedColumns = array_keys($this->columns);
        $this->sortBy = $req->query('sort', 'Aleatoria');

      
        $routeName = $req->route()->getName();
        $params = $req->route()->parameters();

        #dump($params);

        $this->rota_value = match ($routeName) {

         

            'byid' => [
                'ad_id' => (int) $params['ad'],
            ],

            'byids' => [
                'ad_ids' => (array) explode('-', $params['ids']),
            ],

            default => []
        };
    }


    #[Layout('layouts.app')]
    public function render()
    {
        // 1. Gerar 50 anúncios falsos (simulados)
        $fakeAds = collect(range(1, 50))->map(function ($i) {
            return [
                'id' => $i,
                'titulo' => "Imóvel #{$i}",
                'valor' => rand(50000, 500000),

                'slug' => fake()->sentence(9),
                'area' => rand(100,800),

                'preco1' => rand(50000,9000000),
                'preco2' => rand(50000,9000000),

                'tipo' => array_rand(['apto'=>'apto','casa'=>'casa']),

                'parc' => 4,

                'prazo1' => date('d/m'),
                'prazo2' => date('d/m'),

                'endereco' => fake()->sentence(5),
                'bairro' => fake()->sentence(2),

                'end' => 33,
                'cidade' => fake()->city(),
                'uf' => fake()->stateAbbr(),
                'img' => "https://picsum.photos/id/{$i}/300/200", // imagens aleatórias
            ];
        })
        ->map(fn($ad) => (object) $ad)
        ;
    
        // 2. Paginar (ex: 10 por página)
        $perPage = 10;
        $currentPage = request('page', 1);
        $pagedAds = new LengthAwarePaginator(
            $fakeAds->forPage($currentPage, $perPage),
            $fakeAds->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    
        // 3. Retornar para a view como faria com um modelo real
        return view('livewire.home', [
            'ads' => $pagedAds,
        ]);
    }
   
    


   
}
