<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserControl extends Component
{
    public $datauser = [], $dataotoritas = [];
    public $iduser, $email, $nmuser, $password, $password_confirmation, $kdotoritas;

    public $formdatauser = 'hidden', $opsisave;
    public $editingId = null;

    public function render()
    {
        $this->datauser = DB::table('users')
            ->join('otoritas', 'users.kd_otoritas', '=', 'otoritas.kd_otoritas')
            ->select('users.*', 'otoritas.nm_otoritas')
            ->get();

        $this->dataotoritas = DB::table('otoritas')->get();

        return view('livewire.user-control', [
            'datauser' => $this->datauser,
            'dataotoritas' => $this->dataotoritas
        ])->extends('layouts.back');
    }

    public function rules()
    {
        return [
            'email' => $this->editingId
                ? 'required|email|max:100|unique:users,email,' . $this->editingId . ',id'
                : 'required|email|max:100|unique:users,email',
            'nmuser' => 'required|string|max:255',
            'password' => $this->editingId ? 'nullable|string|max:50|confirmed' : 'required|string|max:50|confirmed',
            'password_confirmation' => $this->editingId ? 'nullable|string|max:50' : 'required|string|max:50',
            'kdotoritas' => 'required|string|max:10',
        ];
    }

    protected $messages = [
        'email.unique' => 'Email sudah digunakan.',
        'email.required' => 'Email wajib diisi.',
        'nmuser.required' => 'Nama user wajib diisi.',
        'password.required' => 'Password wajib diisi.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
        'password_confirmation.required' => 'Konfirmasi password wajib diisi.',
        'kdotoritas.required' => 'Silakan pilih otoritas.',
    ];

    public function save()
    {
        $this->validate();

        if ($this->editingId) {
            // Update
            $updateData = [
                'email' => $this->email,
                'nm_user' => $this->nmuser,
                'kd_otoritas' => $this->kdotoritas,
            ];

            if ($this->password) {
                $updateData['password'] = Hash::make($this->password);
            }

            DB::table('users')->where('id', $this->editingId)->update($updateData);
            session()->flash('message', 'User berhasil diperbarui!');
        } else {
            // Insert
            DB::table('users')->insert([
                'email' => $this->email,
                'nm_user' => $this->nmuser,
                'kd_otoritas' => $this->kdotoritas,
                'password' => Hash::make($this->password),
            ]);
            session()->flash('message', 'User berhasil ditambahkan!');
        }

        $this->resetForm();
        $this->dispatch('flashMessage');
    }

    public function delete($id)
    {
        DB::table('users')->where('id', $id)->delete();
        session()->flash('message', 'User berhasil dihapus!');
        $this->dispatch('flashMessage');
    }

    public function tambahdata()
    {
        $this->resetForm();
        $this->formdatauser = '';
        $this->opsisave = 'Tambahkan';
    }

    public function edit($id)
    {
        $this->resetForm();
        $this->formdatauser = '';
        $this->opsisave = 'Perbarui';
        $this->editingId = $id;

        $data = DB::table('users')->where('id', $id)->first();

        $this->email = $data->email;
        $this->nmuser = $data->nm_user;
        $this->kdotoritas = $data->kd_otoritas;
    }

    public function cfuser()
    {
        $this->resetForm();
        $this->formdatauser = 'hidden';
    }

    public function resetForm()
    {
        $this->reset(['email', 'nmuser', 'password', 'password_confirmation', 'kdotoritas', 'editingId']);
        $this->resetValidation();
        $this->formdatauser = 'hidden';
    }
}
