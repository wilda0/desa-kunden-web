<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Desa Kunden | Website Resmi</title>
    <meta name="description" content="Website resmi Desa Kunden Kecamatan Bulu, Sukoharjo. Berisi informasi desa, profil, berita, kegiatan, dan layanan publik.">

    <link rel="canonical" href="https://kunden.id/" />

    <link rel="icon" type="image/png" href="/public/images/logo-kunden.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Custom CSS for Marquee, Sliders, and Navbar Animation -->
    <style>
        .marquee-content {
            animation: marquee 30s linear infinite;
        }

        @keyframes marquee {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .slider-container {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .slider-container::-webkit-scrollbar {
            display: none;
        }

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

        .typing-cursor {
            display: inline-block;
            width: 3px;
            height: 2.5rem;
            background-color: white;
            margin-left: 8px;
            animation: blink 0.8s infinite;
        }

        @media (min-width: 768px) {
            .typing-cursor {
                height: 3.75rem;
            }
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }
        }

        .reveal-on-scroll {
            opacity: 0;
            transition: opacity 1s ease-out, transform 1s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans text-gray-800">

    <!-- Top Marquee -->
    <div class="bg-blue-800 text-white py-2 overflow-hidden">
        <div class="marquee-content whitespace-nowrap">
            <p>Selamat Datang di Website Resmi Pemerintah Desa Kunden, Kecamatan Bulu, Kabupaten Sukoharjo, Jawa Tengah
            </p>
        </div>
    </div>

    <!-- Header & Navbar -->
    @include('layouts.partials.header')

    <main x-data="{ showMore: false }">
        <!-- Hero Section -->
        <section id="home" class="relative h-[60vh] md:h-[80vh] bg-cover bg-center"
            style="background-image: url('/public/images/kantor-kunden.png');">
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="relative z-10 flex flex-col items-center justify-center h-full text-white text-center px-4 animate-fade-in-up">

                <div x-data="typingEffect()" class="min-h-[60px] md:min-h-[72px] mb-4">
                    <h1 class="text-4xl md:text-6xl font-bold flex items-center justify-center">
                        {{-- <span x-text="displayText"></span><span class="typing-cursor"></span> --}}
                        SELAMAT DATANG
                    </h1>
                </div>

                <p class="text-lg md:text-xl max-w-3xl mb-6">Website Pemerintah Desa Kunden, Kecamatan Bulu, Kabupaten
                    Sukoharjo</p>

                <div class="max-w-3xl">
                    <p x-show="!showMore" class="transition-all">Desa Kunden terletak di Kecamatan Bulu, Sukoharjo,
                        Jawa Tengah. Kecamatan Bulu merupakan dataran tinggi, dengan topografi relatif miring yaitu 693
                        m di atas permukaan laut, dengan luas wilayah 43,96 km².</p>
                    <div x-show="showMore" style="display:none;" class="text-left space-y-3"
                        x-transition:enter="transition ease-out duration-500"
                        x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-screen"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 max-h-screen" x-transition:leave-end="opacity-0 max-h-0">
                        <p>Desa Kunden telah berdiri sejak tahun 1942 sebagai hasil pemekaran dari Desa Bulu, Kamal, dan
                            Puron. Desa ini berada pada koordinat -7°44′57″ LS dan 110°49′10″ BT. Secara administratif
                            terdiri dari tiga dusun dan delapan dukuh, dengan 20 RT dan 9 RW, serta jumlah penduduk
                            sebanyak 3.233 jiwa (1.618 pria, 1.615 wanita) dalam 973 kepala keluarga. Mayoritas beragama
                            Islam, dengan jumlah masjid/mushola sebanyak 22 unit.</p>
                        <p>Sebagian besar penduduk bekerja di sektor pertanian khususnya sawah yang dialiri oleh
                            jaringan irigasi dari Waduk Gajah Mungkur sejak 1990-an dengan UMKM aktif dalam pembuatan
                            kendang, peternakan ayam, penggemukan kambing, hingga produksi arang.</p>
                        <p>Secara ringkas, Desa Kunden adalah desa agraris dengan basis pertanian teririgasi, dukungan
                            UMKM yang beragam, infrastruktur pemerintahan dan pendidikan yang memadai, serta masyarakat
                            yang aktif dan harmonis menjadikannya salah satu desa berkembang di wilayah Kecamatan Bulu.
                        </p>
                    </div>
                    <button @click="showMore = !showMore"
                        class="mt-8 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full transition duration-300">
                        <span x-text="showMore ? 'Tutup' : 'Lihat Selengkapnya'"></span>
                    </button>
                </div>
            </div>
        </section>

        <!-- Information Cards -->
        <section id="info-cards" class="py-16 bg-white reveal-on-scroll">
            <div class="container mx-auto px-16">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <a href="{{ route('profil-wilayah') }}" class="block rounded-lg transition-shadow hover:shadow-lg">
                        <div class="flex items-start space-x-4 p-6 border border-gray-200 rounded-lg h-full">
                            <div class="bg-blue-100 text-blue-600 p-3 rounded-full flex-shrink-0"><i
                                    data-lucide="user-circle"></i></div>
                            <div>
                                <h3 class="font-bold text-lg mb-1">Profil Desa</h3>
                                <p class="text-gray-600 text-sm">Informasi mengenai profil, sejarah, dan kondisi
                                    pemerintahan.</p>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('data-jenis-kelamin') }}" class="block rounded-lg transition-shadow hover:shadow-lg">
                        <div class="flex items-start space-x-4 p-6 border border-gray-200 rounded-lg h-full">
                            <div class="bg-green-100 text-green-600 p-3 rounded-full flex-shrink-0"><i
                                    data-lucide="database"></i></div>
                            <div>
                                <h3 class="font-bold text-lg mb-1">Data Desa</h3>
                                <p class="text-gray-600 text-sm">Data jenis kelamin, pendidikan, kesehatan, keagamaan,
                                    dan ekonomi.</p>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('produk-hukum.index') }}" class="block rounded-lg transition-shadow hover:shadow-lg">
                        <div class="flex items-start space-x-4 p-6 border border-gray-200 rounded-lg h-full">
                            <div class="bg-yellow-100 text-yellow-600 p-3 rounded-full flex-shrink-0"><i
                                    data-lucide="gavel"></i></div>
                            <div>
                                <h3 class="font-bold text-lg mb-1">Regulasi</h3>
                                <p class="text-gray-600 text-sm">Produk Hukum dan Informasi Publik.</p>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('dokumen.index') }}" class="block rounded-lg transition-shadow hover:shadow-lg">
                        <div class="flex items-start space-x-4 p-6 border border-gray-200 rounded-lg h-full">
                            <div class="bg-purple-100 text-purple-600 p-3 rounded-full flex-shrink-0"><i
                                    data-lucide="file-text"></i></div>
                            <div>
                                <h3 class="font-bold text-lg mb-1">Dokumen Desa</h3>
                                <p class="text-gray-600 text-sm">Informasi dokumen resmi penyelenggaraan pemerintahan
                                    desa.</p>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('galeri.index') }}" class="block rounded-lg transition-shadow hover:shadow-lg">
                        <div class="flex items-start space-x-4 p-6 border border-gray-200 rounded-lg h-full">
                            <div class="bg-pink-100 text-pink-600 p-3 rounded-full flex-shrink-0"><i
                                    data-lucide="image"></i></div>
                            <div>
                                <h3 class="font-bold text-lg mb-1">Galeri</h3>
                                <p class="text-gray-600 text-sm">Koleksi foto dan video kegiatan serta keindahan Desa
                                    Kunden.</p>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('berita.index') }}" class="block rounded-lg transition-shadow hover:shadow-lg">
                        <div class="flex items-start space-x-4 p-6 border border-gray-200 rounded-lg h-full">
                            <div class="bg-indigo-100 text-indigo-600 p-3 rounded-full flex-shrink-0"><i
                                    data-lucide="newspaper"></i></div>
                            <div>
                                <h3 class="font-bold text-lg mb-1">Berita</h3>
                                <p class="text-gray-600 text-sm">Menyajikan informasi terbaru tentang peristiwa, berita
                                    terkini, dan artikel-artikel.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        @php
            use App\Models\Berita;
            $beritaPengumuman = Berita::where('jenis', 'Pengumuman Desa')->latest()->take(3)->get();
            $beritaPembangunan = Berita::where('jenis', 'Pembangunan Desa')->latest()->take(3)->get();
        @endphp

        <!-- Pengumuman & Progress Section -->
        <section class="py-16 bg-gray-50 reveal-on-scroll">
            <div class="container mx-auto px-16 grid grid-cols-1 md:grid-cols-2 gap-12">
                <div>
                    <h2 class="text-3xl font-bold mb-6 text-center md:text-left">Pengumuman Desa</h2>
                    <div class="space-y-4">
                        @forelse ($beritaPengumuman as $item)
                            <a href="{{ route('berita.detail', $item->id) }}" class="block h-full group">
                                <div class="bg-white p-4 rounded-lg shadow-sm flex items-center space-x-4">
                                    <div class="bg-blue-100 p-3 rounded-full text-blue-500">
                                        <i data-lucide="megaphone"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold">{{ $item->nama_berita }}</p>
                                        <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMMM Y') }}</span>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <p class="text-gray-500">Belum ada pengumuman desa.</p>
                        @endforelse
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-bold mb-6 text-center md:text-left">Progress Pembangunan Desa</h2>
                    <div class="space-y-4">
                        @forelse ($beritaPembangunan as $item)
                            <a href="{{ route('berita.detail', $item->id) }}" class="block h-full group">
                                <div class="bg-white p-4 rounded-lg shadow-sm flex items-center space-x-4">
                                    <div class="bg-blue-100 p-3 rounded-full text-blue-500">
                                        <i data-lucide="pickaxe"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold">{{ $item->nama_berita }}</p>
                                        <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMMM Y') }}</span>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <p class="text-gray-500">Belum ada progress pembangunan desa.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

        @php
            $beritaTerbaru = Berita::latest()->take(8)->get();
        @endphp


        <!-- Berita Section -->
        <section id="berita" class="py-16 bg-white reveal-on-scroll" x-data="slider()">
            <div class="container mx-auto px-6 lg:px-16">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-3xl font-bold text-center sm:text-left">Berita Desa</h2>
                    <div class="hidden sm:flex space-x-2">
                        <button @click="scroll('left')"
                            class="p-2 rounded-full bg-gray-200 hover:bg-gray-300 transition-colors disabled:opacity-50"
                            :disabled="atStart"><i data-lucide="arrow-left" class="w-5 h-5"></i></button>
                        <button @click="scroll('right')"
                            class="p-2 rounded-full bg-gray-200 hover:bg-gray-300 transition-colors disabled:opacity-50"
                            :disabled="atEnd"><i data-lucide="arrow-right" class="w-5 h-5"></i></button>
                    </div>
                </div>
                <div class="overflow-hidden">
                    <div x-ref="slider" @scroll.debounce.100ms="updateButtons()"
                        class="flex overflow-x-auto space-x-6 pb-4 slider-container snap-x snap-mandatory scroll-smooth">
                        @forelse ($beritaTerbaru as $berita)
                            <div class="flex-shrink-0 w-80 snap-start">
                                <a href="{{ route('berita.detail', $berita->id) }}" class="block h-full group">
                                    <div
                                        class="bg-white rounded-lg shadow-md overflow-hidden h-full flex flex-col hover:shadow-xl transition-shadow duration-300">
                                        <img src="{{ asset('public/storage/' . $berita->foto) }}" alt="{{ $berita->nama_berita }}"
                                            class="w-full h-40 object-cover">
                                        <div class="p-4 flex flex-col flex-grow">
                                            <h3 class="font-bold text-lg mb-2 text-gray-800 group-hover:text-blue-600 transition-colors line-clamp-2"
                                                title="{{ $berita->nama_berita }}">
                                                {{ \Illuminate\Support\Str::limit($berita->nama_berita, 50) }}
                                            </h3>
                                            <div class="text-xs font-semibold text-blue-600 mb-2 uppercase">
                                                {{ $berita->jenis }}
                                            </div>
                                            <p class="text-gray-600 text-sm mb-4 line-clamp-2 flex-grow">
                                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                                    {{ Str::limit(strip_tags($berita->deskripsi), 80) }}
                                                </p>
                                            </p>
                                            <div
                                                class="flex justify-between items-center text-xs text-gray-500 border-t pt-3 mt-auto">
                                                <div class="space-y-1">
                                                    <div class="flex items-center">
                                                        <i data-lucide="user-2" class="w-4 h-4 mr-1.5"></i>
                                                        <span>Administrator</span>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <i data-lucide="eye" class="w-4 h-4 mr-1.5"></i>
                                                        <span>Dilihat {{ $berita->views ?? 0 }} kali</span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="bg-blue-600 text-white text-center rounded-md px-2 py-1 shadow">
                                                    <span
                                                        class="font-bold text-lg leading-none">{{ \Carbon\Carbon::parse($berita->tanggal)->format('d') }}</span>
                                                    <span
                                                        class="block text-xs leading-none">{{ \Carbon\Carbon::parse($berita->tanggal)->isoFormat('MMM Y') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <p class="col-span-full text-center text-gray-500 py-8">Belum ada berita yang
                                dipublikasikan.</p>
                        @endforelse
                    </div>
                </div>
                <div class="text-center mt-8">
                    <a href="{{ route('berita.index') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full transition duration-300">
                        Lihat Semua Berita
                    </a>
                </div>
            </div>
        </section>

        <!-- Galeri Section -->
        @php
            use App\Models\Galeri;
            $galeriTerbaru = Galeri::latest()->take(4)->get();
        @endphp
        <section id="galeri" class="py-16 bg-gray-50">
            <div class="container mx-auto px-6 lg:px-16">
                <h2 class="text-3xl font-bold mb-8 text-center">Galeri Desa</h2>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @forelse ($galeriTerbaru as $item)
                        <div class="group relative block w-full rounded-lg shadow-md overflow-hidden aspect-square">
                            <img src="{{ asset('public/storage/' . $item->gambar) }}"
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                alt="{{ $item->judul }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 w-full p-3">
                                <h3 class="text-white font-semibold text-lg truncate" title="{{ $item->judul }}">
                                    {{ $item->judul }}
                                </h3>
                            </div>
                        </div>
                    @empty
                        <p class="col-span-full text-center text-gray-500 py-8">Belum ada foto galeri tersedia.</p>
                    @endforelse
                </div>

                <div class="text-center mt-8">
                    <a href="{{ route('galeri.index') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-full transition duration-300 inline-block">
                        Lihat Semua Galeri
                    </a>
                </div>
            </div>
        </section>

        @php
            use App\Models\Aparatur;
            $aparaturs = Aparatur::all();
        @endphp
        <!-- Aparatur Desa Section -->
        <section id="aparatur" class="py-16 bg-white reveal-on-scroll" x-data="slider()">
            <div class="container mx-auto px-16">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-3xl font-bold text-center sm:text-left">Aparatur Desa</h2>
                    <div class="hidden sm:flex space-x-2">
                        <button @click="scroll('left')"
                            class="p-2 rounded-full bg-gray-200 hover:bg-gray-300 transition-colors disabled:opacity-50"
                            :disabled="atStart"><i data-lucide="arrow-left" class="w-5 h-5"></i></button>
                        <button @click="scroll('right')"
                            class="p-2 rounded-full bg-gray-200 hover:bg-gray-300 transition-colors disabled:opacity-50"
                            :disabled="atEnd"><i data-lucide="arrow-right" class="w-5 h-5"></i></button>
                    </div>
                </div>
                <div class="overflow-hidden">
                    <div x-ref="slider" @scroll.debounce.100ms="updateButtons()"
                        class="flex overflow-x-auto gap-6 pb-4 slider-container snap-x snap-mandatory scroll-smooth">
                        @forelse ($aparaturs as $aparatur)
                            <div class="flex-shrink-0 w-52 snap-start">
                                <div
                                    class="bg-gray-50 rounded-lg shadow-md overflow-hidden h-full group transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-xl">
                                    <img src="{{ asset('public/storage/' . $aparatur->foto) }}" alt="{{ $aparatur->nama }}"
                                        class="w-full h-56 object-cover object-center">
                                    <div class="p-3 text-center">
                                        <h4 class="font-bold text-md">{{ $aparatur->nama }}</h4>
                                        <p class="text-gray-500 text-xs">{{ $aparatur->jabatan }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500">Belum ada data aparatur desa.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    @include('layouts.partials.footer')

    <!-- AlpineJS & Custom Scripts -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();

            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in-up');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);
            const targets = document.querySelectorAll('.reveal-on-scroll');
            targets.forEach(target => {
                observer.observe(target);
            });
        });

        // FUNGSI EFEK KETIK YANG DIPERBARUI
        function typingEffect() {
            return {
                texts: [
                    "Selamat Datang",
                    "Di Website Desa Kunden",
                    "Menuju Desa Maju"
                ],
                textIndex: 0,
                charIndex: 0,
                displayText: '',
                isDeleting: false,
                type() {
                    const currentText = this.texts[this.textIndex];
                    let speed = 120;

                    if (this.isDeleting) {
                        speed = 60;
                        this.displayText = currentText.substring(0, this.charIndex - 1);
                        this.charIndex--;
                    } else {
                        this.displayText = currentText.substring(0, this.charIndex + 1);
                        this.charIndex++;
                    }

                    if (!this.isDeleting && this.charIndex === currentText.length) {
                        speed = 1800;
                        this.isDeleting = true;
                    } else if (this.isDeleting && this.charIndex === 0) {
                        this.isDeleting = false;
                        this.textIndex = (this.textIndex + 1) % this.texts.length;
                        speed = 500;
                    }

                    setTimeout(() => this.type(), speed);
                },
                init() {
                    this.type();
                }
            }
        }

        function slider() {
            return {
                atStart: true,
                atEnd: false,
                init() {
                    this.$nextTick(() => {
                        this.updateButtons();
                    });
                },
                scroll(direction) {
                    const container = this.$refs.slider;
                    const scrollAmount = container.clientWidth * 0.75;
                    if (direction === 'left') {
                        container.scrollLeft -= scrollAmount;
                    } else {
                        container.scrollLeft += scrollAmount;
                    }
                },
                updateButtons() {
                    const container = this.$refs.slider;
                    this.atStart = container.scrollLeft <= 10;
                    this.atEnd = container.scrollLeft + container.clientWidth >= container.scrollWidth - 10;
                }
            }
        }
    </script>
</body>

</html>
