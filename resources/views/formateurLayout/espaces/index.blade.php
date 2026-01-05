@extends('formateurLayout.app')

@section('page_title', 'Mes Espaces Pédagogiques')

@section('content')
<div class="space-y-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shadow-inner">
                    <i class="fas fa-layer-group text-xl"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Espaces Actifs</p>
                    <p class="text-2xl font-black text-gray-800">{{ $espaces->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($espaces as $espace)
            <div class="group bg-white rounded-[2.5rem] border border-gray-100 hover:border-blue-500/30 transition-all duration-500 overflow-hidden hover:shadow-2xl hover:shadow-blue-900/10">
                
                <div class="h-36 bg-gray-900 relative p-8 flex flex-col justify-end">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-600/10 rounded-full blur-3xl -mr-16 -mt-16"></div>
                    
                    <div class="absolute top-6 right-6 w-12 h-12 rounded-2xl bg-white/5 backdrop-blur-xl border border-white/10 flex items-center justify-center text-white/80 text-xl transition-transform group-hover:rotate-12">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    
                    <span class="px-3 py-1 bg-blue-600 text-white text-[9px] font-black uppercase rounded-lg w-fit mb-3 shadow-lg shadow-blue-900/20">
                        {{ $espace->matiere->nom ?? 'Matière' }}
                    </span>
                    <h3 class="text-white font-black text-xl leading-tight tracking-tight group-hover:text-blue-400 transition-colors">
                        {{ $espace->nom }}
                    </h3>
                </div>

                <div class="p-8 space-y-6">
                    <div class="flex items-center justify-between py-3 border-b border-gray-50">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-users text-gray-300 text-xs"></i>
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Promotion</span>
                        </div>
                        <span class="text-xs font-black text-blue-600 bg-blue-50 px-4 py-1.5 rounded-xl">
                            {{ $espace->promotion->nom ?? 'N/A' }}
                        </span>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 group-hover:bg-white transition-colors">
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-tighter">Apprenants</p>
                            <p class="text-lg font-black text-gray-800">{{ $espace->etudiants->count() }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 group-hover:bg-white transition-colors">
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-tighter">Travaux</p>
                            <p class="text-lg font-black text-gray-800">{{ $espace->travails->count() }}</p>
                        </div>
                    </div>

                    <a href="{{ route('formateur.espaces.show', $espace->id) }}" 
                       class="flex items-center justify-center gap-3 w-full py-4 bg-gray-900 text-white rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-blue-600 transition-all duration-300 shadow-xl shadow-gray-200 hover:shadow-blue-200 active:scale-[0.98]">
                        Gérer l'espace
                        <i class="fas fa-chevron-right text-[10px] transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-[3rem] p-20 text-center border-2 border-dashed border-gray-200">
                <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                    <i class="fas fa-inbox text-4xl text-gray-200"></i>
                </div>
                <h3 class="text-xl font-black text-gray-800">Aucun espace disponible</h3>
                <p class="text-gray-400 mt-2 text-sm max-w-xs mx-auto font-medium">Vous n'avez pas encore d'espaces de cours assignés par l'administration.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection