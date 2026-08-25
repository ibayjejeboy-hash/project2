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
    private function authorizeSiswaAccess($identifier)
    {
        $user = auth()->user();
        $siswa = Siswa::with(['kelas.waliKelas'])->byIdentifier($identifier)->firstOrFail();

        if ($user->role === 'siswa') {
            $userSiswa = Siswa::where('user_id', $user->id)->first();
            if (!$userSiswa || (int)$userSiswa->id !== (int)$siswa->id) {
                abort(403, 'Akses Ditolak: Anda hanya diperbolehkan mengakses rapor milik Anda sendiri.');
            }
        } elseif ($user->role === 'guru') {
            $kelas = Kelas::where('wali_kelas_id', $user->id)->first();
            if ($kelas) {
                $isAllowed = Siswa::where('id', $siswa->id)->where('kelas_id', $kelas->id)->exists();
                if (!$isAllowed) {
                    abort(403, 'Akses Ditolak: Siswa ini bukan berada di kelas yang Anda ampu.');
                }
            }
        }

        return $siswa;
    }

    public function dashboard()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $siswas = Siswa::with(['kelas.waliKelas', 'nilais'])->latest()->get();
        } else {
            $kelas = Kelas::where('wali_kelas_id', $user->id)->first();
            if ($kelas) {
                $siswas = Siswa::with(['kelas.waliKelas', 'nilais'])->where('kelas_id', $kelas->id)->latest()->get();
            } else {
                $siswas = Siswa::with(['kelas.waliKelas', 'nilais'])->latest()->get();
            }
        }

        return view('erapor.dashboard', compact('siswas'));
    }

    public function input()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $siswas = Siswa::with(['kelas.waliKelas', 'nilais'])->latest()->get();
        } else {
            $kelas = Kelas::where('wali_kelas_id', $user->id)->first();
            if ($kelas) {
                $siswas = Siswa::with(['kelas.waliKelas', 'nilais'])->where('kelas_id', $kelas->id)->latest()->get();
            } else {
                $siswas = Siswa::with(['kelas.waliKelas', 'nilais'])->latest()->get();
            }
        }

        $indikator = Indikator::where('kategori', 'p5')->get();
        $indikatorRahmatan = Indikator::where('kategori', 'profil')->get();
        $indikatorP5 = $indikator;
        $indikatorProfil = $indikatorRahmatan;

        return view('erapor.input', compact('siswas', 'indikator', 'indikatorRahmatan', 'indikatorP5', 'indikatorProfil'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id'  => 'required',
            'semester'  => 'nullable|string',
            'agama'     => 'required|string',
            'jati_diri' => 'required|string',
            'literasi'  => 'required|string',
        ]);

        $semester = $request->semester ?: '1';
        $siswa = $this->authorizeSiswaAccess($request->siswa_id);

        $nilai = Nilai::updateOrCreate(
            [
                'siswa_id' => $siswa->id,
                'semester' => $semester,
            ],
            [
                'agama'     => $request->agama,
                'jati_diri' => $request->jati_diri,
                'literasi'  => $request->literasi,
                'semester'  => $semester,
            ]
        );

        // Simpan nilai ceklis P5
        if ($request->p5) {
            foreach ($request->p5 as $indikator_id => $nilai_item) {
                NilaiCheck::updateOrCreate(
                    [
                        'siswa_id'     => $siswa->id,
                        'indikator_id' => $indikator_id,
                    ],
                    [
                        'nilai'    => $nilai_item,
                        'kategori' => 'p5',
                    ]
                );
            }
        }

        // Simpan nilai ceklis Profil Rahmatan Lil Alamin
        if ($request->profil) {
            foreach ($request->profil as $indikator_id => $nilai_item) {
                NilaiCheck::updateOrCreate(
                    [
                        'siswa_id'     => $siswa->id,
                        'indikator_id' => $indikator_id,
                    ],
                    [
                        'nilai'    => $nilai_item,
                        'kategori' => 'profil',
                    ]
                );
            }
        }

        return redirect()->route('erapor.hasil', $siswa->uuid ?? $siswa->id)
            ->with('success', 'Rapor berhasil disimpan!');
    }

    public function hasil($identifier)
    {
        $siswa = $this->authorizeSiswaAccess($identifier);
        $nilai = Nilai::where('siswa_id', $siswa->id)->latest()->first();

        // P5
        $indikator = Indikator::where('kategori', 'p5')->get();
        $nilaiP5 = NilaiCheck::where('siswa_id', $siswa->id)->where('kategori', 'p5')->get();

        // Profil Rahmatan Lil Alamin
        $indikatorRahmatan = Indikator::where('kategori', 'profil')->get();
        $nilaiRahmatan = NilaiCheck::where('siswa_id', $siswa->id)->where('kategori', 'profil')->get();

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

    public function cetak($identifier)
    {
        $siswa = $this->authorizeSiswaAccess($identifier);
        $nilai = Nilai::where('siswa_id', $siswa->id)->latest()->first();

        $indikator = Indikator::where('kategori', 'p5')->get();
        $nilaiP5 = NilaiCheck::where('siswa_id', $siswa->id)->where('kategori', 'p5')->get();

        $indikatorRahmatan = Indikator::where('kategori', 'profil')->get();
        $nilaiRahmatan = NilaiCheck::where('siswa_id', $siswa->id)->where('kategori', 'profil')->get();

        $pdf = Pdf::loadView('erapor.cetak', compact(
            'siswa',
            'nilai',
            'indikator',
            'nilaiP5',
            'indikatorRahmatan',
            'nilaiRahmatan'
        ))->setPaper('a4', 'portrait');

        return $pdf->download('Rapor_' . str_replace(' ', '_', $siswa->nama) . '.pdf');
    }

    public function edit($identifier)
    {
        $siswa = $this->authorizeSiswaAccess($identifier);
        $nilai = Nilai::where('siswa_id', $siswa->id)->latest()->first();

        $indikator = Indikator::where('kategori', 'p5')->get();
        $nilaiP5 = NilaiCheck::where('siswa_id', $siswa->id)->where('kategori', 'p5')->get();

        $indikatorRahmatan = Indikator::where('kategori', 'profil')->get();
        $nilaiRahmatan = NilaiCheck::where('siswa_id', $siswa->id)->where('kategori', 'profil')->get();

        return view('erapor.edit', compact(
            'siswa',
            'nilai',
            'indikator',
            'nilaiP5',
            'indikatorRahmatan',
            'nilaiRahmatan'
        ));
    }

    public function update(Request $request, $identifier)
    {
        $siswa = $this->authorizeSiswaAccess($identifier);

        $request->validate([
            'agama'     => 'required|string',
            'jati_diri' => 'required|string',
            'literasi'  => 'required|string',
            'p5'        => 'nullable|array',
            'profil'    => 'nullable|array',
        ]);

        // UPDATE NILAI UTAMA
        Nilai::updateOrCreate(
            ['siswa_id' => $siswa->id],
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
                        'siswa_id'     => $siswa->id,
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
                        'siswa_id'     => $siswa->id,
                        'indikator_id' => $indikator_id,
                    ],
                    [
                        'nilai'    => $nilai,
                        'kategori' => 'profil',
                    ]
                );
            }
        }

        return redirect()->route('erapor.hasil', $siswa->uuid ?? $siswa->id)
            ->with('success', 'Nilai rapor berhasil diperbarui!');
    }

    public function generateNarasi(Request $request)
    {
        $request->validate([
            'siswa_nama' => 'required|string',
            'siswa_jk' => 'required|string',
            'kategori' => 'required|string|in:agama,jati_diri,literasi',
        ]);

        $prompt = "";
        $nama = $request->siswa_nama;
        $jk = strtolower($request->siswa_jk) == 'l' || strtolower($request->siswa_jk) == 'laki-laki' ? 'putra' : 'putri';

        if ($request->kategori === 'agama') {
            $prompt = "Buatkan satu paragraf narasi rapor TK/RA yang ramah, sopan, dan memotivasi untuk siswa bernama {$nama} ({$jk}) mengenai perkembangan 'Nilai Agama & Budi Pekerti'. Ceritakan bahwa Ananda sudah berkembang sangat baik dalam melafalkan doa, surat pendek, dan adab Islami sehari-hari. Jangan gunakan pembuka atau penutup surat, langsung berikan 1 paragraf narasi rapor. Gunakan kata 'Ananda' untuk merujuk pada siswa.";
        } elseif ($request->kategori === 'jati_diri') {
            $prompt = "Buatkan satu paragraf narasi rapor TK/RA yang ramah, sopan, dan memotivasi untuk siswa bernama {$nama} ({$jk}) mengenai perkembangan 'Jati Diri'. Ceritakan bahwa Ananda sudah mandiri, percaya diri, dan bisa bergaul dengan baik bersama teman-teman. Jangan gunakan pembuka atau penutup surat, langsung berikan 1 paragraf narasi rapor. Gunakan kata 'Ananda' untuk merujuk pada siswa.";
        } else {
            $prompt = "Buatkan satu paragraf narasi rapor TK/RA yang ramah, sopan, dan memotivasi untuk siswa bernama {$nama} ({$jk}) mengenai perkembangan 'Literasi & STEAM (Matematika)'. Ceritakan bahwa Ananda memiliki rasa ingin tahu tinggi, mulai mengenal huruf dan angka dengan baik, serta aktif dalam kegiatan bereksplorasi. Jangan gunakan pembuka atau penutup surat, langsung berikan 1 paragraf narasi rapor. Gunakan kata 'Ananda' untuk merujuk pada siswa.";
        }

        $apiKey = config('services.gemini.key');
        if (!$apiKey) {
            return response()->json(['error' => 'API Key Gemini belum diatur.'], 500);
        }

        try {
            $response = \Illuminate\Support\Facades\Http::post('https://generativelanguage.googleapis.com/v1beta/models/gemini-3.6-flash:generateContent?key=' . $apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Gagal memproses narasi.';
                return response()->json(['narasi' => trim($text)]);
            }

            return response()->json(['error' => 'Gagal terhubung ke AI. Error: ' . $response->body()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan sistem: ' . $e->getMessage()], 500);
        }
    }
}
