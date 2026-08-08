@extends('layouts.app')

@section('title', 'RA Al Musyaffallah - Gabuswetan Indramayu | Website Resmi & E-Raport')

@section('content')

{{-- ================= 1. NAVBAR ================= --}}
@include('layouts.navbar')


{{-- ================= 2. HERO SECTION ================= --}}
<section class="relative bg-gradient-to-b from-green-50/80 via-emerald-50/40 to-white pt-10 pb-20 md:pt-16 md:pb-28 overflow-hidden">
    {{-- Decorative Background Elements --}}
    <div class="absolute top-0 right-1/4 w-96 h-96 bg-lime-200/40 rounded-full blur-3xl pointer-events-none -z-10"></div>
    <div class="absolute bottom-0 left-10 w-80 h-80 bg-green-200/30 rounded-full blur-2xl pointer-events-none -z-10"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-4xl mx-auto space-y-6">

            {{-- Announcement Badge --}}
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs sm:text-sm font-bold bg-white text-green-800 border border-green-200 shadow-sm hover:shadow-md transition">
                <span class="flex h-2.5 w-2.5 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-600"></span>
                </span>
                <span>Penerimaan Peserta Didik Baru (PPDB) Tahun Ajaran 2026/2027 Telah Dibuka!</span>
            </div>

            {{-- Main Heading --}}
            <h1 class="text-3xl sm:text-5xl md:text-6xl font-black text-gray-900 tracking-tight leading-tight">
                Membentuk Generasi <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-700 via-emerald-600 to-lime-600">Qur'ani, Cerdas</span> & Berakhlak Mulia
            </h1>

            {{-- Subtitle --}}
            <p class="text-base sm:text-lg md:text-xl font-medium text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Lembaga Pendidikan Anak Usia Dini (RA) berciri khas Islam dengan implementasi <strong>Kurikulum Merdeka PAUD</strong> di Gabuswetan, Indramayu.
            </p>

            {{-- Action Buttons --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
                <a href="{{ route('pendaftaran') }}" 
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-8 py-4 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white font-bold rounded-2xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition duration-200 text-sm sm:text-base">
                    <i class="fa-solid fa-file-signature text-base"></i>
                    <span>Daftar Siswa Baru (PPDB)</span>
                </a>
                
                <a href="{{ route('galeri') }}" 
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-8 py-4 bg-white hover:bg-gray-50 text-gray-800 font-bold rounded-2xl border border-gray-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition duration-200 text-sm sm:text-base">
                    <i class="fa-solid fa-images text-green-600"></i>
                    <span>Lihat Galeri Aktivitas</span>
                </a>

                <a href="{{ url('/erapor') }}" 
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-6 py-4 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 font-bold rounded-2xl border border-emerald-200 transition duration-200 text-sm sm:text-base">
                    <i class="fa-solid fa-graduation-cap text-emerald-600"></i>
                    <span>Portal E-Rapor</span>
                </a>
            </div>

            {{-- Social Media Follow Bar --}}
            <div class="pt-4 flex flex-wrap items-center justify-center gap-3 text-xs text-gray-500 font-bold">
                <span class="text-gray-400 uppercase tracking-wider">Ikuti Media Sosial Kami:</span>
                <div class="flex items-center gap-2">
                    <a href="https://www.facebook.com/profile.php?id=100092545553574&locale=eo_EO#" 
                       target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white rounded-xl border border-gray-200 hover:text-blue-600 hover:border-blue-300 shadow-sm transition">
                        <i class="fa-brands fa-facebook text-blue-600"></i>
                        <span>Facebook</span>
                    </a>
                    <a href="https://www.instagram.com/ra_almusyaffallah.real?utm_source=qr&igsh=YWlnY3E3Nng0cGRh" 
                       target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white rounded-xl border border-gray-200 hover:text-pink-600 hover:border-pink-300 shadow-sm transition">
                        <i class="fa-brands fa-instagram text-pink-600"></i>
                        <span>Instagram</span>
                    </a>
                    <a href="https://www.youtube.com/@raalmusyaffallah2496?app=desktop" 
                       target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white rounded-xl border border-gray-200 hover:text-red-600 hover:border-red-300 shadow-sm transition">
                        <i class="fa-brands fa-youtube text-red-600"></i>
                        <span>YouTube</span>
                    </a>
                </div>
            </div>

        </div>

        {{-- Highlight Stats & Badges Grid --}}
        <div class="mt-14 max-w-5xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            <div class="bg-white/90 backdrop-blur-sm p-5 rounded-2xl border border-green-100 shadow-sm hover:shadow-md transition text-center group">
                <div class="w-12 h-12 rounded-xl bg-green-100 text-green-700 flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition">
                    <i class="fa-solid fa-award text-xl"></i>
                </div>
                <div class="text-xl font-black text-gray-900">Terakreditasi B</div>
                <p class="text-xs text-gray-500 font-medium mt-0.5">BAN-PAUD / Kemenag</p>
            </div>

            <div class="bg-white/90 backdrop-blur-sm p-5 rounded-2xl border border-green-100 shadow-sm hover:shadow-md transition text-center group">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition">
                    <i class="fa-solid fa-book-quran text-xl"></i>
                </div>
                <div class="text-xl font-black text-gray-900">Tahfidz Cilik</div>
                <p class="text-xs text-gray-500 font-medium mt-0.5">Surat Pendek & Doa</p>
            </div>

            <div class="bg-white/90 backdrop-blur-sm p-5 rounded-2xl border border-green-100 shadow-sm hover:shadow-md transition text-center group">
                <div class="w-12 h-12 rounded-xl bg-lime-100 text-lime-700 flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition">
                    <i class="fa-solid fa-shapes text-xl"></i>
                </div>
                <div class="text-xl font-black text-gray-900">Kurikulum Merdeka</div>
                <p class="text-xs text-gray-500 font-medium mt-0.5">P5 & Nilai PPRA</p>
            </div>

            <div class="bg-white/90 backdrop-blur-sm p-5 rounded-2xl border border-green-100 shadow-sm hover:shadow-md transition text-center group">
                <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition">
                    <i class="fa-solid fa-users text-xl"></i>
                </div>
                <div class="text-xl font-black text-gray-900">10+ Tahun</div>
                <p class="text-xs text-gray-500 font-medium mt-0.5">Dedikasi Pendidikan</p>
            </div>
        </div>

    </div>
</section>


{{-- ================= 3. SECTION PROGRAM UNGGULAN ================= --}}
<section id="keunggulan" class="py-20 bg-white border-y border-gray-100 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Section Heading --}}
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
            <span class="text-xs font-extrabold text-green-700 uppercase tracking-widest bg-green-100 px-3 py-1 rounded-full border border-green-200">
                Keunggulan Lembaga
            </span>
            <h2 class="text-3xl sm:text-4xl font-black text-gray-900">
                Mengapa Memilih RA Al Musyaffallah?
            </h2>
            <p class="text-sm sm:text-base text-gray-600">
                Kami merancang proses pembelajaran yang ramah anak, menyenangkan, dan berorientasi pada pembentukan karakter Islami sejak dini.
            </p>
            <div class="w-16 h-1 bg-green-600 mx-auto rounded-full mt-3"></div>
        </div>

        {{-- 4 Cards Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            
            {{-- Card 1 --}}
            <div class="bg-gradient-to-b from-gray-50 to-white p-7 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group">
                <div class="w-14 h-14 rounded-2xl bg-green-600 text-white flex items-center justify-center mb-6 shadow-md group-hover:scale-110 transition">
                    <i class="fa-solid fa-kaaba text-2xl"></i>
                </div>
                <h3 class="text-lg font-black text-gray-900 mb-2.5 group-hover:text-green-700 transition">
                    Pendidikan Qur'ani & Adab
                </h3>
                <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">
                    Pembiasaan shalat Dhuha berjamaah, hafalan juz 30, doa harian, hadits pendek, dan penanaman adab sopan santun islami.
                </p>
            </div>

            {{-- Card 2 --}}
            <div class="bg-gradient-to-b from-gray-50 to-white p-7 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group">
                <div class="w-14 h-14 rounded-2xl bg-emerald-600 text-white flex items-center justify-center mb-6 shadow-md group-hover:scale-110 transition">
                    <i class="fa-solid fa-puzzle-piece text-2xl"></i>
                </div>
                <h3 class="text-lg font-black text-gray-900 mb-2.5 group-hover:text-emerald-700 transition">
                    Kurikulum Merdeka PAUD
                </h3>
                <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">
                    Pembelajaran bermakna dengan eksplorasi minat bakat, sentra kreativitas, serta penanaman Profil Pelajar Rahmatan Lil Alamin.
                </p>
            </div>

            {{-- Card 3 --}}
            <div class="bg-gradient-to-b from-gray-50 to-white p-7 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group">
                <div class="w-14 h-14 rounded-2xl bg-lime-600 text-white flex items-center justify-center mb-6 shadow-md group-hover:scale-110 transition">
                    <i class="fa-solid fa-palette text-2xl"></i>
                </div>
                <h3 class="text-lg font-black text-gray-900 mb-2.5 group-hover:text-lime-700 transition">
                    Motorik & Seni Kreatif
                </h3>
                <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">
                    Stimulasi motorik halus dan kasar melalui kegiatan bermain peran, menari, menggambar, mewarnai, serta senam ceria anak.
                </p>
            </div>

            {{-- Card 4 --}}
            <div class="bg-gradient-to-b from-gray-50 to-white p-7 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group">
                <div class="w-14 h-14 rounded-2xl bg-amber-600 text-white flex items-center justify-center mb-6 shadow-md group-hover:scale-110 transition">
                    <i class="fa-solid fa-heart text-2xl"></i>
                </div>
                <h3 class="text-lg font-black text-gray-900 mb-2.5 group-hover:text-amber-700 transition">
                    Guru Kasih Sayang & Sabar
                </h3>
                <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">
                    Dididik oleh Ustadzah yang berpengalaman, berdedikasi tinggi, penuh kasih sayang, dan memahami psikologi perkembangan anak.
                </p>
            </div>

        </div>

    </div>
</section>


{{-- ================= 4. SECTION VISI & MISI ================= --}}
<section id="visi-misi" class="py-20 bg-gray-50 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-12 gap-12 items-center">

        {{-- Gambar Guru (Left Column) --}}
        <div class="lg:col-span-5">
            <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white group">
                <img src="{{ asset('assets/images/Untitled Design - 1 - Edited.png') }}"
                     alt="Dewan Guru RA Al Musyaffallah"
                     class="w-full h-[420px] sm:h-[500px] object-cover group-hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/20 to-transparent"></div>
                
                {{-- Floating Card on Image --}}
                <div class="absolute bottom-6 left-6 right-6 p-4 bg-white/95 backdrop-blur-md rounded-2xl shadow-lg border border-white/50">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-green-600 text-white flex items-center justify-center font-bold">
                            <i class="fa-solid fa-chalkboard-user"></i>
                        </div>
                        <div>
                            <span class="block text-xs font-black text-green-700 uppercase tracking-wider">Tenaga Pendidik</span>
                            <span class="block text-sm font-bold text-gray-900">Ustadzah & Pengasuh RA</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Text Visi Misi (Right Column) --}}
        <div class="lg:col-span-7 space-y-6">
            <div>
                <span class="text-xs font-extrabold text-green-700 uppercase tracking-widest bg-green-100 px-3 py-1 rounded-full border border-green-200">
                    Arah & Landasan
                </span>
                <h2 class="text-3xl sm:text-5xl font-black text-gray-900 mt-3">
                    VISI & MISI SEKOLAH
                </h2>
                <div class="w-16 h-1 bg-green-600 rounded-full mt-3"></div>
            </div>

            {{-- Visi Card --}}
            <div class="bg-gradient-to-r from-green-800 to-emerald-900 p-6 sm:p-8 rounded-3xl text-white shadow-lg relative overflow-hidden">
                <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-white/10 rounded-full blur-xl pointer-events-none"></div>
                <div class="flex items-center gap-3 mb-3">
                    <span class="px-3 py-1 bg-lime-400 text-green-950 text-xs font-black rounded-lg uppercase tracking-wider">
                        Visi Kami
                    </span>
                </div>
                <p class="text-base sm:text-xl font-semibold leading-relaxed text-green-50 italic">
                    "{{ $informasi->visi ?? 'Mewujudkan Generasi Qur\'ani yang Berakhlak Mulia, Cerdas, Kreatif, dan Mandiri Sejak Usia Dini.' }}"
                </p>
            </div>

            {{-- Misi Card --}}
            <div class="bg-white p-6 sm:p-8 rounded-3xl border border-gray-200 shadow-sm space-y-4">
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-black rounded-lg uppercase tracking-wider">
                        Misi Kami
                    </span>
                </div>
                <div class="text-xs sm:text-sm md:text-base text-gray-700 leading-relaxed space-y-3 font-medium">
                    {!! nl2br(e($informasi->misi ?? "1. Menanamkan nilai-nilai keislaman dan kecintaan terhadap Al-Qur'an sejak usia dini.\n2. Mengembangkan potensi kecerdasan intelektual, emosional, dan spiritual anak secara seimbang.\n3. Membiasakan perilaku mandiri, disiplin, dan berakhlak terpuji dalam kehidupan sehari-hari.\n4. Menyelenggarakan pembelajaran yang aktif, inovatif, kreatif, efektif, dan menyenangkan (PAIKEM).")) !!}
                </div>
            </div>

        </div>

    </div>
</section>


{{-- ================= 5. SECTION SELAYANG PANDANG ================= --}}
<section id="selayang-pandang" class="relative text-white min-h-[520px] flex items-center py-20">
    {{-- Background Image with Parallax Style --}}
    <div class="absolute inset-0">
        <img src="{{ asset('assets/images/612919327_800651653029679_8741154945121478353_n.jpg') }}" 
             alt="Dokumentasi Siswa RA Al Musyaffallah"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/95 via-green-950/90 to-emerald-950/85"></div>
    </div>

    {{-- Content --}}
    <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
        <span class="text-xs font-extrabold text-lime-400 uppercase tracking-widest bg-white/10 px-4 py-1.5 rounded-full border border-lime-400/30">
            Sejarah & Profil Singkat
        </span>
        
        <h2 class="text-3xl sm:text-5xl font-black tracking-tight leading-tight">
            Selayang Pandang RA Al Musyaffallah
        </h2>
        
        <div class="w-16 h-1 bg-lime-400 mx-auto rounded-full"></div>
        
        <div class="max-w-4xl mx-auto text-xs sm:text-sm md:text-base leading-relaxed text-gray-200 font-normal space-y-4 text-justify md:text-center">
            <p>
                Raudhatul Athfal (RA) Al Musyaffallah didirikan atas swadaya masyarakat sekitar pada <strong>Bulan Juli Tahun 2014</strong> berdasarkan Akta Pendirian nomor register <code>k.k.10.12.15/BA.01/12/2014</code> oleh Notaris Suparto, S.H, M.Kn. Seiring perkembangan regulasi dan untuk memperkuat payung hukum Kemenkumham, pada 7 Desember 2016 dibuatlah Akta Notaris No. 79 serta SK Kemenkumham No. <strong>AHU-0045397.AH.01.04</strong>.
            </p>
            <p>
                Secara geografis, RA Al Musyaffallah berlokasi di <strong>Jalan PU Rancahan RT 10/02 Desa Gabuswetan, Kecamatan Gabuswetan, Kabupaten Indramayu</strong>. Bersebelahan dengan Musholla Al Musyaffallah yang menjadi sarana pembiasaan ibadah praktis siswa. Sekolah ini telah terakreditasi resmi dengan predikat <strong>Terakreditasi B</strong>.
            </p>
        </div>

        {{-- Feature Highlights --}}
        <div class="pt-6 flex flex-wrap justify-center gap-4 text-xs font-bold">
            <div class="px-4 py-2 rounded-xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center gap-2">
                <i class="fa-solid fa-calendar-check text-lime-400"></i>
                <span>Berdiri Sejak Juli 2014</span>
            </div>
            <div class="px-4 py-2 rounded-xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center gap-2">
                <i class="fa-solid fa-stamp text-lime-400"></i>
                <span>SK Kemenkumham Resmi</span>
            </div>
            <div class="px-4 py-2 rounded-xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center gap-2">
                <i class="fa-solid fa-certificate text-lime-400"></i>
                <span>Terakreditasi B Sejak 2022</span>
            </div>
        </div>
    </div>
</section>


{{-- ================= 6. SECTION PREVIEW GALERI ================= --}}
<section class="py-20 bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
            <div>
                <span class="text-xs font-extrabold text-green-700 uppercase tracking-widest bg-green-100 px-3 py-1 rounded-full border border-green-200">
                    Aktivitas & Keceriaan
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-gray-900 mt-2">
                    Galeri Kegiatan Terkini
                </h2>
                <p class="text-sm text-gray-600 mt-1">
                    Dokumentasi momen berharga dan suasana belajar ceria anak-anak di RA Al Musyaffallah.
                </p>
            </div>
            <div>
                <a href="{{ route('galeri') }}" 
                   class="inline-flex items-center gap-2 text-sm font-extrabold text-green-700 hover:text-green-800 bg-green-50 hover:bg-green-100 px-5 py-2.5 rounded-xl transition">
                    <span>Lihat Semua Dokumentasi</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>

        {{-- Galeri Grid Preview --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse($galeris as $item)
                <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-1 transition duration-300 group">
                    <div class="overflow-hidden rounded-xl h-56 relative bg-gray-200">
                        <img src="{{ asset('storage/'.$item->gambar) }}" 
                             alt="{{ $item->judul }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                            <span class="px-3 py-1.5 bg-white/90 text-gray-900 text-xs font-bold rounded-lg shadow">
                                <i class="fa-solid fa-magnifying-glass-plus mr-1"></i> Perbesar
                            </span>
                        </div>
                    </div>
                    <p class="text-center mt-3 font-bold text-gray-800 text-sm group-hover:text-green-700 transition">
                        {{ $item->judul }}
                    </p>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                    <i class="fa-solid fa-camera-retro text-3xl text-gray-400 mb-2"></i>
                    <p class="text-sm font-bold text-gray-500">Belum ada foto galeri yang diunggah.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>


{{-- ================= 7. SECTION KONTAK & LOKASI ================= --}}
<section id="kontak" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-14 space-y-3">
            <span class="text-xs font-extrabold text-green-700 uppercase tracking-widest bg-green-100 px-3 py-1 rounded-full border border-green-200">
                Informasi & Layanan
            </span>
            <h2 class="text-3xl sm:text-4xl font-black text-gray-900">
                Hubungi Kami & Kunjungi Sekolah
            </h2>
            <p class="text-sm sm:text-base text-gray-600">
                Pintu kami selalu terbuka untuk para orang tua yang ingin berkonsultasi mengenai pendidikan putra-putrinya.
            </p>
            <div class="w-16 h-1 bg-green-600 mx-auto rounded-full mt-3"></div>
        </div>

        <div class="grid lg:grid-cols-12 gap-8 items-stretch">
            
            {{-- Kartu Info Kontak --}}
            <div class="lg:col-span-5 bg-white p-8 rounded-3xl border border-gray-200 shadow-sm flex flex-col justify-between space-y-6">
                <div>
                    <h3 class="text-xl font-black text-gray-900 mb-6 flex items-center gap-2.5">
                        <i class="fa-solid fa-address-book text-green-600"></i>
                        <span>Kontak Resmi Sekolah</span>
                    </h3>

                    <div class="space-y-5 text-sm">
                        {{-- Alamat --}}
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-green-50 text-green-700 flex items-center justify-center flex-shrink-0 font-bold border border-green-100">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <span class="block text-xs font-bold text-gray-400 uppercase">Alamat Kampus:</span>
                                <p class="text-gray-800 font-medium leading-relaxed mt-0.5">
                                    Jl. PU Rancahan RT 10/02, Desa Gabuswetan, Kec. Gabuswetan, Kab. Indramayu, Jawa Barat (Sebelah Barat Musholla Al Musyaffallah)
                                </p>
                            </div>
                        </div>

                        {{-- Jam Operasional --}}
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center flex-shrink-0 font-bold border border-emerald-100">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <div>
                                <span class="block text-xs font-bold text-gray-400 uppercase">Jam Belajar / Pelayanan:</span>
                                <p class="text-gray-800 font-semibold mt-0.5">
                                    Senin - Jumat : 07.30 - 11.00 WIB
                                </p>
                                <span class="text-xs text-gray-500">Sabtu, Minggu & Hari Libur Nasional Tutup</span>
                            </div>
                        </div>

                        {{-- WhatsApp --}}
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-lime-50 text-lime-700 flex items-center justify-center flex-shrink-0 font-bold border border-lime-100">
                                <i class="fa-brands fa-whatsapp text-lg"></i>
                            </div>
                            <div>
                                <span class="block text-xs font-bold text-gray-400 uppercase">Layanan Informasi PPDB (WhatsApp):</span>
                                <a href="https://wa.me/6281234567890?text=Halo%20Admin%20RA%20Al%20Musyaffallah,%20saya%20ingin%20bertanya%20seputar%20pendaftaran%20siswa%20baru." 
                                   target="_blank" rel="noopener noreferrer" 
                                   class="text-green-700 hover:text-green-800 font-bold underline-offset-2 hover:underline block mt-0.5">
                                    +62 812-3456-7890 (Chat Admin)
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Direct WhatsApp Button --}}
                <div class="pt-4 border-t border-gray-100">
                    <a href="https://wa.me/6281234567890?text=Assalamu'alaikum%20Admin%20RA%20Al%20Musyaffallah,%20saya%20ingin%20konsultasi%20pendaftaran%20siswa%20baru." 
                       target="_blank" rel="noopener noreferrer"
                       class="w-full inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-2xl shadow-md hover:shadow-lg transition">
                        <i class="fa-brands fa-whatsapp text-lg"></i>
                        <span>Kirim Pesan WhatsApp Sekarang</span>
                    </a>
                </div>
            </div>

            {{-- Kartu Peta Google Maps Embed --}}
            <div class="lg:col-span-7 bg-white p-4 rounded-3xl border border-gray-200 shadow-sm flex flex-col">
                <div class="p-4 flex items-center justify-between">
                    <div>
                        <h4 class="font-black text-gray-900 text-base">Lokasi RA Al Musyaffallah di Peta</h4>
                        <p class="text-xs text-gray-500">Gabuswetan, Kabupaten Indramayu, Jawa Barat</p>
                    </div>
                    <a href="https://maps.google.com/?q=Gabuswetan+Indramayu" 
                       target="_blank" rel="noopener noreferrer"
                       class="text-xs font-bold text-green-700 hover:text-green-800 bg-green-50 px-3 py-1.5 rounded-lg border border-green-200">
                        <i class="fa-solid fa-arrow-up-right-from-square mr-1"></i> Buka Google Maps
                    </a>
                </div>

                {{-- Responsive Embed Iframe --}}
                <div class="w-full flex-1 min-h-[300px] rounded-2xl overflow-hidden border border-gray-200 relative">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15858.940733857502!2d108.204567!3d-6.428137!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6ec84d85a109bf%3A0x401e8f1fc28c6e0!2sGabuswetan%2C%20Indramayu%20Regency%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" 
                        class="w-full h-full min-h-[320px] border-0" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

        </div>

    </div>
</section>


{{-- ================= 8. SECTION CTA PPDB BANNER ================= --}}
<section class="py-16 bg-gradient-to-r from-green-800 via-emerald-800 to-green-900 text-white relative overflow-hidden">
    {{-- Glow accents --}}
    <div class="absolute top-0 right-0 w-80 h-80 bg-lime-400/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-emerald-400/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-8 text-center lg:text-left">
            <div class="space-y-3 max-w-2xl">
                <span class="px-3.5 py-1 bg-lime-400 text-green-950 text-xs font-black rounded-full uppercase tracking-wider">
                    Kuota Terbatas Tahun Ajaran 2026/2027
                </span>
                <h2 class="text-3xl sm:text-4xl font-black tracking-tight leading-tight">
                    Siapkan Masa Depan Gemilang Buah Hati Bersama Kami
                </h2>
                <p class="text-sm sm:text-base text-green-100 font-medium">
                    Daftarkan putra-putri tercinta sekarang secara online atau kunjungi langsung kampus RA Al Musyaffallah.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 flex-shrink-0">
                <a href="{{ route('pendaftaran.form') }}" 
                   class="px-8 py-4 bg-lime-400 hover:bg-lime-300 text-green-950 font-black rounded-2xl shadow-xl hover:scale-105 transition duration-200 text-sm sm:text-base">
                    <i class="fa-solid fa-pen-to-square mr-1.5"></i> Formulir Pendaftaran Online
                </a>
                <a href="{{ route('pendaftaran.panduan') }}" 
                   class="px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-bold rounded-2xl border border-white/20 backdrop-blur-md transition duration-200 text-sm sm:text-base">
                    <i class="fa-solid fa-book-open mr-1.5"></i> Panduan & Syarat
                </a>
            </div>
        </div>
    </div>
</section>


{{-- ================= 9. FOOTER ================= --}}
@include('layouts.footer')

@endsection