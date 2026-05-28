@extends('siswa.layout')

@section('content')

<div class="bg-white p-8 rounded-2xl shadow">

    {{-- JUDUL --}}
    <div class="mb-8 border-b pb-4">
        <h2 class="text-3xl font-bold text-gray-800">
            Data Diri Siswa
        </h2>

        <p class="text-gray-500 mt-1">
            Informasi lengkap data siswa
        </p>
    </div>

    {{-- PROFIL --}}
    <div class="flex flex-col md:flex-row gap-8 mb-10">

        {{-- FOTO --}}
        <div class="flex justify-center">
            <img src="{{ asset('storage/'.$siswa->foto) }}"
                 class="w-44 h-56 object-cover rounded-2xl shadow-lg border-4 border-gray-100">
        </div>

        {{-- IDENTITAS --}}
        <div class="flex-1 grid md:grid-cols-2 gap-5">

            <div>
                <label class="text-sm text-gray-500">Nama Lengkap</label>
                <div class="font-semibold text-lg text-gray-800">
                    {{ $siswa->nama }}
                </div>
            </div>

            <div>
                <label class="text-sm text-gray-500">Nama Panggilan</label>
                <div class="font-semibold text-gray-800">
                    {{ $siswa->nama_panggilan }}
                </div>
            </div>

            <div>
                <label class="text-sm text-gray-500">NIS</label>
                <div class="font-semibold text-gray-800">
                    {{ $siswa->nis }}
                </div>
            </div>

            <div>
                <label class="text-sm text-gray-500">Kelas</label>
                <div class="font-semibold text-gray-800">
                    {{ $siswa->kelas->nama_kelas ?? '-' }}
                </div>
            </div>

            <div>
                <label class="text-sm text-gray-500">Jenis Kelamin</label>
                <div class="font-semibold text-gray-800">
                    {{ $siswa->jenis_kelamin }}
                </div>
            </div>

            <div>
                <label class="text-sm text-gray-500">Agama</label>
                <div class="font-semibold text-gray-800">
                    {{ $siswa->agama }}
                </div>
            </div>

            <div>
                <label class="text-sm text-gray-500">Tempat Lahir</label>
                <div class="font-semibold text-gray-800">
                    {{ $siswa->tempat_lahir }}
                </div>
            </div>

            <div>
                <label class="text-sm text-gray-500">Tanggal Lahir</label>
                <div class="font-semibold text-gray-800">
                    {{ $siswa->tanggal_lahir }}
                </div>
            </div>

            <div>
                <label class="text-sm text-gray-500">Anak Ke</label>
                <div class="font-semibold text-gray-800">
                    {{ $siswa->anak_ke }}
                </div>
            </div>

            <div>
                <label class="text-sm text-gray-500">No HP</label>
                <div class="font-semibold text-gray-800">
                    {{ $siswa->no_hp }}
                </div>
            </div>

        </div>

    </div>

    {{-- ALAMAT --}}
    <div class="mb-10">

        <h3 class="text-xl font-bold text-gray-800 mb-5 border-b pb-2">
            Alamat
        </h3>

        <div class="grid md:grid-cols-2 gap-6">

            <div class="md:col-span-2">
                <label class="text-sm text-gray-500">Alamat Lengkap</label>
                <div class="font-semibold text-gray-800">
                    {{ $siswa->alamat }}
                </div>
            </div>

            <div>
                <label class="text-sm text-gray-500">Kecamatan</label>
                <div class="font-semibold text-gray-800">
                    {{ $siswa->kecamatan }}
                </div>
            </div>

            <div>
                <label class="text-sm text-gray-500">Kabupaten / Kota</label>
                <div class="font-semibold text-gray-800">
                    {{ $siswa->kota }}
                </div>
            </div>

            <div>
                <label class="text-sm text-gray-500">Provinsi</label>
                <div class="font-semibold text-gray-800">
                    {{ $siswa->provinsi }}
                </div>
            </div>

            <div>
                <label class="text-sm text-gray-500">Kode Pos</label>
                <div class="font-semibold text-gray-800">
                    {{ $siswa->kode_pos }}
                </div>
            </div>

        </div>

    </div>

    {{-- INFO SEKOLAH --}}
    <div>

        <h3 class="text-xl font-bold text-gray-800 mb-5 border-b pb-2">
            Informasi Sekolah
        </h3>

        <div class="grid md:grid-cols-2 gap-6">

            <div>
                <label class="text-sm text-gray-500">Tanggal Diterima</label>
                <div class="font-semibold text-gray-800">
                    {{ $siswa->tanggal_diterima }}
                </div>
            </div>

            <div>
                <label class="text-sm text-gray-500">Status</label>
                <div>
                    <span class="inline-block px-4 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                        Siswa Aktif
                    </span>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection