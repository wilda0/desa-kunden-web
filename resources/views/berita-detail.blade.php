<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $berita->nama_berita }} - Berita Desa Kunden</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo-kunden.png') }}">

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

        .prose a {
            color: #2563eb;
            text-decoration: underline;
        }

        .prose a:hover {
            color: #1d4ed8;
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
                        <div class="flex flex-wrap items-center justify-between text-sm text-gray-500 mb-6">
                            <span class="flex items-center mb-2 md:mb-0">
                                <i data-lucide="calendar" class="w-4 h-4 mr-1.5"></i>{{ \Carbon\Carbon::parse($berita->tanggal)->isoFormat('dddd, D MMMM Y') }}
                            </span>

                            <div class="flex items-center space-x-4">
                                <span class="flex items-center"><i data-lucide="user" class="w-4 h-4 mr-1.5"></i>Oleh Administrator</span>
                                <span class="flex items-center"><i data-lucide="eye" class="w-4 h-4 mr-1.5"></i>Dilihat {{ $berita->views ?? 0 }} kali</span>
                            </div>
                        </div>

                        <!-- Featured Image -->
                        <img src="{{ Storage::url($berita->foto) }}" alt="{{ $berita->nama_berita }}" class="w-full aspect-video object-cover rounded-lg mb-8 shadow">

                        <!-- Article Content -->
                        <div class="prose max-w-none text-gray-700 leading-relaxed">
                            {!! $berita->deskripsi !!}
                        </div>

                        @if ($berita->id == 15)
                            <div class="mt-12 space-y-6">
                                <h3 class="text-xl font-bold text-gray-800">Produk UMKM Terkait</h3>
                                @foreach ($produkUmkms as $produk)
                                    <div class="flex items-start border p-4 rounded-md shadow-sm bg-white">
                                        <img src="{{ asset('storage/' . $produk->foto) }}" alt="{{ $produk->nama_produk }}" class="w-24 h-24 object-cover rounded mr-4">

                                        <div class="flex-1">
                                            <h4 class="text-lg font-semibold">{{ $produk->nama_produk }}</h4>
                                            <p class="text-sm text-gray-600 mb-1">{{ $produk->format_harga }}</p>
                                            <p class="text-sm text-gray-700">{{ $produk->deskripsi }}</p>

                                            @if ($produk->nomor_wa)
                                                <a href="https://wa.me/{{ $produk->nomor_wa }}" target="_blank"
                                                class="inline-block mt-2 px-3 py-1 bg-green-500 text-white text-xs font-semibold rounded hover:bg-green-700">
                                                    Hubungi Penjual
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Show & Form Komentar -->
                        @if($komentars->count())
                        <div class="mt-12">
                            <h3 class="text-xl font-bold mb-4">Komentar</h3>
                            <div class="space-y-6">
                                @foreach($komentars as $komentar)
                                    <div class="bg-gray-100 p-4 rounded-md shadow-sm">
                                        <div class="flex justify-between items-center mb-1">
                                            <strong>{{ $komentar->nama }}</strong>
                                            <span class="text-xs text-gray-500">{{ $komentar->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-sm text-gray-700">{{ $komentar->isi_komentar }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <div class="mt-12 border-t pt-8">
                            <h3 class="text-2xl font-bold mb-6 text-gray-800">Tinggalkan Komentar</h3>

                            @if(session('success'))
                            <div x-data="{ show: true }"
                                x-init="setTimeout(() => show = false, 5000)"
                                x-show="show"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform translate-y-2"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded relative mb-4"
                                role="alert"
                                style="display: none;">
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                            @endif

                            <form action="{{ route('berita.komentar', $berita->id) }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <input type="text" name="nama" required class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 py-3 px-4" placeholder="Nama">
                                </div>
                                <div>
                                    <input type="email" name="email" required class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 py-3 px-4" placeholder="Email (wajib mengandung @)">
                                </div>
                                <div>
                                    <textarea name="isi_komentar" rows="5" required class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 py-3 px-4" placeholder="Tulis komentar Anda..."></textarea>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                @php
                    use App\Models\Berita;
                    $latestBeritas = Berita::latest()->take(6)->get();
                @endphp

                <aside class="lg:col-span-1 mt-12 lg:mt-0">
                    <div class="sticky top-24">
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-bold border-b pb-3 mb-4">Artikel Terbaru</h3>
                            <div class="space-y-4">
                                {{-- Loop untuk Artikel terbaru --}}
                                @foreach ($latestBeritas as $item)
                                    @if ($item->id === $berita->id)
                                        @continue
                                    @endif
                                    <a href="{{ route('berita.detail', $item) }}" class="flex items-center space-x-3 group">
                                        <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->nama_berita }}" class="w-20 h-20 object-cover rounded-md flex-shrink-0">
                                        <div>
                                            <h4 class="font-semibold text-gray-800 group-hover:text-blue-600 transition-colors line-clamp-2" title="{{ $item->nama_berita }}">
                                                {{ $item->nama_berita }}
                                            </h4>
                                            <div class="text-xs font-semibold text-blue-600 mb-2 uppercase">
                                                {{ $item->jenis }}
                                            </div>
                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMM Y') }}
                                            </p>
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
