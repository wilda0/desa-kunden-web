@section('title', content: 'Admin - Produk Hukum')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Produk Hukum Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800">

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-200 rounded-lg">
                            <div class="font-medium">{{ __('Whoops! Something went wrong.') }}</div>
                            <ul class="mt-3 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.produk-hukum.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Judul Hukum -->
                        <div>
                            <x-label for="judul_hukum" value="{{ __('Judul Hukum') }}" />
                            <x-input id="judul_hukum" class="block mt-1 w-full" type="text" name="judul_hukum"
                                :value="old('judul_hukum')" required autofocus
                                placeholder="Contoh: Peraturan Desa No. 5 Tahun 2025" />
                        </div>

                        <!-- Jenis Hukum -->
                        <div>
                            <x-label for="jenis_hukum" value="{{ __('Jenis Hukum') }}" />
                            <select name="jenis_hukum" id="jenis_hukum"
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                                <option value="">-- Pilih Jenis Hukum --</option>
                                <option value="Peraturan Desa">Peraturan Desa</option>
                                <option value="Keputusan Kepala Desa">Keputusan Kepala Desa</option>
                                <option value="Peraturan Bupati">Peraturan Bupati</option>
                                <option value="Peraturan Daerah">Peraturan Daerah</option>
                                <option value="Instruksi Kepala Desa">Instruksi Kepala Desa</option>
                                <option value="Surat Edaran">Surat Edaran</option>
                                <option value="Perjanjian Kerja Sama">Perjanjian Kerja Sama</option>
                                <option value="Nota Kesepahaman (MoU)">Nota Kesepahaman (MoU)</option>
                            </select>
                        </div>

                        <!-- Tahun -->
                        <div>
                            <x-label for="tahun" value="{{ __('Tahun') }}" />
                            <x-input id="tahun" class="block mt-1 w-full" type="number" name="tahun"
                                :value="old('tahun')" required placeholder="Contoh: 2025" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.produk-hukum.index') }}"
                                class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white underline mr-4">
                                Batal
                            </a>
                            <x-button>
                                {{ __('Simpan') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
