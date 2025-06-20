<div class="overflow-x-auto">
     <div style="margin-bottom: 1rem;">
            <div class="header" style="display:flex; width:100%; justify-content:space-between; align-items:center;">
              <table style="width: 80%; font-size: 12pt; border-spacing: 0; border-collapse: collapse;">
                <tr>
                  <td>
                  <img 
                    src="{{ public_path('images/logo-istek.png')}}" 
                    alt="Logo" 
                    class="w-[120px]"
                >
                </td>
                <td>
                <div style="flex-grow:1; text-align:center;">
                    <h2 style="font-size: 16pt; font-weight: bolder; text-transform: uppercase;">FAKULTAS {{ $nmfakultas }}</h2>
                    <h2 style="font-size: 16pt; font-weight: 600;">ISTeK INSAN CENDEKIA HUSADA BOJONEGORO</h2>
                    <h2 style="font-size: 16pt; font-weight: bolder; text-transform: uppercase;">PRODI {{ $nmprodi }}</h2>
                    <h2 style="font-size: 16pt; font-weight: bolder; text-transform: uppercase;">DAFTAR HADIR DOSEN</h2>
                    <h2 style="font-size: 16pt; font-weight: bolder; text-transform: uppercase;">
                        Semester {{ $semester % 2 == 1 ? 'Ganjil' : 'Genap' }} TA {{ $tahunakademik }}
                    </h2>
                </div>
                </td>
                </tr>
                </table>
            </div>

 {{-- TABEL INFO --}}
    <table style="width: 100%; font-size: 12pt; border-spacing: 0; border-collapse: collapse;">
        <tr>
            <td style="padding: 0.3rem; padding-right: 2rem; text-transform: uppercase;">Mata Kuliah</td><td>:</td><td>{{ $nmmatkul }}</td>
            <td style="padding: 0.3rem; padding-right: 2rem;">Dosen Pengampu</td><td>:</td><td>{{ $nmdosen }}</td>
        </tr>
        <tr>
            <td style="padding: 0.3rem; padding-right: 2rem;text-transform: uppercase;">Kode MK</td><td>:</td><td>{{ $kdmatkul }}</td>
        </tr>
        <tr>
            <td style="padding: 0.3rem; padding-right: 2rem;text-transform: uppercase;">BEBAN STUDI</td><td>:</td><td>{{ $sks }} SKS</td>
            <td style="padding: 0.3rem; padding-right: 2rem;text-transform: uppercase;"></td><td>:</td><td>{{$sks}}</td>
            
        </tr>
        <tr>
            <td style="padding: 0.3rem; padding-right: 2rem;text-transform: uppercase;">PJMK</td><td>:</td><td></td>
        </tr>
    </table>
        </div>
                    <table class="min-w-full border border-gray-300">
                        <thead class="bg-campus-primary text-white">
                            <tr>
                                <th class="border px-4 py-2 text-center">No.</th>
                                <th class="border px-4 py-2 text-center">Kelas</th>
                                <th class="border px-4 py-2 text-center">Mata Kuliah</th>
                                <th class="border px-4 py-2 text-center">Nama Dosen</th>
                                 <th class="border px-4 py-2 text-center">Materi</th>
                                 <th class="border px-4 py-2 text-center">Pertemuan ke</th>
                                <th class="border px-4 py-2 text-center">Tanggal Mulai</th>
                                 <th class="border px-4 py-2 text-center">Tanggal Selesai</th>
                                <th class="border px-4 py-2 text-center">Jam</th>
                                <th class="border px-4 py-2 text-center">Batas Absen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($datperkuliahan as $datperkuliahan)
                                <tr class="hover:bg-gray-100 border text-md">
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2">{{ $datperkuliahan->kelas }}</td>
                                    <td class="px-4 py-2">{{ $datperkuliahan->nm_matkul }}</td>
                                    <td class="px-4 py-2">{{ $datperkuliahan->nm_dosen }}</td>
                                    <td class="px-4 py-2">{{ $datperkuliahan->materi }}</td>
                                    <td class="px-4 py-2">{{ $datperkuliahan->pertemuan_ke }}</td>
                                    <td class="px-4 py-2">{{ $datperkuliahan->tanggal }}</td>
             <td class="px-4 py-2">{{ $datperkuliahan->tanggal_selesai }}</td>
                                    <td class="px-4 py-2">{{ $datperkuliahan->jam }}</td>
                                    <td class="px-4 py-2">{{ $datperkuliahan->batas_absen }}</td>
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
                </div>