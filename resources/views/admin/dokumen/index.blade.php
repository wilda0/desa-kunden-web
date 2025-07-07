@section('title', content: 'Admin - Dokumen')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Dokumen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

                    {{-- Tombol Tambah Data --}}
                    <div class="mb-4">
                        <a href="{{ route('admin.dokumen.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            {{ __('Tambah Dokumen Baru') }}
                        </a>
                    </div>

                    {{-- Notifikasi Sukses --}}
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 dark:bg-green-800 border border-green-200 dark:border-green-600 text-green-700 dark:text-green-200 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Tabel Dokumen --}}
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Judul</th>
                                    <th scope="col" class="px-6 py-3">Jenis Dokumen</th>
                                    <th scope="col" class="px-6 py-3">Tanggal Input</th>
                                    <th scope="col" class="px-6 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dokumens as $dokumen)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $dokumen->judul }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $dokumen->jenis_dokumen }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ \Carbon\Carbon::parse($dokumen->tanggal_input)->isoFormat('D MMMM YYYY') }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end items-center space-x-2">

                                            {{-- Tombol Modal PDF --}}
                                            <div x-data="{ showModal: false }">
                                                <button @click="showModal = true"
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                    Lihat
                                                </button>

                                                {{-- Modal PDF Viewer --}}
                                                <div x-show="showModal"
                                                    x-transition
                                                    @keydown.escape.window="showModal = false"
                                                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
                                                    style="display: none;">
                                                    <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl w-11/12 md:w-3/4 h-5/6 relative">
                                                        <div class="flex justify-between items-center p-4 border-b border-gray-300 dark:border-gray-700">
                                                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Lihat Dokumen: {{ $dokumen->judul }}</h3>
                                                            <button @click="showModal = false" class="text-gray-500 hover:text-gray-700 dark:hover:text-white text-2xl">&times;</button>
                                                        </div>
                                                        <iframe src="{{ asset('public/storage/' . $dokumen->file_path) }}" class="w-full h-full"></iframe>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('admin.dokumen.edit', $dokumen->id) }}" class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline">Edit</a>

                                            {{-- Tombol Hapus --}}
                                            <div x-data="{ open: false }">
                                                <button @click="open = true" class="font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</button>

                                                <!-- Modal Konfirmasi Hapus -->
                                                <div x-show="open" @click.away="open = false" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
                                                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6">
                                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Konfirmasi Hapus</h3>
                                                        <p class="text-gray-600 dark:text-gray-400 mb-6">Apakah Anda yakin ingin menghapus dokumen "{{ $dokumen->judul }}"?</p>
                                                        <div class="flex justify-end space-x-4">
                                                            <button @click="open = false" class="px-4 py-2 bg-gray-300 dark:bg-gray-600 rounded-md text-gray-800 dark:text-gray-200 hover:bg-gray-400">Batal</button>
                                                            <form action="{{ route('admin.dokumen.destroy', $dokumen->id) }}" method="POST" class="inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center">Tidak ada dokumen yang ditemukan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $dokumens->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
