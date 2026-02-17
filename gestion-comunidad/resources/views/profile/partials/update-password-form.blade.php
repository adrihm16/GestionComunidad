@component('components.ui.card', ['hover' => false])
    <form method="POST" action="{{ route('password.update') }}" class="flex flex-col gap-4">
        @csrf
        @method('PUT')

        <p class="text-sm text-muted mb-2">
            Asegúrate de usar una contraseña larga y aleatoria para mantener tu cuenta segura.
        </p>

        {{-- Contraseña actual --}}
        <div>
            <label class="block text-sm font-medium text-main mb-1.5">Contraseña actual</label>
            <input type="password" 
                   name="current_password"
                   required
                   autocomplete="current-password"
                   class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                          focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                          transition-all duration-200">
            @error('current_password', 'updatePassword')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Nueva contraseña --}}
        <div>
            <label class="block text-sm font-medium text-main mb-1.5">Nueva contraseña</label>
            <input type="password" 
                   name="password"
                   required
                   autocomplete="new-password"
                   class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                          focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                          transition-all duration-200">
            @error('password', 'updatePassword')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
            <p class="text-xs text-muted mt-1.5">Mínimo 8 caracteres</p>
        </div>

        {{-- Confirmar contraseña --}}
        <div>
            <label class="block text-sm font-medium text-main mb-1.5">Confirmar contraseña</label>
            <input type="password" 
                   name="password_confirmation"
                   required
                   autocomplete="new-password"
                   class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                          focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                          transition-all duration-200">
            @error('password_confirmation', 'updatePassword')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Botones de acción --}}
        <div class="flex items-center justify-between pt-2">
            @if (session('status') === 'password-updated')
                <div x-data="{ show: true }" 
                     x-show="show" 
                     x-init="setTimeout(() => show = false, 3000)"
                     class="flex items-center gap-2 text-sm text-emerald-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-medium">Contraseña actualizada</span>
                </div>
            @else
                <div></div>
            @endif

            <button type="submit" 
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl 
                           bg-primary text-white text-sm font-medium shadow-md
                           transition-all duration-200 hover:scale-105 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>
                Actualizar contraseña
            </button>
        </div>
    </form>
@endcomponent
