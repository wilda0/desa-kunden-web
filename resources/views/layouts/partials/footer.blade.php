<!-- Footer -->
<footer class="bg-gray-800 text-white">
    <div class="container mx-auto px-16 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Tentang -->
            <div>
                <h3 class="text-xl font-bold mb-4">Tentang Desa Kunden</h3>
                <p class="text-gray-400 text-sm">Desa Kunden terletak di Kecamatan Bulu, Sukoharjo, Jawa Tengah
                    dengan luas wilayah 43,96 km². Desa ini memiliki potensi pertanian, pariwisata, dan budaya yang
                    kaya.</p>
            </div>
            <!-- Kontak -->
            <div>
                <h3 class="text-xl font-bold mb-4">Kontak</h3>
                <ul class="text-gray-400 text-sm space-y-2">
                    <li class="flex items-start"><i data-lucide="map-pin"
                            class="w-4 h-4 mr-2 mt-1"></i><span>Kantor Desa Kunden, Kecamatan Bulu, Kabupaten
                            Sukoharjo, Jawa Tengah</span></li>
                    <li class="flex items-center"><i data-lucide="mail"
                            class="w-4 h-4 mr-2"></i><span>desakunden5@gmail.com</span></li>
                    <li class="flex items-center"><i data-lucide="phone" class="w-4 h-4 mr-2"></i><span>(0271)
                            XXXXXX</span></li>
                    <li class="flex items-center"><i data-lucide="clock" class="w-4 h-4 mr-2"></i><span>Senin -
                            Jumat: 08.00-15.00 WIB</span></li>
                </ul>
            </div>
            <!-- Peta & Akses Pengguna -->
            <div>
                <h3 class="text-xl font-bold mb-4">Peta Wilayah</h3>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31631.579603091988!2d110.80108389334546!3d-7.690184499999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a36e133c16a1b%3A0x5027a76e3568c90!2sBulu%2C%20Kabupaten%20Sukoharjo%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1718967923483!5m2!1sid!2sid"
                    width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy"
                    class="rounded-lg mb-4" referrerpolicy="no-referrer-when-downgrade">
                </iframe>

                @if (Route::has('login'))
                    <div class="mt-4">
                        <h3 class="text-xl font-bold mb-2">Akses Pengguna</h3>
                        <div class="flex items-center space-x-4 text-sm">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="text-gray-300 hover:text-white hover:underline transition">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="text-gray-300 hover:text-white hover:underline transition">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="text-gray-300 hover:text-white hover:underline transition">Register</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
    <div class="bg-gray-900 py-4">
        <p class="text-center text-gray-500 text-sm">&copy; 2024 Pemerintah Desa Kunden. All Rights Reserved.</p>
    </div>
</footer>
