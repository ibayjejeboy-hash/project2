<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InformasiController extends Controller
{
    public function index()
    {
        $informasi = Informasi::first();

        return view('admin.informasi', compact('informasi'));
    }

    public function store(Request $request)
{
    $informasi = Informasi::first();

    if ($request->hasFile('foto')) {

        $foto = $request->file('foto')->store('informasi','public');

    } else {

        $foto = $informasi->foto ?? null;

    }

    Informasi::updateOrCreate(
        ['id' => 1],
        [
            'visi' => $request->visi,
            'misi' => $request->misi,
            'deskripsi' => $request->deskripsi,
            'foto' => $foto
        ]
    );

    return redirect()->back()->with('success','Informasi berhasil diperbarui');
}
}