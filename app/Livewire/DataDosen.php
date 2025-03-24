<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DataDosen extends Component
{
    public $iddosen, $nmdosen, $notelp,$email;
    public $datdosen;
    public $formdatadosen='hidden',$opsisave;

    public function render()
{
    $this->datdosen = DB::table('dat_dosen')->get();

    return view('livewire.data-dosen', [
        'dosen' => $this->datdosen
    ])->extends('layouts.back');
}

    protected $rules = [
        'iddosen' => 'required|max:16|unique:dat_dosen,id_dosen',
        'nmdosen' => 'required|string|max:100',
        'email' => 'required',
    ],
    $message = [
        'iddosen.unique' => 'ID dosen sudah ada di database.',
        'iddosen.required' => 'ID dosen wajib diisi.',
        'nmdosen.required' => 'Nama Dosen wajib diisi.',
        'nmdosen.required' => 'Email wajib diisi.',
        'iddosen.max' => 'ID Dosen Maksimal 16 karakter',
        'nmdosen.max' => 'Nama Mahasiswa Maksimal 100 karakter',
    ];

    public function save()
    {
        $this->validate($this->rules,$this->message);

        $datdosen = DB::table('dat_dosen')->where('id_dosen', $this->iddosen)->first();

        if ($datdosen) {
            // Update data jika sudah ada
            DB::table('dat_dosen')
                ->where('id_dosen', $this->iddosen)
                ->update([
                    'nm_dosen' => $this->nmdosen,
                    'no_telp' => $this->notelp,
                    'email' => $this->email,
                ]);
            session()->flash('message', 'Data berhasil diperbarui!');
        } else {
            // Insert data baru
            DB::table('dat_dosen')->insert([
                'id_dosen' => $this->iddosen,
                'nm_dosen' => $this->nmdosen,
                    'no_telp' => $this->notelp,
                    'email' => $this->email,
            ]);
            session()->flash('message', 'Data berhasil ditambahkan!');
            
        }

        $this->reset();
        $this->dispatch('flashMessage');
    }

    public function delete($iddosen)
    {
        
        $datdosen = DB::table('dat_dosen')->where('id_dosen', $iddosen)->delete();


            session()->flash('message', 'Data berhasil dihapus!');
       

        $this->dispatch('flashMessage');
    }

    public function tambahdata(){
        $this->reset();
        $this->resetValidation();
        $this->formdatadosen='';
        $this->opsisave='Tambahkan';
    }
    public function cfdosen(){
        $this->reset();
        $this->resetValidation();
        $this->formdatadosen='hidden';
    }
    public function resetform(){
        $this->reset();
        $this->resetValidation();
        $this->formdatadosen='';
    }
    public function edit($iddosen){
        $this->formdatadosen='';
        $this->resetValidation();
        $this->opsisave='Perbarui';
        $data=DB::table('dat_dosen')->where('id_dosen',$iddosen)->first();

        $this->iddosen=$data->id_dosen;
        $this->nmdosen=$data->nm_dosen;
        $this->notelp=$data->no_telp;
        $this->email=$data->email;
        
    }
}
