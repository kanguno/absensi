<?php

namespace App\Livewire;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;

use Livewire\Component;

class DataPerkuliahan extends Component
{
   

    public $idperkuliahan, $idsebaranmatkul,$kelas,$tanggal,$jam,$expired;
    public $perkuliahan,$kdmatkul,$prodi,$dosen,$semester;
    public $datadosen=[],$datamatkul=[],$datasemester=[],$datadistribusi=[];
    public $formdataperkuliahan='hidden',$opsisave;

    public function render()
{
    
    $this->existdosen=DB::table('dat_dosen')
    ->where('email',auth()->user()->email)
    ->first();

    
    $dataperkuliahan = DB::table('dat_perkuliahan')
        ->join('dat_sebaran_matkul', 'dat_perkuliahan.id_sebaran_matkul', '=', 'dat_sebaran_matkul.id_sebaran_matkul')
        ->join('dat_prodi', 'dat_sebaran_matkul.kd_prodi', '=', 'dat_prodi.kd_prodi')
        ->join('dat_matkul', 'dat_sebaran_matkul.kd_matkul', '=', 'dat_matkul.kd_matkul')
        ->join('dat_dosen', 'dat_sebaran_matkul.id_dosen', '=', 'dat_dosen.id_dosen')
        ->select('dat_perkuliahan.*', 'dat_prodi.nm_prodi','dat_matkul.nm_matkul','dat_dosen.nm_dosen');
        
        if ($this->existdosen) {
            $dataperkuliahan->where('dat_dosen.id_dosen', $this->existdosen->id_dosen);
        }
        
        $this->perkuliahan=$dataperkuliahan->get();
        // $this->datamatkul=DB::table('dat_matkul')->get();
        $this->dataprodi=DB::table('dat_prodi')->get();


        

        return view('livewire.data-perkuliahan', [
        'perkuliahan' => $this->perkuliahan,
        'dataprodi' => $this->dataprodi,
//        'sebaranmatkul' => $this->sebaranmatkul,
    ])->extends('layouts.back');
}

