<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galeri - Website Desa Kunden</title>
    <link rel="icon" type="image/png" href="/images/logo-kunden.png">

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/quillInit.js'])

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- AlpineJS -->


    <style>
        [x-cloak] {
            display: none !important;
        }

        .filmstrip::-webkit-scrollbar {
            height: 8px;
        }

        .filmstrip::-webkit-scrollbar-track {
            background: #444;
            border-radius: 4px;
        }

        .filmstrip::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        .filmstrip::-webkit-scrollbar-thumb:hover {
            background: #bbb;
        }
    </style>
</head>

<body class="  bg-gray-100 font-sans text-gray-800">

    @include('layouts.partials.header')

    @php
        $images = [];
        foreach ($galleryImages as $item) {
            $extension = strtolower(pathinfo($item->gambar, PATHINFO_EXTENSION));
            $images[] = [
                'thumbnail' => '',
                'src' => asset('storage/' . $item->gambar),
                'title' => $item->judul,
                'isVideo' => in_array($extension, ['mp4', 'webm', 'ogg'])
            ];
        }
    @endphp

    <main x-data="gallerySlider()" x-init="init()" class="container mx-auto px-6 lg:px-16 py-12">

        <!-- Title Section -->
        <div class="border-b-2 border-gray-200 pb-4 mb-8">
            <nav class="text-sm mb-4 text-gray-500">
                <a href="{{ route('welcome') }}" class="hover:text-blue-600">Home</a>
                <span class="mx-2">/</span>
                <span class="text-gray-700">Galeri Desa</span>
            </nav>
            <h1 class="text-4xl font-bold text-gray-800">Galeri Desa</h1>
            <p class="text-gray-500 mt-2">Menampilkan dokumentasi gambar dan video yang ada di desa.</p>
        </div>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse ($galleryImages as $index => $item)
                @php
                    $extension = strtolower(pathinfo($item->gambar, PATHINFO_EXTENSION));
                    $isVideo = in_array($extension, ['mp4', 'webm', 'ogg']);
                @endphp
                <div @click="openModal({{ $index }})"
                    class="group relative block w-full rounded-2xl shadow-md overflow-hidden cursor-pointer aspect-square   bg-gray-50 dark:bg-gray-800 transition-transform hover:scale-105">
                    <img src="" alt="{{ $item->judul }}" class="w-full thumbnail h-full object-cover rounded-2xl">
                    <div class="absolute bottom-0 left-0 w-full p-2   radient-to-t from-black/70 to-transparent">
                        <h3 class="text-white font-semibold text-sm truncate">{{ $item->judul }}</h3>
                        <p class="text-xs text-white/80 media-info">Loading...</p>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-gray-500 text-center py-8">Belum ada media galeri.</p>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $galleryImages->links() }}
        </div>

        <!-- Lightbox Modal -->
        <div x-show="showModal" x-transition @keydown.escape.window="closeModal()"
            @keydown.arrow-right.window="nextImage()" @keydown.arrow-left.window="prevImage()"
            class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-[rgba(0,0,0,0.8)] bg-opacity-90"
            x-cloak>
            <!-- Top Bar -->
            <div class="w-full flex justify-between items-center p-4 text-white absolute top-0 left-0 z-10">
                <div class="flex flex-col">
                    <span x-text="images[currentIndex]?.title" class="text-lg font-semibold"></span>
                    <span x-text="images[currentIndex]?.info" class="text-sm text-white/70"></span>
                </div>
                <button @click="closeModal()" class="text-white hover:opacity-75 text-3xl">&times;</button>
            </div>

            <!-- Main Media -->
            <div class="flex items-center justify-center h-full w-full relative">
                <button @click.stop="prevImage()"
                    class="absolute left-4 p-2 text-white /30 rounded-full hover:bg-[rgba(0,0,0,0.25)]/50 transition-colors z-10">
                    <i data-lucide="chevron-left" class="w-8 h-8"></i>
                </button>

                <div class="relative flex flex-col items-center justify-center text-center">
                    <template x-if="images[currentIndex]?.isVideo">
                        <video controls class="object-contain max-h-[70vh] max-w-[90vw] shadow-lg rounded-md">
                            <source :src="images[currentIndex].src" type="video/mp4">
                        </video>
                    </template>
                    <template x-if="!images[currentIndex]?.isVideo">
                        <img :src="images[currentIndex].src"
                            class="object-contain max-h-[70vh] max-w-[90vw] shadow-lg rounded-md">
                    </template>
                    <div class="mt-4">
                        <p x-text="`${currentIndex + 1} / ${images.length}`" class="text-white/70 font-mono text-sm">
                        </p>
                    </div>
                </div>

                <button @click.stop="nextImage()"
                    class="absolute right-4 p-2 text-white bg-[rgba(0,0,0,0.25)]/30 rounded-full hover:bg-[rgba(0,0,0,0.25)]/50 transition-colors z-10">
                    <i data-lucide="chevron-right" class="w-8 h-8"></i>
                </button>
            </div>

            <!-- Thumbnails -->
            <div class="absolute bottom-0 left-0 w-full p-4 overflow-hidden">
                <div x-ref="filmstrip" class="flex justify-center space-x-2 overflow-x-auto filmstrip pb-2">
                    <template x-for="(image, index) in images" :key="index">
                        <img @click="currentIndex = index" :src="image.thumbnail"
                            class="w-20 h-14 object-cover rounded-md cursor-pointer transition-opacity"
                            :class="{ 'border-2 border-white opacity-100': currentIndex === index, 'opacity-50 hover:opacity-100': currentIndex !== index, 'active-thumbnail': currentIndex === index }" />
                    </template>
                </div>
            </div>
        </div>
    </main>

    @include('layouts.partials.footer')

    <script>
        lucide.createIcons();

        function gallerySlider() {
            return {
                images: @json($images),
                showModal: false,
                currentIndex: 0,
                init() {

                    window.onload = () => {
                        this.images.forEach((img, i) => {
                            const cards = document.querySelectorAll(".group");
                            const info = cards[i].querySelector(".media-info");
                            const thumbnail = cards[i].querySelector(".thumbnail");
                            if (!img.isVideo) {
                                fetch(img.src)
                                    .then(res => res.blob())
                                    .then(blob => {
                                        const sizeKB = (blob.size / 1024).toFixed(1);
                                        const image = new Image();
                                        image.src = URL.createObjectURL(blob);
                                        thumbnail.src = image.src;
                                        img.thumbnail = image.src;
                                        image.onload = () => {
                                            info.innerHTML = `${image.width}x${image.height}px, ${sizeKB} KB`;

                                        };

                                    });
                            } else {
                                const video = document.createElement('video');
                                video.src = img.src;
                                video.preload = 'metadata';
                                video.muted = true;
                                video.crossOrigin = "anonymous"; // needed if remote videos

                                video.onloadedmetadata = () => {
                                    console.log("Metadata loaded:", video.videoWidth, video.videoHeight, video.duration);
                                    info.innerHTML = `${video.videoWidth}x${video.videoHeight} px, ${video.duration.toFixed(1)} s`;

                                    // Force seek
                                    video.currentTime = video.duration > 1 ? 0.5 : 0.01;
                                };

                                video.onseeked = () => {

                                    try {
                                        const canvas = document.createElement('canvas');
                                        canvas.width = video.videoWidth;
                                        canvas.height = video.videoHeight;
                                        const ctx = canvas.getContext('2d');
                                        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

                                        const thumbnailURL = canvas.toDataURL('image/jpeg');


                                        img.thumbnail = thumbnailURL;
                                        if (thumbnail) {
                                            thumbnail.src = thumbnailURL;

                                        } else {

                                        }
                                    } catch (err) {

                                    } finally {
                                        video.removeAttribute("src");
                                        video.load(); // release
                                    }
                                };
                            }
                        });
                    }

                },
                openModal(index) { this.currentIndex = index; this.showModal = true; },
                closeModal() {
                    this.showModal = false;
                    document.querySelectorAll("video").forEach(d => {
                        d.pause();
                    });
                },
                nextImage() { this.currentIndex = (this.currentIndex + 1) % this.images.length; this.scrollToActiveThumbnail(); },
                prevImage() { this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length; this.scrollToActiveThumbnail(); },
                scrollToActiveThumbnail() {
                    this.$nextTick(() => {
                        const activeThumb = this.$refs.filmstrip.querySelector('.active-thumbnail');
                        if (activeThumb) activeThumb.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                    });
                }
            }
        }
    </script>
    <script src="//unpkg.com/alpinejs"></script>
</body>

</html>