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
                    <h2 class="text-lg font-semibold">Data Program Studi</h2>
                    <button wire:click="tambahdata"
                       class="hover:bg-blue-500 text-white px-4 py-2 rounded bg-[#00bcd4]">
                        + Tambah Program Studi
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300">
                        <thead class="bg-[#66008b] text-white">
                            <tr>
                                <th class="border px-4 py-2 text-center">Kd Prodi</th>
                                <th class="border px-4 py-2 text-center">Program Studi</th>
                                <th class="border px-4 py-2 text-center">Fakultas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($prodi Studi as $datprodi)
                                <tr class="hover:bg-gray-100 border">
                                    <td class="px-4 py-2">{{ $datprodi->nim }}</td>
                                    <td class="px-4 py-2">{{ $datprodi->nm_Program Studi }}</td>
                                    <td class="px-4 py-2">{{ $datprodi->kelas }}</td>
                                    <td class="px-4 py-2">{{ $datprodi->semester }}</td>
                                    <td class="px-4 py-2">{{ $datprodi->nm_prodi }}</td>
                                    <td class="px-4 py-2">{{ $datprodi->nm_fakultas }}</td>
                                    <td class="px-4 py-2 text-center justify-center flex gap-5">
                                        <a  wire:click="edit({{ $datprodi->nim }})"
                                           class="bg-[#ff9800] text-white px-3 py-1 rounded hover:bg-yellow-600 cursor-pointer">
                                           <i class="bi bi-pencil-square"></i> Perbarui
                                        </a>
                                        <form class="inline">
                                            <button type="button"
                                                    wire:click="delete({{ $datprodi->nim }})"
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
                                        Belum ada data Program Studi
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group {{$formdatamhs}} fixed inset-0 flex items-center justify-center bg-black bg-opacity-40">
        <div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-md min-w-[90%]">
        <div class="text-end">
            <span wire:click="cfmhs" class="px-2 py-1 bg-slate-50 rounded-full cursor-pointer hover:bg-slate-200 font-bold">X</span>
        </div>    

            <form wire:submit.prevent="save">
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">NIM</label>
                    <input type="text" wire:model="nim"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                    @error('nim') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Nama Program Studi</label>
                    <input type="text" wire:model="nm_Program Studi"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                    @error('nm_Program Studi') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Kelas</label>
                    <input type="text" wire:model="kelas"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                    @error('kelas') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Semester</label>
                    <input type="number" wire:model="semester"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                    @error('semester') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                <select wire:model="kd_prodi" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                    <option value="">Pilih Program Studi</option>
                    @foreach($prodi as $p)
                        <option value="{{ $p->kd_prodi }}" {{ $kd_prodi == $p->kd_prodi ? 'selected' : '' }}>
                            {{ $p->nm_prodi }}
                        </option>
                    @endforeach
                </select>

                </div>

                
                    

                

                <div class="flex justify-between">
                    <button type="button" wire:click="resetform()"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Reset
                    </button>

                    <button type="submit" 
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-[#00bcd4]">
                        {{ $Program Studi_id ? 'Update' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>

    </div>
   
</div>


