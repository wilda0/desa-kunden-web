<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Website Desa Kunden</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Custom CSS for Marquee, Sliders, and Navbar Animation -->
    <style>
        .marquee-content {
            animation: marquee 30s linear infinite;
        }

        @keyframes marquee {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        /* Hide scrollbar for slider containers */
        .slider-container {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .slider-container::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari, and Opera */
        }

        /* Navbar underline animation */
        .nav-link {
            position: relative;
            padding-bottom: 0.5rem;
            /* Space for the underline */
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #3B82F6;
            /* blue-600 */
            transform: scaleX(0);
            transform-origin: bottom right;
            transition: transform 0.3s ease-out;
        }

        .nav-link:hover::after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans text-gray-800">

    <!-- Top Marquee -->
    <div class="bg-blue-800 text-white py-2 overflow-hidden">
        <div class="marquee-content whitespace-nowrap">
            <p>Selamat Datang di Website Resmi Pemerintah Desa Kunden, Kecamatan Bulu, Kabupaten Sukoharjo, Jawa Tengah
            </p>
        </div>
    </div>

    <!-- Header & Navbar -->
    @include('layouts.partials.header')

    <main x-data="{ showMore: false }">
        <!-- Hero Section -->
        <section id="home" class="relative h-[60vh] md:h-[80vh] bg-cover bg-center"
            style="background-image: url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=1932&auto=format&fit=crop');">
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="relative z-10 flex flex-col items-center justify-center h-full text-white text-center px-4">
                <h1 class="text-4xl md:text-6xl font-bold mb-4 animate-fade-in-down">Selamat Datang</h1>
                <p class="text-lg md:text-xl max-w-3xl mb-6">Website Pemerintah Desa Kunden, Kecamatan Bulu, Kabupaten
                    Sukoharjo</p>
                <div class="max-w-3xl">
                    <p x-show="!showMore" class="transition-all">Desa Kunden terletak di Kecamatan Bulu, Sukoharjo,
                        Jawa Tengah. Kecamatan Bulu merupakan dataran tinggi, dengan topografi relatif miring yaitu 693
                        m di atas permukaan laut, dengan luas wilayah 43,96 km².</p>
                    <div x-show="showMore" style="display:none;" class="text-left space-y-3"
                        x-transition:enter="transition ease-out duration-500"
                        x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-screen"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 max-h-screen"
                        x-transition:leave-end="opacity-0 max-h-0">
                        <p>Desa Kunden telah berdiri sejak tahun 1942 sebagai hasil pemekaran dari Desa Bulu, Kamal, dan
                            Puron. Desa ini berada pada koordinat -7°44′57″ LS dan 110°49′10″ BT. Secara administratif
                            terdiri dari tiga dusun dan delapan dukuh, dengan 20 RT dan 9 RW, serta jumlah penduduk
                            sebanyak 3.233 jiwa (1.618 pria, 1.615 wanita) dalam 973 kepala keluarga. Mayoritas beragama
                            Islam, dengan jumlah masjid/mushola sebanyak 22 unit.</p>
                        <p>Sebagian besar penduduk bekerja di sektor pertanian khususnya sawah yang dialiri oleh
                            jaringan irigasi dari Waduk Gajah Mungkur sejak 1990-an dengan UMKM aktif dalam pembuatan
                            kendang, peternakan ayam, penggemukan kambing, hingga produksi arang.</p>
                        <p>Secara ringkas, Desa Kunden adalah desa agraris dengan basis pertanian teririgasi, dukungan
                            UMKM yang beragam, infrastruktur pemerintahan dan pendidikan yang memadai, serta masyarakat
                            yang aktif dan harmonis menjadikannya salah satu desa berkembang di wilayah Kecamatan Bulu.
                        </p>
                    </div>
                    <button @click="showMore = !showMore"
                        class="mt-8 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full transition duration-300">
                        <span x-text="showMore ? 'Tutup' : 'Lihat Selengkapnya'"></span>
                    </button>
                </div>
            </div>
        </section>

        <!-- Information Cards -->
        <section id="info-cards" class="py-16 bg-white">
            <div class="container mx-auto px-16">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Cards Here... -->
                    <div
                        class="flex items-start space-x-4 p-6 border border-gray-200 rounded-lg hover:shadow-lg transition-shadow">
                        <div class="bg-blue-100 text-blue-600 p-3 rounded-full"><i data-lucide="user-circle"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-1">Profil Desa</h3>
                            <p class="text-gray-600 text-sm">Informasi mengenai profil, sejarah, dan kondisi
                                pemerintahan.</p>
                        </div>
                    </div>
                    <div
                        class="flex items-start space-x-4 p-6 border border-gray-200 rounded-lg hover:shadow-lg transition-shadow">
                        <div class="bg-green-100 text-green-600 p-3 rounded-full"><i data-lucide="database"></i></div>
                        <div>
                            <h3 class="font-bold text-lg mb-1">Data Desa</h3>
                            <p class="text-gray-600 text-sm">Data jenis kelamin, pendidikan, kesehatan, keagamaan, dan
                                ekonomi.</p>
                        </div>
                    </div>
                    <div
                        class="flex items-start space-x-4 p-6 border border-gray-200 rounded-lg hover:shadow-lg transition-shadow">
                        <div class="bg-yellow-100 text-yellow-600 p-3 rounded-full"><i data-lucide="gavel"></i></div>
                        <div>
                            <h3 class="font-bold text-lg mb-1">Regulasi</h3>
                            <p class="text-gray-600 text-sm">Produk Hukum dan Informasi Publik.</p>
                        </div>
                    </div>
                    <div
                        class="flex items-start space-x-4 p-6 border border-gray-200 rounded-lg hover:shadow-lg transition-shadow">
                        <div class="bg-purple-100 text-purple-600 p-3 rounded-full"><i data-lucide="file-text"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-1">Dokumen Desa</h3>
                            <p class="text-gray-600 text-sm">Informasi dokumen resmi penyelenggaraan pemerintahan desa.
                            </p>
                        </div>
                    </div>
                    <div
                        class="flex items-start space-x-4 p-6 border border-gray-200 rounded-lg hover:shadow-lg transition-shadow">
                        <div class="bg-pink-100 text-pink-600 p-3 rounded-full"><i data-lucide="image"></i></div>
                        <div>
                            <h3 class="font-bold text-lg mb-1">Galeri</h3>
                            <p class="text-gray-600 text-sm">Koleksi foto dan video kegiatan serta keindahan Desa
                                Kunden.</p>
                        </div>
                    </div>
                    <div
                        class="flex items-start space-x-4 p-6 border border-gray-200 rounded-lg hover:shadow-lg transition-shadow">
                        <div class="bg-indigo-100 text-indigo-600 p-3 rounded-full"><i data-lucide="newspaper"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-1">Berita</h3>
                            <p class="text-gray-600 text-sm">Menyajikan informasi terbaru tentang peristiwa, berita
                                terkini, dan artikel-artikel.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pengumuman & Progress Section -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-16 grid grid-cols-1 md:grid-cols-2 gap-12">
                <div>
                    <h2 class="text-3xl font-bold mb-6 text-center md:text-left">Pengumuman Desa</h2>
                    <div class="space-y-4">
                        <div class="bg-white p-4 rounded-lg shadow-sm flex items-center space-x-4">
                            <div class="bg-blue-100 p-3 rounded-full text-blue-500"><i data-lucide="megaphone"></i>
                            </div>
                            <div>
                                <p class="font-semibold">Pedagang Mie Ayam Mas Aris di Dusun Sumber Agung</p>
                                <span class="text-xs text-gray-500">13 Agustus 2024</span>
                            </div>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm flex items-center space-x-4">
                            <div class="bg-blue-100 p-3 rounded-full text-blue-500"><i data-lucide="megaphone"></i>
                            </div>
                            <div>
                                <p class="font-semibold">Informasi Jadwal Posyandu Bulan Ini</p>
                                <span class="text-xs text-gray-500">10 Agustus 2024</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-bold mb-6 text-center md:text-left">Progres Pembangunan</h2>
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <p class="font-semibold mb-2">Pembangunan Jalan Usaha Tani</p>
                        <div class="w-full bg-gray-200 rounded-full h-4 mb-1">
                            <div class="bg-green-500 h-4 rounded-full" style="width: 75%"></div>
                        </div>
                        <p class="text-sm text-right text-gray-600">75% Selesai</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Berita Section -->
        <section id="berita" class="py-16 bg-white" x-data="slider()">
            <div class="container mx-auto px-16">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-3xl font-bold text-center sm:text-left">Berita Desa</h2>
                    <div class="hidden sm:flex space-x-2">
                        <button @click="scroll('left')"
                            class="p-2 rounded-full bg-gray-200 hover:bg-gray-300 transition-colors disabled:opacity-50"
                            :disabled="atStart"><i data-lucide="arrow-left" class="w-5 h-5"></i></button>
                        <button @click="scroll('right')"
                            class="p-2 rounded-full bg-gray-200 hover:bg-gray-300 transition-colors disabled:opacity-50"
                            :disabled="atEnd"><i data-lucide="arrow-right" class="w-5 h-5"></i></button>
                    </div>
                </div>
                <div class="overflow-hidden">
                    <div x-ref="slider" @scroll.debounce.100ms="updateButtons()"
                        class="flex overflow-x-auto space-x-6 pb-4 slider-container snap-x snap-mandatory scroll-smooth">
                        <!-- Berita Items -->
                        <div class="flex-shrink-0 w-80 snap-start">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden h-full">
                                <img src="https://placehold.co/600x400/003366/FFFFFF?text=Kegiatan+Desa"
                                    alt="Karang Taruna" class="w-full h-40 object-cover">
                                <div class="p-4">
                                    <h3 class="font-bold text-lg mb-2">Karang Taruna Aktif Dusun Sumber Agung</h3>
                                    <p class="text-xs text-gray-500 mb-3">13 Agustus 2024</p>
                                    <a href="#" class="text-blue-600 hover:underline text-sm font-semibold">Baca
                                        Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        <div class="flex-shrink-0 w-80 snap-start">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden h-full">
                                <img src="https://placehold.co/600x400/3B82F6/FFFFFF?text=Kunjungan"
                                    alt="Kunjungan RW" class="w-full h-40 object-cover">
                                <div class="p-4">
                                    <h3 class="font-bold text-lg mb-2">KKN UII 2024 Berkunjung ke rumah Pak RW</h3>
                                    <p class="text-xs text-gray-500 mb-3">13 Agustus 2024</p>
                                    <a href="#" class="text-blue-600 hover:underline text-sm font-semibold">Baca
                                        Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        <div class="flex-shrink-0 w-80 snap-start">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden h-full">
                                <img src="https://placehold.co/600x400/F59E0B/FFFFFF?text=Warta+Usaha"
                                    alt="Warta Usaha" class="w-full h-40 object-cover">
                                <div class="p-4">
                                    <h3 class="font-bold text-lg mb-2">Warta Usaha Rakyat</h3>
                                    <p class="text-xs text-gray-500 mb-3">13 Agustus 2024</p>
                                    <a href="#" class="text-blue-600 hover:underline text-sm font-semibold">Baca
                                        Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        <div class="flex-shrink-0 w-80 snap-start">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden h-full">
                                <img src="https://placehold.co/600x400/10B981/FFFFFF?text=Sosialisasi+UMKM"
                                    alt="Sosialisasi UMKM" class="w-full h-40 object-cover">
                                <div class="p-4">
                                    <h3 class="font-bold text-lg mb-2">Sosialisasi Pemasaran Digital & Perizinan UMKM
                                    </h3>
                                    <p class="text-xs text-gray-500 mb-3">13 Agustus 2024</p>
                                    <a href="#" class="text-blue-600 hover:underline text-sm font-semibold">Baca
                                        Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        <div class="flex-shrink-0 w-80 snap-start">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden h-full">
                                <img src="https://placehold.co/600x400/8B5CF6/FFFFFF?text=Gotong+Royong"
                                    alt="Gotong Royong" class="w-full h-40 object-cover">
                                <div class="p-4">
                                    <h3 class="font-bold text-lg mb-2">Kerja Bakti Membersihkan Saluran Irigasi</h3>
                                    <p class="text-xs text-gray-500 mb-3">5 Agustus 2024</p>
                                    <a href="#" class="text-blue-600 hover:underline text-sm font-semibold">Baca
                                        Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        <div class="flex-shrink-0 w-80 snap-start">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden h-full">
                                <img src="https://placehold.co/600x400/EC4899/FFFFFF?text=Pentas+Seni"
                                    alt="Pentas Seni" class="w-full h-40 object-cover">
                                <div class="p-4">
                                    <h3 class="font-bold text-lg mb-2">Pentas Seni dan Budaya Desa</h3>
                                    <p class="text-xs text-gray-500 mb-3">1 Agustus 2024</p>
                                    <a href="#" class="text-blue-600 hover:underline text-sm font-semibold">Baca
                                        Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        <div class="flex-shrink-0 w-80 snap-start">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden h-full">
                                <img src="https://placehold.co/600x400/EF4444/FFFFFF?text=Lomba+17an" alt="Lomba 17an"
                                    class="w-full h-40 object-cover">
                                <div class="p-4">
                                    <h3 class="font-bold text-lg mb-2">Lomba-Lomba HUT RI ke-79</h3>
                                    <p class="text-xs text-gray-500 mb-3">28 Juli 2024</p>
                                    <a href="#" class="text-blue-600 hover:underline text-sm font-semibold">Baca
                                        Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        <div class="flex-shrink-0 w-80 snap-start">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden h-full">
                                <img src="https://placehold.co/600x400/F97316/FFFFFF?text=Pelatihan"
                                    alt="Pelatihan Pertanian" class="w-full h-40 object-cover">
                                <div class="p-4">
                                    <h3 class="font-bold text-lg mb-2">Pelatihan Pertanian Organik Modern</h3>
                                    <p class="text-xs text-gray-500 mb-3">25 Juli 2024</p>
                                    <a href="#" class="text-blue-600 hover:underline text-sm font-semibold">Baca
                                        Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-8">
                    <a href="{{ route('berita.index') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full transition duration-300">Lihat
                        Semua Berita</a>
                </div>
            </div>
        </section>

        <!-- Galeri Section -->
        <section id="galeri" class="py-16 bg-gray-50">
            <div class="container mx-auto px-16">
                <h2 class="text-3xl font-bold mb-8 text-center">Galeri Desa</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <img src="https://placehold.co/400x300/CCCCCC/FFFFFF?text=Foto+1"
                        class="rounded-lg shadow-md w-full h-full object-cover aspect-square hover:scale-105 transition-transform duration-300"
                        alt="Galeri 1">
                    <img src="https://placehold.co/400x300/CCCCCC/FFFFFF?text=Foto+2"
                        class="rounded-lg shadow-md w-full h-full object-cover aspect-square hover:scale-105 transition-transform duration-300"
                        alt="Galeri 2">
                    <img src="https://placehold.co/400x300/CCCCCC/FFFFFF?text=Foto+3"
                        class="rounded-lg shadow-md w-full h-full object-cover aspect-square hover:scale-105 transition-transform duration-300"
                        alt="Galeri 3">
                    <img src="https://placehold.co/400x300/CCCCCC/FFFFFF?text=Foto+4"
                        class="rounded-lg shadow-md w-full h-full object-cover aspect-square hover:scale-105 transition-transform duration-300"
                        alt="Galeri 4">
                </div>
                <div class="text-center mt-8">
                    <a href="#"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full transition duration-300">Lihat
                        Semua Galeri</a>
                </div>
            </div>
        </section>

        <!-- Aparatur Desa Section -->
        <section id="aparatur" class="py-16 bg-white" x-data="slider()">
            <div class="container mx-auto px-16">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-3xl font-bold text-center sm:text-left">Aparatur Desa</h2>
                    <div class="hidden sm:flex space-x-2">
                        <button @click="scroll('left')"
                            class="p-2 rounded-full bg-gray-200 hover:bg-gray-300 transition-colors disabled:opacity-50"
                            :disabled="atStart"><i data-lucide="arrow-left" class="w-5 h-5"></i></button>
                        <button @click="scroll('right')"
                            class="p-2 rounded-full bg-gray-200 hover:bg-gray-300 transition-colors disabled:opacity-50"
                            :disabled="atEnd"><i data-lucide="arrow-right" class="w-5 h-5"></i></button>
                    </div>
                </div>
                <div class="overflow-hidden">
                    <div x-ref="slider" @scroll.debounce.100ms="updateButtons()"
                        class="flex overflow-x-auto gap-6 pb-4 slider-container snap-x snap-mandatory scroll-smooth">

                        <div class="flex-shrink-0 w-52 snap-start">
                            <div
                                class="bg-gray-50 rounded-lg shadow-md overflow-hidden h-full group transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-xl">
                                <img src="https://placehold.co/208x288/EFEFEF/777777?text=Foto" alt="Aparatur Desa 1"
                                    class="w-full h-56 object-cover object-center">
                                <div class="p-3 text-center">
                                    <h4 class="font-bold text-md">Nama Pejabat 1</h4>
                                    <p class="text-gray-500 text-xs">Jabatan</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex-shrink-0 w-52 snap-start">
                            <div
                                class="bg-gray-50 rounded-lg shadow-md overflow-hidden h-full group transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-xl">
                                <img src="https://placehold.co/208x288/EFEFEF/777777?text=Foto" alt="Aparatur Desa 2"
                                    class="w-full h-56 object-cover object-center">
                                <div class="p-3 text-center">
                                    <h4 class="font-bold text-md">Nama Pejabat 2</h4>
                                    <p class="text-gray-500 text-xs">Jabatan</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex-shrink-0 w-52 snap-start">
                            <div
                                class="bg-gray-50 rounded-lg shadow-md overflow-hidden h-full group transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-xl">
                                <img src="https://placehold.co/208x288/EFEFEF/777777?text=Foto" alt="Aparatur Desa 3"
                                    class="w-full h-56 object-cover object-center">
                                <div class="p-3 text-center">
                                    <h4 class="font-bold text-md">Nama Pejabat 3</h4>
                                    <p class="text-gray-500 text-xs">Jabatan</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex-shrink-0 w-52 snap-start">
                            <div
                                class="bg-gray-50 rounded-lg shadow-md overflow-hidden h-full group transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-xl">
                                <img src="https://placehold.co/208x288/EFEFEF/777777?text=Foto" alt="Aparatur Desa 4"
                                    class="w-full h-56 object-cover object-center">
                                <div class="p-3 text-center">
                                    <h4 class="font-bold text-md">Nama Pejabat 4</h4>
                                    <p class="text-gray-500 text-xs">Jabatan</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex-shrink-0 w-52 snap-start">
                            <div
                                class="bg-gray-50 rounded-lg shadow-md overflow-hidden h-full group transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-xl">
                                <img src="https://placehold.co/208x288/EFEFEF/777777?text=Foto" alt="Aparatur Desa 5"
                                    class="w-full h-56 object-cover object-center">
                                <div class="p-3 text-center">
                                    <h4 class="font-bold text-md">Nama Pejabat 5</h4>
                                    <p class="text-gray-500 text-xs">Jabatan</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex-shrink-0 w-52 snap-start">
                            <div
                                class="bg-gray-50 rounded-lg shadow-md overflow-hidden h-full group transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-xl">
                                <img src="https://placehold.co/208x288/EFEFEF/777777?text=Foto" alt="Aparatur Desa 6"
                                    class="w-full h-56 object-cover object-center">
                                <div class="p-3 text-center">
                                    <h4 class="font-bold text-md">Nama Pejabat 6</h4>
                                    <p class="text-gray-500 text-xs">Jabatan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white">
        <div class="container mx-auto px-16 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Tentang -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Tentang Desa Kunden</h3>
                    <p class="text-gray-400 text-sm">Desa Kunden terletak di Kecamatan Bulu, Sukoharjo, Jawa Tengah
                        dengan luas wilayah 43,96 km². Desa ini memiliki potensi pertanian, pariwisata, dan budaya yang
                        kaya.</p>
                </div>
                <!-- Kontak -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Kontak</h3>
                    <ul class="text-gray-400 text-sm space-y-2">
                        <li class="flex items-start"><i data-lucide="map-pin"
                                class="w-4 h-4 mr-2 mt-1"></i><span>Kantor Desa Kunden, Kecamatan Bulu, Kabupaten
                                Sukoharjo, Jawa Tengah</span></li>
                        <li class="flex items-center"><i data-lucide="mail"
                                class="w-4 h-4 mr-2"></i><span>desakunden5@gmail.com</span></li>
                        <li class="flex items-center"><i data-lucide="phone" class="w-4 h-4 mr-2"></i><span>(0271)
                                XXXXXX</span></li>
                        <li class="flex items-center"><i data-lucide="clock" class="w-4 h-4 mr-2"></i><span>Senin -
                                Jumat: 08.00-15.00 WIB</span></li>
                    </ul>
                </div>
                <!-- Peta & Akses Pengguna -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Peta Wilayah</h3>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31631.579603091988!2d110.80108389334546!3d-7.690184499999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a36e133c16a1b%3A0x5027a76e3568c90!2sBulu%2C%20Kabupaten%20Sukoharjo%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1718967923483!5m2!1sid!2sid"
                        width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy"
                        class="rounded-lg mb-4" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>

                    @if (Route::has('login'))
                        <div class="mt-4">
                            <h3 class="text-xl font-bold mb-2">Akses Pengguna</h3>
                            <div class="flex items-center space-x-4 text-sm">
                                @auth
                                    <a href="{{ url('/dashboard') }}"
                                        class="text-gray-300 hover:text-white hover:underline transition">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="text-gray-300 hover:text-white hover:underline transition">Log in</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}"
                                            class="text-gray-300 hover:text-white hover:underline transition">Register</a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
        <div class="bg-gray-900 py-4">
            <p class="text-center text-gray-500 text-sm">&copy; 2024 Pemerintah Desa Kunden. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- AlpineJS for interactivity -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        lucide.createIcons();

        function slider() {
            return {
                atStart: true,
                atEnd: false,
                init() {
                    this.$nextTick(() => {
                        this.updateButtons();
                    });
                },
                scroll(direction) {
                    const container = this.$refs.slider;
                    const scrollAmount = container.clientWidth * 0.75;
                    if (direction === 'left') {
                        container.scrollLeft -= scrollAmount;
                    } else {
                        container.scrollLeft += scrollAmount;
                    }
                },
                updateButtons() {
                    const container = this.$refs.slider;
                    this.atStart = container.scrollLeft <= 10;
                    this.atEnd = container.scrollLeft + container.clientWidth >= container.scrollWidth - 10;
                }
            }
        }
    </script>
</body>

</html>
