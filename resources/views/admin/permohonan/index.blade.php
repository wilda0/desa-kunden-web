@section('title', content: 'Admin - Permohonan Informasi')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Permohonan Informasi Masuk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

                    {{-- Notifikasi Sukses --}}
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 dark:bg-green-800 border border-green-200 dark:border-green-600 text-green-700 dark:text-green-200 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Tabel Permohonan --}}
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nama</th>
                                    <th scope="col" class="px-6 py-3">Instansi</th>
                                    <th scope="col" class="px-6 py-3">Email / Telepon</th>
                                    <th scope="col" class="px-6 py-3">Tanggal Masuk</th>
                                    <th scope="col" class="px-6 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($permohonans as $permohonan)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $permohonan->nama }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $permohonan->instansi }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span>{{ $permohonan->email }}</span>
                                            <span class="text-xs text-gray-500">{{ $permohonan->telepon }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $permohonan->created_at->isoFormat('D MMMM YYYY') }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end items-center space-x-4">
                                            {{-- Tombol Modal untuk Lihat Detail --}}
                                            <div x-data="{ open: false }">
                                                <button @click="open = true" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat Detail</button>

                                                <div x-show="open" @click.away="open = false" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
                                                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 max-w-lg w-full">
                                                        <div class="flex justify-between items-center border-b pb-3 mb-4">
                                                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Detail Permohonan</h3>
                                                            <button @click="open = false" class="text-gray-500 hover:text-gray-700 dark:hover:text-white text-2xl">&times;</button>
                                                        </div>
                                                        <div class="text-left space-y-2">
                                                            <p><strong class="font-semibold text-gray-600 dark:text-gray-300">Nama:</strong> {{ $permohonan->nama }}</p>
                                                            <p><strong class="font-semibold text-gray-600 dark:text-gray-300">Isi Permohonan:</strong></p>
                                                            <p class="text-gray-600 dark:text-gray-400 whitespace-pre-wrap">{{ $permohonan->permohonan }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Toggle Switch untuk Status Selesai --}}
                                            <div x-data="{ on: {{ $permohonan->status ? 'true' : 'false' }} }">
                                                <form method="POST" action="{{ route('admin.permohonan.toggle', $permohonan->id) }}" x-ref="toggleForm" class="flex items-center space-x-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="checkbox" name="status" x-model="on" class="hidden">
                                                    <button type="button" @click="on = !on; $nextTick(() => $refs.toggleForm.submit())"
                                                            class="relative inline-flex items-center h-6 rounded-full w-11 transition-colors duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800"
                                                            :class="on ? 'bg-green-500' : 'bg-gray-300 dark:bg-gray-600'">
                                                        <span class="sr-only">Toggle Status</span>
                                                        <span class="inline-block w-4 h-4 transform bg-white rounded-full transition-transform duration-300 ease-in-out"
                                                            :class="{ 'translate-x-6': on, 'translate-x-1': !on }">
                                                        </span>
                                                    </button>
                                                    <span x-text="on ? 'Selesai' : 'Baru'" class="text-sm font-medium" :class="{ 'text-green-600 dark:text-green-400': on, 'text-gray-500': !on }"></span>
                                                </form>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center">Tidak ada permohonan yang masuk.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination Links --}}
                    <div class="mt-4">
                        {{ $permohonans->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
