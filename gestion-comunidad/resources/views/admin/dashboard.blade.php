@extends('layouts.admin')

@section('title', 'Panel de Administración')

@section('content')
    <div class="flex flex-col gap-6">

        {{-- Welcome header --}}
        <div>
            @include('components.ui.section-title', ['title' => 'Panel de Administración', 'titleClass' => 'text-2xl'])
            <p class="text-sm text-muted -mt-4">Gestiona todos los recursos de la comunidad desde aquí.</p>
        </div>

        {{-- Management cards grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            {{-- Gestión Usuarios --}}
            <a href="{{ route('admin.users.index') }}" class="block">
                @component('components.ui.card', ['hover' => true])
                <div class="flex flex-col gap-3">
                    <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-primary/10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-poppins font-semibold text-base text-main">Gestión Usuarios</p>
                        <p class="text-xs text-muted mt-0.5">Añade, edita o elimina vecinos y administradores</p>
                    </div>
                    <div class="flex items-center gap-1 text-primary text-xs font-semibold">
                        Ver usuarios
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </div>
                </div>
                @endcomponent
            </a>

            {{-- Gestión Noticias --}}
            <a href="{{ route('admin.noticias.index') }}" class="block">
                @component('components.ui.card', ['hover' => true])
                <div class="flex flex-col gap-3">
                    <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-primary/10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-poppins font-semibold text-base text-main">Gestión Noticias</p>
                        <p class="text-xs text-muted mt-0.5">Publica, edita y elimina noticias de la comunidad</p>
                    </div>
                    <div class="flex items-center gap-1 text-primary text-xs font-semibold">
                        Ver noticias
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </div>
                </div>
                @endcomponent
            </a>

            {{-- Gestión Incidencias --}}
            <a href="{{ route('admin.incidencias.index') }}" class="block">
                @component('components.ui.card', ['hover' => true])
                <div class="flex flex-col gap-3">
                    <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-primary/10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-poppins font-semibold text-base text-main">Gestión Incidencias</p>
                        <p class="text-xs text-muted mt-0.5">Revisa y actualiza el estado de las incidencias</p>
                    </div>
                    <div class="flex items-center gap-1 text-primary text-xs font-semibold">
                        Ver incidencias
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </div>
                </div>
                @endcomponent
            </a>

            {{-- Balance Financiero --}}
            <a href="{{ route('admin.balance.index') }}" class="block">
                @component('components.ui.card', ['hover' => true])
                <div class="flex flex-col gap-3">
                    <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-primary/10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-poppins font-semibold text-base text-main">Balance Financiero</p>
                        <p class="text-xs text-muted mt-0.5">Consulta ingresos, gastos y el balance neto</p>
                    </div>
                    <div class="flex items-center gap-1 text-primary text-xs font-semibold">
                        Ver balance
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </div>
                </div>
                @endcomponent
            </a>

        </div>

        {{-- Quick stats --}}
        <div class="grid grid-cols-3 gap-3">
            <div
                class="flex flex-col items-center justify-center p-4 rounded-2xl bg-white shadow-sm border border-gray-100">
                <p class="text-2xl font-bold text-primary">{{ \App\Models\User::count() }}</p>
                <p class="text-xs text-muted mt-1">Usuarios</p>
            </div>
            <div
                class="flex flex-col items-center justify-center p-4 rounded-2xl bg-white shadow-sm border border-gray-100">
                <p class="text-2xl font-bold text-primary">{{ \App\Models\Noticia::count() }}</p>
                <p class="text-xs text-muted mt-1">Noticias</p>
            </div>
            <div
                class="flex flex-col items-center justify-center p-4 rounded-2xl bg-white shadow-sm border border-gray-100">
                <p class="text-2xl font-bold text-primary">
                    {{ \App\Models\Incidencia::whereIn('estado', ['pendiente', 'en_proceso'])->count() }}
                </p>
                <p class="text-xs text-muted mt-1">Incidencias activas</p>
            </div>
        </div>

    </div>
@endsection