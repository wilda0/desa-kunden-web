@section('title', content: 'Admin - Edit Layanan')
<x-app-layout>
@vite(['resources/js/quillInit.js'])
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div
                    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:radient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

                    {{-- Menampilkan Error Validasi --}}
                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600 dark:text-red-400">
                                {{ __('Whoops! Something went wrong.') }}
                            </div>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form editor-attach="true" id="layananForm" action="{{ route('admin.layanan.update', $layanan->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="space-y-6">
                            <!-- Nama Layanan -->
                            <div class="flex justify-center items-start flex-col gap-2">
                                <x-label for="nama_layanan" value="{{ __('Nama Layanan') }}" />
                                <x-input id="nama_layanan" class="block mt-1 w-full p-2" type="text" name="nama_layanan"
                                    :value="old('nama_layanan', $layanan->nama_layanan)" required autofocus
                                    placeholder="Masukkan Nama Layanan" />
                            </div>

                            <div>
                                <x-label class="mb-2" for="deskripsi" value="{{ __('Deskripsi') }}" />
                                <div id="deskripsi" class="bg-white rounded-b-xl">
                                    
                                </div>
                                <!-- Hidden field that will actually be submitted -->
                                <input type="hidden" name="deskripsi" id="deskripsi_markdown">
                            </div>

                            <!-- Tombol Simpan -->
                            <div class="flex justify-end">
                                <x-button type="submit" class="mt-4">
                                    {{ __('Update Layanan') }}
                                </x-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.deskripsiDelta = JSON.parse(@json($layanan->deskripsi));
    </script>
@vite(['resources/js/customEditor.js'])
</x-app-layout>