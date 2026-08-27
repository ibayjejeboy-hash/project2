{{-- Footer Komponen Publik --}}
<footer class="bg-slate-900 text-gray-300 pt-16 pb-8 border-t-4 border-green-600 relative overflow-hidden">
    {{-- Background Accent Glow --}}
    <div class="absolute top-0 right-0 -mt-16 -mr-16 w-96 h-96 bg-green-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 -mb-16 -ml-16 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-12 mb-12">

            {{-- Kolom 1: Profil & Identitas Lembaga --}}
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/images/1001230752.jpg - Edited.png') }}" 
                         alt="Logo RA Al Musyaffallah" 
                         class="w-12 h-12 object-contain bg-white/10 p-1 rounded-xl">
                    <div>
                        <span class="block font-black text-white text-lg tracking-wider">RA AL MUSYAFFALLAH</span>
                        <span class="block text-xs font-bold text-lime-400 uppercase tracking-widest -mt-0.5">Gabuswetan Indramayu</span>
                    </div>
                </div>

                <p class="text-xs sm:text-sm text-gray-400 leading-relaxed">
                    Lembaga Pendidikan Anak Usia Dini formal berciri khas Islam yang berkomitmen mencetak generasi Qur'ani, cerdas, kreatif, mandiri, dan berakhlak mulia sejak usia dini.
                </p>

                <div class="flex flex-wrap gap-2 pt-1">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-green-950/80 border border-green-700/50 text-green-300 text-xs font-bold rounded-lg">
                        <i class="fa-solid fa-award text-lime-400"></i> Akreditasi B
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-slate-800 border border-slate-700 text-gray-300 text-xs font-semibold rounded-lg">
                        <i class="fa-solid fa-shield-halved text-emerald-400"></i> SK Kemenkumham
                    </span>
                </div>

                {{-- Social Media Links --}}
                <div class="pt-2">
                    <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2.5">Media Sosial Resmi:</span>
                    <div class="flex items-center gap-2.5">
                        <a href="https://www.facebook.com/profile.php?id=100092545553574&locale=eo_EO#" 
                           target="_blank" 
                           rel="noopener noreferrer" 
                           aria-label="Facebook RA Al Musyaffallah"
                           class="w-9 h-9 rounded-xl bg-slate-800 hover:bg-blue-600 hover:text-white flex items-center justify-center text-gray-400 transition-all duration-200 shadow-sm hover:scale-105">
                            <i class="fa-brands fa-facebook-f text-sm"></i>
                        </a>
                        <a href="https://www.instagram.com/ra_almusyaffallah.real?utm_source=qr&igsh=YWlnY3E3Nng0cGRh" 
                           target="_blank" 
                           rel="noopener noreferrer" 
                           aria-label="Instagram RA Al Musyaffallah"
                           class="w-9 h-9 rounded-xl bg-slate-800 hover:bg-gradient-to-tr hover:from-amber-500 hover:via-rose-500 hover:to-purple-600 hover:text-white flex items-center justify-center text-gray-400 transition-all duration-200 shadow-sm hover:scale-105">
                            <i class="fa-brands fa-instagram text-sm"></i>
                        </a>
                        <a href="https://www.youtube.com/@raalmusyaffallah2496?app=desktop" 
                           target="_blank" 
                           rel="noopener noreferrer" 
                           aria-label="YouTube RA Al Musyaffallah"
                           class="w-9 h-9 rounded-xl bg-slate-800 hover:bg-red-600 hover:text-white flex items-center justify-center text-gray-400 transition-all duration-200 shadow-sm hover:scale-105">
                            <i class="fa-brands fa-youtube text-sm"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Kolom 2: Program Pendidikan --}}
            <div class="space-y-4">
                <h4 class="text-sm font-black text-white uppercase tracking-wider border-l-4 border-lime-400 pl-3">
                    Program Unggulan
                </h4>
                <ul class="space-y-2.5 text-xs sm:text-sm text-gray-400">
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-check text-green-500 mt-1"></i>
                        <span>Kelas Kelompok A (Usia 4 - 5 Tahun)</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-check text-green-500 mt-1"></i>
                        <span>Kelas Kelompok B (Usia 5 - 6 Tahun)</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-check text-green-500 mt-1"></i>
                        <span>Kurikulum Merdeka PAUD & P5-PPRA</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-check text-green-500 mt-1"></i>
                        <span>Tahfidz Surat Pendek & Doa Harian</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-check text-green-500 mt-1"></i>
                        <span>Pembiasaan Shalat Dhuha & Adab Islami</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-check text-green-500 mt-1"></i>
                        <span>Pengembangan Motorik & Sentra Bermain</span>
                    </li>
                </ul>
            </div>

            {{-- Kolom 3: Tautan Cepat --}}
            <div class="space-y-4">
                <h4 class="text-sm font-black text-white uppercase tracking-wider border-l-4 border-lime-400 pl-3">
                    Tautan Cepat
                </h4>
                <ul class="space-y-2 text-xs sm:text-sm text-gray-400">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-lime-400 transition flex items-center gap-2">
                            <i class="fa-solid fa-chevron-right text-[10px] text-green-500"></i> Beranda Utama
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}#visi-misi" class="hover:text-lime-400 transition flex items-center gap-2">
                            <i class="fa-solid fa-chevron-right text-[10px] text-green-500"></i> Visi & Misi Sekolah
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}#selayang-pandang" class="hover:text-lime-400 transition flex items-center gap-2">
                            <i class="fa-solid fa-chevron-right text-[10px] text-green-500"></i> Sejarah / Profil Singkat
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('galeri') }}" class="hover:text-lime-400 transition flex items-center gap-2">
                            <i class="fa-solid fa-chevron-right text-[10px] text-green-500"></i> Galeri Dokumentasi Siswa
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pendaftaran') }}" class="hover:text-lime-400 transition flex items-center gap-2">
                            <i class="fa-solid fa-chevron-right text-[10px] text-green-500"></i> Informasi PPDB Online
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pendaftaran.form') }}" class="hover:text-lime-400 transition flex items-center gap-2">
                            <i class="fa-solid fa-chevron-right text-[10px] text-green-500"></i> Formulir Pendaftaran Siswa Baru
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/erapor') }}" class="hover:text-lime-400 transition flex items-center gap-2 text-green-400 font-bold">
                            <i class="fa-solid fa-chevron-right text-[10px]"></i> Portal E-Rapor Digital
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Kolom 4: Informasi Kontak & Alamat --}}
            <div class="space-y-4">
                <h4 class="text-sm font-black text-white uppercase tracking-wider border-l-4 border-lime-400 pl-3">
                    Kontak & Lokasi
                </h4>
                <div class="space-y-3 text-xs sm:text-sm text-gray-400">
                    <a href="https://maps.app.goo.gl/52Sxtsdwn7vJCGrNA" 
                       target="_blank" rel="noopener noreferrer"
                       class="flex items-start gap-3 hover:text-gray-200 transition group">
                        <div class="w-8 h-8 rounded-lg bg-slate-800 group-hover:bg-emerald-950 flex items-center justify-center text-green-400 flex-shrink-0 mt-0.5 border border-slate-700">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <p class="leading-relaxed">
                            Jl. PU Rancahan RT 10/02, Desa Gabuswetan, Kec. Gabuswetan, Kab. Indramayu, Jawa Barat 45263
                            <span class="block text-[11px] text-lime-400 font-semibold mt-0.5 group-hover:underline">
                                <i class="fa-solid fa-arrow-up-right-from-square text-[9px] mr-1"></i>Buka di Google Maps
                            </span>
                        </p>
                    </a>

                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-slate-800 flex items-center justify-center text-green-400 flex-shrink-0">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <p>
                            <span class="font-bold text-gray-300">Jam Belajar:</span><br>
                            Senin - Jumat | 07.30 - 11.00 WIB
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-slate-800 flex items-center justify-center text-green-400 flex-shrink-0">
                            <i class="fa-brands fa-whatsapp text-emerald-400"></i>
                        </div>
                        <a href="https://wa.me/6285314006568?text=Halo%20Admin%20RA%20Al%20Musyaffallah,%20saya%20ingin%20bertanya%20informasi%20pendaftaran%20siswa%20baru" 
                           target="_blank" 
                           rel="noopener noreferrer" 
                           class="text-emerald-400 hover:text-emerald-300 font-bold underline-offset-2 hover:underline">
                            WhatsApp Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>

        </div>

        {{-- Bottom Copyright Bar --}}
        <div class="pt-8 mt-8 border-t border-slate-800/80 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-gray-500">
            <p class="text-center sm:text-left">
                &copy; {{ date('Y') }} <strong class="text-gray-300">RA Al Musyaffallah Gabuswetan</strong>. Hak Cipta Dilindungi.
            </p>
            <div class="flex items-center gap-4 text-xs">
                <span class="text-gray-400">Website & Sistem E-Raport Resmi</span>
                <span>•</span>
                <a href="#top" class="text-lime-400 hover:text-lime-300 transition flex items-center gap-1 font-bold">
                    <i class="fa-solid fa-arrow-up"></i> Ke Atas
                </a>
            </div>
        </div>
    </div>
</footer>
