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
        $request->validate([
            'visi'      => 'nullable|string',
            'misi'      => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $informasi = Informasi::first();
        $foto = $informasi?->foto;

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($foto && Storage::disk('public')->exists($foto)) {
                Storage::disk('public')->delete($foto);
            }
            $foto = $request->file('foto')->store('informasi', 'public');
        }

        Informasi::updateOrCreate(
            ['id' => 1],
            [
                'visi'      => $request->visi,
                'misi'      => $request->misi,
                'deskripsi' => $request->deskripsi,
                'foto'      => $foto,
            ]
        );

        return redirect()->back()->with('success', 'Informasi profil sekolah berhasil diperbarui!');
    }
}