@section('title', content: 'Admin - Galeri')

<x-app-layout>
    <div class="py-12">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-2xl">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800">

                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600 dark:text-red-400">
                                {{ __('Whoops! Something went wrong.') }}
                            </div>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form attr-form action="{{ route("admin.galeri.store") }}" method="POST" enctype="multipart/form-data" class="flex flex-col justify-start items-center gap-2">
                        @csrf
                        <style>
                            .media-grid {
                                display: grid;
                                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                                justify-content: center;
                                align-items: center;
                                align-content: center;
                                gap: 1rem;
                                padding: 1rem 0px;
                            }

                            /* only apply when one card left */
                            .media-grid.single>div {
                                max-width: 300px;
                                margin: 0 auto;
                                /* center it */
                            }
                        </style>
                        <h1 class="w-full text-4xl font-bold dark:text-white">Media Uploader</h1>
                        <p class="w-full dark:text-gray-100 mb-3">
                            Media uploader merupakan suatu form untuk mengupload multi foto video, dengan judul yang bisa di kustom
                        </p>
                        <div class="w-full h-fit flex justify-start items-center">
                            <button type="submit"
                                class="transition-all hover:text-blue-200 hover:border-blue-500 rounded-2xl py-2 px-4 dark:bg-slate-800 border dark:border-slate-300 border-slate-800 dark:text-white">
                                Upload Media
                            </button>
                        </div>
                        <!-- Media Titles -->
                        <textarea attr-titles name="judul_media" class="hidden"></textarea>
                        <label for="file-upload" class="w-full flex flex-col items-center justify-center gap-2 p-8 rounded-2xl border-2 border-dashed border-white/20 
                        bg-white/5 backdrop-blur-sm text-center cursor-pointer
                        hover:border-blue-400 hover:bg-white/10 transition">
                            <span class="text-2xl font-semibold dark:text-white">Tarik foto/video kesini</span>
                            <span class="text-sm text-gray-400">atau klik untuk mengupload</span>
                            <span class="px-4 py-2 rounded-xl   radient-to-b from-blue-500 to-blue-600 
                            dark:text-white font-medium shadow-md hover:from-blue-600 hover:to-blue-700 transition">
                                📷 Pilih Foto/Video
                            </span>
                            <input name="media[]" id="file-upload" multiple type="file" accept="image/*,video/*"
                                class="hidden" />
                        </label>
                        <small class="w-full dark:text-gray-100 mb-3">
                            *Anda bisa langsung mengganti nama file menjadi judul dengan mengklik namafile
                        </small>
                        <div class="media-grid">

                            <div attr-node="default" class="w-full hidden flex-col gap-3 p-4 rounded-2xl
                            border border-slate-200 dark:border-slate-700
                            bg-white dark:bg-slate-800 shadow-md hover:shadow-xl transition">

                                <!-- File title -->
                                <div class="flex justify-between items-center w-full">
                                    <input placeholder="masukan nama media..." attr-title
                                        class="text-slate-800 dark:text-slate-100 w-[90%] dark:bg-transparent text-start text-sm font-semibold truncate" />
                                    <span attr-close
                                        class="text-red-400 text-xl flex justify-center items-center cursor-pointer w-[10%]">
                                        &times;
                                    </span>
                                </div>

                                <!-- Media preview -->
                                <div attr-container
                                    class="w-full aspect-video rounded-xl overflow-hidden border border-dashed 
                                    border-blue-400 dark:border-slate-500 bg-slate-50 dark:bg-slate-700 flex items-center justify-center">

                                </div>

                                <!-- File info -->
                                <div class="flex justify-between w-full text-xs text-slate-600 dark:text-slate-300">
                                    <span attr-size>120 KB</span>
                                    <span attr-dimension>800×600 px</span>
                                </div>
                            </div>

                        </div>
                        <script>

                            function createElement(name, class_list, attr) {
                                const element = document.createElement(name);
                                element.classList.add(...class_list);
                                for (let key of Object.keys(attr)) {
                                    element.setAttribute(key, attr[key]);
                                }
                                return element;
                            }

                            const media_grid = document.querySelector(".media-grid");
                            const file_upload = document.querySelector("#file-upload");
                            const dropZone = document.querySelector("label[for=file-upload]");
                            const default_media_template = document.querySelector("div[attr-node=default]").cloneNode(true);

                            // Highlight drop zone when dragging
                            dropZone.addEventListener("dragover", (e) => {
                                e.preventDefault();
                                dropZone.classList.add("ring", "ring-blue-400");
                            });

                            // Remove highlight
                            dropZone.addEventListener("dragleave", () => {
                                dropZone.classList.remove("ring", "ring-blue-400");
                            });

                            // Handle drop
                            dropZone.addEventListener("drop", (e) => {
                                e.preventDefault();
                                dropZone.classList.remove("ring", "ring-blue-400");

                                const files = e.dataTransfer.files;

                                // Trigger the same logic as fileUpload.onchange
                                file_upload.files = files;

                                // Manually trigger change event
                                file_upload.dispatchEvent(new Event("change"));
                            });

                            let judul_media = {};
                            file_upload.onchange = e => {

                                judul_media = {};
                                media_grid.innerHTML = "";

                                let files = e.target.files;
                                for (let i = 0; i < files.length; i++) {
                                    const file = files[i];
                                    const new_node = default_media_template.cloneNode(true);
                                    const title = new_node.querySelector("[attr-title]");
                                    const size = new_node.querySelector("[attr-size]");
                                    const container = new_node.querySelector("[attr-container]");
                                    const dimension = new_node.querySelector("[attr-dimension]");
                                    const close = new_node.querySelector("[attr-close]");
                                    const dataTransfer = new DataTransfer();

                                    const fileSizeInBytes = file.size;
                                    const fileSizeInKB = (fileSizeInBytes / 1024).toFixed(2); // Convert to KB
                                    const fileSizeInMB = (fileSizeInBytes / (1024 * 1024)).toFixed(2); // Convert to MB
                                    const maxSize = 120 * 1024 * 1024; // 120 MB

                                    if(fileSizeInMB > maxSize){
                                        alert(`${file.name} Ukuran file melebihi 120MB`);
                                        return;
                                    }


                                    new_node.classList.remove("hidden");
                                    new_node.classList.add("flex");
                                    title.value = file.name.substring(0, 20) + (file.name.length > 20 ? "..." : "");
                                    judul_media[i] = title.value;
                                    title.oninput = ext => {
                                        judul_media[i] = ext.target.value;
                                    };
                                    title.onclick = ext =>{
                                        if(judul_media[i] === file.name.substring(0, 20) + (file.name.length > 20 ? "..." : "")){
                                            ext.target.value = file.name;
                                        }
                                    };

                                    if (file.type.startsWith("video/")) {
                                        const video = createElement("video", "w-full h-full".split(" "), { controls: true });
                                        video.src = URL.createObjectURL(file);
                                        video.addEventListener("loadedmetadata", () => {
                                            dimension.innerHTML = `${video.videoWidth}x${video.videoHeight} px,${video.duration.toFixed(1)}s`;
                                            size.innerHTML = `${fileSizeInMB} MB`;
                                        });
                                        container.appendChild(video);
                                        close.onclick = _ => {
                                            new_node.remove();

                                            URL.revokeObjectURL(video.src);

                                            for (let j = 0; j < files.length; j++) {
                                                if (file !== files[j]) {
                                                    dataTransfer.items.add(files[j]);
                                                }
                                            }

                                            e.target.files = dataTransfer.files;
                                            files = e.target.files;

                                            if (e.target.files.length <= 2) {
                                                media_grid.classList.add("single");
                                            } else {
                                                media_grid.classList.remove("single");
                                            }
                                        };
                                    }

                                    if (file.type.startsWith("image/")) {
                                        const img = createElement("img", "object-cover w-full h-full".split(" "), {});
                                        img.src = URL.createObjectURL(file);
                                        img.onload = _ => {
                                            dimension.innerHTML = `${img.naturalWidth}x${img.naturalHeight} px`;
                                            size.innerHTML = `${fileSizeInKB} KB`;
                                        };
                                        container.appendChild(img);

                                        close.onclick = _ => {
                                            new_node.remove();

                                            URL.revokeObjectURL(img.src);

                                            for (let j = 0; j < files.length; j++) {
                                                if (file !== files[j]) {
                                                    dataTransfer.items.add(files[j]);
                                                }
                                            }

                                            e.target.files = dataTransfer.files;
                                            files = e.target.files;

                                            if (e.target.files.length <= 2) {
                                                media_grid.classList.add("single");
                                            } else {
                                                media_grid.classList.remove("single");
                                            }
                                        };
                                    }

                                    media_grid.appendChild(
                                        new_node
                                    );


                                    if (files.length <= 2) {
                                        media_grid.classList.add("single");
                                    } else {
                                        media_grid.classList.remove("single");
                                    }
                                }

                            };

                        </script>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", (event) => {
                const form = document.querySelector("[attr-form]");
                const titles = document.querySelector("[attr-titles]");
                const file_upload = document.querySelector("#file-upload");
                form.onsubmit = e => {
                    titles.value = JSON.stringify(judul_media);
                };
            });
        </script>
    @endpush
</x-app-layout>