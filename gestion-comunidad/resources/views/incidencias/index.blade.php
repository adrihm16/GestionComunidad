@extends('layouts.app')

@section('title', 'Incidencias - Gestión Comunidad')

@section('content')
<div class="flex flex-col gap-5">

    {{-- Page Title + Create Button --}}
    <div class="flex items-center justify-between">
        @include('components.ui.section-title', ['title' => 'Incidencias', 'titleClass' => 'text-xl'])

        <a href="{{ route('incidencias.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-primary text-white text-sm font-medium
                  shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-md hover:shadow-primary/20 active:scale-95 shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Reportar
        </a>
    </div>

    {{-- Incidencias List --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="incidencias-list">

        @forelse ($incidencias as $incidencia)
            <a href="{{ route('incidencias.show', $incidencia) }}" class="block h-full">
                @component('components.ui.card', [
                    'hover' => true,
                    'bodyClass' => 'p-0',
                    'cardClass' => 'h-full',
                ])
                    <div class="flex flex-col h-full">
                        {{-- Image area (fixed height) --}}
                        <div class="w-full h-44 overflow-hidden bg-primary/5">
                            @if($incidencia->foto_url)
                                <img
                                    src="{{ $incidencia->foto_url }}"
                                    alt="{{ $incidencia->titulo }}"
                                    class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                                >
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-primary/20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="p-4 flex flex-col flex-1">
                            {{-- Title --}}
                            <h3 class="font-poppins font-semibold text-base text-main leading-snug mb-2">
                                {{ $incidencia->titulo }}
                            </h3>

                            {{-- Badges: estado + prioridad --}}
                            <div class="flex flex-wrap items-center gap-1.5 mb-2">
                                @php
                                    $estadoBadge = match($incidencia->estado) {
                                        'pendiente' => 'bg-amber-100 text-amber-700',
                                        'en_proceso' => 'bg-blue-100 text-blue-700',
                                        'resuelta' => 'bg-emerald-100 text-emerald-700',
                                        'rechazada' => 'bg-red-100 text-red-700',
                                        default => 'bg-gray-100 text-gray-600',
                                    };
                                    $prioridadBadge = match($incidencia->prioridad) {
                                        'baja' => 'bg-gray-100 text-gray-600',
                                        'media' => 'bg-orange-100 text-orange-700',
                                        'alta' => 'bg-red-100 text-red-700',
                                        default => 'bg-gray-100 text-gray-600',
                                    };
                                @endphp
                                <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-[11px] font-medium {{ $estadoBadge }}">
                                    {{ ucfirst(str_replace('_', ' ', $incidencia->estado)) }}
                                </span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-[11px] font-medium {{ $prioridadBadge }}">
                                    {{ ucfirst($incidencia->prioridad) }}
                                </span>
                            </div>

                            {{-- Date + Author (pushed to bottom) --}}
                            <div class="flex items-center gap-2 text-xs text-muted mt-auto pt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                                <span>{{ $incidencia->fecha_creacion->format('d M Y') }}</span>
                                <span class="text-gray-300">·</span>
                                <span>{{ $incidencia->creador->nombre }} {{ $incidencia->creador->apellidos }}</span>
                            </div>
                        </div>
                    </div>
                @endcomponent
            </a>
        @empty
            {{-- Empty state --}}
            <div class="col-span-full flex flex-col items-center justify-center py-12 text-center">
                <div class="flex items-center justify-center w-16 h-16 rounded-full bg-primary/5 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-primary/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
                <p class="font-medium text-sm text-muted">No hay incidencias reportadas</p>
            </div>
        @endforelse

    </div>

    {{-- Pagination --}}
    <div class="mt-2">
        {{ $incidencias->links() }}
    </div>

</div>
@endsection
