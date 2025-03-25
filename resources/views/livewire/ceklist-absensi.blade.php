<div>

@if (session()->has('message'))
    <div id="notifikasi" class="fixed bottom-4 right-4 z-50 bg-green-100 text-green-700 px-4 py-3 rounded-2xl shadow-lg max-w-xs">
        {{ session('message') }}
        <div class="absolute -bottom-2 right-4 w-0 h-0 border-l-8 border-l-transparent border-r-8 border-r-transparent shadow-lg border-t-8 border-green-100"></div>
    </div>
@endif
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('flashMessage', () => {
    setTimeout(() => {
        const flashMessage = document.getElementById('notifikasi');
        
        if (flashMessage) {
            setTimeout(() => {
                flashMessage.style.transition = 'opacity 1s ease-out';
                flashMessage.style.opacity = 0; // Fade out
                
                setTimeout(() => {
                    flashMessage.style.display = 'none'; // Menyembunyikan flash message setelah fade-out
                }, 1000); // Tunggu 1 detik setelah fade-out
            }, 1000); // Tunggu 3 detik sebelum mulai fade-out
        } else {
            console.log('flashMessage tidak ditemukan');
        }
    }, 500); // Tunggu 500ms untuk memastikan elemen ter-render
});


    });
</script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <h2 class="text-center text-2xl uppercase font-bold">PRODI {{$perkuliahan->nm_prodi}} FAKULTAS {{$perkuliahan->nm_fakultas}}</h2>
                    <h2 class="text-center text-2xl font-bold">ISTeK INSAN CENDEKIA HUSADA BOJONEGORO</h2>
                    <h2 class="text-center text-2xl uppercase font-bold">Data hadir Mahasiswa</h2>
                    <h2 class="text-center text-2xl uppercase font-bold mb-6">Semester
                        @if($perkuliahan->semester % 2 == 1)
                            Ganjil
                        @else
                            Genap
                        @endif        
                        TA {{$perkuliahan->thn_akademik}}
                </h2>
                    
                    <div class="grid md:flex justify-between">
                        <table class="mb-2 md:mb-0 text-lg font-semibold">
                            <tr>
                                <td class="px-4">Mata Kuliah</td>
                                <td class="px-4">:</td>
                                <td class="px-4">{{$perkuliahan->nm_matkul}}</td>
                            </tr>                        
                            <tr>
                                <td class="px-4">Kode MK</td>
                                <td class="px-4">:</td>
                                <td class="px-4">{{$perkuliahan->kd_matkul}}</td>
                            </tr>                        
                            <tr>
                                <td class="px-4">Dosen Pengampu</td>
                                <td class="px-4">:</td>
                                <td class="px-4">{{$perkuliahan->nm_dosen}}</td>
                            </tr>                        
                        </table>
                        <table class="text-lg font-semibold">
                            <tr>
                                <td class="px-4">Semester</td>
                                <td class="px-4">:</td>
                                <td class="px-4">{{$perkuliahan->semester}}</td>
                            </tr>                        
                            <tr>
                                <td class="px-4">Kelas</td>
                                <td class="px-4">:</td>
                                <td class="px-4">{{$perkuliahan->kelas}}</td>
                            </tr>                        
                            <tr>
                                <td class="px-4">Tahun Akademik</td>
                                <td class="px-4">:</td>
                                <td class="px-4">{{$perkuliahan->thn_akademik}}</td>
                            </tr>                        
                        </table>
                    </div>

                    
                </div>
                <div class="max-h-[70vh] overflow-scroll">
                    <table class="min-w-full border border-gray-300">
                        <thead class="bg-[#66008b] text-white">
                        <tr>
                                <th class="border px-4 py-2 text-center">NIM</th>
                                <th class="border px-4 py-2 text-center">Nama</th>
                                <th class="border px-4 py-2 text-center" colspan="2">Status Kehadiran</th>
                                <th class="border px-4 py-2 text-center">Keterangan</th>
                            </tr>
                            <tr class="bg-[#66008b] text-white">
                                <th colspan="2"></th>
                                <th class="border px-4 py-2 text-center">Hadir</th>
                                <th class="border px-4 py-2 text-center">Tidak Hadir</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($absensi as $databsensi)
                                <tr class="hover:bg-gray-100 border">
                                    <td class="px-4">{{ $databsensi->nim }}</td>
                                    <td class="px-4">{{ $databsensi->nm_mahasiswa }}</td>
                                    <td class="px-4 py-2 text-center">
                                        <label class="cursor-pointer">
                                            <input type="radio" 
                                                wire:model="status_kehadiran.{{ $databsensi->id_absensi }}"
                                                value="Y" 
                                                wire:change="updateKehadiran({{ $databsensi->id_absensi }}, 'Y')"
                                                class="hidden peer">
                                            <div class="w-12 h-6 rounded-full bg-gray-300 peer-checked:bg-green-500 relative transition-all">
                                                <div class="w-6 h-6 bg-white rounded-full absolute left-0 peer-checked:left-6 transition-all"></div>
                                            </div>
                                        </label>
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        <label class="cursor-pointer">
                                            <input type="radio" 
                                                wire:model="status_kehadiran.{{ $databsensi->id_absensi }}"
                                                value="T" 
                                                wire:change="updateKehadiran({{ $databsensi->id_absensi }}, 'T')"
                                                class="hidden peer">
                                            <div class="w-12 h-6 rounded-full bg-gray-300 peer-checked:bg-red-500 relative transition-all">
                                                <div class="w-6 h-6 bg-white rounded-full absolute left-0 peer-checked:left-6 transition-all"></div>
                                            </div>
                                        </label>
                                    </td>

                                    <td class="px-4">
                                        <textarea wire:model.lazy="keterangan.{{ $databsensi->id_absensi }}" 
                                            wire:change="updateKeterangan({{ $databsensi->id_absensi }})"
                                            class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-400 transition-all">
                                        </textarea>
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
</div>
