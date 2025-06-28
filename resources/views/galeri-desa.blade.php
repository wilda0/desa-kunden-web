<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galeri - Website Desa Kunden</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo-kunden.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- AlpineJS -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        .nav-link {
            position: relative;
            padding-bottom: 0.5rem;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #3B82F6;
            transform: scaleX(0);
            transform-origin: bottom right;
            transition: transform 0.3s ease-out;
        }
        .nav-link:hover::after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }
        /* Styling untuk filmstrip di lightbox */
        .filmstrip::-webkit-scrollbar { height: 8px; }
        .filmstrip::-webkit-scrollbar-track { background: #444; border-radius: 4px; }
        .filmstrip::-webkit-scrollbar-thumb { background: #888; border-radius: 4px; }
        .filmstrip::-webkit-scrollbar-thumb:hover { background: #bbb; }
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="bg-gray-100 font-sans text-gray-800">

    @include('layouts.partials.header')

    @php
        // Mengambil data dari database
        $galleryItems = \App\Models\Galeri::latest()->paginate(12);
    @endphp

    <main x-data="{
        showModal: false,
        currentIndex: 0,
        images: {{ json_encode($galleryItems->map(fn($item) => ['src' => Storage::url($item->gambar), 'title' => $item->judul])) }},
        openModal(index) {
            this.currentIndex = index;
            this.showModal = true;
        },
        closeModal() {
            this.showModal = false;
        },
        nextImage() {
            this.currentIndex = (this.currentIndex + 1) % this.images.length;
            this.scrollToActiveThumbnail();
        },
        prevImage() {
            this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
            this.scrollToActiveThumbnail();
        },
        scrollToActiveThumbnail() {
            this.$nextTick(() => {
                const activeThumb = this.$refs.filmstrip.querySelector('.active-thumbnail');
                if (activeThumb) {
                    activeThumb.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                }
            });
        }
    }">
        <div class="container mx-auto px-6 lg:px-16 py-12">
            <!-- Title Section -->
            <div class="border-b-2 border-gray-200 pb-4 mb-8">
                <nav class="text-sm mb-4 text-gray-500">
                    <a href="{{ route('welcome') }}" class="hover:text-blue-600">Home</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-700">Galeri Desa</span>
                </nav>
                <h1 class="text-4xl font-bold text-gray-800">Galeri Desa</h1>
                <p class="text-gray-500 mt-2">Menampilkan kegiatan-kegiatan yang berlangsung di desa.</p>
            </div>

            <!-- Photo Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse ($galleryItems as $index => $item)
                    <div>
                        <img @click="openModal({{ $index }})" src="{{ Storage::url($item->gambar) }}" alt="{{ $item->judul }}"
                            class="w-full h-full object-cover rounded-lg shadow-md aspect-square cursor-pointer transition-transform duration-300 hover:scale-105">
                    </div>
                @empty
                    <p class="col-span-full text-gray-500">Belum ada gambar galeri.</p>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $galleryItems->links() }}
            </div>
        </div>

        <!-- Lightbox Modal -->
        <div x-show="showModal"
             x-transition
             @keydown.escape.window="closeModal()"
             @keydown.arrow-right.window="nextImage()"
             @keydown.arrow-left.window="prevImage()"
             class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-black bg-opacity-90"
             x-cloak>

            <!-- Top Bar -->
            <div class="w-full flex justify-between items-center p-4 text-white absolute top-0 left-0 z-10">
                <span x-text="`${currentIndex + 1} / ${images.length}`" class="text-lg font-mono"></span>
                <button @click="closeModal()" class="text-white hover:opacity-75 text-3xl">&times;</button>
            </div>

            <!-- Main Image and Navigation -->
            <div class="flex items-center justify-center h-full w-full">
                <button @click.stop="prevImage()" class="absolute left-4 p-2 text-white bg-black/30 rounded-full hover:bg-black/50 transition-colors z-10">
                    <i data-lucide="chevron-left" class="w-8 h-8"></i>
                </button>

                <img :src="images[currentIndex]?.src" class="object-contain max-h-[70vh] max-w-[90vw] shadow-lg rounded-md">

                <button @click.stop="nextImage()" class="absolute right-4 p-2 text-white bg-black/30 rounded-full hover:bg-black/50 transition-colors z-10">
                    <i data-lucide="chevron-right" class="w-8 h-8"></i>
                </button>
            </div>

            <!-- Filmstrip Thumbnails -->
            <div class="absolute bottom-0 left-0 w-full p-4 overflow-hidden">
                <div x-ref="filmstrip" class="flex justify-center space-x-2 overflow-x-auto filmstrip pb-2">
                    <template x-for="(image, index) in images" :key="index">
                        <img @click="currentIndex = index"
                            :src="image.src"
                            class="w-20 h-14 object-cover rounded-md cursor-pointer transition-opacity"
                            :class="{ 'border-2 border-white opacity-100': currentIndex === index, 'opacity-50 hover:opacity-100': currentIndex !== index, 'active-thumbnail': currentIndex === index }">
                    </template>
                </div>
            </div>
        </div>
    </main>

    @include('layouts.partials.footer')

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
