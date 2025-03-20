<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\datMahasiswa;
use Illuminate\Support\Facades\DB;

class DataMahasiswa extends Component
{
    public function render()
    {
        $datmhs=DB::table('dat_mahasiswa')
        ->join('dat_prodi', 'dat_mahasiswa.kd_prodi', '=', 'dat_prodi.kd_prodi')
        ->join('dat_fakultas', 'dat_prodi.kd_prodi', '=', 'dat_fakultas.kd_fakultas')
        ->select('dat_mahasiswa.*', 'dat_prodi.nm_prodi','dat_fakultas.nm_fakultas')
        ->paginate(10);
        return view('livewire.data-mahasiswa',['datamahasiswa'=>$datmhs])->extends('layouts.back');
    }


    public $nim, $nm_mahasiswa, $kd_prodi, $fakultas;
    public $mahasiswa_id;

    protected $rules = [
        'nim' => 'required|max:20',
        'nm_mahasiswa' => 'required|string|max:255',
        'kd_prodi' => 'required|string|max:255',
    ];

    public function save()
    {
        $this->validate();

        $datmhs = DB::table('dat_mahasiswa')->where('nim', $this->nim)->first();

        if ($datmhs) {
            // Update data jika sudah ada
            DB::table('dat_mahasiswa')
                ->where('nim', $this->nim)
                ->update([
                    'nm_mahasiswa' => $this->nm_mahasiswa,
                    'kd_prodi' => $this->kd_prodi,
                ]);
            session()->flash('message', 'Data berhasil diperbarui!');
        } else {
            // Insert data baru
            DB::table('dat_mahasiswa')->insert([
                'nim' => $this->nim,
                'nm_mahasiswa' => $this->nm_mahasiswa,
                'kd_prodi' => $this->kd_prodi,
            ]);
            session()->flash('message', 'Data berhasil ditambahkan!');
        }

        $this->reset();
    }


    public function edit($nim){
        $data=datMahasiswa::where('nim',$nim)->first();

        $this->nim=$data->nim;
        $this->nm_mahasiswa=$data->nm_mahasiswa;
        $this->kd_prodi=$data->kd_prodi;
        
    }
}
