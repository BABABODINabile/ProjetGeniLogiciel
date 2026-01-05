<?php

namespace App\Services;

use App\Models\Promotion;
use Illuminate\Support\Facades\DB;

class PromotionService
{
    /**
     * Récupérer toutes les promotions avec relations
     */
    public function getAllPromotions()
    {
        return Promotion::with(['filiere_option'])->latest()->get();
    }

    public function getPromotionById($id)
    {
        return Promotion::with(['filiere_option'])->findOrFail($id);
    }

    public function createPromotion(array $data)
    {
        return DB::transaction(function () use ($data) {
            return Promotion::create($data);
        });
    }

    public function updatePromotion($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $promotion = Promotion::findOrFail($id);
            $promotion->update($data);
            return $promotion->fresh();
        });
    }

    public function deletePromotion($id)
    {
        return DB::transaction(function () use ($id) {
            $promotion = Promotion::findOrFail($id);
            $promotion->delete();
            return true;
        });
    }
}
