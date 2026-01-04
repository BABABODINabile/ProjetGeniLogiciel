<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::with('filiereOption')->get();  // Charge la relation pour afficher le nom de la filière
        return view('adminLayout.promotions.index', compact('promotions'));
    }

    public function create()
    {
        $filiereOptions = \App\Models\FiliereOption::all();  // Chargez les options pour le formulaire (ajustez le modèle)
        return view('adminLayout.promotions.create', compact('filiereOptions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:255',
            'filiere_option_id' => 'required|exists:filiere_options,id',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 10),
        ]);
        Promotion::create($validated);
        return redirect()->route('promotions.index');
    }

    public function show(Promotion $promotion)
    {
        $promotion->load('filiereOption');  // Charge la relation
        return view('adminLayout.promotions.show', compact('promotion'));
    }

    public function edit(Promotion $promotion)
    {
        $filiereOptions = \App\Models\FiliereOption::all();
        return view('adminLayout.promotions.edit', compact('promotion', 'filiereOptions'));
    }

    public function update(Request $request, Promotion $promotion)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:255',
            'filiere_option_id' => 'required|exists:filiere_options,id',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 10),
        ]);
        $promotion->update($validated);
        return redirect()->route('promotions.index');
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return redirect()->route('promotions.index');
    }
}