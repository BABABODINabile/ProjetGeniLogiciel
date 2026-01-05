@extends('adminLayout.app')

@section('title', 'Liste des Membres - Administration')
@section('page_title', 'Gestion des Membres de l\'Administration')

@section('content')

<x-bladewind::notification />

@php
    $action_icons = [
        [
            'icon'  => 'envelope',
            'tip'   => 'Envoyer accès',
            'color' => 'green',
            'icon_type' => 'solid',
            'button_outline' => false,
            'click' => "sendMessage('{id}')",
        ],
        [
            'tip' => 'Editer',
            'icon' => 'pencil-square',
            'color' => 'gray',
            'icon_type' => 'solid',
            'button_outline' => false,
            'click' => "goToEdit('{id}')",
        ],
        [
            'tip' => 'Supprimer',
            'icon' => 'trash',
            'color' => 'red',
            'icon_type' => 'solid',
            'button_outline' => false,
            'click' => "confirmDelete('{id}')",
        ],
    ];

    $column_aliases = [
        'id' => 'id',
        'nom' => 'Nom',
        'prenom' => 'Prénom',
        'email' => 'Email',
        'fonction' => 'Fonction',
    ];
@endphp

@if (session('success-admin-store'))
    <script>showNotification('Opération réussie', "{{ session('success-admin-store') }}")</script>
@endif
@if (session('error-admin-store'))
    <script>showNotification('Opération échouée', "{{ session('error-admin-store') }}", 'error')</script>
@endif

<!-- modal de confirmation de suppression -->
<x-bladewind::modal
    name="delete-administration"
    type="error"
    title="Confirmation"
    ok_button_action="submitDelete()"
    ok_button_label="Supprimer"
    cancel_button_label="Annuler"
    align_buttons="center"
    >
    Voulez-vous vraiment supprimer ce membre de l'administration ?
    <br>
    Cette action est <b class="text-red-600">irréversible</b>.

</x-bladewind::modal>

<div class="space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-800">Membres de l'Administration</h1>
        </div>

        <div class="flex items-center gap-3">
            <x-bladewind::button size="small" type="secondary" @class(['p-4', 'font-bold' => true,])>
                <i class="fas fa-file-export mr-1"></i> Exporter
            </x-bladewind::button>

            <x-bladewind::button size="small" @class(['p-4', 'font-bold' => true,]) onclick="goToCreate()">
                <i class="fas fa-plus mr-1"></i> Ajouter un membre
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
    let deleteId = null;

    function goToCreate() {
        window.location.href = "{{ route('administrations.create') }}";
    }

    function goToEdit(adminId) {
        if (!adminId) return;
        window.location.href = "{{ route('administrations.edit', ':id') }}".replace(':id', adminId);
    }

    function confirmDelete(row) {
        deleteId = row.id ?? row;
        if (!deleteId) {
            showNotification('Erreur', 'ID introuvable', 'error');
            return;
        }
        showModal('delete-administration');
    }

    function submitDelete() {
        if (!deleteId) return;
        const form = document.getElementById('delete-form');
        form.action = "{{ route('administrations.destroy', ':id') }}".replace(':id', deleteId);
        form.submit();
    }

    function sendMessage(adminId) {
        if (!adminId) return;
        const form = document.getElementById('send-mail');
        form.action = "{{ route('administrations.send_credentials', ':id') }}".replace(':id', adminId);
        form.submit();
    }
</script>

@endsection
