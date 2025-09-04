@section('title', 'Admin - Lembaga')
<x-app-layout>
@vite(['resources/js/quillInit.js'])
    <div class="w-full h-full bg-white">

        <!-- Simple masthead like Medium -->
        <header class="border-b border-gray-200">
            <div class="container mx-auto max-w-4xl p-4 md:p-8 flex items-center">
                <a href="#" class="text-2xl font-bold text-gray-900">Lembaga Desa</a>
            </div>
        </header>

        <!-- Main content container -->
        <div class="container mx-auto max-w-4xl p-4 md:p-8">

            <!-- Main article area -->
            <main class="w-full">
                <article>
                    <header class="mb-8 px-3">
                        <h1 id="nama_lembaga" class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Nama Lembaga:
                            {{ $lembaga->nama_lembaga }}</h1>
                        <div class="text-gray-500 text-sm md:text-base flex items-center space-x-2">
                            <span><b id="tipe_lembaga">Tipe Lembaga: {{ $lembaga->tipe_lembaga }}</b></span>
                            <span class="text-xs">•</span>
                            <span><b id="tahun_berdiri">Tahun Berdiri: {{ $lembaga->tahun_berdiri }}</b></span>
                        </div>
                    </header>

                    <div class=" text-gray-700 w-full">
                        <div class="prose prose-lg max-w-full" id="deskripsi-lengkap">
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
                                content.updateContents(JSON.parse(@json($lembaga->deskripsi)));
                                container.classList.remove("ql-container");
                            });
                        </script>
                    </div>
                </article>
            </main>

        </div>
    </div>
    @vite(['resources/js/customEditor.js'])
</x-app-layout>