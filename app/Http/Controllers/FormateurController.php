<?php

namespace App\Http\Controllers;
use App\Services\FormateursService;
use App\Http\Requests\StoreFormateurRequest;
use App\Http\Requests\UpdateFormateurRequest;
use App\Models\Formateur;


class FormateurController extends Controller
{
    protected $formateurService;

    // Injection du service dans le constructeur
    public function __construct(FormateursService $formateurService)
    {
        $this->formateurService = $formateurService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $formateurs=$this->formateurService->getAllFormateurs();
        return view('adminLayout.formateurs.index',compact('formateurs'));

    }

    /**
     * Show the form for creating a new formateur.
     */
    public function create()
    {
        return view('adminLayout.formateurs.create');
    }

    /**
     * Store a newly created formateur in storage.
     */
    public function store(StoreFormateurRequest $request)
    {
        try {
            $this->formateurService->createFormateur($request->validated());
            return redirect()->route('formateurs.index')
                ->with('success', 'Le formateur a été créé avec succès.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->withErrors(['error' => 'Une erreur est survenue lors de la création du formateur.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Formateur $formateur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formateur $formateur)
    {
        return view('adminLayout.formateurs.edit', compact('formateur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFormateurRequest $request, Formateur $formateur)
    {
        try {
            $this->formateurService->updateFormateur($formateur, $request->validated());
            return redirect()->route('formateurs.index')
                ->with('success', 'Le formateur a été mis à jour avec succès.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->withErrors(['error' => 'Une erreur est survenue lors de la mise à jour du formateur.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formateur $formateur)
    {
        try {
            $this->formateurService->deleteFormateur($formateur);
            return redirect()->route('formateurs.index')
                ->with('success', 'Le formateur a été supprimé avec succès.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Une erreur est survenue lors de la suppression du formateur.']);
        }
    }
}
