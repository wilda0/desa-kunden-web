@section('title', 'Admin - Edit Produk UMKM')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Produk UMKM') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 dark:bg-red-800 border border-red-200 dark:border-red-600 text-red-700 dark:text-red-200 rounded-lg">
                            <div class="font-bold">{{ __('Whoops! Something went wrong.') }}</div>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.produk-umkm.update', $produkUmkm->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="space-y-6">
                            <!-- Nama Produk -->
                            <div>
                                <x-label for="nama_produk" value="{{ __('Nama Produk') }}" />
                                <x-input id="nama_produk" class="block mt-1 w-full" type="text" name="nama_produk" :value="old('nama_produk', $produkUmkm->nama_produk)" required autofocus />
                            </div>

                            <!-- Harga -->
                            <div>
                                <x-label for="format_harga" value="{{ __('Harga (Rp)') }}" />
                                <x-input id="format_harga" class="block mt-1 w-full" type="text" name="format_harga" :value="old('format_harga', $produkUmkm->format_harga)" required />
                            </div>

                            <!-- Deskripsi -->
                            <div>
                                <x-label for="deskripsi" value="{{ __('Deskripsi Singkat') }}" />
                                <textarea id="deskripsi" name="deskripsi" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>{{ old('deskripsi', $produkUmkm->deskripsi) }}</textarea>
                            </div>

                            <!-- Nomor WhatsApp -->
                            <div>
                                <x-label for="nomor_wa" value="{{ __('Nomor WhatsApp Penjual') }}" />
                                <x-input id="nomor_wa" class="block mt-1 w-full" type="text" name="nomor_wa" :value="old('nomor_wa', $produkUmkm->nomor_wa)" />
                            </div>

                            <!-- Upload Foto Produk -->
                            <div>
                                <x-label for="foto" value="{{ __('Ganti Foto Produk (Opsional)') }}" />
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $produkUmkm->foto) }}" alt="{{ $produkUmkm->nama_produk }}" class="w-24 h-24 object-cover rounded-md shadow-sm mb-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Foto saat ini</p>
                                </div>
                                <input id="foto"
                                    class="block mt-2 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                                    type="file" name="foto">
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-300">Kosongkan jika tidak ingin
                                    mengubah foto.</p>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <a href="{{ route('admin.produk-umkm.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white underline mr-4">
                                    Batal
                                </a>
                                <x-button>
                                    {{ __('Perbarui Produk') }}
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

                if (fotoInput) {
                    fotoInput.addEventListener('change', function(e) {
                        const file = e.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(evt) {
                                previewFoto.src = evt.target.result;
                                previewFoto.style.display = 'block';
                            }
                            reader.readAsDataURL(file);
                        } else {
                            previewFoto.style.display = 'none';
                        }
                    });
                }
            });
        </script>
    @endpush

</x-app-layout>
