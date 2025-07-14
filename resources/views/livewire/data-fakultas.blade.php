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
                    <h2 class="text-lg font-semibold">Data Fakultas</h2>
                    <button wire:click="tambahdata"
                       class="hover:bg-blue-500 text-white px-4 py-2 rounded bg-campus-deep">
                        + Tambah Fakultas
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300">
                        <thead class="bg-campus-primary text-white">
                            <tr>
                                <th class="border px-4 py-2 text-center">No.</th>
                                <th class="border px-4 py-2 text-center">Kd Fakultas</th>
                                <th class="border px-4 py-2 text-center">Fakultas</th>
                                <th class="border px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($fakultas ?? []  as $datfakultas)
                                <tr class="text-md hover:bg-gray-100 border">
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2">{{ $datfakultas->kd_fakultas }}</td>
                                    <td class="px-4 py-2">{{ $datfakultas->nm_fakultas }}</td>
                                    <td class="px-4 py-2 text-center text-sm justify-center flex gap-5">
                                            <a x-data="{ tooltip: false }" @mouseenter="tooltip = true" @mouseleave="tooltip = false"
                                            wire:click="edit({{ $datfakultas->kd_fakultas }})"
                                            class="relative bg-campus-action text-white px-2 py-1 items-center rounded hover:bg-campus-action-dark cursor-pointer">
                                                <i class="bi bi-pencil-square"></i>
                                                <span x-show="tooltip" class="absolute -top-[30px] left-1/2 transform -translate-x-1/2 bg-black text-white text-xs rounded py-1 px-2">
                                                    Perbaruhi Data
                                                </span>
                                            </a>

                                            <form class="inline">
                                                <button
                                                    x-data="{ tooltip: false }"
                                                    @mouseenter="tooltip = true"
                                                    @mouseleave="tooltip = false"
                                                    @click.prevent="
                                                        if (confirm('Yakin ingin menghapus?')) {
                                                            $wire.delete({{ $datfakultas->kd_fakultas }});
                                                        }
                                                    "
                                                    type="button"
                                                    class="relative bg-campus-alert text-white px-2 py-1 items-center rounded hover:bg-campus-alert-dark"
                                                >
                                                    <i class="bi bi-trash-fill"></i>
                                                    <span
                                                        x-show="tooltip"
                                                        class="absolute -top-[30px] left-1/2 transform -translate-x-1/2 bg-black text-white text-xs rounded py-1 px-2"
                                                    >
                                                        Hapus Data
                                                    </span>
                                                </button>
                                            </form>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="border px-4 py-2 text-center text-gray-500">
                                        Belum ada data Fakultas
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-6 flex justify-center items-center space-x-2">
                        {{-- Tombol Prev --}}
                        @if ($fakultas->onFirstPage())
                            <span class="px-3 py-1 bg-gray-200 text-gray-500 rounded cursor-not-allowed">← Prev</span>
                        @else
                            <button wire:click="previousPage" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">← Prev</button>
                        @endif

                        {{-- Nomor Halaman --}}
                        @foreach ($fakultas->getUrlRange(1, $fakultas->lastPage()) as $page => $url)
                            @if ($page == $fakultas->currentPage())
                                <span class="px-3 py-1 bg-blue-700 text-white rounded">{{ $page }}</span>
                            @else
                                <button wire:click="gotoPage({{ $page }})" class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">{{ $page }}</button>
                            @endif
                        @endforeach

                        {{-- Tombol Next --}}
                        @if ($fakultas->hasMorePages())
                            <button wire:click="nextPage" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Next →</button>
                        @else
                            <span class="px-3 py-1 bg-gray-200 text-gray-500 rounded cursor-not-allowed">Next →</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group {{$formdatafakultas}} fixed z-50 inset-0 flex items-center justify-center bg-black bg-opacity-20">
        <div class="max-w-4xl mx-auto mt-10 shadow-md min-w-[90%]">
        <div class="bg-campus-primary p-4 rounded-t-md">

            <div class="text-end">
                <span wire:click="cffakultas" class="px-2 py-1 bg-slate-50 rounded-full cursor-pointer hover:bg-slate-200 font-bold">X</span>
            </div>    
            <h2 class="text-xl text-center text-white font-bold">FORMULIR DATA FAKULTAS</h2>
        </div>

        <form wire:submit.prevent="save" class='p-6 bg-[#45025b] rounded-b-md max-h-[70vh] overflow-y-auto'>
                <div class="mb-4">
                    <label class="block text-white font-medium">Kode Fakultas* </label>
                    <input type="text" wire:model="kdfakultas"
                        class="w-full px-4 py-2 border-none rounded-lg focus:ring focus:ring-blue-300 placeholder-red-500 {{ $kdfakultas ? 'bg-gray-200' : '' }}"
                        {{ $opsisave==='Perbarui' ? 'disabled' : '' }}
                        >
                    @error('kdfakultas') <span class="text-campus-warn text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-white font-medium">Nama Fakultas* </label>
                    <input type="text" wire:model="nmfakultas"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                        @error('nmfakultas') <span class="text-campus-warn text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-between">
                    <button type="button" wire:click="resetform()"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Reset
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