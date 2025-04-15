<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class UserControl extends Component
{
    public $datauser=[],$dataotoritas=[];
    public $iduser, $nmuser, $kdotoritas;
    
    public $formdatauser='hidden',$opsisave;
    public $editingId = null;
    public function render()
{
    $this->datauser = DB::table('users')
        ->join('otoritas', 'users.kd_otoritas', '=', 'otoritas.kd_otoritas')
        ->select('users.*', 'otoritas.*')
        ->get();
    
    
    return view('livewire.user-control', [
        'dataotoritas' => $this->dataotoritas,
        'datauser' => $this->datauser
    ])->extends('layouts.back');
}

    public function mount()
    {
        $this->dataotoritas=DB::table('otoritas')->get();
        
        // Debugging untuk memastikan data ada
        
    }
    public function rules()
    {
        return [
            'kdprodi' => $this->editingId 
                ? 'required|max:2|exists:dat_prodi,kd_prodi' // Hanya validasi exists jika sedang edit
                : 'required|max:2|unique:dat_prodi,kd_prodi',
            'nmprodi' => 'required|string|max:255',
            'kdfakultas' => 'required|string|max:2',
        ];
    }

    // protected $rules = [
    //     'kdprodi' => 'required|max:2|unique:dat_prodi,kd_prodi',
    //     'nmprodi' => 'required|string|max:255',
    //     'kdfakultas' => 'required|string|max:2',
    // ],
    protected $message = [
        'kdprodi.unique' => 'Kode Prodi sudah ada di database.',
        'kdprodi.required' => 'Kode Prodi wajib diisi.',
        'nmprodi.required' => 'Nama Prodi wajib diisi.',
        'kdfakultas.required' => 'Pilih salah satu fakultas'
    ];

    public function save()
    {
        $this->validate($this->rules(), $this->message);

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
        $this->formdatauser='';
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
        $this->editingId=$kdprodi;
        $data=DB::table('dat_prodi')->where('kd_prodi', $kdprodi)->first();

        $this->kdprodi=$data->kd_prodi;
        $this->nmprodi=$data->nm_prodi;
        $this->kdfakultas=$data->kd_fakultas;
        
    }
}
