@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6">
    Edit Data Siswa
</h2>

<div class="bg-white p-6 rounded-2xl shadow">

<form action="{{ route('admin.siswa.update', $siswa->id) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="grid md:grid-cols-2 gap-6">

        {{-- NAMA --}}
<div>
    <label class="font-semibold">Nama Lengkap</label>

    <input
        type="text"
        name="nama"
        value="{{ $siswa->nama }}"
        class="w-full border p-2 rounded mt-1"
        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
    >
</div>

{{-- NAMA PANGGILAN --}}
<div>
    <label class="font-semibold">Nama Panggilan</label>

    <input
        type="text"
        name="nama_panggilan"
        value="{{ $siswa->nama_panggilan }}"
        class="w-full border p-2 rounded mt-1"
        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
    >
</div>

{{-- NIS --}}
<div>
    <label class="font-semibold">NIS</label>

    <input
        type="text"
        name="nis"
        value="{{ $siswa->nis }}"
        class="w-full border p-2 rounded mt-1"
        inputmode="numeric"
        pattern="[0-9]*"
        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
    >
</div>

{{-- KELAS --}}
<div>
    <label class="font-semibold">Kelas</label>

    <select name="kelas_id"
            class="w-full border p-2 rounded mt-1">

        @foreach($kelas as $k)
            <option value="{{ $k->id }}"
                {{ $siswa->kelas_id == $k->id ? 'selected' : '' }}>

                {{ $k->nama_kelas }}

            </option>
        @endforeach

    </select>
</div>

{{-- JENIS KELAMIN --}}
<div>
    <label class="font-semibold">Jenis Kelamin</label>

    <select name="jenis_kelamin"
            class="w-full border p-2 rounded mt-1">

        <option value="L"
            {{ $siswa->jenis_kelamin == 'L' ? 'selected' : '' }}>
            Laki-Laki
        </option>

        <option value="P"
            {{ $siswa->jenis_kelamin == 'P' ? 'selected' : '' }}>
            Perempuan
        </option>

    </select>
</div>

{{-- TEMPAT LAHIR --}}
<div>
    <label class="font-semibold">Tempat Lahir</label>

    <input
        type="text"
        name="tempat_lahir"
        value="{{ $siswa->tempat_lahir }}"
        class="w-full border p-2 rounded mt-1"
        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
    >
</div>

{{-- TANGGAL LAHIR --}}
<div>
    <label class="font-semibold">Tanggal Lahir</label>

    <input
        type="date"
        name="tanggal_lahir"
        value="{{ $siswa->tanggal_lahir }}"
        class="w-full border p-2 rounded mt-1"
    >
</div>

{{-- AGAMA --}}
<div>
    <label class="font-semibold">Agama</label>

    <select name="agama"
            class="w-full border p-2 rounded mt-1">

        <option value="Islam"
            {{ $siswa->agama == 'Islam' ? 'selected' : '' }}>
            Islam
        </option>

        <option value="Kristen"
            {{ $siswa->agama == 'Kristen' ? 'selected' : '' }}>
            Kristen
        </option>

        <option value="Katolik"
            {{ $siswa->agama == 'Katolik' ? 'selected' : '' }}>
            Katolik
        </option>

        <option value="Hindu"
            {{ $siswa->agama == 'Hindu' ? 'selected' : '' }}>
            Hindu
        </option>

        <option value="Budha"
            {{ $siswa->agama == 'Budha' ? 'selected' : '' }}>
            Budha
        </option>

    </select>
</div>

{{-- ANAK KE --}}
<div>
    <label class="font-semibold">Anak Ke</label>

    <select name="anak_ke"
            class="w-full border p-2 rounded mt-1">

        @for($i = 1; $i <= 10; $i++)

            <option value="{{ $i }}"
                {{ $siswa->anak_ke == $i ? 'selected' : '' }}>

                {{ $i }}

            </option>

        @endfor

    </select>
</div>

{{-- NAMA AYAH --}}
<div>
    <label class="font-semibold">Nama Ayah</label>

    <input
        type="text"
        name="nama_ayah"
        value="{{ $siswa->nama_ayah }}"
        class="w-full border p-2 rounded mt-1"
        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
    >
</div>

{{-- NAMA IBU --}}
<div>
    <label class="font-semibold">Nama Ibu</label>

    <input
        type="text"
        name="nama_ibu"
        value="{{ $siswa->nama_ibu }}"
        class="w-full border p-2 rounded mt-1"
        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
    >
</div>

{{-- NO HP --}}
<div>
    <label class="font-semibold">No HP</label>

    <input
        type="text"
        name="no_hp"
        value="{{ $siswa->no_hp }}"
        class="w-full border p-2 rounded mt-1"
        inputmode="numeric"
        pattern="[0-9]*"
        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
    >
</div>

{{-- PEKERJAAN AYAH --}} <div> <label class="font-semibold">Pekerjaan Ayah</label> 
    <input type="text" name="pekerjaan_ayah" value="{{ $siswa->pekerjaan_ayah }}" 
    class="w-full border p-2 rounded mt-1"> </div> 


{{-- PEKERJAAN IBU --}} <div> <label class="font-semibold">Pekerjaan Ibu</label> 
    <input type="text" name="pekerjaan_ibu" value="{{ $siswa->pekerjaan_ibu }}" 
    class="w-full border p-2 rounded mt-1"> </div>

