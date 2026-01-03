@extends('adminLayout.app') {{-- Ton layout admin --}}

@section('title', 'Ajouter un Étudiant')
@section('page_title', 'Nouvel Étudiant')

@section('content')
<div class="max-w-4xl mx-auto">
    
    <form action="{{ route('etudiant.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest flex items-center gap-2">
                    <i class="fas fa-user text-blue-600"></i>
                    Informations Personnelles
                </h3>
            </div>
            
            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-widest mb-2 px-1">Nom</label>
                    <input type="text" name="nom" value="{{ old('nom') }}" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all">
                    @error('nom') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-widest mb-2 px-1">Prénom</label>
                    <input type="text" name="prenom" value="{{ old('prenom') }}" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all">
                         @error('prenom') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-widest mb-2 px-1">Adresse Email Professionnelle</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all"
                        placeholder="etudiant@domaine.com">
                         @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    <p class="text-[10px] text-slate-400 mt-2 italic px-1">Un mail contenant le mot de passe sera automatiquement envoyé à cette adresse.</p>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-widest mb-2 px-1">Date de naissance</label>
                    <input type="date" name="date_naissance" value="{{ old('date_naissance') }}" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-widest mb-2 px-1">Sexe</label>
                    <select name="sexe" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all">
                        <option value="M">Masculin</option>
                        <option value="F">Féminin</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest flex items-center gap-2">
                    <i class="fas fa-graduation-cap text-blue-600"></i>
                    Cursus Académique
                </h3>
            </div>
            
            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-widest mb-2 px-1">N° Matricule</label>
                    <input type="text" name="matricule" value="{{ old('matricule') }}" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all"
                        placeholder="EX: 2025-001">
                         @error('matricule') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-widest mb-2 px-1">Promotion / Année</label>
                    <select name="promotion_id" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all">
                        @foreach($promotions as $promo)
                            <option value="{{ $promo->id }}">{{ $promo->libelle }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-widest mb-2 px-1">Filière / Option</label>
                    <select name="filiere_option_id" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all">
                        @foreach($filieres as $filiere)
                            <option value="{{ $filiere->id }}">{{ $filiere->option }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-4">
            <a href="{{ route('etudiants.index') }}" class="px-6 py-3 text-sm font-bold text-slate-500 uppercase tracking-widest hover:text-slate-800 transition">
                Annuler
            </a>
            <button type="submit" class="px-10 py-4 bg-gray-900 hover:bg-blue-600 text-white font-black rounded-2xl shadow-lg transition-all transform active:scale-95 uppercase tracking-widest text-xs">
                Créer l'étudiant et envoyer les accès
            </button>
        </div>
    </form>
</div>

@endsection