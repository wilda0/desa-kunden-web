<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Berita - Website Desa Kunden</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo-kunden.png') }}">

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
                <nav class="text-sm mb-4 text-gray-500">
                    <a href="{{ route('welcome') }}" class="hover:text-blue-600">Home</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-700">Berita Desa</span>
                </nav>
                <h1 class="text-4xl font-bold text-gray-800">Berita Desa</h1>
                <p class="text-gray-500 mt-2">Menyajikan informasi terbaru tentang peristiwa, berita terkini, dan
                    artikel-artikel jurnalistik dari Desa Kunden.</p>
            </div>

            @php use Illuminate\Support\Str; @endphp
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($beritas as $berita)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                        <a href="{{ route('berita.detail', $berita->id) }}">
                            <img src="{{ Storage::url($berita->foto) }}" alt="{{ $berita->nama_berita }}"
                                class="w-full h-48 object-cover group-hover:opacity-80 transition-opacity">
                        </a>
                        <div class="p-5">
                            <h3 class="font-bold text-xl mb-2">
                                <a href="{{ route('berita.detail', $berita->id) }}"
                                    class="hover:text-blue-600 transition-colors">
                                    {{ $berita->nama_berita }}
                                </a>
                            </h3>
                            <div class="text-xs font-semibold text-blue-600 mb-2 uppercase">
                                {{ $berita->jenis }}
                            </div>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ Str::limit($berita->deskripsi, 150) }}
                            </p>
                            <div class="flex justify-between items-center text-xs text-gray-500 border-t pt-3">
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center">
                                        <i data-lucide="user-2" class="w-4 h-4 mr-1"></i>
                                        <span>Administrator</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i data-lucide="eye" class="w-4 h-4 mr-1"></i>
                                        <span>{{ $berita->views ?? 0 }} kali</span>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                                    <span>{{ \Carbon\Carbon::parse($berita->tanggal)->isoFormat('D MMMM Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $beritas->links() }}
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
