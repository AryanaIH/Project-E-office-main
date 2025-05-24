<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\JenisSuratController;
use App\Http\Controllers\TujuanSuratController;
use App\Http\Controllers\DokumenProyekController;
use App\Http\Controllers\pengaturanController;
use App\Http\Controllers\AuthController;




// Dashboard berdasarkan role
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
});

Route::get('/tambahSurat', function () {
    return view('tambahSurat');
});


Route::get('/masterBarang', function () {
    return view('MasterData');
});

Route::get('/departement', function () {
    return view('departemen');
});

Route::get('/pengguna', function () {
    return view('pengguna');
});

Route::get('/jenis-surat', function () {
    return view('jenis-surat');
});

Route::get('/tujuan-surat', function () {
    return view('tujuan-surat');
});

Route::get('/dokumen-proyek', function () {
    return view('dokumen-proyek');
});

Route::get('/monitoringProyek', function () {
    return view('monitoringProyek');
});

Route::get('/laporan', function () {
    return view('laporan');
});

Route::get('/pengaturan', function () {
    return view('pengaturan');
});

 Route::get('/pra-proyek', function () {
     return view('pra-proyek');
 });

use App\Http\Controllers\SuratKeluarController;

Route::get('/suratKeluar', [SuratKeluarController::class, 'index'])->name('surat-keluar.index');
Route::post('/surat-keluar', [SuratKeluarController::class, 'store'])->name('surat-keluar.store');
Route::get('/surat-keluar/{id}', [SuratKeluarController::class, 'show'])->name('surat-keluar.show');
Route::get('/surat-keluar/{id}/download', [SuratKeluarController::class, 'download'])->name('surat-keluar.download');
Route::get('/surat-keluar/{id}/edit', [SuratKeluarController::class, 'edit'])->name('surat-keluar.edit');
Route::put('/surat-keluar/{id}', [SuratKeluarController::class, 'update'])->name('surat-keluar.update');
Route::delete('/surat-keluar/{id}', [SuratKeluarController::class, 'destroy'])->name('surat-keluar.destroy'); // ✅ tambahkan ini
Route::get('/surat-keluar/{id}/preview', [SuratKeluarController::class, 'preview'])->name('surat-keluar.preview');



use App\Http\Controllers\PraProyekController;

// Halaman utama daftar pra-proyek
Route::get('/pra-proyek', [PraProyekController::class, 'index'])->name('pra-proyek.index');

// Proses tambah data
Route::post('/pra-proyek', [PraProyekController::class, 'store'])->name('pra-proyek.store');

// Form edit pra-proyek
Route::get('/pra-proyek/{id}/edit', [PraProyekController::class, 'edit'])->name('pra-proyek.edit');

// Proses update data
Route::put('/pra-proyek/{id}', [PraProyekController::class, 'update'])->name('pra-proyek.update');

// Proses hapus data
Route::delete('/pra-proyek/{id}', [PraProyekController::class, 'destroy'])->name('pra-proyek.destroy');




Route::get('/departement', [DepartementController::class, 'index'])->name('departement.index');
Route::post('/departement', [DepartementController::class, 'store'])->name('departement.store');
Route::get('/departement/{id}/edit', [DepartementController::class, 'edit'])->name('departement.edit');
Route::put('/departement/{id}', [DepartementController::class, 'update'])->name('departement.update');
Route::delete('/departement/{id}', [DepartementController::class, 'destroy'])->name('departement.destroy');



Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
Route::post('/pengguna', [PenggunaController::class, 'store'])->name('pengguna.store');
Route::put('/pengguna/{id}', [PenggunaController::class, 'update'])->name('pengguna.update');
Route::delete('/pengguna/{id}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');


Route::get('/jenis-surat', [JenisSuratController::class, 'index'])->name('jenis-surat.index');
Route::post('/jenis-surat', [JenisSuratController::class, 'store'])->name('jenis-surat.store');
Route::get('/jenis-surat/{id}/edit', [JenisSuratController::class, 'edit'])->name('jenis-surat.edit');
Route::put('/jenis-surat/{id}', [JenisSuratController::class, 'update'])->name('jenis-surat.update');
Route::delete('/jenis-surat/{id}', [JenisSuratController::class, 'destroy'])->name('jenis-surat.destroy');


Route::get('/tujuan-surat', [TujuanSuratController::class, 'index'])->name('tujuan-surat.index');
Route::post('/tujuan-surat', [TujuanSuratController::class, 'store'])->name('tujuan-surat.store');
Route::get('/tujuan-surat/{id}/edit', [TujuanSuratController::class, 'edit'])->name('tujuan-surat.edit');
Route::put('/tujuan-surat/{id}', [TujuanSuratController::class, 'update'])->name('tujuan-surat.update');
Route::delete('/tujuan-surat/{id}', [TujuanSuratController::class, 'destroy'])->name('tujuan-surat.destroy');
Route::get('/tujuan-surat/{id}', [TujuanSuratController::class, 'show'])->name('tujuan-surat.show');



Route::resource('dokumen-proyek', DokumenProyekController::class);


use App\Http\Controllers\MonitoringController;

Route::get('/monitoring', [MonitoringController::class, 'monitoring'])->name('monitoring');

use App\Http\Controllers\ImageController;

Route::get('/upload', function () {
    return view('upload');
});

Route::post('/upload', [ImageController::class, 'upload'])->name('image.upload');

Route::get('/login', [AuthController::class, 'formLogin'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan');
Route::post('/pengaturan', [PengaturanController::class, 'store'])->name('pengaturan.store');
Route::put('/pengaturan/{id}', [PengaturanController::class, 'update'])->name('pengaturan.update');
Route::delete('/pengaturan/{id}', [PengaturanController::class, 'destroy'])->name('pengaturan.destroy');
