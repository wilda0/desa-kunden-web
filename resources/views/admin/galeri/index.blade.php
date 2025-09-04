@section('title', content: 'Admin - Galeri')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Galeri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div
                    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:radient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">

                    {{-- Tombol Tambah Data --}}
                    <div class="mb-6">
                        <a href="{{ route('admin.galeri.create') }}"
                            class="inline-flex items-center px-4 py-2  bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active: bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            {{ __('+ Tambah Media') }}
                        </a>
                    </div>

                    {{-- Notifikasi Sukses --}}
                    @if (session('success'))
                        <div
                            class="mb-4 p-4  bg-green-100 dark: bg-green-800 border border-green-200 dark:border-green-600 text-green-700 dark:text-green-200 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @forelse ($galeris as $galeri)
                            @php
                                $extension = strtolower(pathinfo($galeri->gambar, PATHINFO_EXTENSION));
                                $isVideo = in_array($extension, ['mp4', 'webm', 'ogg']);
                            @endphp

                            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm hover:shadow-lg transition-shadow duration-200 overflow-hidden group relative media-card"
                                data-url="{{ asset('storage/' . $galeri->gambar) }}"
                                data-is-video="{{ $isVideo ? '1' : '0' }}">

                                @if ($isVideo)
                                    <div class="relative">
                                        <video controls class="w-full h-48 object-cover bg-[rgba(0,0,0,0.25)] rounded-t-2xl media-element">
                                            <source src="{{ asset('storage/' . $galeri->gambar) }}"
                                                type="video/{{ $extension }}">
                                            Your browser does not support the video tag.
                                        </video>
                                        <div class="absolute top-2 left-2 bg-[rgba(0,0,0,0.25)] bg-opacity-50 text-white rounded-full p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path d="M4 2v20l18-10L4 2z" />
                                            </svg>
                                        </div>
                                    </div>
                                @else
                                    <img src="{{ asset('storage/' . $galeri->gambar) }}" alt="{{ $galeri->judul }}"
                                        class="w-full h-48 object-cover rounded-t-2xl media-element">
                                @endif

                                <div class="p-4 flex flex-col">
                                    <h3 class="font-semibold text-gray-900 dark:text-white truncate"
                                        title="{{ $galeri->judul }}">{{ $galeri->judul }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 media-info">Loading...</p>
                                    <div class="mt-3 flex justify-between items-center">
                                        <a href="{{ route('admin.galeri.edit', $galeri->id) }}"
                                            class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                        <div x-data="{ open: false }" class="relative">
                                            <button @click="open = true"
                                                class="text-sm font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</button>

                                            <div x-show="open" @click.away="open = false"
                                                class="fixed inset-0 z-50 flex items-center justify-center bg-[rgba(0,0,0,0.25)] bg-opacity-50"
                                                style="display: none;">
                                                <div
                                                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 max-w-sm mx-auto">
                                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
                                                        Konfirmasi Hapus</h3>
                                                    <p class="text-gray-600 dark:text-gray-400 mb-6">Apakah Anda yakin ingin
                                                        menghapus media ini?</p>
                                                    <div class="flex justify-end space-x-4">
                                                        <button @click="open = false"
                                                            class="px-4 py-2   bg-gray-300 dark:bg-gray-600 rounded-md text-gray-800 dark:text-gray-200 hover:bg-gray-400">Batal</button>
                                                        <form action="{{ route('admin.galeri.destroy', $galeri->id) }}"
                                                            method="POST" class="inline">
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
                                </div>

                            </div>
                        @empty
                            <p class="col-span-full text-center text-gray-500 dark:text-gray-400">Tidak ada media di galeri.
                            </p>
                        @endforelse
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            document.querySelectorAll('.media-card').forEach(card => {
                                const isVideo = card.dataset.isVideo === '1';
                                const mediaElement = card.querySelector('.media-element');
                                const infoElement = card.querySelector('.media-info');

                                if (mediaElement) {
                                    // Get file info via fetch blob
                                    fetch(card.dataset.url)
                                        .then(res => res.blob())
                                        .then(blob => {
                                            const sizeKB = (blob.size / 1024).toFixed(1);

                                            if (!isVideo) {
                                                const img = new Image();
                                                img.src = URL.createObjectURL(blob);
                                                img.onload = () => {
                                                    infoElement.textContent = `${img.width}x${img.height}px, ${sizeKB} KB`;
                                                    URL.revokeObjectURL(img.src);
                                                };
                                            } else {
                                                const video = document.createElement('video');
                                                video.src = URL.createObjectURL(blob);
                                                video.onloadedmetadata = () => {
                                                    const duration = video.duration.toFixed(1);
                                                    infoElement.textContent = `${video.videoWidth}x${video.videoHeight}px, ${sizeKB} KB, ${duration}s`;
                                                    URL.revokeObjectURL(video.src);
                                                };
                                            }
                                        })
                                        .catch(() => {
                                            infoElement.textContent = 'Info unavailable';
                                        });
                                }
                            });
                        });
                    </script>

                    {{-- Pagination Links --}}
                    <div class="mt-6">
                        {{ $galeris->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>