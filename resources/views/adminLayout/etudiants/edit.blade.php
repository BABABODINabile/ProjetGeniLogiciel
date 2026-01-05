@extends('adminLayout.app')

@section('title', 'Éditer un Étudiant')
@section('page_title', 'Édition Étudiant')

@section('content')
<div class="max-w-6xl mx-auto px-4">
    
    <form action="{{ route('etudiant.update', $etudiant->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- Conteneur en Grille pour mettre les deux sections côte à côte --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-stretch">
            
            {{-- Section 1 : Informations Personnelles --}}
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 flex flex-col overflow-hidden">
                <div class="p-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest flex items-center gap-2">
                        <i class="fas fa-user text-blue-600"></i>
                        Informations Personnelles
                    </h3>
                </div>
                
                <div class="p-6 grid grid-cols-2 gap-4">
                    <div class="col-span-1">
                        <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-widest mb-1 px-1">Nom</label>
                        <input type="text" name="nom" value="{{ old('nom', $etudiant->nom) }}" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all text-sm">
                        @error('nom') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="col-span-1">
                        <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-widest mb-1 px-1">Prénom</label>
                        <input type="text" name="prenom" value="{{ old('prenom', $etudiant->prenom) }}" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all text-sm">
                         @error('prenom') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="col-span-2">
                        <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-widest mb-1 px-1">Email Professionnel</label>
                        <input type="email" name="email" value="{{ old('email', $etudiant->user->email) }}" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all text-sm"
                            placeholder="etudiant@domaine.com">
                         @error('email') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="col-span-1">
                        <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-widest mb-1 px-1">Date de naissance</label>
                        <input type="date" name="date_naissance" value="{{ old('date_naissance', $etudiant->date_naissance) }}" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all text-sm">
                    </div>

                    <div class="col-span-1">
                        <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-widest mb-1 px-1">Sexe</label>
                        <select name="sexe" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all text-sm">
                            <option value="M" {{ old('sexe', $etudiant->sexe) == 'M' ? 'selected' : '' }}>Masculin</option>
                            <option value="F" {{ old('sexe', $etudiant->sexe) == 'F' ? 'selected' : '' }}>Féminin</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                         <p class="text-[9px] text-slate-400 italic px-1 leading-tight">Laisser le champ mot de passe vide si vous ne souhaitez pas le modifier. Vous pouvez envoyer les accès manuellement depuis la liste.</p>
                    </div>
                </div>
            </div>

            {{-- Section 2 : Cursus Académique --}}
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 flex flex-col overflow-hidden">
                <div class="p-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest flex items-center gap-2">
                        <i class="fas fa-graduation-cap text-blue-600"></i>
                        Cursus Académique
                    </h3>
                </div>
                
                <div class="p-6 flex flex-col justify-between h-full space-y-5">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-widest mb-1 px-1">N° Matricule</label>
                        <input type="text" name="matricule" value="{{ old('matricule', $etudiant->matricule) }}" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all text-sm"
                            placeholder="EX: 2025-001">
                             @error('matricule') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-widest mb-1 px-1">Promotion / Année</label>
                        <select name="promotion_id" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all text-sm">
                            @foreach($promotions as $promo)
                                <option value="{{ $promo->id }}" {{ old('promotion_id', $etudiant->promotion_id) == $promo->id ? 'selected' : '' }}>{{ $promo->libelle }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-widest mb-1 px-1">Filière / Option</label>
                        <select name="filiere_option_id" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all text-sm">
                            @foreach($filieres as $filiere)
                                <option value="{{ $filiere->id }}" {{ old('filiere_option_id', $etudiant->filiere_option_id) == $filiere->id ? 'selected' : '' }}>{{ $filiere->option }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="pt-4 flex items-center justify-end gap-4">
                        <a href="{{ route('etudiants.index') }}" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest hover:text-slate-600 transition">
                            Annuler
                        </a>
                        <button type="submit" class="px-6 py-3 bg-gray-900 hover:bg-blue-600 text-white font-black rounded-xl shadow-lg transition-all transform active:scale-95 uppercase tracking-widest text-[10px]">
                            Enregistrer les modifications
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
