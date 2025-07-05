<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dokumen - Website Desa Kunden</title>

    <link rel="icon" type="image/png" href="/public/images/logo-kunden.png">

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

    @include('layouts.partials.header')

    <main>
        <div class="container mx-auto px-6 lg:px-16 py-12">

            <!-- PPID Section -->
            <section id="ppid-intro" class="mb-16">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                    <div>
                        <nav class="text-sm mb-4 text-gray-500">
                            <a href="{{ route('welcome') }}" class="hover:text-blue-600">Home</a>
                            <span class="mx-2">/</span>
                            <span class="text-gray-700">Dokumen</span>
                        </nav>
                        <h1 class="text-4xl font-bold text-gray-800 mb-4">PPID</h1>
                        <p class="text-gray-600 mb-6">
                            Pejabat Pengelola Informasi dan Dokumentasi (PPID) adalah pejabat yang bertanggung jawab di
                            bidang penyimpanan, pendokumentasian, penyediaan, dan/atau pelayanan informasi di badan
                            publik.
                        </p>
                    </div>
                    <div class="grid grid-cols-3 gap-4 text-center">
                        <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-sm">
                            <i data-lucide="folder-archive" class="w-12 h-12 text-blue-500 mb-3"></i>
                            <span class="text-sm font-semibold text-gray-700">Informasi Secara Berkala</span>
                        </div>
                        <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-sm">
                            <i data-lucide="file-check-2" class="w-12 h-12 text-green-500 mb-3"></i>
                            <span class="text-sm font-semibold text-gray-700">Informasi Serta Merta</span>
                        </div>
                        <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-sm">
                            <i data-lucide="clock-4" class="w-12 h-12 text-purple-500 mb-3"></i>
                            <span class="text-sm font-semibold text-gray-700">Informasi Setiap Saat</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Informasi Publik Terbaru Section -->
            <section id="informasi-publik">
                <div class="border-t-2 border-gray-200 pt-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Informasi Publik Terbaru</h2>
                    <p class="text-gray-500 mb-8">Update terakhir 2 tahun yang lalu</p>
                </div>

                <!-- Daftar Dokumen -->
                <div class="space-y-6">
                    @foreach ($dokumens as $dokumen)
                        <div
                            class="bg-white rounded-lg shadow-sm p-6 flex flex-col md:flex-row justify-between items-start md:items-center">
                            <div>
                                <h3 class="font-bold text-xl mb-2 text-gray-800">{{ $dokumen->judul }}</h3>
                                <div class="flex items-center text-gray-500 text-sm space-x-4">
                                    <span class="flex items-center">
                                        <i data-lucide="book" class="w-4 h-4 mr-1.5"></i>{{ $dokumen->jenis_dokumen }}
                                    </span>
                                    <span class="flex items-center">
                                        <i data-lucide="calendar" class="w-4 h-4 mr-1.5"></i>
                                        {{ \Carbon\Carbon::parse($dokumen->tanggal_input)->isoFormat('dddd, D MMMM Y') }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex space-x-3 mt-4 md:mt-0 flex-shrink-0">
                                <a href="{{ Storage::url($dokumen->file_path) }}" target="_blank"
                                    class="bg-blue-100 text-blue-700 font-semibold px-4 py-2 rounded-lg flex items-center space-x-2 hover:bg-blue-200 transition-colors">
                                    <i data-lucide="eye" class="w-5 h-5"></i>
                                    <span>Lihat Berkas</span>
                                </a>
                                <a href="{{ route('dokumen.download', $dokumen->id) }}"
                                    class="bg-green-100 text-green-700 font-semibold px-4 py-2 rounded-lg flex items-center space-x-2 hover:bg-green-200 transition-colors">
                                    <i data-lucide="download-cloud" class="w-5 h-5"></i>
                                    <span>Unduh ({{ $dokumen->download_count }}x)</span>
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </section>

            <!-- Ajukan Permohonan Informasi Section -->
            <section id="permohonan-info" class="mt-16 text-center bg-gray-200/50 p-10 rounded-lg">
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Ingin mengajukan permohonan informasi?</h2>
                <a href="{{ route('permohonan.create') }}"
                    class="inline-block bg-white text-blue-600 font-semibold border border-blue-600 px-8 py-3 rounded-lg hover:bg-blue-600 hover:text-white transition-colors duration-300 mt-4">
                    Ajukan Permohonan Informasi
                </a>
            </section>

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
