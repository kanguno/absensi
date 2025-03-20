<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Data Mahasiswa</h2>
                    <button wire:click=""
                       class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        + Tambah Mahasiswa
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="border px-4 py-2 text-left">NIM</th>
                                <th class="border px-4 py-2 text-left">Nama Mahasiswa</th>
                                <th class="border px-4 py-2 text-left">Program Studi</th>
                                <th class="border px-4 py-2 text-left">Fakultas</th>
                                <th class="border px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($datamahasiswa as $datmhs)
                                <tr class="hover:bg-gray-100">
                                    <td class="border px-4 py-2">{{ $datmhs->nim }}</td>
                                    <td class="border px-4 py-2">{{ $datmhs->nm_mahasiswa }}</td>
                                    <td class="border px-4 py-2">{{ $datmhs->nm_prodi }}</td>
                                    <td class="border px-4 py-2">{{ $datmhs->nm_fakultas }}</td>
                                    <td class="border px-4 py-2 text-center">
                                        <a  wire:click="edit({{ $datmhs->nim }})"
                                           class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                            Edit
                                        </a>
                                        <form  method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('Yakin ingin menghapus?')" 
                                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                                Hapus
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
    <div class="form-group">
        <div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
            

            @if (session()->has('message'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('message') }}
                </div>
            @endif

            <form wire:submit.prevent="save">
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">NIM</label>
                    <input type="text" wire:model="nim"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                    @error('nim') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Nama Mahasiswa</label>
                    <input type="text" wire:model="nm_mahasiswa"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                    @error('nm_mahasiswa') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Program Studi</label>
                    <input type="text" wire:model="kd_prodi"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                    @error('kd_prodi') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                

                <div class="flex justify-between">
                    <button type="button" wire:click="reset()"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Reset
                    </button>

                    <button type="submit" 
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        {{ $mahasiswa_id ? 'Update' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>