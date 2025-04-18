<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Carbon\Carbon;

class ReportAbsensi extends Component
{
    public $absensi = [];
    public $dataperkuliahan;
    public $tahun = 2025;
    public $bulan = 3;
    public $tanggalHeader = [];

    public function mount($idperkuliahan)
    {
        if (!$idperkuliahan) {
            abort(404, "ID perkuliahan tidak ditemukan.");
        }

        // Buat array tanggal untuk header tabel
        $start = Carbon::create($this->tahun, $this->bulan, 1);
        $end = $start->copy()->endOfMonth();

        $this->tanggalHeader = [];
        while ($start->lte($end)) {
            $this->tanggalHeader[] = $start->format('Y-m-d');
            $start->addDay();
        }

        // Ambil data absensi mahasiswa
        $data = DB::table('dat_sebaran_matkul as a')
            ->join('dat_perkuliahan as b', 'a.id_sebaran_matkul', '=', 'b.id_sebaran_matkul')
            ->join('dat_absensi as c', 'c.id_perkuliahan', '=', 'b.id_perkuliahan')
            ->join('dat_mahasiswa as d', 'c.nim', '=', 'd.nim')
            ->where('a.id_sebaran_matkul', '1')
            ->whereMonth('b.tanggal', $this->bulan)
            ->whereYear('b.tanggal', $this->tahun)
            ->select('d.nim', 'd.nm_mahasiswa', 'b.tanggal', 'c.status_kehadiran')
            ->get();

        // Pivot data absensi
        $pivoted = [];

        foreach ($data as $row) {
            $nim = $row->nim;
            $nama = $row->nm_mahasiswa;
            $tanggal = $row->tanggal;
            $status = $row->status_kehadiran;

            if (!isset($pivoted[$nim])) {
                $pivoted[$nim] = [
                    'nim' => $nim,
                    'nama' => $nama,
                ];

                // Isi default semua tanggal jadi null
                foreach ($this->tanggalHeader as $tgl) {
                    $pivoted[$nim][$tgl] = null;
                }
            }

            $pivoted[$nim][$tanggal] = $status;
        }

        $this->absensi = array_values($pivoted);

        // Ambil data perkuliahan
        $this->dataperkuliahan = DB::table('dat_perkuliahan')
            ->join('dat_sebaran_matkul', 'dat_perkuliahan.id_sebaran_matkul', '=', 'dat_sebaran_matkul.id_sebaran_matkul')
            ->join('dat_prodi', 'dat_sebaran_matkul.kd_prodi', '=', 'dat_prodi.kd_prodi')
            ->join('dat_matkul', 'dat_sebaran_matkul.kd_matkul', '=', 'dat_matkul.kd_matkul')
            ->join('dat_dosen', 'dat_sebaran_matkul.id_dosen', '=', 'dat_dosen.id_dosen')
            ->join('dat_fakultas', 'dat_prodi.kd_fakultas', '=', 'dat_fakultas.kd_fakultas')
            ->select(
                'dat_perkuliahan.*',
                'dat_sebaran_matkul.semester',
                'dat_sebaran_matkul.thn_akademik',
                'dat_fakultas.nm_fakultas',
                'dat_prodi.nm_prodi',
                'dat_matkul.kd_matkul',
                'dat_matkul.nm_matkul',
                'dat_dosen.nm_dosen'
            )
            ->where('dat_perkuliahan.id_perkuliahan', '=', $idperkuliahan)
            ->first();
    }

    public function render()
    {
        return view('livewire.report-absensi', [
            'absensi' => $this->absensi,
            'perkuliahan' => $this->dataperkuliahan,
            'tanggalHeader' => $this->tanggalHeader,
        ])->extends('layouts.back');
    }

    public function print()
    {
        $this->dispatch('print-page');
    }

    public function kembali()
    {
        $this->redirectRoute('dataperkuliahan');
    }
}
