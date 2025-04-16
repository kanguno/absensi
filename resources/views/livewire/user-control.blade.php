<div>
    {{-- Notifikasi --}}
    @if (session()->has('message'))
        <div id="notifikasi" class="fixed bottom-4 right-4 z-50 bg-green-100 text-green-700 px-4 py-3 rounded-2xl shadow-lg max-w-xs">
            {{ session('message') }}
            <div class="absolute -bottom-2 right-4 w-0 h-0 border-l-8 border-l-transparent border-r-8 border-r-transparent shadow-lg border-t-8 border-green-100"></div>
        </div>
    @endif

    {{-- Data User --}}
    <div class="py-5">
        <div class="w-full h-screen mx-auto lg:px-5">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Data User</h2>
                    <button wire:click="tambahdata"
                        class="hover:bg-blue-500 text-white px-4 py-2 rounded bg-[#00bcd4]">
                        + Tambah User
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300">
                        <thead class="bg-[#66008b] text-white">
                            <tr>
                                <th class="border px-4 py-2 text-center">No.</th> 
                                <th class="border px-4 py-2 text-center">Nama User</th> 
                                <th class="border px-4 py-2 text-center">Email</th>
                                <th class="border px-4 py-2 text-center">Otoritas</th>
                                <th class="border px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($datauser as $u)
                                <tr class="text-md hover:bg-gray-100 border">
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2">{{ $u->nm_user }}</td>
                                    <td class="px-4 py-2">{{ $u->email }}</td>
                                    <td class="px-4 py-2">{{ $u->nm_otoritas }}</td>
                                    <td class="px-4 py-2 text-center text-sm justify-center flex gap-5">
                                        <a x-data="{ tooltip: false }" @mouseenter="tooltip = true" @mouseleave="tooltip = false"
                                            wire:click="edit({{ $u->id }})"
                                            class="relative bg-[#ff9800] text-white px-2 py-1 items-center rounded hover:bg-yellow-600 cursor-pointer">
                                            <i class="bi bi-pencil-square"></i>
                                            <span x-show="tooltip" class="absolute -top-[30px] left-1/2 transform -translate-x-1/2 bg-black text-white text-xs rounded py-1 px-2">
                                                Perbaruhi Data
                                            </span>
                                        </a>

                                        <button x-data="{ tooltip: false }" @mouseenter="tooltip = true" @mouseleave="tooltip = false"
                                            type="button" wire:click="delete({{ $u->id }})"
                                            onclick="return confirm('Yakin ingin menghapus?')"
                                            class="relative bg-[#f44336] text-white px-2 py-1 items-center rounded hover:bg-red-600">
                                            <i class="bi bi-trash-fill"></i>
                                            <span x-show="tooltip" class="absolute -top-[30px] left-1/2 transform -translate-x-1/2 bg-black text-white text-xs rounded py-1 px-2">
                                                Hapus Data
                                            </span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="border px-4 py-2 text-center text-gray-500">
                                        Belum ada data User
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Form Modal --}}
    <div class="form-group {{$formdatauser}} fixed z-50 inset-0 flex items-center justify-center bg-black bg-opacity-20">
        <div class="max-w-4xl mx-auto mt-10 shadow-md min-w-[90%]">
            <div class="bg-[#66008b] p-4 rounded-t-md">
                <div class="text-end">
                    <span wire:click="cfuser" class="px-2 py-1 bg-slate-50 rounded-full cursor-pointer hover:bg-slate-200 font-bold">X</span>
                </div>    
                <h2 class="text-xl text-center text-white font-bold">FORMULIR DATA USER</h2>
            </div>

            <form wire:submit.prevent="save" class='p-6 bg-[#45025b] rounded-b-md max-h-[70vh] overflow-y-auto'>
                <div class="mb-4">
                    <label class="block text-white font-medium">Nama User* </label>
                    <input type="text" wire:model="nmuser"
                        class="w-full px-4 py-2 border-none rounded-lg focus:ring focus:ring-blue-300 placeholder-red-500"
                        >
                    @error('nmuser') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-white font-medium">Email* </label>
                    <input type="email" wire:model="email"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                    @error('email') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-white font-medium">Password* </label>
                    <input type="password" wire:model="password"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                    @error('password') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-white font-medium">Konfirmasi Password* </label>
                    <input type="password" wire:model="password_confirmation"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                    @error('verifpassword') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-white font-medium">Otoritas* </label>
                    <select wire:model="kdotoritas" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                        <option value="">Pilih Otoritas</option>
                        @foreach($dataotoritas as $r)
                            <option value="{{ $r->kd_otoritas }}">
                                {{ $r->nm_otoritas }}
                            </option>
                        @endforeach
                    </select>
                    @error('kdotoritas') <span class="text-[#ffb700] text-sm">{{ $message }}</span> @enderror
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
