@extends('adminLayout.app')

@section('title', 'Ajouter un Espace')
@section('page_title', 'Nouvel Espace Pédagogique')

@section('content')
<div class="max-w-6xl mx-auto">
    
    <form action="{{ route('espaces.store') }}" method="POST" class="space-y-4">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
            
            {{-- Colonne Gauche : Identité --}}
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-5 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest flex items-center gap-2">
                        <i class="fas fa-layer-group text-blue-600"></i>
                        Identité de l'Espace
                    </h3>
                </div>
                
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-widest mb-1 px-1">Nom de l'espace</label>
                        <input type="text" name="nom" value="{{ old('nom') }}" required
                            placeholder="Ex: Atelier Algorithmique"
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all text-sm">
                        @error('nom') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-widest mb-1 px-1">Description pédagogique</label>
                        <textarea name="description" rows="5" 
                            placeholder="Objectifs de cet espace..."
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all text-sm resize-none">{{ old('description') }}</textarea>
                        @error('description') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Colonne Droite : Configuration --}}
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-5 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest flex items-center gap-2">
                        <i class="fas fa-project-diagram text-blue-600"></i>
                        Configuration & Cursus
                    </h3>
                </div>
                
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-widest mb-1 px-1">Matière</label>
                            <select name="matiere_id" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all text-sm">
                                <option value="">Sélectionner une matière</option>
                                @foreach($matieres as $matiere)
                                    <option value="{{ $matiere->id }}" {{ old('matiere_id') == $matiere->id ? 'selected' : '' }}>{{ $matiere->libelle }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-widest mb-1 px-1">
                                Promotion cible <span class="text-[9px] text-amber-600 ml-1">(Optionnel)</span>
                            </label>
                            <select name="promotion_id" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all text-sm">
                                <option value="">En attente d'assignation</option>
                                @foreach($promotions as $promo)
                                    <option value="{{ $promo->id }}" {{ old('promotion_id') == $promo->id ? 'selected' : '' }}>{{ $promo->libelle }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-widest mb-1 px-1">
                                Assigner un Formateur <span class="text-[9px] text-amber-600 ml-1">(Optionnel)</span>
                            </label>
                            <select name="formateur_id" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all text-sm">
                                <option value="">En attente d'assignation</option>
                                @foreach($formateurs as $formateur)
                                    <option value="{{ $formateur->id }}" {{ old('formateur_id') == $formateur->id ? 'selected' : '' }}>{{ $formateur->nom }} {{ $formateur->prenom }}</option>
                                @endforeach
                            </select>
                            <p class="text-[9px] text-slate-400 mt-2 italic px-1">Un badge "En Attente" sera affiché par défaut.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Barre d'actions compacte --}}
        <div class="flex items-center justify-end gap-4 pt-2">
            <a href="{{ route('espaces.index') }}" class="px-5 py-2 text-[11px] font-bold text-slate-500 uppercase tracking-widest hover:text-slate-800 transition">
                Annuler
            </a>
            <button type="submit" class="px-8 py-3 bg-gray-900 hover:bg-blue-600 text-white font-black rounded-xl shadow-lg transition-all transform active:scale-95 uppercase tracking-widest text-[10px]">
                Créer l'Espace Pédagogique
            </button>
        </div>
    </form>
</div>
@endsection