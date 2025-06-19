<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class RekapAbsen extends Component
{
    public $dataabsen = [];
    public $header1 = [];
    public $header2 = [];
    public $panel = '';
    public $cetak = false;

    public $nmfakultas, $nmprodi, $nmmatkul, $kdmatkul, $nmdosen, $tahunakademik, $semester, $kelas,$sks;

    public function render()
    {
        return view('livewire.rekap-absen')
            ->extends('layouts.back');
    }

    public function mount($idperkuliahan)
    {
        $data = DB::table('dat_perkuliahan')
            ->join('dat_sebaran_matkul', 'dat_perkuliahan.id_sebaran_matkul', '=', 'dat_sebaran_matkul.id_sebaran_matkul')
            ->join('dat_prodi', 'dat_sebaran_matkul.kd_prodi', '=', 'dat_prodi.kd_prodi')
            ->join('dat_matkul', 'dat_sebaran_matkul.kd_matkul', '=', 'dat_matkul.kd_matkul')
            ->join('dat_dosen', 'dat_sebaran_matkul.id_dosen', '=', 'dat_dosen.id_dosen')
            ->join('dat_fakultas', 'dat_prodi.kd_fakultas', '=', 'dat_fakultas.kd_fakultas')
            ->select(
                'dat_perkuliahan.*',
                'dat_sebaran_matkul.semester',
                'dat_sebaran_matkul.thn_akademik',
                'dat_matkul.jml_sks',
                'dat_fakultas.nm_fakultas',
                'dat_prodi.nm_prodi',
                'dat_matkul.kd_matkul',
                'dat_matkul.nm_matkul',
                'dat_dosen.nm_dosen'
            )
            ->where('dat_perkuliahan.id_sebaran_matkul', $idperkuliahan)
            ->first();

        if (!$data) {
            session()->flash('messagemodal', 'Data Absensi Tidak Ditemukan!');
            return;
        }

        $this->nmfakultas = $data->nm_fakultas;
        $this->nmprodi = $data->nm_prodi;
        $this->nmmatkul = $data->nm_matkul;
        $this->kdmatkul = $data->kd_matkul;
        $this->nmdosen = $data->nm_dosen;
        $this->tahunakademik = $data->thn_akademik;
        $this->semester = $data->semester;
        $this->kelas = $data->kelas;
        $this->sks = $data->jml_sks;

        $tanggalPertemuan = DB::table('dat_perkuliahan')
            ->where('id_sebaran_matkul', $idperkuliahan)
            ->pluck('tanggal', 'pertemuan_ke')
            ->map(fn($tgl) => \Carbon\Carbon::parse($tgl)->format('d/m/Y'))
            ->toArray();

        $selects = [];
        for ($i = 1; $i <= 14; $i++) {
            $tgl = $tanggalPertemuan[$i] ?? '-';
            $selects[] = DB::raw("MAX(CASE WHEN p.pertemuan_ke = {$i} THEN a.status_kehadiran END) as TM{$i}");
            $this->header1[] = "TM{$i}";
            $this->header2[] = $tgl;
        }

        $this->header1[] = 'Total';
        $this->header2[] = '';

        array_unshift($this->header1, 'No', 'Nama', 'NIM');
        array_unshift($this->header2, '', '', '');

        $columns = [
            'm.nm_mahasiswa as nama',
            'a.nim',
            ...$selects
        ];

        $this->dataabsen = DB::table('dat_absensi as a')
            ->join('dat_perkuliahan as p', 'a.id_perkuliahan', '=', 'p.id_perkuliahan')
            ->join('dat_mahasiswa as m', 'a.nim', '=', 'm.nim')
            ->where('p.id_sebaran_matkul', $idperkuliahan)
            ->select(array_merge($columns, [
                DB::raw("SUM(CASE WHEN a.status_kehadiran = 'Y' THEN 1 ELSE 0 END) as total")
            ]))
            ->groupBy('a.nim', 'm.nm_mahasiswa')
            ->orderBy('m.nm_mahasiswa')
            ->get()
            ->map(function ($item, $index) {
                $item->no = $index + 1;
                return $item;
            });
    }

public function exportPDF()
{
  
    $data = [
        'cetak' => true,
        'nmfakultas' => $this->nmfakultas,
        'nmprodi' => $this->nmprodi,
        'nmmatkul' => $this->nmmatkul,
        'kdmatkul' => $this->kdmatkul,
        'nmdosen' => $this->nmdosen,
        'semester' => $this->semester,
        'kelas' => $this->kelas,
        'sks'=>$this->sks,
        'tahunakademik' => $this->tahunakademik,
        'header1' => $this->header1,
        'header2' => $this->header2,
        'dataabsen' => $this->dataabsen,
    ];

    $pdf = Pdf::loadView('livewire.rekap-absen', $data)
        ->setPaper('A4', 'landscape');
    return response()->streamDownload(
        fn () => print($pdf->output()),
        'rekap-absen.pdf'
    );
}


}
