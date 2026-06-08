@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6">Galeri</h2>

@if(session('success'))
    <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow mb-8">
    @csrf

    <div class="mb-4">
        <label class="block font-bold mb-2">Judul</label>
        <input type="text" name="judul" class="w-full border p-2 rounded" required>
    </div>

    <div class="mb-4">
        <label class="block font-bold mb-2">Upload Gambar</label>
        <input type="file" name="gambar" class="w-full border p-2 rounded" required>
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded">
        Simpan
    </button>
</form>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

    @foreach($galeris as $item)
    <div class="bg-white p-4 rounded-xl shadow">

        <img src="{{ asset('storage/'.$item->gambar) }}" 
             class="w-full h-40 object-cover rounded mb-2">

        {{-- FORM EDIT --}}
        <form action="{{ route('admin.galeri.update', $item->id) }}" 
              method="POST" 
              enctype="multipart/form-data"
              class="mb-3">
            @csrf
            @method('PUT')

            <input type="text" 
                   name="judul" 
                   value="{{ $item->judul }}" 
                   class="w-full border p-2 rounded mb-2">

            <input type="file" 
                   name="gambar" 
                   class="w-full border p-2 rounded mb-2">

            <button class="w-full bg-blue-500 text-white py-1 rounded">
                Update
            </button>
        </form>

        {{-- FORM DELETE --}}
        <form action="{{ route('admin.galeri.destroy', $item->id) }}" 
              method="POST"
              onsubmit="return confirm('Yakin mau hapus?')">
            @csrf
            @method('DELETE')

            <button class="w-full bg-red-500 text-white py-1 rounded">
                Hapus
            </button>
        </form>

    </div>
    @endforeach

</div>

@endsection