@extends('adminLayout.app')

@section('page_title', 'Gestion des espaces pédagogiques') 

@section('content')


    @php
        // define the action icons array

            $action_icons = [
                [
                    'tip'   => 'Retirer de l\'espace',
                    'icon'  => 'x-mark',
                    'color' => 'red',
                    'button_outline'=>false,
                    'click' => "confirmDelete('{id}')",
                ],
            ];

            $column_aliases = [
            
            ];
    @endphp

    <x-bladewind::notification />

    @if (session('status_delete'))
        <script>
            showNotification(
                'Suppression réussie',
                "{{ session('status_delete') }}"
            );
        </script>
    @endif
    @if (session('status_update'))
        <script>
            showNotification(
                'Mise à jour réussie',
                "{{ session('status_update') }}"
            );
        </script>
    @endif
    @if (session('success-etu-reti'))
        <script>
            showNotification(
                'Retrait réussi',
                "{{ session('success-etu-reti') }}"
            );
        </script>
    @endif
    @if (session('error-etu-reti'))
        <script>
            showNotification(
                'Mise à jour réussie',
                "{{ session('error-etu-reti') }}",
                "error"
            );
        </script>
    @endif

    <!-- modal de confirmation de suppression -->
    <x-bladewind::modal
        name="delete-espace"
        type="error"
        title="Confirmation"
        ok_button_action="submitDelete()"
        ok_button_label="Retirer"
        cancel_button_label="Annuler"
        align_buttons="center"
        >
        Voulez-vous vraiment retirer cet étudiant de l'espace pédagogique ?
        <br>
        Cette action est <b class="text-red-600">irréversible</b>.

    </x-bladewind::modal>





    <div class="space-y-8">
        {{-- ================= HEADER ================= --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <x-bladewind::button size="small" color="yellow" @class(['p-4', 'font-bold' => true,])  onclick="retour()">
                    <i class="fa-solid fa-arrow-left"></i>
                </x-bladewind::button>
            <div>
                
                <h1 class="text-2xl font-black text-slate-800">Espaces pédagogiques </h1>
                
            </div>

            <div class="flex items-center gap-3">
                <x-bladewind::button size="small" type="secondary" @class(['p-4', 'font-bold' => true,])>
                    <i class="fas fa-file-export mr-1"></i> Exporter
                </x-bladewind::button>

                <x-bladewind::button size="small" @class(['p-4', 'font-bold' => true,]) onclick="goToAddStu()">
                    <i class="fas fa-plus mr-1"></i> Ajouter un étudiant
                </x-bladewind::button>
            </div>
        </div>

        {{-- ================= TABLE ================= --}}
       
            <x-bladewind::table 
                striped="true" 
                hoverable="true" 
                searchable="true" 
                sortable="true"
                search_placeholder="Rechercher par nom..." 
                :column_aliases="$column_aliases"  
                :action_icons="$action_icons" 
                :data="$data" 
                has_shadow="true">
            </x-bladewind::table>


    </div>
{{-- ================= Form de retrait d'étudiant de l'espace ================= --}}

   <form id="delete-form" method="POST">
        @csrf
        <input type="hidden" name="etudiant_id" id="etudiant_id_input">
   </form>


<script>
    
    function goToEdit(row) {
        // si row est un objet
        const id = row.id ?? row;
        window.location.href = `/admin/espaces/edit/${id}`;
    }

    function goToShow(row) {
        const  id=row.id ?? row;
        window.location.href=`/admin/espaces/show/${id}`;
        
    }


    function goToAddStu() {
    // On passe l'ID directement via Blade
    window.location.href = "{{ route('espaces.addStu', $espace->id) }}";
    }
</script>



<script>
    let studentIdToDelete = null;
    // La route reste fixe puisque c'est l'espace qui est dans l'URL
    const deleteRoute = "{{ route('espaces.retire-etudiant', $espace->id) }}";

    function confirmDelete(id) {
        studentIdToDelete = id;

        if (!studentIdToDelete) {
            // Si tu as un système de notification maison
            if(typeof showNotification === 'function') showNotification('Erreur', 'ID introuvable', 'error');
            return;
        }

        // Affiche ton modal de confirmation
        showModal('delete-espace');
    }

    function submitDelete() {
        if (!studentIdToDelete) return;

        const form = document.getElementById('delete-form');
        const input = document.getElementById('etudiant_id_input');
        
        form.action = deleteRoute;
        input.value = studentIdToDelete; // On place l'ID de l'étudiant dans le champ caché
        
        form.submit();
    }
</script>


<script>
    function retour() {
       //retour
        window.location.href = `/admin/espaces/index`;
    }
</script>



@endsection
