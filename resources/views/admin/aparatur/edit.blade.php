@section('title', 'Admin - Aparatur Desa')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Data Aparatur') }}
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

                    <form action="{{ route('admin.aparatur.update', $aparatur->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="space-y-6">
                            <!-- Nama -->
                            <div>
                                <x-label for="nama" value="{{ __('Nama Lengkap') }}" />
                                <x-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama', $aparatur->nama)" required autofocus />
                            </div>

                            <!-- Jabatan -->
                            <div>
                                <x-label for="jabatan" value="{{ __('Jabatan') }}" />
                                <x-input id="jabatan" class="block mt-1 w-full" type="text" name="jabatan" :value="old('jabatan', $aparatur->jabatan)" required />
                            </div>

                            <!-- Foto -->
                            <div>
                                <x-label for="foto" value="{{ __('Ganti Foto (Opsional, Maks 2MB)') }}" />
                                <div class="mt-2">
                                    <img id="foto-lama" src="{{ asset('public/storage/' . $aparatur->foto) }}" alt="Foto saat ini" class="h-48 rounded-md object-cover shadow mb-2">
                                    <img id="preview-foto" class="h-48 rounded-md object-cover shadow" style="display: none;" alt="Preview Foto Baru">
                                </div>
                                <input id="foto" class="block mt-2 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600" type="file" name="foto" accept="image/*">
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-300">Kosongkan jika tidak ingin mengubah foto.</p>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <a href="{{ route('admin.aparatur.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white underline mr-4">
                                    Batal
                                </a>
                                <x-button>
                                    {{ __('Simpan Perubahan') }}
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
