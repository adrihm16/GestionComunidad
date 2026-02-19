@extends('layouts.admin')

@section('title', 'Gestión de Noticias - Panel Admin')

@section('content')
    <div class="flex flex-col gap-5">

        {{-- Header Section --}}
        <div class="flex items-center justify-between">
            @include('components.ui.section-title', ['title' => 'Gestión de Noticias', 'titleClass' => 'text-xl mb-0'])

            <a href="{{ route('admin.noticias.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-primary text-white text-sm font-medium shadow-md
                              transition-all duration-200 hover:scale-105 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Nueva Noticia
            </a>
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

        {{-- Noticias List --}}
        <div class="flex flex-col gap-4">
            @forelse ($noticias as $noticia)
                @component('components.ui.card', [
                    'hover' => true,
                    'bodyClass' => 'flex flex-col sm:flex-row sm:items-center justify-between px-4 py-4 gap-4 sm:gap-0',
                ])
                <div class="flex items-center gap-4 flex-1">
                    {{-- Thumbnail --}}
                    <div class="flex-shrink-0 w-12 h-12 rounded-xl overflow-hidden bg-primary/10 dark:bg-primary/20">
                        @if($noticia->adjunto_url)
                            <img src="{{ $noticia->adjunto_url }}" alt="{{ $noticia->titulo }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-primary/30" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <p class="font-poppins font-semibold text-base text-main dark:text-gray-100 truncate">
                            {{ $noticia->titulo }}
                        </p>
                        <p class="text-xs text-muted dark:text-gray-400">
                            Publicado el {{ $noticia->fecha_publicacion->format('d/m/Y') }} por {{ $noticia->autor->nombre }}
                        </p>
                    </div>
                </div>

                {{-- Actions --}}
                <div
                    class="flex items-center justify-end gap-2 w-full sm:w-auto sm:ml-4 border-t sm:border-t-0 border-gray-100 dark:border-emerald-900/40 pt-3 sm:pt-0">
                    <a href="{{ route('noticias.show', $noticia) }}" target="_blank"
                        class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-emerald-900/30 transition-colors duration-200"
                        title="Ver noticia">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-muted dark:text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </a>

                    <a href="{{ route('admin.noticias.edit', $noticia) }}"
                        class="p-2 rounded-lg hover:bg-primary/5 transition-colors duration-200" title="Editar noticia">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125" />
                        </svg>
                    </a>

                    <form method="POST" action="{{ route('admin.noticias.destroy', $noticia) }}"
                        onsubmit="return confirm('¿Estás seguro de eliminar esta noticia?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 rounded-lg hover:bg-red-50 transition-colors duration-200"
                            title="Eliminar noticia">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24"
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
                        class="flex items-center justify-center w-16 h-16 rounded-full bg-primary/5 dark:bg-emerald-950/40 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-primary/40" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                        </svg>
                    </div>
                    <p class="font-medium text-sm text-muted dark:text-gray-400">No hay noticias publicadas</p>
                    <a href="{{ route('admin.noticias.create') }}"
                        class="mt-2 text-primary text-sm font-medium hover:underline">
                        Publicar la primera
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($noticias->hasPages())
            <div class="mt-2">
                {{ $noticias->links() }}
            </div>
        @endif

    </div>
@endsection