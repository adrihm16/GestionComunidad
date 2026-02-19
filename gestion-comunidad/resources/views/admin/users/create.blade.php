@extends('layouts.admin')

@section('title', 'Crear Usuario - Panel Admin')

@section('content')
<div class="flex flex-col gap-5 max-w-2xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.users.index') }}" 
           class="p-2 rounded-lg hover:bg-primary/5 transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
        </a>
        @include('components.ui.section-title', ['title' => 'Crear Nuevo Usuario', 'titleClass' => 'text-xl mb-0'])
    </div>

    {{-- Form Component --}}
    <x-admin.users.form :action="route('admin.users.store')" />

</div>
@endsection
