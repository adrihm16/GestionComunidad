@props(['user' => null, 'action', 'method' => 'POST'])

@component('components.ui.card', ['hover' => false])
    <form method="POST" action="{{ $action }}" class="flex flex-col gap-4">
        @csrf
        @if($method !== 'POST')
            @method($method)
        @endif

        {{-- User Info Badge (Edit Mode only) --}}
        @if($user)
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
        @endif

        {{-- Nombre --}}
        <div>
            <label class="block text-sm font-medium text-main mb-1.5">Nombre <span class="text-red-500">*</span></label>
            <input type="text" 
                   name="nombre"
                   value="{{ old('nombre', $user?->nombre) }}"
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
                   value="{{ old('apellidos', $user?->apellidos) }}"
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
                   value="{{ old('email', $user?->email) }}"
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
                   value="{{ old('telefono', $user?->telefono) }}"
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
                <option value="">Selecciona un rol</option>
                <option value="vecino" {{ old('rol_sistema', $user?->rol_sistema) === 'vecino' ? 'selected' : '' }}>Vecino</option>
                <option value="admin" {{ old('rol_sistema', $user?->rol_sistema) === 'admin' ? 'selected' : '' }}>Admin</option>
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
                   value="{{ old('cargo_comunidad', $user?->cargo_comunidad) }}"
                   placeholder="Ej: Presidente, Secretario, Tesorero..."
                   class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                          focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                          transition-all duration-200 @error('cargo_comunidad') border-red-500 @enderror">
            @error('cargo_comunidad')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Separator for Password --}}
        @if($user)
            <div class="border-t border-gray-100 pt-4">
                <p class="text-sm font-semibold text-main mb-1">Cambiar contraseña (opcional)</p>
                <p class="text-xs text-muted">Deja estos campos vacíos si no deseas cambiar la contraseña</p>
            </div>
        @endif

        {{-- Password --}}
        <div>
            <label class="block text-sm font-medium text-main mb-1.5">
                {{ $user ? 'Nueva contraseña' : 'Contraseña' }} 
                @if(!$user) <span class="text-red-500">*</span> @endif
            </label>
            <input type="password" 
                   name="password"
                   @if(!$user) required @endif
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
            <label class="block text-sm font-medium text-main mb-1.5">
                {{ $user ? 'Confirmar nueva contraseña' : 'Confirmar contraseña' }}
                @if(!$user) <span class="text-red-500">*</span> @endif
            </label>
            <input type="password" 
                   name="password_confirmation"
                   @if(!$user) required @endif
                   class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                          focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                          transition-all duration-200">
        </div>

        {{-- Buttons --}}
        <div class="flex flex-col-reverse sm:flex-row sm:items-center justify-between pt-4 border-t border-gray-100 gap-4 sm:gap-0">
            {{-- Delete Button (Edit Mode only & not self) --}}
            @if($user && $user->id !== auth()->id())
                {{-- Note: The delete form needs to be OUTSIDE the main form. 
                     We can't nest forms. 
                     So we'll use a slot or just handle it in the parent view for the delete button specifically?
                     Or we can just put a button here that submits a separate form via JS or uses a named form attribute (HTML5).
                     
                     For simplicity/cleanliness, let's pass a 'deleteUrl' prop. If present, show delete button.
                     Wait, we can't easily nest the delete FORM inside this FORM.
                     
                     Solution: Place the delete button here but make it trigger a form that must be provided via specific slot or placed outside?
                     Actually, standard practice: Put the Delete button/form outside the main form in the parent view?
                     
                     Let's verify how it was done. It was inside the flex container.
                     HTML5 `form` attribute allows button outside form, but simple nesting is forbidden.
                     
                     I'll let the parent view handle the "Delete" button via a slot named 'actions_left',
                     or I'll just skip the delete button here and let the parent render it if needed?
                     
                     Let's use a slot `actions_left` for the delete button.
                --}}
                <div class="w-full sm:w-auto">
                    {{ $actions_left ?? '' }}
                </div>
            @else
                <div class="w-full sm:w-auto"></div>
            @endif

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full sm:w-auto">
                <a href="{{ route('admin.users.index') }}" 
                   class="px-5 py-2.5 rounded-xl text-sm font-medium text-muted text-center
                          hover:bg-gray-100 transition-colors duration-200">
                    Cancelar
                </a>

                <button type="submit" 
                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl 
                               bg-primary text-white text-sm font-medium shadow-md
                               transition-all duration-200 hover:scale-105 active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        @if($user)
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        @else
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        @endif
                    </svg>
                    {{ $user ? 'Guardar Cambios' : 'Crear Usuario' }}
                </button>
            </div>
        </div>
    </form>
@endcomponent
