@extends('layouts.app')

@section('title', $incidencia->titulo . ' - Gestión Comunidad')

@section('content')
<div class="flex flex-col gap-5">

    {{-- Back button --}}
    <a href="{{ route('incidencias.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-muted hover:text-primary transition-colors w-fit">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
        </svg>
        Volver a incidencias
    </a>

    {{-- Incidencia Card --}}
    @component('components.ui.card', ['hover' => false, 'bodyClass' => 'p-0'])
        <div class="flex flex-col">
            {{-- Image (if exists) - clickable to view full --}}
            @if($incidencia->foto_url)
                <div class="w-full max-h-80 overflow-hidden relative group cursor-pointer" onclick="openLightbox()">
                    <img
                        src="{{ $incidencia->foto_url }}"
                        alt="{{ $incidencia->titulo }}"
                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-100"
                    >
                    {{-- Hover overlay --}}
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300 flex items-center justify-center">
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300
                                    flex items-center gap-2 px-4 py-2 rounded-xl bg-white/90 shadow-lg text-sm font-medium text-main">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM10.5 7.5v6m3-3h-6" />
                            </svg>
                            Ver imagen completa
                        </div>
                    </div>
                </div>
            @endif

            {{-- Content --}}
            <div class="p-5 flex flex-col gap-4">
                {{-- Title --}}
                <h1 class="font-poppins font-semibold text-xl text-main leading-snug">
                    {{ $incidencia->titulo }}
                </h1>

                {{-- Badges: estado + prioridad --}}
                <div class="flex flex-wrap items-center gap-2">
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
                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium {{ $estadoBadge }}">
                        Estado: {{ ucfirst(str_replace('_', ' ', $incidencia->estado)) }}
                    </span>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium {{ $prioridadBadge }}">
                        Prioridad: {{ ucfirst($incidencia->prioridad) }}
                    </span>
                </div>

                {{-- Meta: Date + Author --}}
                <div class="flex items-center gap-4 text-xs text-muted">
                    <div class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                        <span>{{ $incidencia->fecha_creacion->format('d M Y, H:i') }}</span>
                    </div>
                    <span class="text-gray-300">|</span>
                    <div class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        <span>{{ $incidencia->creador->nombre }} {{ $incidencia->creador->apellidos }}</span>
                    </div>
                </div>

                {{-- Divider --}}
                <hr class="border-gray-100">

                {{-- Description --}}
                <div class="text-sm text-main leading-relaxed whitespace-pre-line">
                    {{ $incidencia->descripcion }}
                </div>

                {{-- Admin: Status change buttons --}}
                @if(Auth::user()->rol_sistema === 'admin')
                    <hr class="border-gray-100">
                    <div class="flex flex-col gap-2">
                        <p class="text-xs font-semibold text-muted uppercase tracking-wide">Cambiar estado</p>
                        <div class="flex flex-wrap gap-2">
                            @php
                                $estados = [
                                    'pendiente' => ['label' => 'Pendiente', 'active' => 'bg-amber-500 text-white shadow-amber-200', 'inactive' => 'bg-amber-50 text-amber-700 hover:bg-amber-100'],
                                    'en_proceso' => ['label' => 'En proceso', 'active' => 'bg-blue-500 text-white shadow-blue-200', 'inactive' => 'bg-blue-50 text-blue-700 hover:bg-blue-100'],
                                    'resuelta' => ['label' => 'Resuelta', 'active' => 'bg-emerald-500 text-white shadow-emerald-200', 'inactive' => 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100'],
                                ];
                            @endphp
                            @foreach($estados as $estadoKey => $estadoConfig)
                                <form action="{{ route('incidencias.estado.update', $incidencia) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="estado" value="{{ $estadoKey }}">
                                    <button type="submit"
                                            @if($incidencia->estado === $estadoKey) disabled @endif
                                            class="px-4 py-1.5 rounded-lg text-xs font-semibold transition-all duration-200 shadow-sm
                                                   {{ $incidencia->estado === $estadoKey
                                                        ? $estadoConfig['active'] . ' cursor-default'
                                                        : $estadoConfig['inactive'] . ' cursor-pointer hover:scale-105 active:scale-95' }}">
                                        {{ $estadoConfig['label'] }}
                                    </button>
                                </form>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endcomponent

    {{-- ============================================= --}}
    {{-- COMMENTS SECTION                              --}}
    {{-- ============================================= --}}
    <section>
        @include('components.ui.section-title', [
            'title' => 'Comentarios (' . $incidencia->comentarios->count() . ')',
        ])

        {{-- Add comment form --}}
        @component('components.ui.card', ['hover' => false])
            <form action="{{ route('incidencias.comentarios.store', $incidencia) }}" method="POST" class="flex flex-col gap-3">
                @csrf
                <textarea
                    name="contenido"
                    rows="3"
                    placeholder="Escribe un comentario..."
                    required
                    maxlength="1000"
                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                           placeholder-gray-400 bg-white resize-none
                           focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                           transition-all duration-200"
                >{{ old('contenido') }}</textarea>
                @error('contenido')
                    <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror
                <div class="flex justify-end">
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-primary text-white text-sm font-medium
                                   shadow-md transition-all duration-200 hover:scale-105 active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>
                        Comentar
                    </button>
                </div>
            </form>
        @endcomponent

        {{-- Comments list --}}
        <div class="flex flex-col gap-3 mt-3">
            @forelse ($incidencia->comentarios->sortByDesc('created_at') as $comentario)
                @component('components.ui.card', ['hover' => false, 'bodyClass' => 'p-3'])
                    <div class="flex gap-3">
                        {{-- User avatar --}}
                        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-primary/10 shrink-0 mt-0.5">
                            <span class="text-xs font-semibold text-primary">
                                {{ strtoupper(substr($comentario->user->nombre, 0, 1)) }}{{ strtoupper(substr($comentario->user->apellidos, 0, 1)) }}
                            </span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-sm font-medium text-main">
                                    {{ $comentario->user->nombre }} {{ $comentario->user->apellidos }}
                                </span>
                                <span class="text-xs text-muted">
                                    {{ $comentario->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <p class="text-sm text-main leading-relaxed whitespace-pre-line">{{ $comentario->contenido }}</p>
                        </div>
                    </div>
                @endcomponent
            @empty
                <p class="text-sm text-muted text-center py-4">No hay comentarios todavía. ¡Sé el primero!</p>
            @endforelse
        </div>
    </section>

</div>

{{-- Fullscreen Lightbox --}}
@if($incidencia->foto_url)
<div id="lightbox"
     class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4"
     onclick="closeLightbox(event)">

    {{-- Close button --}}
    <button onclick="closeLightbox(event, true)"
            class="absolute top-4 right-4 flex items-center justify-center w-10 h-10 rounded-full
                   bg-white/10 text-white transition-all duration-200
                   hover:bg-white/20 hover:scale-110 active:scale-95 z-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    {{-- Full image --}}
    <img src="{{ $incidencia->foto_url }}"
         alt="{{ $incidencia->titulo }}"
         class="max-w-full max-h-full object-contain rounded-lg shadow-2xl
                transition-transform duration-300 scale-95"
         id="lightbox-img"
         onclick="event.stopPropagation()">
</div>

<script>
function openLightbox() {
    const lb = document.getElementById('lightbox');
    const img = document.getElementById('lightbox-img');
    lb.classList.remove('hidden');
    lb.classList.add('flex');
    requestAnimationFrame(() => {
        img.classList.remove('scale-95');
        img.classList.add('scale-100');
    });
}

function closeLightbox(e, force) {
    if (!force && e.target !== document.getElementById('lightbox')) return;
    const lb = document.getElementById('lightbox');
    const img = document.getElementById('lightbox-img');
    img.classList.remove('scale-100');
    img.classList.add('scale-95');
    setTimeout(() => {
        lb.classList.add('hidden');
        lb.classList.remove('flex');
    }, 200);
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const lb = document.getElementById('lightbox');
        if (lb && !lb.classList.contains('hidden')) {
            closeLightbox(e, true);
        }
    }
});
</script>
@endif
@endsection
