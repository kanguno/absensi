<div>
<div>
    @if (session()->has('message'))
        <div id="notifikasiModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-4 rounded-lg shadow-lg max-w-xs">
                <p class="text-green-700 font-semibold">{{ session('message') }}</p>
                <button onclick="closeModal()" class="mt-2 bg-green-500 text-white px-4 py-2 rounded-lg">OK</button>
            </div>
        </div>

        <script>
            function closeModal() {
                document.getElementById('notifikasiModal').style.display = 'none';
            }

            setTimeout(() => {
                closeModal();
            }, 5000); // Otomatis hilang setelah 3 detik
        </script>
    @endif
</div>

    <div class="bg-[#eae1fd] h-[100vh] flex justify-center">
        <div class="form-group grid md:flex max-w-4xl mx-auto mt-10 min-w-[60%] h-fit">
                    <div class="bg-white rounded-t-3xl md:rounded-r-none md:rounded-l-3xl w-full md:w-1/2 max-h-fit px-6 py-10">
                        <img src="https://istekicsadabjn.ac.id/wp-content/uploads/2023/09/logo-1.png" class="justify-self-center max-w-[300px]" alt="">
                        <div class="grid md:flex justify-between">
                        <table class="my-4 md:mb-0 text-md ">
                            <tr>
                                <td class="px-2">Mata Kuliah</td>
                                <td class="px-2">:</td>
                                <td class="px-2">{{$perkuliahan->nm_matkul}}</td>
                            </tr>                        
                            <tr>
                                <td class="px-2">Kode MK</td>
                                <td class="px-2">:</td>
                                <td class="px-2">{{$perkuliahan->kd_matkul}}</td>
                            </tr>                        
                            <tr>
                                <td class="px-2">Dosen Pengampu</td>
                                <td class="px-2">:</td>
                                <td class="px-2">{{$perkuliahan->nm_dosen}}</td>
                            </tr>                        
                            <tr>
                                <td class="px-2">Semester</td>
                                <td class="px-2">:</td>
                                <td class="px-2">{{$perkuliahan->semester}}</td>
                            </tr>                        
                            <tr>
                                <td class="px-2">Kelas</td>
                                <td class="px-2">:</td>
                                <td class="px-2">{{$perkuliahan->kelas}}</td>
                            </tr>                        
                            <tr>
                                <td class="px-2">Tahun Akademik</td>
                                <td class="px-2">:</td>
                                <td class="px-2">{{$perkuliahan->thn_akademik}}</td>
                            </tr>                        
                        </table>
                    
                    </div>
                </form>
            </div>
            <div class="grid w-full md:w-1/2 px-6 py-10 bg-gradient-to-r to-[#af26d8] from-[#45025b] rounded-b-3xl md:rounded-l-none md:rounded-r-3xl justify-center">            
            <h2 class="text-2xl text-center text-white font-bold mb-10">FORMULIR ABSENSI</h2>
               
                <form wire:submit.prevent="caridataabsensi" class='{{$carimhs}} grid w-full'>
                    <div class="h-fit flex gap-0 w-full justify-between bg-white rounded-3xl p-2 shadow-xl items-center">
                        <input type="text" wire:model="nim" class="border-none p-0 focus:ring-0 w-full placeholder:text-center mx-2" placeholder="Masukkan NIM Anda">
                        <button type="submit" wire:click="caridataabsensi" class="border-none text-center px-3 py-2 text-white bg-orange-500 hover:bg-[#ff9800] rounded-3xl" ><i class="bi bi-search"></i></button>
                    </div>
                </form>
                @if($absensi)
                <table class="text-white {{$formabsen}}">
                    <tr>
                        <td class="px-2">NIM</td>
                        <td class="px-2">:</td>
                        <td class="px-2">{{$absensi->nim}}</td>
                    </tr>
                    <tr>
                        <td class="px-2">Nama</td>
                        <td class="px-2">:</td>
                        <td class="px-2">{{$absensi->nm_mahasiswa}}</td>
                    </tr>
                    <tr>
                        <td class="px-2">Kelas</td>
                        <td class="px-2">:</td>
                        <td class="px-2">{{$absensi->kelas}}</td>
                    </tr>
                    <tr>
                        <td class="px-2">Program Studi</td>
                        <td class="px-2">:</td>
                        <td class="px-2">{{$absensi->nm_prodi}}</td>
                    </tr>
                    <tr>
                        <td class="px-2">Fakultas</td>
                        <td class="px-2">:</td>
                        <td class="px-2">{{$absensi->nm_fakultas}}</td>
                    </tr>
                    <tr>
                        <td class="px-2">Status Kehadiran</td>
                        <td class="px-2">:</td>
                        <td class="px-2">{{ $absensi->status_kehadiran == 'Y' ? 'Hadir' : 'Tidak Hadir' }}</td>
                    </tr>
                </table>
                    <<div class="w-5/6 flex justify-self-center justify-between text-white bg-white rounded-3xl items-center px-4 py-1 shadow-lg {{$formabsen}}">
                        <button wire:click="resetcaridata" wire:model="nim" class="h-fit rounded-2xl justify-self-center px-2 py-2 shadow-lg border-none text-center bg-[#66008b] hover:bg-orange-500">Cari Data</button>
                        <button wire:click="absen({{$absensi->id_absensi}})" class="h-fit rounded-2xl justify-self-center px-2 py-2 shadow-lg border-none text-center bg-orange-500 hover:bg-[#ff9800]" >Absen</button>
                    </div>
            </div>
            @endif
        
    </div>
</div>