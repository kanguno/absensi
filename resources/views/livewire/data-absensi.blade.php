<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-lg font-bold mb-4">Absensi Perkuliahan</h2>

    <form wire:submit.prevent="simpanAbsensi(true)" class="mb-4">
        <div class="mb-2">
            <label class="block text-sm font-medium">Nama</label>
            <input type="text" wire:model="nama" class="w-full border rounded p-2">
            @error('nama') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div class="mb-2">
            <label class="block text-sm font-medium">NIM</label>
            <input type="text" wire:model="nim" class="w-full border rounded p-2">
            @error('nim') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Mahasiswa</button>
    </form>

    <h3 class="text-lg font-bold mb-2">Daftar Kehadiran</h3>
    <table class="w-full border">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Nama</th>
                <th class="border px-4 py-2">NIM</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataAbsensi as $absen)
                <tr>
                    <td class="border px-4 py-2">{{ $absen->nama }}</td>
                    <td class="border px-4 py-2">{{ $absen->nim }}</td>
                    <td class="border px-4 py-2 text-{{ $absen->hadir ? 'green' : 'red' }}-600 font-semibold">
                        {{ $absen->hadir ? 'Hadir' : 'Tidak Hadir' }}
                    </td>
                    <td class="border px-4 py-2">
                        <button wire:click="tandaiHadir({{ $absen->id }})" class="bg-campus-warn-500 text-white px-2 py-1 rounded">Hadir</button>
                        <button wire:click="tandaiTidakHadir({{ $absen->id }})" class="bg-campus-alert-500 text-white px-2 py-1 rounded">Tidak Hadir</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $dataAbsensi->links() }}
    </div>
</div>
