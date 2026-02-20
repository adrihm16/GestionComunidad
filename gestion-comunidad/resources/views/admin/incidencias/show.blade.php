@extends('layouts.admin')

@section('title', 'Detalle de Incidencia - Panel Admin')

@section('content')
    <div class="flex flex-col gap-5">

        {{-- Back button --}}
        <a href="{{ route('admin.incidencias.index') }}"
            class="inline-flex items-center gap-2 text-sm font-medium text-muted hover:text-primary transition-colors w-fit">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
            Volver a incidencias
        </a>

        {{-- Page Title --}}
        @include('components.ui.section-title', ['title' => 'Detalle de Incidencia', 'titleClass' => 'text-xl'])

        {{-- Success Message --}}
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

        {{-- Incident Details Card --}}
        @component('components.ui.card', ['hover' => false])
        <div class="flex flex-col gap-4">
            {{-- Header row --}}
            <div class="flex items-start justify-between gap-4">
                <div class="flex-1 min-w-0">
                    <h2 class="font-poppins font-semibold text-lg text-main">{{ $incidencia->titulo }}</h2>
                    <p class="text-xs text-muted mt-1">
                        Reportada por
                        <span class="font-medium text-main">
                            {{ $incidencia->creador->nombre }} {{ $incidencia->creador->apellidos }}
                        </span>
                        el {{ $incidencia->fecha_creacion->format('d/m/Y H:i') }}
                    </p>
                </div>

                {{-- Priority badge --}}
                @php
                    $prioridadColor = match ($incidencia->prioridad) {
                        'alta' => 'bg-red-100 text-red-700',
                        'media' => 'bg-amber-100 text-amber-700',
                        'baja' => 'bg-blue-100 text-blue-700',
                        default => 'bg-gray-100 text-gray-600',
                    };
                @endphp
                <span
                    class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-semibold {{ $prioridadColor }} flex-shrink-0">
                    Prioridad {{ ucfirst($incidencia->prioridad) }}
                </span>
            </div>

            {{-- Divider --}}
            <hr class="border-gray-100">

            {{-- Description --}}
            <div>
                <p class="text-sm font-medium text-main mb-1">Descripción</p>
                <p class="text-sm text-muted leading-relaxed">{{ $incidencia->descripcion }}</p>
            </div>

            {{-- Photo, if any --}}
            @if($incidencia->foto_url)
                <div>
                    <p class="text-sm font-medium text-main mb-2">Foto adjunta</p>
                    <img src="{{ $incidencia->foto_url }}" alt="Foto de la incidencia"
                        class="w-full max-h-72 object-cover rounded-xl border border-gray-100">
                </div>
            @endif
        </div>
        @endcomponent

        {{-- Status Management Card --}}
        @component('components.ui.card', ['hover' => false, 'stripContent' => '<span class="text-white text-xs font-semibold">Gestionar Estado</span>'])
        <form action="{{ route('admin.incidencias.update', $incidencia) }}" method="POST"
            class="flex flex-col sm:flex-row gap-3 items-end">
            @csrf
            @method('PUT')

            <div class="flex flex-col gap-1.5 flex-1">
                <label for="estado" class="text-sm font-medium text-main">Estado actual</label>
                <select id="estado" name="estado" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                                   focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                                   transition-all duration-200">
                    @foreach(['pendiente', 'en_proceso', 'resuelta', 'rechazada'] as $estado)
                        <option value="{{ $estado }}" {{ $incidencia->estado === $estado ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $estado)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold shadow-md
                               transition-all duration-200 hover:scale-105 active:scale-95 whitespace-nowrap">
                Actualizar estado
            </button>
        </form>
        @endcomponent

    </div>
@endsection