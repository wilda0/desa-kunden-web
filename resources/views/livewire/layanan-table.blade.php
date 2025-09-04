<div class="p-6 bg-white rounded-2xl shadow">
    <div class="flex items-center flex-wrap gap-2 mb-4">

        <div class="relative inline-block w-full lg:w-50">
            <select wire:model.live="perPage" id="selected-item" class="hidden">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="40">40</option>
            </select>
            <!-- Trigger -->
            <button type="button"
                class="w-full flex justify-between items-center px-4 py-2 text-sm bg-white border border-gray-300 rounded-2xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"
                onclick="this.nextElementSibling.classList.toggle('hidden')">
                <span id="selected">Tampilkan {{ $perPage }}</span>
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- Options -->
            <ul class="absolute z-10 mt-1 w-full bg-white border border-gray-200 rounded-2xl shadow-lg hidden">
                <li index="0" class="px-4 py-2 hover:bg-indigo-50 cursor-pointer" onclick="selectOption(this)">10</li>
                <li index="1" class="px-4 py-2 hover:bg-indigo-50 cursor-pointer" onclick="selectOption(this)">20</li>
                <li index="2" class="px-4 py-2 hover:bg-indigo-50 cursor-pointer" onclick="selectOption(this)">30</li>
                <li index="3" class="px-4 py-2 hover:bg-indigo-50 cursor-pointer" onclick="selectOption(this)">40</li>
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


        <input type="text" wire:model.live="nama_layanan" placeholder="Cari layanan..."
            class="flex-1 w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400" />
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left border border-gray-200 rounded-lg overflow-hidden">
            <thead class="  bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border-b">Nama Layanan</th>
                    <th class="px-4 py-2 border-b">Deskripsi</th>
                    <th class="px-4 py-2 border-b">Tanggal Dibuat</th>
                    <th class="px-4 py-2 border-b">Tanggal Diedit</th>
                    <th class="px-4 py-2 border-b"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($layanans as $index => $layanan)
                    <tr wire:key="{{ $layanan->id }}" class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $layanan->nama_layanan }}</td>
                        <td class="px-4 py-2 border-b ">
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
                                    const delta = JSON.parse(@json($layanan->deskripsi));
                                    content.updateContents(delta);
                                    container.innerHTML = content.getText().substring(0, 100) + (content.getLength() > 100 ? "..." : "");
                                });
                            </script>
                        </td>
                        <td class="px-4 py-2 border-b">{{ $layanan->created_at->format('d-m-Y') }}</td>
                        <td class="px-4 py-2 border-b">{{ $layanan->updated_at->format('d-m-Y') }}</td>
                        <td class="px-4 py-2 border-b">
                            <div x-data="{ open: false }">
                                <x-button @click="open = true"
                                    class=" bg-blue-500 text-white px-4 py-2 rounded">Lihat
                                    Selengkapnya
                                </x-button>

                                <div x-show="open"
                                    class="bg-[rgba(0,0,0,0.25)] bg-opacity-50 w-full h-full z-50 fixed top-0 left-0">
                                </div>
                                <div x-show="open"
                                    class="fixed z-50 max-w-[80%] lg:max-w-[700px] max-h-[80%] lg:max-h-[80%] flex items-start justify-center left-0 right-0 top-0 bottom-0 m-auto">
                                    <div class="bg-white flex flex-col p-6 rounded shadow-lg">
                                        <div
                                            class="flex justify-between items-center border-b dark:border-gray-700 pb-3 mb-4">
                                            <h3 class="text-lg w-[90%] font-bold text-gray-900 ">
                                                {{ $layanan->nama_layanan }}
                                            </h3>
                                            <button @click="open = false"
                                                class="text-red-500 w-[10%] flex justify-center items-center hover:text-red-700 text-2xl">&times;</button>
                                        </div>
                                        <div class="w-full max-h-[400px] lg:max-h-[400px] min-h-[300px] overflow-y-auto">
                                            <div class="prose max-w-full" id="deskripsi-lengkap-{{$index}}">
                                            </div>
                                            <script>
                                                window.document.addEventListener("DOMContentLoaded", () => {
                                                    const container = document.querySelector("#deskripsi-lengkap-{{$index}}");
                                                    const content = new Quill(container, {
                                                        theme: "bubble",
                                                        readOnly: true,
                                                        modules: {
                                                            toolbar: [
                                                                ["table-better"]
                                                            ],
                                                            "table-better": {
                                                                language: "en_US",
                                                                menus: ["column", "row", "merge", "table", "cell", "wrap", "copy", "delete"],
                                                                toolbarTable: true,
                                                            }
                                                        }
                                                    });
                                                    content.updateContents(JSON.parse(@json($layanan->deskripsi)));
                                                    container.classList.remove("ql-container");
                                                });
                                            </script>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                            Tidak ada data ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $layanans->links() }}
        </div>
    </div>
</div>