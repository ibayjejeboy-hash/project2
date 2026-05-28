<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Galeri;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function user()
{
    $users = User::all();
    return view('admin.user', compact('users'));
}

public function storeUser(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ]);

    $user = User::create([ 
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role ?? 'siswa',
    ]);

    if ($request->siswa_id) {
        Siswa::where('id', $request->siswa_id)
            ->update([
                'user_id' => $user->id,
                'email' => $user->email,
            ]);
    } else {
        if ($user->role == 'siswa') {
            Siswa::create([
                'nama' => $user->name,
                'email' => $user->email,
                'user_id' => $user->id,
            ]);
        }
    }

    if ($user->role == 'guru') {
        return redirect()->route('erapor.dashboard');
    }

    return redirect()->route('admin.siswa')->with('success','Akun berhasil dibuat');
}

    public function login()
{
    return view('admin.login');
}

public function authenticate(Request $request)
{
    if (Auth::attempt($request->only('email','password')))
    {
        $user = Auth::user();

        // 👨‍🏫 GURU
        if ($user->role == 'guru') {
            return redirect()->route('erapor.dashboard');
        }

        // 🧑‍🎓 SISWA
        if ($user->role == 'siswa') {

            $siswa = Siswa::where('user_id', $user->id)->first();

            if ($siswa) {
                return redirect('/siswa/dashboard/' . $siswa->id);
            } else {
                return back()->with('error','Data siswa tidak ditemukan');
            }
        }

        // 👑 ADMIN (optional)
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }
    }

    return back()->with('error','Login gagal');
}

public function createUser($id)
{
    $siswa = Siswa::findOrFail($id);

    $user = User::find($siswa->user_id);

    return view('admin.user-create', compact(
        'siswa',
        'user'
    ));
}

public function dashboard()
{
    $totalGaleri = Galeri::count();

    return view('admin.dashboard', compact('totalGaleri'));
}

public function logout()
{
    Auth::logout();
    return redirect()->route('admin.login');
}

public function create()
{
    $gurus = User::where('role', 'guru')->get();

    return view('admin.kelas.create', compact('gurus'));
}

}
