@extends('formateurLayout.app')

@section('page_title', 'Créer un nouveau travail')

@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ route('formateur.travaux.store') }}" method="POST" class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        @csrf
        
        <div class="p-8 space-y-6">
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Assigner à l'espace</label>
                <select name="espace_id" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all font-bold text-slate-700">
                    <option value="">Sélectionnez un espace...</option>
                    @foreach($espaces as $espace)
                        <option value="{{ $espace->id }}">{{ $espace->nom }} ({{ $espace->promotion->libelle ?? 'Sans promo' }}_{{ $espace->promotion->filiere_option->option ?? '' }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Titre du travail</label>
                <input type="text" name="titre" placeholder="Ex: Devoir de synthèse n°1" required
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all font-bold">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Type de travail</label>
                    <select name="type" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all font-bold">
                        <option value="Individuel">Individuel</option>
                        <option value="collectif">Collectif</option>
                        <option value="groupe">Groupe</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Statut initial</label>
                    <select name="statut" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all font-bold">
                        <option value="en_attente" selected>En attente</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Consignes / Instructions</label>
                <textarea name="consigne" rows="5" required placeholder="Détaillez ici ce que les étudiants doivent faire..."
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all font-medium text-slate-600"></textarea>
            </div>
        </div>

        <div class="p-6 bg-slate-50 border-t border-slate-100 flex justify-end gap-3">
            <a href="{{ route('formateur.travaux.index') }}" class="px-6 py-3 text-xs font-black uppercase tracking-widest text-slate-400 hover:text-slate-600 transition-colors">Annuler</a>
            <button type="submit" class="px-10 py-3 bg-blue-600 hover:bg-blue-700 text-white text-xs font-black uppercase tracking-widest rounded-2xl transition-all shadow-lg shadow-blue-100">
                Créer le travail
            </button>
        </div>
    </form>
</div>
@endsection