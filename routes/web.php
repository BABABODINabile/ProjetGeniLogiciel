<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompteEtudiantController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\FormateurController;
use App\Http\Controllers\EspaceController;
use App\Models\Espace;

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
Route::prefix('admin')->group(function(){

    Route::get('/', function () {
        return view('adminLayout.app');
    });


    Route::prefix('etudiants')->group(function () {
        Route::get('/index',[EtudiantController::class, 'index'])->name('etudiants.index');
    });


    Route::prefix('formateurs')->group(function () {
        Route::get('/index',[FormateurController::class, 'index'])->name('formateurs.index');
    });


    Route::prefix('administration')->group(function () {
        Route::get('/index', fn() => view('adminLayout.administrations.index'))->name('administrations.index');
    });


    Route::prefix('promotions')->group(function () {
        Route::get('/index', fn() => view('adminLayout.promotions.index'))->name('promotions.index');
    });


    Route::prefix('espaces')->group(function () {
        Route::get('/index', [EspaceController::class, 'index'])->name('espaces.index');
        Route::get('/edit/{espace}', [EspaceController::class, 'edit'])->name('espaces.edit');
        Route::get('/show/{espace}', [EspaceController::class, 'show'])->name('espaces.show');
        Route::get('/addStu/{espace}', [EspaceController::class, 'addStu'])->name('espaces.addStu');
        Route::delete('/{espace}', [EspaceController::class, 'destroy'])->name('espaces.destroy');
        Route::put('/{espace}', [EspaceController::class, 'update'])->name('espaces.update');
        Route::post('espaces/{espace}/inscrire-etudiant', [EspaceController::class, 'inscrireEtudiant'])
         ->name('espaces.inscrire-etudiant');
        Route::post('espaces/{espace}/retire-etudiant', [EspaceController::class, 'retireEtudiant'])
         ->name('espaces.retire-etudiant');
        

    });


    Route::prefix('matieres')->group(function () {
        Route::get('/index', fn() => view('adminLayout.matieres.index'))->name('matieres.index');
    });


    Route::prefix('filieres')->group(function () {
        Route::get('/index', fn() => view('adminLayout.filieres.index'))->name('filieres.index');
    });


    Route::prefix('profil')->group(function () {
        Route::get('/show', fn() => view('adminLayout.profil.show'))->name('profil.show');
    });
});





Route::prefix('etudiant') ->name('etudiant.') ->group(function () {
    
        Route::get('/',function(){
            return view('etudiantLayout.app');
        });


        Route::get('/profil', [CompteEtudiantController::class, 'profil'])
            ->name('profil');


        Route::put('/profil', [CompteEtudiantController::class, 'updateProfil'])
            ->name('profil.update');


        Route::get('/espaces', [CompteEtudiantController::class, 'espaces'])
            ->name('espaces.index');


        Route::get('/espaces/{id}', [CompteEtudiantController::class, 'showEspace'])
            ->name('espaces.show');


        Route::get('/travaux', [CompteEtudiantController::class, 'travaux'])
            ->name('travaux.index');


        Route::get('/travaux/{id}', [CompteEtudiantController::class, 'showTravail'])
            ->name('travaux.show');


        Route::put('/password', [CompteEtudiantController::class, 'updatePassword'])
            ->name('password.update');
    });




