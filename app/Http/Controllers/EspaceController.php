<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEspaceRequest;
use App\Http\Requests\UpdateEspaceRequest;
use App\Models\Espace;
use App\Models\Matiere;
use App\Models\Promotion;
use App\Models\Formateur;
use App\Services\EspaceService;

class EspaceController extends Controller
{
    protected $espaceService;

    public function __construct(EspaceService $espaceService)
    {
        $this->espaceService = $espaceService;
    }

    public function index()
    {
        $espaces = $this->espaceService->getAllEspaces();
        return view('adminLayout.espaces.index', compact('espaces'));
    }

    public function create()
    {
        // On récupère les données nécessaires pour remplir les <select> du formulaire
        $matieres = Matiere::all();
        $promotions = Promotion::all();
        $formateurs = Formateur::all();

        //return view('adminLayout.espaces.create', compact('matieres', 'promotions', 'formateurs'));
    }

    public function store(StoreEspaceRequest $request)
    {
        try {
            $this->espaceService->createEspace($request->validated());
            return redirect()->route('espaces.index')->with('success', 'Espace créé avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la création.')->withInput();
        }
    }

    public function show(Espace $espace)
    {
        // On utilise le service pour charger les relations (étudiants inscrits, etc.)
        $espaceComplet = $this->espaceService->getEspaceById($espace->id);
        return view('adminLayout.espaces.show', compact('espaceComplet'));
    }

    public function edit(Espace $espace)
    {
        $matieres = Matiere::all();
        $promotions = Promotion::all();
        $formateurs = Formateur::all();

        return view('adminLayout.espaces.edit', compact('espace', 'matieres', 'promotions', 'formateurs'));
    }

    public function update(UpdateEspaceRequest $request, Espace $espace)
    {
        try {
            $this->espaceService->updateEspace($espace->id, $request->validated());
            return redirect()->route('espaces.index')->with('success', 'Espace mis à jour.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur de mise à jour.');
        }
    }

    public function destroy(Espace $espace)
    {
        try {
            $this->espaceService->deleteEspace($espace->id);
            return redirect()->route('espaces.index')->with('success', 'Espace supprimé.');
        } catch (\Exception $e) {
            return back()->with('error', 'Impossible de supprimer cet espace.');
        }
    }
}