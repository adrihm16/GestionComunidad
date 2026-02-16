@extends('layouts.app')

@section('title', 'Lista de Vecinos - Gestión Comunidad')

@section('content')
<div class="flex flex-col gap-5">

    {{-- Page Title --}}
    @include('components.ui.section-title', ['title' => 'Lista de Vecinos', 'titleClass' => 'text-xl'])

    {{-- Search Bar --}}
    @include('components.ui.search-bar', ['action' => url('/vecinos')])

    {{-- Vecinos List --}}
    <div class="flex flex-col gap-4" id="vecinos-list">

        @forelse ($inmuebles as $inmueble)
                {{-- Vecino Card --}}
                @component('components.ui.card', [
                    'hover' => true,
                    'stripContent' => '<span class="font-poppins font-semibold text-white text-base">' . e($inmueble->piso) . 'º' . e($inmueble->puerta) . '</span>',
                    'bodyClass' => 'flex items-center justify-between px-4 py-3.5',
                    'cardClass' => '',
                ])
                    <p class="font-poppins font-medium text-base text-main">
                        {{ $inmueble->propietario->nombre }} {{ $inmueble->propietario->apellidos }}
                    </p>

                    @if($inmueble->propietario->cargo_comunidad && $inmueble->propietario->cargo_comunidad !== '' && $inmueble->propietario->cargo_comunidad !== '-')
                        @include('components.ui.badge', ['text' => $inmueble->propietario->cargo_comunidad, 'variant' => 'accent'])
                    @endif
                @endcomponent
        @empty
            {{-- Empty state --}}
            <div class="flex flex-col items-center justify-center py-12 text-center">
                <div class="flex items-center justify-center w-16 h-16 rounded-full bg-primary/5 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-primary/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div>
                <p class="font-medium text-sm text-muted">No se encontraron vecinos</p>
                @if(request('search'))
                    <p class="text-xs text-muted mt-1">Prueba con otro término de búsqueda</p>
                @endif
            </div>
        @endforelse

    </div>

    {{-- Pagination --}}
    <div class="mt-2">
        {{ $inmuebles->withQueryString()->links() }}
    </div>

</div>
@endsection
