@extends('layouts.admin')

@section('title', 'Crear Usuario - Panel Admin')

@section('content')
    <div class="flex flex-col gap-5 max-w-2xl mx-auto">

        {{-- Header --}}
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.users.index') }}"
                class="p-2 rounded-lg hover:bg-primary/5 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            @include('components.ui.section-title', ['title' => 'Crear Nuevo Usuario', 'titleClass' => 'text-xl mb-0'])
        </div>

        {{-- Form Card --}}
        @component('components.ui.card', ['hover' => false])
        <form method="POST" action="{{ route('admin.users.store') }}" class="flex flex-col gap-4">
            @csrf

            {{-- Nombre --}}
            <div>
                <label class="block text-sm font-medium text-main dark:text-gray-300 mb-1.5">Nombre <span
                        class="text-red-500">*</span></label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-main dark:text-gray-100
                                   focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                                   transition-all duration-200 @error('nombre') border-red-500 @enderror">
                @error('nombre')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Apellidos --}}
            <div>
                <label class="block text-sm font-medium text-main dark:text-gray-300 mb-1.5">Apellidos <span
                        class="text-red-500">*</span></label>
                <input type="text" name="apellidos" value="{{ old('apellidos') }}" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-main dark:text-gray-100
                                   focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                                   transition-all duration-200 @error('apellidos') border-red-500 @enderror">
                @error('apellidos')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm font-medium text-main dark:text-gray-300 mb-1.5">Email <span
                        class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-main dark:text-gray-100
                                   focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                                   transition-all duration-200 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Teléfono --}}
            <div>
                <label class="block text-sm font-medium text-main dark:text-gray-300 mb-1.5">Teléfono</label>
                <input type="tel" name="telefono" value="{{ old('telefono') }}" placeholder="666555444" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-main dark:text-gray-100
                                   focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                                   transition-all duration-200 @error('telefono') border-red-500 @enderror">
                @error('telefono')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Rol Sistema --}}
            <div>
                <label class="block text-sm font-medium text-main dark:text-gray-300 mb-1.5">Rol en el sistema <span
                        class="text-red-500">*</span></label>
                <select name="rol_sistema" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-main dark:text-gray-100
                                    focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                                    transition-all duration-200 @error('rol_sistema') border-red-500 @enderror">
                    <option value="">Selecciona un rol</option>
                    <option value="vecino" {{ old('rol_sistema') === 'vecino' ? 'selected' : '' }}>Vecino</option>
                    <option value="admin" {{ old('rol_sistema') === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('rol_sistema')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Cargo Comunidad --}}
            <div>
                <label class="block text-sm font-medium text-main dark:text-gray-300 mb-1.5">Cargo en la comunidad</label>
                <input type="text" name="cargo_comunidad" value="{{ old('cargo_comunidad') }}"
                    placeholder="Ej: Presidente, Secretario, Tesorero..." class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-main dark:text-gray-100
                                   focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                                   transition-all duration-200 @error('cargo_comunidad') border-red-500 @enderror">
                @error('cargo_comunidad')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-sm font-medium text-main dark:text-gray-300 mb-1.5">Contraseña <span
                        class="text-red-500">*</span></label>
                <input type="password" name="password" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-main dark:text-gray-100
                                   focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                                   transition-all duration-200 @error('password') border-red-500 @enderror">
                <p class="text-xs text-muted dark:text-gray-400 mt-1.5">Mínimo 8 caracteres</p>
                @error('password')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div>
                <label class="block text-sm font-medium text-main dark:text-gray-300 mb-1.5">Confirmar contraseña <span
                        class="text-red-500">*</span></label>
                <input type="password" name="password_confirmation" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-sm text-main dark:text-gray-100
                                   focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                                   transition-all duration-200">
            </div>

            {{-- Buttons --}}
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
                <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-medium text-muted dark:text-gray-300
                              hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200">
                    Cancelar
                </a>

                <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl 
                                           bg-primary text-white text-sm font-medium shadow-md
                                           transition-all duration-200 hover:scale-105 active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Crear Usuario
                </button>
            </div>
        </form>
        @endcomponent

    </div>
@endsection