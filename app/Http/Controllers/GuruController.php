<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = User::where('role', 'guru')->with('waliKelas')->latest()->get();
        $kelas = Kelas::all();

        return view('admin.guru', compact('gurus', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:6',
            'kelas_id' => 'nullable|exists:kelas,id',
        ]);

        $emailClean = strtolower(trim($request->email));

        // 1. Buat user akun guru
        $user = User::create([
            'name'     => $request->name,
            'email'    => $emailClean,
            'password' => Hash::make($request->password),
            'role'     => 'guru',
        ]);

        // 2. Set sebagai wali kelas jika dipilih
        if ($request->filled('kelas_id')) {
            Kelas::where('id', $request->kelas_id)->update([
                'wali_kelas_id' => $user->id,
            ]);
        }

        return back()->with('success', 'Data guru berhasil ditambahkan!');
    }
}
