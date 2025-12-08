<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inventaris App</title>

    <!-- TAILWIND CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">

    @stack('styles')

    <style>
        /* Smooth transitions */
        .sidebar {
            transition: all 0.3s ease;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }

        /* Active menu indicator */
        .active-menu {
            background-color: #eff6ff;
            color: #2563eb;
            border-right: 3px solid #2563eb;
        }

        .active-menu i {
            color: #2563eb;
        }

        /* Hover effects */
        .menu-item:hover {
            background-color: #f8fafc;
            transform: translateX(2px);
        }

        /* Logo styling */
        .logo-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Card shadows */
        .card-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        /* Notification badge */
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background-color: #ef4444;
            color: white;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body class="bg-gray-50 flex min-h-screen">

    <!-- SIDEBAR -->
    <aside id="sidebar"
        class="sidebar w-64 bg-gradient-to-b from-white to-gray-50 shadow-xl h-screen fixed top-0 left-0 transform -translate-x-full 
               lg:translate-x-0 transition-transform duration-300 z-50 flex flex-col border-r border-gray-200">

        <!-- Logo Section -->
        <div class="p-5 border-b border-gray-200 bg-white">
            <div class="flex items-center gap-3">
                <div
                    class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                    <i class="ri-box-3-line text-white text-lg"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold logo-gradient tracking-tight">Inventaris</h1>
                    <p class="text-xs text-gray-500 mt-0.5">Management System</p>
                </div>
            </div>
        </div>

        <!-- User Profile Section -->


        <!-- Navigation Menu -->
        <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
                class="menu-item flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 text-gray-700 transition-all duration-200 relative
                       {{ request()->routeIs('dashboard') ? 'active-menu' : '' }}">
                <i class="ri-home-4-line text-xl text-gray-500"></i>
                <span>Dashboard</span>
                @if (request()->routeIs('dashboard'))
                    <i class="ri-arrow-right-s-line ml-auto text-blue-500"></i>
                @endif
            </a>

            <!-- Barang Operasional -->
            <a href="{{ route('barang.index') }}"
                class="menu-item flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 text-gray-700 transition-all duration-200 relative
                       {{ request()->routeIs('barang.*') ? 'active-menu' : '' }}">
                <i class="ri-archive-2-line text-xl text-gray-500"></i>
                <span>Barang Operasional</span>
                @if (request()->routeIs('barang.*'))
                    <i class="ri-arrow-right-s-line ml-auto text-blue-500"></i>
                @endif
                {{-- Uncomment for notification badge --}}
                {{-- <span class="notification-badge">3</span> --}}
            </a>

            <!-- Jadwal Perawatan -->
            <a href="{{ route('perawatan.index') }}"
                class="menu-item flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 text-gray-700 transition-all duration-200 relative
                       {{ request()->routeIs('perawatan.*') ? 'active-menu' : '' }}">
                <i class="ri-calendar-check-line text-xl text-gray-500"></i>
                <span>Jadwal Perawatan</span>
                @if (request()->routeIs('perawatan.*'))
                    <i class="ri-arrow-right-s-line ml-auto text-blue-500"></i>
                @endif
            </a>

            <!-- Manajemen User -->
            <a href="{{ route('petugas.index') }}"
                class="menu-item flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 text-gray-700 transition-all duration-200 relative
                       {{ request()->routeIs('petugas.*') ? 'active-menu' : '' }}">
                <i class="ri-user-settings-line text-xl text-gray-500"></i>
                <span>Manajemen User</span>
                @if (request()->routeIs('petugas.*'))
                    <i class="ri-arrow-right-s-line ml-auto text-blue-500"></i>
                @endif
            </a>

            <!-- Reports (Optional - Add if you have reports feature) -->

        </nav>

        <!-- Logout Section -->
        <div class="p-4 border-t border-gray-200 bg-white mt-auto">
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <button type="button" onclick="confirmLogout()"
                    class="flex items-center justify-center gap-3 w-full p-3 rounded-lg bg-gradient-to-r from-red-50 to-red-50 hover:from-red-100 hover:to-red-100 text-red-600 hover:text-red-700 transition-all duration-200 group">
                    <i class="ri-logout-box-r-line text-xl"></i>
                    <span class="font-medium">Keluar</span>
                    <i class="ri-arrow-right-line ml-auto group-hover:translate-x-1 transition-transform"></i>
                </button>
            </form>

            <!-- App Version -->
            <div class="mt-4 text-center">
                <p class="text-xs text-gray-500">v1.0.0 © {{ date('Y') }}</p>
            </div>
        </div>
    </aside>

    <!-- MOBILE OVERLAY -->
    <div id="overlay" class="hidden fixed inset-0 bg-black bg-opacity-40 z-40 lg:hidden" onclick="toggleSidebar()">
    </div>

    <!-- MAIN CONTENT -->
    <div id="maincontent" class="flex-1 min-h-screen lg:ml-64 transition-all duration-300 flex flex-col">

        <!-- TOP NAV -->
        <header class="bg-white shadow-sm card-shadow p-4 flex items-center justify-between sticky top-0 z-30">
            <div class="flex items-center gap-4">
                <button onclick="toggleSidebar()"
                    class="lg:hidden text-2xl text-gray-600 hover:text-gray-800 hover:bg-gray-100 w-10 h-10 rounded-lg flex items-center justify-center transition-colors">
                    <i class="ri-menu-line"></i>
                </button>

                <!-- Breadcrumb (Optional) -->
                <div class="hidden md:flex items-center text-sm text-gray-500">
                    <a href="{{ route('dashboard') }}" class="hover:text-blue-600">Dashboard</a>
                    <i class="ri-arrow-right-s-line mx-2"></i>
                    <span class="text-gray-700 font-medium">@yield('page-title', 'Inventaris')</span>
                </div>
            </div>

            <!-- Right side of header -->
            <div class="flex items-center gap-4">
                <!-- Notification Bell -->
                <button
                    class="relative w-10 h-10 rounded-full hover:bg-gray-100 flex items-center justify-center transition-colors text-gray-600">
                    <i class="ri-notification-3-line text-xl"></i>
                    <span class="notification-badge">2</span>
                </button>

                <!-- User Menu (Mobile) -->
                <div class="relative lg:hidden">
                    <button id="user-menu-button"
                        class="flex items-center gap-2 p-2 rounded-lg hover:bg-gray-100 transition-colors">
                        <div
                            class="w-8 h-8 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                            {{ substr(Auth::user()->name ?? 'Admin', 0, 1) }}
                        </div>
                    </button>

                    <!-- Dropdown Menu (Mobile) -->
                    <div id="user-dropdown"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 hidden z-40">
                        <div class="p-2">
                            <a href="#"
                                class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 text-gray-700">
                                <i class="ri-user-line"></i>
                                <span>Profil</span>
                            </a>
                            <a href="#"
                                class="flex items-center gap-2 p-2 rounded hover:bg-gray-100 text-gray-700">
                                <i class="ri-settings-3-line"></i>
                                <span>Pengaturan</span>
                            </a>
                            <hr class="my-1">
                            <button onclick="confirmLogout()"
                                class="w-full flex items-center gap-2 p-2 rounded hover:bg-red-50 text-red-600">
                                <i class="ri-logout-box-r-line"></i>
                                <span>Keluar</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- PAGE CONTENT -->
        <main class="flex-1 p-4 md:p-6 bg-gray-50">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">@yield('page-title', 'Dashboard Inventaris')</h1>
                <p class="text-gray-600 mt-1">@yield('page-description', 'Kelola dan pantau inventaris operasional dengan mudah')</p>
            </div>

            <!-- Actual Content -->
            <div class="card-shadow bg-white rounded-xl p-4 md:p-6">
                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 p-4 text-center">
            <p class="text-sm text-gray-600">
                Sistem Inventaris &copy; {{ date('Y') }} -
                <span class="font-medium text-blue-600">v1.0.0</span>
            </p>
        </footer>
    </div>

    <!-- Logout Confirmation Modal -->
    <div id="logout-modal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl max-w-md w-full p-6 card-shadow">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="ri-logout-box-r-line text-2xl text-red-600"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Konfirmasi Keluar</h3>
                    <p class="text-gray-600 mt-1">Anda yakin ingin keluar dari sistem?</p>
                </div>
            </div>

            <div class="flex gap-3 mt-6">
                <button onclick="closeLogoutModal()"
                    class="flex-1 py-3 px-4 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors font-medium">
                    Batal
                </button>
                <button onclick="submitLogout()"
                    class="flex-1 py-3 px-4 rounded-lg bg-gradient-to-r from-red-600 to-red-500 text-white hover:from-red-700 hover:to-red-600 transition-all font-medium">
                    Ya, Keluar
                </button>
            </div>
        </div>
    </div>

    <script>
        // Toggle Sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");

            sidebar.classList.toggle("-translate-x-full");
            overlay.classList.toggle("hidden");
        }

        // User dropdown for mobile
        const userMenuButton = document.getElementById('user-menu-button');
        const userDropdown = document.getElementById('user-dropdown');

        if (userMenuButton) {
            userMenuButton.addEventListener('click', (e) => {
                e.stopPropagation();
                userDropdown.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', () => {
                userDropdown.classList.add('hidden');
            });

            // Prevent dropdown from closing when clicking inside
            userDropdown.addEventListener('click', (e) => {
                e.stopPropagation();
            });
        }

        // Logout confirmation
        function confirmLogout() {
            document.getElementById('logout-modal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logout-modal').classList.add('hidden');
        }

        function submitLogout() {
            document.getElementById('logout-form').submit();
        }

        // Close modal with Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeLogoutModal();
            }
        });

        // Highlight active menu based on current URL
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const menuItems = document.querySelectorAll('.menu-item');

            menuItems.forEach(item => {
                if (item.getAttribute('href') === currentPath) {
                    item.classList.add('active-menu');
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
