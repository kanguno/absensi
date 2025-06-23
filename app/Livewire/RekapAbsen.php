<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class RekapAbsen extends Component
{
    public $dataabsen = [];
    public $header1 = [];
    public $header2 = [];
    public $panel = '';
    public $cetak = false;

    public $datadosen = [], $datamatkul = [], $datasemester = [], $datadistribusi = [];
    public $prodi, $dosen;
    public $existdosen;
    public $nmfakultas, $nmprodi, $nmmatkul, $kdmatkul, $nmdosen, $tahunakademik, $semester, $kelas,$sks;

    public function render()
    {
        $this->listKelas = DB::table('dat_perkuliahan')->select('kelas')->distinct()->get();
        $this->listDosen = DB::table('dat_dosen')->select('id_dosen', 'nm_dosen')->get();
        $this->listMatkul = DB::table('dat_matkul')->select('kd_matkul', 'nm_matkul','teori','praktek')->get();
        if ($this->existdosen) {
            $query->where('dat_dosen.id_dosen', $this->existdosen->id_dosen);
        }
        return view('livewire.rekap-absen',['dataprodi' => DB::table('dat_prodi')->get()])
            ->extends('layouts.back');
    }
 public function mount()
    {
        $this->existdosen = DB::table('dat_dosen')->where('email', auth()->user()->email)->first();
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
        ->select('dat_sebaran_matkul.kd_matkul','dat_matkul.*')
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
        if($this->kdmatkul){
        $this->sksteori=$this->datamatkul->where('kd_matkul','=',$this->kdmatkul)->first()->teori;
        $this->skspraktik=$this->datamatkul->where('kd_matkul','=',$this->kdmatkul)->first()->praktek;
        }else{
            $this->sksteori=0;
            $this->skspraktik=0;
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
    public function caridata()
    {
        // $this->reset();
        
        $data = DB::table('dat_perkuliahan')
            ->join('dat_sebaran_matkul', 'dat_perkuliahan.id_sebaran_matkul', '=', 'dat_sebaran_matkul.id_sebaran_matkul')
            ->join('dat_prodi', 'dat_sebaran_matkul.kd_prodi', '=', 'dat_prodi.kd_prodi')
            ->join('dat_matkul', 'dat_sebaran_matkul.kd_matkul', '=', 'dat_matkul.kd_matkul')
            ->join('dat_dosen', 'dat_sebaran_matkul.id_dosen', '=', 'dat_dosen.id_dosen')
            ->join('dat_fakultas', 'dat_prodi.kd_fakultas', '=', 'dat_fakultas.kd_fakultas')
            ->select(
                'dat_perkuliahan.*',
                'dat_sebaran_matkul.semester',
                'dat_sebaran_matkul.thn_akademik',
                'dat_matkul.jml_sks',
                'dat_fakultas.nm_fakultas',
                'dat_prodi.nm_prodi',
                'dat_matkul.kd_matkul',
                'dat_matkul.nm_matkul',
                'dat_dosen.nm_dosen'
            )
            ->where('dat_perkuliahan.kelas', $this->kelas)
            ->where('dat_dosen.id_dosen', $this->dosen)
            ->where('dat_matkul.kd_matkul', $this->kdmatkul)
            ->where('dat_sebaran_matkul.semester', $this->semester)
            ->first();
// dd ($data) ;
        if (!$data) {
            session()->flash('messagemodal', 'Data Absensi Tidak Ditemukan!');
            return;
        }


        $this->idsebaranmatkul = $data->id_sebaran_matkul;
        $this->nmfakultas = $data->nm_fakultas;
        $this->nmprodi = $data->nm_prodi;
        $this->nmmatkul = $data->nm_matkul;
        $this->kdmatkul = $data->kd_matkul;
        $this->nmdosen = $data->nm_dosen;
        $this->tahunakademik = $data->thn_akademik;
        $this->semester = $data->semester;
        $this->kelas = $data->kelas;
        $this->sks = $data->jml_sks;

        $tanggalPertemuan = DB::table('dat_perkuliahan')
            ->where('id_sebaran_matkul', $this->idsebaranmatkul)
            ->pluck('tanggal', 'pertemuan_ke')
            ->map(fn($tgl) => \Carbon\Carbon::parse($tgl)->format('d/m/Y'))
            ->toArray();

        $selects = [];
        for ($i = 1; $i <= 14; $i++) {
            $tgl = $tanggalPertemuan[$i] ?? '-';
            $selects[] = DB::raw("MAX(CASE WHEN p.pertemuan_ke = {$i} THEN a.status_kehadiran END) as TM{$i}");
            $this->header1[] = "TM{$i}";
            $this->header2[] = $tgl;
        }

        $this->header1[] = 'Total';
        $this->header2[] = '';

        array_unshift($this->header1, 'No', 'Nama', 'NIM');
        array_unshift($this->header2, '', '', '');

        $columns = [
            'm.nm_mahasiswa as nama',
            'a.nim',
            ...$selects
        ];

        $this->dataabsen = DB::table('dat_absensi as a')
            ->join('dat_perkuliahan as p', 'a.id_perkuliahan', '=', 'p.id_perkuliahan')
            ->join('dat_mahasiswa as m', 'a.nim', '=', 'm.nim')
            ->where('p.id_sebaran_matkul', $this->idsebaranmatkul)
            ->select(array_merge($columns, [
                DB::raw("SUM(CASE WHEN a.status_kehadiran = 'Y' THEN 1 ELSE 0 END) as total")
            ]))
            ->groupBy('a.nim', 'm.nm_mahasiswa')
            ->orderBy('m.nm_mahasiswa')
            ->get()
            ->map(function ($item, $index) {
                $item->no = $index + 1;
                return $item;
            });
            // dd($this->dataabsen);
    }

public function exportPDF()
{
  
    $data = [
        'cetak' => true,
        'nmfakultas' => $this->nmfakultas,
        'nmprodi' => $this->nmprodi,
        'nmmatkul' => $this->nmmatkul,
        'kdmatkul' => $this->kdmatkul,
        'nmdosen' => $this->nmdosen,
        'semester' => $this->semester,
        'kelas' => $this->kelas,
        'sks'=>$this->sks,
        'tahunakademik' => $this->tahunakademik,
        'header1' => $this->header1,
        'header2' => $this->header2,
        'dataabsen' => $this->dataabsen,
    ];

    $pdf = Pdf::loadView('livewire.rekap-absen', $data)
        ->setPaper('A4', 'landscape');
    return response()->streamDownload(
        fn () => print($pdf->output()),
        'rekap-absen.pdf'
    );
}


}
