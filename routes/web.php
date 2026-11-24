<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DasboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TarifController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\KendaraanController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Petugas\TransaksiController;
use App\Http\Controllers\Petugas\DashboardController;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;
use App\Http\Controllers\Owner\LaporanController;

// ROUTE E LOGIN
// =========================

Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login']);



// ROUTE E ADMIN DASHBOARD
// =========================

Route::get('/admin/dasboard', [DasboardController::class, 'index'])
    ->name('admin.dasboard');


//  ROUTE E DATA USER
// =========================

Route::get('/admin/user', [UserController::class, 'index'])
    ->name('admin.user');

Route::get('/admin/user/create', [UserController::class, 'create'])
    ->name('admin.user.create');

    Route::post('/admin/user', [UserController::class, 'store'])
    ->name('admin.user.store');

Route::get('/admin/user/{id}/edit', [UserController::class, 'edit'])
    ->name('admin.user.edit');

Route::put('/admin/user/{id}', [UserController::class, 'update'])
    ->name('admin.user.update');

Route::delete('/admin/user/{id}', [UserController::class, 'destroy'])
    ->name('admin.user.destroy');
//  ROUTE E TARIF PARKIR
// =========================

Route::get('/admin/tarif', [TarifController::class, 'index'])
    ->name('admin.tarif');

Route::get('/admin/tarif/create', [TarifController::class, 'create'])
    ->name('admin.tarif.create');

Route::post('/admin/tarif', [TarifController::class, 'store'])
    ->name('admin.tarif.store');

Route::delete('/admin/tarif/{id}', [TarifController::class, 'destroy'])
    ->name('admin.tarif.destroy');

// ROUTE AREA PARKIR
// =========================

Route::get('/admin/area', [AreaController::class, 'index'])
    ->name('admin.area');

Route::get('/admin/area/create', [AreaController::class, 'create'])
    ->name('admin.area.create');

Route::post('/admin/area', [AreaController::class, 'store'])
    ->name('admin.area.store');

Route::get('/admin/area/{id}/edit', [AreaController::class, 'edit'])
    ->name('admin.area.edit');

Route::put('/admin/area/{id}', [AreaController::class, 'update'])
    ->name('admin.area.update');

Route::delete('/admin/area/{id}', [AreaController::class, 'destroy'])
    ->name('admin.area.destroy');

    // INI ROUTE E KENDARAAN

Route::get('/admin/kendaraan', [KendaraanController::class, 'index'])
    ->name('admin.kendaraan');

Route::get('/admin/kendaraan/create', [KendaraanController::class, 'create'])
    ->name('admin.kendaraan.create');

Route::post('/admin/kendaraan', [KendaraanController::class, 'store'])
    ->name('admin.kendaraan.store');

Route::delete('/admin/kendaraan/{id}', [KendaraanController::class, 'destroy'])
    ->name('admin.kendaraan.destroy');

    // INI ROUTE E LOG AKTIVITAS

Route::get('/admin/log', [LogController::class, 'index'])
    ->name('admin.log');

 
// =========================
// ROUTE DASHBOARD PETUGAS
// =========================

Route::get('/petugas/dashboard', [DashboardController::class, 'index'])
    ->name('petugas.dashboard');

Route::post('/petugas/transaksi/masuk', [TransaksiController::class, 'simpanMasuk'])
    ->name('petugas.transaksi.simpanMasuk');


// =========================
// ROUTE TRANSAKSI PETUGAS
// =========================

Route::get('/petugas/transaksi', [TransaksiController::class, 'index'])
    ->name('petugas.transaksi');

Route::get('/petugas/transaksi/cetak', [TransaksiController::class, 'cetak'])
    ->name('petugas.transaksi.cetak');

Route::get('/petugas/transaksi/masuk', [TransaksiController::class, 'masuk'])
    ->name('petugas.transaksi.masuk');

Route::get('/petugas/transaksi/keluar', [TransaksiController::class, 'keluar'])
    ->name('petugas.transaksi.keluar');


// =========================
// ROUTE DASHBOARD OWNER
// =========================

Route::get('/owner/dashboard', [OwnerDashboardController::class, 'index'])
    ->name('owner.dashboard');


// =========================
// ROUTE LOGOUT
// =========================

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

Route::post('/petugas/transaksi/keluar/{id}', [TransaksiController::class, 'prosesKeluar'])
    ->name('petugas.transaksi.prosesKeluar');

    //ROUTE E OWNER

Route::get('/owner/laporan', [LaporanController::class, 'index'])
    ->name('owner.laporan');

Route::get('/owner/laporan/cetak', [LaporanController::class, 'cetak'])
    ->name('owner.laporan.cetak');