<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\DataMahasiswa;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

  

    Route::get('/data-mahasiswa', DataMahasiswa::class)->middleware(['auth'])->name('datamahasiswa');
    Route::get('/data-prodi', DataProdi::class)->middleware(['auth'])->name('dataprodi');

require __DIR__.'/auth.php';
