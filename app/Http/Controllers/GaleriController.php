<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest()->get();
        return view('admin.galeri', compact('galeris'));
    }

    public function store(Request $request)
    {
       $path = $request->file('gambar')->store('galeri', 'public');

dd($path);
    }

    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);
        $request->validate([
            'judul' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

    if ($request->hasFile('gambar')) {

        // Hapus gambar lama
        if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
            Storage::disk('public')->delete($galeri->gambar);
        }

        $path = $request->file('gambar')->store('galeri', 'public');
        $galeri->gambar = $path;
    }

        $galeri->judul = $request->judul;
        $galeri->save();

        return redirect()->back()->with('success', 'Galeri berhasil diupdate!');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

    if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
        Storage::disk('public')->delete($galeri->gambar);
    }

        $galeri->delete();

        return redirect()->back()->with('success', 'Galeri berhasil dihapus!');
    }
}