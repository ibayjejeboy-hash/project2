<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
  public function index()
{
    $siswas = Siswa::all();

    $kelas = Kelas::all();

    return view('admin.siswa', compact(
        'siswas',
        'kelas'
    ));
}

  public function dashboard()
{
    $siswa = Siswa::where(
        'user_id',
        auth()->id()
    )->first();

    return view('siswa.dashboard', compact('siswa'));
}

    public function store(Request $request)
{
    // upload foto
    if($request->hasFile('foto')){
        $foto = $request->file('foto')->store('siswa','public');
    } else {
        $foto = null;
    }

    // simpan data (user_id dibiarkan null, akan dilink otomatis saat siswa login Google)
    $siswa = Siswa::create([ 
        'nama' => $request->nama,
        'nama_panggilan' => $request->nama_panggilan,
        'nis' => $request->nis,
        'kelas_id' => $request->kelas_id,
        'jenis_kelamin' => $request->jenis_kelamin,
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'agama' => $request->agama,
        'anak_ke' => $request->anak_ke,
        'nama_ayah' => $request->nama_ayah,
        'nama_ibu' => $request->nama_ibu,
        'no_hp' => $request->no_hp,
        'email' => $request->email ? strtolower(trim($request->email)) : null,
        'pekerjaan_ayah' => $request->pekerjaan_ayah,
        'pekerjaan_ibu' => $request->pekerjaan_ibu,
        'alamat' => $request->alamat,
        'kode_pos' => $request->kode_pos,
        'kecamatan' => $request->kecamatan,
        'kota' => $request->kota,
        'provinsi' => $request->provinsi,
        'tanggal_diterima' => $request->tanggal_diterima,
        'foto' => $foto
    ]);

     return redirect()->route('admin.user.create', $siswa->id);
}

public function edit($id)
{
    $siswa = Siswa::findOrFail($id);

    $kelas = Kelas::all();

    return view('admin.siswa-edit', compact(
        'siswa',
        'kelas'
    ));
}

public function update(Request $request, $id)
{
    $siswa = Siswa::findOrFail($id);

    // FOTO
    if ($request->hasFile('foto')) {

        $foto = $request->file('foto')
                        ->store('siswa', 'public');

    } else {

        $foto = $siswa->foto;
    }

    // UPDATE DATA
    $siswa->update([

        'nama' => $request->nama,
        'nama_panggilan' => $request->nama_panggilan,
        'nis' => $request->nis,
        'kelas_id' => $request->kelas_id,
        'jenis_kelamin' => $request->jenis_kelamin,
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'agama' => $request->agama,
        'anak_ke' => $request->anak_ke,

        'nama_ayah' => $request->nama_ayah,
        'nama_ibu' => $request->nama_ibu,
        'no_hp' => $request->no_hp,
        'email' => $request->email ? strtolower(trim($request->email)) : null,
        'pekerjaan_ayah' => $request->pekerjaan_ayah,
        'pekerjaan_ibu' => $request->pekerjaan_ibu,

        'alamat' => $request->alamat,
        'kode_pos' => $request->kode_pos,
        'kecamatan' => $request->kecamatan,
        'kota' => $request->kota,
        'provinsi' => $request->provinsi,

        'tanggal_diterima' => $request->tanggal_diterima,

        'foto' => $foto,
    ]);

    return redirect()
        ->route('admin.siswa')
        ->with('success', 'Data siswa berhasil diupdate');
}

public function destroy($id)
{
    $siswa = Siswa::findOrFail($id);

    // hapus foto kalau ada
    if ($siswa->foto && file_exists(public_path('storage/'.$siswa->foto))) {
        unlink(public_path('storage/'.$siswa->foto));
    }

    $siswa->delete();

    return back()->with('success', 'Data siswa berhasil dihapus');
}

public function akun($id)
{
    $siswa = Siswa::findOrFail($id);

    $user = User::find($siswa->user_id);

    return view('admin.user-create', compact(
        'siswa',
        'user'
    ));
}

public function updateAkun(Request $request, $id)
{
    $siswa = Siswa::findOrFail($id);

    $user = User::findOrFail($siswa->user_id);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    $siswa->update([
        'email' => $request->email,
    ]);

    // PASSWORD OPSIONAL
    if ($request->password) {

        $user->update([
            'password' => Hash::make($request->password)
        ]);

    }

    return back()->with(
        'success',
        'Akun siswa berhasil diupdate'
    );
}

}
