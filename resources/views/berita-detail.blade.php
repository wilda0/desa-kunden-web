<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $berita->nama_berita }} - Berita Desa Kunden</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>

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

            <!-- Breadcrumbs -->
            <div class="mb-6 text-sm text-gray-500">
                <a href="{{ route('welcome') }}" class="hover:text-blue-600">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('berita.index') }}" class="hover:text-blue-600">Berita Desa</a>
                <span class="mx-2">/</span>
                <span class="text-gray-700">{{ Str::limit($berita->nama_berita, 30) }}</span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-12">

                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <div class="bg-white p-6 md:p-8 rounded-lg shadow-md">
                        <h1 class="text-3xl lg:text-4xl font-bold text-gray-800 mb-4">{{ $berita->nama_berita }}</h1>

                        <!-- Meta Info -->
                        <div class="flex flex-wrap items-center text-sm text-gray-500 mb-6 space-x-4">
                            <span class="flex items-center"><i data-lucide="calendar" class="w-4 h-4 mr-1.5"></i>{{ \Carbon\Carbon::parse($berita->tanggal)->isoFormat('dddd, D MMMM Y') }}</span>
                            <span class="flex items-center"><i data-lucide="user" class="w-4 h-4 mr-1.5"></i>Oleh Administrator</span>
                            <span class="flex items-center"><i data-lucide="eye" class="w-4 h-4 mr-1.5"></i>{{ $berita->views ?? 0 }} kali</span>
                        </div>

                        <!-- Featured Image -->
                        <img src="{{ Storage::url($berita->foto) }}" alt="{{ $berita->nama_berita }}" class="w-full aspect-video object-cover rounded-lg mb-8 shadow">

                        <!-- Article Content -->
                        <div class="prose max-w-none text-gray-700 leading-relaxed">
                            {!! nl2br(e($berita->deskripsi)) !!}
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <aside class="lg:col-span-1 mt-12 lg:mt-0">
                    <div class="sticky top-24">
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-bold border-b pb-3 mb-4">Berita Terbaru</h3>
                            <div class="space-y-4">
                                {{-- Loop untuk berita terbaru --}}
                                @foreach ($latestBeritas as $item)
                                <a href="{{ route('berita.detail', $item) }}" class="flex items-center space-x-3 group">
                                    <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->nama_berita }}" class="w-20 h-20 object-cover rounded-md flex-shrink-0">
                                    <div>
                                        <h4 class="font-semibold text-gray-800 group-hover:text-blue-600 transition-colors line-clamp-2">{{ $item->nama_berita }}</h4>
                                        <p class="text-xs text-gray-500 mt-1">{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMM Y') }}</p>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </main>

    @include('layouts.partials.footer')

    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>
