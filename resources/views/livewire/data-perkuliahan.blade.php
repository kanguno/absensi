<div>
@if (session()->has('message'))
    <div id="notifikasi" class="fixed bottom-4 right-4 z-50 bg-campus-warn text-green-700 px-4 py-3 rounded-2xl shadow-lg max-w-xs">
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
</div>

 <div class="py-5">
        <div class="w-full h-screen mx-auto lg:px-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-center mb-10 ">
                    <h2 class="text-2xl font-semibold">Data Perkuliahan</h2>
                </div>
                 
        <div class="flex flex-col flex-wrap md:flex-row justify-between items-center gap-4 mb-2 p-2 shadow-xl rounded-md">
            <div class="flex flex-wrap gap-2">
                <!-- Filter Kelas -->
                <div>
                    <select wire:model="filterKelas" wire:change="filterData" id="filterKelas" class="border-campus-primary px-2 py-1 text-xs rounded w-fit">
                        <option value="">-- Semua Kelas --</option>
                        @foreach ($listKelas as $kelas)
                            <option value="{{ $kelas->kelas }}">{{ $kelas->kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Dosen -->
                <div>
                    <select wire:model="filterDosen" wire:change="filterData" id="filterDosen" class="border-campus-primary px-2 py-1 text-xs rounded w-fit">
                        <option value="">-- Semua Dosen --</option>
                        @foreach ($listDosen as $dosen)
                            <option value="{{ $dosen->id_dosen }}">{{ $dosen->nm_dosen }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select wire:model="filterJenis" wire:change="filterData" id="filterJenis" class="border-campus-primary px-2 py-1 text-xs rounded w-fit">
                        <option value="">-- Teori/praktik --</option>
                            <option value="t">Teori</option>
                            <option value="p">praktik</option>
                    </select>
                </div>

                <!-- Filter Mata Kuliah -->
                <div>
                    <select wire:model="filterMatkul" wire:change="filterData" id="filterMatkul" class="border-campus-primary px-2 py-1 text-xs rounded w-fit">
                        <option value="">-- Semua Matkul --</option>
                        @foreach ($listMatkul as $matkul)
                            <option value="{{ $matkul->kd_matkul }}">{{ $matkul->nm_matkul }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
    <div class="flex gap-2 w-fit text-xs justify-end">
                    <button wire:click="tambahdata"
                       class="hover:bg-blue-500 text-white px-4 py-2 rounded bg-campus-deep">
                        + Tambah Perkuliahan
                    </button>
                    <button wire:click="preview" class="px-4 py-2 bg-campus-primary-dark text-white rounded hover:bg-blue-700">
                        <i class="bi bi-eye"></i> Preview Jurnal Dosen
                    </button>
                    <button wire:click="cetakPdf" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        <i class="bi bi-printer"></i> Cetak Jurnal Dosen
                    </button>
                </div>
        </div>

                <div class="overflow-x-auto">
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
                                 <th class="border px-4 py-2 text-center">Jam Perkuliahan</th>
                                <th class="border px-4 py-2 text-center">Batas Absen</th>
                                <th class="border px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($perkuliahan as $datperkuliahan)
                                <tr class="hover:bg-gray-100 border text-md">
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2">{{ $datperkuliahan->kelas }}</td>
                                    <td class="px-4 py-2">{{ $datperkuliahan->nm_matkul }}</td>
                                    <td class="px-4 py-2">{{ $datperkuliahan->nm_dosen }}</td>
                                    <td class="px-4 py-2">{{ $datperkuliahan->materi }}</td>
                                    <td class="px-4 py-2">{{ $datperkuliahan->pertemuan_ke }}</td>
                                    <td class="px-4 py-2">{{ $datperkuliahan->tanggal }}</td>
                                    <td class="px-4 py-2">{{ $datperkuliahan->jam }} s/d {{ $datperkuliahan->jam_selesai }}</td>
                                    <td class="px-4 py-2">{{ $datperkuliahan->batas_absen }}</td>
                                    <td class="px-4 py-2 text-center text-sm justify-center flex gap-5">
                                            <a x-data="{ tooltip: false }" @mouseenter="tooltip = true" @mouseleave="tooltip = false"
                                            wire:click="absensi({{ $datperkuliahan->id_perkuliahan }})"
                                            class="relative bg-campus-primary text-white px-2 py-1 items-center rounded hover:bg-campus-primary-light cursor-pointer">
                                                <i class="bi bi-card-checklist"></i>
                                                <span x-show="tooltip" class="absolute -top-[30px] left-1/2 transform -translate-x-1/2 bg-black text-white text-xs rounded py-1 px-2">
                                                    Absensi
                                                </span>
                                            </a>

                                            <a x-data="{ tooltip: false }" @mouseenter="tooltip = true" @mouseleave="tooltip = false"
                                            wire:click="cetakabsensi({{ $datperkuliahan->id_perkuliahan }})"
                                            class="relative bg-[#45025b] text-white px-2 py-1 items-center rounded hover:bg-purple-600 cursor-pointer">
                                                <i class="bi bi-file-earmark-ruled"></i>
                                                <span x-show="tooltip" class="absolute -top-[30px] left-1/2 transform -translate-x-1/2 bg-black text-white text-xs rounded py-1 px-2">
                                                    Lihat Absensi
                                                </span>
                                            </a>
                                                                <a x-data="{ tooltip: false }" @mouseenter="tooltip = true" @mouseleave="tooltip = false"
                                            wire:click="GenerateQr({{ $datperkuliahan->id_perkuliahan }})"
                                            class="relative bg-black text-white px-2 py-1 items-center rounded hover:bg-black-600 cursor-pointer">
                                                <i class="bi bi-qr-code"></i>
                                                <span x-show="tooltip" class="absolute -top-[30px] left-1/2 transform -translate-x-1/2 bg-black text-white text-xs rounded py-1 px-2">
                                                    Download QR Code
                                                </span>
                                            </a>

                                            <a x-data="{ tooltip: false }" @mouseenter="tooltip = true" @mouseleave="tooltip = false"
                                            wire:click="edit({{ $datperkuliahan->id_perkuliahan }})"
                                            class="relative bg-campus-action text-white px-2 py-1 items-center rounded hover:bg-campus-action-dark cursor-pointer">
                                                <i class="bi bi-pencil-square"></i>
                                                <span x-show="tooltip" class="absolute -top-[30px] left-1/2 transform -translate-x-1/2 bg-black text-white text-xs rounded py-1 px-2">
                                                    Perbaruhi Data
                                                </span>
                                            </a>

                                            <form class="inline">
                                                <button x-data="{ tooltip: false }" @mouseenter="tooltip = true" @mouseleave="tooltip = false"
                                                        type="button" wire:click="delete({{ $datperkuliahan->id_perkuliahan }})"
                                                        onclick="return confirm('Yakin ingin menghapus?')"
                                                        class="relative bg-campus-alert text-white px-2 py-1 items-center rounded hover:bg-campus-alert-dark">
                                                    <i class="bi bi-trash-fill"></i>
                                                    <span x-show="tooltip" class="absolute -top-[30px] left-1/2 transform -translate-x-1/2 bg-black text-white text-xs rounded py-1 px-2">
                                                        Hapus Data
                                                    </span>
                                                </button>
                                            </form>
                                    </td>

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
    <div class="form-group {{$formdataperkuliahan}} fixed z-40 inset-0 flex items-center justify-center bg-black bg-opacity-20">
        <div class="mx-auto mt-10 shadow-md min-w-[90%] max-w-screen-md">
        <div class="bg-campus-primary p-4 rounded-t-md">

            <div class="text-end">
                <span wire:click="cfperkuliahan" class="px-2 py-1 bg-slate-50 rounded-full cursor-pointer hover:bg-slate-200 font-bold">X</span>
            </div>    
            <h2 class="text-xl text-center text-white font-bold">FORMULIR DATA PERKULIAHAN</h2>
        </div>
            
        <form wire:submit.prevent="save" class='p-6 bg-campus-primary-dark rounded-b-md max-h-[70vh] overflow-y-auto'>
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
                @error('prodi') <span class="text-campus-warn text-sm">{{ $message }}</span> @enderror
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
                @error('kdmatkul') <span class="text-campus-warn text-sm">{{ $message }}</span> @enderror
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
                @error('semester') <span class="text-campus-warn text-sm">{{ $message }}</span> @enderror
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
                @error('dosen') <span class="text-campus-warn text-sm">{{ $message }}</span> @enderror
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
                @error('idsebaranmatkul') <span class="text-campus-warn text-sm">{{ $message }}</span> @enderror
            </div>
            
            <div class="mb-4">
                    <label class="block text-white font-medium">Kelas* </label>
                    <input type="text" wire:model="kelas"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300"
                        placeholder="Contoh Penulisan : 2024-A">
                    @error('kelas') <span class="text-campus-warn text-sm">{{ $message }}</span> @enderror
                </div>
                
                            <div class="mb-4">
                    <label class="block text-white font-medium">Pertemuan ke* </label>
                    <input type="number" wire:model="pertemuanke"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                    @error('pertemuanke') <span class="text-campus-warn text-sm">{{ $message }}</span> @enderror
                </div>
                    <div class="mb-4">
                    <label class="block text-white font-medium">Jenis Perkuliahan* </label>
                     <div class="flex text-white gap-6">
                        @if($sksteori>0)
                        <div class="flex items-center gap-2">
                        <input type="checkbox" wire:model="teori" class="form-checkbox">
                        <span>Teori</span>
                        </div>
                    @endif
                    @if($skspraktik>0)
                        <div class="flex items-center gap-2">
                            <input type="checkbox" wire:model="praktik" class="form-checkbox" >
                            <span>praktik</span>
                        </div>
                     </div>
                    @endif
                    @error('pertemuanke') <span class="text-campus-warn text-sm">{{ $message }}</span> @enderror
                </div>
            <div class="mb-4">
                    <label class="block text-white font-medium">Materi* </label>
                    <textarea wire:model="materi" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300"></textarea>
                    @error('materi') <span class="text-campus-warn text-sm">{{ $message }}</span> @enderror
                </div>

            
                <div class="mb-4">
                    <label class="block text-white font-medium">tanggal mulai* </label>
                    <input type="date" wire:model="tanggal"
                        class="px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                    @error('tanggal') <span class="text-campus-warn text-sm">{{ $message }}</span> @enderror
                </div>   
            
            <div class="w-full flex gap-1">
                <div class="mb-4">
                    <label class="block text-white font-medium">Jam* </label>
                    <input type="time" wire:model="jam"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                        @error('jam') <span class="text-campus-warn text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-white font-medium">Jam Selesai* </label>
                    <input type="time" wire:model="jamselesai"
                        class="px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                    @error('jamselesai') <span class="text-campus-warn text-sm">{{ $message }}</span> @enderror
                </div> 
                 <div class="mb-4">
                    <label class="block text-white font-medium">expired* </label>
                    <input type="datetime-local" wire:model="expired"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                    @error('expired') <span class="text-campus-warn text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
               

                <div class="flex justify-between">
                    <button type="button" wire:click="resetform()"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Reset
                    </button>

                    <button type="submit" 
                            class="bg-campus-deep text-white px-3 py-1 rounded hover:border-white hover:bg-campus-primary">
                        {{ $opsisave }}
                    </button>
                </div>
            </form>
        </div>

    </div>

</div>
