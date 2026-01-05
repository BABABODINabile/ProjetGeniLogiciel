@extends('adminLayout.app')  

@section('title', 'Détails de la Promotion')

@section('page_title', 'Détails de la Promotion')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6 max-w-2xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-slate-800">Détails de la Promotion</h2>
        <div class="flex gap-2">
            <a href="{{ route('promotions.edit', $promotion) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition">
                <i class="fas fa-edit mr-2"></i>Modifier
            </a>
            <form action="{{ route('promotions.destroy', $promotion) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette promotion ?')">
                    <i class="fas fa-trash mr-2"></i>Supprimer
                </button>
            </form>
        </div>
    </div>

    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-slate-700">Libellé</label>
            <p class="mt-1 text-lg text-slate-900">{{ $promotion->libelle }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700">Filière/Option</label>
            <p class="mt-1 text-lg text-slate-900">{{ $promotion->filiereOption->option ?? 'N/A' }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700">Année</label>
            <p class="mt-1 text-lg text-slate-900">{{ $promotion->year }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700">Créé le</label>
            <p class="mt-1 text-lg text-slate-900">{{ $promotion->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700">Mis à jour le</label>
            <p class="mt-1 text-lg text-slate-900">{{ $promotion->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('promotions.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
            <i class="fas fa-arrow-left mr-2"></i>Retour à la liste
        </a>
    </div>
</div>
@endsection
