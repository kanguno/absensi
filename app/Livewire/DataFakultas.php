<?php

namespace App\Livewire;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\Component;

class DataFakultas extends Component
{
    use WithPagination;

    public $nmfakultas, $kdfakultas, $editingId = null;
    public $formdatafakultas = 'hidden', $opsisave;

    public function render()
    {
        $fakultas = DB::table('dat_fakultas')
        ->where('is_aktif','=','1')
        ->paginate(10); // ✅ langsung disiapkan untuk view

        return view('livewire.data-fakultas', [
            'fakultas' => $fakultas
        ])->extends('layouts.back');
    }

public function rules()
{
    return [
        'kdfakultas' => $this->editingId
            ? 'required|max:2|unique:dat_fakultas,kd_fakultas,' . $this->editingId . ',kd_fakultas'
            : 'required|max:2|unique:dat_fakultas,kd_fakultas',
        'nmfakultas' => 'required|string|max:255',
    ];
}

    protected $message = [
        'kdfakultas.unique' => 'Kode Fakultas sudah ada di database.',
        'kdfakultas.required' => 'Kode Fakultas wajib diisi.',
        'nmfakultas.required' => 'Nama Fakultas wajib diisi.',
        'kdfakultas.max:2' => 'Kode Fakultas maksimal 2 karakter.',
        'nmfakultas.max:255' => 'Nama Fakultas maksimal 255 karakter.'
    ];

    public function save()
    {
        $this->validate($this->rules(), $this->message);

        $Fakultas = DB::table('dat_fakultas')->where('kd_fakultas', $this->kdfakultas)->first();

        if ($Fakultas) {
            // Update data jika sudah ada
            DB::table('dat_fakultas')
                ->where('kd_fakultas', $this->kdfakultas)
                ->update([
                    'nm_fakultas' => $this->nmfakultas,
                    
                ]);
            session()->flash('message', 'Data berhasil diperbarui!');
        } else {
            // Insert data baru
            DB::table('dat_fakultas')->insert([
                'kd_fakultas' => $this->kdfakultas,
                'nm_fakultas' => $this->nmfakultas,
            ]);
            session()->flash('message', 'Data berhasil ditambahkan!');
            
        }

        $this->reset();
        $this->dispatch('flashMessage');
    }

   public function delete($kdfakultas)
{
    try {
        // Coba tambahkan kolom jika belum ada (optional, dijalankan sekali saja)
        DB::statement("ALTER TABLE dat_fakultas ADD COLUMN is_aktif TINYINT(1) DEFAULT 1");
    } catch (\Exception $e) {
        // Kolom mungkin sudah ada, abaikan
    }

    // Nonaktifkan data, bukan hapus
    DB::table('dat_fakultas')
        ->where('kd_fakultas', $kdfakultas)
        ->update(['is_aktif' => 0]);

    session()->flash('message', 'Data fakultas berhasil dinonaktifkan.');
    $this->dispatch('flashMessage');
}

    public function tambahdata(){
        $this->reset();
        $this->resetValidation();
        $this->formdatafakultas='';
        $this->opsisave='Tambahkan';
    }
    public function cffakultas(){
        $this->reset();
        $this->resetValidation();
        $this->formdatafakultas='hidden';
    }
    public function resetform(){
        $this->reset();
        $this->resetValidation();
        $this->formdatafakultas='';
    }
    public function edit($kdfakultas)
    {
        $this->formdatafakultas = '';
        $this->resetValidation();
        $this->opsisave = 'Perbarui';

        $data = DB::table('dat_fakultas')->where('kd_fakultas', $kdfakultas)->first();

        if ($data) {
            $this->editingId = $data->kd_fakultas; // Simpan ID untuk validasi update
            $this->kdfakultas = $data->kd_fakultas;
            $this->nmfakultas = $data->nm_fakultas;
        }
    }
}
