<?php

namespace App\Http\Controllers;

use App\Models\FavoritePokemons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritePokemonsController extends Controller
{
    function addFavorite(Request $request) {
        $pokemon = $request->input('pokemon_id');
        $user = Auth::user();
        $favorite = $user->favorites()->create([
            'pokemon_id' => $pokemon
        ]);

        return response()->json(['success' => true, 'favorite' => $favorite]);
    }

    function removeFavorite(Request $request) {
        $pokemon = $request->input('pokemon_id');
        $user = Auth::user();
        $user->favorites()->where('pokemon_id', $pokemon)->delete();
        return response()->json(['success' => true]);
    }
}
