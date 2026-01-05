<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTravailRequest;
use App\Http\Requests\UpdateTravailRequest;
use Illuminate\Http\Request;
use App\Models\Travail;
use Illuminate\Support\Facades\Auth;
use App\Models\Assignation;

class TravailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // On ne récupère que les espaces qui appartiennent à CE formateur
        $espaces = Auth::user()->formateur->espaces;
        
        return view('formateurLayout.travaux.create', compact('espaces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // Enregistrer un travail
    public function store(Request $request)
    {
        $formateur = Auth::user()->formateur->id;
        $request->validate([
            'titre' => 'required|string|max:255',
            'consigne' => 'required',
            'type' => 'required', 
            'espace_id' => 'required|exists:espaces,id',
            'statut' => 'required'
        ]);
        $request->merge(['formateur_id' => $formateur]);

        Travail::create($request->all());

        return redirect()->route('formateur.travaux.index');
    }


    public function assignation($id)
    {
        // On récupère le travail avec l'espace
        // On ajoute un tri alphabétique sur la relation etudiants
        $travail = Travail::with(['espace.etudiants' => function($query) {
            $query->orderBy('nom', 'asc')->orderBy('prenom', 'asc');
        }, 'espace.etudiants.user'])->findOrFail($id);
        
        return view('formateurLayout.travaux.assignation_individuelle', compact('travail'));
    }


    public function lancerSelection(Request $request, $id)
    {
        $request->validate([
            'etudiant_ids' => 'required|array|min:1',
            'etudiant_ids.*' => 'exists:etudiants,id',
            'date_fin' => 'required|date|after:now',
        ]);

        $travail = Travail::findOrFail($id);

        // On boucle sur chaque étudiant sélectionné
        foreach ($request->etudiant_ids as $etudiantId) {
            Assignation::create([
                'travail_id'  => $travail->id,
                'etudiant_id' => $etudiantId,
                'date_debut'  => now(),
                'date_fin'    => $request->date_fin,
            ]);
        }

        // Mise à jour du statut global du travail
        $travail->update(['statut' => 'en_cours']);
        
        return redirect()->route('formateur.travaux.index')
            ->with('success-assign', count($request->etudiant_ids) . ' étudiants ont reçu le travail.');
    }


    /**
     * Voir les travaux avec les assignations et les livraisons.
     */
    public function show($id)
    {
        // On descend dans les relations : Assignation -> Etudiant & Assignation -> Livraison -> Evaluation
        $travail = Travail::with([
            'espace', 
            'assignations.etudiant', 
            'assignations.livraison.evaluation' 
        ])->findOrFail($id);

        return view('formateurLayout.travaux.show', compact('travail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Travail $travail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTravailRequest $request, Travail $travail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Travail $travail)
    {
        //
    }
}
