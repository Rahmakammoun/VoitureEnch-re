<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoitureController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\VersionController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\VoitureAController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('/');
Route::resource('voitures', VoitureController::class);

Route::resource('marques', MarqueController::class)->middleware('auth');
;
Route::resource('modeles', ModelController::class);
Route::resource('versions', VersionController::class);
Route::get('voitures/{voiture}', [VoitureController::class, 'show'])->name('voitures.show');
//Route::get('voitures/', [VoitureController::class, 'index'])->name('voitures.index');
Route::get('/marque/{marque}/edit', [MarqueController::class, 'edit'])->name('marque.edit');

Route::get('/modele/{modele}/edit', [ModelController::class, 'edit'])->name('model.edit');
Route::get('/version/{version}/edit', [VersionController::class, 'edit'])->name('version.edit');

Route::resource('voituresA', VoitureAController::class);

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/AjoutVoiture', 'AjoutVoiture')->name('AjoutVoiture');

//Route::get('/modele/{marque_id}', 'ModelController@getModeleByMarque');
Route::get('/modele/{marque_id}', [ModelController::class, 'getModeleByMarque']);
Route::get('/version/{modele_id}', [VersionController::class, 'getVersionByModele']);
//Route::get('/version/{modele_id}', 'VersionController@getVersionByModele');

Route::post('/update/enchere', [VoitureController::class, 'updateEnchere'])->name('update.enchere');

Route::get('/test', function () {
    return view('test');
});



