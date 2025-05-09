<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Detalhe extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {

        $ad = (object) [
            'id' => 999,
            'titulo' => 'Imóvel Simulado Premium',
            'valor' => 275000,
            'url' => 'https://www.dfgsfsdf.com',
            'cidade' => 'Copacabana',
            'nome' => 'Apartamento em Copacabana drfgdf gdf gdfg dfg dfg df',
            'uf' => 'RJ',
            'img' => 'https://picsum.photos/id/101/600/400',
            'slug' => 'copacabana-rj',
            'tipo' => 'apto',
            'status' => 1,

            'desc' => fake()->sentence(140),


            'imgs' => ["https://picsum.photos/id/1/300/200","https://picsum.photos/id/2/300/200","https://picsum.photos/id/3/300/200","https://picsum.photos/id/4/300/200",],

            'diasAtivo' => fn() => '15 dias',

            'preco1' => rand(50000,9000000),
            'preco2' => rand(50000,9000000),

            'parc' => 4,

            'prazo1' => date('d/m'),
            'prazo2' => date('d/m'),

            'uf'=>'SP',
            'cidade'=>'Piratininga',
            'bairro'=>'Ddfsfsdf sdfsdfsd',
            'rua'=>'Rua Alexandre Dumas',
        

        ];

        return view('livewire.detalhe', [
            'ad' => $ad,
        ]);


    }
}
