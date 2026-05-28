<?php

namespace App\Http\Controllers;

use App\Models\Indikator;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\NilaiDeskripsi;
use App\Models\NilaiCheck;
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
        $siswas = Siswa::all();

        // P5
        $indikatorP5 = Indikator::where('kategori', 'p5')->get();

        // Profil Rahmatan
        $indikatorProfil = Indikator::where('kategori', 'profil')->get();

        return view('erapor.input', compact(
            'siswas',
            'indikatorP5',
            'indikatorProfil'
        ));
    }

    public function store(Request $request)
    {
        // =========================
        // SIMPAN DESKRIPSI
        // =========================
        NilaiDeskripsi::create([
            'siswa_id' => $request->siswa_id,
            'agama' => $request->agama,
            'jati_diri' => $request->jati_diri,
            'literasi' => $request->literasi,
            'semester' => '1'
        ]);

        // =========================
        // SIMPAN P5
        // =========================
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

        // =========================
        // SIMPAN PROFIL
        // =========================
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

        return back()->with('success', 'Rapor berhasil disimpan');
    }

    public function cetak($id)
    {
        $nilai = NilaiDeskripsi::with('siswa')->findOrFail($id);

        return view('erapor.cetak', compact('nilai'));
    }

    public function hasil($id)
    {
        $siswa = Siswa::findOrFail($id);

        // =========================
        // DESKRIPSI
        // =========================
        $nilai = NilaiDeskripsi::where('siswa_id', $id)->first();

        // =========================
        // P5
        // =========================
        $indikator = Indikator::where('kategori', 'p5')->get();

        $nilaiP5 = NilaiCheck::where('siswa_id', $id)
            ->where('kategori', 'p5')
            ->get();

        // =========================
        // PROFIL RAHMATAN
        // =========================
        $indikatorRahmatan = Indikator::where('kategori', 'profil')->get();

        $nilaiRahmatan = NilaiCheck::where('siswa_id', $id)
            ->where('kategori', 'profil')
            ->get();

        // =========================
        // LAYOUT
        // =========================
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
}