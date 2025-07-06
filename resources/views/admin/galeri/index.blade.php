@section('title', content: 'Admin - Galeri')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Galeri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

                    {{-- Tombol Tambah Data --}}
                    <div class="mb-6">
                        <a href="{{ route('admin.galeri.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            {{ __('+ Tambah Gambar') }}
                        </a>
                    </div>

                    {{-- Notifikasi Sukses --}}
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 dark:bg-green-800 border border-green-200 dark:border-green-600 text-green-700 dark:text-green-200 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Grid Galeri --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @forelse ($galeris as $galeri)
                            <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg shadow-md overflow-hidden group">
                                <img src="{{ Storage::url($galeri->gambar) }}" alt="{{ $galeri->judul }}" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h3 class="font-bold text-gray-900 dark:text-white truncate" title="{{ $galeri->judul }}">{{ $galeri->judul }}</h3>
                                    <div class="mt-3 flex justify-between items-center">
                                        <a href="{{ route('admin.galeri.edit', $galeri->id) }}" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                        <div x-data="{ open: false }">
                                            <button @click="open = true" class="text-sm font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</button>

                                            <!-- Modal Konfirmasi Hapus -->
                                            <div x-show="open" @click.away="open = false" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
                                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 max-w-sm mx-auto">
                                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Konfirmasi Hapus</h3>
                                                    <p class="text-gray-600 dark:text-gray-400 mb-6">Apakah Anda yakin ingin menghapus gambar ini?</p>
                                                    <div class="flex justify-end space-x-4">
                                                        <button @click="open = false" class="px-4 py-2 bg-gray-300 dark:bg-gray-600 rounded-md text-gray-800 dark:text-gray-200 hover:bg-gray-400">Batal</button>
                                                        <form action="{{ route('admin.galeri.destroy', $galeri->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="col-span-full text-center text-gray-500 dark:text-gray-400">Tidak ada gambar di galeri.</p>
                        @endforelse
                    </div>

                    {{-- Pagination Links --}}
                    <div class="mt-6">
                        {{ $galeris->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
