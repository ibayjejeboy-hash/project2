<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Galeri;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Pendaftaran;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalGaleri = Galeri::count();
        $totalSiswa = Siswa::count();
        $totalGuru = User::where('role', 'guru')->count();
        $totalPendaftaran = Pendaftaran::count();

        return view('admin.dashboard', compact('totalGaleri', 'totalSiswa', 'totalGuru', 'totalPendaftaran'));
    }

    public function user()
    {
        $users = User::latest()->get();
        return view('admin.user', compact('users'));
    }

    public function createUser($id)
    {
        $siswa = Siswa::findOrFail($id);
        $user = $siswa->user_id ? User::find($siswa->user_id) : null;

        return view('admin.user-create', compact('siswa', 'user'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:admin,guru,siswa',
        ]);

        $emailClean = strtolower(trim($request->email));

        $user = User::create([
            'name'     => $request->name,
            'email'    => $emailClean,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        if ($request->filled('siswa_id')) {
            Siswa::where('id', $request->siswa_id)->update([
                'user_id' => $user->id,
                'email'   => $user->email,
            ]);
        }

        return redirect()->route('admin.user')->with('success', 'Akun pengguna berhasil dibuat!');
    }

    public function login()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'guru') {
                return redirect()->route('erapor.dashboard');
            } else {
                $siswa = Siswa::where('user_id', $user->id)->first();
                return $siswa
                    ? redirect()->route('siswa.dashboard', $siswa->id)
                    : redirect()->route('home');
            }
        }

        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials['email'] = strtolower(trim($credentials['email']));

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate(); // Mencegah serangan Session Fixation

            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            } elseif ($user->role === 'guru') {
                return redirect()->intended(route('erapor.dashboard'));
            } elseif ($user->role === 'siswa') {
                $siswa = Siswa::where('user_id', $user->id)->first();
                if ($siswa) {
                    return redirect()->intended(route('siswa.dashboard', $siswa->id));
                } else {
                    return redirect()->route('home')->with('info', 'Selamat datang! Profil siswa Anda belum dihubungkan.');
                }
            }
        }

        return back()->with('error', 'Email atau password yang Anda masukkan salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar (logout).');
    }
}
