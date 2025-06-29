<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Wilayah Desa - Website Desa Kunden</title>

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

        /* Navbar underline animation */
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
            background-color: #3B82F6; /* blue-600 */
            transform: scaleX(0);
            transform-origin: bottom right;
            transition: transform 0.3s ease-out;
        }

        .nav-link:hover::after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }

        /* Animasi untuk konten halaman ini */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 1s ease-out forwards;
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        .delay-200 { animation-delay: 200ms; }
        .delay-400 { animation-delay: 400ms; }
        .delay-600 { animation-delay: 600ms; }

        /* Style untuk elemen sebelum animasi berjalan */
        .reveal-on-scroll {
            opacity: 0;
            transition: opacity 0.5s ease-out;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans text-gray-800">

    <!-- Header & Navbar -->
    @include('layouts.partials.header')

    <main>
        <div class="bg-gray-50">

            <section class="bg-slate-800 relative text-white text-center py-20 sm:py-28">
                <div class="absolute inset-0 bg-cover bg-center"
                    style="background-image: url('{{ asset('images/lahan-kunyit.png') }}');">
                </div>
                <div class="absolute inset-0 bg-black/50"></div>
                <div class="relative z-10 container mx-auto px-4">
                    <nav class="flex justify-center" aria-label="Breadcrumb">
                        <ol role="list" class="flex items-center space-x-2">
                            <li>
                                <div>
                                    <a href="{{ route('welcome') }}" class="text-gray-300 hover:text-white">
                                        <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z" clip-rule="evenodd" /></svg>
                                        <span class="sr-only">Home</span>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" /></svg>
                                    <span class="ml-2 text-sm font-medium text-gray-300">Profil Desa</span>
                                </div>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" /></svg>
                                    <span class="ml-2 text-sm font-medium text-gray-300">Profil Wilayah Desa</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="mt-4 text-4xl md:text-6xl font-bold">
                        Profil Wilayah Desa Kunden
                    </h1>
                    <p class="mt-4 text-lg md:text-xl text-gray-200 max-w-3xl mx-auto">
                        Kondisi geografis, demografis, dan administratif wilayah Desa Kunden.
                    </p>
                </div>
            </section>

            <div class="container mx-auto px-6 lg:px-16 py-16 sm:py-24">

                {{-- 2. Bagian Peta dan Deskripsi --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-start">

                    {{-- Kolom Kiri: Peta --}}
                    <div class="reveal-on-scroll">
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900 mb-4">Peta Wilayah Desa</h2>
                        <div class="aspect-w-16 aspect-h-9 rounded-lg shadow-2xl overflow-hidden border-4 border-white">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15822.46337227495!2d110.8066556447879!3d-7.777491703666323!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a331a9805902b%3A0x28923a1bec4f64d!2sKunden%2C%20Bulu%2C%20Sukoharjo%20Regency%2C%20Central%20Java!5e0!3m2!1sen!2sid!4v1751193630424!5m2!1sen!2sid"
                                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>

                    {{-- Kolom Kanan: Deskripsi --}}
                    <div class="reveal-on-scroll delay-200">
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900 mb-4">Kondisi Geografis &
                            Administratif</h2>
                        <div class="text-gray-700 space-y-4 leading-relaxed">
                             <p>
                                Desa Kunden secara administratif termasuk dalam wilayah Kecamatan Bulu Kabupaten
                                Sukoharjo. Berdasarkan penuturan dari sesepuh masyarakat secara turun temurun mengatakan
                                bahwa desa Kunden merupakan desa yang berdiri paling akhir di kecamatan Bulu. Wilayah
                                desa kunden saat ini merupakan pemekaran wilayah dari 3 desa. Dukuh Loji di sebelah
                                timur merupakan bagian dari desa Bulu. Dukuh Sumberagung, dukuh Kepuh dan Dukuh
                                Sambirejo merupakan bagian dari desa Kamal. Dukuh Ngrancang, dukuh Kunden dan dukuh
                                Sumberejo merupakan bagian dari Desa Puron. Setelah adanya pemekaran, beberapa wilayah
                                dukuh yang disebutkan di atas menjadi satu wilayah yang kemudian dikenal sebagai desa
                                Kunden sejak tahun 1941 sampai dengan sekarang.
                            </p>
                            <p>
                                Wilayah Desa Kunden terbagi menjadi 3 dusun dan 8 dukuh. Struktur
                                pemerintahan desa didukung oleh 20 Rukun Tetangga (RT) dan 9 Rukun Warga (RW) yang aktif
                                berperan dalam menjaga keharmonisan dan ketertiban masyarakat.
                            </p>
                            <p class="font-semibold text-gray-800">
                                Batas wilayah Desa Kunden adalah sebagai berikut:
                            </p>
                            <ul class="list-disc list-inside space-y-2 pl-4 text-gray-600">
                                <li><strong>Sebelah Utara:</strong> Desa Kamal</li>
                                <li><strong>Sebelah Timur:</strong> Desa Bulu</li>
                                <li><strong>Sebelah Selatan:</strong> Kabupaten Wonogiri</li>
                                <li><strong>Sebelah Barat:</strong> Desa Puron</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- 3. Bagian Tabel Pimpinan Desa --}}
                <div class="mt-20 sm:mt-28 reveal-on-scroll delay-400">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 text-center mb-8">Sejarah Kepemimpinan
                        Desa Kunden</h2>
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow-lg overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-slate-700 text-white">
                                            <tr>
                                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">No</th>
                                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Nama Pimpinan</th>
                                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Periode Jabatan</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1.</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Marmo Sudarmo</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1946 - 1953</td>
                                            </tr>
                                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2.</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Pawiro Sumanto</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1953 - 1973</td>
                                            </tr>
                                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3.</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Soekidi Siswo Miharjo</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1973 - 1988</td>
                                            </tr>
                                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">4.</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Purno, B. Sc.</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1988 - 2006</td>
                                            </tr>
                                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5.</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Lagiyo</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2006 - 2018</td>
                                            </tr>
                                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">6.</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Purno, B. Sc.</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2018 - Sekarang</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

            // Pengaturan untuk Intersection Observer
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };

            // Membuat observer baru
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
