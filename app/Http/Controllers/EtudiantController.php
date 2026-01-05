<?php

namespace App\Http\Controllers;

use App\Services\EtudiantService;
use App\Http\Requests\StoreEtudiantRequest;
use App\Http\Requests\UpdateEtudiantRequest;
use App\Models\Etudiant;
use App\Models\Promotion;
use App\Models\FiliereOption;

class EtudiantController extends Controller
{
    protected $etudiantService;

    // Injection du service dans le constructeur
    public function __construct(EtudiantService $etudiantService)
    {
        $this->etudiantService = $etudiantService;
    }

    /**
     * Afficher la liste des étudiants
     */
    public function index()
    {
        $etudiants = $this->etudiantService->getAllStudents();
        $data = $etudiants->map(function($etudiant) {
            return [
                'id' => $etudiant->id,
                'first_name' => $etudiant->nom,
                'last_name' => $etudiant->prenom,
                'matricule'=>$etudiant->matricule,
                'email' => $etudiant->user->email,
                'sexe'=>$etudiant->sexe,
                'promotion' => $etudiant->promotion?->libelle ?? '',
                'filiere_option' => $etudiant->filiere_option?->option ?? '',
            ];
        })->toArray();
        return view('adminLayout.etudiants.index', compact('data'));
    }
    /**
     * Display a listing of the resource.
     */


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $promotions = Promotion::all();
        $filieres = FiliereOption::all();
        return view('adminLayout.etudiants.create', compact('promotions', 'filieres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEtudiantRequest $request)
    {
        try {
            // 1. Appel du service avec les données validées
            // On récupère toutes les données du formulaire
            $etudiant = $this->etudiantService->createStudent($request->validated());

            // 2. Retour avec succès si tout s'est bien passé
            return redirect()->route('etudiants.index')
                ->with('success-etu-store', "L'étudiant {$etudiant->prenom} a été créé avec succès et ses accès ont été envoyés par mail.");

        } catch (\Exception $e) {
            // En cas d'erreur (ex: problème d'envoi de mail ou base de données)
            return back()
                ->withInput()
                ->with('error-etu-store', "Une erreur est survenue lors de la création : " . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Etudiant $etudiant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etudiant $etudiant)
    {
        $promotions = Promotion::all();
        $filieres = FiliereOption::all();
        return view('adminLayout.etudiants.edit', compact('etudiant', 'promotions', 'filieres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEtudiantRequest $request, Etudiant $etudiant)
    {
        try {
            $updated = $this->etudiantService->updateStudent($etudiant->id, $request->validated());
            return redirect()->route('etudiants.index')
                ->with('success-etu-store', "L'étudiant {$updated->prenom} a été mis à jour avec succès.");
        } catch (\Exception $e) {
            return back()->withInput()->with('error-etu-store', 'Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etudiant $etudiant)
    {
        try {
            $this->etudiantService->deleteStudent($etudiant->id);
            return redirect()->route('etudiants.index')->with('success-etu-store', "L'étudiant {$etudiant->prenom} a été supprimé.");
        } catch (\Exception $e) {
            return back()->with('error-etu-store', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }

    /**
     * Envoi manuel des accès (mot de passe temporaire) à un étudiant
     */
    public function sendCredentials(Etudiant $etudiant)
    {
        try {
            $this->etudiantService->sendCredentials($etudiant->id);
            return redirect()->route('etudiants.index')->with('success-etu-store', "Les accès ont été envoyés à {$etudiant->prenom}.");
        } catch (\Exception $e) {
            return back()->with('error-etu-store', 'Erreur lors de l\'envoi des accès : ' . $e->getMessage());
        }
    }
}
