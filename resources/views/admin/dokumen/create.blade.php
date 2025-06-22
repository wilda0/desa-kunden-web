<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Dokumen Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

                    {{-- Menampilkan Error Validasi --}}
                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600 dark:text-red-400">{{ __('Whoops! Something went wrong.') }}</div>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.dokumen.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-6">
                            <!-- Judul Dokumen -->
                            <div>
                                <x-label for="judul" value="{{ __('Judul Dokumen') }}" />
                                <x-input id="judul" class="block mt-1 w-full" type="text" name="judul"
                                    :value="old('judul')" required autofocus placeholder="Masukkan Nama Dokumen" />
                            </div>

                            <!-- Jenis Dokumen -->
                            <div>
                                <x-label for="jenis_dokumen" value="{{ __('Jenis Dokumen') }}" />
                                <select name="jenis_dokumen" id="jenis_dokumen"
                                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option disabled selected>Pilih Jenis Dokumen</option>
                                    <option value="Daftar Informasi Publik">Daftar Informasi Publik</option>
                                    <option value="Dokumen Keuangan">Dokumen Keuangan</option>
                                    <option value="Dokumen Arsip">Dokumen Arsip</option>
                                </select>
                            </div>

                            <!-- Tanggal Input -->
                            <div>
                                <x-label for="tanggal_input" value="{{ __('Tanggal Input') }}" />
                                <x-input id="tanggal_input" class="block mt-1 w-full" type="date" name="tanggal_input"
                                    :value="old('tanggal_input')" required placeholder="Masukkan Tanggal Input" />
                            </div>

                            <!-- Upload Dokumen PDF -->
                            <div>
                                <x-label for="file_dokumen" value="{{ __('Upload Dokumen (PDF, maks 5MB)') }}" />
                                <input id="file_dokumen" class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" name="file_dokumen" required>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <a href="{{ route('admin.dokumen.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white underline mr-4">
                                    Batal
                                </a>
                                <x-button>
                                    {{ __('Simpan Dokumen') }}
                                </x-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            flatpickr("#tanggal_input", {
                dateFormat: "Y-m-d",
                allowInput: true
            });
        </script>
    @endpush

</x-app-layout>
