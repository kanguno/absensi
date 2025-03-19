<?php

namespace App\Livewire;

use Livewire\Component;

class DataMahasiswa extends Component
{
    public function render()
    {
        return view('livewire.data-mahasiswa')->extends('layouts.back');
    }
}
