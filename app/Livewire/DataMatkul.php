<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DataMatkul extends Component
{
    public $kdmatkul, $nmmatkul, $sks;
    public $datmakul,$user;
    public $formdatamatkul='hidden',$opsisave;

    public function render()
{
    $this->datmatkul = DB::table('dat_matkul')->get();

    return view('livewire.data-matkul', [
        'matkul' => $this->datmatkul
    ])->extends('layouts.back');
}

    protected $rules = [
        'kdmatkul' => 'required|max:2',
        'nmmatkul' => 'required|string|max:160',
        'sks' => 'required',
    ],
    $message = [
        'kdmatkul.required' => 'Kd Mata Kuliah wajib diisi.',
        'nmmatkul.required' => 'Nama Mata Kuliah wajib diisi.',
        'sks.required' => 'Jumlah SKS wajib diisi.',
        'kdmatkul.max' => 'Kode Mata Kuliah Maksimal 2 karakter',
        'nmmatkul.max' => 'Nama Mata Kuliah Maksimal 160 karakter',
    ];

    public function save()
    {
        $this->validate($this->rules,$this->message);

        $datmatkul = DB::table('dat_matkul')->where('kd_matkul', $this->kdmatkul)->first();

        if ($datmatkul) {
            // Update data jika sudah ada
            DB::table('dat_matkul')
                ->where('kd_matkul', $this->kdmatkul)
                ->update([
                    'nm_matkul' => $this->nmmatkul,
                    'jml_sks' => $this->sks,
                ]);
            session()->flash('message', 'Data berhasil diperbarui!');
        } else {
            // Insert data baru
            DB::table('dat_matkul')->insert([
                'kd_matkul' => $this->kdmatkul,
                'nm_matkul' => $this->nmmatkul,
                'jml_sks' => $this->sks,
            ]);
            session()->flash('message', 'Data berhasil ditambahkan!');
            
        }

        $this->reset();
        $this->dispatch('flashMessage');
    }

    public function delete($kdmatkul)
    {
        
        $datmatkul = DB::table('dat_matkul')->where('kd_matkul', $kdmatkul)->delete();


            session()->flash('message', 'Data berhasil dihapus!');
       

        $this->dispatch('flashMessage');
    }

    public function tambahdata(){
        $this->reset();
        $this->resetValidation();
        $this->formdatamatkul='';
        $this->opsisave='Tambahkan';
    }
    public function cfmatkul(){
        $this->reset();
        $this->resetValidation();
        $this->formdatamatkul='hidden';
    }
    public function resetform(){
        $this->reset();
        $this->resetValidation();
        $this->formdatamatkul='';
    }
    public function edit($kdmatkul){
        $this->formdatamatkul='';
        $this->resetValidation();
        $this->opsisave='Perbarui';
        $data=DB::table('dat_matkul')->where('kd_matkul',$kdmatkul)->first();

        $this->kdmakul=$data->kd_maktul;
        $this->nmmatkul=$data->nm_matkul;
        $this->sks=$data->jml_sks;
        
    }
}
