<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Client\Pool;

use Inertia\Inertia;

class PokemonController extends Controller
{
    function initPage() {
        
        $favoritesList=[];
        if (Auth::check()) {
            $favoritesList = Auth::user()->favorites()->get();
        }

        return Inertia::render('Pokeapp', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'favoritePokemons' => $favoritesList,
        ]);
    }

    function favoritesPage() {
        $favoritesList = Auth::user()->favorites()->get();

        $pokemonsData = [];
        if (count($favoritesList) > 0) {
            $pokemonsReponse = Http::pool(function (Pool $pool) use ($favoritesList) {
                foreach ($favoritesList as $pokemon) {
                    $pool->as($pokemon['pokemon_id'])->get(Config::get('constants.api_url') . "pokemon/" . $pokemon->pokemon_id);
                }
            });
            
            foreach($pokemonsReponse as $pokemon) {
                $pokemonsData[] = $pokemon->json();
            }
        }
      

        return Inertia::render('Favorites', [
            'favoritePokemons' => $favoritesList,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'user' => Auth::user(),
            'pokemonsData' => $pokemonsData
        ]);
    }

    function search(Request $request) {
        $search = $request->search; 

        $pokemonResponse = Http::get(Config::get('constants.api_url') . "pokemon/" . $search);
        $pokemonData = $pokemonResponse->json();
        
        $favoritesList=[];
        if (Auth::check()) {
            $favoritesList = Auth::user()->favorites()->get();
        }

        return Inertia::render('Pokemon', [
            'favoritePokemons' => $favoritesList,
            'user' => Auth::user(),
            'pokemonData' => $pokemonData
        ]);
    
    }

}
