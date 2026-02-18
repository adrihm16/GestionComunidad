@extends('layouts.app')

@section('title', 'Panel Admin - Gestión Comunidad')

@section('content')
<div class="flex flex-col gap-8" x-data="adminPanel()">

    {{-- ===== PAGE HEADER ===== --}}
    @include('components.ui.section-title', ['title' => 'Panel de Administración', 'titleClass' => 'text-xl mb-0'])

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="flex items-center gap-3 p-4 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="flex items-center gap-3 p-4 rounded-xl bg-red-50 border border-red-100 text-red-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
            </svg>
            <span class="text-sm font-medium">{{ session('error') }}</span>
        </div>
    @endif

    {{-- ===================================================== --}}
    {{-- SECCIÓN 1: GESTIÓN DE USUARIOS                        --}}
    {{-- ===================================================== --}}
    <div class="flex flex-col gap-4">

        {{-- Section header --}}
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-purple-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div>
                <h2 class="font-poppins font-semibold text-base text-main">Gestión de Usuarios</h2>
                <span class="text-xs text-muted bg-gray-100 px-2 py-0.5 rounded-full">{{ $users->total() }}</span>
            </div>
            <a href="{{ route('admin.users.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-primary text-white text-sm font-medium shadow-md
                      transition-all duration-200 hover:scale-105 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Nuevo Usuario
            </a>
        </div>

        {{-- Filters --}}
        @component('components.ui.card', ['hover' => false, 'bodyClass' => 'p-4'])
            <form method="GET" action="{{ route('admin.dashboard') }}" class="flex flex-col md:flex-row gap-3">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Buscar por nombre, apellidos o email..."
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                                  focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all duration-200">
                </div>
                <div>
                    <select name="rol" class="w-full md:w-40 px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                                              focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all duration-200">
                        <option value="">Todos los roles</option>
                        <option value="admin" {{ request('rol') === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="vecino" {{ request('rol') === 'vecino' ? 'selected' : '' }}>Vecino</option>
                    </select>
                </div>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-medium shadow-md
                                             transition-all duration-200 hover:scale-105 active:scale-95">
                    Filtrar
                </button>
                @if(request('search') || request('rol'))
                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-2.5 rounded-xl bg-gray-100 text-main text-sm font-medium
                                                                     transition-all duration-200 hover:bg-gray-200">
                        Limpiar
                    </a>
                @endif
            </form>
        @endcomponent

        {{-- Users list --}}
        <div class="flex flex-col gap-3">
            @forelse ($users as $user)
                @component('components.ui.card', ['hover' => true, 'bodyClass' => 'flex items-center justify-between px-4 py-4'])
                    <div class="flex items-center gap-4 flex-1 min-w-0">
                        <div class="flex items-center justify-center w-11 h-11 rounded-full bg-primary/10 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-poppins font-semibold text-sm text-main truncate">{{ $user->nombre }} {{ $user->apellidos }}</p>
                            <p class="text-xs text-muted truncate">{{ $user->email }}</p>
                        </div>
                        <div class="flex items-center gap-2 flex-shrink-0">
                            @php
                                $rolBadge = match($user->rol_sistema) {
                                    'admin' => 'bg-purple-100 text-purple-700',
                                    'vecino' => 'bg-blue-100 text-blue-700',
                                    default => 'bg-gray-100 text-gray-600',
                                };
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-semibold {{ $rolBadge }}">
                                {{ ucfirst($user->rol_sistema) }}
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center gap-1 ml-4 flex-shrink-0">
                        <a href="{{ route('admin.users.edit', $user) }}"
                           class="p-2 rounded-lg hover:bg-primary/5 transition-colors duration-200" title="Editar usuario">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125" />
                            </svg>
                        </a>
                        @if($user->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                  onsubmit="return confirm('¿Eliminar este usuario?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-lg hover:bg-red-50 transition-colors duration-200" title="Eliminar usuario">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                        @endif
                    </div>
                @endcomponent
            @empty
                <div class="flex flex-col items-center justify-center py-10 text-center">
                    <p class="text-sm text-muted">No se encontraron usuarios</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($users->hasPages())
            <div>{{ $users->withQueryString()->links() }}</div>
        @endif
    </div>

    {{-- Divider --}}
    <div class="border-t border-gray-100"></div>

    {{-- ===================================================== --}}
    {{-- SECCIÓN 2: GESTIÓN DE NOTICIAS                        --}}
    {{-- ===================================================== --}}
    <div class="flex flex-col gap-4">

        {{-- Section header --}}
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-emerald-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                    </svg>
                </div>
                <h2 class="font-poppins font-semibold text-base text-main">Gestión de Noticias</h2>
                <span class="text-xs text-muted bg-gray-100 px-2 py-0.5 rounded-full">{{ $noticias->count() }}</span>
            </div>
            <button type="button" @click="openForm('create')"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-primary text-white text-sm font-medium shadow-md
                           transition-all duration-200 hover:scale-105 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-200"
                     :class="formMode === 'create' && formOpen ? 'rotate-45' : ''"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span x-text="formMode === 'create' && formOpen ? 'Cancelar' : 'Nueva noticia'"></span>
            </button>
        </div>

        {{-- ── Inline form panel (Alpine.js accordion) ── --}}
        <div x-show="formOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             style="display:none;">
            @component('components.ui.card', ['hover' => false])
                {{-- Form title --}}
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-poppins font-semibold text-sm text-main"
                        x-text="formMode === 'create' ? 'Nueva noticia' : 'Editar noticia'"></h3>
                    <button type="button" @click="closeForm()"
                            class="p-1.5 rounded-lg hover:bg-gray-100 transition-colors duration-200 text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- CREATE form --}}
                <form x-show="formMode === 'create'" action="{{ route('admin.noticias.store') }}" method="POST"
                      enctype="multipart/form-data" class="flex flex-col gap-4">
                    @csrf
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-medium text-main">Título <span class="text-red-500">*</span></label>
                        <input type="text" name="titulo" value="{{ old('titulo') }}" required maxlength="150"
                               placeholder="Título de la noticia..."
                               class="w-full px-3 py-2 rounded-xl border border-gray-200 text-sm text-main
                                      focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all duration-200
                                      @error('titulo') border-red-400 @enderror">
                        @error('titulo')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-medium text-main">Contenido <span class="text-red-500">*</span></label>
                        <textarea name="contenido" rows="5" required placeholder="Contenido de la noticia..."
                                  class="w-full px-3 py-2 rounded-xl border border-gray-200 text-sm text-main resize-none
                                         focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all duration-200
                                         @error('contenido') border-red-400 @enderror">{{ old('contenido') }}</textarea>
                        @error('contenido')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-medium text-main">Imagen <span class="text-xs text-muted font-normal">(opcional · JPG, PNG, WebP · máx. 2MB)</span></label>
                        <input type="file" name="imagen" accept="image/*"
                               class="w-full text-sm text-muted file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0
                                      file:text-xs file:font-medium file:bg-primary/10 file:text-primary
                                      hover:file:bg-primary/20 transition-all duration-200">
                        @error('imagen')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="flex gap-3 pt-1">
                        <button type="submit"
                                class="flex-1 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold
                                       shadow-md transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]">
                            Publicar noticia
                        </button>
                        <button type="button" @click="closeForm()"
                                class="px-4 py-2.5 rounded-xl bg-gray-100 text-main text-sm font-medium
                                       transition-all duration-200 hover:bg-gray-200">
                            Cancelar
                        </button>
                    </div>
                </form>

                {{-- EDIT forms (one per noticia, shown based on editId) --}}
                @foreach($noticias as $noticia)
                    <form x-show="formMode === 'edit' && editId === {{ $noticia->id }}"
                          action="{{ route('admin.noticias.update', $noticia) }}" method="POST"
                          enctype="multipart/form-data" class="flex flex-col gap-4">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-medium text-main">Título <span class="text-red-500">*</span></label>
                            <input type="text" name="titulo" value="{{ old('titulo', $noticia->titulo) }}" required maxlength="150"
                                   class="w-full px-3 py-2 rounded-xl border border-gray-200 text-sm text-main
                                          focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all duration-200">
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-medium text-main">Contenido <span class="text-red-500">*</span></label>
                            <textarea name="contenido" rows="5" required
                                      class="w-full px-3 py-2 rounded-xl border border-gray-200 text-sm text-main resize-none
                                             focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all duration-200">{{ old('contenido', $noticia->contenido) }}</textarea>
                        </div>
                        @if($noticia->adjunto_url)
                            <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 border border-gray-100">
                                <img src="{{ $noticia->adjunto_url }}" alt="Imagen actual" class="w-12 h-12 object-cover rounded-lg">
                                <p class="text-xs text-muted">Imagen actual. Sube una nueva para reemplazarla.</p>
                            </div>
                        @endif
                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-medium text-main">{{ $noticia->adjunto_url ? 'Nueva imagen' : 'Imagen' }} <span class="text-xs text-muted font-normal">(opcional)</span></label>
                            <input type="file" name="imagen" accept="image/*"
                                   class="w-full text-sm text-muted file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0
                                          file:text-xs file:font-medium file:bg-primary/10 file:text-primary
                                          hover:file:bg-primary/20 transition-all duration-200">
                        </div>
                        <div class="flex gap-3 pt-1">
                            <button type="submit"
                                    class="flex-1 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold
                                           shadow-md transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]">
                                Guardar cambios
                            </button>
                            <button type="button" @click="closeForm()"
                                    class="px-4 py-2.5 rounded-xl bg-gray-100 text-main text-sm font-medium
                                           transition-all duration-200 hover:bg-gray-200">
                                Cancelar
                            </button>
                        </div>
                    </form>
                @endforeach
            @endcomponent
        </div>

        {{-- Noticias list --}}
        <div class="flex flex-col gap-3">
            @forelse ($noticias as $noticia)
                @component('components.ui.card', ['hover' => true, 'bodyClass' => 'flex items-center justify-between px-4 py-3'])
                    <div class="flex items-center gap-3 flex-1 min-w-0">
                        {{-- Thumbnail --}}
                        <div class="flex-shrink-0 w-10 h-10 rounded-lg overflow-hidden bg-primary/10">
                            @if($noticia->adjunto_url)
                                <img src="{{ $noticia->adjunto_url }}" alt="{{ $noticia->titulo }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary/30" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        {{-- Info --}}
                        <div class="flex-1 min-w-0">
                            <p class="font-poppins font-semibold text-sm text-main truncate">{{ $noticia->titulo }}</p>
                            <p class="text-xs text-muted">{{ $noticia->fecha_publicacion->format('d M Y') }}</p>
                        </div>
                    </div>
                    {{-- Actions --}}
                    <div class="flex items-center gap-1 ml-3 flex-shrink-0">
                        <a href="{{ route('noticias.show', $noticia) }}"
                           class="p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200" title="Ver noticia">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </a>
                        <button type="button" @click="openForm('edit', {{ $noticia->id }})"
                                class="p-2 rounded-lg hover:bg-primary/5 transition-colors duration-200" title="Editar noticia">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125" />
                            </svg>
                        </button>
                        <form method="POST" action="{{ route('admin.noticias.destroy', $noticia) }}"
                              onsubmit="return confirm('¿Eliminar esta noticia?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 rounded-lg hover:bg-red-50 transition-colors duration-200" title="Eliminar noticia">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @endcomponent
            @empty
                <div class="flex flex-col items-center justify-center py-10 text-center">
                    <p class="text-sm text-muted">No hay noticias publicadas aún</p>
                    <button type="button" @click="openForm('create')" class="mt-2 text-sm text-primary font-medium hover:underline">
                        Publicar la primera →
                    </button>
                </div>
            @endforelse
        </div>

    </div>

</div>

<script>
function adminPanel() {
    return {
        formOpen: {{ $errors->any() ? 'true' : 'false' }},
        formMode: '{{ old("_method") === "PUT" ? "edit" : "create" }}',
        editId: null,

        openForm(mode, id = null) {
            if (this.formOpen && this.formMode === mode && this.editId === id) {
                this.closeForm();
                return;
            }
            this.formMode = mode;
            this.editId = id;
            this.formOpen = true;
            this.$nextTick(() => {
                document.querySelector('[x-show="formOpen"]')?.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            });
        },

        closeForm() {
            this.formOpen = false;
            this.editId = null;
        }
    }
}
</script>
@endsection
