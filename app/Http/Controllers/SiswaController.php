<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::with('kelas')->latest()->get();
        $kelas = Kelas::all();

        return view('admin.siswa', compact('siswas', 'kelas'));
    }

    public function dashboard($id = null)
    {
        $user = auth()->user();

        if ($user->role === 'siswa') {
            $siswa = Siswa::where('user_id', $user->id)->first();
            if (!$siswa) {
                return redirect()->route('login')->with('error', 'Data profil siswa Anda belum terdaftar. Silakan hubungi admin sekolah!');
            }
        } else {
            $siswa = $id ? Siswa::findByIdentifierOrFail($id) : Siswa::first();
        }

        return view('siswa.dashboard', compact('siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'            => 'required|string|max:255',
            'nis'             => 'required|string|max:50',
            'kelas_id'        => 'nullable|exists:kelas,id',
            'email'           => 'nullable|email|max:255',
            'foto'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'jenis_kelamin'   => 'nullable|string|max:20',
            'tempat_lahir'    => 'nullable|string|max:100',
            'tanggal_lahir'   => 'nullable|date',
            'no_hp'           => 'nullable|string|max:20',
        ]);

        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('siswa', 'public');
        }

        $emailClean = $request->email ? strtolower(trim($request->email)) : null;

        $siswa = Siswa::create([
            'nama'             => $request->nama,
            'nama_panggilan'   => $request->nama_panggilan,
            'nis'              => $request->nis,
            'kelas_id'         => $request->kelas_id,
            'jenis_kelamin'    => $request->jenis_kelamin,
            'tempat_lahir'     => $request->tempat_lahir,
            'tanggal_lahir'    => $request->tanggal_lahir,
            'agama'            => $request->agama,
            'anak_ke'          => $request->anak_ke,
            'nama_ayah'        => $request->nama_ayah,
            'nama_ibu'         => $request->nama_ibu,
            'no_hp'            => $request->no_hp,
            'email'            => $emailClean,
            'pekerjaan_ayah'   => $request->pekerjaan_ayah,
            'pekerjaan_ibu'    => $request->pekerjaan_ibu,
            'alamat'           => $request->alamat,
            'kode_pos'         => $request->kode_pos,
            'kecamatan'        => $request->kecamatan,
            'kota'             => $request->kota,
            'provinsi'         => $request->provinsi,
            'tanggal_diterima' => $request->tanggal_diterima,
            'foto'             => $foto,
        ]);

        return redirect()->route('admin.user.create', $siswa->id)
            ->with('success', 'Data siswa berhasil disimpan!');
    }

    public function edit($id)
    {
        $siswa = Siswa::findByIdentifierOrFail($id);
        $kelas = Kelas::all();

        return view('admin.siswa-edit', compact('siswa', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findByIdentifierOrFail($id);

        $request->validate([
            'nama'            => 'required|string|max:255',
            'nis'             => 'required|string|max:50',
            'kelas_id'        => 'nullable|exists:kelas,id',
            'email'           => 'nullable|email|max:255',
            'foto'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $foto = $siswa->foto;
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
                Storage::disk('public')->delete($siswa->foto);
            }
            $foto = $request->file('foto')->store('siswa', 'public');
        }

        $emailClean = $request->email ? strtolower(trim($request->email)) : null;

        $siswa->update([
            'nama'             => $request->nama,
            'nama_panggilan'   => $request->nama_panggilan,
            'nis'              => $request->nis,
            'kelas_id'         => $request->kelas_id,
            'jenis_kelamin'    => $request->jenis_kelamin,
            'tempat_lahir'     => $request->tempat_lahir,
            'tanggal_lahir'    => $request->tanggal_lahir,
            'agama'            => $request->agama,
            'anak_ke'          => $request->anak_ke,
            'nama_ayah'        => $request->nama_ayah,
            'nama_ibu'         => $request->nama_ibu,
            'no_hp'            => $request->no_hp,
            'email'            => $emailClean,
            'pekerjaan_ayah'   => $request->pekerjaan_ayah,
            'pekerjaan_ibu'    => $request->pekerjaan_ibu,
            'alamat'           => $request->alamat,
            'kode_pos'         => $request->kode_pos,
            'kecamatan'        => $request->kecamatan,
            'kota'             => $request->kota,
            'provinsi'         => $request->provinsi,
            'tanggal_diterima' => $request->tanggal_diterima,
            'foto'             => $foto,
        ]);

        return redirect()->route('admin.siswa')
            ->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findByIdentifierOrFail($id);

        // Hapus foto jika ada di disk public
        if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
            Storage::disk('public')->delete($siswa->foto);
        }

        $siswa->delete();

        return back()->with('success', 'Data siswa berhasil dihapus!');
    }

    public function akun($id)
    {
        $siswa = Siswa::findByIdentifierOrFail($id);
        $user = $siswa->user_id ? User::find($siswa->user_id) : null;

        return view('admin.user-create', compact('siswa', 'user'));
    }

    public function updateAkun(Request $request, $id)
    {
        $siswa = Siswa::findByIdentifierOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'password' => 'nullable|string|min:6',
        ]);

        $emailClean = strtolower(trim($request->email));

        // FIX BUG-05: Buat user baru jika belum ada
        if ($siswa->user_id) {
            $user = User::find($siswa->user_id);
        } else {
            $user = User::whereRaw('LOWER(email) = ?', [$emailClean])->first();
            if (!$user) {
                $user = new User();
                $user->role = 'siswa';
            }
        }

        $user->name = $request->name;
        $user->email = $emailClean;
        $user->role = 'siswa';

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        } elseif (!$user->exists) {
            $user->password = Hash::make('password123'); // Default password hanya jika baru dibuat manual
        }

        $user->save();

        $siswa->update([
            'user_id' => $user->id,
            'email'   => $emailClean,
        ]);

        return back()->with('success', 'Akun login siswa berhasil disimpan!');
    }
}
