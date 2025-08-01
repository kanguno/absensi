<div>
@if (session()->has('message'))
    <div id="notifikasi" class="fixed bottom-4 right-4 z-50 bg-campus-warn-100 text-green-700 px-4 py-3 rounded-2xl shadow-lg max-w-xs">
        {{ session('message') }}
        <div class="absolute -bottom-2 right-4 w-0 h-0 border-l-8 border-l-transparent border-r-8 border-r-transparent shadow-lg border-t-8 border-green-100"></div>
    </div>
@endif

 <div class="py-5">
        <div class="w-full h-screen mx-auto lg:px-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Data Mahasiswa</h2>
                    <button wire:click="tambahdata"
                       class="hover:bg-blue-500 text-white px-4 py-2 rounded bg-campus-deep">
                        + Tambah Mahasiswa
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300">
                        <thead class="bg-campus-primary text-white">
                            <tr>
                                <th class="border px-4 py-2 text-center">No.</th>
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
                                <tr class="text-md hover:bg-gray-100 border">
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2">{{ $datmhs->nim }}</td>
                                    <td class="px-4 py-2">{{ $datmhs->nm_mahasiswa }}</td>
                                    <td class="px-4 py-2">{{ $datmhs->kelas }}</td>
                                    <td class="px-4 py-2">{{ $datmhs->semester }}</td>
                                    <td class="px-4 py-2">{{ $datmhs->nm_prodi }}</td>
                                    <td class="px-4 py-2">{{ $datmhs->nm_fakultas }}</td>
                                    <td class="px-4 py-2 text-center text-sm justify-center flex gap-5">
                                            <a x-data="{ tooltip: false }" @mouseenter="tooltip = true" @mouseleave="tooltip = false"
                                            wire:click="edit('{{ $datmhs->nim }}')"
                                            class="relative bg-campus-action text-white px-2 py-1 items-center rounded hover:bg-campus-action-dark cursor-pointer">
                                                <i class="bi bi-pencil-square"></i>
                                                <span x-show="tooltip" class="absolute -top-[30px] left-1/2 transform -translate-x-1/2 bg-black text-white text-xs rounded py-1 px-2">
                                                    Perbaruhi Data
                                                </span> 
                                            </a>

                                            <form class="inline">
                                                <button x-data="{ tooltip: false }" @mouseenter="tooltip = true" @mouseleave="tooltip = false"
                                                        type="button" wire:click="delete({{ $datmhs->nim }})"
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
                                        Belum ada data mahasiswa
                                    </td>
                                </tr>
                            @endforelse
                            
                          </tbody>
                    </table>
                      <div class="mt-6 flex justify-center items-center space-x-2">
                        {{-- Tombol Prev --}}
                        @if ($datamahasiswa->onFirstPage())
                            <span class="px-3 py-1 bg-gray-200 text-gray-500 rounded cursor-not-allowed">← Prev</span>
                        @else
                            <button wire:click="previousPage" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">← Prev</button>
                        @endif

                        {{-- Nomor Halaman --}}
                        @foreach ($datamahasiswa->getUrlRange(1, $datamahasiswa->lastPage()) as $page => $url)
                            @if ($page == $datamahasiswa->currentPage())
                                <span class="px-3 py-1 bg-blue-700 text-white rounded">{{ $page }}</span>
                            @else
                                <button wire:click="gotoPage({{ $page }})" class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">{{ $page }}</button>
                            @endif
                        @endforeach

                        {{-- Tombol Next --}}
                        @if ($datamahasiswa->hasMorePages())
                            <button wire:click="nextPage" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Next →</button>
                        @else
                            <span class="px-3 py-1 bg-gray-200 text-gray-500 rounded cursor-not-allowed">Next →</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group {{$formdatamhs}} fixed inset-0 flex items-center z-50 justify-center bg-black bg-opacity-20 ">
        <div class="max-w-4xl mx-auto my-auto shadow-md min-w-[90%]">
        <div class="bg-campus-primary p-4 rounded-t-md">

            <div class="text-end">
                <span wire:click="cfmhs" class="px-2 py-1 bg-slate-50 rounded-full cursor-pointer hover:bg-slate-200 font-bold">X</span>
            </div>    
            <h2 class="text-xl text-center text-white font-bold">FORMULIR DATA MAHASISWA</h2>
        </div>
            <form wire:submit.prevent="save" class='p-6  bg-[#45025b] rounded-b-md max-h-[70vh] overflow-y-auto'>
                <div class="mb-4">
                    
                    <label class="block text-white font-medium">NIM* </label>
                    <input type="text" wire:model="nim"
                        class="w-full px-4 py-2 border-none rounded-lg focus:ring focus:ring-blue-300 placeholder-red-500 {{ $nim ? 'bg-gray-200' : '' }}"
                       
                        >
                    @error('nim') <span class="text-campus-warn text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-white font-medium">Nama Mahasiswa* </label>
                    <input type="text" wire:model="nm_mahasiswa"
                        class="w-full px-4 py-2 border-none rounded-lg focus:ring focus:ring-blue-300 placeholder-red-500">
                    @error('nm_mahasiswa') <span class="text-campus-warn text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-white font-medium">Kelas* </label>
                    <input type="text" wire:model="kelas"
                        class="w-full px-4 py-2 border-none rounded-lg focus:ring focus:ring-blue-300 placeholder-red-500">
                    @error('kelas') <span class="text-campus-warn text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-white font-medium">Semester* </label>
                    <input type="number" wire:model="semester"
                        class="w-full px-4 py-2 border-none rounded-lg focus:ring focus:ring-blue-300 placeholder-red-500">
                    @error('semester') <span class="text-campus-warn text-sm">{{ $message }}</span> @enderror
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
                @error('kd_prodi') <span class="text-campus-warn text-sm">{{ $message }}</span> @enderror
                </div>

                
                    

                

                <div class="flex justify-between">
                    <button type="button" wire:click="formcarimhs"
                            class="bg-campus-primary text-white border-2 border-[#66008b] px-3 py-1 rounded hover:bg-white hover:text-[#66008b] hover:border-white">
                        Kosongkan Formulir
                    </button>

                    <button type="submit" 
                            class="bg-orange-500 text-white border-2 border-orange-500 px-3 py-1 rounded hover:border-orange-500  hover:bg-campus-primary">
                        {{ $opsisave }}
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>


