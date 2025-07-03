<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produk UMKM - Website Desa Kunden</title>

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
            <!-- Title & Breadcrumb -->
            <div class="mb-8">
                <nav class="text-sm mb-4 text-gray-500">
                    <a href="{{ route('welcome') }}" class="hover:text-blue-600">Home</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-700">Produk UMKM</span>
                </nav>
                <h1 class="text-4xl font-bold text-gray-800">Produk UMKM</h1>
                <p class="text-gray-500 mt-2">Layanan yang disediakan promosi produk UMKM desa sehingga mampu
                    meningkatkan perekonomian masyarakat desa.</p>
            </div>


            <!-- Search Form -->
            <div class="mb-8">
                <form action="{{ route('produk-umkm.index') }}" method="GET">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Cari nama produk..."
                            value="{{ request('search') }}"
                            class="w-full py-3 pl-4 pr-12 text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="submit"
                            class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-500 hover:text-blue-600">
                            <i data-lucide="search" class="w-5 h-5"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($produkUmkms as $produk)
                    <a href="{{ route('produk-umkm.show', $produk) }}"
                        class="bg-white rounded-lg shadow-md overflow-hidden group">
                        <img src="{{ Storage::url($produk->foto) }}" alt="{{ $produk->nama_produk }}"
                            class="w-full h-48 object-cover group-hover:opacity-80 transition-opacity">
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-800 truncate">{{ $produk->nama_produk }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ Str::limit($produk->deskripsi, 100) }}
                            </p>
                            <p class="text-base md:text-lg font-semibold text-blue-600 my-4">
                                {{ $produk->format_harga }}
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-16">
                        <p class="text-gray-500">Produk tidak ditemukan.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $produkUmkms->links() }}
            </div>
        </div>
    </main>

    @include('layouts.partials.footer')
    <script>
        lucide.createIcons();
    </script>
</body>

</html>
