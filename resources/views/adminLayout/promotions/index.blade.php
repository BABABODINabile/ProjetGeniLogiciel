@extends('adminLayout.app')

@section('title', 'Liste des Promotions')
@section('page_title', 'Gestion des Promotions')

@section('content')

<x-bladewind::notification />

@php
    $action_icons = [
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
        'libelle' => 'Libellé',
        'filiere' => 'Filière',
        'year' => 'Année',
    ];
@endphp

@if (session('success-promo-store'))
    <script>showNotification('Succès', "{{ session('success-promo-store') }}")</script>
@endif
@if (session('error-promo-store'))
    <script>showNotification('Erreur', "{{ session('error-promo-store') }}", 'error')</script>
@endif
<!-- modal de confirmation de suppression -->
<x-bladewind::modal
    name="delete-promotion"
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
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-800">Liste des promotions</h1>
        </div>

        <div class="flex items-center gap-3">
            <x-bladewind::button size="small" type="secondary" @class(['p-4', 'font-bold' => true,])>
                <i class="fas fa-file-export mr-1"></i> Exporter
            </x-bladewind::button>

            <x-bladewind::button size="small" @class(['p-4', 'font-bold' => true,]) onclick="goToCreate()">
                <i class="fas fa-plus mr-1"></i> Ajouter une promotion
            </x-bladewind::button>
        </div>
    </div>

    <x-bladewind::card class="!p-0">
        <x-bladewind::table 
            striped="true" 
            hoverable="true" 
            searchable="true" 
            search_placeholder="Rechercher par libellé..." 
            :column_aliases="$column_aliases"  
            :action_icons="$action_icons" 
            :data="$data" 
            has_shadow="true">
        </x-bladewind::table>
    </x-bladewind::card>

</div>

<form id="delete-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
    function goToCreate() {
        window.location.href = "{{ route('promotions.create') }}";
    }

    function goToEdit(promoId) {
        if (!promoId) return;

        window.location.href = "{{ route('promotions.edit', ':id') }}".replace(':id', promoId);
    }

    function confirmDelete(row) {
        deleteId = row.id ?? row;
        if (!deleteId){
            showNotification('Erreur', 'ID introuvable', 'error');
            return;
        }
        showModal('delete-promotion');
    }

     function submitDelete() {
        if (!deleteId) return;
        const form = document.getElementById('delete-form');
        form.action = "{{ route('promotions.destroy', ':id') }}".replace(':id', deleteId);
        form.submit();
    }
    
</script>

@endsection
