@section('title', content: 'Admin - Informasi Publik')

<x-app-layout>
    @vite(['resources/js/quillInit.js'])

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Informasi Publik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800">

                    @if ($errors->any())
                        <div class="mb-4 p-4  bg-red-100 text-red-700 border border-red-200 rounded-lg">
                            <div class="font-medium">{{ __('Whoops! Something went wrong.') }}</div>
                            <ul class="mt-3 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form editor-attach action="{{ route('admin.informasi-publik.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <x-label for="judul_informasi" value="{{ __('Judul Informasi') }}" />
                            <x-input id="judul_informasi" class="block mt-1 w-full" type="text"
                                name="judul_informasi" :value="old('judul_informasi')" required autofocus
                                placeholder="Masukkan judul informasi" />
                        </div>

                        <div>
                            <x-label for="kategori" value="{{ __('Kategori') }}" />
                            <select id="kategori" name="kategori" required
                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="" disabled selected>Pilih Kategori</option>
                                <option value="Program dan Kegiatan">Program dan Kegiatan</option>
                                <option value="Anggaran dan Keuangan">Anggaran dan Keuangan</option>
                                <option value="Peraturan dan Kebijakan">Peraturan dan Kebijakan</option>
                                <option value="Layanan Publik">Layanan Publik</option>
                                <option value="Informasi Berkala">Informasi Berkala</option>
                                <option value="Hasil Musyawarah Desa">Hasil Musyawarah Desa</option>
                                <option value="Pengumuman Publik">Pengumuman Publik</option>
                            </select>
                        </div>

                        <div>
                            <x-label for="deskripsi" value="{{ __('Deskripsi') }}" />
                            <div id="deskripsi" name="deskripsi" rows="5"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                required>{{ old('deskripsi') }}</div>
                        </div>

                        <div>
                            <x-label for="tahun" value="{{ __('Tahun') }}" />
                            <x-input id="tahun" class="block mt-1 w-full" type="number" name="tahun"
                                :value="old('tahun')" required placeholder="Contoh: 2025" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.informasi-publik.index') }}"
                                class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white underline mr-4">
                                Batal
                            </a>
                            <x-button>
                                {{ __('Simpan') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        <script>
        let initialImages = [];
        window.mediasURLHandler = urls =>{
            console.log(urls);
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
                            const response = await fetch('{{ route("informasi-publik.media.add") }}', {
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

                fetch(`{{ route("informasi-publik.media.remove") }}`, {
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
