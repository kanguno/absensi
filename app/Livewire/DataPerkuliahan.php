<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class DataPerkuliahan extends Component
{
    public $idperkuliahan, $idsebaranmatkul, $kelas, $tanggal, $tanggalselesai, $jam, $expired, $pertemuanke,$sksteori=0,$skspraktik=0;
    public bool $teori = false;
public bool $praktik = false;

    public $materi, $perkuliahan;
    public $kdmatkul, $prodi, $dosen, $semester;
    public $existdosen;

    public $datadosen = [], $datamatkul = [], $datasemester = [], $datadistribusi = [];
    public $formdataperkuliahan = 'hidden', $opsisave;

    public $search = '', $keyword = '';
    public $filterKelas = '', $filterDosen = '', $filterMatkul = '',$filterJenis='';
    public $listKelas = [], $listDosen = [], $listMatkul = [];
    public $cetak;

    public function mount()
    {
        $this->existdosen = DB::table('dat_dosen')->where('email', auth()->user()->email)->first();
    }

    public function render()
    {
        $query = DB::table('dat_perkuliahan')
            ->join('dat_sebaran_matkul', 'dat_perkuliahan.id_sebaran_matkul', '=', 'dat_sebaran_matkul.id_sebaran_matkul')
            ->join('dat_prodi', 'dat_sebaran_matkul.kd_prodi', '=', 'dat_prodi.kd_prodi')
            ->join('dat_matkul', 'dat_sebaran_matkul.kd_matkul', '=', 'dat_matkul.kd_matkul')
            ->join('dat_dosen', 'dat_sebaran_matkul.id_dosen', '=', 'dat_dosen.id_dosen')
            ->select('dat_perkuliahan.*', 'dat_prodi.nm_prodi', 'dat_matkul.nm_matkul', 'dat_dosen.nm_dosen');
            
        $this->listKelas = DB::table('dat_perkuliahan')->select('kelas')->distinct()->get();
        $this->listDosen = DB::table('dat_dosen')->select('id_dosen', 'nm_dosen')->get();
        $this->listMatkul = DB::table('dat_matkul')->select('kd_matkul', 'nm_matkul','teori','praktek')->get();

        if ($this->existdosen) {
            $query->where('dat_dosen.id_dosen', $this->existdosen->id_dosen);
        }
        
        if ($this->filterKelas) {
            
            $query->where('dat_perkuliahan.kelas', $this->filterKelas);
        }

        if ($this->filterDosen) {
            
            $query->where('dat_dosen.id_dosen', $this->filterDosen);
        }

        if ($this->filterMatkul) {
             $query->where('dat_matkul.kd_matkul', $this->filterMatkul);
        }
       if ($this->filterJenis == 't') {
            $query->where('dat_perkuliahan.is_teori', true);
              $this->perkuliahan = $query->get();
        } elseif ($this->filterJenis == 'p') {
            $query->where('dat_perkuliahan.is_praktik', true);
        }
            $this->perkuliahan = $query->get();
            

        return view('livewire.data-perkuliahan', [
            'perkuliahan' => $this->perkuliahan,
            'dataprodi' => DB::table('dat_prodi')->get(),
        ])->extends('layouts.back');
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
public function dataDistribusi(){
        // dd($this->semester);
        $this->datadistribusi=[];
        
        $this->idsebaranmatkul=null;

        $datadistribusi=DB::table('dat_sebaran_matkul')
        ->join('dat_prodi', 'dat_sebaran_matkul.kd_prodi', '=', 'dat_prodi.kd_prodi')
        ->join('dat_matkul', 'dat_sebaran_matkul.kd_matkul', '=', 'dat_matkul.kd_matkul')
        ->join('dat_dosen', 'dat_sebaran_matkul.id_dosen', '=', 'dat_dosen.id_dosen')
        ->select('dat_sebaran_matkul.*', 'dat_prodi.nm_prodi','dat_matkul.*','dat_dosen.nm_dosen')
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
public function filterData()
{
    
}
    public function searchData()
    {
        $this->keyword = $this->search;
    }

    protected function rules()
    {
        return [
            'idperkuliahan' => 'required|max:2|unique:dat_perkuliahan,id_perkuliahan,' . $this->idperkuliahan . ',id_perkuliahan',
            'idsebaranmatkul' => 'required',
            'kelas' => 'required|max:10',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'expired' => 'required',
            'materi' => 'required',
            'pertemuanke' => 'required'
        ];
    }

    protected $messages = [
        'idperkuliahan.required' => 'Kode Prodi wajib diisi.',
        'kelas.required' => 'Kelas wajib diisi.',
        'idsebaranmatkul.required' => 'Pilih Data Distribusi Mata Kuliah.',
        'tanggal.required' => 'Tanggal wajib diisi.',
        'jam.required' => 'Jam wajib diisi.',
        'expired.required' => 'Batas absen wajib diisi.',
        'materi.required' => 'Materi wajib diisi.',
        'pertemuanke.required' => 'Pertemuan ke-berapa wajib diisi.',
    ];

    public function save()
    {
        $perkuliahan = DB::table('dat_perkuliahan')->where('id_perkuliahan', $this->idperkuliahan)->first();

        if ($perkuliahan) {
            DB::table('dat_perkuliahan')->where('id_perkuliahan', $this->idperkuliahan)->update([
                'id_sebaran_matkul' => $this->idsebaranmatkul,
                'kelas' => $this->kelas,
                'tanggal' => $this->tanggal,
                'jam' => $this->jam,
                'batas_absen' => $this->expired,
                'materi' => $this->materi,
                'tanggal_selesai' => $this->tanggalselesai,
                'pertemuan_ke' => $this->pertemuanke,
                'is_teori' => $this->teori,
                'is_praktik' => $this->praktik,
            ]);
            session()->flash('message', 'Data berhasil diperbarui!');
        } else {
            $idperkuliahan = DB::table('dat_perkuliahan')->insertGetId([
                'id_sebaran_matkul' => $this->idsebaranmatkul,
                'kelas' => $this->kelas,
                'tanggal' => $this->tanggal,
                'jam' => $this->jam,
                'batas_absen' => $this->expired,
                'materi' => $this->materi,
                'is_teori' => $this->teori,
                'is_praktik' => $this->praktik,
            ]);

            do {
                $hash = md5(Str::random(10));
                $exists = DB::table('qrabsen')->where('link_absen', $hash)->exists();
            } while ($exists);

            DB::table('qrabsen')->insert([
                'id_perkuliahan' => $idperkuliahan,
                'link_absen' => $hash,
            ]);

            session()->flash('message', 'Data berhasil ditambahkan!');
        }

        $this->reset();
        $this->dispatch('flashMessage');
    }

    public function delete($idperkuliahan)
    {
        DB::table('dat_perkuliahan')->where('id_perkuliahan', $idperkuliahan)->delete();
        session()->flash('message', 'Data berhasil dihapus!');
        $this->dispatch('flashMessage');
    }

    public function tambahdata()
    {
        $this->reset();
        $this->resetValidation();
        $this->formdataperkuliahan = '';
        $this->opsisave = 'Tambahkan';
    }

    public function cfperkuliahan()
    {
        $this->reset();
        $this->resetValidation();
        $this->formdataperkuliahan = 'hidden';
    }

    public function resetform()
    {
        $this->reset();
        $this->resetValidation();
        $this->formdataperkuliahan = '';
    }

    public function edit($idperkuliahan)
    {
        $this->formdataperkuliahan = '';
        $this->resetValidation();
        $this->opsisave = 'Perbarui';

        $data = DB::table('dat_perkuliahan')
            ->join('dat_sebaran_matkul', 'dat_sebaran_matkul.id_sebaran_matkul', '=', 'dat_perkuliahan.id_sebaran_matkul')
            ->where('id_perkuliahan', $idperkuliahan)
            ->select('dat_perkuliahan.*', 'dat_sebaran_matkul.*')
            ->first();

        $this->datamatkul = DB::table('dat_sebaran_matkul')
            ->join('dat_matkul', 'dat_sebaran_matkul.kd_matkul', '=', 'dat_matkul.kd_matkul')
            ->select('dat_sebaran_matkul.kd_matkul', 'dat_matkul.*')
            ->where('dat_sebaran_matkul.kd_prodi', $data->kd_prodi)
            ->when($this->existdosen, fn($q) => $q->where('dat_sebaran_matkul.id_dosen', $this->existdosen->id_dosen))
            ->distinct()
            ->get();

        $this->datasemester = DB::table('dat_sebaran_matkul')
            ->select('semester')
            ->where('kd_prodi', $data->kd_prodi)
            ->where('kd_matkul', $data->kd_matkul)
            ->when($this->existdosen, fn($q) => $q->where('id_dosen', $this->existdosen->id_dosen))
            ->distinct()
            ->get();

        $this->datadosen = DB::table('dat_sebaran_matkul')
            ->join('dat_dosen', 'dat_sebaran_matkul.id_dosen', '=', 'dat_dosen.id_dosen')
            ->select('dat_sebaran_matkul.*', 'dat_dosen.nm_dosen')
            ->where('kd_prodi', $data->kd_prodi)
            ->where('kd_matkul', $data->kd_matkul)
            ->where('semester', $data->semester)
            ->when($this->existdosen, fn($q) => $q->where('dat_sebaran_matkul.id_dosen', $this->existdosen->id_dosen))
            ->get();

        $this->datadistribusi = DB::table('dat_sebaran_matkul')
            ->join('dat_prodi', 'dat_sebaran_matkul.kd_prodi', '=', 'dat_prodi.kd_prodi')
            ->join('dat_matkul', 'dat_sebaran_matkul.kd_matkul', '=', 'dat_matkul.kd_matkul')
            ->join('dat_dosen', 'dat_sebaran_matkul.id_dosen', '=', 'dat_dosen.id_dosen')
            ->select('dat_sebaran_matkul.*', 'dat_prodi.nm_prodi', 'dat_matkul.nm_matkul', 'dat_dosen.nm_dosen')
            ->where([
                ['dat_sebaran_matkul.kd_prodi', $data->kd_prodi],
                ['dat_sebaran_matkul.semester', $data->semester],
                ['dat_sebaran_matkul.kd_matkul', $data->kd_matkul],
                ['dat_sebaran_matkul.id_dosen', $data->id_dosen],
            ])
            ->when($this->existdosen, fn($q) => $q->where('dat_sebaran_matkul.id_dosen', $this->existdosen->id_dosen))
            ->get();

            if($data->kd_matkul){
        $this->sksteori=$this->datamatkul->where('kd_matkul','=',$data->kd_matkul)->first()->teori;
        $this->skspraktik=$this->datamatkul->where('kd_matkul','=',$data->kd_matkul)->first()->praktek;
        }else{
            $this->sksteori=0;
            $this->skspraktik=0;
        }
        $this->fill([
            'prodi' => $data->kd_prodi,
            'kdmatkul' => $data->kd_matkul,
            'semester' => $data->semester,
            'dosen' => $data->id_dosen,
            'idsebaranmatkul' => $data->id_sebaran_matkul,
            'idperkuliahan' => $data->id_perkuliahan,
            'kelas' => $data->kelas,
            'pertemuanke' => $data->pertemuan_ke,
            'tanggal' => $data->tanggal,
            'teori' => $data->is_teori,
            'praktik' => $data->is_praktik,
            'tanggalselesai' => $data->tanggal_selesai,
            'jam' => $data->jam,
            'expired' => $data->batas_absen,
            'materi' => $data->materi,
        ]);
    }

    public function getFilteredHeader()
{
    $headerdata = DB::table('dat_perkuliahan')
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
            );

    if ($this->filterKelas) {
        $headerdata->where('dat_perkuliahan.kelas', $this->filterKelas);
     }

    if ($this->filterDosen) {
        $headerdata->where('dat_dosen.id_dosen', $this->filterDosen);
    }
  
    if ($this->filterMatkul) {
        $headerdata->where('dat_matkul.kd_matkul', $this->filterMatkul);
    }
    if ($this->filterJenis == 't') {
            $headerdata->where('dat_perkuliahan.is_teori', true);
            } elseif ($this->filterJenis == 'p') {
            $headerdata->where('dat_perkuliahan.is_praktik', true);
        } 
    return $headerdata->first();
}
    public function getFilteredData()
{
     $query = DB::table('dat_perkuliahan')
            ->join('dat_sebaran_matkul', 'dat_perkuliahan.id_sebaran_matkul', '=', 'dat_sebaran_matkul.id_sebaran_matkul')
            ->join('dat_prodi', 'dat_sebaran_matkul.kd_prodi', '=', 'dat_prodi.kd_prodi')
            ->join('dat_matkul', 'dat_sebaran_matkul.kd_matkul', '=', 'dat_matkul.kd_matkul')
            ->join('dat_dosen', 'dat_sebaran_matkul.id_dosen', '=', 'dat_dosen.id_dosen')
            ->select('dat_perkuliahan.*', 'dat_prodi.nm_prodi', 'dat_matkul.nm_matkul', 'dat_dosen.nm_dosen');
    
    
    if ($this->filterKelas) {
        $query->where('dat_perkuliahan.kelas', $this->filterKelas);
    }

    if ($this->filterDosen) {
        $query->where('dat_dosen.id_dosen', $this->filterDosen);
    }

    if ($this->filterMatkul) {
        $query->where('dat_matkul.kd_matkul', $this->filterMatkul);
    }
if ($this->filterJenis == 't') {
            $query->where('dat_perkuliahan.is_teori', true);
        } elseif ($this->filterJenis == 'p') {
            $query->where('dat_perkuliahan.is_praktik', true);
        }
    
    return $query->get();
}
   
    public function cetakPdf()
{
    $header=$this->getFilteredHeader();
    $data = $this->getFilteredData();
    dd($header);
        $this->nmfakultas = $header->nm_fakultas;
        $this->nmprodi = $header->nm_prodi;
        $this->nmmatkul = $header->nm_matkul;
        $this->kdmatkul = $header->kd_matkul;
        $this->nmdosen = $header->nm_dosen;
        $this->tahunakademik = $header->thn_akademik;
        $this->semester = $header->semester;
        $this->kelas = $header->kelas;
        $this->sks = $header->jml_sks;
        $this->sks = $header->is_teori;
        $this->sks = $header->is_praktik;
    $pdf = Pdf::loadView('livewire.jurnaldosen', [
        'datperkuliahan' => $data,
         'nmfakultas' => $this->nmfakultas,
        'nmprodi' => $this->nmprodi,
        'nmmatkul' => $this->nmmatkul,
        'kdmatkul' => $this->kdmatkul,
        'nmdosen' => $this->nmdosen,
        'semester' => $this->semester,
        'kelas' => $this->kelas,
        'sks'=>$this->sks,
        'tahunakademik' => $this->tahunakademik,
    ])->setPaper('a4', 'landscape');

    return response()->streamDownload(function () use ($pdf) {
        echo $pdf->stream();
    }, 'data-perkuliahan.pdf');
}
}
