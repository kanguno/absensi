<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DataDosen extends Component
{
    public $iddosen, $nmdosen, $notelp, $email;
    public $datdosen;
    public $formdatadosen = 'hidden', $opsisave;
    public $editingId = null; // ID yang sedang diedit

    public function render()
    {
        $this->datdosen = DB::table('dat_dosen')->get();

        return view('livewire.data-dosen', [
            'dosen' => $this->datdosen
        ])->extends('layouts.back');
    }

    public function rules()
    {
        return [
            'iddosen' => $this->editingId 
                ? 'required|max:16|exists:dat_dosen,id_dosen' // Hanya validasi exists jika sedang edit
                : 'required|max:16|unique:dat_dosen,id_dosen',
            'nmdosen' => 'required|string|max:100',
            'email' => 'required|email',
        ];
    }

    protected $messages = [
        'iddosen.unique' => 'ID dosen sudah ada di database.',
        'iddosen.required' => 'ID dosen wajib diisi.',
        'iddosen.exists' => 'ID dosen tidak ditemukan dalam database.', // Pesan baru
        'nmdosen.required' => 'Nama Dosen wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'iddosen.max' => 'ID Dosen maksimal 16 karakter.',
        'nmdosen.max' => 'Nama Dosen maksimal 100 karakter.',
    ];

    public function save()
    {
        $this->validate();

        if ($this->editingId) {
            // Update data jika sedang mengedit (tidak ubah id_dosen)
            DB::table('dat_dosen')
                ->where('id_dosen', $this->editingId)
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

        $this->resetForm();
        $this->dispatch('flashMessage');
    }

    public function delete($iddosen)
    {
        DB::table('dat_dosen')->where('id_dosen', $iddosen)->delete();
        session()->flash('message', 'Data berhasil dihapus!');
        $this->dispatch('flashMessage');
    }

    public function tambahdata()
    {
        $this->resetForm();
        $this->opsisave = 'Tambahkan';
    }

    public function edit($iddosen)
    {
        $this->resetValidation();
        $this->formdatadosen = '';
        $this->opsisave = 'Perbarui';
        $this->editingId = $iddosen; // Simpan ID yang sedang diedit

        $data = DB::table('dat_dosen')->where('id_dosen', $iddosen)->first();

        $this->iddosen = $data->id_dosen;
        $this->nmdosen = $data->nm_dosen;
        $this->notelp = $data->no_telp;
        $this->email = $data->email;
    }

    public function resetForm()
    {
        $this->reset(['iddosen', 'nmdosen', 'notelp', 'email', 'editingId']);
        $this->resetValidation();
        $this->formdatadosen = 'hidden';
    }
}
