@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6">Data Siswa</h2>

@if(session('success'))
<div class="bg-green-200 text-green-800 p-3 mb-4 rounded">
    {{ session('success') }}
</div>
@endif

<form action="{{ route('admin.siswa.store') }}" method="POST" enctype="multipart/form-data"
      class="bg-white p-8 rounded-2xl shadow-lg">
@csrf

<h2 class="text-2xl font-bold mb-6">Form Data Siswa</h2>

<div class="grid md:grid-cols-2 gap-6">

    {{-- DATA SISWA --}}
    <div>
    <label class="font-semibold">Nama Lengkap</label>

    <input
        type="text"
        name="nama"
        class="w-full border p-2 rounded mt-1"
        placeholder="Masukkan nama lengkap"
        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
    >
</div>

<div>
    <label class="font-semibold">Nama Panggilan</label>

    <input
        type="text"
        name="nama_panggilan"
        class="w-full border p-2 rounded mt-1"
        placeholder="Masukkan nama panggilan"
        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
    >
</div>

   <div>
    <label class="font-semibold">NISN/NIS</label>

    <input
        type="text"
        name="nis"
        placeholder="Masukkan NIS"
        class="w-full border p-2 rounded mt-1"
        inputmode="numeric"
        pattern="[0-9]*"
        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
    >
</div>

<div>
    <label class="font-semibold">Kelas</label>

    <select name="kelas_id"
        class="w-full border p-2 rounded mt-1">

        <option value="">Pilih Kelas</option>

        @foreach($kelas as $item)

            <option value="{{ $item->id }}">
                {{ $item->nama_kelas }}
            </option>

        @endforeach

    </select>
</div>

    <div>
        <label class="font-semibold">Jenis Kelamin</label>
        <select name="jenis_kelamin" class="w-full border p-2 rounded mt-1">
            <option value="">-- Pilih --</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>
    </div>

    <div>
        <label class="font-semibold">Tempat Lahir</label>
        <input type="text" name="tempat_lahir" class="w-full border p-2 rounded mt-1">
    </div>

    <div>
        <label class="font-semibold">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" class="w-full border p-2 rounded mt-1">
    </div>

    <div>
        <label class="font-semibold">Agama</label>
        <select name="agama" class="w-full border p-2 rounded mt-1">
            <option value="">-- Pilih --</option>
            <option value="Islam">Islam</option>
            <option value="Kristen">Kristen</option>
            <option value="Katolik">Katolik</option>
            <option value="Hindu">Hindu</option>
            <option value="Budha">Budha</option>
        </select>
    </div>

    <div>
        <label class="font-semibold">Anak Ke</label>
        <select name="anak_ke" class="w-full border p-2 rounded mt-1">
            <option value="">-- Pilih --</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>

</div>

<hr class="my-6">

<h3 class="text-xl font-bold mb-4">Data Orang Tua</h3>

<div class="grid md:grid-cols-2 gap-6">

    <div>
        <label class="font-semibold">Nama Ayah</label>
        <input
        type="text"
        name="nama_ayah"
        class="w-full border p-2 rounded mt-1"
        placeholder="Masukkan nama ayah"
        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
    >
    </div>

    <div>
        <label class="font-semibold">Nama Ibu</label>
        <input
        type="text"
        name="nama_ibu"
        class="w-full border p-2 rounded mt-1"
        placeholder="Masukkan nama ibu"
        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
    >
    </div>

    <div>
    <label class="font-semibold">No HP</label>

    <input
        type="text"
        name="no_hp"
        placeholder="08xxxxxxxxxx"
        class="w-full border p-2 rounded mt-1"
        inputmode="numeric"
        pattern="[0-9]*"
        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
    >
</div>

    <div>
        <label class="font-semibold">Email</label>
        <input type="email" name="email" class="w-full border p-2 rounded mt-1">
    </div>

    <div>
        <label class="font-semibold">Pekerjaan Ayah</label>
        <input type="text" name="pekerjaan_ayah" class="w-full border p-2 rounded mt-1">
    </div>

    <div>
        <label class="font-semibold">Pekerjaan Ibu</label>
        <input type="text" name="pekerjaan_ibu" class="w-full border p-2 rounded mt-1">
    </div>


</div>

<hr class="my-6">

<h3 class="text-xl font-bold mb-4">Alamat</h3>

