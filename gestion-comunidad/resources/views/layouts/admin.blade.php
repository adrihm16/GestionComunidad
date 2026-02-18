<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Gestión de Comunidad - Panel de administración">
    <title>@yield('title', 'Gestión Comunidad - Admin')</title>

    {{-- Google Fonts: Poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Base styles fallback --}}
    <style>
        body { background-color: #F5F7FA; font-family: 'Poppins', sans-serif; color: #1A1A1A; }
    </style>

    {{-- Tailwind via CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        primary: '#1E4A26',
                        accent: '#26FF05',
                        'accent-lime': '#A3FF05',
                        page: '#F5F7FA',
                        card: '#FFFFFF',
                        main: '#1A1A1A',
                        muted: '#6B7280',
                    },
                },
            },
        }
    </script>
</head>
<body class="bg-page font-poppins text-main min-h-screen flex flex-col" x-data="{ sidebarOpen: true }">

    {{-- Header --}}
    @include('components.header.header')

    <div class="flex flex-1 max-w-screen-2xl mx-auto w-full relative pt-4">
        
        {{-- Sidebar --}}
        @include('components.admin.sidebar')

        {{-- Main Content --}}
        <main class="flex-1 px-5 py-6 w-full overflow-x-hidden transition-all duration-300 ease-in-out"
              :class="sidebarOpen ? 'md:ml-64' : ''">
            
            {{-- Toggle Button (Visible when sidebar is closed) --}}
            <button x-show="!sidebarOpen"
                    @click="sidebarOpen = true"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-x-4"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    class="fixed left-4 top-[90px] z-40 p-3 bg-primary text-white rounded-full shadow-lg hover:scale-110 transition-transform flex"
                    title="Abrir menú">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            @yield('content')
        </main>
    </div>

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>
</html>
