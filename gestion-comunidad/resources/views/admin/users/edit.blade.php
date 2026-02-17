@extends('layouts.app')

@section('title', 'Editar Usuario - Panel Admin')

@section('content')
<div class="flex flex-col gap-5 max-w-2xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.users.index') }}" 
           class="p-2 rounded-lg hover:bg-primary/5 transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
        </a>
        @include('components.ui.section-title', ['title' => 'Editar Usuario', 'titleClass' => 'text-xl mb-0'])
    </div>

    {{-- Form Card --}}
    @component('components.ui.card', ['hover' => false])
        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="flex flex-col gap-4">
            @csrf
            @method('PUT')

            {{-- User Info Badge --}}
            <div class="flex items-center gap-3 p-3 rounded-lg bg-blue-50 border border-blue-100">
                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-blue-900">{{ $user->nombre }} {{ $user->apellidos }}</p>
                    <p class="text-xs text-blue-700">{{ $user->email }}</p>
                </div>
            </div>

            {{-- Nombre --}}
            <div>
                <label class="block text-sm font-medium text-main mb-1.5">Nombre <span class="text-red-500">*</span></label>
                <input type="text" 
                       name="nombre"
                       value="{{ old('nombre', $user->nombre) }}"
                       required
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                              focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                              transition-all duration-200 @error('nombre') border-red-500 @enderror">
                @error('nombre')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Apellidos --}}
            <div>
                <label class="block text-sm font-medium text-main mb-1.5">Apellidos <span class="text-red-500">*</span></label>
                <input type="text" 
                       name="apellidos"
                       value="{{ old('apellidos', $user->apellidos) }}"
                       required
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                              focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                              transition-all duration-200 @error('apellidos') border-red-500 @enderror">
                @error('apellidos')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm font-medium text-main mb-1.5">Email <span class="text-red-500">*</span></label>
                <input type="email" 
                       name="email"
                       value="{{ old('email', $user->email) }}"
                       required
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                              focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                              transition-all duration-200 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Teléfono --}}
            <div>
                <label class="block text-sm font-medium text-main mb-1.5">Teléfono</label>
                <input type="tel" 
                       name="telefono"
                       value="{{ old('telefono', $user->telefono) }}"
                       placeholder="666555444"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                              focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                              transition-all duration-200 @error('telefono') border-red-500 @enderror">
                @error('telefono')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Rol Sistema --}}
            <div>
                <label class="block text-sm font-medium text-main mb-1.5">Rol en el sistema <span class="text-red-500">*</span></label>
                <select name="rol_sistema" 
                        required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                               focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                               transition-all duration-200 @error('rol_sistema') border-red-500 @enderror">
                    <option value="vecino" {{ old('rol_sistema', $user->rol_sistema) === 'vecino' ? 'selected' : '' }}>Vecino</option>
                    <option value="admin" {{ old('rol_sistema', $user->rol_sistema) === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('rol_sistema')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Cargo Comunidad --}}
            <div>
                <label class="block text-sm font-medium text-main mb-1.5">Cargo en la comunidad</label>
                <input type="text" 
                       name="cargo_comunidad"
                       value="{{ old('cargo_comunidad', $user->cargo_comunidad) }}"
                       placeholder="Ej: Presidente, Secretario, Tesorero..."
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                              focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                              transition-all duration-200 @error('cargo_comunidad') border-red-500 @enderror">
                @error('cargo_comunidad')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Separator --}}
            <div class="border-t border-gray-100 pt-4">
                <p class="text-sm font-semibold text-main mb-1">Cambiar contraseña (opcional)</p>
                <p class="text-xs text-muted">Deja estos campos vacíos si no deseas cambiar la contraseña</p>
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-sm font-medium text-main mb-1.5">Nueva contraseña</label>
                <input type="password" 
                       name="password"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                              focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                              transition-all duration-200 @error('password') border-red-500 @enderror">
                <p class="text-xs text-muted mt-1.5">Mínimo 8 caracteres</p>
                @error('password')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div>
                <label class="block text-sm font-medium text-main mb-1.5">Confirmar nueva contraseña</label>
                <input type="password" 
                       name="password_confirmation"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                              focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                              transition-all duration-200">
            </div>

            {{-- Buttons --}}
            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                {{-- Delete Button (if not current user) --}}
                @if($user->id !== auth()->id())
                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" 
                          onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')"
                          class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl 
                                       bg-red-600 text-white text-sm font-medium shadow-md
                                       transition-all duration-200 hover:scale-105 active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                            Eliminar
                        </button>
                    </form>
                @else
                    <div></div>
                @endif

                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.users.index') }}" 
                       class="px-5 py-2.5 rounded-xl text-sm font-medium text-muted
                              hover:bg-gray-100 transition-colors duration-200">
                        Cancelar
                    </a>

                    <button type="submit" 
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl 
                                   bg-primary text-white text-sm font-medium shadow-md
                                   transition-all duration-200 hover:scale-105 active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Guardar Cambios
                    </button>
                </div>
            </div>
        </form>
    @endcomponent

</div>
@endsection
