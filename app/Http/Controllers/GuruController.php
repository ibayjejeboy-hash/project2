<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Kelas;

class GuruController extends Controller
{
   public function index()
{
    $gurus = User::where('role', 'guru')->get();
    $kelas = Kelas::all();

    return view('admin.guru', compact('gurus', 'kelas'));
}

   public function store(Request $request)
{
    // 1. buat user (akun)
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'guru'
    ]);

    // 2. kalau dipilih jadi wali kelas
    if ($request->kelas_id) {
        Kelas::where('id', $request->kelas_id)
            ->update([
                'wali_kelas_id' => $user->id
            ]);
    }

    return back()->with('success', 'Guru berhasil ditambahkan');
}
}
