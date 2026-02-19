@extends('layouts.admin')

@section('title', 'Gestión de Incidencias - Panel Admin')

@section('content')
    <div class="flex flex-col gap-5">

        {{-- Header Section --}}
        <div class="flex items-center justify-between">
            @include('components.ui.section-title', ['title' => 'Gestión de Incidencias', 'titleClass' => 'text-xl mb-0'])
        </div>

        {{-- Success/Error Messages --}}
        @if(session('success'))
            <div class="flex items-center gap-3 p-4 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Incidencias List --}}
        <div class="flex flex-col gap-4">
            @forelse ($incidencias as $incidencia)
                @component('components.ui.card', [
                    'hover' => true,
                    'bodyClass' => 'flex flex-col sm:flex-row sm:items-center justify-between px-4 py-4 gap-4 sm:gap-0',
                ])
                <div class="flex items-center gap-4 flex-1">
                    {{-- Status Indicator --}}
                    @php
                        $estadoColor = match ($incidencia->estado) {
                            'pendiente' => 'bg-amber-500',
                            'en_proceso' => 'bg-blue-500',
                            'resuelta' => 'bg-emerald-500',
                            'rechazada' => 'bg-red-500',
                            default => 'bg-gray-400',
                        };
                    @endphp
                    <div class="flex-shrink-0 w-3 h-3 rounded-full {{ $estadoColor }}"
                        title="{{ ucfirst($incidencia->estado) }}"></div>

                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <p class="font-poppins font-semibold text-base text-main dark:text-gray-100 truncate">
                            {{ $incidencia->titulo }}
                        </p>
                        <div class="flex items-center gap-2 mt-0.5">
                            <span class="text-xs text-muted dark:text-gray-400">
                                Reportada por {{ $incidencia->creador->nombre }} {{ $incidencia->creador->apellidos }}
                            </span>
                            <span
                                class="text-xs text-muted dark:text-emerald-500/60 px-1.5 py-0.5 bg-gray-100 dark:bg-emerald-900/30 rounded-md">
                                {{ ucfirst($incidencia->prioridad) }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div
                    class="flex items-center justify-end gap-2 w-full sm:w-auto sm:ml-4 border-t sm:border-t-0 border-gray-100 dark:border-emerald-900/40 pt-3 sm:pt-0">
                    <a href="{{ route('incidencias.show', $incidencia) }}"
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-primary/10 dark:bg-primary/20 text-primary dark:text-accent text-xs font-semibold transition-colors hover:bg-primary hover:text-white"
                        title="Ver y Gestionar">
                        Ver Detalles
                    </a>

                    <form method="POST" action="{{ route('admin.incidencias.destroy', $incidencia) }}"
                        onsubmit="return confirm('¿Estás seguro de eliminar esta incidencia?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 rounded-lg hover:bg-red-50 transition-colors duration-200 text-red-600"
                            title="Eliminar incidencia">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </form>
                </div>
                @endcomponent
            @empty
                <div class="flex flex-col items-center justify-center py-16 text-center">
                    <div
                        class="flex items-center justify-center w-16 h-16 rounded-full bg-primary/5 dark:bg-emerald-950/30 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-primary/40" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <p class="font-medium text-sm text-muted dark:text-gray-400">No hay incidencias reportadas</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($incidencias->hasPages())
            <div class="mt-2">
                {{ $incidencias->links() }}
            </div>
        @endif

    </div>
@endsection