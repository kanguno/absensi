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

  

    Route::get('/data-mahasiswa', DataMahasiswa::class)->name('datamahasiswa');

require __DIR__.'/auth.php';
