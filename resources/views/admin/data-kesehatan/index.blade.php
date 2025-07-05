<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Input Data Demografi Kesehatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

                    <form method="POST" action="{{ route('admin.data-kesehatan.store') }}">
                        @csrf

                        @php
                            $fields = [
                                'bayi_lahir' => 'Jumlah Bayi Lahir',
                                'bayi_meninggal' => 'Jumlah Bayi Meninggal',
                                'ibu_melahirkan' => 'Jumlah Ibu Melahirkan',
                                'ibu_meninggal' => 'Jumlah Ibu Meninggal Saat Melahirkan',
                                'jumlah_balita' => 'Jumlah Balita',
                                'gizi_baik' => 'Balita Gizi Baik',
                                'gizi_kurang' => 'Balita Gizi Kurang',
                                'gizi_buruk' => 'Balita Gizi Buruk',
                                'imunisasi_polio' => 'Cakupan Imunisasi Polio 3',
                                'imunisasi_dpt1' => 'Cakupan Imunisasi DPT-1',
                                'imunisasi_cacar' => 'Cakupan Imunisasi Cacar',
                                'sumur_galian' => 'Pengguna Sumur Galian',
                                'air_pah' => 'Pengguna Air PAH',
                                'sumur_pompa' => 'Pengguna Sumur Pompa',
                                'hidran_umum' => 'Pengguna Hidran Umum',
                                'air_sungai' => 'Pengguna Air Sungai',
                            ];
                        @endphp

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($fields as $key => $label)
                            <div>
                                <x-label for="{{ $key }}" value="{{ $label }}" />
                                <x-input id="{{ $key }}" class="block mt-1 w-full" type="number" name="{{ $key }}" :value="old($key, $data->$key ?? 0)" required min="0" />
                            </div>
                            @endforeach
                        </div>

                        <div class="flex items-center justify-end mt-8 border-t border-gray-200 dark:border-gray-700 pt-6">
                            <x-button>
                                {{ __('Simpan Data Kesehatan') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
