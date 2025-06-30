<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kondisi Pemerintahan - Website Desa Kunden</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo-kunden.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Custom CSS -->
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

        /* Animasi */
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

        .reveal-on-scroll {
            opacity: 0;
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .delay-200 {
            animation-delay: 200ms;
        }

        .delay-400 {
            animation-delay: 400ms;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans text-gray-800">

    <!-- Header & Navbar -->
    @include('layouts.partials.header')

    <main>
        <div class="bg-gray-50">

            {{-- Bagian Judul dan Breadcrumb --}}
            <section class="bg-slate-800 relative text-white text-center py-20 sm:py-28">
                <div class="absolute inset-0 bg-cover bg-center"
                    style="background-image: url('{{ asset('images/lahan-kunyit.png') }}');">
                </div>
                <div class="absolute inset-0 bg-black/60"></div>
                <div class="relative z-10 container mx-auto px-4">
                    <nav class="flex justify-center" aria-label="Breadcrumb">
                        <ol role="list" class="flex items-center space-x-2">
                            <li>
                                <a href="{{ route('welcome') }}" class="text-gray-300 hover:text-white">
                                    <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="sr-only">Home</span>
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-2 text-sm font-medium text-gray-300">Profil Desa</span>
                                </div>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-2 text-sm font-medium text-gray-300">Kondisi Pemerintahan</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="mt-4 text-4xl md:text-6xl font-bold">
                        Kondisi Pemerintahan
                    </h1>
                    <p class="mt-4 text-lg md:text-xl text-gray-200 max-w-3xl mx-auto">
                        Struktur Organisasi, Kelembagaan, dan Aparatur Desa Kunden.
                    </p>
                </div>
            </section>

            <div class="container mx-auto px-6 lg:px-16 py-16 sm:py-24 space-y-24">

                <!-- Struktur Organisasi -->
                <section class="reveal-on-scroll">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900">Struktur Organisasi</h2>
                        <p class="mt-2 text-lg text-gray-600">Bagan Struktur Organisasi Pemerintahan Desa Kunden.</p>
                    </div>
                    <div class="max-w-5xl mx-auto bg-white p-4 sm:p-6 rounded-2xl shadow-2xl border">
                        <img src="{{ asset('images/struktur-organisasi.png') }}" alt="Struktur Organisasi Desa Kunden"
                            class="w-full h-auto rounded-lg">
                    </div>
                </section>

                <!-- Pembagian Wilayah -->
                <section class="reveal-on-scroll">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900">Pembagian Wilayah</h2>
                        <p class="mt-2 text-lg text-gray-600">Wilayah administratif Desa Kunden terbagi menjadi beberapa
                            dusun.</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                        <div
                            class="bg-white p-6 rounded-xl shadow-lg text-center hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                            <div
                                class="mx-auto bg-blue-100 text-blue-600 w-16 h-16 rounded-full flex items-center justify-center mb-4">
                                <i data-lucide="map-pin" class="w-8 h-8"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Dusun 01 Sumberagung</h3>
                            <p class="text-2xl font-semibold text-blue-600 mt-2">6 RT</p>
                        </div>
                        <div
                            class="bg-white p-6 rounded-xl shadow-lg text-center hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                            <div
                                class="mx-auto bg-green-100 text-green-600 w-16 h-16 rounded-full flex items-center justify-center mb-4">
                                <i data-lucide="map-pin" class="w-8 h-8"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Dusun 02 Sumberejo</h3>
                            <p class="text-2xl font-semibold text-green-600 mt-2">8 RT</p>
                        </div>
                        <div
                            class="bg-white p-6 rounded-xl shadow-lg text-center hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                            <div
                                class="mx-auto bg-yellow-100 text-yellow-600 w-16 h-16 rounded-full flex items-center justify-center mb-4">
                                <i data-lucide="map-pin" class="w-8 h-8"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Dusun 03 Ngrancang</h3>
                            <p class="text-2xl font-semibold text-yellow-600 mt-2">6 RT</p>
                        </div>
                    </div>
                </section>

                <!-- Kelembagaan Desa -->
                <section class="reveal-on-scroll">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900">Kelembagaan Desa</h2>
                        <p class="mt-2 text-lg text-gray-600">Lembaga Pemerintahan dan Kemasyarakatan yang aktif di Desa
                            Kunden.</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <!-- Lembaga Pemerintahan -->
                        <div>
                            <h3 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center gap-3"><i
                                    data-lucide="landmark" class="w-7 h-7 text-blue-600"></i> Lembaga Pemerintahan</h3>
                            <ul class="space-y-4">
                                <li class="bg-white p-4 rounded-lg shadow-md flex justify-between items-center">
                                    <span class="text-gray-700">Kepala Desa</span>
                                    <span class="font-bold bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">1
                                        Orang</span>
                                </li>
                                <li class="bg-white p-4 rounded-lg shadow-md flex justify-between items-center">
                                    <span class="text-gray-700">Sekretaris Desa</span>
                                    <span class="font-bold bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">1
                                        Orang</span>
                                </li>
                                <li class="bg-white p-4 rounded-lg shadow-md flex justify-between items-center">
                                    <span class="text-gray-700">Perangkat Desa</span>
                                    <span class="font-bold bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">9
                                        Orang</span>
                                </li>
                                <li class="bg-white p-4 rounded-lg shadow-md flex justify-between items-center">
                                    <span class="text-gray-700">BPD</span>
                                    <span class="font-bold bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">9
                                        Orang</span>
                                </li>
                            </ul>
                        </div>
                        <!-- Lembaga Kemasyarakatan -->
                        <div>
                            <h3 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center gap-3"><i
                                    data-lucide="users" class="w-7 h-7 text-green-600"></i> Lembaga Kemasyarakatan
                            </h3>
                            <ul class="space-y-4">
                                <li class="bg-white p-4 rounded-lg shadow-md flex justify-between items-center">
                                    <span class="text-gray-700">LPMD</span>
                                    <span
                                        class="font-bold bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">1
                                        Lembaga</span>
                                </li>
                                <li class="bg-white p-4 rounded-lg shadow-md flex justify-between items-center">
                                    <span class="text-gray-700">PKK</span>
                                    <span
                                        class="font-bold bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">1
                                        Lembaga</span>
                                </li>
                                <li class="bg-white p-4 rounded-lg shadow-md flex justify-between items-center">
                                    <span class="text-gray-700">Posyandu</span>
                                    <span
                                        class="font-bold bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">9
                                        Lembaga</span>
                                </li>
                                <li class="bg-white p-4 rounded-lg shadow-md flex justify-between items-center">
                                    <span class="text-gray-700">Kelompok Tani</span>
                                    <span
                                        class="font-bold bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">4
                                        Kelompok</span>
                                </li>
                                <li class="bg-white p-4 rounded-lg shadow-md flex justify-between items-center">
                                    <span class="text-gray-700">Karang Taruna</span>
                                    <span
                                        class="font-bold bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">1
                                        Kelompok</span>
                                </li>
                                <!-- Tambahkan lembaga lainnya jika perlu -->
                            </ul>
                        </div>
                    </div>
                </section>

                <!-- Aparatur & BPD -->
                <section class="reveal-on-scroll">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <!-- Aparat Desa -->
                        <div>
                            <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-6">Aparat Pemerintah Desa
                            </h2>
                            <div class="bg-white p-6 rounded-xl shadow-lg space-y-4">
                                <div class="border-b pb-2">
                                    <p class="text-sm text-gray-500">Kepala Desa</p>
                                    <p class="font-semibold text-gray-800">PURNO, B. Sc.</p>
                                </div>
                                <div class="border-b pb-2">
                                    <p class="text-sm text-gray-500">Sekretaris Desa</p>
                                    <p class="font-semibold text-gray-800">UNGGUL SANTOSA WIBOWO, S.Pd.,Gr.</p>
                                </div>
                                <div class="border-b pb-2">
                                    <p class="text-sm text-gray-500">Kepala Seksi Pemerintahan</p>
                                    <p class="font-semibold text-gray-800">BAMBANG TRIJOKO</p>
                                </div>
                                <div class="border-b pb-2">
                                    <p class="text-sm text-gray-500">Kepala Seksi Kesejahteraan</p>
                                    <p class="font-semibold text-gray-800">SUNARDI</p>
                                </div>
                                <div class="border-b pb-2">
                                    <p class="text-sm text-gray-500">Kepala Seksi Pelayanan</p>
                                    <p class="font-semibold text-gray-800">JOKO YUNANTO</p>
                                </div>
                                <div class="border-b pb-2">
                                    <p class="text-sm text-gray-500">Kaur Umum</p>
                                    <p class="font-semibold text-gray-800">TULUS JATI WALUYO</p>
                                </div>
                                <div class="border-b pb-2">
                                    <p class="text-sm text-gray-500">Kaur Keuangan</p>
                                    <p class="font-semibold text-gray-800">EKO SUPRIYANTO</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Kaur Perencanaan</p>
                                    <p class="font-semibold text-gray-800">PARJAN</p>
                                </div>
                            </div>
                        </div>

                        <!-- BPD -->
                        <div>
                            <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-6">Badan Permusyawaratan Desa
                                (BPD)</h2>
                            <div class="bg-white p-6 rounded-xl shadow-lg space-y-4">
                                <div class="border-b pb-2">
                                    <p class="text-sm text-gray-500">Ketua</p>
                                    <p class="font-semibold text-gray-800">Drs. Sumarno</p>
                                </div>
                                <div class="border-b pb-2">
                                    <p class="text-sm text-gray-500">Wakil Ketua</p>
                                    <p class="font-semibold text-gray-800">Sru Sarani</p>
                                </div>
                                <div class="border-b pb-2">
                                    <p class="text-sm text-gray-500">Sekretaris</p>
                                    <p class="font-semibold text-gray-800">Eni Setyawati, S.Pd.</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Anggota</p>
                                    <ul class="list-disc list-inside mt-1 space-y-1">
                                        <li class="font-semibold text-gray-800">Devi Rityaningrum, S.Pd.</li>
                                        <li class="font-semibold text-gray-800">Sriyanto</li>
                                        <li class="font-semibold text-gray-800">Sagiyo</li>
                                        <li class="font-semibold text-gray-800">Parno</li>
                                        <li class="font-semibold text-gray-800">Novi Setianto</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('layouts.partials.footer')

    <!-- AlpineJS for interactivity -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Skrip untuk animasi saat scroll -->
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
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
    </script>

</body>

</html>
