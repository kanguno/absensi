<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class DataMatkul extends Component
{
    use WithPagination;
    public $kdmatkul, $nmmatkul, $sks,$teori,$praktek;
    public $datmakul,$user;
    public $formdatamatkul='hidden',$opsisave,$editingId=null;

     public function getMatkulProperty()
    {
        return DB::table('dat_matkul')
            ->where('is_aktif', '=', '1')
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.data-matkul', [
            'matkul' => $this->matkul // ← memanggil getMatkulProperty()
        ])->extends('layouts.back');
    }

    public function rules () {
        return[
        
        'kdmatkul' => $this->editingId
        ? 'required|max:10|exists:dat_matkul,kd_matkul'
        : 'required|max:10|unique:dat_matkul,kd_matkul',
        'nmmatkul' => 'required|string|max:160',
        'sks' => 'required',
        ];
    }
    // protected $rules = [
    //     'kdmatkul' => 'required|max:10|unique:dat_matkul,kd_matkul',
    //     'nmmatkul' => 'required|string|max:160',
    //     'sks' => 'required',

    // ],
    protected $message = [
        'kdmatkul.unique' => 'Kd Mata Kuliah sudah ada di database.',
        'kdmatkul.required' => 'Kd Mata Kuliah wajib diisi.',
        'nmmatkul.required' => 'Nama Mata Kuliah wajib diisi.',
        'sks.required' => 'Jumlah SKS wajib diisi.',
        
        'kdmatkul.max' => 'Kode Mata Kuliah Maksimal 10 karakter',
        'nmmatkul.max' => 'Nama Mata Kuliah Maksimal 160 karakter',
    ];

    public function save()
    {
        $this->validate($this->rules(),$this->message);

        $datmatkul = DB::table('dat_matkul')->where('kd_matkul', $this->kdmatkul)->first();

        if ($datmatkul) {
            // Update data jika sudah ada
            DB::table('dat_matkul')
                ->where('kd_matkul', $this->kdmatkul)
                ->update([
                    'nm_matkul' => $this->nmmatkul,
                    'jml_sks' => $this->sks,
                    'teori' => $this->teori,
                    'praktek' => $this->praktek,
                ]);
            session()->flash('message', 'Data berhasil diperbarui!');
        } else {
            // Insert data baru
            DB::table('dat_matkul')->insert([
                'kd_matkul' => $this->kdmatkul,
                'nm_matkul' => $this->nmmatkul,
                'jml_sks' => $this->sks,
                'teori' => $this->teori,
                'praktek' => $this->praktek,
            ]);
            session()->flash('message', 'Data berhasil ditambahkan!');
            
        }

        $this->reset();
        $this->dispatch('flashMessage');
    }

    public function delete($kdmatkul)
    {
        
        try {
            // Coba tambahkan kolom jika belum ada (optional, dijalankan sekali saja)
            DB::statement("ALTER TABLE dat_matkul ADD COLUMN is_aktif TINYINT(1) DEFAULT 1");
        } catch (\Exception $e) {
            // Kolom mungkin sudah ada, abaikan
        }
    
        // Nonaktifkan data, bukan hapus
        DB::table('dat_matkul')
            ->where('kd_matkul', $kdmatkul)
            ->update(['is_aktif' => 0]);
    
        session()->flash('message', 'Data mata kuliah berhasil dinonaktifkan.');
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
        $this->editingId=$kdmatkul;
        $data=DB::table('dat_matkul')->where('kd_matkul',$kdmatkul)->first();
        

        $this->kdmatkul=$data->kd_matkul;
        $this->nmmatkul=$data->nm_matkul;
        $this->sks=$data->jml_sks;
        $this->teori=$data->teori;
        $this->praktek=$data->praktek;
        
    }
}
