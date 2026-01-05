@extends('formateurLayout.app')

@section('title', 'Détails du Travail')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    
    {{-- Header : Infos du Travail --}}
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 flex justify-between items-center">
        <div>
            <span class="text-[10px] font-black text-blue-600 uppercase tracking-[0.2em]">{{ $travail->espace->nom }}</span>
            <h1 class="text-2xl font-black text-slate-800">{{ $travail->titre }}</h1>
            <p class="text-slate-500 text-sm mt-1">{{ Str::limit($travail->description, 100) }}</p>
        </div>
        <div class="text-right">
            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Échéance</div>
            <div class="text-sm font-black text-slate-700">{{ \Carbon\Carbon::parse($travail->date_fin)->format('d/m/Y') }}</div>
        </div>
    </div>

    {{-- Liste des Étudiants & Suivi --}}
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-5 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
            <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest flex items-center gap-2">
                <i class="fas fa-users text-blue-600"></i>
                Suivi des Assignations ({{ $travail->assignations->count() }})
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100">
                        <th class="p-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Étudiant</th>
                        <th class="p-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Statut</th>
                        <th class="p-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Rendu</th>
                        <th class="p-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Note</th>
                        <th class="p-4 text-right text-[10px] font-black text-slate-400 uppercase tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($travail->assignations as $assignation)
                        {{-- Sécurité : On s'assure que $assignation est bien l'objet attendu --}}

                        @if(is_object($assignation) && isset($assignation->etudiant))
                            @php $livraison = $assignation->livraison; @endphp
                            
                            <tr class="hover:bg-slate-50/30 transition-all">
                                <td class="p-4">
                                    <div class="font-bold text-slate-700 text-sm">
                                        {{ $assignation->etudiant->nom }} {{ $assignation->etudiant->prenom }}
                                    </div>
                                    <div class="text-[10px] text-slate-400">{{ $assignation->etudiant->matricule }}</div>
                                </td>
                                <td class="p-4">
                                    @if($livraison)
                                        <span class="px-3 py-1 bg-green-100 text-green-700 text-[9px] font-black uppercase rounded-full">Livré</span>
                                    @else
                                        <span class="px-3 py-1 bg-slate-100 text-slate-500 text-[9px] font-black uppercase rounded-full">En attente</span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    @if($livraison && $livraison->fichier_path)
                                        <a href="{{ asset('storage/'.$livraison->fichier_path) }}" target="_blank" class="text-blue-600 hover:text-blue-800 transition">
                                            <i class="fas fa-file-alt text-lg"></i>
                                        </a>
                                    @else
                                        <span class="text-slate-300">—</span>
                                    @endif
                                </td>
                                <td class="p-4 text-center">
                                    @if($livraison && $livraison->evaluation)
                                        <span class="font-black text-sm text-slate-800">{{ $livraison->evaluation->note }}</span>
                                        <span class="text-slate-400 text-xs">/{{ $livraison->evaluation->points }}</span>
                                    @else
                                        <span class="text-slate-300">--</span>
                                    @endif
                                </td>
                                <td class="p-4 text-right">
                                    @if($livraison)
                                        <button onclick="openModal('{{ $livraison->id }}')" class="bg-slate-900 hover:bg-blue-600 text-white px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                                            {{ $livraison->evaluation ? 'Modifier Note' : 'Évaluer' }}
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection