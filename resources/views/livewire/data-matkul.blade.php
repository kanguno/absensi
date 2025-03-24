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
                    <h2 class="text-lg font-semibold">Data Mata Kuliah</h2>
                    <button wire:click="tambahdata"
                       class="hover:bg-blue-500 text-white px-4 py-2 rounded bg-[#00bcd4]">
                        + Tambah Mata Kuliah
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300">
                        <thead class="bg-[#66008b] text-white">
                            <tr>
                                <th class="border px-4 py-2 text-center">Kode Mata Kuliah</th>
                                <th class="border px-4 py-2 text-center">Nama Mata Kuliah</th>
                                <th class="border px-4 py-2 text-center">Jumlah SKS</th>
                                <th class="border px-4 py-2 text-center">Jumlah Teori</th>
                                <th class="border px-4 py-2 text-center">Jumlah Praktek</th>
                                <th class="border px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($matkul as $datmatkul)
                                <tr class="hover:bg-gray-100 border">
                                    <td class="px-4 py-2">{{ $datmatkul->kd_matkul }}</td>
                                    <td class="px-4 py-2">{{ $datmatkul->nm_matkul }}</td>
                                    <td class="px-4 py-2">{{ $datmatkul->jml_sks }}</td>
                                    <td class="px-4 py-2">{{ $datmatkul->teori }}</td>
                                    <td class="px-4 py-2">{{ $datmatkul->praktek }}</td>
                                    <td class="px-4 py-2 text-center justify-center flex gap-5">
                                        <a  wire:click="edit('{{ $datmatkul->kd_matkul }}')"
                                        class="bg-[#ff9800] text-white px-3 py-1 rounded hover:bg-yellow-600 cursor-pointer">
                                        <i class="bi bi-pencil-square"></i> Perbarui
                                    </a>
                                    <form class="inline">
                                        <button type="button"
                                        wire:click="delete({{ $datmatkul->kd_matkul }})"
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
                                        Belum ada data Mata Kuliah
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group {{$formdatamatkul}} fixed inset-0 flex items-center justify-center bg-black bg-opacity-20">
        <div class="max-w-4xl mx-auto mt-10 shadow-md min-w-[90%]">
        <div class="bg-[#66008b] p-4 rounded-t-md">

            <div class="text-end">
                <span wire:click="cfmatkul" class="px-2 py-1 bg-slate-50 rounded-full cursor-pointer hover:bg-slate-200 font-bold">X</span>
            </div>    
            <h2 class="text-xl text-center text-white font-bold">FORMULIR DATA MATA KULIAH</h2>
        </div>

        <form wire:submit.prevent="save" class='p-6 bg-[#45025b] rounded-b-md max-h-[80vh] overflow-y-auto'>
                <div class="mb-4">
                    <label class="block text-white font-medium">Kode Mata Kuliah* </label>
                    <input type="text" wire:model="kdmatkul"
                        class="w-full px-4 py-2 border-none rounded-lg focus:ring focus:ring-blue-300 placeholder-red-500 {{ $kdmatkul ? 'bg-gray-200' : '' }}"
                        {{ $opsisave==='Perbarui' ? 'disabled' : '' }}
                        >
                    @error('kdmatkul') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-white font-medium">Nama Mata Kuliah* </label>
                    <input type="text" wire:model="nmmatkul"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                        @error('nmmatkul') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-white font-medium">Jumlah SKS</label>
                    <input type="text" wire:model="sks"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                        @error('sks') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-white font-medium">Jumlah Teori</label>
                    <input type="text" wire:model="teori"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                        @error('teori') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-white font-medium">Jumlah Praktek</label>
                    <input type="text" wire:model="praktek"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                        @error('praktek') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
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


