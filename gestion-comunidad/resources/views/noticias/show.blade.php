@extends('layouts.app')

@section('title', $noticia->titulo . ' - Gestión Comunidad')

@section('content')
<div class="flex flex-col gap-5">

    {{-- Back button + Admin actions --}}
    <div class="flex items-center justify-between">
        <a href="{{ route('noticias.index') }}"
           class="inline-flex items-center gap-2 text-sm font-medium text-muted hover:text-primary transition-colors w-fit">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
            Volver a noticias
        </a>

        @if(auth()->check() && auth()->user()->rol_sistema === 'admin')
            <div class="flex items-center gap-2">
                {{-- Edit button --}}
                <a href="{{ route('noticias.edit', $noticia) }}"
                   class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-blue-500 text-white text-xs font-medium
                          shadow transition-all duration-200 hover:bg-blue-600 hover:scale-105 active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                    Editar
                </a>

                {{-- Delete button --}}
                <form action="{{ route('noticias.destroy', $noticia) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta noticia?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-red-500 text-white text-xs font-medium
                                   shadow transition-all duration-200 hover:bg-red-600 hover:scale-105 active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                        Eliminar
                    </button>
                </form>
            </div>
        @endif
    </div>

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
