<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

$component = new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
};
?>

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
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none; }
    </style>
</head>
<body class="bg-gray-100">
    <div x-data="{ sidebarOpen: true }">
        <div class="flex-1 flex flex-col">
            <header class="bg-white fixed z-50 w-full shadow p-4 flex justify-between items-center">
                <div class="flex space-x-2">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-black focus:outline-none">☰</button>
                    <h1 class="text-lg font-semibold">Dashboard</h1>
                </div>
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                   <div x-data="{ openDropdown: false }" class="relative">
                    <button @click="openDropdown = !openDropdown" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <span>{{ auth()->user()->nm_user ?? 'Guest' }}</span>
                        <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"></path>
                        </svg>
                    </button>
                
                    <div x-show="openDropdown" @click.away="openDropdown = false" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg">
                        <a href="{{ route('profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                        <button @click="$wire.logout()" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                            Log Out
                        </button>
                    </div>
                </div>

                </div>
            </header>
            <div class="flex">
               <div class="bg-white fixed z-10 h-full transition-transform duration-300"
     :class="sidebarOpen ? 'w-64' : 'w-0'">

                    <nav :class="sidebarOpen ? 'grid' : 'hidden'" class="mt-[4rem] p-4">
                        <div x-data="{ openAkademik: true }">
                            <button @click="openAkademik = !openAkademik" class="focus:outline-none w-full">
                                <h2 class="flex justify-between text-gray-700 font-semibold mt-4">
                                    <span>Data Akademik</span>
                                <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"></path>
                                </svg>
                                </h2>
                            </button>
                            <div x-show="openAkademik" x-cloak>
                                <x-responsive-nav-link :href="route('datafakultas')" :active="request()->routeIs('datafakultas')" wire:navigate>Data Fakultas</x-responsive-nav-link>
                                <x-responsive-nav-link :href="route('dataprodi')" :active="request()->routeIs('dataprodi')" wire:navigate>Data Program Studi</x-responsive-nav-link>
                                <x-responsive-nav-link :href="route('datamatkul')" :active="request()->routeIs('datamatkul')" wire:navigate>Data Mata Kuliah</x-responsive-nav-link>
                            </div>
                        </div>
                        <div x-data="{ openCivitas: true }">
                            <button @click="openCivitas = !openCivitas" class="focus:outline-none w-full">
                                <h2 class="flex justify-between text-gray-700 font-semibold mt-4">
                                  <span>
                                  Data Civitas Akademika
                                  </span>
                                <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"></path>
                                </svg>
                                </h2>
                            </button>
                            <div x-show="openCivitas" x-cloak>
                                <x-responsive-nav-link :href="route('datamahasiswa')" :active="request()->routeIs('datamahasiswa')" wire:navigate>Data Mahasiswa</x-responsive-nav-link>
                                <x-responsive-nav-link :href="route('datadosen')" :active="request()->routeIs('datadosen')" wire:navigate>Data Dosen</x-responsive-nav-link>
                            </div>
                        </div>
                        <div x-data="{ openPerkuliahan: true }">
                            <button @click="openPerkuliahan = !openPerkuliahan" class="focus:outline-none w-full">
                                <h2 class="flex justify-between text-gray-700 font-semibold mt-4">Manajemen Perkuliahan
                                  <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                      <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"></path>
                                  </svg>
                                </h2>
                                
                            </button>
                            <div x-show="openPerkuliahan" x-cloak>
                                <x-responsive-nav-link :href="route('dataperkuliahan')" :active="request()->routeIs('dataperkuliahan')" wire:navigate>Data Perkuliahan</x-responsive-nav-link>
                                <x-responsive-nav-link :href="route('datasebaranmatkul')" :active="request()->routeIs('datasebaranmatkul')" wire:navigate>Data Distribusi Mata Kuliah</x-responsive-nav-link>
                            </div>
                        </div>
                    </nav>
                </div>
                <main :class="sidebarOpen ? 'ml-64' : 'ml-0'" class="mt-10 w-full p-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    @livewireScripts
</body>
</html>
