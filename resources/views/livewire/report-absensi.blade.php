<div>

@if (session()->has('message'))
    <div id="notifikasi" class="fixed bottom-4 right-4 z-50 bg-green-100 text-green-700 px-4 py-3 rounded-2xl shadow-lg max-w-xs">
        {{ session('message') }}
        <div class="absolute -bottom-2 right-4 w-0 h-0 border-l-8 border-l-transparent border-r-8 border-r-transparent shadow-lg border-t-8 border-green-100"></div>
    </div>
@endif
<div>
    @if (session()->has('messagemodal'))
        <div id="notifikasiModal" class="fixed z-50 inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-2 rounded-lg shadow-lg max-w-xs">
                
                <div class="text-center p-4 text-red-700">
                <i style="font-size: 4rem;" class="bi bi-bell-fill"></i>    
                <p class="p-4 text-red-700 font-semibold">{{ session('messagemodal') }}</p>
                    <button onclick="closeModal()" class="text-white px-3 py-2 hover:bg-slate-200 rounded-full cursor-pointer bg-slate-500 font-bold">Close</button>
                </div>
                
            </div>
        </div>
    @endif

    <form wire:submit.prevent="cariData" class='p-6 bg-[#45025b] rounded-md mt-10 shadow-lg {{ $form }}'>
        <div class="mb-4">
            <label class="block text-white font-medium" required>Program Studi* </label>
            <select wire:model="prodi" wire:change="dataMatkul()" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" require>
                <option selected>Pilih Program Studi</option>
                    @foreach($dataprodi as $p)
                        <option value="{{ $p->kd_prodi }}">
                        {{$p->kd_prodi}} || {{$p->nm_prodi}}
                        </option>
                    @endforeach
            </select>
                @error('prodi') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-white font-medium" required>Mata Kuliah* </label>
            <select wire:model="kdmatkul" wire:change="dataSemester()" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" require>
            <option>Pilih Mata Kuliah</option>
                @foreach($datamatkul as $m)
                    <option value="{{ $m->kd_matkul }}" @if($m->kd_matkul == $kdmatkul) selected @endif>
                        {{$m->kd_matkul}}||{{$m->nm_matkul}}
                    </option>
                @endforeach
            </select>
                @error('kdmatkul') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-white font-medium" required>Semester* </label>
            <select wire:model="semester" wire:change="dataDosen()" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" require>
            <option selected>Pilih Semester</option>
                @foreach($datasemester as $s)
                    <option value="{{ $s->semester }}" @if($s->semester == $semester) selected @endif>
                        Semester {{$s->semester}}
                    </option>
                @endforeach
            </select>
                @error('semester') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-white font-medium" required>Dosen Pengampu* </label>
            <select wire:model="dosen" wire:change="dataDistribusi()" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" require>
            <option >Pilih Dosen Pengampu</option>
                @foreach($datadosen as $d)
                    <option value="{{ $d->id_dosen }}" @if($d->id_dosen == $dosen) selected @endif>
                        {{$d->nm_dosen}}
                    </option>
                @endforeach
            </select>
                @error('dosen') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block text-white font-medium" required>Data Distribusi Mata Kuliah* </label>
            <select wire:model="idsebaranmatkul" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" require>
            <option >Pilih Distribusi Matkul</option>
                    @foreach($datadistribusi as $m)
                        <option value="{{ $m->id_sebaran_matkul }}" @if($m->id_sebaran_matkul == $idsebaranmatkul) selected @endif>
                        {{$m->id_sebaran_matkul}}||{{$m->nm_prodi}}||{{ $m->nm_matkul }}||{{$m->nm_dosen}}||Semester {{$m->semester}}
                        </option>
                    @endforeach
            </select>
                @error('idsebaranmatkul') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
        </div>
            
        <div class="mb-4">
            <label class="block text-white font-medium">Kelas* </label>
            <input type="text" wire:model="kelas"
                class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300"
                placeholder="Contoh Penulisan : 2024-A">
            @error('kelas') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4 flex justify-end " >
            <button type="submit" 
                class="bg-orange-500 text-white border-2 border-orange-500 px-3 py-1 rounded hover:border-orange-500  hover:bg-[#66008b]">
                Cari Data
            </button>
        </div>
    </form>
        

    
