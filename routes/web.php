<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CompteEtudiantController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\FormateurController;
use App\Http\Controllers\EspaceController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\CompteFormateurController;
use App\Http\Controllers\TravailController;
use App\Http\Controllers\LivraisonController;
use App\Models\Espace;
use App\Models\Travail;

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


// Routes accessibles uniquement aux invités (non connectés)
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);


// Route de déconnexion (accessible uniquement aux connectés)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');




/**
 * Routes pour admin
 */
Route::prefix('admin')->middleware(['auth','role:admin'])->group(function(){

    Route::get('/', function () {
        return view('adminLayout.app');
    })->name('admin');


    Route::prefix('etudiants')->group(function () {
        Route::get('/index',[EtudiantController::class, 'index'])->name('etudiants.index');
        Route::get('/createStudent',[EtudiantController::class,'create'])->name('etudiants.create');
        Route::post('/storeStudent',[EtudiantController::class,'store'])->name('etudiant.store');
        // Edition / mise à jour / suppression et envoi manuel d'accès
        Route::get('/edit/{etudiant}', [EtudiantController::class, 'edit'])->name('etudiants.edit');
        Route::put('/update/{etudiant}', [EtudiantController::class, 'update'])->name('etudiant.update');
        Route::delete('/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiant.destroy');
        Route::post('/send-credentials/{etudiant}', [EtudiantController::class, 'sendCredentials'])->name('etudiants.send_credentials');
    });


    Route::prefix('formateurs')->group(function () {
        Route::get('/index',[FormateurController::class, 'index'])->name('formateurs.index');
        Route::get('/createFormateur',[FormateurController::class,'create'])->name('formateurs.create');
        Route::post('/storeFormateur',[FormateurController::class,'store'])->name('formateurs.store');
        // Edition / mise à jour / suppression et envoi manuel d'accès pour les formateurs
        Route::get('/edit/{formateur}', [FormateurController::class, 'edit'])->name('formateurs.edit');
        Route::put('/update/{formateur}', [FormateurController::class, 'update'])->name('formateurs.update');
        Route::delete('/{formateur}', [FormateurController::class, 'destroy'])->name('formateurs.destroy');
        Route::post('/send-credentials/{formateur}', [FormateurController::class, 'sendCredentials'])->name('formateurs.send_credentials');
    });


    Route::prefix('administration')->group(function () {
        Route::get('/index', [App\Http\Controllers\AdministrationController::class, 'index'])->name('administrations.index');
        Route::get('/create', [App\Http\Controllers\AdministrationController::class, 'create'])->name('administrations.create');
        Route::post('/store', [App\Http\Controllers\AdministrationController::class, 'store'])->name('administrations.store');
        Route::get('/edit/{administration}', [App\Http\Controllers\AdministrationController::class, 'edit'])->name('administrations.edit');
        Route::put('/update/{administration}', [App\Http\Controllers\AdministrationController::class, 'update'])->name('administrations.update');
        Route::delete('/{administration}', [App\Http\Controllers\AdministrationController::class, 'destroy'])->name('administrations.destroy');
        Route::post('/send-credentials/{administration}', [App\Http\Controllers\AdministrationController::class, 'sendCredentials'])->name('administrations.send_credentials');
    });




    Route::prefix('promotions')->name('promotions.')->group(function () {
        Route::get('/index', [PromotionController::class, 'index'])->name('index');
        Route::get('/create', [PromotionController::class, 'create'])->name('create');
        Route::post('/store', [PromotionController::class, 'store'])->name('store');  // Ajout POST
        Route::get('/show/{promotion}', [PromotionController::class, 'show'])->name('show');
        Route::get('/edit/{promotion}', [PromotionController::class, 'edit'])->name('edit');
        Route::put('/update/{promotion}', [PromotionController::class, 'update'])->name('update');  // Ajout PUT
        Route::delete('/destroy/{promotion}', [PromotionController::class, 'destroy'])->name('destroy');  // Ajout DELETE
    });




    Route::prefix('espaces')->group(function () {
        Route::get('/index', [EspaceController::class, 'index'])->name('espaces.index');
        Route::get('/create', [EspaceController::class, 'create'])->name('espaces.create');
        Route::post('/store', [EspaceController::class, 'store'])->name('espaces.store');
        Route::get('/edit/{espace}', [EspaceController::class, 'edit'])->name('espaces.edit');
        Route::get('/addf/{espace}', [EspaceController::class, 'addformateur'])->name('espaces.addf');
        Route::get('/addp/{espace}', [EspaceController::class, 'addpromotion'])->name('espaces.addp');
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





/**
 * Routes pour étudiants
 */

Route::prefix('etudiant')->middleware(['auth','role:etudiant'])->name('etudiant.') ->group(function () {
    
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


        Route::get('/travaux/{id}', [CompteEtudiantController::class, 'showTravail'])
            ->name('travaux.show');


        Route::get('/livraison/create/{assignation_id}', [LivraisonController::class, 'create'])
        ->name('livraison.create');
        Route::post('/livraison/store/{assignation_id}', [LivraisonController::class, 'store'])
        ->name('livraison.store');
    });





/**
 * Routes pour formateurs
 */
Route::prefix('formateur')->middleware(['auth','role:formateur'])->name('formateur.') ->group(function () {
    
        Route::get('/',function(){
            return view('formateurLayout.app');
        });

        Route::get('/profil', [CompteFormateurController::class, 'profil'])
            ->name('profil');


        Route::put('/profil', [CompteFormateurController::class, 'updateProfil'])
            ->name('profil.update');


        Route::get('/espaces', [CompteFormateurController::class, 'espaces'])
            ->name('espaces.index');


        Route::get('/espaces/{id}', [CompteFormateurController::class, 'showEspace'])
            ->name('espaces.show');


        Route::get('/travaux', [CompteFormateurController::class, 'mesTravaux'])
            ->name('travaux.index');

        
        Route::get('/travaux/create', [TravailController::class, 'create'])
            ->name('travaux.create');


        Route::post('/travaux/store', [TravailController::class, 'store'])
            ->name('travaux.store');

        Route::get('/travaux/{id}/assignation', [TravailController::class, 'assignation'])
            ->name('travail.assignation');
        

        Route::put('/travaux/{id}/lancer-selection', [TravailController::class, 'lancerSelection'])
        ->name('travaux.lancer_selection');


        Route::get('/travaux/{id}', [TravailController::class, 'show'])
            ->name('travaux.show');


        Route::put('/password', [CompteFormateurController::class, 'updatePassword'])
            ->name('password.update');

});