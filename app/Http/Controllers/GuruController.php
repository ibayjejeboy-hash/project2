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
        $kelas = Kelas::with('waliKelas')->get();

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
            // Lepaskan wali kelas sebelumnya jika ada
            Kelas::where('id', $request->kelas_id)->update([
                'wali_kelas_id' => $user->id,
            ]);
        }

        return back()->with('success', "Data dewan guru '{$user->name}' berhasil ditambahkan!");
    }

    public function update(Request $request, $id)
    {
        $guru = User::where('role', 'guru')->findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email,' . $guru->id,
            'password' => 'nullable|string|min:6',
            'kelas_id' => 'nullable|exists:kelas,id',
        ]);

        $updateData = [
            'name'  => $request->name,
            'email' => strtolower(trim($request->email)),
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $guru->update($updateData);

        // Update penugasan wali kelas
        // 1. Lepaskan penugasan lama jika ada
        Kelas::where('wali_kelas_id', $guru->id)->update(['wali_kelas_id' => null]);

        // 2. Jika memilih kelas baru, tugaskan
        if ($request->filled('kelas_id')) {
            Kelas::where('id', $request->kelas_id)->update([
                'wali_kelas_id' => $guru->id,
            ]);
        }

        return back()->with('success', "Data dan penugasan guru '{$guru->name}' berhasil diperbarui!");
    }

    public function destroy($id)
    {
        $guru = User::where('role', 'guru')->findOrFail($id);
        $nama = $guru->name;

        // Lepaskan penugasan wali kelas jika ada
        Kelas::where('wali_kelas_id', $guru->id)->update(['wali_kelas_id' => null]);

        $guru->delete();

        return back()->with('success', "Akun guru '{$nama}' berhasil dihapus.");
    }
}
