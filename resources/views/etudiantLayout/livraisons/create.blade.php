@extends('etudiantLayout.app')

@section('page_title', 'Livraison de travail')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="bg-white rounded-[2.5rem] p-8 border border-gray-100 shadow-sm">
        <div class="mb-8">
            <h2 class="text-2xl font-black text-gray-900">Déposer mon travail</h2>
            <p class="text-sm text-gray-400 font-medium">Travail : <span class="text-blue-600 font-bold">{{ $assignation->travail->titre}}</span></p>
        </div>

        <form action="{{ route('etudiant.livraison.store', $assignation->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Fichier joint (optionnel)</label>
                <div class="relative group">
                    {{-- input file overlay (invisible) --}}
                    <input id="fileInput" type="file" name="fichier" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">

                    {{-- visible drop zone / click area --}}
                    <div id="dropZone" class="border-2 border-dashed border-gray-200 rounded-2xl p-8 text-center group-hover:border-blue-400 transition-all">
                        <i class="fas fa-cloud-upload-alt text-gray-300 text-xl mb-2"></i>
                        <p class="text-[10px] font-bold text-gray-500 uppercase">Glissez un fichier ou cliquez ici</p>
                        <div id="fileName" class="mt-3 text-sm text-gray-600 hidden"></div>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Votre message ou réponse textuelle</label>
                <textarea name="message" rows="5" 
                    placeholder="Saisissez votre réponse ici ou ajoutez un commentaire à votre fichier..."
                    class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-4 focus:ring-blue-600/5 focus:border-blue-600 outline-none transition-all text-sm font-medium"></textarea>
            </div>

            <button type="submit" class="w-full py-4 bg-gray-900 text-white rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-blue-600 transition-all">
                Confirmer la livraison
            </button>
        </form>
    </div>
</div>

<script>
    (function() {
        const fileInput = document.getElementById('fileInput');
        const fileNameDiv = document.getElementById('fileName');
        const dropZone = document.getElementById('dropZone');

        if (!fileInput || !fileNameDiv || !dropZone) return;

        fileInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                fileNameDiv.innerText = "Fichier sélectionné : " + this.files[0].name;
                fileNameDiv.classList.remove('hidden');
                dropZone.classList.add('border-blue-400', 'bg-blue-50');
            } else {
                fileNameDiv.innerText = '';
                fileNameDiv.classList.add('hidden');
                dropZone.classList.remove('border-blue-400', 'bg-blue-50');
            }
        });

        // Add drag over effect for better UX
        dropZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            dropZone.classList.add('border-blue-400', 'bg-blue-50');
        });
        dropZone.addEventListener('dragleave', function(e) {
            dropZone.classList.remove('border-blue-400', 'bg-blue-50');
        });

        // Support dropping files into the dropZone
        dropZone.addEventListener('drop', function(e) {
            e.preventDefault();
            dropZone.classList.remove('border-blue-400', 'bg-blue-50');
            const files = e.dataTransfer.files;
            if (files && files.length > 0) {
                // assign files to the hidden input
                // Note: DataTransfer cannot be assigned directly to input.files in all browsers; use FileList workaround where supported
                try {
                    fileInput.files = files;
                } catch (err) {
                    // Fallback: create a DataTransfer and set
                    const dataTransfer = new DataTransfer();
                    for (let i = 0; i < files.length; i++) dataTransfer.items.add(files[i]);
                    fileInput.files = dataTransfer.files;
                }
                const f = fileInput.files[0];
                if (f) {
                    fileNameDiv.innerText = "Fichier sélectionné : " + f.name;
                    fileNameDiv.classList.remove('hidden');
                }
            }
        });
    })();
</script>
@endsection