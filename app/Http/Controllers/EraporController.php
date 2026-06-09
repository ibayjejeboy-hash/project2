<?php

namespace App\Http\Controllers;

use App\Models\Indikator;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\NilaiDeskripsi;
use App\Models\NilaiCheck;
use App\Models\Kelas;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;

class EraporController extends Controller
{
    public function dashboard()
{
    $siswas = Siswa::all();

    return view('erapor.dashboard', compact('siswas'));
}

   public function input()
{
    $user = auth()->user();

    if ($user->role == 'admin') {
        // Admin bisa menginput nilai untuk semua siswa
        $siswas = Siswa::all();
    } else {
        // ambil kelas yang dia pegang
        $kelas = Kelas::where('wali_kelas_id', $user->id)->first();

        if ($kelas) {
            // ambil siswa berdasarkan kelas itu
            $siswas = Siswa::where('kelas_id', $kelas->id)->get();
        } else {
            // jika guru tidak/belum ditugaskan kelas, tampilkan semua siswa agar daftar tidak kosong
            $siswas = Siswa::all();
        }
    }

    // indikator
    $indikatorP5 = Indikator::where('kategori', 'p5')->get();
    $indikatorProfil = Indikator::where('kategori', 'profil')->get();

    return view('erapor.input', compact(
        'siswas',
        'indikatorP5',
        'indikatorProfil'
    ));
}


    public function store(Request $request)
{
     $user = auth()->user();

    if ($user->role !== 'admin') {
        $kelas = Kelas::where('wali_kelas_id', $user->id)->first();

        // pastikan siswa milik kelas dia (jika guru tersebut punya kelas)
        if ($kelas) {
            $valid = Siswa::where('id', $request->siswa_id)
                ->where('kelas_id', $kelas->id)
                ->exists();

            if (!$valid) {
                return back()->with('error', 'Siswa tidak valid');
            }
        }
    }
    // simpan deskripsi
    Nilai::create([
        'siswa_id' => $request->siswa_id,
        'agama' => $request->agama,
        'jati_diri' => $request->jati_diri,
        'literasi' => $request->literasi,
        'semester' => '1'
    ]);

    // simpan P5
    if ($request->p5) {
        foreach ($request->p5 as $indikator_id => $nilai) {
            NilaiCheck::create([
                'siswa_id' => $request->siswa_id,
                'indikator_id' => $indikator_id,
                'nilai' => $nilai,
                'kategori' => 'p5'
            ]);
        }
    }

    // simpan Profil
    if ($request->profil) {
        foreach ($request->profil as $indikator_id => $nilai) {
            NilaiCheck::create([
                'siswa_id' => $request->siswa_id,
                'indikator_id' => $indikator_id,
                'nilai' => $nilai,
                'kategori' => 'profil'
            ]);
        }
        
    }
    

    return back()->with('success','Rapor berhasil disimpan');
}

   public function cetak($id)
{
    $siswa = Siswa::with('kelas')->findOrFail($id);

    $nilai = Nilai::where('siswa_id', $id)->latest()->first();

    $indikator = Indikator::where('kategori','p5')->get();
    $nilaiP5 = NilaiCheck::where('siswa_id', $id)
                ->where('kategori','p5')
                ->get();

    $indikatorRahmatan = Indikator::where('kategori','profil')->get();
    $nilaiRahmatan = NilaiCheck::where('siswa_id', $id)
                ->where('kategori','profil')
                ->get();

    $pdf = Pdf::loadView('erapor.cetak', compact(
        'siswa',
        'nilai',
        'indikator',
        'nilaiP5',
        'indikatorRahmatan',
        'nilaiRahmatan'
    ));

    return $pdf->download('rapor-'.$siswa->nama.'.pdf');
}

   public function hasil($id)
{


    $siswa = Siswa::findOrFail($id);

    // 🔥 INI YANG KURANG
    $nilai = Nilai::where('siswa_id', $id)->latest()->first();

    // P5
    $indikator = Indikator::where('kategori','p5')->get();
    $nilaiP5 = NilaiCheck::where('siswa_id', $id)
                ->where('kategori','p5')
                ->get();

    // Profil Rahmatan Lil Alamin
$indikatorRahmatan = Indikator::where('kategori','profil')->get();

$nilaiRahmatan = NilaiCheck::where('siswa_id', $id)
            ->where('kategori','profil')
            ->get();

    // layout dinamis
    $layout = auth()->user()->role == 'siswa'
        ? 'siswa.layout'
        : 'erapor.layout';

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

public function edit($id)
{
    $siswa = Siswa::findOrFail($id);

    $nilai = Nilai::where('siswa_id', $id)->first();

    // P5
    $indikator = Indikator::where('kategori','p5')->get();
    $nilaiP5 = NilaiCheck::where('siswa_id', $id)
                ->where('kategori','p5')
                ->get();

    // PROFIL
    $indikatorRahmatan = Indikator::where('kategori','profil')->get();
    $nilaiRahmatan = NilaiCheck::where('siswa_id', $id)
                ->where('kategori','profil')
                ->get();

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
    $siswa = Siswa::findOrFail($id);

    // UPDATE NILAI UTAMA
    Nilai::updateOrCreate(
        ['siswa_id' => $id],
        [
            'agama' => $request->agama,
            'jati_diri' => $request->jati_diri,
            'literasi' => $request->literasi,
        ]
    );

    // UPDATE P5
    if ($request->p5) {
        foreach ($request->p5 as $indikator_id => $nilai) {
            NilaiCheck::updateOrCreate(
                [
                    'siswa_id' => $id,
                    'indikator_id' => $indikator_id
                ],
                [
                    'nilai' => $nilai,
                    'kategori' => 'p5'
                ]
            );
        }
    }

    // UPDATE Profil PPRA
    if ($request->profil) {
        foreach ($request->profil as $indikator_id => $nilai) {
            NilaiCheck::updateOrCreate(
                [
                    'siswa_id' => $id,
                    'indikator_id' => $indikator_id
                ],
                [
                    'nilai' => $nilai,
                    'kategori' => 'profil'
                ]
            );
        }
    }

    return redirect()->route('erapor.hasil', $id)
        ->with('success', 'Nilai berhasil diupdate!');
}

}

