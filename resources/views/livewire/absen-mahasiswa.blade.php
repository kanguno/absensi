<div>
@if (session()->has('message'))
    <div id="notifikasi" class="fixed bottom-4 right-4 z-50 bg-green-100 text-green-700 px-4 py-3 rounded-2xl shadow-lg max-w-xs">
        {{ session('message') }}
        <div class="absolute -bottom-2 right-4 w-0 h-0 border-l-8 border-l-transparent border-r-8 border-r-transparent shadow-lg border-t-8 border-green-100"></div>
    </div>
@endif

    <div class="bg-[#eae1fd] h-[100vh] flex justify-center">
        <div class="form-group flex max-w-4xl mx-auto mt-10 min-w-[60%] h-fit">
                    <div class="bg-white rounded-l-xl w-1/2 max-h-fit px-6 py-10">
                        <img src="https://istekicsadabjn.ac.id/wp-content/uploads/2023/09/logo-1.png" class="justify-self-center max-w-[300px]" alt="">
                        <div class="grid md:flex justify-between">
                        <table class="my-4 md:mb-0 text-md ">
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
                </form>
            </div>
            <div class="grid w-1/2 p-6 bg-[#45025b] rounded-r-lg justify-center">
                <form wire:submit.prevent="caridataabsen" class=''>
                <h2 class="text-xl text-center text-white font-bold mb-10">FORMULIR ABSENSI</h2>
                    <div class="mb-4">
                        <input type="text" wire:model="nim" class="w-full px-4 py-2 border-none bg-[#eae1fd] rounded-2xl focus:ring focus:ring-blue-300" placeholder="Masukkan Nomor Induk Mahasiswa">
                    </div>
                    <div class="mb-4 justify-center w-full flex">
                        <button type="text" wire:model="nim" class="rounded-md justify-self-center px-3 py-2 border-none text-center " placeholder="Masukkan Nomor Induk Mahasiswa">Cari Data</button>
                    </div>
                </form>
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>Bambang Paripurno</td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>:</td>
                        <td>2024 A</td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td>Rekayasa Perangkat </td>
                    </tr>
                </table>
            </div>
        
    </div>
</div>