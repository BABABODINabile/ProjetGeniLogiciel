@extends('adminLayout.app')

@section('page_title', 'Modifier un espace pédagogique')

@section('content')

<x-bladewind::notification/>


<x-bladewind::card class="max-w-3xl mx-auto">

    <form method="POST" action="{{ route('espaces.update', $espace) }}">
        @csrf
        @method('PUT')

        {{-- Nom --}}
        <x-bladewind::input
            name="nom"
            label="Nom de l’espace"
            selected_value="{{ old('nom', $espace->nom) }}"
            required />

        {{-- Description --}}
        <x-bladewind::textarea
            name="description"
            label="Description"
            rows="4"
            selected_value="{{ old('description', $espace->description) }}">
            
        </x-bladewind::textarea>

         {{-- Promotion --}}
        <x-bladewind::select
            name="promotion_id"
            label="Promotion"
            label_key="libelle"
            value_key="id"
            :data="$promotions"
            selected_value="{{ old('promotion_id', $espace->promotion->id ?? '') }}" />

        {{-- Matière --}}
        <x-bladewind::select
            name="matiere_id"
            label="Matière"
            label_key="libelle"
            value_key="id"
            :data="$matieres"
            selected_value="{{ old('matiere_id', $espace->matiere->id) }}"  required/>

        {{-- Formateur --}}
        <x-bladewind::select
            name="formateur_id"
            label="Formateur"
            label_key="NomPrenom"
            value_key="id"
            :data="$formateurs"
            selected_value="{{ old('formateur_id', $espace->formateur->id ?? '' ) }}" />


        <div class="flex justify-end gap-3 mt-6">
            <x-bladewind::button type="secondary"
                onclick="cancel()">
                Annuler
            </x-bladewind::button>

            <x-bladewind::button type="primary" can_submit="true">
                Enregistrer
            </x-bladewind::button>
        </div>
    </form>

</x-bladewind::card>

<script>
    function cancel() {
       //annuler
        window.location.href = `/admin/espaces/index`;
    }
</script>
@endsection
