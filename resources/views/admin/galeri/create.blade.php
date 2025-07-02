@section('title', content: 'Admin - Galeri')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Gambar Galeri Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800">

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

                    <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-6">
                            <!-- Judul -->
                            <div>
                                <x-label for="judul" value="{{ __('Judul Gambar') }}" />
                                <x-input id="judul" class="block mt-1 w-full" type="text" name="judul" :value="old('judul')" required autofocus placeholder="Masukkan judul gambar" />
                            </div>

                            <!-- Gambar -->
                            <div>
                                <x-label for="gambar" value="{{ __('File Gambar (Maks 2MB)') }}" />
                                <input id="gambar" class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" name="gambar" required accept="image/*">
                                <img id="preview-gambar" class="mt-4 h-48 object-cover rounded-md shadow" style="display: none;" alt="Preview Gambar">
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <a href="{{ route('admin.galeri.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white underline mr-4">
                                    Batal
                                </a>
                                <x-button>
                                    {{ __('Simpan') }}
                                </x-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const gambarInput = document.getElementById('gambar');
            const previewGambar = document.getElementById('preview-gambar');

            if (gambarInput) {
                gambarInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(evt) {
                            previewGambar.src = evt.target.result;
                            previewGambar.style.display = 'block';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        previewGambar.style.display = 'none';
                    }
                });
            }
        });
    </script>
    @endpush
</x-app-layout>
