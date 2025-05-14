<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Carbon\Carbon;

class ReportAbsensi extends Component
{
    public $absensi = [];
    public $reportAbsen='display:none;',$form='';
    public $dataperkuliahan,$perkuliahan=[];
    public $kelas,$semester,$kdmatkul,$nmprodi,$nmfakultas,$nmdosen,$tahunakademik,$nmmatkul,$prodi,$existdosen,$dosen;
    public $tahun;
    public $bulan;
    public $tanggalHeader = [],$dataprodi=[],$datamatkul=[],$datadosen=[],$datadistribusi=[],$datasemester=[],$datakelas=[];
    public $idsebaranmatkul='1';

    public function mount()
    {
        $this->dataprodi=DB::table('dat_prodi')->get();

        // Buat array tanggal untuk header tabel
    }

    public function render()
    {
        $this->existdosen=DB::table('dat_dosen')
    ->where('email',auth()->user()->email)
    ->first();

        return view('livewire.report-absensi', [
            '$prodi'=>$this->dataprodi
            // 'absensi' => $this->absensi,
            // 'perkuliahan' => $this->dataperkuliahan,
            // 'tanggalHeader' => $this->tanggalHeader,
        ])->extends('layouts.back');
    }

    public function cariData(){
        
        
        if ($this->bulan) {
            // Ubah dari string ke Carbon
            $start = Carbon::createFromFormat('Y-m', $this->bulan)->startOfMonth();
            $end = $start->copy()->endOfMonth();
        
            $this->tanggalHeader = [];
            while ($start->lte($end)) {
                $this->tanggalHeader[] = $start->format('Y-m-d');
                $start->addDay();
            }
        }

        $bulan = Carbon::createFromFormat('Y-m', $this->bulan)->format('m');
        $tahun = Carbon::createFromFormat('Y-m', $this->bulan)->format('Y');
        
        // Ambil data absensi mahasiswa
        $data = DB::table('dat_sebaran_matkul as a')
            ->join('dat_perkuliahan as b', 'a.id_sebaran_matkul', '=', 'b.id_sebaran_matkul')
            ->join('dat_absensi as c', 'c.id_perkuliahan', '=', 'b.id_perkuliahan')
            ->join('dat_mahasiswa as d', 'c.nim', '=', 'd.nim')
            // ->where('a.id_sebaran_matkul', $this->idsebaranmatkul)
            ->where('a.kd_prodi', $this->prodi)
            ->where('a.kd_matkul', $this->kdmatkul)
            ->where('a.semester', $this->semester)
            ->where('a.id_dosen', $this->dosen)
            ->where('b.kelas', $this->kelas)
            ->whereMonth('b.tanggal', $bulan)
            ->whereYear('b.tanggal', $tahun)
            ->select('a.*','b.*','c.id_perkuliahan','d.nim', 'd.nm_mahasiswa', 'b.tanggal', 'c.status_kehadiran')
            ->get();

            //dd($data);
        if($data->isNotEmpty()){
            $this->reportAbsen='';
            $this->form='hidden';  
        
        // Pivot data absensi
        $pivoted = [];

        foreach ($data as $row) {
            $nim = $row->nim;
            $nama = $row->nm_mahasiswa;
            $tanggal = $row->tanggal;
            $status = $row->status_kehadiran;

            if (!isset($pivoted[$nim])) {
                $pivoted[$nim] = [
                    'nim' => $nim,
                    'nama' => $nama,
                ];

                // Isi default semua tanggal jadi null
                foreach ($this->tanggalHeader as $tgl) {
                    $pivoted[$nim][$tgl] = null;
                }
            }

            $pivoted[$nim][$tanggal] = $status;
        }

        $this->absensi = array_values($pivoted);

        
        // Ambil data perkuliahan
        $this->dataperkuliahan = DB::table('dat_perkuliahan')
            ->join('dat_sebaran_matkul', 'dat_perkuliahan.id_sebaran_matkul', '=', 'dat_sebaran_matkul.id_sebaran_matkul')
            ->join('dat_prodi', 'dat_sebaran_matkul.kd_prodi', '=', 'dat_prodi.kd_prodi')
            ->join('dat_matkul', 'dat_sebaran_matkul.kd_matkul', '=', 'dat_matkul.kd_matkul')
            ->join('dat_dosen', 'dat_sebaran_matkul.id_dosen', '=', 'dat_dosen.id_dosen')
            ->join('dat_fakultas', 'dat_prodi.kd_fakultas', '=', 'dat_fakultas.kd_fakultas')
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
            ->where('dat_sebaran_matkul.kd_prodi', $this->prodi)
            ->where('dat_sebaran_matkul.kd_matkul', $this->kdmatkul)
            ->where('dat_sebaran_matkul.semester', $this->semester)
            ->where('dat_sebaran_matkul.id_dosen', $this->dosen)
            ->where('dat_perkuliahan.kelas', $this->kelas)
            ->first();
            $this->nmfakultas=$this->dataperkuliahan->nm_fakultas;
            $this->nmprodi=$this->dataperkuliahan->nm_prodi;
            $this->nmmatkul=$this->dataperkuliahan->nm_matkul;
            $this->nmdosen=$this->dataperkuliahan->nm_dosen;
            $this->nmdosen=$this->dataperkuliahan->nm_dosen;
            $this->tahunakademik=$this->dataperkuliahan->thn_akademik;
        }
        else{
            session()->flash('messagemodal', 'Data Absensi Tidak Ditemukan!');
            $this->prodi=null;
            $this->kdmatkul=null;
            $this->semester=null;
            $this->dosen=null;
            $this->kelas=null;
            $this->idsebaranmatkul=null;

            $this->dispatch('messagemodal');
        }
    }

