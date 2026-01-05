@extends('formateurLayout.app')

@section('page_title')
    Espace : {{ $espace->nom }}
@endsection

@section('content')
<div class="space-y-6">
    <div class="bg-gray-900 rounded-[2.5rem] p-8 text-white relative overflow-hidden shadow-2xl shadow-gray-200">
        <div class="absolute top-0 right-0 w-64 h-64 bg-blue-600/20 rounded-full blur-3xl -mr-32 -mt-32"></div>
        
        <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-6">
                <div class="w-20 h-20 rounded-3xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center text-3xl">
                    <i class="fas fa-graduation-cap text-blue-400"></i>
                </div>
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="px-3 py-1 bg-blue-600 text-[10px] font-black uppercase rounded-lg">
                            {{ $espace->matiere->nom }}
                        </span>
                        <span class="px-3 py-1 bg-white/10 text-[10px] font-black uppercase rounded-lg border border-white/10">
                            {{ $espace->promotion->nom }}
                        </span>
                    </div>
                    <h2 class="text-3xl font-black tracking-tight">{{ $espace->nom }}</h2>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="text-right px-6 border-r border-white/10">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Inscrits</p>
                    <p class="text-2xl font-black">{{ $espace->etudiants->count() }}</p>
                </div>
                <div class="text-right">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Moyenne Globale</p>
                    <p class="text-2xl font-black text-blue-400">14.5<span class="text-sm">/20</span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden">
        <div class="flex border-b border-gray-50 bg-gray-50/50 p-2">
            <button onclick="switchTab('students')" id="tab-students" class="tab-btn active-tab flex-1 py-4 text-xs font-black uppercase tracking-widest rounded-2xl transition-all">
                <i class="fas fa-users mr-2"></i> Liste des Apprenants
            </button>
            <button onclick="switchTab('works')" id="tab-works" class="tab-btn flex-1 py-4 text-xs font-black uppercase tracking-widest rounded-2xl transition-all text-gray-400 hover:text-gray-600">
                <i class="fas fa-tasks mr-2"></i> Travaux & Devoirs
            </button>
        </div>

        <div id="content-students" class="tab-content p-6">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-50">
                            <th class="px-6 py-4">Apprenant</th>
                            <th class="px-6 py-4">Matricule</th>
                            <th class="px-6 py-4">Dernière activité</th>
                            <th class="px-6 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($espace->etudiants as $etudiant)
                        <tr class="group hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-gray-900 text-white flex items-center justify-center font-black text-xs">
                                    {{ substr($etudiant->prenom, 0, 1) }}{{ substr($etudiant->nom, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800"><span class="uppercase">{{ $etudiant->nom }}</span> {{ $etudiant->prenom }}</p>
                                    <p class="text-[10px] text-gray-400 font-medium italic">{{ $etudiant->user->email }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-xs font-bold text-gray-500">{{ $etudiant->matricule }}</td>
                            <td class="px-6 py-4">
                                <span class="text-[10px] font-bold text-green-500 bg-green-50 px-2 py-1 rounded-md">Connecté</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button class="p-2 text-gray-400 hover:text-blue-600 transition-colors">
                                    <i class="fas fa-chart-line"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div id="content-works" class="tab-content p-6 hidden">
            <div class="grid grid-cols-1 gap-4">
                @foreach($espace->travails as $travail)
                <div class="p-5 border border-gray-100 rounded-3xl flex items-center justify-between hover:border-blue-200 transition-all">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-gray-50 flex items-center justify-center text-gray-400 group-hover:text-blue-600">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div>
                            <p class="text-sm font-black text-gray-800">{{ $travail->titre }}</p>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ $travail->type }}</p>
                        </div>
                    </div>
                    <a href="{{ route('formateur.travaux.show', $travail->id) }}" class="px-5 py-2 bg-gray-900 text-white text-[10px] font-black uppercase rounded-xl hover:bg-blue-600 transition-colors">
                        Voir les rendus
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
    .active-tab {
        background: white;
        color: #111827; /* gray-900 */
        box-shadow: 0 4px 20px -5px rgba(0,0,0,0.05);
    }
</style>

<script>
    function switchTab(tab) {
        // Cacher tous les contenus
        document.querySelectorAll('.tab-content').forEach(c => c.classList.add('hidden'));
        // Retirer l'état actif des boutons
        document.querySelectorAll('.tab-btn').forEach(b => {
            b.classList.remove('active-tab', 'text-gray-900');
            b.classList.add('text-gray-400');
        });

        // Afficher le bon contenu
        document.getElementById('content-' + tab).classList.remove('hidden');
        // Activer le bon bouton
        const activeBtn = document.getElementById('tab-' + tab);
        activeBtn.classList.add('active-tab', 'text-gray-900');
        activeBtn.classList.remove('text-gray-400');
    }
</script>
@endsection