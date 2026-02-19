@extends('layouts.app')

@section('title', $noticia->titulo . ' - Gestión Comunidad')

@section('content')
<div class="flex flex-col gap-5">

    {{-- Back button --}}
    <a href="{{ route('noticias.index') }}"
       class="inline-flex items-center gap-2 text-sm font-medium text-muted hover:text-primary transition-colors w-fit">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
        </svg>
        Volver a noticias
    </a>

    {{-- News Card --}}
    @component('components.ui.card', ['hover' => false, 'bodyClass' => 'p-0'])
        <div class="flex flex-col">

            {{-- Image (if exists) --}}
            @if($noticia->adjunto_url)
                <div class="w-full h-52 overflow-hidden">
                    <img
                        src="{{ $noticia->adjunto_url }}"
                        alt="{{ $noticia->titulo }}"
                        class="w-full h-full object-cover"
                    >
                </div>
            @endif

            {{-- Content --}}
            <div class="p-5">
                {{-- Title --}}
                <h1 class="font-poppins font-semibold text-xl text-main leading-snug mb-3">
                    {{ $noticia->titulo }}
                </h1>

                {{-- Meta: date + author --}}
                <div class="flex flex-wrap items-center gap-3 mb-5 pb-4 border-b border-gray-100">
                    {{-- Date --}}
                    <span class="inline-flex items-center gap-1.5 text-xs text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                        {{ $noticia->fecha_publicacion->format('d M Y, H:i') }}h
                    </span>

                    <span class="text-gray-200">|</span>

                    {{-- Author --}}
                    <span class="inline-flex items-center gap-1.5 text-xs text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        {{ $noticia->autor->nombre }} {{ $noticia->autor->apellidos }}
                    </span>
                </div>

                {{-- Body text --}}
                <div class="font-poppins text-sm text-main leading-relaxed whitespace-pre-line">
                    {{ $noticia->contenido }}
                </div>
            </div>

        </div>
    @endcomponent

</div>
@endsection
