<?php

namespace App\Http\Controllers;

use App\Models\Indikator;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\NilaiCheck;
use App\Models\Kelas;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class EraporController extends Controller
{
    /**
     * Helper untuk memeriksa hak akses siswa terhadap rapor (Anti-IDOR)
     */
    private function authorizeSiswaAccess($siswaId)
    {
        $user = auth()->user();

        if ($user->role === 'siswa') {
            $siswa = Siswa::where('user_id', $user->id)->first();
            if (!$siswa || (int)$siswa->id !== (int)$siswaId) {
                abort(403, 'Akses Ditolak: Anda hanya diperbolehkan mengakses rapor milik Anda sendiri.');
            }
        } elseif ($user->role === 'guru') {
            $kelas = Kelas::where('wali_kelas_id', $user->id)->first();
            if ($kelas) {
                $isAllowed = Siswa::where('id', $siswaId)->where('kelas_id', $kelas->id)->exists();
                if (!$isAllowed) {
                    abort(403, 'Akses Ditolak: Siswa ini bukan berada di kelas yang Anda ampu.');
                }
            }
        }
    }

    public function dashboard()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $siswas = Siswa::with('kelas')->latest()->get();
        } else {
            $kelas = Kelas::where('wali_kelas_id', $user->id)->first();
            if ($kelas) {
                $siswas = Siswa::with('kelas')->where('kelas_id', $kelas->id)->latest()->get();
            } else {
                $siswas = Siswa::with('kelas')->latest()->get();
            }
        }

        return view('erapor.dashboard', compact('siswas'));
    }

    public function input()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $siswas = Siswa::with('kelas')->latest()->get();
        } else {
            $kelas = Kelas::where('wali_kelas_id', $user->id)->first();
            if ($kelas) {
                $siswas = Siswa::with('kelas')->where('kelas_id', $kelas->id)->latest()->get();
            } else {
                $siswas = Siswa::with('kelas')->latest()->get();
            }
        }

        $indikatorP5 = Indikator::where('kategori', 'p5')->get();
        $indikatorProfil = Indikator::where('kategori', 'profil')->get();

        return view('erapor.input', compact('siswas', 'indikatorP5', 'indikatorProfil'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id'  => 'required|exists:siswas,id',
            'agama'     => 'required|string',
            'jati_diri' => 'required|string',
            'literasi'  => 'required|string',
            'p5'        => 'nullable|array',
            'profil'    => 'nullable|array',
        ]);

        $user = auth()->user();

        if ($user->role !== 'admin') {
            $kelas = Kelas::where('wali_kelas_id', $user->id)->first();
            if ($kelas) {
                $valid = Siswa::where('id', $request->siswa_id)
                    ->where('kelas_id', $kelas->id)
                    ->exists();

                if (!$valid) {
                    return back()->with('error', 'Siswa tidak terdaftar di kelas Anda.');
                }
            }
        }

        // Simpan atau perbarui nilai deskripsi
        Nilai::updateOrCreate(
            ['siswa_id' => $request->siswa_id],
            [
                'agama'     => $request->agama,
                'jati_diri' => $request->jati_diri,
                'literasi'  => $request->literasi,
                'semester'  => $request->semester ?? '1',
            ]
        );

        // Simpan nilai ceklis P5
        if ($request->p5) {
            foreach ($request->p5 as $indikator_id => $nilai) {
                NilaiCheck::updateOrCreate(
                    [
                        'siswa_id'     => $request->siswa_id,
                        'indikator_id' => $indikator_id,
                    ],
                    [
                        'nilai'    => $nilai,
                        'kategori' => 'p5',
                    ]
                );
            }
        }

        // Simpan nilai ceklis Profil Rahmatan Lil Alamin
        if ($request->profil) {
            foreach ($request->profil as $indikator_id => $nilai) {
                NilaiCheck::updateOrCreate(
                    [
                        'siswa_id'     => $request->siswa_id,
                        'indikator_id' => $indikator_id,
                    ],
                    [
                        'nilai'    => $nilai,
                        'kategori' => 'profil',
                    ]
                );
            }
        }

        return redirect()->route('erapor.hasil', $request->siswa_id)
            ->with('success', 'Rapor berhasil disimpan!');
    }

    public function hasil($id)
    {
        $this->authorizeSiswaAccess($id);

        $siswa = Siswa::with('kelas')->findOrFail($id);
        $nilai = Nilai::where('siswa_id', $id)->latest()->first();

        // P5
        $indikator = Indikator::where('kategori', 'p5')->get();
        $nilaiP5 = NilaiCheck::where('siswa_id', $id)->where('kategori', 'p5')->get();

        // Profil Rahmatan Lil Alamin
        $indikatorRahmatan = Indikator::where('kategori', 'profil')->get();
        $nilaiRahmatan = NilaiCheck::where('siswa_id', $id)->where('kategori', 'profil')->get();

        // Layout dinamis sesuai peran
        $layout = auth()->user()->role === 'siswa' ? 'siswa.layout' : 'erapor.layout';

        return view('erapor.hasil', compact(
            'siswa',
            'nilai',
            'indikator',
            'nilaiP5',
            'indikatorRahmatan',
            'nilaiRahmatan',
            'layout'
        ));
    }

    public function cetak($id)
    {
        $this->authorizeSiswaAccess($id);

        $siswa = Siswa::with('kelas')->findOrFail($id);
        $nilai = Nilai::where('siswa_id', $id)->latest()->first();

        $indikator = Indikator::where('kategori', 'p5')->get();
        $nilaiP5 = NilaiCheck::where('siswa_id', $id)->where('kategori', 'p5')->get();

        $indikatorRahmatan = Indikator::where('kategori', 'profil')->get();
        $nilaiRahmatan = NilaiCheck::where('siswa_id', $id)->where('kategori', 'profil')->get();

        $pdf = Pdf::loadView('erapor.cetak', compact(
            'siswa',
            'nilai',
            'indikator',
            'nilaiP5',
            'indikatorRahmatan',
            'nilaiRahmatan'
        ));

        return $pdf->download('rapor-' . str_replace(' ', '_', $siswa->nama) . '.pdf');
    }

    public function edit($id)
    {
        $this->authorizeSiswaAccess($id);

        $siswa = Siswa::with('kelas')->findOrFail($id);
        // FIX BUG-06: Ambil record nilai terbaru
        $nilai = Nilai::where('siswa_id', $id)->latest()->first();

        $indikator = Indikator::where('kategori', 'p5')->get();
        $nilaiP5 = NilaiCheck::where('siswa_id', $id)->where('kategori', 'p5')->get();

        $indikatorRahmatan = Indikator::where('kategori', 'profil')->get();
        $nilaiRahmatan = NilaiCheck::where('siswa_id', $id)->where('kategori', 'profil')->get();

        return view('erapor.edit', compact(
            'siswa',
            'nilai',
            'indikator',
            'nilaiP5',
            'indikatorRahmatan',
            'nilaiRahmatan'
        ));
    }

    public function update(Request $request, $id)
    {
        $this->authorizeSiswaAccess($id);

        $request->validate([
            'agama'     => 'required|string',
            'jati_diri' => 'required|string',
            'literasi'  => 'required|string',
            'p5'        => 'nullable|array',
            'profil'    => 'nullable|array',
        ]);

        $siswa = Siswa::findOrFail($id);

        // UPDATE NILAI UTAMA
        Nilai::updateOrCreate(
            ['siswa_id' => $id],
            [
                'agama'     => $request->agama,
                'jati_diri' => $request->jati_diri,
                'literasi'  => $request->literasi,
                'semester'  => $request->semester ?? '1',
            ]
        );

        // UPDATE P5
        if ($request->p5) {
            foreach ($request->p5 as $indikator_id => $nilai) {
                NilaiCheck::updateOrCreate(
                    [
                        'siswa_id'     => $id,
                        'indikator_id' => $indikator_id,
                    ],
                    [
                        'nilai'    => $nilai,
                        'kategori' => 'p5',
                    ]
                );
            }
        }

        // UPDATE Profil PPRA
        if ($request->profil) {
            foreach ($request->profil as $indikator_id => $nilai) {
                NilaiCheck::updateOrCreate(
                    [
                        'siswa_id'     => $id,
                        'indikator_id' => $indikator_id,
                    ],
                    [
                        'nilai'    => $nilai,
                        'kategori' => 'profil',
                    ]
                );
            }
        }

        return redirect()->route('erapor.hasil', $id)
            ->with('success', 'Nilai rapor berhasil diperbarui!');
    }
}
