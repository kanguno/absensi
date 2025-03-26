<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\DataMahasiswa;
use App\Livewire\DataProdi;
use App\Livewire\DataFakultas;
use App\Livewire\DataDosen;
use App\Livewire\DataMatkul;
use App\Livewire\DataSebaranMatkul;
use App\Livewire\DataPerkuliahan;
use App\Livewire\AbsenMahasiswa;
use App\Livewire\CeklistAbsensi;

Route::view('/', 'welcome');
Route::get('/data-absensi-{idperkuliahan}', AbsenMahasiswa::class)->name('absensimahasiswa');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

  

    Route::get('/data-mahasiswa', DataMahasiswa::class)->middleware(['auth'])->name('datamahasiswa');
    Route::get('/data-prodi', DataProdi::class)->middleware(['auth'])->name('dataprodi');
    Route::get('/data-fakultas', DataFakultas::class)->middleware(['auth'])->name('datafakultas');
    Route::get('/data-dosen', DataDosen::class)->middleware(['auth'])->name('datadosen');
    Route::get('/data-matkul', DataMatkul::class)->middleware(['auth'])->name('datamatkul');
    Route::get('/data-sebaran-matkul', DataSebaranMatkul::class)->middleware(['auth'])->name('datasebaranmatkul');
    Route::get('/data-perkuliahan', DataPerkuliahan::class)->middleware(['auth'])->name('dataperkuliahan');
    Route::get('/ceklist-absensi-{idperkuliahan}', CeklistAbsensi::class)->middleware(['auth'])->name('ceklistabsensi');

require __DIR__.'/auth.php';
