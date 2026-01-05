@extends('adminLayout.app')

@section('title', 'Éditer une Promotion')
@section('page_title', 'Édition Promotion')

@section('content')
<div class="max-w-4xl mx-auto px-4">
    <form action="{{ route('promotions.update', $promotion->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-4 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest flex items-center gap-2">
                    <i class="fas fa-layer-group text-blue-600"></i>
                    Informations Promotion
                </h3>
            </div>

            <div class="p-6 grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-widest mb-1 px-1">Libellé</label>
                    <input type="text" name="libelle" value="{{ old('libelle', $promotion->libelle) }}" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all text-sm">
                    @error('libelle') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-widest mb-1 px-1">Filière / Option</label>
                    <select name="filiere_option_id" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all text-sm">
                        @foreach($filieres as $f)
                            <option value="{{ $f->id }}" {{ old('filiere_option_id', $promotion->filiere_option_id) == $f->id ? 'selected' : '' }}>{{ $f->option }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-700 uppercase tracking-widest mb-1 px-1">Année</label>
                    <input type="number" name="year" value="{{ old('year', $promotion->year) }}" required min="2000" max="2100"
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 outline-none transition-all text-sm">
                    @error('year') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="pt-4 flex items-center justify-end gap-4">
                    <a href="{{ route('promotions.index') }}" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest hover:text-slate-600 transition">
                        Annuler
                    </a>
                    <button type="submit" class="px-6 py-3 bg-gray-900 hover:bg-blue-600 text-white font-black rounded-xl shadow-lg transition-all transform active:scale-95 uppercase tracking-widest text-[10px]">
                        Enregistrer les modifications
                    </button>
                </div>
            </div>
        </div>

    </form>
</div>
@endsection
