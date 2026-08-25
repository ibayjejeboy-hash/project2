@extends('layouts.app')

@section('title', 'Formulir Pendaftaran Siswa Baru - RA Al Musyaffallah')

@section('content')

@include('layouts.navbar')

<section class="bg-slate-50 min-h-screen py-12 px-4 sm:px-6 lg:px-8">

    <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">

        {{-- Header Banner --}}
        <div class="bg-gradient-to-r from-green-700 via-emerald-600 to-green-800 text-white p-8 sm:p-10 relative overflow-hidden">
            <div class="relative z-10">
                <span class="px-3.5 py-1.5 bg-white/20 backdrop-blur-md rounded-full text-xs font-black uppercase tracking-wider text-green-50 border border-white/30 inline-block mb-3">
                    PPDB TA 2026/2027
                </span>
                <h1 class="text-2xl sm:text-4xl font-black tracking-tight">
                    Formulir Pendaftaran Siswa Baru
                </h1>
                <p class="mt-2 text-xs sm:text-sm text-green-100 max-w-xl font-medium leading-relaxed">
                    Lengkapi seluruh data identitas calon siswa dan data orang tua/wali dengan teliti dan benar.
                </p>
            </div>
            <div class="absolute -right-10 -bottom-10 w-44 h-44 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
        </div>

        {{-- Alerts --}}
        <div class="p-6 sm:p-8 pb-0">
            @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 p-4 rounded-2xl flex items-start gap-3 shadow-sm mb-6 animate-fade-in">
                <i class="fa-solid fa-circle-check text-green-600 text-lg mt-0.5"></i>
                <div class="text-xs sm:text-sm font-medium leading-relaxed">
                    <strong class="font-bold block text-green-900 mb-0.5">Pendaftaran Berhasil!</strong>
                    {{ session('success') }}
                </div>
            </div>
            @endif

            @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-2xl shadow-sm mb-6">
                <div class="flex items-center gap-2 font-bold text-red-900 text-xs sm:text-sm mb-2">
                    <i class="fa-solid fa-triangle-exclamation text-red-600"></i>
                    <span>Terdapat beberapa isian yang belum lengkap atau keliru:</span>
                </div>
                <ul class="list-disc ml-5 text-xs text-red-700 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        <form action="{{ route('pendaftaran.store') }}"
              method="POST"
              class="p-6 sm:p-8 pt-4 space-y-8">
            @csrf

            {{-- ========================= --}}
            {{-- DATA CALON PESERTA DIDIK --}}
            {{-- ========================= --}}
            <div>
                <div class="flex items-center gap-2.5 border-b border-slate-100 pb-3 mb-6">
                    <span class="w-8 h-8 rounded-xl bg-green-100 text-green-800 font-black text-sm flex items-center justify-center">1</span>
                    <div>
                        <h2 class="text-base sm:text-lg font-black text-slate-900">Data Calon Siswa</h2>
                        <p class="text-xs text-slate-500 font-medium">Informasi identitas anak sesuai Akta Kelahiran</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    {{-- Nama Anak --}}
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            Nama Lengkap Anak <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_anak" required
                            value="{{ old('nama_anak') }}"
                            placeholder="Contoh: Muhammad Rayhan Al-Fatih"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none text-xs sm:text-sm font-medium transition">
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            Jenis Kelamin
                        </label>
                        <select name="jenis_kelamin"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none text-xs sm:text-sm font-medium transition bg-white cursor-pointer">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    {{-- Pilihan Kelompok --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            Pilihan Kelompok Belajar
                        </label>
                        <select name="kelompok"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none text-xs sm:text-sm font-medium transition bg-white cursor-pointer">
                            <option value="">-- Pilih Kelompok --</option>
                            <option value="Kelompok A (4-5 Tahun)" {{ old('kelompok') == 'Kelompok A (4-5 Tahun)' ? 'selected' : '' }}>Kelompok A (Usia 4-5 Tahun)</option>
                            <option value="Kelompok B (5-6 Tahun)" {{ old('kelompok') == 'Kelompok B (5-6 Tahun)' ? 'selected' : '' }}>Kelompok B (Usia 5-6 Tahun)</option>
                        </select>
                    </div>

                    {{-- Tempat Lahir --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            Tempat Lahir
                        </label>
                        <input type="text" name="tempat_lahir"
                            value="{{ old('tempat_lahir') }}"
                            placeholder="Contoh: Indramayu"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none text-xs sm:text-sm font-medium transition">
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            Tanggal Lahir <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tgl_lahir" required
                            value="{{ old('tgl_lahir') }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none text-xs sm:text-sm font-medium transition">
                    </div>
                </div>
            </div>

            {{-- ========================= --}}
            {{-- DATA ORANG TUA / WALI --}}
            {{-- ========================= --}}
            <div>
                <div class="flex items-center gap-2.5 border-b border-slate-100 pb-3 mb-6">
                    <span class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-800 font-black text-sm flex items-center justify-center">2</span>
                    <div>
                        <h2 class="text-base sm:text-lg font-black text-slate-900">Data Orang Tua / Wali</h2>
                        <p class="text-xs text-slate-500 font-medium">Kontak aktif untuk pemberitahuan kelulusan dan verifikasi</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    {{-- Nama Ayah --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            Nama Ayah <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="ayah" required
                            value="{{ old('ayah') }}"
                            placeholder="Nama lengkap ayah"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none text-xs sm:text-sm font-medium transition">
                    </div>

                    {{-- Nama Ibu --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            Nama Ibu
                        </label>
                        <input type="text" name="ibu"
                            value="{{ old('ibu') }}"
                            placeholder="Nama lengkap ibu"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none text-xs sm:text-sm font-medium transition">
                    </div>

                    {{-- WhatsApp --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            Nomor WhatsApp Aktif <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" name="whatsapp" required
                                value="{{ old('whatsapp') }}"
                                placeholder="Contoh: 089524810777"
                                class="w-full px-4 py-3 pl-10 rounded-xl border border-slate-200 focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none text-xs sm:text-sm font-medium transition">
                            <i class="fa-brands fa-whatsapp text-green-600 absolute left-3.5 top-1/2 -translate-y-1/2 text-base"></i>
                        </div>
                        <span class="text-[11px] text-slate-400 font-medium mt-1 block">Hasil verifikasi akan dikonfirmasi via WhatsApp</span>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">
                            Email (Opsional)
                        </label>
                        <input type="email" name="email"
                            value="{{ old('email') }}"
                            placeholder="orangtua@email.com"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none text-xs sm:text-sm font-medium transition">
                    </div>
                </div>
            </div>

            {{-- ========================= --}}
            {{-- ALAMAT LENGKAP --}}
            {{-- ========================= --}}
            <div>
                <div class="flex items-center gap-2.5 border-b border-slate-100 pb-3 mb-6">
                    <span class="w-8 h-8 rounded-xl bg-lime-100 text-lime-800 font-black text-sm flex items-center justify-center">3</span>
                    <div>
                        <h2 class="text-base sm:text-lg font-black text-slate-900">Alamat Domisili</h2>
                        <p class="text-xs text-slate-500 font-medium">Alamat tempat tinggal tempat anak berdomisili</p>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">
                        Alamat Lengkap (RT/RW, Desa/Kelurahan, Kecamatan, Kab/Kota) <span class="text-red-500">*</span>
                    </label>
                    <textarea name="alamat" rows="3" required
                        placeholder="Contoh: Blok Sukatani RT 02 / RW 01, Desa Gabuswetan, Kec. Gabuswetan, Kab. Indramayu"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-green-600 focus:ring-2 focus:ring-green-100 outline-none text-xs sm:text-sm font-medium transition leading-relaxed">{{ old('alamat') }}</textarea>
                </div>
            </div>

            {{-- Callout Box Info --}}
            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-5 flex items-start gap-3">
                <i class="fa-solid fa-circle-info text-amber-600 text-base mt-0.5"></i>
                <div class="space-y-1 text-xs text-amber-900 font-medium leading-relaxed">
                    <strong class="font-bold block text-amber-950">Catatan Penting:</strong>
                    <ul class="list-disc ml-4 space-y-0.5">
                        <li>Pastikan nomor WhatsApp yang didaftarkan aktif untuk menerima pesan konfirmasi.</li>
                        <li>Berkas fisik (Akta, KK, KTP) dapat diserahkan ke sekretariat RA saat jadwal orientasi / daftar ulang.</li>
                    </ul>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                <a href="{{ route('pendaftaran') }}"
                   class="text-xs font-bold text-slate-500 hover:text-slate-700 transition">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Info PPDB
                </a>

                <button type="submit"
                    class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white font-black rounded-2xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition text-sm flex items-center justify-center gap-2">
                    <i class="fa-solid fa-paper-plane"></i>
                    <span>Kirim Formulir Pendaftaran</span>
                </button>
            </div>

        </form>

    </div>

</section>

@include('layouts.footer')

@endsection