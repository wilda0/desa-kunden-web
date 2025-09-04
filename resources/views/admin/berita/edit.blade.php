@section('title', content: 'Admin - Artikel')

<x-app-layout>
    @vite(['resources/js/quillInit.js'])
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Artikel ') }}
        </h2>
    </x-slot>

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

                    <form editor-attach action="{{ route('admin.berita.update', $berita) }}" method="POST">
                        @csrf
                        @method("PUT")
                        <div class="space-y-6">
                            <!-- Nama Artikel -->

                            <div class="flex items-center gap-2 mb-4">

                                <div class="relative inline-block w-50">
                                    <select id="selected-item" name="jenis" class="hidden">
                                        <option value="Berita Desa" {{ $berita->jenis === "Berita Desa" ? "selected" : "" }}>Berita Desa</option>
                                        <option value="Pengumuman Desa" {{ $berita->jenis === "Pengumuman Desa" ? "selected" : "" }}>Pengumuman Desa</option>
                                        <option value="Pembangunan Desa" {{ $berita->jenis === "Pembangunan Desa" ? "selected" : "" }}>Pembangunan Desa</option>
                                        <option value="Kegiatan Desa" {{ $berita->jenis === "Kegiatan Desa" ? "selected" : "" }}>Kegiatan Desa</option>
                                    </select>
                                    <!-- Trigger -->
                                    <button type="button"
                                        class="w-full flex justify-between items-center px-4 py-2 text-sm bg-white border border-gray-300 rounded-2xl shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-200"
                                        onclick="this.nextElementSibling.classList.toggle('hidden')">
                                        <span id="selected">Jenis Artikel {{ old("jenis", $berita->jenis) }}</span>
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>

                                    <!-- Options -->
                                    <ul
                                        class="absolute z-10 mt-1 w-full bg-white border border-gray-200 rounded-2xl shadow-lg hidden">
                                        <li class="px-4 py-2 hover:bg-indigo-50 rounded-t-2xl cursor-pointer"
                                            onclick="selectOption(this)">Berita Desa</li>
                                        <li class="px-4 py-2 hover:bg-indigo-50 cursor-pointer"
                                            onclick="selectOption(this)">Pengumuman Desa</li>
                                        <li class="px-4 py-2 hover:bg-indigo-50 cursor-pointer"
                                            onclick="selectOption(this)">Pembangunan Desa</li>
                                        <li class="px-4 py-2 hover:bg-indigo-50 rounded-b-2xl cursor-pointer"
                                            onclick="selectOption(this)">Kegiatan Desa</li>
                                    </ul>
                                </div>

                                <script>
                                    function selectOption(el) {
                                        const value = el.textContent.trim();
                                        document.getElementById("selected").textContent = `Jenis Artikel ${value}`;
                                        const select = document.getElementById("selected-item");
                                        select.value = value;

                                        // Trigger change event so Livewire sees it
                                        select.dispatchEvent(new Event('change', { bubbles: true }));

                                        el.parentElement.classList.add("hidden");
                                    }
                                </script>


                                <input id="nama-berita" type="text"
                                    value="{{ old("nama_berita", $berita->nama_berita) }}" name="nama_berita"
                                    placeholder="Nama Berita..."
                                    class="flex-1 px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400" />
                            </div>

                            <div class="flex justify-center items-center flex-col">
                                <label id="d-label" class="w-full mb-2 dark:text-white"
                                    for="deskripsi">{{ __('Deskripsi') }}</label>
                                <div id="deskripsi" rows="10" class="bg-white porse w-full rounded-b-xl min-h-[200px]">
                                </div>

                            </div>



                            <div class="flex items-center justify-end mt-4">
                                <a href="{{ route('admin.berita.index') }}"
                                    class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white underline mr-4">
                                    Batal
                                </a>
                                <x-button>
                                    {{ __('Update Artikel') }}
                                </x-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        let initialImages = [];
        window.deskripsiDelta = JSON.parse(@json($berita->deskripsi));
        window.quillTextChangeEventHandler = async (quill, delta_content) => {

            document.querySelector("#d-label").innerHTML = `Deskripsi (Menyimpan otomatis 🔃)`;
            const form_data = new FormData();
            const jenis = document.querySelector("#selected-item");
            const nama_berita = document.querySelector("#nama-berita");
            const markdownInput = document.createElement("input");
            form_data.append("nama_berita", nama_berita.value);
            form_data.append("jenis", jenis.value);
            form_data.append("deskripsi", delta_content);
            form_data.append("id", "{{ $berita->id }}");

            const response = await fetch("{{ route("berita.media.auto_update") }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    'accept': "application/json"
                },
                body: form_data
            });

            if (!response.ok) {
                document.querySelector("#d-label").innerHTML = `Deskripsi (Menyimpan otomatis ❌)`;
                throw new Error('menyimpan otomatis gagal.');
            }

            const result = await response.json();
            if (result.message) {
                document.querySelector("#d-label").innerHTML = `Deskripsi (Menyimpan otomatis ✅)`;
            }
        };
        window.mediasURLHandler = async urls => {
            if (!urls.length) return;
            const form_data = new FormData();
            urls.forEach(url => {
                const _t = new URL(url);
                const _url = url.replace(_t.origin + "/storage/", "");
                form_data.append("url[]", _url);
            });
            const response = await fetch("{{ route("berita.media.id") }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    'accept': "application/json"
                },
                body: form_data
            });

            if (!response.ok) {
                throw new Error('media id failed.');
            }

            const result = await response.json();
            result.forEach((d, i) => {
                if (d.exists) initialImages.push({ ...d, url: urls[i] });
            });
        };
        window.handlers = {
            ...(window.handlers || {}),
            image() {
                const input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*,video/*');
                input.click();

                input.onchange = async () => {
                    const file = input.files[0];
                    if (file) {
                        const formData = new FormData();
                        formData.append('media', file);

                        const range = this.quill.getSelection(true);
                        const editorIndex = range ? range.index : this.quill.getLength();

                        try {
                            const response = await fetch('{{ route("berita.media.add") }}', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': '{{ @csrf_token() }}'
                                }
                            });

                            if (!response.ok) {
                                throw new Error('File upload failed.');
                            }

                            const data = await response.json();

                            // FIX: Use the 'url' property instead of 'path'
                            const serverUrl = data.url;
                            initialImages.push(data);

                            this.quill.insertEmbed(editorIndex, 'image', serverUrl);
                        } catch (error) {
                            console.error('Upload error:', error);
                            alert('Error uploading image.');
                        }
                    }
                };
            }
        };

        window.handleImageDeletion = (quill) => {
            // Get all image tags currently in the Quill editor
            const editorImages = quill.root.querySelectorAll('img');
            const currentImageUrls = Array.from(editorImages).map(img => img.src);

            // Assuming you have an array of initial image URLs from the server
            // e.g., window.initialImages = ['/storage/image1.jpg', '/storage/image2.jpg'];
            const imagesToDelete = initialImages.filter(({ url }) => !currentImageUrls.includes(url));

            // Send a request to the server for each image to be deleted
            imagesToDelete.forEach(({ url, id }) => {
                // Extract the filename or ID from the URL
                const filename = new URL(url).pathname.split('/').pop();
                const data = new FormData();
                data.append("id", id);

                fetch(`{{ route("berita.media.remove") }}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ @csrf_token() }}' // CSRF token for security
                    },
                    body: data
                })
                    .then(response => {
                        if (response.ok) {

                            console.log(`Successfully deleted image: ${filename}`);
                            // Remove the URL from the initial list to prevent re-deleting
                            initialImages = initialImages.filter(img => img.id !== id);
                        } else {
                            console.error(`Failed to delete image: ${filename}`);
                        }
                    })
                    .catch(error => {
                        console.error('Network or server error:', error);
                    });
            });
        }
    </script>
@vite(['resources/js/customEditor.js'])
</x-app-layout>