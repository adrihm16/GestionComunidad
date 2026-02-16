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
    {{-- SECTION 4: Calendario                         --}}
    {{-- ============================================= --}}
    <section>
        @include('components.ui.section-title', ['title' => 'Calendario'])
        @component('components.ui.card', ['hover' => false])
            {{-- Month header --}}
            <div class="flex items-center justify-between mb-3">
                <button class="p-1 rounded-lg hover:bg-primary/10 transition-colors" aria-label="Mes anterior">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-main" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </button>
                <span class="font-semibold text-sm text-main">Febrero 2026</span>
                <button class="p-1 rounded-lg hover:bg-primary/10 transition-colors" aria-label="Mes siguiente">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-main" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>

            {{-- Day labels --}}
            <div class="grid grid-cols-7 gap-1 mb-1">
                @foreach(['L', 'M', 'X', 'J', 'V', 'S', 'D'] as $day)
                    <div class="text-center text-xs font-medium text-muted py-1">{{ $day }}</div>
                @endforeach
            </div>

            {{-- Calendar grid (February 2026 starts on Sunday) --}}
            <div class="grid grid-cols-7 gap-1">
                @for($i = 0; $i < 6; $i++)
                    <div></div>
                @endfor

                @for($day = 1; $day <= 28; $day++)
                    @php
                        $isToday = ($day == 13);
                        $hasEvent = in_array($day, [13, 28]);
                    @endphp
                    <button class="relative flex items-center justify-center w-full aspect-square rounded-lg text-xs font-medium
                                   transition-all duration-200
                                   {{ $isToday
                                       ? 'bg-primary text-white shadow-sm'
                                       : 'text-main hover:bg-primary/10' }}">
                        {{ $day }}
                        @if($hasEvent && !$isToday)
                            <span class="absolute bottom-0.5 w-1 h-1 rounded-full bg-accent"></span>
                        @endif
                    </button>
                @endfor
            </div>

            {{-- Upcoming events legend --}}
            <div class="mt-3 pt-3 border-t border-gray-100">
                <div class="flex items-center gap-2 text-xs text-muted">
                    <span class="w-1.5 h-1.5 rounded-full bg-accent"></span>
                    <span>28 Feb — Junta ordinaria de vecinos</span>
                </div>
            </div>
        @endcomponent
    </section>

</div>
@endsection
