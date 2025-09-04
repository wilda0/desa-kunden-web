<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Input Data Jenis Kelamin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800">

                    {{-- Notifikasi Sukses --}}
                    @if (session('success'))
                        <div
                            class="mb-6 p-4  bg-green-100 dark: bg-green-800 border border-green-200 dark:border-green-600 text-green-700 dark:text-green-200 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Menampilkan Error Validasi --}}
                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600 dark:text-red-400">
                                {{ __('Whoops! Something went wrong.') }}</div>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.data-kelamin.store') }}">
                        @csrf

                        {{-- Data Penduduk --}}
                        <div class="mb-8">
                            <h3
                                class="text-lg font-semibold text-gray-800 dark:text-gray-200 border-b border-gray-200 dark:border-gray-700 pb-2 mb-4">
                                Jumlah Penduduk</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <x-label for="laki_laki" value="{{ __('Jumlah Laki-laki (jiwa)') }}" />
                                    <x-input id="laki_laki" class="block mt-1 w-full" type="number" name="laki_laki"
                                        :value="old('laki_laki', $data->laki_laki ?? 0)" required min="0" />
                                </div>
                                <div>
                                    <x-label for="perempuan" value="{{ __('Jumlah Perempuan (jiwa)') }}" />
                                    <x-input id="perempuan" class="block mt-1 w-full" type="number" name="perempuan"
                                        :value="old('perempuan', $data->perempuan ?? 0)" required min="0" />
                                </div>
                                <div>
                                    <x-label for="kepala_keluarga" value="{{ __('Jumlah Kepala Keluarga') }}" />
                                    <x-input id="kepala_keluarga" class="block mt-1 w-full" type="number"
                                        name="kepala_keluarga" :value="old('kepala_keluarga', $data->kepala_keluarga ?? 0)" required min="0" />
                                </div>
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-end mt-8 border-t border-gray-200 dark:border-gray-700 pt-6">
                            <x-button>
                                {{ __('Simpan Data') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
