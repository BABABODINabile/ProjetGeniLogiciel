@extends('adminLayout.app')

@section('title', 'Ajouter un Formateur')
@section('page_title', 'Nouveau Formateur')

@section('content')
<div class="max-w-4xl mx-auto">
    <x-bladewind::button size="small" color="yellow" @class(['p-4', 'font-bold' => true,])  onclick="retour()">
                <i class="fa-solid fa-arrow-left"></i>
            </x-bladewind::button>
    <form action="{{ route('formateurs.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest flex items-center gap-2">
                    <i class="fas fa-user text-blue-600"></i>
                    Informations du formateur
                </h3>
            </div>

            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-widest mb-2 px-1">Nom</label>
                    <input type="text" name="nom" value="{{ old('nom') }}" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl">
                    @error('nom') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-widest mb-2 px-1">Prénom</label>
                    <input type="text" name="prenom" value="{{ old('prenom') }}" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl">
                    @error('prenom') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-widest mb-2 px-1">Adresse Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    <p class="text-[10px] text-slate-400 mt-2 italic px-1">Un mail contenant le mot de passe sera automatiquement envoyé.</p>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-widest mb-2 px-1">Spécialité</label>
                    <input type="text" name="specialite" value="{{ old('specialite') }}"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl">
                    @error('specialite') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="inline-flex items-center gap-2 mt-2">
                        <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4">
                        <span class="text-sm font-bold">Activer le compte</span>
                    </label>
                </div>

            </div>
        </div>

        <div class="flex items-center justify-end gap-4">
            <a href="{{ route('formateurs.index') }}" class="px-6 py-3 text-sm font-bold text-slate-500 uppercase tracking-widest hover:text-slate-800">Annuler</a>
            <button type="submit" class="px-10 py-4 bg-gray-900 hover:bg-blue-600 text-white font-black rounded-2xl shadow-lg">Créer le formateur</button>
        </div>
    </form>
</div>
 <script>
    function retour() {
       //retour
        window.location.href = "{{ route('formateurs.index') }}";
    }
 </script>
@endsection
