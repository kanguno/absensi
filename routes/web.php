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
use App\Livewire\RekapAbsen;
use App\Livewire\CetakAbsensiHarian;
use App\Livewire\Pages\Auth\LoginPage;

use App\Http\Middleware\CheckUserOtoritas;

Route::get('/', function () {
return redirect()->route('dataperkuliahan');
})->name('home');
Route::get('/login', LoginPage::class)->name('login');
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
        Route::get('/preview-jurnal', function () {
    return view('livewire.jurnaldosen', [
        'datperkuliahan' => session('datperkuliahan'),
        'nmfakultas' => session('nmfakultas'),
        'nmprodi' => session('nmprodi'),
        'nmmatkul' => session('nmmatkul'),
        'kdmatkul' => session('kdmatkul'),
        'nmdosen' => session('nmdosen'),
        'semester' => session('semester'),
        'kelas' => session('kelas'),
        'sks' => session('sks'),
        'sksteori' => session('sksteori'),
        'skspraktik' => session('skspraktik'),
        'teori' => session('teori'),
        'praktik' => session('praktik'),
        'jeniskuliah' => session('jeniskuliah'),
        'jmlpertemuan' => session('jmlpertemuan'),
        'tahunakademik' => session('tahunakademik'),
        'preview' => session('preview'),
    ]);
});

    });
    
    Route::get('/data-perkuliahan', DataPerkuliahan::class)->middleware(['auth'])->name('dataperkuliahan');
    Route::get('/ceklist-absensi-{idperkuliahan}', CeklistAbsensi::class)->middleware(['auth'])->name('ceklistabsensi');
    Route::get('/report-absensi', ReportAbsensi::class)->middleware(['auth'])->name('reportabsensi');
    Route::get('/cetak-absensi-harian-{idperkuliahan}', CetakAbsensiHarian::class)->middleware(['auth'])->name('cetakabsensiharian');
    Route::get('/rekap-absen', RekapAbsen::class)->middleware(['auth'])->name('rekapabsen');
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    
        return redirect('/login');
    })->name('logout');
require __DIR__.'/auth.php';
 