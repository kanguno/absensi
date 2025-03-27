<div>
<style>
    @media print {
        .bg-white {
            background-color: black !important;
        }
        .text-2xl {
            font-size: 1.5rem !important;
        }
        .px-4 {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }
        .flex{
            display:flex !important;;
        }
    }
</style>


   <div class="py-12">
   
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex w-fit justify-self-end space-x-4 mb-4 bg-white p-4">
                <button id="printBtn" wire:click="print" class="px-4 py-2 bg-blue-500 text-white rounded"> <i class="bi bi-printer-fill"></i> Cetak</button>
                <button id="savePdfBtn" class="px-4 py-2 bg-green-500 text-white rounded"><i class="bi bi-floppy"></i> Simpan PDF</button>
            </div>
            <div id="print-area" class="bg-white overflow-hidden shadow-sm p-6">
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
                <div class="max-h-full">
                    <table class="min-w-full border">
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
                                <tr class="hover:bg-gray-100 border">
                                    <td class="border border-black px-4">{{ $databsensi->nim }}</td>
                                    <td class="border border-black px-4">{{ $databsensi->nm_mahasiswa }}</td>
                                    <td class="border border-black px-4 text-center text-xl">{!! $databsensi->status_kehadiran == 'Y' ? '<i class="bi bi-check"></i>' : '' !!}</td>
                                    <td class="border border-black px-4 text-center text-xl">{!! $databsensi->status_kehadiran == 'T' ? '<i class="bi bi-check"></i>' : '' !!}</td>
                                    <td class="border border-black px-4">{{ $databsensi->keterangan }}</td>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <script>
        window.addEventListener('print-page', () => {
            let printContent = document.getElementById('print-area').innerHTML;
            let originalContent = document.body.innerHTML;

            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
        });
    </script>

</div>
