@extends('adminLayout.app')

@section('page_title', 'LISTE DES FORMATEURS')

@section('content')
<div class="container mx-auto p-4">
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Liste des formateurs</h1>
        <a href="{{ route('formateurs.create') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Ajouter un formateur
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">NOM</th>
                    <th class="px-4 py-2 text-left">PRÉNOM</th>
                    <th class="px-4 py-2 text-left">EMAIL</th>
                    <th class="px-4 py-2 text-left">SPÉCIALITÉ</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($formateurs as $formateur)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $formateur->nom }}</td>
                        <td class="px-4 py-2">{{ $formateur->prenom }}</td>
                        <td class="px-4 py-2">{{ $formateur->user->email }}</td>
                        <td class="px-4 py-2">{{ $formateur->specialite }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-center text-gray-500">
                            Aucun formateur enregistré
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
