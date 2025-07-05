<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Pendidikan - Website Desa Kunden</title>

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
        use App\Models\DataPendidikan;

        $data = DataPendidikan::latest()->first() ?? (object)[
            'sd_mi' => 0,
            'sltp_mts' => 0,
            'slta_ma' => 0,
            's1_diploma' => 0,
            'putus_sekolah' => 0,
            'buta_huruf' => 0,
            'gedung_tk_paud' => 0,
            'gedung_sd_mi' => 0,
            'gedung_sltp_mts' => 0,
        ];
    @endphp

    <main>
        <div class="bg-gray-50">

            {{-- Bagian Judul dan Breadcrumb --}}
            <section class="bg-slate-800 relative text-white text-center py-20 sm:py-28">
                <div class="absolute inset-0 bg-cover bg-center"
                    style="background-image: url('/public/images/lahan-kunyit.png');"></div>
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
                                    <span class="ml-2 text-sm font-medium text-gray-300">Data Pendidikan</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="mt-4 text-4xl md:text-6xl font-bold">
                        Data Pendidikan Desa Kunden
                    </h1>
                    <p class="mt-4 text-lg md:text-xl text-gray-200 max-w-3xl mx-auto">
                        Statistik tingkat pendidikan dan lembaga pendidikan yang ada di Desa Kunden.
                    </p>
                </div>
            </section>

            <div class="container mx-auto px-6 lg:px-16 py-14 sm:py-14 space-y-14">

                <!-- Grafik dan Tabel Pendidikan -->
                <section class="reveal-on-scroll">
                    <div class="text-center mb-4">
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900">Grafik Tingkat Pendidikan</h2>
                        <p class="mt-2 text-lg text-gray-600">Distribusi tingkat pendidikan terakhir yang ditamatkan
                            oleh penduduk.</p>
                    </div>
                    <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-xl border border-gray-100">
                        <div class="w-full h-96">
                            <canvas id="pendidikanChart"></canvas>
                        </div>
                    </div>
                </section>

                <!-- Tabel Rincian Pendidikan -->
                <section class="reveal-on-scroll">
                    <div class="text-center mb-4">
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900">Tabel Rincian Pendidikan</h2>
                    </div>
                    <div class="max-w-4xl mx-auto">
                        <div class="shadow-2xl overflow-hidden border border-gray-200 sm:rounded-2xl">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-slate-700">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                            Tingkat Pendidikan</th>
                                        <th scope="col"
                                            class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">
                                            Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">SD /
                                            MI</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-semibold text-center">
                                            {{ number_format($data->sd_mi) }} Orang</td>
                                    </tr>
                                    <tr class="bg-gray-50/50 hover:bg-gray-100 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">SLTP /
                                            MTs</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-semibold text-center">
                                            {{ number_format($data->sltp_mts) }}</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">SLTA /
                                            MA</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-semibold text-center">
                                            {{ number_format($data->slta_ma) }}</td>
                                    </tr>
                                    <tr class="bg-gray-50/50 hover:bg-gray-100 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">S1 /
                                            Diploma</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-semibold text-center">
                                            {{ number_format($data->s1_diploma) }}</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">Putus
                                            Sekolah</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-semibold text-center">
                                            {{ number_format($data->putus_sekolah) }}</td>
                                    </tr>
                                    <tr class="bg-gray-50/50 hover:bg-gray-100 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">Buta
                                            Huruf</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-semibold text-center">
                                            {{ number_format($data->buta_huruf) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <!-- Lembaga Pendidikan -->
                <section class="reveal-on-scroll">
                    <div class="text-center mb-4">
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900">Lembaga Pendidikan di Desa Kunden
                        </h2>
                        <p class="mt-2 text-lg text-gray-600">Sarana dan prasarana pendidikan yang tersedia untuk
                            masyarakat.</p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        <div
                            class="bg-white p-6 rounded-xl shadow-lg border hover:border-blue-500 hover:shadow-xl transition-all duration-300">
                            <div class="flex items-start space-x-4">
                                <div class="bg-blue-100 text-blue-600 p-3 rounded-lg flex-shrink-0"><i
                                        data-lucide="building"></i></div>
                                <div>
                                    <h3 class="font-bold text-lg mb-1">Gedung TK/PAUD</h3>
                                    <p class="text-gray-600 text-sm"><span class="font-bold">{{ $data->gedung_tk_paud }} Buah</span> di Dusun
                                        Ngrancang, Ngutran, dan Kepuh.</p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="bg-white p-6 rounded-xl shadow-lg border hover:border-green-500 hover:shadow-xl transition-all duration-300">
                            <div class="flex items-start space-x-4">
                                <div class="bg-green-100 text-green-600 p-3 rounded-lg flex-shrink-0"><i
                                        data-lucide="book-open"></i></div>
                                <div>
                                    <h3 class="font-bold text-lg mb-1">SD / MI</h3>
                                    <p class="text-gray-600 text-sm"><span class="font-bold">{{ $data->gedung_sd_mi }} Buah</span> di Dusun
                                        Ngrancang dan Sumberagung.</p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="bg-white p-6 rounded-xl shadow-lg border hover:border-yellow-500 hover:shadow-xl transition-all duration-300">
                            <div class="flex items-start space-x-4">
                                <div class="bg-yellow-100 text-yellow-600 p-3 rounded-lg flex-shrink-0"><i
                                        data-lucide="graduation-cap"></i></div>
                                <div>
                                    <h3 class="font-bold text-lg mb-1">SLTP / MTs</h3>
                                    <p class="text-gray-600 text-sm"><span class="font-bold">{{ $data->gedung_sltp_mts }} Buah</span> di Dukuh
                                        Sumberejo.</p>
                                </div>
                            </div>
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

            // Data untuk Bar Chart
            const pendidikanData = {
                labels: ['SD/MI', 'SLTP/MTs', 'SLTA/MA', 'S1/Diploma', 'Putus Sekolah', 'Buta Huruf'],
                values: [
                    {{ $data->sd_mi }},
                    {{ $data->sltp_mts }},
                    {{ $data->slta_ma }},
                    {{ $data->s1_diploma }},
                    {{ $data->putus_sekolah }},
                    {{ $data->buta_huruf }}
                ]

            };

            const ctx = document.getElementById('pendidikanChart').getContext('2d');
            const pendidikanChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: pendidikanData.labels,
                    datasets: [{
                        label: 'Jumlah Penduduk',
                        data: pendidikanData.values,
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.7)',
                            'rgba(236, 72, 153, 0.7)',
                            'rgba(16, 185, 129, 0.7)',
                            'rgba(168, 85, 247, 0.7)',
                            'rgba(249, 115, 22, 0.7)',
                            'rgba(107, 114, 128, 0.7)'
                        ],
                        borderColor: [
                            'rgba(59, 130, 246, 1)',
                            'rgba(236, 72, 153, 1)',
                            'rgba(16, 185, 129, 1)',
                            'rgba(168, 85, 247, 1)',
                            'rgba(249, 115, 22, 1)',
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
                                label: function(context) {
                                    return `Jumlah: ${context.raw.toLocaleString('id-ID')} Orang`;
                                }
                            }
                        }
                    }
                }
            });

            // Intersection Observer
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
