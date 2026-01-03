<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS | @yield('title')</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* ================= SIDEBAR ================= */

        .sidebar {
            width: 18rem;
            transition: width 0.3s ease;

        }

        .sidebar.collapsed {
            width: 5rem;
        }

        .sidebar.collapsed .nav-text,
        .sidebar.collapsed .section-title,
        .sidebar.collapsed .brand-text {
            opacity:0;
            width: 0;
            overflow: hidden;
            white-space: nowrap;
        }

        .sidebar.collapsed .nav-item {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }

        .sidebar.collapsed .nav-item i {
            margin: 0;
            padding: 0;
        }

        /* ================= NAV ITEMS ================= */

        .nav-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: white;
            font-weight: bold;
            margin-bottom: 1rem;
            transition: background 0.5s ease, color 0.2s ease;
        }

        .nav-item:hover {
            background-color: white;
            color: #0051ff;
            font-weight: bold;
        }

        .nav-item.active {
            background-color: #2563eb;
            color: #ffffff;
        }

        /* ================= SCROLLBAR ================= */

        ::-webkit-scrollbar {
            width: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 10px;
        }
        .hidden {
            display: none;
        }

    </style>
</head>

<body class="h-full bg-slate-200 text-slate-700 overflow-hidden">
<!-- Notification de connection -->



<!-- modal de confirmation de déconnexion-->
    <x-bladewind::modal
        name="logout"
        type="warning"
        title="Déconnexion"
        ok_button_action="logout()"
        ok_button_label="Se déconnecter"
        cancel_button_label="Annuler"
        align_buttons="center"
        >
        Voulez-vous vraiment vous déconnecter ?
        <br>
        Cette action est <b class="text-red-600">irréversible</b>.

    </x-bladewind::modal>
<div class="flex h-screen">

<script>
    function confirmLogout() {
        // Affiche ton modal de confirmation
        showModal('logout');
    }
    function logout() {
        const form = document.getElementById('logout-form');
        // On place l'ID de l'étudiant dans le champ caché
        form.submit();
    }
