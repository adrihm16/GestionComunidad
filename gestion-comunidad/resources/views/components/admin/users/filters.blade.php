@component('components.ui.card', ['hover' => false, 'bodyClass' => 'p-4'])
    <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col md:flex-row gap-3">
        {{-- Search input --}}
        <div class="flex-1">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}"
                   placeholder="Buscar por nombre, apellidos o email..."
                   class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                          focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                          transition-all duration-200">
        </div>

        {{-- Role filter --}}
        <div>
            <select name="rol" 
                    class="w-full md:w-40 px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                           focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                           transition-all duration-200">
                <option value="">Todos los roles</option>
                <option value="admin" {{ request('rol') === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="vecino" {{ request('rol') === 'vecino' ? 'selected' : '' }}>Vecino</option>
            </select>
        </div>

        {{-- Submit button --}}
        <button type="submit" 
                class="px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-medium shadow-md
                       transition-all duration-200 hover:scale-105 active:scale-95">
            Filtrar
        </button>

        {{-- Clear filters --}}
        @if(request('search') || request('rol'))
            <a href="{{ route('admin.users.index') }}" 
               class="px-4 py-2.5 rounded-xl bg-gray-100 text-main text-sm font-medium
                      transition-all duration-200 hover:bg-gray-200">
                Limpiar
            </a>
        @endif
    </form>
@endcomponent
