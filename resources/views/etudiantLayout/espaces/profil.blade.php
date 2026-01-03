@extends('etudiantLayout.app')

@section('page_title', 'Mon Profil')

@section('content')
<div class="max-w-4xl mx-auto pb-12">
    
    <div class="bg-white rounded-3xl p-6 mb-6 border border-slate-200 shadow-sm flex flex-col md:flex-row items-center gap-6">
        <div class="w-24 h-24 rounded-2xl bg-blue-600 flex items-center justify-center text-white text-4xl shadow-xl shadow-blue-200">
            {{ substr($user->etudiant->prenom, 0, 1) }}{{ substr($user->etudiant->nom, 0, 1) }}
        </div>
        <div class="text-center md:text-left">
            <h2 class="text-2xl font-black text-slate-800">{{ $user->etudiant->prenom }} {{ $user->etudiant->nom }}</h2>
            <p class="text-slate-500 font-medium">{{ $user->email }}</p>
            <div class="mt-2 flex flex-wrap justify-center md:justify-start gap-2">
                <span class="px-3 py-1 bg-green-100 text-green-600 text-[10px] font-bold uppercase rounded-lg">Compte Actif</span>
                <span class="px-3 py-1 bg-blue-100 text-blue-600 text-[10px] font-bold uppercase rounded-lg">Étudiant</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-1 space-y-6">
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Détails Académiques</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-[10px] text-slate-400 uppercase font-bold">Matricule</p>
                        <p class="font-bold text-slate-800">{{ $user->etudiant->matricule }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 uppercase font-bold">Promotion</p>
                        <p class="font-bold text-slate-800">{{ $user->etudiant->promotion? $user->etudiant->promotion->libelle: 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 uppercase font-bold">Filière</p>
                        <p class="font-bold text-slate-800 text-sm leading-tight">{{ $user->etudiant->filiere_option->option ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="md:col-span-2 space-y-6">
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-50">
                    <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest flex items-center gap-2">
                        <i class="fas fa-shield-alt text-blue-600"></i>
                        Sécurité du compte
                    </h3>
                </div>
                
                <form action="{{ route('etudiant.password.update') }}" method="POST" class="p-6 space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1 ml-1">Mot de passe actuel</label>
                        <input type="password" name="current_password" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1 ml-1">Nouveau mot de passe</label>
                            <input type="password" name="password" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1 ml-1">Confirmer</label>
                            <input type="password" name="password_confirmation" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all">
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-gray-900 hover:bg-blue-600 text-white text-xs font-black uppercase tracking-widest rounded-xl transition-all shadow-lg shadow-gray-200 transform active:scale-95">
                            Mettre à jour le mot de passe
                        </button>
                    </div>
                </form>
            </div>

<div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden mb-6">
    <div class="p-6 border-b border-slate-50">
        <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest flex items-center gap-2">
            <i class="fas fa-envelope text-blue-600"></i>
            Identifiants de connexion
        </h3>
    </div>
    
    <form action="{{ route('etudiant.profil.update') }}" method="POST" class="p-6">
        @csrf
        @method('PUT')

        <div class="flex flex-col sm:flex-row gap-4 items-end">
            <div class="flex-1 w-full">
                <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1 ml-1">Adresse Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all">
                @error('email') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
            </div>
            
            <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white text-xs font-black uppercase tracking-widest rounded-xl transition-all shadow-lg shadow-blue-100 transform active:scale-95">
                Enregistrer
            </button>
        </div>
        <p class="text-[10px] text-slate-400 mt-3 flex items-center gap-2 italic">
            <i class="fas fa-info-circle"></i>
            Note : Si vous changez votre email, vous devrez l'utiliser pour vous reconnecter.
        </p>
    </form>
</div>

            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm">
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest mb-4">Données Personnelles</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <p class="text-[10px] text-slate-400 uppercase font-bold">Date de naissance</p>
                        <p class="font-bold text-slate-700">{{ \Carbon\Carbon::parse($user->etudiant->date_naissance)->translatedFormat('d F Y') }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 uppercase font-bold">Sexe</p>
                        <p class="font-bold text-slate-700">{{ $user->etudiant->sexe === 'M' ? 'Masculin' : 'Féminin' }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection