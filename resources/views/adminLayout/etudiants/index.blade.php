@extends('adminLayout.app')

@section('title', 'Liste des Étudiants')
@section('page_title', 'Gestion des Étudiants')

@section('content')

@php
    // define the action icons array

        $action_icons = [
            [
                'icon'  => 'envelope',
                'tip'   => 'Envoyer le mail',
                'color' => 'green',
                'icon_type' => 'solid', // default is outline
                'button_outline' => false,
                'click' => "sendMessage('{id}')",
            ],
            [
                'tip'   => 'Editer',
                'icon'  => 'pencil-square',
                'color'=>'gray',
                'button_outline' => false,
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
            'id' => 'id',
            'first_name' => 'Nom',
            'last_name' => 'Prénom',
            'filiere_option'=>'Filière'
        ];



@endphp
<x-bladewind::notification />

@if (session('success-etu-store'))
    <script>
        showNotification(
            'Opération réussie',
            "{{ session('success-etu-store') }}"
        );
    </script>
@endif
@if (session('error-etu-store'))
    <script>
        showNotification(
            'Création échouée',
            "{{ session('error-etu-store') }}",
            'error'
        );
    </script>
@endif

<!-- modal de confirmation de suppression -->
<x-bladewind::modal
    name="delete-etudiant"
    type="error"
    title="Confirmation"
    ok_button_action="submitDelete()"
    ok_button_label="Supprimer"
    cancel_button_label="Annuler"
    align_buttons="center"
    >
    Voulez-vous vraiment supprimer cet étudiant ?
    <br>
    Cette action est <b class="text-red-600">irréversible</b>.

</x-bladewind::modal>



<div class="space-y-8">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-800">Liste des étudiants</h1>
            
        </div>

        <div class="flex items-center gap-3">
            <x-bladewind::button size="small" type="secondary" @class(['p-4', 'font-bold' => true,])>
                <i class="fas fa-file-export mr-1"></i> Exporter
            </x-bladewind::button>

            <x-bladewind::button size="small" @class(['p-4', 'font-bold' => true,]) onclick="goToStoreStu()">
                <i class="fas fa-plus mr-1"></i> Ajouter un étudiant
            </x-bladewind::button>
        </div>
    </div>

    {{-- ================= TABLE ================= --}}
    <x-bladewind::card class="!p-0">
        <x-bladewind::table 
        striped="true" 
        hoverable="true" 
        searchable="true" 
        search_placeholder="Rechercher par nom..." 
        :column_aliases="$column_aliases"  
        :action_icons="$action_icons" 
        :data="$data" 
        has_shadow="true">
        </x-bladewind::table>
    </x-bladewind::card>

</div>

<form id="send-mail" method="POST" style="display: none;">
        @csrf
</form>

<form id="delete-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
    function goToStoreStu() {
    // On passe l'ID directement via Blade
    window.location.href = "{{ route('etudiants.create')}}";
    }


    function goToEdit(etudiantId) {
        if (!etudiantId) return;

        window.location.href = "{{ route('etudiants.edit', ':id') }}".replace(':id', etudiantId);
    }
    

    function confirmDelete(row) {
        deleteId = row.id ?? row;
        if (!deleteId){
            showNotification('Erreur', 'ID introuvable', 'error');
            return;
        }

        showModal('delete-etudiant');
    }
    function submitDelete() {
        if (!deleteId) return;
        const form = document.getElementById('delete-form');
        form.action = "{{ route('etudiant.destroy', ':id') }}".replace(':id', deleteId);
        form.submit();
    }
    function sendMessage(etudiantId) {
        if (!etudiantId) return;

        const form = document.getElementById('send-mail');
        form.action = "{{ route('etudiants.send_credentials', ':id') }}".replace(':id', etudiantId);
        form.submit();
    }
</script>
@endsection
