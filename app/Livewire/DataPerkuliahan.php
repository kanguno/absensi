<?php

namespace App\Livewire;
use Illuminate\Support\Facades\DB;

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
        // $this->validate($this->rules, $this->message);
        
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
            // Insert data baru
            DB::table('dat_perkuliahan')->insert([
                    'id_sebaran_matkul' => $this->idsebaranmatkul,
                    'kelas' => $this->kelas,
                    'tanggal' => $this->tanggal,
                    'jam' => $this->jam,
                    'batas_absen' => $this->expired
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
        $this->kelas=$data->kelas;
        $this->kdmatkul=$data->kd_matkul;
        $this->iddosen=$data->id_dosen;
        $this->tanggal=$data->tanggal;
        $this->jam=$data->jam;
        $this->expired=$data->expired;
        
    }

    private function generateAbsen($idperkuliahan)
    {
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
    }

}
