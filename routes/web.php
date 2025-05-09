<?php

use App\Livewire\Home;
use App\Livewire\Detalhe;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', Home::class)->name('home');

Route::get('/imovel/{ad:slug}',Detalhe::class)->name('imovel');




Route::get('/{ad:id}',Home::class)->where('ad','^[0-9]+$')->name('byid');

#atencao deixar essa antes das demais senao uf=ids
Route::get('/lista/ids/{ids}',Home::class)->where('ids','^[0-9-]+$')->name('byids'); 

Route::get('/imoveis/{uf:uf}',Home::class)->where('uf','^[a-zA-Z]{2}$')->name('byuf');

Route::get('/imoveis/ufs/{ufs}',Home::class)->where('ufs','^[a-zA-Z-]+$')->name('byufs');

Route::get('/imoveis/{uf:uf}/{cidade:slug}',Home::class)->where(['uf'=>'^[a-zA-Z]{2}$','cidade'=>'^[a-zA-Z\d-]+$'])->name('bycidade');
Route::get('/imoveis/{uf:uf}/{cidade:slug}/{bairro:slug}',Home::class)->name('bybairro');

Route::get('/imoveis/leiloeiros/{parc:slug}',Home::class)->where('parc','^[\d\w]+$')->name('byleiloeiro');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
