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
        $formateurs = $this->formateurService->getAllFormateurs();
        $data = $formateurs->map(function($f) {
            return [
                'id' => $f->id,
                'nom' => $f->nom,
                'prenom' => $f->prenom,
                'email' => $f->user->email ?? '',
                'specialite' => $f->specialite ?? '',
            ];
        })->toArray();

        return view('adminLayout.formateurs.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminLayout.formateurs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFormateurRequest $request)
    {
        try {
            $formateur = $this->formateurService->createFormateur($request->validated());

            return redirect()->route('formateurs.index')
                ->with('success-form-store', "Le formateur {$formateur->prenom} a été créé et ses accès envoyés.");

        } catch (\Exception $e) {
            return back()->withInput()->with('error-form-store', 'Une erreur est survenue : ' . $e->getMessage());
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFormateurRequest $request, Formateur $formateur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formateur $formateur)
    {
        //
    }
}