{{-- KODE POS --}}
<div>
    <label class="font-semibold">Kode Pos</label>

    <input
        type="text"
        name="kode_pos"
        value="{{ $siswa->kode_pos }}"
        class="w-full border p-2 rounded mt-1"
        inputmode="numeric"
        pattern="[0-9]*"
        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
    >
</div>

       {{-- PROVINSI --}}
<div>
    <label class="font-semibold">Provinsi</label>

    <select id="provinsi"
            name="provinsi"
            class="w-full border p-2 rounded mt-1">

        <option value="{{ $siswa->provinsi }}">
            {{ $siswa->provinsi }}
        </option>

    </select>
</div>

{{-- KABUPATEN --}}
<div>
    <label class="font-semibold">Kabupaten/Kota</label>

    <select id="kabupaten"
            name="kota"
            class="w-full border p-2 rounded mt-1">

        <option value="{{ $siswa->kota }}">
            {{ $siswa->kota }}
        </option>

    </select>
</div>

{{-- KECAMATAN --}}
<div>
    <label class="font-semibold">Kecamatan</label>

    <select id="kecamatan"
            name="kecamatan"
            class="w-full border p-2 rounded mt-1">

        <option value="{{ $siswa->kecamatan }}">
            {{ $siswa->kecamatan }}
        </option>

    </select>
</div>

        {{-- TANGGAL DITERIMA --}}
        <div>
            <label class="font-semibold">Tanggal Diterima</label>
            <input type="date"
                   name="tanggal_diterima"
                   value="{{ $siswa->tanggal_diterima }}"
                   class="w-full border p-2 rounded mt-1">
        </div>

        {{-- FOTO --}}
        <div>
            <label class="font-semibold">Foto</label>

            <input type="file"
                   name="foto"
                   class="w-full border p-2 rounded mt-1">

            @if($siswa->foto)
                <img src="{{ asset('storage/'.$siswa->foto) }}"
                     class="w-24 h-32 object-cover rounded mt-3 border">
            @endif
        </div>

        {{-- ALAMAT --}}
        <div class="md:col-span-2">
            <label class="font-semibold">Alamat Lengkap</label>

            <textarea name="alamat"
                      rows="4"
                      class="w-full border p-2 rounded mt-1">{{ $siswa->alamat }}</textarea>
        </div>

    </div>

    {{-- BUTTON --}}
    <div class="mt-8">
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-bold transition">
            Update Data
        </button>
    </div>

    <script>

document.addEventListener("DOMContentLoaded", function () {

    const provinsiSelect = document.getElementById('provinsi');
    const kabupatenSelect = document.getElementById('kabupaten');
    const kecamatanSelect = document.getElementById('kecamatan');

    // DATA LAMA
    const selectedProvinsi = "{{ $siswa->provinsi }}";
    const selectedKabupaten = "{{ $siswa->kota }}";
    const selectedKecamatan = "{{ $siswa->kecamatan }}";

    // LOAD PROVINSI
    async function loadProvinsi() {

        const response = await fetch('/api/provinsi');
        const result = await response.json();

        provinsiSelect.innerHTML =
            '<option value="">Pilih Provinsi</option>';

        result.data.forEach(function (provinsi) {

            const selected =
                provinsi.name == selectedProvinsi
                ? 'selected'
                : '';

            provinsiSelect.innerHTML += `
                <option value="${provinsi.name}"
                        data-code="${provinsi.code}"
                        ${selected}>

                    ${provinsi.name}

                </option>
            `;

        });

        // AUTO LOAD KABUPATEN
        const selectedOption =
            provinsiSelect.options[provinsiSelect.selectedIndex];

        if (selectedOption.dataset.code) {

            loadKabupaten(selectedOption.dataset.code);

        }

    }

    // LOAD KABUPATEN
    async function loadKabupaten(provinsiCode) {

        const response =
            await fetch(`/api/kabupaten/${provinsiCode}`);

        const result = await response.json();

        kabupatenSelect.innerHTML =
            '<option value="">Pilih Kabupaten</option>';

        result.data.forEach(function (kabupaten) {

            const selected =
                kabupaten.name == selectedKabupaten
                ? 'selected'
                : '';

            kabupatenSelect.innerHTML += `
                <option value="${kabupaten.name}"
                        data-code="${kabupaten.code}"
                        ${selected}>

                    ${kabupaten.name}

                </option>
            `;

        });

        // AUTO LOAD KECAMATAN
        const selectedOption =
            kabupatenSelect.options[kabupatenSelect.selectedIndex];

        if (selectedOption.dataset.code) {

            loadKecamatan(selectedOption.dataset.code);

        }

    }

    // LOAD KECAMATAN
    async function loadKecamatan(kabupatenCode) {

        const response =
            await fetch(`/api/kecamatan/${kabupatenCode}`);

        const result = await response.json();

        kecamatanSelect.innerHTML =
            '<option value="">Pilih Kecamatan</option>';

        result.data.forEach(function (kecamatan) {

            const selected =
                kecamatan.name == selectedKecamatan
                ? 'selected'
                : '';

            kecamatanSelect.innerHTML += `
                <option value="${kecamatan.name}"
                        ${selected}>

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

</form>

</div>

@endsection