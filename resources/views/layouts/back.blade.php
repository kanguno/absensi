<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
    </head>
    <body class="bg-gray-100">
    <div x-data="{ open: true }">
        <!-- Sidebar -->
        <!-- Main Content -->
            <div class="flex-1 flex flex-col">
                <!-- Navbar -->
                <header class="bg-white fixed z-50 w-full shadow p-4 flex justify-between items-center">
                    <div class="flex space-x-2">
                        <button @click="open = !open" class="text-black focus:outline-none">
                            ☰
                        </button>
                        <h1 class="text-lg font-semibold">Dashboard</h1>
                    </div>
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="focus:outline-none">
                            {{ Auth::user()->name }} ⌄
                        </button>
                        <div x-show="open" class="absolute right-0 mt-2 bg-white border rounded shadow-md">
                            <x-dropdown-link :href="route('profile')" wire:navigate>
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <button wire:click="logout" class="block w-full text-left px-4 py-2">Logout</button>
                        </div>
                    </div>
                </header>
                <div class="flex">
                    <div  class="bg-white transition-all duration-300 fixed z-10 h-full">
                        <nav :class="open ? 'grid' : 'hidden'" class=" mt-[4rem] w-64">
                             <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                                {{ __('Dashboard') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('datamahasiswa')" :active="request()->routeIs('datamahasiswa')" wire:navigate>
                                {{ __('Data Mahasiswa') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('datadosen')" :active="request()->routeIs('datadosen')" wire:navigate>
                                {{ __('Data Dosen') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('dataprodi')" :active="request()->routeIs('dataprodi')" wire:navigate>
                                {{ __('Data Program Studi') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('datafakultas')" :active="request()->routeIs('datafakultas')" wire:navigate>
                                {{ __('Data Fakultas') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('datamatkul')" :active="request()->routeIs('datamatkul')" wire:navigate>
                                {{ __('Data Mata Kuliah') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('dataperkuliahan')" :active="request()->routeIs('dataperkuliahan')" wire:navigate>
                                {{ __('Data Perkuliahan') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('datasebaranmatkul')" :active="request()->routeIs('datasebaranmatkul')" wire:navigate>
                                {{ __('Data Distribusi Mata Kuliah') }}
                            </x-responsive-nav-link>
                        </nav>
                    </div>
                    <main :class="open ? 'ml-64' : 'ml-0'" class="mt-10 w-full p-4">
                        @yield('content')
                    </main>
                </div>
            </div>
    </div>
    @livewireScripts
</body>
   
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
            }, 3000); // Tunggu 3 detik sebelum mulai fade-out
        } else {
            console.log('flashMessage tidak ditemukan');
        }
    }, 500); // Tunggu 500ms untuk memastikan elemen ter-render
});


    });

    function closeModal() {
            const modal = document.getElementById('notifikasi');
            if (modal) {
            
                    modal.style.display = 'none'; // Menyembunyikan modal setelah fade-out selesai
                 
            } else {
                console.log('Modal tidak ditemukan');
            }
        }
</script>
</html>
