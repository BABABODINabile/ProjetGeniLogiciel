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

    

        ::-webkit-scrollbar {
            width: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 10px;
        }
    </style>
</head>







    <div class="flex-1 flex flex-col min-w-0">

       

        
        <main class="flex-1 overflow-y-auto p-6">
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>

    </div>





</body>
</html>
