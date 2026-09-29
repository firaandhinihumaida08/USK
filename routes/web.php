<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\SkemaController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('skema', SkemaController::class);
    Route::get('/mahasiswa/{mahasiswa}/cetak', [MahasiswaController::class, 'cetak'])->name('mahasiswa.cetak');
});

require __DIR__.'/auth.php';