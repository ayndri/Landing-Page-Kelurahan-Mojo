<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RwProfileController;
use App\Http\Controllers\Admin\PlantAdminController;
use App\Http\Controllers\Admin\UmkmAdminController;
use App\Http\Controllers\Admin\UmkmProductController;
use App\Http\Controllers\Admin\PengumumanAdminController;
use App\Http\Controllers\Admin\GaleriAdminController;
use App\Http\Controllers\Admin\AgendaAdminController;
use App\Http\Controllers\Admin\RtAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\KontakController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/rw/{rw}', [HomeController::class, 'rwProfile'])->name('rw.profile')->where('rw', '[0-9]+');

// Tanaman (semua RW)
Route::get('/tanaman', [PlantController::class, 'index'])->name('tanaman.index');
Route::get('/tanaman/{plant}', [PlantController::class, 'show'])->name('tanaman.show');

// UMKM (semua RW)
Route::get('/umkm', [UmkmController::class, 'index'])->name('umkm.index');
Route::get('/umkm/{umkm}', [UmkmController::class, 'show'])->name('umkm.show');
Route::get('/umkm/{umkm}/produk/{product}', [UmkmController::class, 'showProduct'])->name('umkm.produk.show');

// Peta interaktif — umum (seluruh kelurahan) & per-RW
Route::get('/peta', [PlantController::class, 'peta'])->name('peta');
Route::get('/rw/{rw}/peta', [PlantController::class, 'petaRw'])->name('rw.peta')->where('rw', '[0-9]+');

// Pengumuman
Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
Route::get('/pengumuman/{pengumuman}', [PengumumanController::class, 'show'])->name('pengumuman.show');

// Galeri
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');

// Agenda
Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');

// Kontak & Layanan
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');

// Admin auth
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware('auth.admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Profil RW
        Route::get('/profil', [RwProfileController::class, 'edit'])->name('profil.edit');
        Route::post('/profil', [RwProfileController::class, 'update'])->name('profil.update');

        // Daftar RT
        Route::prefix('rt')->name('rt.')->group(function () {
            Route::get('/', [RtAdminController::class, 'index'])->name('index');
            Route::get('/tambah', [RtAdminController::class, 'create'])->name('create');
            Route::post('/', [RtAdminController::class, 'store'])->name('store');
            Route::get('/{rt}/edit', [RtAdminController::class, 'edit'])->name('edit');
            Route::put('/{rt}', [RtAdminController::class, 'update'])->name('update');
            Route::delete('/{rt}', [RtAdminController::class, 'destroy'])->name('destroy');
        });

        // Tanaman - semua admin RW bisa kelola data milik mereka
        Route::prefix('tanaman')->name('tanaman.')->group(function () {
            Route::get('/', [PlantAdminController::class, 'index'])->name('index');
            Route::get('/tambah', [PlantAdminController::class, 'create'])->name('create');
            Route::post('/', [PlantAdminController::class, 'store'])->name('store');
            Route::get('/{plant}/edit', [PlantAdminController::class, 'edit'])->name('edit');
            Route::put('/{plant}', [PlantAdminController::class, 'update'])->name('update');
            Route::delete('/{plant}', [PlantAdminController::class, 'destroy'])->name('destroy');
        });

        // Galeri
        Route::prefix('galeri')->name('galeri.')->group(function () {
            Route::get('/', [GaleriAdminController::class, 'index'])->name('index');
            Route::get('/tambah', [GaleriAdminController::class, 'create'])->name('create');
            Route::post('/', [GaleriAdminController::class, 'store'])->name('store');
            Route::get('/{galeri}/edit', [GaleriAdminController::class, 'edit'])->name('edit');
            Route::put('/{galeri}', [GaleriAdminController::class, 'update'])->name('update');
            Route::delete('/{galeri}', [GaleriAdminController::class, 'destroy'])->name('destroy');
        });

        // Agenda
        Route::prefix('agenda')->name('agenda.')->group(function () {
            Route::get('/', [AgendaAdminController::class, 'index'])->name('index');
            Route::get('/tambah', [AgendaAdminController::class, 'create'])->name('create');
            Route::post('/', [AgendaAdminController::class, 'store'])->name('store');
            Route::get('/{agenda}/edit', [AgendaAdminController::class, 'edit'])->name('edit');
            Route::put('/{agenda}', [AgendaAdminController::class, 'update'])->name('update');
            Route::delete('/{agenda}', [AgendaAdminController::class, 'destroy'])->name('destroy');
        });

        // Pengumuman
        Route::prefix('pengumuman')->name('pengumuman.')->group(function () {
            Route::get('/', [PengumumanAdminController::class, 'index'])->name('index');
            Route::get('/tambah', [PengumumanAdminController::class, 'create'])->name('create');
            Route::post('/', [PengumumanAdminController::class, 'store'])->name('store');
            Route::get('/{pengumuman}/edit', [PengumumanAdminController::class, 'edit'])->name('edit');
            Route::put('/{pengumuman}', [PengumumanAdminController::class, 'update'])->name('update');
            Route::delete('/{pengumuman}', [PengumumanAdminController::class, 'destroy'])->name('destroy');
        });

        // UMKM - semua admin RW bisa kelola data milik mereka
        Route::prefix('umkm')->name('umkm.')->group(function () {
            Route::get('/', [UmkmAdminController::class, 'index'])->name('index');
            Route::get('/tambah', [UmkmAdminController::class, 'create'])->name('create');
            Route::post('/', [UmkmAdminController::class, 'store'])->name('store');
            Route::get('/{umkm}/edit', [UmkmAdminController::class, 'edit'])->name('edit');
            Route::put('/{umkm}', [UmkmAdminController::class, 'update'])->name('update');
            Route::delete('/{umkm}', [UmkmAdminController::class, 'destroy'])->name('destroy');
            // Produk
            Route::post('/{umkm}/produk', [UmkmProductController::class, 'store'])->name('produk.store');
            Route::put('/{umkm}/produk/{product}', [UmkmProductController::class, 'update'])->name('produk.update');
            Route::delete('/{umkm}/produk/{product}', [UmkmProductController::class, 'destroy'])->name('produk.destroy');
        });

        // Pengguna — super_admin only (enforced in controller)
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserAdminController::class, 'index'])->name('index');
            Route::get('/tambah', [UserAdminController::class, 'create'])->name('create');
            Route::post('/', [UserAdminController::class, 'store'])->name('store');
            Route::get('/{user}/edit', [UserAdminController::class, 'edit'])->name('edit');
            Route::put('/{user}', [UserAdminController::class, 'update'])->name('update');
            Route::delete('/{user}', [UserAdminController::class, 'destroy'])->name('destroy');
        });
    });
});
