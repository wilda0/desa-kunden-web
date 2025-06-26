<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Permohonan Informasi - Website Desa Kunden</title>

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

    {{-- Memanggil file header --}}
    @include('layouts.partials.header')

    <main>
        <div class="container mx-auto px-6 lg:px-16 py-12">

            <!-- Title Section -->
            <div class="border-b-2 border-gray-200 pb-4 mb-8">
                <h1 class="text-4xl font-bold text-blue-600">Form Permohonan Informasi</h1>
                <p class="text-gray-500 mt-2">Harap mengisi form untuk permohonan informasi.</p>
            </div>

            <!-- Form Section -->
            <div class="bg-white p-8 rounded-lg shadow-md max-w-4xl mx-auto">
                <form action="{{-- route('permohonan.store') --}}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Nama -->
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="user" class="w-5 h-5 text-gray-400"></i>
                                </div>
                                <input type="text" name="nama" id="nama" class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan nama Anda" required>
                            </div>
                        </div>

                        <!-- Asal Instansi -->
                        <div>
                            <label for="instansi" class="block text-sm font-medium text-gray-700 mb-1">Asal Instansi <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="building-2" class="w-5 h-5 text-gray-400"></i>
                                </div>
                                <input type="text" name="instansi" id="instansi" class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan asal instansi Anda" required>
                            </div>
                        </div>

                        <!-- Nomor Telepon -->
                        <div>
                            <label for="telepon" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon <span class="text-red-500">*</span></label>
                             <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="phone" class="w-5 h-5 text-gray-400"></i>
                                </div>
                                <input type="tel" name="telepon" id="telepon" class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan nomor telepon Anda (08xxxxx)" pattern="08[0-9]{7,11}" required>
                            </div>
                        </div>

                        <!-- Alamat Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat E-mail <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="at-sign" class="w-5 h-5 text-gray-400"></i>
                                </div>
                                <input type="email" name="email" id="email" class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan alamat email (xxx@xxx)" required>
                            </div>
                        </div>

                        <!-- Permohonan -->
                        <div class="md:col-span-2">
                            <label for="permohonan" class="block text-sm font-medium text-gray-700 mb-1">Permohonan <span class="text-red-500">*</span></label>
                            <textarea name="permohonan" id="permohonan" rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan permohonan Anda" required></textarea>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 text-right">
                        <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-8 rounded-lg hover:bg-blue-700 transition-colors duration-300 flex items-center ml-auto">
                            <i data-lucide="send" class="w-5 h-5 mr-2"></i>
                            <span>Kirim</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Notifikasi Sukses (Toast) -->
    @if (session('success'))
        <div x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 5000)"
             x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-y-4 sm:translate-y-0 sm:translate-x-4"
             x-transition:enter-end="opacity-100 transform translate-y-0 sm:translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed top-5 right-5 z-50 bg-green-500 text-white py-3 px-5 rounded-lg shadow-lg flex items-center"
             style="display: none;">
            <i data-lucide="check-circle" class="w-6 h-6 mr-3"></i>
            <span>{{ session('success') }}</span>
            <button @click="show = false" class="ml-4 text-green-100 hover:text-white">&times;</button>
        </div>
    @endif

    <!-- Footer -->
    @include('layouts.partials.footer')

    <!-- AlpineJS and Lucide Icons -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>
