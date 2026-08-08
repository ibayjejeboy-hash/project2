@extends('layouts.admin')

@section('title', 'Data Pendaftaran PPDB - RA Al Musyaffallah')
@section('page_title', 'Pendaftaran PPDB')

@section('content')

<div class="space-y-8">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                Penerimaan Peserta Didik Baru (PPDB)
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1">
                Kelola dan verifikasi berkas calon siswa yang mendaftar secara online.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3.5 py-1.5 bg-green-100 text-green-800 font-black rounded-xl text-xs">
                Total Pendaftar: {{ count($data) }} Calon Siswa
            </span>
        </div>
    </div>

    {{-- ================= TABLE CARD ================= --}}
    <div class="bg-white p-6 sm:p-7 rounded-3xl border border-slate-100 shadow-sm space-y-5">
        
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-base font-black text-slate-900">Daftar Calon Peserta Didik</h3>
                <p class="text-xs text-slate-500">Ubah status verifikasi atau hubungi orang tua via WhatsApp.</p>
            </div>
            
            {{-- Quick Filter --}}
            <div class="flex items-center gap-2">
                <input type="text" 
                       id="searchPendaftar" 
                       onkeyup="filterPendaftarTable()" 
                       placeholder="Cari nama anak / orang tua..."
                       class="px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:border-green-600 outline-none w-56">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table id="pendaftarTable" class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 font-extrabold uppercase tracking-wider border-y border-slate-100">
                        <th class="py-3.5 px-4 rounded-l-xl text-center w-12">No</th>
                        <th class="py-3.5 px-4">Nama Anak</th>
                        <th class="py-3.5 px-4">Nama Orang Tua</th>
                        <th class="py-3.5 px-4">Kontak WhatsApp</th>
                        <th class="py-3.5 px-4">Alamat Domisili</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                        <th class="py-3.5 px-4 text-center rounded-r-xl w-44">Aksi Verifikasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                    @forelse($data as $i => $item)
                    @php
                        // Format nomor WA
                        $phone = preg_replace('/[^0-9]/', '', $item->no_hp);
                        if (str_starts_with($phone, '0')) {
                            $phone = '62' . substr($phone, 1);
                        }
                    @endphp
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="py-3.5 px-4 text-center text-slate-400 font-bold">
                            {{ $i + 1 }}
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="block font-bold text-slate-900 text-xs sm:text-sm">{{ $item->nama_anak }}</span>
                            <span class="block text-[11px] text-slate-400">
                                Lahir: {{ $item->tgl_lahir ? date('d/m/Y', strtotime($item->tgl_lahir)) : '-' }}
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-slate-700 font-semibold">
                            {{ $item->nama_ortu }}
                        </td>
                        <td class="py-3.5 px-4">
                            @if($item->no_hp)
                            <a href="https://wa.me/{{ $phone }}?text=Halo%20Bapak/Ibu%20wali%20dari%20{{ urlencode($item->nama_anak) }},%20kami%20dari%20Panitia%20PPDB%20RA%20Al%20Musyaffallah." 
                               target="_blank" 
                               class="inline-flex items-center gap-1.5 text-green-700 bg-green-50 hover:bg-green-100 border border-green-200 px-2.5 py-1 rounded-lg font-bold text-[11px] transition">
                                <i class="fa-brands fa-whatsapp text-green-600"></i>
                                <span>{{ $item->no_hp }}</span>
                            </a>
                            @else
                            <span class="text-slate-400">-</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-slate-600 text-[11px] max-w-xs truncate">
                            {{ $item->alamat }}
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            @if($item->status === 'diterima')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-green-100 text-green-800 border border-green-200 uppercase">
                                    <i class="fa-solid fa-circle-check"></i> Diterima
                                </span>
                            @elseif($item->status === 'ditolak')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-red-100 text-red-800 border border-red-200 uppercase">
                                    <i class="fa-solid fa-circle-xmark"></i> Ditolak
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-amber-100 text-amber-800 border border-amber-200 uppercase">
                                    <i class="fa-solid fa-clock"></i> Pending
                                </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            <div class="flex items-center justify-center gap-1.5">
                                
                                {{-- Tombol Konversi ke Data Siswa --}}
                                <form action="{{ route('admin.pendaftaran.konversi', $item->id) }}" 
                                      method="POST"
                                      onsubmit="return confirm('Konversi calon siswa {{ addslashes($item->nama_anak) }} menjadi data siswa resmi?')">
                                    @csrf
                                    <button type="submit" 
                                            title="Konversi ke Data Siswa Resmi"
                                            class="px-2 py-1 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white flex items-center gap-1 text-[11px] font-bold shadow-sm transition">
                                        <i class="fa-solid fa-user-plus text-[10px]"></i>
                                        <span class="hidden sm:inline">Konversi</span>
                                    </button>
                                </form>

                                {{-- Tombol Terima --}}
                                @if($item->status !== 'diterima')
                                <form action="{{ route('admin.pendaftaran.status', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="diterima">
                                    <button type="submit" 
                                            title="Terima Calon Siswa"
                                            class="w-7 h-7 rounded-lg bg-green-500 hover:bg-green-600 text-white flex items-center justify-center text-xs transition">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </form>
                                @endif

                                {{-- Tombol Tolak --}}
                                @if($item->status !== 'ditolak')
                                <form action="{{ route('admin.pendaftaran.status', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="ditolak">
                                    <button type="submit" 
                                            title="Tolak Calon Siswa"
                                            class="w-7 h-7 rounded-lg bg-amber-500 hover:bg-amber-600 text-white flex items-center justify-center text-xs transition">
                                        <i class="fa-solid fa-ban"></i>
                                    </button>
                                </form>
                                @endif

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('admin.pendaftaran.destroy', $item->id) }}" 
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus data pendaftar ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            title="Hapus Pendaftar"
                                            class="w-7 h-7 rounded-lg bg-red-50 hover:bg-red-600 text-red-600 hover:text-white border border-red-200 hover:border-red-600 flex items-center justify-center text-xs transition">
                                        <i class="fa-solid fa-trash-can text-[10px]"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-slate-400 font-semibold">
                            <i class="fa-solid fa-inbox text-3xl mb-2 block"></i>
                            Belum ada data pendaftar masuk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

<script>
function filterPendaftarTable() {
    const input = document.getElementById("searchPendaftar");
    const filter = input.value.toLowerCase();
    const table = document.getElementById("pendaftarTable");
    const tr = table.getElementsByTagName("tr");

    for (let i = 1; i < tr.length; i++) {
        const tdText = tr[i].textContent || tr[i].innerText;
        if (tdText.toLowerCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
    }
}
</script>

@endsection