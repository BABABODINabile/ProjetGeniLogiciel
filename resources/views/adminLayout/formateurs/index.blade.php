@extends('adminLayout.app')

@section('page_title', 'LISTE DES FORMATEURS')

@section('content')
<div class="container mx-auto p-4">
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">NOM</th>
                    <th class="px-4 py-2 text-left">PRÉNOM</th>
                    <th class="px-4 py-2 text-left">EMAIL</th>
                    <th class="px-4 py-2 text-left">SPÉCIALITÉ</th>
                    <th class="px-4 py-2 text-right">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($formateurs as $formateur)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $formateur->nom }}</td>
                        <td class="px-4 py-2">{{ $formateur->prenom }}</td>
                        <td class="px-4 py-2">{{ $formateur->user->email }}</td>
                        <td class="px-4 py-2">{{ $formateur->specialite }}</td>
                        <td class="px-4 py-2 text-right">
                            <a href="#" class="text-blue-600 hover:text-blue-800 mr-3">Modifier</a>
                            <a href="#" class="text-red-600 hover:text-red-800">Supprimer</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-2 text-center text-gray-500">
                            Aucun formateur enregistré
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <a href="{{ route('formateurs.create') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Ajouter un formateur
        </a>
    </div>
</div>
@endsection
