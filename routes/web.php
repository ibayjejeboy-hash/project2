<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GaleriController;
use App\Models\Galeri;
use App\Http\Controllers\InformasiController;
use App\Models\Informasi;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EraporController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\AuthController;



Route::get('/', [HomeController::class, 'home'])->name('home');


    // route tampilan
Route::get('/erapor', function () {
    return view('erapor');
})->name('erapor');


Route::get('/galeri', function () {
    return view('galeri');
})->name('galeri');

Route::get('/pendaftaran', function () {
    return view('pendaftaran');
})->name('pendaftaran');


    // route admin
Route::get('/admin/login', [AdminController::class, 'login'])
    ->name('admin.login');

Route::post('/admin/login', [AdminController::class, 'authenticate'])
    ->name('admin.authenticate');

Route::get('/login', [AdminController::class, 'login'])
    ->name('login');

    Route::get('/auth/google', [AuthController::class, 'redirectGoogle']);
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogle']);

Route::post('/logout', [AdminController::class, 'logout'])
    ->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

Route::put('/admin/siswa/{id}',
    [SiswaController::class, 'update']
)->name('admin.siswa.update');

Route::delete('/admin/siswa/{id}',
    [SiswaController::class, 'destroy']
)->name('admin.siswa.destroy');

Route::get('/admin/siswa/edit/{id}',
    [SiswaController::class, 'edit']
)->name('admin.siswa.edit');

Route::get(
    '/admin/siswa/akun/{id}',
    [SiswaController::class, 'akun']
)->name('admin.user-create');

Route::put(
    '/admin/siswa/akun/update/{id}',
    [SiswaController::class, 'updateAkun']
)->name('admin.user-create.update');

});


    // route galeri
Route::get('/admin/galeri', [GaleriController::class, 'index'])->name('admin.galeri');
Route::post('/admin/galeri', [GaleriController::class, 'store'])->name('admin.galeri.store');
Route::put('/admin/galeri/{id}', [GaleriController::class, 'update'])->name('admin.galeri.update');
Route::delete('/admin/galeri/{id}', [GaleriController::class, 'destroy'])->name('admin.galeri.destroy');

Route::get('/galeri', function () {
    $galeris = Galeri::latest()->get();
    return view('galeri', compact('galeris'));
})->name('galeri');

    // route informasi

Route::get('/admin/informasi', [InformasiController::class, 'index'])->name('admin.informasi');
Route::post('/admin/informasi', [InformasiController::class, 'store'])->name('admin.informasi.store');
Route::put('/admin/informasi/{id}', [InformasiController::class, 'update'])->name('admin.informasi.update');

    // erapor
Route::get('/erapor/dashboard', [EraporController::class, 'dashboard'])->name('erapor.dashboard');

Route::get('/erapor/input', [EraporController::class, 'input'])->name('erapor.input');
Route::post('/erapor/store', [EraporController::class, 'store'])->name('erapor.store');

Route::get('/erapor/cetak/{id}', [EraporController::class, 'cetak'])->name('erapor.cetak');
Route::get('/erapor/hasil/{id}', [EraporController::class, 'hasil'])->name('erapor.hasil');

Route::get('/erapor-redirect', function () {

    Session::put('akses_erapor', true);

    return redirect(env('ERAPORT_URL')); })->name('erapor.redirect');

Route::get('/erapor/edit/{id}', [EraporController::class, 'edit'])->name('erapor.edit');
Route::put('/erapor/update/{id}', [EraporController::class, 'update'])->name('erapor.update');

    // siswa
    Route::get('/admin/siswa', [SiswaController::class, 'index'])->name('admin.siswa');
Route::post('/admin/siswa', [SiswaController::class, 'store'])->name('admin.siswa.store');
Route::put('/admin/siswa/{id}', [SiswaController::class, 'update'])->name('admin.siswa.update');
Route::delete('/admin/siswa/{id}', [SiswaController::class, 'destroy'])->name('admin.siswa.destroy');
Route::get('/siswa/dashboard/{id}', [SiswaController::class, 'dashboard'])
    ->name('siswa.dashboard');
Route::get('/admin/user', [AdminController::class, 'user'])->name('admin.user');
Route::post('/admin/user', [AdminController::class, 'storeUser'])->name('admin.user.store');
Route::get('/admin/user/create/{id}', [AdminController::class, 'createUser'])
    ->name('admin.user.create');

Route::get('/siswa/rapor/{id}', [EraporController::class, 'hasil'])
    ->name('siswa.hasil');

Route::get('/siswa/cetak/{id}', [EraporController::class, 'cetak'])
    ->name('siswa.cetak');

    // guru
Route::get('/admin/guru', [GuruController::class, 'index'])->name('admin.guru');
Route::post('/admin/guru', [GuruController::class, 'store'])->name('admin.guru.store');

    // wilayah
    Route::get('/api/provinsi', [WilayahController::class, 'provinsi']);
Route::get('/api/kabupaten/{id}', [WilayahController::class, 'kabupaten']);
Route::get('/api/kecamatan/{id}', [WilayahController::class, 'kecamatan']);