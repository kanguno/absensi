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
                    <h2 class="text-lg font-semibold">Data Mahasiswa</h2>
                    <button wire:click="tambahdata"
                       class="hover:bg-blue-500 text-white px-4 py-2 rounded bg-[#00bcd4]">
                        + Tambah Mahasiswa
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300">
                        <thead class="bg-[#66008b] text-white">
                            <tr>
                                <th class="border px-4 py-2 text-center">NIM</th>
                                <th class="border px-4 py-2 text-center">Nama Mahasiswa</th>
                                <th class="border px-4 py-2 text-center">Kelas</th>
                                <th class="border px-4 py-2 text-center">Semester</th>
                                <th class="border px-4 py-2 text-center">Program Studi</th>
                                <th class="border px-4 py-2 text-center">Fakultas</th>
                                <th class="border px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($datamahasiswa as $datmhs)
                                <tr class="hover:bg-gray-100 border">
                                    <td class="px-4 py-2">{{ $datmhs->nim }}</td>
                                    <td class="px-4 py-2">{{ $datmhs->nm_mahasiswa }}</td>
                                    <td class="px-4 py-2">{{ $datmhs->kelas }}</td>
                                    <td class="px-4 py-2">{{ $datmhs->semester }}</td>
                                    <td class="px-4 py-2">{{ $datmhs->nm_prodi }}</td>
                                    <td class="px-4 py-2">{{ $datmhs->nm_fakultas }}</td>
                                    <td class="px-4 py-2 text-center justify-center flex gap-5">
                                        <a  wire:click="edit({{ $datmhs->nim }})"
                                           class="bg-[#ff9800] text-white px-3 py-1 rounded hover:bg-yellow-600 cursor-pointer">
                                           <i class="bi bi-pencil-square"></i> Perbarui
                                        </a>
                                        <form class="inline">
                                            <button type="button"
                                                    wire:click="delete({{ $datmhs->nim }})"
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
                                        Belum ada data mahasiswa
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group {{$formdatamhs}} fixed inset-0 flex items-center z-50 justify-center bg-black bg-opacity-20 ">
        <div class="max-w-4xl mx-auto my-auto shadow-md min-w-[90%]">
        <div class="bg-[#66008b] p-4 rounded-t-md">

            <div class="text-end">
                <span wire:click="cfmhs" class="px-2 py-1 bg-slate-50 rounded-full cursor-pointer hover:bg-slate-200 font-bold">X</span>
            </div>    
            <h2 class="text-xl text-center text-white font-bold">FORMULIR DATA MAHASISWA</h2>
        </div>
            <form wire:submit.prevent="save" class='p-6 bg-[#45025b] rounded-b-md max-h-[70vh] overflow-y-auto'>
                <div class="mb-4">
                    <label class="block text-white font-medium">NIM* </label>
                    <input type="text" wire:model="nim"
                        class="w-full px-4 py-2 border-none rounded-lg focus:ring focus:ring-blue-300 placeholder-red-500 {{ $nim ? 'bg-gray-200' : '' }}"
                        {{ $opsisave==='Perbarui' ? 'disabled' : '' }}
                        >
                    @error('nim') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-white font-medium">Nama Mahasiswa* </label>
                    <input type="text" wire:model="nm_mahasiswa"
                        class="w-full px-4 py-2 border-none rounded-lg focus:ring focus:ring-blue-300 placeholder-red-500">
                    @error('nm_mahasiswa') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-white font-medium">Kelas* </label>
                    <input type="text" wire:model="kelas"
                        class="w-full px-4 py-2 border-none rounded-lg focus:ring focus:ring-blue-300 placeholder-red-500">
                    @error('kelas') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-white font-medium">Semester* </label>
                    <input type="number" wire:model="semester"
                        class="w-full px-4 py-2 border-none rounded-lg focus:ring focus:ring-blue-300 placeholder-red-500">
                    @error('semester') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                <select wire:model="kd_prodi" class="w-full px-4 py-2 border-none rounded-lg focus:ring focus:ring-blue-300 placeholder-red-500">
                    <option value="">Pilih Program Studi</option>
                    @foreach($prodi as $p)
                        <option value="{{ $p->kd_prodi }}" {{ $kd_prodi == $p->kd_prodi ? 'selected' : '' }}>
                            {{ $p->nm_prodi }}
                        </option>
                    @endforeach
                </select>
                @error('kd_prodi') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
                </div>

                
                    

                

                <div class="flex justify-between">
                    <button type="button" wire:click="formcarimhs"
                            class="bg-[#66008b] text-white border-2 border-[#66008b] px-3 py-1 rounded hover:bg-white hover:text-[#66008b] hover:border-white">
                        Kosongkan Formulir
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


