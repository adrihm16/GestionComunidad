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
                <label class="block text-sm font-medium text-main mb-1.5">Nombre <span class="text-red-500">*</span></label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" required @class([
                    'w-full px-4 py-2.5 rounded-xl border text-sm text-main focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all duration-200',
                    'border-gray-200' => !$errors->has('nombre'),
                    'border-red-500' => $errors->has('nombre'),
                ])>
                @error('nombre')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Apellidos --}}
            <div>
                <label class="block text-sm font-medium text-main mb-1.5">Apellidos <span
                        class="text-red-500">*</span></label>
                <input type="text" name="apellidos" value="{{ old('apellidos') }}" required @class([
                    'w-full px-4 py-2.5 rounded-xl border text-sm text-main focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all duration-200',
                    'border-gray-200' => !$errors->has('apellidos'),
                    'border-red-500' => $errors->has('apellidos'),
                ])>
                @error('apellidos')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm font-medium text-main mb-1.5">Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" required @class([
                    'w-full px-4 py-2.5 rounded-xl border text-sm text-main focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all duration-200',
                    'border-gray-200' => !$errors->has('email'),
                    'border-red-500' => $errors->has('email'),
                ])>
                @error('email')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Teléfono --}}
            <div>
                <label class="block text-sm font-medium text-main mb-1.5">Teléfono</label>
                <input type="tel" name="telefono" value="{{ old('telefono') }}" placeholder="666555444" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                                          focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                                          transition-all duration-200 @error('telefono') border-red-500 @enderror">
                @error('telefono')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Rol Sistema --}}
            <div>
                <label class="block text-sm font-medium text-main mb-1.5">Rol en el sistema <span
                        class="text-red-500">*</span></label>
                <select name="rol_sistema" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
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
                <label class="block text-sm font-medium text-main mb-1.5">Cargo en la comunidad</label>
                <input type="text" name="cargo_comunidad" value="{{ old('cargo_comunidad') }}"
                    placeholder="Ej: Presidente, Secretario, Tesorero..." class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                                          focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                                          transition-all duration-200 @error('cargo_comunidad') border-red-500 @enderror">
                @error('cargo_comunidad')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- IBAN --}}
            <div>
                <label class="block text-sm font-medium text-main mb-1.5">IBAN de Usuario <span
                        class="text-xs text-muted font-normal">(Privado)</span></label>
                <input type="text" name="iban" value="{{ old('iban') }}" placeholder="ES00 0000 0000 0000 0000 0000"
                    maxlength="34" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                                          focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                                          transition-all duration-200 @error('iban') border-red-500 @enderror">
                <p class="text-[11px] text-muted mt-1">Este dato solo será visible para administradores y el vecino titular.
                </p>
                @error('iban')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-sm font-medium text-main mb-1.5">Contraseña <span
                        class="text-red-500">*</span></label>
                <input type="password" name="password" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                                          focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                                          transition-all duration-200 @error('password') border-red-500 @enderror">
                <p class="text-xs text-muted mt-1.5">Mínimo 8 caracteres</p>
                @error('password')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div>
                <label class="block text-sm font-medium text-main mb-1.5">Confirmar contraseña <span
                        class="text-red-500">*</span></label>
                <input type="password" name="password_confirmation" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                                          focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                                          transition-all duration-200">
            </div>

            {{-- Multiple Inmuebles Assignment (Mandatory) --}}
            <div x-data="{ 
                        inmuebles: [{ tipo: '', bloque: '', piso: '', puerta: '' }]
                    }" class="border-t border-gray-100 pt-6">

                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-sm font-semibold text-main">Asignar Inmuebles <span class="text-red-500">*</span></p>
                        <p class="text-xs text-muted">Añade al menos una propiedad para este vecino</p>
                    </div>
                    <button type="button" @click="inmuebles.push({ tipo: '', bloque: '', piso: '', puerta: '' })"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-600 text-xs font-semibold hover:bg-emerald-100 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Añadir otro
                    </button>
                </div>

                <div class="flex flex-col gap-4">
                    <template x-for="(inmueble, index) in inmuebles" :key="index">
                        <div class="flex flex-col gap-4 p-4 rounded-xl bg-gray-50 border border-gray-100 relative group">
                            {{-- Delete button (visible if more than 1) --}}
                            <button type="button" x-show="inmuebles.length > 1" @click="inmuebles.splice(index, 1)"
                                class="absolute -top-2 -right-2 w-8 h-8 flex items-center justify-center rounded-full bg-white border border-red-200 text-red-500 shadow-sm hover:bg-red-50 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                {{-- Tipo --}}
                                <div>
                                    <label class="block text-sm font-medium text-main mb-1.5">Tipo <span
                                            class="text-red-500">*</span></label>
                                    <select :name="'inmuebles['+index+'][tipo]'" x-model="inmueble.tipo" required
                                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                                        <option value="">Selecciona tipo</option>
                                        <option value="piso">Piso</option>
                                        <option value="local">Local</option>
                                        <option value="garaje">Garaje</option>
                                        <option value="trastero">Trastero</option>
                                    </select>
                                </div>

                                {{-- Bloque --}}
                                <div>
                                    <label class="block text-sm font-medium text-main mb-1.5">Bloque</label>
                                    <input type="text" :name="'inmuebles['+index+'][bloque]'" x-model="inmueble.bloque"
                                        placeholder="A, B, C..." maxlength="10"
                                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                                </div>

                                {{-- Dynamic fields based on type --}}
                                <div class="col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    {{-- Piso / Número --}}
                                    <div>
                                        <label class="block text-sm font-medium text-main mb-1.5">
                                            <span
                                                x-text="(inmueble.tipo === 'garaje' || inmueble.tipo === 'trastero') ? 'Número' : 'Piso'"></span>
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" :name="'inmuebles['+index+'][piso]'" x-model="inmueble.piso"
                                            :placeholder="(inmueble.tipo === 'garaje' || inmueble.tipo === 'trastero') ? 'G1, T1...' : '1, 2, B...'"
                                            required
                                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-primary/30 focus:border-primary transition-all">
                                    </div>

                                    {{-- Puerta (only for Piso/Local) --}}
                                    <div x-show="inmueble.tipo === 'piso' || inmueble.tipo === 'local'">
                                        <label class="block text-sm font-medium text-main mb-1.5">Puerta <span
                                                class="text-red-500">*</span></label>
                                        <input type="text" :name="'inmuebles['+index+'][puerta]'" x-model="inmueble.puerta"
                                            :required="inmueble.tipo === 'piso' || inmueble.tipo === 'local'"
                                            placeholder="A, B, 1, 2..."
                                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:ring-primary/30 focus:border-primary transition-all">
                                    </div>
                                    {{-- Hidden placeholder for puerta in garaje/trastero to satisfy DB --}}
                                    <input type="hidden" :name="'inmuebles['+index+'][puerta]'" value="-"
                                        x-show="inmueble.tipo === 'garaje' || inmueble.tipo === 'trastero' || inmueble.tipo === ''">
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Buttons --}}
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-medium text-muted
                                      hover:bg-gray-100 transition-colors duration-200">
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