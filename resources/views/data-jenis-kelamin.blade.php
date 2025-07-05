<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Jenis Kelamin - Website Desa Kunden</title>

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
        use App\Models\DemografiKelamin;

        $data = DemografiKelamin::latest()->first() ?? (object)[
            'laki_laki' => 0,
            'perempuan' => 0,
            'kepala_keluarga' => 0
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
                                    <span class="ml-2 text-sm font-medium text-gray-300">Data Jenis Kelamin</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="mt-4 text-4xl md:text-6xl font-bold">
                        Data Penduduk Berdasarkan Jenis Kelamin
                    </h1>
                    <p class="mt-4 text-lg md:text-xl text-gray-200 max-w-3xl mx-auto">
                        Statistik demografi penduduk Desa Kunden berdasarkan jenis kelamin.
                    </p>
                </div>
            </section>

            <div class="container mx-auto px-6 lg:px-16 py-14 sm:py-14 space-y-14">

                <section class="reveal-on-scroll">
                    <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-xl border border-gray-100">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
                            <div>
                                <h2 class="text-2xl md:text-3xl font-bold tracking-tight text-gray-900">Grafik Komposisi
                                    Penduduk</h2>
                                <p class="text-gray-500 mt-1">Visualisasi data kependudukan berdasarkan jenis kelamin.
                                </p>
                            </div>
                            <div x-data="{ chartType: 'pie' }"
                                class="flex items-center space-x-2 mt-4 sm:mt-0 p-1 bg-gray-100 rounded-lg">
                                <button @click="chartType = 'pie'; toggleChartType('pie');"
                                    :class="{ 'bg-white text-blue-600 shadow': chartType === 'pie', 'text-gray-600': chartType !== 'pie' }"
                                    class="px-3 py-1.5 text-sm font-semibold rounded-md transition-all">
                                    Pie Chart
                                </button>
                                <button @click="chartType = 'bar'; toggleChartType('bar');"
                                    :class="{ 'bg-white text-blue-600 shadow': chartType === 'bar', 'text-gray-600': chartType !== 'bar' }"
                                    class="px-3 py-1.5 text-sm font-semibold rounded-md transition-all">
                                    Bar Chart
                                </button>
                            </div>
                        </div>
                        <div class="w-full h-80 md:h-96">
                            <canvas id="genderChart"></canvas>
                        </div>
                    </div>
                </section>

                <!-- Kartu Statistik Utama -->
                <section class="reveal-on-scroll">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div
                            class="bg-blue-500 text-white p-8 rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-lg font-medium text-blue-100">Laki-laki</p>
                                    <p class="text-4xl font-extrabold">{{ number_format($data->laki_laki) }}</p>
                                </div>
                                <div class="bg-white/20 p-4 rounded-full">
                                    <i data-lucide="male" class="w-8 h-8"></i>
                                </div>
                            </div>
                        </div>
                        <div
                            class="bg-pink-500 text-white p-8 rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-lg font-medium text-pink-100">Perempuan</p>
                                    <p class="text-4xl font-extrabold">{{ number_format($data->perempuan) }}</p>
                                </div>
                                <div class="bg-white/20 p-4 rounded-full">
                                    <i data-lucide="female" class="w-8 h-8"></i>
                                </div>
                            </div>
                        </div>
                        <div
                            class="bg-slate-700 text-white p-8 rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-lg font-medium text-slate-300">Total Penduduk</p>
                                    <p class="text-4xl font-extrabold">{{ number_format($data->laki_laki + $data->perempuan) }}</p>
                                </div>
                                <div class="bg-white/20 p-4 rounded-full">
                                    <i data-lucide="users" class="w-8 h-8"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Tabel Rincian -->
                <section class="reveal-on-scroll">
                    <div class="lg:col-span-3">
                        <h3 class="text-3xl font-bold tracking-tight text-gray-900 mb-6 text-center">Tabel Rincian
                            Demografi</h3>
                        <div class="shadow-2xl overflow-hidden border border-gray-200 sm:rounded-2xl max-w-6xl mx-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-slate-700">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                            Kelompok</th>
                                        <th scope="col"
                                            class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">
                                            Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 flex items-center">
                                            <i data-lucide="home" class="w-5 h-5 mr-3 text-indigo-500"></i> Kepala
                                            Keluarga
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-semibold text-center">
                                            {{ number_format($data->kepala_keluarga) }} KK</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 flex items-center">
                                            <i data-lucide="male" class="w-5 h-5 mr-3 text-blue-500"></i> Laki-laki
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-semibold text-center">
                                            {{ number_format($data->laki_laki) }} Orang</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 flex items-center">
                                            <i data-lucide="female" class="w-5 h-5 mr-3 text-pink-500"></i> Perempuan
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-semibold text-center">
                                            {{ number_format($data->perempuan) }} Orang</td>
                                    </tr>
                                    <tr class="bg-gray-100">
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 flex items-center">
                                            <i data-lucide="users" class="w-5 h-5 mr-3 text-slate-600"></i> Total
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-bold text-center">
                                            {{ number_format($data->laki_laki + $data->perempuan) }} Orang</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </main>

    @include('layouts.partials.footer')

    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        // Data untuk chart
        const genderData = {
            labels: ['Laki-laki', 'Perempuan'],
            values: [{{ $data->laki_laki }}, {{ $data->perempuan }}],
            colors: ['#3b82f6', '#ec4899'] // blue-500, pink-500
        };

        // Konfigurasi umum
        const commonConfig = {
            data: {
                labels: genderData.labels,
                datasets: [{
                    label: 'Jumlah Penduduk',
                    data: genderData.values,
                    backgroundColor: genderData.colors,
                    borderColor: '#ffffff',
                    borderWidth: 2,
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 1000,
                    easing: 'easeInOutQuart'
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            font: {
                                size: 14,
                                family: "'Instrument Sans', sans-serif"
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed !== null) {
                                    const total = context.dataset.data.reduce((acc, val) => acc + val, 0);
                                    const percentage = ((context.raw / total) * 100).toFixed(2);
                                    label += `${context.raw.toLocaleString('id-ID')} (${percentage}%)`;
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        };

        let genderChart;
        const ctx = document.getElementById('genderChart').getContext('2d');

        // Fungsi untuk membuat atau mengupdate chart
        function createOrUpdateChart(type) {
            if (genderChart) {
                genderChart.destroy();
            }

            let config = JSON.parse(JSON.stringify(commonConfig));
            config.type = type;

            if (type === 'bar') {
                config.options.scales = {
                    y: {
                        beginAtZero: true
                    },
                    x: {}
                };
                config.options.plugins.legend.display = false;
            } else {
                config.type = 'doughnut';
                config.options.plugins.legend.display = true;
            }

            genderChart = new Chart(ctx, config);
        }

        // Fungsi yang dipanggil oleh tombol
        function toggleChartType(type) {
            createOrUpdateChart(type);
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            lucide.createIcons();
            createOrUpdateChart('pie');

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
