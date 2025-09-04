<div class="p-6 bg-white rounded-2xl shadow">
    <div class="flex justify-center flex-wrap items-center gap-2 mb-4">

        <div class="relative inline-block w-full lg:w-50">
            <select wire:model.live="perPage" id="selected-item" class="hidden">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="40">40</option>
            </select>
            <!-- Trigger -->
            <button type="button"
                class="w-full flex justify-between items-center px-4 py-2 text-sm bg-white  dark:border-slate-700 border border-gray-300 rounded-2xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"
                onclick="this.nextElementSibling.classList.toggle('hidden')">
                <span id="selected" class="">Tampilkan {{ $perPage }}</span>
                <svg class="w-4 h-4 text-gray-500 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- Options -->
            <ul
                class="absolute z-10 mt-1 w-full bg-white  dark:border-slate-700 border border-gray-200 rounded-2xl shadow-lg hidden">
                <li index="0" class="px-4 py-2 hover:bg-indigo-50 dark:hover:bg-slate-700 cursor-pointer  rounded-t-2xl"
                    onclick="selectOption(this)">10</li>
                <li index="1" class="px-4 py-2 hover:bg-indigo-50 dark:hover:bg-slate-700 cursor-pointer "
                    onclick="selectOption(this)">20</li>
                <li index="2" class="px-4 py-2 hover:bg-indigo-50 dark:hover:bg-slate-700 cursor-pointer "
                    onclick="selectOption(this)">30</li>
                <li index="3" class="px-4 py-2 hover:bg-indigo-50 dark:hover:bg-slate-700 cursor-pointer  rounded-b-2xl"
                    onclick="selectOption(this)">40</li>
            </ul>
        </div>

        <script>
            function selectOption(el) {
                const value = el.textContent.trim();
                document.getElementById("selected").textContent = `Tampilkan ${value}`;
                const select = document.getElementById("selected-item");
                select.value = value;

                // Trigger change event so Livewire sees it
                select.dispatchEvent(new Event('change', { bubbles: true }));

                el.parentElement.classList.add("hidden");
            }
        </script>


        <input type="text" wire:model.live="nama_lembaga" placeholder="Cari Lembaga..."
            class="flex-1 px-4 py-2 border border-gray-300 w-full  dark:border-slate-700 rounded-2xl focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400" />
    </div>

    <style>
        .lembagas-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            justify-content: center;
            align-items: center;
            align-content: center;
            gap: 1rem;
            padding: 1rem 0px;
        }

        /* only apply when one card left */
        .lembagas-grid.single>div {
            max-width: 400px;
            margin: 0 auto;
            /* center it */
        }
    </style>
    <div class="overflow-x-auto">
        <div class="lembagas-grid {{ $lembagas->count() === 1 ? 'single' : '' }}">
            @forelse ($lembagas as $index => $lembaga)
            <div
                class=" w-full h-[300px] bg-white rounded-2xl shadow-lg border border-gray-200 p-6 flex flex-col justify-between">
                <div class="mb-2">
                    <p class="text-sm font-medium text-gray-500 mb-1"> Tipe lembaga, {{ $lembaga->tipe_lembaga }}</p>
                    <h1 class="text-2xl font-bold text-gray-800">Lembaga {{ $lembaga->nama_lembaga }}</h1>
                </div>

                <div class="flex-grow flex flex-col">
                    <div class="text-sm text-gray-700 leading-relaxed mb-4">
                        <div id="deskripsi-singkat-{{$index}}"></div>
                            <script>
                                window.document.addEventListener("DOMContentLoaded", () => {
                                    const container = document.querySelector("#deskripsi-singkat-{{$index}}");
                                    const content = new Quill(container, {
                                        theme: "bubble",
                                        readOnly: true,
                                        modules: {
                                            toolbar: false
                                        }
                                    });
                                    const delta = JSON.parse(@json($lembaga->deskripsi));
                                    content.updateContents(delta);
                                    container.innerHTML = content.getText().substring(0, 100) + (content.getLength() > 100 ? "..." : "");
                                });
                            </script>
                    </div>
                    <p class="text-xs font-semibold text-gray-600 text-right mt-auto">
                        <span class="text-blue-600">Tahun Berdiri {{ $lembaga->tahun_berdiri }}</span> &middot; Desa
                        Kunden
                    </p>
                </div>
                <a href="{{ route("lembaga-desa-detail", $lembaga) }}" class="w-fit hover:text-blue-400">Lihat Info
                    Lengkap</a>
            </div>
            @empty
            <div
                class=" w-full h-[250px] bg-white rounded-2xl shadow-lg border border-gray-200 p-6 flex flex-col justify-center items-center">
                Tidak ada data yang ditemukan
            </div>
            @endforelse
        </div>
        <div class="mt-4">
            {{ $lembagas->links() }}
        </div>
    </div>
</div>