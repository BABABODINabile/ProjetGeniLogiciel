<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS | @yield('title')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        #sidebar { transition: transform 0.3s ease-in-out; }
        
        @media (max-width: 1023px) {
            .sidebar-closed { transform: translateX(-100%); }
            .sidebar-open { transform: translateX(0); }
        }

        .nav-item {
            display: flex; align-items: center; gap: 1rem;
            padding: 0.75rem 1rem; border-radius: 0.75rem;
            font-size: 0.875rem; font-weight: bold; color: white;
            transition: all 0.3s ease; margin-bottom: 0.5rem;
        }
        .nav-item:hover { background-color: white; color: #2563eb; }
        .nav-item.active { background-color: #2563eb; color: white; }
        
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }
        .hidden {
            display: none;
        }
    </style>
</head>

<body class="h-full bg-slate-100 text-slate-700 overflow-hidden">

    <x-bladewind::modal
        name="logout"
        type="warning"
        title="Déconnexion"
        ok_button_action="logout()"
        ok_button_label="Se déconnecter"
        cancel_button_label="Annuler"
        align_buttons="center">
        Voulez-vous vraiment vous déconnecter ?
        <br>Cette action mettra fin à votre session actuelle.
    </x-bladewind::modal>

    <div class="flex h-screen overflow-hidden">
        
        <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden"></div>
    
        <aside id="sidebar" 
            class="fixed inset-y-0 left-0 z-50 w-72 bg-gray-900 flex flex-col sidebar-closed lg:relative lg:translate-x-0 lg:w-72 transition-all duration-300">
            
            <div class="h-16 flex items-center justify-between px-4 border-b border-gray-800">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white text-lg"></i>
                    </div>
                    <span class="brand-text font-bold text-white uppercase tracking-tight">
                        Nom<span class="text-blue-500">Platform</span>
                    </span>
                </div>
                <button id="close-sidebar" class="lg:hidden text-gray-400 hover:text-white">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <nav class="flex-1 overflow-y-auto px-4 py-6">
                <a href="{{ route('etudiant.profil') }}" class="nav-item {{ request()->routeIs('etudiant.profil') ? 'active' : '' }}">
                    <i class="fas fa-id-badge w-6 text-center"></i>
                    <span class="nav-text text-sm">Mon Profil</span>
                </a>

                <a href="{{ route('etudiant.espaces.index') }}" class="nav-item {{ request()->routeIs('etudiant.espaces.*') ? 'active' : '' }}">
                    <i class="fas fa-chalkboard-user w-6 text-center"></i>
                    <span class="nav-text text-sm">Mes Espaces</span>
                </a>

                <a href="{{ route('etudiant.travaux.index') }}" class="nav-item {{ request()->routeIs('etudiant.travaux.*') ? 'active' : '' }}">
                    <i class="fas fa-file-lines w-6 text-center"></i>
                    <span class="nav-text text-sm">Travaux</span>
                </a>
            </nav>

            <div class="p-4 border-t border-gray-800">
                <p class="text-[10px] text-gray-500 text-center uppercase tracking-widest font-bold">Version 1.0.2</p>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0">

            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 lg:px-8 shrink-0 shadow-sm">
                <div class="flex items-center gap-3">
                    <button id="open-sidebar" class="lg:hidden w-10 h-10 flex items-center justify-center text-gray-600 hover:bg-slate-100 rounded-xl transition">
                        <i class="fas fa-bars text-lg"></i>
                    </button>

                    <div class="hidden sm:block">
                        <h1 class="text-lg font-bold text-slate-800 leading-tight">@yield('page_title', 'Dashboard')</h1>
                        <p class="text-[10px] text-slate-500 uppercase font-bold tracking-widest">Espace Étudiant</p>
                    </div>

                    @if (session('success-login'))
                        <div id="alertConnect" class="ml-4 transition-opacity duration-300">
                            <x-bladewind::alert type="success" shade="dark" class="py-2">
                                {{ session('success-login') }}
                            </x-bladewind::alert>
                        </div>
                    @endif
                </div>

                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-2 bg-slate-50 p-1 pr-3 rounded-2xl border border-slate-100">
                        <div class="w-8 h-8 rounded-lg bg-gray-900 flex items-center justify-center text-white text-xs shadow-lg shadow-gray-200">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                         <div class=" xs:block">
                        <p class="text-xs font-black text-slate-800 leading-none mb-1">{{ Auth::user()->etudiant->nom.' '.Auth::user()->etudiant->prenom ?? 'Étudiant' }}</p>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[9px] font-bold bg-blue-100 text-blue-600   tracking-tighter">
                            {{ Auth::user()->email}}
                        </span>
                    </div>
                    </div>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>

                    <button onclick="confirmLogout()"
                        class="group relative w-11 h-11 rounded-xl bg-white border border-slate-200 text-slate-500 hover:text-red-500 hover:border-red-500 transition-all duration-200 shadow-sm flex items-center justify-center">
                        <i class="fas fa-power-off text-sm group-hover:scale-110 transition-transform"></i>
                        
                        <span class="absolute top-full mt-2 px-3 py-1 text-[10px] font-bold uppercase tracking-widest text-white bg-gray-900 rounded-md opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-50">
                            Déconnexion
                        </span>
                    </button>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-4 lg:p-8">
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        // Sidebar Mobile Logic
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const openBtn = document.getElementById('open-sidebar');
        const closeBtn = document.getElementById('close-sidebar');

        function toggleSidebar() {
            sidebar.classList.toggle('sidebar-closed');
            sidebar.classList.toggle('sidebar-open');
            overlay.classList.toggle('hidden');
        }

        openBtn?.addEventListener('click', toggleSidebar);
        closeBtn?.addEventListener('click', toggleSidebar);
        overlay?.addEventListener('click', toggleSidebar);

        // Logout Logic (Bladewind Modal)
        function confirmLogout() {
            showModal('logout');
        }
        function logout() {
            document.getElementById('logout-form').submit();
        }

        // Auto-hide Login Alert
        document.addEventListener('DOMContentLoaded', () => {
            const alertBox = document.getElementById('alertConnect');
            if (alertBox) {
                setTimeout(() => {
                    alertBox.classList.add('opacity-0');
                    setTimeout(() => alertBox.remove(), 300);
                }, 3000);
            }
        });
    </script>
</body>
</html>