@extends('layouts.app')

@section('content')

<section class="bg-gray-50 min-h-screen px-6 py-12">

    <div class="text-center mb-12">
        <h1 class="text-4xl font-black text-gray-800">
            Panduan Pendaftaran
        </h1>

        <p class="text-gray-500 mt-2">
            Ikuti langkah-langkah berikut untuk melakukan pendaftaran peserta didik baru secara online.
        </p>
    </div>

    <div class="max-w-4xl mx-auto space-y-5">

        @foreach([
            "Buka website PPDB RA Al Musyaffallah kemudian pilih menu Daftar Sekarang.",
            "Isi seluruh data calon peserta didik dengan lengkap dan benar sesuai dokumen yang dimiliki.",
            "Lengkapi data orang tua atau wali serta masukkan alamat email dan nomor WhatsApp yang masih aktif.",
            "Unggah seluruh dokumen persyaratan sesuai ketentuan yang berlaku.",
            "Periksa kembali seluruh data yang telah diisi untuk memastikan tidak ada kesalahan.",
            "Klik tombol Kirim Pendaftaran untuk mengirim formulir kepada pihak sekolah.",
            "Setelah berhasil dikirim, status pendaftaran akan berubah menjadi Menunggu Verifikasi.",
            "Admin sekolah akan memeriksa kelengkapan data dan dokumen yang telah dikirim.",
            "Hasil verifikasi akan dikirimkan melalui Email dan/atau WhatsApp yang telah didaftarkan.",
            "Apabila dinyatakan diterima, orang tua/wali dapat melakukan daftar ulang sesuai jadwal yang ditentukan oleh pihak sekolah."
        ] as $i => $langkah)

        <div class="flex items-start gap-4 bg-white p-5 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition">

            <div class="w-10 h-10 flex items-center justify-center bg-green-600 text-white rounded-full font-bold flex-shrink-0">
                {{ $i + 1 }}
            </div>

            <p class="text-gray-700 leading-relaxed">
                {{ $langkah }}
            </p>

        </div>

        @endforeach

    </div>

    {{-- Informasi --}}
    <div class="max-w-4xl mx-auto mt-10">

        <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-xl p-6">

            <h3 class="font-bold text-yellow-700 text-lg mb-3">
                📢 Informasi Penting
            </h3>

            <ul class="list-disc ml-5 space-y-2 text-gray-700">

                <li>Pendaftaran dilakukan secara online tanpa perlu membuat akun atau login.</li>

                <li>Pastikan alamat email dan nomor WhatsApp yang diisi masih aktif.</li>

                <li>Status pendaftaran akan diberitahukan melalui Email dan/atau WhatsApp setelah proses verifikasi selesai.</li>

                <li>Apabila dinyatakan diterima, calon peserta didik wajib melakukan daftar ulang sesuai jadwal yang telah ditentukan.</li>

                <li>Kesalahan dalam pengisian data menjadi tanggung jawab pendaftar.</li>

            </ul>

        </div>

    </div>

    {{-- Button --}}
    <div class="text-center mt-10">

        <a href="{{ route('pendaftaran.form') }}"
           class="bg-green-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-green-700 transition">

            Daftar Sekarang

        </a>

    </div>

</section>

@endsection