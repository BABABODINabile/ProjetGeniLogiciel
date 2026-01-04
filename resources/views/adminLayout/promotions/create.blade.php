@extends('adminLayout.app')  

@section('title', 'Créer une Promotion')

@section('page_title', 'Ajouter une Promotion')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-bold text-slate-800 mb-6">Nouvelle Promotion</h2>

    <!-- Affichage des erreurs -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulaire -->
    <form action="{{ route('promotions.store') }}" method="POST">
        @csrf  
        <div class="mb-4">
            <label for="libelle" class="block text-sm font-medium text-slate-700">Libellé</label>
            <input type="text" name="libelle" id="libelle" value="{{ old('libelle') }}" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="filiere_option_id" class="block text-sm font-medium text-slate-700">Filière/Option</label>
            <select name="filiere_option_id" id="filiere_option_id" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">Sélectionnez une filière</option>
                @foreach($filiereOptions as $option)
                    <option value="{{ $option->id }}" {{ old('filiere_option_id') == $option->id ? 'selected' : '' }}>{{ $option->option }}</option>  // Changez 'nom' à 'option'
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="year" class="block text-sm font-medium text-slate-700">Année</label>
            <input type="number" name="year" id="year" value="{{ old('year') }}" min="1900" max="{{ date('Y') + 10 }}" class="mt-1 block w-full border border-slate-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('promotions.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">Annuler</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Créer</button>
        </div>
    </form>
</div>
@endsection