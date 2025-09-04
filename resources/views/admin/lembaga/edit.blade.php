@section('title', content: 'Admin - Tambah Lembaga')
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

                    <form editor-attach="true" id="lembagaForm" action="{{ route('admin.lembaga.update',$lembaga) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="space-y-6">
                            <!-- Nama lembaga -->
                            <div class="flex justify-center items-start flex-col gap-2">
                                <x-label for="nama_lembaga" value="{{ __('Nama lembaga') }}" />
                                <x-input required id="nama_lembaga" class="block mt-1 w-full p-2" type="text" name="nama_lembaga"
                                    :value="old('nama_lembaga',$lembaga->nama_lembaga)" required autofocus
                                    placeholder="Masukkan Nama lembaga" />
                            </div>

                            <div class="flex justify-start gap-2 items-center w-full">
                                <div class="flex justify-center items-start flex-col gap-2">
                                    <x-label for="tipe_lembaga" value="{{ __('Tipe lembaga') }}" />
                                    <div class="relative inline-block w-50">
                                        <select name="tipe_lembaga" id="selected-item" class="hidden">
                                            @foreach ($semua_lembaga as $tipe)
                                                <option {{$tipe === $lembaga->tipe_lembaga? "selected": ""}} value="{{$tipe}}">{{$tipe}}</option>
                                            @endforeach
                                        </select>
                                        <!-- Trigger -->
                                        <button type="button"
                                            class="w-full flex justify-between items-center px-4 py-2 text-sm bg-white dark:bg-slate-800 dark:border-slate-700 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"
                                            onclick="this.nextElementSibling.classList.toggle('hidden')">
                                            <span id="selected" class="dark:text-white">Tipe {{ $lembaga->tipe_lembaga }}</span>
                                            <svg class="w-4 h-4 text-gray-500 " fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>

                                        <!-- Options -->
                                        <ul
                                            class="absolute z-10 mt-1 w-full bg-white dark:bg-slate-800 dark:border-slate-700 border border-gray-200 rounded-xl shadow-lg hidden">
                                            @php
                                                $index = 0;
                                            @endphp
                                            @foreach ($semua_lembaga as $tipe)
                                                <li class="px-4 py-2 hover:bg-indigo-50 dark:hover:bg-slate-700 cursor-pointer dark:text-white {{$index === 0 ? "rounded-t-xl" : ($index === count($semua_lembaga) - 1 ? "rounded-b-xl" : "")}}"
                                                    onclick="selectOption(this)">{{$tipe}}</li>
                                                @php
                                                    $index++;
                                                @endphp
                                            @endforeach

                                        </ul>
                                    </div>

                                    <script>
                                        function selectOption(el) {
                                            const value = el.textContent.trim();
                                            document.getElementById("selected").textContent = `Tipe ${value}`;
                                            const select = document.getElementById("selected-item");
                                            select.value = value;

                                            // Trigger change event so Livewire sees it
                                            select.dispatchEvent(new Event('change', { bubbles: true }));

                                            el.parentElement.classList.add("hidden");
                                        }
                                    </script>
                                </div>
                                <div class="flex w-[300px] justify-center items-start flex-col gap-2">
                                    <x-label for="tahun_berdiri" value="{{ __('Tahun Berdiri') }}" />
                                    <input required id="tahun_berdiri" class="w-full flex justify-between items-center px-4 py-2 text-sm bg-white dark:bg-slate-800 dark:text-white dark:border-slate-700 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"
                                        name="tahun_berdiri" type="number" :value="{{old('tahun_berdiri',$lembaga->tahun_berdiri)}}" required autofocus
                                        placeholder="Masukkan Tahun Berdiri lembaga" />
                                </div>
                            </div>

                            <!-- Deskripsi Editor 5 -->
                            <div>
                                <x-label class="mb-2" for="deskripsi" value="{{ __('Deskripsi') }}" />
                                <div id="deskripsi" class="bg-white rounded-b-xl min-h-[400px]">{{ old('deskripsi') }}
                                    
                                </div>
                            </div>

                            <!-- Tombol Tambah -->
                            <div class="flex justify-end">
                                <x-button type="submit" class="mt-4">
                                    {{ __('Update lembaga') }}
                                </x-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.deskripsiDelta = JSON.parse(@json($lembaga->deskripsi));
    </script>
    @vite(['resources/js/customEditor.js'])
</x-app-layout>