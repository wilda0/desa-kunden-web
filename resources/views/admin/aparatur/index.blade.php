@section('title', 'Admin - Aparatur Desa')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Aparatur Desa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:radient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

                    {{-- Tombol Tambah Data --}}
                    <div class="mb-6">
                        <a href="{{ route('admin.aparatur.create') }}" class="inline-flex items-center px-4 py-2  bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active: bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            {{ __('+ Tambah Aparatur') }}
                        </a>
                    </div>

                    {{-- Notifikasi Sukses --}}
                    @if (session('success'))
                        <div class="mb-4 p-4  bg-green-100 dark: bg-green-800 border border-green-200 dark:border-green-600 text-green-700 dark:text-green-200 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Grid Aparatur --}}
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
                        @forelse ($aparatur as $item)
                            <div class="  bg-gray-50 dark:bg-gray-900/50 rounded-lg shadow-md overflow-hidden text-center">
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}" class="w-full h-48 object-cover object-center">
                                <div class="p-4">
                                    <h3 class="font-bold text-gray-900 dark:text-white truncate">{{ $item->nama }}</h3>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm truncate">{{ $item->jabatan }}</p>
                                    <div class="mt-3 flex justify-center items-center gap-3">
                                        <a href="{{ route('admin.aparatur.edit', $item->id) }}" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                        <div x-data="{ open: false }">
                                            <button @click="open = true" class="text-sm font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</button>

                                            <!-- Modal Konfirmasi Hapus -->
                                            <div x-show="open" @click.away="open = false" class="fixed inset-0 z-50 flex items-center justify-center bg-[rgba(0,0,0,0.25)] bg-opacity-50" style="display: none;">
                                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 max-w-sm mx-auto">
                                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Konfirmasi Hapus</h3>
                                                    <p class="text-gray-600 dark:text-gray-400 mb-6">Apakah Anda yakin ingin menghapus data aparatur "{{ $item->nama }}"?</p>
                                                    <div class="flex justify-end space-x-4">
                                                        <button @click="open = false" class="px-4 py-2   bg-gray-300 dark:bg-gray-600 rounded-md text-gray-800 dark:text-gray-200 hover:bg-gray-400">Batal</button>
                                                        <form action="{{ route('admin.aparatur.destroy', $item->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="px-4 py-2  bg-red-600 text-white rounded-md hover:ed-700">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="col-span-full text-center text-gray-500 dark:text-gray-400 py-8">Tidak ada data aparatur yang ditemukan.</p>
                        @endforelse
                    </div>

                    {{-- Pagination Links --}}
                    <div class="mt-6">
                        {{ $aparatur->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
