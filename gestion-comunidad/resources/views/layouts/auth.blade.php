<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Gestión Comunidad')</title>

    {{-- Google Fonts: Poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

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
<body class="bg-page font-poppins text-main min-h-screen flex items-center justify-center px-5 py-10">

    <div class="w-full max-w-sm">
        @yield('content')
    </div>

    @yield('scripts')

</body>
</html>
