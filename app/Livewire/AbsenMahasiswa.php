<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class AbsenMahasiswa extends Component
{
    public $dataperkuliahan=[],$idperkuliahan,$absensi=[],$idabsensi,$nim;
    public $carimhs,$formabsen="hidden";
    
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


    public function caridataabsensi(){
        
        $this->formabsen="";
        $this->carimhs="hidden";
        $this->absensi = DB::table('dat_absensi')
        ->join('dat_mahasiswa', 'dat_mahasiswa.nim', '=', 'dat_absensi.nim')
        ->join('dat_prodi', 'dat_mahasiswa.kd_prodi', '=', 'dat_prodi.kd_prodi')
        ->join('dat_fakultas', 'dat_prodi.kd_fakultas', '=', 'dat_fakultas.kd_fakultas')
        ->where('dat_absensi.nim', '=', $this->nim)
        ->select('dat_absensi.*', 'dat_mahasiswa.nm_mahasiswa','dat_mahasiswa.kelas','dat_mahasiswa.kelas','dat_prodi.nm_prodi','dat_fakultas.nm_fakultas')
        ->first();        
    }
    public function absen($idabsensi){
        $this->absensi=DB::table('dat_absensi')->where('id_absensi','=',$idabsensi)
        ->update([
            'status_kehadiran'=>'Y',
            'keterangan'=>''
        ]);
        session()->flash('message', 'Anda berhasil Absen!');
        return redirect()->route('absensimahasiswa', ['idperkuliahan' => $this->idperkuliahan]);
    }
    public function resetcaridata(){
        $this->carimhs="";
        $this->nim="";
        $this->absensi=null;

    }
}
