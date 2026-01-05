@extends('adminLayout.app')

@section('title', 'Éditer un Formateur')
@section('page_title', 'Édition Formateur')

@section('content')
<div class="max-w-4xl mx-auto px-4">
    
    <form action="{{ route('formateurs.update', $formateur->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-4 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest flex items-center gap-2">
                    <i class="fas fa-user-tie text-blue-600"></i>
                    Informations Formateur
                </h3>
            </div>

            <div class="p-6 grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-widest mb-1 px-1">Nom</label>
                    <input type="text" name="nom" value="{{ old('nom', $formateur->nom) }}" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all text-sm">
                    @error('nom') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-widest mb-1 px-1">Prénom</label>
                    <input type="text" name="prenom" value="{{ old('prenom', $formateur->prenom) }}" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all text-sm">
                    @error('prenom') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-widest mb-1 px-1">Email Professionnel</label>
                    <input type="email" name="email" value="{{ old('email', $formateur->user->email ?? '') }}" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all text-sm">
                    @error('email') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-widest mb-1 px-1">Spécialité</label>
                    <input type="text" name="specialite" value="{{ old('specialite', $formateur->specialite) }}"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all text-sm">
                </div>

                <div>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $formateur->user->is_active ?? true) ? 'checked' : '' }} class="mr-2">
                        <span class="text-[10px] font-medium">Compte actif</span>
                    </label>
                </div>

                <div class="pt-4 flex items-center justify-end gap-4">
                    <a href="{{ route('formateurs.index') }}" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest hover:text-slate-600 transition">
                        Annuler
                    </a>
                    <button type="submit" class="px-6 py-3 bg-gray-900 hover:bg-blue-600 text-white font-black rounded-xl shadow-lg transition-all transform active:scale-95 uppercase tracking-widest text-[10px]">
                        Enregistrer les modifications
                    </button>
                </div>
            </div>
        </div>

    </form>
</div>
@endsection
