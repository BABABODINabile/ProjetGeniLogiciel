<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePromotionRequest;
use App\Http\Requests\UpdatePromotionRequest;
use App\Models\Promotion;
use App\Services\PromotionService;
use App\Models\FiliereOption;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $service = new PromotionService();
        $promotions = $service->getAllPromotions();
        $data = $promotions->map(function($p) {
            return [
                'id' => $p->id,
                'libelle' => $p->libelle,
                'filiere' => $p->filiere_option?->option ?? '',
                'year' => $p->year,
            ];
        })->toArray();

        return view('adminLayout.promotions.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $filieres = FiliereOption::all();
        return view('adminLayout.promotions.create', compact('filieres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePromotionRequest $request)
    {
        try {
            $service = new PromotionService();
            $promotion = $service->createPromotion($request->validated());
            return redirect()->route('promotions.index')->with('success-promo-store', "La promotion {$promotion->libelle} a été créée.");
        } catch (\Exception $e) {
            return back()->withInput()->with('error-promo-store', 'Erreur lors de la création : ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Promotion $promotion)
    {
        // Optionnel : afficher détails
        return view('adminLayout.promotions.show', compact('promotion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotion $promotion)
    {
        $filieres = FiliereOption::all();
        return view('adminLayout.promotions.edit', compact('promotion', 'filieres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePromotionRequest $request, Promotion $promotion)
    {
        try {
            $service = new PromotionService();
            $updated = $service->updatePromotion($promotion->id, $request->validated());
            return redirect()->route('promotions.index')->with('success-promo-store', "La promotion {$updated->libelle} a été mise à jour.");
        } catch (\Exception $e) {
            return back()->withInput()->with('error-promo-store', 'Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promotion $promotion)
    {
        try {
            $service = new PromotionService();
            $service->deletePromotion($promotion->id);
            return redirect()->route('promotions.index')->with('success-promo-store', "La promotion {$promotion->libelle} a été supprimée.");
        } catch (\Exception $e) {
            return back()->with('error-promo-store', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }
}
