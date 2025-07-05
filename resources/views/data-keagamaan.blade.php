<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Keagamaan - Website Desa Kunden</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo-kunden.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

<body class="bg-gray-50 font-sans text-gray-800">

    @include('layouts.partials.header')

    @php
        use App\Models\DataKeagamaan;

        $data = DataKeagamaan::latest()->first() ?? (object)[
            'islam' => 0,
            'katolik' => 0,
            'kristen' => 0,
            'hindu' => 0,
            'budha' => 0,
            'kepercayaan' => 0,
            'masjid' => 0,
            'gereja' => 0,
            'pura' => 0,
            'vihara' => 0,
        ];
    @endphp

    <main>
        <div class="bg-gray-50">

            {{-- Bagian Judul dan Breadcrumb --}}
            <section class="bg-slate-800 relative text-white text-center py-20 sm:py-28">
                <div class="absolute inset-0 bg-cover bg-center"
                    style="background-image: url('{{ asset('images/lahan-kunyit.png') }}');"></div>
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
                                    <span class="ml-2 text-sm font-medium text-gray-300">Data Desa</span>
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
                                    <span class="ml-2 text-sm font-medium text-gray-300">Data Keagamaan</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="mt-4 text-4xl md:text-6xl font-bold">
                        Data Keagamaan Desa Kunden
                    </h1>
                    <p class="mt-4 text-lg md:text-xl text-gray-200 max-w-3xl mx-auto">
                        Distribusi pemeluk agama dan sarana peribadatan di Desa Kunden.
                    </p>
                </div>
            </section>

            <div class="container mx-auto px-6 lg:px-16 py-14 sm:py-14 space-y-14">

                <!-- Jumlah Pemeluk Agama -->
                <section class="reveal-on-scroll">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900">Jumlah Pemeluk Agama</h2>
                        <p class="mt-2 text-lg text-gray-600">Komposisi penduduk Desa Kunden berdasarkan agama yang
                            dianut.</p>
                    </div>
                    <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-xl border border-gray-100">
                        <div class="overflow-x-auto mb-8">
                            <table class="min-w-full text-sm">
                                <thead class="border-b-2 border-gray-200">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-600">Agama
                                        </th>
                                        <th scope="col" class="px-4 py-3 text-right font-semibold text-gray-600">
                                            Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <tr>
                                        <td class="px-4 py-3 text-gray-700">Islam</td>
                                        <td class="px-4 py-3 text-gray-800 text-right font-medium">{{ number_format($data->islam) }} Orang</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 text-gray-700">Katolik</td>
                                        <td class="px-4 py-3 text-gray-800 text-right font-medium">{{ number_format($data->katolik) }} Orang</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 text-gray-700">Kristen</td>
                                        <td class="px-4 py-3 text-gray-800 text-right font-medium">{{ number_format($data->kristen) }} Orang</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 text-gray-700">Hindu</td>
                                        <td class="px-4 py-3 text-gray-800 text-right font-medium">{{ number_format($data->hindu) }} Orang</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 text-gray-700">Budha</td>
                                        <td class="px-4 py-3 text-gray-800 text-right font-medium">{{ number_format($data->budha) }} Orang</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 text-gray-700">Aliran Kepercayaan Lainnya</td>
                                        <td class="px-4 py-3 text-gray-800 text-right font-medium">{{ number_format($data->kepercayaan) }} Orang</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="w-full h-96">
                            <canvas id="agamaChart"></canvas>
                        </div>
                    </div>
                </section>

                <!-- Sarana Peribadatan -->
                <section class="reveal-on-scroll">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900">Sarana Peribadatan</h2>
                        <p class="mt-2 text-lg text-gray-600">Fasilitas tempat ibadah yang tersedia di Desa Kunden.</p>
                    </div>
                    <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <div
                            class="bg-white p-6 rounded-xl shadow-lg border hover:border-green-500 hover:shadow-xl transition-all duration-300 text-center">
                            <div
                                class="mx-auto bg-green-100 text-green-600 w-20 h-20 rounded-full flex items-center justify-center mb-4">
                                <i data-lucide="moon" class="w-10 h-10"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Masjid / Musholla</h3>
                            <p class="text-3xl font-extrabold text-green-600 mt-2">{{ number_format($data->masjid) }}</p>
                            <p class="text-sm text-gray-500">Buah</p>
                        </div>
                        <div
                            class="bg-white p-6 rounded-xl shadow-lg border hover:border-blue-500 hover:shadow-xl transition-all duration-300 text-center">
                            <div
                                class="mx-auto bg-blue-100 text-blue-600 w-20 h-20 rounded-full flex items-center justify-center mb-4">
                                <i data-lucide="church" class="w-10 h-10"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Gereja</h3>
                            <p class="text-3xl font-extrabold text-blue-600 mt-2">{{ number_format($data->gereja) }}</p>
                            <p class="text-sm text-gray-500">Buah</p>
                        </div>
                        <div
                            class="bg-white p-6 rounded-xl shadow-lg border hover:border-red-500 hover:shadow-xl transition-all duration-300 text-center">
                            <div
                                class="mx-auto bg-red-100 text-red-600 w-20 h-20 rounded-full flex items-center justify-center mb-4">
                                <i data-lucide="castle" class="w-10 h-10"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Pura</h3>
                            <p class="text-3xl font-extrabold text-red-600 mt-2">{{ number_format($data->pura) }}</p>
                            <p class="text-sm text-gray-500">Buah</p>
                        </div>
                        <div
                            class="bg-white p-6 rounded-xl shadow-lg border hover:border-purple-500 hover:shadow-xl transition-all duration-300 text-center">
                            <div
                                class="mx-auto bg-purple-100 text-purple-600 w-20 h-20 rounded-full flex items-center justify-center mb-4">
                                <i data-lucide="tent" class="w-10 h-10"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Vihara</h3>
                            <p class="text-3xl font-extrabold text-purple-600 mt-2">{{ number_format($data->vihara) }}</p>
                            <p class="text-sm text-gray-500">Buah</p>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </main>

    @include('layouts.partials.footer')

    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            lucide.createIcons();

            // --- Chart Pemeluk Agama ---
            const agamaCtx = document.getElementById('agamaChart').getContext('2d');
            new Chart(agamaCtx, {
                type: 'bar',
                data: {
                    labels: ['Islam', 'Katolik', 'Kristen', 'Hindu', 'Budha', 'Lainnya'],
                    datasets: [{
                        label: 'Jumlah Pemeluk',
                        data: [
                            @json($data->islam),
                            @json($data->katolik),
                            @json($data->kristen),
                            @json($data->hindu),
                            @json($data->budha),
                            @json($data->kepercayaan)
                        ],
                        backgroundColor: [
                            'rgba(16, 185, 129, 0.7)',
                            'rgba(168, 85, 247, 0.7)',
                            'rgba(59, 130, 246, 0.7)',
                            'rgba(249, 115, 22, 0.7)',
                            'rgba(234, 179, 8, 0.7)',
                            'rgba(107, 114, 128, 0.7)'
                        ],
                        borderColor: [
                            'rgba(16, 185, 129, 1)',
                            'rgba(168, 85, 247, 1)',
                            'rgba(59, 130, 246, 1)',
                            'rgba(249, 115, 22, 1)',
                            'rgba(234, 179, 8, 1)',
                            'rgba(107, 114, 128, 1)'
                        ],
                        borderWidth: 1,
                        borderRadius: 5,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#e5e7eb'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: (c) => `Jumlah: ${c.raw.toLocaleString('id-ID')} Orang`
                            }
                        }
                    }
                }
            });

            // --- Intersection Observer ---
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
