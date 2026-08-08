@extends('layouts.app')

@section('title', 'Formulir Pendaftaran Siswa Baru - RA Al Musyaffallah')

@section('content')

@include('layouts.navbar')

<section class="bg-gray-50 min-h-screen py-12 px-4 sm:px-6 lg:px-8">

    <div class="max-w-5xl mx-auto bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">

        {{-- Header --}}
        <div class="bg-green-600 text-white rounded-t-2xl px-8 py-6">
            <h1 class="text-3xl font-bold">
                Formulir Pendaftaran Peserta Didik Baru
            </h1>
            <p class="mt-2 text-green-100">
                Silakan lengkapi seluruh data dengan benar sesuai dokumen yang dimiliki.
            </p>
        </div>

        <form action="{{ route('pendaftaran.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="p-8">

            @csrf

            {{-- ========================= --}}
            {{-- DATA CALON PESERTA DIDIK --}}
            {{-- ========================= --}}

            <h2 class="text-xl font-bold text-green-700 border-b pb-2 mb-5">
                Data Calon Peserta Didik
            </h2>

            <div class="grid md:grid-cols-2 gap-5">

                <div>
                    <label class="font-semibold">Nama Lengkap Anak <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_anak"
                        class="w-full mt-2 border rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="font-semibold">Jenis Kelamin</label>

                    <select name="jenis_kelamin"
                        class="w-full mt-2 border rounded-lg px-4 py-2">

                        <option value="">-- Pilih --</option>
                        <option>Laki-laki</option>
                        <option>Perempuan</option>

                    </select>
                </div>

                <div>
                    <label class="font-semibold">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir"
                        class="w-full mt-2 border rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="font-semibold">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir"
                        class="w-full mt-2 border rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="font-semibold">Kelompok</label>

                    <select name="kelompok"
                        class="w-full mt-2 border rounded-lg px-4 py-2">

                        <option value="">-- Pilih Kelompok --</option>
                        <option>Kelompok A (4-5 Tahun)</option>
                        <option>Kelompok B (5-6 Tahun)</option>

                    </select>

                </div>

                <div>
                    <label class="font-semibold">NIK Anak</label>
                    <input type="text" name="nik"
                        class="w-full mt-2 border rounded-lg px-4 py-2">
                </div>

            </div>

            {{-- ========================= --}}
            {{-- DATA ORANG TUA --}}
            {{-- ========================= --}}

            <h2 class="text-xl font-bold text-green-700 border-b pb-2 mt-10 mb-5">
                Data Orang Tua / Wali
            </h2>

            <div class="grid md:grid-cols-2 gap-5">

                <div>
                    <label class="font-semibold">Nama Ayah</label>
                    <input type="text" name="ayah"
                        class="w-full mt-2 border rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="font-semibold">Nama Ibu</label>
                    <input type="text" name="ibu"
                        class="w-full mt-2 border rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="font-semibold">Nomor WhatsApp</label>
                    <input type="text" name="whatsapp"
                        placeholder="08xxxxxxxxxx"
                        class="w-full mt-2 border rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="font-semibold">Email Aktif</label>
                    <input type="email" name="email"
                        class="w-full mt-2 border rounded-lg px-4 py-2">
                </div>

            </div>

            {{-- ========================= --}}
            {{-- ALAMAT --}}
            {{-- ========================= --}}

            <h2 class="text-xl font-bold text-green-700 border-b pb-2 mt-10 mb-5">
                Alamat
            </h2>

            <textarea
                name="alamat"
                rows="4"
                class="w-full border rounded-lg px-4 py-3"
                placeholder="Masukkan alamat lengkap"></textarea>

            {{-- ========================= --}}
            {{-- DOKUMEN --}}
            {{-- ========================= --}}

            <h2 class="text-xl font-bold text-green-700 border-b pb-2 mt-10 mb-5">
                Upload Persyaratan
            </h2>

            <div class="grid md:grid-cols-2 gap-5">

                <div>
                    <label class="font-semibold">
                        Akta Kelahiran (PDF/JPG/PNG)
                    </label>

                    <input type="file"
                        name="akta"
                        class="w-full mt-2 border rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="font-semibold">
                        Kartu Keluarga
                    </label>

                    <input type="file"
                        name="kk"
                        class="w-full mt-2 border rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="font-semibold">
                        KTP Orang Tua
                    </label>

                    <input type="file"
                        name="ktp"
                        class="w-full mt-2 border rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="font-semibold">
                        Pas Foto 3x4
                    </label>

                    <input type="file"
                        name="foto"
                        class="w-full mt-2 border rounded-lg px-4 py-2">
                </div>

            </div>

            {{-- Informasi --}}
            <div class="mt-10 bg-yellow-50 border-l-4 border-yellow-500 rounded-xl p-5">

                <h3 class="font-bold text-yellow-700">
                    Informasi
                </h3>

                <ul class="list-disc ml-5 mt-3 text-gray-700 space-y-2">

                    <li>Pastikan data yang diisi sesuai dengan dokumen resmi.</li>

                    <li>Email dan WhatsApp wajib aktif karena hasil seleksi akan dikirim melalui media tersebut.</li>

                    <li>Setelah formulir dikirim, status pendaftaran menjadi <strong>Menunggu Verifikasi</strong>.</li>

                </ul>

            </div>

            <button
                class="w-full mt-8 bg-green-600 hover:bg-green-700 text-white py-4 rounded-xl font-bold text-lg">

                Kirim Pendaftaran

            </button>

        </form>

    </div>

</section>

@include('layouts.footer')

@endsection