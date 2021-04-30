<?php

use App\Http\Controllers\PropertyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
});

Route::get('/a-propos', function () {
    $name = 'Fiorella';

    return view('about', [
        'name' => $name,
        'bibis' => [1, 2, 3, 4],
    ]);
});

Route::get('/hello/{nom?}', function ($nom = 'Fiorella') {
    return "<h1>Hello $nom</h1>";
})->where('nom', '.{2,}'); // Le nom doit faire 2 caractères minimum

// Afficher les annonces
Route::get('/nos-annonces', [PropertyController::class, 'index']);
Route::get('/los-annoncas', [PropertyController::class, 'index']);

// On va créer une route pour voir UNE seule annonce
// La route ressemble à cela : /annonce/2
// On pourra donc récupérer l'id de l'annonce en dynamique
// Avec cette ID, on doit faire la bonne requête (select ... where ...)
// On crée une nouvelle vue properties/show
// On affiche l'annonce (Titre, prix, description) sur cette page

Route::get('/annonce/{property}', [PropertyController::class, 'show'])->whereNumber('property');
Route::get('/annonce/{id}', [PropertyController::class, 'show'])->whereNumber('id');
// On s'assure que $id est seulement un nombre

// On affiche le formulaire
// use App\Http\Controllers\PropertyController;
Route::get('/annonce/creer', [PropertyController::class, 'create']);

// use Illuminate\Http\Request;
Route::post('/annonce/creer', [PropertyController::class, 'store']);

Route::get('/annonce/editer/{id}', [PropertyController::class, 'edit']);
Route::put('/annonce/editer/{id}', [PropertyController::class, 'update']);

Route::delete('/annonce/{id}', [PropertyController::class, 'destroy']);

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
