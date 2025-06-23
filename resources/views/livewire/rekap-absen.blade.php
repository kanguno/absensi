<div>
    @if (!$cetak)<div class="bg-campus-primary p-4 rounded-t-md mx-auto mt-10">
    <h2 class="text-xl text-center text-white font-bold">REKAP ABSENSI</h2>
</div>

<form wire:submit.prevent="caridata()" class="p-6 bg-white text-black rounded-b-md max-h-[70vh] overflow-y-auto">
    <div class="grid grid-cols-2 gap-2"> {{-- Paksa jadi 2 kolom --}}
        <div class="mb-2">
            <label class="block text-back font-medium">Program Studi*</label>
            <select wire:model="prodi" wire:change="dataMatkul()" required class="w-full px-4 py-2 border rounded-lg">
                <option value="">Pilih Program Studi</option>
                @foreach($dataprodi as $p)
                    <option value="{{ $p->kd_prodi }}">{{ $p->kd_prodi }} || {{ $p->nm_prodi }}</option>
                @endforeach
            </select>
            @error('prodi') <span class="text-campus-warn text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-2">
            <label class="block text-back font-medium">Mata Kuliah*</label>
            <select wire:model="kdmatkul" wire:change="dataSemester()" required class="w-full px-4 py-2 border rounded-lg">
                <option value="">Pilih Mata Kuliah</option>
                @foreach($datamatkul as $m)
                    <option value="{{ $m->kd_matkul }}">{{ $m->kd_matkul }} || {{ $m->nm_matkul }}</option>
                @endforeach
            </select>
            @error('kdmatkul') <span class="text-campus-warn text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-2">
            <label class="block text-back font-medium">Semester*</label>
            <select wire:model="semester" wire:change="dataDosen()" required class="w-full px-4 py-2 border rounded-lg">
                <option value="">Pilih Semester</option>
                @foreach($datasemester as $s)
                    <option value="{{ $s->semester }}">Semester {{ $s->semester }}</option>
                @endforeach
            </select>
            @error('semester') <span class="text-campus-warn text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-2">
            <label class="block text-back font-medium">Dosen Pengampu*</label>
            <select wire:model="dosen" required class="w-full px-4 py-2 border rounded-lg">
                <option value="">Pilih Dosen Pengampu</option>
                @foreach($datadosen as $d)
                    <option value="{{ $d->id_dosen }}">{{ $d->nm_dosen }}</option>
                @endforeach
            </select>
            @error('dosen') <span class="text-campus-warn text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4 col-span-2">
            <label class="block text-back font-medium">Kelas*</label>
            <input type="text" wire:model="kelas" required placeholder="Contoh Penulisan : 2024-A" class="w-full px-4 py-2 border rounded-lg">
            @error('kelas') <span class="text-campus-warn text-sm">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="flex justify-between mt-6">
        <button type="button" wire:click="resetform()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Reset</button>
        <button type="submit" class="bg-campus-deep text-white px-3 py-1 rounded hover:border-white hover:bg-campus-primary">Cari Data</button>
    </div>
</form>

@if($dataabsen)
        <div class="w-full flex mt-4 p-4 bg-white justify-end">
            <button wire:click="exportPDF" class="px-4 py-2 bg-campus-primary text-white rounded">
                 <i class="bi bi-printer"></i> Cetak PDF</button>
        </div>
        @endif
    @endif

@if($dataabsen)
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
    @endif
</div>