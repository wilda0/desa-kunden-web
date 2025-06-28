<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produk Hukum - Website Desa Kunden</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- AlpineJS -->
    <script src="//unpkg.com/alpinejs" defer></script>

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
                    <span class="text-gray-700">Produk Hukum</span>
                </nav>
                <h1 class="text-4xl font-bold text-gray-800">Produk Hukum</h1>
                <p class="text-gray-500 mt-2">Temukan peraturan desa, keputusan kepala desa, dan produk hukum lainnya
                    yang berlaku di Desa Kunden.</p>
            </div>

            <!-- Filter Section -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                <form action="{{ route('produk-hukum.index') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                        <div class="md:col-span-2">
                            <label for="jenis_hukum" class="block text-sm font-medium text-gray-700 mb-1">Filter
                                Berdasarkan Jenis</label>
                            <select name="jenis_hukum" id="jenis_hukum"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Semua Jenis</option>
                                @foreach ($jenisHukumList as $jenis)
                                    <option value="{{ $jenis }}"
                                        {{ request('jenis_hukum') == $jenis ? 'selected' : '' }}>{{ $jenis }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="tahun" class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                            <select name="tahun" id="tahun"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Semua Tahun</option>
                                @foreach ($tahunList as $tahun)
                                    <option value="{{ $tahun }}"
                                        {{ request('tahun') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit"
                                class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors flex items-center justify-center">
                                <i data-lucide="search" class="w-4 h-4 mr-2"></i>
                                Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Tabel Dokumen -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Judul
                                    Produk Hukum</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis
                                </th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($produkHukums as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $loop->iteration + ($produkHukums->currentPage() - 1) * $produkHukums->perPage() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-gray-900">
                                        {{ $item->judul_hukum }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->jenis_hukum }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->tahun }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-10 text-gray-500">
                                        <p>Data produk hukum tidak ditemukan.</p>
                                        <a href="{{ route('produk-hukum.index') }}"
                                            class="mt-2 inline-block text-blue-600 hover:underline">Reset Filter</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $produkHukums->links() }}
            </div>
        </div>
    </main>

    @include('layouts.partials.footer')

    <script>
        lucide.createIcons();
    </script>
</body>

</html>