    public function mount()
    {
        $this->sebaranmatkul=DB::table('dat_sebaran_matkul')->get();
        
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
        ];
    }
    
    protected array $messages = [
        'idperkuliahan.required' => 'Kode Prodi wajib diisi.',
        'kelas.required' => 'Kelas wajib diisi.',
        'idsebaranmatkul.required' => 'Pilih Data Distribusi Mata Kuliah.',
        'iddosen.required' => 'Pilih salah satu fakultas',
        'tanggal.required' => 'Tanggal Wajib diisi',
        'jam.required' => 'Jam Wajib diisi',
        'expired.required' => 'Tanggal Kadaluarsa Wajib diisi',
    ];
    

    public function save()
{
    // Cek apakah data sudah ada berdasarkan id_perkuliahan
    $perkuliahan = DB::table('dat_perkuliahan')->where('id_perkuliahan', $this->idperkuliahan)->first();
    
    if ($perkuliahan) {
        // Update data jika sudah ada
        DB::table('dat_perkuliahan')
            ->where('id_perkuliahan', $this->idperkuliahan)
            ->update([
                'id_sebaran_matkul' => $this->idsebaranmatkul,
                'kelas' => $this->kelas,
                'tanggal' => $this->tanggal,
                'jam' => $this->jam,
                'batas_absen' => $this->expired
            ]);

        session()->flash('message', 'Data berhasil diperbarui!');
    } else {
        // Insert data baru & dapatkan ID terbaru
        $idperkuliahan = DB::table('dat_perkuliahan')->insertGetId([
            'id_sebaran_matkul' => $this->idsebaranmatkul,
            'kelas' => $this->kelas,
            'tanggal' => $this->tanggal,
            'jam' => $this->jam,
            'batas_absen' => $this->expired
        ]);

        // Buat QR Code untuk perkuliahan yang baru
        do {
            $hash = md5(Str::random(10)); // Hash lebih pendek
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
        
        $datmhs = DB::table('dat_perkuliahan')->where('id_perkuliahan', $idperkuliahan)->delete();


            // dd($datmhs);
            
            session()->flash('message', 'Data berhasil dihapus!');
       

        $this->dispatch('flashMessage');
    }

    public function tambahdata(){
        $this->reset();
        $this->resetValidation();
        $this->formdataperkuliahan='';
        $this->opsisave='Tambahkan';
    }
    public function cfperkuliahan(){
        $this->reset();
        $this->resetValidation();
        $this->formdataperkuliahan='hidden';
    }
    public function resetform(){
        $this->reset();
        $this->resetValidation();
        $this->formdataperkuliahan='';
    }
    public function edit($idperkuliahan){
        $this->formdataperkuliahan='';
        $this->resetValidation();
        $this->opsisave='Perbarui';
        $data=DB::table('dat_perkuliahan')
        ->join('dat_sebaran_matkul', 'dat_sebaran_matkul.id_sebaran_matkul', '=', 'dat_perkuliahan.id_sebaran_matkul')
        ->where('id_perkuliahan', $idperkuliahan)
        ->select('dat_perkuliahan.*','dat_sebaran_matkul.*')
        ->first();

        $this->datamatkul=DB::table('dat_sebaran_matkul')
        ->join('dat_matkul', 'dat_sebaran_matkul.kd_matkul', '=', 'dat_matkul.kd_matkul')
        ->select('dat_sebaran_matkul.kd_matkul','dat_matkul.nm_matkul')
        ->where('dat_sebaran_matkul.kd_prodi','=',$data->kd_prodi)
        ->distinct()
        ->get();

        $this->datasemester=DB::table('dat_sebaran_matkul')
        ->select('dat_sebaran_matkul.semester')
        ->where('dat_sebaran_matkul.kd_prodi','=',$data->kd_prodi)
        ->where('dat_sebaran_matkul.kd_matkul','=',$data->kd_matkul)
        ->distinct()
        ->get();

        $this->datadosen=DB::table('dat_sebaran_matkul')
        ->join('dat_dosen', 'dat_sebaran_matkul.id_dosen', '=', 'dat_dosen.id_dosen')
        ->select('dat_sebaran_matkul.*','dat_dosen.nm_dosen')
        ->where('dat_sebaran_matkul.kd_prodi','=',$data->kd_prodi)
        ->where('dat_sebaran_matkul.kd_matkul','=',$data->kd_matkul)
        ->where('dat_sebaran_matkul.semester','=',$data->semester)
        ->get();

        $this->datadistribusi=DB::table('dat_sebaran_matkul')
        ->join('dat_prodi', 'dat_sebaran_matkul.kd_prodi', '=', 'dat_prodi.kd_prodi')
        ->join('dat_matkul', 'dat_sebaran_matkul.kd_matkul', '=', 'dat_matkul.kd_matkul')
        ->join('dat_dosen', 'dat_sebaran_matkul.id_dosen', '=', 'dat_dosen.id_dosen')
        ->select('dat_sebaran_matkul.*', 'dat_prodi.nm_prodi','dat_matkul.nm_matkul','dat_dosen.nm_dosen')
        ->where('dat_sebaran_matkul.kd_prodi','=',$data->kd_prodi)
        ->where('dat_sebaran_matkul.semester','=',$data->semester)
        ->where('dat_sebaran_matkul.kd_matkul','=',$data->kd_matkul)
        ->where('dat_sebaran_matkul.id_dosen','=',$data->id_dosen)
        ->get();


        

        $this->prodi=$data->kd_prodi;
        $this->kdmatkul=$data->kd_matkul;
        $this->semester=$data->semester;
        $this->dosen=$data->id_dosen;
        $this->idsebaranmatkul=$data->id_sebaran_matkul;
        $this->idperkuliahan=$data->id_perkuliahan;
        $this->idsebaranmatkul=$data->id_sebaran_matkul;
        $this->kelas=$data->kelas;
        $this->tanggal=$data->tanggal;
        $this->jam=$data->jam;
        $this->expired=$data->batas_absen;
    }

    public function absensi($idperkuliahan)
    {
        $dataabsensi=DB::table('dat_absensi')->where('id_perkuliahan','=',$idperkuliahan)->first();

        if($dataabsensi){
            $this->redirectRoute('ceklistabsensi', $idperkuliahan);
        }
        else{
            $mahasiswa = DB::table('dat_mahasiswa')
            ->join('dat_perkuliahan', 'dat_mahasiswa.kelas', '=', 'dat_perkuliahan.kelas')
            ->where('dat_perkuliahan.id_perkuliahan', $idperkuliahan)
            ->select('dat_mahasiswa.nim', 'dat_mahasiswa.nm_mahasiswa')
            ->get();
        
        foreach ($mahasiswa as $mhs) {
            DB::table('dat_absensi')->insert([
                'id_perkuliahan' => $idperkuliahan,
                'nim' => $mhs->nim,
                'status_kehadiran' => 'T',
                'keterangan' => null,
            ]);
        }
        $this->redirectRoute('ceklistabsensi', $idperkuliahan);
        }
        
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
        ->where()
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
    public function cetakabsensi($idperkuliahan)
    {
        $dataabsensi=DB::table('dat_absensi')->where('id_perkuliahan','=',$idperkuliahan)->first();

        
        if($dataabsensi){
            $this->redirectRoute('cetakabsensiharian', $idperkuliahan);
        }
        else{
            session()->flash('messagemodal', 'Data Absensi Belum Dibuat!');
            $this->dispatch('flashMessage');
            
        }
    }
    
    
    public function Generate($idperkuliahan){
      $qrabsen=DB::table('qrabsen')->where('id_perkuliahan','=',$idperkuliahan)->first();
      

      if(!$qrabsen){
        do {
        $hash = hash('sha256', $data . Str::random(5));
        $exists = DB::table('qrabsen')->where('link_absen', $hash)->exists();
    } while ($exists);
        DB::table('qrabsen')->insert([
          'id_perkuliahan'=>$idperkuliahan,
          'link-absen'=>$hash,
          ]);
      }
    
      
    $qrabsen=DB::table('qrabsen')->where('id_perkuliahan','=',$idperkuliahan)->first();
    $qrCode = QrCode::size(300)->generate(url('/link-absen-' . $qrabsen->id_perkuliahan));

      return response(QrCode::size(300)->generate(url('localhost:8000/link-absen-' . $qrlink)))
        ->header('Content-Type', 'image/svg+xml');
    }



public function GenerateQr($idperkuliahan)
{
    // Cari QR yang sudah ada berdasarkan id_perkuliahan
    $qrabsen = DB::table('qrabsen')->where('id_perkuliahan', '=', $idperkuliahan)->first();

    // Path untuk menyimpan file sementara
    $filePath = storage_path('app/public/qrcode-' . $idperkuliahan . '.png');

    // Generate QR Code dan simpan ke file
    \QrCode::format('svg')->size(300)
    ->margin(10)->backgroundColor(255,255,255)->generate(url('/link-absen-' . $qrabsen->link_absen), $filePath);

    // Return file sebagai download
    return response()->download($filePath, 'qrcode-' . $idperkuliahan . '.png')->deleteFileAfterSend(true);
}

    

public function redirectToAbsensi($qrlink)
{
    $qrabsen = DB::table('qrabsen')
        ->join('dat_perkuliahan', 'qrabsen.id_perkuliahan', '=', 'dat_perkuliahan.id_perkuliahan')
        ->select('qrabsen.*', 'dat_perkuliahan.*')
        ->where('qrabsen.link_absen', '=', $qrlink)
        ->first();

    // Cek apakah $qrabsen ditemukan
    if (!$qrabsen) {
        // Jika QR tidak ditemukan
        return response('QR Code tidak ditemukan', 404);
    }

    // Mengonversi batas_absen ke zona waktu lokal (misalnya Asia/Jakarta)
    $batasAbsen = Carbon::parse($qrabsen->batas_absen)->setTimezone('Asia/Jakarta');

    // Periksa apakah waktu batas absen sudah lewat
    if ($batasAbsen->greaterThan(now('Asia/Jakarta'))) {
        return redirect()->route('absensimahasiswa', ['idperkuliahan' => $qrabsen->id_perkuliahan]);
    } else {
        return response("
            <body>
            <h1>Waktu Absen Telah Berakhir</h1>
            </body>
        ", 200)->header('Content-Type', 'text/html');
    }
}



}
