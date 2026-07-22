<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;

// Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route yang butuh login
Route::middleware(['auth'])->group(function () {

    // Profile (dari Breeze)
Route::get('/profile', function() {
    return redirect('/dashboard');
})->name('profile.edit');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Film CRUD
    Route::resource('film', FilmController::class);

    // Studio CRUD
    Route::resource('studio', StudioController::class);

    // Jadwal CRUD
    Route::resource('jadwal', JadwalController::class);

    // Pemesanan
    Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
    Route::get('/pemesanan/buat', [PemesananController::class, 'create'])->name('pemesanan.create');
    Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store');
    Route::get('/pemesanan/{id}', [PemesananController::class, 'show'])->name('pemesanan.show');

    //menghapus film
    Route::delete('/pemesanan/{id}', [PemesananController::class, 'destroy'])->name('pemesanan.destroy');

    
});

require __DIR__.'/auth.php';