<div class="a4" style="padding-top: 3rem; padding-bottom: 3rem; {{ $reportAbsen }} ">
    <div style="max-width: 80rem; margin: auto; padding-left: 1.5rem; padding-right: 1.5rem;">
        <div class="rounded-xl shadow-lg flex w-fit justify-self-end gap-4 mb-4 bg-white p-3">
            <button wire:click="kembali" class="bg-[#1db851] text-white px-3 py-1 rounded hover:bg-green-600 cursor-pointer"><i class="bi bi-arrow-left-square"></i> Kembali</button>
            <button id="printBtn" wire:click="print" class="hover:bg-blue-500 text-white px-4 py-2 rounded bg-[#00bcd4]"> <i class="bi bi-printer-fill"></i> Cetak</button>
        </div>
        <div class="shadow-xl">
            <div id="print-area" style="background-color: #ffffff; overflow: hidden; padding: 2rem;">
                <div style="margin-bottom: 1rem;">
                    <div class="header" style="display:flex;border-bottom:2px solid black;width:100%;justify-content:center;">
                    <!-- <img src="https://istekicsadabjn.ac.id/wp-content/uploads/2023/09/logo-1.png" class="justify-self-center h-fit w-[120px]" alt=""> -->
                    <div>
                    <h2 style="text-align: center; font-size: 16pt; font-weight: 600;">ISTeK INSAN CENDEKIA HUSADA BOJONEGORO</h2>
                    <h2 style="text-align: center; font-size: 16pt; font-weight: bolder; text-transform: uppercase;">FAKULTAS {{$nmfakultas}}</h2>
                    <h2 style="text-align: center; font-size: 16pt; font-weight: bolder; text-transform: uppercase;">PRODI {{$nmprodi}}</h2>
                    </div>
                    </div>
                    <h2 style="margin-top:20px;text-align: center; font-size: 14pt; font-weight: bold; text-transform: uppercase;">Data hadir Mahasiswa</h2>
                    <h2 style="text-align: center; font-size: 14pt; font-weight: bold; text-transform: uppercase; margin-bottom: 1.5rem;">Semester {{ $semester % 2 == 1 ? 'Ganjil' : 'Genap' }} TA {{$tahunakademik}}</h2>
    
                    <div style="display: flex; justify-content: space-between;border:none;">
                        <table style="font-size: 12pt; font-weight: 500;border:none;">
                            <tbody style="border:none;">
                            <tr><td style="padding: 0.3rem;border:none;">Mata Kuliah</td><td style="padding: 0.3rem;border:none;">:</td><td style="padding: 0.3rem;border:none;">{{$nmmatkul}}</td></tr>
                            <tr><td style="padding: 0.3rem;border:none;">Kode MK</td><td style="padding: 0.3rem;border:none;">:</td><td style="padding: 0.3rem;border:none;">{{$kdmatkul}}</td></tr>
                            <tr><td style="padding: 0.3rem;border:none;">Dosen Pengampu</td><td style="padding: 0.3rem;border:none;">:</td><td style="padding: 0.3rem;border:none;">{{$nmdosen}}</td></tr>
                            </tbody>
                        </table>
                        <table style="font-size: 12pt; font-weight: 500;border:none;">
                            <tbody style="border:none;">
                                <tr><td style="padding: 0.3rem;border:none;">Semester</td><td style="padding: 0.3rem;border:none;">:</td><td style="padding: 0.3rem;border:none;">{{$semester}}</td></tr>
                                <tr><td style="padding: 0.3rem;border:none;">Kelas</td><td style="padding: 0.3rem;border:none;">:</td><td style="padding: 0.3rem;border:none;">{{$kelas}}</td></tr>
                                <tr><td style="padding: 0.3rem;border:none;">Tahun Akademik</td><td style="padding: 0.3rem;border:none;">:</td><td style="padding: 0.3rem;border:none;">{{$tahunakademik}}</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                <div class="table-container" style="overflow-x: auto;">
                        <table border="1" cellspacing="0" cellpadding="1" style="width: 100%; font-size: 11pt; border-collapse: collapse; text-align: center;">
                        <thead style="background-color: #66008b; color: white; border:1px solid black;">
                        <tr>
                            <th rowspan="2" style="max-width: 100px; border: 1px solid black;">NIM</th>
                            <th rowspan="2" style="max-width: 150px; border: 1px solid black;">Nama</th>
                            <th colspan="{{ count($tanggalHeader) }}" style="text-align: center; border: 1px solid black;">Tanggal Perkuliahan</th>
                        </tr>
                        <tr>
                            @foreach($tanggalHeader as $tgl)
                                <th style="max-width: 20px; border: 1px solid black; text-align: center;">
                                    {{ \Carbon\Carbon::parse($tgl)->format('d') }}
                                </th>
                            @endforeach
                        </tr>
                            </thead>
                            <tbody border="1" >
                                @foreach($absensi as $row)
                                    <tr>
                                        <td style="text-align: left; border: 1px solid black;">{{ $row['nim'] }}</td>
                                        <td style="text-align: left; border: 1px solid black;">{{ $row['nama'] }}</td>
                                        @foreach($tanggalHeader as $tgl)
                                        <td style="text-align: center; border: 1px solid black;">
                                            {{ $row[$tgl] === 'Y' ? 'H' : ($row[$tgl] === null ? '' : '-') }}
                                        </td>
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
</div>

    <!-- CSS Tailwind Custom -->
    <style>
    

    .a4 {
        height: 210mm;
        min-width: 297mm;
        padding: 10mm;
        margin: auto;
    }

    @media print {
        body {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .a4 {
            height: 210mm !important;
            min-width: 297mm !important;
            padding: 10mm;
            margin: 0;
        }
        thead {
            display: table-header-group;
        }

        /* Optional: Pastikan background header muncul saat print */
        thead th {
            background-color: #66008b !important;
            color: white !important;
            -webkit-print-color-adjust: exact; 
            print-color-adjust: exact;
        }

        button, .rounded-xl {
            display: none !important;
        }
    }
</style>

<script>
    window.addEventListener('print-page', () => {
        const printElement = document.getElementById('print-area');

        if (!printElement) {
            console.warn('Element #print-area tidak ditemukan.');
            return;
        }

        // Hapus class sebelum dicetak
        printElement.classList.remove('shadow-xl');

        // Simpan HTML dari elemen yang sudah diubah
        const printContent = printElement.outerHTML;
        const originalContent = document.body.innerHTML;

        document.body.innerHTML = printContent;
        window.print();

        // Kembalikan isi halaman seperti semula
        document.body.innerHTML = originalContent;

        // Supaya Livewire hidup lagi setelah innerHTML diubah
        window.location.reload();
    });
</script>

</div>
