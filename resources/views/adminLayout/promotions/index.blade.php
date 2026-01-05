
@extends('adminLayout.app')

@section('title', 'Promotions')

@section('page_title', 'Gestion des Promotions')

@section('content')


<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-slate-800">Liste des Promotions</h2>
        <a href="{{ route('promotions.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            <i class="fas fa-plus mr-2"></i>Ajouter une Promotion
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse border border-slate-200">
            <thead class="bg-slate-100">
                <tr>
                    <th class="border border-slate-200 px-4 py-2 text-left text-sm font-bold text-slate-700">Libellé</th>
                    <th class="border border-slate-200 px-4 py-2 text-left text-sm font-bold text-slate-700">Filière/Option</th>
                    <th class="border border-slate-200 px-4 py-2 text-left text-sm font-bold text-slate-700">Année</th>
                    <th class="border border-slate-200 px-4 py-2 text-center text-sm font-bold text-slate-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($promotions as $promotion)
                    <tr class="hover:bg-slate-50">
                        <td class="border border-slate-200 px-4 py-2 text-sm text-slate-700">{{ $promotion->libelle }}</td>
                        <td class="border border-slate-200 px-4 py-2 text-sm text-slate-700">{{ $promotion->filiere_option?->option ?? 'N/A' }}</td>
                        <td class="border border-slate-200 px-4 py-2 text-sm text-slate-700">{{ $promotion->year }}</td>
                        <td class="border border-slate-200 px-4 py-2 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('promotions.show', $promotion) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('promotions.edit', $promotion) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('promotions.destroy', $promotion) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition" onclick="return confirm('Êtes-vous sûr ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="border border-slate-200 px-4 py-2 text-center text-sm text-slate-500">Aucune promotion.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
