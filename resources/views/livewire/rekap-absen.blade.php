<div>
    @if (!$cetak)
        <div class="w-full flex my-4 content-end">
            <button wire:click="exportPDF" class="px-4 py-2 bg-campus-primary text-white rounded">
                Cetak PDF
            </button>
        </div>
    @endif

    <div class="bg-white p-4 w-full rounded shadow-2xl overflow-scroll">
        {{-- HEADER --}}
        <div style="margin-bottom: 1rem;">
            <div class="header" style="display:flex; border-bottom:2px solid black; width:100%; justify-content:space-between; align-items:center;">
              <table style="width: 80%; font-size: 12pt; border-spacing: 0; border-collapse: collapse;">
                <tr>
                  <td>
                  <img 
                    src="{{ $cetak ? public_path('images/logo-istek.png') : asset('images/logo-istek.png') }}" 
                    alt="Logo" 
                    class="w-[120px]"
                >
                </td>
                <td>
                <div style="flex-grow:1; text-align:center;">
                    <h2 style="font-size: 16pt; font-weight: 600;">ISTeK INSAN CENDEKIA HUSADA BOJONEGORO</h2>
                    <h2 style="font-size: 16pt; font-weight: bolder; text-transform: uppercase;">FAKULTAS {{ $nmfakultas }}</h2>
                    <h2 style="font-size: 16pt; font-weight: bolder; text-transform: uppercase;">PRODI {{ $nmprodi }}</h2>
                </div>
                </td>
                </tr>
                </table>
            </div>

            <h2 style="margin-top: 20px; text-align: center; font-size: 14pt; font-weight: bold;">Data Hadir Mahasiswa</h2>
            <h2 style="text-align: center; font-size: 14pt; font-weight: bold; margin-bottom: 1.5rem;">
                Semester {{ $semester % 2 == 1 ? 'Ganjil' : 'Genap' }} TA {{ $tahunakademik }}
            </h2>

 {{-- TABEL INFO --}}
    <table style="width: 100%; font-size: 12pt; border-spacing: 0; border-collapse: collapse;">
        <tr>
            <td style="padding: 0.3rem; padding-right: 2rem;">Mata Kuliah</td><td>:</td><td>{{ $nmmatkul }}</td>
            <td style="padding: 0.3rem; padding-right: 2rem;">Semester</td><td>:</td><td>{{ $semester }}</td>
        </tr>
        <tr>
            <td style="padding: 0.3rem; padding-right: 2rem;">Kode MK</td><td>:</td><td>{{ $kdmatkul }}</td>
            <td style="padding: 0.3rem; padding-right: 2rem;">Kelas</td><td>:</td><td>{{ $kelas }}</td>
        </tr>
        <tr>
            <td style="padding: 0.3rem; padding-right: 2rem;">SKS</td><td>:</td><td>{{ $sks }}</td>
            <td style="padding: 0.3rem; padding-right: 2rem;">Tahun Akademik</td><td>:</td><td>{{ $tahunakademik }}</td>
        </tr>
        <tr>
            <td style="padding: 0.3rem; padding-right: 2rem;">Dosen Pengampu</td><td>:</td><td>{{ $nmdosen }}</td>
        </tr>
    </table>
        </div>

        {{-- TABEL ABSEN --}}
        <table border="1" cellpadding="4" cellspacing="0" width="100%" style="border-collapse: collapse; font-family: sans-serif; font-size: 12px;">
            <thead>
                <tr>
                    @foreach ($header1 as $head)
                        <th style="border: 1px solid #000; text-align: center;">{{ $head }}</th>
                    @endforeach
                </tr>
                <tr>
                    @foreach ($header2 as $sub)
                        <th style="border: 1px solid #000; text-align: center; font-size: 10px;">{{ $sub }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($dataabsen as $item)
                    <tr>
                        <td style="border: 1px solid #000; text-align: center;">{{ $item->no }}</td>
                        <td style="border: 1px solid #000;">{{ $item->nama }}</td>
                        <td style="border: 1px solid #000;">{{ $item->nim }}</td>
                        @for ($i = 1; $i <= 14; $i++)
                            <td style="border: 1px solid #000; text-align: center;">{{ $item->{'TM'.$i} ?? '-' }}</td>
                        @endfor
                        <td style="border: 1px solid #000; text-align: center;">{{ $item->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- TANDA TANGAN --}}
        <div style="margin-top: 4rem;">
            <table width="100%" style="text-align: center; font-size: 12pt;">
                <tr>
                    <td>Ketua Kelas</td>
                    <td>Dosen Pengampu</td>
                    <td>Ketua Program Studi</td>
                </tr>
                <tr><td colspan="3" style="height: 80px;"></td></tr> <!-- Jarak tanda tangan -->
                <tr>
                    <td style="text-decoration: underline;">..................................</td>
                    <td style="text-decoration: underline;">{{ $nmdosen }}</td>
                    <td style="text-decoration: underline;">..................................</td>
                </tr>
            </table>
        </div>
    </div>
</div>