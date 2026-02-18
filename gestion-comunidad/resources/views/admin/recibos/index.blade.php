@extends('layouts.admin')

@section('title', 'Gestión de Recibos - Panel Admin')

@section('content')
<div x-data="{ 
    modalOpen: false, 
    recibos: {{ json_encode($recibos) }},
    markAsPaid(reciboId) {
        const recibo = this.recibos.find(r => r.id === reciboId);
        if (recibo) {
            recibo.estado = recibo.estado === 'pagado' ? 'pendiente' : 'pagado';
        }
    }
}">
    <div class="flex flex-col gap-6">
        
        {{-- Header & Filters --}}
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-main">Gestión de Recibos</h1>
                <p class="text-sm text-muted">Administra los recibos y cuotas de la comunidad</p>
            </div>

            <div class="flex flex-col lg:flex-row gap-3 w-full lg:w-auto">
                {{-- Month Filter --}}
                <select class="w-full lg:w-auto px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm text-main focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                    <option value="">Mes / Año</option>
                    <option value="2026-03" selected>Marzo 2026</option>
                    <option value="2026-02">Febrero 2026</option>
                    <option value="2026-01">Enero 2026</option>
                </select>

                {{-- Search Bar --}}
                <div class="relative w-full lg:w-auto">
                    <input type="text" 
                           placeholder="Buscar vecino o propiedad..." 
                           class="w-full lg:w-64 px-4 py-2.5 pl-10 rounded-xl border border-gray-200 bg-white text-sm text-main focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-muted absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </div>

                {{-- Create Button --}}
                <button @click="modalOpen = true"
                        class="w-full lg:w-auto px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-medium shadow-lg hover:scale-105 transition-transform active:scale-95 flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Nuevo Recibo Manual
                </button>
            </div>
        </div>

        {{-- Data Table --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-main">
                    <thead class="bg-gray-50 border-b border-gray-100 text-xs uppercase text-muted font-medium">
                        <tr>
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Fecha (Mes)</th>
                            <th class="px-6 py-4">Propiedad</th>
                            <th class="px-6 py-4">Propietario</th>
                            <th class="px-6 py-4">Concepto</th>
                            <th class="px-6 py-4">Monto</th>
                            <th class="px-6 py-4">Estado</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <template x-for="recibo in recibos" :key="recibo.id">
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 font-medium text-main" x-text="'#' + recibo.id"></td>
                                <td class="px-6 py-4 text-muted" x-text="new Date(recibo.fecha_emision).toLocaleDateString('es-ES', { month: 'long', year: 'numeric' })"></td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-medium text-main" x-text="recibo.inmueble.tipo.charAt(0).toUpperCase() + recibo.inmueble.tipo.slice(1)"></span>
                                        <span class="text-xs text-muted" x-text="(recibo.inmueble.tipo === 'garaje' || recibo.inmueble.tipo === 'trastero') ? recibo.inmueble.piso : recibo.inmueble.piso + 'º ' + recibo.inmueble.puerta"></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <span x-text="recibo.propietario.nombre + ' ' + recibo.propietario.apellidos"></span>
                                        <template x-if="recibo.propietario.cargo_comunidad">
                                            <span class="px-2 py-0.5 rounded-full bg-blue-100 text-blue-700 text-[10px] font-semibold tracking-wide uppercase" x-text="recibo.propietario.cargo_comunidad"></span>
                                        </template>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-main" x-text="recibo.concepto"></td>
                                <td class="px-6 py-4 font-medium text-main" x-text="parseFloat(recibo.monto).toFixed(2) + ' €'"></td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border"
                                          :class="recibo.estado === 'pagado' 
                                            ? 'bg-accent/10 text-primary border-accent' 
                                            : 'bg-orange-100 text-orange-700 border-orange-200'"
                                          x-text="recibo.estado === 'pagado' ? 'Pagado' : 'Pendiente'">
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button @click="markAsPaid(recibo.id)" 
                                            class="text-xs font-medium hover:underline transition-colors focus:outline-none"
                                            :class="recibo.estado === 'pagado' ? 'text-orange-600 hover:text-orange-700' : 'text-primary hover:text-green-800'"
                                            x-text="recibo.estado === 'pagado' ? 'Marcar como Pendiente' : 'Marcar como Pagado'">
                                    </button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination Placeholder --}}
            <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between">
                <p class="text-xs text-muted">Mostrando 4 recibos</p>
                <div class="flex items-center gap-2">
                    <button class="p-1 text-muted hover:text-main disabled:opacity-50" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </button>
                    <button class="p-1 text-muted hover:text-main disabled:opacity-50" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Create Receipt Modal --}}
        <div x-show="modalOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4"
             style="display: none;">
            
            <div @click.away="modalOpen = false"
                 class="bg-white w-full max-w-lg rounded-2xl shadow-xl overflow-hidden flex flex-col max-h-[90vh]">
                
                {{-- Modal Header --}}
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gray-50">
                    <h3 class="text-lg font-semibold text-main">Nuevo Recibo Manual</h3>
                    <button @click="modalOpen = false" class="text-muted hover:text-main">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Modal Body --}}
                <div class="p-6 overflow-y-auto">
                    <form class="flex flex-col gap-4">
                        
                        {{-- Property Selector --}}
                        <div>
                            <label class="block text-sm font-medium text-main mb-1.5">Propiedad</label>
                            <select class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                                <option value="">Seleccionar Propiedad...</option>
                                <option value="1">1º A - Juan Pérez</option>
                                <option value="2">2º B - Ana García</option>
                                <option value="3">Local Bajo - Carlos Ruiz</option>
                            </select>
                        </div>

                        {{-- Concept --}}
                        <div>
                            <label class="block text-sm font-medium text-main mb-1.5">Concepto</label>
                            <input type="text" 
                                   value="Cuota Comunidad"
                                   class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            {{-- Amount --}}
                            <div>
                                <label class="block text-sm font-medium text-main mb-1.5">Monto (€)</label>
                                <input type="number" 
                                       placeholder="0.00" 
                                       step="0.01"
                                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                            </div>

                            {{-- Date --}}
                            <div>
                                <label class="block text-sm font-medium text-main mb-1.5">Fecha Emisión</label>
                                <input type="date" 
                                       value="{{ date('Y-m-d') }}"
                                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                            </div>
                        </div>

                    </form>
                </div>

                {{-- Modal Footer --}}
                <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-end gap-3 bg-gray-50">
                    <button @click="modalOpen = false" 
                            class="px-5 py-2.5 rounded-xl text-sm font-medium text-muted hover:bg-gray-100 transition-colors">
                        Cancelar
                    </button>
                    <button @click="modalOpen = false" 
                            class="px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-medium shadow-md hover:scale-105 active:scale-95 transition-all">
                        Guardar Recibo
                    </button>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
