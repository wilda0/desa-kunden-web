<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sejarah Desa - Website Desa Kunden</title>

    <link rel="icon" type="image/png" href="/images/logo-kunden.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/quillInit.js'])

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
    </style>
</head>

<body class="  bg-gray-50 font-sans text-gray-800">

    <!-- Header & Navbar -->
    @include('layouts.partials.header')

    <main>
        <div class="  bg-gray-50">

            {{-- Bagian Judul dan Breadcrumb --}}
            <section class="bg-slate-800 relative text-white text-center py-20 sm:py-28">
                <div class="absolute inset-0 bg-cover bg-center"
                    style="background-image: url('/images/lahan-kunyit.png');">
                </div>
                <div class="absolute inset-0 bg-[rgba(0,0,0,0.25)]/60"></div>
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
                                    <span class="ml-2 text-sm font-medium text-gray-300">Sejarah Desa</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="mt-4 text-4xl md:text-6xl font-bold">
                        Sejarah Desa Kunden
                    </h1>
                    <p class="mt-4 text-lg md:text-xl text-gray-200 max-w-3xl mx-auto">
                        Jejak Langkah dan Perkembangan Desa dari Masa ke Masa.
                    </p>
                </div>
            </section>

            <div class="container mx-auto px-6 lg:px-16 py-14 sm:py-14 space-y-14">
                <!-- Asal Usul Desa Section -->
                <section class="reveal-on-scroll grid grid-cols-1 lg:grid-cols-5 gap-12 lg:gap-16 items-center">
                    <div class="lg:col-span-3">
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900 mb-4">Asal Mula Desa Kunden</h2>
                        <div class="prose prose-lg max-w-none text-gray-700 space-y-4">
                            <p>Desa Kunden secara administratif termasuk dalam wilayah Kecamatan Bulu, Kabupaten
                                Sukoharjo. Berdasarkan penuturan dari sesepuh masyarakat secara turun temurun, Desa
                                Kunden merupakan desa yang berdiri paling akhir di kecamatan ini.
                            </p>
                            <p>Wilayah Desa Kunden saat ini merupakan hasil pemekaran wilayah dari 3 desa. Dukuh Loji di
                                sebelah timur merupakan bagian dari Desa Bulu. Dukuh Sumberagung, Kepuh, dan Sambirejo
                                adalah bagian dari Desa Kamal. Sementara Dukuh Ngrancang, Kunden, dan Sumberejo
                                merupakan bagian dari Desa Puron. Setelah adanya pemekaran, beberapa wilayah dukuh
                                tersebut digabungkan menjadi satu wilayah yang kemudian dikenal sebagai Desa Kunden
                                sejak tahun 1941 hingga sekarang.
                            </p>
                            <p>
                                Sejak saat itu, Desa Kunden berkembang menjadi komunitas yang mandiri, dengan struktur
                                sosial dan pemerintahan sendiri. Meskipun merupakan desa yang terbentuk paling akhir di
                                kecamatan ini, Desa Kunden memiliki potensi sumber daya manusia dan kekayaan budaya
                                lokal yang turut berkontribusi dalam pembangunan wilayah Kecamatan Bulu secara
                                keseluruhan.
                            </p>
                        </div>
                    </div>
                    <div class="lg:col-span-2">
                        <div class="rounded-lg shadow-2xl overflow-hidden border-4 border-white">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15822.46337227495!2d110.8066556447879!3d-7.777491703666323!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a331a9805902b%3A0x28923a1bec4f64d!2sKunden%2C%20Bulu%2C%20Sukoharjo%20Regency%2C%20Central%20Java!5e0!3m2!1sen!2sid!4v1751193630424!5m2!1sen!2sid"
                                width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </section>

                <!-- Sejarah Kepemimpinan Section -->
                <section class="reveal-on-scroll">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900">Jejak Kepemimpinan Desa Kunden</h2>
                        <p class="mt-2 text-lg text-gray-600">Para pemimpin yang telah mengabdi dan membangun Desa
                            Kunden.</p>
                    </div>

                    <div class="max-w-6xl mx-auto">
                        <div class="flex flex-col">
                            <div class="overflow-x-auto">
                                <div class="align-middle inline-block min-w-full">
                                    <div class="shadow-2xl overflow-hidden border-b border-gray-200 sm:rounded-2xl">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-slate-700">
                                                <tr>
                                                    <th scope="col"
                                                        class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                                        No</th>
                                                    <th scope="col"
                                                        class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                                        Nama Pimpinan</th>
                                                    <th scope="col"
                                                        class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                                        Periode Jabatan</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <tr class="hover:bg-blue-50 transition-colors duration-200">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1.
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        Marmo Sudarmo</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1946 -
                                                        1953</td>
                                                </tr>
                                                <tr class="  bg-gray-50 hover:bg-blue-50 transition-colors duration-200">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2.
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        Pawiro Sumanto</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1953 -
                                                        1973</td>
                                                </tr>
                                                <tr class="hover:bg-blue-50 transition-colors duration-200">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3.
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        Soekidi Siswo Miharjo</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1973 -
                                                        1988</td>
                                                </tr>
                                                <tr class="  bg-gray-50 hover:bg-blue-50 transition-colors duration-200">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">4.
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        Purno, B. Sc.</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1988 -
                                                        2006</td>
                                                </tr>
                                                <tr class="hover:bg-blue-50 transition-colors duration-200">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5.
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        Lagiyo</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2006
                                                        - 2018</td>
                                                </tr>
                                                <tr class="  bg-gray-50 hover:bg-blue-50 transition-colors duration-200">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">6.
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        Purno, B. Sc.</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2018
                                                        - Sekarang</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
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