<div class="grid md:grid-cols-2 gap-6">

    <!-- Provinsi -->
    <div>
        <label class="font-semibold">Provinsi</label>
        <select id="provinsi" name="provinsi" class="w-full border p-2 rounded mt-1">
            <option value="">Pilih Provinsi</option>
        </select>
    </div>

    <!-- Kabupaten -->
    <div>
        <label class="font-semibold">Kabupaten/Kota</label>
        <select id="kota" name="kota" class="w-full border p-2 rounded mt-1">
            <option value="">Pilih Kabupaten</option>
        </select>
    </div>

    <!-- Kecamatan -->
    <div>
        <label class="font-semibold">Kecamatan</label>
        <select id="kecamatan" name="kecamatan" class="w-full border p-2 rounded mt-1">
            <option value="">Pilih Kecamatan</option>
        </select>
    </div>

    <!-- Kode Pos -->
    <div>
        <label class="font-semibold">Kode Pos</label>
        <input type="text" name="kode_pos"
            class="w-full border p-2 rounded mt-1">
    </div>

    <!-- Alamat -->
    <div class="md:col-span-2">
        <label class="font-semibold">Alamat Lengkap</label>
        <textarea name="alamat"
            class="w-full border p-2 rounded mt-1"></textarea>
    </div>

    <!-- Tanggal diterima -->
    <div>
        <label class="font-semibold">Tanggal Diterima</label>
        <input type="date" name="tanggal_diterima"
            class="w-full border p-2 rounded mt-1">
    </div>

    <!-- Foto -->
    <div>
        <label class="font-semibold">Foto (3x4)</label>
        <input type="file" name="foto"
            class="w-full border p-2 rounded mt-1">
    </div>

</div>

<div class="mt-8">
    <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-bold transition">
        Simpan Data
    </button>
</div>

</form>

<script>

document.addEventListener("DOMContentLoaded", function () {

    const provinsiSelect = document.getElementById('provinsi');
    const kabupatenSelect = document.getElementById('kota');
    const kecamatanSelect = document.getElementById('kecamatan');

    // LOAD PROVINSI
    async function loadProvinsi() {

        const response = await fetch('/api/provinsi');
        const result = await response.json();

        provinsiSelect.innerHTML =
            '<option value="">Pilih Provinsi</option>';

        result.data.forEach(function (provinsi) {

            provinsiSelect.innerHTML += `
                <option value="${provinsi.name}"
                        data-code="${provinsi.code}">

                    ${provinsi.name}

                </option>
            `;

        });

    }

    // LOAD KABUPATEN
    async function loadKabupaten(provinsiCode) {

        const response =
            await fetch(`/api/kabupaten/${provinsiCode}`);

        const result = await response.json();

        kabupatenSelect.innerHTML =
            '<option value="">Pilih Kabupaten</option>';

        kecamatanSelect.innerHTML =
            '<option value="">Pilih Kecamatan</option>';

        result.data.forEach(function (kabupaten) {

            kabupatenSelect.innerHTML += `
                <option value="${kabupaten.name}"
                        data-code="${kabupaten.code}">

                    ${kabupaten.name}

                </option>
            `;

        });

    }

    // LOAD KECAMATAN
    async function loadKecamatan(kabupatenCode) {

        const response =
            await fetch(`/api/kecamatan/${kabupatenCode.replace('.', '-')}`);

        const result = await response.json();

        kecamatanSelect.innerHTML =
            '<option value="">Pilih Kecamatan</option>';

        result.data.forEach(function (kecamatan) {

            kecamatanSelect.innerHTML += `
                <option value="${kecamatan.name}">

                    ${kecamatan.name}

                </option>
            `;

        });

    }

    // EVENT PROVINSI
    provinsiSelect.addEventListener('change', function () {

        const provinsiCode =
            this.options[this.selectedIndex].dataset.code;

        if (provinsiCode) {

            loadKabupaten(provinsiCode);

        }

    });

    // EVENT KABUPATEN
    kabupatenSelect.addEventListener('change', function () {

        const kabupatenCode =
            this.options[this.selectedIndex].dataset.code;

        if (kabupatenCode) {

            loadKecamatan(kabupatenCode);

        }

    });

    // INIT
    loadProvinsi();

});

</script>

{{-- TABLE --}}
<div class="overflow-x-auto mt-6">
<table class="w-full bg-white rounded-xl shadow min-w-[600px]">
<tr class="bg-gray-200">
<th class="p-2">Nama</th>
<th>NIS</th>
<th>Kelas</th>
<th>JK</th>
<th>Aksi</th>
</tr>

@foreach($siswas as $siswa)
<tr class="text-center border-t">
<td>{{ $siswa->nama }}</td>
<td>{{ $siswa->nis }}</td>
<td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
<td>{{ $siswa->jenis_kelamin }}</td>

<td class="p-2">

    <div class="flex justify-center gap-2">

        {{-- EDIT --}}
        <a href="{{ route('admin.siswa.edit', $siswa->id) }}"
           class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 transition">

            Edit

        </a>

        {{-- AKUN --}}
        <a href="{{ route('admin.user-create', $siswa->id) }}"
           class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">

            Akun

        </a>

        {{-- HAPUS --}}
        <form action="{{ route('admin.siswa.destroy', $siswa->id) }}"
              method="POST"
              class="inline">

            @csrf
            @method('DELETE')

            <button
                type="submit"
                onclick="return confirm('Yakin ingin menghapus siswa ini?')"
                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">

                Hapus

            </button>

        </form>

    </div>

</td>

</tr>
@endforeach

</table>
</div>

@endsection