<div>
<div class="a4" style="padding-top: 3rem; padding-bottom: 3rem;">
    <div style="max-width: 80rem; margin: auto; padding-left: 1.5rem; padding-right: 1.5rem;">
        <div class="rounded-xl shadow-lg flex w-fit justify-self-end gap-4 mb-4 bg-white p-3">
            <button wire:click="kembali" class="bg-[#1db851] text-white px-3 py-1 rounded hover:bg-green-600 cursor-pointer"><i class="bi bi-arrow-left-square"></i> Kembali</button>
            <button id="printBtn" wire:click="print" class="hover:bg-blue-500 text-white px-4 py-2 rounded bg-[#00bcd4]"> <i class="bi bi-printer-fill"></i> Cetak</button>
        </div>

        <div id="print-area" style="background-color: #ffffff; overflow: hidden; padding: 2rem;">
            <div style="margin-bottom: 1rem;">
                <div class="header" style="display:flex;border-bottom:2px solid black;">
                <img src="https://istekicsadabjn.ac.id/wp-content/uploads/2023/09/logo-1.png" class="justify-self-center h-fit w-[120px]" alt="">
                <div>
                <h2 style="text-align: center; font-size: 16pt; font-weight: 600;">ISTeK INSAN CENDEKIA HUSADA BOJONEGORO</h2>
                <h2 style="text-align: center; font-size: 16pt; font-weight: bolder; text-transform: uppercase;">FAKULTAS {{$perkuliahan->nm_fakultas}}</h2>
                <h2 style="text-align: center; font-size: 16pt; font-weight: bolder; text-transform: uppercase;">PRODI {{$perkuliahan->nm_prodi}}</h2>
                </div>
                </div>
                <h2 style="margin-top:20px;text-align: center; font-size: 14pt; font-weight: bold; text-transform: uppercase;">Data hadir Mahasiswa</h2>
                <h2 style="text-align: center; font-size: 14pt; font-weight: bold; text-transform: uppercase; margin-bottom: 1.5rem;">Semester {{ $perkuliahan->semester % 2 == 1 ? 'Ganjil' : 'Genap' }} TA {{$perkuliahan->thn_akademik}}</h2>

                <div style="display: flex; justify-content: space-between;">
                    <table style="font-size: 12pt; font-weight: 500;">
                        <tr><td style="padding: 0.3rem;">Mata Kuliah</td><td style="padding: 0.3rem;">:</td><td style="padding: 0.3rem;">{{$perkuliahan->nm_matkul}}</td></tr>
                        <tr><td style="padding: 0.3rem;">Kode MK</td><td style="padding: 0.3rem;">:</td><td style="padding: 0.3rem;">{{$perkuliahan->kd_matkul}}</td></tr>
                        <tr><td style="padding: 0.3rem;">Dosen Pengampu</td><td style="padding: 0.3rem;">:</td><td style="padding: 0.3rem;">{{$perkuliahan->nm_dosen}}</td></tr>
                    </table>
                    <table style="font-size: 12pt; font-weight: 500;">
                        <tr><td style="padding: 0.3rem;">Semester</td><td style="padding: 0.3rem;">:</td><td style="padding: 0.3rem;">{{$perkuliahan->semester}}</td></tr>
                        <tr><td style="padding: 0.3rem;">Kelas</td><td style="padding: 0.3rem;">:</td><td style="padding: 0.3rem;">{{$perkuliahan->kelas}}</td></tr>
                        <tr><td style="padding: 0.3rem;">Tahun Akademik</td><td style="padding: 0.3rem;">:</td><td style="padding: 0.3rem;">{{$perkuliahan->thn_akademik}}</td></tr>
                    </table>
                </div>
            </div>

            <div>
                <table style="width: 100%; border: 1px solid black; border-collapse: collapse;">
                <thead style="background-color: #66008b; color: white;">
                    <tr>
                        <th style="border: 1px solid black; padding: 0.3rem;" rowspan="2">NIM</th>
                        <th style="border: 1px solid black; padding: 0.3rem;" rowspan="2">Nama</th>
                        <th style="border: 1px solid black; padding: 0.3rem;" colspan="2">Status Kehadiran</th>
                        <th style="border: 1px solid black; padding: 0.3rem;" rowspan="2">Keterangan</th>
                    </tr>
                    <tr>
                        <th style="border: 1px solid black; padding: 0.3rem;">Hadir</th>
                        <th style="border: 1px solid black; padding: 0.3rem;">Tidak Hadir</th>
                    </tr>
                </thead>

                    <tbody>
                        @forelse($absensi as $databsensi)
                            <tr style="border: 1px solid black; background-color: #f9f9f9;">
                                <td style="border: 1px solid black; padding: 0.3rem;">{{ $databsensi->nim }}</td>
                                <td style="border: 1px solid black; padding: 0.3rem;">{{ $databsensi->nm_mahasiswa }}</td>
                                <td style="border: 1px solid black; padding: 0.3rem; text-align: center; font-size: 1.25rem;">{!! $databsensi->status_kehadiran == 'Y' ? '<i class="bi bi-check"></i>' : '' !!}</td>
                                <td style="border: 1px solid black; padding: 0.3rem; text-align: center; font-size: 1.25rem;">{!! $databsensi->status_kehadiran == 'T' ? '<i class="bi bi-check"></i>' : '' !!}</td>
                                <td style="border: 1px solid black; padding: 0.3rem;">{{ $databsensi->keterangan }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="border: 1px solid black; padding: 0.3rem; text-align: center; color: #6b7280;">Belum ada data Perkuliahan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    <!-- CSS Tailwind Custom -->
    <style>
        .a4 {
            width: 210mm;
            min-height: 297mm;
            padding: 10mm;
            margin: auto;
        }

        @media print {
            .a4 {
                width: 210mm !important;
                min-height: 297mm !important;
                padding: 10mm;
                margin: 0;
            }

            /* Menghilangkan tombol saat print */
        }
    </style>
<script>
    window.addEventListener('print-page', () => {
        const printContent = document.getElementById('print-area').outerHTML;
        const originalContent = document.body.innerHTML;

        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
        window.location.reload(); // Reload halaman agar Livewire tetap bekerja normal
    });
</script>

</div>
