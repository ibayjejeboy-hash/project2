<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
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
        $request->validate([
            'nama_anak' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'nama_ortu' => 'required|string|max:255',
            'no_hp'     => 'required|string|max:25',
            'alamat'    => 'required|string',
        ]);

        Pendaftaran::create([
            'nama_anak' => $request->nama_anak,
            'tgl_lahir' => $request->tgl_lahir,
            'nama_ortu' => $request->nama_ortu,
            'no_hp'     => $request->no_hp,
            'alamat'    => $request->alamat,
            'status'    => 'pending',
        ]);

        return back()->with('success', 'Pendaftaran online berhasil dikirim! Pihak sekolah akan segera menghubungi Anda.');
    }
}