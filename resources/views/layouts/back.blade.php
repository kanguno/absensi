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
/* === TEXT COLORS === */
.text-campus-primary           { color: #81007f; }
.text-campus-primary-light     { color: #c576c5; }
.text-campus-primary-dark      { color: #4e0051; }

.text-campus-accent            { color: #fe8da1; }
.text-campus-accent-soft       { color: #febfca; }
.text-campus-accent-dark       { color: #c8576b; }

.text-campus-action            { color: #05bbaa; }
.text-campus-action-light      { color: #80e7dd; }
.text-campus-action-dark       { color: #02796e; }

.text-campus-info              { color: #76e1d1; }
.text-campus-info-dark         { color: #3da99b; }

.text-campus-warn              { color: #d4a537; }
.text-campus-warn-dark         { color: #bdb97f; }

.text-campus-alert             { color: #eb5951; }
.text-campus-alert-light       { color: #fba8a4; }
.text-campus-alert-dark        { color: #b53932; }

.text-campus-deep              { color: #534293; }
.text-campus-deep-light        { color: #897ac4; }
.text-campus-deep-dark         { color: #342266; }

/* === BACKGROUND COLORS === */
.bg-campus-primary             { background-color: #81007f; }
.bg-campus-primary-light       { background-color: #c576c5; }
.bg-campus-primary-dark        { background-color: #4e0051; }

.bg-campus-accent              { background-color: #fe8da1; }
.bg-campus-accent-soft         { background-color: #febfca; }
.bg-campus-accent-dark         { background-color: #c8576b; }

.bg-campus-action              { background-color: #05bbaa; }
.bg-campus-action-light        { background-color: #80e7dd; }
.bg-campus-action-dark         { background-color: #02796e; }

.bg-campus-info                { background-color: #76e1d1; }
.bg-campus-info-dark           { background-color: #3da99b; }

.bg-campus-warn                { background-color:#f1c971; }
.bg-campus-warn-dark           { background-color: #bdb97f; }

.bg-campus-alert               { background-color: #eb5951; }
.bg-campus-alert-light         { background-color: #fba8a4; }
.bg-campus-alert-dark          { background-color: #b53932; }

.bg-campus-deep                { background-color: #534293; }
.bg-campus-deep-light          { background-color: #897ac4; }
.bg-campus-deep-dark           { background-color: #342266; }

/* === BORDER COLORS === */
.border-campus-primary         { border-color: #81007f; }
.border-campus-primary-light   { border-color: #c576c5; }
.border-campus-primary-dark    { border-color: #4e0051; }

.border-campus-accent          { border-color: #fe8da1; }
.border-campus-accent-soft     { border-color: #febfca; }
.border-campus-accent-dark     { border-color: #c8576b; }

.border-campus-action          { border-color: #05bbaa; }
.border-campus-action-light    { border-color: #80e7dd; }
.border-campus-action-dark     { border-color: #02796e; }

.border-campus-info            { border-color: #76e1d1; }
.border-campus-info-dark       { border-color: #3da99b; }

.border-campus-warn            { border-color: #d4a537; }
.border-campus-warn-dark       { border-color: #bdb97f; }

.border-campus-alert           { border-color: #eb5951; }
.border-campus-alert-light     { border-color: #fba8a4; }
.border-campus-alert-dark      { border-color: #b53932; }

.border-campus-deep            { border-color: #534293; }
.border-campus-deep-light      { border-color: #897ac4; }
.border-campus-deep-dark       { border-color: #342266; }

/* === HOVER STATES === */
.hover\:bg-campus-primary:hover         { background-color: #81007f; }
.hover\:bg-campus-primary-light:hover   { background-color: #c576c5; }
.hover\:bg-campus-primary-dark:hover    { background-color: #4e0051; }

.hover\:bg-campus-accent:hover          { background-color: #fe8da1; }
.hover\:bg-campus-accent-soft:hover     { background-color: #febfca; }
.hover\:bg-campus-accent-dark:hover     { background-color: #c8576b; }

.hover\:bg-campus-action:hover          { background-color: #05bbaa; }
.hover\:bg-campus-action-light:hover    { background-color: #80e7dd; }
.hover\:bg-campus-action-dark:hover     { background-color: #02796e; }

.hover\:bg-campus-info:hover            { background-color: #76e1d1; }
.hover\:bg-campus-info-dark:hover       { background-color: #3da99b; }

.hover\:bg-campus-warn:hover            { background-color: #d4a537; }
.hover\:bg-campus-warn-dark:hover       { background-color: #bdb97f; }

.hover\:bg-campus-alert:hover           { background-color: #eb5951; }
.hover\:bg-campus-alert-light:hover     { background-color: #fba8a4; }
.hover\:bg-campus-alert-dark:hover      { background-color: #b53932; }

.hover\:bg-campus-deep:hover            { background-color: #534293; }
.hover\:bg-campus-deep-light:hover      { background-color: #897ac4; }
.hover\:bg-campus-deep-dark:hover       { background-color: #342266; }

/* === ACTIVE STATES === */
.active\:bg-campus-primary:active       { background-color: #81007f; }
.active\:bg-campus-primary-light:active { background-color: #c576c5; }
.active\:bg-campus-primary-dark:active  { background-color: #4e0051; }

.active\:bg-campus-accent:active        { background-color: #fe8da1; }
.active\:bg-campus-accent-soft:active   { background-color: #febfca; }
.active\:bg-campus-accent-dark:active   { background-color: #c8576b; }

.active\:bg-campus-action:active        { background-color: #05bbaa; }
.active\:bg-campus-action-light:active  { background-color: #80e7dd; }
.active\:bg-campus-action-dark:active   { background-color: #02796e; }

.active\:bg-campus-info:active          { background-color: #76e1d1; }
.active\:bg-campus-info-dark:active     { background-color: #3da99b; }

.active\:bg-campus-warn:active          { background-color: #d4a537; }
.active\:bg-campus-warn-dark:active     { background-color: #bdb97f; }

.active\:bg-campus-alert:active         { background-color: #eb5951; }
.active\:bg-campus-alert-light:active   { background-color: #fba8a4; }
.active\:bg-campus-alert-dark:active    { background-color: #b53932; }

.active\:bg-campus-deep:active          { background-color: #534293; }
.active\:bg-campus-deep-light:active    { background-color: #897ac4; }
.active\:bg-campus-deep-dark:active     { background-color: #342266; }



        [x-cloak] { display: none; }
        .scrollbar::-webkit-scrollbar {
            width: 12px;
        }
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
                        <div x-show="openDropdown" @click.away="openDropdown = false" x-cloak class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg">
                            <a href="{{ route('profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>
            <div class="flex">
                <div class="bg-white fixed z-10 p-4 h-full overflow-scroll transition-transform duration-300"
                    :class="sidebarOpen ? 'w-64' : 'w-0'">

                    <nav :class="sidebarOpen ? 'grid' : 'hidden'" class="mt-[4rem] p-4">
                        @if(auth()->check() && auth()->user()->kd_otoritas == 1)
                        <div x-data="{ openAkademik: true }">
                            <button @click="openAkademik = !openAkademik" class="focus:outline-none w-full">
                                <span class="flex justify-between text-left text-gray-700 font-semibold mt-4 w-full">
                                    Data Akademik
                                    <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"></path>
                                    </svg>
                                </span>
                            </button>
                            <div x-show="openAkademik" x-cloak>
                                <x-responsive-nav-link :href="route('datafakultas')" :active="request()->routeIs('datafakultas')" wire:navigate>Data Fakultas</x-responsive-nav-link>
                                <x-responsive-nav-link :href="route('dataprodi')" :active="request()->routeIs('dataprodi')" wire:navigate>Data Program Studi</x-responsive-nav-link>
                                <x-responsive-nav-link :href="route('datamatkul')" :active="request()->routeIs('datamatkul')" wire:navigate>Data Mata Kuliah</x-responsive-nav-link>
                            </div>
                        </div>
                        @endif

                        @if(auth()->check() && auth()->user()->kd_otoritas == 1)
                        <div x-data="{ openCivitas: true }">
                            <button @click="openCivitas = !openCivitas" class="focus:outline-none w-full">
                                <span class="flex justify-between text-left text-gray-700 font-semibold mt-4 w-full">
                                    Data Civitas Akademika
                                    <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"></path>
                                    </svg>
                                </span>
                            </button>
                            <div x-show="openCivitas" x-cloak>
                                <x-responsive-nav-link :href="route('datamahasiswa')" :active="request()->routeIs('datamahasiswa')" wire:navigate>Data Mahasiswa</x-responsive-nav-link>
                                <x-responsive-nav-link :href="route('datadosen')" :active="request()->routeIs('datadosen')" wire:navigate>Data Dosen</x-responsive-nav-link>
                            </div>
                        </div>
                        @endif

                        <div x-data="{ openPerkuliahan: true }">
                            <button @click="openPerkuliahan = !openPerkuliahan" class="focus:outline-none w-full">
                                <span class="flex justify-between text-left text-gray-700 font-semibold mt-4 w-full">
                                    Manajemen Perkuliahan
                                    <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"></path>
                                    </svg>
                                </span>
                            </button>
                            <div x-show="openPerkuliahan" x-cloak>
                                <x-responsive-nav-link :href="route('dataperkuliahan')" :active="request()->routeIs('dataperkuliahan')" wire:navigate>Data Perkuliahan</x-responsive-nav-link>
                                <x-responsive-nav-link :href="route('reportabsensi')" :active="request()->routeIs('reportabsensi')" wire:navigate>Rekap Absensi Bulanan</x-responsive-nav-link>
                                @if(auth()->check() && auth()->user()->kd_otoritas == 1)
                                <x-responsive-nav-link :href="route('datasebaranmatkul')" :active="request()->routeIs('datasebaranmatkul')" wire:navigate>Data Distribusi Mata Kuliah</x-responsive-nav-link>
                                @endif
                            </div>
                        </div>

                        @if(auth()->check() && auth()->user()->kd_otoritas == 1)
                        <div x-data="{ openSetting: true }">
                            <button @click="openSetting = !openSetting" class="focus:outline-none w-full">
                                <span class="flex justify-between text-left text-gray-700 font-semibold mt-4 w-full">
                                    Settings
                                    <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"></path>
                                    </svg>
                                </span>
                            </button>
                            <div x-show="openSetting" x-cloak>
                                <x-responsive-nav-link :href="route('usercontroll')" :active="request()->routeIs('usercontroll')" wire:navigate>Data Pengguna</x-responsive-nav-link>
                            </div>
                        </div>
                        @endif
                    </nav>
                </div>
                <main :class="sidebarOpen ? 'ml-64' : 'ml-0'" class="mt-10 w-full p-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
    <script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('flashMessage', () => {
            setTimeout(() => {
                const flashMessage = document.getElementById('notifikasi');
                if (flashMessage) {
                    setTimeout(() => {
                        flashMessage.style.transition = 'opacity 1s ease-out';
                        flashMessage.style.opacity = 0;
                        setTimeout(() => {
                            flashMessage.style.display = 'none';
                        }, 1000);
                    }, 3000);
                }
            }, 500);
        });
    });
    </script>
    @endif

    <script>
    function closeModal() {
        const modal = document.getElementById('notifikasiModal');
        if (modal) {
            modal.style.display = 'none';
        }
    }
    setTimeout(() => {
        closeModal();
    }, 5000); // Hilang setelah 5 detik
    </script>

    @livewireScripts
</body>
</html>