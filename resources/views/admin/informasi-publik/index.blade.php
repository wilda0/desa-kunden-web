@section('title', content: 'Admin - Informasi Publik')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Informasi Publik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div
                    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:radient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

                    {{-- Tombol Tambah Data --}}
                    <div class="mb-6">
                        <a href="{{ route('admin.informasi-publik.create') }}"
                            class="inline-flex items-center px-4 py-2  bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active: bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            {{ __('+ Tambah Informasi') }}
                        </a>
                    </div>

                    {{-- Notifikasi Sukses --}}
                    @if (session('success'))
                        <div
                            class="mb-4 p-4  bg-green-100 dark: bg-green-800 border border-green-200 dark:border-green-600 text-green-700 dark:text-green-200 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Tabel Informasi Publik --}}
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase   bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Judul</th>
                                    <th scope="col" class="px-6 py-3">Kategori</th>
                                    <th scope="col" class="px-6 py-3">Tahun</th>
                                    <th scope="col" class="px-6 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->judul_informasi }}
                                        </th>
                                        <td class="px-6 py-4">{{ $item->kategori }}</td>
                                        <td class="px-6 py-4">{{ $item->tahun }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex justify-end items-center space-x-4">
                                                <a href="{{ route('admin.informasi-publik.edit', $item->id) }}"
                                                    class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline">Edit</a>
                                                <div x-data="{ open: false }">
                                                    <button @click="open = true"
                                                        class="font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</button>

                                                    <!-- Modal Konfirmasi Hapus -->
                                                    <div x-show="open" @click.away="open = false"
                                                        class="fixed inset-0 z-50 flex items-center justify-center bg-[rgba(0,0,0,0.25)] bg-opacity-50"
                                                        style="display: none;">
                                                        <div
                                                            class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 max-w-sm mx-auto">
                                                            <h3
                                                                class="text-lg font-bold text-gray-900 dark:text-white mb-4">
                                                                Konfirmasi Hapus</h3>
                                                            <p class="text-gray-600 dark:text-gray-400 mb-6">Anda yakin
                                                                ingin menghapus data ini?</p>
                                                            <div class="flex justify-end space-x-4">
                                                                <button @click="open = false"
                                                                    class="px-4 py-2   bg-gray-300 dark:bg-gray-600 rounded-md text-gray-800 dark:text-gray-200 hover:bg-gray-400">Batal</button>
                                                                <form
                                                                    action="{{ route('admin.informasi-publik.destroy', $item->id) }}"
                                                                    method="POST" class="inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="px-4 py-2  bg-red-600 text-white rounded-md hover:ed-700">Hapus</button>
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
                                        <td colspan="4" class="text-center py-4 text-gray-500 dark:text-gray-400">
                                            Belum ada data informasi publik.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination Links --}}
                    <div class="mt-6">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
