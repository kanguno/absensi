<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\DataMahasiswa;
use App\Livewire\DataProdi;
use App\Livewire\DataFakultas;
use App\Livewire\DataDosen;
use App\Livewire\DataMatkul;
use App\Livewire\DataSebaranMatkul;
use App\Livewire\DataPerkuliahan;
use App\Livewire\UserControl;
use App\Livewire\AbsenMahasiswa;
use App\Livewire\CeklistAbsensi;
use App\Livewire\ReportAbsensi;
use App\Livewire\CetakAbsensiHarian;

use App\Http\Middleware\CheckUserOtoritas;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::get('/data-absensi-{idperkuliahan}', AbsenMahasiswa::class)->name('absensimahasiswa');

Route::get('/link-absen-{qrlink}', [DataPerkuliahan::class, 'redirectToAbsensi']);

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');
// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

  

    Route::middleware(['auth', 'check.otoritas'])->group(function () {
        Route::get('/user-controll', UserControl::class)->name('usercontroll');
        Route::get('/data-mahasiswa', DataMahasiswa::class)->middleware(['auth'])->name('datamahasiswa');
        Route::get('/data-prodi', DataProdi::class)->middleware(['auth'])->name('dataprodi');
        Route::get('/data-fakultas', DataFakultas::class)->middleware(['auth'])->name('datafakultas');
        Route::get('/data-dosen', DataDosen::class)->middleware(['auth'])->name('datadosen');
        Route::get('/data-matkul', DataMatkul::class)->middleware(['auth'])->name('datamatkul');
        Route::get('/data-sebaran-matkul', DataSebaranMatkul::class)->middleware(['auth'])->name('datasebaranmatkul');
        
    });
    
    Route::get('/data-perkuliahan', DataPerkuliahan::class)->middleware(['auth'])->name('dataperkuliahan');
    Route::get('/ceklist-absensi-{idperkuliahan}', CeklistAbsensi::class)->middleware(['auth'])->name('ceklistabsensi');
    Route::get('/report-absensi', ReportAbsensi::class)->middleware(['auth'])->name('reportabsensi');
    Route::get('/cetak-absensi-harian-{idperkuliahan}', CetakAbsensiHarian::class)->middleware(['auth'])->name('cetakabsensiharian');
    
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    
        return redirect('/');
    })->name('logout');
require __DIR__.'/auth.php';
