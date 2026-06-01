<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendaftaranController extends Controller
{
    public function store(Request $request)
    {
        DB::table('pendaftaran')->insert([
            'nama_anak' => $request->nama_anak,
            'tgl_lahir' => $request->tgl_lahir,
            'nama_ortu' => $request->nama_ortu,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'status' => 'pending',
            'created_at' => now(),
        ]);

        return back()->with('success', 'Pendaftaran berhasil!');
    }

    public function index()
{
    $data = DB::table('pendaftaran')->latest()->get();

    return view('admin.pendaftaran.index', compact('data'));
}

}