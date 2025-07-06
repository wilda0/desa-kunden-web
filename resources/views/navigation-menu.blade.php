<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redesigned Navigation</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Use the Inter font family */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
        .dark body {
            background-color: #111827;

        /* Smooth transition for dropdowns and mobile menu */
        #userDropdown, #mobile-menu {
            transition: transform 0.3s ease-out, opacity 0.3s ease-out;
        }

        /* Initial state for animations (hidden) */
        .menu-hidden {
            transform: translateY(-10px);
            opacity: 0;
            pointer-events: none;
        }

        /* Visible state for animations */
        .menu-visible {
            transform: translateY(0);
            opacity: 1;
            pointer-events: auto;
        }

        /* Mobile menu slide-in/out transition */
        #mobile-menu {
            transition: max-height 0.5s cubic-bezier(0.23, 1, 0.32, 1);
            max-height: 0;
            overflow: hidden;
        }
        #mobile-menu.open {
            max-height: 100vh; /* A large enough value to show all content */
        }
    </style>
</head>
<body>

    <!-- Header Component -->
    <header class="bg-white dark:bg-gray-800/50 dark:backdrop-blur-sm shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">

                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                        <!-- Placeholder for Logo -->
                       <img src="/public/images/logo-kunden.png" alt="Logo Desa Kunden" class="h-10 w-auto">
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-2">
                    <a href="{{ route('dashboard') }}"
                       class="{{ request()->routeIs('dashboard') ? 'text-indigo-600 dark:text-indigo-400 font-semibold' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} px-3 py-2 rounded-md text-sm">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.berita.index') }}"
                       class="{{ request()->routeIs('admin.berita.*') ? 'text-indigo-600 dark:text-indigo-400 font-semibold' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} px-3 py-2 rounded-md text-sm">
                        Artikel
                    </a>
                    <a href="{{ route('admin.produk-hukum.index') }}"
                       class="{{ request()->routeIs('admin.produk-hukum.*') ? 'text-indigo-600 dark:text-indigo-400 font-semibold' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} px-3 py-2 rounded-md text-sm">
                        Produk Hukum
                    </a>
                    <a href="{{ route('admin.galeri.index') }}"
                       class="{{ request()->routeIs('admin.galeri.*') ? 'text-indigo-600 dark:text-indigo-400 font-semibold' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} px-3 py-2 rounded-md text-sm">
                        Galeri
                    </a>
                    <a href="{{ route('admin.informasi-publik.index') }}"
                       class="{{ request()->routeIs('admin.informasi-publik.*') ? 'text-indigo-600 dark:text-indigo-400 font-semibold' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} px-3 py-2 rounded-md text-sm">
                        Informasi Publik
                    </a>
                    <a href="{{ route('admin.dokumen.index') }}"
                       class="{{ request()->routeIs('admin.dokumen.*') ? 'text-indigo-600 dark:text-indigo-400 font-semibold' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} px-3 py-2 rounded-md text-sm">
                        Dokumen
                    </a>
                    <a href="{{ route('admin.permohonan.index') }}"
                       class="{{ request()->routeIs('admin.permohonan.*') ? 'text-indigo-600 dark:text-indigo-400 font-semibold' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} px-3 py-2 rounded-md text-sm">
                        Permohonan Informasi
                    </a>
                    <a href="{{ route('admin.aparatur.index') }}"
                       class="{{ request()->routeIs('admin.aparatur.*') ? 'text-indigo-600 dark:text-indigo-400 font-semibold' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} px-3 py-2 rounded-md text-sm">
                        Aparatur
                    </a>
                    <a href="{{ route('admin.produk-umkm.index') }}"
                       class="{{ request()->routeIs('admin.produk-umkm.*') ? 'text-indigo-600 dark:text-indigo-400 font-semibold' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} px-3 py-2 rounded-md text-sm">
                        Produk UMKM
                    </a>
                </nav>

                <!-- User Dropdown & Mobile Menu Button -->
                <div class="flex items-center">
                <!-- User Dropdown -->
                <div class="hidden md:block relative ml-4 group">
                    <button
                        class="flex items-center space-x-1 text-sm font-medium text-gray-800 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-300" fill="none" viewBox="0 0 20 20" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8l5 5 5-5" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div
                        class="absolute right-0 mt-2 w-48 origin-top-right bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-md shadow-lg z-50 opacity-0 invisible group-hover:visible group-hover:opacity-100 group-focus-within:visible group-focus-within:opacity-100 transition-opacity duration-150">
                        <div class="px-4 py-3">
                            <p class="text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="py-1">
                            <a href="{{ route('profile.show') }}"
                                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Profile</a>
                        </div>
                        <div class="py-1 border-t border-gray-200 dark:border-gray-600">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-500/10">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                    <!-- Mobile Menu Button -->
                    <div class="md:hidden ml-4">
                        <button id="mobile-menu-toggle" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                            <span class="sr-only">Open main menu</span>
                            <!-- Icon for menu open -->
                            <svg id="menu-open-icon" class="h-6 w-6 block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <!-- Icon for menu close -->
                            <svg id="menu-close-icon" class="h-6 w-6 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('dashboard') }}"
                   class="{{ request()->routeIs('dashboard') ? 'bg-indigo-50 dark:bg-indigo-500/20 text-indigo-700 dark:text-indigo-300' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium">
                    Dashboard
                </a>
                <a href="{{ route('admin.berita.index') }}"
                   class="{{ request()->routeIs('admin.berita.*') ? 'bg-indigo-50 dark:bg-indigo-500/20 text-indigo-700 dark:text-indigo-300' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium">
                    Artikel
                </a>
                <a href="{{ route('admin.produk-hukum.index') }}"
                   class="{{ request()->routeIs('admin.produk-hukum.*') ? 'bg-indigo-50 dark:bg-indigo-500/20 text-indigo-700 dark:text-indigo-300' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium">
                    Produk Hukum
                </a>
                <a href="{{ route('admin.galeri.index') }}"
                   class="{{ request()->routeIs('admin.galeri.*') ? 'bg-indigo-50 dark:bg-indigo-500/20 text-indigo-700 dark:text-indigo-300' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium">
                    Galeri
                </a>
                <a href="{{ route('admin.informasi-publik.index') }}"
                   class="{{ request()->routeIs('admin.informasi-publik.*') ? 'bg-indigo-50 dark:bg-indigo-500/20 text-indigo-700 dark:text-indigo-300' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium">
                    Informasi Publik
                </a>
                <a href="{{ route('admin.dokumen.index') }}"
                   class="{{ request()->routeIs('admin.dokumen.*') ? 'bg-indigo-50 dark:bg-indigo-500/20 text-indigo-700 dark:text-indigo-300' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium">
                    Dokumen
                </a>
                <a href="{{ route('admin.permohonan.index') }}"
                   class="{{ request()->routeIs('admin.permohonan.*') ? 'bg-indigo-50 dark:bg-indigo-500/20 text-indigo-700 dark:text-indigo-300' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium">
                    Permohonan Informasi
                </a>
                <a href="{{ route('admin.aparatur.index') }}"
                   class="{{ request()->routeIs('admin.aparatur.*') ? 'bg-indigo-50 dark:bg-indigo-500/20 text-indigo-700 dark:text-indigo-300' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium">
                    Aparatur
                </a>
                <a href="{{ route('admin.produk-umkm.index') }}"
                   class="{{ request()->routeIs('admin.produk-umkm.*') ? 'bg-indigo-50 dark:bg-indigo-500/20 text-indigo-700 dark:text-indigo-300' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium">
                    Produk UMKM
                </a>
            </div>

            <!-- Mobile User Info -->
            <div class="pt-4 pb-3 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center px-5">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-gray-800 dark:text-white">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 px-2 space-y-1">
                    <a href="{{ route('profile.show') }}"
                       class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                        Profile
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left block px-3 py-2 rounded-md text-base font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-500/10">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // --- Dropdown Menu Logic ---
            const setupDropdown = (containerId, buttonId, dropdownId) => {
                const container = document.getElementById(containerId);
                const button = document.getElementById(buttonId);
                const dropdown = document.getElementById(dropdownId);

                if (!button || !dropdown || !container) return;

                button.addEventListener('click', (event) => {
                    event.stopPropagation();
                    const isHidden = dropdown.classList.contains('menu-hidden');
                    // Hide all other dropdowns first
                    hideAllDropdowns();
                    if (isHidden) {
                        dropdown.classList.remove('menu-hidden');
                        dropdown.classList.add('menu-visible');
                    } else {
                        dropdown.classList.add('menu-hidden');
                        dropdown.classList.remove('menu-visible');
                    }
                });
            };

            const hideAllDropdowns = () => {
                document.querySelectorAll('.menu-visible').forEach(menu => {
                    menu.classList.add('menu-hidden');
                    menu.classList.remove('menu-visible');
                });
            };

            // Initialize all dropdowns
            setupDropdown('user-menu-container', 'userMenuButton', 'userDropdown');
            setupDropdown('more-menu-container', 'more-menu-button', 'more-menu-dropdown');

            // --- Mobile Menu Logic ---
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            const menuOpenIcon = document.getElementById('menu-open-icon');
            const menuCloseIcon = document.getElementById('menu-close-icon');

            if (mobileMenuToggle && mobileMenu) {
                mobileMenuToggle.addEventListener('click', () => {
                    mobileMenu.classList.toggle('open');
                    menuOpenIcon.classList.toggle('hidden');
                    menuCloseIcon.classList.toggle('hidden');
                    // When opening mobile menu, ensure dropdowns are closed
                    if (mobileMenu.classList.contains('open')) {
                        hideAllDropdowns();
                    }
                });
            }

            // --- Global Click Listener to Close Menus ---
            document.addEventListener('click', (event) => {
                // Close dropdowns if click is outside
                const userMenuContainer = document.getElementById('user-menu-container');
                const moreMenuContainer = document.getElementById('more-menu-container');
                if (!userMenuContainer?.contains(event.target) && !moreMenuContainer?.contains(event.target)) {
                    hideAllDropdowns();
                }

                // Close mobile menu if click is outside the header
                const header = document.querySelector('header');
                if (mobileMenu.classList.contains('open') && !header.contains(event.target)) {
                    mobileMenu.classList.remove('open');
                    menuOpenIcon.classList.remove('hidden');
                    menuCloseIcon.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>
