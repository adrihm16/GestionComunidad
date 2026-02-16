@extends('layouts.auth')

@section('title', 'Iniciar Sesión - Gestión Comunidad')

@section('content')

    {{-- Logo / App name --}}
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-primary mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
        </div>
        <h1 class="font-poppins font-semibold text-xl text-main">Gestión Comunidad</h1>
    </div>

    {{-- Login Card (GreenHeaderCard pattern) --}}
    <div class="flex flex-col rounded-2xl shadow-lg overflow-hidden bg-white w-full">
        {{-- Green Header Strip --}}
        <div class="bg-primary px-6 py-4">
            <h2 class="font-poppins font-semibold text-lg text-white">Iniciar Sesión</h2>
            <p class="font-poppins text-sm text-white/70 mt-0.5">Accede a tu comunidad</p>
        </div>

        {{-- Form Body --}}
        <div class="p-6">

            {{-- Session Status --}}
            @if (session('status'))
                <div class="mb-4 text-sm text-green-600 bg-green-50 rounded-xl px-4 py-3">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="block font-poppins font-medium text-sm text-main mb-1.5">
                        Correo electrónico
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="tu@email.com"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white
                               font-poppins text-sm text-main placeholder-muted
                               outline-none transition-all duration-200
                               focus:border-[#26FF05] focus:ring-2 focus:ring-[#26FF05]/20"
                    >
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-4">
                    <label for="password" class="block font-poppins font-medium text-sm text-main mb-1.5">
                        Contraseña
                    </label>
                    <div class="relative">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full px-4 py-3 pr-12 rounded-xl border border-gray-200 bg-white
                                   font-poppins text-sm text-main placeholder-muted
                                   outline-none transition-all duration-200
                                   focus:border-[#26FF05] focus:ring-2 focus:ring-[#26FF05]/20"
                        >
                        <button type="button" id="toggle-password"
                                class="absolute right-3 top-1/2 -translate-y-1/2 p-1 text-muted hover:text-main transition-colors"
                                aria-label="Mostrar contraseña">
                            {{-- Eye icon (show) --}}
                            <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{-- Eye-off icon (hide) --}}
                            <svg id="eye-closed" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12c1.292 4.338 5.31 7.5 10.066 7.5.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center justify-between mb-6">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input
                            id="remember_me"
                            type="checkbox"
                            name="remember"
                            class="w-4 h-4 rounded border-gray-300 text-primary
                                   focus:ring-[#26FF05]/30 focus:ring-2 transition-colors"
                        >
                        <span class="ms-2 font-poppins text-sm text-muted">Recuérdame</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="font-poppins text-sm text-primary hover:text-accent transition-colors">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>

                {{-- Submit Button --}}
                <button
                    type="submit"
                    class="w-full py-3 px-4 rounded-xl bg-primary text-white
                           font-poppins font-semibold text-sm
                           shadow-md hover:opacity-90 active:scale-[0.98]
                           transition-all duration-200"
                >
                    Iniciar Sesión
                </button>
            </form>

        </div>
    </div>

@endsection

@section('scripts')
<script>
    document.getElementById('toggle-password').addEventListener('click', function () {
        const input = document.getElementById('password');
        const eyeOpen = document.getElementById('eye-open');
        const eyeClosed = document.getElementById('eye-closed');

        if (input.type === 'password') {
            input.type = 'text';
            eyeOpen.classList.add('hidden');
            eyeClosed.classList.remove('hidden');
        } else {
            input.type = 'password';
            eyeOpen.classList.remove('hidden');
            eyeClosed.classList.add('hidden');
        }
    });
</script>
@endsection
