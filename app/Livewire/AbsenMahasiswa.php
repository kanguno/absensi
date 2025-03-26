<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class AbsenMahasiswa extends Component
{
    public $dataperkuliahan=[],$idperkuliahan;
    public function render()
    {
        return view('livewire.absen-mahasiswa',[
            'perkuliahan'=>$this->dataperkuliahan])
        ->extends('layouts.front');
    }
    public function mount($idperkuliahan){
        if (!$idperkuliahan) {
            abort(404, "ID perkuliahan tidak ditemukan.");
        }
    
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
}
