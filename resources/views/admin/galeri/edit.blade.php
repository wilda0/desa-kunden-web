@section('title', content: 'Admin - Galeri')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Gambar Galeri') }}
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

                    <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="space-y-6">
                            <!-- Judul -->
                            <div>
                                <x-label for="judul" value="{{ __('Judul Gambar') }}" />
                                <x-input id="judul" class="block mt-1 w-full" type="text" name="judul" :value="old('judul', $galeri->judul)" required autofocus />
                            </div>

                            <!-- Gambar -->
                            <div>
                                <x-label for="gambar" value="{{ __('Ganti Gambar (Opsional, Maks 2MB)') }}" />
                                <div class="mt-2">
                                    <img id="gambar-lama" src="{{ asset('public/storage/' . $galeri->gambar) }}" alt="Gambar saat ini" class="h-48 rounded-md object-cover shadow mb-2">
                                    <img id="preview-gambar" class="h-48 rounded-md object-cover shadow" style="display: none;" alt="Preview Gambar Baru">
                                </div>
                                <input id="gambar" class="block mt-2 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600" type="file" name="gambar" accept="image/*">
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-300">Kosongkan jika tidak ingin mengubah gambar.</p>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <a href="{{ route('admin.galeri.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white underline mr-4">
                                    Batal
                                </a>
                                <x-button>
                                    {{ __('Update') }}
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
            const gambarLama = document.getElementById('gambar-lama');

            if (gambarInput) {
                gambarInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(evt) {
                            previewGambar.src = evt.target.result;
                            previewGambar.style.display = 'block';
                            if (gambarLama) {
                                gambarLama.style.display = 'none';
                            }
                        }
                        reader.readAsDataURL(file);
                    } else {
                        previewGambar.style.display = 'none';
                        if (gambarLama) {
                            gambarLama.style.display = 'block';
                        }
                    }
                });
            }
        });
    </script>
    @endpush
</x-app-layout>
