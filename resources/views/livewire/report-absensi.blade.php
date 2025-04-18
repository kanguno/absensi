<div>
<div class="a4" style="padding-top: 3rem; padding-bottom: 3rem;">
    <div style="max-width: 80rem; margin: auto; padding-left: 1.5rem; padding-right: 1.5rem;">
        <div class="rounded-xl shadow-lg flex w-fit justify-self-end gap-4 mb-4 bg-white p-3">
            <button wire:click="kembali" class="bg-[#1db851] text-white px-3 py-1 rounded hover:bg-green-600 cursor-pointer"><i class="bi bi-arrow-left-square"></i> Kembali</button>
            <button id="printBtn" wire:click="print" class="hover:bg-blue-500 text-white px-4 py-2 rounded bg-[#00bcd4]"> <i class="bi bi-printer-fill"></i> Cetak</button>
        </div>

        <div id="print-area" style="background-color: #ffffff; overflow: hidden; padding: 2rem;">
            <div style="margin-bottom: 1rem;">
                <div class="header" style="display:flex;border-bottom:2px solid black;width:100%;justify-content:center;">
                <!-- <img src="https://istekicsadabjn.ac.id/wp-content/uploads/2023/09/logo-1.png" class="justify-self-center h-fit w-[120px]" alt=""> -->
                <div>
                <h2 style="text-align: center; font-size: 16pt; font-weight: 600;">ISTeK INSAN CENDEKIA HUSADA BOJONEGORO</h2>
                <h2 style="text-align: center; font-size: 16pt; font-weight: bolder; text-transform: uppercase;">FAKULTAS {{$perkuliahan->nm_fakultas}}</h2>
                <h2 style="text-align: center; font-size: 16pt; font-weight: bolder; text-transform: uppercase;">PRODI {{$perkuliahan->nm_prodi}}</h2>
                </div>
                </div>
                <h2 style="margin-top:20px;text-align: center; font-size: 14pt; font-weight: bold; text-transform: uppercase;">Data hadir Mahasiswa</h2>
                <h2 style="text-align: center; font-size: 14pt; font-weight: bold; text-transform: uppercase; margin-bottom: 1.5rem;">Semester {{ $perkuliahan->semester % 2 == 1 ? 'Ganjil' : 'Genap' }} TA {{$perkuliahan->thn_akademik}}</h2>

                <div style="display: flex; justify-content: space-between;border:none;">
                    <table style="font-size: 12pt; font-weight: 500;border:none;">
                        <tr><td style="padding: 0.3rem;border:none;">Mata Kuliah</td><td style="padding: 0.3rem;border:none;">:</td><td style="padding: 0.3rem;border:none;">{{$perkuliahan->nm_matkul}}</td></tr>
                        <tr><td style="padding: 0.3rem;border:none;">Kode MK</td><td style="padding: 0.3rem;border:none;">:</td><td style="padding: 0.3rem;border:none;">{{$perkuliahan->kd_matkul}}</td></tr>
                        <tr><td style="padding: 0.3rem;border:none;">Dosen Pengampu</td><td style="padding: 0.3rem;border:none;">:</td><td style="padding: 0.3rem;border:none;">{{$perkuliahan->nm_dosen}}</td></tr>
                    </table>
                    <table style="font-size: 12pt; font-weight: 500;border:none;">
                        <tr><td style="padding: 0.3rem;border:none;">Semester</td><td style="padding: 0.3rem;border:none;">:</td><td style="padding: 0.3rem;border:none;">{{$perkuliahan->semester}}</td></tr>
                        <tr><td style="padding: 0.3rem;border:none;">Kelas</td><td style="padding: 0.3rem;border:none;">:</td><td style="padding: 0.3rem;border:none;">{{$perkuliahan->kelas}}</td></tr>
                        <tr><td style="padding: 0.3rem;border:none;">Tahun Akademik</td><td style="padding: 0.3rem;border:none;">:</td><td style="padding: 0.3rem;border:none;">{{$perkuliahan->thn_akademik}}</td></tr>
                    </table>
                </div>
            </div>
            <div>
            <div class="table-container" style="overflow-x: auto;">
                    <table border="1" cellspacing="0" cellpadding="1" style="width: 100%; font-size: 11pt; border-collapse: collapse; text-align: center;">
                    <thead style="background-color: #66008b; color: white;">
                            <tr>
                                <th style="max-width: 100px;">NIM</th>
                                <th style="max-width: 150px;">Nama</th>
                                @foreach($tanggalHeader as $tgl)
                                    <th style="max-width: 20px;">{{ \Carbon\Carbon::parse($tgl)->format('d') }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody border="1" >
                            @foreach($absensi as $row)
                                <tr>
                                    <td>{{ $row['nim'] }}</td>
                                    <td>{{ $row['nama'] }}</td>
                                    @foreach($tanggalHeader as $tgl)
                                        <td>{{ $row[$tgl]==='Y' ? 'H' : '-' }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

    <!-- CSS Tailwind Custom -->
    <style>
        tbody,td{
            border:1px solid black;
        }
        .a4 {
            height: 210mm;
            min-width: 297mm;
            padding: 10mm;
            margin: auto;
        }

        @media print {
            .a4 {
                height: 210mm !important;
                min-widtheight: 297mm !important;
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
