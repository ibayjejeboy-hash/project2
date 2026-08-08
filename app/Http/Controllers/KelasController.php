<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Tampilkan daftar rombel kelas dan wali kelas.
     */
    public function index()
    {
        $kelas = Kelas::with(['waliKelas', 'siswa'])->withCount('siswa')->get();
        $gurus = User::where('role', 'guru')->orderBy('name')->get();

        return view('admin.kelas', compact('kelas', 'gurus'));
    }

    /**
     * Simpan rombel kelas baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas'    => 'required|string|max:255|unique:kelas,nama_kelas',
            'wali_kelas_id' => 'nullable|exists:users,id',
        ]);

        // Jika guru yang dipilih sudah menjadi wali di kelas lain, lepaskan penugasan sebelumnya
        if ($request->filled('wali_kelas_id')) {
            Kelas::where('wali_kelas_id', $request->wali_kelas_id)->update(['wali_kelas_id' => null]);
        }

        Kelas::create([
            'nama_kelas'    => $request->nama_kelas,
            'wali_kelas_id' => $request->wali_kelas_id ?: null,
        ]);

        return back()->with('success', "Rombel kelas '{$request->nama_kelas}' berhasil ditambahkan!");
    }

    /**
     * Perbarui data kelas dan penugasan wali kelas.
     */
    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'nama_kelas'    => 'required|string|max:255|unique:kelas,nama_kelas,' . $kelas->id,
            'wali_kelas_id' => 'nullable|exists:users,id',
        ]);

        // Jika guru yang dipilih sudah menjadi wali di kelas lain, lepaskan penugasan kelas lain tersebut
        if ($request->filled('wali_kelas_id') && $request->wali_kelas_id != $kelas->wali_kelas_id) {
            Kelas::where('wali_kelas_id', $request->wali_kelas_id)->where('id', '!=', $kelas->id)->update(['wali_kelas_id' => null]);
        }

        $kelas->update([
            'nama_kelas'    => $request->nama_kelas,
            'wali_kelas_id' => $request->wali_kelas_id ?: null,
        ]);

        return back()->with('success', "Data rombel kelas '{$kelas->nama_kelas}' berhasil diperbarui!");
    }

    /**
     * Hapus rombel kelas (hanya jika tidak ada siswa).
     */
    public function destroy($id)
    {
        $kelas = Kelas::withCount('siswa')->findOrFail($id);

        if ($kelas->siswa_count > 0) {
            return back()->with('error', "Kelas '{$kelas->nama_kelas}' tidak dapat dihapus karena masih memiliki {$kelas->siswa_count} siswa aktif!");
        }

        $nama = $kelas->nama_kelas;
        $kelas->delete();

        return back()->with('success', "Rombel kelas '{$nama}' berhasil dihapus.");
    }
}
