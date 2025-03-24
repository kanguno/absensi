<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class CeklistAbsensi extends Component
{
    public function render()
    {
        return view('livewire.ceklist-absensi');
    }
    public function mount($idperkuliahan){
        $dataabsensi=DB::table('dat_absensi')->where('id_perkuliahan','=',$idperkuliahan)->get();
        dd($dataabsensi);
    }
}
