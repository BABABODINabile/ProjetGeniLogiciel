@extends('formateurLayout.app')

@section('page_title', 'Assignation par sélection')

@section('content')
<div class="max-w-5xl mx-auto">
    <form action="{{ route('formateur.travaux.lancer_selection', $travail->id) }}" method="POST">
        @csrf
        @method('PUT')

       <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-4">
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                        <div>
                            <h3 class="font-black text-slate-800 uppercase text-xs tracking-widest">Élèves de l'espace</h3>
                            <p class="text-[10px] text-slate-500 font-bold uppercase mt-1">Cochez les destinataires</p>
                        </div>
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <span class="text-[10px] font-black text-slate-400 group-hover:text-blue-600 transition-colors uppercase">Tout cocher</span>
                            <input type="checkbox" id="selectAll" class="w-5 h-5 rounded-lg border-slate-300 text-blue-600 focus:ring-blue-600/20">
                        </label>
                    </div>

                    <div class="p-6 bg-slate-50/50 border-b border-slate-100">
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-search text-slate-400 group-focus-within:text-blue-600 transition-colors"></i>
                            </div>
                            <input type="text" id="studentSearch" 
                                placeholder="Rechercher un apprenant par nom ou matricule..." 
                                class="w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-600/5 focus:border-blue-600 outline-none transition-all font-medium text-sm shadow-sm">
                        </div>
                    </div>

                    <div class="max-h-[500px] overflow-y-auto custom-scrollbar">
                        <table class="w-full text-left">
                            <tbody class="divide-y divide-slate-50" id="studentTable">
                                @foreach($travail->espace->etudiants as $etudiant)
                                <tr class="hover:bg-blue-50/30 transition-colors student-row">
                                    <td class="px-6 py-4 w-10">
                                        <input type="checkbox" name="etudiant_ids[]" value="{{ $etudiant->id }}" 
                                            class="student-checkbox w-5 h-5 rounded-lg border-slate-300 text-blue-600 focus:ring-blue-600/20">
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-xl bg-slate-100 flex items-center justify-center text-[10px] font-black text-slate-500 uppercase">
                                                {{ substr($etudiant->prenom, 0, 1) }}{{ substr($etudiant->nom, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-slate-700 leading-none student-name">
                                                    {{ $etudiant->prenom }} {{ $etudiant->nom }}
                                                </p>
                                                <p class="text-[10px] text-slate-400 font-medium mt-1 student-matricule">
                                                    {{ $etudiant->matricule }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div id="noResults" class="hidden p-12 text-center text-slate-400">
                            <i class="fas fa-search-minus text-2xl mb-2"></i>
                            <p class="text-xs font-bold uppercase tracking-widest">Aucun apprenant trouvé</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm space-y-6">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Date limite de rendu</label>
                        <input type="datetime-local" name="date_fin" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-600/20 outline-none font-bold text-slate-700">
                    </div>

                    <div class="p-4 bg-blue-50 rounded-2xl border border-blue-100">
                        <p class="text-[10px] text-blue-600 font-black uppercase mb-1">Résumé</p>
                        <p class="text-xs text-blue-800 font-medium leading-relaxed">
                            Le travail sera créé individuellement pour chaque élève coché.
                        </p>
                    </div>

                    <button type="submit" class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-black uppercase text-xs tracking-widest transition-all shadow-lg shadow-blue-100">
                        Assigner à la sélection
                    </button>
                </div>
            </div>
        </div>

<script>
    // Script pour tout cocher / décocher
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.student-checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });

    document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('studentSearch');
    const rows = document.querySelectorAll('.student-row');
    const noResults = document.getElementById('noResults');

    searchInput.addEventListener('input', function(e) {
        const term = e.target.value.toLowerCase().trim();
        let hasVisibleRows = false;

        rows.forEach(row => {
            const name = row.querySelector('.student-name').textContent.toLowerCase();
            const matricule = row.querySelector('.student-matricule').textContent.toLowerCase();

            if (name.includes(term) || matricule.includes(term)) {
                row.style.display = ""; // Affiche la ligne
                hasVisibleRows = true;
            } else {
                row.style.display = "none"; // Cache la ligne
            }
        });

        // Afficher le message "Aucun résultat" si besoin
        if (hasVisibleRows) {
            noResults.classList.add('hidden');
        } else {
            noResults.classList.remove('hidden');
        }
    });
});
</script>
@endsection