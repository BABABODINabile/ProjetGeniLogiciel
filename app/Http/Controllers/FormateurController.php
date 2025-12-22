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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFormateurRequest $request)
    {
        //
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
