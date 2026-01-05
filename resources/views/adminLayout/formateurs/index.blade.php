@extends('adminLayout.app')

@section('title', 'Liste des Formateurs')
@section('page_title', 'Gestion des Formateurs')

@section('content')

<x-bladewind::notification />

@if (session('success-form-store'))
    <script>
        showNotification('Opération réussie', "{{ session('success-form-store') }}");
    </script>
@endif

@php
    $action_icons = [
        [
            'icon'  => 'envelope',
            'tip'   => 'Envoyer mail',
            'color' => 'green',
            'icon_type' => 'solid',
            'button_outline' => false,
            'click' => "sendMessage('{id}')",
        ],
        [
            'tip'   => 'Editer',
            'icon'  => 'pencil-square',
            'color'=>'gray',
            'icon_type' => 'solid',
            'button_outline' => false,
            'click' => "goToEdit('{id}')",
        ],
        [
            'tip'   => 'Supprimer',
            'icon'  => 'trash',
            'color' => 'red',
            'icon_type' => 'solid',
            'button_outline'=>false,
            'click' => "confirmDelete('{id}')",
        ],
    ];

    $column_aliases = [
        'id' => 'id',
        'nom' => 'Nom',
        'prenom' => 'Prénom',
        'email' => 'Email',
        'specialite' => 'Spécialité',
    ];
@endphp



<!-- modal de confirmation de suppression -->
<x-bladewind::modal
    name="delete-formateur"
    type="error"
    title="Confirmation"
    ok_button_action="submitDelete()"
    ok_button_label="Supprimer"
    cancel_button_label="Annuler"
    align_buttons="center"
    >
    Voulez-vous vraiment supprimer ce formateur ?
    <br>
    Cette action est <b class="text-red-600">irréversible</b>.

</x-bladewind::modal>



<div class="space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-800">Liste des formateurs</h1>
        </div>

        <div class="flex items-center gap-3">
            <x-bladewind::button size="small" type="secondary" @class(['p-4', 'font-bold' => true,])>
                <i class="fas fa-file-export mr-1"></i> Exporter
            </x-bladewind::button>

            <x-bladewind::button size="small" @class(['p-4', 'font-bold' => true,]) onclick="goToCreateForm()">
                <i class="fas fa-plus mr-1"></i> Ajouter un formateur
            </x-bladewind::button>
        </div>
    </div>

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
    function goToCreateForm() {
        window.location.href = "{{ route('formateurs.create') }}";
    }

    function goToEdit(formateurId) {
        if (!formateurId) return;

        window.location.href = "{{ route('formateurs.edit', ':id') }}".replace(':id', formateurId);
    }


    function confirmDelete(row) {
        deleteId = row.id ?? row;
        if (!deleteId){
            showNotification('Erreur', 'ID introuvable', 'error');
            return;
        }
        showModal('delete-formateur');
    }


    function submitDelete() {
        if (!deleteId) return;
        const form = document.getElementById('delete-form');
        form.action = "{{ route('formateurs.destroy', ':id') }}".replace(':id', deleteId);
        form.submit();
    }


    function sendMessage(formateurId) {
        if (!formateurId) return;

        const form = document.getElementById('send-mail');
        form.action = "{{ route('formateurs.send_credentials', ':id') }}".replace(':id', formateurId);
        form.submit();
    }
</script>

@endsection
