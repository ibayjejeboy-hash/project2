@extends('layouts.app')

@section('content')

<section class="bg-gray-50 min-h-screen px-6 py-12">

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-md border">

        <h2 class="text-2xl font-bold mb-6 text-center">
            Form Pendaftaran
        </h2>

        <form action="{{ route('pendaftaran.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="font-semibold">Nama Anak</label>
                <input type="text" name="nama_anak" class="w-full border rounded-lg px-4 py-2">
            </div>

            <div class="mb-4">
                <label class="font-semibold">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="w-full border rounded-lg px-4 py-2">
            </div>

            <div class="mb-4">
                <label class="font-semibold">Nama Orang Tua</label>
                <input type="text" name="nama_ortu" class="w-full border rounded-lg px-4 py-2">
            </div>

            <div class="mb-4">
                <label class="font-semibold">No HP</label>
                <input type="text" name="no_hp" class="w-full border rounded-lg px-4 py-2">
            </div>

            <div class="mb-4">
                <label class="font-semibold">Alamat</label>
                <textarea name="alamat" class="w-full border rounded-lg px-4 py-2"></textarea>
            </div>

            <button class="w-full bg-green-600 text-white py-3 rounded-xl font-bold hover:bg-green-700">
                Kirim Pendaftaran
            </button>

        </form>

    </div>

</section>

@endsection