</script>

    <!-- ================= SIDEBAR ================= -->
    <aside id="sidebar"
           class="sidebar bg-gray-900 border-r border-slate-100 flex flex-col">

        <!-- Brand -->
        <div class="h-16 flex items-center gap-3 px-4 border-b border-slate-100">
            <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center">
                <i class="fas fa-graduation-cap text-white"></i>
            </div>
            <span class="brand-text font-bold text-white uppercase tracking-tight">
                Nom<span class="text-blue-600">Platform</span>
            </span>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-6">

            <div class="">
               <p class="section-title px-3 mb-3 text-[10px] font-bold text-slate-200 uppercase tracking-widest">
                    Gestion des acteurs
                </p>

                <a href="{{ route('etudiants.index') }}" class="nav-item {{ request()->routeIs('etudiants.*') ? 'active' : '' }}">
                    <i class="fas fa-user-graduate w-5 text-center"></i>
                    <span class="nav-text">Étudiants</span>
                </a>

                <a href="{{ route('formateurs.index') }}" class="nav-item {{ request()->routeIs('formateurs.*') ? 'active' : '' }}">
                    <i class="fas fa-chalkboard-teacher w-5 text-center"></i>
                    <span class="nav-text">Formateurs</span>
                </a>

                <a href="{{ route('administrations.index') }}" class="nav-item {{ request()->routeIs('administrations.*') ? 'active' : '' }}">
                    <i class="fas fa-user-shield w-5 text-center"></i>
                    <span class="nav-text">Administration</span>
                </a>

                <a href="{{ route('promotions.index') }}" class="nav-item {{ request()->routeIs('promotions.*') ? 'active' : '' }}">
                    <i class="fas fa-layer-group w-5 text-center"></i>
                    <span class="nav-text">Promotions</span>
                </a>

            </div>

            <div>

                <p class="section-title px-3 mb-3 text-[10px] font-bold text-slate-200 uppercase tracking-widest">
                    Gestion pédagogique
                </p>

                <a href="{{ route('espaces.index') }}" class="nav-item {{ request()->routeIs('espaces.*') ? 'active' : '' }}">
                    <i class="fas fa-chalkboard w-5 text-center"></i>
                    <span class="nav-text">Espaces pédagogiques</span>
                </a>

                <a href="{{ route('matieres.index') }}" class="nav-item {{ request()->routeIs('matieres.*') ? 'active' : '' }}">
                    <i class="fas fa-book-open w-5 text-center"></i>
                    <span class="nav-text">Matières</span>
                </a>

                <a href="{{ route('filieres.index') }}" class="nav-item {{ request()->routeIs('filieres.*') ? 'active' : '' }}">
                    <i class="fas fa-sitemap w-5 text-center"></i>
                    <span class="nav-text">Filières / Options</span>
                </a>

            </div>
                <a href="{{ route('profil.show') }}" class="nav-item {{ request()->routeIs('profil.*') ? 'active' : '' }}">
                    <i class="fas fa-user-circle w-5 text-center"></i>
                    <span class="nav-text">Mon profil</span>
                </a>

        </nav>

        <!-- Collapse button -->
        <div class="p-3 border-t border-slate-100">
            <button id="toggleSidebarBtn"
                    class="w-full h-10 flex items-center justify-center gap-2 rounded-xl
                           bg-slate-100 hover:bg-blue-50 text-slate-500 hover:text-blue-600 transition">
                <i id="collapseIcon" class="fas fa-chevron-left text-xs"></i>
                <span class="nav-text text-xs font-bold uppercase tracking-widest">Réduire</span>
            </button>
        </div>
    </aside>

    <!-- ================= MAIN ================= -->
    <div class="flex-1 flex flex-col min-w-0">

        <!-- Header -->
            <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-200 flex items-center justify-between px-8 sticky top-0 z-30">
            <div>
                <h1 class="text-xl font-black text-slate-800 tracking-tight">
                    @yield('page_title', 'Dashboard')
                </h1>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">
                        Système opérationnel
                    </p>
                </div>
            </div>
            @if (session('success-login'))
            <div id="alertConnect" class="transition-opacity duration-300 opacity-100">
                <x-bladewind::alert
                    type="success"
                    shade="dark">
                    {{ session('success-login') }}
                </x-bladewind::alert>
            </div>

                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const alertBox = document.getElementById('alertConnect');
                        if (!alertBox) return;

                        setTimeout(() => {
                            alertBox.classList.add('opacity-0');

                            setTimeout(() => {
                                alertBox.classList.add('hidden');
                            }, 300);
                        }, 2000);
                    });
                </script>
            @endif

            <div class="flex items-center gap-6">
                <div class="flex items-center gap-3 bg-slate-50 border border-slate-100 p-1.5 pr-4 rounded-2xl hover:bg-white hover:shadow-sm transition cursor-pointer">
                    <div class="w-10 h-10 rounded-xl bg-gray-900 flex items-center justify-center text-white shadow-indigo-100 shadow-lg">
                        <i class="fas fa-user-shield text-sm"></i>
                    </div>
                    <div class="hidden md:block">
                        <p class="text-xs font-black text-slate-800 leading-none mb-1">{{ Auth::user()->email ?? 'Administrateur' }}</p>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[9px] font-bold bg-blue-100 text-blue-600 uppercase tracking-tighter">
                            {{ Auth::user()->administration->fonction}}
                        </span>
                    </div>
                </div>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>

                <button
                    onclick="confirmLogout()"
                    class="group relative w-11 h-11 rounded-xl
                        bg-white border border-slate-200
                        text-slate-500
                        hover:bg-red-0 hover:text-red-500 hover:border-red-500
                        transition-all duration-200 ease-out
                        shadow-sm hover:shadow
                        flex items-center justify-center">

                    <!-- Icône -->
                    <i class="fas fa-power-off text-sm transition-transform duration-200 group-hover:scale-110"></i>

                    <!-- Tooltip -->
                    <span class="absolute bottom-full mb-2 px-3 py-1
                                text-[11px] font-semibold uppercase tracking-wide
                                text-white bg-gray-900 rounded-md
                                opacity-0 translate-y-1
                                group-hover:opacity-100 group-hover:translate-y-20
                                transition-all duration-200 pointer-events-none">
                        Déconnexion
                    </span>
                </button>

            </div>
        </header>

        <!-- Content -->
        <main class="flex-1 overflow-y-auto p-6">
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>

    </div>
</div>

<!-- ================= JS ================= -->
<script>
    
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggleSidebarBtn');
    const icon = document.getElementById('collapseIcon');

    toggleBtn.addEventListener('click', () => {
        const collapsed = sidebar.classList.toggle('collapsed');
        icon.classList.toggle('fa-chevron-left', !collapsed);
        icon.classList.toggle('fa-chevron-right', collapsed);
    });
</script>

</body>
</html>
