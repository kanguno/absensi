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
    public $perkuliahan,$sebaranmatkul,$matkul,$prodi,$dosen;
    public $formdataperkuliahan='hidden',$opsisave;

    public function render()
{
    $this->perkuliahan = DB::table('dat_perkuliahan')
        ->join('dat_sebaran_matkul', 'dat_perkuliahan.id_sebaran_matkul', '=', 'dat_sebaran_matkul.id_sebaran_matkul')
        ->join('dat_prodi', 'dat_sebaran_matkul.kd_prodi', '=', 'dat_prodi.kd_prodi')
        ->join('dat_matkul', 'dat_sebaran_matkul.kd_matkul', '=', 'dat_matkul.kd_matkul')
        ->join('dat_dosen', 'dat_sebaran_matkul.id_dosen', '=', 'dat_dosen.id_dosen')
        ->select('dat_perkuliahan.*', 'dat_prodi.nm_prodi','dat_matkul.nm_matkul','dat_dosen.nm_dosen')
        ->get();
        $this->sebaranmatkul=DB::table('dat_sebaran_matkul')
        ->join('dat_prodi', 'dat_sebaran_matkul.kd_prodi', '=', 'dat_prodi.kd_prodi')
        ->join('dat_matkul', 'dat_sebaran_matkul.kd_matkul', '=', 'dat_matkul.kd_matkul')
        ->join('dat_dosen', 'dat_sebaran_matkul.id_dosen', '=', 'dat_dosen.id_dosen')
        ->select('dat_sebaran_matkul.*', 'dat_prodi.nm_prodi','dat_matkul.nm_matkul','dat_dosen.nm_dosen')
        ->get();

        return view('livewire.data-perkuliahan', [
        'perkuliahan' => $this->perkuliahan,
        'sebaranmatkul' => $this->sebaranmatkul,
    ])->extends('layouts.back');
}

    public function mount()
    {
        $this->sebaranmatkul=DB::table('dat_sebaran_matkul')->get();
        
    }
    
    protected $rules = [
        'idperkuliahan' => 'required|max:2|unique:dat_perkuliahan',
        'idsebaranmatkul' => 'required',
        'kelas' => 'required|max:10',
        'tanggal' => 'required|date',
        'jam' => 'required',
        'expired' => 'required',
    ],
    $message = [
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
        $data=DB::table('dat_perkuliahan')->where('id_perkuliahan', $idperkuliahan)->first();

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
    \QrCode::format('png')->size(300)
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
