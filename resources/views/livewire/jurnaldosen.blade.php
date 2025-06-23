<div class="overflow-x-auto" style="font-family: sans-serif;">
     <div style="margin-bottom: 1rem;">
            <div class="header" style="display:flex; width:100%; justify-content:space-between; align-items:center;">
              <table style="width: 80%; font-size: 12pt; border-spacing: 0; border-collapse: collapse;">
                <tr>
                  <td style="vertical-align:top;display:flex; justify-content:end;">
                  <img 
                    src="{{ $preview ? asset('images/logo-istek.png') : public_path('images/logo-istek.png') }}" 
                    alt="Logo" 
                >
                </td>
                <td>
                <div style="flex-grow:1; text-align:center;margin-bottom:50px">
                    <h2 style="margin:0;font-size: 16pt; font-weight: bolder; text-transform: uppercase;">ISTeK INSAN CENDEKIA HUSADA BOJONEGORO</h2>
                    <h2 style="margin:0;font-size: 16pt; font-weight: bolder; text-transform: uppercase;">FAKULTAS {{ $nmfakultas }}</h2>
                    <h2 style="margin:0;font-size: 16pt; font-weight: bolder; text-transform: uppercase;">PRODI {{ $nmprodi }}</h2>
                    <h2 style="margin:0;font-size: 16pt; font-weight: bolder; text-transform: uppercase;">DAFTAR HADIR DOSEN</h2>
                    <h2 style="margin:0;font-size: 16pt; font-weight: bolder; text-transform: uppercase;">
                        Semester {{ $semester % 2 == 1 ? 'Ganjil' : 'Genap' }} TA {{ $tahunakademik }}
                    </h2>
                </div>
                </td>
                </tr>
                </table>
            </div>

 {{-- TABEL INFO --}}
    <table style="width: 100%; font-size: 11pt;font-weight: bolder; border-spacing: 0; border-collapse: collapse;">
        <tr>
            <td style="padding: 0.3rem; padding-right: 2rem; text-transform: uppercase;width:30mm;">Mata Kuliah</td><td>:</td>
            <td style="padding: 0.3rem; padding-right: 2rem; text-transform: uppercase;width:30mm;width:85mm;">{{ $nmmatkul }}</td>
            
            <td style="padding: 0.3rem; padding-right: 2rem;">DOSEN PENGAMPU</td><td>:</td><td style="padding: 0.3rem; padding-right: 2rem;">{{ $nmdosen }}</td>
        </tr>
        <tr>
            <td style="padding: 0.3rem; padding-right: 2rem;text-transform: uppercase;">Kode MK</td><td>:</td><td>{{ $kdmatkul }}</td>
            
            <td style="padding: 0.3rem; padding-right: 2rem;text-transform: uppercase;">TEORI</td><td>:</td>
            @if($teori)
            <td style="padding: 0.3rem; padding-right: 2rem;">50 Menit/SKS ( 50 Menit x {{$sks}} SKS x {{$jmlpertemuan}} Tm<br>= {{ 50 * $sks * $jmlpertemuan }} Menit = {{ number_format((50 * $sks * $jmlpertemuan) / 60) }} Jam)</td>
            @else
            <td style="padding: 0.3rem; padding-right: 2rem;">-</td>   
            @endif
        </tr>
        <tr>
            <td style="padding: 0.3rem; padding-right: 2rem;text-transform: uppercase;">BEBAN STUDI</td><td>:</td><td>{{ $sks }} SKS ({{ $sksteori ? $sksteori . ' TEORI, ' : '' }}{{ $skspraktik ? $skspraktik . ' PRAKTIK' : '' }})</td>
            
            <td style="padding: 0.3rem; padding-right: 2rem;text-transform: uppercase;">PRAKTIK</td><td>:</td>
            @if($praktik)
            <td style="padding: 0.3rem; padding-right: 2rem;">170 Menit/SKS ( 170 Menit x {{$sks}} SKS x {{$jmlpertemuan}} Tm<br>= {{ 170 * $sks * $jmlpertemuan }} Menit = {{ number_format((170 * $sks * $jmlpertemuan) / 60) }} Jam)</td>
            @else
            <td style="padding: 0.3rem; padding-right: 2rem;">-</td>
            @endif
        </tr>
        <tr>
            <td style="padding: 0.3rem; padding-right: 2rem;text-transform: uppercase;">PJMK</td><td>:</td><td></td>
        </tr>
    </table>
        </div>
                    <table style="border-collapse: collapse; width: 100%;font-size:11pt;">
                        <thead>
    <tr>
        <th rowspan="2" style="border: 1px solid black; padding: 4px; text-align: center; vertical-align: middle;">No.</th>
        <th rowspan="2" style="border: 1px solid black; padding: 4px; text-align: center; vertical-align: middle;min-width:50mm">Materi</th>
        <th rowspan="2" style="border: 1px solid black; text-align: center; vertical-align: middle;padding:4px; width: 80px; white-space: normal; word-wrap: break-word;">Jadwal Kegiatan <br>Pembelajaran</th>
        <th rowspan="2" style="border: 1px solid black; text-align: center; vertical-align: middle; white-space: normal; word-wrap: break-word;">Waktu<br>(Mulai - Berakhir)</th>
        <th colspan="2" style="border: 1px solid black; padding: 4px; text-align: center;">Kesesuaian<br>Jadwal</th>
        <th colspan="2" style="border: 1px solid black; padding: 4px; text-align: center;">Kesesuaian<br>Materi/Bahan<br>Kajian</th>
        <th rowspan="2" style="border: 1px solid black; padding: 4px; text-align: center; vertical-align: middle;">TTD<br>Dosen<br>Pengampu</th>
        <th rowspan="2" style="border: 1px solid black; padding: 4px; text-align: center; vertical-align: middle;">TTD PJ<br>Mhs</th>
        <th rowspan="2" style="border: 1px solid black; padding: 4px; text-align: center; vertical-align: middle;">TTD<br>PJMK</th>
    </tr>
    <tr>
        <th style="border: 1px solid black; padding: 4px;text-align: center;">Daring</th>
        <th style="border: 1px solid black; padding: 4px;text-align: center;">Luring</th>
        <th style="border: 1px solid black; padding: 4px;text-align: center;">Sesuai</th>
        <th style="border: 1px solid black; padding: 4px;text-align: center;">Tidak</th>
    </tr>
