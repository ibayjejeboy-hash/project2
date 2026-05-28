@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6">Informasi Sekolah</h2>

@if(session('success'))
<div class="bg-green-200 text-green-800 p-3 rounded mb-4">
{{ session('success') }}
</div>
@endif

<form action="{{ route('admin.informasi.store') }}" 
method="POST" 
enctype="multipart/form-data"
class="bg-white p-6 rounded-xl shadow">
@csrf

<div class="mb-4">
<label class="block font-bold mb-2">Visi</label>
<textarea id="visi" name="visi" rows="3" class="w-full border p-2 rounded bg-gray-100" readonly>{{ $informasi->visi ?? '' }}</textarea>
</div>

<div class="mb-4">
<label class="block font-bold mb-2">Misi</label>
<textarea id="misi" name="misi" rows="4" class="w-full border p-2 rounded bg-gray-100" readonly>{{ $informasi->misi ?? '' }}</textarea>
</div>

<div class="mb-4">
<label class="block font-bold mb-2">Deskripsi</label>
<textarea id="deskripsi" name="deskripsi" rows="4" class="w-full border p-2 rounded bg-gray-100" readonly>{{ $informasi->deskripsi ?? '' }}</textarea>
</div>

<div class="mb-4">
<label class="block font-bold mb-2">Foto</label>

@if(!empty($informasi->foto))
<img src="{{ asset('storage/'.$informasi->foto) }}" class="w-40 mb-3 rounded">
@endif

<input type="file" id="foto" name="foto" class="w-full border p-2 rounded bg-gray-100" disabled>
</div>

<div class="flex gap-3">

<button type="button" onclick="enableEdit()" class="bg-blue-500 text-white px-6 py-2 rounded">
Edit
</button>

<button id="saveBtn" class="bg-green-600 text-white px-6 py-2 rounded hidden">
Simpan
</button>

</div>

</form>

<script>

function enableEdit(){

document.getElementById('visi').removeAttribute('readonly')
document.getElementById('misi').removeAttribute('readonly')
document.getElementById('deskripsi').removeAttribute('readonly')

document.getElementById('foto').removeAttribute('disabled')

document.getElementById('saveBtn').classList.remove('hidden')

}

</script>

@endsection