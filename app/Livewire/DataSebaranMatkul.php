<?php

namespace App\Livewire;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class DataSebaranMatkul extends Component
{
   

    public $idsebaranmatkul, $kdprodi, $kdmatkul, $iddosen,$semester,$thnakademik;
    public $sebaranmatkul,$prodi,$matkul,$dosen;
    public $formdatasebaran='hidden',$opsisave;

    public function render()
{
    $this->sebaranmatkul = DB::table('dat_sebaran_matkul')
        ->join('dat_prodi', 'dat_sebaran_matkul.kd_prodi', '=', 'dat_prodi.kd_prodi')
        ->join('dat_matkul', 'dat_sebaran_matkul.kd_matkul', '=', 'dat_matkul.kd_matkul')
        ->join('dat_dosen', 'dat_sebaran_matkul.id_dosen', '=', 'dat_dosen.id_dosen')
        ->select('dat_sebaran_matkul.*','dat_prodi.nm_prodi', 'dat_matkul.nm_matkul','dat_matkul.jml_sks','dat_dosen.nm_dosen')
        ->get();
        $this->prodi=DB::table('dat_prodi')->get();
        $this->dosen=DB::table('dat_dosen')->get();
        $this->matkul=DB::table('dat_matkul')->get();
        
    return view('livewire.data-sebaran-matkul', [
        'sebaranmatkul' => $this->sebaranmatkul,
        'prodi' => $this->prodi,
        'matkul' => $this->matkul,
        'dosen' => $this->dosen
    ])->extends('layouts.back');
}

    public function mount()
    {
        $this->prodi=DB::table('dat_prodi')->get();
        $this->dosen=DB::table('dat_dosen')->get();
        $this->matkul=DB::table('dat_matkul')->get();
        
    }
    
    protected $rules = [
        'kdprodi' => 'required|string|max:2',
        'kdmatkul' => 'required|string|max:10',
        'iddosen' => 'required|string|max:16',
            ],
    $message = [
        'kdprodi.required' => 'Pilih salah satu program studi',
        'kdmatkul.required' => 'Pilih salah satu mata kuliah',
        'iddosen.required' => 'Pilih salah satu dosen',
    ];

    public function save()
    {
        $this->validate($this->rules, $this->message);
        
        $perkuliahan = DB::table('dat_sebaran_matkul')->where('id_sebaran_matkul', $this->idsebaranmatkul)->first();
        
        if ($perkuliahan) {
            // Update data jika sudah ada
            DB::table('dat_sebaran_matkul')
                ->where('id_sebaran_matkul', $this->idsebaranmatkul)
                ->update([
                'kd_prodi' => $this->kdprodi,
                'kd_matkul' => $this->kdmatkul,
                'id_dosen' => $this->iddosen,
                'semester' => $this->semester,
                'thn_akademik' => $this->thnakademik
                    
                ]);
            session()->flash('message', 'Data berhasil diperbarui!');
        } else {
            // Insert data baru
            DB::table('dat_sebaran_matkul')->insert([
                'kd_prodi' => $this->kdprodi,
                'kd_matkul' => $this->kdmatkul,
                'id_dosen' => $this->iddosen,
                'semester' => $this->semester,
                'thn_akademik' => $this->thnakademik
            ]);
            session()->flash('message', 'Data berhasil ditambahkan!');
            
        }

        $this->reset();
        $this->dispatch('flashMessage');
    }

    public function delete($idsebaranmatkul)
    {
        
        $datmhs = DB::table('dat_sebaran_matkul')->where('id_sebaran_matkul', $idsebaranmatkul)->delete();


            // dd($datmhs);
            
            session()->flash('message', 'Data berhasil dihapus!');
       

        $this->dispatch('flashMessage');
    }

    public function tambahdata(){
        $this->reset();
        $this->resetValidation();
        $this->formdatasebaran='';
        $this->opsisave='Tambahkan';
    }
    public function cfsebaran(){
        $this->reset();
        $this->resetValidation();
        $this->formdatasebaran='hidden';
    }
    public function resetform(){
        $this->reset();
        $this->resetValidation();
        $this->formdatasebaran='';
    }
    public function edit($idsebaranmatkul){
        $this->formdatasebaran='';
        $this->resetValidation();
        $this->opsisave='Perbarui';
        $data=DB::table('dat_sebaran_matkul')->where('id_sebaran_matkul', $idsebaranmatkul)->first();

        $this->idsebaranmatkul=$data->id_sebaran_matkul;
        $this->kdprodi=$data->kd_prodi;
        $this->kdmatkul=$data->kd_matkul;
        $this->iddosen=$data->id_dosen;
        $this->semester=$data->semester;
        $this->thnakademik=$data->thn_akademik;
        
    }
}
