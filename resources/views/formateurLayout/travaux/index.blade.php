@extends('formateurLayout.app') {{-- Ton layout corrigé --}}

@section('page_title', 'Gestion des Travaux')

@section('content')

<x-bladewind::notification />
@if (session('success-assign'))
    <script>
        showNotification(
            'Assignation réussie',
            "{{ session('success-assign') }}"
        );
    </script>
@endif
<div class="space-y-6">
    <div class="flex justify-between items-center bg-white p-4 rounded-3xl border border-slate-100 shadow-sm">
        <p class="text-sm font-bold text-slate-500 px-4">
            <span class="text-blue-600">{{ $travaux->count() }}</span>@if ($travaux->count()>1)Travaux créés
                @else
                Travail créé
            @endif 
        </p>
        <a href="{{ route('formateur.travaux.create') }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white text-xs font-black uppercase tracking-widest rounded-2xl transition-all shadow-lg shadow-blue-100 flex items-center gap-2">
            <i class="fas fa-plus"></i>
            Nouveau travail
        </a>
    </div>

    <div class="grid grid-cols-1 gap-4">
        @forelse($travaux as $travail)
            <div class="bg-white rounded-3xl border border-slate-200 p-6 hover:border-blue-300 transition-all group">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-slate-50 text-slate-400 group-hover:bg-blue-600 group-hover:text-white flex items-center justify-center transition-colors shadow-inner">
                            <i class="fas fa-file-signature text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-black text-slate-800 text-lg leading-tight">{{ $travail->titre }}</h3>
                            <p class="text-xs text-slate-500 font-bold uppercase tracking-widest mt-1">
                                <i class="fas fa-folder-open mr-1"></i> {{ $travail->espace->nom }} 
                                <span class="mx-2 text-slate-300">|</span> 
                                <i class="fas fa-users mr-1"></i> {{ $travail->espace->promotion->libelle ?? 'N/A' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-6">
                        <div class="text-right hidden sm:block">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Statut</p>
                            <p class="text-sm font-bold {{ $travail->statut ? 'text-yellow-500' : 'text-slate-700' }}">
                                {{ $travail->statut}}
                            </p>
                        </div>

                       <div class="flex items-center gap-3">
                            <a href="{{ route('formateur.travaux.show', $travail->id) }}"
                            class="group relative flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-50 text-slate-400 transition-all duration-300 hover:bg-blue-600 hover:text-white hover:shadow-lg hover:shadow-blue-200" 
                            title="Voir les rendus">
                                <i class="fas fa-eye text-sm transition-transform duration-300 group-hover:scale-110"></i>
                            </a>

                            <a href="" 
                            class="group relative flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-50 text-slate-400 transition-all duration-300 hover:bg-amber-500 hover:text-white hover:shadow-lg hover:shadow-amber-200" 
                            title="Modifier">
                                <i class="fas fa-edit text-sm transition-transform duration-300 group-hover:scale-110"></i>
                            </a>

                            <a href="{{ route('formateur.travail.assignation', $travail->id) }}" 
                                class="group relative flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-50 text-slate-400 transition-all duration-300 hover:bg-green-600 hover:text-white hover:border-green-600 hover:shadow-lg hover:shadow-green-200" 
                                title="Configurer l'assignation">
                                
                                
                                @if($travail->statut == 'en_attente')
                                    <i class="fa fa-hourglass-start text-sm transition-transform duration-300 group-hover:rotate-12"></i>
                                    <span class="absolute -top-1 -right-1 flex h-3 w-3">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-3 w-3 bg-yellow-500"></span>
                                    </span>
                                @endif
                                @if($travail->statut == 'en_cours')
                                    <i class="fa fa-hourglass-half text-sm transition-transform duration-300 group-hover:rotate-12"></i>
                                    <span class="absolute -top-1 -right-1 flex h-3 w-3">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                                    </span>
                                @endif
                                @if($travail->statut == 'termine')
                                    <i class="fa fa-hourglass-end text-sm transition-transform duration-300 group-hover:rotate-12"></i>
                                    <span class="absolute -top-1 -right-1 flex h-3 w-3">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                                    </span>
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-3xl p-12 text-center border-2 border-dashed border-slate-200">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clipboard-list text-3xl text-slate-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Aucun travail publié</h3>
                <p class="text-slate-500 text-sm">Commencez par créer votre premier sujet d'examen ou devoir maison.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection