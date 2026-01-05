@extends('adminLayout.app')

@section('page_title', 'Gestion des espaces pédagogiques')

@section('content')

@php
    // define the action icons array

        $action_icons = [
            [
                'tip'   => 'Ajouter à l\'espace',
                'icon'  => 'plus',
                'color'=>'blue',
                'button_outline' => false,
                'click' => "submitAdd('{id}')",
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

@if (session('success-etu-add'))
    <script>
        showNotification(
            'Ajout réussi',
            "{{ session('success-etu-add') }}"
        );
    </script>
@endif
@if (session('info-etu-add'))
    <script>
        showNotification(
            'Ajout échoué',
            "{{ session('info-etu-add') }}",
            'error'
        );
    </script>
@endif
<div class="space-y-8">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <x-bladewind::button size="small" color="yellow" @class(['p-4', 'font-bold' => true,])  onclick="retour()">
                <i class="fa-solid fa-arrow-left"></i>
            </x-bladewind::button>
        <div>
            <h1 class="text-2xl font-black text-slate-800">Liste  de tous les étudiants</h1>
            
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

<form action="{{ route('espaces.inscrire-etudiant', $espace->id) }}" method="POST" id="add-form">
    <input type="hidden" name="etudiant_id" id="id">
    @csrf
</form>

<script>
    let addId = null;
    function submitAdd(row) {
        addId = row.id ?? row;
        if (!addId) return;
        const form = document.getElementById('add-form');
        const id=document.getElementById('id');
        id.value=addId;
        form.submit();
    }
</script>

<script>
    function retour() {
       //retour
        window.location.href = "{{ route('espaces.show', $espace->id) }}";
    }
</script>
@endsection
