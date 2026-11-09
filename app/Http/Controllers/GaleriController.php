<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    /**
     * Halaman Publik Galeri Kegiatan (Siswa & Guru)
     */
    public function publicIndex(Request $request)
    {
        $kategori = $request->query('kategori');

        $query = Galeri::latest();
        if ($kategori && in_array($kategori, ['kegiatan_siswa', 'kegiatan_guru'])) {
            $query->where('kategori', $kategori);
        }
        $galeris = $query->get();

        $countTotal = Galeri::count();
        $countSiswa = Galeri::where('kategori', 'kegiatan_siswa')->count();
        $countGuru  = Galeri::where('kategori', 'kegiatan_guru')->count();

        return view('galeri', compact('galeris', 'kategori', 'countTotal', 'countSiswa', 'countGuru'));
    }

    /**
     * Halaman Manajemen Galeri di Dashboard Admin
     */
    public function index(Request $request)
    {
        $kategori = $request->query('kategori');

        $query = Galeri::latest();
        if ($kategori && in_array($kategori, ['kegiatan_siswa', 'kegiatan_guru'])) {
            $query->where('kategori', $kategori);
        }
        $galeris = $query->get();

        $countTotal = Galeri::count();
        $countSiswa = Galeri::where('kategori', 'kegiatan_siswa')->count();
        $countGuru  = Galeri::where('kategori', 'kegiatan_guru')->count();

        return view('admin.galeri', compact('galeris', 'kategori', 'countTotal', 'countSiswa', 'countGuru'));
    }

    /**
     * Simpan Foto Dokumentasi Baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'            => 'required|string|max:255',
            'kategori'         => 'required|in:kegiatan_siswa,kegiatan_guru',
            'deskripsi'        => 'nullable|string|max:1000',
            'tanggal_kegiatan' => 'nullable|date',
            'gambar'           => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'judul.required'    => 'Judul kegiatan wajib diisi.',
            'kategori.required' => 'Pilih kategori kegiatan (Siswa atau Guru).',
            'gambar.required'   => 'Pilih berkas foto yang akan diunggah.',
            'gambar.image'      => 'Berkas harus berupa gambar valid.',
            'gambar.max'        => 'Ukuran foto maksimal 5MB.',
        ]);

        $path = $request->file('gambar')->store('galeri', 'public');

        // Sinkronisasi otomatis ke public/storage untuk kompatibilitas Windows/XAMPP
        $publicTarget = public_path('storage/' . $path);
        if (!file_exists(dirname($publicTarget))) {
            @mkdir(dirname($publicTarget), 0777, true);
        }
        @copy(storage_path('app/public/' . $path), $publicTarget);

        Galeri::create([
            'judul'            => trim($request->judul),
            'kategori'         => $request->kategori,
            'deskripsi'        => $request->deskripsi ? trim($request->deskripsi) : null,
            'tanggal_kegiatan' => $request->tanggal_kegiatan ?: null,
            'gambar'           => $path,
        ]);

        return redirect()->back()->with('success', 'Foto kegiatan berhasil ditambahkan ke Galeri!');
    }

    /**
     * Update Foto & Keterangan Galeri
     */
    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'judul'            => 'required|string|max:255',
            'kategori'         => 'required|in:kegiatan_siswa,kegiatan_guru',
            'deskripsi'        => 'nullable|string|max:1000',
            'tanggal_kegiatan' => 'nullable|date',
            'gambar'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        if ($request->hasFile('gambar')) {
            if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
                Storage::disk('public')->delete($galeri->gambar);
            }
            $oldPublic = public_path('storage/' . $galeri->gambar);
            if ($galeri->gambar && file_exists($oldPublic)) {
                @unlink($oldPublic);
            }

            $galeri->gambar = $request->file('gambar')->store('galeri', 'public');

            // Sinkronisasi file baru ke public/storage
            $publicTarget = public_path('storage/' . $galeri->gambar);
            if (!file_exists(dirname($publicTarget))) {
                @mkdir(dirname($publicTarget), 0777, true);
            }
            @copy(storage_path('app/public/' . $galeri->gambar), $publicTarget);
        }

        $galeri->judul            = trim($request->judul);
        $galeri->kategori         = $request->kategori;
        $galeri->deskripsi        = $request->deskripsi ? trim($request->deskripsi) : null;
        $galeri->tanggal_kegiatan = $request->tanggal_kegiatan ?: null;
        $galeri->save();

        return redirect()->back()->with('success', 'Data galeri kegiatan berhasil diperbarui!');
    }

    /**
     * Hapus Foto Galeri
     */
    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
            Storage::disk('public')->delete($galeri->gambar);
        }

        $publicFile = public_path('storage/' . $galeri->gambar);
        if ($galeri->gambar && file_exists($publicFile)) {
            @unlink($publicFile);
        }

        $galeri->delete();

        return redirect()->back()->with('success', 'Foto galeri berhasil dihapus!');
    }

    /**
     * Cetak Lembar Dokumentasi Galeri (Print Out / Format A4 Siap Cetak)
     */
    public function cetak(Request $request)
    {
        $kategori = $request->query('kategori');

        $query = Galeri::latest();
        if ($kategori && in_array($kategori, ['kegiatan_siswa', 'kegiatan_guru'])) {
            $query->where('kategori', $kategori);
        }
        $galeris = $query->get();

        $judulDokumen = match ($kategori) {
            'kegiatan_guru'  => 'LEMBAR DOKUMENTASI KEGIATAN GURU',
            'kegiatan_siswa' => 'LEMBAR DOKUMENTASI KEGIATAN SISWA',
            default          => 'LEMBAR DOKUMENTASI KEGIATAN SEKOLAH (SISWA & GURU)',
        };

        return view('galeri.cetak', compact('galeris', 'kategori', 'judulDokumen'));
    }

    /**
     * Cetak Lembar Dokumentasi Tunggal untuk 1 Foto Kegiatan
     */
    public function cetakSingle($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('galeri.cetak-single', compact('galeri'));
    }
}
