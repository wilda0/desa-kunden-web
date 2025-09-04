<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Ekonomi - Website Desa Kunden</title>

    <link rel="icon" type="image/png" href="/images/logo-kunden.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/quillInit.js'])

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

<body class="  bg-gray-50 font-sans text-gray-800">

    @include('layouts.partials.header')

    @php
        use App\Models\DataEkonomi;
        $data = DataEkonomi::latest()->first() ?? (object)[
            'padi_sawah' => 0,
            'padi_ladang' => 0,
            'jagung' => 0,
            'palawija' => 0,
            'tebu' => 0,

            'kambing' => 0,
            'sapi' => 0,
            'ayam' => 0,
            'burung' => 0,

            'petani' => 0,
            'pedagang' => 0,
            'pns' => 0,
            'tukang' => 0,
            'guru' => 0,
            'bidan_perawat' => 0,
            'tni_polri' => 0,
            'pensiunan' => 0,
            'sopir_angkutan' => 0,
            'buruh' => 0,
            'jasa_persewaan' => 0,
            'swasta' => 0
        ];
    @endphp

    <main>
        <div class="  bg-gray-50">

            {{-- Bagian Judul dan Breadcrumb --}}
            <section class="bg-slate-800 relative text-white text-center py-20 sm:py-28">
                <div class="absolute inset-0 bg-cover bg-center"
                    style="background-image: url('/images/lahan-kunyit.png');"></div>
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
                                    <span class="ml-2 text-sm font-medium text-gray-300">Data Ekonomi</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="mt-4 text-4xl md:text-6xl font-bold">
                        Data Ekonomi Desa Kunden
                    </h1>
                    <p class="mt-4 text-lg md:text-xl text-gray-200 max-w-3xl mx-auto">
                        Potensi, mata pencaharian, dan sarana ekonomi yang menggerakkan Desa Kunden.
                    </p>
                </div>
            </section>

            <div class="container mx-auto px-6 lg:px-16 py-14 sm:py-14 space-y-14">

                <!-- Luas Tanaman Pertanian -->
                <section class="reveal-on-scroll">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900">Luas Tanaman Pertanian</h2>
                        <p class="mt-2 text-lg text-gray-600">Pemanfaatan lahan pertanian di Desa Kunden.</p>
                    </div>
                    <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-xl border border-gray-100">
                        <div class="overflow-x-auto mb-8">
                            <table class="min-w-full text-sm">
                                <thead class="border-b-2 border-gray-200">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-600">Jenis
                                            Tanaman</th>
                                        <th scope="col" class="px-4 py-3 text-right font-semibold text-gray-600">Luas
                                            (ha)</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <tr>
                                        <td class="px-4 py-3 text-gray-700">Padi Sawah</td>
                                        <td class="px-4 py-3 text-gray-800 text-right font-medium">{{ $data->padi_sawah }} ha</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 text-gray-700">Padi Ladang</td>
                                        <td class="px-4 py-3 text-gray-800 text-right font-medium">{{ $data->padi_ladang }} ha</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 text-gray-700">Jagung</td>
                                        <td class="px-4 py-3 text-gray-800 text-right font-medium">{{ $data->jagung }} ha</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 text-gray-700">Palawija</td>
                                        <td class="px-4 py-3 text-gray-800 text-right font-medium">{{ $data->palawija }} ha</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 text-gray-700">Tebu</td>
                                        <td class="px-4 py-3 text-gray-800 text-right font-medium">{{ $data->tebu }} ha</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="w-full h-96">
                            <canvas id="tanamanChart"></canvas>
                        </div>
                    </div>
                </section>

                <!-- Jenis Ternak (Tabel) -->
                <section class="reveal-on-scroll">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900">Jenis Ternak</h2>
                        <p class="mt-2 text-lg text-gray-600">Populasi hewan ternak yang ada di Desa Kunden.</p>
                    </div>

                    <div class="max-w-4xl mx-auto">
                        <div class="flex flex-col">
                            <div class="overflow-x-auto">
                                <div class="align-middle inline-block min-w-full">
                                    <div class="shadow-2xl overflow-hidden border-b border-gray-200 sm:rounded-2xl">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-slate-700">
                                                <tr>
                                                    <th
                                                        class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                                        No
                                                    </th>
                                                    <th
                                                        class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                                        Jenis Ternak
                                                    </th>
                                                    <th
                                                        class="px-6 py-4 text-right text-xs font-bold text-white uppercase tracking-wider">
                                                        Jumlah (Ekor)
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <tr class="hover:bg-blue-50 transition-colors duration-200">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1.
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        Kambing</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-800 font-semibold">
                                                        {{ $data->kambing }}</td>
                                                </tr>
                                                <tr
                                                    class="  bg-gray-50 hover:bg-blue-50 transition-colors duration-200">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2.
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        Sapi</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-800 font-semibold">
                                                        {{ $data->sapi }}</td>
                                                </tr>
                                                <tr class="hover:bg-blue-50 transition-colors duration-200">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3.
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        Ayam</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-800 font-semibold">
                                                        {{ $data->ayam }}</td>
                                                </tr>
                                                <tr
                                                    class="  bg-gray-50 hover:bg-blue-50 transition-colors duration-200">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">4.
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        Burung</td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-800 font-semibold">
                                                        {{ $data->burung }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Pekerjaan / Mata Pencaharian -->
                <section class="reveal-on-scroll">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900">Struktur Mata Pencaharian</h2>
                        <p class="mt-2 text-lg text-gray-600">Distribusi jenis pekerjaan utama masyarakat Desa Kunden.
                        </p>
                    </div>
                    <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-xl border border-gray-100">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                            <div class="w-full h-80 md:h-96">
                                <canvas id="pekerjaanChart"></canvas>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-sm">
                                    <thead class="border-b-2 border-gray-200">
                                        <tr>
                                            <th scope="col"
                                                class="px-4 py-3 text-left font-semibold text-gray-600">Jenis Pekerjaan
                                            </th>
                                            <th scope="col"
                                                class="px-4 py-3 text-right font-semibold text-gray-600">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        <tr>
                                            <td class="px-4 py-3 text-gray-700">Petani</td>
                                            <td class="px-4 py-3 text-gray-800 text-right font-medium">{{ $data->petani }} Orang</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 text-gray-700">Pedagang</td>
                                            <td class="px-4 py-3 text-gray-800 text-right font-medium">{{ $data->pedagang }} Orang</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 text-gray-700">PNS</td>
                                            <td class="px-4 py-3 text-gray-800 text-right font-medium">{{ $data->pns }} Orang</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 text-gray-700">Tukang</td>
                                            <td class="px-4 py-3 text-gray-800 text-right font-medium">{{ $data->tukang }} Orang</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 text-gray-700">Guru</td>
                                            <td class="px-4 py-3 text-gray-800 text-right font-medium">{{ $data->guru }} Orang</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 text-gray-700">Bidan/Perawat</td>
                                            <td class="px-4 py-3 text-gray-800 text-right font-medium">{{ $data->bidan_perawat }} Orang</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 text-gray-700">TNI/Polri</td>
                                            <td class="px-4 py-3 text-gray-800 text-right font-medium">{{ $data->tni_polri }} Orang</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 text-gray-700">Pensiunan</td>
                                            <td class="px-4 py-3 text-gray-800 text-right font-medium">{{ $data->pensiunan }} Orang</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 text-gray-700">Sopir/Angkutan</td>
                                            <td class="px-4 py-3 text-gray-800 text-right font-medium">{{ $data->sopir_angkutan }} Orang</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 text-gray-700">Buruh</td>
                                            <td class="px-4 py-3 text-gray-800 text-right font-medium">{{ $data->buruh }} Orang</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 text-gray-700">Jasa Persewaan</td>
                                            <td class="px-4 py-3 text-gray-800 text-right font-medium">{{ $data->jasa_persewaan }} Orang</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 text-gray-700">Swasta</td>
                                            <td class="px-4 py-3 text-gray-800 text-right font-medium">{{ $data->swasta }} Orang</td>
                                        </tr>
                                    </tbody>
                                </table>
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

            // --- Chart Luas Tanaman Pertanian ---
            const tanamanCtx = document.getElementById('tanamanChart').getContext('2d');
            new Chart(tanamanCtx, {
                type: 'bar',
                data: {
                    labels: ['Padi Sawah', 'Padi Ladang', 'Jagung', 'Palawija', 'Tebu'],
                    datasets: [{
                        label: 'Luas Tanaman (ha)',
                        data: [
                            {{ $data->padi_sawah }},
                            {{ $data->padi_ladang }},
                            {{ $data->jagung }},
                            {{ $data->palawija }},
                            {{ $data->tebu }}
                        ],
                        backgroundColor: [
                            'rgba(34, 197, 94, 0.7)',
                            'rgba(234, 179, 8, 0.7)',
                            'rgba(249, 115, 22, 0.7)',
                            'rgba(168, 85, 247, 0.7)',
                            'rgba(59, 130, 246, 0.7)'
                        ],
                        borderColor: [
                            'rgba(34, 197, 94, 1)',
                            'rgba(234, 179, 8, 1)',
                            'rgba(249, 115, 22, 1)',
                            'rgba(168, 85, 247, 1)',
                            'rgba(59, 130, 246, 1)'
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
                                label: (c) => `Luas: ${c.raw.toLocaleString('id-ID')} ha`
                            }
                        }
                    }
                }
            });

            // --- Chart Mata Pencaharian ---
            const pekerjaanCtx = document.getElementById('pekerjaanChart').getContext('2d');
            new Chart(pekerjaanCtx, {
                type: 'pie',
                data: {
                    labels: ['Petani', 'Pedagang', 'PNS', 'Tukang', 'Guru', 'Bidan/Perawat', 'TNI/Polri',
                        'Pensiunan', 'Sopir/Angkutan', 'Buruh', 'Jasa Persewaan', 'Swasta'
                    ],
                    datasets: [{
                        label: 'Jumlah Orang',
                        data: [
                            {{ $data->petani }},
                            {{ $data->pedagang }},
                            {{ $data->pns }},
                            {{ $data->tukang }},
                            {{ $data->guru }},
                            {{ $data->bidan_perawat }},
                            {{ $data->tni_polri }},
                            {{ $data->pensiunan }},
                            {{ $data->sopir_angkutan }},
                            {{ $data->buruh }},
                            {{ $data->jasa_persewaan }},
                            {{ $data->swasta }}
                        ],
                        backgroundColor: [
                            '#22c55e', '#3b82f6', '#8b5cf6', '#f97316', '#ec4899', '#14b8a6',
                            '#6366f1', '#64748b', '#0ea5e9', '#f59e0b', '#84cc16', '#d946ef'
                        ],
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                padding: 15,
                                boxWidth: 12,
                                font: {
                                    size: 12
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const total = context.dataset.data.reduce((acc, val) => acc + val,
                                        0);
                                    const percentage = ((context.raw / total) * 100).toFixed(2);
                                    return `${context.label}: ${context.raw.toLocaleString('id-ID')} Orang (${percentage}%)`;
                                }
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
