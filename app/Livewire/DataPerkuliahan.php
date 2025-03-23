<?php

namespace App\Livewire;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class DataPerkuliahan extends Component
{
   

    public $idperkuliahan, $kdmatkul, $iddosen,$tanggal,$jam,$expired;
    public $perkuliahan,$matkul,$dosen;
    public $formdataperkuliahan='hidden',$opsisave;

    public function render()
{
    $this->perkuliahan = DB::table('dat_perkuliahan')
        ->join('dat_matkul', 'dat_perkuliahan.kd_matkul', '=', 'dat_matkul.kd_matkul')
        ->join('dat_dosen', 'dat_perkuliahan.id_dosen', '=', 'dat_dosen.id_dosen')
        ->select('dat_perkuliahan.*', 'dat_matkul.nm_matkul','dat_matkul.jml_sks','dat_dosen.nm_dosen')
        ->get();
        $this->dosen=DB::table('dat_dosen')->get();
        $this->matkul=DB::table('dat_matkul')->get();
        
    return view('livewire.data-perkuliahan', [
        'perkuliahan' => $this->perkuliahan,
        'matkul' => $this->matkul,
        'dosen' => $this->dosen
    ])->extends('layouts.back');
}

    public function mount()
    {
        $this->dosen=DB::table('dat_dosen')->get();
        $this->matkul=DB::table('dat_matkul')->get();
        
    }
    
    protected $rules = [
        'idperkuliahan' => 'required|max:2|unique:dat_perkuliahan',
        'kdmatkul' => 'required|string|max:255',
        'iddosen' => 'required|string|max:16',
        'tanggal' => 'required|date',
        'jam' => 'required',
        'expired' => 'required',
    ],
    $message = [
        'idperkuliahan.required' => 'Kode Prodi wajib diisi.',
        'kdmatkul.required' => 'Nama Prodi wajib diisi.',
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
                    'kd_matkul' => $this->kdmatkul,
                    'id_dosen' => $this->iddosen,
                    'tanggal' => $this->tanggal,
                    'jam' => $this->jam,
                    'expired' => $this->expired
                    
                ]);
            session()->flash('message', 'Data berhasil diperbarui!');
        } else {
            // Insert data baru
            DB::table('dat_perkuliahan')->insert([
                'kd_matkul' => $this->kdmatkul,
                'id_dosen' => $this->iddosen,
                'tanggal' => $this->tanggal,
                'jam' => $this->jam,
                'expired' => $this->expired
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
        $this->kdmatkul=$data->kd_matkul;
        $this->iddosen=$data->id_dosen;
        $this->tanggal=$data->tanggal;
        $this->jam=$data->jam;
        $this->expired=$data->expired;
        
    }
}
