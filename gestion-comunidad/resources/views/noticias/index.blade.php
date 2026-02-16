@extends('layouts.app')

@section('title', 'Noticias - Gestión Comunidad')

@section('content')
<div class="flex flex-col gap-5">

    {{-- Page Title --}}
    @include('components.ui.section-title', ['title' => 'Noticias', 'titleClass' => 'text-xl'])

    {{-- Noticias List --}}
    <div class="grid gap-4 md:grid-cols-2" id="noticias-list">

        @forelse ($noticias as $noticia)
            <a href="{{ route('noticias.show', $noticia) }}" class="block h-full">
                @component('components.ui.card', [
                    'hover' => true,
                    'bodyClass' => 'p-0 h-full flex flex-col',
                    'cardClass' => 'h-full',
                ])
                    <div class="flex flex-col h-full">
                        {{-- Image (if exists) --}}
                        @if($noticia->adjunto_url)
                            <div class="w-full h-44 overflow-hidden shrink-0">
                                <img
                                    src="{{ $noticia->adjunto_url }}"
                                    alt="{{ $noticia->titulo }}"
                                    class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                                >
                            </div>
                        @endif

                        {{-- Content --}}
                        <div class="p-4 flex flex-col grow">
                            {{-- Title --}}
                            <h3 class="font-poppins font-semibold text-base text-main leading-snug mb-1.5 line-clamp-2">
                                {{ $noticia->titulo }}
                            </h3>

                            {{-- Date + Author --}}
                            <div class="flex items-center gap-2 text-xs text-muted mt-auto pt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                                <span class="whitespace-nowrap">{{ $noticia->fecha_publicacion->format('d M Y') }}</span>
                                <span class="text-gray-300">·</span>
                                <span class="truncate">{{ $noticia->autor->nombre }} {{ $noticia->autor->apellidos }}</span>
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
                              d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                    </svg>
                </div>
                <p class="font-medium text-sm text-muted">No hay noticias publicadas</p>
            </div>
        @endforelse

    </div>

    {{-- Pagination --}}
    <div class="mt-2">
        {{ $noticias->links() }}
    </div>

</div>
@endsection
