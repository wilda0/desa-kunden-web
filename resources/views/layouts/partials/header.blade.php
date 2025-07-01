<!-- Header & Navbar -->
<header class="bg-white/80 backdrop-blur-lg sticky top-0 z-50 shadow-md" x-data="{ mobileMenuOpen: false }">
    <nav class="container mx-auto px-6 lg:px-16 py-3 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ route('welcome') }}" class="flex items-center space-x-2">
            <img src="{{ asset('images/logo-kunden.png') }}" alt="Logo Desa Kunden" class="h-10 w-auto">
            <span class="text-xl font-bold text-gray-700">Desa Kunden</span>
        </a>

        <!-- Desktop Menu -->
        <div class="hidden lg:flex items-center space-x-8">
            <a href="{{ route('welcome') }}" class="text-gray-600 hover:text-blue-600 nav-link">Home</a>
            <!-- Profil Desa Dropdown -->
            <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button class="flex items-center text-gray-600 hover:text-blue-600 nav-link">
                    Profil Desa <i data-lucide="chevron-down" class="w-4 h-4 ml-1 transition-transform"
                        :class="{ 'rotate-180': open }"></i>
                </button>
                <div x-show="open" x-transition class="absolute mt-0 pt-2 w-48 bg-white rounded-md shadow-xl z-20"
                    style="display: none;">
                    <a href="{{ route('sejarah-desa') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Sejarah
                        Desa</a>
                    <a href="{{ route('profil-wilayah') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Profil Wilayah
                        Desa</a>
                    <a href="{{ route('kondisi-pemerintahan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Kondisi
                        Pemerintahan</a>
                </div>
            </div>
            <!-- Data Desa Dropdown -->
            <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button class="flex items-center text-gray-600 hover:text-blue-600 nav-link">
                    Data Desa <i data-lucide="chevron-down" class="w-4 h-4 ml-1 transition-transform"
                        :class="{ 'rotate-180': open }"></i>
                </button>
                <div x-show="open" x-transition class="absolute mt-0 pt-2 w-48 bg-white rounded-md shadow-xl z-20"
                    style="display: none;">
                    <a href="{{ route('data-jenis-kelamin') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Data Jenis
                        Kelamin</a>
                    <a href="{{ route('data-pendidikan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Data
                        Pendidikan</a>
                    <a href="{{ route('data-kesehatan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Data
                        Kesehatan</a>
                    <a href="{{ route('data-keagamaan') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Data
                        Keagamaan</a>
                    <a href="{{ route('data-ekonomi') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Data
                        Ekonomi</a>
                </div>
            </div>
            <!-- Regulasi Dropdown -->
            <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <button class="flex items-center text-gray-600 hover:text-blue-600 nav-link">
                    Regulasi <i data-lucide="chevron-down" class="w-4 h-4 ml-1 transition-transform"
                        :class="{ 'rotate-180': open }"></i>
                </button>
                <div x-show="open" x-transition class="absolute mt-0 pt-2 w-48 bg-white rounded-md shadow-xl z-20"
                    style="display: none;">
                    <a href="{{ route('produk-hukum.index') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Produk
                        Hukum</a>
                    <a href="{{ route('informasi-publik.index') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Informasi
                        Publik</a>
                </div>
            </div>
            <a href="{{ route('dokumen.index') }}" class="text-gray-600 hover:text-blue-600 nav-link">Dokumen Desa</a>
            <a href="{{ route('galeri.index') }}" class="text-gray-600 hover:text-blue-600 nav-link">Galeri</a>
            <a href="{{ route('berita.index') }}" class="text-gray-600 hover:text-blue-600 nav-link">Berita</a>
        </div>

        <!-- Mobile Menu Button -->
        <div class="lg:hidden">
            <button @click="mobileMenuOpen = !mobileMenuOpen">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" class="lg:hidden" style="display: none;" x-transition>
        <a href="{{ route('welcome') }}" @click="mobileMenuOpen = false"
            class="block py-2 px-4 text-sm hover:bg-gray-200">Home</a>
        <div x-data="{ open: false }">
            <button @click="open = !open"
                class="w-full text-left flex justify-between items-center py-2 px-4 text-sm hover:bg-gray-200">
                Profil Desa <i data-lucide="chevron-down" class="w-4 h-4 transition-transform"
                    :class="{ 'rotate-180': open }"></i>
            </button>
            <div x-show="open" class="pl-4">
                <a href="{{ route('sejarah-desa') }}" @click="mobileMenuOpen = false"
                    class="block py-2 px-4 text-xs hover:bg-gray-100">Sejarah Desa</a>
                <a href="{{ route('profil-wilayah') }}" @click="mobileMenuOpen = false"
                    class="block py-2 px-4 text-xs hover:bg-gray-100">Profil Wilayah Desa</a>
                <a href="{{ route('kondisi-pemerintahan') }}" @click="mobileMenuOpen = false"
                    class="block py-2 px-4 text-xs hover:bg-gray-100">Kondisi Pemerintahan</a>
            </div>
        </div>
        <div x-data="{ open: false }">
            <button @click="open = !open"
                class="w-full text-left flex justify-between items-center py-2 px-4 text-sm hover:bg-gray-200">
                Data Desa <i data-lucide="chevron-down" class="w-4 h-4 transition-transform"
                    :class="{ 'rotate-180': open }"></i>
            </button>
            <div x-show="open" class="pl-4">
                <a href="{{ route('data-jenis-kelamin') }}" @click="mobileMenuOpen = false"
                    class="block py-2 px-4 text-xs hover:bg-gray-100">Data Jenis Kelamin</a>
                <a href="{{ route('data-pendidikan') }}" @click="mobileMenuOpen = false"
                    class="block py-2 px-4 text-xs hover:bg-gray-100">Data Pendidikan</a>
                <a href="{{ route('data-kesehatan') }}" @click="mobileMenuOpen = false"
                    class="block py-2 px-4 text-xs hover:bg-gray-100">Data Kesehatan</a>
                <a href="{{ route('data-keagamaan') }}" @click="mobileMenuOpen = false"
                    class="block py-2 px-4 text-xs hover:bg-gray-100">Data Keagamaan</a>
                <a href="{{ route('data-ekonomi') }}" @click="mobileMenuOpen = false"
                    class="block py-2 px-4 text-xs hover:bg-gray-100">Data Ekonomi</a>
            </div>
        </div>
        <div x-data="{ open: false }">
            <button @click="open = !open"
                class="w-full text-left flex justify-between items-center py-2 px-4 text-sm hover:bg-gray-200">
                Regulasi <i data-lucide="chevron-down" class="w-4 h-4 transition-transform"
                    :class="{ 'rotate-180': open }"></i>
            </button>
            <div x-show="open" class="pl-4">
                <a href="{{ route('produk-hukum.index') }}" @click="mobileMenuOpen = false"
                    class="block py-2 px-4 text-xs hover:bg-gray-100">Produk Hukum</a>
                <a href="{{ route('informasi-publik.index') }}" @click="mobileMenuOpen = false"
                    class="block py-2 px-4 text-xs hover:bg-gray-100">Informasi Publik</a>
            </div>
        </div>
        <a href="{{ route('dokumen.index') }}" @click="mobileMenuOpen = false"
            class="block py-2 px-4 text-sm hover:bg-gray-200">Dokumen Desa</a>
        <a href="{{ route('galeri.index') }}" @click="mobileMenuOpen = false"
            class="block py-2 px-4 text-sm hover:bg-gray-200">Galeri</a>
        <a href="{{ route('berita.index') }}" @click="mobileMenuOpen = false"
            class="block py-2 px-4 text-sm hover:bg-gray-200">Berita</a>
    </div>
</header>
