<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $produkUmkm->nama_produk }} - Produk UMKM Desa Kunden</title>

    <link rel="icon" type="image/png" href="/public/images/logo-kunden.png">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-kunden.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- AlpineJS -->
    <script src="//unpkg.com/alpinejs" defer></script>

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
                <a href="{{ route('produk-umkm.index') }}" class="hover:text-blue-600">Produk UMKM</a>
                <span class="mx-2">/</span>
                <span class="text-gray-700">{{ $produkUmkm->nama_produk }}</span>
            </div>

            <div class="bg-white p-6 md:p-8 rounded-lg shadow-md">
                <div class="flex flex-col md:flex-row gap-4 items-start">
                    <!-- Image Gallery -->
                    <div>
                        <img src="{{ Storage::url($produkUmkm->foto) }}" alt="{{ $produkUmkm->nama_produk }}"
                            class="w-[300px] h-[300px] object-cover rounded-lg shadow-sm">
                    </div>

                    <!-- Product Details -->
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-bold text-gray-800">{{ $produkUmkm->nama_produk }}</h1>

                        <p class="text-2xl md:text-3xl font-bold text-blue-600 my-4">
                            {{ $produkUmkm->format_harga }}
                        </p>
                        <p class="text-gray-600 leading-relaxed">{{ $produkUmkm->deskripsi }}</p>

                        <div class="mt-6">
                            @if ($produkUmkm->nomor_wa)
                                <a href="https://wa.me/{{ $produkUmkm->nomor_wa }}" target="_blank"
                                    class="w-full inline-flex items-center justify-center px-6 py-3 bg-green-500 text-white font-bold rounded-lg hover:bg-green-600 transition-colors">
                                    <i data-lucide="message-square-share" class="w-5 h-5 mr-2"></i>
                                    Hubungi Penjual
                                </a>
                            @else
                                <div class="w-full inline-flex items-center justify-center px-6 py-3 bg-gray-400 text-white font-bold rounded-lg cursor-not-allowed opacity-70">
                                    <i data-lucide="message-square-x" class="w-5 h-5 mr-2"></i>
                                    Nomor WhatsApp tidak tersedia
                                </div>
                            @endif
                        </div>

                        <div class="mt-6 flex items-center space-x-4 text-gray-500">
                            <span class="text-sm">Bagikan:</span>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}" target="_blank" class="hover:text-blue-600">
                                <i data-lucide="facebook"></i>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($produkUmkm->nama_produk . ' - ' . Request::url()) }}" target="_blank" class="hover:text-green-500">
                                <i data-lucide="message-circle"></i>
                            </a>
                            <a href="#" onclick="event.preventDefault(); navigator.clipboard.writeText('{{ Request::url() }}'); alert('Link produk disalin!')" class="hover:text-pink-500 cursor-pointer">
                                <i data-lucide="copy"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ulasan & Komentar Section -->
            <div class="mt-12 bg-white p-6 md:p-8 rounded-lg shadow-md">
                <!-- Daftar Komentar -->
                <h2 class="text-2xl font-bold mb-6">Ulasan & Komentar ({{ $produkUmkm->komentars->count() }})</h2>
                <div class="space-y-6">
                    @forelse($produkUmkm->komentars as $komentar)
                    <div class="flex space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center">
                                <i data-lucide="user" class="text-gray-500"></i>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-baseline space-x-2">
                                <h4 class="font-bold text-gray-800">{{ $komentar->nama }}</h4>
                                <p class="text-xs text-gray-500">{{ $komentar->created_at->diffForHumans() }}</p>
                            </div>
                            <p class="mt-1 text-gray-600">{{ $komentar->isi_komentar }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-center py-4 text-gray-500">Jadilah yang pertama memberikan ulasan.</p>
                    @endforelse
                </div>

                <!-- Form Tinggalkan Komentar -->
                <div class="mt-12 border-t pt-8">
                    <h3 class="text-2xl font-bold mb-6 text-gray-800">Tinggalkan Komentar</h3>

                    @if(session('success'))
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded relative mb-4" role="alert" style="display: none;">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                    @endif

                    <form action="{{ route('produk-umkm.komentar.store', $produkUmkm->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="nama" class="sr-only">Nama</label>
                            <input type="text" name="nama" id="nama" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Nama">
                        </div>
                        <div>
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Email">
                        </div>
                        <div>
                            <label for="isi_komentar" class="sr-only">Komentar Anda</label>
                            <textarea id="isi_komentar" name="isi_komentar" rows="5" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-3 px-4 text-base" placeholder="Tulis komentar Anda di sini..."></textarea>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="inline-flex justify-center py-2 px-8 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Submit Now
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    @include('layouts.partials.footer')

    <script>
        lucide.createIcons();
    </script>
</body>

</html>
