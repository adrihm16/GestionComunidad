<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Gestión de Comunidad - Panel de administración">
    <title>@yield('title', 'Gestión Comunidad')</title>

    {{-- Google Fonts: Poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Base styles fallback (prevents white flash while Tailwind CDN loads) --}}
    <style>
        body {
            background-color: #F5F7FA;
            font-family: 'Poppins', sans-serif;
            color: #1A1A1A;
        }
    </style>

    {{-- Tailwind via CDN (dev fallback) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
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

        // Initialize dark mode before Alpine starts (flicker prevention)
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        // Global Theme Store
        document.addEventListener('alpine:init', () => {
            Alpine.store('theme', {
                darkMode: document.documentElement.classList.contains('dark'),
                toggle() {
                    this.darkMode = !this.darkMode;
                    if (this.darkMode) {
                        document.documentElement.classList.add('dark');
                        localStorage.theme = 'dark';
                    } else {
                        document.documentElement.classList.remove('dark');
                        localStorage.theme = 'light';
                    }
                }
            })
        })
    </script>
</head>

<body class="bg-page dark:bg-[#071309] font-poppins text-main dark:text-gray-100 min-h-screen flex flex-col" x-data="{}"
    x-cloak>

    {{-- Header --}}
    @include('components.header.header')

    {{-- Main Content (pb-28 prevents content from hiding behind the fixed bottom nav) --}}
    <main class="flex-1 px-5 py-6 pb-20 max-w-screen-xl mx-auto w-full">
        @yield('content')
    </main>

    {{-- Bottom Navigation --}}
    @include('components.bottom-nav.bottom-nav')

    {{-- Alpine.js for interactive components --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>

</html>