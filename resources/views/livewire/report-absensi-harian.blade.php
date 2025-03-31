<div>
   <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <h2 class="text-center text-2xl uppercase font-bold">PRODI {{$perkuliahan->nm_prodi}} FAKULTAS {{$perkuliahan->nm_fakultas}}</h2>
                    <h2 class="text-center text-2xl font-bold">ISTeK INSAN CENDEKIA HUSADA BOJONEGORO</h2>
                    <h2 class="text-center text-2xl uppercase font-bold">Data hadir Mahasiswa</h2>
                    <h2 class="text-center text-2xl uppercase font-bold mb-6">Semester
                        @if($perkuliahan->semester % 2 == 1)
                            Ganjil
                        @else
                            Genap
                        @endif        
                        TA {{$perkuliahan->thn_akademik}}
                </h2>
                    
                    <div class="grid md:flex justify-between">
                        <table class="mb-2 md:mb-0 text-lg font-semibold">
                            <tr>
                                <td class="px-4">Mata Kuliah</td>
                                <td class="px-4">:</td>
                                <td class="px-4">{{$perkuliahan->nm_matkul}}</td>
                            </tr>                        
                            <tr>
                                <td class="px-4">Kode MK</td>
                                <td class="px-4">:</td>
                                <td class="px-4">{{$perkuliahan->kd_matkul}}</td>
                            </tr>                        
                            <tr>
                                <td class="px-4">Dosen Pengampu</td>
                                <td class="px-4">:</td>
                                <td class="px-4">{{$perkuliahan->nm_dosen}}</td>
                            </tr>                        
                        </table>
                        <table class="text-lg font-semibold">
                            <tr>
                                <td class="px-4">Semester</td>
                                <td class="px-4">:</td>
                                <td class="px-4">{{$perkuliahan->semester}}</td>
                            </tr>                        
                            <tr>
                                <td class="px-4">Kelas</td>
                                <td class="px-4">:</td>
                                <td class="px-4">{{$perkuliahan->kelas}}</td>
                            </tr>                        
                            <tr>
                                <td class="px-4">Tahun Akademik</td>
                                <td class="px-4">:</td>
                                <td class="px-4">{{$perkuliahan->thn_akademik}}</td>
                            </tr>                        
                        </table>
                    </div>

                    
                </div>
                <div class="max-h-[70vh] overflow-scroll">
                    <table class="min-w-full border border-gray-300">
                        <thead class="bg-[#66008b] text-white">
                        <tr>
                                <th class="border px-4 py-2 text-center">NIM</th>
                                <th class="border px-4 py-2 text-center">Nama</th>
                                <th class="border px-4 py-2 text-center" colspan="2">Status Kehadiran</th>
                                <th class="border px-4 py-2 text-center">Keterangan</th>
                            </tr>
                            <tr class="bg-[#66008b] text-white">
                                <th colspan="2"></th>
                                <th class="border px-4 py-2 text-center">Hadir</th>
                                <th class="border px-4 py-2 text-center">Tidak Hadir</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($absensi as $databsensi)
                                <tr class="text-md hover:bg-gray-100 border">
                                    <td class="px-4">{{ $databsensi->nim }}</td>
                                    <td class="px-4">{{ $databsensi->nm_mahasiswa }}</td>
                                    <td class="px-4">{{ $absensi->status_kehadiran == 'Y' ? '✔' : '' }}</td>
                                    <td class="px-4">{{ $absensi->status_kehadiran == 'T' ? '' : '✔' }}</td>
                                    <td class="px-4">{{ $databsensi->keterangan }}</td>
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
            </div>
        </div>
    </div>
</div>
