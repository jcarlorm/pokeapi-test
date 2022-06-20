<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
        return Inertia::render('Favorites', [
            'favoritePokemons' => $favoritesList,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'user' => Auth::user(),
        ]);
    }

}