    public function print()
    {
        $this->dispatch('print-page');
    }

    public function kembali()
    {
            $this->form='';
            $this->reportAbsen='display:none;';
            $this->prodi=null;
            $this->kdmatkul=null;
            $this->semester=null;
            $this->dosen=null;
            $this->kelas=null;
            $this->idsebaranmatkul=null;
    }

    public function dataMatkul(){
        $this->datamatkul=[];
        $this->datasemester=[];
        $this->datadosen=[];
        $this->datadistribusi=[];
        
            $this->kdmatkul=null;
            $this->semester=null;
            $this->dosen=null;
            $this->idsebaranmatkul=null;

     
        $datamatkul=DB::table('dat_sebaran_matkul')
        ->join('dat_matkul', 'dat_sebaran_matkul.kd_matkul', '=', 'dat_matkul.kd_matkul')
        ->select('dat_sebaran_matkul.kd_matkul','dat_matkul.nm_matkul')
        ->where('dat_sebaran_matkul.kd_prodi','=',$this->prodi)
        ->when($this->existdosen, function ($query) {
        return $query->where('dat_sebaran_matkul.id_dosen', $this->existdosen->id_dosen);
    })
        ->distinct()
        ->get();
        if($datamatkul->isNotEmpty()){
            $this->datamatkul=$datamatkul;
        }
        else{
            
            session()->flash('messagemodal', 'Data Distribusi Mata Kuliah ini belum ada!');
            $this->dispatch('flashMessage');
            $this->prodi=null;
            $this->kdmatkul=null;
            $this->semester=null;
            $this->dosen=null;
            $this->idsebaranmatkul=null;
        }
    }
    public function dataSemester(){
        $this->datasemester=[];
        $this->datadosen=[];
        $this->datadistribusi=[];
        
        $this->semester=null;
        $this->dosen=null;
        $this->idsebaranmatkul=null;
        $datasemester=DB::table('dat_sebaran_matkul')
        ->select('dat_sebaran_matkul.semester')
        ->where('dat_sebaran_matkul.kd_prodi','=',$this->prodi)
        ->where('dat_sebaran_matkul.kd_matkul','=',$this->kdmatkul)
        ->when($this->existdosen, function ($query) {
        return $query->where('dat_sebaran_matkul.id_dosen', $this->existdosen->id_dosen);
    })
        ->distinct()
        ->get();
        
        if($datasemester->isNotEmpty()){
            $this->datasemester=$datasemester;
        }
        else{
            
            session()->flash('messagemodal', 'Data Distribusi Mata Kuliah ini belum ada!');
            $this->dispatch('flashMessage');
            $this->kdmatkul=null;
            $this->semester=null;
            $this->dosen=null;
            $this->idsebaranmatkul=null;
        }
    }
    public function dataDosen(){
        // dd($this->semester);
        $this->datadosen=[];
        $this->datadistribusi=[];
        
        $this->dosen=null;
        $this->idsebaranmatkul=null;
        $datadosen=DB::table('dat_sebaran_matkul')
        ->join('dat_dosen', 'dat_sebaran_matkul.id_dosen', '=', 'dat_dosen.id_dosen')
        ->select('dat_sebaran_matkul.*','dat_dosen.nm_dosen')
        ->when($this->existdosen, function ($query) {
        return $query->where('dat_sebaran_matkul.id_dosen', $this->existdosen->id_dosen);
    })
        ->where('dat_sebaran_matkul.kd_prodi','=',$this->prodi)
        ->where('dat_sebaran_matkul.semester','=',$this->semester)
        ->where('dat_sebaran_matkul.kd_matkul','=',$this->kdmatkul)
        ->get();
        
        if($datadosen->isNotEmpty()){
            $this->datadosen=$datadosen;
        }
        else{
            
            session()->flash('messagemodal', 'Data Distribusi Mata Kuliah ini belum ada!');
            $this->dispatch('flashMessage');
            $this->semester=null;
            $this->dosen=null;
            $this->idsebaranmatkul=null;
        }
    }
public function dataDistribusi(){
        // dd($this->semester);
        $this->datadistribusi=[];
        
        $this->idsebaranmatkul=null;

        $datadistribusi=DB::table('dat_sebaran_matkul')
        ->join('dat_prodi', 'dat_sebaran_matkul.kd_prodi', '=', 'dat_prodi.kd_prodi')
        ->join('dat_matkul', 'dat_sebaran_matkul.kd_matkul', '=', 'dat_matkul.kd_matkul')
        ->join('dat_dosen', 'dat_sebaran_matkul.id_dosen', '=', 'dat_dosen.id_dosen')
        ->select('dat_sebaran_matkul.*', 'dat_prodi.nm_prodi','dat_matkul.nm_matkul','dat_dosen.nm_dosen')
        ->when($this->existdosen, function ($query) {
        return $query->where('dat_sebaran_matkul.id_dosen', $this->existdosen->id_dosen);
    })
        ->where('dat_sebaran_matkul.kd_prodi','=',$this->prodi)
        ->where('dat_sebaran_matkul.semester','=',$this->semester)
        ->where('dat_sebaran_matkul.kd_matkul','=',$this->kdmatkul)
        ->where('dat_sebaran_matkul.id_dosen','=',$this->dosen)
        ->get();
        
        if($datadistribusi->isNotEmpty()){
            $this->datadistribusi=$datadistribusi;
        }
        else{
            
            session()->flash('messagemodal', 'Data Distribusi Mata Kuliah ini belum ada!');
            $this->dispatch('flashMessage');
            $this->idsebaranmatkul=null;
        }
    }
    
}
