<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class PokeapiController extends Controller
{
    function listPokemons($pageNumber)
    {
        $pageNumber = $pageNumber - 1 ?? 1;
        $pageNumber = $pageNumber * 10;
        $response = Http::get(Config::get('constants.api_url') . "pokemon?offset=$pageNumber&limit=10");

        $pokemons = $response->json();

        $pokemonsReponse = Http::pool(function (Pool $pool) use ($pokemons) {
            foreach ($pokemons['results'] as $pokemon) {
                $pool->as($pokemon['name'])->get($pokemon['url']);
            }
        });

        foreach($pokemons['results'] as $pokemon) {
            $pokemonsData[$pokemon['name']] = $pokemonsReponse[$pokemon['name']]->json();
        }

        return response()->json(['pokemonsData' => $pokemonsData, 'pokemonsPaginate' => $pokemons]);
    }
}
