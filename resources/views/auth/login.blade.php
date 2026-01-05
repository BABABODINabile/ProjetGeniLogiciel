<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | NomPlatform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="h-full bg-slate-200 flex items-center justify-center p-4">

    <div class="max-w-md w-full">
        <div class="flex items-center justify-center gap-3 mb-8">
            <div class="w-12 h-12 rounded-2xl bg-blue-600 flex items-center justify-center shadow-lg shadow-blue-200">
                <i class="fas fa-graduation-cap text-white text-xl"></i>
            </div>
            <span class="text-2xl font-bold text-gray-900 uppercase tracking-tight">
                Nom<span class="text-blue-600">Platform</span>
            </span>
        </div>

        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
            <div class="p-8">
                <h2 class="text-xl font-bold text-gray-800 mb-2">Bon retour !</h2>
                <p class="text-sm text-slate-500 mb-8 font-semibold uppercase tracking-widest text-[10px]">
                    Identifiez-vous pour accéder à votre espace
                </p>

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 rounded-xl border-l-4 border-red-500 text-red-700 text-sm">
                        <i class="fas fa-exclamation-triangle mr-2"></i> {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-widest mb-2 px-1">Adresse Email</label>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-blue-600 transition-colors">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" name="email" required value="{{ old('email') }}"
                                class="block w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:bg-white focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 transition-all outline-none" 
                                placeholder="nom@exemple.com">
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between mb-2 px-1">
                            <label class="text-[11px] font-bold text-slate-700 uppercase tracking-widest">Mot de passe</label>
                            <a href="#" class="text-[10px] font-bold text-blue-600 uppercase hover:underline">Oublié ?</a>
                        </div>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 group-focus-within:text-blue-600 transition-colors">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" name="password" required
                                class="block w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:bg-white focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 transition-all outline-none" 
                                placeholder="••••••••">
                        </div>
                    </div>

                    <div class="flex items-center px-1">
                        <input type="checkbox" id="remember" name="remember" class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500">
                        <label for="remember" class="ml-2 text-xs font-bold text-slate-600 uppercase tracking-wide">Se souvenir de moi</label>
                    </div>

                    <button type="submit" 
                        class="w-full bg-gray-900 hover:bg-blue-600 text-white font-bold py-4 rounded-2xl shadow-lg transition-all transform active:scale-95 flex items-center justify-center gap-2 group">
                        <span>SE CONNECTER</span>
                        <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </form>
            </div>

            <div class="bg-slate-50 p-6 text-center border-t border-slate-100">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                    &copy; 2025 NomPlatform • Système Sécurisé
                </p>
            </div>
        </div>
    </div>

</body>
</html>