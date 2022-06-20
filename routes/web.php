<?php

use App\Http\Controllers\FavoritePokemonsController;
use App\Http\Controllers\PokeapiController;
use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PokemonController::class, 'initPage'])->name('home');

Route::get('/search/{search}', [PokemonController::class, 'search'])->name('search');

Route::get('/favorites', [PokemonController::class, 'favoritesPage'])
->middleware(['auth'])->name('favorites');


Route::group(['prefix' => 'pokeapi'], function () {
    Route::get('/pokemons/{pageNumber}', [PokeapiController::class , 'listPokemons']);
});


Route::group(['prefix' => 'pokemon', 'middleware' => ['auth']], function () {
    Route::post('/favorite', [FavoritePokemonsController::class , 'addFavorite']);
    Route::post('/unfavorite', [FavoritePokemonsController::class , 'removeFavorite']);
});

require __DIR__.'/auth.php';
