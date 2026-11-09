<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        $data = Pendaftaran::latest()->get();

        return view('admin.pendaftaran.index', compact('data'));
    }

    public function store(Request $request)
    {
        // Normalisasi input nama orang tua jika dikirim via form publik (ayah & ibu)
        $namaOrtu = $request->nama_ortu;
        if (!$namaOrtu && ($request->filled('ayah') || $request->filled('ibu'))) {
            $parts = [];
            if ($request->filled('ayah')) $parts[] = 'Ayah: ' . trim($request->ayah);
            if ($request->filled('ibu'))  $parts[] = 'Ibu: ' . trim($request->ibu);
            $namaOrtu = implode(' / ', $parts);
        }

        // Normalisasi kontak telepon / whatsapp
        $noHp = $request->no_hp ?: $request->whatsapp;

        // Normalisasi tanggal lahir
        $tglLahir = $request->tgl_lahir ?: $request->tanggal_lahir;

        // Normalisasi pekerjaan orang tua jika dikirim terpisah atau gabungan
        $pekerjaanOrtu = $request->pekerjaan_ortu;
        if (!$pekerjaanOrtu && ($request->filled('pekerjaan_ayah') || $request->filled('pekerjaan_ibu'))) {
            $pJobs = [];
            if ($request->filled('pekerjaan_ayah')) $pJobs[] = 'Ayah: ' . trim($request->pekerjaan_ayah);
            if ($request->filled('pekerjaan_ibu'))  $pJobs[] = 'Ibu: ' . trim($request->pekerjaan_ibu);
            $pekerjaanOrtu = implode(' / ', $pJobs);
        }

        $request->merge([
            'nama_ortu'      => $namaOrtu,
            'no_hp'          => $noHp,
            'tgl_lahir'      => $tglLahir,
            'pekerjaan_ortu' => $pekerjaanOrtu,
        ]);

        $request->validate([
            'nama_anak'      => 'required|string|max:255',
            'tgl_lahir'      => 'required|date',
            'no_kk'          => 'nullable|string|max:30',
            'nik'            => 'nullable|string|max:30',
            'ktp'            => 'nullable|string|max:30',
            'pekerjaan_ortu' => 'nullable|string|max:150',
            'nama_ortu'      => 'required|string|max:255',
            'no_hp'          => 'required|string|max:25',
            'alamat'         => 'required|string',
        ], [
            'nama_anak.required' => 'Nama lengkap anak wajib diisi.',
            'tgl_lahir.required' => 'Tanggal lahir anak wajib diisi.',
            'nama_ortu.required' => 'Nama orang tua / wali wajib diisi.',
            'no_hp.required'     => 'Nomor WhatsApp / HP wajib diisi.',
            'alamat.required'    => 'Alamat domisili lengkap wajib diisi.',
        ]);

        Pendaftaran::create([
            'nama_anak'      => trim($request->nama_anak),
            'no_kk'          => $request->filled('no_kk') ? trim($request->no_kk) : null,
            'nik'            => $request->filled('nik') ? trim($request->nik) : null,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'kelompok'       => $request->kelompok,
            'tempat_lahir'   => $request->filled('tempat_lahir') ? trim($request->tempat_lahir) : null,
            'tgl_lahir'      => $tglLahir,
            'nama_ortu'      => $namaOrtu,
            'ktp'            => $request->filled('ktp') ? trim($request->ktp) : null,
            'pekerjaan_ortu' => $pekerjaanOrtu ? trim($pekerjaanOrtu) : null,
            'no_hp'          => $noHp,
            'email'          => $request->filled('email') ? trim($request->email) : null,
            'alamat'         => trim($request->alamat),
            'status'         => 'pending',
        ]);

        return back()->with('success', 'Pendaftaran online atas nama ' . e($request->nama_anak) . ' berhasil dikirim! Panitia PPDB akan segera memverifikasi data dan menghubungi Anda.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diterima,ditolak',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update([
            'status' => $request->status,
        ]);

        return back()->with('success', "Status pendaftaran {$pendaftaran->nama_anak} berhasil diubah menjadi: {$request->status}!");
    }

    public function konversi($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        // Cek apakah siswa dengan nama yang sama sudah ada di master siswa
        $existingSiswa = Siswa::where('nama', $pendaftaran->nama_anak)->first();
        if ($existingSiswa) {
            return back()->with('info', "Calon siswa '{$pendaftaran->nama_anak}' sudah terdaftar dalam data master siswa (NIS: {$existingSiswa->nis}).");
        }

        // Generate NIS unik otomatis (Tahun + nomor urut)
        $latestSiswa = Siswa::whereYear('created_at', date('Y'))->latest('id')->first();
        $counter = Siswa::count() + 1;
        $newNis = date('Y') . str_pad($counter, 3, '0', STR_PAD_LEFT);
        while (Siswa::where('nis', $newNis)->exists()) {
            $counter++;
            $newNis = date('Y') . str_pad($counter, 3, '0', STR_PAD_LEFT);
        }

        // Ekstraksi nama ayah dan ibu jika tercatat dalam format terstruktur
        $namaAyah = $pendaftaran->nama_ortu;
        $namaIbu = null;
        if (str_contains($pendaftaran->nama_ortu, 'Ayah:') || str_contains($pendaftaran->nama_ortu, 'Ibu:')) {
            preg_match('/Ayah:\s*([^/]+)/i', $pendaftaran->nama_ortu, $matchAyah);
            preg_match('/Ibu:\s*(.+)/i', $pendaftaran->nama_ortu, $matchIbu);
            if (!empty($matchAyah[1])) $namaAyah = trim($matchAyah[1]);
            if (!empty($matchIbu[1])) $namaIbu = trim($matchIbu[1]);
        }

        // Buat record siswa resmi baru
        $siswa = Siswa::create([
            'nama'             => $pendaftaran->nama_anak,
            'nis'              => $newNis,
            'jenis_kelamin'    => $pendaftaran->jenis_kelamin,
            'tempat_lahir'     => $pendaftaran->tempat_lahir,
            'tanggal_lahir'    => $pendaftaran->tgl_lahir,
            'nama_ayah'        => $namaAyah,
            'nama_ibu'         => $namaIbu,
            'pekerjaan_ayah'   => $pendaftaran->pekerjaan_ortu,
            'no_hp'            => $pendaftaran->no_hp,
            'email'            => $pendaftaran->email,
            'alamat'           => $pendaftaran->alamat,
            'tanggal_diterima' => date('Y-m-d'),
        ]);

        // Tandai status PPDB menjadi diterima
        $pendaftaran->update(['status' => 'diterima']);

        return redirect()->route('admin.siswa.edit', $siswa->id)
            ->with('success', "Calon siswa '{$pendaftaran->nama_anak}' berhasil dikonversi menjadi Siswa Resmi (NIS: {$newNis})! Silakan atur Rombel Kelas dan lengkapi data pendukung.");
    }

    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $nama = $pendaftaran->nama_anak;
        $pendaftaran->delete();

        return back()->with('success', "Data pendaftaran {$nama} berhasil dihapus.");
    }
}
