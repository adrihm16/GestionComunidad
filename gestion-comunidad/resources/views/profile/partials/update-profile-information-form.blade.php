@component('components.ui.card', ['hover' => false])
<form method="POST" action="{{ route('profile.update') }}" class="flex flex-col gap-4">
    @csrf
    @method('PATCH')

    {{-- Nombre --}}
    <div>
        <label class="block text-sm font-medium text-main mb-1.5">Nombre</label>
        <input type="text" name="nombre" value="{{ old('nombre', auth()->user()->nombre) }}" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                          focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                          transition-all duration-200">
        @error('nombre')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Apellidos --}}
    <div>
        <label class="block text-sm font-medium text-main mb-1.5">Apellidos</label>
        <input type="text" name="apellidos" value="{{ old('apellidos', auth()->user()->apellidos) }}" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                          focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                          transition-all duration-200">
        @error('apellidos')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Email --}}
    <div>
        <label class="block text-sm font-medium text-main mb-1.5">Email</label>
        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                          focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                          transition-all duration-200">
        @error('email')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Teléfono --}}
    <div>
        <label class="block text-sm font-medium text-main mb-1.5">Teléfono</label>
        <input type="tel" name="telefono" value="{{ old('telefono', auth()->user()->telefono) }}" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                          focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                          transition-all duration-200">
        @error('telefono')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- IBAN --}}
    <div>
        <label class="block text-sm font-medium text-main mb-1.5">IBAN <span
                class="text-xs text-muted font-normal">(Privado)</span></label>
        <input type="text" name="iban" value="{{ old('iban', auth()->user()->iban) }}"
            placeholder="ES00 0000 0000 0000 0000 0000" maxlength="34" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                          focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                          transition-all duration-200">
        <p class="text-[11px] text-muted mt-1">Este dato solo es visible para ti y los administradores.</p>
        @error('iban')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Información de solo lectura --}}
    <div class="grid grid-cols-2 gap-3 pt-2 border-t border-gray-100">
        <div>
            <p class="text-xs font-medium text-muted mb-1">Rol en el sistema</p>
            @php
                $rolBadge = match (auth()->user()->rol_sistema) {
                    'admin' => 'bg-purple-100 text-purple-700',
                    'vecino' => 'bg-blue-100 text-blue-700',
                    default => 'bg-gray-100 text-gray-600',
                };
            @endphp
            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium {{ $rolBadge }}">
                {{ ucfirst(auth()->user()->rol_sistema) }}
            </span>
        </div>

        @if(auth()->user()->cargo_comunidad)
            <div>
                <p class="text-xs font-medium text-muted mb-1">Cargo comunidad</p>
                <p class="text-sm text-main font-medium">{{ auth()->user()->cargo_comunidad }}</p>
            </div>
        @endif
    </div>

    {{-- Botones de acción --}}
    <div class="flex items-center justify-between pt-2">
        @if (session('status') === 'profile-updated')
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                class="flex items-center gap-2 text-sm text-emerald-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-medium">Guardado correctamente</span>
            </div>
        @else
            <div></div>
        @endif

        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl 
                           bg-primary text-white text-sm font-medium shadow-md
                           transition-all duration-200 hover:scale-105 active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
            Guardar cambios
        </button>
    </div>
</form>
@endcomponent