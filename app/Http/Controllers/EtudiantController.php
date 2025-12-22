<?php

namespace App\Http\Controllers;

use App\Services\EtudiantService;
use App\Http\Requests\StoreEtudiantRequest;
use App\Http\Requests\UpdateEtudiantRequest;
use App\Models\Etudiant;

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
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEtudiantRequest $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEtudiantRequest $request, Etudiant $etudiant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etudiant $etudiant)
    {
        //
    }
}
