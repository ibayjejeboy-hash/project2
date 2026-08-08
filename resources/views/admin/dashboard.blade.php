@extends('layouts.admin')

@section('title', 'Dashboard Administrator - RA Al Musyaffallah')
@section('page_title', 'Dashboard')

@section('content')

<div class="space-y-8">

    {{-- ================= 1. WELCOME BANNER ================= --}}
    <div class="relative bg-gradient-to-r from-slate-900 via-green-950 to-emerald-900 rounded-3xl p-6 sm:p-8 text-white shadow-xl overflow-hidden">
        {{-- Background Glow --}}
        <div class="absolute top-0 right-0 w-80 h-80 bg-lime-400/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-1/3 w-64 h-64 bg-emerald-500/10 rounded-full blur-2xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/10 backdrop-blur-md rounded-full text-xs font-bold text-lime-400 border border-white/10">
                    <span class="w-2 h-2 rounded-full bg-lime-400 animate-ping"></span>
                    <span>Sistem Aktif & Terlindungi</span>
                </div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black tracking-tight">
                    Selamat Datang, {{ Auth::user()->name ?? 'Administrator' }}! 👋
                </h1>
                <p class="text-xs sm:text-sm text-slate-300 font-medium max-w-2xl leading-relaxed">
                    Kelola seluruh data akademik, administrasi guru, dokumentasi galeri, dan penerimaan siswa baru (PPDB) RA Al Musyaffallah dalam satu panel terintegrasi.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3 flex-shrink-0">
                <a href="{{ route('admin.siswa') }}" 
                   class="inline-flex items-center gap-2 px-5 py-3 bg-lime-400 hover:bg-lime-300 text-slate-950 font-black rounded-2xl shadow-lg transition duration-200 text-xs sm:text-sm">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tambah Siswa</span>
                </a>
                <a href="{{ route('admin.pendaftaran') }}" 
                   class="inline-flex items-center gap-2 px-5 py-3 bg-white/10 hover:bg-white/20 text-white font-bold rounded-2xl border border-white/20 backdrop-blur-md transition duration-200 text-xs sm:text-sm">
                    <i class="fa-solid fa-file-lines text-lime-400"></i>
                    <span>Cek PPDB</span>
                </a>
            </div>
        </div>
    </div>


    {{-- ================= 2. METRIC STAT CARDS ================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        
        {{-- Card 1: Total Siswa --}}
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Total Siswa Aktif</span>
                    <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $totalSiswa }}</h3>
                    <p class="text-xs text-emerald-600 font-bold mt-1 flex items-center gap-1">
                        <i class="fa-solid fa-circle-check text-[10px]"></i> Terdaftar di Sistem
                    </p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-green-600 to-emerald-500 text-white flex items-center justify-center text-2xl shadow-lg shadow-green-600/20 group-hover:scale-110 transition duration-300">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <a href="{{ route('admin.siswa') }}" class="font-bold text-green-700 hover:text-green-800 flex items-center gap-1">
                    <span>Lihat Semua Siswa</span>
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </div>

        {{-- Card 2: Total Guru --}}
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Tenaga Pendidik</span>
                    <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $totalGuru }}</h3>
                    <p class="text-xs text-blue-600 font-bold mt-1 flex items-center gap-1">
                        <i class="fa-solid fa-user-tie text-[10px]"></i> Guru & Ustadzah
                    </p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-blue-600 to-cyan-500 text-white flex items-center justify-center text-2xl shadow-lg shadow-blue-600/20 group-hover:scale-110 transition duration-300">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <a href="{{ route('admin.guru') }}" class="font-bold text-blue-700 hover:text-blue-800 flex items-center gap-1">
                    <span>Kelola Data Guru</span>
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </div>

        {{-- Card 3: Pendaftar PPDB --}}
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Pendaftar PPDB</span>
                    <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $totalPendaftaran }}</h3>
                    <p class="text-xs text-amber-600 font-bold mt-1 flex items-center gap-1">
                        <i class="fa-solid fa-clock text-[10px]"></i> Calon Peserta Didik
                    </p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-amber-500 to-yellow-400 text-white flex items-center justify-center text-2xl shadow-lg shadow-amber-500/20 group-hover:scale-110 transition duration-300">
                    <i class="fa-solid fa-file-signature"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <a href="{{ route('admin.pendaftaran') }}" class="font-bold text-amber-700 hover:text-amber-800 flex items-center gap-1">
                    <span>Verifikasi Berkas</span>
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </div>

        {{-- Card 4: Galeri --}}
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-xs font-extrabold text-slate-400 uppercase tracking-wider">Galeri Dokumentasi</span>
                    <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $totalGaleri }}</h3>
                    <p class="text-xs text-purple-600 font-bold mt-1 flex items-center gap-1">
                        <i class="fa-solid fa-image text-[10px]"></i> Foto Kegiatan Publik
                    </p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-purple-600 to-pink-500 text-white flex items-center justify-center text-2xl shadow-lg shadow-purple-600/20 group-hover:scale-110 transition duration-300">
                    <i class="fa-solid fa-images"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <a href="{{ route('admin.galeri') }}" class="font-bold text-purple-700 hover:text-purple-800 flex items-center gap-1">
                    <span>Unggah Dokumentasi</span>
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </div>

    </div>


    {{-- ================= 3. QUICK ACTIONS & SHORTCUTS ================= --}}
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
        <h3 class="text-sm font-black text-slate-800 uppercase tracking-wider mb-4 flex items-center gap-2">
            <i class="fa-solid fa-bolt text-amber-500"></i>
            <span>Menu Cepat & Pintasan Aksi</span>
        </h3>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3">
            
            <a href="{{ route('admin.siswa') }}" 
               class="p-4 rounded-2xl bg-slate-50 hover:bg-green-50 border border-slate-100 hover:border-green-200 text-slate-700 hover:text-green-800 transition duration-200 flex flex-col items-center text-center group">
                <div class="w-10 h-10 rounded-xl bg-green-100 text-green-700 flex items-center justify-center mb-2 group-hover:scale-110 transition">
                    <i class="fa-solid fa-user-plus"></i>
                </div>
                <span class="text-xs font-bold">Tambah Siswa</span>
            </a>

            <a href="{{ route('admin.guru') }}" 
               class="p-4 rounded-2xl bg-slate-50 hover:bg-blue-50 border border-slate-100 hover:border-blue-200 text-slate-700 hover:text-blue-800 transition duration-200 flex flex-col items-center text-center group">
                <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center mb-2 group-hover:scale-110 transition">
                    <i class="fa-solid fa-person-chalkboard"></i>
                </div>
                <span class="text-xs font-bold">Data Guru</span>
            </a>

            <a href="{{ route('admin.galeri') }}" 
               class="p-4 rounded-2xl bg-slate-50 hover:bg-purple-50 border border-slate-100 hover:border-purple-200 text-slate-700 hover:text-purple-800 transition duration-200 flex flex-col items-center text-center group">
                <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center mb-2 group-hover:scale-110 transition">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                </div>
                <span class="text-xs font-bold">Unggah Foto</span>
            </a>

            <a href="{{ route('admin.informasi') }}" 
               class="p-4 rounded-2xl bg-slate-50 hover:bg-amber-50 border border-slate-100 hover:border-amber-200 text-slate-700 hover:text-amber-800 transition duration-200 flex flex-col items-center text-center group">
                <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center mb-2 group-hover:scale-110 transition">
                    <i class="fa-solid fa-bullhorn"></i>
                </div>
                <span class="text-xs font-bold">Visi & Misi</span>
            </a>

            <a href="{{ route('admin.user') }}" 
               class="p-4 rounded-2xl bg-slate-50 hover:bg-emerald-50 border border-slate-100 hover:border-emerald-200 text-slate-700 hover:text-emerald-800 transition duration-200 flex flex-col items-center text-center group col-span-2 sm:col-span-1">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center mb-2 group-hover:scale-110 transition">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <span class="text-xs font-bold">Kelola Akun</span>
            </a>

        </div>
    </div>


    {{-- ================= 4. RECENT REGISTRATIONS & CLASS DISTRIBUTION ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        {{-- Recent Pendaftaran Table (Left 8 Cols) --}}
        <div class="lg:col-span-8 bg-white p-6 sm:p-7 rounded-3xl border border-slate-100 shadow-sm space-y-5">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-base font-black text-slate-900">Pendaftar PPDB Terbaru</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Daftar calon peserta didik yang mendaftar secara online.</p>
                </div>
                <a href="{{ route('admin.pendaftaran') }}" 
                   class="text-xs font-bold text-green-700 hover:text-green-800 bg-green-50 px-3.5 py-2 rounded-xl transition flex items-center gap-1.5">
                    <span>Lihat Semua</span>
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 font-extrabold uppercase tracking-wider border-y border-slate-100">
                            <th class="py-3 px-4 rounded-l-xl">Nama Anak</th>
                            <th class="py-3 px-4">Nama Orang Tua</th>
                            <th class="py-3 px-4">Jenis Kelamin</th>
                            <th class="py-3 px-4">Tanggal Daftar</th>
                            <th class="py-3 px-4 rounded-r-xl text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                        @forelse($recentPendaftaran as $item)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3.5 px-4 font-bold text-slate-900">
                                {{ $item->nama_anak }}
                            </td>
                            <td class="py-3.5 px-4 text-slate-600">
                                {{ $item->nama_ayah ?? $item->nama_ibu ?? '-' }}
                            </td>
                            <td class="py-3.5 px-4">
                                @if($item->jenis_kelamin == 'Laki-laki')
                                    <span class="inline-flex items-center gap-1 text-blue-700 bg-blue-50 px-2 py-0.5 rounded-md font-semibold text-[11px]">
                                        <i class="fa-solid fa-mars"></i> L
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-pink-700 bg-pink-50 px-2 py-0.5 rounded-md font-semibold text-[11px]">
                                        <i class="fa-solid fa-venus"></i> P
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-slate-500 text-[11px]">
                                {{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-amber-100 text-amber-800 border border-amber-200">
                                    Menunggu
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400 font-semibold">
                                <i class="fa-solid fa-inbox text-2xl mb-1 block"></i>
                                Belum ada pendaftar baru saat ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Class Distribution & System Info (Right 4 Cols) --}}
        <div class="lg:col-span-4 space-y-6">
            
            {{-- Class Card --}}
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-black text-slate-800 uppercase tracking-wider flex items-center gap-2">
                        <i class="fa-solid fa-school text-green-600"></i>
                        <span>Rombongan Belajar</span>
                    </h3>
                    <a href="{{ route('admin.kelas') }}" class="text-[11px] font-bold text-green-700 hover:text-green-800 flex items-center gap-1">
                        <span>Kelola</span>
                        <i class="fa-solid fa-arrow-right text-[9px]"></i>
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse($kelasList as $kelas)
                    <div class="p-3.5 bg-slate-50 rounded-2xl border border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="block font-bold text-slate-900 text-sm">{{ $kelas->nama_kelas }}</span>
                            <span class="block text-xs text-slate-500">
                                Wali: {{ $kelas->waliKelas->name ?? 'Belum Ditentukan' }}
                            </span>
                        </div>
                        <span class="px-3 py-1 bg-green-100 text-green-800 font-black rounded-xl text-xs">
                            {{ $kelas->siswa_count ?? 0 }} Siswa
                        </span>
                    </div>
                    @empty
                    <p class="text-xs text-slate-400 text-center py-3">Data kelas belum tersedia.</p>
                    @endforelse
                </div>
            </div>

            {{-- System Details Card --}}
            <div class="bg-gradient-to-br from-slate-900 to-slate-950 p-6 rounded-3xl text-white shadow-md border border-slate-800 space-y-3">
                <div class="flex items-center gap-2.5">
                    <img src="{{ asset('assets/images/1001230752.jpg - Edited.png') }}" 
                         alt="Logo RA" class="w-8 h-8 object-contain bg-white/10 p-1 rounded-lg">
                    <div>
                        <span class="block text-xs font-black text-lime-400 uppercase tracking-wider">RA Al Musyaffallah</span>
                        <span class="block text-[11px] text-slate-400">Gabuswetan, Indramayu</span>
                    </div>
                </div>

                <div class="text-xs text-slate-300 space-y-1.5 pt-2 border-t border-slate-800">
                    <div class="flex justify-between">
                        <span class="text-slate-400">Status Akreditasi:</span>
                        <strong class="text-white font-bold">Terakreditasi B</strong>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Kurikulum:</span>
                        <strong class="text-white font-bold">Merdeka PAUD</strong>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-400">Tahun Ajaran:</span>
                        <strong class="text-lime-400 font-bold">2025/2026</strong>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection