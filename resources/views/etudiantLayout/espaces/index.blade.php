@extends('etudiantLayout.app')

@section('page_title', 'Mes Espaces Pédagogiques') 

@section('content')
<div class="py-6">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-sm font-black text-slate-400 uppercase tracking-widest">Espaces Pédagogiques</h2>
            <p class="text-xs font-bold text-slate-800">{{ $espaces->count() }} Espace (s) en cours </p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($espaces as $espace)
            <a href="{{ route('etudiant.espaces.show', $espace->id) }}"
               class="group relative flex flex-col rounded-3xl border border-slate-200 bg-white p-6 shadow-sm hover:shadow-xl hover:shadow-blue-500/5 hover:border-blue-200 transition-all duration-300">
                
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-slate-50 text-slate-400 group-hover:bg-blue-600 group-hover:text-white flex items-center justify-center transition-all duration-300 shadow-inner">
                        <i class="fas fa-layer-group text-xl"></i>
                    </div>
                    
                    <span class="text-[10px] font-black px-3 py-1 bg-blue-50 text-blue-600 rounded-lg uppercase tracking-tighter">
                        {{ $espace->promotion->libelle.'_'.$espace->promotion->filiere_option->option ?? 'Promo' }}
                    </span>
                </div>

                <h3 class="text-lg font-black text-slate-800 group-hover:text-blue-600 transition-colors mb-2">
                    {{ $espace->nom }}
                </h3>

                <p class="text-sm leading-relaxed text-slate-500 line-clamp-2 mb-6">
                    Matière : <span class="font-semibold text-slate-700">{{ $espace->matiere->libelle ?? 'Non définie' }}</span>. <br>
                    Explorez les ressources, devoirs et supports de cours partagés.
                </p>

                <div class="mt-auto pt-4 border-t border-slate-50 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
                        <i class="fas fa-user-tie text-xs"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest leading-none">Formateur</span>
                        <span class="text-xs font-bold text-slate-700">{{ $espace->formateur ? $espace->formateur->nom . " " . $espace->formateur->prenom: 'En attente' }}</span>
                    </div>
                    
                    <div class="ml-auto w-8 h-8 rounded-xl bg-slate-50 group-hover:bg-blue-50 flex items-center justify-center transition-colors">
                        <i class="fas fa-chevron-right text-[10px] text-slate-300 group-hover:text-blue-600"></i>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full bg-white border-2 border-dashed border-slate-200 rounded-3xl p-12 text-center">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-ghost text-3xl text-slate-200"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Aucun espace pour le moment</h3>
                <p class="text-slate-500">Dès que l'administration vous inscrira à un cours, il apparaîtra ici.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection