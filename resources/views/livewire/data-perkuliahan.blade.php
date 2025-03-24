<div>
@if (session()->has('message'))
    <div id="notifikasi" class="bg-green-100 text-green-700 p-3 rounded mb-4 transition-opacity">
        {{ session('message') }}
    </div>
@endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                                <th class="border px-4 py-2 text-center">Id Perkuliahan</th>
                                <th class="border px-4 py-2 text-center">Kelas</th>
                                <th class="border px-4 py-2 text-center">Mata Kuliah</th>
                                <th class="border px-4 py-2 text-center">Nama Dosen</th>
                                <th class="border px-4 py-2 text-center">Tanggal</th>
                                <th class="border px-4 py-2 text-center">Jam</th>
                                <th class="border px-4 py-2 text-center">Expired</th>
                                <th class="border px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($perkuliahan as $datperkuliahan)
                                <tr class="hover:bg-gray-100 border">
                                    <td class="px-4 py-2">{{ $datperkuliahan->id_perkuliahan }}</td>
                                    <td class="px-4 py-2">{{ $datperkuliahan->kelas }}</td>
                                    <td class="px-4 py-2">{{ $datperkuliahan->nm_matkul }}</td>
                                    <td class="px-4 py-2">{{ $datperkuliahan->nm_dosen }}</td>
                                    <td class="px-4 py-2">{{ $datperkuliahan->tanggal }}</td>
                                    <td class="px-4 py-2">{{ $datperkuliahan->jam }}</td>
                                    <td class="px-4 py-2">{{ $datperkuliahan->batas_absen }}</td>
                                    <td class="px-4 py-2 text-center justify-center flex gap-5">
                                        <a  wire:click="edit({{ $datperkuliahan->id_perkuliahan }})"
                                        class="bg-[#ff9800] text-white px-3 py-1 rounded hover:bg-yellow-600 cursor-pointer">
                                        <i class="bi bi-pencil-square"></i> Perbarui
                                    </a>
                                    <form class="inline">
                                        <button type="button"
                                        wire:click="delete({{ $datperkuliahan->id_perkuliahan }})"
                                        onclick="return confirm('Yakin ingin menghapus?')"
                                        class="bg-[#f44336] text-white px-3 py-1 rounded hover:bg-red-600">
                                        <i class="bi bi-trash-fill"></i> Hapus
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
    <div class="form-group {{$formdataperkuliahan}} fixed inset-0 flex items-center justify-center bg-black bg-opacity-20">
        <div class="max-w-4xl mx-auto mt-10 shadow-md min-w-[90%]">
        <div class="bg-[#66008b] p-4 rounded-t-md">

            <div class="text-end">
                <span wire:click="cfperkuliahan" class="px-2 py-1 bg-slate-50 rounded-full cursor-pointer hover:bg-slate-200 font-bold">X</span>
            </div>    
            <h2 class="text-xl text-center text-white font-bold">FORMULIR DATA PERKULIAHAN</h2>
        </div>

        <form wire:submit.prevent="save" class='p-6 bg-[#45025b] rounded-b-md max-h-[80vh] overflow-y-auto'>
            <div class="mb-4">
                <label class="block text-white font-medium" required>Data Distribusi Mata Kuliah* </label>
                <select wire:model="idsebaranmatkul" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" require>
                <option selected>Pilih Distribusi Matkul</option>
                    @foreach($sebaranmatkul as $m)
                        <option value="{{ $m->id_sebaran_matkul }}">
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


