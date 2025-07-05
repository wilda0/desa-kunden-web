<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                {{-- Pesan Selamat Datang --}}
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <h1 class="text-2xl font-medium text-gray-900 dark:text-white">
                        Selamat Datang di Dashboard Admin!
                    </h1>
                    <p class="mt-4 text-gray-500 dark:text-gray-400 leading-relaxed">
                        Dari sini, Anda dapat mengelola berbagai aspek konten website Desa Kunden. Silakan pilih salah satu menu di bawah ini atau gunakan navigasi di atas untuk memulai.
                    </p>
                </div>

                {{-- Bagian Baru untuk Navigasi Data Demografi --}}
                <div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 p-6 lg:p-8">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Manajemen Data Demografi</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                        <!-- Data Jenis Kelamin -->
                        <a href="{{ route('admin.demografi-kelamin.index') }}" class="block p-6 bg-white dark:bg-gray-700 rounded-lg shadow-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            <div class="flex items-center">
                                <div class="p-3 bg-blue-100 dark:bg-blue-900/50 rounded-full">
                                    <i data-lucide="users" class="w-6 h-6 text-blue-600 dark:text-blue-400"></i>
                                </div>
                                <h4 class="ml-4 text-lg font-semibold text-gray-800 dark:text-gray-200">Data Jenis Kelamin</h4>
                            </div>
                        </a>

                        <!-- Data Pendidikan -->
                        <a href="{{ route('admin.data-pendidikan.index') }}" class="block p-6 bg-white dark:bg-gray-700 rounded-lg shadow-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            <div class="flex items-center">
                                <div class="p-3 bg-green-100 dark:bg-green-900/50 rounded-full">
                                    <i data-lucide="graduation-cap" class="w-6 h-6 text-green-600 dark:text-green-400"></i>
                                </div>
                                <h4 class="ml-4 text-lg font-semibold text-gray-800 dark:text-gray-200">Data Pendidikan</h4>
                            </div>
                        </a>

                        <!-- Data Kesehatan -->
                        <a href="#" class="block p-6 bg-white dark:bg-gray-700 rounded-lg shadow-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            <div class="flex items-center">
                                <div class="p-3 bg-red-100 dark:bg-red-900/50 rounded-full">
                                    <i data-lucide="heart-pulse" class="w-6 h-6 text-red-600 dark:text-red-400"></i>
                                </div>
                                <h4 class="ml-4 text-lg font-semibold text-gray-800 dark:text-gray-200">Data Kesehatan</h4>
                            </div>
                        </a>

                        <!-- Data Keagamaan -->
                        <a href="#" class="block p-6 bg-white dark:bg-gray-700 rounded-lg shadow-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            <div class="flex items-center">
                                <div class="p-3 bg-yellow-100 dark:bg-yellow-900/50 rounded-full">
                                    <i data-lucide="command" class="w-6 h-6 text-yellow-600 dark:text-yellow-400"></i>
                                </div>
                                <h4 class="ml-4 text-lg font-semibold text-gray-800 dark:text-gray-200">Data Keagamaan</h4>
                            </div>
                        </a>

                        <!-- Data Ekonomi -->
                        <a href="#" class="block p-6 bg-white dark:bg-gray-700 rounded-lg shadow-md hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            <div class="flex items-center">
                                <div class="p-3 bg-purple-100 dark:bg-purple-900/50 rounded-full">
                                    <i data-lucide="briefcase" class="w-6 h-6 text-purple-600 dark:text-purple-400"></i>
                                </div>
                                <h4 class="ml-4 text-lg font-semibold text-gray-800 dark:text-gray-200">Data Ekonomi</h4>
                            </div>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Pastikan script Lucide Icons dimuat --}}
    @push('scripts')
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
    @endpush
</x-app-layout>
