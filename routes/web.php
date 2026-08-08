<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GaleriController;
use App\Models\Galeri;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EraporController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftaranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =========================================================================
// 1. PUBLIC SERVE STORAGE (Anti-Path Traversal Protected)
// =========================================================================
Route::get('/storage/{path}', function ($path) {
    // Cegah serangan directory traversal (../ atau ..\)
    if (str_contains($path, '..') || str_starts_with($path, '/') || str_starts_with($path, '\\')) {
        abort(403, 'Akses ilegal ke sistem file ditolak.');
    }

    $fullPath = storage_path('app/public/' . $path);

    if (!file_exists($fullPath) || is_dir($fullPath)) {
        abort(404);
    }

    $mimeType = mime_content_type($fullPath) ?: 'application/octet-stream';
    return response()->file($fullPath, ['Content-Type' => $mimeType]);
})->where('path', '.*')->name('storage.serve');


// =========================================================================
// 2. PUBLIC WEBSITE ROUTES
// =========================================================================
Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/erapor', function () {
    return view('erapor');
})->name('erapor');

Route::get('/galeri', function () {
    $galeris = Galeri::latest()->get();
    return view('galeri', compact('galeris'));
})->name('galeri');

// Pendaftaran Siswa Baru
Route::get('/pendaftaran', function () {
    return view('pendaftaran');
})->name('pendaftaran');

Route::get('/pendaftaran/alur', function () {
    return view('pendaftaran.alur');
})->name('pendaftaran.alur');

Route::get('/pendaftaran/syarat', function () {
    return view('pendaftaran.syarat');
})->name('pendaftaran.syarat');

Route::get('/pendaftaran/panduan', function () {
    return view('pendaftaran.panduan');
})->name('pendaftaran.panduan');

Route::get('/pendaftaran/form', function () {
    return view('pendaftaran.form');
})->name('pendaftaran.form');

Route::post('/pendaftaran/store', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

// API Wilayah Indonesia
Route::get('/api/provinsi', [WilayahController::class, 'provinsi'])->name('api.provinsi');
Route::get('/api/kabupaten/{id}', [WilayahController::class, 'kabupaten'])->name('api.kabupaten');
Route::get('/api/kecamatan/{id}', [WilayahController::class, 'kecamatan'])->name('api.kecamatan');


// =========================================================================
// 3. AUTHENTICATION ROUTES (Login, Google OAuth, Logout)
// =========================================================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('login');
    Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/admin/login', [AdminController::class, 'authenticate'])->name('admin.authenticate');

    // Google OAuth
    Route::get('/auth/google', [AuthController::class, 'redirectGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogle'])->name('auth.google.callback');
});

Route::post('/logout', [AdminController::class, 'logout'])->name('logout')->middleware('auth');


// =========================================================================
// 4. PROTECTED ROUTES: ADMIN ONLY (`role:admin`)
// =========================================================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Manajemen User
    Route::get('/user', [AdminController::class, 'user'])->name('user');
    Route::post('/user', [AdminController::class, 'storeUser'])->name('user.store');
    Route::get('/user/create/{id}', [AdminController::class, 'createUser'])->name('user.create');

    // Manajemen Data Siswa
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa');
    Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('/siswa/edit/{id}', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
    Route::get('/siswa/akun/{id}', [SiswaController::class, 'akun'])->name('user-create');
    Route::put('/siswa/akun/update/{id}', [SiswaController::class, 'updateAkun'])->name('user-create.update');

    // Manajemen Data Guru
    Route::get('/guru', [GuruController::class, 'index'])->name('guru');
    Route::post('/guru', [GuruController::class, 'store'])->name('guru.store');

    // Manajemen Galeri
    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');
    Route::post('/galeri', [GaleriController::class, 'store'])->name('galeri.store');
    Route::put('/galeri/{id}', [GaleriController::class, 'update'])->name('galeri.update');
    Route::delete('/galeri/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');

    // Manajemen Informasi Sekolah
    Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi');
    Route::post('/informasi', [InformasiController::class, 'store'])->name('informasi.store');

    // Manajemen Pendaftaran
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran');
});


// =========================================================================
// 5. PROTECTED ROUTES: GURU & ADMIN (`role:admin,guru`)
// =========================================================================
Route::middleware(['auth', 'role:admin,guru'])->prefix('erapor')->name('erapor.')->group(function () {
    Route::get('/dashboard', [EraporController::class, 'dashboard'])->name('dashboard');
    Route::get('/input', [EraporController::class, 'input'])->name('input');
    Route::post('/store', [EraporController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [EraporController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [EraporController::class, 'update'])->name('update');
    Route::get('/hasil/{id}', [EraporController::class, 'hasil'])->name('hasil');
    Route::get('/cetak/{id}', [EraporController::class, 'cetak'])->name('cetak');
});


// =========================================================================
// 6. PROTECTED ROUTES: SISWA & ALL AUTHENTICATED USERS
// =========================================================================
Route::middleware(['auth'])->group(function () {
    // Siswa Dashboard & Hasil Rapor (Anti-IDOR terverifikasi di Controller)
    Route::get('/siswa/dashboard/{id}', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
    Route::get('/siswa/rapor/{id}', [EraporController::class, 'hasil'])->name('siswa.hasil');
    Route::get('/siswa/cetak/{id}', [EraporController::class, 'cetak'])->name('siswa.cetak');
});