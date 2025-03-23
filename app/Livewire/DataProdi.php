<?php

namespace App\Livewire;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class DataProdi extends Component
{
   

    public $kdprodi, $nmprodi, $kdfakultas;
    public $fakultas,$prodi;
    public $formdataprodi='hidden',$opsisave;

    public function render()
{
    $this->prodi = DB::table('dat_prodi')
        ->join('dat_fakultas', 'dat_prodi.kd_fakultas', '=', 'dat_fakultas.kd_fakultas')
        ->select('dat_prodi.*', 'dat_fakultas.nm_fakultas')
        ->get();
    $this->fakultas=DB::table('dat_fakultas')->get();
    
    return view('livewire.data-prodi', [
        'fakultas' => $this->fakultas,
        'prodi' => $this->prodi
    ])->extends('layouts.back');
}

    public function mount()
    {
        $this->fakultas=DB::table('dat_fakultas')->get();
        // Debugging untuk memastikan data ada
        
    }
    
    protected $rules = [
        'kdprodi' => 'required|max:2',
        'nmprodi' => 'required|string|max:255',
        'kdfakultas' => 'required|string|max:2',
    ],
    $message = [
        'kdprodi.required' => 'Kode Prodi wajib diisi.',
        'nmprodi.required' => 'Nama Prodi wajib diisi.',
        'kdfakultas.required' => 'Pilih salah satu fakultas'
    ];

    public function save()
    {
        $this->validate($this->rules, $this->message);

        $prodi = DB::table('dat_prodi')->where('kd_prodi', $this->kdprodi)->first();

        if ($prodi) {
            // Update data jika sudah ada
            DB::table('dat_prodi')
                ->where('kd_prodi', $this->kdprodi)
                ->update([
                    'nm_prodi' => $this->nmprodi,
                    'kd_fakultas' => $this->kdfakultas,
                    
                ]);
            session()->flash('message', 'Data berhasil diperbarui!');
        } else {
            // Insert data baru
            DB::table('dat_prodi')->insert([
                'kd_prodi' => $this->kdprodi,
                'nm_prodi' => $this->nmprodi,
                'kd_fakultas' => $this->kdfakultas
            ]);
            session()->flash('message', 'Data berhasil ditambahkan!');
            
        }

        $this->reset();
        $this->dispatch('flashMessage');
    }

    public function delete($kdprodi)
    {
        
        $datmhs = DB::table('dat_prodi')->where('kd_prodi', $kdprodi)->delete();


            // dd($datmhs);
            
            session()->flash('message', 'Data berhasil dihapus!');
       

        $this->dispatch('flashMessage');
    }

    public function tambahdata(){
        $this->reset();
        $this->resetValidation();
        $this->formdataprodi='';
        $this->opsisave='Tambahkan';
    }
    public function cfprodi(){
        $this->reset();
        $this->resetValidation();
        $this->formdataprodi='hidden';
    }
    public function resetform(){
        $this->reset();
        $this->resetValidation();
        $this->formdataprodi='';
    }
    public function edit($kdprodi){
        $this->formdataprodi='';
        $this->resetValidation();
        $this->opsisave='Perbarui';
        $data=DB::table('dat_prodi')->where('kd_prodi', $kdprodi)->first();

        $this->kdprodi=$data->kd_prodi;
        $this->nmprodi=$data->nm_prodi;
        $this->kdfakultas=$data->kd_fakultas;
        
    }
}
