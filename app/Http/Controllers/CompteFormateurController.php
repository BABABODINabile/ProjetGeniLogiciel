<?php

namespace App\Http\Controllers;

use App\Models\Travail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Espace;

class CompteFormateurController extends Controller
{
    //

    public function mesTravaux(){
        $formateur=Auth::user()->formateur;
        $travaux = Travail::with(['espace']) // Charger les relations pour la vue
        ->whereHas('espace', function($query) use ($formateur) {
            $query->where('formateur_id', $formateur->id);
        })
        ->latest() // Trier du plus récent au plus ancien
        ->get();   // TRÈS IMPORTANT : Récupère les résultats
    return view('formateurLayout.travaux.index', compact('travaux'));
    }


    public function espaces()
    {
            // On récupère l'étudiant connecté avec ses espaces, les matières et les formateurs liés
            $formateurs = Auth::user()->formateur;
            $espaces = $formateurs->espaces()->with(['matiere'])->get();
        return view('formateurLayout.espaces.index',[
                'espaces' => $espaces,
                'page_title' => 'Mes Espaces de Cours'
            ]);
    }


    public function showEspace($id)
    {
        $espace = Espace::with([
            'matiere', 
            'promotion', 
            'etudiants.user', 
            'travails' => function($q) {
                $q->latest();
            }
        ])->findOrFail($id);

        return view('formateurLayout.espaces.show', compact('espace'));
    }
}
