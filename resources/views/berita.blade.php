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
    @include('layouts.partials.footer')


    <!-- AlpineJS for interactivity -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>
