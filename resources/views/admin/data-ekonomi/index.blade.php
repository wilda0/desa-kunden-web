<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Input Data Ekonomi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800">

                    {{-- Notifikasi Sukses --}}
                    @if (session('success'))
                        <div
                            class="mb-6 p-4 bg-green-100 dark:bg-green-800 border border-green-200 dark:border-green-600 text-green-700 dark:text-green-200 rounded-lg">
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

                    <form method="POST" action="{{ route('admin.data-ekonomi.store') }}">
                        @csrf

                        {{-- Luas Tanaman Pertanian --}}
                        <div class="mb-8">
                            <h3
                                class="text-lg font-semibold text-gray-800 dark:text-gray-200 border-b border-gray-200 dark:border-gray-700 pb-2 mb-4">
                                Luas Tanaman Pertanian (ha)</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach (['padi_sawah' => 'Padi Sawah', 'padi_ladang' => 'Padi Ladang', 'jagung' => 'Jagung', 'palawija' => 'Palawija', 'tebu' => 'Tebu'] as $name => $label)
                                    <div>
                                        <x-label for="{{ $name }}" value="{{ $label }}" />
                                        <x-input id="{{ $name }}" class="block mt-1 w-full" type="number"
                                            name="{{ $name }}" :value="old($name, $data->$name ?? 0)" required min="0" />
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Jumlah Ternak --}}
                        <div class="mb-8">
                            <h3
                                class="text-lg font-semibold text-gray-800 dark:text-gray-200 border-b border-gray-200 dark:border-gray-700 pb-2 mb-4">
                                Jumlah Ternak (ekor)</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach (['kambing' => 'Kambing', 'sapi' => 'Sapi', 'ayam' => 'Ayam', 'burung' => 'Burung'] as $name => $label)
                                    <div>
                                        <x-label for="{{ $name }}" value="{{ $label }}" />
                                        <x-input id="{{ $name }}" class="block mt-1 w-full" type="number"
                                            name="{{ $name }}" :value="old($name, $data->$name ?? 0)" required min="0" />
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Mata Pencaharian --}}
                        <div class="mb-8">
                            <h3
                                class="text-lg font-semibold text-gray-800 dark:text-gray-200 border-b border-gray-200 dark:border-gray-700 pb-2 mb-4">
                                Mata Pencaharian (orang)</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach (['petani' => 'Petani', 'pedagang' => 'Pedagang', 'pns' => 'PNS', 'tukang' => 'Tukang', 'guru' => 'Guru', 'bidan_perawat' => 'Bidan/Perawat', 'tni_polri' => 'TNI/Polri', 'pensiunan' => 'Pensiunan', 'sopir_angkutan' => 'Sopir/Angkutan', 'buruh' => 'Buruh', 'jasa_persewaan' => 'Jasa Persewaan', 'swasta' => 'Swasta'] as $name => $label)
                                    <div>
                                        <x-label for="{{ $name }}" value="{{ $label }}" />
                                        <x-input id="{{ $name }}" class="block mt-1 w-full" type="number"
                                            name="{{ $name }}" :value="old($name, $data->$name ?? 0)" required min="0" />
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-end mt-8 border-t border-gray-200 dark:border-gray-700 pt-6">
                            <x-button>
                                {{ __('Simpan Data Ekonomi') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
