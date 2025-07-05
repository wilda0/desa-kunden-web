<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Input Data Jenis Kelamin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800">

                    {{-- Notifikasi Sukses --}}
                    @if (session('success'))
                        <div class="mb-6 p-4 bg-green-100 dark:bg-green-800 border border-green-200 dark:border-green-600 text-green-700 dark:text-green-200 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

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

                    <form method="POST" action="{{ route('admin.data-kelamin.store') }}" class="space-y-6">
                        @csrf

                        <!-- Jumlah Laki-laki -->
                        <div>
                            <x-label for="laki_laki" value="{{ __('Jumlah Laki-laki') }}" />
                            <x-input id="laki_laki" class="block mt-1 w-full" type="number" name="laki_laki" :value="old('laki_laki', $data->laki_laki ?? 0)" required min="0" />
                        </div>

                        <!-- Jumlah Perempuan -->
                        <div>
                            <x-label for="perempuan" value="{{ __('Jumlah Perempuan') }}" />
                            <x-input id="perempuan" class="block mt-1 w-full" type="number" name="perempuan" :value="old('perempuan', $data->perempuan ?? 0)" required min="0" />
                        </div>

                        <!-- Jumlah Kepala Keluarga -->
                        <div>
                            <x-label for="kepala_keluarga" value="{{ __('Jumlah Kepala Keluarga') }}" />
                            <x-input id="kepala_keluarga" class="block mt-1 w-full" type="number" name="kepala_keluarga" :value="old('kepala_keluarga', $data->kepala_keluarga ?? 0)" required min="0" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
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
