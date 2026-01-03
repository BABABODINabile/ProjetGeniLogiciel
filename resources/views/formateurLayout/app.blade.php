<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formateur | @yield('title')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .sidebar { width: 18rem; transition: width 0.3s ease; }
        .sidebar.collapsed { width: 5rem; }
        .sidebar.collapsed .nav-text, .sidebar.collapsed .section-title, .sidebar.collapsed .brand-text {
            opacity:0; width: 0; overflow: hidden; white-space: nowrap;
        }
        .sidebar.collapsed .nav-item { justify-content: center; padding-left: 0; padding-right: 0; }

        .nav-item {
            display: flex; align-items: center; gap: 1rem; padding: 0.75rem 1rem;
            border-radius: 0.75rem; font-size: 0.875rem; font-weight: bold;
            color: white; margin-bottom: 1rem; transition: background 0.5s ease, color 0.2s ease;
        }
        .nav-item:hover { background-color: white; color: #2563eb; }
        .nav-item.active { background-color: #2563eb; color: #ffffff; }

        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }
    </style>
</head>

<body class="h-full bg-slate-200 text-slate-700 overflow-hidden">

    <x-bladewind::modal
        name="logout"
        type="warning"
        title="Déconnexion"
        ok_button_action="logout()"
        ok_button_label="Se déconnecter"
        cancel_button_label="Annuler"
        align_buttons="center">
        Voulez-vous vraiment quitter votre espace formateur ?
    </x-bladewind::modal>

    <div class="flex h-screen">

        <aside id="sidebar" class="sidebar bg-gray-900 border-r border-slate-100 flex flex-col">
            <div class="h-16 flex items-center gap-3 px-4 border-b border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center">
                    <i class="fas fa-graduation-cap text-white"></i>
                </div>
                <span class="brand-text font-bold text-white uppercase tracking-tight">
                    Nom<span class="text-blue-600">Platform</span>
                </span>
            </div>

            <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-6">
                <div>
                    <p class="section-title px-3 mb-3 text-[10px] font-bold text-slate-200 uppercase tracking-widest">
                        Enseignement
                    </p>
                    <a href="{{ route('formateur.espaces.index') }}" class="nav-item {{ request()->routeIs('formateur.espaces.*') ? 'active' : '' }}">
                        <i class="fas fa-chalkboard w-5 text-center"></i>
                        <span class="nav-text">Mes Espaces</span>
                    </a>
                    <a href="{{ route('formateur.travaux.index') }}" class="nav-item {{ request()->routeIs('formateur.travaux.*') ? 'active' : '' }}">
                        <i class="fas fa-tasks w-5 text-center"></i>
                        <span class="nav-text">Travaux</span>
                    </a>
                </div>

                <div>
                    <p class="section-title px-3 mb-3 text-[10px] font-bold text-slate-200 uppercase tracking-widest">
                        Ressources
                    </p>
                    <a href="#" class="nav-item">
                        <i class="fas fa-users w-5 text-center"></i>
                        <span class="nav-text">Mes Étudiants</span>
                    </a>
                    <a href="#" class="nav-item">
                        <i class="fas fa-folder-open w-5 text-center"></i>
                        <span class="nav-text">Médiathèque</span>
                    </a>
                </div>

                <a href="{{ route('formateur.profil') }}" class="nav-item {{ request()->routeIs('formateur.profil') ? 'active' : '' }}">
                    <i class="fas fa-user-circle w-5 text-center"></i>
                    <span class="nav-text">Mon profil</span>
                </a>
            </nav>

            <div class="p-3 border-t border-slate-100">
                <button id="toggleSidebarBtn" class="w-full h-10 flex items-center justify-center gap-2 rounded-xl bg-slate-100 hover:bg-blue-50 text-slate-500 hover:text-blue-600 transition">
                    <i id="collapseIcon" class="fas fa-chevron-left text-xs"></i>
                    <span class="nav-text text-xs font-bold uppercase tracking-widest">Réduire</span>
                </button>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0">
            <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-200 flex items-center justify-between px-8 sticky top-0 z-30">
                <div>
                    <h1 class="text-xl font-black text-slate-800 tracking-tight">@yield('page_title', 'Dashboard Formateur')</h1>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Espace Enseignant</p>
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-3 bg-slate-50 border border-slate-100 p-1.5 pr-4 rounded-2xl hover:bg-white transition cursor-pointer">
                        <div class="w-10 h-10 rounded-xl bg-gray-900 flex items-center justify-center text-white shadow-lg">
                            <i class="fas fa-chalkboard-teacher text-sm"></i>
                        </div>
                        <div class="hidden md:block">
                            <p class="text-xs font-black text-slate-800 leading-none mb-1">{{ Auth::user()->formateur->prenom }} {{ Auth::user()->formateur->nom }}</p>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[9px] font-bold bg-blue-100 text-blue-600 uppercase tracking-tighter">
                                Formateur
                            </span>
                        </div>
                    </div>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                    <button onclick="confirmLogout()" class="group relative w-11 h-11 rounded-xl bg-white border border-slate-200 text-slate-500 hover:text-red-500 hover:border-red-500 transition-all shadow-sm">
                        <i class="fas fa-power-off text-sm group-hover:scale-110 transition-transform"></i>
                    </button>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-6">
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleSidebarBtn');
        const icon = document.getElementById('collapseIcon');

        toggleBtn.addEventListener('click', () => {
            const collapsed = sidebar.classList.toggle('collapsed');
            icon.classList.toggle('fa-chevron-left', !collapsed);
            icon.classList.toggle('fa-chevron-right', collapsed);
        });

        function confirmLogout() { showModal('logout'); }
        function logout() { document.getElementById('logout-form').submit(); }
    </script>
</body>
</html>