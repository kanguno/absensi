<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class CeklistAbsensi extends Component
{
    public $absensi;
    public $status_kehadiran = [];
    public $keterangan = []; 
    public $dataperkuliahan=[];

    public function render()
    {
        
        return view('livewire.ceklist-absensi', [
            'absensi' => $this->absensi,
            'perkuliahan'=>$this->dataperkuliahan
            ])
            ->extends('layouts.back');
    }
    public function mount($idperkuliahan)
    {
        $this->absensi = DB::table('dat_absensi')
            ->join('dat_mahasiswa', 'dat_mahasiswa.nim', '=', 'dat_absensi.nim')
            ->where('id_perkuliahan', '=', $idperkuliahan)
            ->select('dat_absensi.*', 'dat_mahasiswa.nm_mahasiswa')
            ->get();

        foreach ($this->absensi as $absen) {
            $this->status_kehadiran[$absen->id_absensi] = $absen->status_kehadiran;
        }
        $this->dataperkuliahan= DB::table('dat_perkuliahan')
        ->join('dat_sebaran_matkul', 'dat_perkuliahan.id_sebaran_matkul', '=', 'dat_sebaran_matkul.id_sebaran_matkul')
        ->join('dat_prodi', 'dat_sebaran_matkul.kd_prodi', '=', 'dat_prodi.kd_prodi')
        ->join('dat_matkul', 'dat_sebaran_matkul.kd_matkul', '=', 'dat_matkul.kd_matkul')
        ->join('dat_dosen', 'dat_sebaran_matkul.id_dosen', '=', 'dat_dosen.id_dosen')
        ->join('dat_fakultas', 'dat_prodi.kd_fakultas', '=', 'dat_prodi.kd_fakultas')
        ->select('dat_perkuliahan.*','dat_sebaran_matkul.semester','dat_sebaran_matkul.thn_akademik',
         'dat_fakultas.nm_fakultas','dat_prodi.nm_prodi','dat_matkul.kd_matkul','dat_matkul.nm_matkul','dat_dosen.nm_dosen')
        ->first();

    }

    public function updateKehadiran($id_absensi, $status)
    {
        DB::table('dat_absensi')
            ->where('id_absensi', $id_absensi)
            ->update(['status_kehadiran' => $status]);

        $this->status_kehadiran[$id_absensi] = $status;

        session()->flash('message', 'Status kehadiran diperbarui.');
        $this->dispatch('flashMessage');
    }

    public function updateKeterangan($id_absensi)
    {
        DB::table('dat_absensi')
            ->where('id_absensi', $id_absensi)
            ->update(['keterangan' => $this->keterangan[$id_absensi]]);

            session()->flash('message', 'Status kehadiran diperbarui.');
            $this->dispatch('flashMessage');
    }
  
}
