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
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/quillInit.js'])

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

        .kontent-lembaga p,
        .kontent-lembaga li {
            text-align: justify;
        }

        .kontent-lembaga ol {
            list-style: decimal;
            padding-left: 1rem;
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
                    <span class="text-gray-700">Informasi Publik</span>
                </nav>
                <h1 class="text-4xl font-bold text-gray-800">Informasi publik Desa Kunden</h1>
                <p class="text-gray-500 mt-2">Informasi publik didesa kunden</p>
            </div>

            <div class="w-full h-full bg-white rounded-2xl flex">
                <!-- Main content container -->
                <div class="container mx-auto max-w-4xl p-4 md:p-8">

                    <!-- Main article area -->
                    <main class="w-full kontent-lembaga">
                        <article>
                            <header class="my-8">
                                <h1 id="nama_informasi-publik" class="text-6xl lg:text-8xl font-bold text-gray-900 mb-4">
                                    {{ $informasi->judul_informasi }}</h1>
                                <div
                                    class="text-gray-500 p-2 text-sm md:text-base flex items-center space-x-2">
                                    <span><b id="tipe_lembaga">Tipe Informasi: {{ $informasi->kategori }}</b></span>
                                    <span class="text-xs">•</span>
                                    
                                </div>
                            </header>

                            <div class="w-full">
                                <div class="prose porse-lg max-w-full" id="deskripsi-lengkap">
                                </div>
                                <script>
                                    window.document.addEventListener("DOMContentLoaded", () => {
                                        const container = document.querySelector("#deskripsi-lengkap");
                                        const content = new Quill(container, {
                                            theme: "bubble",
                                            readOnly: true,
                                            modules: {
                                                toolbar: [
                                                    ["table-better"]
                                                ],
                                                "table-better": {
                                                    language: "en_US",
                                                    menus: ["column", "row", "merge", "table", "cell", "wrap", "copy", "delete"],
                                                    toolbarTable: true,
                                                }
                                            }
                                        });
                                        content.updateContents(JSON.parse(@json($informasi->deskripsi)));
                                        container.classList.remove("ql-container");
                                    });
                                </script>
                            </div>
                        </article>
                    </main>

                </div>
            </div>

        </div>
    </main>

    @include('layouts.partials.footer')

    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>