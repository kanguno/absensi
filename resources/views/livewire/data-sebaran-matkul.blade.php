<div>
@if (session()->has('message'))
    <div id="notifikasi" class="fixed bottom-4 right-4 z-50 bg-green-100 text-green-700 px-4 py-3 rounded-2xl shadow-lg max-w-xs">
        {{ session('message') }}
        <div class="absolute -bottom-2 right-4 w-0 h-0 border-l-8 border-l-transparent border-r-8 border-r-transparent shadow-lg border-t-8 border-green-100"></div>
    </div>
@endif

 <div class="py-5">
        <div class="w-full mx-auto lg:px-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Data Distribusi Mata Kuliah</h2>
                    <button wire:click="tambahdata"
                       class="hover:bg-blue-500 text-white px-4 py-2 rounded bg-[#00bcd4]">
                        + Tambah Distribusi
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300">
                        <thead class="bg-[#66008b] text-white">
                            <tr>
                                <th class="border px-4 py-2 text-center">Id Sebaran Matkul</th>
                                <th class="border px-4 py-2 text-center">Program Studi</th>
                                <th class="border px-4 py-2 text-center">Mata Kuliah</th>
                                <th class="border px-4 py-2 text-center">Nama Dosen</th>
                                <th class="border px-4 py-2 text-center">Semester</th>
                                <th class="border px-4 py-2 text-center">Tahun Akademik</th>
                                <th class="border px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sebaranmatkul as $datsebaranmatkul)
                                <tr class="hover:bg-gray-100 border">
                                    <td class="px-4 py-2">{{ $datsebaranmatkul->id_sebaran_matkul }}</td>
                                    <td class="px-4 py-2">{{ $datsebaranmatkul->nm_prodi }}</td>
                                    <td class="px-4 py-2">{{ $datsebaranmatkul->nm_matkul }}</td>
                                    <td class="px-4 py-2">{{ $datsebaranmatkul->nm_dosen }}</td>
                                    <td class="px-4 py-2">{{ $datsebaranmatkul->semester }}</td>
                                    <td class="px-4 py-2">{{ $datsebaranmatkul->thn_akademik }}</td>
                                    <td class="px-4 py-2 text-center justify-center flex gap-5">
                                        <a  wire:click="edit({{ $datsebaranmatkul->id_sebaran_matkul }})"
                                        class="bg-[#ff9800] text-white px-3 py-1 rounded hover:bg-yellow-600 cursor-pointer">
                                        <i class="bi bi-pencil-square"></i> Perbarui
                                    </a>
                                    <form class="inline">
                                        <button type="button"
                                        wire:click="delete({{ $datsebaranmatkul->id_sebaran_matkul }})"
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
    <div class="form-group {{$formdatasebaran}} fixed inset-0 flex items-center justify-center bg-black bg-opacity-20">
        <div class="max-w-4xl mx-auto mt-10 shadow-md min-w-[90%]">
        <div class="bg-[#66008b] p-4 rounded-t-md">

            <div class="text-end">
                <span wire:click="cfsebaran" class="px-2 py-1 bg-slate-50 rounded-full cursor-pointer hover:bg-slate-200 font-bold">X</span>
            </div>    
            <h2 class="text-xl text-center text-white font-bold">FORMULIR DATA DISTRIBUSI MATAKULIAH</h2>
        </div>

        <form wire:submit.prevent="save" class='p-6 bg-[#45025b] rounded-b-md max-h-[80vh] overflow-y-auto'>
            <div class="mb-4">
                <label class="block text-white font-medium" required>Matkul* </label>
                <select wire:model="kdprodi" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" require>
                <option selected>Pilih Program Studi</option>
                    @foreach($prodi as $p)
                        <option value="{{ $p->kd_prodi }}" {{ $kdprodi == $p->kd_prodi ? 'selected' : '' }}>
                            {{ $p->nm_prodi }}
                        </option>
                    @endforeach
                </select>
                @error('kdprodi') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-white font-medium" required>Matkul* </label>
                <select wire:model="kdmatkul" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" require>
                <option selected>Pilih Mata Kuliah</option>
                    @foreach($matkul as $m)
                        <option value="{{ $m->kd_matkul }}" {{ $kdmatkul == $m->kd_matkul ? 'selected' : '' }}>
                            {{ $m->nm_matkul }}
                        </option>
                    @endforeach
                </select>
                @error('kdmatkul') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-white font-medium" required>Nama Dosen Pengampu* </label>
                <select wire:model="iddosen" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" require>
                <option selected>Pilih Dosen Pengampu</option>
                    @foreach($dosen as $d)
                        <option value="{{ $d->id_dosen }}" {{ $iddosen == $d->id_dosen ? 'selected' : '' }}>
                            {{ $d->nm_dosen }}
                        </option>
                    @endforeach
                </select>
                @error('iddosen') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                    <label class="block text-white font-medium">Semester* </label>
                    <input type="number" wire:model="semester"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                    @error('semester') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-white font-medium">Tahun Akademik* </label>
                    <input type="text" wire:model="thnakademik"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                        @error('thnakademik') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
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


