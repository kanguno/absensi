<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\datMahasiswa;
use Illuminate\Support\Facades\DB;

class DataMahasiswa extends Component
{
    public $nim, $nm_mahasiswa, $kelas,$semester,$kd_prodi, $fakultas;
    public $mahasiswa_id,$prodi;
    public $formdatamhs='hidden';

    public function render()
{
    $this->prodi = DB::table('dat_prodi')
        ->join('dat_fakultas', 'dat_prodi.kd_fakultas', '=', 'dat_fakultas.kd_fakultas')
        ->select('dat_prodi.*', 'dat_fakultas.nm_fakultas')
        ->get();

    $datmhs = DB::table('dat_mahasiswa')
        ->leftJoin('dat_prodi', 'dat_mahasiswa.kd_prodi', '=', 'dat_prodi.kd_prodi')
        ->leftJoin('dat_fakultas', 'dat_prodi.kd_fakultas', '=', 'dat_fakultas.kd_fakultas')
        ->select('dat_mahasiswa.*', 'dat_prodi.nm_prodi', 'dat_fakultas.nm_fakultas')
        ->paginate(10);

    return view('livewire.data-mahasiswa', [
        'datamahasiswa' => $datmhs,
        'prodi' => $this->prodi
    ])->extends('layouts.back');
}

    public function mount()
    {
        $this->prodi = DB::table('dat_prodi')
            ->join('dat_fakultas', 'dat_prodi.kd_fakultas', '=', 'dat_fakultas.kd_fakultas')
            ->select('dat_prodi.*', 'dat_fakultas.nm_fakultas')
            ->get();
        
        // Debugging untuk memastikan data ada
        
    }
    
    protected $rules = [
        'nim' => 'required|max:20',
        'nm_mahasiswa' => 'required|string|max:255',
        'kelas' => 'required|string|max:10',
        'semester' => 'required',
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
                    'kelas' => $this->kelas,
                    'semester' => $this->semester,
                    'kd_prodi' => $this->kd_prodi,
                ]);
            session()->flash('message', 'Data berhasil diperbarui!');
        } else {
            // Insert data baru
            DB::table('dat_mahasiswa')->insert([
                'nim' => $this->nim,
                'nm_mahasiswa' => $this->nm_mahasiswa,
                'kelas' => $this->kelas,
                'semester' => $this->semester,
                'kd_prodi' => $this->kd_prodi,
            ]);
            session()->flash('message', 'Data berhasil ditambahkan!');
            
        }

        $this->reset();
        $this->dispatch('flashMessage');
    }

    public function delete($nim)
    {
        
        $datmhs = DB::table('dat_mahasiswa')->where('nim', $nim)->delete();


            // dd($datmhs);
            
            session()->flash('message', 'Data berhasil dihapus!');
       

        $this->dispatch('flashMessage');
    }

    public function tambahdata(){
        $this->reset();
        $this->formdatamhs='';
    }
    public function cfmhs(){
        $this->reset();
        $this->formdatamhs='hidden';
    }
    public function resetform(){
        $this->reset();
        $this->formdatamhs='';
    }
    public function edit($nim){
        $this->formdatamhs='';
        $data=datMahasiswa::where('nim',$nim)->first();

        $this->nim=$data->nim;
        $this->nm_mahasiswa=$data->nm_mahasiswa;
        $this->kelas=$data->kelas;
        $this->semester=$data->semester;
        $this->kd_prodi=$data->kd_prodi;
        
    }
}
