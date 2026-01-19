@extends('adminLayout.app')

@section('page_title', 'Gestion des espaces pédagogiques') 

@section('content')


@php
    // define the action icons array

        $action_icons = [
            [
                'icon'  => 'eye',
                'tip'   => 'voir les étudiants',
                'color' => 'green',
                'icon_type' => 'solid', // default is outline
                'button_outline' => false,
                'click' => "goToShow('{id}')",
            ],
            [
                'tip'   => 'Editer',
                'icon'  => 'pencil-square',
                'color'=>'gray',
                'button_outline' => false,
                'color'=>'gray',
                'icon_type' => 'solid',
                'click' => "goToEdit('{id}')",
            ],
            [
                'tip'   => 'Supprimer',
                'icon'  => 'trash',
                'color' => 'red',
                'button_outline'=>false,
                'icon_type' => 'solid',
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
@if (session('success'))
    <script>
        showNotification(
            'Création réussie',
            "{{ session('success') }}"
        );
    </script>
@endif

<!-- modal de confirmation de suppression -->
<x-bladewind::modal
    name="delete-espace"
    type="error"
    title="Confirmation"
    ok_button_action="submitDelete()"
    ok_button_label="Supprimer"
    cancel_button_label="Annuler"
    align_buttons="center"
    >
    Voulez-vous vraiment supprimer cet espace pédagogique ?
    <br>
    Cette action est <b class="text-red-600">irréversible</b>.

</x-bladewind::modal>









    <div class="space-y-8">
    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-800">Espaces pédagogiques </h1>
            
        </div>

        <div class="flex items-center gap-3">
            <x-bladewind::button size="small" type="secondary" @class(['p-4', 'font-bold' => true,])>
                <i class="fas fa-file-export mr-1"></i> Exporter
            </x-bladewind::button>

            <x-bladewind::button size="small" @class(['p-4', 'font-bold' => true,]) onclick="goToCreateForm()">
                <i class="fas fa-plus mr-1"></i> Créer un espace
            </x-bladewind::button>
        </div>
    </div>

    {{-- ================= TABLE ================= --}}
            <x-bladewind::card class="!p-0">
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
                </x-bladewind::card>

</div>
{{-- ================= Form de suppression ================= --}}

    <form id="delete-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
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

   
</script>

<script>
    let deleteId = null;
    const deleteRoute = "{{ route('espaces.destroy', ':id') }}";

    function confirmDelete(row) {
        deleteId = row.id ?? row;

        if (!deleteId) {
            showNotification('Erreur', 'ID introuvable', 'error');
            return;
        }

        showModal('delete-espace');
    }

    function submitDelete() {
        if (!deleteId) return;

        const form = document.getElementById('delete-form');
        form.action = deleteRoute.replace(':id', deleteId);
        form.submit();
    }

    function goToCreateForm() {
        window.location.href = "{{ route('espaces.create') }}";
    }
</script>






@endsection
