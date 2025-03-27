<?php

namespace App\Livewire;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

use Livewire\Component;

class CetakAbsensiHarian extends Component
{

    public $absensi,$dataperkuliahan;
    public function render()
    {   
        
        return view('livewire.cetak-absensi-harian', [
            'absensi' => $this->absensi,
            'perkuliahan'=>$this->dataperkuliahan
        ])
        ->extends('layouts.back');
    }
    public function mount($idperkuliahan)
    {
    if (!$idperkuliahan) {
        abort(404, "ID perkuliahan tidak ditemukan.");
    }

    // Ambil data absensi dengan informasi mahasiswa
    $this->absensi = DB::table('dat_absensi')
    ->join('dat_mahasiswa', 'dat_mahasiswa.nim', '=', 'dat_absensi.nim')
    ->where('id_perkuliahan', '=', $idperkuliahan)
    ->select('dat_absensi.*', 'dat_mahasiswa.nm_mahasiswa')
    ->get();

    
    // Ambil data perkuliahan
    $this->dataperkuliahan = DB::table('dat_perkuliahan')
        ->join('dat_sebaran_matkul', 'dat_perkuliahan.id_sebaran_matkul', '=', 'dat_sebaran_matkul.id_sebaran_matkul')
        ->join('dat_prodi', 'dat_sebaran_matkul.kd_prodi', '=', 'dat_prodi.kd_prodi')
        ->join('dat_matkul', 'dat_sebaran_matkul.kd_matkul', '=', 'dat_matkul.kd_matkul')
        ->join('dat_dosen', 'dat_sebaran_matkul.id_dosen', '=', 'dat_dosen.id_dosen')
        ->join('dat_fakultas', 'dat_prodi.kd_fakultas', '=', 'dat_fakultas.kd_fakultas') // Perbaikan join fakultas
        ->select(
            'dat_perkuliahan.*',
            'dat_sebaran_matkul.semester',
            'dat_sebaran_matkul.thn_akademik',
            'dat_fakultas.nm_fakultas',
            'dat_prodi.nm_prodi',
            'dat_matkul.kd_matkul',
            'dat_matkul.nm_matkul',
            'dat_dosen.nm_dosen'
        )
        ->where('dat_perkuliahan.id_perkuliahan', '=', $idperkuliahan) // Tambahkan where untuk spesifik perkuliahan
        ->first();
    }

    public function print(){
        
        $this->dispatch('print-page');
    }
    public function kembali(){
        $this->redirectRoute('dataperkuliahan');
    }
    
}