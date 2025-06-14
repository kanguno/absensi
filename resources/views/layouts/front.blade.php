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
        
    <style>
/* === TEXT COLORS === */
.text-magenta    { color: #D83F87; }
.text-violet     { color: #2A1B3D; }
.text-indigo     { color: #44318D; }
.text-orange     { color: #E98907; }
.text-gray-soft  { color: #A4B3B6; }

/* === BACKGROUND COLORS === */
.bg-magenta      { background-color: #D83F87; }
.bg-violet       { background-color: #2A1B3D; }
.bg-indigo       { background-color: #44318D; }
.bg-orange       { background-color: #E98907; }
.bg-gray-soft    { background-color: #A4B3B6; }

/* === BORDER COLORS === */
.border-magenta   { border-color: #D83F87; }
.border-violet    { border-color: #2A1B3D; }
.border-indigo    { border-color: #44318D; }
.border-orange    { border-color: #E98907; }
.border-gray-soft { border-color: #A4B3B6; }

    </style>
    </head>
            <body class="font-sans antialiased">
                <div class="min-h-screen bg-white">
                
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
            @yield('content')
            </main>
        </div>
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
</script>
</html>
