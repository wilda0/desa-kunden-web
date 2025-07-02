@section('title', content: 'Admin - Berita Desa')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Berita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

                    {{-- Tampilkan Validasi Error --}}
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

                    <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="space-y-6">

                            {{-- Nama Berita --}}
                            <div>
                                <x-label for="nama_berita" value="{{ __('Nama Berita') }}" />
                                <x-input id="nama_berita" class="block mt-1 w-full" type="text" name="nama_berita" :value="old('nama_berita', $berita->nama_berita)" required autofocus />
                            </div>

                            {{-- Tanggal --}}
                            <div>
                                <x-label for="tanggal" value="{{ __('Tanggal') }}" />
                                <x-input id="tanggal" class="block mt-1 w-full" type="date" name="tanggal" :value="old('tanggal', $berita->tanggal)" required />
                            </div>

                            {{-- Deskripsi --}}
                            <div>
                                <x-label for="deskripsi" value="{{ __('Deskripsi') }}" />
                                <textarea id="deskripsi" name="deskripsi" rows="8" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('deskripsi', $berita->deskripsi) }}</textarea>
                            </div>

                            {{-- Foto --}}
                            <div>
                                <x-label for="foto" value="{{ __('Ganti Foto (Opsional, Maks 2MB)') }}" />
                                <div class="mt-2">
                                    <img id="foto-lama" src="{{ Storage::url($berita->foto) }}" alt="Foto saat ini" class="h-40 rounded-md object-cover mb-2">
                                    <img id="preview-foto" class="h-40 rounded-md object-cover" style="display: none;">
                                </div>
                                <input id="foto" class="block mt-2 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" type="file" name="foto">
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-300">Kosongkan jika tidak ingin mengubah foto.</p>
                            </div>

                            {{-- Tombol --}}
                            <div class="flex items-center justify-end mt-4">
                                <a href="{{ route('admin.berita.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white underline mr-4">
                                    Batal
                                </a>
                                <x-button>
                                    {{ __('Perbarui Berita') }}
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
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi Flatpickr
            flatpickr("#tanggal", {
                dateFormat: "Y-m-d",
                allowInput: true,
            });

            // Script untuk Preview Foto
            const fotoInput = document.getElementById('foto');
            const previewFoto = document.getElementById('preview-foto');
            const fotoLama = document.getElementById('foto-lama');

            if (fotoInput) {
                fotoInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(evt) {
                            previewFoto.src = evt.target.result;
                            previewFoto.style.display = 'block';
                            if (fotoLama) {
                                fotoLama.style.display = 'none';
                            }
                        }
                        reader.readAsDataURL(file);
                    } else {
                        previewFoto.style.display = 'none';
                        if (fotoLama) {
                            fotoLama.style.display = 'block';
                        }
                    }
                });
            }
        });
    </script>
    @endpush
</x-app-layout>
