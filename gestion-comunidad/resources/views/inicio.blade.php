@extends('layouts.app')

@section('title', 'Inicio - Gestión Comunidad')

@section('content')
<div class="flex flex-col gap-6">

    {{-- ============================================= --}}
    {{-- SECTION 1: Últimas noticias (2-column grid)   --}}
    {{-- ============================================= --}}
    <section>
        @include('components.ui.section-title', ['title' => 'Últimas noticias'])
        <div class="grid grid-cols-2 gap-3">

            @forelse ($ultimasNoticias as $noticia)
                <a href="{{ route('noticias.show', $noticia) }}" class="block">
                    @component('components.ui.card', ['hover' => true, 'bodyClass' => 'p-3'])
                        <p class="font-semibold text-sm text-main leading-snug mb-1">{{ $noticia->titulo }}</p>
                        <p class="text-xs text-muted line-clamp-2">{{ Str::limit($noticia->contenido, 80) }}</p>
                        <p class="text-xs text-muted mt-2 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                            {{ $noticia->fecha_publicacion->format('d M Y') }}
                        </p>
                    @endcomponent
                </a>
            @empty
                <p class="col-span-2 text-sm text-muted text-center py-4">No hay noticias publicadas</p>
            @endforelse

        </div>
    </section>

    {{-- ============================================= --}}
    {{-- SECTION 2: Próxima reunión                    --}}
    {{-- ============================================= --}}
    <section>
        @include('components.ui.section-title', ['title' => 'Próxima reunión'])
        @component('components.ui.card', ['hover' => true])
            <div class="flex items-start gap-4">
                {{-- Date badge --}}
                <div class="flex flex-col items-center justify-center min-w-[52px] h-14 rounded-xl bg-primary/5 border border-primary/15">
                    <span class="text-xl font-bold text-primary leading-none">28</span>
                    <span class="text-xs font-medium text-primary uppercase leading-tight">Feb</span>
                </div>
                {{-- Meeting details --}}
                <div class="flex-1">
                    <p class="font-semibold text-sm text-main mb-0.5">Junta ordinaria de vecinos</p>
                    <p class="text-xs text-muted mb-2">Revisión de presupuesto anual y aprobación de obras.</p>
                    <div class="flex items-center gap-3 text-xs text-muted">
                        <span class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            18:00h
                        </span>
                        <span class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                            Salón comunal
                        </span>
                    </div>
                </div>
            </div>
        @endcomponent
    </section>

    {{-- ============================================= --}}
    {{-- SECTION 3: Recibos                            --}}
    {{-- ============================================= --}}
    <section>
        @include('components.ui.section-title', ['title' => 'Recibos'])
        @component('components.ui.card', ['hover' => true])
            {{-- Receipt row 1 --}}
            <div class="flex items-center justify-between py-2">
                <div class="flex items-center gap-3">
                    <div class="flex items-center justify-center w-9 h-9 rounded-lg bg-primary/5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-sm text-main">Febrero 2026</p>
                        <p class="text-xs text-muted">Cuota comunidad</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-semibold text-sm text-main">85,00 €</p>
                    @include('components.ui.badge', ['text' => 'Pagado', 'variant' => 'success'])
                </div>
            </div>
            {{-- Divider --}}
            <div class="border-t border-gray-100"></div>
            {{-- Receipt row 2 --}}
            <div class="flex items-center justify-between py-2">
                <div class="flex items-center gap-3">
                    <div class="flex items-center justify-center w-9 h-9 rounded-lg bg-primary/5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-sm text-main">Enero 2026</p>
                        <p class="text-xs text-muted">Cuota comunidad</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="font-semibold text-sm text-main">85,00 €</p>
                    @include('components.ui.badge', ['text' => 'Pagado', 'variant' => 'success'])
                </div>
            </div>
        @endcomponent
    </section>

    {{-- ============================================= --}}
    {{-- SECTION 3.5: Incidencias activas              --}}
    {{-- ============================================= --}}
    <section>
        <div class="flex items-center justify-between mb-1">
            @include('components.ui.section-title', ['title' => 'Incidencias activas'])
            <a href="{{ route('incidencias.index') }}" class="text-xs font-medium text-primary hover:underline">Ver todas →</a>
        </div>
        @forelse ($ultimasIncidencias as $incidencia)
            <a href="{{ route('incidencias.show', $incidencia) }}" class="block mb-2">
                @component('components.ui.card', ['hover' => true, 'bodyClass' => 'p-3'])
                    <div class="flex items-center gap-3">
                        {{-- Priority icon --}}
                        @php
                            $prioridadColor = match($incidencia->prioridad) {
                                'alta' => 'bg-red-100 text-red-600',
                                'media' => 'bg-orange-100 text-orange-600',
                                default => 'bg-gray-100 text-gray-500',
                            };
                        @endphp
                        <div class="flex items-center justify-center w-9 h-9 rounded-lg {{ $prioridadColor }} shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-sm text-main truncate">{{ $incidencia->titulo }}</p>
                            <p class="text-xs text-muted">{{ $incidencia->fecha_creacion->format('d M Y') }}</p>
                        </div>
                        @php
                            $estadoBadge = match($incidencia->estado) {
                                'pendiente' => 'bg-amber-100 text-amber-700',
                                'en_proceso' => 'bg-blue-100 text-blue-700',
                                default => 'bg-gray-100 text-gray-600',
                            };
                        @endphp
                        <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-[10px] font-medium {{ $estadoBadge }} shrink-0">
                            {{ ucfirst(str_replace('_', ' ', $incidencia->estado)) }}
                        </span>
                    </div>
                @endcomponent
            </a>
        @empty
            @component('components.ui.card', ['hover' => false, 'bodyClass' => 'p-3'])
                <p class="text-sm text-muted text-center">No hay incidencias activas 🎉</p>
            @endcomponent
        @endforelse
    </section>

    {{-- ============================================= --}}
    {{-- SECTION 4: Calendario                         --}}
    {{-- ============================================= --}}
    <section>
        @include('components.ui.section-title', ['title' => 'Calendario'])
        @include('components.ui.calendar', ['calendarData' => $calendarData])
    </section>

</div>
@endsection