</thead>

                        <tbody>
                            @forelse($datperkuliahan as $datperkuliahan)
                                <tr class="hover:bg-gray-100 border text-md">
                                    <td  style="border: 1px solid black; padding: 4px; text-align: start; vertical-align: middle;">{{ $loop->iteration }}</td>
                                    <td  style="border: 1px solid black; padding: 4px; text-align: start; vertical-align: middle;">{{ $datperkuliahan->materi }}</td>
                                    <td  style="border: 1px solid black; padding: 4px; text-align: start; vertical-align: middle;">Tanggal:<br><p>{{ $datperkuliahan->tanggal }}</p></td>
                                    <td  style="border: 1px solid black; padding: 4px; text-align: center; vertical-align: middle;">{{ $datperkuliahan->jam }} s/d<br>{{ $datperkuliahan->jam_selesai }}</td>
                                    <td  style="border: 1px solid black; padding: 4px; text-align: start; vertical-align: middle;"></td>
                                    <td  style="border: 1px solid black; padding: 4px; text-align: start; vertical-align: middle;"></td>
                                    <td  style="border: 1px solid black; padding: 4px; text-align: start; vertical-align: middle;"></td>
                                    <td  style="border: 1px solid black; padding: 4px; text-align: start; vertical-align: middle;"></td>
                                    <td  style="border: 1px solid black; padding: 4px; text-align: start; vertical-align: middle;"></td>
                                    <td  style="border: 1px solid black; padding: 4px; text-align: start; vertical-align: middle;"></td>
                                    <td  style="border: 1px solid black; padding: 4px; text-align: start; vertical-align: middle;"></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="border px-4 py-2 text-center text-gray-500">
                                        Belum ada data Perkuliahan
                                    </td>
                                </tr>
                                @endforelse
                        </tbody>
                    </table>
                  {{-- TANDA TANGAN --}}
        <div style="margin-top: 4rem;">
            <table width="100%" style="text-align: center; font-size: 12pt;">
                <tr rowspan="3">
                    <td>Bojonegoro, ..........................................</td>
                </tr>
                <tr>
                    <td>Koordinator Gugus Mutu Prodi</td>
                    <td>Sekretaris Prodi</td>
                    <td>Kaprodi {{$nmprodi}}</td>
                </tr>
                <tr><td colspan="3" style="height: 80px;"></td></tr> <!-- Jarak tanda tangan -->
                <tr>
                    <td style="text-decoration: underline;">(............................................)</td>
                    <td style="text-decoration: underline;">(............................................)</td>
                    <td style="text-decoration: underline;">(............................................)</td>
                </tr>
            </table>
        </div>
                </div>