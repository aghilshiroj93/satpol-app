<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris App</title>

    <!-- TAILWIND CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">

    <style>
        /* Transition sidebar */
        .sidebar {
            transition: width 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-100 flex">

    <body class="bg-gray-100 flex">

        <!-- SIDEBAR -->
        <aside id="sidebar" 
            class="sidebar w-64 bg-white shadow-md h-screen fixed top-0 left-0 transform -translate-x-full 
                   lg:translate-x-0 transition-transform duration-300 z-50">
            
            <div class="p-5 border-b">
                <h1 class="text-xl font-semibold tracking-wide">Inventaris</h1>
            </div>
    
            <nav class="p-4 space-y-2">
                <a href="/" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 text-gray-700">
                    <i class="ri-home-4-line text-xl"></i>
                    <span>Home</span>
                </a>
    
                <a href="{{ route('barang.index') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 text-gray-700">
                    <i class="ri-archive-2-line text-xl"></i>
                    <span>Barang Operasional</span>
                </a>
                
    
                
    
                <a href="{{ route('perawatan.index') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 text-gray-700">
                    <i class="ri-calendar-check-line text-xl"></i>
                    <span>Jadwal Perawatan</span>
                </a>
            </nav>
        </aside>
    
        <!-- MOBILE OVERLAY -->
        <div id="overlay" 
            class="hidden fixed inset-0 bg-black bg-opacity-40 z-40"
            onclick="toggleSidebar()"></div>
    
        <!-- MAIN CONTENT -->
        <div id="maincontent" class="flex-1 min-h-screen lg:ml-64 transition-all duration-300">
    
            <!-- TOP NAV -->
            <header class="bg-white shadow p-4 flex items-center justify-between">
                <button onclick="toggleSidebar()" class="lg:hidden text-2xl text-gray-600">
                    <i class="ri-menu-line"></i>
                </button>
                <span class="text-gray-600 font-medium hidden lg:block">Dashboard Inventaris</span>
            </header>
    
            <!-- PAGE CONTENT -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    
        <script>
            function toggleSidebar() {
                const sidebar = document.getElementById("sidebar");
                const overlay = document.getElementById("overlay");
    
                sidebar.classList.toggle("-translate-x-full");
                overlay.classList.toggle("hidden");
            }
        </script>
    
        @yield('scripts')
    </body>
    

</body>
</html>
