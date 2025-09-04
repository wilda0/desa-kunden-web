<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Informasi Publik - Website Desa Kunden</title>

    <link rel="icon" type="image/png" href="/images/logo-kunden.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/quillInit.js'])

    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
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
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="  bg-gray-100 font-sans text-gray-800">

    @include('layouts.partials.header')

    <main>
        <div class="container mx-auto px-6 lg:px-16 py-12 flex flex-col space-y-8">

            <!-- Title & Breadcrumb -->
            <div class="mb-8">
                <nav class="text-sm mb-4 text-gray-500">
                    <a href="{{ route('welcome') }}" class="hover:text-blue-600">Home</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-700">Layanan Desa</span>
                </nav>
                <h1 class="text-4xl font-bold text-gray-800">Layanan Desa</h1>
                <p class="text-gray-500 mt-2">Daftar Layanan Desa yang wajib disediakan dan diumumkan oleh
                    Pemerintah Desa Kunden.</p>
            </div>

            {{-- The Livewire Component --}}
            <livewire:layanan-table />

        </div>
    </main>

    @include('layouts.partials.footer')

    <script>


        lucide.createIcons();
    </script>
</body>

</html>