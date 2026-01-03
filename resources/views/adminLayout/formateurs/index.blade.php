@extends('adminLayout.app')

@section('title', 'Liste des Formateurs')
@section('page_title', 'Gestion des Formateurs')

@section('content')

<x-bladewind::notification />

@if (session('success-form-store'))
    <script>
        showNotification('Création réussie', "{{ session('success-form-store') }}");
    </script>
@endif

@php
    $action_icons = [
        [
            'icon'  => 'envelope',
            'tip'   => 'Envoyer mail',
            'color' => 'green',
            'click' => "", // à implémenter si besoin
        ],
        [
            'tip'   => 'Editer',
            'icon'  => 'pencil-square',
            'color'=>'gray',
            'click' => "redirect('/admin/formateurs/edit/{id}')",
        ],
        [
            'tip'   => 'Supprimer',
            'icon'  => 'trash',
            'color' => 'red',
            'click' => "deleteUser({id}, '{nom}')",
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

<script>
    function goToCreateForm() {
        window.location.href = "{{ route('formateur.create') }}";
    }
</script>

@endsection
