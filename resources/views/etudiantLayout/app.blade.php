<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS | @yield('title')</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

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
    </style>
</head>

<body class="h-full bg-slate-200 text-slate-700 overflow-hidden">

<div class="flex h-screen">

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

                <a href="{{ route('etudiant.profil') }}" class="nav-item {{ request()->routeIs('etudiant.profil') ? 'active' : '' }}">
                   <i class="fas fa-id-badge w-5 text-center"></i>
                    <span class="nav-text">Mon profil</span>
                </a>

            </div>

            <div>

                <a href="{{ route('etudiant.espaces.index') }}" class="nav-item {{ request()->routeIs('etudiant.espaces.*') ? 'active' : '' }}">
                    <i class="fas fa-chalkboard-user w-5 text-center"></i>
                    <span class="nav-text">Espaces pédagogiques</span>
                </a>

            </div>
                <a href="{{ route('etudiant.travaux.index') }}" class="nav-item {{ request()->routeIs('etudiant.travaux.*') ? 'active' : '' }}">
                    <i class="fas fa-file-lines w-5 text-center"></i>
                    <span class="nav-text">Travaux</span>
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
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6 shadow-sm rounded-b-xl hover:shadow-md transition">
            <div>
                <h1 class="text-lg font-bold text-slate-800">
                    @yield('page_title', 'Dashboard')
                </h1>
                <p class="text-[11px] text-slate-600 uppercase tracking-widest">
                    Système académique
                </p>
            </div>

            <div class="flex items-center gap-4">
                <div class="hidden sm:flex items-center gap-2 bg-gray-700 px-3 py-1.5 rounded-xl">
                    <i class="fas fa-user-graduate text-blue-500"></i>
                    <div>
                        <p class="text-xs font-bold text-white uppercase">étudiant</p>
                        <p class="text-[10px] text-slate-300 uppercase"></p>
                    </div>
                </div>

                <button class="w-10 h-10 rounded-xl bg-white border border-red-100 text-red-500
                               hover:bg-red-500 hover:text-white transition">
                   <i class="fas fa-right-from-bracket"></i>
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
