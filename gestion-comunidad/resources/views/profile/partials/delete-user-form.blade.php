@component('components.ui.card', ['hover' => false])
    <div class="flex flex-col gap-4">
        
        {{-- Advertencia --}}
        <div class="flex gap-3 p-3 rounded-lg bg-red-50 border border-red-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
            </svg>
            <div>
                <h3 class="text-sm font-semibold text-red-900 mb-1">Acción permanente e irreversible</h3>
                <p class="text-sm text-red-700">
                    Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán borrados permanentemente. 
                    Antes de eliminar tu cuenta, descarga cualquier información que desees conservar.
                </p>
            </div>
        </div>

        {{-- Botón de eliminación --}}
        <div class="flex justify-end">
            <button type="button"
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl 
                           bg-red-600 text-white text-sm font-medium shadow-md
                           transition-all duration-200 hover:scale-105 active:scale-95 hover:bg-red-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
                Eliminar cuenta
            </button>
        </div>
    </div>
@endcomponent

{{-- Modal de confirmación --}}
<x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="POST" action="{{ route('profile.destroy') }}" class="p-6">
        @csrf
        @method('DELETE')

        <div class="flex items-start gap-3 mb-4">
            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-main">
                    ¿Estás seguro de eliminar tu cuenta?
                </h2>
                <p class="mt-1 text-sm text-muted">
                    Esta acción no se puede deshacer. Todos tus datos serán eliminados permanentemente.
                </p>
            </div>
        </div>

        {{-- Input de contraseña --}}
        <div class="mb-6">
            <label class="block text-sm font-medium text-main mb-1.5">Confirma tu contraseña</label>
            <input type="password" 
                   name="password"
                   required
                   placeholder="Escribe tu contraseña"
                   class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                          focus:outline-none focus:ring-2 focus:ring-red-500/30 focus:border-red-500
                          transition-all duration-200">
            @error('password', 'userDeletion')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Botones --}}
        <div class="flex items-center justify-end gap-3">
            <button type="button"
                    x-on:click="$dispatch('close')"
                    class="px-4 py-2 rounded-xl text-sm font-medium text-muted
                           hover:bg-gray-100 transition-colors duration-200">
                Cancelar
            </button>

            <button type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl 
                           bg-red-600 text-white text-sm font-medium shadow-md
                           transition-all duration-200 hover:scale-105 active:scale-95 hover:bg-red-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
                Sí, eliminar mi cuenta
            </button>
        </div>
    </form>
</x-modal>
