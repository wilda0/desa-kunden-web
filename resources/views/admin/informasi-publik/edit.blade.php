<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Informasi Publik') }}
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

                    <form action="{{ route('admin.informasi-publik.update', $informasiPublik->id) }}" method="POST"
                        class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-label for="judul_informasi" value="{{ __('Judul Informasi') }}" />
                            <x-input id="judul_informasi" class="block mt-1 w-full" type="text"
                                name="judul_informasi" :value="old('judul_informasi', $informasiPublik->judul_informasi)" required autofocus />
                        </div>

                        <div>
                            <x-label for="kategori" value="{{ __('Kategori') }}" />
                            <select id="kategori" name="kategori" required
                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="" disabled selected>Pilih Kategori</option>
                                <option value="Program dan Kegiatan">Program dan Kegiatan</option>
                                <option value="Anggaran dan Keuangan">Anggaran dan Keuangan</option>
                                <option value="Peraturan dan Kebijakan">Peraturan dan Kebijakan</option>
                                <option value="Layanan Publik">Layanan Publik</option>
                                <option value="Informasi Berkala">Informasi Berkala</option>
                                <option value="Hasil Musyawarah Desa">Hasil Musyawarah Desa</option>
                                <option value="Pengumuman Publik">Pengumuman Publik</option>
                            </select>
                        </div>

                        <div>
                            <x-label for="deskripsi" value="{{ __('Deskripsi') }}" />
                            <textarea id="deskripsi" name="deskripsi" rows="5"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                required>{{ old('deskripsi', $informasiPublik->deskripsi) }}</textarea>
                        </div>

                        <div>
                            <x-label for="tahun" value="{{ __('Tahun') }}" />
                            <x-input id="tahun" class="block mt-1 w-full" type="number" name="tahun"
                                :value="old('tahun', $informasiPublik->tahun)" required />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.informasi-publik.index') }}"
                                class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white underline mr-4">
                                Batal
                            </a>
                            <x-button>
                                {{ __('Simpan Perubahan') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
