@extends('layouts.app')

@section('title', $user->nombre . ' ' . $user->apellidos . ' - Vecino')

@section('content')
<div class="flex flex-col gap-5">

    {{-- Back button --}}
    <a href="{{ route('vecinos.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-muted hover:text-primary transition-colors w-fit">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
        </svg>
        Volver a vecinos
    </a>

    {{-- Información Personal --}}
    @include('components.ui.section-title', ['title' => 'Información del Vecino', 'titleClass' => 'text-xl'])
    
    @component('components.ui.card', ['hover' => false])
        <div class="flex items-start gap-4">
            {{-- Avatar --}}
            <div class="flex items-center justify-center w-20 h-20 rounded-full bg-primary/10 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
            </div>

            {{-- Info --}}
            <div class="flex-1">
                <h1 class="font-poppins font-semibold text-2xl text-main mb-2">
                    {{ $user->nombre }} {{ $user->apellidos }}
                </h1>

                <div class="flex flex-col gap-3">
                    {{-- Email --}}
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-muted flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                        <a href="mailto:{{ $user->email }}" class="text-sm text-main hover:text-primary transition-colors">
                            {{ $user->email }}
                        </a>
                    </div>

                    {{-- Teléfono --}}
                    @if($user->telefono)
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-muted flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                            <a href="tel:{{ $user->telefono }}" class="text-sm text-main hover:text-primary transition-colors">
                                {{ $user->telefono }}
                            </a>
                        </div>
                    @endif

                    {{-- Cargo --}}
                    @if($user->cargo_comunidad)
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-muted flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0" />
                            </svg>
                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-semibold bg-amber-100 text-amber-700">
                                {{ $user->cargo_comunidad }}
                            </span>
                        </div>
                    @endif

                    {{-- Fecha de registro --}}
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-muted flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                        <span class="text-sm text-muted">
                            Vecino desde {{ $user->fecha_registro ? $user->fecha_registro->format('d/m/Y') : 'N/A' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endcomponent

    {{-- Inmuebles --}}
    @if($user->inmuebles->count() > 0)
        @include('components.ui.section-title', ['title' => 'Inmuebles', 'titleClass' => 'text-lg'])
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($user->inmuebles as $inmueble)
                @component('components.ui.card', ['hover' => false])
                    <div class="flex items-center gap-3">
                        {{-- Icon based on type --}}
                        <div class="flex items-center justify-center w-12 h-12 rounded-lg 
                                    {{ $inmueble->tipo === 'piso' ? 'bg-blue-100' : '' }}
                                    {{ $inmueble->tipo === 'local' ? 'bg-purple-100' : '' }}
                                    {{ $inmueble->tipo === 'garaje' ? 'bg-gray-100' : '' }}
                                    {{ $inmueble->tipo === 'trastero' ? 'bg-amber-100' : '' }}">
                            @if($inmueble->tipo === 'piso')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                            @elseif($inmueble->tipo === 'local')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" />
                                </svg>
                            @elseif($inmueble->tipo === 'garaje')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                </svg>
                            @endif
                        </div>

                        {{-- Inmueble Details --}}
                        <div>
                            <p class="text-sm font-semibold text-main">
                                {{ ucfirst($inmueble->tipo) }}
                                @if($inmueble->bloque) - Bloque {{ $inmueble->bloque }} @endif
                            </p>
                            <p class="text-xs text-muted">
                                @if($inmueble->tipo === 'garaje' || $inmueble->tipo === 'trastero')
                                    {{ $inmueble->piso }}
                                @else
                                    {{ $inmueble->piso }}º{{ $inmueble->puerta }}
                                @endif
                            </p>
                        </div>
                    </div>
                @endcomponent
            @endforeach
        </div>
    @endif

    {{-- Incidencias Recientes --}}
    @if($user->incidencias->count() > 0)
        @include('components.ui.section-title', ['title' => 'Incidencias Recientes', 'titleClass' => 'text-lg'])
        
        <div class="flex flex-col gap-3">
            @foreach($user->incidencias as $incidencia)
                <a href="{{ route('incidencias.show', $incidencia) }}">
                    @component('components.ui.card', ['hover' => true, 'bodyClass' => 'flex items-center justify-between px-4 py-3'])
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-main truncate">{{ $incidencia->titulo }}</p>
                            <p class="text-xs text-muted mt-0.5">{{ $incidencia->fecha_creacion->diffForHumans() }}</p>
                        </div>

                        <div class="flex items-center gap-2 ml-4">
                            @php
                                $estadoBadge = match($incidencia->estado) {
                                    'pendiente' => 'bg-amber-100 text-amber-700',
                                    'en_proceso' => 'bg-blue-100 text-blue-700',
                                    'resuelta' => 'bg-emerald-100 text-emerald-700',
                                    'rechazada' => 'bg-red-100 text-red-700',
                                    default => 'bg-gray-100 text-gray-600',
                                };
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold {{ $estadoBadge }}">
                                {{ ucfirst($incidencia->estado) }}
                            </span>
                        </div>
                    @endcomponent
                </a>
            @endforeach
        </div>
    @endif

</div>
@endsection
