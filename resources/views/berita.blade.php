<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Berita - Website Desa Kunden</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Custom CSS -->
    <style>
        .nav-link {
            position: relative;
            padding-bottom: 0.5rem;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #3B82F6;
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

<body class="bg-gray-100 font-sans text-gray-800">

    <!-- Header & Navbar -->
    @include('layouts.partials.header')

    <main>
        <div class="container mx-auto px-6 lg:px-16 py-12">
            <!-- Breadcrumb and Title -->
            <div class="border-b-2 border-gray-200 pb-4 mb-8">
                <h1 class="text-4xl font-bold text-gray-800">Berita Desa</h1>
                <p class="text-gray-500 mt-2">Menyajikan informasi terbaru tentang peristiwa, berita terkini, dan artikel-artikel jurnalistik dari Desa Kunden.</p>
            </div>

            <!-- Grid for News Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- News Card 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                    <a href="#">
                        <img src="https://placehold.co/600x400/003366/FFFFFF?text=Kegiatan+Desa" alt="Karang Taruna" class="w-full h-48 object-cover group-hover:opacity-80 transition-opacity">
                    </a>
                    <div class="p-5">
                        <h3 class="font-bold text-xl mb-2"><a href="#" class="hover:text-blue-600 transition-colors">Karang Taruna Aktif Dusun Sumber Agung</a></h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">Kegiatan rutin pemuda-pemudi karang taruna dalam rangka menjaga kekompakan dan merencanakan program kerja untuk kemajuan dusun.</p>
                        <div class="flex justify-between items-center text-xs text-gray-500 border-t pt-3">
                            <div class="flex items-center">
                                <i data-lucide="user-2" class="w-4 h-4 mr-1"></i>
                                <span>Administrator</span>
                            </div>
                            <div class="flex items-center">
                                <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                                <span>13 Agustus 2024</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- News Card 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                     <a href="#">
                        <img src="https://placehold.co/600x400/3B82F6/FFFFFF?text=Kunjungan" alt="Kunjungan RW" class="w-full h-48 object-cover group-hover:opacity-80 transition-opacity">
                    </a>
                    <div class="p-5">
                        <h3 class="font-bold text-xl mb-2"><a href="#" class="hover:text-blue-600 transition-colors">KKN UII 2024 Berkunjung ke rumah Pak RW</a></h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">Mahasiswa KKN dari Universitas Islam Indonesia melakukan kunjungan silaturahmi ke kediaman Ketua RW untuk membahas program kerja.</p>
                         <div class="flex justify-between items-center text-xs text-gray-500 border-t pt-3">
                            <div class="flex items-center">
                                <i data-lucide="user-2" class="w-4 h-4 mr-1"></i>
                                <span>Administrator</span>
                            </div>
                            <div class="flex items-center">
                                <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                                <span>13 Agustus 2024</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- News Card 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                    <a href="#">
                        <img src="https://placehold.co/600x400/F59E0B/FFFFFF?text=Warta+Usaha" alt="Warta Usaha" class="w-full h-48 object-cover group-hover:opacity-80 transition-opacity">
                    </a>
                    <div class="p-5">
                        <h3 class="font-bold text-xl mb-2"><a href="#" class="hover:text-blue-600 transition-colors">Warta Usaha Rakyat</a></h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">Melihat lebih dekat geliat UMKM di Desa Kunden, mulai dari usaha jamu herbal hingga kuliner mie ayam yang legendaris.</p>
                        <div class="flex justify-between items-center text-xs text-gray-500 border-t pt-3">
                            <div class="flex items-center">
                                <i data-lucide="user-2" class="w-4 h-4 mr-1"></i>
                                <span>Administrator</span>
                            </div>
                            <div class="flex items-center">
                                <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                                <span>13 Agustus 2024</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- News Card 4 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                    <a href="#">
                        <img src="https://placehold.co/600x400/10B981/FFFFFF?text=Sosialisasi+UMKM" alt="Sosialisasi UMKM" class="w-full h-48 object-cover group-hover:opacity-80 transition-opacity">
                    </a>
                    <div class="p-5">
                        <h3 class="font-bold text-xl mb-2"><a href="#" class="hover:text-blue-600 transition-colors">Sosialisasi Pemasaran Digital & Perizinan UMKM</a></h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">Pemerintah desa bekerja sama dengan akademisi untuk memberikan pelatihan pemasaran online dan bantuan perizinan bagi pelaku UMKM.</p>
                        <div class="flex justify-between items-center text-xs text-gray-500 border-t pt-3">
                            <div class="flex items-center">
                                <i data-lucide="user-2" class="w-4 h-4 mr-1"></i>
                                <span>Administrator</span>
                            </div>
                            <div class="flex items-center">
                                <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                                <span>13 Agustus 2024</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- News Card 5 -->
                 <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                    <a href="#">
                        <img src="https://placehold.co/600x400/8B5CF6/FFFFFF?text=Gotong+Royong" alt="Gotong Royong" class="w-full h-48 object-cover group-hover:opacity-80 transition-opacity">
                    </a>
                    <div class="p-5">
                        <h3 class="font-bold text-xl mb-2"><a href="#" class="hover:text-blue-600 transition-colors">Kerja Bakti Membersihkan Saluran Irigasi</a></h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">Warga bahu-membahu membersihkan saluran irigasi utama desa untuk menyambut musim tanam agar distribusi air lancar.</p>
                        <div class="flex justify-between items-center text-xs text-gray-500 border-t pt-3">
                            <div class="flex items-center">
                                <i data-lucide="user-2" class="w-4 h-4 mr-1"></i>
                                <span>Administrator</span>
                            </div>
                            <div class="flex items-center">
                                <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                                <span>5 Agustus 2024</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- News Card 6 -->
                 <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                    <a href="#">
                        <img src="https://placehold.co/600x400/EC4899/FFFFFF?text=Pentas+Seni" alt="Pentas Seni" class="w-full h-48 object-cover group-hover:opacity-80 transition-opacity">
                    </a>
                    <div class="p-5">
                        <h3 class="font-bold text-xl mb-2"><a href="#" class="hover:text-blue-600 transition-colors">Pentas Seni dan Budaya Desa</a></h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">Malam puncak perayaan hari jadi desa dimeriahkan dengan berbagai pertunjukan seni dan budaya dari warga setempat.</p>
                        <div class="flex justify-between items-center text-xs text-gray-500 border-t pt-3">
                            <div class="flex items-center">
                                <i data-lucide="user-2" class="w-4 h-4 mr-1"></i>
                                <span>Administrator</span>
                            </div>
                            <div class="flex items-center">
                                <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                                <span>1 Agustus 2024</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                <nav class="flex items-center space-x-2">
                    <a href="#" class="px-3 py-1 rounded-md text-gray-500 hover:bg-gray-200">«</a>
                    <a href="#" class="px-3 py-1 rounded-md bg-blue-600 text-white">1</a>
                    <a href="#" class="px-3 py-1 rounded-md text-gray-700 hover:bg-gray-200">2</a>
                    <a href="#" class="px-3 py-1 rounded-md text-gray-700 hover:bg-gray-200">3</a>
                    <span class="px-3 py-1 text-gray-500">...</span>
                    <a href="#" class="px-3 py-1 rounded-md text-gray-700 hover:bg-gray-200">8</a>
                    <a href="#" class="px-3 py-1 rounded-md text-gray-500 hover:bg-gray-200">»</a>
                </nav>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-16">
        <div class="container mx-auto px-6 lg:px-16 py-12">
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
                               <a href="{{ url('/dashboard') }}" class="text-gray-300 hover:text-white hover:underline transition">Dashboard</a>
                           @else
                               <a href="{{ route('login') }}" class="text-gray-300 hover:text-white hover:underline transition">Log in</a>

                               @if (Route::has('register'))
                                   <a href="{{ route('register') }}" class="text-gray-300 hover:text-white hover:underline transition">Register</a>
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
    </script>
</body>

</html>
