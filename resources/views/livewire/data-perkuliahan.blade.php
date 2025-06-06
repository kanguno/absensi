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
</div>

 <div class="py-5">
        <div class="w-full h-screen mx-auto lg:px-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Data Perkuliahan</h2>
                    <button wire:click="tambahdata"
                       class="hover:bg-blue-500 text-white px-4 py-2 rounded bg-[#00bcd4]">
                        + Tambah Perkuliahan
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300">
                        <thead class="bg-[#66008b] text-white">
                            <tr>
                                <th class="border px-4 py-2 text-center">No.</th>
                                <th class="border px-4 py-2 text-center">Kelas</th>
                                <th class="border px-4 py-2 text-center">Mata Kuliah</th>
                                <th class="border px-4 py-2 text-center">Nama Dosen</th>
                                <th class="border px-4 py-2 text-center">Tanggal</th>
                                <th class="border px-4 py-2 text-center">Jam</th>
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
                                    <td class="px-4 py-2">{{ $datperkuliahan->tanggal }}</td>
                                    <td class="px-4 py-2">{{ $datperkuliahan->jam }}</td>
                                    <td class="px-4 py-2">{{ $datperkuliahan->batas_absen }}</td>
                                    <td class="px-4 py-2 text-center text-sm justify-center flex gap-5">
                                            <a x-data="{ tooltip: false }" @mouseenter="tooltip = true" @mouseleave="tooltip = false"
                                            wire:click="absensi({{ $datperkuliahan->id_perkuliahan }})"
                                            class="relative bg-[#1db851] text-white px-2 py-1 items-center rounded hover:bg-green-600 cursor-pointer">
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
                                            class="relative bg-[#ff9800] text-white px-2 py-1 items-center rounded hover:bg-yellow-600 cursor-pointer">
                                                <i class="bi bi-pencil-square"></i>
                                                <span x-show="tooltip" class="absolute -top-[30px] left-1/2 transform -translate-x-1/2 bg-black text-white text-xs rounded py-1 px-2">
                                                    Perbaruhi Data
                                                </span>
                                            </a>

                                            <form class="inline">
                                                <button x-data="{ tooltip: false }" @mouseenter="tooltip = true" @mouseleave="tooltip = false"
                                                        type="button" wire:click="delete({{ $datperkuliahan->id_perkuliahan }})"
                                                        onclick="return confirm('Yakin ingin menghapus?')"
                                                        class="relative bg-[#f44336] text-white px-2 py-1 items-center rounded hover:bg-red-600">
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
        <div class="max-w-4xl mx-auto mt-10 shadow-md min-w-[90%]">
        <div class="bg-[#66008b] p-4 rounded-t-md">

            <div class="text-end">
                <span wire:click="cfperkuliahan" class="px-2 py-1 bg-slate-50 rounded-full cursor-pointer hover:bg-slate-200 font-bold">X</span>
            </div>    
            <h2 class="text-xl text-center text-white font-bold">FORMULIR DATA PERKULIAHAN</h2>
        </div>
            
        <form wire:submit.prevent="save" class='p-6 bg-[#45025b] rounded-b-md max-h-[70vh] overflow-y-auto'>
            
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
                    @error('kelasl') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
                </div>

            <div class="mb-4">
                    <label class="block text-white font-medium">tanggal* </label>
                    <input type="date" wire:model="tanggal"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                    @error('tanggal') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-white font-medium">Jam* </label>
                    <input type="time" wire:model="jam"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                        @error('jam') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-white font-medium">expired* </label>
                    <input type="datetime-local" wire:model="expired"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                    @error('expired') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-between">
                    <button type="button" wire:click="resetform()"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Reset
                    </button>

                    <button type="submit" 
                            class="bg-orange-500 text-white border-2 border-orange-500 px-3 py-1 rounded hover:border-orange-500  hover:bg-[#66008b]">
                        {{ $opsisave }}
                    </button>
                </div>
            </form>
        </div>

    </div>
   
</div>


