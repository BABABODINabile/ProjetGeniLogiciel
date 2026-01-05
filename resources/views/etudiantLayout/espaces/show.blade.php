@extends('etudiantLayout.app')

@section('page_title', $espace->nom)

@section('content')
<x-bladewind::notification />
@if (session('success-livraison'))
    <script>
        showNotification(
            'Livraison réussie',
            "{{ session('success-livraison') }}"
        );
    </script>
@endif
<div class="space-y-8">
    <div class="bg-white rounded-[2rem] p-8 border border-slate-200 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div class="flex items-center gap-6">
            <div class="w-16 h-16 rounded-2xl bg-blue-600 text-white flex items-center justify-center text-2xl shadow-lg shadow-blue-200">
                <i class="fas fa-book"></i>
            </div>
            <div>
                <h2 class="text-2xl font-black text-slate-800">{{ $espace->nom }}</h2>
                <p class="text-slate-500 font-medium">Formateur : <span class="text-blue-600">{{ $espace->formateur->nom }} {{ $espace->formateur->prenom }}</span></p>
            </div>
        </div>
        <div class="px-6 py-3 bg-slate-50 rounded-2xl border border-slate-100">
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Matière</p>
            <p class="font-bold text-slate-700">{{ $espace->matiere->libelle }}</p>
        </div>
    </div>

    <div class="space-y-4">
        <h3 class="text-sm font-black text-slate-400 uppercase tracking-widest ml-2">Travaux à rendre</h3>
        
        <div class="grid grid-cols-1 gap-4">
            @forelse($travaux as $travail)
                @php
                    $assignation = $travail->assignations
                        ->firstWhere('etudiant_id', auth()->user()->etudiant->id)
                        ?? $travail->assignations
                        ->firstWhere('promotion_id', auth()->user()->etudiant->promotion_id);

                    $estExpire = $assignation && now()->gt($assignation->date_fin);
                @endphp
                <div class="group bg-white rounded-3xl border border-slate-200 p-6 hover:border-blue-500 transition-all duration-300">
                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-6">
                        <div class="flex items-start gap-4 flex-1">
                            <div class="w-12 h-12 rounded-2xl bg-slate-50 text-slate-400 group-hover:bg-blue-50 group-hover:text-blue-600 flex items-center justify-center transition-colors shrink-0">
                                <i class="fas fa-file-signature text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-black text-slate-800 group-hover:text-blue-600 transition-colors">{{ $travail->titre }}</h4>
                                <div class="flex items-center gap-3 mt-1 mb-4">
                                    <span class="text-[10px] font-bold px-2 py-0.5 bg-slate-100 text-slate-500 rounded uppercase">{{ $travail->type }}</span>
                                    <span class="text-[10px] font-medium text-slate-400">
                                        <i class="far fa-clock mr-1"></i> Limite : {{ \Carbon\Carbon::parse($assignation->date_fin)->format('d/m/Y H:i') }}
                                    </span>
                                </div>

                                @if($travail->consigne)
                                    <div class="border-l-2 border-blue-100 pl-4 py-1">
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Consignes :</p>
                                        <p class="text-sm text-slate-600 leading-relaxed italic">{{ $travail->consigne }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center gap-3 shrink-0">
                            @if($estExpire)
                                <span class="px-4 py-2 bg-rose-50 text-rose-600 text-[10px] font-black uppercase rounded-xl border border-rose-100">
                                    Délai dépassé
                                </span>
                            @else
                                <a href="{{ route('etudiant.livraison.create', $travail->assignations->id) }}" 
                                   class="px-6 py-3 bg-gray-900 text-white text-[10px] font-black uppercase rounded-xl hover:bg-blue-600 transition-all shadow-lg shadow-gray-200 hover:shadow-blue-200 flex items-center gap-2">
                                    <i class="fas fa-upload text-[10px]"></i>
                                    Livrer le travail
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl p-12 text-center">
                    <p class="text-slate-400 font-bold text-sm">Aucun travail publié pour le moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection