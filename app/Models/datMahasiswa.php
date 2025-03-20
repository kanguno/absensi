<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class datMahasiswa extends Model
{
    //
    protected $table = 'dat_mahasiswa'; 
    protected $primaryKey = 'nim';
    public $timestamps = false; // Nonaktifkan timestamps
    protected $fillable = [
        'nim',
        'nm_mahasiswa',
        'kelas',
        'semester',
        'no_telp',
        'kd_prodi',
    ];

}
