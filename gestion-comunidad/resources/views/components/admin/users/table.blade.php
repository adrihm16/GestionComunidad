@props(['users'])

<div class="flex flex-col gap-4">
    @forelse ($users as $user)
        @component('components.ui.card', [
            'hover' => true,
            'bodyClass' => 'flex flex-col sm:flex-row sm:items-center justify-between px-4 py-4 gap-4 sm:gap-0',
        ])
            <div class="flex items-center gap-4 flex-1">
                {{-- Avatar --}}
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-primary/10 flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </div>

                {{-- User Info --}}
                <div class="flex-1 min-w-0">
                    <p class="font-poppins font-semibold text-base text-main truncate">
                        {{ $user->nombre }} {{ $user->apellidos }}
                    </p>
                    <p class="text-sm text-muted truncate">{{ $user->email }}</p>
                    @if($user->telefono)
                        <p class="text-xs text-muted mt-0.5">{{ $user->telefono }}</p>
                    @endif
                </div>

                {{-- Role Badge --}}
                <div class="flex items-center gap-2">
                    @php
                        $rolBadge = match($user->rol_sistema) {
                            'admin' => 'bg-purple-100 text-purple-700',
                            'vecino' => 'bg-blue-100 text-blue-700',
                            default => 'bg-gray-100 text-gray-600',
                        };
                    @endphp
                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-semibold {{ $rolBadge }}">
                        {{ ucfirst($user->rol_sistema) }}
                    </span>

                    @if($user->cargo_comunidad)
                        <span class="hidden sm:inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium bg-amber-100 text-amber-700">
                            {{ $user->cargo_comunidad }}
                        </span>
                    @endif
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-2 w-full sm:w-auto sm:ml-4 border-t sm:border-t-0 border-gray-100 pt-3 sm:pt-0">
                <a href="{{ route('admin.users.edit', $user) }}" 
                   class="p-2 rounded-lg hover:bg-primary/5 transition-colors duration-200"
                   title="Editar usuario">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                </a>

                @if($user->id !== auth()->id())
                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" 
                          onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')"
                          class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="p-2 rounded-lg hover:bg-red-50 transition-colors duration-200"
                                title="Eliminar usuario">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </form>
                @endif
            </div>
        @endcomponent
    @empty
        {{-- Empty state --}}
        <div class="flex flex-col items-center justify-center py-16 text-center">
            <div class="flex items-center justify-center w-16 h-16 rounded-full bg-primary/5 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-primary/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
            </div>
            <p class="font-medium text-sm text-muted">No se encontraron usuarios</p>
            @if(request('search') || request('rol'))
                <p class="text-xs text-muted mt-1">Prueba con otros filtros</p>
            @endif
        </div>
    @endforelse
</div>

{{-- Pagination --}}
@if($users->hasPages())
    <div class="mt-2">
        {{ $users->withQueryString()->links() }}
    </div>
@endif
