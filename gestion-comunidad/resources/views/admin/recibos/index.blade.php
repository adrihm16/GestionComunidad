@extends('layouts.admin')

@section('title', 'Gestión de Recibos - Panel Admin')

@section('content')
<div x-data="{ 
    createModalOpen: false, 
    editModalOpen: false,
    editingRecibo: { id: null, monto: 0, concepto: '' },
    openEditModal(recibo) {
        this.editingRecibo = recibo;
        this.editModalOpen = true;
    }
}">
    <div class="flex flex-col gap-6">
        
        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-r shadow-sm" role="alert">
                <p class="font-bold">Éxito</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        {{-- Header & Filters --}}
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-main">Gestión de Recibos</h1>
                <p class="text-sm text-muted">Administra los recibos y cuotas de la comunidad</p>
            </div>

            <div class="flex flex-col lg:flex-row gap-3 w-full lg:w-auto">
                <x-admin.recibos.filters :anio="request('anio')" :mes="request('mes')" :search="request('search')" />

                {{-- Create Button --}}
                <button @click="createModalOpen = true"
                        class="w-full lg:w-auto px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-medium shadow-lg hover:scale-105 transition-transform active:scale-95 flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Nuevo Recibo Manual
                </button>
            </div>
        </div>

        {{-- Data Table --}}
        <x-admin.recibos.table :recibos="$recibos" />

        {{-- Create Receipt Modal --}}
        <x-admin.recibos.create-modal open="createModalOpen" :inmuebles="$inmuebles" />

        {{-- Edit Amount Modal --}}
        <x-admin.recibos.edit-modal open="editModalOpen" />

    </div>
</div>
@endsection
