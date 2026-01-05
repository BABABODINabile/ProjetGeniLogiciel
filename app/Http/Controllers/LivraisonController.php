<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLivraisonRequest;
use App\Http\Requests\UpdateLivraisonRequest;
use App\Models\Assignation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Livraison;

class LivraisonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function create($assignation_id)
    {
        $etudiant = Auth::user()->etudiant;
        $assignation = Assignation::with('travail.espace')->findOrFail($assignation_id);
        
        // Logique de vérification simplifiée :
        // On autorise si l'ID de l'étudiant match OU si l'ID de la promotion match
        $isOwner = ($assignation->etudiant_id == $etudiant->id);
        $isForMyPromo = ($assignation->promotion_id == $etudiant->promotion_id);

        if (!$isOwner && !$isForMyPromo) {
            abort(403, "Vous n'êtes pas autorisé à accéder à cette assignation.");
        }

        // Sécurité supplémentaire : Vérifier si la date limite n'est pas dépassée
        if (now()->gt($assignation->date_fin)) {
            return redirect()->back()->with('error', 'Le délai de livraison pour ce travail est expiré.');
        }

        return view('etudiantLayout.livraisons.create', compact('assignation'));
    }

    public function store(Request $request, $assignation_id)
    {
        $assignation=Assignation::findOrFail($assignation_id);
        $request->validate([
            'fichier' => 'nullable|file|mimes:pdf,zip,docx,png|max:10240',
            'message' => 'required_without:fichier|nullable|string',
        ], [
            'message.required_without' => 'Veuillez soit joindre un fichier, soit écrire un message.'
        ]);

        $path = null;
        if ($request->hasFile('fichier')) {
            $path = $request->file('fichier')->store('livraisons', 'public');
        }

        Livraison::create([
            'assignation_id' => $assignation_id,
            'fichier_path'   => $path,
            'message'        => $request->message,
        ]);

        return redirect()->route('etudiant.espaces.show', $assignation->travail->espace_id)
                        ->with('success-livraison', 'Votre travail a été transmis !');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Livraison $livraison)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLivraisonRequest $request, Livraison $livraison)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Livraison $livraison)
    {
        //
    }
}
