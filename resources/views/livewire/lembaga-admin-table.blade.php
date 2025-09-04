<div class="p-6 bg-white dark:bg-slate-900 rounded-2xl shadow">
    <div class="flex items-center gap-2 mb-4">

        <div class="relative inline-block w-50">
            <select wire:model.live="perPage" id="selected-item" class="hidden">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="40">40</option>
            </select>
            <!-- Trigger -->
            <button type="button"
                class="w-full flex justify-between items-center px-4 py-2 text-sm bg-white dark:bg-slate-800 dark:border-slate-700 border border-gray-300 rounded-2xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"
                onclick="this.nextElementSibling.classList.toggle('hidden')">
                <span id="selected" class="dark:text-white">Tampilkan {{ $perPage }}</span>
                <svg class="w-4 h-4 text-gray-500 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- Options -->
            <ul
                class="absolute z-10 mt-1 w-full bg-white dark:bg-slate-800 dark:border-slate-700 border border-gray-200 rounded-2xl shadow-lg hidden">
                <li index="0"
                    class="px-4 py-2 hover:bg-indigo-50 dark:hover:bg-slate-700 cursor-pointer dark:text-white rounded-t-2xl"
                    onclick="selectOption(this)">10</li>
                <li index="1"
                    class="px-4 py-2 hover:bg-indigo-50 dark:hover:bg-slate-700 cursor-pointer dark:text-white"
                    onclick="selectOption(this)">20</li>
                <li index="2"
                    class="px-4 py-2 hover:bg-indigo-50 dark:hover:bg-slate-700 cursor-pointer dark:text-white"
                    onclick="selectOption(this)">30</li>
                <li index="3"
                    class="px-4 py-2 hover:bg-indigo-50 dark:hover:bg-slate-700 cursor-pointer dark:text-white rounded-b-2xl"
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
            class="flex-1 px-4 py-2 border border-gray-300 dark:bg-slate-800 dark:text-white dark:border-slate-700 rounded-2xl focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400" />
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left border border-gray-200 dark:bg-slate-800 rounded-lg overflow-hidden">
            <thead class="  bg-gray-100 dark:bg-slate-800">
                <tr>
                    <th class="px-4 py-2 border-b dark:text-white">Nama Lembaga</th>
                    <th class="px-4 py-2 border-b dark:text-white">Deskripsi</th>
                    <th class="px-4 py-2 border-b dark:text-white">Tipe Lembaga</th>
                    <th class="px-4 py-2 border-b dark:text-white">Tahun Berdiri</th>
                    <th class="px-4 py-2 border-b dark:text-white text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lembagas as $index => $lembaga)
                    <tr wire:key="{{ $lembaga->id }}" class="hover:bg-gray-50 dark:hover:bg-slate-700">
                        <td class="px-4 py-2 border-b prose dark:prose-invert">{{ $lembaga->nama_lembaga }}</td>
                        <td class="px-4 py-2 border-b prose dark:prose-invert">
                            <div class="prose max-w-full" id="deskripsi-singkat-{{$index}}">
                            </div>
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
                        </td>
                        <td class="px-4 py-2 border-b prose dark:prose-invert">{{ $lembaga->tipe_lembaga }}</td>
                        <td class="px-4 py-2 border-b prose dark:prose-invert">{{ $lembaga->tahun_berdiri }}</td>
                        <td class="px-4 py-2 border-b">
                            <div class="flex items-center gap-1 justify-center">
                                <a href="{{ route("admin.lembaga.show", $lembaga) }}"
                                    class="  bg-green-800 text-white px-4 py-2 rounded uppercase">Lihat</a>
                                <a href="{{ route("admin.lembaga.edit", $lembaga) }}"
                                    class="  bg-blue-800 text-white px-4 py-2 rounded uppercase">Edit</a>
                                <div x-data="{ open: false }">
                                    <button @click="open = true"
                                        class="  bg-red-800 text-white px-4 py-2 rounded uppercase">Delete</button>

                                    <!-- Modal Konfirmasi Hapus -->
                                    <div x-show="open" @click.away="open = false"
                                        class="fixed inset-0 z-50 flex items-center justify-center bg-[rgba(0,0,0,0.25)] bg-opacity-50"
                                        style="display: none;">
                                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6">
                                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
                                                Konfirmasi Hapus</h3>
                                            <p class="text-gray-600 dark:text-gray-400 mb-6">Apakah Anda
                                                yakin ingin menghapus lembaga
                                                "{{ $lembaga->nama_lembaga }}"?</p>
                                            <div class="flex justify-end space-x-4">
                                                <button @click="open = false"
                                                    class="px-4 py-2   bg-gray-300 dark:bg-gray-600 rounded-md text-gray-800 dark:text-gray-200 hover:bg-gray-400">Batal</button>
                                                <form action="{{ route('admin.lembaga.destroy', $lembaga) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-4 py-2  bg-red-600 text-white rounded-md hover:ed-700">Hapus</button>
                                                </form>
                                            </div>
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
            {{ $lembagas->links() }}
        </div>
    </div>
</div>